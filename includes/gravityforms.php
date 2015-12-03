<?php
/**
 * Gravity Forms Actions/Filters
 *
 * @since   1.0.0
 * @package KidNiche
 */

add_action( 'wp', 'custom_gform_activation_page', 9 );
/**
 * Overrides the default Gravity Forms User Activation Page
 */
function custom_gform_activation_page() {

    $template_path = __DIR__ . '/activate.php';
    $is_activate_page = isset( $_GET['page'] ) && $_GET['page'] == 'gf_activation';

    if( ! file_exists( $template_path ) || ! $is_activate_page  )
        return;

    require_once( $template_path );

    exit();

}
