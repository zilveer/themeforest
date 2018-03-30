<?php
if (!function_exists('hue_mikado_get_blog')) {
	/**
	 * Function which return holder for all blog lists
	 *
	 * @return holder.php template
	 */
	function hue_mikado_get_blog($type)
	{

		$sidebar = hue_mikado_sidebar_layout();

		$params = array(
			"blog_type" => $type,
			"sidebar"   => $sidebar
		);
		hue_mikado_get_module_template_part('templates/lists/holder', 'blog', '', $params);
	}

}

if (!function_exists('hue_mikado_get_blog_type')) {

	/**
	 * Function which create query for blog lists
	 *
	 * @return blog list template
	 */

	function hue_mikado_get_blog_type($type)
	{

		$blog_query = hue_mikado_get_blog_query();

		$paged = hue_mikado_paged();
		$blog_classes = '';

		if (hue_mikado_options()->getOptionValue('blog_page_range') != "") {
			$blog_page_range = esc_attr(hue_mikado_options()->getOptionValue('blog_page_range'));
		} else {
			$blog_page_range = $blog_query->max_num_pages;
		}
		$show_load_more = hue_mikado_enable_load_more();

		if ($show_load_more) {
			$blog_classes .= ' mkd-blog-load-more';
		}

		$params = array(
			'blog_query'      => $blog_query,
			'paged'           => $paged,
			'blog_page_range' => $blog_page_range,
			'blog_type'       => $type,
			'blog_classes'    => $blog_classes
		);

		hue_mikado_get_module_template_part('templates/lists/' . $type, 'blog', '', $params);
	}

}

if (!function_exists('hue_mikado_get_blog_query')) {
	/**
	 * Function which create query for blog lists
	 *
	 * @return wp query object
	 */
	function hue_mikado_get_blog_query()
	{
		global $wp_query;

		$id = hue_mikado_get_page_id();
		$category = esc_attr(get_post_meta($id, "mkd_blog_category_meta", true));
		if (esc_attr(get_post_meta($id, "mkd_show_posts_per_page_meta", true)) != "") {
			$post_number = esc_attr(get_post_meta($id, "mkd_show_posts_per_page_meta", true));
		} else {
			$post_number = esc_attr(get_option('posts_per_page'));
		}

		$paged = hue_mikado_paged();
		$query_array = array(
			'post_type'      => 'post',
			'paged'          => $paged,
			'cat'            => $category,
			'posts_per_page' => $post_number
		);
		if (is_archive() || is_search()) {
			$blog_query = $wp_query;
		} else {
			$blog_query = new WP_Query($query_array);
		}

		return $blog_query;
	}
}

if (!function_exists('hue_mikado_add_user_custom_fields')) {
	/**
	 * Function creates custom social fields for users
	 *
	 * return $user_contact
	 */
	function hue_mikado_add_user_custom_fields($user_contact)
	{

		/**
		 * Function that add custom user fields
		 **/
		$user_contact['position'] = esc_html__('Position', 'hue');
		$user_contact['instagram'] = esc_html__('Instagram', 'hue');
		$user_contact['twitter'] = esc_html__('Twitter', 'hue');
		$user_contact['pinterest'] = esc_html__('Pinterest', 'hue');
		$user_contact['tumblr'] = esc_html__('Tumbrl', 'hue');
		$user_contact['facebook'] = esc_html__('Facebook', 'hue');
		$user_contact['google-plus'] = esc_html__('Google Plus', 'hue');
		$user_contact['linkedin'] = esc_html__('Linkedin', 'hue');

		return $user_contact;
	}

	add_filter('user_contactmethods', 'hue_mikado_add_user_custom_fields');
}

if (!function_exists('hue_mikado_get_user_custom_fields')) {
	/**
	 * Function returns links and icons for author social networks
	 *
	 * return array
	 */
	function hue_mikado_get_user_custom_fields()
	{

		$user_social_array = array();
		$social_network_array = array(
			'google-plus',
			'facebook',
			'twitter',
			'linkedin',
			'tumblr',
			'pinterest',
			'instagram'
		);

		foreach ($social_network_array as $network) {
			if (get_the_author_meta($network) != '') {
				$$network = array(
					'link'  => get_the_author_meta($network),
					'class' => 'fa-' . $network . ' mkd-author-social-' . $network . ' mkd-author-social-icon'
				);
				$user_social_array[$network] = $$network;
			}
		}

		return $user_social_array;
	}
}


