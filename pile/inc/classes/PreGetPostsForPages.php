<?php
/**
 * Class PreGetPostsForPages
 *
 * This class is a helper class for creating custom loops in pages with custom page templates.
 * By using post injection, it is able to keep full post integrity, so  $wp_the_query->post, $wp_query->post, $posts and $post stays constant throughout the template, they all only holds the current page object as is the case with true pages.
 * This way, functions like breadcrumbs still think that the current page is a true page and not some kind of archive
 *
 * started from this, with minor modifications: http://stackoverflow.com/a/34922062
 */
class PreGetPostsForPages {
	/**
	 * @var string $page_slug
	 * @access protected
	 * @since 1.0.0
	 */
	protected $page_slug;

	/**
	 * @var string $templatePart
	 * @access protected
	 * @since 1.0.0
	 */
	protected $templatePart;

	/**
	 * @var bool $postFormatSupport
	 * @access protected
	 * @since 1.0.0
	 */
	protected $postFormatSupport;

	/**
	 * @var array $args
	 * @access protected
	 * @since 1.0.0
	 */
	protected $args;

	/**
	 * @var array $mergedArgs
	 * @access protected
	 * @since 1.0.0
	 */
	protected $mergedArgs = array();

	/**
	 * @var NULL|stdClass $injectorQuery
	 * @access protected
	 * @since 1.0.0
	 */
	protected $injectorQuery = NULL;

	/**
	 * @var string $validatedPageSlug
	 * @access protected
	 * @since 1.0.0
	 */
	protected $validatedPageSlug = '';

	/**
	 * Constructor method
	 *
	 * @param string $page_slug The slug of the page we would like to target
	 * @param string $templatePart The template part which should be used to display posts
	 * @param bool $postFormatSupport Should get_template_part support post format specific template parts
	 * @param array $args An array of valid arguments compatible with WP_Query
	 *
	 * @since 1.0.0
	 */
	public function __construct(
		$page_slug             = NULL,
		$templatePart       = NULL,
		$postFormatSupport  = false,
		$args               = array()
	) {
		$this->page_slug          = $page_slug;
		$this->templatePart       = $templatePart;
		$this->postFormatSupport  = $postFormatSupport;
		$this->args               = $args;
	}

	/**
	 * Public method init()
	 *
	 * The init method will be use to initialize our pre_get_posts action
	 *
	 * @since 1.0.0
	 */
	public function init() {
		// Initialise our pre_get_posts action
		add_action( 'pre_get_posts', array( $this, 'preGetPosts' ) );
	}

	/**
	 * Private method validatePageSlug()
	 *
	 * Validates the page ID passed
	 *
	 * @since 1.0.0
	 */
	private function validatePageSlug() {
		$validatedPageSlug = $this->page_slug;
		$this->validatedPageSlug = $validatedPageSlug;
	}

	/**
	 * Private method mergedArgs()
	 *
	 * Merge the default args with the user passed args
	 *
	 * @since 1.0.0
	 */
	private function mergedArgs() {
		// Set default arguments
		if ( get_query_var( 'paged' ) ) {
			$currentPage = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$currentPage = get_query_var( 'page' );
		} else {
			$currentPage = 1;
		}
		$default = array(
			'suppress_filters'    => true,
			'ignore_sticky_posts' => 1,
			'paged'               => $currentPage,
			'posts_per_page'      => get_option( 'posts_per_page' ), // Set posts per page here to set the LIMIT clause etc
			'nopaging'            => false
		);
		$mergedArgs = wp_parse_args( (array) $this->args, $default );
		$this->mergedArgs = $mergedArgs;
	}

