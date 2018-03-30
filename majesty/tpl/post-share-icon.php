<?php global $majesty_options; ?>
<!-- Social share -->
<div class="post-share social-share">
	<ul>
		<?php if( $majesty_options['single_share_facebook'] ) { ?>
			<li><a rel="nofollow" class="facebook-share" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&#038;t=<?php echo esc_attr( str_replace(' ', '%20', get_the_title())); ?>"><i class="fa fa-facebook"></i> <?php esc_html_e('Share', 'theme-majesty'); ?></a></li>
		<?php } ?>
		<?php if( $majesty_options['single_share_twitter'] ) { ?>
			<li><a rel="nofollow" class="twitter-share" href="http://twitter.com/home?status=<?php echo esc_attr( str_replace(' ', '%20', get_the_title()) ); ?>%20<?php the_permalink(); ?>"><i class="fa fa-twitter"></i> <?php esc_html_e('Tweet', 'theme-majesty'); ?></a></li>
		<?php } ?>
		<?php if( $majesty_options['single_share_gplus'] ) { ?>
			<li><a rel="nofollow" class="google-share" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i> <?php esc_html_e('Google+', 'theme-majesty'); ?></a>
		<?php } ?>
		<?php if( $majesty_options['single_share_pinterest'] ) { ?>
			<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
			<li><a rel="nofollow" class="pinterest-share" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( esc_url( get_permalink() ) ); ?>&#038;description=<?php echo urlencode( esc_attr( $post->post_title ) ); ?>&#038;media=<?php echo urlencode( esc_url( $full_image[0] ) ); ?>"><i class="fa fa-pinterest"></i> <?php esc_html_e('Pin', 'theme-majesty'); ?></a></li>
		<?php } ?>
		<?php if( $majesty_options['single_share_linkedin'] ) { ?>
			<li><a rel="nofollow" class="linkedin-share" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&#038;title=<?php the_title(); ?>"><i class="fa fa-linkedin"></i> <?php esc_html_e('LinkedIn', 'theme-majesty'); ?></a></li>
		<?php } ?>
	</ul>
</div><!-- Social share -->