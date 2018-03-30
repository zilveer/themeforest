<?php
global $ctCommentsCounter; $ctCommentsCounter = 0;
function theme_comments($comment, $args, $depth) {
	$GLOBALS['ctCommentsCounter']++;
	$GLOBALS['comment'] = $comment;?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<?php if($GLOBALS['ctCommentsCounter']!=1): ?><hr><?php endif;?>
		<div class="commentHeader" id="comment-<?php comment_ID(); ?>">
			<?php echo get_avatar($comment, $size = '50', $default = ''); ?>
            <span class="author"><?php echo get_comment_author_link()?></span>
            <span class="date vgray">
	            <?php echo get_comment_date()?> <?php _e('at', 'ct_theme') ?> <?php echo get_comment_time()?>
	            <?php if(ct_get_option("posts_single_show_comment_form", 1)):?> | <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?><?php endif;?>
	            <?php if ($comment->comment_approved == '0') : ?> | <span class="unapproved-info"><?php _e('Your comment is awaiting moderation.', 'ct_theme') ?></span><?php endif; ?>
            </span>
        </div>

      <?php comment_text() ?>
	<?php
}

?>
<?php if(post_password_required()): ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view and post comments.' , 'ct_theme' ); ?></p>
	<?php return;?>
<?php endif;?>
<?php if (((get_post_type()=='portfolio' && ct_get_option("portfolio_single_show_comments", 0)) || (get_post_type()=='post' && ct_get_option("posts_single_show_comments", 1)) || (get_post_type()=='page' && ct_get_option("pages_single_show_comments", 0))) && have_comments()): ?>
	<div class='row-fluid'>
	    <div class="span12">
	        <h3 class="crossLine"><span><?php echo wp_count_comments(get_the_ID())->approved?> <?php echo __("COMMENTS", "ct_theme");?></span></h3>
	        <br>
	        <ul class="commentList">
		        <?php wp_list_comments(array('callback' => 'theme_comments', 'style' => 'ol'));?>
	        </ul>
	    </div>
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
	<div id="respond" class="row-fluid">
	    <div class="span12">
	        <br><br>
	        <h3 class="crossLine"><span><?php _e('LEAVE A COMMENT', 'ct_theme');?></span></h3>
	        <br>

			<?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
	            <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment', 'ct_theme'), wp_login_url(get_permalink())); ?></p>
			<?php else : ?>

		    <form class="form-search form-horizontal" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	            <fieldset>
	                <?php if (is_user_logged_in()) : ?>
	                    <p class="logged"><?php printf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'ct_theme'), admin_url('profile.php'), $user_identity, wp_logout_url(get_permalink()))?></p>
	                <?php else : ?>
		                <div class="control-group">
		                    <label class="control-label" for="inputName"><?php _e('NAME', 'ct_theme')?></label>

		                    <div class="controls">
		                        <input type="text" id="inputName" name="author" class="span12">
		                    </div>
		                </div>
		                <div class="control-group">
		                    <label class="control-label" for="inputEmail"><?php _e('EMAIL', 'ct_theme')?></label>

		                    <div class="controls">
		                        <input type="text" id="inputEmail" name="email" class="span12">
		                    </div>
		                </div>
		            <?php endif; ?>
	                <div class="control-group">
	                    <label class="control-label" for="msgArea"><?php _e('MESSAGE', 'ct_theme')?></label>

	                    <div class="controls">
	                        <textarea rows="10" id="msgArea" name="comment" class="span12"></textarea>
	                    </div>
	                </div>
	                <div class="control-group">

	                    <div class="controls doRight">
	                        <input type="submit" value="<?php _e('SUBMIT COMMENT', 'ct_theme')?>" class="btn vorange vlarge">
	                    </div>
	                </div>
		            <?php comment_id_fields(); ?>
                    <p><?php do_action('comment_form', get_the_ID()); ?></p>
                    <?php if(false):?><?php comment_form()?><?php endif;?>
	            </fieldset>
	        </form>
		    <?php endif; ?>
	    </div>
	</div>
<?php endif; ?>