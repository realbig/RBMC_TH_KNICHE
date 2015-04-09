<?php
/**
 * Shows a single product within a loop.
 *
 * @since   1.0.0
 * @package KidNiche
 *
 * @global $wp_query
 * @global $post_count
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$post_count = $post_count ? $post_count : $wp_query->post_count;

$columns = 12 / $post_count;
$columns = $columns < 3 ? $columns == 3 : $columns;

?>
<li class="columns small-12 medium-<?php echo $columns; ?>">

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