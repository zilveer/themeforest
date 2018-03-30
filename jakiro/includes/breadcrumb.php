<?php
if(!class_exists('DH_Breadcrumb')):
class DH_Breadcrumb {
	public function __construct(){
		if(!is_admin()){
			add_filter('dh_get_breadcrumb', array(&$this,'output'));
		}
	}
	
	public function output($args = array()){
		global $wp_query;
		
		$defaults = array(
				'home' => esc_html__( 'Home', 'jakiro' ),
				'delimiter' => '',
				'front_page' => false,
				'show_blog' => true,
				'singular_post_taxonomy' => 'category',
		);
		
		$args = apply_filters( 'dh_breadcrumb_args', $args );
		$args = wp_parse_args( $args, $defaults );
		
		$delimiter = $args['delimiter'];
		
		if ( is_front_page() && !$args['front_page'] )
			return apply_filters( 'dh_breadcrumb_output', false );
		
		$item = array();
	
		$show_on_front = get_option( 'show_on_front' );
		
		/* Front page. */
		if ( is_front_page() ) {
			$item['last'] = $args['home'];
		}
		
		/* Link to front page. */
		if ( !is_front_page() )
			$item[] = '<span typeof="v:Breadcrumb"><a href="'. home_url( '/' ) .'"  property="v:title" rel="v:url" class="home"><span>' . $args['home'] . '</span></a></span>';
		
		
		/* If bbPress is installed and we're on a bbPress page. */
		if ( function_exists( 'is_bbpress' ) && is_bbpress() )
			$item = array_merge( $item, $this->_bbpress_items() );
		
		/* If viewing a home/post page. */
		elseif ( is_home() ) {
			$home_page = get_page( $wp_query->get_queried_object_id() );
			$item = array_merge( $item, $this->_get_parents( $home_page->post_parent ) );
			$item['last'] = get_the_title( $home_page->ID );
		}
		
		/* If viewing a singular post. */
		elseif ( is_singular() ) {
		
			$post = $wp_query->get_queried_object();
			$post_id = (int) $wp_query->get_queried_object_id();
			$post_type = $post->post_type;
		
			$post_type_object = get_post_type_object( $post_type );
		
		
			if ( 'page' !== $wp_query->post->post_type ) {
		
				/* If there's an archive page, add it. */
				if ( is_singular('portfolio') ) {
					$terms = wp_get_object_terms( $post_id, 'portfolio_category' );
					if($terms)
						$item = array_merge( $item, $this->_get_term_parents( $terms[0], 'portfolio_category' ) );
					//$item[] = get_the_term_list( $post_id, 'portfolio_category', '', ', ', '' );
				}
		
				if ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) && is_taxonomy_hierarchical( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) ) {
					$terms = wp_get_object_terms( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"] );
					if($terms)
						$item = array_merge( $item, $this->_get_term_parents( $terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"] ) );
				}elseif ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) ){
					$item[] = get_the_term_list( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '' );
				}
			}
		
			if ( ( is_post_type_hierarchical( $wp_query->post->post_type ) || 'attachment' === $wp_query->post->post_type ) && $parents = $this->_get_parents( $wp_query->post->post_parent ) ) {
				$item = array_merge( $item, $parents );
			}
		
			$item['last'] = get_the_title();
		}
		
		/* If viewing any type of archive. */
		else if ( is_archive() ) {
		
		
			if ( is_category() || is_tag() || is_tax() ) {
		
				$term = $wp_query->get_queried_object();
				$taxonomy = get_taxonomy( $term->taxonomy );
		
				if ( ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents = $this->_get_term_parents( $term->parent, $term->taxonomy ) )
					$item = array_merge( $item, $parents );
		
				$item['last'] = $term->name;
			}
		
			else if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {
				$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );
				$item['last'] = $post_type_object->labels->name;
			}
		
			else if ( is_date() ) {
		
				if(is_numeric(get_query_var('w') && 0 !== get_query_var('w') ))
					$item['last'] =  sprintf( esc_html__('Weekly Archive for: "%s"','jakiro'),get_the_time('W'));
				elseif ( is_day() )
				$item['last'] = sprintf( esc_html__('Daily Archive for: "%s"','jakiro'),get_the_time('F jS, Y'));
				elseif ( is_month() )
				$item['last'] =  sprintf( esc_html__('Monthly Archive for: "%s"','jakiro'),get_the_time('F jS, Y'));
				elseif ( is_year() )
				$item['last'] =  sprintf(esc_html__('Yearly Archive for: "%s"','jakiro'),get_the_time('Y'));
			}
		
