<?php               

define( 'YIW_THEME_OPTIONS', __( 'Theme Options', 'yiw' ) );  
define( 'YIW_OPTIONS_DB', 'yiw_theme_options' ); 

function yiw_add_more_tabs_to_panel() {
	return apply_filters( 'yiw_tabs_panel', array(
		'panelimport' => __( 'Panel Import', 'yiw' )
	) );
}
$yiw_theme_options_items = array_merge( $yiw_theme_options_items, yiw_add_more_tabs_to_panel() );

// get all categories created on theme
$yiw_categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($yiw_categories as $category_list ) 
{
    $wp_cats[$category_list->category_nicename] = $category_list->cat_name;
}
array_unshift($wp_cats, __("Choose a category", 'yiw'));  

// effects
$yiw_cycle_fxs = array(
    'blindX' => 'blindX', 		'blindY' => 'blindY', 		'blindZ' => 'blindZ', 		'cover' => 'cover', 		'curtainX' => 'curtainX',
    'curtainY' => 'curtainY', 	'fade' => 'fade', 			'fadeZoom' => 'fadeZoom', 	'growX' => 'growX', 		'growY' => 'growY',
    'scrollUp' => 'scrollUp', 	'scrollDown' => 'scrollDown','scrollLeft' => 'scrollLeft','scrollRight' => 'scrollRight', 	'scrollHorz' => 'scrollHorz',
    'shuffle' => 'shuffle', 	'slideX' => 'slideX', 		'slideY' => 'slideY', 		'toss' => 'toss', 			'turnUp' => 'turnUp',
    'turnLeft' => 'turnLeft', 	'turnRight' => 'turnRight', 'uncover' => 'uncover', 	'wipe' => 'wipe', 			'zoom' => 'zoom',
    'none' => 'none',			'turnDown' => 'turnDown',	'scrollVert' => 'scrollVert'
);

// anythingslider
$yiw_anything_fxs = array(
    'top' => 'top',
    'bottom' => 'bottom',
    'right' => 'right',
    'left' => 'left',
    'fade' => 'fade',
    'expand' => 'expand',
    'listLR' => 'listLR',
    'listRL' => 'listRL',
);

// nivo slider effect
$yiw_nivo_fxs = array(
    'random' => 'random',
	'sliceDown' => 'sliceDown',
    'sliceDownLeft' => 'sliceDownLeft',
    'sliceUp' => 'sliceUp',
    'sliceUpLeft' => 'sliceUpLeft',
    'sliceUpDown' => 'sliceUpDown',
    'sliceUpDownLeft' => 'sliceUpDownLeft',
    'fold' => 'fold',
    'fade' => 'fade',
    'slideInRight' => 'slideInRight',
    'slideInLeft' => 'slideInLeft',
    'boxRandom' => 'boxRandom', 
    'boxRain' => 'boxRain', 
    'boxRainReverse' => 'boxRainReverse', 
    'boxRainGrow' => 'boxRainGrow', 
    'boxRainGrowReverse' => 'boxRainGrowReverse'
);

// easings
$yiw_easings = array(
	FALSE => 'none',
	'easeInQuad' => 'easeInQuad',
	'easeOutQuad' => 'easeOutQuad',
	'easeInOutQuad' => 'easeInOutQuad',
	'easeInCubic' => 'easeInCubic',
	'easeOutCubic' => 'easeOutCubic',
	'easeInOutCubic' => 'easeInOutCubic',
	'easeInQuart' => 'easeInQuart',
	'easeOutQuart' => 'easeOutQuart',
	'easeInOutQuart' => 'easeInOutQuart',
	'easeInQuint' => 'easeInQuint',
	'easeOutQuint' => 'easeOutQuint',
	'easeInOutQuint' => 'easeInOutQuint',
	'easeInSine' => 'easeInSine',
	'easeOutSine' => 'easeOutSine',
	'easeInOutSine' => 'easeInOutSine',
	'easeInExpo' => 'easeInExpo',
	'easeOutExpo' => 'easeOutExpo',
	'easeInOutExpo' => 'easeInOutExpo',
	'easeInCirc' => 'easeInCirc',
	'easeOutCirc' => 'easeOutCirc',
	'easeInOutCirc' => 'easeInOutCirc',
	'easeInElastic' => 'easeInElastic',
	'easeOutElastic' => 'easeOutElastic',
	'easeInOutElastic' => 'easeInOutElastic',
	'easeInBack' => 'easeInBack',
	'easeOutBack' => 'easeOutBack',
	'easeInOutBack' => 'easeInOutBack',
	'easeInBounce' => 'easeInBounce',
	'easeOutBounce' => 'easeOutBounce',
	'easeInOutBounce' => 'easeInOutBounce'
);
?>
