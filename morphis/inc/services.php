
		<div id="services" class="row clearfix">
			<!-- CENTERED HEADING -->
			<?php 
			global $NHP_Options; 
			$options_morphis = $NHP_Options; 
			?>
			<h4 class="centered-heading"><span><?php echo $options_morphis['servicesHeading']; ?></span><a href="<?php echo $options_morphis['servicesSubHeadingLink']; ?>"><?php echo $options_morphis['servicesSubHeadingLinkText']; ?></a></h4>				
			<!-- END CENTERED HEADING -->
			<p class="smart"></p>
<?php
	$postCount = 0;
	$query = new WP_Query( array( 'post_type' => 'services', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );

	if( $query->have_posts() ) {
	
	  while ($query->have_posts()) : $query->the_post(); 

	  	$service_link = get_post_meta($post->ID,'_cmb_service_link_image_upload',TRUE);
	  	
		if(!empty($service_link)):
	  
	  		$service_link_before = "<a href='" . $service_link . "' title='" . get_the_title($post->ID) . "' class='service-link'>";
	  		$service_link_after = "</a>";
		
		endif;
	  
		if (++$postCount % 4 == 1) {
			 // FIRST POST
?>	
			<section class="four columns alpha">
					
						<?php $service_item_image = get_post_meta($post->ID,'_cmb_service_image_upload',TRUE); ?>									
						<?php if($service_item_image != '') : ?>
							<?php echo $service_link_before; ?>
								<img src="<?php echo $service_item_image; ?>" />
							<?php echo $service_link_after; ?>
						<?php endif; ?>
						<h5><?php echo get_the_title($post->ID); ?> </h5>		
						<?php $service_item_desc = get_post_meta($post->ID,'_cmb_service_description',TRUE); ?>			
						<p><?php echo do_shortcode( $service_item_desc ); ?></p>				
					
			</section>
<?php
		
		} elseif($postCount % 4 == 0) {
			 // LAST POST IN LOOP
?>
			<section class="four columns omega">
					
						<?php $service_item_image = get_post_meta($post->ID,'_cmb_service_image_upload',TRUE); ?>			
						<?php if($service_item_image != '') : ?>
							<?php echo $service_link_before; ?>
								<img src="<?php echo $service_item_image; ?>" />
							<?php echo $service_link_after; ?>
						<?php endif; ?>
						<h5><?php echo get_the_title($post->ID); ?> </h5>		
						<?php $service_item_desc = get_post_meta($post->ID,'_cmb_service_description',TRUE); ?>			
						<p><?php echo do_shortcode( $service_item_desc ); ?></p>			
					
			</section>
		<div class="clear"></div>
<?php
		} else {			
?>			
			<section class="four columns">
					
						<?php $service_item_image = get_post_meta($post->ID,'_cmb_service_image_upload',TRUE); ?>			
						<?php if($service_item_image != '') : ?>
							<?php echo $service_link_before; ?>
								<img src="<?php echo $service_item_image; ?>" />
							<?php echo $service_link_after; ?>
						<?php endif; ?>
						<h5><?php echo get_the_title($post->ID); ?> </h5>		
						<?php $service_item_desc = get_post_meta($post->ID,'_cmb_service_description',TRUE); ?>			
						<p><?php echo do_shortcode( $service_item_desc ); ?></p>			
					
			</section>
<?php
		}
		
	  endwhile;
	  
	}
?>

</div>		
<!-- END SERVICES SECTION -->