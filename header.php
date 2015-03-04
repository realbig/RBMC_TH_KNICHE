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

global $woocommerce;
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

				<div class="cart">
					<p class="cart-link">
						<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>">
							<span class="icon-cart"></span>
							Cart
						</a>
					</p>

					<p class="cart-contents">
						<?php
						$cart_count = sizeof( $woocommerce->cart->cart_contents );
						echo $cart_count . _n( ' item', ' items', $cart_count );
						?>
						&nbsp;-
						<?php echo $woocommerce->cart->get_cart_total(); ?>
					</p>
				</div>

			</div>

		</section>

		<section class="primary-nav row">

			<a href="<?php bloginfo( 'url' ); ?>">
				<img class="site-logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-header.png"/>
			</a>

			<nav id="site-nav" class="columns small-12 medium-6 push-6">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
				) );
				?>
			</nav>

		</section>

		<section class="feature row">

			<div class="columns small-12">

				<div class="row">

					<div class="feature-left columns small-12 medium-6">
						<?php // FIXME make admin accessible ?>
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/temp-home.png"/>
					</div>

					<div class="feature-right columns small-12 medium-6">

						<div class="container">
							<div class="feature-statement">
								<p>
									Teach your children the skill with eternal benefits.
								</p>

								<p>
									Teach your children to pray.
								</p>
							</div>

							<a href="#" class="button secondary expand">Buy Here</a>
						</div>

					</div>

				</div>

			</div>

		</section>

	</header>