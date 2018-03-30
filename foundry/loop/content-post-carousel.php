<?php
	if(!( has_post_thumbnail() ))
		return false;
?>

<div class="masonry-item project post-carousel">
    <div class="image-tile hover-tile text-center">
        <?php the_post_thumbnail('grid', array('class' => 'background-image')); ?>
        <div class="hover-state">
            <a href="<?php the_permalink(); ?>">
                <?php the_title('<h3 class="uppercase mb8">', '</h3><h6 class="uppercase">'. get_the_time(get_option('date_format')) .'</h6>'); ?>
            </a>
        </div>
    </div>
</div>