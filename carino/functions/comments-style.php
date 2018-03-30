<?php
/**
* Cutom the comments style . 
* PLEASE DO NOT MODIFY THIS FILE
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

function van_custom_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; 
?>

<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>

	<article id="comment<?php comment_ID() ?>" <?php comment_class(); ?>>
		
		<?php if ( ( function_exists("get_comment_type") && get_comment_type() == "comment" ) ||  !function_exists("get_comment_type") ): ?>
			
			<div class="comment-avatar">
				<?php echo get_avatar( $comment, 64 ); ?>
			</div>

		<?php endif; ?>

		<div class="comment-container">

			<header class="comment-header">

				<?php printf(__('<cite class="fn vcard comment-author">%s</cite>', 'van'), get_comment_author_link()) ?>
				
				<div class="comment-dt">
					<a  class="comment-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php 
								$comment_time = get_comment_date( 'U' );
								if ( ( abs( time() - $comment_time) ) < 86400 ) {
									echo sprintf( __('%s ago','van'), human_time_diff( $comment_time ) );
								}else{ 
									echo date_i18n( __('F d, Y','van'), $comment_time) . __(' at ','van') . date_i18n( __('h:i a','van' ), $comment_time);
								}
							?>
					</a>
					<?php edit_comment_link( __( '(Edit)', 'van' ), '' ); ?>
				</div>

				

			</header>

			<div class="comment-content entry-content">
				
				<?php if ( $comment->comment_approved == '0') : ?>
					<p class="comment-awaiting-moderation">
						<?php _e('Your comment is awaiting moderation.', 'van') ?>
					</p>
				<?php endif; ?>

				<?php comment_text(); ?>

			</div>

			<div class="replay">
				<?php 
					comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
				?>
			</div>

		</div>
	</article>

</li><!-- li.comment -->

<?php } ?>