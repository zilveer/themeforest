<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/comments.php
 * @file	 	1.0
 */
?>
<?php

// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
  	<div class="alert-box password-protected">
    	This post is password protected. Enter the password to view comments.
  	</div>
  	<div class="spacer clearfix"></div>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->

	<div id="reviews">

		<div id="comments" class="clearfix">
			<?php if(comments_open() && have_comments()) : ?>

				<div class="row reviews-intro clearfix">
					<div class="seven columns">
						<h6><?php comments_number('<span class="alert-color">No</span> Responses', '<span class="alert-color">One</span> Response', '<spa class="focus"n>%</span> Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h6>
					</div>
					<div class="five columns text-right clearfix">
						<p class="add_review"><a href="#" class="inline review_form button alert"><em class="icon-chat"></em> <span class="helper"><?php _e('Leave a reply', 'woocommerce'); ?></span></a></p>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>

				<ol class="commentlist clearfix">
					<?php wp_list_comments('type=comment&callback=prostore_comments'); ?>
				</ol>

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
					<nav id="comment-nav" class="navigation clearfix">
						<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav"><em class="icon-left-open"></em></span> Previous', 'prostore-theme' ) ); ?></div>
					  	<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav"><em class="icon-right-open"></em></span>', 'prostore-theme' ) ); ?></div>
					  	<div class="clear"></div>
					</nav>
				<?php endif; ?>

			<?php elseif(comments_open() && !have_comments()) : ?>

				<div class="row reviews-intro clearfix">
					<div class="seven columns">
						<h6><?php comments_number('<span class="alert-color">No</span> Responses', '<span class="alert-color">One</span> Response', '<spa class="focus"n>%</span> Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h6>
					</div>
					<div class="five columns text-right clearfix">
						<p class="add_review"><a href="#" class="inline review_form button alert"><em class="icon-chat"></em> <span class="helper"><?php _e('Leave a reply', 'woocommerce'); ?></span></a></p>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>

			<?php elseif(!comments_open() && have_comments()) : ?>

				<div class="row reviews-intro clearfix">
					<div class="twelve columns clearfix">
						<h6><?php comments_number('<span class="alert-color">No</span> Responses', '<span class="alert-color">One</span> Response', '<spa class="focus"n>%</span> Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h6>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>

				<div class="alert-box">Comments are closed.</div>

				<ol class="commentlist clearfix">
					<?php wp_list_comments('type=comment&callback=prostore_comments'); ?>
				</ol>

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
					<nav id="comment-nav" class="navigation clearfix">
						<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav"><em class="icon-left-open"></em></span> Previous', 'prostore-theme' ) ); ?></div>
					  	<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav"><em class="icon-right-open"></em></span>', 'prostore-theme' ) ); ?></div>
					  	<div class="clear"></div>
					</nav>
				<?php endif; ?>

			<?php endif; ?>







			<?php if ( comments_open() ) : ?>

				</div><div id="review_form_wrapper"><div id="review_form"><div class="row container">

					<section class="respond-form">

					<h3 id="comment-form-title"><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>

					<div id="cancel-comment-reply">
						<p class="small"><?php cancel_comment_reply_link(); ?></p>
					</div>

					<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>

						<div class="alert-box warning">
							<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
						</div>

					<?php else : ?>

						<?php

							echo '<div class="alert-box" id="comment-status"></div>';

							$commenter = wp_get_current_commenter();

							$title_reply = __('Leave a reply', 'woocommerce');

							$comment_form = array(
								'title_reply' => $title_reply,
								'comment_notes_before' => '',
								'comment_notes_after' => '',
								'fields' => array(
												'author' => '<div class="six columns"><p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'woocommerce' ) . '</label> ' . '<span class="required">*</span></p>' .
									            '<div class="row"><div class="twelve columns"><div class="row collapse"><div class="one mobile-one columns input"><span class="prefix"><em class="icon-user"></em></span></div><div class="eleven mobile-three columns input"><input id="author" name="author" type="text" class="dark" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="Your name" /></div></div></div></div></div>',
									'email'  => '<div class="six columns"><p class="comment-form-email"><label for="email">' . __( 'Email', 'woocommerce' ) . '</label> ' . '<span class="required">*</span></p>' .
									            '<div class="row"><div class="twelve columns"><div class="row collapse"><div class="two mobile-one columns"><span class="prefix"><em class="icon-at"></em></span></div><div class="ten mobile-three columns"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" class="dark" placeholder="Your email address" /></div></div></div></div></div>',
								),
								'label_submit' => __('Submit comment', 'woocommerce'),
								'logged_in_as' => '',
								'comment_field' => ''
							);

							if(is_user_logged_in()) {
								global $userdata;
								get_currentuserinfo();

								$comment_form['comment_field'] .= '<div class="one column mobile-one logged_in_user text-right">'.get_avatar( $userdata->ID, 27 ).'</div><div class="eleven mobile-three columns logged_in_user_review clearfix"><p class="comment-form-comment clearfix"><label for="comment">' . __( 'Your comment', 'woocommerce' ) . '</label></p><textarea id="comment" name="comment" class="logged_in_user dark" aria-required="true" placeholder="Your Review"></textarea></div>';

							} else {
								$comment_form['comment_field'] .= '<div class="twelve columns comment-field clearfix"><p class="comment-form-comment clearfix"><label for="comment">' . __( 'Your Review', 'woocommerce' ) . '</label></p><textarea id="comment" name="comment" class="dark" aria-required="true" placeholder="Your Review"></textarea></div>';
							}

							comment_form( $comment_form );

						?>

					<?php endif; // If registration required and not logged in ?>

				</section>

				</div></div>

			<?php endif; // if you delete this the sky will fall on your head ?>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>

	</div>