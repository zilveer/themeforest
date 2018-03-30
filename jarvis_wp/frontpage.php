<?php get_header(); 

/*
Template name: Frontpage Template
*/
global $current_page_id;
$current_page_id = get_option('page_on_front');

if ( ( $locations = get_nav_menu_locations() ) && $locations['main-menu'] ) {
    $menu = wp_get_nav_menu_object( $locations['main-menu'] );
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    $test_include = array();
    foreach($menu_items as $item) {
        if($item->object == 'page')
            $test_include[] = $item->object_id;
    }
	
	$args = array( 'post_type' => 'page', 'post__in' => $test_include, 'posts_per_page' => count($test_include), 'orderby' => 'post__in',  'suppress_filters'=> true );
	
	if( function_exists('CPTOrderPosts') )
    	remove_filter('posts_orderby', 'CPTOrderPosts', 99, 2);
    
	$frontpage_query = new WP_Query($args);
	
	

}
else{
    $args=array(
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'posts_per_page' => '-1',
	'suppress_filters'=> true
  );
    $frontpage_query = new WP_Query($args); 
}


$menu = 1;

    while ($frontpage_query->have_posts()) : $frontpage_query->the_post();

    global $post, $portfolio_grid;

    $post_name = $post->post_name;
    
    global $post_id;
	$post_id = get_the_ID();



	
		/* section post parent */
	$first_parent = array_reverse( get_post_ancestors( $post_id ) );
	if( !empty( $first_parent[0] ) ) {
		
		$first_parent = get_page($first_parent[0]);
		$post_parent = 'data-parent="' . $first_parent->post_name . '"';
		
	} else {
		
		$post_parent = NULL;
	
	}	
    
    $separate_page = get_post_meta($post_id, "rnr_separate_page", true); 
    if (($separate_page!= true )&& ($post_id != $current_page_id ))
    {
		
?>

<?php if (get_post_meta($post_id, "rnr_assign_type", true) == "parallax-section") { ?>

    <!-- START PARALLAX SECTION -->	
	<section id="<?php echo $post_name; ?>" class="parallax">
    <div class="rnr-offset" <?php echo $post_parent; ?> data-section="<?php echo $post_name; ?>"></div>
		<div class="parallax-overlay">
		<div class="container clearfix">
			<div class="parallax-content">
				<?php the_content(); ?>
			</div><!-- END PARALLAX CONTENT -->
		</div><!-- END CONTAINER -->
       </div><!-- END PATTERN OVERLAY -->
       <div class="rnr-scroll-up" data-section="<?php echo $post_name; ?>" <?php echo $post_parent; ?>></div>
	</section>
	<!-- END PARALLAX SECTION -->   
 
    
<?php } else if (get_post_meta($post_id, "rnr_assign_type", true) == "revolutionslider-section") { ?>
   
	<!-- START PARALLAX SECTION -->	
	<div id="<?php echo $post_name; ?>" class="revolutionslider-section">
          <?php if (get_post_meta( get_the_ID(), 'rnr_revolutionslider', true ) != '0') { ?>          
              <?php if(class_exists('RevSlider')){ putRevSlider(get_post_meta( get_the_ID(), 'rnr_revolutionslider', true )); } ?>          
          <?php } /* end slidertype = revslider */ ?>
	</div>
	<!-- END PARALLAX SECTION --> 
    
    <?php } else {
	 if (get_post_meta($post_id, "rnr_assign_type", true) == "home-section") { 
		  $home_type = $smof_data['rnr_home_type'];
		  $layout_type = $smof_data['rnr_home_look_type'];
		  $layout_return='';
		  $type_return='';
		  $menu_return='';
		  
		  if($home_type=="Full Width Content") {
			$type_return = 'home-parallax'; 
			  
		  } else if($home_type=="Boxed Content") {
			$type_return = 'home-parallax';
			  
		  }else if($home_type=="Revolution Slider") {
			$type_return = 'home-parallax';
			  
		  }else if($home_type=="FullScreen Slider") {
			   if($smof_data['rnr_fullscreenslider_as_background']) {
			     $type_return = 'home-fullscreenslider full-background';				   
			   } else {			 
			     $type_return = 'home-fullscreenslider';
			   }
			  
		  }else if($home_type=="Video") {
			$type_return = 'home-video';
			  
		  }
		  
		  
		  
		  if($layout_type=="Regular") {
			$layout_return = 'home-banner2';
			  
		  } else if($layout_type=="Regular with padding") {
			$layout_return = 'home-banner';
			  
		  }else if($layout_type=="Full Screen") {
			$layout_return = 'fullscreen';
			  
		  }	 
		  
          if($smof_data['rnr_menu_style'] == "bottom"){
			 $menu_return='pagescroll';
		  }	   
 
 }

 ?>   <div id="<?php echo $post_name; ?>" class="page<?php echo $post_id; ?> section <?php if (get_post_meta($post_id, "rnr_assign_type", true) == "home-section") echo $type_return,' ', $layout_return,' ', $menu_return; ?> <?php echo $post_name; ?><?php if ((get_post_meta($post_id, "rnr_assign_type", true) == "portfolio-section") || (get_post_meta($post_id, "rnr_assign_type", true) == "grid-portfolio-section") || (get_post_meta($post_id, "rnr_assign_type", true) == "portfolio-gallery")) echo ' ', 'rnr-portfolio'; ?>"><!-- SECTION -->
 
  <div class="rnr-offset" <?php echo $post_parent; ?> data-section="<?php echo $post_name; ?>"></div>



<?php if((get_post_meta($post_id, "rnr_assign_type", true) != "home-section") ){ ?>    

<?php if((get_post_meta( $post_id, 'rnr_disable_title', true )!= true) ){ ?>    
  
		<div class="container">	
           <div class="row">	
			<div data-effect="fadeInUp" class="rnr-animate animated sixteen columns">            
	            <!-- START TITLE -->	            
				<div class="title">
				  <h1 class="header-text"><?php if(get_post_meta( get_the_ID(), 'rnr_alt_title', true )){ echo get_post_meta( get_the_ID(), 'rnr_alt_title', true ); } else { the_title(); } ?></h1>                  
                      <?php if(get_post_meta( get_the_ID(), 'rnr_subtitle', true )){ echo '<div class="subtitle"><p>'.get_post_meta( get_the_ID(), 'rnr_subtitle', true ).'</p></div><!-- END SUBTITLE -->'; } ?>
                </div><!-- END TITLE -->  	                           
			</div><!-- END SIXTEEN COLUMNS -->  
           </div><!-- END ROW -->         
          </div><!-- END CONTAINER -->       
  <?php } ?>   
  <?php } ?>   
  

   <?php
	if (get_post_meta($post_id, "rnr_assign_type", true) == "home-section") { ?>
      <?php get_template_part('home_section');
	  
	}

	else if (get_post_meta($post_id, "rnr_assign_type", true) == "portfolio-section") { 



?>
      <div class="container">	
			<div data-effect="fadeInUp" class="sixteen columns rnr-animate animated">     
                <?php the_content(); ?>
            </div>
      </div>	
      <?php get_template_part('portfolio_section');
	}
	else if (get_post_meta($post_id, "rnr_assign_type", true) == "grid-portfolio-section") { 



?>
      <div class="container">	
			<div data-effect="fadeInUp" class="sixteen columns rnr-animate animated">     
                <?php the_content(); ?>
            </div>
      </div>	
      <?php get_template_part('portfolio_section2');
	}
	
	
	else if (get_post_meta($post_id, "rnr_assign_type", true) == "portfolio-gallery") { 



?>
      <div class="container">	
			<div data-effect="fadeInUp" class="sixteen columns rnr-animate animated">     
                <?php the_content(); ?>
            </div>
      </div>	
      <?php get_template_part('portfolio_section3');
	}
	
	else if (get_post_meta($post_id, "rnr_assign_type", true) == "contact-section") { ?>	
      <?php get_template_part('contact_section');
	}
	else { ?>

      <div class="container">	
			<div data-effect="fadeInUp" class="sixteen columns rnr-animate animate">     
                <?php the_content(); ?>
            </div>
      </div>	
		
	<?php } ?> 
    <div class="rnr-scroll-up" data-section="<?php echo $post_name; ?>" <?php echo $post_parent; ?>></div>  

    </div><!--END SECTION -->

    
<?php
    } ?>
    
    
   <?php if($menu==1){
        get_template_part('menu_section');
     } 	
	  $menu=2;
  }
    endwhile;
	wp_reset_postdata();
	if( function_exists('CPTOrderPosts') )
		add_filter('posts_orderby', 'CPTOrderPosts', 99, 2);


