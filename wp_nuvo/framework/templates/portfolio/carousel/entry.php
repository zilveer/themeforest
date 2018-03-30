<?php $post_id = get_the_ID(); ?>
<article id="post_<?php echo esc_attr($post_id); ?>" <?php post_class();?>>
    <div class="cs-carousel-portfolio-header">               
        <?php
        $options = get_option(OPTIONS);
        if (has_post_thumbnail()) {
            $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full', false);
            $image_resize = matthewruddy_image_resize( $attachment_image[0], 600, 400, true, false );
            echo '<img class="attachment-featuredImageCropped" src="'. esc_attr($image_resize['url']) .'" />';            
        }
        ?>
        <div class="cs-carousel-portfolio-info">
            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel=""><i class="fa fa-share"></i></a>
        </div>
    </div>
    <div class="cs-carousel-portfolio-content">
         <h3 class="cs-carousel-portfolio-title"><?php the_title(); ?></h3>
         <?php echo get_the_term_list($post_id, 'portfolio_category', '', ', ', ''); ?>
    </div>
</article>