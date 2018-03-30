<?php
extract(shortcode_atts(array(
    'orderby'       => 'date',
    'slides'        => '',
    'order'         => 'ASC',
    'pagination'    => 'stroke',
    "el_class"      => ''
), $atts));
Mk_Static_Files::addAssets('mk_edge_one_pager');
Mk_Static_Files::addAssets('mk_page_section');