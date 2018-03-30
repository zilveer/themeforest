<?php
/* commentlist */
function retro_commentlist( $comment, $args, $depth ) {
	$GLOBALS[ 'comment' ] = $comment;
	extract( $args, EXTR_SKIP );
?>
	
	<!-- comment -->
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'clear' ) ?>>
		
		<!-- meta -->
		<div class="comment-author vcard">
			
			<!-- picture -->
			<?php
			if ( $args[ 'avatar_size' ] )
				echo get_avatar( $comment, 90 );
			?>
			
			<!-- name -->
			<span class="comment-name enbold"><?php comment_author_link(); ?></span>
			
			<?php if ( $comment->comment_approved == '0' ) : ?>
			
			<strong><em><?php _e( 'This comment has not been approved yet.', 'openframe' ); ?></em></strong>
				
			<?php else : ?>
			
			<!-- date -->
			// <time datetime="<?php echo get_comment_date( DATE_W3C ); ?>"><?php comment_date(); ?> - <?php comment_time(); ?></a></time>
						
			<!-- reply -->
			// <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ) ); ?>
			
			<?php endif; ?>

		</div>
		<!-- end: meta -->
		
		<!-- comment -->
		<div class="comment-content">
			
			<?php comment_text(); ?>
										
		</div>
		<!-- end: comment -->
	
	</li>
	<!-- end: comment -->

<?php
}
?>