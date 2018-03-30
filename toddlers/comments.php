<?php
/*
Comments
*/

if ( ! empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<div class="alert alert-help">
			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'toddlers'  ); ?></p>
		</div>
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>

  <div id="comments" class="havecomments">

	<h3><?php comments_number( __( '<span>No</span> Responses', 'toddlers'  ), __( '<span>One</span> Response', 'toddlers'  ), _n( '<span>%</span> Response', '<span>%</span> Responses', get_comments_number(), 'toddlers'  ) );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<ol class="commentlist">
		<?php wp_list_comments( 'type=comment&callback=bones_comments' ); ?>
	</ol>

	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
	<?php // If comments are open, but there are no comments. ?>
  <div id="comments" class="nocomments">
    <h3<?php _e( 'No Comments', 'toddlers'  ); ?></h3>
	<?php else : // comments are closed ?>
	<?php // If comments are closed. ?>
	<?php endif; ?>

<?php endif; ?>

<?php if ( comments_open() ) : ?>

  <?php if(page_has_comments_nav()) : ?>

    <nav class="comment-nav clearfix">
      <div class="comment-prev">
        <?php previous_comments_link(__( '<i class="fa fa-chevron-left"></i>', 'toddlers'  ) . '  Previous Comments') ?>
      </div>
      <div class="comment-next">
        <?php next_comments_link(__( 'More Comments  ', 'toddlers'  ) . '<i class="fa fa-chevron-right"></i>') ?>
      </div>
    </nav>
  <?php endif; ?>

</div> <!-- END #COMMENTS -->

<?php comment_form(); ?>

<?php else : ?>

  <?php if ( have_comments() ) : ?>

  </div> <!-- END #COMMENTS (have comments, comments now closed) -->

  <div class="closed comments-closed">
    <h3><?php _e( 'Comments are closed', 'toddlers'  ); ?></h3>
  </div>

  <?php endif; ?>


<?php endif; // if you delete this the sky will fall on your head ?>

<?php $comments_by_type = separate_comments($comments); ?>
  <?php if ( ! empty( $comments_by_type['pings'] ) ) { ?>
  <div id="pings">
    <h3>
      <?php _e( 'Trackbacks and Pingbacks:', 'toddlers'  ); ?>
    </h3>
    <ol class="pinglist">
      <?php wp_list_comments( 'type=pings&callback=list_pings' ); ?>
    </ol>
  </div><!-- /#pings -->
  <?php } // end if ?>