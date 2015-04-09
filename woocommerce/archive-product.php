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

the_post();

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

		kidniche_page_title( __( 'Blog', 'KidNiche' ) );

		do_action( 'woocommerce_archive_description' );

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

get_sidebar();

kidniche_page_end();

get_footer();