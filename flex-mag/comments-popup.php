<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" >
<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />

<?php if ( ! function_exists( '_wp_render_title_tag' ) ) { function theme_slug_render_title() { ?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php } add_action( 'wp_head', 'theme_slug_render_title' ); } ?>
<?php if(get_option('mvp_favicon')) { ?><link rel="shortcut icon" href="<?php echo esc_url(get_option('mvp_favicon')); ?>" /><?php } ?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
</head>

<body id="commentspopup">
<div id="content-main">
<div id="comments" class="comments-pop">

<?php
/* Don't remove these lines. */
add_filter('comment_text', 'popuplinks');
if ( have_posts() ) :
while( have_posts()) : the_post();
?>

<h1 class="post-title left"><?php the_title(); ?></h1>

<?php $disqus_id = get_option('mvp_disqus_id'); if ($disqus_id) { ?>

<?php $disqus_id2 = esc_html($disqus_id); mvp_disqus_embed($disqus_id2); ?>

<?php } else { ?>

<h4 class="post-header"><span class="post-header">
			<?php
			printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'mvp-text' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?>
</span></h4>

<?php
// this line is WordPress' motor, do not delete it.
$commenter = wp_get_current_commenter();
$comments = get_approved_comments($id);
$post = get_post($id);
if ( post_password_required($post) ) {  // and it doesn't match the cookie
	echo(get_the_password_form());
} else { ?>

<?php if ($comments) { ?>
<ol class="commentlist">
<?php foreach ($comments as $comment) { ?>
	<li id="comment-<?php comment_ID() ?>">
		<div class="comment-inner">
			<p class="comment-meta-2">
				<?php printf(__('%1$s &#8212; %2$s', 'mvp-text' ), get_comment_author_link(), get_comment_date(), get_comment_ID(), get_comment_time()); ?>
			</p>
			<?php comment_text() ?>
		</div><!--comment-innner-->
	</li>

<?php } // end for each comment ?>
</ol>
<?php } else { // this is displayed if there are no comments so far ?>
	<p><?php _e('No comments yet.', 'mvp-text'); ?></p>
<?php } ?>

<?php if ( comments_open() ) { ?>
<div id="respond" class="comment-respond">
<h4 class="post-header"><span class="post-header"><?php _e('Leave a comment', 'mvp-text'); ?></span></h4>

<form action="<?php echo esc_url(site_url()); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
	<p class="logged-in-as"><?php printf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out &raquo;</a>', 'mvp-text'), get_edit_user_link(), $user_identity, wp_logout_url(get_permalink())); ?></p>
<?php else : ?>
	<p>
	  <input type="text" name="author" id="author" class="textarea" value="<?php echo esc_attr( $commenter['comment_author'] ); ?>" size="28" tabindex="1" />
	   <label for="author"><?php _e('Name', 'mvp-text'); ?></label>
	</p>

	<p>
	  <input type="text" name="email" id="email" value="<?php echo esc_attr( $commenter['comment_author_email'] ); ?>" size="28" tabindex="2" />
	   <label for="email"><?php _e('E-mail', 'mvp-text'); ?></label>
	</p>

	<p>
	  <input type="text" name="url" id="url" value="<?php echo esc_attr( $commenter['comment_author_url'] ); ?>" size="28" tabindex="3" />
	   <label for="url"><?php _e('<abbr title="Universal Resource Locator">URL</abbr>', 'mvp-text'); ?></label>
	</p>
<?php endif; ?>

	<p>
	  <label for="comment"><?php _e('Your Comment', 'mvp-text'); ?></label>
	<br />
	  <textarea name="comment" id="comment" cols="70" rows="4" tabindex="4"></textarea>
	</p>

	<p>
	  <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	  <input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER["REQUEST_URI"]); ?>" />
	  <input name="submit" id="submit" type="submit" tabindex="5" value="<?php _e('Post Comment', 'mvp-text' ); ?>" />
	</p>
	<?php
	/** This filter is documented in wp-includes/comment-template.php */
	do_action( 'comment_form', $post->ID );
	?>
</form>
</div><!--respond-->
<?php } else { // comments are closed ?>
<p><?php _e('Sorry, the comment form is closed at this time.', 'mvp-text'); ?></p>
<?php }
} // end password check
?>

<?php } ?>

<div><strong><a href="javascript:window.close()"><?php _e('Close this window.', 'mvp-text'); ?></a></strong></div>

<?php // if you delete this the sky will fall on your head
endwhile; // have_posts()
else: // have_posts()
?>
<p><?php _e('Sorry, no posts matched your criteria.', 'mvp-text'); ?></p>
<?php endif; ?>
<!-- // this is just the end of the motor - don't touch that line either :) -->
<?php //} ?>

<script type="text/javascript">
<!--
document.onkeypress = function esc(e) {
	if(typeof(e) == "undefined") { e=event; }
	if (e.keyCode == 27) { self.close(); }
}
// -->
</script>
</div><!--content-main-->
</div><!--comments-->
<?php wp_footer(); ?>
</body>
</html>