<?php 
/* =================================== */
// BUTTONS
/* =================================== */
function truethemes_button($atts, $content = null) {
  extract(shortcode_atts(array(
  'size'      => '',
  'style'     => '',
  'url'       => '',
  'target'    => '',
  'icon'      => '',
  'popup'     => '',
  'title'     => '',
  ), $atts));
  
  //format sizes so user doesn't need to input "_"
  $size   = ($size == 'small')  ? 'small_'  : $size;
  $size   = ($size == 'medium') ? 'medium_' : $size;
  $size   = ($size == 'large')  ? 'large_'  : $size;
  
  $output = '<a class="ka_button '.$size.'button '.$size.$style.'"';
  
  //link target
  if('' != $target){
	  $output .= ' target="'.$target.'"';
  }
  
  //link title
  if('' != $title){
	  $output .= ' title="'.$title.'"';
  }
  
  $output .= ' href="';
  
  //display popup in lightbox or normal url
  if('' != $popup){
	  $output .= $popup.'" data-gal="prettyPhoto">';
  } else {
	  $output .= $url.'">';
  }
  
  //display icon
  if('' != $icon){
  	$output .= '<i class="fa '.$icon.'"></i>' .do_shortcode($content). '</a>'; 
  } else {
	$output .= do_shortcode($content). '</a>';
  }
  
  return $output;
}
add_shortcode('button', 'truethemes_button');

/* =================================== */
// BUSINESS CONTACT DETAILS
/* =================================== */
function truethemes_business_contact( $atts, $content = null ) {
	extract(shortcode_atts(array(
	'phone_number'     => '',
  'fax_number'       => '',
	'skype_username'   => '',
	'skype_label'      => 'Skype',
	'email_address'    => '',
	'directions_url'   => '',
	'directions_label' => 'get driving directions',
	'style' => '',
	), $atts));
  
	$output = '<ul class="tt-business-contact">';
	if(!empty($phone_number)):
		$output .= '<li><a href="tel://'.$phone_number.'" class="tt-biz-phone">'.$phone_number.'</a></li>'; endif;
  if(!empty($fax_number)):
    $output .= '<li><a href="tel://'.$fax_number.'" class="tt-biz-fax">'.$fax_number.'</a></li>'; endif;
	if(!empty($skype_username)):
		$output .= '<li><a href="skype:'.$skype_username.'?call" class="tt-biz-skype">'.$skype_label.'</a></li>'; endif;
	if(!empty($email_address)):
		$output .= '<li><a href="mailto:'.$email_address.'" class="tt-biz-email">'.$email_address.'</a></li>'; endif;
	if(!empty($directions_url)):
		$output .= '<li><a href="'.$directions_url.'" class="tt-biz-directions" target="_blank">'.$directions_label.'</a></li>'; endif;

$output .= '</ul>';

	return $output;
}
add_shortcode('business_contact', 'truethemes_business_contact');

/* =================================== */
// CALLOUT BOXES
/* =================================== */
function truethemes_callout( $atts, $content = null ) {
  extract(shortcode_atts(array(
  'font_size' => '13px',
  'style' => '',
  ), $atts));
  
  if('dark' == $style) {$style == 'black';}

return '[raw]<div class="message_karma_'.$style.' colored_box" style="font-size:'.$font_size.';">[/raw]' . do_shortcode($content) . '[raw]</div><br class="clear" />[/raw]';
}
add_shortcode('callout', 'truethemes_callout');

/* =================================== */
// COLUMNS 
/* =================================== */
/* 6 */
function truethemes_one_sixth( $atts, $content = null ) {
   return '[raw]<div class="one_sixth tt-column">[/raw]' . do_shortcode($content) . '[raw]</div>[/raw]';
} add_shortcode('one_sixth', 'truethemes_one_sixth');

function truethemes_one_sixth_last( $atts, $content = null ) {
   return '[raw]<div class="one_sixth_last tt-column">[/raw]' . do_shortcode($content) . '[raw]</div><br class="clear" />[/raw]';
} add_shortcode('one_sixth_last', 'truethemes_one_sixth_last');

/* 5 */
function truethemes_one_fifth( $atts, $content = null ) {
   return '[raw]<div class="one_fifth tt-column">[/raw]' . do_shortcode($content) . '[raw]</div>[/raw]';
} add_shortcode('one_fifth', 'truethemes_one_fifth');

function truethemes_one_fifth_last( $atts, $content = null ) {
   return '[raw]<div class="one_fifth_last tt-column">[/raw]' . do_shortcode($content) . '[raw]</div><br class="clear" />[/raw]';
} add_shortcode('one_fifth_last', 'truethemes_one_fifth_last');

/* 4 */
function truethemes_one_fourth( $atts, $content = null ) {
   return '[raw]<div class="one_fourth tt-column">[/raw]' . do_shortcode($content) . '[raw]</div>[/raw]';
} add_shortcode('one_fourth', 'truethemes_one_fourth');

function truethemes_one_fourth_last( $atts, $content = null ) {
   return '[raw]<div class="one_fourth_last tt-column">[/raw]' . do_shortcode($content) . '[raw]</div><br class="clear" />[/raw]';
} add_shortcode('one_fourth_last', 'truethemes_one_fourth_last');

/* 3 */
function truethemes_one_third( $atts, $content = null ) {
   return '[raw]<div class="one_third tt-column">[/raw]' . do_shortcode($content) . '[raw]</div>[/raw]';
} add_shortcode('one_third', 'truethemes_one_third');

function truethemes_one_third_last( $atts, $content = null ) {
   return '[raw]<div class="one_third_last tt-column">[/raw]' . do_shortcode($content) . '[raw]</div><br class="clear" />[/raw]';
} add_shortcode('one_third_last', 'truethemes_one_third_last');

