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

 
echo <<<SCRIPT
	<script type="text/javascript">
	 /* <![CDATA[ */ 
		// Nivo Slider
		jQuery(window).load(function() {
		  jQuery('#$slider_unique_name').nivoSlider({
				pauseTime:$slider_timeout*1000, // How long each slide will show	
				captionOpacity:1,
				controlNav: true 	 
		  });
		});  
	/* ]]> */	
	</script>
SCRIPT;
?>


<!-- slider area -->	
<div class="slider_area box-shadow  <?php if(!$logo_container) echo "no-logo-container";?>" <?php echo $css;?>>
	<div class="slider"> 

		<div class="nivo-container theme-default">
		  <div class="nivoSlider " id="<?php echo $slider_unique_name;?>">
		   

				<?php
				$SliderQuery = new WP_Query($slides); 

				$slider_image_width		= ($resize_slider_images) ? ($sidebar=="full" ) ? 940 : 668 : 100000; //max slide width
				$slider_image_height	= $rttheme_slider_height;
				$background_images		= "";
				$captions				= "";
				
				if ( $SliderQuery -> have_posts() ) : while ( $SliderQuery -> have_posts() ) : $SliderQuery -> the_post(); 
				
				$hide_title_and_text = get_post_meta($SliderQuery -> post->ID, THEMESLUG.'hide_titles', true); 
				$custom_link = get_post_meta($SliderQuery -> post->ID, THEMESLUG.'custom_link', true);	
				$title = get_the_title();
				$slide_text = get_post_meta($SliderQuery -> post->ID, THEMESLUG.'slide_text', true);
				$thumb = get_post_thumbnail_id(); 
				$image = @vt_resize( $thumb, '', $slider_image_width, $slider_image_height, $crop_slider_images );

				if ($hide_title_and_text):
					$nivo_title = '#slide_'.$post->ID.'_caption';
					$nivo_alt  = trim(strip_tags($title));
				else:
					$nivo_title = '';
					$nivo_alt  = trim(strip_tags($title));
				endif;
				?>
				  
	
				<?php if($custom_link):?><a href="<?php echo $custom_link; ?>" title="<?php echo $title; ?>"><?php endif;?>
					<!-- slide image -->
					<img src="<?php echo $image["url"];?>" alt="<?php echo $nivo_alt; ?>"  title="<?php echo $nivo_title;?>" />
					<!-- /slide image -->
				<?php if($custom_link):?></a><?php endif;?>

		
				<?php
				if ($hide_title_and_text):

					$captions.="";
					$captions.='<div id="slide_'.$post->ID.'_caption" class="nivo-html-caption"><div class="desc-background">'."\n";  
					if($custom_link) : $captions.='<div class="nivo-title">'."\n"; else: $captions.='<div class="nivo-title no-link">'."\n"; endif;
					$captions.='<h3 class="nocufon">';
					if($custom_link)  $captions.='<a href="'.$custom_link.'" title="'.$title.'">'."\n"; 
					$captions.= $title."\n"; 
					if($custom_link) $captions.='</a>'."\n";
					$captions.='</h3>';
					$captions.= "</div>\n"; 
					if($slide_text) $captions.= '<div class="nivo-text">'.$slide_text.'</div>'."\n";  
					$captions.='</div></div>'."\n";
		
				endif;
				?>         
			 
		      <?php endwhile;endif;wp_reset_query();?> 
		 
		  </div>

			<!-- captions  -->
			<?php echo $captions;?>
			<!-- /captions -->

		</div> 

  
	</div>
</div><!-- / end div #slider_area -->  
<?php wp_reset_query();?> 