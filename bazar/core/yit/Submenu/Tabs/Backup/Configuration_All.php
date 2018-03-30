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
class YIT_Submenu_Tabs_Backup_Configuration_All extends YIT_Submenu_Tabs_Abstract {
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
		$configs = get_option( yit_get_model('panel')->configs_name  );
?>
			<div id="backup_configuration_all" class="yit_options rm_option rm_input rm_text">
                <div class="option">
                	<?php if( !empty($configs) ): ?>
                    <label for="configuration-restore"><?php _e('Choose a configuration to restore', 'yit'); ?></label>
	                <div class="select_wrapper">
	                    <select name="configuration-restore" id="configuration-restore">
							<?php foreach( $configs as $slug=>$config ): ?>
							<option value="<?php echo $slug ?>"><?php echo $config['name'] ?></option>
							<?php endforeach ?>
	                    </select>
	                </div>                    
					<input type="submit" value="Restore" class="button" name="configuration-restore-save" id="configuration-restore-save">
					<?php else: ?>
					<?php _e( 'No configuration backups were created. Create a new configuration before.', 'yit'); ?>
					<?php endif ?>
                </div>
                <div class="description">
                    <?php _e( 'Choose a configuration backup to restore.', 'yit'); ?>
                </div>
                <div class="clear"></div>
            </div>

			<?php if( !empty($configs) ): ?>
			<div id="backup_configuration_remove" class="yit_options rm_option rm_input rm_text rm_sidebarlist">
                <div class="option">
                    <label for="configuration-remove"><?php _e('Choose a configuration to delete', 'yit'); ?></label>
                    
					<table class="cc-options">
						<tbody>      
		                <?php foreach( $configs as $slug=>$config ): ?>
		                	<tr>
		                		<td>
									<a href="#" rel="<?php echo $slug ?>" class="configuration-remove-item" title="<?php _e( 'Delete', 'yit' ) ?>"><img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/close_20.png" alt="<?php _e( 'Delete', 'yit' ) ?>" /></a>
					                <?php echo $config['name'] ?>
		                		</td>
		                	</tr>
		                <?php endforeach ?>                           
				        </tbody>
					</table>
					
					<input type="hidden" name="configuration-remove" id="configuration-remove" value="" />
                </div>
                <div class="description">
                    <?php _e( 'Choose a configuration backup to remove.', 'yit'); ?>
                </div>
                <div class="clear"></div>
            </div>
		<?php endif ?>
<?php
	}
}
