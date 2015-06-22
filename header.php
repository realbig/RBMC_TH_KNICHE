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

	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/vendor/js/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

	<header id="site-header">

		<?php
		global $post;
		$show_feature = is_front_page();
		?>

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

		<section class="primary-nav show-for-medium-up row <?php echo $show_feature ? 'large' : ''; ?>">

			<a href="<?php bloginfo( 'url' ); ?>">
				<img class="site-logo <?php echo $show_feature ? 'large' : ''; ?>"
				     src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-header.png"/>
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

		<section class="mobile-header show-for-small-only row <?php echo $show_feature ? 'large' : ''; ?>">

			<a href="<?php bloginfo( 'url' ); ?>">
				<img class="site-logo <?php echo $show_feature ? 'large' : ''; ?>"
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
						'items_wrap' => '%3$s',
					) );

					wp_nav_menu( array(
						'theme_location' => 'top_nav',
						'container'      => false,
						'items_wrap' => '%3$s',
					) );
					?>
				</ul>
			</nav>

		</section>

		<?php
		if ( $show_feature ) :

			$background = get_post_meta( get_option( 'page_on_front' ), '_kidniche_home_featured_background', true );
			$background_preview = $background ? wp_get_attachment_image_src( $background, 'full' ) : '';
		?>

			<section class="feature row"
				<?php echo $background ? "style=\"background-image: url('$background_preview[0]');\"" : ''; ?>>

				<div class="columns small-12">

					<div class="row">

						<div class="feature-left columns small-12 medium-6">
							<?php
							if ( $image = get_post_meta( get_option( 'page_on_front' ), '_kidniche_home_featured_image', true ) ) {
								echo wp_get_attachment_image( $image, 'full' );
							}
							?>
						</div>

						<div class="feature-right columns small-12 medium-6">

							<div class="container">
								<?php
								if ( $blurb = get_post_meta( get_option( 'page_on_front' ), '_kidniche_home_featured_blurb', true ) ) {
									echo wpautop( do_shortcode( $blurb ) );
								}
								?>
							</div>

						</div>

					</div>

				</div>

			</section>

		<?php endif; ?>

	</header>