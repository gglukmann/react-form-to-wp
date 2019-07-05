<?php

/**
 * Trigger this file on plugin uninstall
 *
 * @package ReactFormToWP
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
  die;
}

$forms = get_posts(array('post_type' => 'form', 'numberposts' => -1));

foreach ($forms as $form) {
  wp_delete_post($form->ID, true);
}
