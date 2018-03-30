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
 * Class to print fields in the tab Sample Data -> Install
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Backup_Sampledata_Install extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_backup_sampledata_install
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
		<h3><?php _e( 'Install sample data', 'yit' ) ?></h3>

		<?php if( defined('YIT_IS_SHOP') && YIT_IS_SHOP ): ?>
		<p><strong><?php _e('Keep in mind to download and activate Woocommerce before to install sample data!', 'yit') ?></strong></p>
		<?php endif ?>

		<p><?php _e( 'Click on the button below to install our sample data. With it installed, your website will look like our live preview.', 'yit' ) ?></p>
        <p><?php _e( 'The installation may need few minutes. Please be patient and do not refresh the page.', 'yit' ) ?></p>
        <p><?php _e( '<strong>Note</strong>: If you get errors, please be sure that your server can use the PHP function <strong>set_time_limit()</strong> before to write in the support forum.', 'yit' ) ?></p>
        <p><?php _e( '<strong>Warning</strong>: You must install sample data <strong>before</strong> customizing your theme. If you begin customizing your theme, then install sample data, <strong>all current data entered on your site will be overwritten/lost</strong>! Please proceed with the utmost care, <strong>after backing up all current data</strong>!', 'yit' ) ?></p>

        <?php if( defined('YIT_SAMPLE_DATA_LIGHT') ): ?>
        <h3><?php _e('Choose the Sample Data version you want to install', 'yit') ?></h3>
        <p><?php _e('If you have experienced performarce issues once you installed the default sample data or simply you want to try the theme with only the shop installed, please select the Light version.', 'yit') ?></p>

        <select id="sample_data_version" name="sample_data_version" style="opacity:1">
            <option value="default" selected><?php _e('Default', 'yit') ?></option>
            <option value="light"><?php _e('Light', 'yit') ?></option>
        </select>
        <?php endif ?>

        <p>
			<input type="submit" value="<?php _e( 'Install sample data', 'yit' ) ?>" class="button-secondary" id="install-sampledata" />
            <img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" class="ajax-loading" id="add-items-ajax-loading-1" alt="" />
		</p>
	</div>
<?php
	}
}
