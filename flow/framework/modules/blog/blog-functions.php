<?php

if ( ! function_exists( 'flow_elated_add_post_order' ) ) {

	function flow_elated_add_post_order() {

		add_post_type_support( 'post', 'page-attributes' );

	}

	add_action('init', 'flow_elated_add_post_order');

}

if( !function_exists('flow_elated_get_blog') ) {
	/**
	 * Function which return holder for all blog lists
	 *
	 * @return holder.php template
	 */
	function flow_elated_get_blog($type) {

		$sidebar = flow_elated_sidebar_layout();
		$params = array(
			"blog_type" => $type,
			"sidebar" => $sidebar
		);
		flow_elated_get_module_template_part('templates/lists/holder', 'blog', '', $params);
	}

}

if( !function_exists('flow_elated_get_blog_type') ) {

	/**
	 * Function which create query for blog lists
	 *
	 * @return blog list template
	 */

	function flow_elated_get_blog_type($type, $sidebar) {
		
		$blog_query = flow_elated_get_blog_query();
		
		$paged = flow_elated_paged();
		
		if(flow_elated_options()->getOptionValue('blog_page_range') != ""){
			
			$blog_page_range = esc_attr(flow_elated_options()->getOptionValue('blog_page_range'));
			
		} else{
			
			$blog_page_range = $blog_query->max_num_pages;
			
		}	
		
		$blog_classes = flow_elated_get_blog_holder_classes($type, $sidebar);
		
		$params = array(
			'blog_query' => $blog_query,
			'paged' => $paged,
			'blog_page_range' => $blog_page_range,
			'blog_type' => $type,
			'blog_classes' => $blog_classes
		);

		flow_elated_get_module_template_part('templates/lists/' .  $type, 'blog', '', $params);
	}

}


if(!function_exists('flow_elated_get_blog_holder_classes')){
	/**
     * Function set blog holder class
     * 
	 * return string
     */
	
	function flow_elated_get_blog_holder_classes($type, $sidebar){
		
		
		$show_load_more = flow_elated_enable_load_more();
		$enable_inf_scroll = flow_elated_enable_infinite_scroll();
		
		$blog_classes = array(
			'eltd-blog-holder'
		);
		
		if($show_load_more){
			$blog_classes[] = 'eltd-blog-load-more';
		}
		
		if($enable_inf_scroll){
			$blog_classes[] = 'eltd-blog-infinite-scroll';
		}
		
		if($sidebar !== 'default' && $sidebar !== 'no-sidebar'){
			$blog_classes[] = 'eltd-blog-with-sidebar';
		}
		
		switch ($type) {
			
			case 'standard':
				$blog_classes[] = 'eltd-blog-type-standard';
				break;
			
			case 'standard-whole-post':
				$blog_classes[] = 'eltd-blog-type-standard';
				break;
			
			case 'split-column':
				$blog_classes[] = 'eltd-blog-type-split-column';
				break;
			
			case 'expanding-tiles':
				$blog_classes[] = 'eltd-blog-type-expanding-tiles';
				break;
			
			case 'masonry':
				$blog_classes[] = 'eltd-blog-type-masonry';
				break;
			
			case 'masonry-full-width':
				$blog_classes[] = 'eltd-blog-type-masonry eltd-masonry-full-width';
				break;
			
			default:
				$blog_classes[] = 'eltd-blog-type-standard';
				break;
		}
		
		if($type == 'masonry' || $type == 'masonry-full-width'){
			
			$masonry_columns = flow_elated_get_meta_field_intersect('masonry_columns');
			
			switch ($masonry_columns) {
				case 'four':			
					$blog_classes[] = 'eltd-masonry-four-cols';
					break;
				case 'three':			
					$blog_classes[] = 'eltd-masonry-three-cols';
					break;
				case 'two': 
					$blog_classes[] = 'eltd-masonry-two-cols';
					break;
			}
			
		}
				
		return implode(' ',$blog_classes);
	}
	
}

if(!function_exists('flow_elated_get_blog_query')){
	/**
	* Function which create query for blog lists
	*
	* @return wp query object
	*/
	function flow_elated_get_blog_query(){
		global $wp_query;
		
		$id = flow_elated_get_page_id();
		$category = esc_attr(get_post_meta($id, "eltd_blog_category_meta", true));
		
		if(esc_attr(get_post_meta($id, "eltd_show_posts_per_page_meta", true)) != ""){
			$post_number = esc_attr(get_post_meta($id, "eltd_show_posts_per_page_meta", true));
		}else{			
			$post_number = esc_attr(get_option('posts_per_page'));
		} 
		
		$paged = flow_elated_paged();
		$query_array = array(
			'post_type' => 'post',
			'paged' => $paged,
			'cat' 	=> $category,
			'posts_per_page' => $post_number
		);
		if(is_archive()){
			$blog_query = $wp_query;
		}else{
			$blog_query = new WP_Query($query_array);
		}
		return $blog_query;
		
	}
}


if( !function_exists('flow_elated_get_post_format_html') ) {

	/**
	 * Function which return html for post formats
	 * @param $type - dependns on blog list type 
	 * @param $ajax
	 * @param $no_posts - when ajax is set to yes check which template to load if there are no posts in WP Query 
	 * @return post format template
	 */

	function flow_elated_get_post_format_html($type = "", $ajax = '', $no_posts = '') {

		$post_format = get_post_format();
		
		$supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
		if(in_array($post_format,$supported_post_formats)) {
			$post_format = $post_format;
		} else {
			$post_format = 'standard';
		}
		$slug = '';
		if($type !== ""){
			$slug = $type;			
		}
		

		$params = array();
		$params['blog_type'] = $type;
		
		switch( $post_format ) {
			case 'standard':
				break;
			case 'audio':
				break;
			case 'video':
				break;
			case 'link':
				$id = get_the_ID();
				$params['image'] = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large');
				$params['external_link'] = esc_html(get_post_meta(get_the_ID(), "eltd_post_link_link_meta", true));
				$params['link_target'] = '_blank';
				$params['title_tag'] = 'h4';
				break;
			case 'quote':
				$id = get_the_ID();
				$params['image'] = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large');
				$quote_array = flow_elated_get_quote_meta_fields();
				$params['quote_text'] = $quote_array['quote_text'];
				$params['quote_author'] = $quote_array['quote_author'];
				break;
			case 'gallery':
				break;
			default:
		}

		$chars_array = flow_elated_blog_lists_number_of_chars();
		
		if(isset($chars_array[$type])) {
			$params['excerpt_length'] = $chars_array[$type];
		} else {
			$params['excerpt_length'] = '';
		}
		
		
		if($type == 'masonry' || $type='masonry-full-width'){
			$params['image_size'] = flow_elated_get_post_image_size();
		}
		
		$params['featured_class'] = flow_elated_featured_post_class();

		if($ajax == ''){
			flow_elated_get_module_template_part('templates/lists/post-formats/' . $post_format, 'blog', $slug, $params);
		}
		if($ajax == 'yes' && $no_posts == ''){
			
			return flow_elated_get_blog_module_template_part('templates/lists/post-formats/' . $post_format, $slug, $params);
						
		}
		
		if($no_posts == 'yes' && $ajax == 'yes'){
			return flow_elated_get_blog_module_template_part('templates/parts/no-posts', $slug, $params);
		}
		
	}

}

