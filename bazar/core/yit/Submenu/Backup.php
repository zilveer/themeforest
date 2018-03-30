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
 * YIT Sample Data submenu page
 * 
 * 
 * @since 1.0.0
 */

class YIT_Submenu_Backup extends YIT_Submenu_Abstract {
    
    /**
     * Menu items
     * 
     * @var array
     * @since 1.0.0
     */
    public $_menu = array();
    
    /**
     * Submenu items
     * 
     * @var array
     * @since 1.0.0
     */
    public $_submenu = array();

    /**
	 * Init helper method
     * 
	 */
	public function init() {
	    $this->_menu = apply_filters( 'yit_admin_menu_backup', array(
            'sampledata' => __( 'Sample data', 'yit' ),
	    	'configuration' => __( 'Configuration', 'yit' ),
            'backup' => __( 'Backup', 'yit' ),
            'reset' => __( 'Reset', 'yit' )
        ) );
        
        $this->_submenu = apply_filters( 'yit_admin_submenu_backup', array(
            'sampledata' => array(
                'install' => __( 'Install', 'yit' ),
                'images' => __( 'Download Sample Images', 'yit')
            ),
        	'configuration' => array(
                'all' => __( 'All configurations saved', 'yit' ),
                'save' => __( 'Save new configuration', 'yit' )
			),
            'backup' => array(
                'import' => __( 'Import Data', 'yit' ),
                'export' => __( 'Export Data', 'yit' )
            ),
            'reset' => array(
                'reset' => __( 'Reset', 'yit' )
            )
        ) );
	}
    
    /**
     * Print the menu for the Theme Options
     * 
     * @return void
     * @since 1.0.0
     */
    public function get_menu( $id ) {
        if( !empty( $this->_menu ) && !empty( $this->_submenu ) ) :
           yit_get_template('admin/panel/menu.php', array ( 'id' => $id, 'menu' => $this->_menu, 'submenu' => $this->_submenu ) );
        endif;
	}
	
	/**
	 * Print an iframe for the shop
	 * 
	 * @return void
     * @since 1.0.0
	 */
	public function display_page() {
    
	    $this->get_header( 'backup' );
	   	$this->get_form( array(
							'id' => 'backup',
							'action' => 'panel_backup',
							'enctype' => true,
							'subpage' => strtolower( str_replace( 'YIT_Submenu_', '', __CLASS__ ) )
						) );
     
        foreach( $this->_tabClasses as $slug=>$class ) : ?>
        <div id="yit_<?php echo $slug ?>" class="yit-box">
			<?php $class->display_page() ?>
        </div>
        <?php
        endforeach;

	        
	    $this->get_footer();
	}
	
}
