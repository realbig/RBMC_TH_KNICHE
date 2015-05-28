<?php
/**
 * Shows a single product within a loop.
 *
 * @since   1.0.0
 * @package KidNiche
 *
 * @global WP_Query $wp_query
 * @global int $post_count
 * @global int $max_columns
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$post_count = $post_count ? $post_count : $wp_query->post_count;

$columns = 12 / min( $max_columns ? $max_columns : $post_count, $post_count );
?>
<li class="columns small-12 medium-<?php echo $columns; ?>" <?php echo is_front_page() ? 'data-equalizer-watch' : ''; ?>>

	<div class="container">
		<div class="product-image">
			<?php the_post_thumbnail( 'thumbnail' ); ?>
		</div>

		<div class="product-content">
			<h4 class="product-title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h4>

			<p>
				<?php echo custom_excerpt_length(); ?>
			</p>

			<div class="product-buy">
				<?php wc_get_template( 'loop/add-to-cart.php' ); ?>
				<?php wc_get_template( 'loop/price.php' ); ?>
			</div>
		</div>
	</div>
</li>