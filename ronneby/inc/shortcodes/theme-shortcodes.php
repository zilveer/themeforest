<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
// Buttons
function dfd_flexslider( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'id' => '', /* some unique id */
    ), $atts ) );

    /* If there's no content, just return back what we got. */
    if ( is_null( $content ) )
        return $content;

    $output = '<div id="' . $id . '"><span class="extra-links"></span>';
    $output .= $content;
    $output .= '</div>';

    $output .= '<script type="text/javascript">
            jQuery(document).ready(function () {

                jQuery("#' . $id . ' div.woocommerce").flexslider({
                    selector: "ul.products > li",
                    animation: "slide",
                    direction: "horizontal",
                    itemWidth: 280,
                    itemMargin: 0,
                    minItems: 2,
                    maxItems: 4,
                    controlsContainer: ".extra-links",
                    slideshow: false,
                    controlNav: false,            //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                    directionNav: true,           //Boolean: Create navigation for previous/next navigation? (true/false)
                    prevText: "",                 //String: Set the text for the "previous" directionNav item
                    nextText: ""
                });

            });
        </script>';

    return $output;
}

add_shortcode('flexslider', 'dfd_flexslider');