/* 2 */
function truethemes_one_half( $atts, $content = null ) {
   return '[raw]<div class="one_half tt-column">[/raw]' . do_shortcode($content) . '[raw]</div>[/raw]';
} add_shortcode('one_half', 'truethemes_one_half');

function truethemes_one_half_last( $atts, $content = null ) {
   return '[raw]<div class="one_half_last tt-column">[/raw]' . do_shortcode($content) . '[raw]</div><br class="clear" />[/raw]';
} add_shortcode('one_half_last', 'truethemes_one_half_last');

/* 2/3 */
function truethemes_two_thirds( $atts, $content = null ) {
   return '[raw]<div class="two_thirds tt-column">[/raw]' . do_shortcode($content) . '[raw]</div>[/raw]';
} add_shortcode('two_thirds', 'truethemes_two_thirds');

function truethemes_two_thirds_last( $atts, $content = null ) {
   return '[raw]<div class="two_thirds_last tt-column">[/raw]' . do_shortcode($content) . '[raw]</div><br class="clear" />[/raw]';
} add_shortcode('two_thirds_last', 'truethemes_two_thirds_last');

/* 3/4 */
function truethemes_three_fourth( $atts, $content = null ) {
   return '[raw]<div class="three_fourth tt-column">[/raw]' . do_shortcode($content) . '[raw]</div>[/raw]';
} add_shortcode('three_fourth', 'truethemes_three_fourth');

function truethemes_three_fourth_last( $atts, $content = null ) {
   return '[raw]<div class="three_fourth_last tt-column">[/raw]' . do_shortcode($content) . '[raw]</div><br class="clear" />[/raw]';
} add_shortcode('three_fourth_last', 'truethemes_three_fourth_last');

function truethemes_flash_wrap( $atts, $content = null ) {
   return '[raw]<div class="flash_wrap">[/raw]' . do_shortcode($content) . '[raw]</div><br class="clear" />[/raw]';
} add_shortcode('flash_wrap', 'truethemes_flash_wrap');

/* =================================== */
// IMAGE FRAME + LIGHTBOX 
/* =================================== */

/**
 * @since 4.0 - Image Frames + Lightboxes combined into single function for better user experience.
 *
 * Old lightbox shortcode moved to /framewrok/shortcodes-old.php
 *
 * Use to construct HTML output of truethemes_image_frame().
 * prevents duplication of codes and allows easy modification.
 *
 * uses truethemes_crop_image() to get cropped image src.
 * see framework/theme-functions.php
 *
 */

function truethemes_image_frame_constructor($style,$frame_class,$image_path,$width,$height,$framesize,$lightbox,$link_to_page,$image_zoom_number,$target,$description,$lightbox_group,$float){

//Allow plugins/themes to override this layout.
//refer to http://codex.wordpress.org/Function_Reference/add_filter for usage
$output = apply_filters('truethemes_image_frame_filter','',$style,$frame_class,$image_path,$width,$height,$framesize,$lightbox,$link_to_page,$image_zoom_number,$target,$description,$lightbox_group,$float);
if ( $output != '' ){
		return $output;
}
$image_src = truethemes_crop_image($thumb=null,$image_path,$width,$height); //see above

$output .= '[raw]<div class="'.$style.'_img_frame '.$framesize.''; //@since 4.0 - check for $float
if ('' == $float) {
	$output .= '">';
} else {
	$output .= ' tt-img-'.$float.'">';
}

//if $lightbox or $link_to_page we add .lightbox-img class for hover-effect
if(('' != $lightbox) || ('' != $link_to_page)){
	$output .='<div class="img-preload lightbox-img">';
} else {
	$output .= '<div class="img-preload">'; //all "preload classes" replaced by .img-preload
}

//if $link_to_page we format for link
if(!empty($link_to_page)){ 
	$output.='<a href="'.$link_to_page.'" class="attachment-fadeIn" title="'.$description.'" target="'.$target.'">';
	$output.='<div class="lightbox-zoom zoom-'.$image_zoom_number.' zoom-link" style="position:absolute; display: none;">&nbsp;</div>';
}

//if $lightbox we format for lightbox
if(!empty($lightbox)){
	$output.='<a href="'.$lightbox.'" class="attachment-fadeIn" data-gal="prettyPhoto['.$lightbox_group.']" title="'.$description.'">';
	$output.='<div class="lightbox-zoom zoom-'.$image_zoom_number.'" style="position:absolute; display: none;">&nbsp;</div>';
}

//if $lightbox and $link_to_page are empty we format normal image
if(('' == $lightbox) || ('' == $link_to_page)){
$output .= "<img src='".$image_src."' alt='".$description."' class=\"attachment-fadeIn\" />";
}


//if $lightbox or $link_to_page we close anchor tag </a>
if(('' != $lightbox) || ('' != $link_to_page)){
	$output.='</a></div></div>[/raw]';
} else {
	$output .='</div></div>[/raw]'; //close normal image
}

return $output;

} //END truethemes_image_frame_constructor


function truethemes_image_frame($atts, $content = null) {
  extract(shortcode_atts(array(  
  'style'           => '',
  'image_path'      => '',
  'link_to_page'    => '',
  'target'          => '',
  'description'     => '',
  'size'            => '',
  'lightbox'        => '',
  'lightbox_group'  => '1',
  'float'           => ''
  ), $atts));
  
 
 $framesize = $style.'_'.$size;
 $output = null;
 
 
/* --- FULL WIDTH -  BANNER --- */
if ($size == 'banner_full'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,922,201,$framesize,$lightbox,$link_to_page,'banner-full',$target,$description,$lightbox_group,$float);
}

/* --- FULL WIDTH -  ONE_HALF (2 Column) --- */
if ($size == 'two_col_large'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,437,234,$framesize,$lightbox,$link_to_page,'2',$target,$description,$lightbox_group,$float);
}

/* --- FULL WIDTH -  ONE_THIRD (3 Column) --- */
if ($size == 'three_col_large'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,275,145,$framesize,$lightbox,$link_to_page,'3',$target,$description,$lightbox_group,$float);
}

