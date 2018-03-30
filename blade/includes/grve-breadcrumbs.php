<?php
/*
*	Simple Breadcrumb Implementation
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/


if ( !function_exists( 'blade_grve_print_breadcrumbs' ) ) {
	function blade_grve_print_breadcrumbs( $args = array() ) {
		//Yoast Breadcrumbs
		$yoast_options = get_option( 'wpseo_internallinks' );
		if ( function_exists( 'yoast_breadcrumb' ) && true === $yoast_options[ 'breadcrumbs-enable' ] ) {
			yoast_breadcrumb( '<nav>', '</nav>' );
		} elseif ( function_exists( 'bcn_display' ) ) {
?>
			<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
				<?php bcn_display(); ?>
			</div>
<?php
		} else{
			$breadcrumb = new Blade_GRVE_Breadcrumb( $args );
			return $breadcrumb->trail();
		}
	}
}

class Blade_GRVE_Breadcrumb {

	public $items = array();
	public $args = array();
	public $post_taxonomy = array();

	public function __toString() {
		return $this->trail();
	}

	public function __construct( $args = array() ) {

		$defaults = array(
			'container'       => 'nav',
			'before'          => '',
			'after'           => '',
			'show_on_front'   => true,
			'home_label'       => esc_html__( 'Home', 'blade' ),
			'show_title'      => true,
			'post_taxonomy'   => array(
				'post' => 'category',
			),
		);

		// Filter hook for breadcrumb args
		$args = apply_filters( 'blade_grve_breadcrumb_args', $args );
		$this->args = wp_parse_args( $args, $defaults );

		//Assign Available Taxonomies
		$this->post_taxonomy = $this->args['post_taxonomy'];
		//Add Items
		$this->add_items();
	}

	public function trail() {

		$breadcrumb    = '';
		$item_count    = count( $this->items );
		$item_position = 0;


		if ( 0 < $item_count ) {

			$breadcrumb .= '<ul class="grve-breadcrumb-items" itemscope itemtype="http://schema.org/BreadcrumbList">';

			foreach ( $this->items as $item ) {

				++$item_position;

				// Check if the item is linked.
				preg_match( '/(<a.*?>)(.*?)(<\/a>)/i', $item, $matches );

				$item = !empty( $matches ) ? sprintf( '%s<span itemprop="name">%s</span>%s', $matches[1], $matches[2], $matches[3] ) : sprintf( '<span itemprop="name">%s</span>', $item );

				$item_class = 'grve-breadcrumb-item grve-small-text';
				if ( 1 === $item_position && 1 < $item_count ) {
					$item_class .= ' grve-breadcrumb-first';
				} elseif ( $item_count === $item_position ) {
					$item_class .= ' grve-breadcrumb-last';
				}

				$attributes = 'itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="' . $item_class . '"';
				$meta = sprintf( '<meta itemprop="position" content="%s" />', absint( $item_position ) );

				$breadcrumb .= sprintf( '<li %s>%s%s</li>', $attributes, $item, $meta );
			}

			$breadcrumb .= '</ul>';

			echo sprintf(
				'<%1$s id="grve-breadcrumbs" class="grve-list-divider">%2$s%3$s%4$s</%1$s>',
				tag_escape( $this->args['container'] ),
				$this->args['before'],
				$breadcrumb,
				$this->args['after']
			);
		}

	}

	protected function add_items() {

		global $wp_rewrite;

		//Home Label
		$home_label = $this->args['home_label'];

		if ( is_front_page() ) {
			//Front Page
			if ( true === $this->args['show_on_front'] && $home_label ) {
				$this->items[] = $home_label;
			}
		} else {

			if ( $home_label ) {
				$this->items[] = sprintf( '<a href="%s"%s>%s</a>', esc_url( home_url( '/' ) ), ' rel="home"', $home_label );
			}

			if ( is_home() ) {
				//Home Page
				$post_id = get_queried_object_id();
				$post    = get_post( $post_id );
				if ( 0 < $post->post_parent ) {
					$this->add_post_parents( $post->post_parent );
				}
				$title = get_the_title( $post_id );

				// Add the posts page item.
				if ( is_paged() ) {
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $post_id ) ), $title );
				} elseif ( $title && true === $this->args['show_title'] ) {
					$this->items[] = $title;
				}
			} elseif ( is_singular() ) {
				//Single Post
				$post    = get_queried_object();
				$post_id = get_queried_object_id();

				if ( 0 < $post->post_parent ) {
					$this->add_post_parents( $post->post_parent );
				} else {
					$this->add_post_hierarchy( $post_id );
				}

				if ( !empty( $this->post_taxonomy[ $post->post_type ] ) ) {
					$this->add_post_terms( $post_id, $this->post_taxonomy[ $post->post_type ] );
				}

				if ( $post_title = single_post_title( '', false ) ) {

					if ( 1 < get_query_var( 'page' ) || is_paged() ) {
						$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $post_id ) ), $post_title );
					} elseif ( true === $this->args['show_title'] ) {
						$this->items[] = $post_title;
					}
				}
			} elseif ( is_archive() ) {
				// Archive Page
				if ( is_post_type_archive() ) {
					$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

					if ( false !== $post_type_object->rewrite ) {
						if ( $post_type_object->rewrite['with_front'] ) {
							$this->add_rewrite_front_items();
						}
						if ( !empty( $post_type_object->rewrite['slug'] ) ) {
							$this->add_path_parents( $post_type_object->rewrite['slug'] );
						}
					}
					if ( is_paged() ) {
						$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $post_type_object->name ) ), post_type_archive_title( '', false ) );
					} elseif ( true === $this->args['show_title'] ) {
						$this->items[] = post_type_archive_title( '', false );
					}
				} elseif ( is_category() || is_tag() || is_tax() ) {
					$this->add_term_archive_items();
				} elseif ( is_author() ) {
					$this->add_rewrite_front_items();
					$user_id = get_query_var( 'author' );

					if ( is_paged() ) {
						$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_author_posts_url( $user_id ) ), get_the_author_meta( 'display_name', $user_id ) );
					} elseif ( true === $this->args['show_title'] ) {
						$this->items[] = get_the_author_meta( 'display_name', $user_id );
					}
				} elseif ( is_day() ) {
					$this->add_rewrite_front_items();
					$year  = sprintf( '%s',  get_the_time( esc_html__( 'Y',  'blade' ) ) );
					$month = sprintf( '%s', get_the_time( esc_html__( 'F', 'blade' ) ) );
					$day   = sprintf( '%s',   get_the_time( esc_html__( 'j', 'blade' ) ) );

					// Add the year and month items.
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $year );
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), $month );

					// Add the day item.
					if ( is_paged() ) {
						$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_day_link( get_the_time( 'Y' ) ), get_the_time( 'm' ), get_the_time( 'd' ) ), $day );
					} elseif ( true === $this->args['show_title'] ) {
						$this->items[] = $day;
					}
				} elseif ( is_month() ) {
					$this->add_rewrite_front_items();
					$year  = sprintf( '%s',  get_the_time( esc_html__( 'Y', 'blade' ) ) );
					$month = sprintf( '%s', get_the_time( esc_html__( 'F', 'blade' ) ) );
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $year );
					if ( is_paged() ) {
						$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), $month );
					} elseif ( true === $this->args['show_title'] ) {
						$this->items[] = $month;
					}
				} elseif ( is_year() ) {
					$this->add_rewrite_front_items();
					$year  = sprintf( '%s',  get_the_time( esc_html__( 'Y',  'blade' ) ) );
					if ( is_paged() ) {
						$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $year );
					} elseif ( true === $this->args['show_title'] ) {
						$this->items[] = $year;
					}
				} else {
					//Default Archives
					if ( is_date() || is_time() ) {
						$this->add_rewrite_front_items();
					}
					if ( true === $this->args['show_title'] ) {
						$this->items[] = esc_html__( 'Archives', 'blade' );
					}
				}
			} elseif ( is_search() ) {
				//Search Page
				if ( is_paged() ) {
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_search_link() ), sprintf( esc_html__( 'Search Results for : %s', 'blade' ), get_search_query() ) );
				} elseif ( true === $this->args['show_title'] ) {
					$this->items[] = sprintf( esc_html__( 'Search Results for : %s', 'blade' ), get_search_query() );
				}
			} elseif ( is_404() ) {
				//404 Page
				if ( true === $this->args['show_title'] ) {
					$this->items[] = esc_html__( '404 Not Found', 'blade' );
				}
			}
		}

		// Add paged items.
		if ( is_singular() && 1 < get_query_var( 'page' ) && true === $this->args['show_title'] ) {
			$this->items[] = sprintf( esc_html__( 'Page %s', 'blade' ), number_format_i18n( absint( get_query_var( 'page' ) ) ) );
		} elseif ( is_paged() && true === $this->args['show_title'] ) {
			$this->items[] = sprintf( esc_html__( 'Page %s', 'blade' ), number_format_i18n( absint( get_query_var( 'paged' ) ) ) );
		}

		//Filter hook for items
		$this->items = array_unique( apply_filters( 'blade_grve_breadcrumb_items', $this->items, $this->args ) );
	}

	protected function add_rewrite_front_items() {
		global $wp_rewrite;

		if ( $wp_rewrite->front )
			$this->add_path_parents( $wp_rewrite->front );
	}

	protected function add_term_archive_items() {
		global $wp_rewrite;

		// Get some taxonomy and term variables.
		$term           = get_queried_object();
		$taxonomy       = get_taxonomy( $term->taxonomy );
		$done_post_type = false;

		// If there are rewrite rules for the taxonomy.
		if ( false !== $taxonomy->rewrite ) {

			// If 'with_front' is true, dd $wp_rewrite->front to the trail.
			if ( $taxonomy->rewrite['with_front'] && $wp_rewrite->front )
				$this->add_rewrite_front_items();

			// Get parent pages by path if they exist.
			$this->add_path_parents( $taxonomy->rewrite['slug'] );

			// Add post type archive if its 'has_archive' matches the taxonomy rewrite 'slug'.
			if ( $taxonomy->rewrite['slug'] ) {

				$slug = trim( $taxonomy->rewrite['slug'], '/' );

				// Deals with the situation if the slug has a '/' between multiple
				// strings. For example, "movies/genres" where "movies" is the post
				// type archive.
				$matches = explode( '/', $slug );

				// If matches are found for the path.
				if ( isset( $matches ) ) {

					// Reverse the array of matches to search for posts in the proper order.
					$matches = array_reverse( $matches );

					// Loop through each of the path matches.
					foreach ( $matches as $match ) {

						// If a match is found.
						$slug = $match;

						// Get public post types that match the rewrite slug.
						$post_types = $this->get_post_types_by_slug( $match );

						if ( !empty( $post_types ) ) {

							$post_type_object = $post_types[0];

							// Add support for a non-standard label of 'archive_title' (special use case).
							$label = !empty( $post_type_object->labels->archive_title ) ? $post_type_object->labels->archive_title : $post_type_object->labels->name;

							// Core filter hook.
							$label = apply_filters( 'post_type_archive_title', $label, $post_type_object->name );

							// Add the post type archive link to the trail.
							$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $post_type_object->name ) ), $label );

							$done_post_type = true;

							// Break out of the loop.
							break;
						}
					}
				}
			}
		}

		// If there's a single post type for the taxonomy, use it.
		if ( false === $done_post_type && 1 === count( $taxonomy->object_type ) && post_type_exists( $taxonomy->object_type[0] ) ) {

			// If the post type is 'post'.
			if ( 'post' === $taxonomy->object_type[0] ) {
				$post_id = get_option( 'page_for_posts' );

				if ( 'posts' !== get_option( 'show_on_front' ) && 0 < $post_id )
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $post_id ) ), get_the_title( $post_id ) );

			// If the post type is not 'post'.
			} else {
				$post_type_object = get_post_type_object( $taxonomy->object_type[0] );

				$label = !empty( $post_type_object->labels->archive_title ) ? $post_type_object->labels->archive_title : $post_type_object->labels->name;

				// Core filter hook.
				$label = apply_filters( 'post_type_archive_title', $label, $post_type_object->name );

				$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $post_type_object->name ) ), $label );
			}
		}

		// If the taxonomy is hierarchical, list its parent terms.
		if ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent )
			$this->add_term_parents( $term->parent, $term->taxonomy );

		// Add the term name to the trail end.
		if ( is_paged() )
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $term, $term->taxonomy ) ), single_term_title( '', false ) );

		elseif ( true === $this->args['show_title'] )
			$this->items[] = single_term_title( '', false );
	}

	protected function add_post_parents( $post_id ) {
		$parents = array();

		while ( $post_id ) {

			// Get the post by ID.
			$post = get_post( $post_id );

			// If we hit a page that's set as the front page, bail.
			if ( 'page' == $post->post_type && 'page' == get_option( 'show_on_front' ) && $post_id == get_option( 'page_on_front' ) )
				break;

			// Add the formatted post link to the array of parents.
			$parents[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $post_id ) ), get_the_title( $post_id ) );

			// If there's no longer a post parent, break out of the loop.
			if ( 0 >= $post->post_parent )
				break;

			// Change the post ID to the parent post to continue looping.
			$post_id = $post->post_parent;
		}

		// Get the post hierarchy based off the final parent post.
		$this->add_post_hierarchy( $post_id );

		// Display terms for specific post type taxonomy if requested.
		if ( !empty( $this->post_taxonomy[ $post->post_type ] ) )
			$this->add_post_terms( $post_id, $this->post_taxonomy[ $post->post_type ] );

		// Merge the parent items into the items array.
		$this->items = array_merge( $this->items, array_reverse( $parents ) );
	}

	protected function add_post_hierarchy( $post_id ) {

		// Get the post type.
		$post_type        = get_post_type( $post_id );
		$post_type_object = get_post_type_object( $post_type );

		// If this is the 'post' post type, get the rewrite front items.
		if ( 'post' === $post_type ) {
			// Add $wp_rewrite->front to the trail.
			$this->add_rewrite_front_items();
		}

		// If the post type has rewrite rules.
		elseif ( false !== $post_type_object->rewrite ) {

			// If 'with_front' is true, add $wp_rewrite->front to the trail.
			if ( $post_type_object->rewrite['with_front'] )
				$this->add_rewrite_front_items();

			// If there's a path, check for parents.
			if ( !empty( $post_type_object->rewrite['slug'] ) )
				$this->add_path_parents( $post_type_object->rewrite['slug'] );
		}

		// If there's an archive page, add it to the trail.
		if ( $post_type_object->has_archive ) {

			// Add support for a non-standard label of 'archive_title' (special use case).
			$label = !empty( $post_type_object->labels->archive_title ) ? $post_type_object->labels->archive_title : $post_type_object->labels->name;

			// Core filter hook.
			$label = apply_filters( 'post_type_archive_title', $label, $post_type_object->name );

			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $post_type ) ), $label );
		}
	}

	protected function get_post_types_by_slug( $slug ) {

		$return = array();

		$post_types = get_post_types( array(), 'objects' );

		foreach ( $post_types as $type ) {

			if ( $slug === $type->has_archive || ( true === $type->has_archive && $slug === $type->rewrite['slug'] ) )
				$return[] = $type;
		}

		return $return;
	}

	protected function add_post_terms( $post_id, $taxonomy ) {

		// Get the post type.
		$post_type = get_post_type( $post_id );

		// Get the post categories.
		$terms = get_the_terms( $post_id, $taxonomy );

		// Check that categories were returned.
		if ( $terms && ! is_wp_error( $terms ) ) {

			// Sort the terms by ID and get the first category.
			usort( $terms, '_usort_terms_by_ID' );
			$term = get_term( $terms[0], $taxonomy );

			// If the category has a parent, add the hierarchy to the trail.
			if ( 0 < $term->parent )
				$this->add_term_parents( $term->parent, $taxonomy );

			// Add the category archive link to the trail.
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $term, $taxonomy ) ), $term->name );
		}
	}

	function add_path_parents( $path ) {

		// Trim '/' off $path in case we just got a simple '/' instead of a real path.
		$path = trim( $path, '/' );

		// If there's no path, return.
		if ( empty( $path ) )
			return;

		// Get parent post by the path.
		$post = get_page_by_path( $path );

		if ( !empty( $post ) ) {
			$this->add_post_parents( $post->ID );
		}

		elseif ( is_null( $post ) ) {

			// Separate post names into separate paths by '/'.
			$path = trim( $path, '/' );
			preg_match_all( "/\/.*?\z/", $path, $matches );

			// If matches are found for the path.
			if ( isset( $matches ) ) {

				// Reverse the array of matches to search for posts in the proper order.
				$matches = array_reverse( $matches );

				// Loop through each of the path matches.
				foreach ( $matches as $match ) {

					// If a match is found.
					if ( isset( $match[0] ) ) {

						// Get the parent post by the given path.
						$path = str_replace( $match[0], '', $path );
						$post = get_page_by_path( trim( $path, '/' ) );

						// If a parent post is found, set the $post_id and break out of the loop.
						if ( !empty( $post ) && 0 < $post->ID ) {
							$this->add_post_parents( $post->ID );
							break;
						}
					}
				}
			}
		}
	}

	function add_term_parents( $term_id, $taxonomy ) {

		// Set up some default arrays.
		$parents = array();

		// While there is a parent ID, add the parent term link to the $parents array.
		while ( $term_id ) {

			// Get the parent term.
			$term = get_term( $term_id, $taxonomy );

			// Add the formatted term link to the array of parent terms.
			$parents[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $term, $taxonomy ) ), $term->name );

			// Set the parent term's parent as the parent ID.
			$term_id = $term->parent;
		}

		// If we have parent terms, reverse the array to put them in the proper order for the trail.
		if ( !empty( $parents ) )
			$this->items = array_merge( $this->items, $parents );
	}

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
