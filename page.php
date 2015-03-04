<?php
/**
 * The theme's page file use for displaying pages.
 *
 * @since 0.1.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();

page_start();
?>

	<div class="row">
		<div class="page-content columns small-12 medium-9">
			<h1 class="page-title">
				<?php the_title(); ?>
			</h1>

			<?php the_content(); ?>
		</div>

		<?php get_sidebar(); ?>
</div>
<?php
page_end();

get_footer();