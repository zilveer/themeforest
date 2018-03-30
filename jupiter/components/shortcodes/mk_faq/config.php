<?php
extract( shortcode_atts( array(
	"sortable"  => 'true',
	'order'     => 'ASC',
	'count'     => 50,
	'style'     => 'fancy',
    'view_all_text'      => 'All',
	'offset'    => 0,
	'orderby'   => 'date',
	'faq_cat'   => '',
	'posts'		=> '',
	'background_color' => '',
	'el_class'	=> ''
), $atts ) );
Mk_Static_Files::addAssets('mk_faq');
Mk_Static_Files::addAssets('vc_accordions');