<?php

class PGL_Utilities {

	static function parse_args( $args = array() ) {
		if ( ! empty( $args ) ) {
			$return = array();
			foreach ( $args as $key => $value ) {
				if( is_array($value) ) {
					$value = implode(',', $value);
				}
				$return[] = "$key=$value";
			}
			return implode( '&', $return );
		}
		else {
			return '';
		}
	}

	static function endsWith( $haystack, $needle ) {
		return substr( $haystack, - strlen( $needle ) ) === $needle;
	}

	static function startsWith( $haystack, $needle ) {
		return ! strncmp( $haystack, $needle, strlen( $needle ) );
	}

	static function get_currencies() {
		return array_unique(
			apply_filters( 'PGL_currencies',
				array(
					'CU'   => __( 'Custom Currency', PGL ),
					'AUD' => __( 'Australian Dollars', PGL ),
					'BRL' => __( 'Brazilian Real', PGL ),
					'CAD' => __( 'Canadian Dollars', PGL ),
					'RMB' => __( 'Chinese Yuan', PGL ),
					'CZK' => __( 'Czech Koruna', PGL ),
					'DKK' => __( 'Danish Krone', PGL ),
					'EUR' => __( 'Euros', PGL ),
					'HKD' => __( 'Hong Kong Dollar', PGL ),
					'HUF' => __( 'Hungarian Forint', PGL ),
					'IDR' => __( 'Indonesia Rupiah', PGL ),
					'INR' => __( 'Indian Rupee', PGL ),
					'ILS' => __( 'Israeli Shekel', PGL ),
					'JPY' => __( 'Japanese Yen', PGL ),
					'KRW' => __( 'South Korean Won', PGL ),
					'MYR' => __( 'Malaysian Ringgits', PGL ),
					'MXN' => __( 'Mexican Peso', PGL ),
					'NOK' => __( 'Norwegian Krone', PGL ),
					'NZD' => __( 'New Zealand Dollar', PGL ),
					'PHP' => __( 'Philippine Pesos', PGL ),
					'PLN' => __( 'Polish Zloty', PGL ),
					'GBP' => __( 'Pounds Sterling', PGL ),
					'RON' => __( 'Romanian Leu', PGL ),
					'SGD' => __( 'Singapore Dollar', PGL ),
					'ZAR' => __( 'South African rand', PGL ),
					'SEK' => __( 'Swedish Krona', PGL ),
					'CHF' => __( 'Swiss Franc', PGL ),
					'TWD' => __( 'Taiwan New Dollars', PGL ),
					'THB' => __( 'Thai Baht', PGL ),
					'TRY' => __( 'Turkish Lira', PGL ),
					'USD' => __( 'US Dollars', PGL ),
					'VND' => __( 'Viet Nam Dong', PGL )
				)
			)
		);
	}

	static function get_currency_symbol( $currency = '' ) {
		global $pgl_options;
		if ( ! $currency )
			$currency = self::get_currencies();

		switch ( $currency ) {
			case 'CU' :
				$currency_symbol = $pgl_options->option('estate_custom_currency');
				break;
			case 'BRL' :
				$currency_symbol = '&#82;&#36;';
				break;
			case 'AUD' :
			case 'CAD' :
			case 'MXN' :
			case 'NZD' :
			case 'HKD' :
			case 'SGD' :
			case 'USD' :
				$currency_symbol = '&#36;';
				break;
			case 'EUR' :
				$currency_symbol = '&euro;';
				break;
			case 'CNY' :
			case 'RMB' :
			case 'JPY' :
				$currency_symbol = '&yen;';
				break;
			case 'KRW' :
				$currency_symbol = '&#8361;';
				break;
			case 'TRY' :
				$currency_symbol = '&#84;&#76;';
				break;
			case 'NOK' :
				$currency_symbol = '&#107;&#114;';
				break;
			case 'ZAR' :
				$currency_symbol = '&#82;';
				break;
			case 'CZK' :
				$currency_symbol = '&#75;&#269;';
				break;
			case 'MYR' :
				$currency_symbol = '&#82;&#77;';
				break;
			case 'DKK' :
				$currency_symbol = '&#107;&#114;';
				break;
			case 'HUF' :
				$currency_symbol = '&#70;&#116;';
				break;
			case 'IDR' :
				$currency_symbol = 'Rp';
				break;
			case 'INR' :
				$currency_symbol = '&#8377;';
				break;
			case 'ILS' :
				$currency_symbol = '&#8362;';
				break;
			case 'PHP' :
				$currency_symbol = '&#8369;';
				break;
			case 'PLN' :
				$currency_symbol = '&#122;&#322;';
				break;
			case 'SEK' :
				$currency_symbol = '&#107;&#114;';
				break;
			case 'CHF' :
				$currency_symbol = '&#67;&#72;&#70;';
				break;
			case 'TWD' :
				$currency_symbol = '&#78;&#84;&#36;';
				break;
			case 'THB' :
				$currency_symbol = '&#3647;';
				break;
			case 'GBP' :
				$currency_symbol = '&pound;';
				break;
			case 'RON' :
				$currency_symbol = 'lei';
				break;
			case 'VND' :
				$currency_symbol = '&#8363;';
				break;
			default    :
				$currency_symbol = '';
				break;
		}
		return apply_filters( 'PGL_currency_symbol', $currency_symbol, $currency );
	}

