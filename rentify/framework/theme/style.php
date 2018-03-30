<?php

/*
Register Fonts
*/

function sb_fonts_url() {

	$fonts_url = '';
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'rentify' );
	$droid_serif = _x( 'on', 'Droid Serif font: on or off', 'rentify' );
	$montserrat = _x( 'on', 'Montserrat font: on or off', 'rentify' );
	$nothing_you_could_do = _x( 'on', 'Nothing You Could Do font: on or off', 'rentify' );
	$libre_baskerville = _x( 'on', 'Libre Baskerville  font: on or off', 'rentify' );

	if ( 'off' !== $open_sans || 'off' !== $droid_serif || 'off' !== $montserrat || 'off' !== $nothing_you_could_do || 'off' !== $libre_baskerville ) {
		$font_families = array();
	 
		if ( 'off' !== $open_sans ) {
			$font_families[] = 'Open Sans:400italic,300,400,600,700';
		}
		 
		if ( 'off' !== $droid_serif ) {
			$font_families[] = 'Droid Serif:400,700,400italic';
		}

		if ( 'off' !== $montserrat ) {
			$font_families[] = 'Montserrat:400,700';
		}

		if ( 'off' !== $nothing_you_could_do ) {
			$font_families[] = 'Nothing You Could Do';
		}

		if ( 'off' !== $libre_baskerville ) {
			$font_families[] = 'Libre Baskerville:400,400italic';
		}
		 
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
	 
		$fonts_url = add_query_arg( $query_args,"https://fonts.googleapis.com/css" );
	}
 
	return esc_url_raw( $fonts_url );
}

/*-------------------------------------------------------------------------
 START ENQUEUING STYLESHEETS
------------------------------------------------------------------------- */

if( !function_exists('sb_add_style') ){
	function sb_add_style(){	            
		global $is_IE,$rentify_option_data;
		$i=1;
		$protocol = is_ssl() ? 'https' : 'http';

		wp_enqueue_style( 'sb-fonts', sb_fonts_url(), array(), null );
		wp_enqueue_style('sb-swipebox', RENTIFY_CSS.'swipebox.min.css', array(), $ver = false, $media = 'all');
		if(is_page_template('templates/copywriter-home.php' )){
			$i=0;
			wp_enqueue_style('copywriter-style', RENTIFY_CSS.'copywriter-style.css', array(), $ver = false, $media = 'all');
		}

		if(is_page_template('templates/corporate-home.php' )){
			$i=0;
			wp_enqueue_style('corporate-style-style', RENTIFY_CSS.'corporate-style.css', array(), $ver = false, $media = 'all');
		}
		if(is_page_template('templates/creative-home.php' )){
			$i=0;
			wp_enqueue_style('creative-style', RENTIFY_CSS.'creative-style.css', array(), $ver = false, $media = 'all');
		}
		wp_enqueue_style('masterslider-style', RENTIFY_JS.'masterslider/style/masterslider.css', array(), $ver = false, $media = 'all');
		wp_enqueue_style('default-style', RENTIFY_JS.'masterslider/skins/default/style.css', array(), $ver = false, $media = 'all');
		wp_enqueue_style('light2-style', RENTIFY_JS.'masterslider/skins/light-2/style.css', array(), $ver = false, $media = 'all');
		wp_enqueue_style('black1-style', RENTIFY_JS.'masterslider/skins/black-1/style.css', array(), $ver = false, $media = 'all');
		wp_enqueue_style('owl.carousel', RENTIFY_CSS.'owl.carousel.css', array(), $ver = false, $media = 'all');

		if($i==1){
			wp_enqueue_style('sb-main-stylesheet', RENTIFY_CSS.'main-style.css', array(), $ver = false, $media = 'all');
		}
		wp_enqueue_style('rentify', RENTIFY_CSS.'rentify.css', array(), $ver = false, $media = 'all');
	}
}

add_action('wp_enqueue_scripts', 'sb_add_style');

/*-------------------------------------------------------------------------
 END ENQUEUING STYLESHEETS
------------------------------------------------------------------------- */

