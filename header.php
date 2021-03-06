<?php
/**
 * The theme's header file that appears on EVERY page.
 *
 * @since   1.0.0
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

    <meta name="msvalidate.01" content="BC0CA43152825FE3AF36AECF5EC2E1D0" />
    <meta name="google-site-verification" content="XD-sLL0wtQneZCDoVZKeN14rXMjTJjTpo0F5_169psY" />

	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/vendor/js/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

	<header id="site-header">

		<?php global $post; ?>

		<section class="top-header hide-for-small-only">

			<div class="row collapse">

				<div class="user-menu columns small-12 medium-6">
					<?php if ( ! is_user_logged_in() ) : ?>
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

				<nav class="top-nav columns small-12 medium-6">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'top_nav',
						'container'      => false,
					) );
					?>
				</nav>

				<div class="cart">
					<p class="cart-link">
						<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>">
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

		<section class="primary-nav show-for-medium-up">
			<div class="row">

				<a href="<?php bloginfo( 'url' ); ?>">
					<img class="site-logo"
					     src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-header.png"/>
				</a>

				<nav id="site-nav" class="columns small-12">
					<?php ob_start(); ?>
					<li class="menu-item">
						<a href="<?php bloginfo( 'url' ); ?>">
							<span class="icon-home"></span>
						</a>
					</li>
					<?php
					$home_item = ob_get_clean();

					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false,
						'items_wrap'     => '<ul id="%1$s" class="%2$s">' . $home_item . '%3$s</ul>',
					) );
					?>
				</nav>
			</div>
		</section>

		<section class="mobile-header show-for-small-only row">

			<a href="<?php bloginfo( 'url' ); ?>">
				<img class="site-logo"
				     src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-header.png"/>
			</a>

			<nav id="mobile-nav" class="columns small-12 medium-6 push-6">

				<a href="#" class="menu-toggle">
					<span class="icon-menu"></span>
				</a>

				<ul class="menu">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false,
						'items_wrap'     => '%3$s',
					) );

					wp_nav_menu( array(
						'theme_location' => 'top_nav',
						'container'      => false,
						'items_wrap'     => '%3$s',
					) );
					?>
				</ul>
			</nav>

		</section>

		<?php
		if ( is_front_page() ) :

			$background                = get_post_meta( get_the_ID(), '_kidniche_home_featured_background', true );
			$background_preview = $background ? wp_get_attachment_image_src( $background, 'full' ) : '';

			$mobile_background         = get_post_meta( get_the_ID(), '_kidniche_home_featured_background_mobile', true );
			$mobile_background_preview = $mobile_background ? wp_get_attachment_image_src( $mobile_background, 'full' ) : '';
			?>

			<section class="feature">
				<div class="row collapse"
					<?php echo $background ? "style=\"background-image: url('$background_preview[0]');\"" : ''; ?>>

					<?php if ( $mobile_background ) : ?>
						<div class="mobile-background hide-for-medium-up"
							<?php echo $mobile_background ? "style=\"background-image: url('$mobile_background_preview[0]');\"" : ''; ?>></div>
					<?php endif; ?>

					<?php if ( $image = get_post_meta( get_the_ID(), '_kidniche_home_featured_image', true ) ) : ?>
						<div class="feature-left columns small-12 medium-6">
							<?php
							if ( $link = get_post_meta( get_the_ID(), '_kidniche_home_featured_image_link', true ) ) {
								echo "<a href=\"$link\">";
							}
							?>
							<?php echo wp_get_attachment_image( $image, 'full' ); ?>
							<?php echo $link ? '</a>' : ''; ?>
						</div>
					<?php endif; ?>

					<div class="feature-right columns small-12 medium-6" data-vertical-align="middle">
						<div class="container">
							<?php
							if ( $blurb = get_post_meta( get_option( 'page_on_front' ), '_kidniche_home_featured_blurb', true ) ) {
								echo wpautop( do_shortcode( $blurb ) );
							}
							?>
						</div>
					</div>
				</div>
			</section>

		<?php endif; ?>

	</header>
