<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 * 
 * @cmsms_package 	EcoNature
 * @cmsms_version 	1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '70' ), '', get_comment_author() ); ?>

		<div class="comment-text">
		<?php
			cmsms_woocommerce_rating('cmsms-icon-star-empty', 'cmsms-icon-star-1', true, $comment->comment_ID);
			
			
			if ( $comment->comment_approved == '0' ) : 
		?>
				<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></p>
		<?php 
			else : 
		?>
				<div class="meta">
					<h5 itemprop="author"><?php comment_author(); ?></h5>
					<?php
						if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
							if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
								echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';
					?> 
					<time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>">
						<?php echo get_comment_date( __( get_option( 'date_format' ), 'woocommerce' ) ); ?>
					</time>
				</div>

		<?php 
			endif; 
		?>
			<div itemprop="description" class="description"><?php comment_text(); ?></div>
		</div>
	</div>
