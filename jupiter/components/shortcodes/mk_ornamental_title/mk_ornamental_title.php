<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$html = file_get_contents( $path . '/template.php' );
$html = phpQuery::newDocument( $html );
$id = Mk_Static_Files::shortcode_id();

// Main logic here
//


$title_container = pq( '.mk-ornamental-title' );
$title_container->attr('id', 'mk-ornamental-title-'.$id);
$title_container->addClass($ornament_style);
$title_container->append( '<'.$tag_name.' class="title"></'.$tag_name.'>' );

if ($title_as == 'text') {
	$title_container->find('.title')
				->append('<span class="title-text"></span>');

	$title_container->find('.title')
				    ->find('.title-text')
				    ->html(strip_tags($content));
}else if ($title_as == 'image') {
	$title_container->find('.title')
					->append('<span class="title-image"></span>');
				    

    $title_container->find('.title')
				    ->find('.title-image')
				    ->append('<img src="'.$title_image.'"></img>');
}

echo mk_get_fontfamily( "#mk-ornamental-title-", $id, $font_family, $font_type );

	
if($ornament_style == 'rovi-single' || $ornament_style == 'rovi-double'){
	$title_container->find('.title')
				    ->find('span')
				    ->append('<i class="line-left"></i>');

	$title_container->find('.title')
				    ->find('span')
				    ->append('<i class="line-right"></i>');
}
if($ornament_style == 'norman-short-single' || $ornament_style == 'norman-short-double' || $ornament_style == 'lemo-single' || $ornament_style == 'lemo-double'){
	$title_container->addClass('align-'.$nss_align);
}

$title_container->addClass('title_as_'.$title_as);
$title_container->addClass($ornament_style);
$title_container->addClass($el_class);
if ( $animation != '' ) {
	$title_container->addClass(get_viewport_animation_class($animation));
}

/**
 * Collect JSON config for JS
 * ==================================================================================*/


/**
 * Custom CSS Calculate
 * ==================================================================================*/


if ($title_as == 'text') {
	$font_size_change = ( $font_size + 6 );
	if($ornament_style == 'rovi-double' || $ornament_style == 'norman-double' || $ornament_style == 'norman-short-double'){
		$double_line = ( ($font_size_change - ( ($ornament_thickness * 2) + 3 ) ) / 2 );
	}else {
		$single_line = ( ($font_size_change - $ornament_thickness) / 2 );
	}
}else if ($title_as == 'image') {
	$image_size = getimagesize($title_image);
	if($ornament_style == 'rovi-double' || $ornament_style == 'norman-double' || $ornament_style == 'norman-short-double'){
		$double_line = ( $image_size[1] - ( ($ornament_thickness * 2) + 3 ) ) / 2;
	}else {
		$single_line = ( $image_size[1] - $ornament_thickness ) / 2;
	}
}




/**
 * Custom CSS Output
 * ==================================================================================*/

Mk_Static_Files::addCSS('
	#mk-ornamental-title-'.$id.' {
		margin-top: '.$margin_top.'px;
		margin-bottom: '.$margin_bottom.'px;
	}
	#mk-ornamental-title-'.$id.' .title {
		color: '.$text_color.';
		font-weight: '.$font_weight.';
		font-style: '.$font_style.';
		text-transform: '.$txt_transform.';
	}
	#mk-ornamental-title-'.$id.' .title span::after,
	#mk-ornamental-title-'.$id.' .title span::before {
		border-top: '.$ornament_thickness.'px solid '.$ornament_color.';
	}
', $id);




if ($title_as == 'text') {
	Mk_Static_Files::addCSS('
		#mk-ornamental-title-'.$id.' .title {
			font-size: '.$font_size.'px;
			line-height: '.($font_size + 6 ).'px;
		}
	', $id);
}else if ($title_as == 'image') {
	Mk_Static_Files::addCSS('
		#mk-ornamental-title-'.$id.' .title {
			font-size: initial;
			line-height: initial;
		}
	', $id);
}

if($ornament_style == 'rovi-single' || $ornament_style == 'rovi-double') {
	Mk_Static_Files::addCSS('
		#mk-ornamental-title-'.$id.' .title .title-text,
		#mk-ornamental-title-'.$id.' .title .title-image {
			border-left: '.$ornament_thickness.'px solid '.$ornament_color.';
			border-right: '.$ornament_thickness.'px solid '.$ornament_color.';
		}

	', $id);
}
if($ornament_style == 'rovi-double') {
	Mk_Static_Files::addCSS('
		#mk-ornamental-title-'.$id.' .title .title-text .line-left,
		#mk-ornamental-title-'.$id.' .title .title-image .line-left {
			border-left: '.$ornament_thickness.'px solid '.$ornament_color.';
		}
		#mk-ornamental-title-'.$id.' .title .title-text .line-right,
		#mk-ornamental-title-'.$id.' .title .title-image .line-right {
			border-right: '.$ornament_thickness.'px solid '.$ornament_color.';
		}
	', $id);
}
if($ornament_style == 'rovi-double' || $ornament_style == 'norman-double' || $ornament_style == 'norman-short-double' ){
	Mk_Static_Files::addCSS('
		#mk-ornamental-title-'.$id.' .title span::after,
		#mk-ornamental-title-'.$id.' .title span::before {
			top: '.$double_line.'px; 
			border-bottom: '.$ornament_thickness.'px solid '.$ornament_color.';
		}
	', $id);
}
if($ornament_style == 'rovi-single' || $ornament_style == 'norman-single' || $ornament_style == 'norman-short-single' ){
	Mk_Static_Files::addCSS('
		#mk-ornamental-title-'.$id.' .title span::after,
		#mk-ornamental-title-'.$id.' .title span::before {
			top: '.$single_line.'px;
		}
	', $id);
}
if($ornament_style == 'normal-short-double') {
	Mk_Static_Files::addCSS('
		#mk-ornamental-title-'.$id.' .title::after,
		#mk-ornamental-title-'.$id.' .title::before {
			border-botom: '.$ornament_thickness.'px solid '.$ornament_color.';
		}
	', $id);
}

if($ornament_style == 'lemo-single') {
	Mk_Static_Files::addCSS('
		#mk-ornamental-title-'.$id.' .title span::after {
			border-top: '.$ornament_thickness.'px solid '.$ornament_color.';
		}
		#mk-ornamental-title-'.$id.' .title span::before {
			border-top: '.$ornament_thickness.'px solid '.$ornament_color.'; 
		}
	', $id);
}
if($ornament_style == 'lemo-double') {
	Mk_Static_Files::addCSS('
		#mk-ornamental-title-'.$id.' .title span::after,
		#mk-ornamental-title-'.$id.' .title span::before {
			border-top: '.$ornament_thickness.'px solid '.$ornament_color.';
			border-bottom: '.$ornament_thickness.'px solid '.$ornament_color.';
		}
	', $id);
}


print $html;