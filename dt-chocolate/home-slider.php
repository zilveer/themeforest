<?php
/* Template Name: Homepage - Supersized Slider */

define('GAL_HOME', 1);
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="prevthumb"></div>
<div id="nextthumb"></div>

<!--Arrow Navigation-->
<a id="prevslide" class="load-item"></a>
<a id="nextslide" class="load-item"></a>

<div id="thumb-tray" class="load-item">
	<div id="thumb-back"></div>
	<div id="thumb-forward"></div>
</div>

<!--Time Bar-->
<!--<div id="progress-back" class="load-item">
	<div id="progress-bar"></div>
</div>-->

<?php if( !$dt_options['dt_hide_over_mask'] ): ?>
	<div id="big-mask"></div>
<?php endif; ?>

<!--Control Bar-->
<div id="controls-wrapper" class="load-item">
	<div id="controls">

		<!--Slide counter-->
		<div id="slidecounter">
			<span class="slidenumber"></span> / <span class="totalslides"></span>
		</div>
		
		<!--Slide captions displayed here-->
		<div id="slidecaption"></div>
		
		<!--Thumb Tray button-->
		<div class="but-play">
			<a id="play-button"></a>
			<a id="tray-button"></a>
		</div>
		
		<!--Navigation-->
		<ul id="slide-list"></ul>
		
	</div>
</div>
<?php get_footer(); ?>
