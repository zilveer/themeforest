<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) {
		echo '<p class="nocomments">This post is password protected. Enter the password to view comments.</p>';
		return;
	}
/* You can start editing here. */ ?>



<div id="comments">

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'themnific' ),
			number_format_i18n( get_comments_number() ),  get_the_title());
			?></h3>
            <div class="hrline"></div>

			<ol class="commentlist">
				<?php
					wp_list_comments('avatar_size=54');
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous fl"><?php previous_comments_link( __( '<span class="meta-nav">&laquo;</span> Older Comments', 'themnific' ) ); ?></div>
				<div class="nav-next fr"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&raquo;</span>', 'themnific' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'themnific' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>

</div><!-- #comments -->
