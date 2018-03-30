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
 * YIT Sidebars submenu page
 * 
 * 
 * @since 1.0.0
 */

class YIT_Submenu_Splash extends YIT_Submenu_Abstract {
    
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
	    $this->_menu = apply_filters( 'yit_admin_menu_splash', array(
            'custom_splash' => __( 'Customize Login Screen', 'yit' )
        ) );
        
        $this->_submenu = apply_filters( 'yit_admin_submenu_splash', array(
            'custom_splash' => array(
                'general' => __( 'General', 'yit' ),
                'background' => __( 'Background', 'yit' ),
                'logo' => __( 'Logo', 'yit' ),
                'container' => __( 'Container', 'yit' )
            )
        ) );
	}
    
    /**
     * Print the menu for the Theme Options
     * 
     * @return void
     * @since 1.0.0
     */
    public function get_menu($id) {
        if( !empty( $this->_menu ) && !empty( $this->_submenu ) ) :
           yit_get_template('admin/panel/menu.php', array ( 'id' => $id, 'menu' => $this->_menu, 'submenu' => $this->_submenu ) );
        endif;
    }
	
	/**
	 * Print all options
     * 
     * @return void
     * @since 1.0.0
	 */
	public function display_page() {
    
    $this->get_header('splash');
   	$this->get_form( array(
						'id' => 'splash',
						'action' => 'panel_splash',
						'subpage' => strtolower( str_replace( 'YIT_Submenu_', '', __CLASS__ ) )
					) );
		
        foreach( $this->_tabClasses as $slug => $fields ) : ?>
        <div id="yit_<?php echo $slug ?>" class="yit-box">
            <div class="yit-options">
                <?php
                ksort( $fields->fields );
                
                foreach( $fields->fields as $priority => $tab ) {
                    if( $priority < 0 )
                        { continue; }
                    
                    YIT_Type::display( $tab );
                }
                ?>
            </div>
        </div>
        <?php
        endforeach;
        
        $this->get_footer();
	}
}