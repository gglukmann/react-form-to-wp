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
  { }

  function activate()
  { }

  function deactivate()
  { }

  function uninstall()
  { }
}

// activate
if (class_exists('ReactFormToWP')) {
  $reactFromToWP = new ReactFormToWP();
}

// deactivate

// uninstall
