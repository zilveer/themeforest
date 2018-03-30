<?php 

// ---------- COMMENTS ---------- //

function experience_comment_list( $comment, $args, $depth ) {
	
	$GLOBALS['comment'] = $comment; ?>
	
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		
		<?php 
			$admin_class = "";
			if( get_comment_type() == 'comment' ) {

				if ( user_can( $comment->user_id, 'edit_posts' ) ) {
					$admin_class = 'admin-comment';
				}

			} 
		?>
		
		<div class="comment-holder padding-v <?php echo $admin_class; ?>" id="comment-<?php comment_ID(); ?>">
			
			<?php if ( is_page() ) {
				$comment_width = 'site-width';
			} else {
				$comment_width = 'narrow-width';
			} ?>

			<div class="padding-h <?php echo esc_attr( $comment_width ); ?>">
				
				<?php echo get_avatar( $comment, 72 ); ?>
				
				<div class="comment-content-wrapper">
				
					<span class="comment-author"><?php comment_author_link(); ?></span>
					<span class="comment-date"><a href="<?php echo esc_url( get_comment_link( $comment -> comment_ID ) ); ?>"><time datetime="<?php comment_date ('c'); ?>"><span class="funky-icon-time"></span><?php comment_date (); ?> <?php esc_html_e( "at", 'experience' );?> <?php comment_time(); ?></time></a></span>
					
					<div class="comment-content">
					
						<?php if ( $comment->comment_approved == '0' ) {?>
							<p><?php esc_html_e( 'Your comment is awaiting moderation.', 'experience' ); ?></p>
						<?php } ?>
						
						<?php comment_text() ?>
						
					</div>
					
					<div class="comment-reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'login_text' => '', 'reply_text' => esc_html__( 'Reply', 'experience' ) ) ) ); ?>
					</div>
					
				</div>
				
			</div>
		
		</div>
		
<?php } ?>