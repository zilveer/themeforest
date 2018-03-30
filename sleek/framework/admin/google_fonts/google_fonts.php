<?php

/*
Font Fetcher.
Gets google font list per API
https://developers.google.com/fonts/docs/developer_api

Call:
https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=APIKEY

If unsuccessful [max-quote, error] uses manually provided list.
*/


if( !function_exists( 'sleek_get_google_fonts' ) ){
	function sleek_get_google_fonts() {

		/*------------------------------------------------------------
		 *	Get Google Fonts by API call and store in global var
		 *------------------------------------------------------------*/

		static $sleek_google_fonts;

		if( $sleek_google_fonts ) {
			return $sleek_google_fonts;
		}

		// cached file location
		$sleek_cached_file = THEME_ADMIN . '/google_fonts/google_fonts.txt';
		// Total time the file will be cached in seconds, set to a 28days
		$cachetime = 86400 * 28;

		if(
			file_exists($sleek_cached_file)
			&& filesize($sleek_cached_file) != 0
			&& $cachetime > time()-filemtime($sleek_cached_file)
		){

			// $sleek_google_fonts = (array)wp_remote_get( esc_url_raw( THEME_ADMIN_URI.'/google_fonts/google_fonts.txt' ) );
			// $sleek_google_fonts = json_decode( $sleek_google_fonts['body'] );
			$sleek_google_fonts = file_get_contents( THEME_ADMIN . '/google_fonts/google_fonts.txt' );
			$sleek_google_fonts = json_decode( $sleek_google_fonts );

		}else{
			$theme_settings = sleek_theme_settings();

			$sleek_google_fonts_response = wp_remote_get( esc_url_raw( 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key='.$theme_settings->advanced['google_api'] ) );

			if( !is_wp_error( $sleek_google_fonts_response ) && $sleek_google_fonts_response['response']['code'] == 200 ){

				// save cache
				$fp = fopen($sleek_cached_file, 'w');
				fwrite($fp, $sleek_google_fonts_response['body']);
				fclose($fp);

				$sleek_google_fonts = json_decode($sleek_google_fonts_response['body']);

			}else{
				$sleek_google_fonts = file_get_contents( THEME_ADMIN . '/google_fonts/google_fonts.txt' );
				$sleek_google_fonts = json_decode( $sleek_google_fonts );
			}

		}

		$sleek_google_fonts = isset($sleek_google_fonts) ? $sleek_google_fonts->items : array();


		/* Add Web Safe fonts to the bottom
		 *------------------------------------------------------------*/

		$sleek_websafe_fonts_families = array('Arial', 'Arial Black', 'Helvetica Neue', 'Verdana', 'Tahoma', 'Century Gothic', 'Gill Sans', 'Times New Roman', 'Baskerville', 'Palatino', 'Georgia', 'Courier New', 'Lucida Sans Typewriter' );
		$sleek_websafe_fonts_variants = array('300', '300italic', 'regular', 'italic', '600', '600italic', '700', '700italic', '800', '800italic');

		foreach( $sleek_websafe_fonts_families as $family ){
			$font = new StdClass();
			$font->family = $family;
			$font->variants = $sleek_websafe_fonts_variants;
			$sleek_google_fonts[] = $font;
		}



		return $sleek_google_fonts;
	}
}