if( !function_exists('flow_elated_get_default_blog_list') ) {
	/**
	 * Function which return default blog list for archive post types
	 *
	 * @return post format template
	 */

	function flow_elated_get_default_blog_list() {

		$blog_list = flow_elated_options()->getOptionValue('blog_list_type');
		return $blog_list;

	}

}


if (!function_exists('flow_elated_pagination')) {

	/**
	 * Function which return pagination
	 *
	 * @return blog list pagination html
	 */

	function flow_elated_pagination($pages = '', $range = 4, $paged = 1, $blog_type){

		$showitems = $range+1;

		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages){
				$pages = 1;
			}
		}
		
		$show_load_more = flow_elated_enable_load_more();
		$enable_inf_scroll = flow_elated_enable_infinite_scroll();
		
		$search_template = 'no';
		if(is_search()){
			$search_template = 'yes';
		}
		
		
		if($pages != 1){
			if($show_load_more == 'yes'  && $search_template !== 'yes'){

				echo '<div class="eltd-load-more-ajax-pagination">';
				echo flow_elated_get_load_more_button_html();
				do_action( 'flow_elated_after_load_more_button' );
				echo '</div>';
				
			}
			elseif($enable_inf_scroll && $search_template !== 'yes'){
				//infinite scroll pagination type
			}
			
			else{
				if($blog_type !== 'expanding-tiles'){
					
					echo '<div class="eltd-pagination">';
					echo '<ul>';
						if($paged > 2 && $paged > $range+1 && $showitems < $pages){
							echo '<li class="eltd-pagination-first-page"><a href="'.esc_url(get_pagenum_link(1)).'"><span class="arrow_carrot-left"></span></a></li>';
						}
						echo "<li class='eltd-pagination-prev";
						if($paged > 2 && $paged > $range+1 && $showitems < $pages) {
							echo " eltd-pagination prev-first";
						}
						echo "'><a href='".esc_url(get_pagenum_link($paged - 1))."'><span class='arrow_carrot-left'></span></a></li>";

						for ($i=1; $i <= $pages; $i++){
							if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
								echo ($paged == $i)? "<li class='active'><span>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
							}
						}

						echo '<li class="eltd-pagination-next';
						if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
							echo ' eltd-pagination-next-last';
						}
						echo '"><a href="';
						if($pages > $paged){
							echo esc_url(get_pagenum_link($paged + 1));
						} else {
							echo esc_url(get_pagenum_link($paged));
						}
						echo '"><span class="arrow_carrot-right"></span></a></li>';
						if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
							echo '<li class="eltd-pagination-last-page"><a href="'.esc_url(get_pagenum_link($pages)).'"><span class="arrow_carrot-right"></span></a></li>';
						}
					echo '</ul>';
					echo "</div>";
				}				
			}
		}
	}
}

if(!function_exists('flow_elated_post_info')){
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
	function flow_elated_post_info($config){
		$default_config = array(
			'date' => '',
			'category' => '',
			'author' => '',
			'comments' => '',
			'like' => '',
			'share' => ''
		);

		extract(shortcode_atts($default_config, $config));

		if($date == 'yes'){
			flow_elated_get_module_template_part('templates/parts/post-info-date', 'blog');
		}
		if($like == 'yes'){
			flow_elated_get_module_template_part('templates/parts/post-info-like', 'blog');
		}
		if($comments == 'yes'){
			flow_elated_get_module_template_part('templates/parts/post-info-comments', 'blog');
		}
		if($category == 'yes'){
			flow_elated_get_module_template_part('templates/parts/post-info-category', 'blog');
		}		
		if($share == 'yes'){
			flow_elated_get_module_template_part('templates/parts/post-info-share', 'blog');
		}
		if($author == 'yes'){
			flow_elated_get_module_template_part('templates/parts/post-info-author', 'blog');
		}		
		
	}
}

