<?php
/*
	Tie Shortcode Module for Tielabs themes
	Version:  1.0.0
*/
define ( 'JS_PATH' , get_template_directory_uri().'/framework/shortcodes/mce.js');

add_action('admin_head', 'tie_add_mce_button');
function tie_add_mce_button() {
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'tie_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'tie_register_mce_button' );
	}
}

// Declare script for new button
function tie_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['tie_mce_button'] = JS_PATH;
	return $plugin_array;
}

// Register new button in the editor
function tie_register_mce_button( $buttons ) {
	array_push( $buttons, 'tie_mce_button' );
	return $buttons;
}

function tie_shortcodes_mce_css() {
	wp_enqueue_style('tie-shortcodes-admin-css',  get_template_directory_uri().'/framework/shortcodes/css/shortcodes.css' );
}
add_action( 'admin_enqueue_scripts', 'tie_shortcodes_mce_css' );


## Ads1 -------------------------------------------------- #
function tie_shortcode_ads1( $atts, $content = null ) {
	$out ='<div class="e3lan e3lan-in-post1">'. htmlspecialchars_decode(tie_get_option( 'ads1_shortcode' )) .'</div>';
   return $out;
}
add_shortcode('ads1', 'tie_shortcode_ads1');


## Ads2 -------------------------------------------------- #
function tie_shortcode_ads2( $atts, $content = null ) {
	$out ='<div class="e3lan e3lan-in-post2">'. htmlspecialchars_decode(tie_get_option( 'ads2_shortcode' )) .'</div>';
   return $out;
}
add_shortcode('ads2', 'tie_shortcode_ads2');


