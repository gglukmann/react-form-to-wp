<?php

/**
 * @package ReactFormToWP
 */
/*
Plugin Name: React Form To WP
Plugin URI: https://github.com/gglukmann/react-form-to-wp
Description: Save contact form fields from React POST query to Wordpress.
Version: 1.0.0
Author: Gert Glükmann
Author URI: https://github.com/gglukmann
License: GPLv3
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
    add_action('init', array($this, 'custom_field_group'));
    add_action('manage_form_posts_custom_column', array($this, 'form_custom_columns'));
    add_filter('manage_edit-form_columns', array($this, 'form_columns'));
  }

  public function activate()
  {
    flush_rewrite_rules();
    $this->custom_post_type();
    $this->custom_field_group();
  }

  public function deactivate()
  {
    flush_rewrite_rules();
  }

  function custom_post_type()
  {
    /**
     * Post Type: Forms.
     */

    $labels = array(
      "name" => __("Forms", "custom-post-type-ui"),
      "singular_name" => __("Form", "custom-post-type-ui"),
    );

    $args = array(
      "label" => __("Forms", "custom-post-type-ui"),
      "labels" => $labels,
      "description" => "",
      "public" => true,
      "publicly_queryable" => true,
      "show_ui" => true,
      "delete_with_user" => false,
      "show_in_rest" => true,
      "rest_base" => "",
      "rest_controller_class" => "WP_REST_Posts_Controller",
      "has_archive" => false,
      "show_in_menu" => true,
      "show_in_nav_menus" => true,
      "exclude_from_search" => false,
      "capability_type" => "post",
      "map_meta_cap" => true,
      "hierarchical" => false,
      "rewrite" => array("slug" => "form", "with_front" => true),
      "query_var" => true,
      "supports" => array("title"),
    );

    register_post_type("form", $args);
  }

  function custom_field_group()
  {
    if (function_exists('acf_add_local_field_group')) {

      acf_add_local_field_group(array(
        'key' => 'form_data',
        'title' => 'Form data',
        'fields' => array(),
        'location' => array(
          array(
            array(
              'param' => 'post_type',
              'operator' => '==',
              'value' => 'form',
            ),
          ),
        ),
      ));

      acf_add_local_field(array(
        'key' => 'name',
        'label' => 'Name',
        'name' => 'name',
        'type' => 'text',
        'required' => 1,
        'parent' => 'form_data',
      ));

      acf_add_local_field(array(
        'key' => 'email',
        'label' => 'Email',
        'name' => 'email',
        'type' => 'text',
        'required' => 1,
        'parent' => 'form_data',
      ));

      acf_add_local_field(array(
        'key' => 'phone',
        'label' => 'Phone',
        'name' => 'phone',
        'type' => 'text',
        'required' => 0,
        'parent' => 'form_data',
      ));

      acf_add_local_field(array(
        'key' => 'message',
        'label' => 'Message',
        'name' => 'message',
        'type' => 'textarea',
        'required' => 1,
        'parent' => 'form_data',
      ));

      acf_add_local_field(array(
        'key' => 'time',
        'label' => 'Time',
        'name' => 'time',
        'type' => 'text',
        'required' => 1,
        'parent' => 'form_data',
      ));
    }
  }

  function form_columns($columns)
  {
    $columns = array(
      'cb' => '< input type="checkbox" />',
      'title' => 'Title',
      'email' => 'Email',
      'number' => 'Number',
      'message' => 'Message',
      'time' => 'Time',
    );
    return $columns;
  }

  function form_custom_columns($column)
  {
    global $post;

    switch ($column) {
      case 'email':
        echo get_field('email', $post->ID);
        break;
      case 'number':
        echo get_field('number', $post->ID);
        break;
      case 'message':
        echo get_field('message', $post->ID);
        break;
      case 'time':
        echo get_field('time', $post->ID);
        break;
      default:
        return;
    }
  }
}

if (class_exists('ReactFormToWP')) {
  $reactFromToWP = new ReactFormToWP();
}

// activation
register_activation_hook(__FILE__, array($reactFromToWP, 'activate'));

// deactivate
register_deactivation_hook(__FILE__, array($reactFromToWP, 'deactivate'));
