<?php
/**
 * The theme's single file use for books.
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

$snippet = get_post_meta( get_the_ID(), '_snippet', true );
$snippet = $snippet ? wpautop( do_shortcode( $snippet ) ) : false;

$product_link = get_post_meta( get_the_ID(), '_product_link', true );
$product_link = $product_link ? get_permalink( $product_link ) : false;

if ( $snippet ) : ?>

	<section class="book-snippet">
		<div class="row">
			<div class="container">

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="book-image columns small-12 medium-6 text-center">
						<?php the_post_thumbnail( 'full' ); ?>
					</div>
				<?php endif; ?>

				<div class="book-copy columns small-12 medium-6">
					<?php echo $snippet; ?>

					<?php if ( $product_link ) : ?>
						<p class="text-center">
							<a href="<?php echo $product_link; ?>" class="button large secondary">
								Order Now
							</a>
						</p>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</section>

<?php endif; ?>

	<section id="site-content" class="row">

		<div class="page-content columns small-12 medium-9">

			<h1><?php the_title(); ?></h1>

			<?php if ( $field = get_field( 'sub_title' ) ) : ?>
				<p class="product-subtitle">
					<?php echo $field; ?>
				</p>
			<?php endif; ?>

			<?php the_content(); ?>

			<?php if ( $product_link ) : ?>
				<a href="<?php echo $product_link; ?>" class="button large expand">
					Purchase Now!
				</a>
			<?php endif; ?>

			<?php
			$author_ID = get_the_author_meta( 'ID' );
			include __DIR__ . '/partials/about-the-author.php';
			?>

		</div>

		<?php get_sidebar( 'book' ); ?>

	</section>

<?php
get_footer();