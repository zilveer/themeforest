<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/theme-seo.php
 * @file	 	1.2
 *
 * 	1.1	General
 *	1.2 Contextual hooks functions
 *	1.3 SEO - Title
 *	1.4	SEO - Description
 *  1.5 SEO - Keywords
 *  1.6 SEO - Robots
 *
 */
?>
<?php
/**
 * ------------------------------------------------------------------------
 * 1.	Hooks definition
 * ------------------------------------------------------------------------
 */
    /*-------------------------------------
    //  1.1	General
    ---------------------------------------*/
	function prostore_meta_head() { prostore_contextual_hook('prostore_meta_head'); }
	function prostore_head() { prostore_contextual_hook('prostore_head'); }

    /*-------------------------------------
    //  1.2 Contextual hooks functions
    ---------------------------------------*/
	if ( !function_exists( 'prostore_contextual_hook' ) ) {
	    function prostore_contextual_hook( $tag = '', $args = '' ) {
	        if ( !$tag ) { return false; }

	        do_action( $tag, $args );

	        foreach( (array) prostore_get_context() as $context ) {
	            do_action( "{$tag}_{$context}", $args );
	        }
	    }
	}

	if ( ! function_exists( 'prostore_get_context' ) ) {
		function prostore_get_context() {
			global $wp_query, $query_context;

			/* Return query_context if set -------------------------------------------*/
			if ( isset( $query_context->context ) && is_array( $query_context->context ) ) {
				return $query_context->context;
			} else {
	        	$query_context = new stdClass;
	        }

			/* Figure out the context ------------------------------------------------*/
			$query_context->context = array();

			/* Front page */
			if ( is_front_page() ) {
			    $query_context->context[] = 'home';
			}

			/* Blog page */
			if ( is_home() && ! is_front_page() ) {
				$query_context->context[] = 'blog';

	        /* Singular views. */
			} elseif ( is_singular() ) {

				$query_context->context[] = 'singular';
				$query_context->context[] = "singular-{$wp_query->post->post_type}";

				/* Page Templates. */
				if ( is_page_template() ) {
					$to_skip = array( 'page', 'post' );

					$page_template = basename( get_page_template() );
					$page_template = str_replace( '.php', '', $page_template );
					$page_template = str_replace( '.', '-', $page_template );

					if ( $page_template && ! in_array( $page_template, $to_skip ) ) {
						$query_context->context[] = $page_template;
					}
				}

				$query_context->context[] = "singular-{$wp_query->post->post_type}-{$wp_query->post->ID}";
			}

			/* Archive views. */
			elseif ( is_archive() ) {
				$query_context->context[] = 'archive';

				/* Taxonomy archives. */
				if ( is_tax() || is_category() || is_tag() ) {
					$term = $wp_query->get_queried_object();
					$query_context->context[] = 'taxonomy';
					$query_context->context[] = $term->taxonomy;
					$query_context->context[] = "{$term->taxonomy}-" . sanitize_html_class( $term->slug, $term->term_id );
				}

				/* User/author archives. */
				elseif ( is_author() ) {
					$query_context->context[] = 'user';
					$query_context->context[] = 'user-' . sanitize_html_class( get_the_author_meta( 'user_nicename', get_query_var( 'author' ) ), $wp_query->get_queried_object_id() );
				}

				/* Time/Date archives. */
				else {
					if ( is_date() ) {
						$query_context->context[] = 'date';
						if ( is_year() )
							$query_context->context[] = 'year';
						if ( is_month() )
							$query_context->context[] = 'month';
						if ( get_query_var( 'w' ) )
							$query_context->context[] = 'week';
						if ( is_day() )
							$query_context->context[] = 'day';
					}
					if ( is_time() ) {
						$query_context->context[] = 'time';
						if ( get_query_var( 'hour' ) )
							$query_context->context[] = 'hour';
						if ( get_query_var( 'minute' ) )
							$query_context->context[] = 'minute';
					}
				}
			}

			/* Search results. */
			elseif ( is_search() ) {
				$query_context->context[] = 'search';

			/* Error 404 pages. */
			} elseif ( is_404() ) {
				$query_context->context[] = 'error-404';
			}

			return $query_context->context;
		}
	}

    /*-------------------------------------
    //  1.3 SEO - Title
    ---------------------------------------*/
	function metabox_seo_title($title) {
		global $post;

		if( $post && !is_seo_plugin_active() ) {
		    if( is_home() || is_archive() || is_search() ) {
		        $postid = get_option('page_for_posts');
		    } else {
		        $postid = $post->ID;
		    }

			if( $seo_title = get_post_meta( $postid, 'seo_title', true ) ) {
				return $seo_title;
			}
		}
		return $title;
	}
	add_filter('wp_title', 'metabox_seo_title', 15);

    /*-------------------------------------
    //  1.4 SEO - Description
    ---------------------------------------*/
	function metabox_seo_description() {
		global $post;

		if( $post && !is_seo_plugin_active() ) {
		    if( is_home() || is_archive() || is_search() ) {
		        $postid = get_option('page_for_posts');
		    } else {
		        $postid = $post->ID;
		    }

			if( $seo_description = get_post_meta( $postid, 'seo_description', true ) ){
				echo '<meta name="description" content="'. esc_html(strip_tags($seo_description)) .'" />' . "\n";
			}
		}
	}
	add_action('prostore_meta_head', 'metabox_seo_description');

    /*-------------------------------------
    //  1.5 SEO - Keywords
    ---------------------------------------*/
	function metabox_seo_keywords() {
		global $post;

		if( $post && !is_seo_plugin_active() ) {
		    if( is_home() || is_archive() || is_search() ) {
		        $postid = get_option('page_for_posts');
		    } else {
		        $postid = $post->ID;
		    }

			if( $seo_keywords = get_post_meta( $postid, 'seo_keywords', true ) ){
				echo '<meta name="keywords" content="'. esc_html(strip_tags($seo_keywords)) .'" />' . "\n";
			}
		}
	}
	add_action('prostore_meta_head', 'metabox_seo_keywords');

    /*-------------------------------------
    //  1.6 SEO - Robots
    ---------------------------------------*/
	function metabox_seo_robots() {
		global $post;

		if( $post && !is_seo_plugin_active() && get_option('blog_public') == 1 ){
		    if( is_home() || is_archive() || is_search() ) {
		        $postid = get_option('page_for_posts');
		    } else {
		        $postid = $post->ID;
		    }

			$seo_index = get_post_meta( $postid, 'seo_robots_index', true );
			$seo_follow = get_post_meta( $postid, 'seo_robots_follow', true );

			if( !$seo_index ) $seo_index = 'index';
			if( !$seo_follow ) $seo_follow = 'follow';

			if( !($seo_index == 'index' && $seo_follow == 'follow') )
				echo '<meta name="robots" content="'. $seo_index .','. $seo_follow .'" />' . "\n";
		}
	}
	add_action('prostore_meta_head', 'metabox_seo_robots');