<?php

/*********** Shortcode: Latest Post ************************************************************/

$ABdevDND_shortcodes['posts_dd'] = array(
	'attributes' => array(
		'category' => array(
			'description' => __( 'Category', 'dnd-shortcodes' ),
		),
		'ids' => array(
			'description' => __( 'Posts IDs', 'dnd-shortcodes' ),
		),
		'order' => array(
			'default' => 'DESC',
			'type' => 'select',
			'description' => __( 'Order', 'dnd-shortcodes' ),
			'values' => array(
				'ASC' =>  __( 'ASC', 'dnd-shortcodes' ),
				'DESC' =>  __( 'DESC', 'dnd-shortcodes' ),
			),      
		),
		'orderby' => array(
			'default' => 'date',
			'type' => 'select',
			'description' => __( 'Order by', 'dnd-shortcodes' ),
			'values' => array(
				'ID' =>  __( 'ID', 'dnd-shortcodes' ),
				'none' =>  __( 'none', 'dnd-shortcodes' ),
				'author' =>  __( 'author', 'dnd-shortcodes' ),
				'title' =>  __( 'title', 'dnd-shortcodes' ),
				'name' =>  __( 'name', 'dnd-shortcodes' ),
				'date' =>  __( 'date', 'dnd-shortcodes' ),
				'modified' =>  __( 'modified', 'dnd-shortcodes' ),
				'parent' =>  __( 'parent', 'dnd-shortcodes' ),
				'rand' =>  __( 'rand', 'dnd-shortcodes' ),
				'menu_order' =>  __( 'menu_order', 'dnd-shortcodes' ),
				'post__in' =>  __( 'post__in', 'dnd-shortcodes' ),
			),      
		),
		'post_parent' => array(
			'description' => __( 'Post Parent', 'dnd-shortcodes' ),
		),
		'post_type' => array(
			'default' => 'post',
			'description' => __( 'Post Type', 'dnd-shortcodes' ),
		),
		'posts_no' => array(
			'default' => '4',
			'description' => __( 'Number of Posts', 'dnd-shortcodes' ),
		),
		'offset' => array(
			'default' => '0',
			'description' => __( 'Offset', 'dnd-shortcodes' ),
		),
		'tag' => array(
			'description' => __( 'Tag', 'dnd-shortcodes' ),
		),
		'tax_operator' => array(
			'default' => 'IN',
			'description' => __( 'Tax Operator', 'dnd-shortcodes' ),
		),
		'tax_term' => array(
			'description' => __( 'Tax Term', 'dnd-shortcodes' ),
		),
		'taxonomy' => array(
			'description' => __( 'Taxonomy', 'dnd-shortcodes' ),
		),
		'excerpt' => array(
			'description' => __( 'Custom Excerpt Limit Words', 'dnd-shortcodes' ),
			'info' => __( 'How many words you want to display? If left empty default WordPress excerpt will be used.', 'dnd-shortcodes' ),
		),
	),
	'description' => __( 'Posts Excerpts', 'dnd-shortcodes' )
);

if ( ! function_exists( 'ABdevDND_posts_dd_shortcode' ) ){
	function ABdevDND_posts_dd_shortcode( $attributes ) {
		extract(shortcode_atts(ABdevDND_extract_attributes('posts_dd'), $attributes));

		$args = array(
			'category_name'  => $category,
			'order'          => $order,
			'orderby'        => $orderby,
			'post_type'      => explode( ',', $post_type ),
			'posts_per_page' => $posts_no,
			'offset'         => $offset,
			'tag'            => $tag,
		);
		if( $ids ) {
			$posts_in = array_map( 'intval', explode( ',', $ids ) );
			$args['post__in'] = $posts_in;
		}
		if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {
			$tax_term = explode( ', ', $tax_term );
			if( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ){
				$tax_operator = 'IN';
			}
			$tax_args = array(
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $tax_term,
						'operator' => $tax_operator
					)
				)
			);
			$args = array_merge( $args, $tax_args );
		}
		if( $post_parent ) {
			if( 'current' == $post_parent ) {
				global $post;
				$post_parent = $post->ID;
			}
			$args['post_parent'] = $post_parent;
		}
		$listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $attributes ) );
		if ( ! $listing->have_posts() ){
			return apply_filters( 'display_posts_shortcode_no_results', false );
		}
		$output = '';
		while ( $listing->have_posts() ): $listing->the_post(); 
			global $post;

			$thumbnail = get_the_post_thumbnail($post->ID,'thumbnail');
			$hasthumb_class = ($thumbnail!='') ? ' has_thumbnail' : ' without_thumbnail';

			$output .= '<div class="dnd_posts_shortcode clearfix'.$hasthumb_class.'">';
			$output .= ($thumbnail!='') ? '<a class="dnd_latest_news_shortcode_thumb" href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID,'thumbnail') . '</a>' :'';
			$output .= '<div class="dnd_latest_news_shortcode_content">';
			$output .= '<h5><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>';
			$date = get_the_date();
			$output .= '<p class="dnd_latest_news_time"><span class="month">'.get_the_date('M').'</span> <span class="day">'.get_the_date('d').'</span><span class="year">, '.get_the_date('Y').'</span></p>';
			if($excerpt > 0){
				$text = do_shortcode(get_the_content());
				$text = apply_filters('the_content', $text);
				$text = str_replace(']]>', ']]&gt;', $text);
				$text = strip_tags($text);
				$words = preg_split("/[\n\r\t ]+/", $text, $excerpt+1, PREG_SPLIT_NO_EMPTY);
				$ending = (count($words) > $excerpt) ? '...':'';
				$words = array_slice($words, 0, $excerpt);
				$text = implode(' ', $words).$ending;
			}
			else{
				$text = get_the_excerpt();
			}
			$output .= '<p>' . $text . '</p>';
			$output .= '</div>';
			$output .= '</div>';
		endwhile; 
		wp_reset_postdata();
		return $output;
	}
}

