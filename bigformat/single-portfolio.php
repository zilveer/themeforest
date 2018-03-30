<?php get_header(); ?>

<?php 

global $vendor;

/* #Get Video URL */
$video_url = get_post_meta(get_the_ID(), 'ag_video_url', true);	

/* #If Video URL
======================================================*/
if ($video_url != '') : 

$vendor = parse_url($video_url); 

/* #If Youtube */
	if ($vendor['host'] == 'www.youtube.com' || $vendor['host'] == 'youtu.be' || $vendor['host'] == 'www.youtu.be' || $vendor['host'] == 'youtube.com'){ 
 		get_template_part('youtube');
	}
	
/* #If Vimeo */
	if ($vendor['host'] == 'vimeo.com'){ 
 		get_template_part('vimeo');
	}
?>
<?php 
/* #Else if not Video
======================================================*/
else :  ?>

<!--Lines Overlay-->
<div class="lines"></div>  

<!--Supersized Background-->               
<script type="text/javascript">
			jQuery(function($){
				
				$.supersized({
					slideshow               :   1,			// Slideshow on/off
					autoplay				:	<?php echo of_get_option('of_portfolio_autoplay', '1'); ?>,		
					start_slide             :   1,			// Start slide (0 is random)
					stop_loop				:	0,			// Pauses slideshow on last slide
					random					: 	0,			// Randomize slide order (Ignores start slide)
					slide_interval          :   <?php echo of_get_option('of_portfolio_autoplay_delay', '5'); ?>000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade
					transition_speed		:	1000,		// Speed of transition
					new_window				:	0,			// Image links open in new window/tab
					pause_hover             :   0,			// Pause slideshow on hover
					keyboard_nav            :   0,			// Keyboard navigation on/off
					performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	<?php if ( $imageprotect = get_option('of_image_protect') ) { echo $imageprotect; } else { echo '1'; }?>,			// Disables image dragging and right click with Javascript
					
															   
					// Size & Position						   
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					<?php  if (have_posts()) : while (have_posts()) : the_post();
							get_portfolio_info ($post->ID, $thumbnum);
							endwhile; endif; ?>
					fit_always				:	<?php echo $fitalways; ?>,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   <?php echo $fitportrait; ?>,			// Portrait images will not exceed browser height
					fit_landscape			:   <?php echo $fitlandscape; ?>,			// Landscape images will not exceed browser width
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					thumb_links				:	1,			// Individual thumb links for each slide
					thumbnail_navigation    :   0,			// Thumbnail navigation
					slides 					:  	[			// Slideshow Images
												 
					     <?php global $ag_loopcounter; $ag_loopcounter = 1;
						 	   if ( $thumbnum = of_get_option('of_thumbnail_number') ) { $thumbnum = ($thumbnum + 1); } else { $thumbnum = 7;}

						 if (have_posts()) : while (have_posts()) : the_post();	?>
						{image : '<?php  echo $full[0]; ?>', thumb : '<?php  echo $thumb[0]; ?>'} 

						<?php $counter = 2;
						while ($counter < ($thumbnum)) :
                        
							if ( ${'thumb' . $counter}) : ?>
                               , {image : '<?php echo ${'full' . $counter}[0]; ?>', thumb : '<?php  echo ${'thumb' . $counter}[0]; ?>'}  
							<?php $ag_loopcounter++;
							endif; $counter++;
							
						endwhile; ?>
						
					 
						 ],
												
					// Theme Options			   
					progress_bar			:	<?php if ( $portprogressbar = get_option('of_portfolio_progress_bar') ) { echo $portprogressbar; } else { echo '1'; }?>,			// Timer for each slide							
					mouse_scrub				:	0
					
				});
		    });
			
		    
</script>
<!--End Supersized Background-->               

<?php ag_loophide($ag_loopcounter); //Hide Controls if Only 1 Slide. Located in functions.php ?>
        
<!-- Page Title
  ================================================== -->
<div class="contentarea"><div class="clear"></div><!-- For Stupid ie7-->

<div class="singleproject"><div class="clear"></div><!-- For Stupid ie7-->
    <div class="full page"><div class="clear"></div><!-- For Stupid ie7-->
        <div class="pagename"><div class="clear"></div><!-- For Stupid ie7-->
                <div class="tipsy tipsy-w tipsy-on">
                	<div class="tipsy-arrow tipsy-arrow-w"></div>
               		<div class="tipsy-inner">
               			<?php _e('More Info', 'framework'); ?>
               		</div>
                </div>
                <a href="#" class="toggleproject tool-project" data-hidetext="<?php _e('Hide Text', 'framework');?>" data-showtext="<?php _e('More Info', 'framework'); ?>" data-url="closed" title="<?php _e('More Info', 'framework'); ?>"><?php _e('Read More', 'framework'); ?></a> 
        </div>
    </div>
</div>

<!-- Mobile and SEO Friendly Images
  ================================================== -->
<div class="wmuSlider <?php if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', '2-slide', NULL,  'portfoliosmallnc') != '' ) { echo 'projectslideshow'; }?>" data-autoplay="<?php echo of_get_option('of_portfolio_autoplay') ? of_get_option('of_portfolio_autoplay') : 'true';?>" data-autoplay-delay="<?php echo of_get_option('of_portfolio_autoplay_delay') ? of_get_option('of_portfolio_autoplay_delay') . '000' : '7000';?>">
    <div class="wmuSliderWrapper">
        <span><img src="<?php  echo $thumb[0]; ?>" alt="<?php if ($alt) { echo str_replace('"', "", $alt); } else { echo the_title(); } ?>" title="<?php if ($alt) { echo str_replace('"', "", $alt); } else { echo the_title(); } ?>" class="scale-with-grid"/></span>
        
        <?php $counter = 2;
        
        while ($counter < ($thumbnum)) :
        
            if ( ${'thumb' . $counter}) : ?>
                <span><img src="<?php  echo ${'thumb' . $counter}[0]; ?>" alt="<?php if (${'alt' . $counter}) { echo str_replace('"', "", ${'alt' . $counter}); } else { echo the_title(); } ?>" title="<?php if (${'alt' . $counter}) { echo str_replace('"', "", ${'alt' . $counter}); } else { echo the_title(); } ?>" class="scale-with-grid"/></span>
            <?php endif; $counter++;
            
        endwhile; ?>
    </div>
</div>

<!-- Page Content
  ================================================== -->
<div class="projectcontent">
 <div class="namecontainer container singleproject">
        <div class="pagename">
           <h2><span> <?php the_title(); ?></span></h2>
        </div>
</div>
 <div class="container clearfix ">
        <div class="smallpage">
            <?php $content = get_the_content(); if($content  != '') : // if there is content ?>
            <div class="content pagebg">
                <div class="contentwrap">
                    <?php the_content(); ?>
                    <div class="clear"></div>
                    <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
                    
                 	 <?php show_social_icons(get_permalink(),get_the_title()); ?>
                    
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <?php endif; ?>
            <?php comments_template('', true);?>
        </div>
    </div>

</div>

</div>
<!--Thumbnail Navigation-->
<div id="prevthumb"></div>
<div id="nextthumb"></div>
<!--Navigation-->
<ul id="slide-list">
</ul>
<?php endwhile; endif; ?>
<?php endif; ?>
<!-- Page Content
  ================================================== -->
</div>
<?php get_footer(); ?>