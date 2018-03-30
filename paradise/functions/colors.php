<?php

function theme_get_color_styles(){
	global $_theme_colors;
	if (empty($_theme_colors)) {
		$_theme_colors = array();
		foreach(glob(get_theme_root() . '/' . get_template() . '/colors/*.css') as $color_file){
			if(preg_match('/Style name: "(.*?)"/i', file_get_contents($color_file), $match)){
				$_theme_colors[basename($color_file, ".css")] = trim($match[1]);
			}
		}
	}
	return $_theme_colors;
}

function theme_color_styles() {
	wp_register_style('css_main', get_bloginfo('template_directory') . '/stylesheets/styles.css');
	$_theme_colors = theme_get_color_styles();
	foreach ($_theme_colors as $color => $name) {
		wp_register_style("css_{$color}", get_bloginfo('template_directory') . "/colors/{$color}.css", array('css_main'), false, 'screen');
	}
	global $wp_styles;
	reset($_theme_colors);
	$default = get_option('default_theme_color', key($_theme_colors));
	$preset = (get_option('show_switcher') && isset($_COOKIE['style'])) ? $_COOKIE['style'] : false;
	$style_to_set = ($preset) ? $preset : $default;
	foreach ($_theme_colors as $color => $name) {
		if ($color != $style_to_set) {
			$wp_styles->registered["css_{$color}"]->add_data('alt', true);
		}
		$wp_styles->registered["css_{$color}"]->add_data('title', $color);
	}
}

function theme_color_switcher($action) {
	if (!get_option('show_switcher'))
		return;
	switch ($action) {
		case 'init':
 ?>
	<!-- Stylesheet switcher built on jQuery -->
	<script type="text/javascript">
		jQuery(function($) {
			var offset = $(".schemes").offset();
			var topPadding = 50;
			jQuery(window).scroll(function() {
				if (jQuery(window).scrollTop() > offset.top) {
					jQuery(".schemes").stop().animate({
						marginTop: $(window).scrollTop() - offset.top + topPadding
					});
				} else {
					jQuery(".schemes").stop().animate({
						marginTop: 0
					});
				};
			});
		});
		jQuery(function($)
			{
				$.stylesheetInit();
				$('.schemes a').bind(
					'click',
					function(e)
					{
						$.stylesheetSwitch(this.getAttribute('rel'));
						return false;
					}
				);
			}
		);
	</script>
 <?php
		break;
		case 'render':
			echo '<div class="schemes">';
			$url = home_url('/');
			foreach (theme_get_color_styles() as $color => $name) {
				echo "<a href='{$url}?style={$color}' rel='{$color}' class='{$color}' title='{$name}'>{$name}</a>";
			}
			echo '</div>';
		break;
	}
}

function enqueue_color_styles() {
	$_theme_colors = theme_get_color_styles();
	reset($_theme_colors);
	$default = get_option('default_theme_color', key($_theme_colors));
	$preset = (get_option('show_switcher') && isset($_COOKIE['style'])) ? $_COOKIE['style'] : false;
	$style_to_set = ($preset) ? $preset : $default;
	wp_enqueue_style("css_{$style_to_set}");
	foreach ($_theme_colors as $color => $name) {
		if ($color != $style_to_set) {
			wp_enqueue_style("css_{$color}");
		}
	}
}


?>
