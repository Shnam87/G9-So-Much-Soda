<?php
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo');


// Que in scripts (worked without but just in case)
add_action('wp_enqueue_scripts', 'somuchsoda_enqueue');

function somuchsoda_enqueue()
{
  wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('after_setup_theme', 'woocommerce_support');

function woocommerce_support()
{
  add_theme_support('woocommerce');
}


if (!function_exists('somuchsoda_theme_register_nav_menu')) {

  function somuchsoda_theme_register_nav_menu()
  {
    register_nav_menus(array(
      'primary_menu' => __('Primary Menu', 'text_domain'),
      'right_footer_menu'  => __('Right Footer Menu', 'text_domain'),
      'left_footer_menu'  => __('Left Footer Menu', 'text_domain'),
    ));
  }
  add_action('after_setup_theme', 'somuchsoda_theme_register_nav_menu', 0);
}


function change_excerpt_length($length)
{
  return 15;
}
add_filter('excerpt_length', 'change_excerpt_length');


function new_excerpt_more($more)
{
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


/* welcome-widgets-menus */

add_action('acf/init', 'my_acf_init_block_types');

function my_acf_init_block_types()
{

  // Check function exists.
  if (function_exists('acf_register_block_type')) {

    // register a testimonial block.
    acf_register_block_type(array(
      'name'              => 'about',
      'title'             => __('About us'),
      'description'       => __('About us block.'),
      'render_template'   => 'template-parts/blocks/about-us.php',
      'category'          => 'formatting',
      'icon'              => 'welcome-widgets-menus',
      'keywords'          => array('about us'),
    ));
  }
}

if (function_exists('acf_add_options_page')) {

  acf_add_options_page();
}
