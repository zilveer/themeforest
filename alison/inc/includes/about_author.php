<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<div class="post-author">

	<div class="author-img">
		<?php echo get_avatar( get_the_author_meta('email'), '85' ); ?>
	</div>
	
	<div class="author-content">
		<div class="box-title-area"><h4 class="title"><?php _e('About Author / ', 'alison'); ?><?php the_author_posts_link(); ?></h4></div>
		<div class="author-info">
			<p><?php the_author_meta('description'); ?></p>
			<?php if(get_the_author_meta('facebook')) : ?><a target="_blank" class="author-social" href="<?php echo the_author_meta('facebook'); ?>"><i class="fa fa-facebook"></i></a><?php endif; ?>
			<?php if(get_the_author_meta('twitter')) : ?><a target="_blank" class="author-social" href="<?php echo the_author_meta('twitter'); ?>"><i class="fa fa-twitter"></i></a><?php endif; ?>
			<?php if(get_the_author_meta('instagram')) : ?><a target="_blank" class="author-social" href="<?php echo the_author_meta('instagram'); ?>"><i class="fa fa-instagram"></i></a><?php endif; ?>
			<?php if(get_the_author_meta('google')) : ?><a target="_blank" class="author-social" href="<?php echo the_author_meta('google'); ?>"><i class="fa fa-google-plus"></i></a><?php endif; ?>
			<?php if(get_the_author_meta('pinterest')) : ?><a target="_blank" class="author-social" href="<?php echo the_author_meta('pinterest'); ?>"><i class="fa fa-pinterest"></i></a><?php endif; ?>
			<?php if(get_the_author_meta('tumblr')) : ?><a target="_blank" class="author-social" href="<?php echo the_author_meta('tumblr'); ?>"><i class="fa fa-tumblr"></i></a><?php endif; ?>
		</div>
	</div>
	
</div>