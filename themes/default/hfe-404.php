<?php
/**
 * Custom 404 Template
 *
 * This template is used to display 404 content.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Include the theme header
get_header();


do_action( 'hfe_404' );


// Include the theme footer
get_footer();
