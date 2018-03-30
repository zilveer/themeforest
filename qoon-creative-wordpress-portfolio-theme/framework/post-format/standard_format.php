<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); 
$oi_qoon_options = get_option('oi_qoon_options');
?>
<div class="row">
    <div class="col-md-12">
		<?php if ($large_image_url[0] != '') {?>
            <a class="oi_post_image" href="<?php echo the_permalink(); ?>">
                <div class="oi_img_holder">
                </div>
                 <img class="img-responsive" src="<?php echo esc_url($large_image_url[0]); ?>" alt="<?php the_title(); ?>" />
            </a>
        <?php }else{ ?>
        <img class="img-responsive" src="<?php echo get_template_directory_uri().'/framework/images/noimage.jpg'?>">
        <?php };?>
    </div>
    <div class="col-md-12">
        <div class="oi_blog_post_descr">
            <div class="oi_blog_meta_date"><span><?php the_time( get_option( 'date_format' ) ); ?> </span></div>
            <h4 class="oi_blog_title"><a class="blog_title_a" href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>     
        	<div class="oi_post_content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
   
</div>