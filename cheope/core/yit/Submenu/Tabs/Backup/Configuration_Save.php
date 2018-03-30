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
class YIT_Submenu_Tabs_Backup_Configuration_Save extends YIT_Submenu_Tabs_Abstract {
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
			<div id="backup_configuration_save" class="yit_options rm_option rm_input rm_text">
                <div class="option">
                    <label for="configuration-name"><?php _e('Configuration Name', 'yit'); ?></label>
                    <input type="text" name="configuration-name" id="configuration-name" />
                    
					<input type="submit" value="Add" class="button" name="configuration_name_save" id="configuration_name_save">
                </div>
                <div class="description">
                    <?php _e( 'Choose the name of the configuration', 'yit' ); ?>
                </div>
                <div class="clear"></div>
            </div>
<?php
	}
}
