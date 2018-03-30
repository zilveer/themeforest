<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( version_compare( WOOCOMMERCE_VERSION, "2.6.0" ) >= 0 ) {

?>
	<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	
		<div id="comment-<?php comment_ID(); ?>" class="comment_container">
	
			<div class="comment-details">
				<?php
				/**
				 * The woocommerce_review_before_comment_meta hook.
				 *
				 * @hooked woocommerce_review_display_rating - 10
				 */
				do_action( 'woocommerce_review_before_comment_meta', $comment );
				?>
	
				<?php
				/**
				 * The woocommerce_review_before hook
				 *
				 * @hooked woocommerce_review_display_gravatar - 10
				 */
				do_action( 'woocommerce_review_before', $comment );
				?>
				
				<div class="author" itemprop="author"><?php comment_author(); ?></div>
	
				<time class="date" itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></time>
			</div>
	
			<div class="comment-text">
	
				<?php do_action( 'woocommerce_review_meta', $comment ); ?>
	
				<div itemprop="description" class="description">
	
				<?php 
	
				do_action( 'woocommerce_review_before_comment_text', $comment );
	
				/**
				 * The woocommerce_review_comment_text hook
				 *
				 * @hooked woocommerce_review_display_comment_text - 10
				 */
				do_action( 'woocommerce_review_comment_text', $comment );
	
				do_action( 'woocommerce_review_after_comment_text', $comment ); ?>
					
				</div>
			</div>
		</div>
<?php } else {
	$comment_id = $comment->comment_ID;
	
	$rating = intval( get_comment_meta( $comment_id, 'rating', true ) );
	$comment_title = get_comment_meta( $comment_id, 'title', $single = true );
	
	?>
	<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	
		<div id="comment-<?php comment_ID(); ?>" class="comment_container">
	
			<div class="comment-details">
				<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
	
					<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating clearfix" title="<?php echo sprintf( __( 'Rated %d out of 5', 'swiftframework' ), $rating ) ?>">
						<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo esc_attr($rating); ?></strong> <?php _e( 'out of 5', 'swiftframework' ); ?></span>
					</div>
	
				<?php endif; ?>
				
				<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '' ); ?>
				
				<div class="author" itemprop="author"><?php comment_author(); ?></div>
	
				<time class="date" itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( __( get_option( 'date_format' ), 'swiftframework' ) ); ?></time>
			</div>
	
			<div class="comment-text">
	
				<?php if ( $comment->comment_approved == '0' ) : ?>
	
					<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'swiftframework' ); ?></em></p>
	
				<?php else : ?>
	
					<p class="meta">
						<?php
							if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' ) {
								if ( function_exists( 'wc_review_is_from_verified_owner' ) ) {
									$verified = wc_review_is_from_verified_owner( $comment_id );	
									if ( $verified ) {
										echo '<em class="verified">(' . __( 'verified owner', 'swiftframework' ) . ')</em> ';
									}
								}
							}
						?>
					</p>
	
				<?php endif; ?>
	
				<div itemprop="description" class="description">
	
					<?php if ( isset( $comment_title ) && $comment_title != "" ) { ?>
	
						<h4><?php echo esc_attr($comment_title); ?></h4>
	
					<?php } ?>
	
					<?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>
		
					<div itemprop="description" class="description"><?php comment_text(); ?></div>
		
					<?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>
					
				</div>
			</div>
		</div>

<?php } ?>
