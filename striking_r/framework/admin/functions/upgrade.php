<?php
class upgradeHelper {
	public function __construct() {
		$this->init();
	}

	public function init(){
		add_action('update-core-custom_'.THEME_SLUG.'_theme_update', array(&$this,'update'));

		add_filter( 'http_response', array(&$this,'download_package_http_response_filter'), 10, 3 );
		if (theme_get_option('advanced','update_notification') ){
			add_action('admin_notices', array(&$this,'notices'));
		}
	}

	public function download_package_http_response_filter( $response, $args, $url ){
		if ( 0 === strpos( $url, $this->getPackage() ) ) {
			switch (wp_remote_retrieve_response_code( $response )){
				case '401':
					return new WP_Error( 'unauthorized',  __('Please input your purchase code','theme_admin'));
				case '406':
					return new WP_Error( 'not_acceptable',  __('Please contact theme author','theme_admin'));	
			}
			
	    }
	    return $response;
	}
	public function notices(){
		if ( is_multisite() && !current_user_can('update_core') )
			return false;		

		$has_update =  $this->check();
		if($has_update){
			if ( current_user_can('update_core') ) {
				$notification = get_transient(THEME_SLUG.$has_update.'_notification');
				if($notification){
					$msg = sprintf( $notification, $has_update, THEME_NAME, admin_url( 'admin.php?page=theme_advanced&tab=update#update') );
				} else {
					$msg = sprintf( __('%2$s %1$s is available! You should review the instructions in the version thread at the Striking Support forum prior to updating first. Then <a href="%3$s">update it</a>.','theme_admin'), $has_update, THEME_NAME, admin_url( 'admin.php?page=theme_advanced&tab=update#update') );
				}
			} else {
				$msg = sprintf( __('%2$s %1$s is available! Please notify the site administrator.','theme_admin'), $has_update, THEME_NAME );
			}
			echo "<div class='update-nag'>$msg</div>";
		}
	}

	public static function check(){

		$latest_version = get_transient(THEME_SLUG.'_update');
		
		if(isset($_GET['check'])){
			$latest_version = false;
		}
		if(!$latest_version){
			$latest_version = THEME_VERSION;
			global $wp_version,$wp_install;

			$query = array(
				'version'           => THEME_VERSION,
				'theme'             => THEME_SLUG,
			);

			$url = 'http://api.kaptinlin.com/themes/'.THEME_SLUG.'/upgrade/check/'.THEME_VERSION;
			$url = apply_filters('theme_check_url', $url,THEME_SLUG, THEME_VERSION);
	 		$options = array(
				'timeout' => ( ( defined('DOING_CRON') && DOING_CRON ) ? 30 : 3 ),
				'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url( '/' ),
				'headers' => array(
					'wp_install' => $wp_install,
					'wp_blog' => home_url( '/' )
				)
			);

			$response = wp_remote_get($url, $options);

			if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
				set_transient(THEME_SLUG.'_update', $latest_version, 3600); // cache for 1hr (3600)
				return false;
			}
				
			
			$body =  json_decode(trim( wp_remote_retrieve_body( $response ) ),true);

			if($body){
				if(is_array($body) && isset($body['needUpgrade'])){
					if(isset($body['latestVersion'])){
						$latest_version = $body['latestVersion'];
					}
					$needUpgrade = $body['needUpgrade'];
					set_transient(THEME_SLUG.'_update', $latest_version, 43200); // cache for 12hrs (43200)

					if(isset($body['notification'])){
						set_transient(THEME_SLUG.$latest_version.'_notification', $body['notification'], 43200); // cache for 12hrs (43200)
					}
				}
				if(is_array($body) && isset($body['error'])){
					set_transient(THEME_SLUG.'_update', $latest_version, 3600); // cache for 1hr (3600)
					return false;
				}
			}
		}
		if ( version_compare(THEME_VERSION, $latest_version, '>=') )
			return false;
		
