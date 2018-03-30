<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */
function listable_register_widget_areas() {

	register_sidebar( array(
		'name'          => '&#x1f535; ' . esc_html__( 'Front Page Sections', 'listable' ),
		'id'            => 'front_page_sections',
		'before_widget' => '<div class="front-page-section"><div class="section-wrap">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="front_page_sections_title">',
		'after_title'   => '</h2>'
	) );


	register_sidebar( array(
		'name'          => '&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . ' &raquo; ' . esc_html__( 'Content', 'listable' ),
		'description'   => esc_html__( 'The wider area where the main listing content should go.', 'listable' ),
		'id'            => 'listing_content',
		'before_widget' => '<div id="%1$s" class="widget  %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget_sidebar_title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => '&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . ' &raquo; ' . esc_html__( 'Sidebar Top', 'listable' ),
		'description'   => esc_html__( 'Placed to the top of the right sidebar, this area put each widget in a visually different boxed container.', 'listable' ),
		'id'            => 'listing__sticky_sidebar',
		'before_widget' => '<div id="%1$s" class="widget  %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget_sidebar_title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => '&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . ' &raquo; ' . esc_html__( 'Sidebar Bottom', 'listable' ),
		'description'   => esc_html__( 'Placed below the Sidebar Top, this area brings together all the widgets under the same container.', 'listable' ),
		'id'            => 'listing_sidebar',
		'before_widget' => '<div id="%1$s" class="widget  %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget_sidebar_title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Area', 'listable' ),
		'id'            => 'footer-widget-area',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget  widget--footer  %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_widget( 'Listing_Actions_Widget' );
	register_widget( 'Listing_Content_Widget' );
	register_widget( 'Listing_Comments_Widget' );


	register_widget( 'Listing_Sidebar_Map_Widget' );
	register_widget( 'Listing_Sidebar_Categories_Widget' );
	register_widget( 'Listing_Sidebar_Hours_Widget' );
	register_widget( 'Listing_Sidebar_Gallery_Widget' );

	if ( class_exists( 'WP_Job_Manager_Claim_Listing' ) ) {
		register_widget( 'Listing_Sidebar_Claim_Listing_Widget' );
	}

	if ( function_exists( 'the_job_permalink' ) ) {
		register_widget( 'Front_Page_Listing_Cards_Widget' );
		register_widget( 'Front_Page_Listing_Categories_Widget' );

		if ( class_exists( 'Astoundify_Job_Manager_Regions' ) ) {
			register_widget( 'Front_Page_Listing_Regions_Widget' );
		}
	}

	register_widget( 'Front_Page_Recent_Posts_Widget' );
	register_widget( 'Front_Page_Spotlights_Widget' );

}

add_action( 'widgets_init', 'listable_register_widget_areas' );

/**
 * Listing Widgets
 */
class Listing_Actions_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_actions', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . ' &raquo; ' . esc_html__( 'Actions', 'listable' ), // Name
			array( 'description' => esc_html__( 'The action buttons like Write a Review, Share or Add to Favorites.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		echo $args['before_widget'];

		$action_items = 0;
		$action_reviews = false;
		$action_bookmarks = false;
		$action_sharing = false;

		if ( comments_open() && class_exists( 'PixReviewsPlugin' ) ) {
			$action_reviews = true;
			$action_items++;
		}

		global $job_manager_bookmarks;

		if ( method_exists( $job_manager_bookmarks, 'bookmark_form' ) ) {
			$action_bookmarks = true;
			$action_items++;
		}

		if ( function_exists( 'sharing_display' ) ) {
			$action_sharing = true;
			$action_items++;
		}

		?>

		<div class="single-action-buttons<?php
			if( 1 == $action_items ) echo '  has--one-action';
			elseif( 2 == $action_items ) echo '  has--two-actions';
		?>">
			<?php if ( true == $action_reviews ) : ?>

				<a href="#respond" class="action  action--review">
				<span class="action__icon">

					<?php get_template_part( 'assets/svg/write-a-review-icon-svg' ); ?>

				</span>
					<span class="action__text"><?php esc_html_e( 'Write a review', 'listable' ); ?></span>
					<span class="action__text--mobile"><?php esc_html_e( 'Review', 'listable' ); ?></span>
				</a>

				<?php
			endif;

			if ( true == $action_bookmarks ) {
				$job_manager_bookmarks->bookmark_form();
			}

			if ( true == $action_sharing ) : ?>

				<div class="action  action--share  tooltip-container">
					<a href="#" class="tooltip-trigger  js-tooltip-trigger">
						<span class="action__icon">
							<?php get_template_part( 'assets/svg/share-icon-svg' ); ?>
						</span>
						<span class="action__text"><?php esc_html_e( 'Share', 'listable' ); ?></span>
						<span class="action__text--mobile"><?php esc_html_e( 'Share', 'listable' ); ?></span>
					</a>

					<?php sharing_display( '', true ); ?>

				</div><!-- .action.action--share.tooltip-container -->

			<?php endif; ?>

		</div><!-- .single-action-buttons -->

		<?php

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}

} // class Listing_Actions_Widget

class Listing_Content_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_content', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . ' &raquo; ' . esc_html__( 'Content', 'listable' ), // Name
			array( 'description' => esc_html__( 'The main listing content.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		echo $args['before_widget'];

		//first let's filter the content in any way we might find suitable
		$content = get_the_content();
		//let add-ons and so on, hook into this
		//but cripple it's behaviour similar to the_content
		remove_filter( 'the_job_description', 'wptexturize'        );
		remove_filter( 'the_job_description', 'convert_smilies'    );
		remove_filter( 'the_job_description', 'convert_chars'      );
		remove_filter( 'the_job_description', 'wpautop'            );
		remove_filter( 'the_job_description', 'shortcode_unautop'  );
		remove_filter( 'the_job_description', 'prepend_attachment' );
		$content = apply_filters( 'the_job_description', $content );

		//deliver the_content blessing from the Heavens (you know... shortcodes and all)
		$content = apply_filters( 'the_content', $content );

		if ( ! empty( $content ) ) : ?>

			<div class="job_description" itemprop="description">
				<?php
				//now show it to the world
				echo $content;
				?>
			</div>

		<?php endif;

		// if ( candidates_can_apply() ) {get_job_manager_template( 'job-application.php' ); }

		/**
		 * single_job_listing_end hook
		 */
		do_action( 'single_job_listing_end' );

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}

} // class Listing_Content_Widget

class Listing_Comments_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_comments', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . ' &raquo; ' . esc_html__( 'Reviews', 'listable' ), // Name
			array( 'description' => esc_html__( 'A list of the recent reviews and the submission form.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		// If comments are open or we have at least one comment, load up the comment template.
		if ( ( comments_open() || get_comments_number() ) && 'preview' !== $post->post_status ) {
			echo $args['before_widget'];

			if ( 'job_listing' == get_post_type() ) {
				add_action( 'comment_text', 'listable_move_comment_date', 9 );
			}
			comments_template();

			echo $args['after_widget'];
		}
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} // class Listing_Comments_Widget

class Listing_Sidebar_Map_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_sidebar_map', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . '  &raquo; ' . esc_html__( 'Location Map', 'listable' ), // Name
			array( 'description' => esc_html__( 'A Map View of the listing location along with a Directions link to Google Map.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;

		$address = listable_get_formatted_address();

		if ( empty( $address ) ) {
			return;
		}

		$geolocation_lat  = get_post_meta( get_the_ID(), 'geolocation_lat', true );
		$geolocation_long = get_post_meta( get_the_ID(), 'geolocation_long', true );

		$get_directions_link = '';
		if ( ! empty( $geolocation_lat ) && ! empty( $geolocation_long ) && is_numeric( $geolocation_lat ) && is_numeric( $geolocation_long ) ) {
			$get_directions_link = '//maps.google.com/maps?daddr=' . $geolocation_lat . ',' . $geolocation_long;
		}
		
		if ( empty( $get_directions_link ) ) {
			return;
		}
		echo $args['before_widget']; ?>

		<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
			<div id="map" class="listing-map"></div>

			<?php if ( ! empty( $geolocation_lat ) && ! empty( $geolocation_long ) && is_numeric( $geolocation_lat ) && is_numeric( $geolocation_long ) ) : ?>

				<meta itemprop="latitude" content="<?php echo $geolocation_lat; ?>"/>
				<meta itemprop="longitude" content="<?php echo $geolocation_long; ?>"/>

			<?php endif; ?>

		</div>
		<div class="listing-map-content">
			<address class="listing-address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<?php
				echo $address;
				if ( true == apply_filters( 'listable_skip_geolocation_formatted_address', false ) ) { ?>
					<meta itemprop="streetAddress" content="<?php echo trim( get_post_meta( $post->ID, 'geolocation_street_number', true ), '' ); ?> <?php echo trim( get_post_meta( $post->ID, 'geolocation_street', true ), '' ); ?>">
					<meta itemprop="addressLocality" content="<?php echo trim( get_post_meta( $post->ID, 'geolocation_city', true ), '' ); ?>">
					<meta itemprop="postalCode" content="<?php echo trim( get_post_meta( $post->ID, 'geolocation_postcode', true ), '' ); ?>">
					<meta itemprop="addressRegion" content="<?php echo trim( get_post_meta( $post->ID, 'geolocation_state', true ), '' ); ?>">
					<meta itemprop="addressCountry" content="<?php echo trim( get_post_meta( $post->ID, 'geolocation_country_short', true ), '' ); ?>">
				<?php } ?>
			</address>
			<?php if ( ! empty( $get_directions_link ) ) { ?>
				<a href="<?php echo $get_directions_link; ?>" class="listing-address-directions" target="_blank"><?php esc_html_e( 'Get directions', 'listable' ); ?></a>
			<?php } ?>
		</div><!-- .listing-map-content -->

		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} // class Listing_Sidebar_Map_Widget

class Listing_Sidebar_Categories_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_sidebar_categories', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . ' &raquo; ' . esc_html__( 'Categories', 'listable' ), // Name
			array(
				'description' => esc_html__( 'The listing categories along with the related icon.', 'listable' ),
			) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		echo $args['before_widget'];

		$term_list = wp_get_post_terms(
			$post->ID,
			'job_listing_category',
			array( 'fields' => 'all' )
		);

		if ( ! empty( $term_list ) && ! is_wp_error( $term_list ) ) : ?>

			<ul class="categories">
				<?php
				foreach ( $term_list as $key => $term ) : ?>
					<li>
						<a href="<?php echo esc_url( get_term_link( $term ) ); ?>">
							<?php
							$icon_url      = listable_get_term_icon_url( $term->term_id );
							$attachment_id = listable_get_term_icon_id( $term->term_id );
							if ( ! empty( $icon_url ) ) { ?>
								<span class="category-icon">
									<?php listable_display_image( $icon_url, '', true, $attachment_id ); ?>
								</span>
							<?php } ?>
							<span class="category-text"><?php echo $term->name; ?></span>
						</a>
					</li>

				<?php endforeach; ?>

			</ul><!-- .categories -->

			<?php
		endif;

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} // class Listing_Sidebar_Categories_Widget

class Listing_Sidebar_Hours_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_sidebar_hours', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . ' &raquo; ' . esc_html__( 'Hours', 'listable' ), // Name
			array( 'description' => esc_html__( 'The Hours field content.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;

		$hours = get_post_meta( get_the_ID(), '_job_hours', true );
		if ( ! empty ( $hours ) ) :

			echo $args['before_widget']; ?>
			<div class="schedule" itemprop="openingHours"><?php echo $hours; ?></div>
			<?php
			echo $args['after_widget'];

		endif;
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} // class Listing_Sidebar_Hours_Widget

class Listing_Sidebar_Gallery_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_sidebar_gallery', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . ' &raquo; ' . esc_html__( 'Gallery Images', 'listable' ), // Name
			array( 'description' => esc_html__( 'The attached images in a gallery grid format.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;

		$photos = listable_get_listing_gallery_ids();

		if ( ! empty( $photos ) ) :
			echo $args['before_widget']; ?>

			<header class="listing-gallery__header">
				<span class="listing-gallery__title"><?php esc_html_e( 'Photo gallery', 'listable' ); ?></span>
				<a href="<?php echo wp_get_attachment_url( intval( $photos[0] ) ); ?>" class="listing-gallery__all"><?php echo esc_html__( 'All photos', 'listable' ) . ' (' . count( $photos ) . ')'; ?></a>
			</header>
			<div class="listing-gallery__items  js-widget-gallery">

				<?php
				foreach ( $photos as $key => $photo_ID ) : ?>
					<a href="<?php echo wp_get_attachment_url( $photo_ID ); ?>" class="listing-gallery__item">
						<?php
							$attachment = get_post( $photo_ID );
							echo wp_get_attachment_image( $photo_ID, 'thumbnail', false, array( 'itemprop' => 'image', 'caption' => $attachment->post_excerpt, 'description' => $attachment->post_content ) );
						?>
					</a>
				<?php endforeach; ?>

			</div><!-- .listing-gallery__items -->

		<?php
			echo $args['after_widget'];
		endif;
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} // class Listing_Sidebar_Gallery_Widget

class Listing_Sidebar_Claim_Listing_Widget extends WP_Widget {
	//These are used when nothing existing in the database, as values - so we are not talking about fake things when none exists
	//For those there are the placeholders
	private $defaults = array(
		'title' => '',
		'claim_button_text' => '',
		'claim_description_text' => '',
	);

	function __construct() {
		parent::__construct(
			'listing_sidebar_claim_listing', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . ' &raquo; ' . esc_html__( 'Claim Listing', 'listable' ), // Name
			array( 'description' => esc_html__( 'Display a claim listing button.', 'listable' ), ) // Args
		);

		remove_action( 'single_job_listing_start', array( WP_Job_Manager_Claim_Listing()->listing, 'claim_listing_link' ), 10 );
	}

	public function widget( $args, $instance ) {
		global $post;

		$placeholders = $this->get_placeholder_strings();
		//only put in the default title if the user hasn't saved anything in the database e.g. $instance is empty (as a whole)
		$title = apply_filters( 'widget_title', ( empty( $instance ) || ! isset( $instance['title'] ) ) ? $placeholders['title'] : $instance['title'], $instance, $this->id_base );
		$claim_button_text = ( empty( $instance ) || ! isset( $instance['claim_button_text'] ) ) ? $placeholders['claim_button_text'] : $instance['claim_button_text'];
		$claim_description_text = ( empty( $instance ) || ! isset( $instance['claim_description_text'] ) ) ? $placeholders['claim_description_text'] : $instance['claim_description_text'];

		$classes = WP_Job_Manager_Claim_Listing()->listing->add_post_class( array(), '', $post->ID );

		if ( isset( $classes[0] ) && ! empty( $classes[0] ) ) {
			if ( $classes[0] == 'claimed' )
				return;
		}

		echo $args['before_widget'];

		if ( ! empty( $title ) || ! empty( $claim_button_text ) ) {
			//make sure that Login with Ajax can work
			if( empty( $paid_claims ) && ! is_user_logged_in() && listable_using_lwa() ) {
				//we need a wrapper with the lwa class
				$args['before_title'] .= '<div class="lwa">';
				$args['after_title'] = '</div>' . $args['after_title'];
			}

			echo $args['before_title'] . $title;

			if ( ! empty( $claim_button_text ) ) {

				$paid_claims = get_option('wpjmcl_paid_claiming');

				$paid_claim_listing_page = job_manager_get_permalink( 'claim_listing' );
				$href = esc_url ( wp_nonce_url ( add_query_arg ( array ( 'action' => 'claim_listing', 'listing_id' => $post->ID ), $paid_claim_listing_page ), 'claim_listing', 'claim_listing_nonce' ) );
				$classes = 'listing-claim-button';

				if( empty( $paid_claims ) && ! is_user_logged_in() ) {
					$href = listable_get_login_url();
					$classes = listable_get_login_link_class( $classes );
				}

				echo ' <a class="' . $classes . '" href="' . $href . '">'. $claim_button_text .'</a>';
			}

			echo $args['after_title'];
		}

		if ( ! empty ( $claim_description_text ) ) {
			echo '<small class="listing-claim-description">'. $claim_description_text .'</small>';
		}

		wc_print_notices();

		?>

		<?php echo $args['after_widget'];
	}

	public function form( $instance ) {
		$original_instance = $instance;

		//Defaults
		$instance = wp_parse_args(
			(array) $instance,
			$this->defaults );

		$placeholders = $this->get_placeholder_strings();

		$title = esc_attr( $instance['title'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $title ) ) {
			$title = $placeholders['title'];
		}

		$claim_button_text = esc_attr( $instance['claim_button_text'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $claim_button_text ) ) {
			$claim_button_text = $placeholders['claim_button_text'];
		}

		$claim_description_text = esc_attr( $instance['claim_description_text'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $claim_description_text ) ) {
			$claim_description_text = $placeholders['claim_description_text'];
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'claim_button_text' ); ?>"><?php _e( 'Claim Button Text:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'claim_button_text' ); ?>" name="<?php echo $this->get_field_name( 'claim_button_text' ); ?>" type="text" value="<?php echo esc_attr( $claim_button_text ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'claim_description_text' ); ?>"><?php _e( 'Description:', 'listable' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'claim_description_text' ); ?>" name="<?php echo $this->get_field_name( 'claim_description_text' ); ?>"><?php
				echo esc_attr( $claim_description_text ); ?></textarea>
		</p>

		<?php
	}

	private function get_placeholder_strings() {
		$placeholders = apply_filters( 'listing_sidebar_claim_listing_widget_backend_placeholders', array() );

		$placeholders = wp_parse_args(
			(array) $placeholders,
			array(
				'title'    => esc_html__( 'Is this your business?', 'listable' ),
				'claim_button_text' => esc_html__( 'Claim it now.', 'listable' ),
				'claim_description_text' => esc_html__( 'Make sure your information is up to date.', 'listable' ),
			) );

		return $placeholders;
	}
} // class Listing_Sidebar_Claim_Listing_Widget

/**
 * Front Page Widgets
 */
class Front_Page_Listing_Cards_Widget extends WP_Widget {

	private $defaults = array(
		'title'           => '',
		'subtitle'        => '',
		'number_of_items' => '3',
		'show'            => 'all',
		'orderby'         => 'date',
		'items_ids'       => '',
		'categories_slug' => ''
	);

	function __construct() {
		parent::__construct(
			'front_page_listing_cards', // Base ID
			'&#x1f535; ' . esc_html__( 'Front Page', 'listable' ) . ' &raquo; ' . esc_html__( 'Listing Cards', 'listable' ), // Name
			array( 'description' => esc_html__( 'Displays a list of your listings based on different criteria (eg. latest of featured listings from a specific category)', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;

		$placeholders = $this->get_placeholder_strings();
		//only put in the default title if the user hasn't saved anything in the database e.g. $instance is empty (as a whole)
		$title           = apply_filters( 'widget_title', empty( $instance ) ? $placeholders['title'] : $instance['title'], $instance, $this->id_base );
		$subtitle        = empty( $instance ) ? $placeholders['subtitle'] : $instance['subtitle'];
		$number_of_items = empty( $instance['number_of_items'] ) ? $this->defaults['number_of_items'] : $instance['number_of_items'];
		$show            = empty( $instance['show'] ) ? $this->defaults['show'] : $instance['show'];
		$orderby         = empty( $instance['orderby'] ) ? $this->defaults['orderby'] : $instance['orderby'];
		$items_ids       = empty( $instance['items_ids'] ) ? $this->defaults['items_ids'] : $instance['items_ids'];
		$categories_slug = empty( $instance['categories_slug'] ) ? $this->defaults['categories_slug'] : $instance['categories_slug'];

		echo $args['before_widget']; ?>

		<div class="widget_front_page_listing_cards" itemscope itemtype="http://schema.org/LocalBusiness">
			<h3 class="widget_title  widget_title--frontpage">
				<?php
				echo $title;

				if ( ! empty( $subtitle ) ) { ?>
					<span class="widget_subtitle--frontpage">
						<?php echo $subtitle; ?>
					</span>
				<?php } ?>
			</h3>
			<?php
			// lets query some
			$query_args = array(
				'post_type'   => 'job_listing',
				'post_status' => 'publish'
			);

			if ( ! empty( $number_of_items ) && is_numeric( $number_of_items ) ) {
				$query_args['posts_per_page'] = $number_of_items;
			}

			if ( ! empty( $orderby ) && is_string( $orderby ) ) {
				$query_args['orderby'] = $orderby;
			}

			if ( ! empty( $show ) && $show === 'featured' ) {
				$query_args['meta_key']   = '_featured';
				$query_args['meta_value'] = '1';
			}

			if ( ! empty( $items_ids ) && is_string( $items_ids ) ) {
				$query_args['post__in'] = explode( ',', $items_ids );
			}

			if ( ! empty( $categories_slug ) && is_string( $categories_slug ) ) {
				$categories_slug = explode( ',', $categories_slug );

				foreach ( $categories_slug as $key => $cat ) {
					$categories_slug[ $key ] = sanitize_title( $cat );
				}
				$query_args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'job_listing_category',
						'field'    => 'slug',
						'terms'    => $categories_slug,
					)
				);
			}

			$listings = new WP_Query( $query_args );

			if ( $listings->have_posts() ) : ?>
				<div class="grid  grid--widget  list">
					<?php while ( $listings->have_posts() ) : $listings->the_post();
						$terms = get_the_terms( get_the_ID(), 'job_listing_category' );

						$listing_classes = 'card  card--listing  card--widget  ';
						$listing_is_claimed = false;
						$listing_is_featured = false;

						if ( is_position_featured($post) ) $listing_is_featured = true;

						if ( class_exists( 'WP_Job_Manager_Claim_Listing' ) ) {
							$classes = WP_Job_Manager_Claim_Listing()->listing->add_post_class( array(), '', $post->ID  );

							if ( isset( $classes[0] ) && ! empty( $classes[0] ) ) {
								$listing_classes .= $classes[0];

								if ( $classes[0] == 'claimed' )
									$listing_is_claimed = true;
							}
						}

						if ( true === $listing_is_featured ) $listing_classes .= '  is--featured';

						$listing_classes = apply_filters( 'listable_listing_archive_classes', $listing_classes, $post ); ?>

						<a href="<?php the_job_permalink(); ?>" class="grid__item  grid__item--widget">
							<article class="<?php echo $listing_classes; ?>" data-latitude="<?php echo get_post_meta( $post->ID, 'geolocation_lat', true ); ?>"
							         data-longitude="<?php echo get_post_meta( $post->ID, 'geolocation_long', true ); ?>"
							         data-img="<?php echo listable_get_post_image_src( $post->ID, 'full' ); ?>"
							         data-permalink="<?php the_job_permalink(); ?>">

								<aside class="card__image" style="background-image: url(<?php echo listable_get_post_image_src( $post->ID, 'listable-card-image' ); ?>);">
									<?php if ( true === $listing_is_featured ): ?>
									<span class="card__featured-tag"><?php esc_html_e( 'Featured', 'listable' ); ?></span>
									<?php endif; ?>

									<?php do_action('listable_job_listing_card_image_top', $post ); ?>

									<?php do_action('listable_job_listing_card_image_bottom', $post ); ?>

								</aside>

								<div class="card__content">
									<h2 class="card__title" itemprop="name"><?php
										echo get_the_title();
										if ( $listing_is_claimed ) :
											echo '<span class="listing-claimed-icon">';
											get_template_part('assets/svg/checked-icon-small');
											echo '<span>';
										endif;
									?></h2>
									<div class="card__tagline"><?php the_company_tagline(); ?></div>
									<footer class="card__footer">
										<?php
										$rating = get_average_listing_rating( $post->ID, 1 );
										if ( ! empty( $rating ) ) { ?>
											<div class="rating  card__rating">
												<span class="js-average-rating"><?php echo get_average_listing_rating( $post->ID, 1 ); ?></span>
											</div>
										<?php } else {
											if ( get_post_meta( $post->ID, 'geolocation_street', true ) ) { ?>
												<div class="card__rating  card__pin">
													<?php get_template_part( 'assets/svg/pin-simple-svg' ) ?>
												</div>
											<?php }
										} ?>

										<?php if ( ! is_wp_error( $terms ) && ( is_array( $terms ) || is_object( $terms ) ) ) { ?>

											<ul class="card__tags">
												<?php foreach ( $terms as $term ) {
													$icon_url      = listable_get_term_icon_url( $term->term_id );
													$attachment_id = listable_get_term_icon_id( $term->term_id );
													if ( empty( $icon_url ) ) {
														continue;
													} ?>
													<li>
														<div class="card__tag">
															<div class="pin__icon">
																<?php listable_display_image( $icon_url, '', true, $attachment_id ); ?>
															</div>
														</div>
													</li>
												<?php } ?>
											</ul>

										<?php }

										$listing_address = listable_get_formatted_address( $post );

										if ( ! empty( $listing_address ) ) { ?>
											<div class="address  card__address">
												<?php echo $listing_address; ?>
											</div>
										<?php } ?>
									</footer>
								</div><!-- .card__content -->
							</article><!-- .card.card--listing -->
						</a><!-- .grid_item -->

					<?php endwhile;

					wp_reset_postdata(); ?>

				</div>

			<?php endif; ?>

		</div>
		<?php echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return null
	 */
	public function form( $instance ) {
		$original_instance = $instance;

		//Defaults
		$instance = wp_parse_args(
			(array) $instance,
			$this->defaults );

		$placeholders = $this->get_placeholder_strings();

		$title = esc_attr( $instance['title'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $title ) ) {
			$title = $placeholders['title'];
		}

		$subtitle = esc_attr( $instance['subtitle'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $subtitle ) ) {
			$subtitle = $placeholders['subtitle'];
		}

		$number_of_items = esc_attr( $instance['number_of_items'] );
		$items_ids       = esc_attr( $instance['items_ids'] );
		$categories_slug = esc_attr( $instance['categories_slug'] ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" placeholder="<?php echo esc_attr( $placeholders['title'] ); ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php esc_html_e( 'Subtitle:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo $subtitle; ?>" placeholder="<?php echo esc_attr( $placeholders['subtitle'] ); ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number_of_items' ); ?>"><?php esc_html_e( 'Number of items to show:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number_of_items' ); ?>" name="<?php echo $this->get_field_name( 'number_of_items' ); ?>" type="number" value="<?php echo $number_of_items; ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show' ); ?>"><?php esc_html_e( 'Show:', 'listable' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'show' ); ?>" id="<?php echo $this->get_field_id( 'show' ); ?>" class="widefat">
				<option value="all"<?php selected( $instance['show'], 'all' ); ?>><?php esc_html_e( 'All Listings', 'listable' ); ?></option>
				<option value="featured"<?php selected( $instance['show'], 'featured' ); ?>><?php esc_html_e( 'Featured Listings', 'listable' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e( 'Order by:', 'listable' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id( 'orderby' ); ?>" class="widefat">
				<option value="date"<?php selected( $instance['orderby'], 'date' ); ?>><?php esc_html_e( 'Date', 'listable' ); ?></option>
				<option value="rand"<?php selected( $instance['orderby'], 'rand' ); ?>><?php esc_html_e( 'Random', 'listable' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'items_ids' ); ?>"><?php esc_html_e( 'Items IDs(optional):', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'items_ids' ); ?>" name="<?php echo $this->get_field_name( 'items_ids' ); ?>" type="text" value="<?php echo $items_ids; ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'categories_slug' ); ?>"><?php esc_html_e( 'Categories Slug(optional):', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'categories_slug' ); ?>" name="<?php echo $this->get_field_name( 'categories_slug' ); ?>" type="text" value="<?php echo $categories_slug; ?>"/>
		</p>
		<?php
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                    = $old_instance;
		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['subtitle']        = strip_tags( $new_instance['subtitle'] );
		$instance['number_of_items'] = strip_tags( $new_instance['number_of_items'] );
		//some sanity check
		if ( intval( $instance['number_of_items'] ) < 1 ) {
			$instance['number_of_items'] = '1';
		}
		$instance['items_ids']       = strip_tags( $new_instance['items_ids'] );
		$instance['categories_slug'] = strip_tags( $new_instance['categories_slug'] );

		if ( in_array( $new_instance['show'], array( 'all', 'featured' ) ) ) {
			$instance['show'] = $new_instance['show'];
		} else {
			$instance['show'] = 'all';
		}

		if ( in_array( $new_instance['orderby'], array( 'date', 'rand' ) ) ) {
			$instance['orderby'] = $new_instance['orderby'];
		} else {
			$instance['orderby'] = 'date';
		}

		return $instance;
	}

	private function get_placeholder_strings() {
		$placeholders = apply_filters( 'front_page_listing_cards_widget_backend_placeholders', array() );

		$placeholders = wp_parse_args(
			(array) $placeholders,
			array(
				'title'    => esc_html__( 'Listing Cards', 'listable' ),
				'subtitle' => esc_html__( 'Explore these lovely listings', 'listable' )
			) );

		return $placeholders;
	}
} // class Front_Page_Listing_Cards_Widget

class Front_Page_Listing_Categories_Widget extends WP_Widget {

	private $defaults = array(
		'title'           => '',
		'subtitle'        => '',
		'number_of_items' => '4',
		'orderby'         => 'name',
		'categories_slug' => '',
//		'default_image'   => ''
	);

	function __construct() {
		parent::__construct(
			'front_page_listing_categories', // Base ID
			'&#x1f535; ' . esc_html__( 'Front Page', 'listable' ) . ' &raquo; ' . esc_html__( 'Listing Categories', 'listable' ), // Name
			array( 'description' => esc_html__( 'Display a list of listing categories based on different criteria (eg. most popular, random) or specify which ones you want to show.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;

		$placeholders = $this->get_placeholder_strings();

		//only put in the default title if the user hasn't saved anything in the database e.g. $instance is empty (as a whole)
		$title                  = apply_filters( 'widget_title', empty( $instance ) ? $placeholders['title'] : $instance['title'], $instance, $this->id_base );
		$subtitle               = empty( $instance ) ? $placeholders['subtitle'] : $instance['subtitle'];
		$number_of_items        = empty( $instance['number_of_items'] ) ? $this->defaults['number_of_items'] : $instance['number_of_items'];
		$orderby                = empty( $instance['orderby'] ) ? $this->defaults['orderby'] : $instance['orderby'];
		$categories_slug        = empty( $instance['categories_slug'] ) ? $this->defaults['categories_slug'] : $instance['categories_slug'];
		//$widget_default_image   = empty( $instance['default_image'] ) ? $this->defaults['default_image'] : $instance['default_image'];
		$term_list              = array();
		$custom_category_labels = array();

		//first let's do only one query and get all the terms - we will reuse this info to avoid multiple queries
		$query_args = array( 'order' => 'DESC', 'hide_empty' => false, 'hierarchical' => true, 'pad_counts' => true );
		if ( ! empty( $orderby ) && is_string( $orderby ) ) {
			$query_args['orderby'] = $orderby;
		}

		$all_terms = get_terms(
			'job_listing_category',
			$query_args
		);

		//bail if there was an error
		if ( is_wp_error( $all_terms ) ) {
			return;
		}

		//now create an array with the category slug as key so we can reference/search easier
		$all_categories = array();
		foreach ( $all_terms as $key => $term ) {
			$all_categories[ $term->slug ] = $term;
		}

		echo $args['before_widget'];

		//if we have received a list of categories to display (their slugs and optional label), use that
		if ( ! empty( $categories_slug ) && is_string( $categories_slug ) ) {
			$categories = explode( ',', $categories_slug );
			foreach ( $categories as $key => $category ) {
				if ( strpos( $category, '(' ) !== false ) {
					$category  = explode( '(', $category );
					$term_slug = trim( $category[0] );

					if ( substr( $category[1], - 1, 1 ) == ')' ) {
						$custom_category_labels[ $term_slug ] = trim( substr( $category[1], 0, - 1 ) );
					}

					if ( array_key_exists( $term_slug, $all_categories ) ) {
						$term_list[] = $all_categories[ $term_slug ];
					}
				} else {
					$term_slug = trim( $category );
					if ( array_key_exists( $term_slug, $all_categories ) ) {
						$term_list[] = $all_categories[ $term_slug ];
					}
				}
			}

			//now if the user has chosen to sort these according to the number of posts, we should do that
			// since we will, by default, respect the order of the categories he has used
			if ( 'count' == $orderby ) {
				// Define the custom sort function
				function sort_by_post_count( $a, $b ) {
					return $a->count < $b->count;
				}

				// Sort the multidimensional array
				usort( $term_list, "sort_by_post_count" );
			} elseif ( 'rand' == $orderby ) {
				//randomize things a bit if this is what the user ordered
				shuffle( $term_list );
			}

		} else {
			//it seems we will have to figure out ourselves what categories to display

			if ( ! $number_of_items = intval( $number_of_items ) ) {
				$number_of_items = 4;
			}

			$term_list = array_slice( $all_categories, 0, $number_of_items );
		}

		if ( ! empty( $term_list ) ) : ?>

			<h3 class="widget_title  widget_title--frontpage">
				<?php
				echo $title;
				if ( ! empty( $subtitle ) ) { ?>
					<span class="widget_subtitle  widget_subtitle--frontpage">
						<?php echo $subtitle; ?>
					</span>
				<?php } ?>
			</h3>

			<div class="categories-wrap  categories-wrap--widget">
				<ul class="categories  categories--widget">

					<?php foreach ( $term_list as $key => $term ) :
						if ( ! $term ) {
							continue;
						}
						$icon_url           = listable_get_term_icon_url( $term->term_id );
						$image_url          = listable_get_term_image_url( $term->term_id, 'listable-card-image' );
						$attachment_id      = listable_get_term_icon_id( $term->term_id );
						$image_src          = '';

						if ( ! empty( $image_url ) ) {

							$image_src = $image_url;

//						} elseif ( $has_widget_default ) {
//							$image_src = $widget_default_image;
						} else {
							$thumbargs    = array(
								'posts_per_page' => 1,
								'post_type'      => 'job_listing',
								'meta_key'       => 'main_image',
								'orderby'          => 'rand',
								'tax_query'      => array(
									array(
										'taxonomy' => 'job_listing_category',
										'field'    => 'name',
										'terms'    => $term->name
									),
								)
							);
							$latest_thumb = new WP_Query( $thumbargs );

							if ( $latest_thumb->have_posts() ) {
								//get the first image in the listing's gallery or the featured image, if present
								$image_ID  = listable_get_post_image_id( $latest_thumb->post->ID );
								$image_src = '';
								if ( ! empty( $image_ID ) ) {
									$image     = wp_get_attachment_image_src( $image_ID, 'medium' );
									$image_src = $image[0];
								}
							}
						} ?>

						<li <?php echo empty( $icon_url ) ? 'class="no-icon"' : ''; ?>>
							<div class="category-cover" style="background-image: url(<?php echo listable_get_inline_background_image( $image_src ); ?>)">
								<a href="<?php echo esc_url( get_term_link( $term ) ); ?>">

									<?php if ( ! empty( $icon_url ) ) : ?>

										<div class="category-icon">

											<?php listable_display_image( $icon_url, '', true, $attachment_id ); ?>

											<span class="category-count">
												<?php echo $term->count; ?>
											</span>
										</div>

									<?php endif; ?>

									<span class="category-text"><?php echo isset( $custom_category_labels[ $term->slug ] ) ? $custom_category_labels[ $term->slug ] : $term->name; ?></span>
								</a>
							</div>
						</li>

					<?php endforeach; ?>

				</ul><!-- .categories -->
			</div><!-- .categories-wrap -->

			<?php
		endif;

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return null
	 */
	public function form( $instance ) {
		$original_instance = $instance;
		//Defaults
		$instance = wp_parse_args(
			(array) $instance,
			$this->defaults );

		$placeholders = $this->get_placeholder_strings();

		$title = esc_attr( $instance['title'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $title ) ) {
			$title = $placeholders['title'];
		}

		$subtitle = esc_attr( $instance['subtitle'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $subtitle ) ) {
			$subtitle = $placeholders['subtitle'];
		}
		$number_of_items = esc_attr( $instance['number_of_items'] );
		$categories_slug = esc_attr( $instance['categories_slug'] );
		//$default_image   = esc_attr( $instance['default_image'] ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" placeholder="<?php echo esc_attr( $placeholders['title'] ); ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php esc_html_e( 'Subtitle:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo $subtitle; ?>" placeholder="<?php echo esc_attr( $placeholders['subtitle'] ); ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number_of_items' ); ?>"><?php esc_html_e( 'Number of items to show:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number_of_items' ); ?>" name="<?php echo $this->get_field_name( 'number_of_items' ); ?>" type="number" value="<?php echo $number_of_items; ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e( 'Order by:', 'listable' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id( 'orderby' ); ?>" class="widefat">
				<option value="name"<?php selected( $instance['orderby'], 'name' ); ?>><?php esc_html_e( 'Default', 'listable' ); ?></option>
				<option value="count"<?php selected( $instance['orderby'], 'count' ); ?>><?php esc_html_e( 'Number of Listings', 'listable' ); ?></option>
				<option value="rand"<?php selected( $instance['orderby'], 'rand' ); ?>><?php esc_html_e( 'Random', 'listable' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'categories_slug' ); ?>"><?php esc_html_e( 'Categories Slug(optional):', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'categories_slug' ); ?>" name="<?php echo $this->get_field_name( 'categories_slug' ); ?>" type="text" value="<?php echo $categories_slug; ?>"/>
		</p>

		<?php
		/**
		 * Keep this hidden for now

		if ( ! wp_attachment_is_image( $default_image ) ) {
			$default_image = false;
		} ?>

		<span class="field_separator">...</span>

		<p class="listable-image-modal-control<?php echo ( $default_image ) ? ' has-image' : ''; ?>"
		   data-title="<?php esc_attr_e( 'Select an Image', 'listable' ); ?>"
		   data-update-text="<?php esc_attr_e( 'Update Image', 'listable' ); ?>"
		   data-target="listable-categories-<?php echo $this->number ?>-image-id">
			<?php
			if ( ! empty( $default_image ) ) {
				echo wp_get_attachment_image( $default_image, 'medium', false );
			} ?>
			<input data-field="image" type="hidden" value="<?php echo $default_image; ?>" class="widefat listable-category-<?php echo $this->number ?>-image-id" id="<?php echo $this->get_field_id( 'default_image' ); ?>" name="<?php echo $this->get_field_name( 'default_image' ); ?>">
			<a class="button listable-image-modal-control__choose dashicons dashicons-camera" href="#" title="<?php esc_html_e( 'Select an Image', 'listable' ); ?>"></a>
			<a class="button listable-image-modal-control__clear dashicons dashicons-dismiss" href="#" title="<?php esc_html_e( 'Clear', 'listable' ); ?>"></a>
		</p>
		<?php
		 */
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		//this number can't be lower than 1
		$instance['number_of_items'] = strip_tags( $new_instance['number_of_items'] );
		if ( intval( $instance['number_of_items'] ) < 1 ) {
			$instance['number_of_items'] = '1';
		}
		$instance['categories_slug'] = strip_tags( $new_instance['categories_slug'] );
		//$instance['default_image']   = strip_tags( $new_instance['default_image'] );

		if ( in_array( $new_instance['orderby'], array( 'name', 'count', 'rand' ) ) ) {
			$instance['orderby'] = $new_instance['orderby'];
		} else {
			$instance['orderby'] = 'name';
		}

		return $instance;
	}

	private function get_placeholder_strings() {
		$placeholders = apply_filters( 'front_page_listing_categories_widget_backend_placeholders', array() );

		$placeholders = wp_parse_args(
			(array) $placeholders,
			array(
				'title'    => esc_html__( 'What are you interested in?', 'listable' ),
				'subtitle' => esc_html__( 'Discover something nice', 'listable' )
			) );

		return $placeholders;
	}

} // class Front_Page_Listing_Categories_Widget

class Front_Page_Recent_Posts_Widget extends WP_Widget {

	private $defaults = array(
		'title'           => '',
		'subtitle'        => '',
		'number_of_items' => '3'
	);

	function __construct() {
		parent::__construct(
			'front_page_recent_posts', // Base ID
			'&#x1f535; ' . esc_html__( 'Front Page', 'listable' ) . ' &raquo; ' . esc_html__( 'Recent Posts', 'listable' ), // Name
			array( 'description' => esc_html__( 'A list of the latest posts from blog.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;

		$placeholders = $this->get_placeholder_strings();
		//only put in the default title if the user hasn't saved anything in the database e.g. $instance is empty (as a whole)
		$title           = apply_filters( 'widget_title', empty( $instance ) ? $placeholders['title'] : $instance['title'], $instance, $this->id_base );
		$subtitle        = empty( $instance ) ? $placeholders['subtitle'] : $instance['subtitle'];
		$number_of_items = empty( $instance['number_of_items'] ) ? $this->defaults['number_of_items'] : $instance['number_of_items'];

		$query_args = array( 'order' => 'DESC', 'orderby' => 'date' );

		if ( ! empty( $number_of_items ) && is_numeric( $number_of_items ) ) {
			$query_args['posts_per_page'] = $number_of_items;
		}
		$query = new WP_Query( $query_args );

		echo $args['before_widget']; ?>

		<h3 class="widget_title  widget_title--frontpage">
			<?php
			echo $title;

			if ( ! empty( $subtitle ) ) { ?>
				<span class="widget_subtitle  widget_subtitle--frontpage">
					<?php echo $subtitle; ?>
				</span>
			<?php } ?>
		</h3>

		<div class="grid  grid--widget  list">

			<?php while ( $query->have_posts() ) : $query->the_post(); ?>

				<div class="grid__item  grid__item--widget">

					<?php
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
					?>

				</div>

			<?php endwhile;

			wp_reset_postdata(); ?>

		</div><!-- .grid.list -->

		<?php $blog_url = get_option( 'show_on_front' ) == 'page' ? get_permalink( get_option( 'page_for_posts' ) ) : home_url(); ?>

		<div class="nav-links">
			<div class="nav-next">
				<a href="<?php echo esc_url( $blog_url ); ?>"><?php esc_html_e( 'View All', 'listable' ); ?></a></div>
		</div>

		<?php echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return null
	 */
	public function form( $instance ) {
		$original_instance = $instance;

		//Defaults
		$instance = wp_parse_args(
			(array) $instance,
			$this->defaults );

		$placeholders = $this->get_placeholder_strings();

		$title = esc_attr( $instance['title'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $title ) ) {
			$title = $placeholders['title'];
		}

		$subtitle = esc_attr( $instance['subtitle'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $subtitle ) ) {
			$subtitle = $placeholders['subtitle'];
		}
		$number_of_items = esc_attr( $instance['number_of_items'] ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" placeholder="<?php echo esc_attr( $placeholders['title'] ); ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php esc_html_e( 'Subtitle:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo $subtitle; ?>" placeholder="<?php echo esc_attr( $placeholders['subtitle'] ); ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number_of_items' ); ?>"><?php esc_html_e( 'Number of items to show:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number_of_items' ); ?>" name="<?php echo $this->get_field_name( 'number_of_items' ); ?>" type="number" value="<?php echo $number_of_items; ?>"/>
		</p>
		<?php
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                    = $old_instance;
		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['subtitle']        = strip_tags( $new_instance['subtitle'] );
		$instance['number_of_items'] = strip_tags( $new_instance['number_of_items'] );
		//some sanity check
		if ( intval( $instance['number_of_items'] ) < 1 ) {
			$instance['number_of_items'] = '1';
		}

		return $instance;
	}

	private function get_placeholder_strings() {
		$placeholders = apply_filters( 'front_page_recent_posts_widget_backend_placeholders', array() );

		$placeholders = wp_parse_args(
			(array) $placeholders,
			array(
				'title'    => esc_html__( 'Latest Posts', 'listable' ),
				'subtitle' => esc_html__( 'Fresh articles from the blog', 'listable' )
			) );

		return $placeholders;
	}

} // class Front_Page_Recent_Posts_Widget

class Front_Page_Spotlights_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'front_page_spotlights', // Base ID
			'&#x1f535; ' . esc_html__( 'Front Page', 'listable' ) . ' &raquo; ' . esc_html__( 'Spotlights', 'listable' ), // Name
			array(
				'description' => esc_html__( 'Emphasize some features of your website or use it as a step-by-step explaining process.', 'listable' ),
			), // Args
			array()
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		echo $args['before_widget'];

		$placeholders = $this->get_placeholder_strings();
		//only put in the default title if the user hasn't saved anything in the database e.g. $instance is empty (as a whole)
		$widget_title    = apply_filters( 'widget_title', empty( $instance ) ? $placeholders['widget_title'] : $instance['widget_title'], $instance, $this->id_base );
		$widget_subtitle = empty( $instance ) ? $placeholders['widget_subtitle'] : $instance['widget_subtitle']; ?>

		<h3 class="widget_title  widget_title--frontpage">
			<?php
			echo $widget_title;
			if ( ! empty( $widget_subtitle ) ) { ?>
				<span class="widget_subtitle  widget_subtitle--frontpage"><?php echo $widget_subtitle; ?></span>
			<?php } ?>
		</h3>

		<?php
		if ( ! isset( $instance['spotlights_value'] ) || empty ( $instance['spotlights_value'] ) ) {
			echo $args['after_widget'];

			return;
		}

		$spotlights = json_decode( $instance['spotlights_value'] );

		if ( ! empty( $spotlights ) ) : ?>

		<div class="grid  grid--widget">
			<?php foreach ( $spotlights as $key => $spotlight ) : ?>
				<div class="grid__item  grid__item--widget">
					<div class="card  card--post  card--feature  card--widget">
						<div class="card__content">
							<?php if ( isset( $spotlight->image ) && ! empty( $spotlight->image ) ) {

								$url = wp_get_attachment_image_src( $spotlight->image, 'medium', false );
								if ( isset( $url[0] ) && ! empty( $url[0] ) ) {
									listable_display_image( $url[0], '', true, $spotlight->image );
								}
							}

							if ( isset( $spotlight->title ) && ! empty( $spotlight->title ) ) { ?>
								<div class="card__title"><?php echo $spotlight->title; ?></div>
							<?php }

							if ( isset( $spotlight->desc ) && ! empty( $spotlight->desc ) ) {
								echo $spotlight->desc;
							} ?>
						</div><!-- .card__content -->
					</div><!-- .card.card--post.card--feature -->
				</div><!-- .grid__item -->

			<?php endforeach; ?>
		</div><!-- .grid -->

		<?php endif; ?>
		<?php echo $args['after_widget'];
	}

	public function form( $instance ) {
		$original_instance = $instance;

		//Defaults
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'widget_title'    => '',
				'widget_subtitle' => '',
			) );

		$placeholders = $this->get_placeholder_strings();

		$widget_title = esc_html( $instance['widget_title'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $widget_title ) ) {
			$widget_title = $placeholders['widget_title'];
		}

		$widget_subtitle = esc_html( $instance['widget_subtitle'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $widget_subtitle ) ) {
			$widget_subtitle = $placeholders['widget_subtitle'];
		}

		wp_enqueue_media();
		wp_enqueue_style( 'group_panel_widget_script', get_template_directory_uri() . '/assets/css/admin/group_panel_widget.css' );

		wp_enqueue_script( 'group_panel_widget_script', get_template_directory_uri() . '/assets/js/admin/group_panel_widget.js', array(
			'jquery',
			'jquery-ui-sortable',
			'media-upload',
			'media-views',
		) );

		wp_localize_script(
			'group_panel_widget_script',
			'ListableSpotlightsWidget',
			array(
				'l10n' => array(
					'frameTitle'      => esc_html__( 'Select an Image', 'listable' ),
					'frameUpdateText' => esc_html__( 'Update Image', 'listable' ),
				),
			)
		);

		$count         = "{{{counter}}}";
		$current_value = '';

		if ( isset( $instance['spotlights_value'] ) ) {
			$current_value = $instance['spotlights_value'];
			$spotlights    = json_decode( $current_value );

		} ?>

		<div class="spotlight_widget">
			<div id="<?php echo $this->get_field_id( 'spotlights_value' ); ?>_wrapper" class="group_panel_widget_wrapper">
			<input type="hidden" class="spotlight_values" id="<?php echo $this->get_field_id( 'spotlights_value' ); ?>" name="<?php echo $this->get_field_name( 'spotlights_value' ); ?>" value='<?php echo $current_value; ?>'>
			<input type="hidden" class="spotlight_widget_id" name="<?php echo $this->get_field_name( 'spotlight_widget_id' ); ?>" value="<?php echo $this->id_base; ?>">

			<p>
				<label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php esc_html_e( 'Main Title:', 'listable' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" value="<?php echo $widget_title; ?>" placeholder="<?php echo esc_attr( $placeholders['widget_title'] ); ?>"/>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'widget_subtitle' ); ?>"><?php esc_html_e( 'Main Subtitle:', 'listable' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'widget_subtitle' ); ?>" name="<?php echo $this->get_field_name( 'widget_subtitle' ); ?>" type="text" value="<?php echo $widget_subtitle; ?>" placeholder="<?php echo esc_attr( $placeholders['widget_subtitle'] ); ?>"/>
			</p>


			<div class="group_panel_widget_list">

				<?php if ( ! empty( $spotlights ) ) :
					foreach ( $spotlights as $key => $spotlight ) :
						if ( ! wp_attachment_is_image( $spotlight->image ) ) {
							$spotlight->image = false;
						} ?>

						<div class="group_panel_widget_spotlight" data-count="<?php echo $key; ?>">
							<span class="drag_here">...</span>

							<p class="listable-spotlights-widget-image-control<?php echo ( $spotlight->image ) ? ' has-image' : ''; ?>"
							   data-title="<?php esc_attr_e( 'Select an Image', 'listable' ); ?>"
							   data-update-text="<?php esc_attr_e( 'Update Image', 'listable' ); ?>"
							   data-target="listable-spotlight-<?php echo $key ?>-image-id">
								<?php
								if ( ! empty( $spotlight->image ) ) {
									echo wp_get_attachment_image( $spotlight->image, 'medium', false );
								} ?>
								<input data-field="image" type="hidden" value="<?php echo $spotlight->image; ?>" class="listable-spotlight-<?php echo $key ?>-image-id">
								<a class="button listable-spotlights-widget-image-control__choose" href="#"><?php esc_html_e( 'Select an Image', 'listable' ); ?></a>
							</p>

							<p>
								<label for="title"><?php esc_html_e( 'Title:', 'listable' ) ?></label>
								<input data-field="title" type="text" value="<?php echo esc_html( $spotlight->title ); ?>">
							</p>

							<p>
								<label for="desc"><?php esc_html_e( 'Content:', 'listable' ) ?></label>
								<br/>
								<textarea data-field="desc" cols="20" rows="5"><?php echo esc_html( $spotlight->desc ); ?></textarea>
							</p>
						</div>

					<?php endforeach;
				endif; ?>

			</div><!-- .group_panel_widget_list -->

			<span class="button button-secondary add_spotlights"><?php esc_html_e( 'Add Spotlight', 'listable' ) ?></span>

			<div id="spotlight_template" class="hidden">
				<div class="group_panel_widget_spotlight" data-count="<?php echo $count ?>">
					<span class="drag_here">...</span>

					<p class="listable-spotlights-widget-image-control"
					   data-title="<?php esc_attr_e( 'Select an Image', 'listable' ); ?>"
					   data-update-text="<?php esc_attr_e( 'Update Image', 'listable' ); ?>"
					   data-target="listable-spotlight-<?php echo $count ?>-image-id">

						<input data-field="image" type="hidden" value="" class="listable-spotlight-<?php echo $count ?>-image-id">
						<a class="button listable-spotlights-widget-image-control__choose" href="#"><?php esc_html_e( 'Choose an Image', 'listable' ); ?></a>
					</p>

					<p>
						<label for="title"><?php esc_html_e( 'Title:', 'listable' ) ?></label>
						<input data-field="title" type="text">
					</p>

					<p>
						<label for="desc"><?php esc_html_e( 'Content:', 'listable' ) ?></label>
						<br/>
						<textarea data-field="desc" cols="20" rows="5"></textarea>
					</p>
				</div>
			</div><!-- #spotlight_template -->
		</div><!-- .group_panel_widget_wrapper -->
		</div>
		<?php
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                        = $old_instance;
		$instance['widget_title']        = strip_tags( $new_instance['widget_title'], true );
		$instance['widget_subtitle']     = strip_tags( $new_instance['widget_subtitle'], true );
		$instance['spotlight_widget_id'] = strip_tags( $new_instance['spotlight_widget_id'] );
		$instance['spotlights_value']    = balanceTags( $new_instance['spotlights_value'], true );

		return $instance;
	}

	private function get_placeholder_strings() {
		$placeholders = apply_filters( 'front_page_spotlights_widget_backend_placeholders', array() );

		$placeholders = wp_parse_args(
			(array) $placeholders,
			array(
				'widget_title'    => esc_html__( 'How It Works', 'listable' ),
				'widget_subtitle' => esc_html__( '', 'listable' )
			) );

		return $placeholders;
	}

} // class Front_Page_Spotlights_Widget

class Front_Page_Listing_Regions_Widget extends WP_Widget {

	private $defaults = array(
		'title'           => '',
		'subtitle'        => '',
		'number_of_items' => '4',
		'orderby'         => 'name',
		'regions_slug'    => ''
	);

	function __construct() {
		parent::__construct(
			'front_page_listing_regions', // Base ID
			'&#x1f535; ' . esc_html__( 'Front Page', 'listable' ) . ' &raquo; ' . esc_html__( 'Listing Regions', 'listable' ), // Name
			array( 'description' => esc_html__( 'Display a list of listing regions based on different criteria (eg. most popular, random) or specify which ones you want to show.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;

		$placeholders = $this->get_placeholder_strings();

		//only put in the default title if the user hasn't saved anything in the database e.g. $instance is empty (as a whole)
		$title                = apply_filters( 'widget_title', empty( $instance ) ? $placeholders['title'] : $instance['title'], $instance, $this->id_base );
		$subtitle             = empty( $instance ) ? $placeholders['subtitle'] : $instance['subtitle'];
		$number_of_items      = empty( $instance['number_of_items'] ) ? $this->defaults['number_of_items'] : $instance['number_of_items'];
		$orderby              = empty( $instance['orderby'] ) ? $this->defaults['orderby'] : $instance['orderby'];
		$regions_slug         = empty( $instance['regions_slug'] ) ? $this->defaults['regions_slug'] : $instance['regions_slug'];
		$term_list            = array();
		$custom_region_labels = array();

		//first let's do only one query and get all the terms - we will reuse this info to avoid multiple queries
		$query_args = array( 'order' => 'DESC', 'hide_empty' => false, 'hierarchical' => true, 'pad_counts' => true );
		if ( ! empty( $orderby ) && is_string( $orderby ) ) {
			$query_args['orderby'] = $orderby;
		}

		$all_terms = get_terms(
			'job_listing_region',
			$query_args
		);

		//bail if there was an error
		if ( is_wp_error( $all_terms ) ) {
			return;
		}

		//now create an array with the category slug as key so we can reference/search easier
		$all_regions = array();
		foreach ( $all_terms as $key => $term ) {
			$all_regions[ $term->slug ] = $term;
		}

		echo $args['before_widget'];

		//if we have received a list of regions to display (their slugs and optional label), use that
		if ( ! empty( $regions_slug ) && is_string( $regions_slug ) ) {
			$regions = explode( ',', $regions_slug );
			foreach ( $regions as $key => $region ) {
				if ( strpos( $region, '(' ) !== false ) {
					$region    = explode( '(', $region );
					$term_slug = trim( $region[0] );

					if ( substr( $region[1], - 1, 1 ) == ')' ) {
						$custom_region_labels[ $term_slug ] = trim( substr( $region[1], 0, - 1 ) );
					}

					if ( array_key_exists( $term_slug, $all_regions ) ) {
						$term_list[] = $all_regions[ $term_slug ];
					}
				} else {
					$term_slug = trim( $region );
					if ( array_key_exists( $term_slug, $all_regions ) ) {
						$term_list[] = $all_regions[ $term_slug ];
					}
				}
			}

			//now if the user has chosen to sort these according to the number of posts, we should do that
			// since we will, by default, respect the order of the regions he has used
			if ( 'count' == $orderby ) {
				// Define the custom sort function
				function sort_by_post_count( $a, $b ) {
					return $a->count < $b->count;
				}

				// Sort the multidimensional array
				usort( $term_list, "sort_by_post_count" );
			} elseif ( 'rand' == $orderby ) {
				//randomize things a bit if this is what the user ordered
				shuffle( $term_list );
			}

		} else {
			//it seems we will have to figure out ourselves what categories to display

			if ( ! $number_of_items = intval( $number_of_items ) ) {
				$number_of_items = 4;
			}

			$term_list = array_slice( $all_regions, 0, $number_of_items );
		}

		if ( ! empty( $term_list ) ) { ?>

			<h3 class="widget_title  widget_title--frontpage">
				<?php
				echo $title;
				if ( ! empty( $subtitle ) ) { ?>
					<span class="widget_subtitle  widget_subtitle--frontpage">
						<?php echo $subtitle; ?>
					</span>
				<?php } ?>
			</h3>

			<div class="categories-wrap--widget">
				<ul class="categories--widget">

					<?php foreach ( $term_list as $key => $term ) :

						if ( ! $term ) {
							continue;
						}

						$icon_url      = listable_get_term_icon_url( $term->term_id );
						$image_url     = listable_get_term_image_url( $term->term_id, 'listable-card-image' );
						$attachment_id = listable_get_term_icon_id( $term->term_id );
						$image_src = '';

						if ( ! empty( $image_url ) ) {
							$image_src = $image_url;
						} else {
							$thumbargs     = array(
								'posts_per_page' => 1,
								'post_type'      => 'job_listing',
								'orderby'        => 'rand',
								'meta_key'       => 'main_image',
								'tax_query'      => array(
									array(
										'taxonomy' => 'job_listing_region',
										'field'    => 'name',
										'terms'    => $term->name
									),
								)
							);
							$latest_thumb  = new WP_Query( $thumbargs );

							if ( $latest_thumb->have_posts() ) {
								//get the first image in the listing's gallery or the featured image, if present
								$image_ID  = listable_get_post_image_id( $latest_thumb->post->ID );
								$image_src = '';
								if ( ! empty( $image_ID ) ) {
									$image     = wp_get_attachment_image_src( $image_ID, 'medium' );
									$image_src = $image[0];
								}
							}
						} ?>

						<li <?php echo empty( $icon_url ) ? 'class="no-icon"' : '';  ?>>

							<div class="category-cover" style="background-image: url(<?php echo listable_get_inline_background_image( $image_src ); ?>)">
								<a href="<?php echo esc_url( get_term_link( $term ) ); ?>">
									<?php if ( ! empty( $icon_url ) ) : ?>

										<div class="category-icon">

											<?php listable_display_image( $icon_url, '', true, $attachment_id ); ?>

											<span class="category-count">
												<?php echo $term->count; ?>
											</span>
										</div>

									<?php endif; ?>

									<span class="category-text"><?php echo isset( $custom_region_labels[ $term->slug ] ) ? $custom_region_labels[ $term->slug ] : $term->name; ?></span>
								</a>
							</div>
						</li>

					<?php endforeach; ?>

				</ul><!-- .categories -->
			</div><!-- .categories-wrap -->
			<?php
		}

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return null
	 */
	public function form( $instance ) {
		$original_instance = $instance;
		//Defaults
		$instance = wp_parse_args(
			(array) $instance,
			$this->defaults );

		$placeholders = $this->get_placeholder_strings();

		$title = esc_attr( $instance['title'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $title ) ) {
			$title = $placeholders['title'];
		}

		$subtitle = esc_attr( $instance['subtitle'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $subtitle ) ) {
			$subtitle = $placeholders['subtitle'];
		}
		$number_of_items = esc_attr( $instance['number_of_items'] );
		$regions_slug    = esc_attr( $instance['regions_slug'] ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" placeholder="<?php echo esc_attr( $placeholders['title'] ); ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php esc_html_e( 'Subtitle:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo $subtitle; ?>" placeholder="<?php echo esc_attr( $placeholders['subtitle'] ); ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number_of_items' ); ?>"><?php esc_html_e( 'Number of items to show:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number_of_items' ); ?>" name="<?php echo $this->get_field_name( 'number_of_items' ); ?>" type="number" value="<?php echo $number_of_items; ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e( 'Order by:', 'listable' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id( 'orderby' ); ?>" class="widefat">
				<option value="name"<?php selected( $instance['orderby'], 'name' ); ?>><?php esc_html_e( 'Default', 'listable' ); ?></option>
				<option value="count"<?php selected( $instance['orderby'], 'count' ); ?>><?php esc_html_e( 'Number of Listings', 'listable' ); ?></option>
				<option value="rand"<?php selected( $instance['orderby'], 'rand' ); ?>><?php esc_html_e( 'Random', 'listable' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'regions_slug' ); ?>"><?php esc_html_e( 'Regions Slug(optional):', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'regions_slug' ); ?>" name="<?php echo $this->get_field_name( 'regions_slug' ); ?>" type="text" value="<?php echo $regions_slug; ?>"/>
		</p>
		<?php
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		//this number can't be lower than 1
		$instance['number_of_items'] = strip_tags( $new_instance['number_of_items'] );
		if ( intval( $instance['number_of_items'] ) < 1 ) {
			$instance['number_of_items'] = '1';
		}
		$instance['regions_slug'] = strip_tags( $new_instance['regions_slug'] );

		if ( in_array( $new_instance['orderby'], array( 'name', 'count', 'rand' ) ) ) {
			$instance['orderby'] = $new_instance['orderby'];
		} else {
			$instance['orderby'] = 'name';
		}

		return $instance;
	}

	private function get_placeholder_strings() {
		$placeholders = apply_filters( 'front_page_listing_regions_widget_backend_placeholders', array() );

		$placeholders = wp_parse_args(
			(array) $placeholders,
			array(
				'title'    => esc_html__( 'Where are you going next?', 'listable' ),
				'subtitle' => esc_html__( 'Find the best places to spend your time, near you or in any location around the world.', 'listable' )
			) );

		return $placeholders;
	}

} // class Front_Page_Listing_Categories_Widget
