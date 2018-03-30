<?php
/**
 * Blog Template Part: Single Author Information
 * @version 1.0
 */
?>

<div id="author-info" class="clearfix">
	<div class="author-image col-md-2 column">
		<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_avatar( get_the_author_meta('user_email'), '80', '' ); ?></a>
	</div>   
	<div class="author-bio col-md-10 column">
	    <h4><?php _e('About:', 'smartfood'); ?> <?php echo get_the_author_meta( 'display_name' ); ?></h4>
	    <?php the_author_meta('description'); ?>
	</div>
	<div class="clear"></div>
</div>