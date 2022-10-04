<?php 

// Que in scripts (worked without but just in case)
add_action('wp_enqueue_scripts', 'somuchsoda_enqueue');

function somuchsoda_enqueue(){
  wp_enqueue_style('style', get_stylesheet_uri());
}




function add_woocommerce_support(){

  add_theme_support('woocommerce');

}

add_action('after_setup_theme', 'add_woocommerce_support');



//Header nav menu.
function wpb_custom_new_menu()
{
    register_nav_menu('header-menu', __('Header Menu'));
}
add_action('init', 'wpb_custom_new_menu');



	




if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}



	
wp_enqueue_script( 
  'wpb_togglemenu', 
  get_template_directory_uri() . '/js/navigation.js', 
  array('jquery'), '20160909', true 
);



/**
 * Change a currency symbol
 */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'SEK': $currency_symbol = 'SEK'; break;
     }
     return $currency_symbol;
}

// -------------
// 1. Show plus minus buttons
  
add_action( 'woocommerce_after_quantity_input_field', 'bbloomer_display_quantity_plus' );
  
function bbloomer_display_quantity_plus() {
   echo '<button type="button" class="plus">+</button>';
}
  
add_action( 'woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_minus' );
  
function bbloomer_display_quantity_minus() {
   echo '<button type="button" class="minus">-</button>';
}
  
// -------------
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



// add_filter( 'template_include', 'woocommerce_archive_template', 99 );function woocommerce_archive_template( $template ) {    if ( is_woocommerce() && is_archive() ) {        $new_template = get_stylesheet_directory() . '/woocommerce/archive-product.php';        if ( !empty( $new_template ) ) {            return $new_template;        }    }    return $template;}/*  */
