# react-form-to-wp

Wordpress plugin. Save contact form fields from React POST query to Wordpress.

## Installation

- Add to WP and activate
- Add this code to theme functions.php

```php
$RFTWP_post = array(
  'post_title'  => $contactName,
  'post_type'    => 'form',
  'post_status'  => 'publish'
);

$post_id = wp_insert_post($RFTWP_post);
update_field('name', $contactName, $post_id);
update_field('email', $contactEmail, $post_id);
update_field('phone', $contactPhone, $post_id);
update_field('message', $contactMessage, $post_id);
update_field('time', date('d.m.Y H:i:s'), $post_id);
```
