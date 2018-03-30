<?php 
/**
* Theme Shortcodes.
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/
/**
*  Buttons
*********************************************/

add_shortcode("button","van_button");
function van_button($atts,$content = null){

	extract(shortcode_atts( array("color" => "green", "size" => "small","style"=>"round", "align" => "none", "link"  => "", "target"=> "" ),$atts ));

	$output = '<span class="button-container button-' . $align . '"><a href="' . esc_url( $link ) . '" target="' . $target . '" class="short-buttons button-' . $color . ' button-' . $size . ' button-' . $style . '">'.$content.'</a></span>';
	
	return $output;
}

/**
*  Messages Boxes
*********************************************/

add_shortcode("box","van_short_boxes");
function van_short_boxes($atts, $content = null){

	extract(shortcode_atts( array("type"   => "","width"  => "100%"),$atts ));

	$output = '<div class="msg-boxes ' . $type . '-msg" style="width:' . $width . '"><span></span>'.$content.'<div class="clear"></div></div>';
	
	return $output;
}

/**
*  Videos
*********************************************/

add_shortcode("video","van_short_video");
function van_short_video($atts){

	extract(shortcode_atts( array("src"   => "","size"=>"","width" => "","height"=> ""),$atts ));
	
	if ( $size == "auto" ) {
		
		if ( van_video_embed_url(640,320,$src) ) 
			$output = '<div class="short-resp-container"><div class="short-resp">' . van_video_embed_url(640,320,$src) . '</div></div>';

	}else{
		
		if ( van_video_embed_url($width,$height,$src) ) 
			$output = '<div style="width:'.$width.'px;height:'.$height.'px;margin:0 auto;">' . van_video_embed_url($width,$height,$src) . '</div>';
	}
	return $output;
}

/**
*  Much login to view content
*********************************************/

add_shortcode( 'private', 'van_private_content' );
function van_private_content( $atts, $content = null ) {
	if ( is_user_logged_in() && !is_null( $content ) && !is_feed() ){

		$output = '<p>' . $content . '</p>';

	}else{
		$args = array('echo' => false,'redirect' =>  get_permalink(), 'label_username' => __( 'Username', 'van' ),'label_password' => __( 'Password', 'van' ),'label_remember' => __( 'Remember Me', 'van' ),'label_log_in' => __( 'Log In', 'van' ) );
		$output = '<div id="loginform-container" style="max-width: 300px;margin: 0 auto;"><p style=" text-align: center; ">' . __("You Much Login to view this content", "van") . '</p><p class="error-message"></p> ' . wp_login_form( $args ) . ' </div>';
	}
		
	return $output;
}
/**
*  Flickr
*********************************************/

add_shortcode('flickr', 'van_short_flickr');
function van_short_flickr( $atts, $content = null ) {

	extract(shortcode_atts( array("id"  => "","number"  => "5","order"   => "random"),$atts ));

	$output = '<div class="flickr"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='. $number .'&amp;display='. $order .'&amp;size=s&amp;layout=x&amp;source=user&amp;user='. $id .'"></script><div class="clear"></div></div>';       

	return $output;

}

/**
*  Twitter
*********************************************/

add_shortcode('twitter', 'van_short_twitter');
function van_short_twitter( $atts, $content = null ) {

	extract(shortcode_atts( array("number"  => "5"),$atts ));

	$output = van_recent_tweets( $number );   

	return $output;
}

/**
*  Tooltip
*********************************************/

add_shortcode('tooltip', 'van_short_Tooltip');
function van_short_Tooltip( $atts, $content = null ) {

	extract(shortcode_atts( array("text"    => "","gravity" => "s"),$atts ));

	$output = '<span class="short-tooltip tooltip-'.$gravity.'" title=" '. htmlentities( $content ) . ' ">'.$text.'</span>';
	
	return $output;
}

/**
*  Google Map
*********************************************/

add_shortcode('googlemap', 'van_short_googlemap');
function van_short_googlemap( $atts ) {
	extract(shortcode_atts(array('src'    => '', 'embed' => '' ,'size'=>'','width' => '640','height' => '320'), $atts));

	$code = "";
	
	if ( !empty( $src ) ) {
		$code =van_embed_code($src . '&amp;output=embed', $width, $height, 'overflow:hidden;', '');
	}elseif( !empty( $embed ) ) {
		$code = $embed;
	}
	
	if ( $size == "auto" ) {
		
		$output = '<div class="short-resp-container"><div class="short-resp">' . $code . '</div></div>';

	}else{

		$output = '<div style="width:' . $width . 'px;height:' . $height . 'px;margin:0 auto;">' . $code . '</div>';
	}
	return $output;
}

/**
*  Toggle Box
*********************************************/

