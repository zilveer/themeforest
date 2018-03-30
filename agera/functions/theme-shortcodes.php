<?php

/*-----------------------------------------------------------------------------------*/
/*	Shortcodes PHP:
/*
/*	1. Tabs
/*	2. Toggle
/*	3. Buttons
/*	4. YouTube
/*	5. Vimeo
/*	6. Columns
/*	7. FlexSlider
/*	8. Lists
/*	9. Contact Form
/*	10. Google Maps
/*
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	1. Tabs Shortcode
/*-----------------------------------------------------------------------------------*/


function mpc_tabs($atts, $content) {
	$GLOBALS['tab_count'] = 0;

	do_shortcode($content);

	if(is_array($GLOBALS['tabs'])) {
		$i = 1; $j = 1;
		
		foreach( $GLOBALS['tabs'] as $tab ) {
			$tabs[] = '<li class="tabs_title"><a class="" href="#'.$i++.'">'.$tab['title'].'</a></li>';
			$panes[] = '<div id="'.$j++.'" class="tab_content"><p>'.$tab['content'].'</p></div>';
		}
		
		$return = "\n".'<div class="tabs"><ul>'.implode( "\n", $tabs ).'</ul><span class="clear"></span>'."\n".''.implode( "\n", $panes ).'</div>'."\n";
		
	}
	$return .='<div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode( 'tabs', 'mpc_tabs' );

function mpc_tab($atts, $content) {
	extract(shortcode_atts(array
	(
		'title' => 'Tab %d'
	), $atts));

	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

	$GLOBALS['tab_count']++;
}

add_shortcode('tab', 'mpc_tab');

/*--------------------------- END Tabs -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	2. Toggle Shortcode
/*-----------------------------------------------------------------------------------*/

function mpc_toggle_shortcode($atts, $content = null){
	extract( shortcode_atts(
		array(
			'title' => 'Click To Open'
			),
			$atts));
			$return = '<div class="toggle-header"><h3 class="toggle-title"><a href="#">'. $title .'</a></h3></div><div class="toggle-content">' . do_shortcode($content) . '</div><div class="toggle-space"></div><div class="clear"></div>';
			$return = parse_shortcode_content($return);
			return $return;
}

add_shortcode('toggle', 'mpc_toggle_shortcode');

/*--------------------------- END Toggle Shortcode -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	3. Button Shortcode
/*-----------------------------------------------------------------------------------*/

function mpc_button_shortcode($atts, $content = null ) {
	extract(shortcode_atts(array(
    'class' => '',
    'url' => '',
    'background' => '',
    'text_color' => '',
    'background_hover' => '',
    'text_color_hover' => '',
    
    ), $atts));
    
    ?>
    <style>
    	#shortcode-preview .mpc-button.<?php echo $class; ?>,
    	.mpc-button.<?php echo $class; ?> {
	    	background: <?php echo $background; ?>!important;
	    	color: <?php echo $text_color; ?>!important;
    	}
    	
    	#shortcode-preview .mpc-button.<?php echo $class; ?>:hover,
    	.mpc-button.<?php echo $class; ?>:hover {
	    	background: <?php echo $background_hover; ?>!important;
	    	color: <?php echo $text_color_hover; ?>!important;
    	}
    
    </style>
    
    <?php
   $return = '<a class="mpc-button ' . esc_attr($class) . '" href="' .$url. '">' . $content . '</a>';
   $return = parse_shortcode_content($return);
   return $return;
}

add_shortcode('button', 'mpc_button_shortcode');

/*--------------------------- END Alery Shortcode -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	4. YouTube 
/*-----------------------------------------------------------------------------------*/

function youtube_shortcode($atts, $content = null) {
   extract(shortcode_atts(array(
			'video'  => '',
			'width'  => '590',
			'height' => '355'
			), $atts));
			
	if($video !=''){
		if($width == '')
			$width = '590';
		if($height == '')
			$height = '355';
				
		$return = '<div class="youtube_video"><object type="application/x-shockwave-flash" style="width:'.esc_attr($width).'; height:'.esc_attr($height).';" data="http://www.youtube.com/v/'.esc_attr($video).'&amp;hl=en_US&amp;fs=1&amp;"><param name="movie" value="http://www.youtube.com/v/'.esc_attr($video).'&amp;hl=en_US&amp;fs=1&amp;" /></object></div>';
		$return = parse_shortcode_content($return);
		return $return;
	}
}
add_shortcode('youtube', 'youtube_shortcode');

/*--------------------------- END YouTube -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	5. Vimeo
/*-----------------------------------------------------------------------------------*/

function vimeo_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
                    'id' => '',
                    'height' => '355',
                    'width' => '590'
                        ), $atts));
        if ($id != '') {
        	if($width == '')
				$width = '590';
			if($height == '')
				$height = '355';
					
            $iframe = '<iframe src="http://player.vimeo.com/video/';
            $iframe .= esc_attr($id);
            $iframe .= '?color=F9625B" width="';
            $iframe .= esc_attr($width);
            $iframe .= '" height="';
            $iframe .= esc_attr($height);
            $iframe .= '"></iframe>';
            
            $iframe = parse_shortcode_content($iframe);
            return $iframe;
        }
    }
    
