<?php

	/* SETUP THE COMMENTS SECTION
	================================================== */
	?>
	<div id="comments">
	<?php
	    $req = get_option('require_name_email'); // Checks if fields are required.
	    if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
	        die ( 'Please do not load this page directly. Thanks!' );
	    if ( post_password_required() ) :
	?>
	</div><!-- .comments -->
	<?php
	        return;
	    endif;


	/* DISPLAY THE COMMENTS
	================================================== */
	?>

	<div id="comments-list" class="comments">
		<div class="title-wrap">
			<h2 class="spb-heading"><span><?php comments_number(__('Comments (0)', "swiftframework"), __('Comment (1)', "swiftframework"), __('Comments (%)', "swiftframework") ); ?></span></h2>
		</div>

		<?php if ( have_comments() ) :

			$ping_count = $comment_count = 0;
			foreach ( $comments as $comment )
		    get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
			if ( ! empty($comments_by_type['comment']) ) { ?>
					<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>
						<div id="comments-nav-above" class="comments-navigation">
							<div class="paginated-comments-links clearfix"><?php paginate_comments_links(array('type'=>'list','prev_text'=> __('<i class="sf-icon-chevron-prev"></i> Previous', 'swiftframework'),
								'next_text'    => __('Next <i class="sf-icon-chevron-next"></i>', 'swiftframework'))); ?></div>
						</div><!-- #comments-nav-above -->
					<?php endif; ?>
					<ol>
						<?php wp_list_comments('type=comment&callback=sf_custom_comments'); ?>
					</ol>
					<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>
						<div id="comments-nav-below" class="comments-navigation">
							<div class="paginated-comments-links comments-links-after clearfix"><?php paginate_comments_links(array('type'=>'list','prev_text'=> __('<i class="sf-icon-chevron-prev"></i> Previous', 'swiftframework'),
								'next_text'    => __('Next <i class="sf-icon-chevron-next"></i>', 'swiftframework'))); ?></div>
						</div><!-- #comments-nav-below -->
					<?php endif; ?>
			<?php } if (!empty($comments_by_type['pingback'])) { ?>
			
				<h3 class="spb-heading"><span><?php _e("Pingbacks", "swiftframework"); ?></span></h3>
				<ol id="pingback-list">
					<?php wp_list_comments('type=pingback&callback=sf_custom_comments'); ?>
				</ol>
			
			<?php } ?>

		<?php endif /* if ( $comments ) */ ?>

	</div><!-- #comments-list .comments -->

	<?php


	/* COMMENT ENTRY FORM
	================================================== */
	?>

	<?php if ( 'open' == $post->comment_status ) : ?>
		<div id="respond-wrap">
			<?php
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true'" : '' );
				$fields =  array(
					'author' => '<div class="row"><p class="comment-form-author col-sm-4"><label for="author">' . __( 'Name', 'swiftframework' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="'.__( 'Author', 'swiftframework' ).'" /></p>',
					'email' => '<p class="comment-form-email col-sm-4"><label for="email">' . __( 'Email', 'swiftframework' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="'.__( 'Email', 'swiftframework' ).'" /></p>',
					'url' => '<p class="comment-form-url col-sm-4"><label for="url">' . __( 'Website', 'swiftframework' ) . '</label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'.__( 'Website', 'swiftframework' ).'" /></p></div>'
				);
				$comments_args = array(
				    'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
				    'logged_in_as'		   => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'swiftframework' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				    'title_reply'          => __( 'Leave a reply', 'swiftframework' ),
				    'title_reply_to'       => __( 'Leave a reply to %s', 'swiftframework' ),
				    'cancel_reply_link'    => __( 'Click here to cancel the reply', 'swiftframework' ),
				    'label_submit'         => __( 'Post comment', 'swiftframework' ),
				    'comment_field'		   => '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'swiftframework' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . __( 'Comment', 'swiftframework' ) . '" aria-required="true"></textarea></p>',
				    'must_log_in'		   => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'swiftframework' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				);
			?>

			<?php comment_form($comments_args); ?>
		</div>
	<?php endif /* if ( 'open' == $post->comment_status ) */ ?>
	</div><!-- #comments -->