<?php
/**
 * Gravity Forms Actions/Filters
 *
 * @since   1.0.0
 * @package KidNiche
 */

add_filter( 'gform_username_2', 'generate_wholesale_username' );
/**
 * Ensures that the Username is unique
 * @param  string $username Set to First Name in the Registration Feed (Full Name doesn't work for some reason)
 * @return string $username
 */
function generate_wholesale_username( $username ) {
    
    if ( class_exists( 'GFUser' ) ) {
    
        $first = rgpost( 'input_1_3' );
        $last = rgpost( 'input_1_6' );

        // No need for overly long Usernames
        $username = substr( $first, 0, 1 ) . substr( $last, 0, 10 );
        $username = preg_replace( '/[^A-Za-z]/', '', strtolower( $username ) );

        $index = 1;
        while( username_exists( $username ) !== false ) {

            $username = str_replace( $index - 1, '', $username ) . $index;

            $index++;

        }
        
    }
    
    return $username;
    
}