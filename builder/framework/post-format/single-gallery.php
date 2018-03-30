<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), ''); 
global $oi_options;
?>


<div class="row">
    <div class="col-md-12">
		<?php if(get_post_meta($post->ID, 'oi_gallery_type', 1) =='Grid'){?>
            <div class="row">
                <div class="oi_gallery">
					<?php
                    $arr = explode(",", get_post_meta($post->ID, 'image', true));
                    foreach ($arr as &$value) {
						$img = wp_get_attachment_image_src( $value, 'wall-portfolio-squre' );
                    	$per_row = get_post_meta($post->ID, 'oi_gallery_per_row', true);
						if($per_row == '2 Images'){$oi_per_row ='col-md-6';}
						if($per_row == '3 Images'){$oi_per_row ='col-md-4';}
						if($per_row == '4 Images'){$oi_per_row ='col-md-3';}
					?>
                    <div class="<?php echo esc_attr($oi_per_row)?> oi_gallery_item">
                             <img class="img-responsive" src="<?php echo esc_url($img[0])?>" alt="<?php the_title(); ?>" />
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
         <span><?php the_time( get_option( 'date_format' ) ); ?></span>
        <h2 class="oi_blog_title"><?php the_title(); ?></h2>
        <div class="oi_post_content">
        	<?php the_content(); ?>
        </div>
        <div class="oi_blog_meta oi_mas_meta oi_bottom_mas_meta">
           
            <span><?php _e('By','orangeidea')?> <?php the_author(); ?></span>
            <span><?php the_category(' '); ?></span>
            <span><?php the_tags(' '); ?></span>
            <span class="oi_share_text"><?php _e('Share: ','orangeidea')?> 
                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink()?>" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>
                <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink()?>" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/share?url=<?php the_permalink()?>" title="Facebook" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="https://plus.google.com/share?url=<?php the_permalink()?>" title="Google+" target="_blank"><i class="fa fa-google-plus"></i></a>
			</span>
        </div>
        <div class="single_post_bottom_sidebar_holder">
        	<?php comments_template(); ?>
        </div>
    </div>
</div>
