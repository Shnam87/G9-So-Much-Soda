<?php
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo');

// Que in scripts 
add_action('wp_enqueue_scripts', 'somuchsoda_enqueue');

function somuchsoda_enqueue() {
  wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'somuchsoda_enqueue');

wp_enqueue_script( 
  'wpb_togglemenu', 
  get_template_directory_uri() . '/js/navigation.js', 
  array('jquery'), '20160909', true 
);


//Change a currency symbol
function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'SEK': $currency_symbol = 'SEK'; break;
     }
     return $currency_symbol;
}
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);



// 1. Show plus minus buttons
add_action( 'woocommerce_after_quantity_input_field', 'bbloomer_display_quantity_plus' ); 
function bbloomer_display_quantity_plus() {
   echo '<button type="button" class="plus">+</button>';
}

add_action( 'woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_minus' );
function bbloomer_display_quantity_minus() {
   echo '<button type="button" class="minus">-</button>';
}
  
// 2. Trigger update quantity script
  
add_action( 'wp_footer', 'add_cart_quantity_plus_minus' );
  
function add_cart_quantity_plus_minus() {
   if ( ! is_product() && ! is_cart() ) return;
   wc_enqueue_js( "   
           
      $(document).on( 'click', 'button.plus, button.minus', function() {
  
         var qty = $( this ).parent( '.quantity' ).find( '.qty' );
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr( 'max' ));
         var min = parseFloat(qty.attr( 'min' ));
         var step = parseFloat(qty.attr( 'step' ));
 
         if ( $( this ).is( '.plus' ) ) {
            if ( max && ( max <= val ) ) {
               qty.val( max ).change();
            } else {
               qty.val( val + step ).change();
            }
         } else {
            if ( min && ( min >= val ) ) {
               qty.val( min ).change();
            } else if ( val > 1 ) {
               qty.val( val - step ).change();
            }
         }
      });    
   " );
}

/** Remove product data tabs */
add_filter( 'woocommerce_product_tabs', 'my_remove_product_tabs', 98 );
function my_remove_product_tabs( $tabs ) {
  unset( $tabs['additional_information'] ); // To remove the additional information tab
  return $tabs;
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

function wpa89819_wc_single_product(){
   $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
   if ( $product_cats && ! is_wp_error ( $product_cats ) ){
       $single_cat = array_shift( $product_cats ); ?>
       <h2 itemprop="name" class="product_category_title"><span><?php echo $single_cat->name; ?></span></h2>
<?php }
}
add_action( 'woocommerce_single_product_summary', 'wpa89819_wc_single_product', 2 );


/** Update Variable Product Price With Current Variation Price */
add_action( 'woocommerce_variable_add_to_cart', 'bbloomer_update_price_with_variation_price' );
  
function bbloomer_update_price_with_variation_price() {
   global $product;
   $price = $product->get_price_html();
   wc_enqueue_js( "      
      $(document).on('found_variation', 'form.cart', function( event, variation ) {   
         if(variation.price_html) $('.summary > p.price').html(variation.price_html);
         $('.woocommerce-variation-price').hide();
      });
      $(document).on('hide_variation', 'form.cart', function( event, variation ) {   
         $('.summary > p.price').html('" . $price . "');
      });
   " );
}

// Remove "Select options" button from (variable) products on the main WooCommerce shop page.
add_filter( 'woocommerce_loop_add_to_cart_link', function( $product ) {
	global $product;
	if ( is_shop() && 'variable' === $product->product_type ) {
		return '';
	} else {
		sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			esc_html( $product->add_to_cart_text() )
		);
	}
} );


function tutsplus_excerpt_in_product_archives() {
   echo wp_trim_words( get_the_excerpt(), 10 );
}
add_action( 'woocommerce_after_shop_loop_item_title', 'tutsplus_excerpt_in_product_archives', 40 );

add_action('woocommerce_before_single_product', 'add_breadcrumb', 20);
function add_breadcrumb(){
   woocommerce_breadcrumb();
};
 

add_action('woocommerce_after_shop_loop', 'add_text', 20);
function add_text(){
     get_template_part( 'template-parts/news' ); 
     get_template_part( 'template-parts/blocks/hero' );  
};


// Theme support Woo
function add_woocommerce_support(){
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'add_woocommerce_support');

/* =============================== */
/* Mimmi */
/* =============================== */

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


/* =============================== */
/* Shahram */
/* =============================== */
if (!function_exists('somuchsoda_theme_register_nav_menu')) {

  function somuchsoda_theme_register_nav_menu()
  {
    register_nav_menus(array(
      'primary_menu' => __('Primary Menu', 'text_domain'),
      'right_footer_menu'  => __('Right Footer Menu', 'text_domain'),
      'left_footer_menu'  => __('Left Footer Menu', 'text_domain'),
      'header-menu' => __('Header Menu'),
    ));
  }
  add_action('after_setup_theme', 'somuchsoda_theme_register_nav_menu', 0);
}

//Header nav menu.
// function wpb_custom_new_menu(){
//     register_nav_menu('header-menu', __('Header Menu'));
//  }
//  add_action('init', 'wpb_custom_new_menu');


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

function woocommerce_button_proceed_to_checkout() { ?>
    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward">
    <?php esc_html_e( 'CHECKOUT', 'woocommerce' ); ?>
    </a>
    <?php
}
