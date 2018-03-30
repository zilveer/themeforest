<?php
extract( shortcode_atts( array(
	'id' => '',
), $atts ) );
Mk_Static_Files::addAssets('mk_revslider');