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
 
require_once YIT_CORE_PATH . '/lib/vendors/mobile-detect/mobile-detect.php';

/**
 * Class to detect mobiles and tablets
 * 
 * @since 1.0.0
 */
class YIT_Mobile extends Mobile_Detect {

}

if( !function_exists( 'yit_is_mobile' ) ) {
    /**
     * Check if you are on a mobile device (tablet/mobile phone) or not
     * 
     * @return bool
     * @since 1.0.0
     */
    function yit_is_mobile() {
        $mobile = new Mobile_Detect();
        
        return $mobile->isMobile();
    }
}

if( !function_exists( 'yit_is_iphone' ) ) {
    /**
     * Check if you are on an iphone or not
     * 
     * @return bool
     * @since 1.0.0
     */
    function yit_is_iphone() {
        $mobile = new Mobile_Detect();
        
        return $mobile->isIphone();
    }
}

if( !function_exists( 'yit_is_ipad' ) ) {
    /**
     * Check if you are on an ipad or not
     * 
     * @return bool
     * @since 1.0.0
     */
    function yit_is_ipad() {
        $mobile = new Mobile_Detect();
        
        return $mobile->isIpad();
    }
}

if( !function_exists( 'yit_is_tablet' ) ) {
    /**
     * Check if you are on a table or not
     * 
     * @return bool
     * @since 1.0.0
     */
    function yit_is_tablet() {
        $mobile = new Mobile_Detect();
        
        return ( $mobile->isIpad() || $mobile->isBlackberryTablet() || $mobile->isAndroidTablet() );
    }
}