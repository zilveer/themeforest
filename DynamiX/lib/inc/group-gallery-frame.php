<?php 

/* ------------------------------------

:: CONFIGURE SLIDE

------------------------------------*/

	if($NV_movieurl && $NV_videotype=="")
	{ 
		// Check if using JW Player -> Add Skin if enabled
		 $isplayer = strpos($NV_movieurl, "player.swf");
		 
		if ($isplayer !== false)
		{	
			if( $NV_videoautoplay=="1" )
			{
				$NV_movieurl .= "&amp;autostart=true";
			}
				
			if( of_get_option('jwplayer_skin') )
			{
				$NV_movieurl .="&amp;skin=".of_get_option('jwplayer_skin');
			}
				
			if( of_get_option('jwplayer_skinpos') )
			{
				$NV_movieurl .="&amp;controlbar.position=".of_get_option('jwplayer_skinpos');
			}				
		}
	}
	
	// max width + frame effect
	if( !empty($NV_imgwidth) && $NV_verticalslide == 'horizontal' )
	{
		if( $NV_imageeffect == 'frame' )
		{
			$NV_maxwidth='style="max-width:'.($NV_imgwidth+12).'px"';
		}
		else
		{
			$NV_maxwidth='style="max-width:'.($NV_imgwidth-2).'px"';
		}		
	}

	if( empty($NV_previewimgurl) ) { // check what image to use, custom, featured, image within post. 
		$post_image_id = get_post_thumbnail_id(get_the_ID());
			if ($post_image_id) {
				$thumbnail = wp_get_attachment_image_src( $post_image_id, 'post-thumbnail', false);
				$NV_previewimgurl=$thumbnail[0];
				$NV_previewimgurl	=	parse_url($NV_previewimgurl, PHP_URL_PATH); // make relative Image URL
			} elseif($image) {
			$NV_previewimgurl=$image;
		}
	}
	
	if($NV_imageeffect=='shadowblackwhite') { $NV_imageeffect = 'shadow'; $NV_blackwhite='blackwhite'; } // add space for separate effects (shadow / black white)
	
	if(!isset($NV_gallery_postformat)) $NV_gallery_postformat=''; // check if postformat enabled
	

/* ------------------------------------

:: CONFIGURE SLIDE *END*

------------------------------------*/

?>

<?php if( $postcount == "1" ) { ?>
    <div class="groupslides-wrap" <?php if(isset($NV_panelformat)) echo $NV_panelformat; ?>>
<?php } ?>


	<div class="panel block columns <?php echo $NV_slidercolumns_text."_column "; if($postcount==$NV_slidercolumns) { echo 'last'; } ?>" <?php echo $NV_vertheight; ?>>
		<div class="slide-break"></div>