/* --- FULL WIDTH -  ONE_THIRD (3 Column - Square) --- */
if ($size == 'three_col_square'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,275,275,$framesize,$lightbox,$link_to_page,'3',$target,$description,$lightbox_group,$float);
}

/* --- FULL WIDTH -  ONE_FOURTH (4 Column) */
if ($size == 'four_col_large'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,190,111,$framesize,$lightbox,$link_to_page,'4',$target,$description,$lightbox_group,$float);
}

/* --- SIDE NAV -  BANNER --- */
if ($size == 'banner_regular'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,703,201,$framesize,$lightbox,$link_to_page,'banner-side-nav',$target,$description,$lightbox_group,$float);
}

/* --- SIDE NAV -  ONE_HALF (2 Column) --- */
if ($size == 'two_col_small'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,324,180,$framesize,$lightbox,$link_to_page,'2-small',$target,$description,$lightbox_group,$float);
}

/* --- SIDE NAV -  ONE_THIRD (3 Column) --- */
if ($size == 'three_col_small'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,202,113,$framesize,$lightbox,$link_to_page,'3-small',$target,$description,$lightbox_group,$float);
}

/* --- SIDE NAV -  ONE_FOURTH (4 Column) --- */
if ($size == 'four_col_small'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,135,76,$framesize,$lightbox,$link_to_page,'4-small',$target,$description,$lightbox_group,$float);
}

/* --- SIDE NAV + SIDEBAR -  BANNER --- */
if ($size == 'banner_small'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,493,201,$framesize,$lightbox,$link_to_page,'banner-side-nav-sidebar',$target,$description,$lightbox_group,$float);
}

/* --- PORTRAIT STYLE - FULL --- */
if ($size == 'portrait_full'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,612,792,$framesize,$lightbox,$link_to_page,'portrait-full',$target,$description,$lightbox_group,$float);
}

/* --- PORTRAIT STYLE - THUMBNAIL --- */
if ($size == 'portrait_thumb'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,275,355,$framesize,$lightbox,$link_to_page,'portrait-small',$target,$description,$lightbox_group,$float);
}

/* --- SQUARE IMAGE FRAME --- */
if ($size == 'square'){
$output .= truethemes_image_frame_constructor($style,'img-preload',$image_path,190,180,$framesize,$lightbox,$link_to_page,'square',$target,$description,$lightbox_group,$float);
}

return $output;
}
add_shortcode('frame', 'truethemes_image_frame');



/* =================================== */
// DIVIDERS 
/* =================================== */
function truethemes_hr_shadow() {
    return '[raw]<div class="hr_shadow">&nbsp;</div>[/raw]';
}
add_shortcode('hr_shadow', 'truethemes_hr_shadow');

function truethemes_hr() {
    return '[raw]<div class="hr">&nbsp;</div>[/raw]';
}
add_shortcode('hr', 'truethemes_hr');

function truethemes_top_link( $atts, $content = null ) {
   return '[raw]<div class="hr_top_link">&nbsp;</div><a href="#" class="link-top">' . do_shortcode($content) . '</a><br class="clear" />[/raw]';
}
add_shortcode('top_link', 'truethemes_top_link');



/* =================================== */
// Font Awesome
/* =================================== */
function truethemes_font_awesome($atts, $content = null) {
  extract(shortcode_atts(array(  
  'icon'     => '',
  'size'     => '',
  'border'   => 'false',
  'pull'     => '',
  'color'    => ''
  
  ), $atts));
  
  $output = '<i class="fa '.$icon;
  
  if('' != $size):
  		$output .= ' '.$size;
  endif;
  
  if('true' == $border):
  		$output .= ' fa-border';
  endif;
  
  if('' != $pull):
  		$output .= ' '.$pull;
  endif; 
  
  if('' != $color):
  		$output .= '" style="color:'.$color.';';
  	endif;
  
  $output .= '"></i>';
  
  return $output;
}
add_shortcode('tt_vector', 'truethemes_font_awesome');



/* =================================== */
// Font Awesome - Icon Box
/* =================================== */
function truethemes_font_awesome_box($atts, $content = null) {
  extract(shortcode_atts(array(  
  'icon'            => '',
  'size'            => 'fa-4x',
  'color'           => '',
  'link_to_page'    => '',
  'target'          => '',
  'description'     => ''
  ), $atts));
  
if('' != $link_to_page) {
	$output = '[raw]<a class="tt-icon-box" href="'.$link_to_page.'" title="'.$description.'" target="'.$target.'">';
  } else { $output = '[raw]<div class="tt-icon-box">'; }
		
	$output .= '<span class="fa-stack '.$size.'"><i class="fa fa-circle fa-stack-2x"';
				
	if('' != $color):
		$output .= ' style="color:'.$color.';"';
  	endif;
  
  	$output .= '></i><i class="fa '.$icon.' fa-stack-1x fa-inverse"></i></span>[/raw]';
	$output .= do_shortcode($content);
	
	
	if('' != $link_to_page) { 
		$output .= '[raw]</a>[/raw]';
	} else { 
		$output .= '[raw]</div>[/raw]'; 
	}

  
  return $output;
}
add_shortcode('tt_vector_box', 'truethemes_font_awesome_box');


/* =================================== */
// GAP 
/* =================================== */
function truethemes_sc_gap($atts, $content = null) {
  extract(shortcode_atts(array(  
  'size'            => '100px',
  ), $atts));
  
    return '[raw]<div class="hr_gap" style="height:'.$size.';"></div>[/raw]';
}
add_shortcode('gap', 'truethemes_sc_gap');


/* =================================== */
// LISTS 
/* =================================== */
function truethemes_list1( $atts, $content = null ) {
   return '<ul class="list list1">' . do_shortcode($content) . '</ul>';
}
add_shortcode('arrow_list', 'truethemes_list1');