		return $latest_version;
	}
	public static function getPackage(){
		$latest_version = get_transient(THEME_SLUG.'_update');
		$url = 'http://api.kaptinlin.com/themes/'.THEME_SLUG.'/verify-purchase/'.theme_get_option('advanced','item_purchase_code').'/upgrade/from/'.THEME_VERSION.'/to/'.$latest_version.'.zip';
		$url = apply_filters('theme_package_url', $url,THEME_SLUG,THEME_VERSION, $latest_version,theme_get_option('advanced','item_purchase_code'));
		return $url;
	}
	public static function getUpdateInfo(){
		$latest_version = get_transient(THEME_SLUG.'_update');
		$url = 'http://api.kaptinlin.com/themes/'.THEME_SLUG.'/compare/from/'.THEME_VERSION.'/to/'.$latest_version;
		$url = apply_filters('theme_update_info_url', $url,THEME_SLUG, THEME_VERSION, $latest_version);
		return $url;
	}
	public function update(){
		if ( ! current_user_can( 'update_themes' ) )
			wp_die( __('You do not have sufficient permissions to update this site.','theme_admin') );

		$title =  sprintf(__('Update %s Themes','theme_admin'),THEME_NAME);
		check_admin_referer('upgrade-'.THEME_SLUG);
		require_once(ABSPATH . 'wp-admin/admin-header.php');

		global $wp_filesystem;
		$url = 'update-core.php?action='.THEME_SLUG.'_theme_update';
		$url = wp_nonce_url($url, 'upgrade-'.THEME_SLUG);
		if ( false === ($credentials = request_filesystem_credentials($url, '', false, ABSPATH)) )
			return;
		if ( ! WP_Filesystem($credentials, ABSPATH) ) {
			request_filesystem_credentials($url, '', true, ABSPATH); //Failed to connect, Error and request again
			return;
		}
?>
		<div class="wrap">
		<h2><?php printf(__('Update %s Themes','theme_admin'),THEME_NAME);?></h2>
<?php
		if ( $wp_filesystem->errors->get_error_code() ) {
			foreach ( $wp_filesystem->errors->get_error_messages() as $message )
				show_message($message);
			echo '</div>';
			return;
		}

		add_filter('update_feedback', 'show_message');

		$need_update = $this->check();
		$latest_version = get_transient(THEME_SLUG.'_update');
		$query = array(
			'version'           => THEME_VERSION,
			'theme'             => THEME_SLUG,
		);
		$name = THEME_NAME;
		$package = $this->getPackage();
		$theme = compact('name','need_update','latest_version','package');

		$upgrader = new Kaptinlin_Theme_Upgrader();
		$result =  $upgrader->upgrade($theme);

		
		if ( is_wp_error($result) ) {
			show_message($result);
			if ('up_to_date' != $result->get_error_code() )
				show_message( __('Installation Failed','theme_admin') );
		} else {
			show_message( sprintf(__('%s updated successfully','theme_admin'),THEME_NAME) );
			show_message( '<a href="' . esc_url( self_admin_url() ) . '">' . __('Go to Dashboard','theme_admin') . '</a>' );
		}
		
		echo '</div>';

		include(ABSPATH . 'wp-admin/admin-footer.php');
		
	}
}
if(isset($_GET['action']) && $_GET['action'] == THEME_SLUG.'_theme_update'){
	include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	class Kaptinlin_Theme_Upgrader extends WP_Upgrader {
		function upgrade_strings() {
			$this->strings['up_to_date'] = sprintf(__('%s is at the latest version.','theme_admin'),THEME_NAME);
			$this->strings['no_package'] = __('Update package not available.','theme_admin');
			$this->strings['downloading_package'] = __('Downloading update from <span class="code">%s</span>&#8230;','theme_admin');
			$this->strings['unpack_package'] = __('Unpacking the package&#8230;','theme_admin');
			$this->strings['copy_failed'] = __('Could not copy files.','theme_admin');
		}
		function upgrade($theme) {
			global $wp_filesystem;

			$this->init();
			$this->upgrade_strings();

			// Is an update available?
			if ( !isset( $theme['latest_version'] ) ||  $theme['latest_version'] == THEME_VERSION )
				return new WP_Error('up_to_date', $this->strings['up_to_date']);
			
			$theme_name = basename (TEMPLATEPATH);
			$theme_dir = trailingslashit(trailingslashit($wp_filesystem->wp_themes_dir()).$theme_name);
			
			$download = $this->download_package( $theme['package'] );
			if ( is_wp_error($download) )
				return $download;
			
			$working_dir =  $this->unpack_package( $download );
			if ( is_wp_error($working_dir) )
				return $working_dir;

			$working_dir = trailingslashit($working_dir);
			
			// Copy update.php from the new version into place.
			if ( !$wp_filesystem->copy($working_dir . 'framework/admin/update.php', $theme_dir . 'framework/admin/update.php', true) ) {
				$wp_filesystem->delete($working_dir, true);
				return new WP_Error('copy_failed', $this->strings['copy_failed']);
			}

			$wp_filesystem->chmod($theme_dir . 'framework/admin/update.php', FS_CHMOD_FILE);

			require(TEMPLATEPATH . '/framework/admin/update.php' );

			return theme_update($working_dir, $theme_dir);
		}
	}
}