if(!function_exists('flow_elated_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in eltd_set_blog_word_count function.
	 *
	 * It current post has read more tag set it will return content of the post, else it will return post excerpt
	 *
	 */
	function flow_elated_excerpt($excerpt_length = '') {
		global $post;

		if(post_password_required()) {
			echo get_the_password_form();
		}

		//does current post has read more tag set?
		elseif(flow_elated_post_has_read_more()) {
			global $more;

			//override global $more variable so this can be used in blog templates
			$more = 0;
			the_content(true);
		}

		//is word count set to something different that 0?
		elseif($excerpt_length != '0') {
			//if word count is set and different than empty take that value, else that general option from theme options
			$word_count = '45';
			if(isset($excerpt_length) && $excerpt_length != ""){
				$word_count = $excerpt_length;

			} elseif(flow_elated_options()->getOptionValue('number_of_chars') != '') {
				$word_count = esc_attr(flow_elated_options()->getOptionValue('number_of_chars'));
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
				$excert_postfix		= apply_filters('flow_elated_excerpt_postfix', '...');

				//and finally implode words together
				$excerpt 			= implode (' ', $excerpt_word_array).$excert_postfix;

				//is excerpt different than empty string?
				if($excerpt !== '') {
					
					$short_excerpt = substr($excerpt, 0 , 30);
					$short_excerpt = $short_excerpt.'...';
					
					echo '<p class="eltd-post-excerpt eltd-long-excerpt">'.wp_kses_post($excerpt).'</p>';
					echo '<p class="eltd-post-excerpt eltd-short-excerpt">'.wp_kses_post($short_excerpt).'</p>';
				}
			}
		}
	}
}

if(!function_exists('flow_elated_get_blog_single')) {

	/**
	 * Function which return holder for single posts
	 *
	 * @return single holder.php template
	 */

	function flow_elated_get_blog_single() {
		$sidebar = flow_elated_sidebar_layout();

		$params = array(
			"sidebar" => $sidebar
		);

		flow_elated_get_module_template_part('templates/single/holder', 'blog', '', $params);
	}
}

if( !function_exists('flow_elated_get_single_html') ) {

	/**
	 * Function return all parts on single.php page
	 *
	 *
	 * @return single.php html
	 */

	function flow_elated_get_single_html($ajax = '') {

		$post_format = get_post_format();
		$supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
		if(in_array($post_format,$supported_post_formats)) {
			$post_format = $post_format;
		} else {
			$post_format = 'standard';
		}
		
		switch( $post_format ) {
			case 'standard':
				break;
			case 'audio':
				break;
			case 'video':
				break;
			case 'link':
				$id = get_the_ID();
				$params['image'] = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large');
				$params['external_link'] = esc_html(get_post_meta(get_the_ID(), "eltd_post_link_link_meta", true));
				$params['link_target'] = '_blank';
				$params['title_tag'] = 'h4';
				break;
			case 'quote':
				$id = get_the_ID();
				$params['image'] = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large');
				$quote_array = flow_elated_get_quote_meta_fields();
				$params['quote_text'] = $quote_array['quote_text'];
				$params['quote_author'] = $quote_array['quote_author'];
				break;
			case 'gallery':
				break;
			default:
		}

		$params['featured_class'] = flow_elated_featured_post_class();

		//Related posts
		$related_posts_params = array();
		$show_related = (flow_elated_options()->getOptionValue('blog_single_related_posts') == 'yes') ? true : false;
		if ($show_related) {
			$hasSidebar = flow_elated_sidebar_layout();
			$post_id = get_the_ID();
			$related_post_number = ($hasSidebar == '' || $hasSidebar == 'default' || $hasSidebar == 'no-sidebar') ? 4 : 3;
			$related_posts_options = array(
				'posts_per_page' => $related_post_number
			);
			$related_posts_params = array(
				'related_posts' => flow_elated_get_related_post_type($post_id, $related_posts_options)
			);
		}
		$show_single_nav = false;
		if (!isset($_POST["ajaxReq"]) || $_POST["ajaxReq"] != 'yes'){
			$show_single_nav = true;
		}
		
		if($ajax == ''){
			flow_elated_get_module_template_part('templates/single/post-formats/' . $post_format, 'blog', '', $params);
			if ($show_related) {
				flow_elated_get_module_template_part('templates/single/parts/related-posts', 'blog', '', $related_posts_params);
			}
			if($show_single_nav){
				flow_elated_get_module_template_part('templates/single/parts/single-navigation', 'blog');
			}
			
			flow_elated_get_module_template_part('templates/single/parts/author-info', 'blog');

			if(flow_elated_show_comments()){
				comments_template('', true);
			}
		}		
		
		if($ajax == 'yes'){
			$params['post_id'] = get_the_ID();
			$html = '';

			do_action('flow_elated_before_post_content');
			$html .= flow_elated_get_blog_module_template_part('templates/single/post-formats/' . $post_format,'blog',$params);
			if ($show_related) {
				$html .= flow_elated_get_blog_module_template_part('templates/single/parts/related-posts','blog', $related_posts_params);
			}
			$html .= flow_elated_get_blog_module_template_part('templates/single/parts/author-info','blog',$params);

			if(flow_elated_show_comments()) {
				ob_start();
				comments_template( '', true );
				$html .= ob_get_clean();
			}

			return $html;
		}
	}

}
if( !function_exists('flow_elated_additional_post_items') ) {

	/**
	 * Function which return parts on single.php which are just below content
	 *
	 * @return single.php html
	 */

	function flow_elated_additional_post_items() {

		if(has_tag()){
			flow_elated_get_module_template_part('templates/single/parts/tags', 'blog');
		}


		$args_pages = array(
			'before'           => '<div class="eltd-single-links-pages"><div class="eltd-single-links-pages-inner">',
			'after'            => '</div></div>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'pagelink'         => '%'
		);

		wp_link_pages($args_pages);

	}
	add_action('flow_elated_before_blog_article_closed_tag', 'flow_elated_additional_post_items');
}


if (!function_exists('flow_elated_comment')) {

	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */

	function flow_elated_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment  =  false;

		$comment_class = 'eltd-comment clearfix';

		if($is_author_comment) {
			$comment_class .= ' eltd-post-author-comment';
		}

		if($is_pingback_comment) {
			$comment_class .= ' eltd-pingback-comment';
		}

		?>

		<li>
		<div class="<?php echo esc_attr($comment_class); ?>">
			<?php if(!$is_pingback_comment) { ?>
				<div class="eltd-comment-image"> <?php echo flow_elated_kses_img(get_avatar($comment, 80)); ?> </div>
			<?php } ?>
			<div class="eltd-comment-text">
					<h5 class="eltd-comment-name">
						<?php if($is_pingback_comment) { esc_html_e('Pingback:', 'flow'); } ?>
						<?php echo wp_kses_post(get_comment_author_link()); ?>
						<?php if($is_author_comment) { ?>
							<i class="fa fa-user post-author-comment-icon"></i>
						<?php } ?>
					</h5>
			<?php if(!$is_pingback_comment) { ?>
				<div class="eltd-text-holder" id="comment-<?php echo comment_ID(); ?>">
					<?php comment_text(); ?>
				</div>
				<div class="eltd-comment-info">
				<span class="eltd-comment-date"><?php comment_time(get_option('date_format')); ?> <?php esc_html_e('at', 'flow'); ?> <?php comment_time(get_option('time_format')); ?></span>

					<span class="eltd-comment-edit-link">
						<?php
						edit_comment_link( 'Edit', '<span class="icon_pencil"></span>');
						?>
					</span>
					<span class="eltd-comment-reply-link">
						<?php
						comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '<span class="arrow_back"></span>') ) );
						?>
					</span>
				</div>
			<?php } ?>
		</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>

		<?php
	}
}