function truethemes_list2( $atts, $content = null ) {
   return '<ul class="list list2">' . do_shortcode($content) . '</ul>';
}
add_shortcode('star_list', 'truethemes_list2');

function truethemes_list3( $atts, $content = null ) {
   return '<ul class="list list3">' . do_shortcode($content) . '</ul>';
}
add_shortcode('circle_list', 'truethemes_list3');

function truethemes_list4( $atts, $content = null ) {
   return '<ul class="list list4">' . do_shortcode($content) . '</ul>';
}
add_shortcode('check_list', 'truethemes_list4');

function truethemes_list5( $atts, $content = null ) {
   return '<ul class="list list5">' . do_shortcode($content) . '</ul>';
}
add_shortcode('caret_list', 'truethemes_list5');

function truethemes_list6( $atts, $content = null ) {
   return '<ul class="list list6">' . do_shortcode($content) . '</ul>';
}
add_shortcode('plus_list', 'truethemes_list6');

function truethemes_list7( $atts, $content = null ) {
   return '<ul class="list list7">' . do_shortcode($content) . '</ul>';
}
add_shortcode('double_angle_list', 'truethemes_list7');

function truethemes_list8( $atts, $content = null ) {
   return '<ul class="list list8">' . do_shortcode($content) . '</ul>';
}
add_shortcode('full_arrow_list', 'truethemes_list8');


function truethemes_list_item( $atts, $content = null ) {
   return '<li>' . do_shortcode($content) . '</li>';
}
add_shortcode('list_item', 'truethemes_list_item');

/* =================================== */
// SOCIAL ICONS
/* =================================== */
function truethemes_social_shortcode( $atts, $content = null ) {
  extract(shortcode_atts(array(
  'style'            => '',
  'target'           => '_self',
  'show_title'       => '',
  'rss'              => '',
  'rss_title'        => 'RSS',
  'twitter'          => '',
  'twitter_title'    => 'Twitter',
  'facebook'         => '',
  'facebook_title'   => 'Facebook',
  'email'            => '',
  'email_title'      => 'Email',
  'flickr'           => '',
  'flickr_title'     => 'Flickr',
  'youtube'          => '',
  'youtube_title'    => 'YouTube',
  'linkedin'         => '',
  'linkedin_title'   => 'Linkedin',
  'pinterest'        => '',
  'pinterest_title'  => 'Pinterest',
  'instagram'        => '',
  'instagram_title'  => 'Instagram',
  'foursquare'       => '',
  'foursquare_title' => 'FourSquare',
  'delicious'        => '',
  'delicious_title'  => 'Delicious',
  'digg'             => '',
  'digg_title'       => 'Digg',
  'google'           => '',
  'google_title'     => 'Google +',
  'dribbble'         => '',
  'dribbble_title'   => 'Dribbble',
  'skype'            => '',
  'skype_title'      => 'Skype',
  ), $atts));
  
  if('image' == $style){ $style = 'tt_image_social_icons';}
  if('vector' == $style){ $style = 'tt_vector_social_icons';}
  if('vector_color' == $style){ $style = 'tt_vector_social_icons tt_vector_social_color';}
  
$output = '[raw]
<ul class="social_icons '.$style;

if('true' == $show_title){ $output .=' tt_show_social_title'; }else{ $output .=' tt_no_social_title'; }

$output .='">';

if(!empty($rss)):
$output .='<li><a title="'.$rss_title.'" class="rss" href="'.$rss.'" target="'.$target.'">'.$rss_title.'</a></li>'; endif;
if(!empty($twitter)):
$output .='<li><a title="'.$twitter_title.'" class="twitter" href="'.$twitter.'" target="'.$target.'">'.$twitter_title.'</a></li>'; endif;
if(!empty($facebook)):
$output .='<li><a title="'.$facebook_title.'" class="facebook" href="'.$facebook.'" target="'.$target.'">'.$facebook_title.'</a></li>'; endif;
if(!empty($email)):
$output .='<li><a title="'.$email_title.'" class="email" href="'.$email.'" target="'.$target.'">'.$email_title.'</a></li>'; endif;
if(!empty($flickr)):
$output .='<li><a title="'.$flickr_title.'" class="flickr" href="'.$flickr.'" target="'.$target.'">'.$flickr_title.'</a></li>'; endif;
if(!empty($youtube)):
$output .='<li><a title="'.$youtube_title.'" class="youtube" href="'.$youtube.'" target="'.$target.'">'.$youtube_title.'</a></li>'; endif;
if(!empty($linkedin)):
$output .='<li><a title="'.$linkedin_title.'" class="linkedin" href="'.$linkedin.'" target="'.$target.'">'.$linkedin_title.'</a></li>'; endif;
if(!empty($pinterest)):
$output .='<li><a title="'.$pinterest_title.'" class="pinterest" href="'.$pinterest.'" target="'.$target.'">'.$pinterest_title.'</a></li>'; endif;
if(!empty($instagram)):
$output .='<li><a title="'.$instagram_title.'" class="instagram" href="'.$instagram.'" target="'.$target.'">'.$instagram_title.'</a></li>'; endif;
if(!empty($foursquare)):
$output .='<li><a title="'.$foursquare_title.'" class="foursquare" href="'.$foursquare.'" target="'.$target.'">'.$foursquare_title.'</a></li>'; endif;
if(!empty($delicious)):
$output .='<li><a title="'.$delicious_title.'" class="delicious" href="'.$delicious.'" target="'.$target.'">'.$delicious_title.'</a></li>'; endif;
if(!empty($digg)):
$output .='<li><a title="'.$digg_title.'" class="digg" href="'.$digg.'" target="'.$target.'">'.$digg_title.'</a></li>'; endif;
if(!empty($google)):
$output .='<li class="google-plus"><a title="'.$google_title.'" class="google +" href="'.$google.'" target="'.$target.'">'.$google_title.'</a></li>'; endif;
if(!empty($dribbble)):
$output .='<li><a title="'.$dribbble_title.'" class="dribbble" href="'.$dribbble.'" target="'.$target.'">'.$dribbble_title.'</a></li>'; endif;
if(!empty($skype)):
$output .='<li><a title="'.$skype_title.'" class="skype" href="'.$skype.'" target="'.$target.'">'.$skype_title.'</a></li>'; endif;

$output .='</ul>
[/raw]';

return $output;	
}
add_shortcode('social', 'truethemes_social_shortcode');

