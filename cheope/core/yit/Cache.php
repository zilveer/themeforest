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
 * Cache handler
 * 
 * @since 1.0.0
 */
class YIT_Cache {
    /**
     * Cache expiration time. Defualt is 1 week.
     * 
     * @var int
     * @access protected
     * @since 1.0.0
     */
    protected $_expiration_time = 604800;
    
    /**
     * Locate the file in the "cache" folder, first in child theme and then in
     * parent theme.     
     * 
     * @param string $fname
     * @param mixed $content
     * @return bool
     * @since 1.0.0
     */
    public function locate_file( $fname ) {
        $folder_name = str_replace( get_stylesheet_directory_uri() . '/', '', YIT_CACHE_URL );
        $cache_dir = locate_template( $folder_name, false );
        $file = $cache_dir . '/' . $fname;
        
        return $file;
    }
    
    /**
     * Locate the file in the "cache" folder, first in child theme and then in
     * parent theme.     
     * 
     * @param string $fname
     * @param mixed $content
     * @return bool
     * @since 1.0.0
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
     * @param string $fname
     * @param mixed $content
     * @return bool
     * @since 1.0.0
     */
    public function save( $fname, $content ) {    
        $file = $this->locate_file( $fname );
        
        return yit_file_put_contents( $file, $content );
        
//         $fp = fopen( $file, 'w' );
//                 
//         if( $fp !== false ) {
//             fwrite( $fp, $content );
//             fclose( $fp );
//             
//             return true;
//         }
//         
//         return false;
    }
    
    /**
     * Retrieve cache file content.
     * 
     * @param string $fname
     * @return mixed
     * @since 1.0.0
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
     * @param string $fname
     * @return bool
     * @since 1.0.0
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