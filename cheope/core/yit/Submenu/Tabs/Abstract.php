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
 * General class to print fields in the Theme Options
 * 
 * @since 1.0.0
 */
abstract class YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields.
     * It is a multi-dimensional array:
     * 
     * $fields = array(
     *     10 => array();
     *     20 => array();
     * );
     * 
     * Numeric index is the priority when print items and cannot be <= 0
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields = array();
    
    /**
     * Merge default fields with theme specific fields using the filter $filter
     * 
     * @param string $filter
     * @since 1.0.0
     */
    public function __construct( $filter ) {
        $fields = $this->init();
        $this->fields = apply_filters( strtolower( $filter ), $fields );
    }
    
    /**
     * Set the default fields and return it.
     * 
     * @return array
     * @since 1.0.0
     */
    abstract public function init();
}