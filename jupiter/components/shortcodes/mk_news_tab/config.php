<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract( shortcode_atts( array(
	'el_class' 		=> '',
	'widget_title' 	=> '',
	'responsive' 	=> 'true',
	'tab_title' 	=> 'News',
), $atts ) );
Mk_Static_Files::addAssets('mk_news_tab');
