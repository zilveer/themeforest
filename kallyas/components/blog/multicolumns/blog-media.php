<?php if(! defined('ABSPATH')){ return; }
/**
 * Multi-columns image
 */

if( ! empty( $current_post['media'] ) ) : ?>
    <div class="itemThumbnail kl-blog-item-thumbnail">
        <?php echo $current_post['media']; ?>
        <div class="overlay kl-blog-item-overlay">
            <div class="overlay__inner kl-blog-item-overlay-inner">
                <a href="<?php the_permalink(); ?>" class="readMore kl-blog-item-overlay-more" title="<?php the_title(); ?>" data-readmore="<?php echo esc_attr(__('Read More', 'zn_framework')); ?>"></a>
            </div>
        </div>
    </div>
    <?php
endif;
