<?php
/**
 * The theme's archive file for generic display of post archives.
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

kidniche_page_title( __( 'Blog', 'KidNiche' ) );

if ( have_posts() ) :
	?>
	<div class="page-content columns small-12 medium-9">
		<div class="post-list">
			<?php
			while ( have_posts() ) :
				the_post();
				kidniche_post_loop_content();
			endwhile;
			?>
		</div>
	</div>
<?php
endif;

get_sidebar();

kidniche_page_end();

get_footer();