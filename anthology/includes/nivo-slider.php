<script type="text/javascript"
	src="<?php echo get_template_directory_uri(); ?>/script/jquery.nivo.slider.pack.js"></script>
	<?php 
$interval=get_opt('_nivo_interval');
$animation=get_opt('_nivo_animation');
$slices=get_opt('_nivo_slices');
$columns=get_opt('_nivo_columns')?get_opt('_nivo_columns'):8;
$rows=get_opt('_nivo_rows')?get_opt('_nivo_rows'):4;
$speed=get_opt('_nivo_speed');
$autoplay=get_opt('_nivo_autoplay')=='false'?'false':'true';
$pauseOnHover=get_opt('_nivo_pause_hover')=='false'?'false':'true';

$navigation=get_opt('_nivo_navigation');
switch ($navigation){
	case 'buttons': $buttons='true'; $arrows='false'; break;
	case 'arrows': $buttons='false'; $arrows='true'; break;
	case 'butarr': $buttons='true'; $arrows='true'; break;
	default : $buttons='false'; $arrows='false'; break;
}
?>
<script type="text/javascript">
jQuery(function(){
	pexetoSite.loadNivoSlider(jQuery('#nivo-slider'), "<?php echo $animation; ?>" , <?php echo $buttons; ?>, <?php echo $arrows; ?>, <?php echo $slices; ?>, <?php echo $speed; ?>, <?php echo $interval; ?>, <?php echo $pauseOnHover; ?>, <?php echo $autoplay; ?>, <?php echo $columns; ?>, <?php echo $rows; ?>);
});
</script>
<div id="slider-container">
<div id="slider-container-shadow"></div>

<div id="nivo-slider-container" class="center"> 
<div id="nivo-slider" class="center"> 
	
	  <?php 

$separator='|*|';

$sliderImagesString = get_option('_nivo_image_names');
$linkString=get_option('_nivo_image_links');
$descString=get_option('_nivo_image_desc');

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

<div id="slider-container-shadow-bottom"></div>
</div>

