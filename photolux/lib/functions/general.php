<?php
/**
 * This file contain some general helper functions
 *
 * @author Pexeto
 */


/**
 * Filter the main blog page query according to the blog settings in the theme's Options page
 * @param $query the WP query object
 */
function pexeto_set_blog_post_settings( $query ) {
    if ( $query->is_main_query() && is_home()) {
    	$postsPerPage=get_opt('_post_per_page_on_blog')==''?5:get_opt('_post_per_page_on_blog');
		$excludeCat=explode(',',get_opt('_exclude_cat_from_blog'));
        $query->set( 'category__not_in', $excludeCat );  //exclude the categories
        $query->set( 'posts_per_page', $postsPerPage );  //set the number of posts per page
    }
}
add_action( 'pre_get_posts', 'pexeto_set_blog_post_settings' );


/**
 * Returns a text depending on the settings set. By default the theme gets uses
 * the texts set in the Translation section of the Options page. If multiple languages enabled,
 * the default language texts are used from the Translation section and the additional language
 * texts are used from the added .mo files within the lang folder.
 * @param $textid the ID of the text
 */
function pex_text($textid){

	$locale=get_locale();
	$int_enabled=get_option(PEXETO_SHORTNAME.'_enable_translation')=='on'?true:false;
	$default_locale=get_option(PEXETO_SHORTNAME.'_def_locale');

	if($int_enabled && $locale!=$default_locale){
		//use translation - extract the text from a defined .mo file
		return __($textid, 'pexeto');
	}else{
		//use the default text settings
		return stripslashes(get_option(PEXETO_SHORTNAME.$textid));
	}
}


function pexeto_get_resized_image($imgurl, $width, $height, $align='c', $enlarge = 0){
	$resized_img = '';
	$align_options = array('t', 'l', 'b', 'r');
	$crop_from_position = false;
	$crop = empty($height) ? false : true;
	$w = $width;
	$h = $height;

	//enlarge the image for retina displays
	if($enlarge!==0){
		$w = intval($width+$enlarge);
		$h = empty($height) ? $height : intval($height*$w/$width);
	}

	if(!empty($align) && in_array($align, $align_options)){
		$crop_from_position = true;
		$resized_img = pexeto_resize_with_crop($imgurl, $w, $h, $align);
	}

	if(!$crop_from_position || ($crop_from_position && !$resized_img)){
		//either crop position is not set or crop position was set but it
		//failed to resize the image, so attempt to resize with aq resize
		$resized_img = aq_resize( $imgurl, $w, $h, $crop, true, true );
	}

	if(!$resized_img){
		//the Aqua Resizer script could not crop the image, return the original image
		$resized_img = $imgurl;
	}

	return $resized_img;
}

/**
 * Prints the pagination. Checks whether the WP-Pagenavi plugin is installed and if so, calls
 * the function for pagination of this plugin. If not- shows prints the previous and next post links.
 */
function print_pagination(){
	if(function_exists('wp_pagenavi')){
	 wp_pagenavi();
	}else{?>
<div id="blog_nav_buttons" class="navigation">
<div class="alignleft"><?php previous_posts_link('<span>&laquo;</span> '.pex_text('_previous_text')) ?></div>
<div class="alignright"><?php next_posts_link(pex_text('_next_text').' <span>&raquo;</span>') ?></div>
</div>
	<?php
	}
}


/**
 * Removes an item from an array by specifying its value
 * @param $array the array from witch to remove the item
 * @param $val the value to be removed
 * @return returns the initial array without the removed item
 */
function pexeto_remove_item_by_value($array, $val = '') {
	if (empty($array) || !is_array($array)) return false;
	if (!in_array($val, $array)) return $array;

	foreach($array as $key => $value) {
		if ($value == $val) unset($array[$key]);
	}

	return array_values($array);
}


