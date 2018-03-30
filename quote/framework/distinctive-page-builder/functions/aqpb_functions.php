<?php
/**
 * Aqua Page Builder functions
 *
 * This holds the external functions which can be used by the theme
 * Requires the AQ_Page_Builder class
 *
 * @todo - multicheck, image checkbox, better colorpicker
**/

if(class_exists('AQ_Page_Builder')) {
	
	/** 
	 * Core functions
	*******************/
	 
	/* Register a block */
	function aq_register_block($block_class) {
		global $aq_registered_blocks;
		$aq_registered_blocks[strtolower($block_class)] = new $block_class;
	}
	
	/** Un-register a block **/
	function aq_unregister_block($block_class) {
		global $aq_registered_blocks;
		$block_class = strtolower($block_class);
		foreach($aq_registered_blocks as $block) {
			if($block->id_base == $block_class) unset($aq_registered_blocks[$block_class]);
		}
	}
	
	/** Get list of all blocks **/
	function aq_get_blocks($template_id) {
		global $aq_page_builder;
		$blocks = $aq_page_builder->get_blocks($template_id);
		
		return $blocks;
	}
	
	/** 
	 * Form Field Helper functions
	 *
	 * Provides some default fields for use in the blocks
	********************************************************/
	
	/* Input field - Options: $size = min, small, full */
	function aq_field_input($field_id, $block_id, $input, $size = 'full', $type = 'text') {
		$output = '<input type="'.$type.'" id="'. $block_id .'_'.$field_id.'" class="input-'.$size.'" value="'.$input.'" name="aq_blocks['.$block_id.']['.$field_id.']">';
		
		return $output;
	}
	
	/* Textarea field */
	function aq_field_textarea($field_id, $block_id, $text, $size = 'full', $buttons = false) {
		$output = '';
		if( $buttons == true ){
			$output .= '
				<div class="clear"></div>
		        <button name="B">B</button>
		        <button name="I">I</button>
		        <button name="BQ">Quote</button>
		        <button name="LINK">Link</button>
		        <button name="OL">OL</button>
		        <button name="UL">UL</button>
		        <button name="IMG">IMG</button>
		        <button name="H1">H1</button>
		        <button name="H2">H2</button>
		        <button name="H3">H3</button>
		        <button name="H4">H4</button>
		        <button name="H5">H5</button>
		        <button name="H6">H6</button>
			';
		}
		$output .= '<textarea id="'. $block_id .'_'.$field_id.'" class="textarea-'.$size.'" name="aq_blocks['.$block_id.']['.$field_id.']" rows="5">'.$text.'</textarea>';
		
		return $output;
	}
	
	
	/* Select field */
	function aq_field_select($field_id, $block_id, $options, $selected) {
		$options = is_array($options) ? $options : array();
		$output = '<select id="'. $block_id .'_'.$field_id.'" name="aq_blocks['.$block_id.']['.$field_id.']">';
		foreach($options as $key=>$value) {
			$output .= '<option value="'.$key.'" '.selected( $selected, $key, false ).'>'.htmlspecialchars($value).'</option>';
		}
		$output .= '</select>';
		
		return $output;
	}
	
	/* Multiselect field */
	function aq_field_multiselect($field_id, $block_id, $options, $selected_keys = array()) {
		$output = '<select id="'. $block_id .'_'.$field_id.'" multiple="multiple" class="select of-input" name="aq_blocks['.$block_id.']['.$field_id.'][]">';
		foreach ($options as $key => $option) {
			$selected = (is_array($selected_keys) && in_array($key, $selected_keys)) ? $selected = 'selected="selected"' : '';			
			$output .= '<option id="'. $block_id .'_'.$field_id.'_'. $key .'" value="'.$key.'" '. $selected .' />'.$option.'</option>';
		}
		$output .= '</select>';
		
		return $output;
	}
	
	/* Color picker field */
	function aq_field_color_picker($field_id, $block_id, $color, $default = '') {
		$output = '<div class="aqpb-color-picker">';
			$output .= '<input type="text" id="'. $block_id .'_'.$field_id.'" class="input-color-picker" value="'. $color .'" name="aq_blocks['.$block_id.']['.$field_id.']" data-default-color="'. $default .'"/>';
		$output .= '</div>';
		
		return $output;
	}

	function aq_category_select($field_id, $block_id, $categories) {
		$output = '';
		$args = array(
		  'orderby' => 'name',
		  'order' => 'ASC'
		  );
		$categories = get_categories($args);
		$output .= wp_dropdown_categories('show_option_all=All&show_count=1&hierarchical=1');
	}
	
	/* Single Checkbox */
	function aq_field_checkbox($field_id, $block_id, $check) {
		$output = '<input type="hidden" name="aq_blocks['.$block_id.']['.$field_id.']" value="0" />';
		$output .= '<input type="checkbox" id="'. $block_id .'_'.$field_id.'" class="input-checkbox" name="aq_blocks['.$block_id.']['.$field_id.']" '. checked( 1, $check, false ) .' value="1"/>';
		
		return $output;
	}
	
	/* Multi Checkbox */
	function aq_field_multicheck($field_id, $block_id, $fields = array(), $selected = array()) {
	
	}
	
	/* Media Uploader */
	function aq_field_upload($field_id, $block_id, $media, $media_type = 'image') {
		$output = '<input type="text" id="'. $block_id .'_'.$field_id.'" class="input-full input-upload" value="'.$media.'" name="aq_blocks['.$block_id.']['.$field_id.']">';
		$output .= '<a href="#" class="aq_upload_button button" rel="'.$media_type.'">Upload</a><p></p>';
		
		return $output;
	}
	
	function aq_cf7_select($field_id, $block_id, $posts ) {
		global $post;
		$post_type = 'wpcf7_contact_form';
		$args = array (
		    'post_type' => $post_type,
		    'posts_per_page' => -1,
		    'orderby' => 'menu_order',
		    'order' => 'ASC',
		);
		 $posts = get_posts($args);
		 $output = '<select id="'. $block_id .'_'.$field_id.'" name="aq_blocks['.$block_id.']['.$field_id.']">';
		 foreach( $posts as $post ) { setup_postdata($post);
		              $output .= '<option value="'.$post->ID.'">'.htmlspecialchars($post->post_title).'</option>';
		 }
		 $output .= '</select>';
		 return $output;
	}

	/** 
	 * Misc Helper Functions
	**************************/
	
	/** Get column width
	 * @parameters - $size (column size), $grid (grid size e.g 940), $margin
	 */
	function aq_get_column_width($size, $grid = 940, $margin = 20) {
		
		$columns = range(1,12);
		$widths = array();
		foreach($columns as $column) {
			$width = (( $grid + $margin ) / 12 * $column) - $margin;
			$width = round($width);
			$widths[$column] = $width;
		}
		
		$column_id = absint(preg_replace("/[^0-9]/", '', $size));
		$column_width = $widths[$column_id];
		return $column_width;
	}
	
	/** Recursive sanitize
	 * For those complex multidim arrays 
	 * Has impact on server load on template save, so use only where necessary 
	 */
	function aq_recursive_sanitize($value) {
		if(is_array($value)) {
			$value = array_map('aq_recursive_sanitize', $value);
		} else {
			$value = htmlspecialchars(stripslashes($value));
		}
		return $value;
	}
	
}