add_shortcode('vimeo', 'vimeo_shortcode');

/*--------------------------- END Vimeo -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	6. Columns
/*-----------------------------------------------------------------------------------*/

/* function allow you to insert 1/2 column */
function column1_2_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_half" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_2', 'column1_2_shortcode');

/* function allow you to insert 1/2 column last */
function column1_2_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_half column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_2_last', 'column1_2_last_shortcode');


/* function allow you to insert 1/3 column */
function column1_3_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_third" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_3', 'column1_3_shortcode');

/* function allow you to insert 1/3 column last */
function column1_3_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_third column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_3_last', 'column1_3_last_shortcode');


/* function allow you to insert 2/3 column */
function column2_3_shortcode( $atts, $content = null ) {
	$return = '<div class="column two_third" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column2_3', 'column2_3_shortcode');

/* function allow you to insert 2/3 column last */
function column2_3_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column two_third column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column2_3_last', 'column2_3_last_shortcode');


/* function allow you to insert 1/4 column */
function column1_4_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_fourth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_4', 'column1_4_shortcode');

/* function allow you to insert 1/4 column last */
function column1_4_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_fourth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_4_last', 'column1_4_last_shortcode');

/* function allow you to insert 3/4 column */
function column3_4_shortcode( $atts, $content = null ) {
	$return = '<div class="column three_fourth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column3_4', 'column3_4_shortcode');

/* function allow you to insert 3/4 column */
function column3_4_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column three_fourth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column3_4_last', 'column3_4_last_shortcode');


/* function allow you to insert 1/5 column */
function column1_5_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_fifth" ><p>'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_5', 'column1_5_shortcode');

/* function allow you to insert 1/5 column */
function column1_5_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_fifth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_5_last', 'column1_5_last_shortcode');

/* function allow you to insert 2/5 column */
function column2_5_shortcode( $atts, $content = null ) {
	$return = '<div class="column two_fifth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column2_5', 'column2_5_shortcode');

/* function allow you to insert 2/5 column */
function column2_5_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column two_fifth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column2_5_last', 'column2_5_last_shortcode');


/* function allow you to insert 3/5 column */
function column3_5_shortcode( $atts, $content = null ) {
	$return = '<div class="column three_fifth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column3_5', 'column3_5_shortcode');

/* function allow you to insert 3/5 column */
function column3_5_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column three_fifth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column3_5_last', 'column3_5_last_shortcode');


/* function allow you to insert 4/5 column */
function column4_5_shortcode( $atts, $content = null ) {
	$return = '<div class="column four_fifth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column4_5', 'column4_5_shortcode');

/* function allow you to insert 4/5 column */
function column4_5_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column four_fifth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column4_5_last', 'column4_5_last_shortcode');


/* function allow you to insert 1/6 column */
function column1_6_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_sixth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_6', 'column1_6_shortcode');

/* function allow you to insert 1/6 column */
function column1_6_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_sixth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_6_last', 'column1_6_last_shortcode');

/* function allow you to insert 5/6 column */
function column5_6_shortcode( $atts, $content = null ) {
	$return = '<div class="column five_sixth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column5_6', 'column5_6_shortcode');

/* function allow you to insert 5/6 column */
function column5_6_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column five_sixth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column5_6_last', 'column5_6_last_shortcode');


