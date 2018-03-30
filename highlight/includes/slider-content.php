<?php 
/**
 * This file contains the functionality of the accordion slider.
 */
?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/script/jquery-easing.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/script/content-slider.js"></script>

<?php 
$shownavigation=explode(',', get_opt('_content_navigation'));
$showarrows=in_array('arrows', $shownavigation)?"true":"false";
$showbuttons=in_array('buttons', $shownavigation)?"true":"false";
$autoplay=get_opt('_content_autoplay')=='on'?"true":"false";
$interval=get_opt('_content_interval');
$pauseInterval=get_opt('_content_pause');
$pauseOnHover=get_opt('_content_pause_hover')=='on'?"true":"false";
$easing=get_opt('_content_animation');
?>

<script type="text/javascript">
(function($){
	$(window).load(function(){
		$('#content-slider').pexetoSlider({buttons:<?php echo $showbuttons;?>,
										   arrows:<?php echo $showarrows;?>,
										   autoplay:<?php echo($autoplay); ?>, 
										   animationInterval:<?php echo($interval);?>,
										   pauseInterval:<?php echo($pauseInterval);?>, 
										   pauseOnHover:<?php echo($pauseOnHover); ?>,
										   easing:"<?php echo $easing; ?>"});
	});
})(jQuery);
</script>

	<div class="center">
	<div id="content-slider"> 
      <ul id="slider-ul">
		
	
	  <?php 
	  
			$sliderImagesArray=explode(PEXETO_SEPARATOR, get_option($slider_prefix.'_content_image_names'));
			$linkArray= explode(PEXETO_SEPARATOR,get_option($slider_prefix.'_content_image_links'));
			$titleArray= explode(PEXETO_SEPARATOR,get_option($slider_prefix.'_content_image_titles'));
			$descArray= explode(PEXETO_SEPARATOR,get_option($slider_prefix.'_content_image_descs'));
			
			$count=count($sliderImagesArray);
			$linkCount=count($linkArray);
			
			for($i=0;$i<$count-1;$i++){
			

				if(get_opt('_content_auto_resize')=='on'){
					$path=pexeto_get_resized_image($sliderImagesArray[$i],450, 280);
		      	}else{
					$path=$sliderImagesArray[$i];
		      	}
				echo('<li><div class="slider-text">');
				if($titleArray[$i]!='') echo ('<h2>'.stripslashes($titleArray[$i]).'</h2>');
				if($descArray[$i]!='') echo ('<p>'.do_shortcode(stripslashes($descArray[$i])).'</p>');
				if($linkArray[$i]!='') echo ('<a href="'.$linkArray[$i].'" class="button-small header-button"><span>'.get_opt('_learn_more').'</span></a>');
				echo('</div><img src="'.$path.'" alt="" class="slider-frame"></li>');
				
		}
		?>
	
	</ul>
	</div>
</div>