/**
 * Gonna Throw Some extras here too
**/
function mpt_content_kses($content) {
	
	$output = wp_kses($content, array(
					'a' => array(
						'href' => array(),
						'title' => array(),
						'target' => array()
						),
					'br' => array(),
					'em' => array(),
					'strong' => array() 
					)); 

	return trim($output);
}

function mpt_load_featured_image( $id , $imagesize = 'tb-360' , $prettyphoto = false , $btnclass = '' , $iconclass = '') {
	$output = '';
	$fullimage = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');


	if ($imagesize == 'tb-860') {
		$style = ' style="max-width: 860px;"';
	} else {
		$style = '';
	}

	$output .= '<div class="image-box transparent add-shadow-effect"'.$style.'>';
	$output .= '<div class="hover-btn">';

		if ($prettyphoto == 'true') {
			$output .= '<a href="'.$fullimage[0].'" class="btn btn-block" rel="prettyPhoto[post-'.$id.']"><i class="icon-search"></i> View Image';
		} else {
			$output .= '<a href="'.get_permalink($id).'" class="btn btn-block"><i class="icon-search"></i> Read Post';
		}
		$output .= '</a>';

	$output .= '</div>';

	if ($prettyphoto == 'true') {
		$output .= '<a href="'.$fullimage[0].'" rel="prettyPhoto[post-'.$id.']">';
	} else {
		$output .= '<a href="'.get_permalink($id).'" >';
	}
		
	$output .= get_the_post_thumbnail($id,$imagesize);
	$output .= '</a>';

	$output .= '</div>';
	
	echo $output;
}