if (!function_exists('hue_mikado_get_post_format_html')) {

	/**
	 * Function which return html for post formats
	 *
	 * @param $type
	 *
	 * @return post format template
	 */

	function hue_mikado_get_post_format_html($type = "", $ajax = '')
	{

		$post_format = get_post_format();

		$supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
		if (in_array($post_format, $supported_post_formats)) {
			$post_format = $post_format;
		} else {
			$post_format = 'standard';
		}

		$slug = '';
		if ($type !== "") {
			$slug = $type;
		}

		if ($slug === 'masonry-full-width' || $slug === 'masonry-no-image') {
			$slug = 'masonry';
		}

		if($slug === 'masonry-simple') {
			$post_format = 'standard';
		}

		if($slug === 'simple') {
			$post_format = 'simple';
		}

		$params = array();

		$chars_array = hue_mikado_blog_lists_number_of_chars();
		if (isset($chars_array[$type])) {
			$params['excerpt_length'] = $chars_array[$type];
		} else {
			$params['excerpt_length'] = '';
		}

		if($type == 'masonry-gallery') {
			$size = 'square';
			if (get_post_meta(get_the_ID(), 'mkd_blog_masonry_gallery_dimensions', true) !== '') {
				$size = get_post_meta(get_the_ID(), 'mkd_blog_masonry_gallery_dimensions', true);
				$params['post_class'] = 'mkd-post-size-'. $size;
			}
			$params['post_class'] = 'mkd-post-size-'. $size;
			$params['image_size'] =  hue_mikado_get_masonry_gallery_image_size($size);

			if(in_array($post_format,array('audio'))) {
				$post_format = 'standard';
			}

		}

		if ($ajax == '') {
			hue_mikado_get_module_template_part('templates/lists/post-formats/' . $post_format, 'blog', $slug, $params);
		}
		if ($ajax == 'yes') {
			return hue_mikado_get_blog_module_template_part('templates/lists/post-formats/' . $post_format, $slug, $params);
		}


	}

}

if( !function_exists('hue_mikado_get_masonry_gallery_image_size') ) {
	/**
	 * Function which return post image size for masonry gallery
	 *
	 * @return string
	 */

	function hue_mikado_get_masonry_gallery_image_size($size) {

		$image_size = 'hue_mikado_square';

		switch($size):

			case 'large-width':
				$image_size = 'hue_mikado_large_width';
				break;
			case 'large-height':
				$image_size = 'hue_mikado_large_height';
				break;
			case 'large-width-height':
				$image_size = 'hue_mikado_large_width_height';
				break;
		endswitch;

		return $image_size;
	}

}

if (!function_exists('hue_mikado_get_default_blog_list')) {
	/**
	 * Function which return default blog list for archive post types
	 *
	 * @return post format template
	 */

	function hue_mikado_get_default_blog_list()
	{

		$blog_list = hue_mikado_options()->getOptionValue('blog_list_type');

		return $blog_list;

	}

}

if (!function_exists('hue_mikado_comment_form_submit_button')) {
	/**
	 * Override comment form submit button
	 *
	 * @return mixed|string
	 */
	function hue_mikado_comment_form_submit_button()
	{

		$comment_form_button = hue_mikado_get_button_html(array(
			'html_type'      => 'input',
			'type'           => 'gradient',
			'text'           => 'Submit',
			'input_name'     => 'submit',
			'hover_type'     => 'gradient',
			'gradient_style' => 'mkd-type2-gradient-left-to-right-2x'
		));

		return $comment_form_button;

	}

	add_filter('comment_form_submit_button', 'hue_mikado_comment_form_submit_button');

}


if (!function_exists('hue_mikado_pagination')) {

	/**
	 * Function which return pagination
	 *
	 * @return blog list pagination html
	 */

	function hue_mikado_pagination($pages = '', $range = 4, $paged = 1)
	{

		$showitems = $range + 1;

		if ($pages == '') {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if (!$pages) {
				$pages = 1;
			}
		}

		$show_load_more = hue_mikado_enable_load_more();
		$masonry_template = hue_mikado_is_masonry_template();

		$search_template = 'no';
		if (is_search()) {
			$search_template = 'yes';
		}


		if ($pages != 1) {
			if ($show_load_more == 'yes' && $search_template !== 'yes' && !$masonry_template) {
				$params = array(
					'text' => 'Load More'
				);
				echo '<div class="mkd-load-more-ajax-pagination">';
				echo hue_mikado_get_button_html($params);
				echo '</div>';
			} else {
				echo '<div class="mkd-pagination">';
				echo '<ul class="clearfix">';
				if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
					echo '<li class="mkd-pagination-first-page"><a href="' . esc_url(get_pagenum_link(1)) . '"><<</a></li>';
				}
				echo "<li class='mkd-pagination-prev";
				if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
					echo " mkd-pagination prev-first";
				}
				echo "'><a href='" . esc_url(get_pagenum_link($paged - 1)) . "'><span>" . esc_html__('Previous posts', 'hue') . "</span></a></li>";

				for ($i = 1; $i <= $pages; $i++) {
					if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
						echo ($paged == $i) ? "<li class='active'><span>" . $i . "</span></li>" : "<li><a href='" . get_pagenum_link($i) . "' class='inactive'>" . $i . "</a></li>";
					}
				}

				echo '<li class="mkd-pagination-next';
				if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
					echo ' mkd-pagination-next-last';
				}
				echo '"><a href="';
				if ($pages > $paged) {
					echo esc_url(get_pagenum_link($paged + 1));
				} else {
					echo esc_url(get_pagenum_link($paged));
				}
				echo '"><span>' . esc_html__('Next posts', 'hue') . '</span></a></li>';
				if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
					echo '<li class="mkd-pagination-last-page"><a href="' . esc_url(get_pagenum_link($pages)) . '">></a></li>';
				}
				echo '</ul>';
				echo "</div>";

                echo '<div class="mkd-pagination-helper">';
                previous_posts_link();
                next_posts_link();
                echo '</div>';
			}
		}
	}
}

