<!--start nicdark_masonry_container-->
<div class="nicdark_masonry_container">

	<?php if(have_posts()) : ?>
				
		<?php while(have_posts()) : the_post(); ?>

			<?php
				$post_id = get_the_ID(); 
				//image src
		    	$attachment_id = get_post_thumbnail_id( $post_id );
		    	$image_attributes = wp_get_attachment_image_src( $attachment_id, 'large' );
		    ?>
			
			<!--prevew-->
			<div class="grid grid_4 nicdark_masonry_item nicdark_width100_ipadpotr">
			
				<!--#post-->
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="nicdark_focus nicdark_padding40 nicdark_sizing" style="background-image:url(<?php echo esc_url($image_attributes[0]); ?>); background-size:cover;  background-position:center center;">
			            <div class="nicdark_focus nicdark_filter white nicdark_padding40 nicdark_sizing center">
			                <h3 class="grey"><?php the_title(); ?></h3>
			                <div class="nicdark_space20"></div>
			                <h5 class="grey"><strong><?php echo esc_attr(get_the_date()); ?></strong></h5>
			                <div class="nicdark_space20"></div>
			                <div class="nicdark_divider center small"><span class="nicdark_bg_grey2 "></span></div>
			                <div class="nicdark_space20"></div>
			                <p><?php the_excerpt(); ?></p>
			                <div class="nicdark_space20"></div>
			                <a href="<?php esc_url(the_permalink()); ?>" class="nicdark_btn nicdark_border_grey nicdark_press nicdark_transition title medium grey"><?php _e('READ MORE','weddingindustry'); ?></a>
			            </div>
			        </div>
		        </div>
				<!--#post-->

			</div>
			<!--preview-->


			<div class="nicdark_space50"></div>
				
				
		<?php endwhile; ?>
				
	<?php else: ?>
	
		<?php $nicdark_search_message = __('NOTHING FOUND: Search again','weddingindustry'); ?>
	    <div class="nicdark_alerts nicdark_bg_orange  ">
	        <p class="white nicdark_size_big"><i class="icon-cancel-circled-outline iconclose"></i>&nbsp;&nbsp;&nbsp;<?php echo esc_attr($nicdark_search_message); ?></p>
	        <i class="icon-warning-empty nicdark_iconbg right big orange"></i>
	    </div>

	<?php endif; ?>

</div>
<!--end nicdark_masonry_container-->