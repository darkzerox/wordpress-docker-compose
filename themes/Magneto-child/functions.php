<?php

global $domain;
$domain = "Magnetolabs";

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
  // wp_deregister_script('jquery');

  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

  wp_enqueue_script(
    'main',
    get_stylesheet_directory_uri() . '/public/scripts/main.js',
    '',
    '',
    false
  );

  $pageTemplate = get_body_class(get_the_ID());

  /**
    // custom load css js
     */

  if (is_front_page()) {
    //css
    wp_enqueue_style(
      'style-home',
      get_stylesheet_directory_uri() . '/public/styles/home.css'
    );

    //js
    wp_enqueue_script(
      'home',
      get_stylesheet_directory_uri() . '/public/scripts/home.js',
      '',
      '',
      false
    );
  }

  if (is_archive() || (!is_front_page() && is_home())) {
    //css
    wp_enqueue_style(
      'archive',
      get_stylesheet_directory_uri() . '/public/styles/archive.css'
    );

    //js
    wp_enqueue_script(
      'archive',
      get_stylesheet_directory_uri() . '/public/scripts/archive.js',
      '',
      '',
      false
    );
  }

  if (is_single()) {
    //css
    wp_enqueue_style(
      'style-single',
      get_stylesheet_directory_uri() . '/public/styles/single.css'
    );

    //js
    wp_enqueue_script(
      'single',
      get_stylesheet_directory_uri() . '/public/scripts/single.js',
      '',
      '',
      false
    );
  }

  if (is_search()) {
    wp_enqueue_style(
      'style-search',
      get_stylesheet_directory_uri() . '/public/styles/archive.css'
    );
  }

  if (is_page() || is_404()) {
    if (!is_front_page()) {
      //css
      wp_enqueue_style(
        'style-page',
        get_stylesheet_directory_uri() . '/public/styles/page.css'
      );

      //js
      wp_enqueue_script(
        'page',
        get_stylesheet_directory_uri() . '/public/scripts/page.js',
        '',
        '',
        false
      );
    }
  }

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}

// Add backend styles for Gutenberg.
add_action('enqueue_block_editor_assets', 'gutenberg_editor_assets');

function gutenberg_editor_assets()
{
  // Load the theme styles within Gutenberg.
  wp_enqueue_style(
    'gutenberg-editor-styles',
    get_template_directory_uri() . '/public/styles/gutenberg-editor-styles.css',
    false
  );
}

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_stylesheet_directory() . '/inc/template-functions.php';

/**
 * Gutenburg Block Register
 */
require get_stylesheet_directory() . '/inc/gutenberg-block-function.php';

/**
 * get Icon Function
 */
require get_stylesheet_directory() . '/inc/icons.php';

/**
 * get module Function
 */
// require get_stylesheet_directory() . '/inc/module-function.php';

if (!function_exists('magneto_setup')):
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function magneto_setup()
  {
    // This theme uses wp_nav_menu() in one location.
    register_nav_menus([
      // 'primary' => __( 'primary' ),
      'footer' => __('Footer'),
    ]);

    add_theme_support('custom-logo', [
      'height' => 250,
      'width' => 250,
      'flex-width' => true,
      'flex-height' => true,
    ]);

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    //   add_theme_support( 'html5', array(
    //     'search-form',
    //     'comment-form',
    //     'comment-list',
    //     'gallery',
    //     'caption',
    //   ) );
  }
endif;
add_action('after_setup_theme', 'magneto_setup');