add_shortcode('toggle', 'van_shor_toggle');
function van_shor_toggle( $atts, $content = null ) {

	extract(shortcode_atts(array('title'    => '','state'    => 'close'), $atts));

	$output = '<div class="toggle"><h3><a class="toggle-' . $state . '" href="#"><span></span>' . $title . '</a></h3><div class="toggle-content  toggle-'.$state.'">' . do_shortcode($content) . '</div></div>';
	
	return $output;
}

/**
*  Tabs
*********************************************/

add_shortcode('tabs', 'van_shor_tabs');
function van_shor_tabs( $atts, $content = null ) {

	$GLOBALS['tabs_num'] = 0;
	do_shortcode($content);

	if( is_array( $GLOBALS['tabs'] ) ){
		$tab_control = array();
		$tab_content = array();
		$i = 1;
		foreach( $GLOBALS['tabs'] as $tab ){
			$tab_control[]    = '<li><a href="#">'.$tab['title'].'</a></li>';
			$tab_content[]     = '<div class="tab-content">' .$tab['content'].'</div>';
			$i++;
		}
		$output = '<div class="tabs-container"><ul class="tabs-controls">' . implode( "", $tab_control ) . '</ul><div class="clear"></div>' . implode( "", $tab_content ) . '</div>';
	}
	return $output;
}

add_shortcode('tab', 'van_shor_tab');
function van_shor_tab( $atts, $content = null ) {

	extract( shortcode_atts( array('title' => ''), $atts ) );

	$i = $GLOBALS['tabs_num'];

	$GLOBALS['tabs'][$i] = array( 'title' => sprintf( $title, $GLOBALS['tabs_num'] ), 'content' =>  $content );
	
	$GLOBALS['tabs_num']++;
}

/**
*   Accordions 
********************************************/
add_shortcode('accordions', 'van_shor_accordions');
function van_shor_accordions( $atts, $content = null ) {

	$GLOBALS['accordions_num'] = 0;
	do_shortcode($content);

	if( is_array( $GLOBALS['accordions'] ) ){
		$accordion_output = array();
		$i = 1;
		foreach( $GLOBALS['accordions'] as $accordion ){
			$accordion_output[]   = '<h4 class="accordion-control"><a href="#"><span></span>'.$accordion['title'].'</a></h4><div class="accordion-content">' .$accordion['content'].'</div>';
			$i++;
		}
		$output = '<div class="accordions-container">' . implode( "", $accordion_output ) . '<div class="clear"></div></div>';
	}
	return $output;
}

add_shortcode('accordion', 'van_shor_accordion');
function van_shor_accordion( $atts, $content = null ) {

	extract( shortcode_atts( array('title' => ''), $atts ) );

	$i = $GLOBALS['accordions_num'];

	$GLOBALS['accordions'][$i] = array( 'title' => sprintf( $title, $GLOBALS['accordions_num'] ), 'content' =>  $content );
	
	$GLOBALS['accordions_num']++;
}

/**
*  Author box
*********************************************/

add_shortcode('author', 'van_short_author');
function van_short_author( $atts, $content = null ) {

	extract(shortcode_atts(array('type' => '','username' => '','name'=>'','avatar'=>''), $atts));
	
	$output = "";

	if( $type == "registered" ){

		$user_info = get_user_by( 'login', $username );

		if( isset( $user_info->ID ) && $user_info->ID ){

			$output = '<div class="short-author-box"><h3 class="box-title">' . __( 'About ', 'van' ) . '<span>' . $username . '</span></h3><div class="box-content"><div class="author-avatar">' . get_avatar( $user_info->ID, 64 ) . '</div><div class="author-desc">' . get_the_author_meta( 'description', $user_info->ID ) . '</div><div class="clear"></div></div><!-- box-content --></div> <!-- author-box -->';
		
		}
		
	}else{
		$output = '<div class="short-author-box"><h3 class="box-title">' . __( 'About ', 'van' ) . '<span>' . $name . '</span></h3><div class="box-content"><div class="author-avatar"><img class="author-img" src="'.$avatar.'" alt="' . $name . '" width="64" height="64" /></div><div class="author-desc">' . do_shortcode($content) . '</div><div class="clear"></div></div><!-- box-content --></div> <!-- author-box -->';
	}


	return $output;
}

/**
*  Check List
*********************************************/

add_shortcode("checklist", "van_short_checklist");

function van_short_checklist( $atts, $content = null ) {  

	return '<div class="checklist">'.do_shortcode($content).'</div>';  

} 

/**
*  Error List
*********************************************/

add_shortcode("errorlist", "van_short_errorlist");
function van_short_errorlist( $atts, $content = null ) { 

	return '<div class="errorlist">'.do_shortcode($content).'</div>';  

} 
/**
*  Bullet List
*********************************************/

