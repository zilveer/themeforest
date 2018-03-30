<div class="col-sm-6 masonry-item project" data-filter="<?php echo ebor_the_terms('portfolio_category', ',', 'name'); ?>">
    <div class="image-tile inner-title hover-reveal text-center">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('full'); ?>
            <div class="title">
                <?php the_title('<h5 class="uppercase mb0">', '</h5><span>'. ebor_the_terms('portfolio_category', ' / ', 'name') .'</span>'); ?>
            </div>
        </a>
    </div>
</div>