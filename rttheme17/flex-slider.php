<?php
/* 
* rt-theme slider
*/
global $slides, $rttheme_slider_height, $crop_slider_images, $resize_slider_images,$slider_effect,$slider_timeout,$slider_buttons,$group_id,$sidebar,$this_item_layout,$rttheme_slider_width,$boxNumber,$logo_container,$header_background_image,$header_text,$slider_thumbs,$thumbs_width,$thumbs_height;

#
#	uniqueness
#
$slider_unique_name 	= "unique_".$group_id."_slider";
$carosel_unique_name 	= "unique_".$group_id."_slider_carousel";
$slider_buttons_name 	= "unique_".$group_id."_slider_buttons";

#
#	pager style
#
$pager_style = $slider_buttons ? $slider_buttons : "";

#
#	slider heights
#
 
$css 		= ($boxNumber != 1  ||  (is_front_page() && (trim($header_text) || $header_background_image))) ? 'style="top:0px !important;margin:0 auto !important;"' : "";
$theme_uri 	= THEMEURI;

#
#	thumbnail navigation defaults
#
$thumbs_width	= $thumbs_width ? $thumbs_width : 200;
$thumbs_height = $thumbs_height ? $thumbs_height : 90;

#
#	the slider effect
#
$slider_effect = $slider_effect ? $slider_effect : "fade";

if($pager_style=="on" || $pager_style==""){
echo <<<SCRIPT
	<script type="text/javascript">
	 /* <![CDATA[ */ 
		// Flex Slider and Helper Functions
		jQuery(window).load(function() {
		  jQuery('#$slider_unique_name').flexslider({
			   animation: "$slider_effect",
			   slideshowSpeed:$slider_timeout*1000,
			   controlsContainer: ".$slider_buttons_name",
			   smoothHeight: true,
			   directionNav: false,
			   after: onAfter,
			   before: onBefore
		  });
		});  
	/* ]]> */	
	</script>
SCRIPT;
}elseif($pager_style=="thumbnails"){
echo <<<SCRIPT
	<script type="text/javascript">
	 /* <![CDATA[ */ 
		// Flex Slider and Helper Functions with thumbnail navigation  
		jQuery(window).load(function() {
			jQuery('#$carosel_unique_name').flexslider({
				animation: "slide",
				controlNav: false, 
				itemWidth: $thumbs_width, 
				itemMargin: 20,
				animationLoop: false,
				slideshow: true, 
				slideshowSpeed:$slider_timeout*1000,
				asNavFor: '#$slider_unique_name'
			});

			jQuery('#$slider_unique_name').flexslider({
				animation: "$slider_effect",
				controlNav: false,
				animationLoop: false,
				slideshowSpeed:$slider_timeout*1000,
				slideshow: true,
				smoothHeight: true,
				directionNav: false,
				sync: "#$carosel_unique_name",
				after: onAfter,
				before: onBefore 
			}); 
		}); 


	/* ]]> */	
	</script>
SCRIPT;
}else{
echo <<<SCRIPT
	<script type="text/javascript">
	 /* <![CDATA[ */ 
		// Flex Slider and Helper Functions with thumbnail navigation  
		jQuery(window).load(function() {
			jQuery('#$carosel_unique_name').flexslider({
				animation: "slide",
				controlNav: false, 
				itemWidth: $thumbs_width, 
				itemMargin: 1,
				animationLoop: false,
				slideshow: true, 
				slideshowSpeed:$slider_timeout*1000,
				asNavFor: '#$slider_unique_name'
			});

			jQuery('#$slider_unique_name').flexslider({
				animation: "$slider_effect",
				controlNav: false,
				animationLoop: false,
				slideshowSpeed:$slider_timeout*1000,
				slideshow: true,
				smoothHeight: true,
				directionNav: false,
				sync: "#$carosel_unique_name",
				after: onAfter,
				before: onBefore 
			}); 
		});  
	/* ]]> */	
	</script>
SCRIPT;
}
?>


