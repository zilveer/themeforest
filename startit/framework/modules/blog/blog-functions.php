<?php
if( !function_exists('qode_startit_get_blog') ) {
	/**
	 * Function which return holder for all blog lists
	 *
	 * @return holder.php template
	 */
	function qode_startit_get_blog($type) {

		$sidebar = qode_startit_sidebar_layout();

		$params = array(
			"blog_type" => $type,
			"sidebar" => $sidebar
		);
		qode_startit_get_module_template_part('templates/lists/holder', 'blog', '', $params);
	}

}

if( !function_exists('qode_startit_get_blog_type') ) {

	/**
	 * Function which create query for blog lists
	 *
	 * @return blog list template
	 */

	function qode_startit_get_blog_type($type) {
		global $wp_query;

		$id = qode_startit_get_page_id();
		$category = get_post_meta($id, "qodef_blog_category_meta", true);
		$post_number = esc_attr(get_post_meta($id, "qodef_show_posts_per_page_meta", true));

		$paged = qode_startit_paged();

		if(!is_archive()) {
			$blog_query = new WP_Query('post_type=post&paged=' . $paged . '&cat=' . $category . '&posts_per_page=' . $post_number);
		}else{
			$blog_query = $wp_query;
		}

		if(qode_startit_options()->getOptionValue('blog_page_range') != ""){
			$blog_page_range = esc_attr(qode_startit_options()->getOptionValue('blog_page_range'));
		} else{
			$blog_page_range = $blog_query->max_num_pages;
		}
		$params = array(
			'blog_query' => $blog_query,
			'paged' => $paged,
			'blog_page_range' => $blog_page_range,
			'blog_type' => $type
		);

		qode_startit_get_module_template_part('templates/lists/' .  $type, 'blog', '', $params);
        wp_reset_postdata();
	}

}



if( !function_exists('qode_startit_get_post_format_html') ) {

	/**
	 * Function which return html for post formats
	 * @param $type
	 * @return post hormat template
	 */

	function qode_startit_get_post_format_html($type = "") {

		$post_format = get_post_format();
		if($post_format === false){
			$post_format = 'standard';
		}
		$slug = '';
		if($type !== ""){
			$slug = $type;
		}

		$params = array();

		$chars_array = qode_startit_blog_lists_number_of_chars();
		if(isset($chars_array[$type])) {
			$params['excerpt_length'] = $chars_array[$type];
		} else {
			$params['excerpt_length'] = '';
		}

		$params['type'] = $slug;

		$group = '';
		if ($slug == '') {
			$group = 'standard';
		}
		else if(in_array($slug, qode_startit_blog_masonry_types())){
			$group = 'masonry';
		}
		else if(in_array($slug, qode_startit_blog_standard_types())){
            $group = 'standard';
        }
        else if(in_array($slug, qode_startit_blog_gallery_types())){
            $group = 'gallery';
        }

		qode_startit_get_module_template_part('templates/lists/post-formats/' .$group .'/' . $post_format, 'blog', $slug, $params);

	}

}

if( !function_exists('qode_startit_get_default_blog_list') ) {
	/**
	 * Function which return default blog list for archive post types
	 *
	 * @return post format template
	 */

	function qode_startit_get_default_blog_list() {

		$blog_list = qode_startit_options()->getOptionValue('blog_list_type');
		return $blog_list;

	}

}