if (!function_exists('hue_mikado_post_info')) {
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
	function hue_mikado_post_info($config, $blog_type = '')
	{
		$default_config = array(
			'date'     => '',
			'category' => '',
			'author'   => '',
			'comments' => '',
			'like'     => '',
			'share'    => ''
		);

		extract(shortcode_atts($default_config, $config));
		$params['blog_type'] = $blog_type;

		if ($date == 'yes') {
			hue_mikado_get_module_template_part('templates/parts/post-info-date', 'blog');
		}

		if ($author == 'yes') {
			hue_mikado_get_module_template_part('templates/parts/post-info-author', 'blog');
		}

		if ($like == 'yes') {
			hue_mikado_get_module_template_part('templates/parts/post-info-like', 'blog');
		}

		if ($comments == 'yes') {
			hue_mikado_get_module_template_part('templates/parts/post-info-comments', 'blog');
		}

		if ($category == 'yes') {
			hue_mikado_get_module_template_part('templates/parts/post-info-category', 'blog');
		}

		if ($share == 'yes') {
			hue_mikado_get_module_template_part('templates/parts/post-info-share', 'blog');
		}
	}
}

if (!function_exists('hue_mikado_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in mkd_set_blog_word_count function.
	 *
	 * It current post has read more tag set it will return content of the post, else it will return post excerpt
	 *
	 */
	function hue_mikado_excerpt($excerpt_length = '')
	{
		global $post;

		if (post_password_required()) {
			echo get_the_password_form();
		} //does current post has read more tag set?
		elseif (hue_mikado_post_has_read_more()) {
			global $more;

			//override global $more variable so this can be used in blog templates
			$more = 0;
			the_content(true);
		} //is word count set to something different that 0?
		elseif ($excerpt_length != '0') {
			//if word count is set and different than empty take that value, else that general option from theme options
			$word_count = '45';
			if (isset($excerpt_length) && $excerpt_length != "") {
				$word_count = $excerpt_length;

			} elseif (hue_mikado_options()->getOptionValue('number_of_chars') != '') {
				$word_count = esc_attr(hue_mikado_options()->getOptionValue('number_of_chars'));
			}
			//if post excerpt field is filled take that as post excerpt, else that content of the post
			$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);

			//remove leading dots if those exists
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

			//if clean excerpt has text left
			if ($clean_excerpt !== '') {
				//explode current excerpt to words
				$excerpt_word_array = explode(' ', $clean_excerpt);

				//cut down that array based on the number of the words option
				$excerpt_word_array = array_slice($excerpt_word_array, 0, $word_count);

				//add exerpt postfix
				$excert_postfix = apply_filters('hue_mikado_excerpt_postfix', '...');

				//and finally implode words together
				$excerpt = implode(' ', $excerpt_word_array) . $excert_postfix;

				//is excerpt different than empty string?
				if ($excerpt !== '') {
					echo '<p class="mkd-post-excerpt">' . wp_kses_post($excerpt) . '</p>';
				}
			}
		}
	}
}

if (!function_exists('hue_mikado_get_blog_single')) {

	/**
	 * Function which return holder for single posts
	 *
	 * @return single holder.php template
	 */

	function hue_mikado_get_blog_single()
	{
		$sidebar = hue_mikado_sidebar_layout();

		$params = array(
			"sidebar"         => $sidebar,
			"single_template" => 'mkd-blog-standard'
		);

		hue_mikado_get_module_template_part('templates/single/holder', 'blog', '', $params);
	}
}

