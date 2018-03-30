<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-wide'); 
global $oi_options;
?>
<div class="row">
    <div class="col-md-11">
        <?php if ($large_image_url[0] != '') {?>
        	<a class="oi_post_image" href="<?php echo the_permalink(); ?>">
                <div class="oi_img_holder">
                	<img class="oi_zoom_img" width="160px" src="<?php echo get_template_directory_uri().'/framework/img/zoom-v.png';?>">
                </div>
                 <img class="img-responsive" src="<?php echo esc_url($large_image_url[0]); ?>" alt="<?php the_title(); ?>" />
            </a>
        <?php }; ?>
        <div class="clearfix"></div>
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
	<div class="col-md-1">
    	<div class="oi_meta_side">
            <span class="oi_meta_side_time_d"><?php the_time('d'); ?></span>
            <span class="oi_meta_side_time_y"><?php the_time('M'); ?></span>
        </div>
    </div>
</div>