<?php 

// Que in scripts 
add_action('wp_enqueue_scripts', 'somuchsoda_enqueue');

function somuchsoda_enqueue(){
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
}

//Override styles to create own class
add_filter('woocommerce_post_class', 'featured_product_class');

function featured_product_class($classes) {
    $classes[] = 'featured-prod-container';
    return $classes;
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



                    // function filter_woocommerce_post_class( $classes, $product ) {
                    //     global $woocommerce_loop;
                        
                    //     if (!is_product() ) return $classes;
                        
                    //     // The related products section, so return
                    //     if ( $woocommerce_loop['name'] == 'related' ) return $classes;
                        
                    //     // Add new class
                    //     $classes[] = 'featured-prod-container';
                        
                    //     return $classes;
                    // }
                    // add_filter( 'woocommerce_post_class', 'filter_woocommerce_post_class', 10, 2 );



// eventuellt bättre?
                    // function filter_woocommerce_post_class( $classes, $product ) {
                    //     global $woocommerce_loop;
                        
                    //     if ( is_product()) return $classes;
                        
                    //     // The related products section, so return
                    //     if ( $woocommerce_loop['name'] == 'related' ) return $classes;
                        
                    //     // Add new class
                    //     $classes[] = 'featured-prod-container';
                        
                    //     return $classes;
                    // }
                    // add_filter( 'woocommerce_post_class', 'filter_woocommerce_post_class', 10, 2 );








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
