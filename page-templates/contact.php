<?php
/**
 * Template Name: Contact
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
?>

	<div class="page-content columns small-12 medium-9">
		<div class="row collapse">

			<?php kidniche_page_title(); ?>

			<div class="columns small-12 medium-6">
				<?php the_content(); ?>
			</div>

			<div class="columns small-12 medium-6">
				<?php
				if ( function_exists( 'gravity_form' ) && $form_ID = get_post_meta( get_the_ID(), '_kidniche_contact_form', true ) ) {
					gravity_form(
						$form_ID,
						$display_title = false,
						$display_description = false,
						$display_inactive = false,
						$field_values = null,
						$ajax = false
					);
				}
				?>
			</div>

		</div>
	</div>

<?php
get_sidebar();

kidniche_page_end();

get_footer();