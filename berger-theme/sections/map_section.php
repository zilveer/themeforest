<?php
/**
 * Created by Clapat.
 * Date: 01/02/15
 * Time: 1:54 PM
 */

$hero_size 			    = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-map-height' );
$hero_position 		    = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-map-position' );
$hero_scroll_opacity 	= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-map-scroll-opacity' );
$hero_content_type		= redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-map-content' );

$hero_class = '';
if( $hero_scroll_opacity ){

	$hero_class = 'opacity-hero';
}

if( $hero_size == 'big' ){
	
	$hero_class .= ' hero-big';
}
else if( $hero_size == 'small' ){
	
	$hero_class .= ' hero-small';
}

if( $hero_position == 'static' ){
	
	$hero_class .= ' static-hero';
}
else if( $hero_position == 'parallax' ){
	
	$hero_class .= ' parallax-hero';
}

if( $hero_content_type == 'light' ){

    $hero_class .= ' dark-bg';
}

$hero_class = trim( $hero_class );
if( !empty( $hero_class ) ){

	$hero_class = 'class="' . $hero_class . '"';
} 

?>

		<!-- Map -->
        <div id="hero" <?php echo $hero_class; ?>>

            <div id="map_canvas"></div>
		
		</div>
        <!--/Map -->