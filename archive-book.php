<?php
/**
 * The theme's archive file for books.
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

kidniche_page_title( __( 'Books', 'KidNiche' ) );

global $wp_query, $post;

if ( have_posts() ) :
	?>
	<div class="page-content columns small-12 medium-9">

		<p>Browse the books created by Susan Case Bonner.</p>

		<div class="product-loop">

			<ul class="products row <?php echo $wp_query->post_count === 1 ? 'collapse' : ''; ?>">

				<?php

				// Filter output
				add_filter( 'woocommerce_loop_add_to_cart_link', 'kniche_woocommerce_add_to_cart_link_book' );
				add_filter( 'woocommerce_price_html', '__return_false' );

				while ( have_posts() ) {

					the_post();

					$linked_post = get_post_meta( get_the_ID(), '_product_link', true );
					if ( empty( $linked_post ) ) {
						continue;
					}

					$linked_post = get_post( $linked_post );

					$post = $linked_post;
					setup_postdata( $post );

					$max_columns = 1;
					include __DIR__ . '/partials/product-loop-single.php';
				}

				// Reset settings from loop
				wp_reset_postdata();
				remove_filter( 'woocommerce_loop_add_to_cart_link', 'kniche_woocommerce_add_to_cart_link_book' );
				remove_filter( 'woocommerce_price_html', '__return_false' );
				?>

			</ul>

		</div>
	</div>
<?php
endif;

get_sidebar();

kidniche_page_end();

get_footer();

function kniche_woocommerce_add_to_cart_link_book() {

	global $wp_query;

	return '<a href="' . get_permalink( $wp_query->post->ID ) . '" class="button">View Book</a>';
}