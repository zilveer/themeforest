<?php
extract(shortcode_atts(array(
    'size' 	=> '40',
    'visibility' 	=> ''
) , $atts));
Mk_Static_Files::addAssets('mk_padding_divider');
