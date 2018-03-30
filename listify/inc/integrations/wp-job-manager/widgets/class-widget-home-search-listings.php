<?php
/**
 * Home: Search Listings
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Search_Listings extends Listify_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		global $listify_facetwp;

		$this->widget_description = __( 'Display a search form to search listings', 'listify' );
		$this->widget_id          = 'listify_widget_search_listings';
		$this->widget_name        = __( 'Listify - Page: Search Listings', 'listify' );
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title:', 'listify' )
			),
			'description' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Description:', 'listify' )
			)
		);

		if ( listify_has_integration( 'facetwp' ) ) {
			$this->settings[ 'facets' ] = array(
				'type'  => 'text',
				'std'   => listify_theme_mod( 'listing-archive-facetwp-defaults', array( 'keyword', 'location', 'category' ) ),
				'label' => __( 'Facets:', 'listify' )
			);
		}

		parent::__construct();

		add_filter( 'facetwp_load_assets', '__return_true' );
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

		extract( $args );

		$title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
		$description = isset( $instance[ 'description' ] ) ? $instance[ 'description' ] : false;

		$after_title = '</h1><h2 class="home-widget-description">' . $description . '</h2></div>';

		ob_start();

		echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title;

		if ( listify_has_integration( 'facetwp' ) ) {
			global $listify_facetwp;

			$facets = isset( $instance[ 'facets' ] ) ? array_map( 'trim', explode( ',', $instance[ 'facets' ] ) ) : listify_theme_mod( 'listing-archive-facetwp-defaults', array( 'keyword', 'location', 'category' ) );
			$_facets = $listify_facetwp->get_homepage_facets( $facets );
		?>
			<div class="job_search_form">
				<?php echo $listify_facetwp->template->output_facet_html( $_facets ); ?>

				<div class="facetwp-submit">
					<input type="submit" value="<?php _e( 'Search', 'listify' ); ?>" onclick="fwp_redirect()" />
		  		</div>

				<div style="display: none;">
					<?php echo do_shortcode( '[facetwp template="listings"]' ); ?>
				</div>

			</div>

			<script>
			function fwp_redirect() {
				FWP.parse_facets();
				FWP.set_hash();

				var query_string = FWP.build_query_string();
				if ('' != query_string) {
					query_string = '?' + query_string;
				}
				var url = query_string;
				window.location.href = '<?php echo get_post_type_archive_link( 'job_listing' ); ?>' + url;
			}
			</script>
		<?php
		} else {
            locate_template( array( 'job-filters-flat.php', 'job-filters.php'), true, false );
		}

		echo $after_widget;

		$content = ob_get_clean();

		echo apply_filters( $this->widget_id, $content );

		$this->cache_widget( $args, $content );
	}
}
