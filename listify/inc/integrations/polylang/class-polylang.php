<?php
/**
 * Polylang
 */

class Listify_Polylang extends Listify_Integration {

    public function __construct() {
        $this->includes = array();
        $this->integration = 'polylang';

        parent::__construct();
    }

    public function setup_actions() {}

}

$GLOBALS[ 'listify_polylang' ] = new Listify_Polylang();