function rocknrolla_custom_scripts() {
global $smof_data; 
?>

<!-- CUSTOM TYPOGRAPHY STYLES -->
	
<script type="text/javascript">
jQuery.noConflict(); (function($) {				  
				  
	$(document).ready(function() {  
  
 <?php 

 	$args=array(
 	    'post_type' => 'page',
 	    'order' => 'ASC',
 	    'orderby' => 'menu_order',
 	    'posts_per_page' => '-1'
  	 );
 	$parallax_query = new WP_Query($args); 
	
    global $post;


     while ($parallax_query->have_posts()) : $parallax_query->the_post();
	    
	    $post_id = get_the_ID();
		 $post_name = $post->post_name;
		
		
	if (get_post_meta($post_id, "rnr_assign_type", true) == "parallax-section") {	?>
      $('#<?php echo $post_name; ?>').parallax("50%", 0.6);



<?php }
    endwhile;
	wp_reset_postdata();
 ?>
 
    <?php if($smof_data['rnr_home_type']=="FullScreen Slider") { ?>
	  
	jQuery(function($){
				
				$.supersized({
				
					// Functionality
					slideshow               :   1,			// Slideshow on/off
					autoplay				:   1,			// Slideshow starts playing automatically
					start_slide             :   1,			// Start slide (0 is random)
					stop_loop			   :   0,			// Pauses slideshow on last slide
					random				  :   0,			// Randomize slide order (Ignores start slide)
					slide_interval          :   4000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:   1000,		// Speed of transition
					new_window			  :   1,			// Image links open in new window/tab
					pause_hover             :   0,			// Pause slideshow on hover
					keyboard_nav            :   1,			// Keyboard navigation on/off
					performance			 :   1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect		   :   1,			// Disables image dragging and right click with Javascript
						   
					min_width		       :   0,			// Min width allowed (in pixels)
					min_height		      :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always			  :   0,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   1,			// Portrait images will not exceed browser height
					fit_landscape		   :   0,			// Landscape images will not exceed browser width
							
					slide_links			 :   'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					thumb_links			 :   0,			// Individual thumb links for each slide
					thumbnail_navigation    :   0,			// Thumbnail navigation
					slides 				  :   [						   
	               <?php $home_slider = $smof_data['rnr_home_slider'];
				   
				   
				   
                   if ( !empty( $home_slider )) {
                      foreach( $home_slider  as $slide){ ?>
						{image : '<?php echo $slide['url'] ?>', title : '<?php echo $slide['title'].'<div class="slidedescription">'.$slide['description'].'</div>'; ?>', thumb : '', url : '#'},
					  <?php } //end foreach ?>          
                    <?php } //end homeslider ?>],		   
					progress_bar		:	0,			// Timer for each slide							
					mouse_scrub			 :	0
					
				});
		    });
  
   <?php } ?> 
   

     <?php $detect = new Mobile_Detect;
	       if($smof_data['rnr_home_type']=="Video" && !$detect->isMobile() ) {      
	
	
	     if($smof_data['rnr_home_video_type']=="youtube") {  ?>    

		  jQuery(window).load(function(){        
		  
									
								  
								 		$(".rnr-video-player").YTPlayer();	
										
									
											  
								  
								  /* player mute control */
								  $(".rnr-video-control").on('click', function(event){
									  
									  event.preventDefault();		
									  
									  if( $(".rnr-video-control").hasClass("rnr-unmute") ) {
										  
										  $(this).removeClass("rnr-unmute").addClass("rnr-mute").text("MUTE");	
										  $(".rnr-video-player").setYTPVolume(100);													
										  $(".rnr-video-player").unmuteYTPVolume();
										  
									  } else if( $(".rnr-video-control").hasClass("rnr-mute") ){
										  
										  $(this).removeClass("rnr-mute").addClass("rnr-unmute").text("UNMUTE");
										  $(".rnr-video-player").muteYTPVolume();							
										  
									  }
							
							  });	
		  });
					
		<?php } else if ($smof_data['rnr_home_video_type']=="vimeo") {  ?>   
		 <?php if($smof_data['rnr_video_mute']) {
			 $vol = 0;
		 } else {
			 $vol = 100;
		 }?>	
		 
		  jQuery(window).load(function(){    		 

						  jQuery('.home-background-vimeo').okvideo({ 
						                          source: '<?php echo $smof_data['rnr_home_video_id']; ?>',
												  volume: '<?php echo $vol ?>', //set your vimeo video source here
												  loop: <?php echo $smof_data['rnr_enable_video_loop']; ?>,
												  adproof: true,// control the volume by setting a value from 0 to 99
												  autoplay: true
						   });
						   
		  });
						   
			<?php } ?>			   
   
<?php } ?> 			  
	});
	
})(jQuery);
</script> 
<?php }





add_action( 'wp_footer', 'rocknrolla_custom_scripts', 20 );

 get_footer(); ?>
