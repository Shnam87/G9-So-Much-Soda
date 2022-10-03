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
// Call to action block
function my_acf_blocks_init() {
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'cta',
            'title'             => __('CTA'),
            'description'       => __('A custom cta block.'),
            'render_template'   => 'template-parts/blocks/cta.php',
            'category'          => 'formatting',
            'icon'              => 'slides',
            'keywords'          => array('cta'),
        ));
    }
}

// Register post type for 'Stores'
function create_posttype(){
    register_post_type(
        'stores',
        array(
            'labels' => array(
                'name' => ('Stores'),
                'singular_name' => __('Store')
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'stores'),
        )
        );
}
// Hooking up function to theme setup
add_action('init', 'create_posttype');

// CATEGORIES
$args = array(
    'taxonomy' => 'product_cat',
    'orderby' => 'name', 
    'order' => 'DESC',
    'hide_empty' => false
);
foreach( get_categories($args) as $category):
    // Display category data here
    the_title();
endforeach;



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
