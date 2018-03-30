<?php
/* Theme Shortcode for social links ------------------------------------------------------------------------------------*/
function stag_social_shortcode( $atts ){
 extract( shortcode_atts( array(
    'url' => '',
    'all' => ''
  ), $atts ) );

  $output = '<div class="social-icons">';
  $url = explode(',', $url);

  foreach($url as $u){
    $u = trim($u);

    if($u === 'email' || $u === ' email'){
      $output .= "<a target='_blank' href='mailto:". stag_get_option('general_contact_email') ."'><i class='icon icon-{$u}'></i></a>";
    }
    if($u === 'rss' || $u === ' rss'){
      $output .= "<a target='_blank' href='". get_bloginfo('rss_url') ."'><i class='icon icon-{$u}'></i></a>";
    }

    if(stag_get_option('social_'.$u) != ''){
      $output .= "<a target='_blank' href='". stag_get_option('social_'.$u) ."'><i class='icon icon-{$u}'></i></a>";
    }
  }

  $output .= '</div>';

 return $output;
}
add_shortcode( 'social', 'stag_social_shortcode' );



function stag_google_map_shortcode($atts){
  extract( shortcode_atts( array(
     'url' => '',
   ), $atts ) );
  return "<iframe class='google-map' width='100%' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='{$url}&amp;output=embed'></iframe>";
}
add_shortcode('map', 'stag_google_map_shortcode');
