<?php
/**
 * Custom Single Post Template
 *
 * This template is used to display single post content.
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
		do_action( 'hfe_archive' );
    endwhile;
endif;

// Include the theme footer
get_footer();