			else if ( is_author() )
				$item['last'] =  sprintf(esc_html__('Author Archive for: "%s"','jakiro'),get_the_author_meta( 'display_name', $wp_query->post->post_author ));
		}
		
		/* If viewing search results. */
		else if ( is_search() )
			$item['last'] =  esc_html__('Search','jakiro');//sprintf(__('search Results for: "%s"','jakiro'),stripslashes( strip_tags( get_search_query() ) ));
		
		/* If viewing a 404 error page. */
		else if ( is_404() )
			$item['last'] = esc_html__( 'Page Not Found', 'jakiro' );
		
		$item['last'] = '<span typeof="v:Breadcrumb" property="v:title">'.$item['last'].'</span>';
		$breadcrumb = '';
		if(!empty($item) && is_array($item)){
			$breadcrumb = '<ul class="breadcrumb" prefix="v: http://rdf.data-vocabulary.org/#">';
			$breadcrumb .= '<li>'.join( "{$delimiter}".'</li><li>', $item ).'</li>';
			$breadcrumb .= '</ul>';
		}
		
		$breadcrumb = apply_filters( 'dh_breadcrumb_output', $breadcrumb );
	
		return $breadcrumb;
	}
	
	protected function _bbpress_items() {
	
		$item = array();
	
		$post_type_object = get_post_type_object( bbp_get_forum_post_type() );
	
		if ( !empty( $post_type_object->has_archive ) && !bbp_is_forum_archive() )
			$item[] = '<span typeof="v:Breadcrumb"><a href="' . get_post_type_archive_link( bbp_get_forum_post_type() ) . '"  property="v:title" rel="v:url"><span>' . bbp_get_forum_archive_title() . '</span></a></span>';
	
		if ( bbp_is_forum_archive() )
			$item[] = bbp_get_forum_archive_title();
	
		elseif ( bbp_is_topic_archive() )
		$item[] = bbp_get_topic_archive_title();
	
		elseif ( bbp_is_single_view() )
		$item[] = bbp_get_view_title();
	
		elseif ( bbp_is_single_topic() ) {
	
			$topic_id = get_queried_object_id();
	
			$item = array_merge( $item, $this->_get_parents( bbp_get_topic_forum_id( $topic_id ) ) );
	
			if ( bbp_is_topic_split() || bbp_is_topic_merge() || bbp_is_topic_edit() )
				$item[] = '<span typeof="v:Breadcrumb"><a href="' . bbp_get_topic_permalink( $topic_id ) . '"  property="v:title" rel="v:url"><span>' . bbp_get_topic_title( $topic_id ) . '</span></a></span>';
			else
				$item[] = bbp_get_topic_title( $topic_id );
	
			if ( bbp_is_topic_split() )
				$item[] = esc_html__( 'Split', 'jakiro' );
	
			elseif ( bbp_is_topic_merge() )
			$item[] = esc_html__( 'Merge', 'jakiro' );
	
			elseif ( bbp_is_topic_edit() )
			$item[] = esc_html__( 'Edit', 'jakiro' );
		}
	
		elseif ( bbp_is_single_reply() ) {
	
			$reply_id = get_queried_object_id();
	
			$item = array_merge( $item, $this->_get_parents( bbp_get_reply_topic_id( $reply_id ) ) );
	
			if ( !bbp_is_reply_edit() ) {
				$item[] = bbp_get_reply_title( $reply_id );
	
			} else {
				$item[] = '<span typeof="v:Breadcrumb"><a href="' . bbp_get_reply_url( $reply_id ) . '"  property="v:title" rel="v:url"><span>' . bbp_get_reply_title( $reply_id ) . '</span></a></span>';
				$item[] = esc_html__( 'Edit', 'jakiro' );
			}
	
		}
	
		elseif ( bbp_is_single_forum() ) {
	
			$forum_id = get_queried_object_id();
			$forum_parent_id = bbp_get_forum_parent_id( $forum_id );
	
			if ( 0 !== $forum_parent_id)
				$item = array_merge( $item, $this->_get_parents( $forum_parent_id ) );
	
			$item[] = bbp_get_forum_title( $forum_id );
		}
	
		elseif ( bbp_is_single_user() || bbp_is_single_user_edit() ) {
	
			if ( bbp_is_single_user_edit() ) {
				$item[] = '<span typeof="v:Breadcrumb"><a href="' . bbp_get_user_profile_url() . '"  property="v:title" rel="v:url" ><span>' . bbp_get_displayed_user_field( 'display_name' ) . '</span></a></span>';
				$item[] = esc_html__( 'Edit', 'jakiro'  );
			} else {
				$item[] = bbp_get_displayed_user_field( 'display_name' );
			}
		}
		
		return $item;
	}
	
	protected function _get_parents( $post_id = '', $separator = '/' ) {
	
		$parents = array();
	
		if ( $post_id == 0 )
			return $parents;
	
		while ( $post_id ) {
			$page = get_page( $post_id );
			$parents[]  = '<span typeof="v:Breadcrumb"><a href="' . get_permalink( $post_id ) . '"  property="v:title" rel="v:url"><span>' . get_the_title( $post_id ) . '</span></a></span>';
			$post_id = $page->post_parent;
		}
	
		if ( $parents )
			$parents = array_reverse( $parents );
	
		return $parents;
	}
	
	protected function _get_term_parents( $parent_id = '', $taxonomy = '', $separator = '/' ) {
	
		$html = array();
		$parents = array();
	
		if ( empty( $parent_id ) || empty( $taxonomy ) )
			return $parents;
	
		while ( $parent_id ) {
			$parent = get_term( $parent_id, $taxonomy );
			$parents[] = '<span typeof="v:Breadcrumb"><a href="' . get_term_link( $parent, $taxonomy ) . '"  property="v:title" rel="v:url"><span>' . $parent->name . '</span></a></span>';
			$parent_id = $parent->parent;
		}
	
		if ( $parents )
			$parents = array_reverse( $parents );
	
		return $parents;
	}
}

new DH_Breadcrumb();
endif;