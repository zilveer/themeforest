<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$html = file_get_contents( $path . '/template.php' );
$html = phpQuery::newDocument( $html );
$id = Mk_Static_Files::shortcode_id();

$container = pq('.mk-banner-builder');
$items = $container->find('.mk-banner-slides');
$item = $items->find('.mk-banner-slide')->remove();
$container->attr('id', 'mk-banner-builder-'.$id);


$query = mk_wp_query(array(
	'post_type' 		=> 'banner_builder',
	'suppress_filters' 	=> false,
	'order' 			=> $order,
	'orderby' 		=> $orderby,
	'count' 			=> 0,
));
if ( !empty($slides) ) {
	$query['post__in'] = explode( ',', $slides );
}

$r = $query['wp_query'];

$i = 0;
while ($r->have_posts()):
	$r->the_post();
	$i++;

	$each_item = $item->clone();
	$each_item->html(do_shortcode(get_the_content()));

	$each_item->appendTo($items);
endwhile;
wp_reset_query();

if ($i < 2){
	$directionNav = 'false';
}else{
	$directionNav = 'true';
}

/**
 * Collect JSON config for JS
 * ==================================================================================*/
$json = array(
	'animation' 		=> $animation_style,
	'slideshow'		=> $autoplay,
	'slideshowSpeed'	=> $slideshow_speed,
	'animationSpeed'	=> $animation_duration,
	'directionNav'		=> $directionNav
);

$json = json_encode( $json );

$container->attr('data-BannerBuilder-config', $json);


/**
 * Custom CSS Output
 * ==================================================================================
 */
$app_styles = '
	#mk-banner-builder-'.$id.'{
		padding: '.$padding.'px 0;
		height: '.$height.'px;
	}
';



 Mk_Static_Files::addCSS($app_styles, $id);


print $html;
