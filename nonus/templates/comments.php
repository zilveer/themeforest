<?php
function theme_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="comment">
            <div class="comment-meta">
	            <?php echo get_avatar($comment, $size = '50', $default = ''); ?>
                <h4 class="author"><?php echo get_comment_author_link()?></h4>
                <span class="date"><?php echo get_comment_date();?><?php if(get_comment_time()):?> <?php _e('at', 'ct_theme') ?> <?php echo get_comment_time()?><?php endif; ?></span>
            </div>
			<?php if(ct_get_option("posts_single_show_comment_form", 1)):?><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?><?php endif;?>

            <div class="comment-content">
	            <?php comment_text() ?>
            </div>
        </div>
	<?php
}

?>



<?php if(post_password_required()): ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view and post comments.' , 'ct_theme' ); ?></p>
	<?php return;?>
<?php endif;?>
<?php if (((get_post_type()=='portfolio' && ct_get_option("portfolio_single_show_comments", 0)) || (get_post_type()=='post' && ct_get_option("posts_single_show_comments", 1)) || (get_post_type()=='page' && ct_get_option("pages_single_show_comments", 0))) && have_comments()): ?>
	<div id="comments" class="comments">
        <h3><span class="count"><?php echo wp_count_comments(get_the_ID())->approved?></span> <?php echo __("Comments", "ct_theme");?></h3>

	    <ul class="comment-list">
	        <?php wp_list_comments(array('callback' => 'theme_comments', 'style' => 'ol'));?>
        </ul>
	</div>
	<!-- row-fluid -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) && false ) : ?>
		<nav class="comments_navigation">
			<div class="nav_previous"><?php previous_comments_link(); ?></div>
			<div class="nav_next"><?php next_comments_link(); ?></div>
		</nav>
	<?php endif; ?>
<?php endif; ?>

<?php if (((get_post_type()=='portfolio' && ct_get_option("portfolio_single_show_comment_form", 0)) || (get_post_type()=='post' && ct_get_option("posts_single_show_comment_form", 1)) || get_post_type()=='page' && ct_get_option("pages_single_show_comment_form", 0)) && comments_open()) : // Comment Form ?>
	<div id="respond" class="comment-form">
        <h3><?php _e('Leave a Comment', 'ct_theme');?></h3>

		<?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
            <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment', 'ct_theme'), wp_login_url(get_permalink())); ?></p>
		<?php else : ?>
		    <form class="comment-form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                <?php if (is_user_logged_in()) : ?>
                    <p class="logged"><?php printf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'ct_theme'), admin_url('profile.php'), $user_identity, wp_logout_url(get_permalink()))?></p>
                <?php else : ?>
                    <input type="text" id="inputName" name="author" placeholder="<?php _e('Your name', 'ct_theme')?>">
                    <input type="text" id="inputEmail" name="email" placeholder="<?php _e('Your email', 'ct_theme')?>">
	            <?php endif; ?>
                <textarea rows="7" id="msgArea" name="comment" placeholder="<?php _e('Your message', 'ct_theme')?>"></textarea>
                <input type="submit" value="<?php _e('Submit', 'ct_theme')?>">

	            <?php comment_id_fields(); ?>
                <p><?php do_action('comment_form', get_the_ID()); ?></p>
                <?php if(false):?><?php comment_form()?><?php endif;?>
	        </form>
	    <?php endif; ?>
	</div>
<?php endif;