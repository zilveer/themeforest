<?php $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true); ?>
<div class="social-share-container">
    <div class="social-share-trigger mk-toggle-trigger"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-share-2'); ?></div>
    <ul class="single-share-box mk-box-to-trigger">
        <li><a class="facebook-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-facebook'); ?></a></li>
        <li><a class="twitter-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-twitter'); ?></a></li>
        <li><a class="googleplus-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-googleplus'); ?></a></li>
        <li><a class="pinterest-share" data-image="<?php echo esc_attr( $image_src_array[0] ); ?>" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-pinterest'); ?></a></li>
        <li><a class="linkedin-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-linkedin'); ?></a></li>
    </ul>
</div>