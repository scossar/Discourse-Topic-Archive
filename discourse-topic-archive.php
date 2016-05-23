<?php

/**
 * Plugin Name: Archive Discourse Topic
 * Plugin Author: scossar
 * Description: Loads a Discourse topic into the WordPress post editor
 *
 * Version: 0.0.1
 */
class Archive_Discourse_Topic {
  
  protected static $instance = null;

  public static function get_instance() {
    self::$instance === null && self::$instance = new self;

    return self::$instance;
  }

  protected function __construct() {
    add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_javascript' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'discourse_topic_styles' ) );
    add_action( 'add_meta_boxes', array( $this, 'add_discourse_meta_box' ) );
    add_action( 'wp_ajax_get_json', array( $this, 'get_json' ) );
  }

  public function admin_styles() {
    wp_enqueue_style( 'admin-styles', plugins_url( 'lib/css/admin-styles.css', __FILE__ ) );
  }

  public function discourse_topic_styles() {
    wp_enqueue_style( 'discourse-styles', plugins_url( 'lib/css/discourse-topic-styles.css', __FILE__ ) );
  }

  public function enqueue_javascript( $hook ) { // $hook contains the name of the current admin page.
    if ( $hook != 'post.php' && $hook != 'post-new.php' ) {
      return;
    }
    wp_enqueue_script( 'discourse-content', plugins_url( 'lib/js/wp-discourse-topic.js', __FILE__ ) );
  }

  function add_discourse_meta_box() {
    add_meta_box(
      'discourse-fetch',
      'Load Discourse Topic',
      array( $this, 'discourse_meta_box_callback' ),
      null,
      'normal',
      'high'
    );
  }

  function discourse_meta_box_callback() { ?>
    <div id="discourse-message"></div>
    <div class="loading"></div>
    <label for="discourse-url">URL:</label>
    <input type="text" id="discourse-url" name="discourse-url"/>
    <button id="get-topic">Fetch Discourse Topic</button>
    <div class="topic-posts"></div>
    <?php
  }

  function get_json() {
    $url = $_GET['url'];
    $topic_json = file_get_contents( $url );
    echo $topic_json;
    wp_die();
  }
}

Archive_Discourse_Topic::get_instance();