	/**
	 * Public method preGetPosts()
	 *
	 * This is the callback method which will be hooked to the
	 * pre_get_posts action hook. This method will be used to alter
	 * the main query on the page specified by ID.
	 *
	 * @param WP_Query $q The query object passed by reference
	 * @since 1.0.0
	 */
	public function preGetPosts( $q ) {
		// Initialize our method which will return the validated page slug
		$this->validatePageSlug();

		if ( !is_admin() // Only target the front end
		     && $q->is_main_query() // Only target the main query
		) {
			$page_ID = $q->get('page_id');
			if ( empty( $page_ID ) ) {
				$page_ID = $q->queried_object_id;
			}

			if ( ! empty( $page_ID )
			     && $this->validatedPageSlug == get_page_template_slug( $page_ID ) // Only target our specified page
			) {
				// Remove the pre_get_posts action to avoid unexpected issues
				remove_action( current_action(), array( $this, __METHOD__ ) );

				// METHODS:
				// Initiale our mergedArgs() method
				$this->mergedArgs();
				// Initiale our custom query method
				$this->injectorQuery();

				/**
				 * We need to alter a couple of things here in order for this to work
				 * - Set posts_per_page to the user set value in order for the query to
				 *   to properly calculate the $max_num_pages property for pagination
				 * - Set the $found_posts property of the main query to the $found_posts
				 *   property of our custom query we will be using to inject posts
				 * - Set the LIMIT clause to the SQL query. By default, on pages, `is_singular`
				 *   returns true on pages which removes the LIMIT clause from the SQL query.
				 *   We need the LIMIT clause because an empty limit clause inhibits the calculation
				 *   of the $max_num_pages property which we need for pagination
				 */
				if (    $this->mergedArgs['posts_per_page']
				        && true !== $this->mergedArgs['nopaging']
				) {
					$q->set( 'posts_per_page', $this->mergedArgs['posts_per_page'] );
				} elseif ( true === $this->mergedArgs['nopaging'] ) {
					$q->set( 'posts_per_page', -1 );
				}
				$current_page = $q->get('page');
				//since this is a page, the pagination is put into 'page', not 'paged' like in a normal loop
				if ( ! empty( $current_page ) ) {
					$q->set( 'paged', $current_page );
				}

				//also fix the globals regarding pagination
				global $paged;

				$paged = 1;
				if( get_query_var( 'paged' ) ) {
					$paged = get_query_var( 'paged' );
				}
				if( get_query_var( 'page' ) ) {
					$paged = get_query_var( 'page' );
				}

				// FILTERS:
				add_filter( 'found_posts', array( $this, 'foundPosts' ), PHP_INT_MAX, 2 );
				add_filter( 'post_limits', array( $this, 'postLimits') );

				// ACTIONS:
				/**
				 * We can now add all our actions that we will be using to inject our custom
				 * posts into the main query. We will not be altering the main query or the
				 * main query's $posts property as we would like to keep full integrity of the
				 * $post, $posts globals as well as $wp_query->post. For this reason we will use
				 * post injection
				 */
				add_action( 'loop_start', array( $this, 'loopStart' ), 1 );
				add_action( 'loop_end', array( $this, 'loopEnd' ),   1 );

				//we hook very early in the wp_head to make sure that all the metas are ok
				add_action( 'wp_head', array( $this, 'query_is_not_singular' ), 0 );
				//we hook early to make sure that everybody has a title to work with
				add_filter( 'document_title_parts', array( $this, 'fix_the_title' ), 0 );
			}
		}
	}

	function query_is_not_singular() {
		global $wp_query;
		//since this is a page, is_singular is made true; for pagination to work this must be false
		$wp_query->is_singular = false;
	}

	function fix_the_title( $title ) {
		//due to the fact that we set is_singular to false, the page title will not be picked up
		//we need to help it
		$title['title'] = single_post_title( '', false );

		return $title;
	}

	/**
	 * Public method injectorQuery
	 *
	 * This will be the method which will handle our custom
	 * query which will be used to
	 * - return the posts that should be injected into the main
	 *   query according to the arguments passed
	 * - alter the $found_posts property of the main query to make
	 *   pagination work
	 *
	 * @link https://codex.wordpress.org/Class_Reference/WP_Query
	 * @since 1.0.0
	 * @return \stdClass $this->injectorQuery
	 */
	public function injectorQuery() {
		//Define our custom query
		$injectorQuery = new WP_Query( $this->mergedArgs );

		// Update the thumbnail cache
		update_post_thumbnail_cache( $injectorQuery );

		$this->injectorQuery = $injectorQuery;

		return $this->injectorQuery;
	}

	/**
	 * Public callback method foundPosts()
	 *
	 * We need to set found_posts in the main query to the $found_posts
	 * property of the custom query in order for the main query to correctly
	 * calculate $max_num_pages for pagination
	 *
	 * @param string $found_posts Passed by reference by the filter
	 * @param WP_Query $q The current query object passed by refence
	 * @since 1.0.0
	 * @return $found_posts
	 */
	public function foundPosts( $found_posts, $q ) {
		if ( !$q->is_main_query() )
			return $found_posts;

		remove_filter( current_filter(), array( $this, __METHOD__ ) );

		// Make sure that $this->injectorQuery actually have a value and is not NULL
		if ( $this->injectorQuery instanceof WP_Query && 0 != $this->injectorQuery->found_posts ) {
			return $found_posts = $this->injectorQuery->found_posts;
		}

		return $found_posts;
	}

