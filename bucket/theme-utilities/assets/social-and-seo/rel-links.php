<?php
global $wp, $pagename, $post;
$url = wpgrade_get_current_canonical_url(true);

//the logic for outputting the rel links for the custom page builder
//SEO plugins can't get this right because they don't know the custom query :)
if(is_page() && get_page_template_slug(wpgrade::lang_original_post_id(get_the_ID())) == 'page-builder.php') {
	//first lets determine the page we are on
	$paged = (get_query_var('paged')) ? get_query_var('paged') : '';
	if( empty($paged)){
		$paged = (get_query_var('page')) ? get_query_var('page') : 1;
	}

	if( empty($paged)){
		$paged = 1;
	}

	//go through all the blocks and find if we have a Latest Posts block
	while(has_sub_field("blocks")) {
		$row_layout = get_row_layout();

		if ($row_layout == "latest_posts") {
			//we need to do something about it

			//unfortunately we need to do an extra query to properly get the number of pages
			$number_of_posts = get_sub_field('number_of_posts');

			$args = array(
				'paged' => $paged,
				'posts_per_page' => $number_of_posts,
				'order' => 'DESC',
				'orderby' => 'date',
				'ignore_sticky_posts' => false,
			);

			$posts_source = get_sub_field('posts_source');
			$offset = get_sub_field('offset');

			if ( is_numeric($offset) && $offset > 0 ) {
				//we need to paginate ourselves because WP will ignore paging (paged) when offset is present
				$args['offset'] = $offset + ($paged - 1) * $number_of_posts;
			}

			switch ( $posts_source ) :

				case 'featured' :
					/** In this case return only posts marked as featured */
					$args['meta_query'] = array(
						'relation' => 'AND',
						array(
							'key' => wpgrade::prefix() . 'featured_post',
							'value' => 'on',
							'compare' => '='
						)
					);
					break;

				case 'latest' :
					/** Return the latest posts only */
					$args['order'] = 'DESC';
					$args['orderby'] = 'date';
					break;

				case 'latest_by_cat' :
					/** Return posts from selected categories */
					$categories = get_sub_field('posts_source_category');
					$catarr = array();
					if(!empty($categories)) {
						foreach ($categories as $key => $value) {
							$catarr[] = (int) $value;
						}
					}

					$args['category__in'] = $catarr;
					break;

				case 'latest_by_format' :
					/** Return posts with the selected post format */
					$formats = get_sub_field('posts_source_post_formats');
					$terms = array();
					if (!isset($args['tax_query'])) {
						$args['tax_query'] = array();
					}
					foreach ( $formats as $key => &$format) {
						if ($format == 'standard') {
							//if we need to include the standard post formats
							//then we need to include the posts that don't have a post format set
							$all_post_formats = get_theme_support('post-formats');
							if (!empty($all_post_formats[0]) && count($all_post_formats[0])) {
								$allterms = array();
								foreach ($all_post_formats[0] as $format2) {
									$allterms[] = 'post-format-'.$format2;
								}

								$args['tax_query']['relation'] = 'AND';
								$args['tax_query'][] = array(
									'taxonomy' => 'post_format',
									'terms' => $allterms,
									'field' => 'slug',
									'operator' => 'NOT IN'
								);
							}
						} else {
							$terms[] = 'post-format-' . $format;
						}
					}

					if ( !empty($terms) ) {
						$args['tax_query'][] = array(
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => $terms,
							'operator' => 'IN'
						);
					}
					break;

				case 'latest_by_reviews':
					$args['meta_query'] = array(
						'relation' => 'AND',
						array(
							'key' => 'enable_review_score',
							'value' => '1',
							'compare' => '='
						)
					);
					break;
				default : ;
			endswitch;

			$latest_query = new WP_Query( $args );

			//now lets output the rel links
			if ( $paged == 2 ) {
				bucket::adjacent_rel_link( 'prev', $url, $paged - 1, true );
			}

			// Make sure to use index.php when needed, done after paged == 2 check so the prev links to homepage will not have index.php in them
			if ( is_front_page() ) {
				$base = $GLOBALS['wp_rewrite']->using_index_permalinks() ? 'index.php/' : '/';
				$url  = home_url( $base );
			}

			if ( $paged > 2 )
				bucket::adjacent_rel_link( 'prev', $url, $paged - 1, true );

			if ( $paged < $latest_query->max_num_pages )
				bucket::adjacent_rel_link( 'next', $url, $paged + 1, true );
		}
	}

	//reset the rows so we can properly display them later on
	reset_rows();
}
