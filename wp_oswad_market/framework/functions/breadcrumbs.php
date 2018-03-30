<?php 
/* 
	Show breadcrumbs with format : 
		Home » Category » Subcategory » Post Title
		Home » Subcategory » Post Title
		Home » Page Level 1 » Page Level 2 » Page Level 3
*/
if(!function_exists('dimox_breadcrumbs')){
	function dimox_breadcrumbs() {
	
		if( in_array( "woocommerce/woocommerce.php", apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
			if( function_exists('woocommerce_breadcrumb') && function_exists('is_woocommerce') && is_woocommerce() ){
				woocommerce_breadcrumb();
				return;
			}
		}
 
		wp_reset_query();
		$delimiter = '<span class="brn_arrow">&raquo;</span>';
	  
		$front_id = get_option( 'page_on_front' );
		if ( !empty( $front_id ) ) {
			$home = get_the_title( $front_id );
		} else {
			$home = __( 'Home', 'wpdance' );
		}
		$ar_title = array(
					'search' 		=> __('Search results for ','wpdance')
					,'404' 			=> __('Error 404','wpdance')
					,'tagged' 		=> __('Tagged ','wpdance')
					,'author' 		=> __('Articles posted by ','wpdance')
					,'page' 		=> __('Page','wpdance')
					,'portfolio' 	=> __('Portfolio','wpdance')
					);
	  
		$before = '<span class="current">'; // tag before the current crumb
		$after = '</span>'; // tag after the current crumb
		global $wp_rewrite;
		$rewriteUrl = $wp_rewrite->using_permalinks();
		if ( !is_home() && !is_front_page() || is_paged() ) {
	 
			echo '<div id="crumbs">';
	 
			global $post;
			$homeLink = home_url(); //get_bloginfo('url');
			echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
	 
		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
				echo $before . single_cat_title('', false) . $after;
	 
		}
		elseif ( is_search() ) {
			echo $before . $ar_title['search'] . '"' . get_search_query() . '"' . $after;
	 
		}elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
	 
		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
	 
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
	 
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				$post_type_name = $post_type->labels->singular_name;
			if(strcmp('Portfolio Item',$post_type->labels->singular_name)==0){
				$post_type_name = $ar_title['portfolio'];
			}
			if($rewriteUrl){
				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type_name . '</a> ' . $delimiter . ' ';
			}else{
				echo '<a href="' . $homeLink . '/?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
			}
			
			echo $before . get_the_title() . $after;
		  } else {
			$cat = get_the_category(); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo $before . get_the_title() . $after;
		  }
	 
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			$slug = $post_type->rewrite;
			$post_type_name = $post_type->labels->singular_name;
		  if(strcmp('Portfolio Item',$post_type->labels->singular_name)==0){
				$post_type_name = $ar_title['portfolio'];
		  }
			if ( is_tag() ) {
				echo $before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after;
		 
			}
			elseif(is_taxonomy_hierarchical(get_query_var('taxonomy'))){
				if($rewriteUrl){
					echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type_name . '</a> ' . $delimiter . ' ';
				}else{
					echo '<a href="' . $homeLink . '/?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
				}			
				
				$curTaxanomy = get_query_var('taxonomy');
				$curTerm = get_query_var( 'term' );
				$termNow = get_term_by( "name",$curTerm, $curTaxanomy);
				$pushPrintArr = array();
				if( $termNow !== false ){
					while ((int)$termNow->parent != 0){
						$parentTerm = get_term((int)$termNow->parent,get_query_var('taxonomy'));
						array_push($pushPrintArr,'<a href="' . get_term_link((int)$parentTerm->term_id,$curTaxanomy) . '">' . $parentTerm->name . '</a> ' . $delimiter . ' ');
						$curTerm = $parentTerm->name;
						$termNow = get_term_by( "name",$curTerm, $curTaxanomy);
					}
				}
				$pushPrintArr = array_reverse($pushPrintArr);
				array_push($pushPrintArr,$before  . get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) )->name  . $after);
				echo implode($pushPrintArr);
			}else{
				echo $before . $post_type_name . $after;
			}
	 
		} elseif ( is_attachment() ) {
			if( (int)$post->post_parent > 0 ){
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID);
				if( count($cat) > 0 ){
					$cat = $cat[0];
					echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				}
				echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			}
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) {
			echo $before . get_the_title() . $after;
	 
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_post($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
		  }
		  $breadcrumbs = array_reverse($breadcrumbs);
		  foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
		  echo $before . get_the_title() . $after;
	 
		} elseif ( is_tag() ) {
			echo $before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after;
	 
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . $ar_title['author'] . $userdata->display_name . $after;
	 
		} elseif ( is_404() ) {
			echo $before . $ar_title['404'] . $after;
		}
	 
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ) echo $before .' (';
				echo $ar_title['page'] . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ) echo ')'. $after;
		}
		else{ 
			if ( get_query_var('page') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ) echo $before .' (';
					echo $ar_title['page'] . ' ' . get_query_var('page');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ) echo ')'. $after;
			}
		}
		echo '</div>';
	 
	  }
		wp_reset_query();
	}
}

	if(!function_exists("wd_show_breadcrumbs")){
        function wd_show_breadcrumbs(){
            ?>
            <div class="top-page <?php wd_page_layout_class(); ?>">
				<div class="container">
					<?php dimox_breadcrumbs(); ?>
				</div>
            </div>
            <?php
        }
    }
	
	/* bbPress Breadcrumbs */
	if( class_exists('bbPress') ){
		function wd_bbpress_breadcrumbs( $args = array() ){
			wp_reset_query();

			// Define variables
			$front_id         = $root_id                                 = 0;
			$ancestors        = $crumbs           = $tag_data            = array();
			$pre_root_text    = $pre_front_text   = $pre_current_text    = '';
			$pre_include_root = $pre_include_home = $pre_include_current = true;

			/** Home Text *********************************************************/

			// No custom home text
			if ( empty( $args['home_text'] ) ) {

				$front_id = get_option( 'page_on_front' );

				// Set home text to page title
				if ( !empty( $front_id ) ) {
					$pre_front_text = get_the_title( $front_id );

				// Default to 'Home'
				} else {
					$pre_front_text = __( 'Home', 'wpdance' );
				}
			}

			/** Root Text *********************************************************/

			// No custom root text
			if ( empty( $args['root_text'] ) ) {
				$page = bbp_get_page_by_path( bbp_get_root_slug() );
				if ( !empty( $page ) ) {
					$root_id = $page->ID;
				}
				$pre_root_text = bbp_get_forum_archive_title();
			}

			/** Includes **********************************************************/

			// Root slug is also the front page
			if ( !empty( $front_id ) && ( $front_id === $root_id ) ) {
				$pre_include_root = false;
			}

			// Don't show root if viewing forum archive
			if ( bbp_is_forum_archive() ) {
				$pre_include_root = false;
			}

			// Don't show root if viewing page in place of forum archive
			if ( !empty( $root_id ) && ( ( is_single() || is_page() ) && ( $root_id === get_the_ID() ) ) ) {
				$pre_include_root = false;
			}

			/** Current Text ******************************************************/

			// Search page
			if ( bbp_is_search() ) {
				$pre_current_text = bbp_get_search_title();

			// Forum archive
			} elseif ( bbp_is_forum_archive() ) {
				$pre_current_text = bbp_get_forum_archive_title();

			// Topic archive
			} elseif ( bbp_is_topic_archive() ) {
				$pre_current_text = bbp_get_topic_archive_title();

			// View
			} elseif ( bbp_is_single_view() ) {
				$pre_current_text = bbp_get_view_title();

			// Single Forum
			} elseif ( bbp_is_single_forum() ) {
				$pre_current_text = bbp_get_forum_title();

			// Single Topic
			} elseif ( bbp_is_single_topic() ) {
				$pre_current_text = bbp_get_topic_title();

			// Single Topic
			} elseif ( bbp_is_single_reply() ) {
				$pre_current_text = bbp_get_reply_title();

			// Topic Tag (or theme compat topic tag)
			} elseif ( bbp_is_topic_tag() || ( get_query_var( 'bbp_topic_tag' ) && !bbp_is_topic_tag_edit() ) ) {

				// Always include the tag name
				$tag_data[] = bbp_get_topic_tag_name();

				// If capable, include a link to edit the tag
				if ( current_user_can( 'manage_topic_tags' ) ) {
					$tag_data[] = '<a href="' . esc_url( bbp_get_topic_tag_edit_link() ) . '" class="bbp-edit-topic-tag-link">' . esc_html__( '(Edit)', 'wpdance' ) . '</a>';
				}

				// Implode the results of the tag data
				$pre_current_text = sprintf( __( 'Topic Tag: %s', 'wpdance' ), implode( ' ', $tag_data ) );

			// Edit Topic Tag
			} elseif ( bbp_is_topic_tag_edit() ) {
				$pre_current_text = __( 'Edit', 'wpdance' );

			// Single
			} else {
				$pre_current_text = get_the_title();
			}

			/** Parse Args ********************************************************/

			// Parse args
			$r = bbp_parse_args( $args, array(

				// HTML
				'before'          => '<div class="bbp-breadcrumb" id="crumbs">',
				'after'           => '</div>',

				// Separator
				'sep'             => is_rtl() ? __( '&laquo;', 'wpdance' ) : __( '&raquo;', 'wpdance' ),
				'pad_sep'         => 1,
				'sep_before'      => '<span class="bbp-breadcrumb-sep brn_arrow">',
				'sep_after'       => '</span>',

				// Crumbs
				'crumb_before'    => '',
				'crumb_after'     => '',

				// Home
				'include_home'    => $pre_include_home,
				'home_text'       => $pre_front_text,

				// Forum root
				'include_root'    => $pre_include_root,
				'root_text'       => $pre_root_text,

				// Current
				'include_current' => $pre_include_current,
				'current_text'    => $pre_current_text,
				'current_before'  => '<span class="bbp-breadcrumb-current">',
				'current_after'   => '</span>',
			), 'get_breadcrumb' );

			/** Ancestors *********************************************************/

			// Get post ancestors
			if ( is_singular() || bbp_is_forum_edit() || bbp_is_topic_edit() || bbp_is_reply_edit() ) {
				$ancestors = array_reverse( (array) get_post_ancestors( get_the_ID() ) );
			}

			// Do we want to include a link to home?
			if ( !empty( $r['include_home'] ) || empty( $r['home_text'] ) ) {
				$crumbs[] = '<a href="' . trailingslashit( home_url() ) . '" class="bbp-breadcrumb-home">' . $r['home_text'] . '</a>';
			}

			// Do we want to include a link to the forum root?
			if ( !empty( $r['include_root'] ) || empty( $r['root_text'] ) ) {

				// Page exists at root slug path, so use its permalink
				$page = bbp_get_page_by_path( bbp_get_root_slug() );
				if ( !empty( $page ) ) {
					$root_url = get_permalink( $page->ID );

				// Use the root slug
				} else {
					$root_url = get_post_type_archive_link( bbp_get_forum_post_type() );
				}

				// Add the breadcrumb
				$crumbs[] = '<a href="' . esc_url( $root_url ) . '" class="bbp-breadcrumb-root">' . $r['root_text'] . '</a>';
			}

			// Ancestors exist
			if ( !empty( $ancestors ) ) {

				// Loop through parents
				foreach ( (array) $ancestors as $parent_id ) {

					// Parents
					$parent = get_post( $parent_id );

					// Skip parent if empty or error
					if ( empty( $parent ) || is_wp_error( $parent ) )
						continue;

					// Switch through post_type to ensure correct filters are applied
					switch ( $parent->post_type ) {

						// Forum
						case bbp_get_forum_post_type() :
							$crumbs[] = '<a href="' . esc_url( bbp_get_forum_permalink( $parent->ID ) ) . '" class="bbp-breadcrumb-forum">' . bbp_get_forum_title( $parent->ID ) . '</a>';
							break;

						// Topic
						case bbp_get_topic_post_type() :
							$crumbs[] = '<a href="' . esc_url( bbp_get_topic_permalink( $parent->ID ) ) . '" class="bbp-breadcrumb-topic">' . bbp_get_topic_title( $parent->ID ) . '</a>';
							break;

						// Reply (Note: not in most themes)
						case bbp_get_reply_post_type() :
							$crumbs[] = '<a href="' . esc_url( bbp_get_reply_permalink( $parent->ID ) ) . '" class="bbp-breadcrumb-reply">' . bbp_get_reply_title( $parent->ID ) . '</a>';
							break;

						// WordPress Post/Page/Other
						default :
							$crumbs[] = '<a href="' . esc_url( get_permalink( $parent->ID ) ) . '" class="bbp-breadcrumb-item">' . get_the_title( $parent->ID ) . '</a>';
							break;
					}
				}

			// Edit topic tag
			} elseif ( bbp_is_topic_tag_edit() ) {
				$crumbs[] = '<a href="' . esc_url( get_term_link( bbp_get_topic_tag_id(), bbp_get_topic_tag_tax_id() ) ) . '" class="bbp-breadcrumb-topic-tag">' . sprintf( __( 'Topic Tag: %s', 'wpdance' ), bbp_get_topic_tag_name() ) . '</a>';

			// Search
			} elseif ( bbp_is_search() && bbp_get_search_terms() ) {
				$crumbs[] = '<a href="' . esc_url( bbp_get_search_url() ) . '" class="bbp-breadcrumb-search">' . esc_html__( 'Search', 'wpdance' ) . '</a>';
			}

			/** Current ***********************************************************/

			// Add current page to breadcrumb
			if ( !empty( $r['include_current'] ) || empty( $r['current_text'] ) ) {
				$crumbs[] = $r['current_before'] . $r['current_text'] . $r['current_after'];
			}

			/** Separator *********************************************************/

			// Wrap the separator in before/after before padding and filter
			if ( ! empty( $r['sep'] ) ) {
				$sep = $r['sep_before'] . $r['sep'] . $r['sep_after'];
			}

			// Pad the separator
			if ( !empty( $r['pad_sep'] ) ) {
				if ( function_exists( 'mb_strlen' ) ) {
					$sep = str_pad( $sep, mb_strlen( $sep ) + ( (int) $r['pad_sep'] * 2 ), ' ', STR_PAD_BOTH );
				} else {
					$sep = str_pad( $sep, strlen( $sep ) + ( (int) $r['pad_sep'] * 2 ), ' ', STR_PAD_BOTH );
				}
			}

			/** Finish Up *********************************************************/

			// Filter the separator and breadcrumb
			$sep    = apply_filters( 'bbp_breadcrumb_separator', $sep    );
			$crumbs = apply_filters( 'bbp_breadcrumbs',          $crumbs );

			// Build the trail
			$trail  = !empty( $crumbs ) ? ( $r['before'] . $r['crumb_before'] . implode( $sep . $r['crumb_after'] . $r['crumb_before'] , $crumbs ) . $r['crumb_after'] . $r['after'] ) : '';

			echo apply_filters( 'bbp_get_breadcrumb', $trail, $crumbs, $r );
			 
			wp_reset_query();
		}
		
		if(!function_exists("wd_bbpress_show_breadcrumbs")){
			function wd_bbpress_show_breadcrumbs( $args = array() ){
				?>
				<div class="top-page <?php wd_page_layout_class(); ?>">
					<div class="container">
						<?php wd_bbpress_breadcrumbs( $args ); ?>
					</div>
				</div>
				<?php
			}
		}
	}

?>