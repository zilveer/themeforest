<div class="feed-item mb96 mb-xs-48">

    <div class="row mb16 mb-xs-0">
        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center">
            <?php the_title('<h6 class="uppercase mb16 mb-xs-8">'. get_the_time(get_option('date_format')) .'</h6><h3><a href="'. esc_url(get_permalink()) .'">', '</a></h3>'); ?>
        </div>
    </div>

    <div class="row mb32 mb-xs-16">
        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
            <?php 
            	the_post_thumbnail('large', array('class' => 'mb32 mb-xs-16'));
            	the_content(); 
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center">
            <a class="mb48 mb-xs-32 btn btn-lg" href="<?php the_permalink(); ?>"><?php _e('Read Article','foundry'); ?></a>
            <hr>
        </div>
    </div>
    
</div>