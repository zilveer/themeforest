<?php
extract( shortcode_atts( array(
	'el_class'    	=> '',
	"style"     	=> 'quote-style',
	"font_size_combat"=> 'false',
    "force_font_size" => 'false',
    'size_smallscreen' => '0',
    'size_tablet' => '0',
    'size_phone' => '36',
	"text_size"   	=> '12',
	"font_family"   	=> '',
	'animation'   	=> '',
	"font_type"   	=> '',
), $atts ) );
Mk_Static_Files::addAssets('mk_blockquote');
