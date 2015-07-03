<?php
/**
 * The theme's single-product file for showing a product page.
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

// Remove some actions
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
?>
	<div class="page-content columns small-12 medium-9">


		<?php
		if ( $field = get_field( 'sub_title' ) ) {

			$subtitle = '<p class="product-subtitle">';
			$subtitle .= $field;
			$subtitle .= '</p>';

			kidniche_page_title( get_the_title() . $subtitle );
		} else {
			kidniche_page_title();
		}
		?>

		<?php wc_get_template_part( 'content', 'single-product' ); ?>

	</div> <!-- .page-content -->

<?php

get_sidebar( 'shop' );

kidniche_page_end();

get_footer();