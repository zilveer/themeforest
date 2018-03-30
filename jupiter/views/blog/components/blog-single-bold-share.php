<?php

/**
 * template part for blog single bold style social share single.php. views/blog/components
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.0
 */

if(mk_get_blog_single_style() != 'bold') return false;

global $mk_options;

$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id() , 'full', true)[0];

if($mk_options['single_blog_social'] == 'true' ) : ?>
<div class="mk-social-share">
	<ul>
		<li><a class="mk-blog-print" onClick="window.print()" href="#" title="<?php esc_attr_e( 'Print', 'mk_framework' ); ?>"><img src="<?php echo THEME_IMAGES; ?>/social-icons/print.svg" alt="print page" /></a></li>

		<?php if($mk_options['blog_single_comments'] == 'true') : if ( get_post_meta( $post->ID, '_disable_comments', true ) != 'false' ) { ?>
		<li><a href="<?php echo esc_url( get_permalink() ); ?>#comments" class="blog-bold-comment"><img src="<?php echo THEME_IMAGES; ?>/social-icons/comment.svg" alt="comments" /></a></li>
		<?php } endif; ?>

		<li><a class="facebook-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><img src="<?php echo THEME_IMAGES; ?>/social-icons/facebook.svg" alt="facebook icon" /></a></li>
		<li><a class="twitter-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><img src="<?php echo THEME_IMAGES; ?>/social-icons/twitter.svg" alt="twitter icon" /></a></li>
	</ul>
	<div class="clearboth"></div>
</div>
<?php endif; ?>
