<?php
/**
 * The theme's widgets.
 *
 * @since   0.1.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class KidNicheWidget_Subscribe
 *
 * Widget for the MailChimp subscription form.
 *
 * @since 0.1.0
 */
class KidNicheWidget_Subscribe extends WP_Widget {

	public function __construct() {

		// Build the widget
		parent::__construct(
			'kidnichewidget_subscribe',
			__( 'Subscribe', 'KidNiche' ),
			array(
				'description' => __( 'Adds a subscription form to any sidebar.', 'KidNiche' ),
			)
		);
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		?>

		<!-- Begin MailChimp Signup Form -->
		<div id="mc_embed_signup">
			<form
				action="//realbigmarketing.us4.list-manage.com/subscribe/post?u=82db87321b6e03e3d7c4d9445&amp;id=c5fdffab28"
				method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
				target="_blank" novalidate>
				<div id="mc_embed_signup_scroll">

					<div class="mc-field-group">
						<label for="mce-EMAIL">Email Address</label>
						<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="email@example.com">
					</div>

					<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					<div style="position: absolute; left: -5000px;">
						<input type="text" name="b_82db87321b6e03e3d7c4d9445_c5fdffab28" tabindex="-1" value="">
					</div>

					<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe"
					       class="button expand">
				</div>
			</form>
		</div>

		<!--End mc_embed_signup-->

		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Subscribe', 'KidNiche' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>">
		</p>
	<?php
	}
}

add_action( 'widgets_init', function () {
	register_widget( 'KidNicheWidget_Subscribe' );
} );

/**
 * Class KidNicheWidget_Testimonials
 *
 * Widget for showing Testimonials.
 *
 * @since 0.1.0
 */
class KidNicheWidget_Testimonials extends WP_Widget {

	public function __construct() {

		// Build the widget
		parent::__construct(
			'kidnichewidget_testimonials',
			__( 'Testimonials', 'KidNiche' ),
			array(
				'description' => __( 'Shows a list of testimonials.', 'KidNiche' ),
			)
		);
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$count = isset( $instance['count'] ) && ! empty( $instance['count'] ) ? (int) $instance['count'] : 3;

		$testimonials = get_posts( array(
			'post_type' => 'testimonial',
			'numberposts' => $count,
		) );

		if ( ! empty( $testimonials ) ) {
			?>

			<div class="testimonials-container">

				<div class="testimonials-prev icon-circle-left" style="display: none;"></div>
				<div class="testimonials-next icon-circle-right" style="display: none;"></div>

				<ul class="testimonials" style="left: 0;">
					<?php
					global $post;
					$i = 0;
					foreach ( $testimonials as $post ) {
						setup_postdata( $post );
						$i++;

						$role = get_post_meta( get_the_ID(), '_testimonial_role', true );
						?>

						<li class="testimonial <?php echo $i === 1 ? 'active' : ''; ?>">

							<div class="testimonial-image">
								<?php the_post_thumbnail( 'thumbnail' ); ?>
							</div>

							<h4 class="testimonial-author">
								<?php the_title(); ?>

								<br/>

								<?php if ( $role ) : ?>
									<span class="testimonial-role">
										<?php echo $role; ?>
									</span>
								<?php endif; ?>
							</h4>

							<div class="testimonial-content">
								<span class="icon-quote icon-quotes-left"></span>
								<?php the_content(); ?>
							</div>

						</li>

						<?php
					}
					wp_reset_postdata();
					?>
				</ul>

			</div>

		<?php
		}
		echo $args['after_widget'];
	}

	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Testimonials', 'KidNiche' );
		$count = ! empty( $instance['count'] ) ? $instance['count'] : 3;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Count:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>"
			       name="<?php echo $this->get_field_name( 'count' ); ?>" type="text"
			       value="<?php echo esc_attr( $count ); ?>">
		</p>
	<?php
	}
}

add_action( 'widgets_init', function () {
	register_widget( 'KidNicheWidget_Testimonials' );
} );