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
add_filter( 'woocommerce_package_rates', '_kniche_user_role_shipping', 10, 2 );

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

function _kniche_user_role_shipping( $rates, $package ) {

    global $woocommerce;
    global $current_user;

    $user_role = $current_user->roles[0];

    $free_shipping = new WC_Shipping_Rate();
    $free_shipping->id = 'free_shipping';
    $free_shipping->label = 'Free Shipping';
    $free_shipping->cost = '0';
    $free_shipping->method_id = 'free_shipping';

    $wholesale_flat = new WC_Shipping_Rate();
    $wholesale_flat->id = 'wholesale_flat';
    $wholesale_flat->label = 'Wholesale Flat Rate';
    $wholesale_flat->cost = '10';
    $wholesale_flat->method_id = 'wholesale_flat';

    $usps_priority = new WC_Shipping_Rate();
    $usps_priority->id = 'usps_priority';
    $usps_priority->label = 'USPS Priority';

    $cart_total = $woocommerce->cart->subtotal_ex_tax;

    if ( $user_role == 'customer_wholesale' ) {

        if ( $cart_total >= 50 ) {

            $rates = array();
            $rates['free_shipping'] = $free_shipping;

        }
        else {

            $rates = array();
            $rates['wholesale_flat'] = $wholesale_flat;

        }

    }
    else {

        if ( $cart_total <= 12.5 ) {

            $usps_priority->cost = '3';

        }
        else if ( ( $cart_total >= 12.51 ) && ( $cart_total <= 25 ) ) {

            $usps_priority->cost = '6';

        }
        else if ( ( $cart_total >= 25.01 ) && ( $cart_total <= 50 ) ) {

            $usps_priority->cost = '9';

        }
        else if ( ( $cart_total >= 50.01 ) && ( $cart_total <= 130 ) ) {

            $usps_priority->cost = '12';

        }
        else {
            // Greater than $130

            $usps_priority->cost = '15';

        }

        $rates = array();
        $rates['usps_priority'] = $usps_priority;

    }

    return $rates;

}
