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

class ReactFormToWP
{
  function __construct()
  {
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

  public function custom_post_type()
  {
    register_post_type('form', ['public' => true, 'label' => 'Form', 'supports' => array('title')]);
  }
}

if (class_exists('ReactFormToWP')) {
  $reactFromToWP = new ReactFormToWP();
}

// activation
register_activation_hook(__FILE__, array($reactFromToWP, 'activate'));

// deactivate
register_deactivation_hook(__FILE__, array($reactFromToWP, 'deactivate'));
