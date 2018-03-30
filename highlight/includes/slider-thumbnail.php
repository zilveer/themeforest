<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/script/slider.js"></script>
<?php 
	$autoplay=get_opt('_thum_autoplay')=='on'?'true':'false';
	$interval=get_opt('_thum_interval');
	$pauseInterval=get_opt('_thum_pause');
	$pauseOnHover=get_opt('_thum_pause_hover')=='on'?'true':'false';
?>	
	
<script type="text/javascript">
(function($){
	$(window).one('load',function(){
		$('#slider').slider({thumbContainerId:'slider-navigation', autoplay:<?php echo($autoplay); ?>, interval:<?php echo($interval);?>, pauseInterval:<?php echo($pauseInterval);?>, pauseOnHover:<?php echo($pauseOnHover); ?>});
	});
})(jQuery);
</script>

<div id="slider-container" class="center">
    <div id="slider" class="slider-frame"> 
    <div id="slider-img-wrapper">
		<div class="loading"></div>
		
			  <?php 
					
					$sliderImagesArray=explode(PEXETO_SEPARATOR, get_option($slider_prefix.'_thum_image_names'));
					$linkArray= explode(PEXETO_SEPARATOR, get_option($slider_prefix.'_thum_image_links'));
					$descArray= explode(PEXETO_SEPARATOR, get_option($slider_prefix.'_thum_image_descs'));
					
					$count=count($sliderImagesArray);
					$linkCount=count($linkArray);
					
					for($i=0;$i<$count-1;$i++){
					
						if($i<$linkCount && $linkArray[$i]!=''){
							echo('<a href="'.$linkArray[$i].'">');
						}
						echo('<img src="');
					if(get_opt('_thum_auto_resize')=='true' || get_opt('_thum_auto_resize')=='on'){
						$path=pexeto_get_resized_image($sliderImagesArray[$i],940, 318, 100);
		      		}else{
						$path=$sliderImagesArray[$i];
		      		}
					echo($path);
					echo('" alt=""');
					if($i==0){
						echo(' class="first"');
					}
					if($descArray[$i]!=''){
						echo(' title="'.stripslashes($descArray[$i]).'"');
					}
					echo('/>');
					if($i<$linkCount && $linkArray[$i]!=''){
						echo('</a>');
					}
				}
				?>									
	
 	</div>
 	</div>
 	</div>
 	<?php $nav_class=$count<=9?'no-arrows':'with-arrows'; ?>
    <div id="slider-navigation-container" class="center <?php echo $nav_class; ?>">
      <div class="relative">
        <div id="slider-navigation" >
      	  <div class="items">
	      	<?php 
	      	$closed=true;
	      	for($i=0;$i<$count-1;$i++){
	      		if($i%9==0){ 
	      			echo('<div>'); 
	      			$closed=false;
	      		}
	      		if(get_opt('_thum_auto_resize')=='true' || get_opt('_thum_auto_resize')=='on'){
	      			$path=pexeto_get_resized_image($sliderImagesArray[$i],70, 50, 50);
	      		}else{
	      			$path=$sliderImagesArray[$i];
	      		}
	      		echo('<img src="'.$path.'" alt="" />');
				if(($i+1)%9==0){
					echo('</div>');
					$closed=true;
				}
			}
			if(!$closed){
				echo('</div>');
			}
	      	?>
        </div>
      </div>
    </div>
  </div>