if (!function_exists('hue_mikado_get_single_html')) {

	/**
	 * Function return all parts on single.php page
	 *
	 *
	 * @return single.php html
	 */

	function hue_mikado_get_single_html()
	{

		$post_format = get_post_format();
		$supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
		if (in_array($post_format, $supported_post_formats)) {
			$post_format = $post_format;
		} else {
			$post_format = 'standard';
		}

		//Related posts
		$related_posts_params = array();
		$show_related = (hue_mikado_options()->getOptionValue('blog_single_related_posts') == 'yes') ? true : false;
		if ($show_related) {
			$hasSidebar = hue_mikado_sidebar_layout();
			$post_id = get_the_ID();
			$related_post_number = ($hasSidebar == '' || $hasSidebar == 'default' || $hasSidebar == 'no-sidebar') ? 4 : 3;
			$related_posts_options = array(
				'posts_per_page' => $related_post_number
			);
			$related_posts_params = array(
				'related_posts' => hue_mikado_get_related_post_type($post_id, $related_posts_options)
			);
		}

		$single_options_template = hue_mikado_options()->getOptionValue('blog_single_type');

		hue_mikado_get_module_template_part('templates/single/post-formats/' . $post_format, 'blog', $single_options_template);
		hue_mikado_get_module_template_part('templates/single/parts/author-info', 'blog');
		hue_mikado_get_single_post_navigation_template();
		if (false) {
			hue_mikado_get_module_template_part('templates/single/parts/related-posts', 'blog', '', $related_posts_params);
		}
		if (hue_mikado_show_comments()) {
			comments_template('', true);
		}
	}

}
if (!function_exists('hue_mikado_additional_post_items')) {

	/**
	 * Function which return parts on single.php which are just below content
	 *
	 * @return single.php html
	 */

	function hue_mikado_additional_post_items()
	{

		if (has_tag() && hue_mikado_options()->getOptionValue('blog_enable_single_tags') == 'yes') {
			hue_mikado_get_module_template_part('templates/single/parts/tags', 'blog');
		}


		$args_pages = array(
			'before'      => '<div class="mkd-single-links-pages"><div class="mkd-single-links-pages-inner">',
			'after'       => '</div></div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '%'
		);

		wp_link_pages($args_pages);

	}

	add_action('hue_mikado_before_blog_article_closed_tag', 'hue_mikado_additional_post_items');
}


if (!function_exists('hue_mikado_comment')) {

	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */

	function hue_mikado_comment($comment, $args, $depth)
	{

		$GLOBALS['comment'] = $comment;

		global $post;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment = $post->post_author == $comment->user_id;

		$comment_class = 'mkd-comment clearfix';

		if ($is_author_comment) {
			$comment_class .= ' mkd-post-author-comment';
		}

		if ($is_pingback_comment) {
			$comment_class .= ' mkd-pingback-comment';
		}

		?>

		<li>
		<div class="<?php echo esc_attr($comment_class); ?>">
			<?php if (!$is_pingback_comment) { ?>
				<div
					class="mkd-comment-image"> <?php echo hue_mikado_kses_img(get_avatar($comment, 75)); ?> </div>
			<?php } ?>
			<div class="mkd-comment-text">
				<div class="mkd-comment-info">
					<h5 class="mkd-comment-name">
						<?php if ($is_pingback_comment) {
							esc_html_e('Pingback:', 'hue');
						} ?>
						<?php echo wp_kses_post(get_comment_author_link()); ?>
					</h5>
					<span
						class="mkd-comment-date"><?php comment_time(get_option('date_format')); ?><?php esc_html_e(' at ', 'hue'); ?><?php comment_time(get_option('time_format')); ?></span>
				</div>

				<?php if (!$is_pingback_comment) { ?>
					<div class="mkd-text-holder" id="comment-<?php echo comment_ID(); ?>">
						<?php comment_text(); ?>
						<div class="mkd-comment-reply-holder">
							<?php
							comment_reply_link(array_merge($args, array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth']
							)));
							edit_comment_link();
							?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements
		?>

	<?php
	}
}

if (!function_exists('hue_mikado_blog_archive_pages_classes')) {

	/**
	 * Function which create classes for container in archive pages
	 *
	 * @return array
	 */

	function hue_mikado_blog_archive_pages_classes($blog_type)
	{

		$classes = array();
		if (in_array($blog_type, hue_mikado_blog_full_width_types())) {
			$classes['holder'] = 'mkd-full-width';
			$classes['inner'] = 'mkd-full-width-inner';
		} elseif (in_array($blog_type, hue_mikado_blog_grid_types())) {
			$classes['holder'] = 'mkd-container';
			$classes['inner'] = 'mkd-container-inner clearfix';
		}

		return $classes;

	}

}

if (!function_exists('hue_mikado_blog_full_width_types')) {

	/**
	 * Function which return all full width blog types
	 *
	 * @return array
	 */

	function hue_mikado_blog_full_width_types()
	{

		$types = array('masonry-full-width', 'masonry-no-image', 'masonry-simple', 'masonry-gallery');

		return $types;

	}

}

if (!function_exists('hue_mikado_blog_grid_types')) {

	/**
	 * Function which return in grid blog types
	 *
	 * @return array
	 */

	function hue_mikado_blog_grid_types()
	{

		$types = array('standard', 'standard-date-on-side', 'masonry', 'split-column', 'standard-whole-post', 'simple');

		return $types;

	}

}

if (!function_exists('hue_mikado_blog_types')) {

	/**
	 * Function which return all blog types
	 *
	 * @return array
	 */

	function hue_mikado_blog_types()
	{

		$types = array_merge(hue_mikado_blog_grid_types(), hue_mikado_blog_full_width_types());

		return $types;

	}

}

