<?php
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo');


// Que in scripts 
add_action('wp_enqueue_scripts', 'somuchsoda_enqueue');

function somuchsoda_enqueue()
{
  wp_enqueue_style('style', get_stylesheet_uri());
}

// Theme support Woo
function add_woocommerce_support(){
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'add_woocommerce_support');

// ACF block registration 
add_action('acf/init', 'my_acf_blocks_init');
// CTA Block / Heading & Subheading Block
function my_acf_blocks_init() {
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'cta',
            'title'             => __('CTA'),
            'description'       => __('A custom cta block.'),
            'render_template'   => 'template-parts/blocks/cta.php',
            'category'          => 'formatting',
            'icon'              => 'microphone',
            'keywords'          => array('cta'),
        ));
    }
    // Featured Product Block
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'featured product',
            'title'             => __('Featured Product'),
            'description'       => __('A custom featured product block.'),
            'render_template'   => 'template-parts/blocks/featured-prod.php',
            'category'          => 'formatting',
            'icon'              => 'admin-customizer',
            'keywords'          => array('featured products', 'featured product', 'featured'),
        ));
    }
    // Text/Image & Image/Text Block
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'text image',
            'title'             => __('Text/Image'),
            'description'       => __('A custom text/image block.'),
            'render_template'   => 'template-parts/blocks/text-image.php',
            'category'          => 'formatting',
            'icon'              => 'align-pull-right',
            'keywords'          => array('text/image', 'text', 'image', 'media', 'split'),
        ));
    }
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'image text',
            'title'             => __('Image/Text'),
            'description'       => __('A custom image/text block.'),
            'render_template'   => 'template-parts/blocks/image-text.php',
            'category'          => 'formatting',
            'icon'              => 'align-pull-left',
            'keywords'          => array('image/text', 'text', 'image', 'media', 'split'),
        ));
    }
    // Store Block
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'stores',
            'title'             => __('Stores'),
            'description'       => __('A custom store block.'),
            'render_template'   => 'template-parts/blocks/stores.php',
            'category'          => 'formatting',
            'icon'              => 'store',
            'keywords'          => array('store', 'shop', 'location'),
        ));
    }
    // Category / Taxonomy Block
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'categories',
            'title'             => __('Categories'),
            'description'       => __('A custom category block.'),
            'render_template'   => 'template-parts/blocks/categories.php',
            'category'          => 'formatting',
            'icon'              => 'category',
            'keywords'          => array('category', 'categories', 'taxonomy', 'taxonomies'),
        ));
    }
}


// Get product id
function iconic_get_product_id_by_sku($sku = false){

    global $wpdb;

    if(!$sku)
        return null;

    $product_id = $wpdb->get_var(
      $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1",
        $sku)
    );

    if ($product_id)
        return $product_id;

    return null;

}






// Register post type for 'Stores'
function custom_post_type() {
	$labels = array(
		'name'                  => _x( 'Stores', 'Post Type General Name', 'so_much_soda' ),
		'singular_name'         => _x( 'Store', 'Post Type Singular Name', 'so_much_soda' ),
		'menu_name'             => __( 'Stores', 'so_much_soda' ),
		'name_admin_bar'        => __( 'Stores', 'so_much_soda' ),
	);
	$args = array(
		'label'                 => __( 'Store', 'so_much_soda' ),
		'description'           => __( 'Post Type Description', 'so_much_soda' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		// 'menu_position'         => 20,
		'menu_icon'             => 'dashicons-store',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'stores', $args );

}
add_action( 'init', 'custom_post_type', 0 );

// Hooking up function to theme setup
add_action('init', 'create_posttype');

// CATEGORIES
// $args = array(
//     'taxonomy' => 'product_cat',
//     'orderby' => 'name', 
//     'order' => 'DESC',
//     'hide_empty' => false
// );
// foreach( get_categories($args) as $category):
//     // Display category data here
//     the_title();
// endforeach;



// function get_categories(){

//   $taxonomy     = 'product_cat';
//   $orderby      = 'name';  
//   $show_count   = 0;      // 1 for yes, 0 for no
//   $pad_counts   = 0;      // 1 for yes, 0 for no
//   $hierarchical = 1;      // 1 for yes, 0 for no  
//   $title        = '';  
//   $empty        = 0;

//   $args = array(
//          'taxonomy'     => $taxonomy,
//          'orderby'      => $orderby,
//          'show_count'   => $show_count,
//          'pad_counts'   => $pad_counts,
//          'hierarchical' => $hierarchical,
//          'title_li'     => $title,
//          'hide_empty'   => $empty
//   );
//  $all_categories = get_categories( $args );
//  foreach ($all_categories as $cat) {
//     if($cat->category_parent == 0) {
//         $category_id = $cat->term_id;       
//         echo '<br /><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';

//         $args2 = array(
//                 'taxonomy'     => $taxonomy,
//                 'child_of'     => 0,
//                 'parent'       => $category_id,
//                 'orderby'      => $orderby,
//                 'show_count'   => $show_count,
//                 'pad_counts'   => $pad_counts,
//                 'hierarchical' => $hierarchical,
//                 'title_li'     => $title,
//                 'hide_empty'   => $empty
//         );
//         $sub_cats = get_categories( $args2 );
//         if($sub_cats) {
//             foreach($sub_cats as $sub_category) {
//                 echo  $sub_category->name ;
//             }   
//         }
//     }       
// }


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
