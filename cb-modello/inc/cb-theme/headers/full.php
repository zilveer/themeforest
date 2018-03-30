<?php
/* fullscreen slider */

//require (get_template_directory () . '/inc/cb-theme/cb-theme-options.php');

?>
<?php if( $full_slider_style=='1'){ ?>
<div id="prevthumb"></div>
<div id="nextthumb"></div>
<?php if($full_slider_nav=='1') { ?>
<a id="prevslide" class="load-item"></a>
<a id="nextslide" class="load-item"></a>
<?php } ?>
<div id="thumb-tray" class="load-item">
	<div id="thumb-back"></div>
	<div id="thumb-forward"></div>
</div>
<div id="progress-back" class="load-item">
	<div id="progress-bar"></div>
</div>
<div id="controls-wrapper" class="load-item">
	<div id="controls">
		<a id="play-button"><img id="pauseplay"
			src="<?php echo WP_THEME_URL.'/inc/js/supersized/slideshow/'; ?>img/pause.png" />
		</a>
		<div id="slidecounter">
			<span class="slidenumber"></span> / <span class="totalslides"></span>
		</div>
		<div id="slidecaption"></div>
		<a id="tray-button"><img id="tray-arrow"
			src="<?php echo WP_THEME_URL.'/inc/js/supersized/slideshow/'; ?>/img/button-tray-up.png" />
		</a>
		<ul id="slide-list"></ul>
	</div>
</div>
<?php } ?>