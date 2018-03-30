<script type="text/javascript"
	src="<?php echo get_template_directory_uri(); ?>/script/slider.js"></script>
	<?php 
$autoplay=get_opt('_thum_autoplay')=='false'?'false':'true';
$interval=get_opt('_thum_interval');
$pauseInterval=get_opt('_thum_pause');
$pauseOnHover=get_opt('_thum_pause_hover')=='false'?'false':'true';
?>
<script type="text/javascript">
(function($){
$(window).load(function(){
		$('#slider').slider({thumbContainerId:'slider-navigation', autoplay:<?php echo($autoplay); ?>, interval:<?php echo($interval);?>, pauseInterval:<?php echo($pauseInterval);?>, pauseOnHover:<?php echo($pauseOnHover); ?>});
});
})(jQuery);

</script>
<div id="slider-container">
<div id="slider-container-shadow"></div>

<div id="slider" class="center"> 
<div class="loading"></div>
	  <?php 

$separator='|*|';

$sliderImagesString = get_option('_thum_image_names');
$linkString=get_option('_thum_image_links');
$descString=get_option('_thum_image_desc');

$sliderImagesArray=explode($separator, $sliderImagesString);
$linkArray= explode($separator,$linkString);
$descArray= explode($separator,$descString);

$count=count($sliderImagesArray);
$linkCount=count($linkArray);

for($i=0;$i<$count-1;$i++){

	if($i<$linkCount && $linkArray[$i]!=''){
		echo('<a href="'.$linkArray[$i].'">');
	}
	echo('<img src="');
	$path=$sliderImagesArray[$i];
	echo($path);
	echo('" alt=""');
	if($descArray[$i]!=''){
		echo(' title="'.$descArray[$i].'"');
	}
	echo('/>');
	if($i<$linkCount && $linkArray[$i]!=''){
		echo('</a>');
	}
}
?>
	
</div>

<div id="slider-container-shadow-bottom"></div>
</div>
<div id="slider-navigation-container">
	  <div class="hr"></div>
 
 <div class="center relative">
      <div id="slider-navigation" >
      <div class="items">
      	<?php 
      	$closed=true;
      	for($i=0;$i<$count-1;$i++){
      		if($i%6==0){ 
      			echo('<div>'); 
      			$closed=false;
      		}
      		if(get_opt('_thum_auto_resize')=='true'){
      			echo('<img src="'.pexeto_get_resized_image($sliderImagesArray[$i], 120, 80).'" alt="" />');
      		}else{
      			echo('<img src="'.$sliderImagesArray[$i].'" alt="" />');
      		}
			if(($i+1)%6==0){
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

	  <div class="hr"></div>
</div>
