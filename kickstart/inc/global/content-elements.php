<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Post meta template
*	--------------------------------------------------------------------- 
*/

if ( ! function_exists( 'mnky_post_meta' ) ) :
	function mnky_post_meta(){ ?>
		<?php $hide_meta = ot_get_option( 'hide_meta' ); ?>

			<!-- Date -->
				<?php if(!isset($hide_meta[0])) {
					echo '<span class="post-date"><a href="', the_permalink() .'">' . get_the_date() . '</a></span>';
				} ?>
			<!-- Date END -->
			
			<!-- Author -->
				<?php if(!isset($hide_meta[1])) {
					echo '<span class="post-dauthor">'. __('by', 'kickstart') .' <a href="', get_author_posts_url(get_the_author_meta( 'ID' )) .'">'. get_the_author() .'</a></span>';
				} ?> 
			<!-- Author END -->
			
			<!-- Category -->
				<?php if(!isset($hide_meta[2]) && has_category()) { 
					echo '<span class="post-category">'. __('in ', 'kickstart'). get_the_category_list(', ') .'</span>';
				} ?> 
			<!-- Category END -->
			
			<!-- Comments -->
				<?php if(!isset($hide_meta[3])) {
					echo '<span class="post-comments">';
						comments_popup_link( __( '0 Comments', 'kickstart' ), __( '1 Comment', 'kickstart' ), __( '% Comments', 'kickstart' ), '', __( 'Comments are off', 'kickstart' ) );
					echo '</span>'; 
				} ?> 
			<!-- Comments END -->

			<!-- Tags -->
				<?php if(!isset($hide_meta[4])){ 
					if( has_tag() && is_single() ) {
						the_tags('<div class="post-tags">'. __('Tagged with: ', 'kickstart'), ', ' ,'</div>');
					} 
				} ?> 
			<!-- Tags END -->
			
	<?php }
endif;


/*	
*	---------------------------------------------------------------------
*	MNKY Comments template
*	--------------------------------------------------------------------- 
*/

if ( ! function_exists( 'mnky_comment' ) ) :	
function mnky_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="comment-avatar">
			<?php if ($depth > 1) {
				echo get_avatar( $comment, $size = '35'); 
			} else {
				echo get_avatar( $comment, $size = '55'); 
			} ?> 
		</div>
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrapper">
				<div class="comment-meta">
					<span><?php comment_author_link() ?></span>
					<?php 
						comment_date(); 
						printf( __( ' at %1$s', 'kickstart' ), get_comment_time() ); 
						edit_comment_link( __( ' [Edit]', 'kickstart' ), ' ' ); 
					?>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'reply_text' => '<i class="moon-bubbles-10"></i>',  'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>
				</div>
				
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'kickstart' ); ?></em>
				<?php endif; ?>

				<div class="comment-body">
					<?php comment_text(); ?>
				</div>
	</div><!-- #comment-##  -->

	<?php
		break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="pingback">
		<p><?php _e( 'Pingback:', 'kickstart' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'kickstart' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;
?>