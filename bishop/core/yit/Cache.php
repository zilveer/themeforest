<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Cache handler
 * 
 * @package	Yithemes
 * @since 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Cache {
    /**
     * Cache expiration time (in seconds). Default is 1 week.
     * 
     * @var int
     * @access protected
     * @since 1.0.0
     */
    protected $_expiration_time = 604800;
    
    /**
     * Locate the file in the "cache" folder, first in child theme and then in parent theme.
     * 
     * @param string $fname The file name to locate.
     * @return bool
     * @since 1.0.0
     * @author Simone D'amico <simone.damico@yithemes.com>
     */
    public function locate_file( $fname ) {
        $cache_dir = locate_template( 'cache', false );
        $file = $cache_dir . '/' . $fname;

        return $file;
    }
    
    /**
     * Locate the file in the "cache" folder, first in child theme and then in
     * parent theme.     
     * 
     * @param string $fname The file name to locate.
     * @return string
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function locate_url( $fname ) {
        if( !is_child_theme() )
            { return str_replace( get_template_directory(), get_template_directory_uri(), $this->locate_file( $fname ) ); }
        else
            { return str_replace( get_stylesheet_directory(), get_stylesheet_directory_uri(), $this->locate_file( $fname ) ); }
    }
    
    /**
     * Add contents in a cache file.
     * If the file doesn't exists attempt to create it.
     * 
     * @param string $fname The file name to locate or create.
     * @param mixed $content The filecontent.
     * @return mixed
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function save( $fname, $content ) {    
        $file = $this->locate_file( $fname );
        
        return yit_file_put_contents( $file, $content );
    }
    
    /**
     * Retrieve cache file content.
     * 
     * @param string $fname
     * @return mixed
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function read( $fname ) {
        $file = $this->locate_file( $fname );
        
        if( !file_exists( $file ) )
            { return false; }
        
        $fp = fopen( $file, 'r' );
        
        $content = '';
        while( !feof( $fp ) ) {
            $content .= fread( $fp, 8192 );
        }
        
        fclose( $fp );
        
        return $content;
    }
    
    /**
     * Check if cache file is expired or not.
     * 
     * @param string $fname The file name to check.
     * @return bool
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function is_expired( $fname ) {
        $file = $this->locate_file( $fname );
                        
        if( !file_exists( $file ) )
            { return true; }
            
        if( time() - $this->_expiration_time < filemtime( $file ) ) {
            return false;
        } else {
            return true;
        }
    }
}