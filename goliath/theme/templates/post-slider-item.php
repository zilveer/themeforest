<div class="post-item" data-overlay="1" data-overlay-excerpt="<?php echo esc_attr(plsh_excerpt(50)); ?>" data-overlay-url="<?php the_permalink(); ?>">
    <?php
    $image = plsh_get_thumbnail('post-slider-image', true);
    if($image)
    {
        ?>
        <?php plsh_get_rating_stars('block'); ?>
        <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image); ?>" alt="<?php esc_attr(the_title()); ?>" /></a>
        <?php
    }
    ?>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part( 'theme/templates/title-legend-mosaic'); ?>
</div>