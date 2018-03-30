<?php
/**
 * Theme Index Content - Standard Post Format
 *
 * @package	DigitalAgency
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since DigitalAgency 1.0
 */

global $sd_data;

$sd_has_thumb = ( has_post_thumbnail() ) ? NULL : ' sd-no-thumb';
$blog_layout  = $sd_data['sd_blog_layout'];
$thumb_size   = ( $blog_layout == '2' ) ? 'full' : 'sd-blog-thumbs' ;
$post_meta    = $sd_data['sd_blog_post_meta_enable'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-standard-entry clearfix' . $sd_has_thumb ); ?>> 
	<div class="sd-entry-wrapper">
		<?php if ( ( has_post_thumbnail() ) ) : ?>
			<div class="sd-entry-thumb">
				<figure>
					<?php the_post_thumbnail( $thumb_size ); ?>
				</figure>
			</div>
		<?php endif; ?>
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
<!-- sd-blog-entry  --> 