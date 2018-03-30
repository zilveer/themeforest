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
 * Class to print fields in the tab Sample Data -> Import
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Backup_Backup_Import extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_sidebars_custom_add
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
		<h3><?php _e( 'Import Theme Data', 'yit' ) ?></h3>
		<p class="install-help"><?php _e( 'If you have Theme Data in a .gz format, you may install it by uploading it here.', 'yit' ) ?></p>
		<div class="yit_options rm_option rm_input rm_text rm_upload">
			<div class="option">
				<input type="file" name="import-file" style="width:300px" id="import-file" /> <input type="submit" value="Import" class="button" /><br /> 
			</div>
            <div class="description">
				<?php _e( '<strong>Warning</strong>: You must import sample data <strong>before</strong> customizing your theme. If you begin customizing your theme, then import sample data, <strong>all current data entered on your site will be overwritten/lost</strong>! Please proceed with the utmost care, <strong>after backing up all current data</strong>!', 'yit' ) ?>
                <br /><?php _e( '<strong>Note</strong>: If you get errors, please be sure that your server can use the PHP function <strong>set_time_limit()</strong> before to write in the support forum.', 'yit' ) ?>
            </div>
            <div class="clear"></div> 
		</div>
	</div>
<?php
	}
}
