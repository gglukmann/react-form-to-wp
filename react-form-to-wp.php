<?php

/**
 * @package ReactFormToWP
 */
/*
Plugin Name: React Form To WP
Plugin URI: https://github.com/gglukmann/react-form-to-wp
Description: React From to Wordpress
Version: 1.0.0
Author: Gert Glükmann
Author URI: https://github.com/gglukmann
License: GPLv2 or later
Text-Domain: react-form-to-wp
 */

if (!defined('ABSPATH')) {
  die;
}

global $rftw_db_version;
$rftw_db_version = '1.0';

class ReactFormToWP
{
  public function activate()
  {
    $this->create_db();
  }

  public function deactivate()
  { }

  public function uninstall()
  { }

  private function create_db()
  {
    global $wpdb;
    global $rftw_db_version;

    $table_name = $wpdb->prefix . "react_form_to_wp";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      name tinytext NOT NULL,
      email tinytext NOT NULL,
      message text NOT NULL,
      PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    add_option('rftw_db_version', $rftw_db_version);
  }
}

if (class_exists('ReactFormToWP')) {
  $reactFromToWP = new ReactFormToWP();
}

// activation
register_activation_hook(__FILE__, array($reactFromToWP, 'activate'));

// deactivate
register_deactivation_hook(__FILE__, array($reactFromToWP, 'deactivate'));

// uninstall
