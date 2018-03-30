<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();

$query = mk_wp_query(array(
            'post_type' => 'clients',
            'count' => $count,
            'posts' => $clients,
            'orderby' => $orderby,
            'order' => $order,
        ));



$gutter_space = ($style == 'carousel' || $border_style == "opened_edges") ? 0 : $gutter_space;
$gutter_space = ($gutter_space == 0) ? '0 auto' : $gutter_space;
$bg_color = !empty( $bg_color ) ? ( ' background-color:'.$bg_color.'; ' ) : '';
$bg_hover_color = !empty( $bg_hover_color ) ? ( ' background-color:'.$bg_hover_color.'; ' ) : '';
$border_color_item = !empty( $border_color ) ? ( ' border-color:'.$border_color.'; ' ) : 'border-color:transparent;';
$height = !empty( $height ) ? ( ' height:'.$height.'px; ' ) : ( ' height:110px; ' );


$atts = array(
		'id' => $id,
		'column' => $column,
		'border_color' => $border_color,
		'border_style' => $border_style,
		'height' => $height,
		'title' => $title,
		'autoplay' => $autoplay,
		'target' => $target,
		'cover' => $cover,
		'el_class' => $el_class,
		'gutter_space' => $gutter_space,
		'query' => $query['wp_query']
	);

echo mk_get_shortcode_view('mk_clients', 'loop-styles/client-loop-' . $style, true, $atts);





/* Dynamic Styles */
$app_styles = "
#clients-{$id} {
	margin-bottom:{$margin_bottom}px;
}
#clients-{$id} .client-logo {
	{$bg_color}
	{$border_color_item};
	border-width: 1px;
	border-style: solid;
	margin:{$gutter_space}px;
";
if($gutter_space == 0 && $style == 'column') {
	$app_styles .= "
		
		border-top-style: none;
		border-left-style: none;
	";
}
$app_styles .= "
}
";
if($border_style == "opened_edges") {
$app_styles .= "
#clients-{$id} li:nth-child({$column}) .client-logo {
	border-right-style: none;
}
";	
}
$app_styles .= "
#clients-{$id} .client-logo:hover {
	{$bg_hover_color}
}
";


Mk_Static_Files::addCSS($app_styles, $id);
