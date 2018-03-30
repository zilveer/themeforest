<?php
if(!function_exists('theme_section_introduce')){
/**
 * The default template for displaying introduce in the pages
 */
function theme_section_introduce($post_id = NULL, $show_any_way = false, $show_by_id = false){
	if (is_blog()){
		$blog_page_id = theme_get_option('blog','blog_page');
		$post_id = wpml_get_object_id($blog_page_id,'page');
	}
	if (is_single() || is_page() || (is_front_page() && $post_id != NULL) || (is_home() && $post_id != NULL) || (!empty($post_id) && $show_by_id)){
		$type = get_post_meta($post_id, '_introduce_text_type', true);
		$text = '';
		if (empty($type))
			$type = 'default';
		
		if (!theme_get_option('general','introduce') && $type=='default'){
			return;
		}
		
		if ($type == 'disable') {
			return;
		}

		if (in_array($type, array('default', 'title', 'title_custom','title_slideshow'))) {
			$custom_title = get_post_meta($post_id, '_custom_title', true);
			if(!empty($custom_title) && $type !== 'default'){
				$title = $custom_title;
			}else{
				$title = get_the_title($post_id);
			}
		}
		if (in_array($type, array('slideshow', 'custom_slideshow','title_slideshow'))) {
			$stype = get_post_meta($post_id, '__slideshow_type', true);
			$scategory = get_post_meta($post_id, '_slideshow_category', true);
			$number = get_post_meta($post_id, '_slideshow_number', true);

			if ($type == 'slideshow' ){
				if($stype == 'revslider'){
					if(function_exists('putRevSlider')){
						$rev_id = get_post_meta($post_id, '_slideshow_rev', true);
						ob_start();
						putRevSlider($rev_id);
						$content = ob_get_clean();


						return '<div id="feature" class="revslider with_shadow">'.$content.'</div>';
					} else {
						return '';
					}
				} else {
					return theme_generator('slideshow',$stype,$scategory,'',$number);
				}
			}else{
				if($stype == 'revslider'){
					if(function_exists('putRevSlider')){
						$rev_id = get_post_meta($post_id, '_slideshow_rev', true);
						ob_start();
						putRevSlider($rev_id);
						$content = ob_get_clean();

						
						return '<div id="feature" class="revslider with_shadow">'.$content.'</div>';
					} else {
						return '';
					}
				} else {
					if($type == 'custom_slideshow'){
						$text = do_shortcode(get_post_meta($post_id, '_custom_introduce_text', true));
					}elseif($type == 'title_slideshow'){
						$text = '<h1>'.$title.'</h1>';
					}
					
					return theme_generator('slideshow',$stype,$scategory,'',$number,$text);
				}
			}
		}		
		
		if (in_array($type, array('custom', 'title_custom'))) {
			$text = do_shortcode(get_post_meta($post_id, '_custom_introduce_text', true));
		}

		$blog_page_id = theme_get_option('blog','blog_page');
		$blog_page_id = wpml_get_object_id($blog_page_id,'page');

		if($type === 'default' && is_singular('post') && $post_id!=$blog_page_id){
			$single_header = theme_get_option('blog','single_header');
			if($single_header === 'blog' && !empty($blog_page_id)){
				return theme_generator('introduce',$blog_page_id);
			}
		}

		$show_in_header = theme_get_inherit_option($post_id, '_show_in_header', 'blog','show_in_header');
		if ($show_in_header && is_singular('post') && $post_id!=$blog_page_id && in_array($type, array('default', 'title', 'custom', 'title_custom'))) {
			$meta_html = theme_generator('blog_meta',true);
			if($meta_html) {
				$text .= '<div class="entry_meta">';
				$text .= $meta_html;
				$text .= '</div>';
			}
		}
	}else{
		if (is_home() || is_front_page()) {
			if (theme_get_option('homepage','show_homepage_title')) {
				$title= theme_get_option('homepage','homepage_custom_title');
				$text= theme_get_option('homepage','homepage_custom_introduce_text');
				$text = do_shortcode(stripslashes($text));
				if (empty($title)&&empty($text)) $title=__('Home','striking-r');
				if (!empty($title) || !empty($text)) $show_any_way='true';
			} else return;
		}
		if(!theme_get_option('general','introduce') && !$show_any_way){
			return;
		}
	}

	if (is_archive() && !$show_by_id){
		$title = __('Archives','striking-r');
		if(function_exists('is_post_type_archive')){
			if(is_post_type_archive()){
				$title = wpml_t(THEME_NAME, get_query_var( 'post_type' ) . ' Post Type Archive Title',theme_get_option('advanced','archive_'.get_query_var( 'post_type' ).'_title'));
				if($title === false){
					$title = theme_get_option('advanced','archive_'.get_query_var( 'post_type' ).'_title');
				}
				$text = wpml_t(THEME_NAME, get_query_var( 'post_type' ) . ' Post Type Archive Text',theme_get_option('advanced','archive_'.get_query_var( 'post_type' ).'_text'));
				if($text === false ){
					$text = theme_get_option('advanced','archive_'.get_query_var( 'post_type' ).'_text');
				}
				$classes = get_body_class();
				if ( in_array('forum-archive',$classes) && in_array('bbpress',$classes)) {
					$text = theme_get_option('advanced','archive_'.get_query_var( 'post_type' ).'_text');
				}
				$post_type = get_post_type_object( get_query_var( 'post_type' ) );
				$title = sprintf($title,$post_type->name);
				$text = sprintf($text,$post_type->name);
			}
		}
		if(is_category()){
			$title = wpml_t(THEME_NAME, 'Category Archive Title',theme_get_option('advanced','category_title'));
			$text = wpml_t(THEME_NAME, 'Category Archive Text',theme_get_option('advanced','category_text'));
			$title = sprintf($title,single_cat_title('',false));
			$text = sprintf($text,single_cat_title('',false));
		}elseif(is_tag()){
			$title = wpml_t(THEME_NAME, 'Tag Archive Title',theme_get_option('advanced','tag_title'));
			$text = wpml_t(THEME_NAME, 'Tag Archive Text',theme_get_option('advanced','tag_text'));
			$title = sprintf($title,single_tag_title('',false));
			$text = sprintf($text,single_tag_title('',false));
		}elseif(is_date() && is_numeric(get_query_var('w')) && 0 !== get_query_var('w') ){
			$title = wpml_t(THEME_NAME, 'Weekly Archive Title',theme_get_option('advanced','weekly_title'));
			$text = wpml_t(THEME_NAME, 'Weekly Archive Text',theme_get_option('advanced','weekly_text'));
			$title = sprintf($title,get_the_time('W'));
			$text = sprintf($text,get_the_time('W'));
		}elseif(is_day()){
			$title = wpml_t(THEME_NAME, 'Daily Archive Title',theme_get_option('advanced','daily_title'));
			$text = wpml_t(THEME_NAME, 'Daily Archive Text',theme_get_option('advanced','daily_text'));
			$title = sprintf($title,get_the_time('F jS, Y'));
			$text = sprintf($text,get_the_time('F jS, Y'));
		}elseif(is_month()){
			$title = wpml_t(THEME_NAME, 'Monthly Archive Title',theme_get_option('advanced','monthly_title'));
			$text = wpml_t(THEME_NAME, 'Monthly Archive Text',theme_get_option('advanced','monthly_text'));
			$title = sprintf($title,get_the_time('F, Y'));
			$text = sprintf($text,get_the_time('F, Y'));
		}elseif(is_year()){
			$title = wpml_t(THEME_NAME, 'Yearly Archive Title',theme_get_option('advanced','yearly_title'));
			$text = wpml_t(THEME_NAME, 'Yearly Archive Text',theme_get_option('advanced','yearly_text'));
			$title = sprintf($title,get_the_time('Y'));
			$text = sprintf($text,get_the_time('Y'));
		}elseif(is_author()){
			$title = wpml_t(THEME_NAME, 'Author Archive Title',theme_get_option('advanced','author_title'));
			$text = wpml_t(THEME_NAME, 'Author Archive Text',theme_get_option('advanced','author_text'));

			if(get_query_var('author_name')){
				$curauth = get_user_by('slug', get_query_var('author_name'));
			} else {
				$curauth = get_userdata(get_query_var('author'));
			}
			$title = sprintf($title,$curauth->nickname);
			$text = sprintf($text,$curauth->nickname);
		}elseif(isset($_GET['paged']) && !empty($_GET['paged'])) {
			$title = wpml_t(THEME_NAME, 'Blog Archive Title',theme_get_option('advanced','blog_title'));
			$text = wpml_t(THEME_NAME, 'Blog Archive Text',theme_get_option('advanced','blog_text'));
		}elseif(is_tax()){
			$title = wpml_t(THEME_NAME, get_query_var( 'taxonomy' ) . ' Taxonomy Archive Title',theme_get_option('advanced','taxonomy_'.get_query_var( 'taxonomy' ).'_title'));
			if($title === false){
				$title = theme_get_option('advanced','taxonomy_'.get_query_var( 'taxonomy' ).'_title');
			}
			if($title === false){
				$title = wpml_t(THEME_NAME, 'Taxonomy Archive Title',theme_get_option('advanced','taxonomy_title'));
			}
			$text = wpml_t(THEME_NAME, get_query_var( 'taxonomy' ) . ' Taxonomy Archive Text',theme_get_option('advanced','taxonomy_'.get_query_var( 'taxonomy' ).'_text'));
			if($text === false ){
				$text = theme_get_option('advanced','taxonomy_'.get_query_var( 'taxonomy' ).'_text');
			}
			if($text === false ){
				$text = wpml_t(THEME_NAME, 'Taxonomy Archive Text',theme_get_option('advanced','taxonomy_text'));
			}
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$title = sprintf($title,$term->name);
			$text = sprintf($text,$term->name);
		}
		$title = stripslashes($title);
		$text = do_shortcode(stripslashes($text));
	}

	if (is_404()) {
		$title = wpml_t(THEME_NAME, '404 Page Title',theme_get_option('advanced','404_title'));
		$text = wpml_t(THEME_NAME, '404 Page Text',theme_get_option('advanced','404_text'));
		$title = stripslashes($title);
		$text = do_shortcode(stripslashes($text));
	}

	if (is_search()) {
		$title = wpml_t(THEME_NAME, 'Search Page Title',theme_get_option('advanced','search_title'));
		$text = wpml_t(THEME_NAME, 'Search Page Text',theme_get_option('advanced','search_text'));
		$searchquery = esc_html(preg_replace( "/\\[(.*?)\\]/", "&#91;$1&#93;", get_search_query()));
		$text = sprintf($text,stripslashes( strip_tags( $searchquery ) ));		
		$title = stripslashes($title);
		$text = do_shortcode(stripslashes($text));
	}
	if( function_exists('is_woocommerce') && is_woocommerce()){
		if(!is_shop() && is_archive() && !theme_is_enabled(theme_get_option('advanced','woocommerce_introduce'), theme_get_option('general','introduce'))){
			return;
		}
		if(function_exists('is_shop') && is_shop() && !$show_by_id){
			$shop_id = woocommerce_get_page_id( 'shop' );
				$type = get_post_meta($shop_id, '_introduce_text_type', true);
				
				if (empty($type)){
					$type = 'default';
				}
				if($type !== 'default'){
					return theme_generator('introduce', $shop_id, false, true);
				}
		}
	}

	if ( class_exists( 'Tribe__Events__Main' ) ) {
		if ( tribe_is_list_view() || tribe_is_showing_all() || tribe_is_month() || tribe_is_day()) {
			//$title = wp_title( '', false);
			global $wp_version;
			if ( ! function_exists( '_wp_render_title_tag' ) || version_compare(preg_replace("/[^0-9\.]/","",$wp_version), '4.4', '<')  ) {
				$title = wp_title( '', false);
			} else 	$title =  wp_get_document_title(); 		
		}
	}

	$output = '';
	$output .= '<div id="feature">';
	$output .= '<div class="top_shadow"></div>';
	$output .= '<div class="inner">';
	if (isset($title) && !empty($title)) {
		$output .= '<h1 class="entry-title">' . $title . '</h1>';
	}
	if (isset($text) && !empty($text)) {
		$output .= '<div class="feature-introduce" id="introduce">';
		$output .= $text;
		$output .= '</div>';
	}
	$output .= '</div>';
	$output .= '<div class="bottom_shadow"></div>';
	$output .= '</div>';
	
	return $output;
}
}