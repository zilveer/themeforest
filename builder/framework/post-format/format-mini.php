<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'wall-portfolio-squre'); 
global $oi_options;
?>
<div class="oi_mini_holder">
<div class="row">
	<?php if ($large_image_url[0] != '') {?>
    <div class="col-md-6 col-sm-6">
    	<a class="oi_post_image" href="<?php echo the_permalink(); ?>">
            <div class="oi_img_holder">
                <img class="oi_zoom_img" width="160px" src="<?php echo get_template_directory_uri().'/framework/img/zoom.png';?>">
            </div>
             <img class="img-responsive" src="<?php echo esc_url($large_image_url[0]); ?>" alt="<?php the_title(); ?>" />
        </a>
    </div>
    <?php }; ?>
    <div class="<?php if ($large_image_url[0] != '') {echo 'col-md-6  col-sm-6'; }else{ echo 'col-md-12';}; ?>">
    	<span class="oi_mini_date"><?php the_time(get_option( 'date_format' ));?></span>
        <h3 class="oi_blog_title"><a class="blog_title_a" href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a></h3>
        <div class="oi_post_content">
        	<?php the_content(); ?>
    	</div>
        <div class="oi_blog_meta">
        	<span><?php _e('By','orangeidea')?> <?php the_author(); ?></span>
        	<span><?php the_category(' '); ?></span>
            <span><?php the_tags(' '); ?></span>
       </div>
    </div>
</div>
</div>