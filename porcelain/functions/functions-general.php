<?php
/**
 * This file contains the main general theme functions.
 * All the functions are pluggable, which means that they can be replaced in a
 * child theme.
 *
 * @author Pexeto
 */


if(!function_exists('pexeto_wp_title')){
	function pexeto_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}

		$prepend = '';

		if (is_category()) {
			$prepend = __( 'Category', 'pexeto' ).' '; 
		} elseif (is_tag()) {
			$prepend = __( 'Tag', 'pexeto' ).' '; 
		} elseif (is_search()) {
			$prepend = __( 'Search results', 'pexeto' ).' '; 
		} elseif (is_404()) {
			$prepend = __( 'Page not found', 'pexeto' ).' '; 
		}

		// Add the site name.
		$append = get_bloginfo( 'name' );

		return $prepend.$title.$append;
	}
}
add_filter( 'wp_title', 'pexeto_wp_title', 10, 2 );


if(!function_exists('pexeto_get_column_width')){

	/**
	 * Calculates the column widith depending on the current page layout
	 * and number of columns.
	 * @param  int $columns      the number of columns
	 * @param  string $content_type content type - can be blog, gallery,
	 * carousel, quick_gallery, services, content_slider
	 * @param  string $layout       the current page layout
	 * @return int               the calculated column width
	 */
	function pexeto_get_column_width($columns, $content_type='', $layout='full'){
		global $pexeto_content_sizes;

		$spacing = isset($pexeto_content_sizes['column_spacing'][$content_type]) ?
			$pexeto_content_sizes['column_spacing'][$content_type] : 0;

		
		if($layout=='threecolumn' || $layout =='twocolumn'){
			//this is a blog two/three column layout
			$col = $layout == 'twocolumn' ? 2 : 3;
			$layout_width = pexeto_get_column_width($col, 'blog');
		}else{
			$layout_key = $layout == 'full' ? 'fullwidth' : 'content';
			$layout_width = $pexeto_content_sizes[$layout_key];
		}

		$column_width = ($layout_width + $spacing)/$columns - $spacing;

		return round($column_width);
	}
}


if(!function_exists('pexeto_get_image_size_options')){

	/**
	 * Retrieves the image size options depending on the section/content type
	 * and the number of columns.
	 * @param  integer $columns      the number of columns
	 * @param  string  $content_type the content type - can be blog, gallery,
	 * carousel, quick_gallery, services, content_slider
	 * @param  string  $layout       the current page/section layout
	 * @return array                array containing the image size settings,
	 * with properties width, height and crop
	 */
	function pexeto_get_image_size_options($columns=1, $content_type='', $layout=''){
		global $pexeto_content_sizes;

		$res = array('width' => '', 'height' => '', 'crop' => false);

		if(!$layout){
			global $pexeto_page;

			if(!empty($pexeto_page) && isset($pexeto_page['layout'])){
				$layout = $pexeto_page['layout'];
			}else{
				$layout = 'full';
			}
		}

		$layout_keys = array(
			'left' => 'content',
			'right' => 'content',
			'full' => 'fullwidth',
			'container' => 'container'
			);

		switch ($content_type) {
			case 'blog':
				//blog post image
				if($layout=='full'){
					if($columns==1){
						//full-width one column layout
						$option_key = 'full_blog_image_height';
					}else {
						//two or three column layout
						$option_key = $columns==2 ? 'twocolumn_blog_image_height' : 'threecolumn_blog_image_height';
					}
				}else{
					//standard sidebar layout
					if($columns>1){
						$option_key = 'twocolumn_blog_sidebar_image_height';
					}else{
						$option_key = 'blog_image_height';
					}
				}

				$res['width'] = pexeto_get_column_width($columns, $content_type, $layout);
				$res['height'] = pexeto_option($option_key);
				

				if($res['height']){
					$res['crop'] = true;
				}

				break;

			
			default:
				if($columns!=1){
					$res['width'] = pexeto_get_column_width($columns, $content_type, $layout);
				}else{
					$layout_key = isset($layout_keys[ $layout ]) ? $layout_keys[ $layout ] : $layout_keys[ 0 ];
					$res['width'] = $pexeto_content_sizes[ $layout_key ];
				}
				
				break;
		}

		return $res;
	}
}