if (!function_exists('hue_mikado_blog_templates')) {

	/**
	 * Function which return all blog templates names
	 *
	 * @return array
	 */

	function hue_mikado_blog_templates()
	{

		$templates = array();
		$grid_templates = hue_mikado_blog_grid_types();
		$full_templates = hue_mikado_blog_full_width_types();
		foreach ($grid_templates as $grid_template) {
			array_push($templates, 'blog-' . $grid_template);
		}
		foreach ($full_templates as $full_template) {
			array_push($templates, 'blog-' . $full_template);
		}

		return $templates;

	}

}

if (!function_exists('hue_mikado_blog_lists_number_of_chars')) {

	/**
	 * Function that return number of characters for different lists based on options
	 *
	 * @return int
	 */

	function hue_mikado_blog_lists_number_of_chars()
	{

		$number_of_chars = array();

		if (hue_mikado_options()->getOptionValue('standard_number_of_chars')) {
			$number_of_chars['standard'] = hue_mikado_options()->getOptionValue('standard_number_of_chars');
		}
		if (hue_mikado_options()->getOptionValue('masonry_number_of_chars')) {
			$number_of_chars['masonry'] = hue_mikado_options()->getOptionValue('masonry_number_of_chars');
		}
		if (hue_mikado_options()->getOptionValue('masonry_number_of_chars')) {
			$number_of_chars['masonry-full-width'] = hue_mikado_options()->getOptionValue('masonry_number_of_chars');
		}
		if (hue_mikado_options()->getOptionValue('split_column_number_of_chars')) {
			$number_of_chars['split-column'] = hue_mikado_options()->getOptionValue('split_column_number_of_chars');
		}

		return $number_of_chars;

	}

}

if (!function_exists('hue_mikado_get_single_post_navigation_template')) {
	/**
	 * Gets previous and next post and loads single post navigation
	 */
	function hue_mikado_get_single_post_navigation_template()
	{
		$params = array();

		$in_same_term = hue_mikado_options()->getOptionValue('blog_navigation_through_same_category') === 'yes';

		$prev_post = get_previous_post($in_same_term);
		$next_post = get_next_post($in_same_term);
		$params['has_prev_post'] = false;
		$params['has_next_post'] = false;

		if ($prev_post) {
			$params['prev_post_object'] = $prev_post;
			$params['has_prev_post'] = true;
			$params['prev_post'] = array(
				'title' => get_the_title($prev_post->ID),
				'link'  => get_the_permalink($prev_post->ID),
				'image' => get_the_post_thumbnail($prev_post->ID, 'thumbnail')
			);

			$params['prev_post_has_image'] = !empty($params['prev_post']['image']);
		}

		if ($next_post) {
			$params['next_post_object'] = $next_post;
			$params['has_next_post'] = true;
			$params['next_post'] = array(
				'title' => get_the_title($next_post->ID),
				'link'  => get_the_permalink($next_post->ID),
				'image' => get_the_post_thumbnail($next_post->ID, 'thumbnail')
			);

			$params['next_post_has_image'] = !empty($params['next_post']['image']);
		}

		hue_mikado_get_module_template_part('templates/single/parts/single-navigation', 'blog', '', $params);
	}
}

if (!function_exists('hue_mikado_excerpt_length')) {
	/**
	 * Function that changes excerpt length based on theme options
	 *
	 * @param $length int original value
	 *
	 * @return int changed value
	 */
	function hue_mikado_excerpt_length($length)
	{

		if (hue_mikado_options()->getOptionValue('number_of_chars') !== '') {
			return esc_attr(hue_mikado_options()->getOptionValue('number_of_chars'));
		} else {
			return 45;
		}
	}

	add_filter('excerpt_length', 'hue_mikado_excerpt_length', 999);
}

if (!function_exists('hue_mikado_excerpt_more')) {
	/**
	 * Function that adds three dotes on the end excerpt
	 *
	 * @param $more
	 *
	 * @return string
	 */
	function hue_mikado_excerpt_more($more)
	{
		return '...';
	}

	add_filter('excerpt_more', 'hue_mikado_excerpt_more');
}

if (!function_exists('hue_mikado_post_has_read_more')) {
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function hue_mikado_post_has_read_more()
	{
		global $post;

		return strpos($post->post_content, '<!--more-->');
	}
}

if (!function_exists('hue_mikado_post_has_title')) {
	/**
	 * Function that checks if current post has title or not
	 * @return bool
	 */
	function hue_mikado_post_has_title()
	{
		return get_the_title() !== '';
	}
}

if (!function_exists('hue_mikado_modify_read_more_link')) {
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function hue_mikado_modify_read_more_link()
	{
		$link = '<div class="mkd-more-link-container">';
		$link .= hue_mikado_get_button_html(array(
			'link' => get_permalink() . '#more-' . get_the_ID(),
			'text' => esc_html__('Continue reading', 'hue'),
			'size' => 'small'
		));

		$link .= '</div>';

		return $link;
	}

	add_filter('the_content_more_link', 'hue_mikado_modify_read_more_link');
}


