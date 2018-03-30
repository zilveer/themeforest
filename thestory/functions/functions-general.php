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


if(!function_exists('pexeto_get_header_title')){
	function pexeto_get_header_title($page_id=null){
		global $pexeto_page, $post;
		$res = array();


		if(isset( $pexeto_page['title'] )){
			$title = $pexeto_page['title'];
			if(!empty($pexeto_page['subtitle'])){
				$subtitle = $pexeto_page['subtitle'];
			}
		}elseif(is_page() || $page_id){
			$id = $page_id ? $page_id : $post->ID;
			
			$title_settings = pexeto_get_post_meta($id, array('header_title'));
			$title_settings = $title_settings['header_title'];
			if(!empty($title_settings['custom_title'])){
				$title = $title_settings['custom_title'];
			}else{
				$title=get_the_title($id);
			}
			if(!empty($title_settings['subtitle'])){
				$subtitle = $title_settings['subtitle'];
			}
		}

		

		if(!empty($title)){
			$res['title']=$title;
		}

		if(!empty($subtitle)){
			$res['subtitle']=$subtitle;
		}

		return $res;

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
	function pexeto_get_resized_image( $imgurl, $width, $height='', $crop = false, $increase_size = false ) {
		if($height && !$crop){
			$crop = true;
		}
		$width = (int)$width;
		$height = (int)$height;

		if($increase_size && $width!=0){
			$new_width = $width+150;
			$new_height = $new_width*$height/$width;
		}else{
			$new_width = $width;
			$new_height = $height;
		}

		$resized_img = aq_resize( $imgurl, $new_width, $new_height, $crop, true, true );

		if(!$resized_img){
			//the Aqua Resizer script could not crop the image, return the original image
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
			//allow the default page ID to be overwritten
			$page_id = apply_filters('pexeto_page_id', $post->ID);

			$page_settings = pexeto_get_post_meta( $page_id, array( 'slider', 'blog_layout' ) );
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
			$content = '<div class="section-boxed" id="'.pexeto_generate_section_id().'">'.apply_filters( 'the_content', $content ).'</div>';
		}
		return $content;
	}
}

if(!function_exists('vc_theme_before_vc_row')){
	function vc_theme_before_vc_row($atts, $content = null) {
		if(is_page_template('template-full-custom.php') && !pexeto_contains_fullwidth_el($content)){
			return '<div class="pexeto-vc-wrap section-boxed">';
		}
	}
}

if(!function_exists('vc_theme_after_vc_row')){
	function vc_theme_after_vc_row($atts, $content = null) {
		if(is_page_template('template-full-custom.php') && !pexeto_contains_fullwidth_el($content)){
	   		return '</div>';
	   	}
	}
}

if(!function_exists('pexeto_contains_fullwidth_el')){
	function pexeto_contains_fullwidth_el($content){
		if(pexeto_option('qg_masonry_fullpage_layout')=='full'){
			$regex = "/\[(bgsection|pexnivoslider|pexcontentslider|pexservices(?=[^\]]*pex_attr_layout=\"fullbox\")).*?|\[gallery.*?\]/s";
		}else{
			$regex = "/\[(bgsection|pexnivoslider|pexcontentslider|pexservices(?=[^\]]*pex_attr_layout=\"fullbox\")).*?/s";
		}
		if(preg_match($regex, $content)==1){
			return true;
		}
		return false;
	}
}

if(!function_exists('pexeto_contains_vc_shortcodes')){
	function pexeto_contains_vc_shortcodes( $content ){
		if(shortcode_exists('vc_row') && has_shortcode($content, 'vc_row')){
			return true;
		}
		return false;
	}
}


if(!function_exists('pexeto_filter_home_content')){
	function pexeto_filter_home_content( $content ) {

		$filtered_content = '';

		if(is_page_template('template-full-custom.php')){

			if(pexeto_contains_vc_shortcodes($content)){
				//do not wrap the content sections in boxed sections
				return $content;
			}

			//regex to match the [bgsection] shortcodes
			if(pexeto_option('qg_masonry_fullpage_layout')=='full'){
				$regex = "/\[(bgsection|pexnivoslider|pexcontentslider|pexservices(?=[^\]]*pex_attr_layout=\"fullbox\")).*?\[\/\\1]|\[gallery.*?\]/s";
			}else{
				$regex = "/\[(bgsection|pexnivoslider|pexcontentslider|pexservices(?=[^\]]*pex_attr_layout=\"fullbox\")).*?\[\/\\1]/s";
			}
			
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
		$options_suffix =  $suffix=='_content'?'':$suffix;

		$autoresizing = pexeto_option( 'nivo_auto_resize'.$options_suffix )=='true' ? true : false;

		$data_keys = array('image_url', 'description', 'image_link', 'image_link_open');
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
				'link_open' => $item_data['image_link_open'],
				'description' => $item_data['description']
			);
			
		}
		
		$options = pexeto_get_nivo_args($options_suffix);

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
	function pexeto_get_nivo_post_images($post, $img_size){
		$attachments = pexeto_get_post_gallery_images( $post );
		$images = array();


		foreach ( $attachments as $attachment ) {
			$img =  wp_get_attachment_image_src($attachment->ID, 'full');
			$imgurl = pexeto_get_resized_image( $img[0], $img_size['width'], $img_size['height'], $img_size['crop'], true );

			$images[]= array(
				'url' => $imgurl,
				'link' => '',
				'description' => $attachment->pexeto_desc
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
		global $post;

		if(pexeto_option('layout')=='boxed'){
			$classes[]='boxed-layout';
		}

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

		$icons_style = pexeto_option('header_icon_style');
		if(!empty($icons_style)){
			$classes[]='icons-style-'.$icons_style;
		}

		//header layout
		$header_layout = pexeto_option('header_layout');
		if(!empty($header_layout) && $header_layout!='left'){
			$classes[]='header-layout-'.$header_layout;
		}

		$large_header = false;
		//header size
		if(!empty($post)){
			if(is_single() && pexeto_is_header_style_post($post)){
				//post header
				$large_header_meta = pexeto_get_single_meta($post->ID, 'large_header');
				if($large_header_meta === 'true'){
					$large_header = true;
				}
			}else{
				//page
				$page_id = apply_filters('pexeto_page_id', $post->ID);
				$header_settings = pexeto_get_post_meta($page_id, array('header_display'));
				if(isset($header_settings['header_display']['large_header']) 
					&& $header_settings['header_display']['large_header']=='true'){
					$large_header = true;
				}
			}
		}

		if($large_header){
			$classes[]='large-header';
		}

		if(pexeto_option('header_parallax')==true){
			$classes[]='parallax-header';
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

		if(empty($post)){
			return false;
		}

		$page_id = apply_filters('pexeto_page_id', $post->ID);

		if(!empty($page_id)){
			$header = pexeto_get_single_meta($page_id, 'slider');
		}
		
		$contains_slider = (!empty($header) && $header!=='none') ? $header : false;
		
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
		global $post;
		$res = array('img'=>'', 'color_css'=>'');

		$bg_options = array();
		$global_bg_options = pexeto_option('header_bg_img');
		$contains_slider = pexeto_contains_slider();

		if(is_singular()){
			$is_header_post = pexeto_is_header_style_post($post);

			if(is_page() || $is_header_post){
				$meta_options = pexeto_get_post_meta($post->ID, array('header_bg'));
				$bg_options = $meta_options['header_bg'];
			}

			if($is_header_post && has_post_thumbnail( $post->ID )){
				//get the featured image
				$featured = pexeto_get_featured_image_url($post->ID);
				$bg_options['img'] = $featured;
			}
		}
		

		if(PEXETO_WOOCOMMERCE_ACTIVE && function_exists('pexeto_get_woo_header_settings')){
			$woo_bg_options = pexeto_get_woo_header_settings();
			if(!empty($woo_bg_options)){
				$bg_options = $woo_bg_options;
			}
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
		if(preg_match('/(youtube|vimeo|wordpress.tv|youtu.be|blip.tv)/', $url)==1){
			return '<div class="video-wrap">'.$markup.'</div>';
		}else{
			return $markup;
		}
		
	}
}
add_filter('embed_oembed_html', 'pexeto_wrap_video_element', 20, 3);


if(!function_exists('pexeto_get_multiupload_images')){
	function pexeto_get_multiupload_images($id_string){
		$att_ids = explode(',', $id_string);
		$images = array();

		foreach ($att_ids as $id) {
			$attachment = get_post( $id );
			$src = wp_get_attachment_image_src( intval($id), 'full');

			$images[]=array(
				'url'=>$src[0],
				'caption'=>isset($attachment->post_excerpt)?$attachment->post_excerpt:''
			);
		}

		return $images;
	}
}



if(!function_exists('pexeto_do_on_import')){
	/**
	 * Selects the theme's main menu on import
	 */
	function pexeto_do_on_import(){
		if(isset($_GET['import']) && $_GET['import']=='wordpress'){
			$menu_locations = get_theme_mod( 'nav_menu_locations' );
			$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
			
			if(empty($menu_locations['pexeto_main_menu'])){
				foreach ($menus as $menu) {
					if($menu->slug=='story-main-menu'){
						$menu_locations['pexeto_main_menu']=$menu->term_id;
						set_theme_mod('nav_menu_locations', $menu_locations);
						break;
					}
				}
			}
		}
	}
}

add_action('import_end', 'pexeto_do_on_import');


if(!function_exists('pexeto_posts_page_notice')){

	/**
	 * Prints a notice on the blog page when this page is set as a posts page
	 * so that it can warn the users that the page settings for this page
	 * won't be applied.
	 */
	function pexeto_posts_page_notice(){
		global $current_screen, $post;

		if($current_screen->base == 'post' && $current_screen->post_type=='page'){
			$posts_page_id = intval(get_option( 'page_for_posts' ));
			if($posts_page_id!=0 && $post->ID == $posts_page_id){
				$note = '<div class="error">
				<p><strong>Note:</strong> This page is set as a Posts Page in Settings &raquo; Reading.<br/> 
				If you would like to set the theme\'s custom blog options, please make sure that 
				this page <strong>is not</strong> set as a Posts Page in Settings &raquo; Reading';

				if(get_page_template_slug( $post->ID ) != 'template-blog.php'){
					$note.=' and set the Blog Page template to this page';
				}

				$note.='.</p></div>';

				echo $note;
			}
		}
	}
}

add_action('admin_notices', 'pexeto_posts_page_notice');


if(!function_exists('pexeto_generate_section_id')){
	function pexeto_generate_section_id($title = null){
		$id='';

		if(!empty($title)){
			$id = pexeto_convert_to_class($title);
			if(!empty($id)){
				if(strlen($id)>=5){
					return $id;
				}else{
					return 'section-'.$id;
				}
			}
		}

		if(empty($title) || empty($id)){
			global $pexeto;
			$id = ++$pexeto->fullwidth_section_counter;
			return 'section-'.$id;
		}

		return '';
	}
}

if(!function_exists('pexeto_get_image_url_by_id')){
	function pexeto_get_image_url_by_id($id){
		$attachment = wp_get_attachment_image_src( $id, 'single-post-thumbnail' );
		if(!empty($attachment[0])){
			return $attachment[0];
		}
		return '';
	}
}


if(!function_exists('pexeto_print_custom_slider_shortcode')){
	/**
	 * Prints a custom slider shortcode.
	 */
	function pexeto_print_custom_slider_shortcode(){
		global $post;

		if ( !empty( $post ) ) {
			$shortcode = pexeto_get_single_meta($post->ID, 'custom_slider');
			if(!empty($shortcode)){
				echo do_shortcode($shortcode);
			}
		}
	}
}

if(!function_exists('pexeto_is_header_style_post')){
	function pexeto_is_header_style_post($post){
		return $post->post_type == 'post' && pexeto_get_single_meta($post->ID, 'post_style') == 'header' ? true : false;
	}
}


if(!function_exists('pexeto_get_related_posts_html')){
	function pexeto_get_related_posts_html($post){
		$html = '';
		$columns = intval(pexeto_option('related_posts_columns'));
		if(empty($columns)){
			$columns = 3;
		}

		$args = array(
			'suppress_filters'=>false,
			'posts_per_page' => $columns,
			'post__not_in' => array($post->ID)
		);

		$tax_query = array('ralation' => 'AND' );

		//set the category
		$cats = array();
		$cat = pexeto_option('related_posts_cat');

		if($cat=='related'){
			$post_cats = get_the_category( $post->ID );
			if($post_cats){
				foreach ($post_cats as $c) {
					$cats[]=$c->term_id;
				}
			}
		}elseif($cat!=='all' && is_numeric($cat)){
			$cats[]=intval($cat);
		}

		if(!empty($cats)){
	      	$tax_query[]=array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $cats,
				'operator' => 'IN'
			);
		}

		$exclude_fromats = pexeto_option('exclude_related_posts');
		if(!empty($exclude_fromats)){
	    	$tax_query[]=array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => $exclude_fromats,
				'operator' => 'NOT IN'
			);
		}

		//post order
		if(pexeto_option('related_posts_order')=='random'){
			$args['orderby'] = 'rand';
		}


		$args['tax_query'] = $tax_query;



		$posts = get_posts($args);
		
		if(sizeof($posts)>0){
			$html .= '<div class="post-content pexeto-related-posts"><h3>'.__('You may also like', 'pexeto').'</h3>';

			$thumb_height = intval(pexeto_option('related_posts_height'));
			if(empty($thumb_height)){
				$thumb_height = null;
			}
			$html .= pexeto_get_recent_posts_column_layout_html($posts, $columns, false, $thumb_height);

			$html .='</div>';
		}

		return $html;
	}
}


if(!function_exists('pexeto_get_post_format_options')){
	function pexeto_get_post_format_options(){
		$formats = array();
		$post_formats = get_terms(array('post_format'), array('hide_empty' => false));
		foreach ($post_formats as $format) {
			$formats[]= array('id'=>$format->slug, 'name'=>$format->name);
		}

		return $formats;
	}
}


if(!function_exists('pexeto_add_thumbnails_to_feed')){
	function pexeto_add_thumbnails_to_feed( $content ) {
		global $post;
		if( has_post_thumbnail( $post->ID ) ) {
			$content = '<p>' . get_the_post_thumbnail( $post->ID, 'medium' ) . '</p>' . $content;
		}
		return $content;
	}
}
add_filter( 'the_excerpt_rss', 'pexeto_add_thumbnails_to_feed' );
add_filter( 'the_content_feed', 'pexeto_add_thumbnails_to_feed' );


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