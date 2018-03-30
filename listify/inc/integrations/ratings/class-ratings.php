<?php
/**
 * Ratings (custom)
 */

class Listify_Ratings extends listify_Integration {

	public function __construct() {
		$this->includes = array(
			'class-comments.php',
			'class-rating.php',
			'class-rating-comment.php',
			'class-rating-listing.php'
		);

		$this->integration = 'ratings';

		parent::__construct();
	}

	public function setup_actions() {
		if ( ! listify_has_integration( 'wp-job-manager-reviews' ) ) {
			add_action( 'comment_form_top', array( $this, 'comment_form_top' ) );
			add_action( 'comment_post', array( $this, 'comment_post' ) );

			add_action( 'wp_set_comment_status', array( $this, 'wp_set_comment_status' ), 10, 2 );

			add_action( 'submit_job_form_save_job_data', array( $this, 'open_comments' ) );

			add_action( 'single_job_listing_meta_start', array( $this, 'the_rating' ), 40 );
			add_action( 'listify_content_job_listing_footer', array( $this, 'the_rating' ) );
			add_action( 'listify_listings_by_term_after', array( $this, 'the_rating' ) );

			add_action( 'listify_comment_meta_after', array( $this, 'output_rating' ) );

			add_filter( 'listify_listing_data', array( $this, 'listing_data' ), 10, 2 );
		}
	}

	/**
	 * Output the star count on the listing data.
	 *
	 * @since 1.4.1
	 * @param array $data
	 * @return array $data
	 */
	public function listing_data( $data, $post ) {
		$rating = new Listify_Rating_Listing( array(
			'object' => $post,
			'object_id' => $post->ID,
		) );

		$data[ 'rating' ] = sprintf( _n( '%d Star', '%d Stars', $rating->output(), 'listify' ), $rating->output() );

		return $data;
	}

	private function get_default_rating() {
		return apply_filters( 'listify_ratings_default_rating', 3 );
	}

	public function comment_form_top() {
		if ( ! is_singular( 'job_listing' ) ) {
			return;
		}

		if ( is_user_logged_in() && ( get_current_user_id() == get_post()->post_author ) ) {
			return;
		}

		$output = array();

		for ( $i = 5; $i > 0; $i-- ) {
			$output[] = sprintf(
				'<a class="star' . ( $i == $this->get_default_rating() ? ' active' : '' ) . '" href="" data-rating="%d"></a>',
				$i
			);
		}

		echo '<p class="star-rating-wrapper comment-form-rating comment-form-rating--listify">';
		echo '<span class="star-rating-label">' . __( 'Your Rating', 'listify' ) . '</span>';
		echo '<span class="stars">';
		echo implode( '', $output );
		echo '</span>';
		echo '</p>';
	}

	public function comment_post( $comment_id ) {
		$comment = get_comment( $comment_id );

		if ( ! empty( $comment->comment_parent ) ) {
			return;
		}

		$rating = isset( $_POST[ 'comment_rating' ] ) ? absint( $_POST[ 'comment_rating' ] ) : false;

		if ( ! $rating || ( get_post( $comment->comment_post_ID )->post_author == get_current_user_id() ) ) {
			return;
		}

		$r_comment = new Listify_Rating_Comment( array(
			'rating' => $rating,
			'object_id' => $comment_id
		) );

		$r_listing = new Listify_Rating_Listing( array(
			'object_id' => $comment->comment_post_ID,
			'rating' => true
		) );
	}

	public function wp_set_comment_status( $comment_id, $comment_status ) {
		if ( ! get_comment( $comment_id ) ) {
			return;
		}

		$update = new Listify_Rating_Listing( array(
			'object_id' => get_comment( $comment_id )->comment_post_ID,
			'rating' => true
		) );
	}

	public function open_comments( $args ) {
		$args[ 'comment_status' ] = 'open';

		return $args;
	}

	/**
	 * Listing Rating
	 *
	 * @since Listify 1.0.0
	 *
	 * @return void
	 */
	public function the_rating() {
		$rating = new Listify_Rating_Listing( array(
			'object_id' => get_post()->ID
		) );
	?>
		<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" class="rating-<?php echo floor(
		$rating->output() ); ?> job_listing-rating-wrapper" title="<?php printf( '%d Reviews', $rating->count() ); ?>">
			<span class="job_listing-rating-stars">
				<?php echo $rating->stars(); ?>
			</span>

			<span class="job_listing-rating-average">
				<span itemprop="ratingValue"><?php echo $rating->output(); ?></span>
				<meta itemprop="bestRating" content="5"/>
				<meta itemprop="worstRating" content="1"/>
			</span>
			<span class="job_listing-rating-count">
				<?php printf( _n( '<span itemprop="ratingCount">%d</span> Review', '<span itemprop="ratingCount">%d</span> Reviews', $rating->count(), 'listify' ), $rating->count() ); ?>
			</span>
		</div>
	<?php
	}

	public function output_rating( $comment ) {
		if ( ! is_singular( 'job_listing' ) ) {
			return;
		}

		if ( 0 != $comment->comment_parent ) {
			return;
		}

		if ( $comment->user_id > 0 && ( $comment->user_id == get_current_user_id() ) ) {
			return;
		}

		if ( $comment->user_id > 0 && ( $comment->user_id == get_post()->post_author ) ) {
			return;
		}
		
		$rating = new Listify_Rating_Comment( array(
			'object_id' => $comment->comment_ID
		) );

		$stars  = $rating->stars();
		$number = $rating->output();
	?>
<div class="single-comment-rating">
    <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="comment-rating">
        <span itemprop="ratingValue"><?php echo $number; ?></span>
    </div>
    <span class="rating-stars"><?php echo $stars; ?></span>
</div>
	<?php
	}

}

$_GLOBALS[ 'listify_ratings' ] = new Listify_Ratings;
