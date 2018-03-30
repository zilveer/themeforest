<?php
/*
Template Name: Home
*/
?>
<?php global $NHP_Options; ?>
<?php $options_morphis = $NHP_Options; ?>
<?php get_header(); ?>
	<?php 

		if( $options_morphis['toggleHeadline'] == '1' ) {	
			get_template_part('inc/headline'); 
		}
	?>
	
  </div>
  <!-- END HEADER CONTAINER-->         
	
	<!-- BEGIN SLIDER -->
	<?php $unique_home_slider = get_post_meta($post->ID,'_cmb_home_slider',TRUE); ?>
	
    <?php	if( $options_morphis['toggleSlider'] == '1' ) {	?>
				
				<?php if($options_morphis['select_slider'] == 'caroufredsel') : ?>
					<?php if($unique_home_slider == 'eislider') : ?>
						<?php	get_template_part('inc/ei-slider'); ?>
					<?php elseif($unique_home_slider == 'layerslider') : ?>
						<?php	get_template_part('inc/layer-slider'); ?>
					<?php else: ?>
						<?php	get_template_part('inc/slider'); ?>
					<?php endif; ?>
	
				<?php elseif($options_morphis['select_slider'] == 'eislider') : ?>
					<?php if($unique_home_slider == 'caroufredsel') : ?>
						<?php	get_template_part('inc/slider'); ?>
					<?php elseif($unique_home_slider == 'layerslider') : ?>
						<?php	get_template_part('inc/layer-slider'); ?>
					<?php else: ?>
						<?php	get_template_part('inc/ei-slider'); ?>
					<?php endif; ?>
					
				<?php elseif($options_morphis['select_slider'] == 'layerslider') : ?>
					<?php if($unique_home_slider == 'caroufredsel') : ?>
						<?php	get_template_part('inc/slider'); ?>
					<?php elseif($unique_home_slider == 'eislider') : ?>
						<?php	get_template_part('inc/ei-slider'); ?>
					<?php else: ?>
						<?php	get_template_part('inc/layer-slider'); ?>
					<?php endif; ?>
					
				<?php endif; ?>
				
	<?php	} ?>    
	<!-- END SLIDER -->
	
  <!-- MAIN CONTAINER -->
  <div class="container">	
	<!-- MAIN BODY -->
	<div id="main" role="main" class="sixteen columns">	
		<?php 
			global $wp_query;
			$page_id = $wp_query->get_queried_object_id();
			$page_data = get_page($page_id); 
			if ( $page_data ) {
				echo apply_filters('the_content',$page_data->post_content);
			}
		?>
		<!-- SERVICES SECTION -->
			
			<?php		if( $options_morphis['toggleServices'] == '1' ) { ?>	
			<?php			get_template_part('inc/services'); ?>
			<?php		} ?>			  
		<!-- END SERVICES SECTION -->
		<!-- RECENT WORKS SECTION -->						  
			
			<?php		if( $options_morphis['togglePortfolio'] == '1' ) {	?>
			<?php			get_template_part('inc/portfolio'); ?>
			<?php		}			  ?>  
		<!-- END RECENT WORKS SECTION -->
		<div class="clear"></div>
		<!-- LATEST BLOGS SECTION -->
		
		<?php		if( $options_morphis['toggleBlogs'] == '1' ) {	?>
		<?php			get_template_part('inc/blogs'); ?>
		<?php		}			  ?>  
		
		<div class="clear"></div>
    </div> 
	<!-- END MAIN BODY -->
  </div> 
  <!-- END MAIN CONTAINER --> 
 
 <?php if( $options_morphis['twitter_hide_below'] == '1' ) { ?>
		<?php twitter_strip($options_morphis['twitter_username']); ?>
 <?php } ?>

           
<?php get_footer(); ?>