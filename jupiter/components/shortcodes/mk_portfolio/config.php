<?php
extract(shortcode_atts(array(
     'style'                  => 'classic',
     'column'                 => 3,
     'count'                  => 10,
     'permalink_icon'         => 'true',
     'zoom_icon'              => 'true',
     'pagination'             => 'true',
     'meta_type'              => 'category',
     'pagination_style'       => '1',
     'height'                 => 300,
     'categories'             => '',
     'author'                 => '',
     'posts'                  => '',
     'offset'                 => 0,
     'order'                  => 'DESC',
     'orderby'                => 'date',
     'ajax'                   => 'false',
     'target'                 => '_self',
     'hover_scenarios'        => 'slidebox',
     'grid_spacing'           => 4,
     'el_class'               => '',
     'image_size'             => 'crop',
     "sortable"               => 'true',
     'sortable_align'         => 'left',     
     'sortable_style'         => 'classic', 
     'sortable_mode'          => 'ajax',
     'sortable_bg_color'      => '#1a1a1a',
     'sortable_txt_color'     => '#cccccc',
     'sortable_all_text'      => 'All',
     'excerpt_length'         => 200,

), $atts));
Mk_Static_Files::addAssets('mk_portfolio');

$style = ($style == 'modern') ? 'grid' : $style;