if ( !function_exists( 'pexeto_get_resized_image' ) ) {

	/**
	 * Gets the URL for a Timthumb resized image.
	 *
	 * @param string  $imgurl the original image URL
	 * @param string  $width  the width to which the image will be cropped
	 * @param string  $height the height to which the image will be cropped
	 * @param string  $crop whether to crop the image to exact proportions
	 * @return string the URL of the image resized with Timthumb
	 */
	function pexeto_get_resized_image( $imgurl, $width, $height='', $crop = false ) {
		if($height && !$crop){
			$crop = true;
		}
		$width = (int)$width;
		$height = (int)$height;
		$resized_img = aq_resize( $imgurl, $width, $height, $crop, true, true );
		if(!$resized_img){
			$resized_img = $imgurl;
		}

		return $resized_img;
	}
}


if ( !function_exists( 'pexeto_get_categories' ) ) {
	/**
	 * Gets the post categories.
	 *
	 * @return array containing the categories with keys id containing the category ID and
	 * name containing the category name.
	 */
	function pexeto_get_categories() {
		global $pexeto;

		if ( !isset( $pexeto->categories ) ) {
			$categories=get_categories( 'hide_empty=0' );
			$pexeto_categories=array();
			for ( $i=0; $i<sizeof( $categories ); $i++ ) {
				$pexeto_categories[]=array( 'id'=>$categories[$i]->cat_ID, 'name'=>$categories[$i]->cat_name );
			}
			$pexeto->categories = $pexeto_categories;
		}

		return $pexeto->categories;
	}
}


if ( !function_exists( 'pexeto_option' ) ) {
	/**
	 * Gets an option from the options panel by its key.
	 *
	 * @param string  $option the option ID
	 * @return the option value. If there isn't a value set, returns the default value for the option.
	 */
	function pexeto_option( $option ) {
		global $pexeto;
		$val = $pexeto->options->get_value( $option );
		if ( is_string( $val ) ) {
			$val = stripslashes( $val );
		}
		return $val;
	}
}



if ( !function_exists( 'pexeto_get_saved_option' ) ) {
	/**
	 * Retrieves the saved value of a field only if it has been modified from
	 * its default value.
	 * @param unknown $id - the ID of the option to be retrieved
	 * @return the saved value
	 */
	function pexeto_get_saved_option( $option ) {
		global $pexeto;
		return $pexeto->options->get_saved_value( $option );
	}
}


if ( !function_exists( 'pexeto_get_featured_image_url' ) ) {

	/**
	 * Gets the URL of the featured image of a post.
	 *
	 * @param int     $pid the ID of the post
	 * @return string the URL of the image
	 */
	function pexeto_get_featured_image_url( $pid ) {
		$attachment = wp_get_attachment_image_src( get_post_thumbnail_id( $pid ), 'single-post-thumbnail' );
		return $attachment[0];
	}
}


if ( !function_exists( 'pexeto_get_post_attachments' ) ) {

	/**
	 * Retrieves the attachments of a post.
	 *
	 * @param int     $id the ID of the post
	 * @return array     containing the attachments of the posts
	 */
	function pexeto_get_post_attachments( $id ) {
		return get_children( array(
				'order'=> 'ASC',
				'orderby'=>'menu_order',
				'post_parent' => $id,
				'post_type' => 'attachment',
				'post_mime_type' =>'image'
			) );
	}
}


if ( !function_exists( 'pexeto_print_video' ) ) {

	/**
	 * Prints a video. For Flash videos uses the standard flash embed code and for other videos uses
	 * the WordPress embed tag.
	 *
	 * @param string  $video_url the URL of the video
	 * @param string  $width     the width to set to the video
	 */
	function pexeto_print_video( $video_url, $width ) {
		echo pexeto_get_video_html( $video_url, $width );
	}
}


if ( !function_exists( 'pexeto_get_lightbox_options' ) ) {

	/**
	 * Returns all the saved lightbox options in the panel.
	 *
	 * @return array containing all the settings
	 */
	function pexeto_get_lightbox_options() {
		$opt_ids=array( 'theme', 'animation_speed', 'overlay_gallery', 'allow_resize' );
		$res_arr=array();

		foreach ( $opt_ids as $opt_id ) {
			$res_arr[$opt_id]=pexeto_option( $opt_id );
		}

		return $res_arr;
	}
}


