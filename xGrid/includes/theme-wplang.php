<?php
/*
 * WPLANG
 */
@define( 'BD_WPTHEME', 'bd');

function bd_wplang( $label ) {
        $wplang = array(

            /* Post Meta */
            'no_comments' => __( '0', BD_WPTHEME ),
            'comment' => __( '1', BD_WPTHEME ),
            'comments' => __( 'Comments', BD_WPTHEME ),
            'comments_link' => __( 'comments-link', BD_WPTHEME ),
            'comments_closed' => __( '0', BD_WPTHEME ),
            'edit' => __( 'Edit', BD_WPTHEME ),

            /* Loop */
            'continue_reading' => __( 'Continue Reading', BD_WPTHEME ),

            /* Filter */
            'show_all' => __( 'All Categories', BD_WPTHEME ),

            /* Widgets */
            'nothing_yet' => __( 'Nothing Yet.', BD_WPTHEME ),

        );
		return $wplang[$label];
	};
?>