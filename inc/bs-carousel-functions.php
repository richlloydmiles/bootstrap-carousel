<?php
/**
 * Wraps the output class in a function to be called in templates
 */
function bs_carousel( $args ) {
	$bs_carousel = new BS_Carousel;
    echo $bs_carousel->output( $args );
}

// Compatibility with Homepage Control
// add_action( 'homepage', 'bs_carousel', 10 );