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

if ( have_posts() ) :
	?>
	<div class="page-content columns small-12 medium-9">
		<div class="post-list">
			<?php
			while ( have_posts() ) :
				the_post();

				$linked_post = get_post( get_post_meta( get_the_ID(), '_product_link', true ) );
				if ( $linked_post === null ) {
					continue;
				}
				?>
				<div id="book-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="post-title">
						<?php the_title(); ?>
					</h2>

					<a href="<?php the_permalink(); ?>" class="button">
						View Book
					</a>
				</div>
			<?php
			endwhile;
			?>
		</div>
	</div>
<?php
endif;

get_sidebar();

kidniche_page_end();

get_footer();