/* =================================== */
// INTERACTIVE SHORTCODES 
/* =================================== */

/*
* @since 3.0.1, modified back to default WordPress shortcode format. (backward compatible for customer)
* no more using class.
* jQuery ui enqueued in footer via javascript.php, not sure since which version.
*
* How to use?
* [accordion class="accord1" active="2"]
* [slide name="slide1"]Content 1[/slide]
* [slide name="slide2"]Content 2[/slide]
* [/accordion]
* 
*/
	
function accordion_wrapper_shortcode( $atts, $content = null ){

    extract(shortcode_atts(array(
    'class' => 'accord1', //accordion class
    'active' => 'false', //since 3.0.1 close by default
    ), $atts));

    $output = '';
    $output .= '[raw]<ul class="accordion '.$class.'">[/raw]';
    $output .= do_shortcode($content) ;
    $output .= '[raw]</ul>[/raw]';
    
 	//added @since version 2.6 to allow open tab by default.
 	//uses jQuery UI version 1.8.15
    //jquery initialise individual accordions.
    $output .= "[raw]<script type='text/javascript'>jQuery(document).ready(function() {jQuery( \".".$class."\" ).accordion([/raw]";

    //if user wants to open any tab be default, user will set active='1'
    if(isset($active)){
    //the first tab is actually 0, so we use active tab minus 1.
    if($active != 'false'){ //fixed since 3.0.1
		$active = $active-1;
    }	
    $output .= "[raw]{ active: ".$active.", autoHeight: false, heightStyle: \"content\", header: \".opener\", collapsible: true, event: \"click\"}[/raw]";
    }

    $output .= "[raw]);});</script>[/raw]";
    
    return $output;	
}

add_shortcode('accordion','accordion_wrapper_shortcode');
    
    	
function accordion_slide_shortcode( $atts, $content = null ) {

    extract(shortcode_atts(array(), $atts));
    $slide   = $atts['name'];
    $output  = '';
    $output .= '[raw]<li><a href="#" class="opener"><strong>' .$slide. '</strong></a>[/raw]';
    $output .= '[raw]<div class="slide-holder"><div class="slide">[/raw]';
    $output .= '' . do_shortcode($content) .'';
    $output .= '[raw]</div></div></li>[/raw]';
    return $output;
}	

add_shortcode('slide','accordion_slide_shortcode');


/*
* @since 3.0.1, modified back to default WordPress shortcode format. (backward compatible for customer)
* no more using class.
* jQuery ui enqueued in footer via javascript.php
*/

 
function truethemes_tabset($atts, $content = null) {
    global $i;
    extract(shortcode_atts(array(), $atts));
    $output = '';
    $output .= '[raw]<div class="tabs-area">[/raw]';
    $output .= '[raw]<ul class="tabset">[/raw]';
    foreach ($atts as $tab) {
    $tabID = "tab-" . $i++;
    $output .= '[raw]<li><a href="#' . $tabID . '" class="tab"><span>' .$tab. '</span></a></li>[/raw]';
    }
    $output .= '[raw]</ul>[/raw]';
    $output .= do_shortcode($content) .'[raw]</div>[/raw]';
    return $output;
}

add_shortcode('tabset','truethemes_tabset');	

function truethemes_tabs($atts, $content = null) {
    global $j;
    extract(shortcode_atts(array(), $atts));
    $output = '';
    $tabID = "tab-" . $j++;
    $output .= '[raw]<div id="' . $tabID . '" class="tab-box">[/raw]' . do_shortcode($content) .'[raw]</div>[/raw]';	
    return $output;	
}

add_shortcode('tab','truethemes_tabs');
    
    

/* ----- TESTIMONIALS ----- */
function truethemes_testimonials( $atts, $content = null ) {
   return '[raw]<div class="tt-testimonial-wrapper"><div class="testimonials flexslider"><ul class="slides">' . do_shortcode($content) . '</ul></div></div><!-- END testimonials -->[/raw]';
}
add_shortcode('testimonial_wrap', 'truethemes_testimonials');


function truethemes_testimonial_content( $atts, $content = null ) {
   return '<li><blockquote><p>' . do_shortcode($content) . '</p></blockquote></li>';
}
add_shortcode('testimonial', 'truethemes_testimonial_content');

function truethemes_testimonial_client( $atts, $content = null ) {
   return '<cite>&ndash;' . do_shortcode($content) . '</cite>';
}
add_shortcode('client_name', 'truethemes_testimonial_client');


/* =================================== */
// Team Members
/* =================================== */
function truethemes_team_member($atts, $content = null) {
  extract(shortcode_atts(array(
  'members_name'   => '',
  'members_title'  => '',
  'style'          => '',
  'size'           => 'square',
  'image_path'     => '',
  'link_to_page'   => '',
  'description'    => '',
  'last_item'      => '',
  ), $atts));
  
  $framesize = $style.'_'.$size;
  
	$output ='[raw]<div class="member-wrap[/raw]';
	if('true' == $last_item): $output.='[raw] member-last-item[/raw]'; endif;
	$output.='[raw]"><div class="member-photo">[/raw]';
	//@since 4.0.4 dev 6 mod by denzel, to fix PHP error. 
	//Note to truethemes team :- Even if variable of function is not used, it has to be assigned empty and cannot be omitted!
	$output.= truethemes_image_frame_constructor($style,"img-preload",$image_path,190,180,$framesize,$lightbox='',$link_to_page,'square',$target='',$description,$lightbox_group='',$float='');
	$output.='[raw]</div><!-- END member-photo -->[/raw]';
	$output.='[raw]<div class="member-bio">[/raw]<h4 class="team-member-name">'.$members_name.'</h4><p class="team-member-title">'.$members_title.'</p>' . do_shortcode($content) . '[raw]</div><!-- END member-bio -->[/raw]';
	
	$output.='[raw]</div><!-- END member-wrap -->[/raw]';
	
return $output;
}
add_shortcode('team_member', 'truethemes_team_member');


