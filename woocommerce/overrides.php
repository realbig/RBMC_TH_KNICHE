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
add_action( 'woocommerce_after_shop_loop_item_title', '_kniche_product_subtitle' );
add_action( 'woocommerce_after_shop_loop_item_title', '_kniche_product_subtitle' );
add_filter('loop_shop_columns', '_kniche_loop_columns');

function _kniche_modify_cart_success_link() {
	return get_permalink( wc_get_page_id( 'shop' ) );
}

function _kniche_product_subtitle() {

	//	global $post;

	if ( $field = get_field( 'sub_title' ) ) : ?>
		<p class="product-subtitle">
			<?php echo $field; ?>
		</p>
	<?php endif;
}

function _kniche_loop_columns() {
	return 3; // 3 products per row
}