<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );
$html = file_get_contents( $path . '/template.php' );
$html = phpQuery::newDocument( $html );
$id = Mk_Static_Files::shortcode_id();


$image_src = Mk_Image_Resize::resize_by_url($src, $image_diameter, $image_diameter, $crop = true, $dummy = true);

$container = pq('.mk-circle-image');
$containerHolder = $container->find('.mk-circle-image__holder');

$container->attr('id', 'mk-circle-image-'.$id);
$container->addClass($el_class);
$container->addClass($visibility);

if ( $animation != '' ) {
	$container->addClass(get_viewport_animation_class($animation));
}
if ( !empty( $heading_title ) ) {
	$container->prepend('<h3 class="mk-circle-image__title mk-fancy-title pattern-style"></h3>')
		->find('.mk-circle-image__title')
		->html('<span>'.$heading_title.'</span>');
}
$containerHolder->append('<img class="mk-circle-image__img">')
		->find('.mk-circle-image__img')
		->attr('title', $heading_title)
		->attr('alt', $heading_title)
		->attr('src', $image_src);

if($link) {
	$containerHolder->find('.mk-circle-image__img')
			->wrap('<a href="'.$link.'">');
}


print $html;
