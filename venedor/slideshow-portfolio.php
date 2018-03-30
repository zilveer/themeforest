<?php 
// Portfolio Slideshow
global $venedor_settings;
$slideshow_type = get_post_meta($post->ID, 'slideshow_type', true);

$layout = $venedor_settings['portfolio-content-layout'];

$layout = (isset($_GET['portfolio-layout'])) ? $_GET['portfolio-layout'] : $layout;

$image_size = ($layout == 'large-alt') ? 'portfolio-single-large' : 'portfolio-single-medium';
 
if ($slideshow_type != 'none') :
    ?>
    <?php
    if ($slideshow_type == 'images' && has_post_thumbnail()) : ?>
    <div class="portfolio-slideshow-wrap <?php echo $layout ?>">
        <div id="portfolio-slideshow-<?php echo $post->ID ?>" class="portfolio-slideshow owl-carousel">
            <?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size); ?>
            <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
            <?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
            <div class="post-image">
                <img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>" data-image="<?php echo $venedor_settings['portfolio-zoom']?$full_image[0]:'' ?>" />
            </div>
        
            <?php
            $i = 2;
            while ($i <= $venedor_settings['portfolio-slideshow-count']) :
            $attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'portfolio');
            if ($attachment_new_id) :
            ?>
                <?php $attachment_image = wp_get_attachment_image_src($attachment_new_id, $image_size); ?>
                <?php $full_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
                <?php $attachment_data = wp_get_attachment_metadata($attachment_new_id); ?>
                <div class="post-image">
                    <img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_field('post_content', $attachment_new_id); ?>" data-image="<?php echo $venedor_settings['portfolio-zoom']?$full_image[0]:'' ?>" />
                </div>
            <?php endif; $i++; endwhile; ?>
        </div>
        <?php if ($venedor_settings['portfolio-zoom']) : ?>
        <div class="figcaption">
            <span class="btn btn-inverse zoom-button"><span class="fa fa-search"></span></span>
            <a class="btn btn-inverse link-button" href="<?php the_permalink(); ?>"><span class="fa fa-link fa-rotate-90"></span></a>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php
    if ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true)): ?>
    <div class="portfolio-slideshow-wrap <?php echo $layout ?>">
        <div id="portfolio-slideshow-<?php echo $post->ID ?>" class="portfolio-slideshow">
            <div class="fit-video">
                <?php echo get_post_meta($post->ID, 'video_code', true); ?>
            </div>
        </div>
    </div>
    <?php
    endif;
endif;
?>