if(!function_exists('pexeto_get_post_images')){
	/**
	 * Loads the post images into an array. First checks for a gallery inserted
	 * in the content of the post. If there is a gallery, loads the gallery images.
	 * If there isn't a gallery, loads the post attachment images. If there aren't
	 * attachment images, loads the featured image of the post (if it set).
	 * @param  $post the post object
	 * @return array containing the attachment(image) objects
	 */
	function pexeto_get_post_images($post){
		$pattern = get_shortcode_regex();
		$ids = array();
		$images = array();
		 
		//check if there is a gallery shortcode included
		if (   preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
	        && array_key_exists( 2, $matches )
	        && in_array( 'gallery', $matches[2] ) ){

	        $key = array_search('gallery', $matches[2]);
	        $att_text = $matches[3][$key];
	        $atts = shortcode_parse_atts( $att_text );
	        if(!empty($atts['ids'])){
	        	$ids = explode(',' , $atts['ids']);
	        }
	    }

	    $args = array(
						'post_type' => 'attachment', 
						'post_mime_type' =>'image',
						'numberposts' =>-1
	    			 );

	    if(!empty($ids)){
	    	//there is a gallery shortcode included
	    	$args['post__in'] = $ids;
	    }else{
	    	//there is no gallery shortcode included, load the item attachments
	    	$args['post_parent'] = $post->ID;
	    	$args['orderby'] = 'menu_order';
	    	$args['order'] = 'ASC';
	    }

	    $images = get_posts($args);

	    if(empty($images) && has_post_thumbnail($post->ID)){
	    	$att_id = get_post_thumbnail_id( $post->ID );
	    	$att = get_post($att_id);
	    	$images[]=$att;
	    	return $images;
	    }

	    if(!empty($ids)){
	    	//the images are added via the gallery shortcode, order them as set in their IDs attribute
	    	if(sizeof($images)==sizeof($ids)){
				$ordered_images = array_fill(0, sizeof($images), null);

				foreach ($images as $img) {
					$index = array_search($img->ID, $ids);
					$ordered_images[$index] = $img;
				}

				$images = $ordered_images;
			}else{
				//overcome the WP bug about not removing the deleted images IDs
				//from the gallery shortcode
				$ordered_images=array();

				foreach ($ids as $id) {
					foreach ($images as $img) {
						if($img->ID == $id){
							$ordered_images[]=$img;
							break;
						}
					}
				}
			}

	    }

	    
	    //set the description of the image
	    foreach ($images as &$img) {
	    	$alt = get_post_meta($img->ID, '_wp_attachment_image_alt', true);
	    	if(!empty($alt)){
	    		// the alt field of the image is set
	    		$img->pexeto_desc=$alt;
	    	}elseif(!empty($img->post_excerpt)){
	    		// the caption field of the image is set
	    		$img->pexeto_desc=$img->post_excerpt;
	    	}else{
	    		$img->pexeto_desc='';
	    	}
	    }

	    return $images;

	}
}


if(!function_exists('pexeto_remove_gallery_from_content')){
	function pexeto_remove_gallery_from_content($content){
		$pattern = '/\[.?gallery[^\]]*\]/';
		
		$content = preg_replace($pattern, '', $content, 1);

	    return $content;
	}
}

if(!function_exists('pexeto_add_title_to_attachment')){

	/**
	 * Adds the title parameter to the image in the quick gallery.
	 * @param  string $markup the generated markup for the image attachment link
	 * @param  int $id     the ID of the attachment
	 * @return string         the modified markup so it includes the title attribute
	 * in the markup
	 */
	function pexeto_add_title_to_attachment( $markup, $id ){
		$att = get_post( $id );
		return str_replace('<a ', '<a title="'.esc_attr($att->post_title).'" ', $markup);
	}
}
add_filter('wp_get_attachment_link', 'pexeto_add_title_to_attachment', 10, 2);


if(!function_exists('pexeto_get_sharing_options')){
	function pexeto_get_sharing_options($content_type){
		$show_btns_on = get_option(PEXETO_SHORTNAME.'_show_share_buttons_on', false);

		$display_buttons_opt = get_opt('_show_share_buttons');
		if(empty($display_buttons_opt)){
			return '';
		}
		$display_buttons = explode(',', $display_buttons_opt);

		if($show_btns_on === false && $content_type=='slider'){
			//this new option hasn't been saved to the database yet, use
			return $display_buttons;
		}else{
			if(!empty($show_btns_on)){
				if(in_array($content_type, explode(',', $show_btns_on))){
					return $display_buttons;
				}
			}
		}

		return null;
	}
}

