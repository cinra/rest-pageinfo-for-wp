<?php
/*
Plugin Name: REST PAGEINFO FOR WP 
Plugin URI: https://github.com/cinra/wp-rest-pageinfo
Description: Get page infomation for spa component control by frontend. 
Author: Hirohito Higa / Aoki Yuichi
Version: 1.0.0
Author URI: https://www.cinra.co.jp
Text Domain: cinra
License: GPLv2 or later
*/

class RestPageinfoForWP
{
  private $api_access_point = '/page-info';

  protected function __construct()
  {
    $this->set_api();
    $this->set_wp_initialize();
    $this->set_element_response_header();
  }

  private function set_api()
  {
    add_action('rest_api_init', function () {
      register_rest_route('wp/v2', $this->api_access_point . '/(?P<slug>.*)', array(
        'methods' => 'GET',
        'callback' => 'response_get_page_info',
      ));
    }, 10000);

    function response_get_page_info(WP_REST_Request $request)
    {
      return rest_ensure_response(RestPageinfoForWP::get_page_info($request));
    }
  }

  private function set_wp_initialize()
  {
    add_action('wp_footer', function () {
      wp_localize_script('app', 'WP_INITIALIZE', $this->get_page_info());
      wp_localize_script('app', 'WP_API_Settings', array(
        'root' => esc_url_raw(rest_url()),
        'nonce' => wp_create_nonce('wp_rest')
      ));
    });
  }

  private function set_element_response_header()
  {
    add_filter('wp_rest_server_class', function ($wp_rest_server) {
      $obj = parse_url($_SERVER['REQUEST_URI']);
      preg_match('/^\/wp-json\/wp\/v2\/(.+)$/', $obj['path'], $match);

      if (!empty($match[1])) {
        $api_target_str = explode('/', $match[1]);

        if (empty($api_target_str[1])) {
          $current = isset($_GET['page']) ? esc_html($_GET['page']) : 1;
          header('X-WP-CurrentPage: ' . $current);
        }
      }
      return $wp_rest_server;
    }, 10, 1);
  }

  public static function get_page_info($request = null)
  {
    $uri            = null;
    $the_id         = null;
    $home_id        = null;
    $post_type      = null;
    $is_page        = false;

    $json = file_get_contents(__DIR__ . '/respose_base.json');
    if ($json === false) throw new \RuntimeException('file not found.');

    $info = json_decode($json, true);

    if ($request) {
      $uri     = $request->get_params('params')['slug'];

      $post_info = explode('/', $uri);

      $page_types = get_post_types(array(
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true
      ));

      $page_type = 'page';

      foreach ($page_types as $type) {
        if ($type === $post_info[0]) {
          $page_type = $post_info[0];
          break;
        }
      }

      $path = null;

      if ($page_type === 'page') {
        foreach ($post_info as $k => $v) {
          $path .= '/' . $v;
        }
      } else {
        foreach ($post_info as $k => $v) {
          if (!$k) continue;
          $path .= '/' . $v;
        }
      }

      $home_id = get_option('page_on_front');
      $page_obj = get_page_by_path($path, OBJECT, $page_type);

      if ($page_obj && $page_obj->post_type === 'page') {
        $is_page = true;
      }
      

      if ($page_obj && !$the_id) $the_id = $page_obj->ID;
      if (empty($post_info[1])) $post_type = $post_info[0];
    } else {
      $obj = parse_url($_SERVER['REQUEST_URI']);
      preg_match('/^\/(.+)\/$/', $obj['path'], $match);
      if (!empty($match[1])) $uri = $match[1];
    }

    $info['current']    = $uri ? $uri : "";
    $info['the_id']     = $request ? $the_id : (is_post_type_archive() ? null : get_the_ID());
    $info['is_home']    = $request ? ($home_id == $the_id ? true : false) : is_front_page();
    $info['is_page']    = $request ? ($is_page) : is_page();
    $info['is_single']  = $request ? (!$is_page && $the_id ? true : false) : is_single();

    if ($post_type || (!$info['is_page'] && !$info['is_single'])) {
      $info['is_archive'] = $request ? post_type_exists($post_type) : is_post_type_archive();
    }

    if (!$info['the_id'] && !$info['is_archive']) {
      $info['is_404'] = true;
    }

    $info = apply_filters('filter_rest_pageinfo_for_wp', $info, $request);

    if (isset($_GET['preview']) && $_GET['preview']) {
      $preview_revisions = isset($info['the_id']) ? wp_get_post_revisions($info['the_id']) : "";

      if (!empty($preview_revisions)) {
        ksort($preview_revisions, SORT_NUMERIC);
        if (end($arr)->ID) $info['preview_revision_id'] = end($arr)->ID;
      }
    }

    return $info;
  }

  public static function init()
  {
    return new RestPageinfoForWP;
  }
}

RestPageinfoForWP::init();