add_shortcode("bulletlist", "van_short_bulletlist");
function van_short_bulletlist( $atts, $content = null ) { 

	return '<div class="bulletlist">'.do_shortcode($content).'</div>';  

} 
/**
* DropCap 
*********************************************/
add_shortcode("dropcap", "van_short_dropcap");
function van_short_dropcap( $atts, $content = null ) {  

	extract(shortcode_atts(array('color' => '#454545'), $atts));

	return '<span class="dropcap" style="color:' . $color . '" >'.$content.'</span>';  

}  

/**
* highlight 
*********************************************/

add_shortcode("highlight", "van_short_highlight");
function van_short_highlight( $atts, $content = null ) {  

	extract(shortcode_atts(array('color' => '#454545', 'background' => '#ffd500'), $atts));

	return '<span class="highlight" style="color:' . $color . ';background:' . $background . '" >'.$content.'</span>';  

}  

/**
* Columns
*********************************************/

add_shortcode('one_third', 'van_one_third');
function van_one_third( $atts, $content = null ) {

	return '<div class="one_third">' . do_shortcode($content) . '</div>';

}

add_shortcode('one_third_last', 'van_one_third_last');
function van_one_third_last( $atts, $content = null ) {

	return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}

add_shortcode('two_third', 'van_two_third');
function van_two_third( $atts, $content = null ) {

	return '<div class="two_third">' . do_shortcode($content) . '</div>';

}

add_shortcode('two_third_last', 'van_two_third_last');
function van_two_third_last( $atts, $content = null ) {

	return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}

add_shortcode('one_half', 'van_one_half');
function van_one_half( $atts, $content = null ) {

	return '<div class="one_half">' . do_shortcode($content) . '</div>';

}

add_shortcode('one_half_last', 'van_one_half_last');
function van_one_half_last( $atts, $content = null ) {

	return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}

add_shortcode('one_fourth', 'van_one_fourth');
function van_one_fourth( $atts, $content = null ) {

	return '<div class="one_fourth">' . do_shortcode($content) . '</div>';

}

add_shortcode('one_fourth_last', 'van_one_fourth_last');
function van_one_fourth_last( $atts, $content = null ) {

	return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}

add_shortcode('three_fourth', 'van_three_fourth');
function van_three_fourth( $atts, $content = null ) {

	return '<div class="three_fourth">' . do_shortcode($content) . '</div>';

}

add_shortcode('three_fourth_last', 'van_three_fourth_last');
function van_three_fourth_last( $atts, $content = null ) {

	return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}

add_shortcode('one_fifth', 'van_one_fifth');
function van_one_fifth( $atts, $content = null ) {

	return '<div class="one_fifth">' . do_shortcode($content) . '</div>';

}

add_shortcode('one_fifth_last', 'van_one_fifth_last');
function van_one_fifth_last( $atts, $content = null ) {

	return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}

add_shortcode('two_fifth', 'van_two_fifth');
function van_two_fifth( $atts, $content = null ) {

	return '<div class="two_fifth">' . do_shortcode($content) . '</div>';

}

add_shortcode('two_fifth_last', 'van_two_fifth_last');
function van_two_fifth_last( $atts, $content = null ) {

	return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}

add_shortcode('three_fifth', 'van_three_fifth');
function van_three_fifth( $atts, $content = null ) {

	return '<div class="three_fifth">' . do_shortcode($content) . '</div>';

}

add_shortcode('three_fifth_last', 'van_three_fifth_last');
function van_three_fifth_last( $atts, $content = null ) {

	return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}

add_shortcode('four_fifth', 'van_four_fifth');
function van_four_fifth( $atts, $content = null ) {

	return '<div class="four_fifth">' . do_shortcode($content) . '</div>';

}

add_shortcode('four_fifth_last', 'van_four_fifth_last');
function van_four_fifth_last( $atts, $content = null ) {

	return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}

add_shortcode('one_sixth', 'van_one_sixth');
function van_one_sixth( $atts, $content = null ) {

	return '<div class="one_sixth">' . do_shortcode($content) . '</div>';

}

add_shortcode('one_sixth_last', 'van_one_sixth_last');
function van_one_sixth_last( $atts, $content = null ) {

	return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}

add_shortcode('five_sixth', 'van_five_sixth');
function van_five_sixth( $atts, $content = null ) {

	return '<div class="five_sixth">' . do_shortcode($content) . '</div>';

}

add_shortcode('five_sixth_last', 'van_five_sixth_last');
function van_five_sixth_last( $atts, $content = null ) {


	return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}

/**
* Ads 
*********************************************/

