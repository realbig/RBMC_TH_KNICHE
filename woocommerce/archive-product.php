<?php
/**
 * The theme's archive file for generic display of post archives.
 *
 * @since   1.0.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

kidniche_page_start();

// Modify button
add_filter( 'woocommerce_loop_add_to_cart_link', function () {

	global $product;

	return sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button tiny expand %s product_type_%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $product->product_type ),
		esc_html( $product->add_to_cart_text() )
	);
});
?>
	<div class="page-content columns small-12 medium-9">
		<?php

		kidniche_page_title( __( 'Shop', 'KidNiche' ) );

        global $current_user;
        $user_role = $current_user->roles[0];

		$shop_page_ID = get_option( 'woocommerce_shop_page_id' );
		if ( ( $shop_form_ID = get_post_meta( $shop_page_ID, '_kidniche_shop_form', true ) ) && $user_update_form_ID = get_post_meta( $shop_page_ID, '_kidniche_user_update_form', true ) ) :

            if ( $user_role !== 'customer_wholesale' ) {

			?>

			<div data-alert class="alert-box">
				Sign up for wholesale! <a href="#" data-reveal-id="wholesale-form" class="normal-color">Signup Now</a>
				<a href="#" class="close">&times;</a>
			</div>

            <?php

            }

            ?>

			<div id="wholesale-form" class="reveal-modal" data-reveal aria-labelledby="wholesale-form-title" aria-hidden="true" role="dialog">

                <h2 id="wholesale-form-title">Wholesale Signup</h2>

                <div id="wholesale-top-banner">
                    <h3>Free Shipping & Handling on $50 Orders — Mix & Match</h3>
                </div>

				<?php
				if ( function_exists( 'gravity_form' ) ) {
                    if ( ! is_user_logged_in() ) { // Show Regular Wholesale Signup Form
                        gravity_form(
                            $shop_form_ID,
                            $display_title = false,
                            $display_description = false,
                            $display_inactive = false,
                            $field_values = null,
                            $ajax = true
                        );
                    }
                    else {
                        gravity_form( // Show Form for so they can Update Their User Account
                            $user_update_form_ID,
                            $display_title = false,
                            $display_description = false,
                            $display_inactive = false,
                            $field_values = null,
                            $ajax = true
                        );
                    }
				}
				?>

                <div id="wholesale-bottom-banner">
                    <h3>Questions? Call Susan at <a href="tel:12313607318">231-360-7318</a> or Keith at <a href="tel:12313607320">231-360-7320</a></h3>
                </div>

				<a class="close-reveal-modal" aria-label="Close">&#215;</a>
			</div>

		<?php
		endif;

		if ( have_posts() ) {

			/**
			 * woocommerce_before_shop_loop hook
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
			 * woocommerce_after_shop_loop hook
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );

		} elseif (
		! woocommerce_product_subcategories(
			array(
				'before' => woocommerce_product_loop_start( false ),
				'after'  => woocommerce_product_loop_end( false )
			)
		)
		) {
			wc_get_template( 'loop/no-products-found.php' );
		}
		?>

	</div> <!-- .page-content -->

<?php

get_sidebar( 'shop' );

kidniche_page_end();

get_footer();
