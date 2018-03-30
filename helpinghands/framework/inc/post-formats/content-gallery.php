<?php
/**
 * Theme Index Content - Gallery Post Format
 *
 * @package	DigitalAgency
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since DigitalAgency 1.0
 */

global $sd_data;

$blog_layout  = $sd_data['sd_blog_layout'];
$thumb_size   = ( $blog_layout == '2' ) ? 'full' : 'sd-blog-thumbs' ;
$post_meta    = $sd_data['sd_blog_post_meta_enable'];
$gallery_imgs = rwmb_meta( 'sd_gallery_images', 'size=' . $thumb_size . '' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-gallery-entry clearfix' ); ?>> 
	<div class="sd-entry-wrapper">
		<div class="sd-entry-gallery">
			<div class="flexslider sd-entry-gallery-slider">
				<ul class="slides">
					<?php if ( ! empty( $gallery_imgs ) ) : ?>
						<?php foreach( $gallery_imgs as $gallery_img ) :  ?>
							<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
									<figure><img src="<?php echo $gallery_img['url']; ?>" alt="<?php echo $gallery_img['alt']; ?>" /></figure>
								</a>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
			<!-- flexslider sd-entry-gallery-slider -->
		</div>
		<!-- sd-entry-gallery --> 
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
<!-- sd-gallery-entry --> 