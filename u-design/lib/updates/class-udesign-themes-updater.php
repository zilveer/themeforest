<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists("UDesign_Theme_Updater") ) {
	class UDesign_Theme_Updater {
			
		protected $username;
		protected $apikey;

		public function __construct($username = null,$apikey = null,$authors = null) {

			$this->username = $username;
			$this->apikey = $apikey;
			$this->authors = $authors;

		}

		public function check($updates) {

			$this->username = apply_filters("udesign_theme_update_username",$this->username);
			$this->apikey = apply_filters("udesign_theme_updater_apikey",$this->apikey);
			$this->authors = apply_filters("udesign_theme_updater_authors",$this->authors);

			if (isset($this->authors) && !is_array($this->authors)) {
				$this->authors = array($this->authors);
			}

			if (!isset($this->username) || !isset($this->apikey) || !isset($updates->checked)) return $updates;

			if (!class_exists("Envato_Protected_API")) {
				require_once( trailingslashit( get_template_directory() ) . "lib/updates/class-envato-api.php" );
			}

			
			$api = new Envato_Protected_API($this->username,$this->apikey);
			add_filter("http_request_args",array(&$this,"http_timeout"),10,1);
			$purchased = $api->wp_list_themes(true);

			$installed = function_exists("wp_get_themes") ? wp_get_themes() : get_themes();
			$filtered = array();
			
			foreach ($installed as $theme) {
				if ($this->authors && !in_array($theme->{'Author Name'},$this->authors)) continue;
				$filtered[$theme->Name] = $theme;
			}
                        
                        if ( is_array( $purchased ) ) {
                            foreach ($purchased as $theme) {
                                    if ( isset( $filtered[$theme->theme_name] ) && $theme->item_id == 253220 ) { // to list all themes that needs updating for this user remove: "&& $theme->item_id == 253220"
                                            // gotcha, compare version now
                                            $current = $filtered[$theme->theme_name];
                                            if (version_compare($current->Version, $theme->version, '<')) {
                                                    // bingo, inject the update
                                                    if ($url = $api->wp_download($theme->item_id)) {
                                                            $update = array(
                                                                        "url" => "http://themeforest.net/item/theme/{$theme->item_id}",
                                                                        "new_version" => $theme->version,
                                                                        "package" => $url
                                                                        );

                                                            $updates->response[$current->Stylesheet] = $update;

                                                    }
                                            }
                                    }
                            }
                        }

			remove_filter("http_request_args",array(&$this,"http_timeout"));

			return $updates;
		}

		public function http_timeout($req) {
			// increase timeout for api request
			$req["timeout"] = 300;
			return $req;
		}

	}
}