/* =================================== */
// TYPOGRAPHY
/* =================================== */
function truethemes_h1( $atts, $content = null ) {
   return '<h1>' . do_shortcode($content) . '</h1>';
} add_shortcode('h1', 'truethemes_h1');

function truethemes_h2( $atts, $content = null ) {
   return '<h2>' . do_shortcode($content) . '</h2>';
} add_shortcode('h2', 'truethemes_h2');

function truethemes_h3( $atts, $content = null ) {
   return '<h3>' . do_shortcode($content) . '</h3>';
} add_shortcode('h3', 'truethemes_h3');

function truethemes_h4( $atts, $content = null ) {
   return '<h4>' . do_shortcode($content) . '</h4>';
} add_shortcode('h4', 'truethemes_h4');

function truethemes_h5( $atts, $content = null ) {
   return '<h5>' . do_shortcode($content) . '</h5>';
} add_shortcode('h5', 'truethemes_h5');

function truethemes_h6( $atts, $content = null ) {
   return '<h6>' . do_shortcode($content) . '</h6>';
} add_shortcode('h6', 'truethemes_h6');

function truethemes_callout1( $atts, $content = null ) {
   return '[raw]<div class="callout-wrap"><span>' . do_shortcode($content) . '</span></div><!-- END callout-wrap --><br class="clear" />
[/raw]';
} add_shortcode('callout1', 'truethemes_callout1');

function truethemes_callout2( $atts, $content = null ) {
   return '[raw]<p class="callout2"><span>' . do_shortcode($content) . '</span></p><br class="clear" />[/raw]';
} add_shortcode('callout2', 'truethemes_callout2');

function truethemes_callout3( $atts, $content = null ) {
   return '[raw]<p class="callout2"><span>' . do_shortcode($content) . '</span></p><br class="clear" />[/raw]';
} add_shortcode('callout2', 'truethemes_callout2');

function truethemes_heading_horz($atts, $content = null) {
  extract(shortcode_atts(array(
  'type'  => 'h3',
  'margin_top'  => '20px',
  'margin_bottom'  => '20px'
  ), $atts));
  
  $output = '[raw]<'.$type.' class="heading-horizontal" style="margin:'.$margin_top.' 0 '.$margin_bottom.' 0;"><span>'. do_shortcode($content) .'</span></'.$type.'>[/raw]';
  return $output;
  
} add_shortcode('heading_horizontal', 'truethemes_heading_horz');

/* =================================== */
// NOTIFY BOXES 
/* =================================== */
function truethemes_notify( $atts, $content = null ) {
  extract(shortcode_atts(array(
  'font_size' => '13px',
  'style' => '',
  'list' => '',
  ), $atts));
  
  return '[raw]<div class="karma_notify message_'.$style.'" style="font-size:'.$font_size.';"><p>' . do_shortcode($content) . '</p></div>[/raw]';

}
add_shortcode('notify_box', 'truethemes_notify');

/* =================================== */
// VIDEO LAYOUT 
/* =================================== */
function truethemes_video_left( $atts, $content = null ) {
   return '[raw]<div class="video-wrap video_left">[/raw]' . do_shortcode($content) . '[raw]</div><!-- END video-wrap -->[/raw]';
}
add_shortcode('video_left', 'truethemes_video_left');

function truethemes_video_right( $atts, $content = null ) {
   return '[raw]<div class="video-wrap video_right">[/raw]' . do_shortcode($content) . '[raw]</div><!-- END video-wrap -->[/raw]';
}
add_shortcode('video_right', 'truethemes_video_right');

function truethemes_video_frame( $atts, $content = null ) {
   return '[raw]<div class="video-main">
	<div class="video-frame">' . do_shortcode($content) . '</div><!-- END video-frame -->
</div><!-- END video-main -->[/raw]';
}
add_shortcode('video_frame', 'truethemes_video_frame');

function truethemes_video_text( $atts, $content = null ) {
   return '[raw]<div class="video-sub">[/raw]' . do_shortcode($content) . '[raw]</div><!-- END video-sub --><br class="clear" />[/raw]';
}
add_shortcode('video_text', 'truethemes_video_text');

/* =================================== */
// TRUETHEMES BLOG POSTS
/* =================================== */

