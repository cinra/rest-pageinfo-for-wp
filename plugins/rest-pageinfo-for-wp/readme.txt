=== REST PAGEINFO FOR WP ===
Contributors: higayo 
Tags: api, development
Requires at least: 4.7
Tested up to: 5.7
Stable tag: 1.0.0
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Easy get page, post and custom post inforamtion for frontend develop!

== Description ==

## ABOUT

"REST PAGEINFO FOR WP" was developed for the purpose of improving the efficiency of component sorting by page type in SPA development on the frontend.
When this plugin is enabled, the page status is returned using the URI as a key.

## API

### Endpoint

|post_type|endpoint|notes|
|:-|:-|:-|
|page(default)|/wp-json/wp/v2/page-info/{URI}||
|post(default)|/wp-json/wp/v2/page-info/post/{URI}|needs `post`|
|archive(default)|/wp-json/wp/v2/page-info/post|needs `post`|
|custom_post|/wp-json/wp/v2/page-info/{URI}||
|arthive(custom_post)|/wp-json/wp/v2/page-info/{URI}||

- Attention!!!  
Page and Custom post use only {URI}, but default post(archive) needs `post`.

### Response

```json
{
  "current": "post/hello-world",
  "the_id": 4,
  "is_home": false,
  "is_page": false,
  "is_single": true,
  "is_archive": true,
  "is_404": false,
  "preview_revision_id": "",
  "meta": [ ]
}
```

## Customize response data

If you customize response data(ex: breadcrumbs, meta desciption, etc...), please hook to `apply_filters('filter_rest_pageinfo_for_wp', $info, $request)`.

## About Preview post

If you want get preview post, need jwt plugin for check wp logined.

## You can easy check it by docker

https://github.com/cinra/rest-pageinfo-for-wp#you-can-easy-check-it-by-docker

== Changelog ==

= 1.0.0 =
* Publish plugin!

== Upgrade Notice ==

= 1.0.0 =
* Publish plugin!
