<?php

// Social icons box

function th_social_icons_box($atts, $content = null) {
    extract(shortcode_atts(array(
        "social_facebook" => '',
        "social_twitter" => '',
        "social_skype" => '',
        "social_pinterest" => '',
        "th_social_target" => '',
        "th_custom_social" => '',
        "social_custom" => '',
        "el_class" => '',
    ), $atts));


	$output = '';
	$output .= '<br><div class="row '.$el_class.'">
						<div class="col-sm-3 col-md-12">
							<ul class="contact-social">';
	
								if( $social_facebook != '' ){
									$output .= '<li><a target="'.$th_social_target.'" href="'.$social_facebook.'"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>';
								}
								if( $social_twitter !== '' ){
									$output .= '<li><a target="'.$th_social_target.'" href="'.$social_twitter.'"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a></li>';
								}
								if( $social_skype !== '' ){
									$output .= '<li><a target="'.$th_social_target.'" href="'.$social_skype.'"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-skype fa-stack-1x fa-inverse"></i></span></a></li>';
								}
								if( $social_pinterest !== '' ){
									$output .= '<li><a target="'.$th_social_target.'" href="'.$social_pinterest.'"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-pinterest fa-stack-1x fa-inverse"></i></span></a></li>';
								}
                                
								if( $th_custom_social == 'yes' ){
									$social_encode =  rawurldecode(base64_decode(strip_tags($social_custom)));
									$output .= $social_encode;
								}
			$output .= '</ul>
					</div>
				</div>';							



    return $output;
}

remove_shortcode('social_icons_box');
add_shortcode('social_icons_box', 'th_social_icons_box');