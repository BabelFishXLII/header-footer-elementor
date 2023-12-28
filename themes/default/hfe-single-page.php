<?php
/**
 * Custom Single Page Template
 *
 * This template is used to display Single Page content.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Include the theme header
get_header();

// Start the WordPress loop
if ( have_posts() ) :
    while ( have_posts() ) : the_post();
		do_action( 'hfe_single_page' );
    endwhile;
endif;

// Include the theme footer
get_footer();
