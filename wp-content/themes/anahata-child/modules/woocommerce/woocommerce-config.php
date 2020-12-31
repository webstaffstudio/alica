<?php
/**
 * Woocommerce configuration file
 */

// Adds theme support for woocommerce
add_theme_support( 'woocommerce' );

//Disable the default WooCommerce stylesheet.
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

if ( ! function_exists( 'anahata_mikado_woocommerce_content' ) ) {
	/**
	 * Output WooCommerce content.
	 *
	 * This function is only used in the optional 'woocommerce.php' template
	 * which people can add to their themes to add basic woocommerce support
	 * without hooks or modifying core templates.
	 *
	 * @access public
	 * @return void
	 */
	function anahata_mikado_woocommerce_content() {
		
		if ( is_singular( 'product' ) ) {
			
			while ( have_posts() ) : the_post();
				
				wc_get_template_part( 'content', 'single-product' );
			
			endwhile;
			
		} else {
			
			if ( have_posts() ) :
				
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				
				woocommerce_product_loop_start();
				
				woocommerce_product_subcategories();
				
				while ( have_posts() ) : the_post();
					
					wc_get_template_part( 'content', 'product' );
				
				endwhile; // end of the loop.
				
				woocommerce_product_loop_end();
				
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			
			elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) :
				
				wc_get_template( 'loop/no-products-found.php' );
			
			endif;
		}
	}
}

//Define number of products per page
add_filter( 'loop_shop_per_page', 'anahata_mikado_woocommerce_products_per_page', 20 );

//Set number of related products
add_filter( 'woocommerce_output_related_products_args', 'anahata_mikado_woocommerce_related_products_args' );

//Overide Product List Loop Title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'anahata_mikado_woocommerce_template_loop_product_title', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

//Override Product List Loop Add To Cart
add_filter( 'woocommerce_loop_add_to_cart_link', 'anahata_mikado_woocommerce_loop_add_to_cart_link' );

//remove default link around whole product content in loop
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

//Single Product Title template override
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'anahata_mikado_woocommerce_template_single_title', 5 );

//Single product add social share)
add_action( 'woocommerce_share', 'anahata_mikado_woocommerce_share', 70 );

//Sale flash template override
add_filter( 'woocommerce_sale_flash', 'anahata_mikado_woocommerce_sale_flash' );

//Override Checkout Fields
add_filter( 'woocommerce_checkout_fields', 'anahata_mikado_custom_override_checkout_fields' );

//Set Woocommerce button style
//Simple and grouped products
add_action( 'anahata_mikado_woocommerce_add_to_cart_button', 'anahata_mikado_get_woocommerce_add_to_cart_button' );

//External product
add_action( 'anahata_mikado_woocommerce_add_to_cart_button_external', 'anahata_mikado_get_woocommerce_add_to_cart_button_external' );

//Variable product
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
add_action( 'woocommerce_single_variation', 'anahata_mikado_woocommerce_single_variation_add_to_cart_button', 20 );

//Apply Coupon Button
add_action( 'anahata_mikado_woocommerce_apply_coupon_button', 'anahata_mikado_get_woocommerce_apply_coupon_button' );

//Update Cart
add_action( 'anahata_mikado_woocommerce_update_cart_button', 'anahata_mikado_get_woocommerce_update_cart_button' );

//Proceed To Checkout Button
remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
add_action( 'woocommerce_proceed_to_checkout', 'anahata_mikado_woocommerce_button_proceed_to_checkout', 20 );

//Update Totals Button, Shipping Calculator
add_action( 'anahata_mikado_woocommerce_update_totals_button', 'anahata_mikado_get_woocommerce_update_totals_button' );

//Pay For Order Button, Checkout page
add_filter( 'woocommerce_pay_order_button_html', 'anahata_mikado_woocommerce_pay_order_button_html' );

//Replace default navigation on shop list
add_filter( 'woocommerce_pagination_args', 'anahata_mikado_alter_woo_pagination' );

//Place Order Button, Checkout page
add_filter( 'woocommerce_order_button_html', 'anahata_mikado_woocommerce_order_button_html' );

//Add Category on Cart
add_filter( 'woocommerce_cart_item_name', 'anahata_mikado_woocommerce_cart_categories', 10, 3 );

//add hover image in product loop
add_action( 'woocommerce_before_shop_loop_item_title', 'anahata_mikado_product_hover_image' );

//Override woocommerce in stock html
add_filter( 'woocommerce_get_stock_html', 'anahata_mikado_woocommerce_stock_html' );

// removed action from title and added on loop item for Sale flash
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash' );
