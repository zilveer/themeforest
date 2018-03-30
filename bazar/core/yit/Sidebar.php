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
 * Class to handle sidebars
 * 
 * @since 1.0.0
 */
class YIT_Sidebar {
    
}


if( !function_exists('yit_get_sidebars') ) {
    /**
     * Returns the list of sidebars
     */
	function yit_get_sidebars() {
		$sidebars = wp_get_sidebars_widgets();
		unset($sidebars['orphaned_widgets_1']);
		unset($sidebars['wp_inactive_widgets']);
		
		return $sidebars;
	}
}

if( !function_exists('yit_get_sidebar_widgets') ) {
    /**
     * Returns the widgets contained within a specific sidebar
     * 
     */
	function yit_get_sidebar_widgets( $sidebar ) {
		$sidebars = wp_get_sidebars_widgets();
		
		return $sidebars[$sidebar];
	}
}

if( !function_exists( 'yit_registered_sidebars' ) ) {
    /**
     * Retrieve all registered sidebars
     * 
     * @return array
     * @since 1.0.0
     */
    function yit_registered_sidebars() {
        global $wp_registered_sidebars;
 
        $return = array();
         
        if ( empty( $wp_registered_sidebars ) )
            { $return = array( '' => '' ); }
        
        foreach ( ( array ) $wp_registered_sidebars as $the_ )
            { $return[ $the_['name'] ] = $the_['name']; }
        
        ksort( $return );
        
        return $return;
    }
}