if (!function_exists('qode_startit_pagination')) {

	/**
	 * Function which return pagination
	 *
	 * @return blog list pagination html
	 */

	function qode_startit_pagination($pages = '', $range = 4, $paged = 1){

		$showitems = $range+1;

		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages){
				$pages = 1;
			}
		}
		if(1 != $pages){

			echo '<div class="qodef-pagination">';
				echo '<ul>';
					if($paged > 2 && $paged > $range+1 && $showitems < $pages){
						echo '<li class="qodef-pagination-first-page"><a href="'.esc_url(get_pagenum_link(1)).'"><<</a></li>';
					}
					echo "<li class='qodef-pagination-prev";
					if($paged > 2 && $paged > $range+1 && $showitems < $pages) {
						echo " qodef-pagination prev-first";
					}
					echo "'><a href='".esc_url(get_pagenum_link($paged - 1))."'><i class='fa fa-chevron-left'></i></a></li>";

					for ($i=1; $i <= $pages; $i++){
						if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
							echo ($paged == $i)? "<li class='active'><span>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
						}
					}

					echo '<li class="qodef-pagination-next';
					if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
						echo ' qodef-pagination-next-last';
					}
					echo '"><a href="';
					if($pages > $paged){
						echo esc_url(get_pagenum_link($paged + 1));
					} else {
						echo esc_url(get_pagenum_link($paged));
					}
					echo '"><i class="fa fa-chevron-right"></i></a></li>';
					if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
						echo '<li class="qodef-pagination-last-page"><a href="'.esc_url(get_pagenum_link($pages)).'">>></a></li>';
					}
				echo '</ul>';
			echo "</div>";
		}
	}
}

if(!function_exists('qode_startit_post_info')){
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
	function qode_startit_post_info($config,  $params = array()){
		$default_config = array(
			'date' => '',
			'author' => '',
			'category' => '',
			'comments' => '',
			'like' => '',
			'share' => ''
		);

		extract(shortcode_atts($default_config, $config));

		if($date == 'yes'){
			qode_startit_get_module_template_part('templates/parts/post-info-date', 'blog');
		}
		if($author == 'yes'){
			qode_startit_get_module_template_part('templates/parts/post-info-author', 'blog');
		}
		if($category == 'yes'){
			qode_startit_get_module_template_part('templates/parts/post-info-category', 'blog', '', $params);
		}
		if($comments == 'yes'){
			qode_startit_get_module_template_part('templates/parts/post-info-comments', 'blog');
		}
		if($like == 'yes'){
			qode_startit_get_module_template_part('templates/parts/post-info-like', 'blog');
		}
		if($share == 'yes'){
			qode_startit_get_module_template_part('templates/parts/post-info-share', 'blog');
		}
	}
}

if(!function_exists('qode_startit_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in qode_set_blog_word_count function.
	 *
	 * It current post has read more tag set it will return content of the post, else it will return post excerpt
	 *
	 */
	function qode_startit_excerpt($excerpt_length) {
		global $post;

		if(post_password_required()) {
			echo get_the_password_form();
		}

		//does current post has read more tag set?
		elseif(qode_startit_post_has_read_more()) {
			global $more;

			//override global $more variable so this can be used in blog templates
			$more = 0;
			the_content(true);
		}

		//is word count set to something different that 0?
		elseif($excerpt_length != '0') {
			//if word count is set and different than empty take that value, else that general option from theme options
			$word_count = isset($excerpt_length) && $excerpt_length !== "" ? $excerpt_length : esc_attr(qode_startit_options()->getOptionValue('number_of_chars'));

			//If there is no value set for excerpt
			if($word_count == 0) {
				$word_count = 30;
			}

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
				$excert_postfix		= apply_filters('qode_startit_excerpt_postfix', '...');

				//and finally implode words together
				$excerpt 			= implode (' ', $excerpt_word_array).$excert_postfix;

				//is excerpt different than empty string?
				if($excerpt !== '') {
					echo '<p class="qodef-post-excerpt">'.wp_kses_post($excerpt).'</p>';
				}
			}
		}
	}
}

if(!function_exists('qode_startit_get_blog_single')) {

	/**
	 * Function which return holder for single posts
	 *
	 * @return single holder.php template
	 */

	function qode_startit_get_blog_single() {
		$sidebar = qode_startit_sidebar_layout();

		$params = array(
			"sidebar" => $sidebar
		);

		qode_startit_get_module_template_part('templates/single/holder', 'blog', '', $params);
	}
}

