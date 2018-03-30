<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

/**
 * Description of TF_SHORTCODES_MODEL
 *
 */
class TF_SHORTCODES_MODEL extends TF_TFUSE {

    public $_the_class_name = 'SHORTCODES_MODEL';
    public $_ext_name = 'SHORTCODES';
    public $_standalone = TRUE;

    function __construct() {
        parent::__construct();
    }

}
