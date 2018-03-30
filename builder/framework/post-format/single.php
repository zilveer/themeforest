<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), ''); 
global $oi_options;
?>


<div class="row">
    <div class="col-md-12">
		<?php if ($large_image_url[0] != '') {?>
        	<div class="oi_single_featured_holder">
        	<img class="img-responsive" src="<?php echo esc_url($large_image_url[0]); ?>" alt="<?php the_title(); ?>" />
        	</div>
		<?php }; ?>
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
