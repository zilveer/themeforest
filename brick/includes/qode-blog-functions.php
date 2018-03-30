<?php
if(!function_exists('qode_post_info')){
	/**
	 * Function that loads parts of blog post info section
	 * Possible options are:
	 * 1. date
	 * 2. category
	 * 3. author
	 * 4. comments
	 * 5. like
	 * 6. share
	 *
	 * @param $config array of sections to load
	 */
	function qode_post_info($config){
		$default_config = array(
			'date' => '',
			'category' => '',
			'author' => '',
			'comments' => '',
			'like' => '',
			'share' => ''
		);

		extract(shortcode_atts($default_config, $config));

		if($date == "yes"){
			get_template_part('templates/blog/parts/post-info-date');
		}
		if($category == "yes"){
			get_template_part('templates/blog/parts/post-info-category');
		}
		if($author == "yes"){
			get_template_part('templates/blog/parts/post-info-author');
		}
		if($comments == "yes"){
			get_template_part('templates/blog/parts/post-info-comments');
		}
		if($like == "yes"){
			get_template_part('templates/blog/parts/post-info-like');
		}
		if($share == "yes"){
			get_template_part('templates/blog/parts/post-info-share');
		}
	}
}

if(!function_exists('qode_read_more_button')) {
	/**
	 * Function that outputs read more button html if necessary.
	 * It checks if read more button should be outputted only if option for given template is enabled and post does'nt have read more tag
	 * and if post isn't password protected
	 * @param string $option name of option to check
	 * @param string $class additional class to add to button
	 *
	 */
	function qode_read_more_button($option = '', $class = '') {
		global $qode_options;

		$show_read_more_button = 'yes';

		if(isset($qode_options[$option]) && $qode_options[$option] !== '') {
			$show_read_more_button = $qode_options[$option];
		}

		if($show_read_more_button == 'yes' && !qode_post_has_read_more() && !post_password_required()) {
			echo apply_filters(
				'qode_read_more_button',
				'<a href="'.get_the_permalink().'" target="_self" class="qbutton small read_more_button '.$class.'">'.__("Read More", "qode").'</a>',
				$option,
				$class
			);
		}
	}
}

if(!function_exists('qode_post_has_title')) {
	/**
	 * Function that checks if current post has title or not
	 * @return bool
	 */
	function qode_post_has_title() {
		return get_the_title() !== '';
	}
}

if(!function_exists('qode_gallery_post_format_content')) {
	/**
	 * Function that replaces gallery inserted in post content with empty string.
	 * Hooks to the_content filter
	 * Needed for gallery post format
	 * @param $content string content of current post
	 * @return mixed string changed content of current post
	 */
	function qode_gallery_post_format_content($content) {
		if(get_post_type() == 'post' && get_post_format() == 'gallery') {

			$content = preg_replace('/\[gallery.*ids=.(.*).\]/', '', $content);
		}

		return $content;
	}

	add_filter('the_content', 'qode_gallery_post_format_content');
}

if(!function_exists('qode_gallery_post_format_ids_images')) {
	/**
	 * Function that returns IDs of gallery items found in $content
	 * @param $content string content to search in
	 * @return array|bool array of IDs if found, else false
	 */
	function qode_gallery_post_format_ids_images($content) {

		preg_match('/\[gallery.*ids=.(.*).\]/', $content, $ids);

		if(is_array($ids) && count($ids) >= 2) {
			return explode(',', $ids[1]);
		}

		return false;
	}

}

if(!function_exists('qode_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $qode_word_count, which is defined in qode_set_blog_word_count function.
	 *
	 * It current post has read more tag set it will return content of the post, else it will return post excerpt
	 *
	 * @changed in 4.3 version
	 */
	function qode_excerpt() {
		global $qode_options, $qode_word_count, $post;

		if(post_password_required()) {
			echo get_the_password_form();
		}

		//does current post has read more tag set?
		elseif(qode_post_has_read_more()) {
			global $more;

			//override global $more variable so this can be used in blog templates
			$more = 0;
			the_content(true);
		}

		//is word count set to something different that 0?
		elseif($qode_word_count != '0') {
			//if word count is set and different than empty take that value, else that general option from theme options
			$word_count = isset($qode_word_count) && $qode_word_count !== "" ? $qode_word_count : esc_attr($qode_options['number_of_chars']);
			
			//if post excerpt field is filled take that as post excerpt, else that content of the post
			$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);

			//remove leading dots if those exists
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

			//if clean excerpt has text left
			if($clean_excerpt !== '') {
				//explode current excerpt to words
				$excerpt_word_array = explode (' ', $clean_excerpt);

				//cut down that array based on the number of the words option
				$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);

				//add exerpt postfix
				$excert_postfix		= apply_filters('qode_excerpt_postfix', '...');

				//and finally implode words together
				$excerpt 			= implode (' ', $excerpt_word_array).$excert_postfix;

				//is excerpt different than empty string?
				if($excerpt !== '') {
					echo '<p class="post_excerpt">'.wp_kses_post($excerpt).'</p>';
				}
			}
		}
	}
}

if(!function_exists('qode_set_blog_word_count')) {
	/**
	 * Function that sets global blog word count variable used by qode_excerpt function
	 */
	function qode_set_blog_word_count($word_count_param) {
		global $qode_word_count;

		$qode_word_count = $word_count_param;
	}
}

