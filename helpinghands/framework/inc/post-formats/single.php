<?php
/**
 * Theme Single Post - Standard Post Format
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
?>

<div class="sd-entry-wrapper clearfix">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="sd-entry-thumb">
			<figure>
				<?php the_post_thumbnail( $thumb_size ); ?>
			</figure>
		</div>
	<?php endif; ?>
	<header>
		<h2 class="sd-entry-title">
			<?php the_title(); ?>
		</h2>
		<?php if ( $post_meta == '1' ) : ?>
			<?php get_template_part( 'framework/inc/post-meta' ); ?>
		<?php endif; ?>
	</header>
	<div class="sd-entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( 'before=<strong class="sd-page-navigation clearfix">&after=</strong>' ); ?>
	</div>
	<!-- sd-entry-content -->
</div>
<!-- sd-entry-wrapper --> 
