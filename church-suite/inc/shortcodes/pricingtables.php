<?php 

function webnus_pricing_tables( $attributes, $content = null ) {
	extract(shortcode_atts(array(
		'title'  => '',
		'price'  => '$10',
		'period'  => 'Month',
		'link_url'  => '',
		'link_text'  => '',
		'featured'  => '',
		'row1'  => '',
		'row2'  => '',
		'row3'  => '',
		'row4'  => '',
		'row5'  => '',
		'row6'  => '',
		'row7'  => '',
	), $attributes));
	
	// output included "i" tag
	//if( ! empty($icon_name) && $icon_name != 'none' )
	// $icon = do_shortcode( "[icon name='$icon_name' size='$icon_size' color='$icon_color']" );

	$featured = (!empty($featured)) ? ' featured' : '' ;

	$out  = '';
	$out .= '<div class="w-pricing-table ' . $featured . '">';
	$out .= '<div class="price-header">';
	$out .= '<h5 class="plan-title">' . $title . '</h5>';
	$out .= '<h6 class="plan-price"> <span>' . $price . '</span> <small>/' . $period . '</small> </h6>';
	$out .= '</div> <!-- end price-header -->';
	$out .= '<ul class="features">';
    $out .= (!empty($row1)) ? '<li>' . $row1 . '</li>' : '' ;
    $out .= (!empty($row2)) ? '<li>' . $row2 . '</li>' : '' ;
    $out .= (!empty($row3)) ? '<li>' . $row3 . '</li>' : '' ;
    $out .= (!empty($row4)) ? '<li>' . $row4 . '</li>' : '' ;
    $out .= (!empty($row5)) ? '<li>' . $row5 . '</li>' : '' ;
    $out .= (!empty($row6)) ? '<li>' . $row6 . '</li>' : '' ;
    $out .= (!empty($row7)) ? '<li>' . $row7 . '</li>' : '' ;
	$out .= '</ul> <!-- end features -->';
	$out .= '<div class="price-footer"> <a href="' . $link_url . '" class="magicmore">' . $link_text . '</a> </div>';
	$out .= '</div> <!-- end pricing-table -->';



return $out;
}
add_shortcode('pricing-tables', 'webnus_pricing_tables');		

?>