<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments', 'designcrumbs') ?>.</p>

			<?php
			return;
		}
	}
?>

<?php if ( have_comments() ) : //if comments open and there are comments to show, display this ?>

	<?php if ( ! empty($comments_by_type['comment']) ) : ?>

		<h3 id="comments"><?php comments_number();?> on "<?php the_title(); ?>"</h3>
		<div id="comments_wrap"> 
			<ul class="commentlist"><!-- display omments -->
				<?php wp_list_comments('callback=custom_comment&type=comment'); //'custom_comment' are edited in [functions.php] ?>
			</ul>
		</div>

        <div class="navigation comment-nav">
	        <div class="nav-prev"><?php previous_comments_link() ?></div>
    	    <div class="nav-next"><?php next_comments_link() ?></div>
    	    <div class="clear"></div>
        </div>

	<?php endif; ?>

	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
		<h3 id="pings"><?php _e('Trackbacks', 'designcrumbs') ?></h3>
		<div id="comments_wrap">
			<ul class="pinglist"><!-- display trackbacks -->
				<?php wp_list_comments('callback=custom_pings&type=pings'); ?>
			</ul>
		</div>
		
		<div class="navigation comment-nav"> 
			<div class="nav-prev"><?php previous_comments_link() ?></div>
			<div class="nav-next"><?php next_comments_link() ?></div>
			<div class="clear"></div>
		</div>

	<?php endif; ?>

<?php else : ?>
	
	<?php if ('open' == $post->comment_status) : 
		// Display something if there are no comments yet?
	else : ?>
		<h5 id="comments_closed"><?php _e("Comments are closed.", "designcrumbs"); ?></h5>
	<?php endif; ?>

<?php endif; ?>

<?php comment_form(); ?>