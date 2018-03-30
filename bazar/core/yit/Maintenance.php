<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Manage Custom maintenance Screen
 * 
 * @since 1.0.0
 */
class YIT_Maintenance {
	


	/**
	 * Constructor
	 */
	public function __construct() {}
	
	/**
	 * Init
	 * 
	 */
	public function init() {
		if( !is_admin() ) {
			add_action( 'init', array( $this, 'activate_maintenance'), 99 );
		}
		
		add_action( 'admin_bar_menu', array( &$this, 'admin_bar_menu' ), 1000 );
		add_action('wp_head', array( &$this, 'custom_style'));
		add_action('admin_head', array( &$this, 'custom_style'));
	}
	
	/** 
	 * Admin bar menu item
	 * 
	 */
    public function admin_bar_menu(){
    	if( !$this->_isMaintenanceEnabled() ) return;
		
		global $wp_admin_bar;

		/* Add the main siteadmin menu item */
		$wp_admin_bar->add_menu( array(
			'id'     => 'maintenance-bar',
            'href'   => admin_url().'admin.php?page=yit_panel_maintenance',
            'parent' => 'top-secondary',
            'title'  => apply_filters( 'yit_maintenance_admin_bar_title', __('Maintenance Mode Active', 'yit') ),
            'meta'   => array( 'class' => 'yit_maintenance' ),
        ) );
	}
	
	/**
	 * Custom css for admin bar menu item
	 * 
	 */
	public function custom_style() {
		if ( !is_user_logged_in() || !$this->_isMaintenanceEnabled() ) return; ?>
	<style type="text/css">
    #wp-admin-bar-maintenance-bar a.ab-item { background: rgb(197, 132, 8) !important; color: #fff !important }
    </style>
	<?php
	}
	
	/**
	 * Render the maintenance page
	 * 
	 */
	public function activate_maintenance() {
		if( !$this->_isMaintenanceEnabled() || $this->_userIsAllowed() || $this->_isLoginPage() ) return;

		yit_get_template('maintenance/maintenance.php', $this->_vars());
		exit();
	}

	/**
	 * Is the maintenance mode enabled?
	 * 
	 * @return bool
	 * @since 1.0.0
	 */
	protected function _isMaintenanceEnabled() {
		return yit_get_option('enable-maintenance') == 1;
	}


	/**
	 * Is the user allowed to access to frontend?
	 * 
	 * @return bool
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _userIsAllowed() {
		//super admin
		if( current_user_can('manage_network') || current_user_can('administrator') ) {
			return true;
		}

		$roles = json_decode(stripslashes(yit_get_option('maintenance-allowed_roles')), true);
		$allowed = array_keys( (array)$roles['allowed'] );
		$user_roles = yit_user_roles();
		
		$is_allowed = false;
		
		foreach( $user_roles as $role ) {
			if( in_array( $role, $allowed ) ) {
				$is_allowed = true;
				break;
			}
		}
		
		return $is_allowed;
	}
	
	
	/**
	 * Is it a login page?
	 * 
	 * @return bool
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _isLoginPage() {
		$pages = array('/wp-login.php', '/wp-admin/index.php');
		$current_page = $_SERVER['PHP_SELF'];
		$found = false;
		
		foreach( $pages as $page ) {
			if( strpos( $current_page, $page ) !== false ) {
				$found = true;
				break;
			}
		}
		
		return $found;
	}
	
	
	/**
	 * Generate template vars
	 * 
	 * @return array
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _vars() {
		$vars = array(
			'background' => array(
				'color'      => yit_get_option('maintenance-bg_color'),
				'image'      => yit_get_option('maintenance-bg_image'),
				'repeat'     => yit_get_option('maintenance-bg_image_repeat'),
				'position'   => yit_get_option('maintenance-bg_image_position'),
				'attachment' => yit_get_option('maintenance-bg_image_attachment')
			),
			'logo' => array(
				'image' => yit_get_option('maintenance-logo_image'),
				'color' => yit_get_option('maintenance-logo_color')
			),
			'container' => array(
				'width'  => yit_get_option('maintenance-container_width'),
				'height' => yit_get_option('maintenance-container_height'),
				'color'  => yit_get_option('maintenance-container-bg_color')
			),
			'message' => yit_get_option('maintenance-message'),
			'newsletter' => array(
				'enabled' => yit_get_option('maintenance-enable-newsletter') == 1,
				'submit' => array(
					'color' => yit_get_option('maintenance-newsletter-background'),
					'hover' => yit_get_option('maintenance-newsletter-background_hover'),
				)
			),
			'custom' => yit_get_option('maintenance-custom-style')
		);

		return apply_filters('yit_maintenance_vars',$vars );
	}
}