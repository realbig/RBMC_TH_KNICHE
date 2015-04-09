<?php
/**
 * The theme's front-page file use for displaying the home page.
 *
 * @since   1.0.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();
?>

	<div class="home-welcome row">
		<div class="columns small-12">
			<h2>
				<?php
				echo get_post_meta( get_the_ID(), '_kidniche_home_welcome_blurb_title', true );
				?>
			</h2>

			<p class="home-welcome-blurb">
				<?php
				echo get_post_meta( get_the_ID(), '_kidniche_home_welcome_blurb', true );
				?>
			</p>
		</div>
	</div>

<?php
$featured_products = get_posts( array(
	'post_type'      => 'product',
	'meta_key'       => '_featured',
	'meta_value'     => 'yes',
	'posts_per_page' => 3,
) );

if ( ! empty( $featured_products ) ) {
	global $post;

	add_filter( 'woocommerce_loop_add_to_cart_link', function () {

		global $product;

		return sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s">%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( $product->id ),
			esc_attr( $product->get_sku() ),
			esc_attr( isset( $quantity ) ? $quantity : 1 ),
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
			esc_attr( $product->product_type ),
			'<span class="icon-cart"></span>'
		);
	} );
	?>
	<section class="home-featured-products row">
		<div class="columns small-12">
			<h3 class="section-title">Featured Books</h3>
			<ul class="products row">
				<?php
				foreach ( $featured_products as $post ) {
					setup_postdata( $post );
					?>
					<li class="columns small-12 medium-4">

						<div class="container">
							<div class="product-image">
								<?php the_post_thumbnail( 'thumbnail' ); ?>
							</div>

							<div class="product-content">
								<h4 class="product-title">
									<?php the_title(); ?>
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
				<?php
				}
				wp_reset_postdata();
				?>
			</ul>
		</div>
	</section>
<?php
}

kidniche_page_start();
?>

	<div class="page-content columns small-12 medium-9">

		<div class="home-about-author row">
			<div class="home-author-meta columns small-12 medium-3">
				<div class="home-author-image">
					<?php
					echo wp_get_attachment_image(
						get_post_meta( get_the_ID(), '_kidniche_home_author_image', true )
					);
					?>
				</div>

				<div class="home-author-social">
					<?php echo do_shortcode( get_post_meta( get_the_id(), '_kidniche_home_author_social', true ) ); ?>
				</div>
			</div>

			<div class="home-author-info columns small-12 medium-9">
				<h3 class="home-author-title">About the author</h3>

				<h4 class="home-author-name">Susan case Bonner</h4>

				<div class="home-author-content">
					<?php
					echo apply_filters(
						'the_content',
						get_post_meta( get_the_ID(), '_kidniche_home_about_the_author', true )
					);
					?>
				</div>
			</div>
		</div>


		<?php
		$blog_post_count = get_post_meta( get_the_ID(), '_kidniche_home_blog_post_count', true );
		$posts           = get_posts( array(
			'numberposts' => $blog_post_count ? $blog_post_count : 3,
		) );

		if ( ! empty( $posts ) ) {
			global $post;
			?>
			<div class="home-blog columns small-12">

				<h3 class="section-title">From the Blog</h3>

				<div class="post-list">
					<?php
					foreach ( $posts as $post ) {
						setup_postdata( $post );
						kidniche_post_loop_content();
					}
					wp_reset_postdata();
					?>
				</div>

			</div>
		<?php
		}
		?>

	</div>

<?php get_sidebar(); ?>

<?php
kidniche_page_end();

get_footer();