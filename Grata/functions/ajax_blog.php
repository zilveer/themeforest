<?php

if ( ! function_exists('blogAjaxPagination'))
{
	function blogAjaxPagination() {

		global $us_thumbnail_size;

		$attributes = array(
			'type' => isset( $_POST['type'] ) ? $_POST['type'] : 'square',
			'show_date' => isset( $_POST['show_date'] ) ? intval($_POST['show_date']) : NULL,
			'show_author' => isset( $_POST['show_author'] ) ? intval($_POST['show_author']) : NULL,
			'show_categories' => isset( $_POST['show_categories'] ) ? intval($_POST['show_categories']) : NULL,
			'show_tags' => isset( $_POST['show_tags'] ) ? intval($_POST['show_tags']) : NULL,
			'show_comments' => isset( $_POST['show_comments'] ) ? intval($_POST['show_comments']) : NULL,
			'show_read_more' => isset( $_POST['show_read_more'] ) ? intval($_POST['show_read_more']) : NULL,
			'category' => isset( $_POST['category'] ) ? $_POST['category'] : NULL,
			'items' => isset( $_POST['items'] ) ? intval($_POST['items']) : NULL,
			'columns' => isset( $_POST['columns'] ) ? intval($_POST['columns']) : NULL,
		);

		if ( ! in_array( $attributes['type'], array( 'square', 'rounded', 'masonry' ) ) ) {
			$attributes['type'] = 'square';
		}

		$paged = $_POST['page'];

		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',
			'paged' => $paged,
		);

		$categories_slugs = null;

		if ( ! empty( $attributes['category'] ) ) {
			$categories_slugs = explode( ',', $attributes['category'] );
			$categories_slugs = array_map( 'sanitize_title', $categories_slugs );
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $categories_slugs,
				)
			);
		}

		if (is_integer($attributes['items']) AND $attributes['items'] > 0) {
			$args['posts_per_page'] = $attributes['items'];
		}

		if ( ! in_array( $attributes['columns'], array( 1, 2, 3 ) ) ) {
			$attributes['columns'] = 1;
		}
		$classes = 'w-blog columns_'.$attributes['columns'];

		switch ( $attributes['type'] ) {
			case 'square':
				$classes .= ' imgpos_atleft';
				break;
			case 'rounded':
				$classes .= ' imgpos_atleft circle';
				break;
			case 'masonry':
				$classes .= ' imgpos_attop type_masonry';
				break;
		}


		$wp_query = new WP_Query(); $wp_query->query($args);

		$blog_thumbnails = array(
			'square' => 'blog-list',
			'rounded' => 'blog-list',
			'masonry' => 'blog-grid'
		);
		$us_thumbnail_size = $blog_thumbnails[$attributes['type']];
		if (empty($us_thumbnail_size))
		{
			$us_thumbnail_size = 'blog-list';
		}

		while ($wp_query->have_posts())
		{
			$wp_query->the_post();
			global $smof_data;

			$post_format = get_post_format()?get_post_format():'standard';

			global $post;

			$preview = (has_post_thumbnail())?get_the_post_thumbnail(get_the_ID(), $us_thumbnail_size):'';


			if (empty($preview) AND $us_thumbnail_size == 'blog-list')
			{
				$preview = '<img src="'.get_template_directory_uri().'/img/placeholder/500x500.gif" alt="">';
			}
			$output .= '<div class="' . join( ' ', get_post_class( 'w-blog-entry', null ) ) . '">
				<div class="w-blog-entry-h">
					<a class="w-blog-entry-link" href="'.get_permalink().'">';
			if ($preview) {
				$output .= '<span class="w-blog-entry-preview">'.$preview.'</span>';
			}

			$output .= '<h2 class="w-blog-entry-title"><span>'.get_the_title().'</span></h2>';

			$output .= '</a>
					<div class="w-blog-entry-body">
						<div class="w-blog-meta">';
			if ($attributes['show_date'] == 1 OR $attributes['show_date'] == 'yes') {
				$output .= '<div class="w-blog-meta-date">
								<i class="fa fa-clock-o"></i>
								<span>'.get_the_date().'</span>
							</div>';
			}
			if ($attributes['show_author'] == 1 OR $attributes['show_author'] == 'yes') {
				$output .= '<div class="w-blog-meta-author">
								<i class="fa fa-user"></i>';
				if (get_the_author_meta('url')) {
					$output .= '<a href="'.esc_url( get_the_author_meta('url') ).'">'.get_the_author().'</a>';
				} else {
					$output .= '<span>'.get_the_author().'</span>';
				}
				$output .= '</div>';
			}
			if ($attributes['show_categories'] == 1 OR $attributes['show_categories'] == 'yes') {
				$output .= '<div class="w-blog-meta-category">
								<i class="fa fa-folder-open"></i>';
				$categories = get_the_category();
				$categories_output = '';
				$separator = ', ';
				if($categories){
					foreach($categories as $category) {
						$categories_output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
					}
				}
				$output .= trim($categories_output, $separator).'
								</div>';
			}
			if ($attributes['show_tags'] == 1 OR $attributes['show_tags'] == 'yes') {
				$tags = wp_get_post_tags($post->ID);
				if ($tags) {
					$output .= '<div class="w-blog-meta-tags">
									<i class="fa fa-tags"></i>';

					$tags_output = '';
					$separator = ', ';
					foreach($tags as $tag) {
						$tags_output .= '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>'.$separator;
					}

					$output .= trim($tags_output, $separator).'
									</div>';
				}
			}
			if ($attributes['show_comments'] == 1 OR $attributes['show_comments'] == 'yes') {

				if ( ! (get_comments_number() == 0 AND ! comments_open() AND ! pings_open())) {
					$output .= '<div class="w-blog-meta-comments">';
					$output .= '<i class="fa fa-comments"></i>';
					$number = get_comments_number();

					if ( 0 == $number ) {
						$comments_link = get_permalink() . '#respond';
					}
					else {
						$comments_link = esc_url(get_comments_link());
					}
					$output .= '<a href="'.$comments_link.'">';

					if ( $number > 1 )
						$output .= str_replace('%', number_format_i18n($number), __('% Comments', 'us'));
					elseif ( $number == 0 )
						$output .= __('No Comments', 'us');
					else // must be one
						$output .= __('1 Comment', 'us');
					$output .= '</a></div>';
				}

			}
			$output .= '</div>';

			$output .= '<div class="w-blog-entry-short">';

			$excerpt = get_the_excerpt();

			if (empty($excerpt)) {
				$excerpt = get_the_content(get_the_ID());
				$excerpt = do_shortcode($excerpt);

				$excerpt = apply_filters('the_excerpt', $excerpt);
				$excerpt = str_replace(']]>', ']]>', $excerpt);
				$excerpt_length = apply_filters('excerpt_length', 55);
				$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
				$excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );
			}

			$output .= $excerpt;

			$output .= '</div>';

			if ($attributes['show_read_more'] == 1 OR $attributes['show_read_more'] == 'yes') {
				$output .= '<a class="w-blog-entry-more g-btn color_faded outlined size_small" href="'.get_permalink().'"><span>'.__('Read More', 'us').'</span></a>';
			}

			$output .= '</div>
				</div>
			</div>';
		}


		echo $output;

		die();

	}

	add_action( 'wp_ajax_nopriv_blogPagination', 'blogAjaxPagination' );
	add_action( 'wp_ajax_blogPagination', 'blogAjaxPagination' );
}