	/**
	 * Public callback method postLimits()
	 *
	 * We need to set the LIMIT clause as it it is removed on pages due to
	 * is_singular returning true. Witout the limit clause, $max_num_pages stays
	 * set 0 which avoids pagination.
	 *
	 * We will also leave the offset part of the LIMIT cluase to 0 to avoid paged
	 * pages returning 404's
	 *
	 * @param string $limits Passed by reference in the filter
	 * @since 1.0.0
	 * @return $limits
	 */
	public function postLimits( $limits ) {
		$posts_per_page = (int) $this->mergedArgs['posts_per_page'];
		if (    $posts_per_page
		        && -1   !=  $posts_per_page // Make sure that posts_per_page is not set to return all posts
		        && true !== $this->mergedArgs['nopaging'] // Make sure that nopaging is not set to true
		) {
			$limits = "LIMIT 0, $posts_per_page"; // Leave offset at 0 to avoid 404 on paged pages
		}

		return $limits;
	}

	/**
	 * Public callback method loopStart()
	 *
	 * Callback function which will be hooked to the loop_start action hook
	 *
	 * @param WP_Query $q Query object passed by reference
	 * @since 1.0.0
	 */
	public function loopStart( $q ) {
		/**
		 * Although we run this action inside our preGetPosts methods and
		 * and inside a main query check, we need to redo the check here as well
		 * because failing to do so sets our div in the custom query output as well
		 */

		if ( ! $q->is_main_query() )
			return;

		//Make sure that $this->injectorQuery actually have a value and is not NULL
		if ( ! $this->injectorQuery instanceof WP_Query )
			return;

		// Setup a counter as wee need to run the custom query only once
		static $count = 0;

		/**
		 * Only run the custom query on the first run of the loop. Any consecutive
		 * runs (like if the user runs the loop again), the custom posts won't show.
		 */
		if ( 0 === (int) $count ) {
			// We will now add our custom posts on loop_end
			$this->injectorQuery->rewind_posts();

			// Create our loop
			if ( $this->injectorQuery->have_posts() ) {

				/**
				 * Fires before the loop to add pagination.
				 *
				 * @since 1.0.0
				 *
				 * @param \stdClass $this->injectorQuery Current object (passed by reference).
				 */
				do_action( 'pregetpostsforpages_before_loop_pagination', $this->injectorQuery );


				// Add a static counter for those who need it
				static $counter = 0;

				while ( $this->injectorQuery->have_posts() ) {
					$this->injectorQuery->the_post();

					/**
					 * Fires before get_template_part.
					 *
					 * @since 1.0.0
					 *
					 * @param int $counter (passed by reference).
					 */
					do_action( 'pregetpostsforpages_counter_before_template_part', $counter );

					/**
					 * Fires before get_template_part.
					 *
					 * @since 1.0.0
					 *
					 * @param \stdClass $this->injectorQuery-post Current post object (passed by reference).
					 * @param \stdClass $this->injectorQuery Current object (passed by reference).
					 */
					do_action( 'pregetpostsforpages_current_post_and_object', $this->injectorQuery->post, $this->injectorQuery );

					/**
					 * Load our custom template part as set by the user
					 *
					 * We will also add template support for post formats. If $this->postFormatSupport
					 * is set to true, get_post_format() will be automatically added in get_template part
					 *
					 * If you have a template called content-video.php, you only need to pass 'content'
					 * to $template part and then set $this->postFormatSupport to true in order to load
					 * content-video.php for video post format posts
					 */
					$part = '';
					if ( true === $this->postFormatSupport ) {
						$part = get_post_format( $this->injectorQuery->post->ID );
					}

					get_template_part(
						filter_var( $this->templatePart, FILTER_SANITIZE_STRING ),
						$part
					);

					/**
					 * Fires after get_template_part.
					 *
					 * @since 1.0.0
					 *
					 * @param int $counter (passed by reference).
					 */
					do_action( 'pregetpostsforpages_counter_after_template_part', $counter );

					$counter++; //Update the counter
				}

				wp_reset_postdata();

				/**
				 * Fires after the loop to add pagination.
				 *
				 * @since 1.0.0
				 *
				 * @param \stdClass $this->injectorQuery Current object (passed by reference).
				 */
				do_action( 'pregetpostsforpages_after_loop_pagination', $this->injectorQuery );
			}
		}

		// Update our static counter
		$count++;
	}

	/**
	 * Public callback method loopEnd()
	 *
	 * Callback function which will be hooked to the loop_end action hook
	 *
	 * @param WP_Query $q Query object passed by reference
	 * @since 1.0.0
	 */
	public function loopEnd( $q ) {
		/**
		 * Although we run this action inside our preGetPosts methods and
		 * and inside a main query check, we need to redo the check here as well
		 * because failing to do so sets our custom query into an infinite loop
		 */
		if ( ! $q->is_main_query() )
			return;
	}
}