//@since 4.0 - completely re-written shortcode for better optimize
function truethemes_blog_posts($atts, $content=null) {
extract(shortcode_atts(array(
'button_color'    => 'black',
'character_count' => '115',
'count'           => '3',
'image_path'      => '',
'layout'          => '',
'link_text'       => 'Read more',
'linkpost'        => '',
'post_category'   => '',
'style'           => 'modern',
'title'           => '',
'excluded_cat'    => ''
), $atts));

$title            = $title;
$count            = $count;
$truethemes_count = 0;
$truethemes_col   = 0;

//@since ver 4.0.3 dev 5 mod by denzel to use either user input exclude cat or site option exclude cat.
global $post;
if($excluded_cat != ''){
remove_filter('pre_get_posts','wploop_exclude');
$exclude = $excluded_cat;
}else{
add_filter('pre_get_posts','wploop_exclude');
$exclude = B_getExcludedCats();
}


if ($post_category != ''){
//@since mod by denzel to use WP_Query class instead of get_posts, so that WPML works.
$myposts = new WP_Query('posts_per_page='.$count.'&offset=0&category_name='.$post_category.'');
}else{
$myposts = new WP_Query('posts_per_page='.$count.'&offset=0&cat='.$exclude);
}

if($layout == 'default'){
$output = '[raw]<div class="blog-posts-shortcode-outer-wrap"><ul class="tt-recent-posts">[/raw]';
}else{
$output = '[raw]<div class="blog-posts-shortcode-outer-wrap">[/raw]';
}
if ($title != '') {$output .= '<h3>'.$title.'</h3>';};

$truethemes_count = 0;
$truethemes_col   = 0;

//define values below to be used in loop below
if ('default' == $layout){
$image_width     = 65;
$image_height    = 65;
}

if ('two_col_large' == $layout){
$tt_frame_size   = 'two_col_large';
$tt_column_size  = 'one_half';
$tt_column_count = 2;
$image_width     = 437;
$image_height    = 234;
$zoom            = '2';
}

if ('three_col_large' == $layout){
$tt_frame_size   = 'three_col_large';
$tt_column_size  = 'one_third';
$tt_column_count = 3;
$image_width     = 275;
$image_height    = 145;
$zoom            = '3';
}

if ('four_col_large' == $layout){
$tt_frame_size   = 'four_col_large';
$tt_column_size  = 'one_fourth';
$tt_column_count = 4;
$image_width     = 190;
$image_height    = 111;
$zoom            = '4';
}

if ('two_col_small' == $layout){
$tt_frame_size   = 'two_col_small';
$tt_column_size  = 'one_half';
$tt_column_count = 2;
$image_width     = 324;
$image_height    = 180;
$zoom            = '2-small';
}

if ('three_col_small' == $layout){
$tt_frame_size   = 'three_col_small';
$tt_column_size  = 'one_third';
$tt_column_count = 3;
$image_width     = 202;
$image_height    = 113;
$zoom            = '3-small';
}

if ('four_col_small' == $layout){
$tt_frame_size   = 'four_col_small';
$tt_column_size  = 'one_fourth';
$tt_column_count = 4;
$image_width     = 135;
$image_height    = 76;
$zoom            = '4-small';
}
	
if ( $myposts->have_posts() ) : while ( $myposts->have_posts() ) : $myposts->the_post();

$permalink          = get_permalink($post->ID);
$linkpost           = get_post_meta($post->ID, "_jcycle_url_value", $single = true);
$video_url          = get_post_meta($post->ID,'truethemes_video_url',true);
$post_thumb         = null; //declare empty variable to prevent error.
$thumb              = get_post_thumbnail_id(); //featured image
$external_image_url = get_post_meta($post->ID,'truethemes_external_image_url',true); //featured image (external source)
$image_src          = truethemes_crop_image($thumb,$external_image_url,$image_width,$image_height);	
		
if ($linkpost == ''): $truethemeslink = $permalink; else: $truethemeslink = $linkpost; endif;


/*--------------------------------------------*/
/* blog post column layouts
/*--------------------------------------------*/
if ('default' != $layout){

$truethemes_count++;
$truethemes_col ++;
$mod = ($truethemes_count % $tt_column_count == 0) ? 0 : $tt_column_count - $truethemes_count % $tt_column_count;
if($truethemes_col == $tt_column_count){$last = '_last';$truethemes_col = 0;}else{$last = '';}

$output .= '
[raw]<div class="'.$tt_column_size.$last.' tt-column">
	<div class="'.$style.'_img_frame '.$style.'_'.$tt_frame_size.'">
		<div class="img-preload lightbox-img">
			<a href="'.$truethemeslink.'" class="attachment-fadeIn">
				<div class="lightbox-zoom zoom-'.$zoom.' zoom-link" style="position:absolute; display: none;">&nbsp;</div>';

//post thumbnail
if (!empty($image_src)):
$output .= '<img src="'.$image_src.'" alt="'.get_the_title().'" />';

//video embed
elseif(!empty($video_url)):	
$post_thumb .= '<span class="tt-blog-placeholder tt-blog-'.$tt_frame_size.' tt-blog-video">&nbsp;</span>';

//placeholder image
else:
$post_thumb .= '<span class="tt-blog-placeholder tt-blog-'.$tt_frame_size.'">&nbsp;</span>';

endif;
$output .= $post_thumb;
$output .= '</a></div></div>[/raw]';

} //END blog post column layouts



/*--------------------------------------------*/
/* blog post default layout (small thumbs)
/*--------------------------------------------*/
if ('default' == $layout){
	
$output .= '[raw]<li><a class="tt-recent-post-link" title="'.get_the_title().'" href="'.$truethemeslink.'">[/raw]';

//post thumbnail
if (!empty($image_src)):
$output .= '[raw]<img src="'.$image_src.'" alt="'.get_the_title().'" class="tt-blog-sc-img" />[/raw]';

//video embed
elseif(!empty($video_url)):
$output .= '[raw]<span class="tt-blog-placeholder tt-blog-default tt-blog-video tt-blog-sc-img">&nbsp;</span>[/raw]';

//placeholder image
else:
$output .= '[raw]<span class="tt-blog-placeholder tt-blog-default tt-blog-sc-img">&nbsp;</span>[/raw]';
endif; 

} //END blog post default layout (small thumbs)


//remove <!--nextpage--> and show only first page content
$post_content   =  explode('<!--nextpage-->',$post->post_content);
$post_content   =  (string)$post_content[0];
$post_content   =  substr(strip_tags($post_content),0,$character_count);
$post_content   =  rtrim($post_content); //remove space from end of string
$post_content   =  str_replace("<br>","",$post_content);
$post_content   =  strip_shortcodes($post_content); //remove all shortcodes from post content.

$output .= '<h4>'.get_the_title().'</h4>';
$output .= '<p>[raw]'.$post_content.'...[/raw]</p>';

//if ('default' != $layout){ $output .= '[raw]<a href="'.$truethemeslink.'" class="ka_button small_button small_black">'.$link_text.'</a></div>[/raw]';}

if ('default' != $layout){ $output .= '[raw]<a href="'.$truethemeslink.'">'.$link_text.'</a></div>[/raw]';}
if ('default' == $layout){ $output .= '[raw]</a></li>[/raw]'; }

endwhile; endif;
if($layout ==  'default'){
$output .= '[raw]</ul></div><br class="clear" />[/raw]';
}else{
$output .= '[raw]</div><br class="clear" />[/raw]';
}

wp_reset_postdata();
return $output;
}

