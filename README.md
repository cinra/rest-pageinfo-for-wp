# WP REST PAGEINFO

This plug-in was developed for the purpose of improving the efficiency of component sorting by page type in SPA development on the front end.
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

If you customize response data(ex: breadcrumbs, meta desciption, etc...), please hook to `apply_filters('filter_wp_rest_pageinfo', $info, $request)`.

## About Preview post

If you want get preview post, need jwt plugin for check wp logined.

## You can easy check it by docker

### run docker 
```sh
$ docker-compose up -d
$ docker exec -it wprestpageinfo_db bash -c "mysql -h localhost -u exampleuser -pexamplepass exampledb < /sql/sample.sql"
```
Sampel post  
http://127.0.0.1:8080/wp-json/wp/v2/page-info/post/hello-world

### Access wp

http://127.0.0.1:8080/wp-admin

|User name|Password|
|:-|:-|
|admin|admin|
