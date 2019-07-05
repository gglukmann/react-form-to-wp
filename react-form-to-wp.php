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

// global $rftw_db_version;
// $rftw_db_version = '1.0';

class ReactFormToWP
{
  function __construct()
  {
    // add_action('init', array($this, 'create_db_table'));
    add_action('init', array($this, 'custom_post_type'));
  }

  public function activate()
  {
    flush_rewrite_rules();
    // $this->create_db_table();
    $this->custom_post_type();
  }

  public function deactivate()
  {
    flush_rewrite_rules();
  }

  // public function uninstall()
  // { }

  public function custom_post_type()
  {
    register_post_type('form', ['public' => true, 'label' => 'Form', 'supports' => array('title')]);
  }

  // public function create_db_table()
  // {
  //   global $wpdb;
  //   global $rftw_db_version;

  //   $table_name = $wpdb->prefix . "react_form_to_wp";
  //   $charset_collate = $wpdb->get_charset_collate();

  //   $sql = "CREATE TABLE $table_name (
  //     id mediumint(9) NOT NULL AUTO_INCREMENT,
  //     time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  //     name tinytext NOT NULL,
  //     email tinytext NOT NULL,
  //     message text NOT NULL,
  //     PRIMARY KEY (id)
  //   ) $charset_collate;";

  //   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  //   dbDelta($sql);

  //   add_option('rftw_db_version', $rftw_db_version);
  // }

  // public function delete_db_table()
  // { }
}

if (class_exists('ReactFormToWP')) {
  $reactFromToWP = new ReactFormToWP();
}

// activation
register_activation_hook(__FILE__, array($reactFromToWP, 'activate'));

// deactivate
register_deactivation_hook(__FILE__, array($reactFromToWP, 'deactivate'));

// uninstall
// if (defined('WP_UNINSTALL_PLUGIN')) {
//   register_uninstall_hook(__FILE__, array($reactFromToWP, 'uninstall'));
// }
