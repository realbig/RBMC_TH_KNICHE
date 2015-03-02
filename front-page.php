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

<?php page_start(); ?>

<?php
page_end();

get_footer();