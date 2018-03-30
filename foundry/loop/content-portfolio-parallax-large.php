<section class="fullscreen image-bg overlay parallax">

    <div class="background-image-holder">
        <?php the_post_thumbnail('full', array('class' => 'background-image')); ?>
    </div>
    
    <div class="container v-align-transform">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <div class="feature feature-1 bordered">
                
                    <?php the_title('<div class="text-center"><h2 class="uppercase">', '</h2></div>'); ?>
                    <p><?php echo get_post_meta($post->ID, '_ebor_the_subtitle', 1); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-white btn-lg mb0"><?php _e('Open Project','foundry'); ?></a>
                    
                </div>
            </div>
        </div>
    </div>

</section>