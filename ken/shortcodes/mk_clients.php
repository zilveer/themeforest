<?php

extract( shortcode_atts( array(
			'count'=> 10,
			'bg_color' => '',
			'style' => 'column',
			'column' => 3,
            'dimension' => 180, // specific for grid style
            'item_height' => 180, // specific for column style
			'border_color' => '',
			'border_width' => 2,			
			'scroll' => 'true',
			'hover_state' => 'true',
			'target' => '_self',
			'clients' => '',
			'orderby'=> 'date',
			'order'=> 'DESC',
			'el_class' => '',
			'cover' => 'false'
		), $atts ) );

$scroll_stuff = array('','','','', '');

$query = array(
	'post_type' => 'clients',
	'showposts' => $count,
);

if ( $clients ) {
	$query['post__in'] = explode( ',', $clients );
}
if ( $orderby ) {
	$query['orderby'] = $orderby;
}
if ( $order ) {
	$query['order'] = $order;
}



$loop = new WP_Query( $query );

$bg_color = !empty( $bg_color ) ? ( 'background-color:'.$bg_color.';' ) : '';
$border_color_item = !empty( $border_color ) ? ( 'border-color:'.$border_color.';' ) : 'border-color:transparent;';

$id = Mk_Static_Files::shortcode_id();
$output = $column_css = $dimension_style = $container_border = '';


$app_styles = '';

if ( $style == 'grid' ) {
    $app_styles .= '
	    #clients-shortcode-'.$id.' ul li:last-child .flip-wrapper {
            border-right-width: '.$border_width.'px !important;
        }
        #clients-shortcode-'.$id.' .client-item-wrapper{
			border-width: '.$border_width.'px;
    	}

        #clients-shortcode-'.$id.' ul li:last-child .flip-wrapper {
            border-right-width: '.$border_width.'px !important;
        }
        ';
}else{
	$app_styles .= '
        #clients-shortcode-'.$id.'.column-style .client-item .client-item-wrapper {
            border-width:'.$border_width.'px;
        }
        ';
}

if($style == 'grid') {
	$dimension_style = !empty( $dimension ) ? ( 'height:'.$dimension.'px;width:'.$dimension.'px;' ) : ( 'height:180px;width:180px;' );
if($scroll == 'true') {
		$scroll_stuff = array('mk-swiper-container mk-swiper-slider ', ' data-loop="false" data-freeModeFluid="true" data-slidesPerView="auto" data-pagination="false" data-freeMode="true" data-mousewheelControl="false" data-direction="horizontal" data-slideshowSpeed="4000" data-animationSpeed="600" data-directionNav="false" ', 'mk-swiper-wrapper', 'swiper-slide', '');
	} else {
		$scroll_stuff[4] = 'grid-style ';
	}
} else {
	switch ( $column ) {
		case 1:
			$column_css = 'one-column';
			break;
		case 2:
			$column_css = 'two-column';
			break;
		case 3:
			$column_css = 'three-column';
			break;
		case 4:
			$column_css = 'four-column';
			break;
		case 5:
			$column_css = 'five-column';
			break;
		case 6:
			$column_css = 'six-column';
			break;
		default : 
			$column_css = 'four-column';
		}
	$scroll_stuff[4] = 'column-style ';
	$dimension = $item_height;
	$item_height = !empty( $item_height ) ? ( 'height:'.$item_height.'px;' ) : ( ' height:180px;' );
	$container_border = !empty( $border_color ) ? ( 'style="border-left:'.$border_width.'px solid '.$border_color.'; border-top:'.$border_width.'px solid '.$border_color.';" ' ) : '';

}

$output .= '<div id="clients-shortcode-'.$id.'" class="mk-clients-shortcode '.$column_css.' '.$scroll_stuff[4].$scroll_stuff[0].'bg-cover-'.$cover.' '.$el_class.'"'.$scroll_stuff[1].'>';
$output .= '<ul class="'.$scroll_stuff[2].'" '.$container_border.'>';

while ( $loop->have_posts() ):
	$loop->the_post();
$url = get_post_meta( get_the_ID(), '_url', true );
$company = get_post_meta( get_the_ID(), '_company', true );
$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );


$output .= '<li class="client-item '.$scroll_stuff[3].'" onClick="return true"><div class="client-item-wrapper" style="'.$border_color_item.'">';
$output .= !empty( $url ) ? '<a target="'.$target.'" href="'.$url.'">' : '';
$output .= '<div title="'.$company.'" class="client-logo" style="background-image:url('.mk_thumbnail_image_gen($image_src_array[0], false, false).'); '.$dimension_style.$item_height.$bg_color.'"></div>';


if($hover_state == 'true' && !empty($company)) {
	$output .= '<div class="clients-info">';
	$output .= '<div class="clients-info-holder" style="height:'.$dimension.'px;">';
	$output .= '<span class="client-company">'.$company.'</span>';
	$output .= do_shortcode('[mk_divider style="single" divider_color="rgba(255,255,255,0.4)" divider_width="custom_width" custom_width="35" align="center" thickness="2" margin_top="10" margin_bottom="0"]');
	$output .= '</div></div>';
}

$output .= !empty( $url ) ? '</a>' : '';
$output .= '</div></li>';

endwhile;
wp_reset_postdata();

$output .= '</ul><div class="clearboth"></div></div>';


echo $output;

Mk_Static_Files::addCSS($app_styles, $id);