<!-- slider area -->	
<div class="slider_area box-shadow  <?php if(!$logo_container) echo "no-logo-container";?>" <?php echo $css;?>>
	<div class="slider"> 

		<div class="flex-container">
		  <div class="flexslider" id="<?php echo $slider_unique_name;?>">
		    <ul class="slides">


				<?php
				$SliderQuery = new WP_Query($slides); 

				$slider_image_width		= ($resize_slider_images) ? ($sidebar=="full" ) ? 940 : 668 : 100000; //max slide width
				$slider_image_height	= ($resize_slider_images && $crop_slider_images) ? $rttheme_slider_height : 100000; 		
				$background_images		= "";
				
				if ( $SliderQuery -> have_posts() ) : while ( $SliderQuery -> have_posts() ) : $SliderQuery -> the_post(); 
				
				$hide_title_and_text = get_post_meta($SliderQuery->post->ID, THEMESLUG.'hide_titles', true);
				$video_url = get_post_meta($SliderQuery->post->ID, THEMESLUG.'video_url', true);

				$custom_link = get_post_meta($SliderQuery->post->ID, THEMESLUG.'custom_link', true);	
				$title = get_the_title();
				$slide_text = get_post_meta($SliderQuery->post->ID, THEMESLUG.'slide_text', true);
				$thumb = get_post_thumbnail_id(); 
				$image = @vt_resize( $thumb, '', $slider_image_width, $slider_image_height, $crop_slider_images );

				?>
				 
					<li>
						<?php if(!$video_url):?>
								<!-- slide image -->
								<?php if($custom_link):?><a href="<?php echo $custom_link; ?>" title="<?php echo $title; ?>"><?php endif;?><img src="<?php echo $image["url"];?>" alt="<?php echo $title; ?>" /><?php if($custom_link):?></a><?php endif;?>
								<!-- /slide image -->
				
								<?php if($hide_title_and_text):?>
								<div class="flex-caption">
								  <div class="desc-background">
									  <h3>
											  <?php if($custom_link):?><a href="<?php echo $custom_link; ?>" title="<?php echo $title; ?>"><?php endif;?>
												  <?php echo $title; ?>
											 <?php if($custom_link):?></a><?php endif;?>
									  </h3>
										 <!-- slide text -->
										 <?php echo $slide_text; ?>
								  </div>
								</div>
								<?php endif;?>
						<?php else: 
								if( strpos($video_url, 'youtube')  ) { //youtube
									echo '<iframe  width="100%" height="'.$rttheme_slider_height.'" src="http://www.youtube.com/embed/'.find_tube_video_id($video_url).'" frameborder="0" allowfullscreen></iframe>';
								}
								
								if( strpos($video_url, 'vimeo')  ) { //vimeo
									echo '<iframe  src="http://player.vimeo.com/video/'.find_tube_video_id($video_url).'?color=d6d6d6&title=0&amp;byline=0&amp;portrait=0" width="100%" height="'.$rttheme_slider_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
								}
						 endif;?>
					</li>

		      <?php endwhile;endif;wp_reset_query();?> 
		    </ul>
		  </div>
		</div> 

		<?php if($pager_style=="on"):?>
			<!-- slider buttons -->
			<div class="flex-nav-container <?php echo $slider_buttons_name;?>"></div>
		<?php endif;?>
 

		<?php if($pager_style=="thumbnails"):?>
		<div id="<?php echo $carosel_unique_name;?>" class="flexslider slider-carousel margin-t20">
		  <ul class="slides">
				<?php
				$SliderQuery = new WP_Query($slides);  
				
				if ( $SliderQuery -> have_posts() ) : while ( $SliderQuery -> have_posts() ) : $SliderQuery -> the_post(); 
				 
				$title = get_the_title(); 
				$thumb = get_post_thumbnail_id(); 
				$image = @vt_resize( $thumb, '', $thumbs_width, $thumbs_height, "true" );

					echo '<li><img src="'.$image["url"].'" alt="'.$title.'" /></li>'; 

				endwhile;endif;wp_reset_query();
				?>	
		  </ul>
		</div>
		<?php endif;?>

		<?php if($pager_style=="headings"):?>
		<div id="<?php echo $carosel_unique_name;?>" class="flexslider slider-carousel margin-t0 title_navs">
		  <ul class="slides">
				<?php
				$SliderQuery = new WP_Query($slides); 
 	 
				if ( $SliderQuery -> have_posts() ) : while ( $SliderQuery -> have_posts() ) : $SliderQuery -> the_post(); 
				 
					$title = get_the_title();   
					echo '<li class="title_nav" style="position:relative;height:'.$thumbs_height.'px;text-align:center;"><span style="position:absolute;top:'.round($thumbs_height/2-6).'px;left:0;"><h4>'.$title.'</h4></span></li>';

				endwhile;endif;wp_reset_query();
				?>	
		  </ul>
		</div>
		<?php endif;?>

	</div>
</div><!-- / end div #slider_area -->  
<?php wp_reset_query();?> 