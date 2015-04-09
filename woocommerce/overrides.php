<?php
/**
 * Overrides and filters for WooCommerce.
 *
 * @since   1.0.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_filter( 'woocommerce_continue_shopping_redirect', '_kniche_modify_cart_success_link' );

function _kniche_modify_cart_success_link() {
	return get_permalink( wc_get_page_id( 'shop' ) );
}