if( !function_exists('qode_startit_get_single_html') ) {

	/**
	 * Function return all parts on single.php page
	 *
	 *
	 * @return single.php html
	 */

	function qode_startit_get_single_html() {

		$post_format = get_post_format();
		if($post_format === false){
			$post_format = 'standard';
		}

		qode_startit_get_module_template_part('templates/single/post-formats/' . $post_format, 'blog');
		qode_startit_get_module_template_part('templates/single/parts/single-navigation', 'blog');
		qode_startit_get_module_template_part('templates/single/parts/author-info', 'blog');
		if(qode_startit_show_comments()){
			comments_template('', true);
		}
	}

}
if( !function_exists('qode_startit_additional_post_items') ) {

	/**
	 * Function which return parts on single.php which are just below content
	 *
	 * @return single.php html
	 */

	function qode_startit_additional_post_items() {

		if(has_tag()){
			qode_startit_get_module_template_part('templates/single/parts/tags', 'blog');
		}

		qode_startit_get_module_template_part('templates/parts/post-info-share', 'blog');

		$args_pages = array(
			'before'           => '<div class="qodef-single-links-pages"><div class="qodef-single-links-pages-inner">',
			'after'            => '</div></div>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'pagelink'         => '%'
		);

		wp_link_pages($args_pages);

	}
	add_action('qode_startit_before_blog_article_closed_tag', 'qode_startit_additional_post_items');
}


if (!function_exists('qode_startit_comment')) {

	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */

	function qode_startit_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		global $post;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment  = $post->post_author == $comment->user_id;

		$comment_class = 'qodef-comment clearfix';

		if($is_author_comment) {
			$comment_class .= ' qodef-post-author-comment';
		}

		if($is_pingback_comment) {
			$comment_class .= ' qodef-pingback-comment';
		}

		?>

		<li>
		<div class="<?php echo esc_attr($comment_class); ?>">
			<?php if(!$is_pingback_comment) { ?>
				<div class="qodef-comment-image"> <?php echo qode_startit_kses_img(get_avatar($comment, 75)); ?> </div>
			<?php } ?>
			<div class="qodef-comment-text">
				<div class="qodef-comment-info">
					<h5 class="qodef-comment-name">
						<?php if($is_pingback_comment) { esc_html_e('Pingback:', 'startit'); } ?>
						<?php echo wp_kses_post(get_comment_author_link()); ?>
						<?php if($is_author_comment) { ?>
							<i class="fa fa-user post-author-comment-icon"></i>
						<?php } ?>
					</h5>
				<?php
					comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']) ) );
					edit_comment_link();
				?>
			</div>
			<div class="qodef-comment-date-holder">
				<span class="qodef-comment-date"><?php esc_html_e('Posted at ', 'startit') . comment_time(get_option('time_format')); ?><?php esc_html_e(', ', 'startit'); ?><?php comment_time(get_option('date_format')); ?></span>
			</div>
			<?php if(!$is_pingback_comment) { ?>
				<div class="qodef-text-holder" id="comment-<?php echo comment_ID(); ?>">
					<?php comment_text(); ?>
				</div>
			<?php } ?>
		</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>

		<?php
	}
}

if( !function_exists('qode_startit_blog_archive_pages_classes') ) {

	/**
	 * Function which create classes for container in archive pages
	 *
	 * @return array
	 */

	function qode_startit_blog_archive_pages_classes($blog_type) {

		$classes = array();
		if(in_array($blog_type, qode_startit_blog_full_width_types())){
			$classes['holder'] = 'qodef-full-width';
			$classes['inner'] = 'qodef-full-width-inner';
		} elseif(in_array($blog_type, qode_startit_blog_grid_types())){
			$classes['holder'] = 'qodef-container';
			$classes['inner'] = 'qodef-container-inner clearfix';
		}

		return $classes;

	}

}

if( !function_exists('qode_startit_blog_full_width_types') ) {

	/**
	 * Function which return all full width blog types
	 *
	 * @return array
	 */

	function qode_startit_blog_full_width_types() {

		$types = array('masonry-full-width', 'gallery');

		return $types;

	}

}

if( !function_exists('qode_startit_blog_grid_types') ) {

	/**
	 * Function which return in grid blog types
	 *
	 * @return array
	 */

	function qode_startit_blog_grid_types() {

		$types = array('standard', 'masonry', 'standard-whole-post');

		return $types;

	}

}

if( !function_exists('qode_startit_blog_types') ) {

	/**
	 * Function which return all blog types
	 *
	 * @return array
	 */

	function qode_startit_blog_types() {

		$types = array_merge(qode_startit_blog_grid_types(), qode_startit_blog_full_width_types());

		return $types;

	}

}

