<?php
/**
 * WP Job Manager
 */

class Listify_WP_Job_Manager_Reviews extends Listify_Integration {

	public function integration() {
		return 'wp-job-manager-reviews';
	}

	public function __construct() {
		$this->includes = array();
		$this->integration = 'wp-job-manager-reviews';

		parent::__construct();
	}

	public function setup_actions() {
        add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_scripts' ), 11 );

		add_action( 'single_job_listing_meta_start', array( $this, 'the_rating' ), 40 );
		add_action( 'listify_content_job_listing_footer', array( $this, 'the_rating' ) );
		add_action( 'listify_listings_by_term_after', array( $this, 'the_rating' ) );

		add_filter( 'listify_listing_data', array( $this, 'listing_data' ), 30 );

		add_filter( 'get_comment_text', array( $this, 'review_comment_text' ), 11, 3 );

		add_action( 'listify_output_customizer_css', array( $this, 'css' ) );
	}

    public function dequeue_scripts() {
        wp_dequeue_style( 'wp-job-manager-reviews' );
    }

	public function review_comment_text( $content, $comment, $args ) {
		if ( 0 != $comment->comment_parent || ! is_singular( 'job_listing' ) ) {
			return $content;
		}

		ob_start();
	?>
		<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="comment-rating">
			<span itemprop="ratingValue"><?php echo number_format( WPJMR()->review->average_rating_review( $comment->comment_ID ), 1, '.', ',' ); ?></span>
		</div>
	<?php
		$average = ob_get_clean();

		return $average . $content;
	}

	public function the_rating( $comment ) {
		global $post;

		$number = WPJMR()->review->review_count( $post->ID );
		$number = number_format( $number, 1, '.', ',' );
		$value  = number_format( WPJMR()->review->average_rating_listing( $post->ID ), 1, '.', ',' );
		$stars  = WPJMR()->review->get_stars( $post->ID );
	?>
		<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" class="rating-<?php echo floor( $value ); ?> job_listing-rating-wrapper" title="<?php printf( '%d Reviews', $number ); ?>">
			<span class="job_listing-rating-stars">
				<?php echo $stars; ?>
			</span>

			<span class="job_listing-rating-average">
				<span itemprop="ratingValue"><?php echo $value; ?></span>
				<meta itemprop="bestRating" content="<?php echo absint( WPJMR()->wpjmr_get_count_stars() ); ?>"/>
				<meta itemprop="worstRating" content="1"/>
			</span>
			<span class="job_listing-rating-count">
				<?php printf( _n( '<span itemprop="ratingCount">%1$d</span> Review', '<span itemprop="ratingCount">%d</span> Reviews', $number, 'listify' ), $number ); ?>
			</span>
		</div>
	<?php
	}

	public function listing_data( $data ) {
		global $post;

		$rating = WPJMR()->review->average_rating_listing( $post->ID );

		$data[ 'rating' ] = sprintf( _n( '%d Star', '%d Stars', $rating, 'listify' ), $rating );

		return $data;
	}

	public function css() {
		$css = new Listify_Customizer_CSS();

		$css->add( array(
			'selectors' => array(
				'#wpjmr-submit-ratings .star-rating .dashicons-star-filled',
				'#wpjmr-list-reviews .star-rating .dashicons-star-filled',
				'.stars-rating .dashicons.dashicons-star-filled',
				'#wpjmr-submit-ratings .choose-rating .star:hover',
				'#wpjmr-submit-ratings .choose-rating .star:hover ~ .star',
				'#wpjmr-submit-ratings .choose-rating .star.active',
				'#wpjmr-submit-ratings .choose-rating .star.active ~ .star'
			),
			'declarations' => array(
				'color' => listify_theme_color( 'color-primary' )
			)
		) );
	}

}

$GLOBALS[ 'listify_job_manager_reviews' ] = new Listify_WP_Job_Manager_Reviews();