if (!function_exists('qode_modify_read_more_link')) {
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function qode_modify_read_more_link() {
		$link = '<div class="more-link-container">';
		$link .= '<a class="qbutton small read_more_button" href="'.get_permalink().'#more-'.get_the_ID().'"><span>'.__('Continue reading', 'qode').'</span></a>';
		$link .= '</div>';

		return $link;
	}

	add_filter( 'the_content_more_link', 'qode_modify_read_more_link');
}

if(!function_exists('qode_load_blog_assets')) {
	/**
	 * Function that checks if blog assets should be loaded
	 *
	 * @see qode_is_ajax_enabled()
	 * @see qode_is_blog_template()
	 * @see is_home()
	 * @see is_single()
	 * @see qode_has_blog_shortcode()
	 * @see is_archive()
	 * @see is_search()
	 * @see qode_has_blog_widget()
	 * @return bool
	 */
	function qode_load_blog_assets() {
		return qode_is_ajax_enabled() || qode_is_blog_template() || is_home()
		|| is_single() || qode_has_blog_shortcode() || is_archive() || is_search() || qode_has_blog_widget();
	}
}

if(!function_exists('qode_is_blog_template')) {
	/**
	 * Checks if current template page is blog template page.
	 * @param string current page. Optional parameter. If not passed qode_get_page_template_name() function will be used
	 * @return bool
	 *
	 * @see qode_get_page_template_name()
	 */
	function qode_is_blog_template($current_page = '') {

		if($current_page == '') {
			$current_page = qode_get_page_template_name();
		}

		$blog_templates = array(
			'blog-category-title-first-centered',
			'blog-date-in-title',
			'blog-masonry',
			'blog-masonry-full-width',
			'blog-masonry-gallery',
			'blog-masonry-gallery-full-width',
			'blog-post-info-hierarchical',
			'blog-split-column',
			'blog-standard',
			'blog-standard-whole-post',
			'blog-title-author-centered',
			'blog-meta-info-featured-on-side',
			'blog-meta-info-featured-on-side-with-read-more',
            'blog-vertical-loop',
		);

		return in_array($current_page, $blog_templates);
	}
}

if(!function_exists('qode_has_blog_widget')) {
	/**
	 * Function that checks if latest posts widget is added to widget area
	 * @return bool
	 */
	function qode_has_blog_widget() {
		$widgets_array = array(
			'qode_latest_posts_widget'
		);

		foreach ($widgets_array as $widget) {
			$active_widget = is_active_widget(false, false, $widget);

			if($active_widget) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('qode_has_blog_shortcode')) {
	/**
	 * Function that checks if any of blog shortcodes exists on a page
	 * @return bool
	 */
	function qode_has_blog_shortcode() {
		$blog_shortcodes = array(
			'no_blog_list',
			'no_blog_slider'
		);

		$slider_field = get_post_meta(qode_get_page_id(), 'qode_revolution-slider', true);

		foreach ($blog_shortcodes as $blog_shortcode) {
			$has_shortcode = qode_has_shortcode($blog_shortcode) || qode_has_shortcode($blog_shortcode, $slider_field);

			if($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('qode_has_blog_widget')) {
	/**
	 * Function that checks if blog widget is added to any widget area
	 * @return bool
	 */
	function qode_has_blog_widget() {
		$widgets_array = array(
			'qode_latest_posts_widget'
		);

		foreach ($widgets_array as $widget) {
			$active_widget = is_active_widget(false, false, $widget);

			if($active_widget) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('qode_post_has_read_more')) {
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function qode_post_has_read_more() {
		global $post;

		return strpos($post->post_content, '<!--more-->');
	}
}

if (!function_exists('qode_excerpt_more')) {
	/**
	 * Function that adds three dotes on the end excerpt
	 * @param $more
	 * @return string
	 */
	function qode_excerpt_more( $more ) {
		return '...';
	}

	add_filter('excerpt_more', 'qode_excerpt_more');
}

if (!function_exists('qode_excerpt_length')) {
	/**
	 * Function that changes excerpt length based on theme options
	 * @param $length int original value
	 * @return int changed value
	 */
	function qode_excerpt_length( $length ) {
		global $qode_options;

		if($qode_options['number_of_chars']){
			return esc_attr($qode_options['number_of_chars']);
		} else {
			return 45;
		}
	}

	add_filter( 'excerpt_length', 'qode_excerpt_length', 999 );
}

if (!function_exists('qode_the_excerpt_max_charlength')) {
	/**
	 * Function that sets character length for social share shortcode
	 * @param $charlength string original text
	 * @return string shortened text
	 */
	function qode_the_excerpt_max_charlength($charlength) {
		global $qode_options;

		if(isset($qode_options['twitter_via']) && !empty($qode_options['twitter_via'])) {
			$via = " via " . esc_attr($qode_options['twitter_via']) . " ";
		} else {
			$via = 	"";
		}

		$excerpt = get_the_excerpt();
		$charlength = 140 - (mb_strlen($via) + $charlength);

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength);
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				return mb_substr( $subex, 0, $excut );
			} else {
				return $subex;
			}
		} else {
			return $excerpt;
		}
	}
}