if( !function_exists('qode_startit_blog_templates') ) {

	/**
	 * Function which return all blog templates names
	 *
	 * @return array
	 */

	function qode_startit_blog_templates() {

		$templates = array();
		$grid_templates = qode_startit_blog_grid_types();
		$full_templates = qode_startit_blog_full_width_types();
		foreach($grid_templates as $grid_template){
			array_push($templates, 'blog-'.$grid_template);
		}
		foreach($full_templates as $full_template){
			array_push($templates, 'blog-'.$full_template);
		}

		return $templates;

	}

}

if( !function_exists('qode_startit_blog_masonry_types') ) {

	/**
	 * Function which return masonry blog types
	 *
	 * @return array
	 */

	function qode_startit_blog_masonry_types() {

		$types = array('masonry', 'masonry-full-width');

		return $types;

	}

}

if( !function_exists('qode_startit_blog_standard_types') ) {

	/**
	 * Function which return masonry blog types
	 *
	 * @return array
	 */

	function qode_startit_blog_standard_types() {

		$types = array('standard', 'standard-whole-post');

		return $types;

	}

}

if( !function_exists('qode_startit_blog_gallery_types') ) {

    /**
     * Function which return masonry blog types
     *
     * @return array
     */

    function qode_startit_blog_gallery_types() {

        $types = array('gallery');

        return $types;

    }

}

if( !function_exists('qode_startit_blog_lists_number_of_chars') ) {

	/**
	 * Function that return number of characters for different lists based on options
	 *
	 * @return int
	 */

	function qode_startit_blog_lists_number_of_chars() {

		$number_of_chars = array();
		if(qode_startit_options()->getOptionValue('standard_number_of_chars')) {
			$number_of_chars['standard'] = qode_startit_options()->getOptionValue('standard_number_of_chars');
		}
		if(qode_startit_options()->getOptionValue('masonry_number_of_chars')) {
			$number_of_chars['masonry'] = qode_startit_options()->getOptionValue('masonry_number_of_chars');
		}
        if(qode_startit_options()->getOptionValue('gallery_number_of_chars')) {
            $number_of_chars['gallery'] = qode_startit_options()->getOptionValue('gallery_number_of_chars');
        }

		return $number_of_chars;

	}

}

if (!function_exists('qode_startit_excerpt_length')) {
	/**
	 * Function that changes excerpt length based on theme options
	 * @param $length int original value
	 * @return int changed value
	 */
	function qode_startit_excerpt_length( $length ) {

		if(qode_startit_options()->getOptionValue('number_of_chars') !== ''){
			return esc_attr(qode_startit_options()->getOptionValue('number_of_chars'));
		} else {
			return 45;
		}
	}

	add_filter( 'excerpt_length', 'qode_startit_excerpt_length', 999 );
}

if (!function_exists('qode_startit_excerpt_more')) {
	/**
	 * Function that adds three dotes on the end excerpt
	 * @param $more
	 * @return string
	 */
	function qode_startit_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'qode_startit_excerpt_more');
}

if(!function_exists('qode_startit_post_has_read_more')) {
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function qode_startit_post_has_read_more() {
		global $post;

		return strpos($post->post_content, '<!--more-->');
	}
}

if(!function_exists('qode_startit_post_has_title')) {
	/**
	 * Function that checks if current post has title or not
	 * @return bool
	 */
	function qode_startit_post_has_title() {
		return get_the_title() !== '';
	}
}

if (!function_exists('qode_startit_modify_read_more_link')) {
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function qode_startit_modify_read_more_link() {
		$link = '<div class="qodef-more-link-container">';
		$link .= qode_startit_get_button_html(array(
			'link' => get_permalink().'#more-'.get_the_ID(),
			'text' => esc_html__('Continue reading', 'startit')
		));

		$link .= '</div>';

		return $link;
	}

	add_filter( 'the_content_more_link', 'qode_startit_modify_read_more_link');
}


