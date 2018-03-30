<?php
/**
 * Mostly from https://github.com/Yoast/wordpress-seo/blob/master/frontend/class-breadcrumbs.php
 */

class Listify_Taxonomy_Breadcrumbs {

	public function __construct( $args = array() ) {
		global $post;

		$this->crumbs = array();

		$defaults = array(
			'post_id' => $post->ID,
			'taxonomy' => '',
			'before' => '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">',
			'after' => '</span>',
			'sep' => ', '
		);
		$this->args = wp_parse_args( $args, $defaults );

		$this->build();
	}

	public function build() {
		$terms = wp_get_object_terms( $this->args[ 'post_id' ], $this->args[ 'taxonomy' ] );

		if ( is_array( $terms ) && $terms !== array() ) {
			$deepest_term = $this->find_deepest_term( $terms );

			if ( is_taxonomy_hierarchical( $this->args[ 'taxonomy' ] ) && $deepest_term->parent != 0 ) {
				$parent_terms = $this->get_term_parents( $deepest_term );

				foreach ( $parent_terms as $parent_term ) {
					$this->add_term_crumb( $parent_term );
				}
				
				$this->add_term_crumb( $deepest_term );
			} else {
				foreach ( $terms as $term ) {
					$this->add_term_crumb( $term );
				}
			}
		}
	}

	public function output() {
		$term_links = array();
		
		if ( 0 == $this->deepest_term->parent ) {
			echo get_the_term_list( $this->args[ 'post_id' ], $this->args[ 'taxonomy' ], $this->args[ 'before' ], ', ',
			$this->args[ 'after' ] );
		} else {
			foreach ( $this->crumbs as $term ) {
				$link = get_term_link( $term, $this->args[ 'taxonomy' ] );

				if ( is_wp_error( $link ) ) {
					return $term_links;
				}

				$term_links[] = $this->args[ 'before' ] . '<a href="' . esc_url( $link ) . '" rel="tag" itemprop="url"><span itemprop="title">' . $term->name . '</span></a>' . $this->args[ 'after' ];
			}

			echo join( $this->args[ 'sep' ], $term_links );
		}
	}

	/**
	 * Add a term based crumb to the crumbs property
	 */
	private function add_term_crumb( $term ) {
		$this->crumbs[] = $term;
	}

	/**
	 * Get a term's parents.
	 *
	 * @param	object	$term	Term to get the parents for
	 * @return	array
	 */
	private function get_term_parents( $term ) {
		$tax     = $term->taxonomy;
		$parents = array();

		while ( $term->parent != 0 ) {
			$term      = get_term( $term->parent, $tax );
			$parents[] = $term;
		}

		return array_reverse( $parents );
	}

	/**
	 * Find the deepest term in an array of term objects
	 *
	 * @param  array	$terms
	 *
	 * @return object
	 */
	private function find_deepest_term( $terms ) {
		/* Let's find the deepest term in this array, by looping through and then
		   unsetting every term that is used as a parent by another one in the array. */
		$terms_by_id = array();

		foreach ( $terms as $term ) {
			$terms_by_id[ $term->term_id ] = $term;
		}

		foreach ( $terms as $term ) {
			unset( $terms_by_id[ $term->parent ] );
		}

		/* As we could still have two subcategories, from different parent categories,
		   let's pick the one with the lowest ordered ancestor. */
		$parents_count = 0;
		$term_order    = 9999; //because ASC

		reset( $terms_by_id );

		$this->deepest_term = current( $terms_by_id );

		foreach ( $terms_by_id as $term ) {
			$parents = $this->get_term_parents( $term );

			if ( count( $parents ) >= $parents_count ) {
				$parents_count = count( $parents );

				//if higher count
				if ( count( $parents ) > $parents_count ) {
					//reset order
					$term_order = 9999;
				}

				$parent_order = 9999; //set default order

				foreach ( $parents as $parent ) {
					if ( $parent->parent == 0 && isset( $parent->term_order ) ) {
						$parent_order = $parent->term_order;
					}
				}

				//check if parent has lowest order
				if ( $parent_order < $term_order ) {
					$term_order = $parent_order;
					$this->deepest_term = $term;
				}
			}
		}

		return $this->deepest_term;
	}

	/**
	 * Retrieve the hierachical ancestors for the current 'post'
	 *
	 * @return array
	 */
	private function get_post_ancestors() {
		$ancestors = array();

		if ( isset( $this->post->ancestors ) ) {
			if ( is_array( $this->post->ancestors ) ) {
				$ancestors = array_values( $this->post->ancestors );
			}
			else {
				$ancestors = array( $this->post->ancestors );
			}
		}
		elseif ( isset( $this->post->post_parent ) ) {
			$ancestors = array( $this->post->post_parent );
		}

		// Reverse the order so it's oldest to newest
		$ancestors = array_reverse( $ancestors );

		return $ancestors;
	}
}
