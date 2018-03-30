<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	
	$width = 1900;
	
	if(df_option_compare('single_thumb_size','single_thumb_size',$post->ID)==true){
		$height = 0;
	} else {
		$height = 700;
	}
	
	$image = get_post_thumb($post->ID,0,0); 
	//image credits
	$imageCreditLink = get_post_meta( $post->ID, "_".THEME_NAME."_imageCreditLink", true );
	$imageCredits = get_post_meta( $post->ID, "_".THEME_NAME."_imageCredits", true );

	$votes = get_post_meta( $post->ID, "_".THEME_NAME."_total_votes", true );
	$video = get_post_meta( $post->ID, "_".THEME_NAME."_video_code", true );
	$slider = get_post_meta( $post->ID, THEME_NAME."_gallery_images", true );
	$audio = get_post_meta( $post->ID, "_".THEME_NAME."_audio", true );
	if(!$votes) {
		$votes = 0;
	}
	if(isset($_COOKIE[THEME_NAME.'_rating_'.$post->ID])) {
		$voteCookie = $_COOKIE[THEME_NAME.'_rating_'.$post->ID];	
	} else {
		$voteCookie = null;
	}

	if((df_option_compare('show_single_thumb','show_single_thumb',$post->ID)==true) && !(function_exists('is_cart') && is_cart()) && !(function_exists('is_checkout') && is_checkout()) && !(function_exists("is_bbpress") && is_bbpress()) && !is_attachment()) {
?>
    <!-- Media -->
    <div class="entry_media">
	    <?php if(!$video && !$slider && !$audio) { ?>
	    	<?php if($imageCredits) { ?>
	    		<span class="photo_caption">
	    			<?php if($imageCreditLink) { ?>
	    				<a href="<?php echo esc_url($imageCreditLink);?>" target="_blank">
	    			<?php } ?>
	    					<?php echo esc_html($imageCredits);?>
	    			<?php if($imageCreditLink) { ?>
	    				</a>
	    			<?php } ?>
	    		</span>
	    	<?php } ?>
	    	<?php if(df_option_compare('showLikes','showLikes',$post->ID)==true && $image['show']==true) { ?>
		        <span class="meta_likes">
		        	<a href="javascript:void(0);" data-tip="<?php echo intval($votes);?> <?php if($votes==1) { esc_attr_e("like", THEME_NAME); } else { esc_attr_e("likes", THEME_NAME); }?>" data-id="<?php echo intval($post->ID);?>"<?php if(isset($voteCookie)) { ?> class="voted"<?php } ?>>
		        		<?php if(isset($voteCookie)) { ?>
		        			<i class="fa fa-heart"></i>
		        		<?php } else {	?>
		        			<i class="fa fa-heart-o"></i>
		        		<?php } ?>
		        	</a>
		        </span>
	        <?php } ?>
	        <?php if(df_option_compare('imagePopUp','imagePopUp',$post->ID)==true) { ?> 
	        	<a href="<?php echo esc_url($image['src']);?>" class="popup_link">
	        <?php } ?>
	        	<?php echo df_image_html($post->ID,$width,$height); ?>
	        <?php if(df_option_compare('imagePopUp','imagePopUp',$post->ID)==true) { ?> 
	       		</a>
	        <?php } ?>
        <?php 
    		} elseif($video && !$slider && !$audio) { 
    			echo balanceTags($video);
        	} else if(!$video && $slider && !$audio) {
        ?>
            <!-- Content slider -->
            <div class="content_slider">
                <ul>
                	<?php
                		$imageIDs = explode(",",$slider);
                		foreach($imageIDs as $sliderImage) {
                			if($sliderImage) {
                				$file = wp_get_attachment_url($sliderImage);
                				$image = get_post_thumb(false, $width, $height, false, $file);
                				$imageL = get_post_thumb(false, 0, 0, false, $file);

                	?>
	                    <!-- Item -->
	                    <li>
					        <?php if(df_option_compare('imagePopUp','imagePopUp',$post->ID)==true) { ?> 
					        	<a href="<?php echo esc_url($imageL['src']);?>" class="popup_link">
					        <?php } ?>	
					        	<img src="<?php echo esc_url($image['src']);?>" alt="<?php the_title_attribute(); ?>">
					        <?php if(df_option_compare('imagePopUp','imagePopUp',$post->ID)==true) { ?> 
					       		</a>
					        <?php } ?>
	                    </li><!-- End Item -->
                	<?php
                			}
                		}


                	?>
                </ul>
            </div><!-- End Content slider -->
        <?php
        	} elseif(!$video && !$slider && $audio) {
        		echo balanceTags($audio);
        	}
        ?>
    </div>
    <!-- End Media -->
<?php } ?>
