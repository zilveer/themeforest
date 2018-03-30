<?php
/**
* @package Grace - Religious WordPress Theme
* @subpackage grace
* @author Theme Blossom - www.themeblossom.net
*/

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php echo __('This post is password protected. Enter the password to view comments.', 'grace');?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<div id="comments">
<?php if ( have_comments() ) : ?>
	<div class="contentSpacer"></div>
	
	<h3>	
	<?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'grace' ),
			number_format_i18n( get_comments_number() ), '<span class="normal">&quot;'.get_the_title().'&quot;</span>' );?>
	
	</h3>

	
	<ul class="commentlist">
	<?php wp_list_comments("callback=st_comments"); ?>
	</ul>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	
<?php endif; ?>

</div>

<?php if ( comments_open() ) : ?>

<div class="contentSpacer"></div>

<div id="respond">

<h3><?php comment_form_title( __('Leave a reply','grace')); ?></h3>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php echo __('You must be logged in to post a comment.','grace');?></a> </p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<p><small><?php echo __('Logged in as: ','grace').' '?><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php echo __('Log out','grace');?>"><?php echo __('Log out','grace');?></a></small></p>

<?php else : ?>

<p>
<label for="author"><small><?php echo __('Name','grace');?> <?php if ($req) echo __('required','grace'); ?></small></label><br>
<input type="text" name="author" id="author" value="<?php /*echo esc_attr($comment_author); */ echo esc_attr($comment_author);?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
</p>

<p>
<label for="email"><small><?php echo __('Email ','grace'); echo __('(will not be published)','grace'); if ($req) { echo __(' (required)','grace'); } ?></small></label><br>
<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
</p>

<p>
<label for="url"><small><?php echo __('Website','grace');?></small></label><br>
<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
</p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p>
<label for="comment"><small><?php echo __('Your Comment','grace');?></small></label><br>
<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
</p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php echo __('Submit comment','grace');?>" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<div class="contentSpacer"></div>

<?php endif; // if you delete this the sky will fall on your head ?>
