<?php
//Google Maps 
function mom_googleMaps($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '680',
      "height" => '400',
      "src" => 'https://maps.google.com/?ll=37.0625,-95.677068&spn=48.555061,94.570313&t=m&z=4'
   ), $atts));
   return '<div class="mom_map"><iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed"></iframe></div>';
}
add_shortcode("google_map", "mom_googleMaps");

//Google Fonts
function mom_googleFonts($atts, $content = null) {
   extract(shortcode_atts(array(
      "font" => '',
      "font_size" => '',
      "font_weight" => ''
   ), $atts));
   		$safe_fonts = array('arial'=>'Arial',
			'verdana'=>'Verdana, Geneva',
			'trebuchet'=>'Trebuchet',
			'georgia' =>'Georgia',
			'times'=>'Times New Roman',
			'tahoma'=>'Tahoma, Geneva',
			'palatino'=>'Palatino',
			'helvetica'=>'Helvetica',
			'museo_slab' => 'Museo Slab'
			);

if (! array_key_exists($font, $safe_fonts) && $font != '') {
			$gfont = $font;
			$gfontn = explode(' ', $gfont);
			$gfontn = $gfontn[0];
			$gfont = str_replace(' ', '+', $gfont);
			
			if ($font_weight == 700) {
			      wp_enqueue_style( "mom_typography_$gfontn", "http://fonts.googleapis.com/css?family=$gfont:400,700&subset=latin,greek-ext,cyrillic-ext,greek,vietnamese,latin-ext,cyrillic", false, null, 'all' );	
			} else {
			      wp_enqueue_style( "mom_typography_$gfontn", "http://fonts.googleapis.com/css?family=$gfont&subset=latin,greek-ext,cyrillic-ext,greek,vietnamese,latin-ext,cyrillic", false, null, 'all' );	
			}
			
}
if( $font_size != '' ) {
    $font_size = 'font-size:'.$font_size.'px;';
} else {
    $font_size = '';    
}
if( $font_weight != '' ) {
    $font_weight = 'font-weight:'.$font_weight.';';
} else {
    $font_weight = '';    
}

   return '<div class="mom_google_font" style="font-family:'.$font.'; '.$font_size.$font_weight.'">'.do_shortcode($content).'</div>';
}
add_shortcode("google_font", "mom_googleFonts");

//Gap
function mom_gap($atts, $content = null) {
   extract(shortcode_atts(array(
      "height" => 40,
   ), $atts));
   return '<div class="clear" style="height:'.$height.'px;"></div>';
}
add_shortcode("gap", "mom_gap");
//contact Wrap
function mom_contact_wrap($atts, $content = null) {
   extract(shortcode_atts(array(
      "style" => '',
   ), $atts));
   return '<div class="mom_contac_wrap contact_form_style'.$style.'">'.do_shortcode($content).'</div>';
}
add_shortcode("contact_wrap", "mom_contact_wrap");
//Animation
function mom_animation($atts, $content = null) {
   extract(shortcode_atts(array(
      "animation" => '',
      "duration" => '',
      "delay" => '',
      "iteration" => '',
   ), $atts));
   if (!empty($duration)) {
      $duration = '-webkit-animation-duration: '.$duration.'s;-moz-animation-duration: '.$duration.'s;-o-animation-duration: '.$duration.'s;animation-duration: '.$duration.'s;';
   }
   if (!empty($delay)) {
      $delay = '-webkit-animation-delay: '.$delay.'s;-moz-animation-delay: '.$delay.'s;-o-animation-delay: '.$delay.'s;animation-delay: '.$delay.'s;';
   }
   $iteration_count = '';
   if (!empty($iteration)) {
      if ($iteration == -1 ) {$iteration = 'infinite';}
      $iteration_count = '-webkit-animation-iteration-count: '.$iteration.';-moz-animation-iteration-count: '.$iteration.';-o-animation-iteration-count: '.$iteration.';animation-iteration-count: '.$iteration.';';
   }

   return '<div class="animator animated" style="'.$duration.$delay.$iteration_count.'" data-animate="'.$animation.'">'.do_shortcode($content).'</div>';
}
add_shortcode("animate", "mom_animation");

function mom_visibility_shortcode($atts, $content = null) {
   extract(shortcode_atts(array(
      "visible_on" => '', // desktop, devices (tablets/mobile), tablets, mobiles
   ), $atts));
   $visible_on = 'mom_visibility_'.$visible_on;
   return '<div class="'.$visible_on.'">'.do_shortcode($content).'</div>';

}
add_shortcode("visibility", "mom_visibility_shortcode");


function mom_login_shortcode($atts, $content = null) {
   extract(shortcode_atts(array(
      'register' => '',
      'reset'	=> ''
   ), $atts));
   return mom_login_form($register, $reset);

}
add_shortcode("login_form", "mom_login_shortcode");

function mom_register_shortcode($atts, $content = null) {
   extract(shortcode_atts(array(
      'register' => '',
      'reset'	=> ''
   ), $atts));
   return mom_register_form();

}
add_shortcode("register_form", "mom_register_shortcode");