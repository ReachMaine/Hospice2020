<?php /* woocommerce custom coding */

// remove the result count
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
// remove sorting
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
// remove woo breadcrumbs
add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// remove additional information tab
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;

}
/**
 * @snippet       Close Ship to Different Address @ Checkout Page
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.9
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );


/**
 * @snippet       Variable Product Price Range:  $$$min_price"
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=275
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.4
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
add_filter( 'woocommerce_variable_price_html', 'bbloomer_variation_price_format_min', 9999, 2 );
function bbloomer_variation_price_format_min( $price, $product ) {
   if ($product->get_id() == 18434) { // only for notecards.
     $prices = $product->get_variation_prices( true );
     $min_price = current( $prices['price'] );
     $price = sprintf( __( '%1$s', 'woocommerce' ), wc_price( $min_price ) );
   }
   return $price;
}
