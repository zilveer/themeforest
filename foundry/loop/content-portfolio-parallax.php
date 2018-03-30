<section class="image-bg bg-dark parallax overlay pt120 pb120">

    <div class="background-image-holder">
        <?php the_post_thumbnail('full', array('class' => 'background-image')); ?>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <?php the_title('<h2 class="uppercase mb8">', '</h2>'); ?>
                <p class="lead"><?php echo get_post_meta($post->ID, '_ebor_the_subtitle', 1); ?></p>
                <a class="btn btn-lg btn-white mt40 mb0" href="<?php the_permalink(); ?>"><?php _e('Open Project','foundry'); ?></a>
            </div>
        </div>
    </div>

</section>