if ( !function_exists( 'pexeto_get_nivo_args' ) ) {

	/**
	 * Retrieves the Nivo slider settings depending on where the slider is
	 * inserted (header/content).
	 * @param  string $suffix the suffix for the key options, for slider in the
	 * content the suffix should be set to "content"
	 * @return array         containing all the settings for this slider
	 */
	function pexeto_get_nivo_args( $suffix='' ) {
		//slider navigation
		$exclude_navigation = pexeto_option( 'exclude_nivo_navigation'.$suffix );
		$show_buttons = in_array( 'buttons', $exclude_navigation ) ? false : true;
		$show_arrows = in_array( 'arrows', $exclude_navigation ) ? false : true;
		$autoplay = pexeto_option( 'nivo_autoplay'.$suffix );
		$pause_hover = pexeto_option( 'nivo_pause_hover'.$suffix );

		$args = array(
			'interval'=>intval( pexeto_option( 'nivo_interval'.$suffix ) ),
			'speed'=>intval( pexeto_option( 'nivo_speed'.$suffix ) ),
			'autoplay'=>$autoplay,
			'pauseOnHover'=>$pause_hover,
			'buttons' => $show_buttons,
			'arrows' =>$show_arrows
		);

		if($suffix != '_post'){
			$args = array_merge($args, array(
				'animation'=> implode( ',', pexeto_option( 'nivo_animation'.$suffix ) ),
				'slices'=>intval( pexeto_option( 'nivo_slices'.$suffix ) ),
				'columns'=>intval( pexeto_option( 'nivo_columns'.$suffix ) ),
				'rows'=>intval( pexeto_option( 'nivo_rows'.$suffix ) )
			));
		}else{
			$args['animation'] = 'fade';
		}

		return $args;
	}
}

if ( !function_exists( 'pexeto_get_font_options' ) ) {

	/**
	 * Loads all the font options from which the user can select. First adds
	 * the default for the theme font set and then loads the custom Google
	 * fonts that the user has added.
	 * @return array all the font options with keys:
	 * id: the name of the font
	 * name: the name of the font
	 */
	function pexeto_get_font_options() {
		global $pexeto;

		if(isset($pexeto->fonts) && !empty($pexeto->fonts)){
			return $pexeto->fonts;
		}

		$fonts = array(
			array( 'id'=>'default', 'name'=>'Default Theme Font'),
			array( 'id'=>'georgia', 'name'=>'Georgia, serif' ),
			array( 'id'=>'palationo', 'name'=>'Palatino Linotype, Book Antiqua, Palatino, serif' ),
			array( 'id'=>'timesnewroman', 'name'=>'Times New Roman, Times, serif' ),
			array( 'id'=>'arial', 'name'=>'Arial, Helvetica, sans-serif' ),
			array( 'id'=>'arialblack', 'name'=>'Arial Black, Gadget, sans-serif' ),
			array( 'id'=>'comicsansms', 'name'=>'Comic Sans MS, cursive, sans-serif' ),
			array( 'id'=>'impact', 'name'=>'Impact, Charcoal, sans-serif' ),
			array( 'id'=>'lucida', 'name'=>'Lucida Sans Unicode, Lucida Grande, sans-serif' ),
			array( 'id'=>'tahoma', 'name'=>'Tahoma, Geneva, sans-serif' ),
			array( 'id'=>'trebutchet', 'name'=>'Trebuchet MS, Helvetica, sans-serif' ),
			array( 'id'=>'verdana', 'name'=>'Verdana, Geneva, sans-serif' ),
			array( 'id'=>'couriernew', 'name'=>'Courier New, Courier, monospace' ),
			array( 'id'=>'lucidaconsole', 'name'=>'Lucida Console, Monaco, monospace' )
			);

		$google_fonts = pexeto_option( 'google_fonts' );

		if ( !empty( $google_fonts ) ) {
			foreach ( $google_fonts as $font ) {
				$fonts[] = array( 'id'=> str_replace('"', '', $font['link']), 'name'=>stripslashes($font['name']));
			}
		}

		$pexeto->fonts = $fonts;

		return $fonts;

	}
}