	static function list_file( $path = '', $prefix = '' ) {
		$list = array_diff( scandir( PGL_PATH . $path ), array( '..', '.' ) );
		if ( $prefix ) {
			$prefix .= '-';
		}
		foreach ( $list as $k => &$v ) {
			if ( ! self::startsWith( $v, $prefix ) ) {
				unset( $list[$k] );
				continue;
			}
			$v = str_replace( '.php', '', $v );
		}
		return self::translate_file_desc( $list );
	}

	static function list_template_file( $dir = '', $prefix = '' ) {
		return self::list_file( $dir, $prefix );
	}

	static function translate_file_desc( $files ) {
		if ( ! is_array( $files ) )
			$files = (array) $files;
		$temp = array();
		foreach ( $files as $f ) {
			$temp[$f] = __( ucwords( str_replace( '-', ' ', $f ) ), PGL );
		}
		return $temp;
	}

	static function get_video_thumbnail( $url ) {
		$p_url = self::__video_url_type( $url );

		switch ( $p_url['type'] ) {
			case 'youtube' :
			{
				return 'http://img.youtube.com/vi/' . self::id_youtube($url) . '/hqdefault.jpg';
				break;
			}

			case 'vimeo':
			{
				$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".self::id_vimeo($url).".php"));
				return $hash[0]['thumbnail_large'];
			}

			default:
				return '';
		}
	}

	static function __video_url_type( $url ) {
		if( ! $url ) {
			return array('type' => '');
		}
		$p_url = parse_url( $url );
		$hosts = array( 'youtube', 'vimeo' );
		foreach ( $hosts as $host ) {
			if ( strpos( $p_url['host'], $host ) !== FALSE ) {
				$p_url['type'] = $host;
				return $p_url;
			}
		}
		$p_url['type'] = NULL;
		return $p_url;
	}

    static function video_id($type, $url) {
        switch($type) {
            case 'youtube':{
                return self::id_youtube($url);
            }

            case 'vimeo':{
                return self::id_vimeo($url);
            }

            default:
                return '';
        }
    }

	static function id_youtube( $text ) {
		$text = preg_replace( '~
        # Match non-linked youtube URL in the wild. (Rev:20111012)
        https?://         # Required scheme. Either http or https.
        (?:[0-9A-Z-]+\.)? # Optional subdomain.
        (?:               # Group host alternatives.
          youtu\.be/      # Either youtu.be,
        | youtube\.com    # or youtube.com followed by
          \S*             # Allow anything up to VIDEO_ID,
          [^\w\-\s]       # but char before ID is non-ID char.
        )                 # End host alternatives.
        ([\w\-]{11})      # $1: VIDEO_ID is exactly 11 chars.
        (?=[^\w\-]|$)     # Assert next char is non-ID or EOS.
        (?!               # Assert URL is not pre-linked.
          [?=&+%\w]*      # Allow URL (query) remainder.
          (?:             # Group pre-linked alternatives.
            [\'"][^<>]*>  # Either inside a start tag,
          | </a>          # or inside <a> element text contents.
          )               # End recognized pre-linked alts.
        )                 # End negative lookahead assertion.
        [?=&+%\w-]*        # Consume any URL (query) remainder.
        ~ix',
			'$1',
			$text );
		return $text;
	}

	static function id_vimeo( $text ) {
		$pattern = "/https?:\\/\\/(?:www\\.)?vimeo.com\\/(?:channels\\/|groups\\/([^\\/]*)\\/videos\\/|album\\/(\\d+)\\/video\\/|)(\\d+)(?:$|\\/|\\?)/" ;
		preg_match($pattern, $text, $matches);
		return array_pop($matches);
	}

	static function insert_into_array( $position, $needle, $haystack ) {
		$spliced = array_splice($haystack, $position);
		return ($haystack + $needle + $spliced);
	}
	static public function get_include_contents($file, $params = null){
		if(is_file(locate_template($file))){
			ob_start();
			extract($params);
			include locate_template($file);
			return ob_get_clean();
		}
		return false;
	}
}
