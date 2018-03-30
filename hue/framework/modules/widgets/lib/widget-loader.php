<?php

if(!function_exists('hue_mikado_register_widgets')) {

	function hue_mikado_register_widgets() {

		$widgets = array(
			'HueMikadoLatestPosts',
			'HueMikadoSearchOpener',
			'HueMikadoSideAreaOpener',
			'HueMikadoStickySidebar',
			'HueMikadoSocialIconWidget',
			'HueMikadoSeparatorWidget',
			'HueMikadoCallToActionButton',
			'HueMikadoHtmlWidget',
			'HueMikadoPostCategories'
		);

		foreach($widgets as $widget) {
			register_widget($widget);
		}
	}
}

add_action('widgets_init', 'hue_mikado_register_widgets');