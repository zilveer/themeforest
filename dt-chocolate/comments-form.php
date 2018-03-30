<?php
global $current_user;
get_currentuserinfo();
?>

<div id="share_com_top"></div>
<div class="share_com">
	<div class="article_footer_t"></div>
	<div class="article_footer">

		<!-- start -->
		<?php do_action( 'comment_form_before' ); ?>

		<div id="form_prev_holder">
			<div id="form_holder">
					<div id="respond">
					<div class="header"><?php _ex('Share a comment:', 'comments form', LANGUAGE_ZONE); ?></div>

					<?php if ( is_user_logged_in() ) : ?>
						<small><?php
							_ex('You are currently logged in as', 'comments form', LANGUAGE_ZONE);
							sprintf('<a href="%1$s">%2$s</a>',
								trailingslashit( home_url('/author/') . $current_user->user_login ),
								$current_user->user_login
							);
						?></small>
					<?php 
						$commenter = wp_get_current_commenter();
						$c_user = wp_get_current_user();
						$user_identity = ! empty( $c_user->ID ) ? $c_user->display_name : '';

						do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
					else : ?>
						<small><?php _ex('Your email address will not be published. Required fields are marked <span class="required">*</span>', 'comments form', LANGUAGE_ZONE); ?></small>
					<?php endif; // is_user_logged_in ?>

					<form action="<?php echo site_url('/'); ?>wp-comments-post.php" method="post" id="commentform" class="uniform">

						<?php do_action( 'comment_form_top' ); ?>

						<?php do_action( 'comment_form_before_fields' ); ?>

						<?php if ( !is_user_logged_in() ) : ?>

							<div class="i_h">
								<div class="l">
									<input id="author" name="author" type="text" aria-required='true' placeholder="<?php echo esc_attr_x('Name*', 'comments form', LANGUAGE_ZONE); ?>" class="validate[required]" value="<?php if ( isset($current_user->user_login) ) echo $current_user->user_login; ?>" />
								</div>
							</div>

							<div class="i_h">
								<div class="r">
									<input id="email22" name="email" type="text" placeholder="<?php echo esc_attr_x('Email*', 'comments form', LANGUAGE_ZONE); ?>" aria-required='true' class="validate[required,custom[email]]" value="<?php  if ( isset($current_user->user_email) ) echo $current_user->user_email; ?>" />
								</div>
							</div>

							<input type="hidden" id="url" name="url" value="<?php if ( isset($current_user->user_url) ) echo $current_user->user_url; ?>" />

						<?php endif; // !is_user_logged_in ?>

						<div class="t_h"><textarea id="comment" name="comment" class="validate[required]" aria-required="true" placeholder="<?php echo esc_attr_x('Comment*', 'comments form', LANGUAGE_ZONE); ?>"></textarea></div>

						<?php do_action( 'comment_form_after_fields' ); ?>

						<a href="#" id="submit" class="go_button do_add_comment subm_comm go_add_comment"><span><i></i><?php _ex('Add comment', 'comments form', LANGUAGE_ZONE); ?></span></a>
						<a rel="nofollow" id="cancel-comment-reply-link" href="#respond" class="do_clear"><?php _ex('Cancel', 'comments form', LANGUAGE_ZONE); ?></a>

						<?php comment_id_fields(); ?>

						<?php do_action('comment_form', $post->ID); ?>

					</form>

					</div>

				</div>
			</div>

		<?php do_action( 'comment_form_after' ); ?>

		<!-- end -->

	</div>
	<div class="article_footer_b"></div>
</div>