if( !function_exists('flow_elated_blog_archive_pages_classes') ) {

	/**
	 * Function which create classes for container in archive pages
	 *
	 * @return array
	 */

	function flow_elated_blog_archive_pages_classes($blog_type) {

		$classes = array();
		if(in_array($blog_type, flow_elated_blog_full_width_types())){
			$classes['holder'] = 'eltd-full-width';
			$classes['inner'] = 'eltd-full-width-inner';
		} elseif(in_array($blog_type, flow_elated_blog_grid_types())){
			$classes['holder'] = 'eltd-container';
			$classes['inner'] = 'eltd-container-inner clearfix';
		}

		return $classes;

	}

}

if( !function_exists('flow_elated_blog_full_width_types') ) {

	/**
	 * Function which return all full width blog types
	 *
	 * @return array
	 */

	function flow_elated_blog_full_width_types() {

		$types = array('masonry-full-width', 'expanding-tiles');

		return $types;

	}

}

if( !function_exists('flow_elated_blog_grid_types') ) {

	/**
	 * Function which return in grid blog types
	 *
	 * @return array
	 */

	function flow_elated_blog_grid_types() {

		$types = array('standard', 'masonry', 'split-column', 'standard-whole-post');

		return $types;

	}

}

if( !function_exists('flow_elated_blog_types') ) {

	/**
	 * Function which return all blog types
	 *
	 * @return array
	 */

	function flow_elated_blog_types() {

		$types = array_merge(flow_elated_blog_grid_types(), flow_elated_blog_full_width_types());

		return $types;

	}

}

if( !function_exists('flow_elated_blog_templates') ) {

	/**
	 * Function which return all blog templates names
	 *
	 * @return array
	 */

	function flow_elated_blog_templates() {

		$templates = array();
		$grid_templates = flow_elated_blog_grid_types();
		$full_templates = flow_elated_blog_full_width_types();
		foreach($grid_templates as $grid_template){
			array_push($templates, 'blog-'.$grid_template);
		}
		foreach($full_templates as $full_template){
			array_push($templates, 'blog-'.$full_template);
		}

		return $templates;

	}

}

if( !function_exists('flow_elated_blog_lists_number_of_chars') ) {

	/**
	 * Function that return number of characters for different lists based on options
	 *
	 * @return int
	 */

	function flow_elated_blog_lists_number_of_chars() {

		$number_of_chars = array();

		if(flow_elated_options()->getOptionValue('standard_number_of_chars')) {
			$number_of_chars['standard'] = flow_elated_options()->getOptionValue('standard_number_of_chars');
		}
		if(flow_elated_options()->getOptionValue('masonry_number_of_chars')) {
			$number_of_chars['masonry'] = flow_elated_options()->getOptionValue('masonry_number_of_chars');
		}
		if(flow_elated_options()->getOptionValue('split_column_number_of_chars')){
			$number_of_chars['split-column'] = flow_elated_options()->getOptionValue('split_column_number_of_chars');
		}
		if(flow_elated_options()->getOptionValue('expanding_tiles_number_of_chars')){
			$number_of_chars['expanding-tiles'] = flow_elated_options()->getOptionValue('expanding_tiles_number_of_chars');
		}

		return $number_of_chars;

	}

}

if (!function_exists('flow_elated_excerpt_length')) {
	/**
	 * Function that changes excerpt length based on theme options
	 * @param $length int original value
	 * @return int changed value
	 */
	function flow_elated_excerpt_length( $length ) {

		if(flow_elated_options()->getOptionValue('number_of_chars') !== ''){
			return esc_attr(flow_elated_options()->getOptionValue('number_of_chars'));
		} else {
			return 45;
		}
	}

	add_filter( 'excerpt_length', 'flow_elated_excerpt_length', 999 );
}

if (!function_exists('flow_elated_excerpt_more')) {
	/**
	 * Function that adds three dotes on the end excerpt
	 * @param $more
	 * @return string
	 */
	function flow_elated_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'flow_elated_excerpt_more');
}

if(!function_exists('flow_elated_post_has_read_more')) {
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function flow_elated_post_has_read_more() {
		global $post;

		return strpos($post->post_content, '<!--more-->');
	}
}

if(!function_exists('flow_elated_post_has_title')) {
	/**
	 * Function that checks if current post has title or not
	 * @return bool
	 */
	function flow_elated_post_has_title() {
		return get_the_title() !== '';
	}
}

if (!function_exists('flow_elated_modify_read_more_link')) {
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function flow_elated_modify_read_more_link() {
		$link = '<div class="eltd-more-link-container">';
		$link .= flow_elated_get_button_html(array(
			'link' => get_permalink().'#more-'.get_the_ID(),
			'text' => esc_html__('Continue reading', 'flow')
		));

		$link .= '</div>';

		return $link;
	}

	add_filter( 'the_content_more_link', 'flow_elated_modify_read_more_link');
}

