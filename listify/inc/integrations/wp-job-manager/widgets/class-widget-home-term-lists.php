<?php
class Listify_Widget_Term_Lists extends Listify_Widget {

	public function __construct() {
		$this->widget_description = __( 'Display lists of listings associated with terms of a given taxonomy.', 'listify' );
		$this->widget_id          = 'listify_widget_taxonomy_term_lists';
		$this->widget_name        = __( 'Listify - Page: Listings by Category', 'listify' );

		$this->settings = array(
			'title' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title:', 'listify' )
			),
			'description' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Description:', 'listify' )
			),
            'terms' => array(
                'label' => __( 'Categories:', 'listify' ),
                'type' => 'multicheck',
                'std'  => '',
                'options' => $this->get_terms_simple( 'job_listing_category' )
            ),
			'limit' => array(
				'type'  => 'number',
				'std'   => 5,
				'min'   => 1,
				'max'   => 30,
				'step'  => 1,
				'label' => __( 'Listings per category', 'listify' )
			),
			'orderby' => array(
				'label' => __( 'Order By:', 'listify' ),
				'type' => 'select',
				'std'  => 'date',
				'options' => array(
					'date' => __( 'Date', 'listify' ),
					'featured' => __( 'Featured', 'listify' ),
					'title' => __( 'Title', 'listify' ),
					'ID' => __( 'ID', 'listify' )
				)
			),
			'featured' => array(
				'type' => 'checkbox',
				'std'  => 0,
				'label' => __( 'Use only featured listings', 'listify' )
			)
		);

		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) )
			return;

		$this->instance = $instance;

		extract( $args );

		$title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
		$description = isset( $instance[ 'description' ] ) ? esc_attr( $instance[ 'description' ] ) : false;

		$after_title = '<h2 class="home-widget-description">' . $description . '</h2>' . $after_title;

		$limit = isset( $instance[ 'limit' ] ) ? absint( $instance[ 'limit' ] ) : 3;
		$featured = isset( $instance[ 'featured' ] ) && 1 == $instance[ 'featured' ] ? true : null;
		$orderby = isset( $instance[ 'orderby' ] ) ? $instance[ 'orderby' ] : 'date';

		$terms = isset( $instance[ 'terms' ] ) ? maybe_unserialize( $instance[ 'terms' ] ) : false;

		$args = apply_filters( 'listify_mega_menu_list', array( 
			'include' => $terms
		) );

		if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
			$args[ 'lang' ] = apply_filters( 'wpml_current_language', NULL );
		} elseif ( function_exists( 'pll_current_language' ) ) {
			$args[ 'lang' ] = pll_current_language();
		}

		$terms = listify_get_terms( $args );

		if ( ! $terms ) {
			return;
		}

		$listings_by_term = $this->get_listings_by_term( $terms, $limit, $featured, $orderby );

		global $listify_job_manager;

		ob_start();

		echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title;
		?>

		<div class="listing-by-term-wrapper row" data-columns>

		<?php foreach ( $listings_by_term as $data ) : if ( ! $data[ 'listings' ]->have_posts() ) continue; ?>

			<div id="term-<?php echo $data[ 'term' ]->term_id; ?>" class="listings-by-term">
				<div class="listing-by-term-inner">
					<h2 class="listing-by-term-title"><a href="<?php echo get_term_link( $data[ 'term' ], 'job_listing_category' ); ?>"><?php echo $data[ 'term' ]->name; ?></a></h2>

					<ul>
					<?php while ( $data[ 'listings' ]->have_posts() ) : $data[ 'listings' ]->the_post(); ?>

						<li>
							<a href="<?php the_permalink(); ?>" class="job_listing-clickbox"></a>

							<div class="listings-by-term-preview">
								<?php the_post_thumbnail(); ?>
							</div>

							<div class="listings-by-term-content">
								<?php the_title(); ?>
								<?php do_action( 'listify_listings_by_term_after' ); ?>
							</div>
						</li>

					<?php endwhile; ?>
					</ul>

					<div class="listings-by-term-more">
						<a href="<?php echo get_term_link( $data[ 'term' ], 'job_listing_category' ); ?>"><?php _e( 'More', 'listify' ); ?></a>
					</div>
				</div>
			</div>

		<?php endforeach; ?>

		</div>

		<?php
		echo $after_widget;

		$content = ob_get_clean();

		echo apply_filters( $this->widget_id, $content );

		$this->cache_widget( $args, $content );
	}

	public function get_terms_simple() {
		$_terms = array();

		$terms = listify_get_terms();

		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return array();
		}

		foreach ( $terms as $term ) {
			$_terms[ $term->term_id ] = $term->name;
		}

		return $_terms;
	}

	public function get_listings_by_term( $terms, $limit, $featured, $orderby ) {
		if ( empty( $terms ) ) {
			return array(-1);
		}

		foreach ( $terms as $term ) {
			$objects = get_objects_in_term( $term->term_id, 'job_listing_category', array( 'orderby' => $orderby ) );

			if ( empty( $objects ) ) {
				$objects = array(-1);
			}

			$_output[] = array(
				'term' => $term,
				'listings' => get_job_listings( array(
					'posts_per_page' => $limit,
					'featured' => $featured,
					'orderby' => $orderby,
					'no_found_rows' => true,
					'post__in' => $objects 
				) )
			);

		}

		return $_output;
	}

}
