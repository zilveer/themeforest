<?php

    /*
    *
    *	Breacrumbs
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	sf_breadcrumbs()
    *
    */


    /* PAGE HEADING
    ================================================== */
    if ( ! function_exists( 'sf_breadcrumbs' ) ) {
        function sf_breadcrumbs( $alt = false ) {

            global $post, $sf_options;

            $remove_breadcrumbs = false;
			$breadcrumb_in_heading = 0;
			if ( isset( $sf_options['breadcrumb_in_heading'] ) ) {
				$breadcrumb_in_heading = $sf_options['breadcrumb_in_heading'];
			}
			
			// Remove breadcrumbs
            if ( $post && is_singular() ) {
                $remove_breadcrumbs = sf_get_post_meta( $post->ID, 'sf_no_breadcrumbs', true );
            }
            
            // Breadcrumb in heading
            if ( $breadcrumb_in_heading && !$alt ) {
				return;
            }

            if ( ! $remove_breadcrumbs ) {
                if ( function_exists( 'bcn_display' ) ) {
                    ?>
                    <div id="breadcrumbs">
                        <div class="container"><?php bcn_display(); ?></div>
                    </div>
                <?php } else if ( function_exists( 'yoast_breadcrumb' ) ) { ?>
                    <div id="breadcrumbs">
                        <div class="container"><?php yoast_breadcrumb( "", "" ); ?></div>
                    </div>
                <?php
                }
            }

        }

        add_action( 'sf_main_container_start', 'sf_breadcrumbs', 20 );
    }
?>