if(!function_exists('pexeto_get_font_name_by_key')){

	/**
	 * Retrieves a font name from by its key from the registered fonts.
	 * @param  string $key the key of the font
	 * @return string      the name of the font if it exists or null if it
	 * doesn't exist within the included fonts.
	 */
	function pexeto_get_font_name_by_key($key){
		$fonts = pexeto_get_font_options();

		foreach ($fonts as $font) {
			if($font['id']==$key){
				return $font['name'];
			}
		}

		return null;
	}
}

if ( !function_exists( 'pexeto_get_slider_type' ) ) {

	/**
	 * Retrieves the selected slider type for the current page.
	 * @return string the type of the slider. Will return null if a slider
	 * has not been selected for the current page.
	 */
	function pexeto_get_slider_type() {
		global $post;
		$slider_type = null;

		if ( !empty( $post ) ) {
			$page_settings = pexeto_get_post_meta( $post->ID, array( 'slider', 'blog_layout' ) );
			if ( !empty( $page_settings['slider'] ) ) {
				$slider = PexetoCustomPageHelper::get_slider_data_parts( $page_settings['slider'] );
				$slider_type = $slider[0];
			}
		}

		return $slider_type;
	}
}


if ( !function_exists( 'pexeto_contains_posts' ) ) {

	/**
	 * Checks whether the current page contains post.
	 * @return boolean true if it contains posts - these are the blog page,
	 * archive pages, search results page and blog page template, and will
	 * return false in all other cases.
	 */
	function pexeto_contains_posts() {
		if ( is_page_template( 'template-blog.php' ) || is_home() 
			|| is_archive() || is_search() ) {
			return true;
		}else {
			return false;
		}
	}
}


if(!function_exists('pexeto_wrap_content_in_section')){
	function pexeto_wrap_content_in_section($content){
		if(trim($content)!=''){
			$content = '<div class="section-boxed">'.apply_filters( 'the_content', $content ).'</div>';
		}
		return $content;
	}
}

if(!function_exists('pexeto_filter_home_content')){
	function pexeto_filter_home_content( $content ) {

		$filtered_content = '';

		if(is_page_template('template-full-custom.php')){
			//regex to match the [bgsection] shortcodes
			$regex = "/\[(bgsection|pexnivoslider).*?\[\/\\1]/s";

			$matches = array();
			preg_match_all($regex, $content, $matches, PREG_OFFSET_CAPTURE );

			if(sizeof($matches[0])==0){
				return pexeto_wrap_content_in_section($content);
			}

			$bg_sections = array();
			foreach ($matches[0] as $match) {
				//retrieve the start index and end index of each shortcode
				$bg_sections[]=array(
					'text' => $match[0],
					'start_index' => $match[1],
					'end_index' => $match[1] + strlen($match[0]) - 1
					);
			}

			$last_index = 0;
			$last_bgsection_index = 0;

			while ($last_index < strlen($content)-1) {
				//go trough all the content and if it is a shortcode, append the
				//shortcode to the filtered text and if it is another text that
				//goes before/after the shortcode, wrap this content within a 
				//conbtainer div before appending it
				
				$bg_section = $bg_sections[$last_bgsection_index];

				if($last_index < $bg_section['start_index']){
					//the current index of the content is before the first index
					//of the next shortcode, which means that there is standard
					//content before the shortcode, wrap this content within
					//a container div and then append it
					$filtered_content.=pexeto_wrap_content_in_section(
						substr($content, $last_index, $bg_section['start_index']-$last_index));
					$last_index=$bg_section['start_index'];
				}elseif($last_index == $bg_section['start_index']){
					//the current index of the content is the same as the start
					//index of the next shortcode, which means that the shortcode
					//content goes now - just append the shortcode to the content
					$filtered_content.=$bg_section['text'];
					$last_index=$bg_section['end_index']+1;
					if($last_bgsection_index<sizeof($bg_sections)-1){
						//there are more shortcodes in the content after this one
						$last_bgsection_index++;
					}
				}else{
					//there are no more shortcodes and this is the last part
					//of the string - wrap this string withing a container div
					//and append it to the content
					$filtered_content.=pexeto_wrap_content_in_section(
						substr($content, $last_index, strlen($content)-1));
					$last_index = strlen($content)-1;
				}
			}

			return $filtered_content;
		}
	    
	    return $content;
	}
}

