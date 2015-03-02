<?php
/**
 * The theme's header file that appears on EVERY page.
 *
 * @since   0.1.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/vendor/js/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

	<header id="site-header">

		<section class="top-header">

			<div class="row">

				<nav class="top-nav columns small-12 medium-6">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'top_nav',
						'container'      => false,
					) );
					?>
				</nav>

				<div class="user-menu columns small-12 medium-6">
					<?php if ( is_user_logged_in() ) : ?>
						<p>
							<?php
							printf(
								__( 'Welcome! %sLog In%s or %sCreate an Account%s', 'KidNiche' ),
								'<a href="' . wp_login_url( get_permalink() ) . '">',
								'</a>',
								'<a href="' . wp_registration_url() . '">',
								'</a>'
							);
							?>
						</p>
					<?php endif; ?>
				</div>

			</div>

		</section>

		<section class="bottom-header row">

			<img class="site-logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-header.png" />

			<nav id="site-nav" class="columns small-12 medium-6 push-6">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
				) );
				?>
			</nav>

		</section>

	</header>