function mpt_load_image_carousel( $id , $imagesize = 'tb-360' , $prettyphoto = false) {
	$themefolder = get_template_directory_uri();
	$output = '';
	$image1 = get_post_meta( $id, '_mpt_video_featured_image_2', true );
	$imageurl1 = esc_url($image1);
	$attachid1 = get_image_id($imageurl1);
	$image2 = get_post_meta( $id, '_mpt_video_featured_image_3', true );
	$imageurl2 = esc_url($image2);
	$attachid2 = get_image_id($imageurl2);
	$fullimage = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');

	if ($imagesize == 'tb-860') {
		$style = ' style="max-width: 860px;"';
	} else {
		$style = '';
	}

	$output .= '<div id="image-carousel-'.$id.'" class="image-carousel carousel slide add-shadow-effect"'.$style.'>';
	$output .= '<div class="carousel-inner">';
	$output .= '<div class="active item">';

	if ($prettyphoto == 'true') {
		$output .= '<a href="'.$fullimage[0].'" rel="prettyPhoto[carousel-'.$id.']">';
	} else {
		$output .= '<a href="'.get_permalink($id).'">';
	}

	$output .= get_the_post_thumbnail($id,$imagesize);
	$output .= '</a></div>';

	if (!empty($image1)) {

		$output .= '<div class="item">';

		if ($prettyphoto == 'true') {
			$output .= '<a href="'.$imageurl1.'" rel="prettyPhoto[carousel-'.$id.']">';
		} else {
			$output .= '<a href="'.get_permalink($id).'">';
		}

		$output .= wp_get_attachment_image( $attachid1, $imagesize );
		$output .= '</a></div>';
	}

	if (!empty($image2)) {

		$output .= '<div class="item">';

		if ($prettyphoto == 'true') {
			$output .= '<a href="'.$imageurl2.'" rel="prettyPhoto[carousel-'.$id.']">';
		} else {
			$output .= '<a href="'.get_permalink($id).'">';
		}

		$output .= wp_get_attachment_image( $attachid2, $imagesize );
		$output .= '</a></div>';
	}

	$output .= '</div>';
	$output .= '<a class="carousel-control left" href="#image-carousel-'.$id.'" data-slide="prev"><img src="'.$themefolder.'/img/back.png"></a>';
	$output .= '<a class="carousel-control right" href="#image-carousel-'.$id.'" data-slide="next"><img src="'.$themefolder.'/img/next.png"></a>';
	$output .= '</div>';
	$output .= '<script type="text/javascript">';
	$output .= 'jQuery(document).ready(function () {jQuery("#image-carousel-'.$id.'").carousel({interval: 3000,pause: "hover"})});';
	$output .= '</script>';
	
	echo $output;
}

function get_image_id($image_url) {
	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_url'";
	$id = $wpdb->get_var($query);
	return $id;
}

function mpt_load_video_post( $id , $height = null) {
	$output = '';
	$video = get_post_meta( $id, '_mpt_post_video_url', true );
	$videourl = esc_url($video);
	$videotype = get_post_meta( $id, '_mpt_post_video_type', true );
	$videocode = '';

	if (!empty($height)) {
		$videoheight = ' height="'.$height.'"';
	} else {
		$videoheight = '';
	}

	switch ($videotype) {
		case 'youtube':
			$youtube = array(
				"http://youtu.be/",
				"http://www.youtube.com/watch?v=",
				"http://www.youtube.com/embed/"
				);
			$videonum = str_replace($youtube, "", $videourl);
			$videocode = 'http://www.youtube.com/embed/' . $videonum;
			break;
		case 'vimeo':
			$vimeo = array(
				"http://vimeo.com/",
				"http://player.vimeo.com/video/"
				);
			$videonum = str_replace($vimeo, "", $videourl);
			$videocode = 'http://player.vimeo.com/video/' . $videonum;
			break;
	}

	$output .= '<div class="video-box">';
	$output .= '<iframe src="'.$videocode.'?title=1&amp;byline=1&amp;portrait=1" width="100%"'.$videoheight.' frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	$output .= '</div>';
	
	echo $output;
}

// set excerpt lenght to custom character length
function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}