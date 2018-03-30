<?php

/**
 * template part for blog single meta single.php. views/blog/components
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.0
 */

if(mk_get_blog_single_style() == 'bold') return false;

global $mk_options;

$image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id() , 'full');

if($mk_options['blog_single_title'] == 'true') : ?>
	<?php if($mk_options['blog_single_title'] == 'true') : ?>
			<h2 class="blog-single-title" itemprop="headline"><?php the_title(); ?></h2>
	<?php endif; ?>
<?php endif; ?>


<?php if($mk_options['single_meta_section'] == 'true' && get_post_meta( $post->ID, '_disable_meta', true ) != 'false') : ?>
<div class="blog-single-meta">
	<div class="mk-blog-author" itemtype="http://schema.org/Person" itemprop="author"><?php esc_html_e( 'By', 'mk_framework' ); ?> <?php esc_url( the_author_posts_link() ); ?> </div>
		<time class="mk-post-date" datetime="<?php the_date('Y-m-d') ?>"  itemprop="datePublished">
			&nbsp;<?php esc_html_e( 'Posted', 'mk_framework' ); ?> <a href="<?php echo get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ); ?>"><?php echo get_the_date(); ?></a>
		</time>
		<div class="mk-post-cat">&nbsp;<?php esc_html_e( 'In', 'mk_framework' ); ?> <?php the_category( ', ' ) ?></div>
	<?php  mk_structured_data_post_meta_hidden();?>
</div>
<?php endif; ?>



<div class="single-social-section">

	<div class="mk-love-holder"><?php echo Mk_Love_Post::send_love(); ?></div>

	<?php
	if($mk_options['blog_single_comments'] == 'true') :
			if ( get_post_meta( $post->ID, '_disable_comments', true ) != 'false' ) { ?>
		<a href="<?php echo esc_url( get_permalink() ); ?>#comments" class="blog-modern-comment"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-bubble-9', 16); ?><span> <?php echo comments_number( '0', '1', '%'); ?></span></a><?php
			}
		endif;
	?>

	<?php if($mk_options['single_blog_social'] == 'true' ) : ?>
	<div class="blog-share-container">
		<div class="blog-single-share mk-toggle-trigger"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-share-2', 16); ?></div>
		<ul class="single-share-box mk-box-to-trigger">
			<li><a class="facebook-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-facebook', 16); ?></a></li>
			<li><a class="twitter-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-twitter', 16); ?></a></li>
			<li><a class="googleplus-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-googleplus', 16); ?></a></li>
			<li><a class="pinterest-share" data-image="<?php echo $image_src_array[0]; ?>" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-pinterest', 16); ?></a></li>
			<li><a class="linkedin-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-linkedin', 16); ?></a></li>
		</ul>
	</div>
	<?php endif; ?>

	<a class="mk-blog-print" onClick="window.print()" href="#" title="<?php esc_attr_e( 'Print', 'mk_framework' ); ?>"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-print-3', 16); ?></a>
<div class="clearboth"></div>
</div>