if(!function_exists('flow_elated_has_blog_widget')) {
	/**
	 * Function that checks if latest posts widget is added to widget area
	 * @return bool
	 */
	function flow_elated_has_blog_widget() {
		$widgets_array = array(
			'eltd_latest_posts_widget'
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

if(!function_exists('flow_elated_has_blog_shortcode')) {
	/**
	 * Function that checks if any of blog shortcodes exists on a page
	 * @return bool
	 */
	function flow_elated_has_blog_shortcode() {
		$blog_shortcodes = array(
			'eltd_blog_list',
			'eltd_blog_slider',
			'eltd_blog_carousel'
		);

		$slider_field = get_post_meta(flow_elated_get_page_id(), 'eltd_page_slider_meta', true); //TODO change

		foreach ($blog_shortcodes as $blog_shortcode) {
			$has_shortcode = flow_elated_has_shortcode($blog_shortcode) || flow_elated_has_shortcode($blog_shortcode, $slider_field);

			if($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}


if(!function_exists('flow_elated_load_blog_assets')) {
	/**
	 * Function that checks if blog assets should be loaded
	 *
	 * @see flow_elated_is_ajax_enabled()
	 * @see flow_elated_is_ajax_enabled_is_blog_template()
	 * @see is_home()
	 * @see is_single()
	 * @see eltd_has_blog_shortcode()
	 * @see is_archive()
	 * @see is_search()
	 * @see eltd_has_blog_widget()
	 * @return bool
	 */
	function flow_elated_load_blog_assets() {
		return flow_elated_is_ajax_enabled() || flow_elated_is_blog_template() || is_home() || is_single() || flow_elated_has_blog_shortcode() || is_archive() || is_search() || flow_elated_has_blog_widget();
	}
}

if(!function_exists('flow_elated_is_blog_template')) {
	/**
	 * Checks if current template page is blog template page.
	 *
	 *@param string current page. Optional parameter.
	 *
	 *@return bool
	 *
	 * @see flow_elated_get_page_template_name()
	 */
	function flow_elated_is_blog_template($current_page = '') {

		if($current_page == '') {
			$current_page = flow_elated_get_page_template_name();
		}

		$blog_templates = flow_elated_blog_templates();

		return in_array($current_page, $blog_templates);
	}
}

if(!function_exists('flow_elated_read_more_button')) {
	/**
	 * Function that outputs read more button html if necessary.
	 * It checks if read more button should be outputted only if option for given template is enabled and post does'nt have read more tag
	 * and if post isn't password protected
	 *
	 * @param string $option name of option to check
	 * @param string $class additional class to add to button
	 * @param string $size
	 */
	function flow_elated_read_more_button($option = '', $class = '', $size = 'medium') {
		if($option != '') {
			$show_read_more_button = flow_elated_options()->getOptionValue($option) == 'yes';
		}else {
			$show_read_more_button = 'yes';
		}
		
		$read_more_class = $class . ' eltd-read-more '; //currently is fixed in code to be green button
		
		if($show_read_more_button && !flow_elated_post_has_read_more() && !post_password_required()) {
			echo flow_elated_get_button_html(array(
				'size'         => $size,
				'link'         => get_the_permalink(),
				'text'         => esc_html__('Read More', 'flow'),
				'custom_class' => $read_more_class
			));
		}
	}
}

if(!function_exists('flow_elated_set_blog_holder_data_params')){
	/**
	 * Function which set data params on blog holder div
	 */
	function flow_elated_set_blog_holder_data_params(){
		
		$show_load_more = flow_elated_enable_load_more();
		$enable_inf_scroll = flow_elated_enable_infinite_scroll();
		
		if($show_load_more || $enable_inf_scroll){
			
			$current_query = flow_elated_get_blog_query();
			
			$data_params = array();
			$data_return_string = '';
			
			$paged = flow_elated_paged();
			
			$posts_number =  '';
			if(get_post_meta(get_the_ID(), "eltd_show_posts_per_page_meta", true) != ""){
				$posts_number = get_post_meta(get_the_ID(), "eltd_show_posts_per_page_meta", true);
			}else{			
				$posts_number = get_option('posts_per_page');
			} 
			$category = get_post_meta(flow_elated_get_page_id(), 'eltd_blog_category_meta', true);
			
			
			//set data params
			$data_params['data-next-page'] = $paged+1;
			$data_params['data-max-pages'] =  $current_query->max_num_pages;
			
			
			if($posts_number !=''){
				$data_params['data-post-number'] = $posts_number;
			}
			
			
			if($category !=''){
				$data_params['data-category'] = $category;
			}
			if(is_archive()){
				if(is_category()){
					$cat_id = get_queried_object_id();
					$data_params['data-archive-category'] = $cat_id;
				}
				if(is_author()){
					$author_id = get_queried_object_id();
					$data_params['data-archive-author'] = $author_id;
 				}
				if(is_tag()){
					$current_tag_id = get_queried_object_id();
					$data_params['data-archive-tag'] = $current_tag_id;
				}
				if(is_date()){
					$day  = get_query_var('day');
					$month = get_query_var('monthnum');
					$year = get_query_var('year');
					
					$data_params['data-archive-day'] = $day;
					$data_params['data-archive-month'] = $month;
					$data_params['data-archive-year'] = $year;
				}				
			}
			if(is_search()){
				$search_query = get_search_query();
				$data_params['data-archive-search-string'] = $search_query; // to do, not finished
			}
			
			foreach($data_params as $key => $value) {
				if($key !== '') {
					$data_return_string .= $key.'= '.esc_attr($value).' ';
				}
			}
			
			return $data_return_string;
			
		}
	}
}

if(!function_exists('flow_elated_enable_load_more')){
	/**
	 * Function that check if load more is enabled
	 * 
	 * return boolean
	 */
	function flow_elated_enable_load_more(){
		$enable_load_more = false;
		$id = flow_elated_get_page_id();
		
		if(flow_elated_get_meta_field_intersect('lists_pagination', $id) == 'load-more'){
			$enable_load_more = true;
		}
		
		return $enable_load_more;
	}
}
if(!function_exists('flow_elated_enable_infinite_scroll')){
	/**
	 * Function that check if infinite scroll is enabled
	 * 
	 * return boolean
	 */
	function flow_elated_enable_infinite_scroll(){
		$enable_inf_scroll = false;
		$id = flow_elated_get_page_id();
		
		if(flow_elated_get_meta_field_intersect('lists_pagination', $id) == 'infinite-scroll'){
			$enable_inf_scroll = true;
		}
		
		return $enable_inf_scroll;
	}
}

if(!function_exists('flow_elated_is_masonry_template')){
	/**
	 * Check if is masonry template enabled
	 * return boolean
	 */
	function flow_elated_is_masonry_template(){

		$page_id = flow_elated_get_page_id();
		$page_template = get_page_template_slug($page_id);
		$page_options_template = flow_elated_options()->getOptionValue('blog_list_type');

		if(!is_archive()){
			if($page_template == 'blog-masonry.php' ||  $page_template =='blog-masonry-full-width.php'){
				return true;
			}
		}elseif(is_archive() || is_home()){
			if($page_options_template == 'masonry' || $page_options_template == 'masonry-full-width'){
				return true;
			}
		}
		else{
			return false;
		}
	}


}
if(!function_exists('flow_elated_is_expanding_tiles_template')){
	/**
	 * Check if is masonry template enabled
	 * return boolean
	 */
	function flow_elated_is_expanding_tiles_template(){

		$page_id = flow_elated_get_page_id();
		$page_template = get_page_template_slug($page_id);
		$page_options_template = flow_elated_options()->getOptionValue('blog_list_type');

		if(!is_archive()){
			
			if($page_template == 'blog-expanding-tiles.php'){
				
				return true;
				
			}
			
		}elseif(is_archive() || is_home()){
			
			if($page_options_template == 'expanding-tiles'){
				
				return true;
				
			}
			
		}
		else{
			return false;
		}
	}


}
if(!function_exists('flow_elated_get_post_image_size')){
	/**
	 * Function returns image size for post in loop
	 * This is only for masonry blog lists
	 * return string
	 */
	function flow_elated_get_post_image_size(){

		$image_size = get_post_meta(get_the_ID(), 'eltd_post_image_size_meta', true);

		switch ($image_size) {
			case 'portrait':
				$image_size_class = 'flow_elated_portrait';
				break;
			case 'landscape':
				$image_size_class = 'flow_elated_landscape';
				break;
			case 'square':
				$image_size_class = 'flow_elated_square';
				break;
			default:
				$image_size_class = 'full';
				break;
		}
		return $image_size_class;
		
	}
}


if(!function_exists('flow_elated_get_post_link')){
	/**
	 * Function returns href attribute for post links
	 * Link post format on single pages should take link from meta field
	 * return string
	 */
	function flow_elated_get_post_link(){
		
		$post_format = get_post_format();
		
		if($post_format == 'link'){
			$meta_field_value = esc_html(get_post_meta(get_the_ID(), "eltd_post_link_link_meta", true));
			
			if(is_single()){
				if($meta_field_value != ''){
					$link = $meta_field_value;
				}else{
					$link = esc_attr( get_the_permalink() );
				}
			} else {
				$link = esc_attr( get_the_permalink() );
			}
		}else{
			$link = esc_attr( get_the_permalink() );
		}
		return $link;
	}
}

if(!function_exists('flow_elated_get_quote_meta_fields')){
	/**
	 * Function returns quote auhtor and text meta field
	 * 
	 * return array
	 */
	function flow_elated_get_quote_meta_fields(){
		
		$quote_params = array();
		$quote_text = '';
		$quote_author = '';
		$meta_text = esc_html(get_post_meta(get_the_ID(), "eltd_post_quote_text_meta", true));
		$meta_author = esc_html(get_post_meta(get_the_ID(), "eltd_post_quote_author_meta", true));
		
		if($meta_text != ''){
			$quote_text = $meta_text;
		}
		if($meta_author != ''){
			$quote_author = $meta_author;
		}
		
		$quote_params['quote_text'] = $quote_text;
		$quote_params['quote_author'] = $quote_author;
		
		return $quote_params;
	}
}

if(!function_exists('flow_elated_quote_bck_img_style')){
	/**
	 * Function generates style attribute for link and quote background image
	 * 
	 * return string
	 */
	function flow_elated_quote_bck_img_style(){
		
		$style_attr = '';
		
		if(has_post_thumbnail()){
			$background_image_object = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID()), 'full');
			$background_image_src = $background_image_object[0];
			$style_attr  = 'style = background-image:url('.  esc_url($background_image_src) .')';
		}
		
		print $style_attr;
		
	}
}
if(!function_exists('flow_elated_quote_bck_img_class')){
	/**
	 * Function generates class for link and quote background image
	 * 
	 * return string
	 */
	function flow_elated_quote_bck_img_class(){
		
		$class = '';
		
		if(has_post_thumbnail()){
			$class = 'eltd-quote-bck-img';
		}
		
		print $class;
		
	}
}
if(!function_exists('flow_elated_get_post_classes')){
	/**
	 * Function generates post classes
	 * 
	 * return string
	 */
	function flow_elated_get_post_classes(){
		
		$class = array();
		
		if(!has_post_thumbnail()){
			$class[] = 'eltd-post-no-img'; //all post classes should be generated in this function
		}
		
		return implode(' ',$class);
		
	}
}
if(!function_exists('flow_elated_get_post_back_image')){
	
	function  flow_elated_get_post_back_image(){
		/**
		* Function generates background image style attribute for post in loop
		* 
		* return string
		*/
		
		$style_attr = '';
		
		if ( has_post_thumbnail() ) {
			$background_image_object = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID()),'full');	
			$background_image_src = $background_image_object[0];
			$style_attr  = 'background-image:url('.  esc_url($background_image_src) .')';
		}
		
		return $style_attr;
		
	}
	
}


if(! function_exists('flow_elated_add_user_custom_fields')){
	/**
	 * Function creates custom social fields for users
	 * 
	 * return $user_contact
	 */
	function flow_elated_add_user_custom_fields($user_contact) {

		/**
		 * Function that add custom user fields
		 **/
		$user_contact['instagram']   = esc_html__( 'Instagram', 'flow');
		$user_contact['twitter'] = esc_html__( 'Twitter', 'flow');
		$user_contact['pinterest'] = esc_html__( 'Pinterest', 'flow' );
		$user_contact['tumblr'] = esc_html__( 'Tumbrl', 'flow' );
		$user_contact['facebook'] = esc_html__( 'Facebook', 'flow');
		$user_contact['googleplus'] = esc_html__( 'Google Plus', 'flow');
		$user_contact['linkedin'] = esc_html__( 'Linkedin', 'flow' );
		$user_contact['vimeo'] = esc_html__( 'Vimeo', 'flow' );
		$user_contact['youtube'] = esc_html__( 'Youtube', 'flow' );
		$user_contact['skype'] = esc_html__( 'Skype', 'flow' );
		$user_contact['yahoo'] = esc_html__( 'Yahoo', 'flow' );

		return $user_contact;
	}
}

add_filter( 'user_contactmethods', 'flow_elated_add_user_custom_fields');

if(! function_exists('flow_elated_get_user_custom_fields')){
	/**
	 * Function returns links and icons for author social networks 
	 * 
	 * return array
	 */
	function flow_elated_get_user_custom_fields( $id ){
		
		$user_social_array = array();
		$social_network_array = array('instagram', 'twitter','pinterest','tumblr','facebook','googleplus','linkedin','soundcloud','vimeo','youtube','skype','yahoo');
		
		foreach($social_network_array as $network){
			if(get_the_author_meta($network, $id) != ''){
				$$network = array(
					'link' => get_the_author_meta($network),
					'class' => 'social_'.$network
				);
				$user_social_array[$network] = $$network;
			}
		}	

		return $user_social_array;
	}
}


if(!function_exists('flow_elated_featured_post_class')){
	/**
	 * Function sets class for featured posts 
	 * 
	 * return srting
	 */
	function flow_elated_featured_post_class(){
		
		$class = '';
		
		if(get_post_meta(get_the_ID(),'eltd_featured_post_meta',true)== 'yes'){
			$class = 'eltd-featured-post';
		}
		
		return $class;
		
	}
}

if(!function_exists('flow_elated_get_blog_slider_position')){
	/**
	 * Function check slider position on blog templates
	 * 
	 * return string
	 */
	function flow_elated_get_blog_slider_position(){
		
		$slider_position = '';
		$id = flow_elated_get_page_id();
		$sidebar = flow_elated_sidebar_layout();
		
		$slider_position_value = get_post_meta($id,'eltd_blog_slider_position_meta',true);
		
		if($slider_position_value !== '' && $sidebar != 'default' && $sidebar != 'no-sidebar' && $sidebar != ''){
			
			$slider_position = $slider_position_value;
			
		}else{
			
			$slider_position = 'above_content-sidebar';
			
		}
		
		return $slider_position;
		
	}
}

/**
	 * Loads more function for blog posts.
	 *
	 */

if(!function_exists('flow_elated_set_ajax_url')){
	/**
     * load themes ajax functionality
     * 
     */
	function flow_elated_set_ajax_url() {
		echo '<script type="application/javascript">var ElatedAjaxUrl = "'.admin_url('admin-ajax.php').'"</script>';
	}
	add_action('wp_enqueue_scripts', 'flow_elated_set_ajax_url');
	
}


if(!function_exists('flow_elated_blog_load_more')){
	
	function flow_elated_blog_load_more(){
	
	$return_obj = array();
	$paged = $post_number = $category = $cat_id = $tag_slug = $blog_type = $search_param = '' ;
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
	if (!empty($_POST['catId'])) {
        $cat_id = $_POST['catId'];
    }
	if (!empty($_POST['tagSlug'])) {
        $tag_slug = $_POST['tagSlug'];
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
	if(!empty($_POST['searchValue'])){
		$search_param = $_POST['searchValue'];
	}
	
	
	$html = '';
	$query_array = array(
		'post_type' => 'post',
		'paged' => $paged,
		'posts_per_page' => $post_number
	);
	if($category != ''){
		$query_array['cat'] = $category;
	}
	if($cat_id != ''){
		$query_array['cat'] = $cat_id; //override currently set category.
	}
	if($tag_slug != ''){
		$query_array['tag'] = $tag_slug; //override currently set category.
	}
	if($archive_category != ''){
		$query_array['cat'] = $archive_category;
	}
	if($archive_author != ''){
		$query_array['author'] = $archive_author;
	}
	if($archive_tag != ''){
		$query_array['tag'] = $archive_tag;
	}
	if($archive_day !='' && $archive_month != '' && $archive_year !=''){
		$query_array['day'] = $archive_day;
		$query_array['monthnum'] = $archive_month;
		$query_array['year'] = $archive_year;
	}
	if($search_param != ''){
		$query_array['s'] = $search_param;
	}
	
	
	$query_results = new \WP_Query($query_array);
	
	if($query_results->have_posts()):			
		while ( $query_results->have_posts() ) : $query_results->the_post();
			$html .=  flow_elated_get_post_format_html($blog_type, 'yes');
		endwhile;
		else:
			$no_posts_template = '';
		
			if($blog_type == 'expanding-tiles'){
				$no_posts_template = 'expandable';
			}
			$html .= flow_elated_get_post_format_html($no_posts_template, '', 'yes');
		endif;
		
	$return_obj = array(
		'html' => $html
	);
	
	echo json_encode($return_obj); exit;
}
}


add_action('wp_ajax_nopriv_flow_elated_blog_load_more', 'flow_elated_blog_load_more');
add_action( 'wp_ajax_flow_elated_blog_load_more', 'flow_elated_blog_load_more' );


if(!function_exists('flow_elated_get_post_by_ajax')){
	/**
	 * Function loads page content via ajax(for Blog Expandible Items template) 
	 *
	 */
	function flow_elated_get_post_by_ajax(){
		global $wp_query;

		$item_id = $html = '';
		
		
		if (!empty($_POST['currentItemId'])) {
			$item_id = $_POST['currentItemId'];
		}
		
		$query_array = array(
			'post_type' => 'post',
			'p' => $item_id
		);		
		$query_results = new \WP_Query($query_array);

		$wp_query = $query_results; 

		if($query_results->have_posts()):			
			while ( $query_results->have_posts() ) : $query_results->the_post();
				$html .= flow_elated_get_single_html('yes');
			endwhile;
		else:
			flow_elated_get_post_format_html('expandable', 'yes', 'yes'); //load no posts template
		endif;

		$return_obj = array(
			'html' => $html
		);

		$wp_query = null;

		echo json_encode($return_obj);

		wp_die();
		
	}
}

add_action('wp_ajax_nopriv_flow_elated_get_post_by_ajax', 'flow_elated_get_post_by_ajax');
add_action( 'wp_ajax_flow_elated_get_post_by_ajax', 'flow_elated_get_post_by_ajax' );


if(!function_exists('flow_elated_get_archive_page_html')){
	/**
	 * Function loads page content via ajax(for Blog Expandible Items template) 
	 *
	 */
	function flow_elated_get_archive_page_html(){
		
		$return_obj = array();
		$query_array = array();
		$post_number = $cat_id = $tag_slug = $html = $author_id = '';
		$max_pages = '';
		
		if (!empty($_POST['currentCatId'])) {
			$cat_id = $_POST['currentCatId'];
		}
		if (!empty($_POST['currentTagSlug'])) {
			$tag_slug = $_POST['currentTagSlug'];
		}
		if (!empty($_POST['currentAuthorId'])) {
			$author_id = $_POST['currentAuthorId'];
		}
		if (!empty($_POST['postNumber'])) {
			$post_number = $_POST['postNumber'];
		}
		
		$query_array = array(
			'post_type' => 'post',
			'posts_per_page' => $post_number
		);	
		if($cat_id != ''){
			$query_array['cat'] = $cat_id;
		}
		if($tag_slug != ''){
			$query_array['tag'] = $tag_slug;
		}
		if($author_id != ''){
			$query_array['author'] = $author_id;
		}
		
		$query_results = new WP_Query($query_array);		
		$max_pages = $query_results->max_num_pages;
		
		if($query_results->have_posts()):			
			while ( $query_results->have_posts() ) : $query_results->the_post();
				$html .= flow_elated_get_post_format_html('expanding-tiles', 'yes');
			endwhile;
		else:
			flow_elated_get_post_format_html('expandable', 'yes', 'yes'); //load no posts template
		endif;

		$return_obj = array(
			'html' => $html,
			'maxPages' => $max_pages
		);
	
		echo json_encode($return_obj); exit;
		
	}
}

add_action('wp_ajax_nopriv_flow_elated_get_archive_page_html', 'flow_elated_get_archive_page_html');
add_action( 'wp_ajax_flow_elated_get_archive_page_html', 'flow_elated_get_archive_page_html' );


if ( ! function_exists( 'flow_elated_ajax_add_comment' ) ) {

	function flow_elated_ajax_add_comment() {

		$comment_data = $_POST['commentData'];
		parse_str( $comment_data );
		$comment_array = array(
			'author'                      => isset( $author ) ? $author : null,
			'email'                       => isset( $email ) ? $email : null,
			'url'                         => isset( $url ) ? $url : null,
			'comment'                     => $comment,
			'submit'                      => isset( $submit ) ? $submit : 'Submit',
			'comment_post_ID'             => $comment_post_ID,
			'comment_parent'              => $comment_parent,
			'_wp_unfiltered_html_comment' => isset( $_wp_unfiltered_html_comment ) ? $_wp_unfiltered_html_comment : null
		);

		$comment = wp_handle_comment_submission( wp_unslash( $comment_array ) );
		if ( is_wp_error( $comment ) ) {
			$data = $comment->get_error_data();
			if ( ! empty( $data ) ) {
				$response = array(
					'data'   => $comment->get_error_message(),
					'status' => 'error'
				);
				$response = json_encode( $response );
				die( $response );
			} else {
				exit;
			}
		}

		$user = wp_get_current_user();

		/**
		 * Perform other actions when comment cookies are set.
		 *
		 * @since 3.4.0
		 *
		 * @param WP_Comment $comment Comment object.
		 * @param WP_User $user User object. The user may not exist.
		 */
		do_action( 'set_comment_cookies', $comment, $user );

		//Return comment html
		$args  = array(
			'max_depth'    => 5,
			'style'        => 'ul',
			'calback'      => 'flow_elated_comment',
			'end-callback' => 'NULL',
			'type'         => 'all',
			'avatar_size'  => '32',

		);
		$depth = 1;

		ob_start();
		flow_elated_comment( $comment, $args, $depth );
		$comments_html = ob_get_clean();

		$response = array(
			'data'   => $comments_html,
			'status' => 'success'
		);

		$response = json_encode( $response );

		die($response);

	}

	add_action('wp_ajax_nopriv_flow_elated_ajax_add_comment', 'flow_elated_ajax_add_comment');
	add_action( 'wp_ajax_flow_elated_ajax_add_comment', 'flow_elated_ajax_add_comment' );

}

if ( ! function_exists( 'flow_elated_get_infinite_scroll_trigger' ) ) {

	function flow_elated_get_infinite_scroll_trigger() {
		$infinite_scroll_enabled = flow_elated_enable_infinite_scroll();

		if ( is_home() || is_page_template('blog-expanding-tiles.php') || is_page_template('blog-masonry.php') || is_page_template('blog-masonry-full-width.php') || is_page_template('blog-split-column.php') || is_page_template('blog-standard.php') || is_page_template('blog-standard-whole-post.php') ) {
			if ( $infinite_scroll_enabled ) {
				echo '<div class="eltd-infinite-scroll-trigger"></div>';
				do_action( 'flow_elated_after_load_more_button' );
			}
		}

	}

	add_action( 'flow_elated_generate_scroll_trigger', 'flow_elated_get_infinite_scroll_trigger' );

}

if ( ! function_exists( 'flow_elated_ajax_search' ) ) {

	function flow_elated_ajax_search() {

		$searchParam = $_POST['searchParam'];

		$query = array(
			's' => $searchParam,
			'post_type' => 'post'
		);

		$searchResults = new WP_Query($query);
		$max_pages = $searchResults;
		$result = '';

		if ( $searchResults->have_posts() ) {

			while ( $searchResults->have_posts() ) {
				$searchResults->the_post();

				$result .= flow_elated_get_post_format_html('expanding-tiles', 'yes', '');
			}

		} else {
			$result .= flow_elated_get_post_format_html('expandable', 'yes', 'yes'); //load no posts template
		}

		$return_obj = array(
			'html' => $result,
			'maxPages' => $max_pages
		);

		echo json_encode($return_obj); exit;


	}

	add_action('wp_ajax_flow_elated_ajax_search', 'flow_elated_ajax_search');
	add_action('wp_ajax_nopriv_flow_elated_ajax_search', 'flow_elated_ajax_search');

}

if ( ! function_exists( 'flow_elated_related_post_preloader' ) ) {

	function flow_elated_related_post_preloader() {

		$html = '<div class="eltd-single-post-preload-holder eltd-related-post-preloader">
					<span class="eltd-preload-square eltd-preload-square-1"></span>
                    <span class="eltd-preload-square eltd-preload-square-2"></span>
                    <span class="eltd-preload-square eltd-preload-square-4"></span>
                    <span class="eltd-preload-square eltd-preload-square-3"></span>
                </div>';

		echo $html;

	}

	add_action( 'flow_elated_after_related_post_image', 'flow_elated_related_post_preloader' );

}

if ( ! function_exists( 'flow_elated_gallery_post_preloader' ) ) {

	function flow_elated_gallery_post_preloader() {

		$html = '<div class="eltd-single-post-preload-holder eltd-format-gallery">
					<span class="eltd-preload-square eltd-preload-square-1"></span>
                    <span class="eltd-preload-square eltd-preload-square-2"></span>
                    <span class="eltd-preload-square eltd-preload-square-4"></span>
                    <span class="eltd-preload-square eltd-preload-square-3"></span>
                </div>';

		echo $html;

	}

	add_action( 'flow_elated_after_gallery_slide', 'flow_elated_gallery_post_preloader' );

}

if ( ! function_exists( 'flow_elated_blog_list_load_more_preloader' ) ) {

	function flow_elated_blog_list_load_more_preloader() {

		$html = '<div class="eltd-list-loading">
                	<div class="eltd-blog-list-preload-holder">
                    	<span class="eltd-preload-square eltd-preload-square-1"></span>
                     	<span class="eltd-preload-square eltd-preload-square-2"></span>
                     	<span class="eltd-preload-square eltd-preload-square-4"></span>
                     	<span class="eltd-preload-square eltd-preload-square-3"></span>
                	</div>
                </div>';

		echo $html;

	}

	add_action( 'flow_elated_after_load_more_button', 'flow_elated_blog_list_load_more_preloader' );

}

?>