add_shortcode("ads","van_short_ads");
function van_short_ads($atts){
	$banner_type   = van_get_option("short_banner_type");
	$banner_img    = van_get_option("short_banner_img");
	$banner_target = van_get_option("short_banner_tab");
	$banner_link   = van_get_option("short_banner_link");
	$banner_code   = van_get_option("short_banner_ads",true);
	$output = '<div class="shortcode-ads" style="width:468px;margin:0 auto;">';

	if($banner_type  == "image"){
		if( $banner_img ){
			$target = ( $banner_target ) ? "target='_blank'" : "";
			$output .= '<a href="' . esc_url( $banner_link ) . '" '.$target.' ><img src="'.$banner_img.'" width="468" height="68" /></a>';
		}
	}elseif ( $banner_type == "ads_code" ){
		if( $banner_code ){ $output .= $banner_code; }
	}
	$output .= '</div>';	
	return $output;
}
/**
* Divider
***************************************************/

add_shortcode("divider", "van_short_divider");
function van_short_divider( $atts ) {  

	return '<span class="short-divider"></span>';  

}  
/**
* Clear
***************************************************/

add_shortcode("clear", "van_short_clear");
function van_short_clear( $atts ) {  

	return '<div class="clear"></div>';  

}
/**
* Social Shares
***************************************************/

add_shortcode("social", "van_short_social");
function van_short_social( $atts ) {  

	extract(shortcode_atts(array(		
		"link_ops" => "post",
		"link"	 => "",
		"counter" => "",
		"fb" => "",
		"twitter" => "",
		"gplus" => "",
		"linkedin" => "",
		"pinterest" => "",
		"twitter_follow" => "",
		"twitter_name" => "",
		"fb_page" => "",
		"fb_url" => "",
		"feedburner" => "",
		"feed_name" => ""), $atts));

	$share_link = ( $link_ops == "post" ) ? get_permalink() : esc_url( $link );
	$twitter_count = $counter ? 'vertical' : 'none';
	$fb_count = $counter ? 'box_count' : 'standard';
	$linkedin_count = $counter ? 'top' : 'none';
	$gplus_count = $counter ? '' : 'data-annotation="none"';
	$height          = $counter ? '61' : '30';

	$output       = '<div class="short-social">'; 
	
	if ( $twitter ){
		$output .= '<div style="float:left;height: ' . $height . 'px;margin-right: 10px;"><a href="' . esc_url('https://twitter.com/share') . '" class="twitter-share-button" data-url="' . $share_link . '" data-count="' . $twitter_count . '">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>';
	}if ( $gplus ) {
		$output .= '<div style="float:left;height: ' . $height . 'px;margin-right: 10px;"><div class="g-plusone" data-size="tall" ' . $gplus_count . ' data-href="' . $share_link . '"></div><script type="text/javascript">(function() { var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;po.src = \'https://apis.google.com/js/plusone.js\';var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);})();</script></div>';
	}if ( $linkedin ) {
		$output .= '<div style="float:left;height: ' . $height . 'px;margin-right: 10px;"><script src="//platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="' . $share_link . '"  data-counter="' . $linkedin_count . '"></script></div>';
	}if ( $fb ) {
		$output .= '<div style="float:left;height: ' . $height . 'px;margin-right: 10px;">' . van_embed_code('http://www.facebook.com/plugins/like.php?href=' . $share_link . '&amp;send=false&amp;layout=' . $fb_count . '&amp;width=25&amp;show_faces=false&amp;font=arial&amp;colorscheme=light&amp;action=like&amp;height=65', '55', '65', 'overflow:hidden;width:55px;height:65px;', '') . '</div>';
	}if ( $twitter_follow && $twitter_name != "") {
		$output .= '<div style="float:left;height: ' . $height . 'px;margin-right: 10px;"><a href="' . esc_url( 'https://twitter.com/' . $twitter_name ) . '" class="twitter-follow-button" data-show-count="false">Follow @' . $twitter_name . '</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script></div>';
	}if ( $feedburner && $feed_name != "") {
		$output .= '<div style="float:left;height: ' . $height . 'px;margin-right: 10px;"><a href="'. esc_url( 'http://feeds.feedburner.com/' . $feed_name ) .'"><img width="88" height="26" alt="Feedburner feed counter" src="http://feeds.feedburner.com/~fc/thesistheme?bg=2361a1&amp;fg=ffffff&amp;anim=0"/></a></div>';
	}if ( $fb_page  && $fb_url !="") {
		$output .= '<div style="float:left;">' . van_embed_code('http://www.facebook.com/plugins/likebox.php?href=' . esc_url( $fb_url ) . '&amp;width=100&amp;height=62&amp;show_faces=false&amp;colorscheme=light&amp;stream=false&amp;show_border=false&amp;header=false&amp;appId=121518931330729', '260', '62', 'overflow:hidden;width:260px;height:62px;background:transparent;', '') . '</div>';
	}
	$output .= '<div class="clear"></div></div> <!-- .short-social-->';

	return $output;
}