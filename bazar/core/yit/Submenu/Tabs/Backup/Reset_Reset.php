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
 * Class to print fields in the tab Sample Data -> Export
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Backup_Reset_Reset extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_backup_reset_reset
     * 
     * @param array $fields
     * @since 1.0.0
     */
    public function __construct() {
        $fields = $this->init();
        //$this->fields = apply_filters( strtolower( __CLASS__ ), $fields );
    }
    
    /**
     * Set default values
     * 
     * @return array
     * @since 1.0.0
     */
    public function init() {  
        return false;
    }
	
	/**
	 * Display tab html code
	 * 
	 * @return string
	 * @since 1.0.0
	 */
	public function display_page() {
?>
	<div class="yit_options">
		<h3><?php _e( 'Delete Cache', 'yit' ) ?></h3>
									
		<p><?php printf( __( 'When you click the button below, the folder <strong>wp-content/themes/%s/cache/</strong> will be empty.', 'yit' ), get_template() ) ?></p>
        <p><?php _e( 'It\'s possible you will see the website front-end broken after deleteing the cache. <strong>Do not worry!</strong> Simply reload the page so the theme can regenerate the correct style.', 'yit' ) ?></p>
		<p>
			<input type="submit" value="<?php _e( 'Delete Cache', 'yit' ) ?>" class="button-secondary" id="delete-cache" />
            <img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" class="ajax-loading" id="add-items-ajax-loading-1" alt="" />
		</p>
	</div>
    
    <div class="yit_options">
		<h3><?php _e( 'Reset Theme Options', 'yit' ) ?></h3>
									
		<p><?php _e( 'When you click the button below, the Theme Options return to its default values.', 'yit' ) ?></p>
        <p><?php _e( 'Once the Theme Options is resetted to default, you need to save it again to regenerate the style.', 'yit' ) ?></p>
		<p>
			<input type="submit" value="<?php _e( 'Reset Theme Options', 'yit' ) ?>" class="button-secondary" id="reset-theme-options" />
            <img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" class="ajax-loading" id="add-items-ajax-loading-2" alt="" />
		</p>
	</div>
    
    <div class="yit_options">
		<h3><?php _e( 'Delete Custom Sidebars', 'yit' ) ?></h3>
									
		<p><?php _e( 'When you click the button below, all Custom Sidebars will be deleted.', 'yit' ) ?></p>
		<p>
			<input type="submit" value="<?php _e( 'Delete Custom Sidebars', 'yit' ) ?>" class="button-secondary" id="delete-custom-sidebars" />
            <img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" class="ajax-loading" id="add-items-ajax-loading-3" alt="" />
		</p>
	</div>
    
    <div class="yit_options">
		<h3><?php _e( 'Delete Resized Images', 'yit' ) ?></h3>
									
		<p><?php _e( 'Click here to remove all resized images located inside the "uploads" folder. The images are been generated to show some images with a specific size.', 'yit' ) ?></p>
		<p>
			<input type="submit" value="<?php _e( 'Delete Resized Images', 'yit' ) ?>" class="button-secondary" id="delete-resized-images" />
            <img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" class="ajax-loading" id="add-items-ajax-loading-4" alt="" />
		</p>
	</div>
<?php
	}
}
