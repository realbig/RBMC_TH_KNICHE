<?php
/**
 * The theme's front-page file use for displaying the home page.
 *
 * @since   0.1.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

// TODO gap under header
?>

	<section id="home-content" class="row">

		<div class="home-feature columns small-12">

			<div class="row">

				<div class="home-feature-left columns small-12 medium-6">
					<?php // FIXME make admin accessible ?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/temp-home.png"/>
				</div>

				<div class="home-feature-right columns small-12 medium-6">

					<div class="container">
						<p class="home-feature-statement">
							Teach your children the skill with eternal benefits.
						</p>

						<a href="#" class="button secondary expand">Buy Here</a>
					</div>

				</div>

			</div>

		</div>

		<div class="home-welcome columns small-12">
			<h2>Welcome to Kid Niche</h2>

			<p class="home-welcome-blurb">
				Offering a wide selection of Christian books for children and teens.
			</p>
		</div>

	</section>

<?php
page_start();

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
	<section class="home-featured-products">
		<h3>Featured Books</h3>
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

							<?php echo custom_excerpt_length(); ?>

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
	</section>
<?php
}
?>

	<div class="row">

		<div class="home-about-author columns small-12 medium-9">

			<div class="row">
				<div class="home-author-meta columns small-12 medium-3">
					<div class="home-author-image">

					</div>

					<div class="home-author-social">

					</div>
				</div>

				<div class="home-author-info collumns small-12 medium-9">
					<h3>About the author</h3>

					<h4>Susan case Bonner</h4>
					<p>
						Among many other fine qualities, my royal friend Tranquo, being gifted with a devout love for all matters of barbaric vertu, had brought together in Pupella whatever rare things the more ingenious of his people could invent; chiefly carved woods of
					</p>
				</div>
			</div>

		</div>

		<?php get_sidebar(); ?>

	</div>

<?php
page_end();

get_footer();