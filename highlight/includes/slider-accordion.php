<?php 
/**
 * This file contains the functionality of the accordion slider.
 */
?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/script/accordion-slider.js"></script>

<script type="text/javascript">
(function($){
	$(window).load(function(){
		$('#slider').accordionSlider();
	});
})(jQuery);
</script>

<div id="slider-container" class="center">
	<div class="slider-frame">
	<div id="slider"> 
      <div class="loading"></div>
      	
	
	  <?php 
			
			$sliderImagesArray=explode(PEXETO_SEPARATOR, get_option($slider_prefix.'_accord_image_names'));
			$linkArray= explode(PEXETO_SEPARATOR,get_option($slider_prefix.'_accord_image_links'));
			$titleArray= explode(PEXETO_SEPARATOR,get_option($slider_prefix.'_accord_image_titles'));
			$descArray= explode(PEXETO_SEPARATOR,get_option($slider_prefix.'_accord_image_descs'));
			
			$count=count($sliderImagesArray);
			$linkCount=count($linkArray);
			
			for($i=0;$i<$count-1;$i++){
			
				$showDesc=false;
				if($descArray[$i]!='' || $titleArray[$i]!='' || $linkArray[$i]!=''){
					$showDesc=true;
				}
				
				if(get_opt('_accord_auto_resize')=='on'){
					$path=pexeto_get_resized_image($sliderImagesArray[$i],700, 318, 100);
		      	}else{
					$path=$sliderImagesArray[$i];
		      	}
				echo('<div class="accordion-holder"><img src="'.$path.'" alt="" />');
				if($showDesc){
					echo('<div class="accordion-description">');
				if($titleArray[$i]!='') echo ('<h4>'.stripslashes($titleArray[$i]).'</h4>');
				if($descArray[$i]!='') echo ('<p>'.stripslashes($descArray[$i]).'</p>');
				if($linkArray[$i]!='') echo ('<a href="'.$linkArray[$i].'">'.get_opt('_learn_more').'</a>');
				echo('</div>');
				
				}
			echo('</div>');
		}
		?>
	<div class="inner-shadow-top"></div>
	<div class="inner-shadow-bottom"></div>
	<div class="inner-shadow-left"></div>
	<div class="inner-shadow-right"></div>
	</div>
	</div>
</div>