add_shortcode('blog_posts', 'truethemes_blog_posts');


/* =================================== */
// MISCELLANEOUS
/* =================================== */
/* ----- IFRAME SHORTCODE ----- */
function karma_iframe($atts, $content=null) {
extract(shortcode_atts(array(
'url'   => '',
'width'     => '100%',
'height'    => '500',
), $atts));
 
if (empty($url)) return 'http://';
return '<iframe src="'.$url.'" title="" width="'.$width.'" height="'.$height.'">'.$content.'</iframe>';
}
add_shortcode('iframe','karma_iframe');



/* ----- RELATED POSTS ----- 
* rewrite function - @since version 4.1
* 1) added style option for two types of display, default is 'one', second option is 'two'
* 2) change custom sql query to use WordPress WP_Query 
*/
function related_posts_shortcode( $atts ) {
	extract(shortcode_atts(array(
		'title' 	=> '',
		'limit' 	=> '5',
		'post_id' 	=> '',
		'style' 	=> 'one', //default style one, style two is same as that found in single.php
		'icon' 		=> '<i style="font-size:13px" class="fa fa-file-text-o"></i>', //for style two
		'target'	=> '_blank',
	), $atts));
	
	//prepare html codes that wrap list items output
	$style_one_html_before = "<div class='related_posts'><h4>{$title}</h4><ul class='list list1'>";
	$style_one_html_after = "</ul></div>";
	$style_two_html_before = "<h6 class='heading-horizontal tt-blog-related-post'><span>$icon&nbsp; {$title}</span></h6><ul class='list list1 tt-blog-related-post-list'>";
	$style_two_html_after = "</ul>"; 

	/*
	* if user did not enter post_id in shortcode, 
	* we assign current $post->ID to post_id
	*/
	if(empty($post_id)){
	global $post;
	$post_id = $post->ID;
	}
	
	/*
	* Start grabbing lists of post tag term_id from this post 
	*/
	
	//declare container for tag ids
	$tag_ids = array();
	//grab the tags
	$tags = wp_get_post_tags($post_id);
	//if there are tags found, we push their id into tag_ids container 
	if ($tags) { 
			foreach($tags as $individual_tag) {
			$tag_ids[] = $individual_tag->term_id;
			}
	   }
	   
	   
	//declare output container
	$output = '';
	
	
    /*
    * Start doing database query only if there is tags found.
    */
    
    
    if($tags){
    /*
    * if there are tags found, we grab all posts that has the same tags and print as lists items
    * if not we skip the block of codes enclosed and straight to ## end of function
    */
    
    		//print out html before list item according to style
			if($style=='one'){
			    	$output.= $style_one_html_before;
			    }else{
			    	$output.= $style_two_html_before;
			}
		    
		    //prepare query arguments
		    $args = array(
						'tag__in' => $tag_ids,
						'post__not_in' => array($post_id), //don't include current post.
						'showposts' => $limit,  // number of related posts that will be shown.
						'ignore_sticky_posts' => 1 //do not show sticky posts at the top.
					);
					
			//run the query		
			$related_query = new WP_Query($args);
			
			//the loop 
			if ( $related_query->have_posts() ) {

			    //print out list items
			    while ( $related_query->have_posts() ) {
			    	$related_query->the_post();
			    	$output.= "<li><a href='".get_permalink()."' rel='bookmark' title='".get_the_title()."' target='{$target}'>".get_the_title()."</a></li>";
			    }

			} else {
			    
			    //there are tags in current post but no related posts found
				$output.= "<li>No related posts found.</li>";

			}
			
			
			//print out html after list items according to style
			if($style=='one'){
			    	$output.= $style_one_html_after;
			    }else{
			    	$output.= $style_two_html_after;
			}
			
			//restore original post data
			wp_reset_postdata();

			//everything done, we display on screen.
    		return $output;

    }else{
    
        //## end of function	
     
        //There are no tags found in current posts, so we skip WP_Query and display no related post found.
    	if($style=='one'):
   	    		$output.= $style_one_html_before."<li>No related posts found.</li>".$style_one_html_after;
   	    	else:
	   	    	$output.= $style_two_html_before."<li>No related posts found.</li>".$style_two_html_after;
   	    endif;
   	    
   	    return $output;
    
    }
  
}
add_shortcode('related_posts', 'related_posts_shortcode');



/* ----- RELATED POSTS FOR CONTENT AREA -----
* This shortcode is almost identical to related_posts shortcode defined above.
* due to the fact that both exists in Karma theme for a very long time..
* @since version 4.1 - for backward compatibility, we remove it's code and map this shortcode to run related_posts shortcode.
* function related_posts_content_shortcode.php and add_shortcode('related_posts_content'.. was moved to shortcodes-old.php
*/




/* ----- CATEGORIES ----- */
function truethemes_categorie_display($atts) {
	extract(shortcode_atts(array(
'title'   => 'Categories',
), $atts));
	
	$pos_excluded = positive_exlcude_cats();
	$pos_cats = $pos_excluded;
	$pos_args = array('orderby' => 'name', 'exclude' => $pos_cats, 'title_li' => '');	
	echo '<h3>'.$title.'</h3>';
	wp_list_categories($pos_args);
}
add_shortcode('post_categories', 'truethemes_categorie_display');
?>