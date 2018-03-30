<div class="col-sm-6 col-xs-12">

    <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('grid', array('class' => 'mb24')); ?>
    </a>
    
    <?php the_title('<a href="'. esc_url(get_permalink()) .'"><h4 class="mb8">', '</h4></a>'); ?>
    
    <ul class="list-inline mb16">
        <li><?php the_time(get_option('date_format')); ?></li>
        <li><?php the_author_posts_link(); ?></li>
        <li><span class="label"><?php the_category('</span><span class="label">'); ?></span></li>
    </ul>
    
    <p class="mb0"><?php echo get_the_excerpt(); ?></p>
    
</div>