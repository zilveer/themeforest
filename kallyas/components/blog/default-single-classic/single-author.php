<?php if(! defined('ABSPATH')){ return; }
/**
 * Single Author
 */

if( zget_option( 'zn_show_author_info', 'blog_options', false, 'yes' ) == 'yes' ) : ?>
	<div class="post-author kl-blog-post-author">
		<div class="author-avatar kl-blog-post-author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 100 ); ?>
		</div>
		<div class="author-details kl-blog-post-author-details">
			<h4 class="kl-blog-post-author-title" <?php echo WpkPageHelper::zn_schema_markup('author'); ?>><?php _e('About', 'zn_framework'); ?> <span class="author vcard" rel="author"><?php echo get_the_author_meta( 'display_name' );?></span></h4>
			<?php echo get_the_author_meta( 'description' );?>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php
endif;
