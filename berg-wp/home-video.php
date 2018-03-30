<?php
if (has_post_thumbnail()) {
	$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large_bg');
}

$videoUrl = get_post_meta(get_the_id(), 'section_home_video', true);
$videoMute = get_post_meta(get_the_id(), 'home_background_video_mute', true);
if($videoMute == '1') {
	$videoMute = 'true';
} else {
	$videoMute = 'false';
}

?>
<div class="video-controls hidden-xs">
	<div class="pause">
		<i class="icon-control-pause"></i>
	</div>
	<div class="play hidden">
		<i class="icon-control-play"></i>
	</div>
	<div class="fullscreen">
		<i class="icon-size-fullscreen"></i>
	</div>
</div>
<?php if ($videoUrl != ''): ?>
<section class="item hidden-xs">
	<div class="video-wrapper" style="position:absolute; width: 100%; height: 100%; left: 0; top: 0; "></div>
	<div id="P1" class="player" style="display:block; margin: auto; background: rgba(0,0,0,0.5);" data-property="{videoURL:'<?php echo $videoUrl; ?>',containment:'.video-wrapper',startAt:0,mute:<?php echo $videoMute;?>,autoPlay:true,loop:true,opacity:1, showControls: false}"></div>
	<?php if(YSettings::g('section_video_overlay1') == 'mask') : ?>
		<div class="video-mask hidden-xs" style="background: <?php echo YSettings::g('section_video_color_overlay1', get_the_id()) ;?> url('<?php echo THEME_DIR_URI .'/img/overlay.png';?>') repeat 0 0;"></div>
	<?php endif ;?>
	<?php if(YSettings::g('section_video_overlay1') == 'color_overlay') : ?>
		<div class="video-overlay hidden-xs" style="background: <?php echo YSettings::g('section_video_color_overlay1', get_the_id()) ;?>"></div>
	<?php endif ;?>
</section>
<?php else : ?>
<div class="home-bg-image" data-background="http://placehold.it/1440x900&amp;text=Please+select+video+url"></div>
<?php endif; ?>