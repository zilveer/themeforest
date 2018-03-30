<?php

define('TH_SHORTCODES', dirname( __FILE__ ));

// Load complex shortcodes

include_once( TH_SHORTCODES . '/lib/carousel-logos.php');
include_once( TH_SHORTCODES . '/lib/pricing-box.php');
include_once( TH_SHORTCODES . '/lib/google-map.php');
include_once( TH_SHORTCODES . '/lib/testimonials-carousel.php');
include_once( TH_SHORTCODES . '/lib/icon-box.php');
include_once( TH_SHORTCODES . '/lib/button.php');
include_once( TH_SHORTCODES . '/lib/team-member.php');
include_once( TH_SHORTCODES . '/lib/icon-box_grid.php');
include_once( TH_SHORTCODES . '/lib/portfolio-grid.php');
include_once( TH_SHORTCODES . '/lib/quotes.php');
include_once( TH_SHORTCODES . '/lib/alert.php');
include_once( TH_SHORTCODES . '/lib/blog-grid.php');
include_once( TH_SHORTCODES . '/lib/call-to-action.php');
include_once( TH_SHORTCODES . '/lib/call-to-action-line.php');
include_once( TH_SHORTCODES . '/lib/footer-section.php');
include_once( TH_SHORTCODES . '/lib/contact-block.php');
include_once( TH_SHORTCODES . '/lib/social-icon-box.php');
include_once( TH_SHORTCODES . '/lib/projects-gallery.php');
include_once( TH_SHORTCODES . '/lib/modal.php');
include_once( TH_SHORTCODES . '/lib/contact-form.php');



function th_heading($atts, $content=null) {
    extract(shortcode_atts(array(
        "title" => 'This is a Special Heading',
        "th_is_underline" => '',
        "font"			=> '',
        "th_text_align"			=> ''
    ), $atts));

    $font_class = '';
	$return = '';

    if($th_is_underline == 'yes'){
        $return .= '<h3 class="'.$th_text_align.'">'.$title.'</h3><hr>';

    }else{

        if($font == 'cta-title') {
            $font_class = 'cta-title-2';

            $return = '<div class="'.$font_class.' '.$th_text_align.'"><div class="space-bottom-2x"></div>';
        }
        else {
            $font_class = 'general-title';
            $return = '<!-- Section General Title -->';
            $return .= '<div class="'.$font_class.'">';
        }

		        $return .= '<h2>'.$title.'</h2><div class="space-bottom-2x"></div>';
        $return .= '</div>';
    }
    return $return;
}
add_shortcode('special_heading', 'th_heading');