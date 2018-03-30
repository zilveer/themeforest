<?php global $majesty_options; ?>
<!-- Social share -->
<div class="shop-social-share post-share">
	<ul class="social pull-right">
		<?php if( $majesty_options['shop_share_facebook'] ) { ?>
			<li><a rel="nofollow" class="facebook-share" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&#038;t=<?php echo esc_attr( str_replace(' ', '%20', get_the_title())); ?>" data-toggle="tooltip" title="" data-original-title="<?php esc_html_e('Facebook', 'theme-majesty'); ?>"><i class="fa fa-facebook"></i></a></li>
		<?php } ?>
		<?php if( $majesty_options['shop_share_twitter'] ) { ?>
			<li><a rel="nofollow" class="twitter-share" href="http://twitter.com/home?status=<?php echo esc_attr( str_replace(' ', '%20', get_the_title()) ); ?>%20<?php the_permalink(); ?>" data-toggle="tooltip" title="" data-original-title="<?php esc_html_e('Twitter', 'theme-majesty'); ?>"><i class="fa fa-twitter"></i></a></li>
		<?php } ?>
		<?php if( $majesty_options['shop_share_gplus'] ) { ?>
			<li><a rel="nofollow" class="google-share" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" data-toggle="tooltip" title="" data-original-title="<?php esc_html_e('Google+', 'theme-majesty'); ?>"><i class="fa fa-google-plus"></i></a>
		<?php } ?>
		<?php if( $majesty_options['shop_share_pinterest'] ) { ?>
			<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
			<li><a rel="nofollow" class="pinterest-share" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( esc_url( get_permalink() ) ); ?>&#038;description=<?php echo urlencode( esc_attr( $post->post_title ) ); ?>&#038;media=<?php echo urlencode( esc_url( $full_image[0] ) ); ?>" data-toggle="tooltip" title="" data-original-title="<?php esc_html_e('pinterest', 'theme-majesty'); ?>"><i class="fa fa-pinterest"></i></a></li>
		<?php } ?>
		<?php if( $majesty_options['shop_share_linkedin'] ) { ?>
			<li><a rel="nofollow" class="linkedin-share" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&#038;title=<?php the_title(); ?>" data-toggle="tooltip" title="" data-original-title="<?php esc_html_e('LinkedIn', 'theme-majesty'); ?>"><i class="fa fa-linkedin"></i></a></li>
		<?php } ?>
	</ul>
</div><!-- Social share -->