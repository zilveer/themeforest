<?php 

/*

We store our shortcodes in an array ready for processing

*/

$theme_shortcodes = array (

	array ("id" => "two_column",
	"name" => __("Two Columns", "alive"),
	"shortcode_name" => "two_column",
	"attributes" => "",
	"content_required" => true,
	"custom_output" => "[two_column]First Column[/two_column] [two_column_last]Second Column[/two_column_last]"
	),

	array ("id" => "three_column",
	"name" => __("Three Columns", "alive"),
	"shortcode_name" => "three_column",
	"attributes" => "",
	"content_required" => true,
	"custom_output" => "[three_column]First Column[/three_column] [three_column]Second Column[/three_column] [three_column_last]Third Column[/three_column_last]"
	),

	array ("id" => "four_column",
	"name" => __("Four Columns", "alive"),
	"shortcode_name" => "four_column",
	"attributes" => "",
	"content_required" => true,
	"custom_output" => "[four_column]First Column[/four_column] [four_column]Second Column[/four_column] [four_column]Third Column[/four_column] [four_column_last]Fourth Column[/four_column_last]"
	),

	array ("id" => "two_third_column",
	"name" => __("Two Third Columns", "alive"),
	"shortcode_name" => "two_third_column",
	"attributes" => "",
	"content_required" => true,
	"custom_output" => "[two_third_column]First Column[/two_third_column] [three_column_last]Second Column[/three_column_last]"
	),

	array ("id" => "blockquote",
	"name" => __("Blockquote", "alive"),
	"shortcode_name" => "blockquote",
	"attributes" => array (
	
		array ("id" => "quoted_by",
		"name" => "Quoted By",
		"desc" => "The name of the person who made the quote."
		),

	),
	"content_required" => true,
	"custom_output" => null
	),

	array ("id" => "blockquote_left",
	"name" => __("Blockquote Left", "alive"),
	"shortcode_name" => "blockquote_left",
	"attributes" => array (
	
		array ("id" => "quoted_by",
		"name" => "Quoted By",
		"desc" => "The name of the person who made the quote."
		),

	),
	"content_required" => true,
	"custom_output" => null
	),

	array ("id" => "blockquote_right",
	"name" => __("Blockquote Right", "alive"),
	"shortcode_name" => "blockquote_right",
	"attributes" => array (
	
		array ("id" => "quoted_by",
		"name" => "Quoted By",
		"desc" => "The name of the person who made the quote."
		),

	),
	"content_required" => true,
	"custom_output" => null
	),

	array ("id" => "button",
	"name" => __("Button", "alive"),
	"shortcode_name" => "button",
	"attributes" => array (

		array ("id" => "link",
		"name" => "Button Link",
		"desc" => "The link associated with the button."
		),	
		array ("id" => "size",
		"name" => "Button Size",
		"desc" => "The size of the button: small, medium or large."
		),
		array ("id" => "color",
		"name" => "Button Color",
		"desc" => "The color of the button: teal, navy, red, magenta, orange, yellow, green, black, white."
		),
		

	),
	"content_required" => true,
	"custom_output" => null
	),

	array ("id" => "fancybox_image",
	"name" => __("Fancybox Image", "alive"),
	"shortcode_name" => "fancybox_image",
	"attributes" => array (
	
		array ("id" => "image_url",
		"name" => "Thumbnail URL",
		"desc" => "The url of the thumbnail image."
		),
		array ("id" => "fancybox_url",
		"name" => "Image URL",
		"desc" => "The url of the large image to be opened in Fancybox. If you want the thumbnail image to load in Fancybox, leave this blank."
		),
		array ("id" => "width",
		"name" => "Width",
		"desc" => "The width of the image."
		),
		array ("id" => "height",
		"name" => "Height",
		"desc" => "The height of the image."
		),

	),
	"content_required" => false,
	"custom_output" => null
	),

	array ("id" => "fancybox_youtube",
	"name" => __("Fancybox Youtube", "alive"),
	"shortcode_name" => "fancybox_youtube",
	"attributes" => array (
	
		array ("id" => "image_url",
		"name" => "Image URL",
		"desc" => "The url of the preview image."
		),
		array ("id" => "youtube_id",
		"name" => "Youtube ID",
		"desc" => "The youtube video id."
		),
		array ("id" => "width",
		"name" => "Width",
		"desc" => "The width of the image."
		),
		array ("id" => "height",
		"name" => "Height",
		"desc" => "The height of the image."
		),

	),
	"content_required" => false,
	"custom_output" => null
	),
		
	array ("id" => "fancybox_vimeo",
	"name" => __("Fancybox Vimeo", "alive"),
	"shortcode_name" => "fancybox_vimeo",
	"attributes" => array (
	
		array ("id" => "image_url",
		"name" => "Image URL",
		"desc" => "The url of the preview image."
		),
		array ("id" => "vimeo_id",
		"name" => "Vimeo ID",
		"desc" => "The vimeo video id."
		),
		array ("id" => "width",
		"name" => "Width",
		"desc" => "The width of the image."
		),
		array ("id" => "height",
		"name" => "Height",
		"desc" => "The height of the image."
		),

	),
	"content_required" => false,
	"custom_output" => null
	),

	array ("id" => "youtube",
	"name" => __("Embed Youtube", "alive"),
	"shortcode_name" => "youtube",
	"attributes" => array (
	
		array ("id" => "youtube_id",
		"name" => "Youtube ID",
		"desc" => "The youtube video id."
		),
		array ("id" => "width",
		"name" => "Width",
		"desc" => "The width of the video."
		),
		array ("id" => "height",
		"name" => "Height",
		"desc" => "The height of the video."
		),

	),
	"content_required" => false,
	"custom_output" => null
	),

	array ("id" => "vimeo",
	"name" => __("Embed Vimeo", "alive"),
	"shortcode_name" => "vimeo",
	"attributes" => array (
	
		array ("id" => "vimeo_id",
		"name" => "Vimeo ID",
		"desc" => "The vimeo video id."
		),
		array ("id" => "width",
		"name" => "Width",
		"desc" => "The width of the video."
		),
		array ("id" => "height",
		"name" => "Height",
		"desc" => "The height of the video."
		),

	),
	"content_required" => false,
	"custom_output" => null
	),
	
		
	array ("id" => "twitter",
	"name" => __("Twitter", "alive"),
	"shortcode_name" => "twitter",
	"attributes" => "",
	"content_required" => false,
	"custom_output" => null
	)

	
	
);

