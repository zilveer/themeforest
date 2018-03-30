<?php
use \Handyman\Front as F;
/**
 *  Related post part
 */
?>
<div class="column span-6">
    <?php echo F\tl_post_featured_media(array('size' => 'layers-landscape-medium')); ?>
    <div class="thumbnail-body">
        <header class="article-title">
            <h3 class="heading">
                <a title="<?php the_title_rss(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
        </header>
        <?php
        /**
         * Get meta data
         */
        F\tl_layers_post_meta(get_the_ID(), array('date', 'categories'));
        ?>
    </div>
</div>