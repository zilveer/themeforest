<?php if(! defined('ABSPATH')){ return; }
if(!defined('ABSPATH')) {
	die("Don't call this file directly.");
}

if ( ! class_exists( 'ZnThemeOptionsExport' ) ) {
	class ZnThemeOptionsExport
	{

		private $file_name = 'theme_options.txt';

		/**
		 * Holds the wp_upload_dir() paths
		 * @var array
		 */
		var $upload_dir_config;

		/**
		 * Holds the uploads directory url
		 * @var string
		 */
		var $upload_dir_url;

		/**
		 * Holds the uploads directory url without WWW
		 * @var string
		 */
		var $upload_dir_url_no_www;

		/**
		 * Holds the uploads directory path
		 * @var string
		 */
		var $upload_dir_path;

		/**
		 * Holds the uploads placeholder used for replacing the uploads urls
		 * @var string
		 */
		var $site_url_placeholder = 'ZNBP_SITE_URL_PLACEHOLDER';

		/**
		 * Holds the allowed file types on export
		 * @var array
		 */
		var $allowed_file_types = array(
			'jpg',
			'png',
			'gif',
			'svg',
			'jpeg',
			'txt',
			'woff',
			'ttf',
			'eot',
		);

		function __construct(){
		}

		function render_page() {
		}

		function do_deploy(){


		}

		function do_export(){
			header( 'Content-Description: File Transfer' );
			header( 'Content-Disposition: attachment; filename=' . $this->file_name );
			header( 'Content-Type: text/plain; charset=' . get_option( 'blog_charset' ), true );

			$options_json = $this->build_options_json();
			echo $options_json;

			die();
		}

		function build_options_json(){

			$this->upload_dir_config = wp_upload_dir();
			$this->upload_dir_path = $this->upload_dir_config['basedir'];
			$this->upload_dir_url = $this->upload_dir_config['baseurl'];
			$this->upload_dir_url_no_www = str_replace('www.', '', $this->upload_dir_url );


			$options = $this->get_all_options();
			$options = $this->zpbp_parse_recursive_export( $options );
			return json_encode($options);

		}

		function zpbp_parse_recursive_export( &$export_config ){

			if( empty( $export_config ) ) return $export_config;

			if ( is_array( $export_config ) ){
				foreach ($export_config as $key => &$value) {
					if ( empty( $value ) ) continue;

					if( is_array( $value ) ){
						$this->zpbp_parse_recursive_export( $value );
					}
					else{
						// Check if this is exportable media
						$value = $this->znpb_extract_image( $value );
					}
				}
			}
			else{
				// This should be a string
				$export_config = $this->znpb_extract_image( $export_config );
			}

			return $export_config;
		}

		/**
		 * This function checks to see if we have an exportable media and if so, it will add it to the zip file
		 * @param  [type] $url [description]
		 * @param  [type] $zip [description]
		 * @return [type]      [description]
		 */
		private function znpb_extract_image( $url ){

			$file_types = implode('|', $this->allowed_file_types);
			$pattern = "#https?://[^/\s]+/\S+\.($file_types)#";
			$url = preg_replace_callback( $pattern, array( $this, 'media_callback' ), $url );

			return $url;
		}

		/**
		 * This function adds the media file to the zip archive and replaces the uploads directory path with a placeholder path that we cann replace on import
		 * @param  array $file The preg_replace match
		 * @return string The modified file url
		 */
		function media_callback($file){

			// Check to see if this is a local file or not
			if( strpos($file[0], $this->upload_dir_url) !== false || strpos($file[0], $this->upload_dir_url_no_www) !== false ){
				// Get the media file path relative to the uploads folder
				$file_path = str_replace(array($this->upload_dir_url, $this->upload_dir_url_no_www), '', $file[0]);
				return $this->site_url_placeholder . $file_path;
			}

			return $file[0];
		}

		// Make this function to pass trough all the options and skipe the 'skip_export' ones
		function get_all_options(){
			$options = zget_option(false,false,true);

			unset($options['general_options']['mailchimp_api']);
			unset($options['general_options']['google_analytics']);

			// Add custom css and custom js. Thesse are saved in a separate DB field
			$custom_css = get_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_css' );
			$custom_js = get_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_js' );

			if ( ! empty( $custom_css ) ){
				$options['advanced']['custom_css'] = $custom_css;
			}
			if ( ! empty( $custom_js ) ){
				$options['advanced']['custom_js'] = $custom_js;
			}

			return $options;
		}


	}

}


?>