if(!function_exists('pexeto_generate_nivo_id')){
	function pexeto_generate_nivo_id(){
		global $pexeto_nivo_ids;

		if(empty($pexeto_nivo_ids)){
			$pexeto_nivo_ids=0;
		}

		return ++$pexeto_nivo_ids;
	}
}

if(!function_exists('pexeto_get_nivo_data')){

	/**
	 * Retrieves the initization data, such as images and settings
	 * for the Nivo slider
	 * @param  array $slider_data array containing the raw slider data, must
	 * have a posts key containing all the slider posts
	 * @param  string $layout_key  the type of layout
	 * @param  string $suffix      suffix for options (such as _content)
	 * @param  int $id          the ID of the slider, it must be unique
	 * @return array              array containing all the slider data,
	 * such as images and options.
	 */
	function pexeto_get_nivo_data($slider_data, $layout_key, $suffix='', $id){
		global $pexeto_content_sizes;

		$id.=pexeto_generate_nivo_id();


		$width = $pexeto_content_sizes[$layout_key];
		$height = pexeto_option( 'nivo_height'.$suffix );
		$height = is_numeric( $height )?intval( $height ):400;
		$slider_div_id='nivo-slider-'.$id;
		$autoresizing = pexeto_option( 'nivo_auto_resize'.$suffix )=='true' ? true : false;

		$data_keys = array('image_url', 'description', 'image_link');
		$slider_items=$slider_data['posts'];
		$images = array();

		foreach ( $slider_items as $key=>$item ) {

			$item_data = pexeto_get_multi_meta_values($item->ID, $data_keys, PEXETO_CUSTOM_PREFIX);
			//get the image URL
			$imgurl=$item_data['image_url'];
			if ( $autoresizing ) {
				$imgurl=pexeto_get_resized_image( $imgurl, $width, $height );
			}


			$images[]= array(
				'url' => $imgurl,
				'link' => $item_data['image_link'],
				'description' => $item_data['description']
			);
			
		}

		$options = pexeto_get_nivo_args($suffix);

		return array(
			'images' => $images,
			'options' => $options,
			'height' => $height,
			'autoresizing' => $autoresizing,
			'slider_div_id' => $slider_div_id
			);
	}
}

if(!function_exists('pexeto_get_nivo_post_images')){
	function pexeto_get_nivo_post_images($post_id, $img_size){
		$attachments = pexeto_get_post_attachments( $post_id );
		$images = array();


		foreach ( $attachments as $attachment ) {
			$img =  wp_get_attachment_image_src($attachment->ID, 'full');
			$imgurl = pexeto_get_resized_image( $img[0], $img_size['width'], $img_size['height'], $img_size['crop'] );

			$images[]= array(
				'url' => $imgurl,
				'link' => '',
				'description' => $attachment->post_content
			);

		}

		return $images;

	} 
		
		
}


if(!function_exists('pexeto_convert_hex_to_rgb')){

	/**
	 * Converts a hexadecimal color to RGB
	 * @param  string $color the hex color
	 * @return array        containing the R, G and B values
	 */
	function pexeto_convert_hex_to_rgb( $color ) {
		if ( $color[0] == '#' ) {
		        $color = substr( $color, 1 );
		}
		if ( strlen( $color ) == 6 ) {
		        list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
		        list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
		        return false;
		}
		$r = hexdec( $r );
		$g = hexdec( $g );
		$b = hexdec( $b );
		return array( 'r' => $r, 'g' => $g, 'b' => $b );
	}
}


if(!function_exists('pexeto_add_body_class')){

	/**
	 * Adds additional classes to the body class
	 * @param  array $classes the default WordPress classes added to the body
	 * @return array          the modified classes
	 */
	function pexeto_add_body_class($classes){
		//sticky header
		if(pexeto_option('sticky_header')==true){
			$classes[]='fixed-header';
		}

		//icons style
		if(pexeto_option('icon_style')=='light'){
			$classes[]='light-icons';
		}

		//responsive layout
		if(pexeto_option('responsive_layout')===false){
			$classes[]='non-responsive';
		}

		//contains posts
		if(pexeto_contains_posts()){
			$classes[]='contains-posts';
		}

		$slider = pexeto_contains_slider();
		//slider/static image layout
		if($slider){
			$classes[]='slider-active';
			if (strpos($slider, 'nivoslider') !== false){
				$classes[]='with-nivo-slider';
			}
		}else{
			$classes[]='no-slider';
		}

		if(pexeto_is_title_hidden()){
			$classes[]='no-title';
		}

		if(pexeto_option('header_overlay_bg')){
			$classes[]='dark-header';
		}

		return $classes;
	}
}

