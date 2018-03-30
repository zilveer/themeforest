<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments and the comment
 * form. The formatting of individual comments is handled by the file /inc/raw_comments.php.
 *
 * @package		WordPress
 * @subpackage	Munch
 * @since		Munch 1.0
 **/
 
// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();

if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'Please do not load this page directly.' );
}

if ( !post_password_required() ) {
	
	if ( have_comments() || comments_open() ) { ?>
	
		<?php if (
			isset( $experience_theme_array['post-comments-color-scheme'] )
			&& $experience_theme_array['post-comments-color-scheme'] != ""
		) {		
			$comments_color_scheme = 'color-scheme-'. esc_attr( $experience_theme_array['post-comments-color-scheme'] );
		} else {
			$comments_color_scheme = 'color-scheme-2';
		} ?>
		
		<!-- BEGIN .section-content-wrapper -->		
		<div class="section-content-wrapper padding-top <?php echo esc_attr( $comments_color_scheme ); ?>">
		
			<!-- BEGIN #comments-holder -->
			<div id="comments-holder">
				
				<?php // Comments Header
				if ( have_comments() || comments_open() ) { ?>
					
					<?php if ( is_page() ) {
						$comment_width = 'site-width';
					} else {
						$comment_width = 'narrow-width';
					} ?>
					
					<!-- BEGIN .comments-header -->
					<div class="comments-header padding-h <?php echo esc_attr( $comment_width ); ?>">
						
						<div class="col-padding">
						
							<h3 id="comments-title"><?php esc_html_e( 'Comments', 'experience' ); ?></h3>
							
							<?php if ( !have_comments()	&& comments_open()) { // If comments are open, but there are no comments. ?>
						
								<p><?php esc_html_e( 'Be the first to post a comment.', 'experience' ); ?></p>

							<?php } ?>					
						
							<?php // Comment Pagination
							if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>

								<nav class="comments-navigation clearfix" role="navigation">					
									<div class="next-link"><?php next_comments_link( '<span class="funky-icon-arrow-left"></span>' ); ?></div>
									<div class="prev-link"><?php previous_comments_link( '<span class="funky-icon-arrow-right"></span>' ); ?></div>
								</nav>
							
							<?php } ?>
						
						</div>
						
					</div>
					<!-- END .comments-header -->
					
				<?php } ?>
				
				<?php // Comments
				if ( have_comments() ) { ?>							
				
					<!-- BEGIN .commentlist -->
					<ol id="comments" class="commentlist">
						<?php wp_list_comments( 'callback=experience_comment_list' ); ?>
					</ol>
					<!-- END .commentlist -->
					
				<?php } ?>
				

				<?php // Comment Form
				if ( comments_open() ) { ?>				

					<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) { ?>
					
						<div class="padding-h padding-v <?php echo esc_attr( $comment_width ); ?>">
							<div class="col-padding">
								<p class="comment-login"><?php esc_html_e( 'You must be logged in to post a comment.', 'experience' ); ?></p>
							</div>
						</div>
						
					<?php } else {
					
						$fields =  array(
							'author' => '<p class="comment-form-author">
											<input id="author" name="author" type="text" class="required" value="'. esc_attr( $commenter['comment_author'] ) .'" size="30" placeholder="'. esc_attr__( 'Name', 'experience' ) .'*" />
										</p>',
										
							'email'  => '<p class="comment-form-email">
											<input id="email" name="email" type="text" class="required email" value="'. esc_attr( $commenter['comment_author_email'] ) .'" size="30" placeholder="'. esc_attr__( 'Email', 'experience' ) .'*" />
										</p>',
										
							'url'    => '<p class="comment-form-url">
											<input id="url" name="url" type="text" value="'. esc_attr( $commenter['comment_author_url'] ) .'" size="30" placeholder="'. esc_attr__( 'Website', 'experience' ) .'" />
										</p>'						
						);
						
						comment_form(
							array(
								'logged_in_as'			=>	'<p class="logged-in-as">'. wp_kses( sprintf( __( 'Logged in as %1$s. <a href="%2$s" title="Log out of this account">Log out?</a>', 'experience' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ), array( 'a' => array( 'href' => array(), 'title' => array() ) ) ) .'</p>',
								'comment_notes_after'	=>	false,
								'cancel_reply_link'		=>	'&times;',
								'title_reply'			=>	esc_html__( 'Leave A Comment', 'experience' ),
								'label_submit'			=>	esc_html__( 'Submit', 'experience' ),
								'fields'				=>	$fields,
								'comment_field'			=> '<p class="comment-form-comment"><textarea id="comment" class="required" name="comment" cols="45" rows="8"  aria-required="true" placeholder="'. esc_attr__( 'Comment', 'experience' ) .'*"></textarea></p>'
							)
						);
						
					} // If registration required and not logged in ?>			
					
				<?php } // if comments open ?>

			</div>
			<!-- END #comments-holder -->
		
		</div>
		<!-- END .section-content-wrapper -->	

	<?php }
 
} ?>