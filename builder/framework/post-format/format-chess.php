<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-normal'); 
global $oi_options;
?>
<div class="row">
<div class="col-md-6 col-sm-4 oi_chess_img_holder <?php if( $wp_query->current_post%2 == 1 ) {echo ' col-md-push-6';} else {echo 'oi_left_side_post';};?>">
<?php if ($large_image_url[0] != '') {?>
    <a class="oi_post_image" href="<?php echo the_permalink(); ?>">
        <div class="oi_img_holder">
            <img class="oi_zoom_img" width="160px" src="<?php echo get_template_directory_uri().'/framework/img/zoom.png';?>">
        </div>
         <img class="img-responsive" src="<?php echo esc_url($large_image_url[0]); ?>" alt="<?php the_title(); ?>" />
    </a>
<?php }else{ ?>
<img class="img-responsive" src="<?php echo get_template_directory_uri().'/framework/images/noimage.jpg'?>">
<?php };?>
</div>
<div class="col-md-6 col-sm-8 <?php if( $wp_query->current_post%2 == 1 ) echo ' col-md-pull-6';?>">
    <div class="oi_chess_content">
        <h3 class="oi_blog_title"><a class="blog_title_a" href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a></h3>
            <div class="oi_post_content">
                <?php the_content(); ?>
            </div>
            <div class="oi_blog_meta">
            	<span><?php the_time( get_option( 'date_format' ) ); ?></span>
                <span><?php _e('By','orangeidea')?> <?php the_author(); ?></span>
                <span><?php the_category(' '); ?></span>
                <span><?php the_tags(' '); ?></span>
           </div>
        </div>
    </div>
</div>