/*

Adding shortcodes to Wordpress

*/
function reformat_content($content) {
	$content = do_shortcode( shortcode_unautop( $content ) ); 
    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
    return $content;
}

// Two Columns
function theme_sc_two_column($atts, $content = null) 
{

	return '<div class="one_half">
               ' . reformat_content($content) . ' 
			 </div>';

}

add_shortcode('two_column', 'theme_sc_two_column');

// Two Columns Last
function theme_sc_two_column_last($atts, $content = null) 
{

	return '<div class="one_half col_last">
               ' . reformat_content($content) . ' 
			 </div><div class="clear"></div>';

}

add_shortcode('two_column_last', 'theme_sc_two_column_last');

// Three Columns
function theme_sc_three_column($atts, $content = null) 
{

	return '<div class="one_third">
              ' . reformat_content($content) . ' 
			 </div>';

}

add_shortcode('three_column', 'theme_sc_three_column');

// Three Columns Last
function theme_sc_three_column_last($atts, $content = null) 
{

	return '<div class="one_third col_last">
               ' . reformat_content($content) . ' 
			 </div><div class="clear"></div>';

}

add_shortcode('three_column_last', 'theme_sc_three_column_last');

// Four Columns
function theme_sc_four_column($atts, $content = null) 
{

	return '<div class="one_fourth">
               ' . reformat_content($content) . '  
			 </div>';

}

add_shortcode('four_column', 'theme_sc_four_column');

// Four Columns Last
function theme_sc_four_column_last($atts, $content = null) 
{

	return '<div class="one_fourth col_last">
              ' . reformat_content($content) . '  
			 </div><div class="clear"></div>';

}

add_shortcode('four_column_last', 'theme_sc_four_column_last');

// Two Third Columns
function theme_sc_two_third_column($atts, $content = null) 
{

	return '<div class="two_third">
              ' . reformat_content($content) . '  
			 </div>';

}

add_shortcode('two_third_column', 'theme_sc_two_third_column');

// Shortcode List
function theme_sc_list($atts, $content = null) 
{

	return '<ul class="list">' . reformat_content($content) . ' </ul>';

}


// Blockquote
function theme_sc_blockquote($atts, $content = null) 
{

	extract( shortcode_atts( array(
			'quoted_by' => '',
		), $atts ) );

	return ' <blockquote><p>' . esc_attr($content) . '</p><p class="clientRef">-' . esc_attr($quoted_by) . '</p></blockquote>';

}

add_shortcode('blockquote', 'theme_sc_blockquote');

// Blockquote Left
function theme_sc_blockquote_left($atts, $content = null) 
{

	extract( shortcode_atts( array(
			'quoted_by' => '',
		), $atts ) );

	return ' <blockquote class="alignLeft"><p>' . esc_attr($content) . '</p><p class="clientRef">-' . esc_attr($quoted_by) . '</p></blockquote>';

}

add_shortcode('blockquote_left', 'theme_sc_blockquote_left');

// Blockquote Right
function theme_sc_blockquote_right($atts, $content = null) 
{

	extract( shortcode_atts( array(
			'quoted_by' => '',
		), $atts ) );

	return ' <blockquote class="alignRight"><p>' . esc_attr($content) . '</p><p class="clientRef">-' . esc_attr($quoted_by) . '</p></blockquote>';

}

add_shortcode('blockquote_right', 'theme_sc_blockquote_right');

