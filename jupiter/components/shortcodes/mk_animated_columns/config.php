<?php
global $mk_options;
	extract( shortcode_atts( array(
		'column_number'         => 4,
		'columns'              	=> '',
		'style'                	=> 'full',
		'orderby'              	=> 'date',
		'order'                	=> 'DESC',
		'title_size'           	=> '20',
		'icon_color'           	=> '',
		'icon_hover_color'     	=> '',
		'icon_size'            	=> 16,
		'txt_color'            	=> '',
		'txt_hover_color'       => '',
		'btn_color'             => '',
		'btn_hover_color'       => '',
		'btn_hover_txt_color'  	=> '',
		'border_color'          => '',
		'bg_color'              => '',
		'bg_hover_color'        => '',
		'el_class'              =>'',
		'column_height'         => 500,
		'animation'             => '',
	), $atts ) );
Mk_Static_Files::addAssets('mk_animated_columns');