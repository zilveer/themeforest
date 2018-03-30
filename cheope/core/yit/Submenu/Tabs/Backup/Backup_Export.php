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
class YIT_Submenu_Tabs_Backup_Backup_Export extends YIT_Submenu_Tabs_Abstract {
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
		<h3><?php _e( 'Export Theme Data', 'yit' ) ?></h3>
									
		<p><?php _e('When you click the button below WordPress will create a GZIP file for you to save to your computer.', 'yit' ) ?></p>
		<p><?php _e('This format will contain your theme options the following tables: posts, postmeta, terms, term_taxonomy, term_relationships.', 'yit' ) ?>
		<p><?php _e('Once you\'ve saved the download file, you can use the Import function in another WordPress installation to import the content from this site.', 'yit' ) ?></p>
		<p>
			<input type="submit" value="<?php _e( 'Download Export File', 'yit' ) ?>" class="button-secondary" id="export-file" />
		</p>
	</div>
<?php
	}
}
