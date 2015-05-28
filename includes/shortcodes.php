<?php
/**
 * The theme's shortcodes.
 *
 * @since   1.0.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_shortcode( 'facebook', '_kidniche_sc_facebook' );
add_shortcode( 'linkedin', '_kidniche_sc_linkedin' );
add_shortcode( 'twitter', '_kidniche_sc_twitter' );
add_shortcode( 'clear', '_kidniche_sc_clear' );
add_shortcode( 'button', '_kidniche_sc_button' );

function _kidniche_sc_facebook( $atts = array() ) {

	$atts = shortcode_atts( array(
		'link' => '#',
	), $atts );

	return "<a href=\"$atts[link]\" class=\"social-icon-facebook icon-facebook\"></a>";
}

function _kidniche_sc_linkedin( $atts = array() ) {

	$atts = shortcode_atts( array(
		'link' => '#',
	), $atts );

	return "<a href=\"$atts[link]\" class=\"social-icon-linkedin icon-linkedin\"></a>";
}

function _kidniche_sc_twitter( $atts = array() ) {

	$atts = shortcode_atts( array(
		'link' => '#',
	), $atts );

	return "<a href=\"$atts[link]\" class=\"social-icon-twitter icon-twitter\"></a>";
}

function _kidniche_sc_clear() {
	return '<div class="clear"></div>';
}

function _kidniche_sc_button( $atts = array(), $content = '' ) {

	$atts = shortcode_atts( array(
		'link' => '#',
		'size' => '',
		'classes' => 'button',
	), $atts );

	$atts['classes'] .= " $atts[size]";

	return '<a href="' . $atts['link'] . '" class="' . $atts['classes'] . '">' . do_shortcode( $content ) . '</a>';
}