if (!function_exists('hue_mikado_has_blog_widget')) {
	/**
	 * Function that checks if latest posts widget is added to widget area
	 * @return bool
	 */
	function hue_mikado_has_blog_widget()
	{
		$widgets_array = array(
			'mkd_latest_posts_widget'
		);

		foreach ($widgets_array as $widget) {
			$active_widget = is_active_widget(false, false, $widget);

			if ($active_widget) {
				return true;
			}
		}

		return false;
	}
}

if (!function_exists('hue_mikado_has_blog_shortcode')) {
	/**
	 * Function that checks if any of blog shortcodes exists on a page
	 * @return bool
	 */
	function hue_mikado_has_blog_shortcode()
	{
		$blog_shortcodes = array(
			'mkd_blog_list',
			'mkd_blog_slider',
			'mkd_blog_carousel'
		);

		$slider_field = get_post_meta(hue_mikado_get_page_id(), 'mkd_page_slider_meta', true); //TODO change

		foreach ($blog_shortcodes as $blog_shortcode) {
			$has_shortcode = hue_mikado_has_shortcode($blog_shortcode) || hue_mikado_has_shortcode($blog_shortcode, $slider_field);

			if ($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}


if (!function_exists('hue_mikado_load_blog_assets')) {
	/**
	 * Function that checks if blog assets should be loaded
	 *
	 * @see hue_mikado_is_ajax_enabled()
	 * @see hue_mikado_is_ajax_enabled_is_blog_template()
	 * @see is_home()
	 * @see is_single()
	 * @see mkd_has_blog_shortcode()
	 * @see is_archive()
	 * @see is_search()
	 * @see mkd_has_blog_widget()
	 * @return bool
	 */
	function hue_mikado_load_blog_assets()
	{
		return hue_mikado_is_ajax_enabled() || hue_mikado_is_blog_template() || is_home() || is_single() || hue_mikado_has_blog_shortcode() || is_archive() || is_search() || hue_mikado_has_blog_widget();
	}
}

if (!function_exists('hue_mikado_is_blog_template')) {
	/**
	 * Checks if current template page is blog template page.
	 *
	 * @param string current page. Optional parameter.
	 *
	 * @return bool
	 *
	 * @see hue_mikado_get_page_template_name()
	 */
	function hue_mikado_is_blog_template($current_page = '')
	{

		if ($current_page == '') {
			$current_page = hue_mikado_get_page_template_name();
		}

		$blog_templates = hue_mikado_blog_templates();

		return in_array($current_page, $blog_templates);
	}
}

if (!function_exists('hue_mikado_read_more_button')) {
	/**
	 * Function that outputs read more button html if necessary.
	 * It checks if read more button should be outputted only if option for given template is enabled and post does'nt have read more tag
	 * and if post isn't password protected
	 *
	 * @param string $option name of option to check
	 * @param string $class additional class to add to button
	 *
	 */
	function hue_mikado_read_more_button($option = '', $class = '')
	{
		if ($option != '') {
			$show_read_more_button = hue_mikado_options()->getOptionValue($option) == 'yes';
		} else {
			$show_read_more_button = 'yes';
		}
		if ($show_read_more_button && !hue_mikado_post_has_read_more() && !post_password_required()) {
			echo hue_mikado_get_button_html(array(
				'size'         => 'small',
				'link'         => get_the_permalink(),
				'text'         => esc_html__('Read More', 'hue'),
				'custom_class' => $class
			));
		}
	}
}

if (!function_exists('hue_mikado_set_blog_holder_data_params')) {
	/**
	 * Function which set data params on blog holder div
	 */
	function hue_mikado_set_blog_holder_data_params()
	{

		$show_load_more = hue_mikado_enable_load_more();
		if ($show_load_more) {
			$current_query = hue_mikado_get_blog_query();

			$data_params = array();
			$data_return_string = '';

			$paged = hue_mikado_paged();

			$posts_number = '';
			if (get_post_meta(get_the_ID(), "mkd_show_posts_per_page_meta", true) != "") {
				$posts_number = get_post_meta(get_the_ID(), "mkd_show_posts_per_page_meta", true);
			} else {
				$posts_number = get_option('posts_per_page');
			}
			$category = get_post_meta(hue_mikado_get_page_id(), 'mkd_blog_category_meta', true);


			//set data params
			$data_params['data-next-page'] = $paged + 1;
			$data_params['data-max-pages'] = $current_query->max_num_pages;


			if ($posts_number != '') {
				$data_params['data-post-number'] = $posts_number;
			}


			if ($category != '') {
				$data_params['data-category'] = $category;
			}
			if (is_archive()) {
				if (is_category()) {
					$cat_id = get_queried_object_id();
					$data_params['data-archive-category'] = $cat_id;
				}
				if (is_author()) {
					$author_id = get_queried_object_id();
					$data_params['data-archive-author'] = $author_id;
				}
				if (is_tag()) {
					$current_tag_id = get_queried_object_id();
					$data_params['data-archive-tag'] = $current_tag_id;
				}
				if (is_date()) {
					$day = get_query_var('day');
					$month = get_query_var('monthnum');
					$year = get_query_var('year');

					$data_params['data-archive-day'] = $day;
					$data_params['data-archive-month'] = $month;
					$data_params['data-archive-year'] = $year;
				}
			}
			if (is_search()) {
				$search_query = get_search_query();
				$data_params['data-archive-search-string'] = $search_query; // to do, not finished
			}

			foreach ($data_params as $key => $value) {
				if ($key !== '') {
					$data_return_string .= $key . '= ' . esc_attr($value) . ' ';
				}
			}

			return $data_return_string;

		}
	}
}

if (!function_exists('hue_mikado_enable_load_more')) {
	/**
	 * Function that check if load more is enabled
	 *
	 * return boolean
	 */
	function hue_mikado_enable_load_more()
	{
		$enable_load_more = false;

		if (hue_mikado_options()->getOptionValue('enable_load_more_pag') == 'yes') {
			$enable_load_more = true;
		}

		return $enable_load_more;
	}
}
if (!function_exists('hue_mikado_is_masonry_template')) {
	/**
	 * Check if is masonry template enabled
	 * return boolean
	 */
	function hue_mikado_is_masonry_template()
	{

		$page_id = hue_mikado_get_page_id();
		$page_template = get_page_template_slug($page_id);
		$page_options_template = hue_mikado_options()->getOptionValue('blog_list_type');

		if (!is_archive()) {
			if ($page_template == 'blog-masonry.php' || $page_template == 'blog-masonry-full-width.php' || $page_template == 'blog-masonry-no-image.php' || $page_template == 'blog-masonry-simple.php') {
				return true;
			}
		} elseif (is_archive() || is_home()) {
			if ($page_options_template == 'masonry' || $page_options_template == 'masonry-full-width' || $page_options_template == 'masonry-no-image') {
				return true;
			}
		} else {
			return false;
		}
	}


}

if (!function_exists('hue_mikado_set_ajax_url')) {
	/**
	 * load themes ajax functionality
	 *
	 */
	function hue_mikado_set_ajax_url()
	{
		echo '<script type="application/javascript">var MikadoAjaxUrl = "' . admin_url('admin-ajax.php') . '"</script>';
	}

	add_action('wp_enqueue_scripts', 'hue_mikado_set_ajax_url');

}

if (!function_exists('hue_mikado_get_the_author_name')) {
	/**
	 * Returns current author name. Must be called when in loop
	 *
	 * @return string
	 */
	function hue_mikado_get_the_author_name()
	{
		if (get_the_author_meta('first_name') !== '' || get_the_author_meta('last_name') !== '') {
			$name = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
		} else {
			$name = get_the_author_meta('display_name');
		}

		return $name;
	}
}

if (!function_exists('hue_mikado_get_author_posts_url')) {
	/**
	 * Returns URL to author posts page
	 *
	 * @return string
	 */
	function hue_mikado_get_author_posts_url()
	{
		return get_author_posts_url(get_the_author_meta('ID'));
	}
}

/**
 * Loads more function for blog posts.
 *
 */
if (!function_exists('hue_mikado_blog_load_more')) {

	function hue_mikado_blog_load_more()
	{

		$return_obj = array();
		$paged = $post_number = $category = $blog_type = '';
		$archive_category = $archive_author = $archive_tag = $archive_day = $archive_month = $archive_year = '';

		if (!empty($_POST['nextPage'])) {
			$paged = $_POST['nextPage'];
		}
		if (!empty($_POST['number'])) {
			$post_number = $_POST['number'];
		}
		if (!empty($_POST['category'])) {
			$category = $_POST['category'];
		}
		if (!empty($_POST['blogType'])) {
			$blog_type = $_POST['blogType'];
		}
		if (!empty($_POST['archiveCategory'])) {
			$archive_category = $_POST['archiveCategory'];
		}
		if (!empty($_POST['archiveAuthor'])) {
			$archive_author = $_POST['archiveAuthor'];
		}
		if (!empty($_POST['archiveTag'])) {
			$archive_tag = $_POST['archiveTag'];
		}
		if (!empty($_POST['archiveDay'])) {
			$archive_day = $_POST['archiveDay'];
		}
		if (!empty($_POST['archiveMonth'])) {
			$archive_month = $_POST['archiveMonth'];
		}
		if (!empty($_POST['archiveYear'])) {
			$archive_year = $_POST['archiveYear'];
		}


		$html = '';
		$query_array = array(
			'post_type'      => 'post',
			'paged'          => $paged,
			'posts_per_page' => $post_number
		);
		if ($category != '') {
			$query_array['cat'] = $category;
		}
		if ($archive_category != '') {
			$query_array['cat'] = $archive_category;
		}
		if ($archive_author != '') {
			$query_array['author'] = $archive_author;
		}
		if ($archive_tag != '') {
			$query_array['tag'] = $archive_tag;
		}
		if ($archive_day != '' && $archive_month != '' && $archive_year != '') {
			$query_array['day'] = $archive_day;
			$query_array['monthnum'] = $archive_month;
			$query_array['year'] = $archive_year;
		}
		$query_results = new \WP_Query($query_array);

		if ($query_results->have_posts()):
			while ($query_results->have_posts()) : $query_results->the_post();
				$html .= hue_mikado_get_post_format_html($blog_type, 'yes');
			endwhile;
		else:
			$html .= '<p>' . esc_html__('Sorry, no posts matched your criteria.', 'hue') . '</p>';
		endif;

		$return_obj = array(
			'html' => $html,
		);

		echo json_encode($return_obj);
		exit;
	}
}

if (!function_exists('hue_mikado_masonry_no_image_template')) {
	/**
	 * Check if is masonry no image template enabled
	 * return boolean
	 */
	function hue_mikado_masonry_no_image_template()
	{
		$masonry_no_image = true;

		$page_id = hue_mikado_get_page_id();
		$page_template = get_page_template_slug($page_id);
		$page_options_template = hue_mikado_options()->getOptionValue('blog_list_type');

		if (!is_archive()) {
			if ($page_template == 'blog-masonry-no-image.php') {
				$masonry_no_image = false;
			}
		} elseif (is_archive() || is_home()) {
			if ($page_options_template == 'masonry-no-image') {
				$masonry_no_image = false;
			}
		} else {
			$masonry_no_image = true;
		}

		return $masonry_no_image;
	}
}

if (!function_exists('hue_mikado_taxonomy_custom_fields')) {
	function hue_mikado_taxonomy_custom_fields($tag)
	{
		$t_id = $tag->term_id; // Get the ID of the category you're editing
		$term_meta = get_option("post_tax_term_$t_id");
		?>
		<tr>
			<th scope="row" valign="top">
				<label for="shortcode"><?php esc_html_e('Category color', 'hue'); ?></label>
			</th>
			<td>
				<input style="width:100px" type="text" name="term_meta[category_color]" id="term_meta[category_color]"
					   size="3"
					   value="<?php if (isset($term_meta['category_color']) && $term_meta['category_color'] != '') {
						   echo esc_attr($term_meta['category_color']);
					   } ?>">

				<p class="description"><?php esc_html_e('Define category color using a hexadecimal (HEX) notation for the combination of Red, Green, and Blue color values (RGB). Default value is: #d4145a', 'hue'); ?></p>
			</td>
		</tr>
	<?php
	}
}

if (!function_exists('hue_mikado_save_taxonomy_custom_fields')) {
	function hue_mikado_save_taxonomy_custom_fields($term_id)
	{
		if (isset($_POST['term_meta'])) {
			$t_id = $term_id;
			$term_meta = get_option("post_tax_term_$t_id");

			$cat_keys = array_keys($_POST['term_meta']);
			foreach ($cat_keys as $key) {
				if (isset($_POST['term_meta'][$key])) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			update_option("post_tax_term_$t_id", $term_meta);
		}
	}
}

if (!function_exists('hue_mikado_get_category_color')) {
	function hue_mikado_get_category_color($term_id)
	{
		$cat_array = get_option("post_tax_term_$term_id");

		$category_color = '#d4145a';
		if (isset($cat_array['category_color']) && $cat_array['category_color'] != '') {
			$category_color = $cat_array['category_color'];
		}

		return $category_color;
	}
}

if (!function_exists('hue_mikado_get_category_color_name')) {
	function hue_mikado_get_category_color_name($category, $count)
	{
		$category_color = hue_mikado_get_category_color($category->term_id);
		$html = '';
		$html .= '<a href="' . get_category_link($category->term_id) . '">';
		$html .= '<span class="mkd-category-color" style="background-color:' . hue_mikado_get_category_color($category->term_id) . ';"></span>';
		$html .= '<span class="mkd-category-name">' . get_cat_name($category->term_id) . '</span>';
		$html .= $count ? ' (' . $category->count . ')' : '';
		$html .= '</a>';

		return $html;
	}
}

if (!function_exists('hue_mikado_category_color_name')) {
	function hue_mikado_category_color_name($term_id)
	{
		echo hue_mikado_get_category_color_name($term_id, false);
	}
}

add_action('category_edit_form_fields', 'hue_mikado_taxonomy_custom_fields', 10, 2);
add_action('edited_term', 'hue_mikado_save_taxonomy_custom_fields', 10, 2);

add_action('wp_ajax_nopriv_hue_mikado_blog_load_more', 'hue_mikado_blog_load_more');
add_action('wp_ajax_hue_mikado_blog_load_more', 'hue_mikado_blog_load_more');

?>