<?php
/**
* The template for displaying Comments.
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

if ( post_password_required() ) : ?>

	<p class="nocomments">
		<?php _e('This post is password protected. Enter the password to view comments.','van'); ?>
	</p>
	
<?php return; endif ;?>

<?php if ( comments_open() ): ?>
	
	<section id="comments" class="content">

		<?php if ( have_comments() ): ?>

			<div id="comments-list">

				<div id="comments-list-head" class="clearfix">
					<h3 id="comments-title" class="row-title"><?php comments_number(__('No comments','van'), __('One comment','van'), '% ' . __('Comments','van') );?></h3>
					<a href="#respond" id="respond-link" > <?php _e( 'Leave a comment', 'van' ) ?></a>
				</div>

				<ol class="commentslist">
					<?php
						wp_list_comments( array(
							'style'       => 'ol',
							'short_ping'  => true,
							'callback'=>'van_custom_comments'
						) );
					?>
				</ol><!-- .comment-list -->
			
				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :?>
					<nav id="pagination" class="comment-navigation" role="navigation">
						<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'van' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'van' ) ); ?></div>
						<div class="clear"></div>
					</nav><!-- .comment-navigation -->
				<?php endif; ?>

			</div><!-- #comments-list -->

		<?php endif; // have_comments ?>
		
		<div id="comment-form">
		<?php 
			$commenter      = wp_get_current_commenter();
			$req 		      = get_option( 'require_name_email' );
			$aria_req         = ( $req ? " aria-required='true'" : '' );
			$required_text = __(' Required fields are marked', 'van').' <span class="required">*</span>';
			
			comment_form( array(
				'title_reply'           => __( 'Leave a Comment','van' ),
				'title_reply_to'      => __( 'Leave a Reply to %s','van' ),
				'cancel_reply_link' => __( 'Cancel Reply','van' ),
				'label_submit' 	   => __( 'Submit Comment','van' ),
				'comment_field'      => '<p class="comment-form-comment"><label for="comment">' . __( 'Comment','van') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
				'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.','van' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','van' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.','van' ) . ( $req ? $required_text : '' ) . '</p><div class="line"></div>',
				'comment_notes_after'   => '',
				'fields'  => apply_filters( 'comment_form_default_fields', array(
				'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'van' ) . ( $req ? '<span class="required">*</span>' : '' ) . ' </label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
				'email'   => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'van' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
				'url'      => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'van' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>' ) ) ) );
			?>
		</div><!-- #comments-form -->

	</section><!-- #comments -->	

<?php elseif ( !comments_open() && is_single() ) : ?>
	<section id="comments" class="content">
		<p class="no-comments">
			<?php _e( 'Comments are closed.' , 'van' ); ?>
		</p>
	</section><!-- #comments -->
<?php endif; ?>