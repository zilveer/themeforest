<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'wall-portfolio-squre'); 
global $oi_options;
?>
<div class="row">
    <div class="col-md-12">
		<?php if ($large_image_url[0] != '') {?>
        	<a class="oi_post_image mas_image" href="<?php echo the_permalink(); ?>">
                <div class="oi_img_holder">
                	<img class="oi_zoom_img" width="160px" src="<?php echo get_template_directory_uri().'/framework/img/zoom.png';?>">
                </div>
                <img class="img-responsive" src="<?php echo esc_url($large_image_url[0]); ?>" alt="<?php the_title(); ?>" />
            </a>
        <?php }; ?>
        <div class="oi_mas_content">
		<h4 class="oi_blog_title oi_mas_title"><a class="blog_title_a" href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a></h4>
		<div class="oi_blog_meta oi_mas_meta">
        	<span><?php the_time( get_option( 'date_format' ) ); ?></span>
        	<span><?php _e('By','orangeidea')?> <?php the_author(); ?></span>
       </div>
        <div class="oi_post_content">
        	<?php the_content(); ?>
    	</div>
        <div class="oi_blog_meta oi_mas_meta oi_bottom_mas_meta">
        	<span><?php the_category(' '); ?></span>
            <span><?php the_tags(' '); ?></span>
       </div>
        </div>
    </div>
</div>