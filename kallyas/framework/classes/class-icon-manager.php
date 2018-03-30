<?php if(! defined('ABSPATH')){ return; }

	/**
	*
	*/
	class ZnIconManager
	{

		var $paths;

		var $font_name = 'new_font';

		// CONTAINS ALL THE ICONS
		static $icon_data;
		static $icons_locations;
		static $custom_fonts;

		function __construct()
		{

			global $wp_upload_dir;

			// SET PATHS
			$this->paths = $wp_upload_dir;
			$this->paths['fonts'] 	= 'zn_fonts';
			$this->paths['temp']  	= trailingslashit( $this->paths['fonts'] ).'zn_temp';
			$this->paths['fontdir'] = trailingslashit( $this->paths['basedir'] ).$this->paths['fonts'];
			$this->paths['tempdir'] = trailingslashit( $this->paths['basedir'] ).$this->paths['temp'];
			$this->paths['fonturl'] = trailingslashit( $this->paths['baseurl'] ).$this->paths['fonts'];
			$this->paths['tempurl'] = trailingslashit( $this->paths['baseurl'] ).trailingslashit( $this->paths['temp'] );

			add_action('wp_ajax_zn_upload_icons',  array(&$this, 'upload_icons') );
			add_action('wp_ajax_zn_remove_icons',  array(&$this, 'remove_icons') );
			add_filter('zn_dynamic_css' , array( &$this,'set_css') );

		}

		/*
		*	UPLOADS THE ICONS
		*/
		function upload_icons(){

			// PERFORM THE CHECK
			check_ajax_referer( 'zn_framework', 'security' );
			$return = array();

			$attachment = $_POST['attachment'];
			$path  = get_attached_file( $attachment['id'] );
			$return = $this->do_icon_install( $path, $attachment['title'] );

			wp_send_json( $return );

		}

		function do_icon_install( $path, $title ){
			$unzipped = $this->do_icons_archive( $path );

			if ( !empty( $unzipped['error'] ) ) {
				$return['message'] = $unzipped['error'];
			}
			else {

				// ADD THE FONT INFO TO DB AND CREATE ICON_LIST
				$font_data = $this->create_data();

				if ( !empty( $font_data['message'] ) )
				{
					$return['message'] = $font_data['message'];
				}
				else{
					$return['message'] = 'The '.$this->font_name.' font was succesfully added';
					$return['html'] = '<a class="zn_remove_font" href="#">'.$this->font_name.'<span data-font_name="'.$title.'" class="zn_remove_font_trigger">&#215;</span></a> ';
				}

			}
			generate_options_css();
			return $return;

		}

		/*
		*	DELETES THE ICONS
		*/
		function remove_icons()
		{
			$font_name = $_POST['font_name'];

			zn_delete_folder( $this->paths['fontdir'].'/'.$font_name );

			$fonts = $this->get_custom_fonts();

			unset( $fonts[$font_name] );

			update_option('zn_custom_fonts', $fonts);

			$return['message'] = 'The '.$font_name.' font was succesfully deleted';

			wp_send_json($return);
		}

		function create_data()
		{
			$svg_file = find_file( $this->paths['tempdir'] , '.svg' );
			$return = array();

			if( empty( $svg_file ) )
			{
				zn_delete_folder( $this->paths['tempdir'] );
				$return['message'] = 'The zip did not contained any svg files.';
				return $return;
			}

			//#! since v4.1.4
			$svgFile = trailingslashit($this->paths['tempdir']).$svg_file;
			if(! is_file($svgFile) || !is_readable($svgFile)){
				zn_delete_folder( $this->paths['tempdir'] );
				$return['message'] = 'Could not find or read the svg file.';
				return $return;
			}

			$file_data = file_get_contents($svgFile);

			if (!is_wp_error($file_data) && !empty($file_data))
			{
				$xml = simplexml_load_string($file_data);

				//#! since v4.1.4 - make sure this is a valid font archive
				if(!is_object($xml) || !isset($xml->defs) || !isset($xml->defs->font)){
					zn_delete_folder( $this->paths['tempdir'] );
					$return['message'] = 'Could not find or read the svg file.';
					return $return;
				}

				$font_attr = $xml->defs->font->attributes();
				$this->font_name = (string) $font_attr['id'];
				$icon_list = array();

				$glyphs = $xml->defs->font->children();
				$class = '';
				foreach($glyphs as $item => $glyph)
				{
					if( $item == 'glyph' )
					{
						$attributes = $glyph->attributes();
						$unicode	=  (string) $attributes['unicode'];
						$d		=  (string) $attributes['d'];

						if( $class != 'hidden' && !empty( $d ) )
						{
							$unicode_key = trim( json_encode( $unicode ) ,'\\\"');

							if($item == 'glyph' && !empty( $unicode_key ) && trim( $unicode_key ) != '' )
							{
								$icon_list[$this->font_name][$unicode_key] = $unicode_key;
							}
						}
					}
				}

				if(!empty( $icon_list ) && !empty( $this->font_name ) )
				{

					$icon_list_file = fopen( $this->paths['tempdir'].'/icon_list.php', 'w' );

					if ($icon_list_file)
					{

						fwrite( $icon_list_file, '<?php $icons = array();');

						foreach( $icon_list[$this->font_name] as $unicode)
						{
							if(!empty($unicode))
							{
								$delimiter = "'";
								if(strpos($unicode, "'") !== false) $delimiter = '"';
								fwrite( $icon_list_file, "\r\n".'$icons[\''.$this->font_name.'\']['.$delimiter.$unicode.$delimiter.'] = '.$delimiter.$unicode.$delimiter.';' );
							}
						}

						fclose( $icon_list_file );
					}
					else
					{
						zn_delete_folder( $this->paths['tempdir'] );
						$return['message'] = 'There was a problem creating the icon list file';
						return $return;
					}

					// RENAME ALL FILES SO WE CAN LOAD THEM BY FONT NAME
					$this->rename_files();

					// RENAME THE FOLDER WITH THE FONT NAME
					$this->rename_folder();

					// ADD FONT DATA TO FONT OPTION
					$this->add_font_data();
				}
			}
			else {
				$return['message'] = 'The svg file could not be opened.';
			}
			return $return;
		}

		/*
		*	Retrieves all custom fonts from options table
		*/
		static function get_custom_fonts()
		{

			if(!empty( self::$custom_fonts )) return self::$custom_fonts;

			$fonts = get_option('zn_custom_fonts');

			if( empty( $fonts ) )
			{
				$fonts = array();
			}

			// CACHE THE VALUE
			self::$custom_fonts = $fonts;
			return $fonts;

		}

		function add_font_data(){
			$fonts = $this->get_custom_fonts();

			if( empty( $fonts) ) $fonts = array();

			$url = trailingslashit( $this->paths['fonturl'] );
			$url = preg_replace('#^https?://#', '//', $url); // SSL friendly URL

			$fonts[$this->font_name] = array(
				'url' 	=> $url,
				'filepath' 	=> trailingslashit( $this->paths['fontdir'] ),
			);

			update_option('zn_custom_fonts', $fonts);
		}


		function rename_files()
		{
			$directory = trailingslashit( $this->paths['tempdir'] );
			$extensions = array('eot','svg','ttf','woff');

			foreach( glob( $directory.'*' ) as $file)
			{
				$path_parts = pathinfo($file);
				if( in_array( $path_parts['extension'], $extensions ) )
				{
					rename($file, trailingslashit($path_parts['dirname']).$this->font_name.'.'.$path_parts['extension']);
				}
			}
		}

		/*
		*	RENAME THE FOLDER
		*	@param : the font name
		*/
		function rename_folder( )
		{
			$new_name = trailingslashit($this->paths['fontdir']).$this->font_name;

			zn_delete_folder( $new_name );

			rename( $this->paths['tempdir'], $new_name );
		}

		/*
		*	EXTRACTS AN ARCHIVE CONTAINNING ICONS
		*/
		function do_icons_archive( $zip )
		{
			/*
				Not needed actually. WP already sets the memory limit to 256
				\wp-admin\admin.php
				\wp-includes\default-constants.php
			*/
			// @ini_set( 'memory_limit', apply_filters( 'admin_memory_limit', '256M' ) );

			$return       = array();
			$zipper       = new ZipArchive;
			$extensions   = array( 'eot','svg','ttf','woff' , 'json' );
			$tempdir = zn_create_folder( $this->paths['tempdir'], false );
			if(!$tempdir)
			{
				$return['error'] = 'The temp folder could not be created !';
				return $return;
			}

			if ( $zipper->open( $zip ) === true )
			{
				for($i = 0; $i < $zipper->numFiles; $i++)
				{
					$filename = $zipper->getNameIndex($i);
					$file_extension = pathinfo( $filename , PATHINFO_EXTENSION );

					if ( !in_array( $file_extension , $extensions ) || substr( $filename, -1 ) == '/' )
					{
						continue;
					}

					$fp = $zipper->getStream( $filename );
					$ofp 	= fopen( $this->paths['tempdir'].'/'.basename($filename), 'w' );

					while ( ! feof( $fp ) )
					{
						fwrite( $ofp, fread($fp, 8192) );
					}

					fclose($fp);
					fclose($ofp);

				}

				$zipper->close();
			}
			else
			{
				$return['error'] = 'The zip file could not be extracted !';
			}

			return $return;

		}


		/*
		*	GET ALL THE ICONS
		*/
		static function get_icons()
		{
			if(!empty( self::$icon_data )) return self::$icon_data;

			$icon_locations = self::get_icon_locations();
			$config = array();

			foreach ( $icon_locations as $name => $icon ) {
				if( file_exists( $icon['filepath'] . $name .'/icon_list.php' ) ){
					include( $icon['filepath'] . $name .'/icon_list.php' );
				}

				$config = array_merge( $config , $icons );

			}

			self::$icon_data = $config;
			return $config;

		}

		/*
		*	GET ALL ICONS LOCATIONS ( DEFAULT AND CUSTOM )
		*/
		static function get_icon_locations()
		{
			if(!empty(self::$icons_locations)) return self::$icons_locations;

			// CUSTOM FONTS
			$custom_fonts = self::get_custom_fonts();

			$font_names = array();
			$default_fonts_base = THEME_BASE .'/template_helpers/icons/';

			foreach( glob( $default_fonts_base.'*' ) as $file)
			{
				$path_parts = pathinfo($file);
				$font_names[] = $path_parts['basename'];

			}

			$url = THEME_BASE_URI .'/template_helpers/icons/';
			$url = preg_replace('#^https?://#', '//', $url);
			foreach ( $font_names as $font ) {
				$default_fonts[$font] = array
				(
					'url' => $url, // USED TO LOAD THE FILES
					'filepath' => $default_fonts_base // USED INTERNALLY
				);
			}

			// COMBINE DEFAULT AND CUSTOM FONTS
			$icons_locations = array_merge( $default_fonts , $custom_fonts );

			self::$icons_locations = $icons_locations;

			return $icons_locations;

		}

		function get_icon( $icon )
		{
			if(strpos( $icon, 'u' ) === 0 ) $icon = json_decode('"\\'.$icon.'"');
			return $icon;
		}

		function set_css( $output ){
			$icons_locations 	= self::get_icon_locations();

			//$output .= '<style type="text/css">';
			foreach( $icons_locations as $name => $font_data )
			{

				$icon_file = $font_data['url'].$name.'/'.$name;

				$output .="
@font-face {font-family: '{$name}'; font-weight: normal; font-style: normal;
src: url('{$icon_file}.eot');
src: url('{$icon_file}.eot#iefix') format('embedded-opentype'),
url('{$icon_file}.woff') format('woff'),
url('{$icon_file}.ttf') format('truetype'),
url('{$icon_file}.svg#{$name}') format('svg');
}
[data-zniconfam='{$name}']:before , [data-zniconfam='{$name}']  { font-family: '{$name}' !important; }
[data-zn_icon]:before {
    content: attr(data-zn_icon)
}
";

			}

			return $output;

		}

		function generate_icon_data( $icon )
		{
			if ( !is_array( $icon ) ) return;
			if ( empty( $icon['family'] ) || empty( $icon['unicode'] ) ) return;
// print_z($icon);
			return 'data-zniconfam="'.$icon['family'].'" data-zn_icon="'.$this->get_icon( $icon['unicode'] ).'"';

		}

	}

	function zn_generate_icon( $icon ) {

		return ZN()->icon_manager->generate_icon_data( $icon );

	}

?>
