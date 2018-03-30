<div class="clearfix"></div><hr class="sexy_line"/>

<section id="comments">

	<?php if (post_password_required()) : ?>
		<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'spritz' ); ?></p>

		</section> <!-- END: comments if password protected -->
	<?php return; endif; ?>

	<?php if (have_comments()) : ?>

		<?php # Enable the below link if you want the comment title ?>
		<?php # <h3 class="comments-title"><?php comments_number(); ></h3> ?>

		<ol class="commentlist">
			<?php wp_list_comments( 'type=comment&callback=spritzcomments' ); // Custom callback in functions.php ?>
		</ol>

		<?php if ( $pagination = paginate_comments_links( array( 'echo' => false ) ) ) { ?>
			<nav id="pagination"><?php echo $pagination; ?></nav>
		<?php } ?>

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<!--<p class="center"><?php _e( 'Comments are closed here.', 'spritz' ); ?></p>-->

	<?php endif; ?>

	<?php comment_form(); ?>

</section> <!-- END: comments if not password protected -->