if ( !function_exists( 'pexeto_get_share_btns_html' ) ) {

	/**
	 * Generates the sharing buttons HTML code.
	 *
	 * @param int     $post_id      the ID of the post that the buttons will be
	 * added to
	 * @param string  $content_type the type of the containing element - can
	 * be a post, page, portfolio or slider
	 * @return string               the HTML code of the buttons
	 */
	function pexeto_get_share_btns_html( $post_id, $content_type, $options = array() ) {
		$display_buttons = pexeto_get_sharing_options($content_type);
		if(empty($display_buttons)){
			return;
		}

		$permalink = isset($options['url']) ? $options['url'] : get_permalink( $post_id );
		$title = get_the_title( $post_id );
		$html = '<div class="social-share"><div class="share-title">'
			.pex_text('_share_text').'</div><ul>';

		foreach ( $display_buttons as $btn ) {
			switch ( $btn ) {
			case 'facebook':
				$html.='<li title="Facebook" class="share-item share-fb" data-url="'.$permalink
					.'" data-type="'.$btn.'" data-title="'.esc_attr($title).'"></li>';
				break;
			case 'googleplus':
				$lang = get_opt('_gplus_lang');
				if(empty($lang)){
					$lang = 'en-US';
				}
				$html.='<li title="Google+" class="share-item share-gp" data-url="'.$permalink
					.'" data-lang="'.$lang.'" data-title="'.esc_attr($title)
					.'" data-type="googlePlus"></li>';
				break;

			case 'twitter':
				$html.='<li title="Twitter" class="share-item share-tw" data-url="'.$permalink
					.'" data-title="'.esc_attr($title).'" data-type="'.$btn.'" data-text="'.esc_attr($title).'"></li>';
				break;

			case 'pinterest':
				if($content_type=='portfolio' || $content_type=='slider'){
					$cur_post = get_post($post_id);
					$img = pexeto_get_portfolio_preview_img( $cur_post );
				}else{
					$img = pexeto_get_featured_image($post_id);
				}
				$html.='<li title="Pinterest" class="share-item share-pn" data-url="'.$permalink
					.'" data-title="'.esc_attr($title).'" data-media="'.$img.'" data-type="'.$btn.'"></li>';
				break;
			}
		}

		$html.='</ul></div><div class="clear"></div>';

		return $html;
	}
}

if(!function_exists('pexeto_get_featured_image')){
	function pexeto_get_featured_image($post_id){
		$attachment = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
		if(!empty($attachment) && isset($attachment[0])){
			return $attachment[0];
		}
		return '';
	}
}



if(!function_exists('pexeto_print_social_meta_tags')){

	/**
	 * Prints the open graph tags to include image and title when the page/item
	 * is shared.
	 */
	function pexeto_print_social_meta_tags(){
		global $post;

		if(is_page_template('template-grid-gallery.php' ) && isset($_GET['share']) && is_numeric($_GET['share'])){
			$share_item = $_GET['share'];
			$cur_post = get_post(intval($share_item));
			//URL escaping with esc_url() is applied below
			$permalink = add_query_arg('share', $share_item, get_permalink($post->ID)).'#'.$share_item;
		}else{
			$cur_post = $post;
			$permalink = get_permalink($post->ID);
		}

		if(!empty($cur_post)){
			if($cur_post->post_type==PEXETO_PORTFOLIO_POST_TYPE){
				$image = pexeto_get_portfolio_preview_img($cur_post);
			}else{
				$image = pexeto_get_featured_image($cur_post->ID);
			}

			if(!empty($image)){
				//facebook meta tag
				echo '<meta property="og:image" content="'.$image.'"/>';
				echo '<meta property="og:title" content="'.esc_attr($cur_post->post_title).'"/>';
				echo '<meta property="og:url" content="'.esc_url( $permalink ).'"/>';
			} 
		}
	}
}

add_theme_support( 'woocommerce' );



if ( !function_exists( 'pexeto_print_captcha_options_script' ) ) {

	/**
	 * Prints the reCAPTCHA settings in a JavaScript code.
	 */
	function pexeto_print_captcha_options_script() {
		if ( get_opt( '_captcha' ) == 'on') {
			$contact_options['captcha']=true;

			$recaptcha_options = array(
				'theme' => 'custom',
				'custom_theme_widget'=> 'recaptcha_widget',
				'tabindex' => 4
			);

			echo '<script type="text/javascript">var RecaptchaOptions = '
				.json_encode( $recaptcha_options ).';</script>';
		}
	}
}