// Button
function theme_sc_button($atts, $content = null) 
{

	extract( shortcode_atts( array(
			'size' => "small",
			'link' => '#',
			'color' => 'black'
		), $atts ) );
		

	return '<a class="button ' . esc_attr($color) . ' ' . esc_attr($size) . '"  href="' . esc_attr($link) . '">' . $content . '</a>';

}

add_shortcode('button', 'theme_sc_button');

// Fancybox Image
function theme_sc_fb_image($atts, $content = null) 
{

	extract( shortcode_atts( array(
			'image_url' => '',
			'fancybox_url' => '',
			'width' => "488",
			'height' => '200'
		), $atts ) );
		
		if ($fancybox_url == "") $fancybox_url = $image_url;
		
	return reformat_content('<style>	
			.mediaContainer'. $width . $height .' {width:' . $width .'px; height: '. $height.'px;}
			.mediaContainer'. $width . $height .' a img {width:' . ($width + 20) .'px; height: '. ($height + 20).'px;}
	</style> 
	<div class="mediaContainer mediaContainer'. $width . $height .'">
		<a class="_image" href="' . esc_attr($fancybox_url) . '">
			<div class="_rollover"></div>
			<img src="' . esc_attr($image_url) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" alt=""/>
		</a>
	</div>');

}

add_shortcode('fancybox_image', 'theme_sc_fb_image');

// Fancybox Youtube
function theme_sc_fb_youtube($atts, $content = null) 
{

	extract( shortcode_atts( array(
			'image_url' => '',
			'youtube_id' => '',
			'width' => "488",
			'height' => '200'
		), $atts ) );

	return reformat_content('<style>	
			.mediaContainer'. $width . $height .' {width:' . $width .'px; height: '. $height.'px;}
			.mediaContainer'. $width . $height .' a img {width:' . ($width + 20) .'px; height: '. ($height + 20).'px;}
	</style> 
	
	<div class="mediaContainer mediaContainer'. $width . $height .'">
    	<a class="_video" href="http://www.youtube.com/watch?v=' . esc_attr($youtube_id) . '" >
        	<div class="_rollover"></div>
            <img src="' . esc_attr($image_url) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" alt=""/>   
        </a>
    </div>');

}

add_shortcode('fancybox_youtube', 'theme_sc_fb_youtube');

// Fancybox Vimeo
function theme_sc_fb_vimeo($atts, $content = null) 
{

	extract( shortcode_atts( array(
			'image_url' => '',
			'vimeo_id' => '',
			'width' => "488",
			'height' => '200'
		), $atts ) );

	return reformat_content('<style>	
			.mediaContainer'. $width . $height .' {width:' . $width .'px; height: '. $height.'px;}
			.mediaContainer'. $width . $height .' a img {width:' . ($width + 20) .'px; height: '. ($height + 20).'px;}
	</style> 
	<div class="mediaContainer mediaContainer'. $width . $height .'">
    	<a class="_video" href="http://vimeo.com/' . esc_attr($vimeo_id). '" >
        	<div class="_rollover"></div>
            <img src="' . esc_attr($image_url) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" alt=""/>
        </a>  
    </div>');

}

add_shortcode('fancybox_vimeo', 'theme_sc_fb_vimeo');

// Youtube
function theme_sc_youtube($atts, $content = null) 
{

	extract( shortcode_atts( array(
			'youtube_id' => '',
			'width' => "488",
			'height' => '300'
		), $atts ) );

	return reformat_content('<style>	
		.mediaContainer'. $width . $height .' {width:' . $width .'px; height: '. $height.'px;}
	</style> 
	<div class="mediaContainer mediaContainer'. $width . $height .'">
		<iframe width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" src="http://www.youtube.com/embed/' . esc_attr($youtube_id) . '?autohide=2&amp;controls=0&amp;disablekb=0&amp;fs=0&amp;hd=0&amp;loop=0&amp;rel=0&amp;showinfo=0&amp;showsearch=0&amp;wmode=transparent" frameborder="0"></iframe>
	</div> ');

}

add_shortcode('youtube', 'theme_sc_youtube');

// Vimeo
function theme_sc_vimeo($atts, $content = null) 
{

	extract( shortcode_atts( array(
			'vimeo_id' => '',
			'width' => "488",
			'height' => '300'
		), $atts ) );

	return reformat_content('<style>	
			.mediaContainer'. $width . $height .' {width:' . $width .'px; height: '. $height.'px;}
			.mediaContainer'. $width . $height .' a img {width:' . ($width + 20) .'px; height: '. ($height + 20).'px;}
	</style>  
	<div class="mediaContainer mediaContainer'. $width . $height .'">
		<iframe  width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" src="http://player.vimeo.com/video/' . esc_attr($vimeo_id) . '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=0&amp;loop=0" frameborder="0"></iframe>
	</div> ');

}

add_shortcode('vimeo', 'theme_sc_vimeo');



// Twitter
function theme_sc_twitter($atts, $content = null) 
{

	return '<div class="twitter"></div>';

}

add_shortcode('twitter', 'theme_sc_twitter');



?>