/*--------------------------- END Columns  -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	7. FlexSlider
/*-----------------------------------------------------------------------------------*/

function flex_images($atts, $content) {
	extract(shortcode_atts(array (
		'url' => 'image %d'
	), $atts));
		
	$i = $GLOBALS['image_count'];
	$GLOBALS['images'][$i] = array ('url' => sprintf ( $url, $GLOBALS['image_count'] ), 'content' => $content);
	$GLOBALS['image_count']++;
}

add_shortcode('flex_image', 'flex_images');


function flex_shortcode ($atts, $content) {
	$GLOBALS['image_count'] = 0;
	do_shortcode ($content);
	extract(shortcode_atts(array(
		'width'  => '500',
		'height' => '200',
		'effect' => 'fade',
		'slideshowspeed' => '3000'
	), $atts,$content));
	
	if(is_array($GLOBALS['images'])) {
		foreach($GLOBALS['images'] as $image) {
			$images[] = '<li><img src="'.$image['url'].'"/></li>';
		}
	?>
	
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.flexslider').flexslider({
				animation: '<?php echo esc_attr($effect); ?>',
				slideshowSpeed: '<?php echo esc_attr($slideshowspeed); ?>',
				controlNav: false 
			});
		});
	</script>
	
	<?php
		$return = "\n".'<div class="flexslider"><ul class="slides">'.implode( "\n", $images ).'</ul></div>'."\n";
	}
	//echo $return;
	$return = parse_shortcode_content($return);
	return $return;
}
	
add_shortcode('flexslider', 'flex_shortcode');

/*--------------------------- END FlexSlider -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	8. Lists
/*-----------------------------------------------------------------------------------*/

function mpc_list_items($atts, $content) {
	extract(shortcode_atts(array (
		'item' => ''
	), $atts));
	
	$i = $GLOBALS['item_count'];
	$GLOBALS['items'][$i] = $content;
	$GLOBALS['item_count']++;	
}

add_shortcode('litem', 'mpc_list_items');

function mpc_lists_shortcode($atts, $content = null ) {
	$GLOBALS['item_count'] = 0;
	do_shortcode ($content);
	extract(shortcode_atts(array(
    'type' => '',
    ), $atts,$content));
   
   if($type == 'ordered'){
   		$output = '<ol class="list">';
   	} else {
  	 $output = '<ul class="' .$type. ' list">';
 	}
   
   if(is_array($GLOBALS['items'])) {
		foreach($GLOBALS['items'] as $item) {
			$output .= '<li>' .$item. '</li>';
		}	
	}
	
	if($type == 'ordered'){
   		$output .= '</ol>';
   	} else {
  		$output .= '</ul>';
 	}
  
   $output = parse_shortcode_content($output);
   return $output;
} 

add_shortcode('list', 'mpc_lists_shortcode');

/*--------------------------- END Lists -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	9. Contact Form
/*-----------------------------------------------------------------------------------*/

function mpc_contact_form_shortcode($params = array()) {
	extract(shortcode_atts(array(
	), $params));
	
	$output = '';
	$output = include(get_theme_root() . '/' . get_template() . "/functions/contact-form.php");
	return $output; 
}

add_shortcode('contact_form', 'mpc_contact_form_shortcode');

/*--------------------------- END Contact Form -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	10. Google Maps
/*-----------------------------------------------------------------------------------*/

function mpc_gmaps($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '640',
      "height" => '480',
      "src" => ''
   ), $atts));
   return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed"></iframe>';
}
add_shortcode("mpc_google_map", "mpc_gmaps");

/*--------------------------- END Google Maps -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	Shortcodes clean up - prevents the empty paragraph at the top of the shortcode
/*-----------------------------------------------------------------------------------*/

// clean up shortcode

function parse_shortcode_content( $content ) {

   /* Parse nested shortcodes and add formatting. */
    $content = trim( do_shortcode( shortcode_unautop( $content ) ) );

    /* Remove '' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '' )
        $content = substr( $content, 4 );

    /* Remove '' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of ''. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    $content = str_replace( array( '<p>  </p>' ), '', $content );

    return $content;
}

// move wpautop filter to AFTER shortcode is processed

remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'shortcode_unautop',100 );

?>