add_filter('body_class', 'pexeto_add_body_class');


if(!function_exists('pexeto_contains_slider')){
	function pexeto_contains_slider(){
		global $pexeto, $post;

		if(isset($pexeto->contains_slider)){
			return $pexeto->contains_slider;
		}

		$header = pexeto_get_single_meta($post->ID, 'slider');
		$contains_slider = (is_page() && !empty($header) && $header!=='none') ? $header : false;
		
		$pexeto->contains_slider = $contains_slider;
		return $contains_slider;
	}
}

if(!function_exists('pexeto_is_title_hidden')){
	function pexeto_is_title_hidden(){
		global $post;

		if(is_home() || (is_single() && $post->post_type=='post')){
			return true;
		}

		if(is_page()){

			$show_title = pexeto_get_single_meta($post->ID, 'show_title');
			if($show_title=='off' || (
			   $show_title=='global' && pexeto_option( 'show_page_title' )==false)){
				return true;
			}
		}

		return false;
	}
}


if(!function_exists('pexeto_excerpt_length')){

	/**
	 * Filters the post excerpt length to all posts displayed on non-posts pages.
	 * @param  int $length the default excerpth length
	 * @return int         the new excerpt length
	 */
	function pexeto_excerpt_length( $length ) {
		if(!pexeto_contains_posts()){
			return 20;
		}else{
			return $length;
		}
	}
}
add_filter( 'excerpt_length', 'pexeto_excerpt_length' );



if(!function_exists('pexeto_get_header_bg_data')){

	function pexeto_get_header_bg_data(){
		$res = array('img'=>'', 'color_css'=>'');

		$bg_options = array();
		$global_bg_options = pexeto_option('header_bg_img');
		$contains_slider = pexeto_contains_slider();

		if(is_page()){
			global $post;

			$meta_options = pexeto_get_post_meta($post->ID, array('header_bg'));
			$bg_options = $meta_options['header_bg'];
		}

		if(empty($bg_options['img']) && !empty($global_bg_options['img']) && !$contains_slider){
			//set the image that is saved in the global theme options
			$bg_options['img'] = $global_bg_options['img'];
			$bg_options['opacity'] = $global_bg_options['opacity'];
		}

		if(!empty($bg_options['color'])){
			$res['color_css'] = sprintf(' style="background-color:#%s;"', $bg_options['color']);
		}
		if(!empty($bg_options['img']) && !$contains_slider){
			$ie_opacity = floatval($bg_options['opacity'])*100;
			$res['img'] = sprintf('<div class="full-bg-image" style="background-image:url(%s); opacity:%s; filter: alpha(opacity=%d);"></div>', $bg_options['img'], $bg_options['opacity'], $ie_opacity);
		}

		return $res;
	}
}


if(!function_exists('pexeto_get_youtube_video_id')){
	function pexeto_get_youtube_video_id($url){
		$video_id = null;

		$video_url_elem = parse_url($url);
		if(isset($video_url_elem['query'])){
			parse_str($video_url_elem['query'], $query_parts);
			if(isset($query_parts['v'])){
				$video_id = $query_parts['v'];
			}
		}

		return $video_id;
	}
}

if(!function_exists('pexeto_wrap_video_element')){
	function pexeto_wrap_video_element($markup, $url, $data) {
		/* Do nothing if an error occured while parsing */
		if(!$markup) return false;



		/* Return the result */
		if(preg_match('/(youtube|vimeo)/', $url)==1){
			return '<div class="video-wrap">'.$markup.'</div>';
		}else{
			return $markup;
		}
		
	}
}
add_filter('embed_oembed_html', 'pexeto_wrap_video_element', 10, 3);

add_theme_support( 'woocommerce' );

if(!function_exists('pexeto_get_post_date_html')){
	function pexeto_get_post_date_html(){
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		return $time_string;
	}
}