## Boxes -------------------------------------------------- #
function tie_shortcode_box( $atts, $content = null ) {
	$type  = 'shadow';
	$align = $class = $width = '';
	
	if( is_array( $atts ) ) extract($atts);
	
	if( !empty( $width ) )	$width = ' style="width:'.$width.'"';

	$out = '<div class="box '.$type.' '.$class.' '.$align.'"'.$width.'><div class="box-inner-block"><i class="fa tie-shortcode-boxicon"></i>
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('box', 'tie_shortcode_box');


## Lightbox -------------------------------------------------- #
function tie_shortcode_lightbox( $atts, $content = null ) {
	$full = $title = '';
	
    if( is_array( $atts ) ) extract($atts);
	$full = tie_get_video_embed( $full );
	
	$out = '<a class="lightbox-enabled" href="'.$full.'" data-caption="'.$title.'" title="'.$title.'">' .do_shortcode($content). '</a>';
    return $out;
}
add_shortcode('lightbox', 'tie_shortcode_lightbox');


## Toggle -------------------------------------------------- #
function tie_shortcode_toggle( $atts, $content = null ) {
	$state = 'open';
	$title = '';
	
    if( is_array( $atts ) ) extract($atts);

	$out = '<div class="clear"></div><div class="toggle '.$state.'"><h3 class="toggle-head-open">'.$title.'<i class="fa fa-angle-up"></i></h3><h3 class="toggle-head-close">'.$title.'<i class="fa fa-angle-down"></i></h3><div class="toggle-content">
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('toggle', 'tie_shortcode_toggle');


## Author_info -------------------------------------------------- #
function tie_shortcode_author_info( $atts, $content = null ) {
	$title = __ti( 'About the author' );
	$image = '';
	
    if( is_array( $atts ) ) extract($atts);

	$out = '<div class="clear"></div><div class="author-info"><img class="author-img" src="'.$image.'" alt="" /><div class="author-info-content"><h3>'.$title.'</h3>
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('author', 'tie_shortcode_author_info');



## Buttons -------------------------------------------------- #
function tie_shortcode_button( $atts, $content = null ) {
	$size  = 'small';
	$color = 'gray';
	$link  = $button_target = $align = $icon   = '';
	
    if( is_array( $atts ) ) extract($atts);

	if( !empty( $target ) && $target == 'true' ) $button_target = ' target="_blank"';
	if( !empty( $icon ) )   $icon   = '<i class="fa '.$icon.'"></i>';
	
	$out = '<a href="'.$link.'"'.$button_target.' class="shortc-button '.$size.' '.$color.' '.$align.'">'. $icon . do_shortcode($content). '</a>';
    return $out;
}
add_shortcode('button', 'tie_shortcode_button');


## Flickr -------------------------------------------------- #
function tie_shortcode_flickr( $atts, $content = null ) {
	$number  = '5' ;
	$orderby = 'random';
	$id = '';
	$protocol = is_ssl() ? 'https' : 'http';

    if( is_array( $atts ) ) extract($atts);

	$out = '<div class="flickr-wrapper">
	<script type="text/javascript" src="'.$protocol.'://www.flickr.com/badge_code_v2.gne?count='. $number .'&amp;display='. $orderby .'&amp;size=s&amp;layout=x&amp;source=user&amp;user='. $id .'"></script>
	</div>';       

    return $out;
}
add_shortcode('flickr', 'tie_shortcode_flickr');


## Feeds -------------------------------------------------- #
function tie_shortcode_feeds( $atts, $content = null ) {
	$number  = '5';
	$url = '';
	
    if( is_array( $atts ) ) extract($atts);
	
	return tie_get_feeds( $url , $number );
}
add_shortcode('feed', 'tie_shortcode_feeds');


## Google Map -------------------------------------------------- #
function tie_shortcode_googlemap( $atts, $content = null ) {
	$width  = '620' ;
	$height = '440';
	$align = $src = '';
	
	if( is_array( $atts ) ) extract($atts);

	return tie_google_maps( $src , $width, $height , $align  );
}
add_shortcode('googlemap', 'tie_shortcode_googlemap');


## is_logged_in shortcode -------------------------------------------------- #
function tie_shortcode_is_logged_in( $atts, $content = null ) {
	global $user_ID ;
	if( $user_ID )
		return do_shortcode($content) ;
}
add_shortcode('is_logged_in', 'tie_shortcode_is_logged_in');

## is_guest shortcode -------------------------------------------------- #
function tie_shortcode_is_guest( $atts, $content = null ) {
	global $user_ID ;
	if( !$user_ID  )
		return do_shortcode($content) ;
}
add_shortcode('is_guest', 'tie_shortcode_is_guest');


## Follow Twitter -------------------------------------------------- #
function tie_shortcode_follow( $atts, $content = null ) {
	$count = "false";
	$id = $size  = '';
	
    if( is_array( $atts ) ) extract($atts);

	if( $size == "large" ) $size = 'data-size="large"' ;
	if( $count == "true" ) $count = "true" ;
	$protocol = is_ssl() ? 'https' : 'http';

	$out = '
	<a href="$protocol://twitter.com/'. $id .'" class="twitter-follow-button" data-show-count="'.$count.'" '.$size.'>Follow @'. $id .'</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';       

    return $out;
}
add_shortcode('follow', 'tie_shortcode_follow');


## ToolTip  -------------------------------------------------- #
function tie_shortcode_Tooltip( $atts, $content = null ) {
	$text = $gravity = '';
	
    if( is_array( $atts ) ) extract($atts);

	$out = '<span class="post-tooltip tooltip-'.$gravity.'" title="'.$content.'">'.$text.'</span>';
   return $out;
}
add_shortcode('tooltip', 'tie_shortcode_Tooltip');


## highlight -------------------------------------------------- #
function tie_highlight_shortcode( $atts, $content = null ) {
	$color = 'yellow';

    if( is_array( $atts ) ) extract($atts);
	
    return '<span class="highlight highlight-'.$color.'">'.$content.'</span>';  
}  
add_shortcode("highlight", "tie_highlight_shortcode");  


## Full Width Images ------------------------------------------ #
function tie_full_width_img_shortcode( $atts, $content = null ) {
    return '<div class="tie-full-width-img">'.$content.'</div>';  
}  
add_shortcode("tie_full_img", "tie_full_width_img_shortcode");  


## Dropcap  -------------------------------------------------- #
function tie_dropcap_shortcode( $atts, $content = null ) { 
	$type = '';

    if( is_array( $atts ) ) extract($atts);
	
    return '<span class="dropcap '.$type.'">'.$content.'</span>';  
}  
add_shortcode("dropcap", "tie_dropcap_shortcode");  


## tie_list  -------------------------------------------------- #
function tie_shortcode_tie_list( $atts, $content = null ) {
	$type = 'checklist';
	
    if( is_array( $atts ) ) extract($atts);

    return '<div class="'.$type.' tie-list-shortcode">'.do_shortcode($content).'</div>';  
}
add_shortcode('tie_list', 'tie_shortcode_tie_list');

## checklist | Old Versions replaced with tie_list ------------ #
function tie_checklist_shortcode( $atts, $content = null ) {  
    return '<div class="checklist tie-list-shortcode">'.do_shortcode($content).'</div>';  
}  
add_shortcode("checklist", "tie_checklist_shortcode");


## starlist | Old Versions replaced with tie_list  -------------- #
function tie_starlist_shortcode( $atts, $content = null ) {  
    return '<div class="starlist tie-list-shortcode">'.do_shortcode($content).'</div>';  
}  
add_shortcode("starlist", "tie_starlist_shortcode");


## Facebook -------------------------------------------------- #
function tie_facebook_shortcode( $atts, $content = null ) { 
	global $post;
	$protocol = is_ssl() ? 'https' : 'http';

    return '<iframe src="'.$protocol.'://www.facebook.com/plugins/like.php?href='. get_permalink($post->ID) .'&amp;layout=box_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;font&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:65px;" allowTransparency="true"></iframe>';  
}  
add_shortcode("facebook", "tie_facebook_shortcode");


## Tweet -------------------------------------------------- #
function tie_tweet_shortcode( $atts, $content = null ) { 
	global $post;
	$protocol = is_ssl() ? 'https' : 'http';

    return '<a href="'.$protocol.'://twitter.com/share" class="twitter-share-button" data-url="'. get_permalink($post->ID) .'" data-text="'. get_the_title($post->ID) .'" data-via="'. tie_get_option( 'share_twitter_username' ) .'" data-lang="en" data-count="vertical" >tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';  
}  
add_shortcode("tweet", "tie_tweet_shortcode");


## Digg -------------------------------------------------- #
function tie_digg_shortcode( $atts, $content = null ) { 
	global $post;
	$protocol = is_ssl() ? 'https' : 'http';

    return "
	<script type='text/javascript'>
(function() {
var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
s.type = 'text/javascript';
s.async = true;
s.src = '".$protocol."://widgets.digg.com/buttons.js';
s1.parentNode.insertBefore(s, s1);
})();
</script><a class='DiggThisButton DiggMedium' href='http://digg.com/submit?url". get_permalink($post->ID) ."=&amp;title=". get_the_title($post->ID) ."'></a>";  
}  
add_shortcode("digg", "tie_digg_shortcode");


## stumble -------------------------------------------------- #
function tie_stumble_shortcode( $atts, $content = null ) { 
	global $post;
    return "<su:badge layout='5' location='". get_permalink($post->ID) ."'></su:badge>
<script type='text/javascript'>
  (function() {
    var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
    li.src = 'https://platform.stumbleupon.com/1/widgets.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
  })();
</script>";  
}  
add_shortcode("stumble", "tie_stumble_shortcode");


## pinterest -------------------------------------------------- #
function tie_pinterest_shortcode( $atts, $content = null ) { 
	global $post;
    return '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
	<a href="http://pinterest.com/pin/create/button/?url='.get_permalink($post->ID).'&amp;media='.tie_thumb_src( 'slider' ).' class="pin-it-button" count-layout="vertical"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';
 
}  
add_shortcode("pinterest", "tie_pinterest_shortcode");



## Google + -------------------------------------------------- #
function tie_google_shortcode( $atts, $content = null ) { 
	global $post;
    return "<g:plusone size='tall'></g:plusone>
<script type='text/javascript'>
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
";  
}  
add_shortcode("Google", "tie_google_shortcode");


## feedburner -------------------------------------------------- #
function tie_feedburner_shortcode( $atts, $content = null ) { 
    if( is_array( $atts ) ) extract($atts);
    return '<a href="http://feeds.feedburner.com/'.$name.'"><img src="http://feeds.feedburner.com/~fc/'.$name.'?anim=1" height="26" width="88" style="border:0" alt="" /></a>';  
}  
add_shortcode("feedburner", "tie_feedburner_shortcode");


## Tabs -------------------------------------------------- #
function tie_shortcode_post_slideshow( $atts, $content = null ) {
	
    wp_enqueue_script( 'tie-cycle' );
	$tie_random_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

	$out ='
	<script type="text/javascript">
	jQuery(window).load(function() {
	
			jQuery( "#post-slideshow-'.$tie_random_id.'" ).cycle({
				fx:     "scrollHorz",
				timeout: 0,
				pager:  ".slideshow-nav-'.$tie_random_id.'",
				after:  onBefore,
				containerResize  : false,
				slideResize: false,
				fit:           1, 
				slideExpr: ".post-content-slide",
				speed: 400,
				prev:   ".prev-'.$tie_random_id.'", 
				next:   ".next-'.$tie_random_id.'",
			});
	
	function onBefore() { 
		var h = jQuery(this).outerHeight() ;
		jQuery(this).parent().height( h ); 
	}
  });
</script>

<div class="post-content-slideshow-outer">
	<div id="post-slideshow-'.$tie_random_id.'" class="post-content-slideshow">
	
		<div class="post-tslideshow-nav-outer">
			<div class="slideshow-nav-'.$tie_random_id.' post-slideshow-nav"></div>
			<a class="next-'.$tie_random_id.' post-slideshow-next" href="#"> '. __ti( "Next" ) .' <i class="fa fa-angle-right"></i></a>
			<a class="prev-'.$tie_random_id.' post-slideshow-prev" href="#"><i class="fa fa-angle-left"></i> '. __ti( "Prev" ) .'</a>
		</div><!-- post-tslideshow-nav-outer -->
		'.
		do_shortcode($content)
		.'
		<div class="post-tslideshow-nav-outer-bottom">
			<div class="slideshow-nav-'.$tie_random_id.' post-slideshow-nav"></div>
			<a class="next-'.$tie_random_id.' post-slideshow-next" href="#">'. __ti( 'Next' ) .' <i class="fa fa-angle-right"></i></a>
			<a class="prev-'.$tie_random_id.' post-slideshow-prev" href="#"><i class="fa fa-angle-left"></i> '. __ti( "Prev" ) .'</a>
		</div><!-- post-tslideshow-nav-outer-bottom -->
		
		
	</div><!-- post-content-slideshow -->
</div><!-- post-content-slideshow-outer -->';
   return $out;
}
add_shortcode('tie_slideshow', 'tie_shortcode_post_slideshow');


## Tab -------------------------------------------------- #
function tie_shortcode_post_slide( $atts, $content = null ) {
	$out ='
		<div class="post-content-slide">
		'.do_shortcode($content).'
		</div><!-- post-content-slide -->
	';
   return $out;
}
add_shortcode('tie_slide', 'tie_shortcode_post_slide');


## Tabs -------------------------------------------------- #
function tie_shortcode_tabs( $atts, $content = null ) {
	$type= '';
	
    if( is_array( $atts ) ) extract($atts);
	
	$class_type = 'post-tabs';
	if( $type == "vertical" ) $class_type = 'post-tabs-ver';
		
    wp_enqueue_script( 'tie-tabs' );

	$out ='
	<script type="text/javascript">	jQuery(document).ready(function($){	jQuery("ul.tabs-nav").tabs("> .pane"); }); </script>

		<div class="'.$class_type.'">
		'.do_shortcode($content).'
		</div>
	';
   return $out;
}
add_shortcode('tabs', 'tie_shortcode_tabs');


## Tab -------------------------------------------------- #
function tie_shortcode_tab( $atts, $content = null ) {
	$out ='
		<div class="pane">
		'.do_shortcode($content).'
		</div>
	';
   return $out;
}
add_shortcode('tab', 'tie_shortcode_tab');


## Tab Head -------------------------------------------------- #
function tie_shortcode_tabs_head( $atts, $content = null ) {
	$out ='<ul class="tabs-nav">'.do_shortcode($content).'</ul>';
   return $out;
}
add_shortcode('tabs_head', 'tie_shortcode_tabs_head');


## Tab_title -------------------------------------------------- #
function tie_shortcode_tab_title( $atts, $content = null ) {
	$out ='<li>'.do_shortcode($content).'</li>';
   return $out;
}
add_shortcode('tab_title', 'tie_shortcode_tab_title');


## Divider -------------------------------------------------- #
function tie_shortcode_divider( $atts, $content = null ) {
	$style = 'normal';
	$top = $bottom = '10';
	
    if( is_array( $atts ) ) extract($atts);
	
	$out ='<div class="clear"></div><div style="margin-top:'.$top.'px; margin-bottom:'.$bottom.'px;" class="divider divider-'.$style.'"></div>';
   return $out;
}
add_shortcode('divider', 'tie_shortcode_divider');


## Padding -------------------------------------------------- #
function tie_shortcode_padding( $atts, $content = null ) {
	$left = $right = '10%';

    if( is_array( $atts ) ) extract($atts);
	
	$out ='<div class="tie-padding" style="padding-left:'.$left.'; padding-right:'.$right.';">'.do_shortcode($content).'</div>';
   return $out;
}
add_shortcode('padding', 'tie_shortcode_padding');


## Columns  -------------------------------------------------- #
function tie_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'tie_one_third');

function tie_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'tie_one_third_last');

function tie_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'tie_two_third');

function tie_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'tie_two_third_last');

function tie_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'tie_one_half');

function tie_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'tie_one_half_last');

function tie_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'tie_one_fourth');

function tie_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'tie_one_fourth_last');

function tie_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'tie_three_fourth');

function tie_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'tie_three_fourth_last');

function tie_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'tie_one_fifth');

function tie_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'tie_one_fifth_last');

function tie_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'tie_two_fifth');

function tie_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'tie_two_fifth_last');

function tie_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'tie_three_fifth');

function tie_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'tie_three_fifth_last');

function tie_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'tie_four_fifth');

function tie_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'tie_four_fifth_last');

function tie_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'tie_one_sixth');

function tie_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'tie_one_sixth_last');

function tie_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'tie_five_sixth');

function tie_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'tie_five_sixth_last');
?>