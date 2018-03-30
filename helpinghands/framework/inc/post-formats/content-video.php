<?php
/**
 * Theme Index Content - Video Post Format
 *
 * @package	DigitalAgency
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since DigitalAgency 1.0
 */

global $sd_data;
$post_meta = $sd_data['sd_blog_post_meta_enable'];
$video_embed = rwmb_meta( 'sd_video_url', 'type=oembed' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-video-entry clearfix' ); ?>> 
	<div class="sd-entry-wrapper">
		<div class="sd-entry-video-wrapper">
			<div class="sd-entry-video"> <?php echo $video_embed; ?> </div>
		</div>
		<!-- sd-entry-video-wrapper --> 
		<header>
			<h2 class="sd-entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h2>
			<?php if ( $post_meta == '1' ) : ?>
				<?php get_template_part( 'framework/inc/post-meta' ); ?>
			<?php endif; ?>
		</header>
		<div class="sd-entry-content">
			<?php the_excerpt(); ?>
		</div>
		<!-- sd-entry-content -->
	</div>
	<!-- sd-entry-wrapper --> 
</article>
<!-- sd-video-entry --> 