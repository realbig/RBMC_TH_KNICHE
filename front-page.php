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

	add_filter( 'woocommerce_loop_add_to_cart_link', 'kniche_woocommerce_add_to_cart_link_icon' );
	?>
	<section class="home-featured-products row">
		<div class="columns small-12">
			<h3 class="section-title">Featured Books</h3>
			<ul class="product-loop row">
				<?php
					global $post_count;
				foreach ( $featured_products as $post ) {
					setup_postdata( $post );
					$post_count = count( $featured_products );
					include __DIR__ . '/partials/product-loop-single.php';
				}
				wp_reset_postdata();
				?>
			</ul>
		</div>
	</section>
<?php
	remove_filter( 'woocommerce_loop_add_to_cart_link', 'kniche_woocommerce_add_to_cart_link_icon' );
}

kidniche_page_start();
?>

	<div class="page-content columns small-12 medium-9">

		<?php
		$author_ID = get_post_meta( get_the_ID(), '_kidniche_home_author_user_id', true );
		include __DIR__ . '/partials/about-the-author.php';

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