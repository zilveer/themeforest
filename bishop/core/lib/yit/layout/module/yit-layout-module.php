<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit;
} // Exit if accessed directly

abstract class YIT_Layout_Module{

    /**
     * Module idenfification
     * @var string
     */
    protected $id;

    /**
     * Module name
     * @var string
     */
    protected $name;

    protected $serchable;

    protected $pagination = array(
        'per_page' => 20,
        'total_pages' => 1,
        'total_items' => 0
    );

    /**
     *
     * Constructor
     *
     */
    public function __construct($id, $name, $serchable) {
        $this->id = $id;
        $this->name = $name;
        $this->serchable = $serchable;

        add_action('wp_ajax_yit-layout-module-'.$this->id,array( $this,'ajax_get_content'));

    }
}