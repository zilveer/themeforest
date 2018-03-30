<script type="text/javascript"
	src="<?php echo get_template_directory_uri(); ?>/script/jquery.nivo.slider.pack.js"></script>
	<?php 
$interval=get_opt('_nivo_interval');
$animation=get_opt('_nivo_animation');
$slices=get_opt('_nivo_slices');
$columns=get_opt('_nivo_columns');
$rows=get_opt('_nivo_rows');
$speed=get_opt('_nivo_speed');
$autoplay=get_opt('_nivo_autoplay')=='on'?'true':'false';
$pauseOnHover=get_opt('_nivo_pause_hover')=='on'?'true':'false';

$shownavigation=explode(',', get_opt('_nivo_navigation'));
$arrows=in_array('arrows', $shownavigation)?"true":"false";
$buttons=in_array('buttons', $shownavigation)?"true":"false";

?>
<script type="text/javascript">
jQuery(function(){
	pexetoSite.loadNivoSlider(jQuery('#nivo-slider'), "<?php echo $animation; ?>" , <?php echo $buttons; ?>, <?php echo $arrows; ?>, <?php echo $slices; ?>, <?php echo $speed; ?>, <?php echo $interval; ?>, <?php echo $pauseOnHover; ?>, <?php echo $autoplay; ?>, <?php echo $columns; ?>, <?php echo $rows; ?>);
});
</script>
<div id="slider-container" class="center">

<div class="slider-frame">
<div id="nivo-slider"> 
	  <?php 


$sliderImagesArray=explode(PEXETO_SEPARATOR, get_option($slider_prefix.'_nivo_image_names'));
$linkArray= explode(PEXETO_SEPARATOR,get_option($slider_prefix.'_nivo_image_links'));
$descArray= explode(PEXETO_SEPARATOR,get_option($slider_prefix.'_nivo_image_descs'));

$count=count($sliderImagesArray);
$linkCount=count($linkArray);

for($i=0;$i<$count-1;$i++){

	if($i<$linkCount && $linkArray[$i]!=''){
		echo('<a href="'.$linkArray[$i].'">');
	}
	echo('<img src="');
	if(get_opt('_nivo_auto_resize')=='true'||get_opt('_nivo_auto_resize')=='on'){
		$path=pexeto_get_resized_image($sliderImagesArray[$i],940, 318);
	}else{
		$path=$sliderImagesArray[$i];
	}
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
<?php if($buttons=='true'){ ?>
<div id="nivo-controlNav-holder"></div>
<?php } ?>

</div>