if(!function_exists('qode_startit_has_blog_widget')) {
	/**
	 * Function that checks if latest posts widget is added to widget area
	 * @return bool
	 */
	function qode_startit_has_blog_widget() {
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

if(!function_exists('qode_startit_has_blog_shortcode')) {
	/**
	 * Function that checks if any of blog shortcodes exists on a page
	 * @return bool
	 */
	function qode_startit_has_blog_shortcode() {
		$blog_shortcodes = array(
			'qodef_blog_list',
			'qodef_blog_slider',
			'qodef_blog_carousel'
		);

		$slider_field = get_post_meta(qode_startit_get_page_id(), 'qode_revolution-slider', true); //TODO change

		foreach ($blog_shortcodes as $blog_shortcode) {
			$has_shortcode = qode_startit_has_shortcode($blog_shortcode) || qode_startit_has_shortcode($blog_shortcode, $slider_field);

			if($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}


if(!function_exists('qode_startit_load_blog_assets')) {
	/**
	 * Function that checks if blog assets should be loaded
	 *
	 * @see qode_is_blog_template()
	 * @see is_home()
	 * @see is_single()
	 * @see qode_has_blog_shortcode()
	 * @see is_archive()
	 * @see is_search()
	 * @see qode_has_blog_widget()
	 * @return bool
	 */
	function qode_startit_load_blog_assets() {
		return qode_startit_is_blog_template() || is_home() || is_single() || qode_startit_has_blog_shortcode() || is_archive() || is_search() || qode_startit_has_blog_widget();
	}
}

if(!function_exists('qode_startit_is_blog_template')) {
	/**
	 * Checks if current template page is blog template page.
	 *
	 *@param string current page. Optional parameter.
	 *
	 *@return bool
	 *
	 * @see qode_startit_get_page_template_name()
	 */
	function qode_startit_is_blog_template($current_page = '') {

		if($current_page == '') {
			$current_page = qode_startit_get_page_template_name();
		}

		$blog_templates = qode_startit_blog_templates();

		return in_array($current_page, $blog_templates);
	}
}

if(!function_exists('qode_startit_read_more_button')) {
	/**
	 * Function that outputs read more button html if necessary.
	 * It checks if read more button should be outputted only if option for given template is enabled and post does'nt have read more tag
	 * and if post isn't password protected
	 *
	 * @param string $option name of option to check
	 * @param string $class additional class to add to button
	 *
	 */
	function qode_startit_read_more_button($option = '', $class = '') {
		if($option != '') {
			$show_read_more_button = qode_startit_options()->getOptionValue($option) == 'yes';
		}else {
			$show_read_more_button = 'yes';
		}
		if($show_read_more_button && !qode_startit_post_has_read_more() && !post_password_required()) {
			echo qode_startit_get_button_html(array(
				'size'         => 'small',
				'link'         => get_the_permalink(),
				'text'         => esc_html__('Read More', 'startit'),
				'custom_class' => $class
			));
		}
	}
}

if(!function_exists('qode_startit_add_user_custom_fields')) {

	/**
	 * Function that extends wordpress user info with social media links
	 */

	function qode_startit_add_user_custom_fields($user_contact) {
		$user_contact['facebook']   = esc_html__( 'Facebook', 'startit');
		$user_contact['twitter'] = esc_html__( 'Twitter', 'startit');
		$user_contact['instagram'] = esc_html__( 'Instagram', 'startit');
		$user_contact['dribbble'] = esc_html__( 'Dribbble', 'startit');
		$user_contact['linkedin'] = esc_html__( 'LinkedIn', 'startit' );

		return $user_contact;
	}

	add_filter( 'user_contactmethods', 'qode_startit_add_user_custom_fields' );
}

if(!function_exists('qode_startit_get_user_gravatar')) {

	/**
	 * Function for connecting wordpress user account with gravatar
	 */

	function qode_startit_get_user_gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array()) {
		$url = 'http://www.gravatar.com/avatar/';
		$url .= md5(strtolower(trim($email)));
		$url .= "?s=$s&d=$d&r=$r";
		if ($img) {
			$url = '<img src="' . $url . '"';
			foreach ($atts as $key => $val)
				$url .= ' ' . $key . '="' . $val . '"';
			$url .= ' alt="user-gravatar"/>';
		}
		return $url;
	}
}



?>