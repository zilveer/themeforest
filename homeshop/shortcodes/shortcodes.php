<?php




add_action( 'init', 'sc_button' );
function sc_button() {
	add_filter("mce_external_plugins", "sc_add_buttons");
    add_filter('mce_buttons', 'sc_register_buttons');
}	
function sc_add_buttons($plugin_array) {
	$plugin_array['sc_button'] = get_template_directory_uri() . '/shortcodes/sc_button.js';
	return $plugin_array;
}
function sc_register_buttons($buttons) {
	array_push( $buttons, 'shortcodeButton' ); 
	return $buttons;
}


if ( is_admin() ) {
  
    if ( 
	   ( current_user_can( 'edit_posts' ) 
	   || current_user_can( 'edit_pages' ) ) 
	  && 'true' == get_user_option( 'rich_editing' ) 
    ) {
     add_action( 'admin_footer', 'sc_dialog' );
    }
}

function sc_dialog() {


$content_ios = array (
	'Title'=>'[content_ios_title]Title[/content_ios_title]',
	'Text'=>'[content_ios_text price="$960.00" title1="All the power in your hands!" ]From[/content_ios_text]',
	'Button' => '[but_ios size="big" color="red" url="#" target="_blank" title="Buy Now" ]'
);

$content_video = array (
	'Video' => '[custom_video video_link="" type_video="" ]'
);





//Categories
$categories = array (  			
	'Slider-content' => $content_ios,
	'Video' => $content_video
	);


$page = '';
$i = '0';


	echo '<div  style="display:none;"><div id="my_plugin_dialog">';
	?>
	
		<div id="my_sidebar">
			<div id="my-nav">
				<ul class="sc_activate_nav">
				<?php
					foreach ( $categories as $name => $shortcodes ) {
						$cls = '';
						
						if ( $i == '0') { $cls = ''; }
						echo '<li><a rel="" href="#sc_page_'.$name.'" class="normal '.$cls.'">'.$name.'</a></li>';
					
						
							$page .= '<div id="sc_page_'.$name.'" class="sc_page">';
								$page .= '<h4 class="heading">'.$name.'</h4>';
								foreach ( $shortcodes as $shortcode_name => $shortcode_value ) {
									$page .= '<div class="my_sc_container"><div class="my_sc_title">'.$shortcode_name.'</div><div class="my_shortcode_text">'.$shortcode_value.'</div></div>';
								}
							$page .= '</div>';
						
						$i++;
					}
				?>
				</ul>
			</div>
		</div>	
				<div id="content">
						<?php echo $page;?>
				</div>	
		
	
	<?php
	echo '</div></div>';
}












function custom_featured_video_func( $atts, $content = null ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
	'video_link' => '',
	'type_video' => ''
   ), $atts ) );
 

	$output  = '<!-- Featured Video -->
						<div class="custom-featured-video" style="margin-top:10px;">';
							
					if($type_video == 'youtube') {
		$output  .= '<iframe width="100%" height="315" src="//www.youtube.com/embed/'. $video_link .'?wmode=transparent" allowfullscreen></iframe>';
					}		
					if($type_video == 'vimeo') {
		$output  .= '<iframe width="100%" height="315" src="http://player.vimeo.com/video/'. $video_link .'?js_api=1&amp;js_onLoad=player'. $video_link .'_1798970533.player.moogaloopLoaded" allowfullscreen></iframe>';
					}			
					if($type_video == 'html5') {
		$output  .= '<video width="100%" height="315"  id="home_video_featured" class="entry-video video-js vjs-default-skin" poster="" data-aspect-ratio="2.41" data-setup="{}" controls>
		<source src="'. $video_link .'.mp4" type="video/mp4"/>
	<source src="'. $video_link .'.webm" type="video/webm"/>
	<source src="'. $video_link .'.ogg" type="video/ogg"/></video>';
					}			
							
	$output  .= '</div>
						<!-- /Featured Video -->';
	

   return $output;
}
add_shortcode('custom_video', 'custom_featured_video_func');




















//content_ios///////////////////////////////////////////////////////////////////////////////////////////////

//////content_ios_title//////
function shortcode_content_ios_title( $atts, $content = null ) {
	$res ='';
	$res .= '<div class = "title">
				<h2>' . do_shortcode($content) . '</h2>
			</div>';

	return $res;	
}
add_shortcode('content_ios_title', 'shortcode_content_ios_title');


//content_ios_text////////////////////
function shortcode_content_ios_text( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"price" => '',
		"title1" => ''
	), $atts));
	$res ='';
	$res .= '<div class = "desc">
				<h3>' . $title1 . '</h3>
				<span>' . do_shortcode($content) . ' <span class="price" style="color: #2c3e50 !important;">' . $price . '</span></span>
			</div>';
			
	return $res;	
}
add_shortcode('content_ios_text', 'shortcode_content_ios_text');


//but_ios////////////////////
function shortcode_but_ios( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"size" => '',
		"color" => '',
		"url" => '',
		"target" => '',
		"title" => ''
	), $atts));
	$res ='';
	$res .= '<div class = "button">
				<a class="button ' . $size . ' ' . $color . '" href="' . $url . '" target="' . $target . '" >' . $title . '</a>
			</div>';

	return $res;	
}
add_shortcode('but_ios', 'shortcode_but_ios');


?>