<?php if($NV_gallery_postformat=='yes') {
	
	global $NV_is_widget; $NV_is_widget=true; // stop comments displaying within gallery
	get_template_part( 'content', get_post_format() );	
	
} else { 


	if($NV_groupgridcontent!="text") { ?> 

    <?php if($NV_videotype) { // Check "Preview Image" field is completed ?>    
  
		<div class="container videotype <?php echo $NV_shadowsize.' '.$NV_imageeffect.' '.$NV_cssclasses; ?>">
			<div class="gridimg-wrap">
				<div class="title-wrap <?php echo $NV_blackwhite; ?>">
				
					<?php 
					
					$output = '';
					
					include(NV_FILES .'/inc/classes/video-class.php'); 
					
					// Create video output
					echo $output;					
					
					if(($NV_groupgridcontent=="titleoverlay" || $NV_groupgridcontent=="titletextoverlay")) { ?>	
                    <div class="title"><h3><?php if($NV_disablegallink!='yes') { ?><a href="<?php if($NV_galexturl) { echo $NV_galexturl; } ?>" title="<?php echo $NV_posttitle; ?>" target="_blank"><?php } ?><?php echo $NV_posttitle; ?><?php if($NV_disablegallink!='yes') { ?></a><?php } ?></h3>
                        <?php if($NV_groupgridcontent=="titletextoverlay") { ?>
                        <div class="overlaytext">
                        <?php echo do_shortcode($NV_description); ?>
                        </div> 
                        <?php } ?>
                    </div>	             
                    <?php } ?>	
                    
				</div><!-- / title-wrap -->    	
			</div><!-- / gridimg-wrap -->
		</div><!-- / container -->		    
        
    <?php } elseif($NV_previewimgurl) { // Check "Preview Image" field is completed ?>
   
		<div class="container <?php echo $NV_shadowsize.' '.$NV_imageeffect.' '.$NV_cssclasses; ?>">
			<div class="gridimg-wrap">
				<div class="title-wrap <?php echo $NV_blackwhite; ?>">

					<?php if(class_exists('WPSC_Query') || class_exists('Woocommerce')   && $NV_datasource=='data-5') { // Product Price  ?>
                        <?php if( !empty( $NV_productprice ) ) : ?>	<span class="productprice"><?php echo $NV_productprice; ?></span> <?php endif; ?>	  
                    <?php } 

					// Split Icon Space
					$split = '';
														
					if( $NV_lightbox == "yes" && $NV_disablegallink != 'yes' ) $split = 'split';
									
					// Set Link + Lightbox
					if( $NV_lightbox == "yes" )
					{ 
						$lightbox_url = $lightbox_type = $lightbox_iframe = '';

						// Lightbox iframe					
						if (strpos($NV_cssclasses, 'iframe_lightbox') !== FALSE)
						{
							$lightbox_iframe = 'data-fancybox-type="iframe"';
						}	
								
						if( !empty($NV_movieurl) )
						{
							$lightbox_url = $NV_movieurl;
							
							if( empty( $lightbox_iframe ) )
							{
								$lightbox_type = 'fa fa-play';
							}
							else
							{
								$lightbox_type = 'fa fa-expand';
							}
						}
						else
						{
							$lightbox_url = $NV_previewimgurl;
							$lightbox_type = 'fa fa-expand';
						}
										
						echo  '<a href="'. $lightbox_url .'" '. $lightbox_iframe .' data-fancybox-group="gallery'. $NV_shortcode_id .'" title="'. ( !empty( $NV_alt ) ? $NV_alt : $NV_posttitle ) .'" class="fancybox action-icons lightbox-icon '. $split .'"><i class="'. $lightbox_type .' fa-lg"></i></a>';
					}
		
					if( $NV_disablegallink != 'yes' )
					{ 
						echo '<a href="'. $NV_galexturl .'" class="action-icons link-icon '. $split .'"><i class="fa fa-link fa-lg"></i></a>';
					}				
                    

					if($NV_imageeffect=="reflection" || $NV_imageeffect=="shadowreflection") $class = 'gallery-img reflect'; else $class = 'gallery-img ';
						
                  echo '<img class="'. $class .'" src="'. $NV_imagepath .'" alt="'. $NV_posttitle .'" width="'. $NV_imgwidth .'" height="'. $NV_imgheight .'" />';


					if(($NV_groupgridcontent=="titleoverlay" || $NV_groupgridcontent=="titletextoverlay")) { ?>	
				<div class="title"><h3><?php if($NV_disablegallink!='yes') { ?><a href="<?php if($NV_galexturl) { echo $NV_galexturl; } ?>" title="<?php echo $NV_posttitle; ?>" target="_blank"><?php } ?><?php echo $NV_posttitle; ?><?php if($NV_disablegallink!='yes') { ?></a><?php } ?></h3>
                    
                    <?php if($NV_groupgridcontent=="titletextoverlay") { ?>
                    <div class="overlaytext">
                    <?php echo do_shortcode($NV_description); ?>
                	</div>      
                    <?php } ?>                              
                </div>	             
                <?php } ?>	
				</div><!-- / title-wrap --> 
			</div><!-- / gridimg-wrap -->
		</div><!-- / container -->				
				
	<?php } 
	
	} 

if(($NV_groupgridcontent!="image" && $NV_groupgridcontent!="titleoverlay" && $NV_groupgridcontent!="titletextoverlay" )) { ?>  

	<div class="panelcontent content <?php echo $NV_cssclasses. ' '. $NV_imageeffect; ?>"  <?php if(isset($NV_maxwidth)) echo $NV_maxwidth; ?>>
		
        <h3><?php if($NV_disablegallink!='yes') { ?>
        <a href="<?php if($NV_galexturl) { echo $NV_galexturl; } ?>" title="<?php echo $NV_posttitle; ?>"><?php } ?><?php echo $NV_posttitle; ?><?php if($NV_disablegallink!='yes') { ?></a>
		<?php } ?></h3>	

		<?php 
		if($NV_groupgridcontent!="titleimage")
		{ 
			echo do_shortcode($NV_description);
			
			if($NV_disablegallink!='yes' && $NV_disablereadmore!='yes')
			{
				echo themeva_readmore( $NV_galexturl );	 
			} 
		} ?>

	</div><!-- /panelcontent --> 
     
<?php } 	        
        
} // end of post format 
	
    echo '</div><!-- /panel -->';   

	if( empty( $total_count ) ) 
	{
		$total_count = 1;
	}
	else
	{
		$total_count++;
	}

	if( $postcount == $NV_slidercolumns || $total_count == $post_count )
	{ 
		$postcount = "0";
		
		echo '</div><!--  / groupslides-wrap -->';
	}