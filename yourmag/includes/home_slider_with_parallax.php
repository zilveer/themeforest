

<div class="fws2" id="fws2-instance1">
    <div class="slider_container">

	<?php 
    $featucat = get_option('op_feat_cat');
	$slides = get_option('op_feat_slides');
	if (get_option('op_recent_featured_flex') == 'Recent posts') {
	$my_query = new WP_Query('showposts='. $slides .'');	
	} else {
    $my_query = new WP_Query('showposts='. $slides .'&category_name='. $featucat .'');	
	}
    if ($my_query->have_posts()) :
    ?>					
		
    <?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>	
		
            <div class="slide"> 
            <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
	        <?php $image = aq_resize( $thumbnailSrc, 1240, 612, true ); ?>
	     	<img alt="<?php the_title(); ?>" src="<?php echo $image ?>" />
			
			<?php 
					if(function_exists('taqyeem_get_score')) { 
					global $post;
                    $post_score = get_post_meta($post->ID, 'taq_review_score', true);
					$post_total_score = get_post_meta($post->ID, 'taq_review_total', true);
					$post_score_position = get_post_meta($post->ID, 'taq_review_position', true);
					
                    echo $post_score_box =  '<span title="'.$post_total_score.'" class="post-single-rate post-small-rate stars-small hide'. $post_score_position.'">
					<span style="width:'.$post_score.'%"></span></span>';
					} ;
			?>
			
			<div class="slide_content_box">
                <div class="slide_content">
                    <div class="slide_content_wrap">

					<div class="clear"></div>
					
				    <?php if (get_option('op_slider_time_variant') == 'Standard') { ?>
					<div class="slide_time"><?php the_time('F j, Y'); ?></div>
					<?php } else { ?>	
                    <?php $time_ago = (get_option('op_time_ago')) ?>
		            <div class="slide_time"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . $time_ago ; ?></div>
	                <?php } ?>						
				    <div class="clear"></div>
                    <h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?> &raquo;</a></h1>
                    <div class="clear"></div>

                    <?php $custom_read_more = get_post_meta($post->ID, 'r_custom_read_more', true); ?>
	                <?php if($custom_read_more !== '') { ?>
	                <div class="custom_read_more">
					
                    <?php $custom_rm_link = get_post_meta($post->ID, 'r_custom_rm_link', true); ?>
	                <?php if($custom_rm_link !== '') { ?>
					<a href="<?php echo $custom_rm_link; ?>" title="<?php the_title(); ?>" target="_blank">
					<?php } else { ?>	
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">					
	                <?php } ?>	
					
	                <?php echo $custom_read_more; ?> &raquo;
					</a>
                    </div>
	                <?php } else { ?>
	                <div class="custom_read_more">
					
                    <?php $custom_rm_link = get_post_meta($post->ID, 'r_custom_rm_link', true); ?>
	                <?php if($custom_rm_link !== '') { ?>
					<a href="<?php echo $custom_rm_link; ?>" title="<?php the_title(); ?>" target="_blank">
					<?php } else { ?>	
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">					
	                <?php } ?>	
					
					<?php echo get_option('op_read_more'); ?>
					
					</a>
                    </div>
				    <?php } ?>
                    <div class="clear"></div>
					
                   </div>
                </div>
            </div>
            </div>
     
        <?php endwhile; wp_reset_query(); ?> 
        <?php endif; ?>      
           

        </div>

        <div class="slidePrev"></div>
        <div class="slideNext"></div>

</div> 

<?php 
wp_enqueue_script('fwslider', BASE_URL . 'js/fwslider.js', false, '', true);
?>


<div id="featured_two_image_box">

<div class="feat_image_one">
	<?php 
    $featucat_one = get_option('op_feat_cat_one');
	$slides = 1;
    $my_query = new WP_Query('showposts='. $slides .'&category_name='. $featucat_one .'');	
    if ($my_query->have_posts()) :
    ?>					
		
    <?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>	
		
            <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
	        <?php $image = aq_resize( $thumbnailSrc, 380, 180, true ); ?>
	     	<img alt="<?php the_title(); ?>" src="<?php echo $image ?>" />
			
			<div class="feat_image_content">
			
                    <?php 
					if(function_exists('taqyeem_get_score')) { 
					global $post;
                    $post_score = get_post_meta($post->ID, 'taq_review_score', true);
					$post_total_score = get_post_meta($post->ID, 'taq_review_total', true);
					$post_score_position = get_post_meta($post->ID, 'taq_review_position', true);
					
                    echo $post_score_box =  '<span title="'.$post_total_score.'" class="post-single-rate post-small-rate stars-small hide'. $post_score_position.'">
					<span style="width:'.$post_score.'%"></span></span>';
					} ;
					?>
					
					<div class="clear"></div>

				    <?php if (get_option('op_slider_time_variant') == 'Standard') { ?>
					<div class="slide_time"><?php the_time('F j, Y'); ?></div>
					<?php } else { ?>	
                    <?php $time_ago = (get_option('op_time_ago')) ?>
		            <div class="slide_time"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . $time_ago ; ?></div>
	                <?php } ?>						
				    <div class="clear"></div>
                    <h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?> &raquo;</a></h1>
					
			</div>
     
        <?php endwhile; wp_reset_query(); ?> 
        <?php endif; ?>      
</div>    
      
<div class="clear"></div>

<div class="feat_image_two">		   
	<?php 
    $featucat_one = get_option('op_feat_cat_two');
	$slides = 1;
    $my_query = new WP_Query('showposts='. $slides .'&category_name='. $featucat_one .'');	
    if ($my_query->have_posts()) :
    ?>					
		
    <?php while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID; ?>	
		
            <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
	        <?php $image = aq_resize( $thumbnailSrc, 380, 180, true ); ?>
	     	<img alt="<?php the_title(); ?>" src="<?php echo $image ?>" />
			
			<div class="feat_image_content">
			
                    <?php 
					if(function_exists('taqyeem_get_score')) { 
					global $post;
                    $post_score = get_post_meta($post->ID, 'taq_review_score', true);
					$post_total_score = get_post_meta($post->ID, 'taq_review_total', true);
					$post_score_position = get_post_meta($post->ID, 'taq_review_position', true);
					
                    echo $post_score_box =  '<span title="'.$post_total_score.'" class="post-single-rate post-small-rate stars-small hide'. $post_score_position.'">
					<span style="width:'.$post_score.'%"></span></span>';
					} ;
					?>
					
					<div class="clear"></div>

				    <?php if (get_option('op_slider_time_variant') == 'Standard') { ?>
					<div class="slide_time"><?php the_time('F j, Y'); ?></div>
					<?php } else { ?>	
                    <?php $time_ago = (get_option('op_time_ago')) ?>
		            <div class="slide_time"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . $time_ago ; ?></div>
	                <?php } ?>						
				    <div class="clear"></div>
                    <h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?> &raquo;</a></h1>
					
			</div>
     
        <?php endwhile; wp_reset_query(); ?> 
        <?php endif; ?>  		   
</div> 		   
		   
</div>

