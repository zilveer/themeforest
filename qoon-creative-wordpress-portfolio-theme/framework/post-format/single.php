<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'normal');
$full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), '');  
$oi_qoon_options = get_option('oi_qoon_options');
?>
<div class="row">
	<div class="col-md-12 text-<?php echo $oi_qoon_options['single_title-position']?>">
        <div class="oi_blog_post_single_descr">
            <div class="oi_blog_meta_date"><span><?php the_time( get_option( 'date_format' ) ); ?> </span></div>
            <h4 class="oi_blog_title"><?php the_title(); ?></h4>     
        	<div class="oi_post_content">
            </div>
        </div>
    </div>
    <?php if($oi_qoon_options['single_heading-image'] !='style_ii') {if ($large_image_url[0] != '') {?>
    <div class="col-md-12">
        	<div class="oi_single_featured_holder">
        		 <a class="oi_post_image oi_must_zoom"  href="<?php echo esc_url($full_image_url[0]); ?>" data-rel="lightcase">
                    <div class="oi_img_holder">
                    	<img class="oi_zoom_img" width="100px" src="<?php echo get_template_directory_uri().'/framework/img/zoom.png';?>">
                    </div>
                   <img class="img-responsive" src="<?php echo esc_url($large_image_url[0]); ?>" alt="<?php the_title(); ?>" />
                </a>
        	</div>
	</div>
    <?php }}; ?>
    <div class="col-md-12">
        <div class="oi_single_post_content">
            <?php the_content(); ?>
            <?php $defaults = array( 'link_before' => '<span>',	'link_after'  => '</span>','before'   => '<div class="oi_pg single" >',	'after' => '</div>',); wp_link_pages( $defaults );?>
        </div>
        <div class="oi_single_post_meta">
        	<div class="row">
            	<div class="col-md-6 col-sm-6 col-xs-6">
                    <span class="single_post_meta_cat"><?php the_category(', '); ?> | </span>
                    <span class="single_post_meta_tag"><?php the_tags(' '); ?></span><br>
                    
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                	<span class="oi_share_text"><?php esc_html_e('Share: ','qoon-creative-wordpress-portfolio-theme')?> 
                        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink()?>" title="LinkedIn" target="_blank"><i class="fa fa-fw fa-linkedin"></i></a>
                        <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink()?>" title="Facebook" target="_blank"><i class="fa fa-fw  fa-facebook"></i></a>
                        <a href="https://twitter.com/share?url=<?php the_permalink()?>" title="Facebook" target="_blank"><i class="fa fa-fw  fa-twitter"></i></a>
                        <a href="https://plus.google.com/share?url=<?php the_permalink()?>" title="Google+" target="_blank"><i class="fa fa-fw  fa-google-plus"></i></a>
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>
