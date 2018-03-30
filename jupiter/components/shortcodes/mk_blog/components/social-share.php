<?php
global $mk_options;

if ($mk_options['single_blog_social'] == 'true'){ 
?>
<span class="blog-share-container">
    <span class="mk-blog-share mk-toggle-trigger"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-share-2', 16); ?></span>
    <ul class="blog-social-share mk-box-to-trigger">
	    <li><a class="facebook-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-facebook', 16); ?></a></li>
	    <li><a class="twitter-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-twitter', 16); ?></a></li>
	    <li><a class="googleplus-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-googleplus', 16); ?></a></li>
	    <li><a class="pinterest-share" data-image="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id() , 'full', true) [0]; ?>" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-pinterest', 16); ?></a></li>
	    <li><a class="linkedin-share" data-desc="<?php echo esc_attr(get_the_excerpt()); ?>" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-linkedin', 16); ?></a></li>
    </ul>
</span>
<?php    
}