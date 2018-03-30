<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-wide'); 
global $oi_options;
?>
<div class="row">
    <div class="col-md-12">

		
		<?php if(get_post_meta($post->ID, 'oi_gallery_type', 1) =='Grid'){?>
        <div class="oi_mas_gal_holder oi_post_image mas_image">
            <div class="row">
                <div class="oi_gallery mas_image">
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
                        <a class="oi_post_image mas_image" href="<?php echo the_permalink(); ?>">
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
            </div>
        <?php };?>
        
        <?php if(get_post_meta($post->ID, 'oi_gallery_type', 1) =='Slider'){?>
        	<div class="oi_mas_gal_holder_slider">
                <div class="oi_gallery_slider">
					<?php
                    $arr = explode(",", get_post_meta($post->ID, 'image', true));
                    foreach ($arr as $value) {
						$img = wp_get_attachment_image_src( $value, 'blog-wide' );
					?>
                        <div>
                        <a class="oi_post_image mas_image" href="<?php echo the_permalink(); ?>"><img class="img-responsive" src="<?php echo esc_url($img[0])?>" alt="<?php the_title(); ?>" /></a>
                        </div>
                    <?php }; ?>
                </div>
                <div class="clearfix"></div>
                </div>
        <?php };?>
        <div class="oi_mas_content">
            <h4 class="oi_blog_title oi_mas_title"><a class="blog_title_a" href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a></h4>
            <div class="oi_blog_meta oi_mas_meta">
                <span><?php the_time( get_option( 'date_format' ) ); ?></span>
                <span><?php _e('By','orangeidea')?> <?php the_author(); ?></span>
                <span><?php the_category(' '); ?></span>
                <span><?php the_tags(' '); ?></span>
            </div>
            <div class="oi_post_content">
            <?php the_content(); ?>
            </div>
        </div>
    </div>
   
</div>