<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-wide'); 
global $oi_options;
?>
<div class="row">
    <div class="col-md-1">
    	<div class="oi_meta_side">
            <span class="oi_meta_side_time_d"><?php the_time('d'); ?></span>
            <span class="oi_meta_side_time_y"><?php the_time('M'); ?></span>
        </div>
    </div>
    <div class="col-md-11">
		<?php if(get_post_meta($post->ID, 'oi_gallery_type', 1) =='Grid'){?>
            <div class="row">
                <div class="oi_gallery">
					<?php
                    $arr = explode(",", get_post_meta($post->ID, 'image', true));
                    foreach ($arr as &$value) {
						$img = wp_get_attachment_image_src( $value, 'wall-portfolio-squre' );
                    	$per_row = get_post_meta($post->ID, 'oi_gallery_per_row', true);
						if($per_row == '2 Images'){$oi_per_row ='col-md-6 col-sm-6';}
						if($per_row == '3 Images'){$oi_per_row ='col-md-4 col-sm-4';}
						if($per_row == '4 Images'){$oi_per_row ='col-md-3 col-sm-3';}
					?>
                    <div class="<?php echo esc_attr($oi_per_row)?> oi_gallery_item">
                        <a class="oi_post_image" href="<?php echo the_permalink(); ?>">
                            <div class="oi_img_holder">
                                <img class="oi_zoom_img" width="100px" src="<?php echo get_template_directory_uri().'/framework/img/zoom.png';?>">
                            </div>
                             <img class="img-responsive" src="<?php echo esc_url($img[0])?>" alt="<?php the_title(); ?>" />
                        </a>
                    </div>
                    <?php }; ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        <?php };?>
        <?php if(get_post_meta($post->ID, 'oi_gallery_type', 1) =='Slider'){?>
                <div class="oi_gallery_slider">
					<?php
                    $arr = explode(",", get_post_meta($post->ID, 'image', true));
                    foreach ($arr as $value) {
						$img = wp_get_attachment_image_src( $value, 'blog-wide' );
					?>
                        <div>
                        <a class="oi_post_image" href="<?php echo the_permalink(); ?>"><img class="img-responsive" src="<?php echo esc_url($img[0])?>" alt="<?php the_title(); ?>" /></a>
                        </div>
                    <?php }; ?>
                </div>
        <?php };?>
        
        
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
