<?php
extract( shortcode_atts( array(
	 'tabs' 			=> '',
	 'orderby'			=> 'date',
	 'order'			=> 'DESC',
	 'autoplay_time' 	=> 5000,
	 'animation' 		=> '',
	 'button_size' 		=> '20',
	 'button_color' 	=> '',
	 "el_class" 		=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_tab_slider');