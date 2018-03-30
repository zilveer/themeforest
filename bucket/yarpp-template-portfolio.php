<?php
/*
YARPP Template: Related Articles
*/
?>


    <div class="related-projects_items-list-container">
        <div class="comments-area-title">
            <h4 class="hN"><?php _e('<em>Related</em> Articles', 'bucket'); ?></h4>
        </div>
        <?php if (have_posts()):?>
            <ul class="related-projects_items-list grid"><!--
            <?php while (have_posts()) : the_post(); ?>
                --><li class="related-projects_item grid__item one-half lap-and-up-one-quarter">

                     <article class="article article--billboard-small">
                        <?php $image_post_small = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-small'); ?>
                        <a href="<?php the_permalink(); ?>">
                            <div class="article__thumb">
	                            <?php bucket::the_img_tag($image_post_small[0], 'img') ?>
                            </div>
                            <div class="article__content">
                                <h2 class="article__title article--billboard-small__title">
                                    <span class="hN"><?php the_title(); ?></span>
                                </h2>
                                <span class="article__description">
                                    <?php
                                        //we need to differentiate here for mb strings
                                        if (wpgrade_contains_any_multibyte(get_the_excerpt())) {
                                            echo short_text(get_the_excerpt(), 50, 55);
                                        } else {
                                            echo short_text(get_the_excerpt(), 75, 80);
                                        }
                                    ?>
                                </span>
                                <span class="small-link"><?php _e('Read More', 'bucket'); ?><em>+</em></span>
                            </div> 
                        </a>
                    </article>

                </li><!--
            <?php endwhile; ?>
            --></ul>

        <?php else: ?>
        <p><?php _e("No related articles yet.", 'bucket'); ?></p>
        <?php endif; ?>
    </div>
