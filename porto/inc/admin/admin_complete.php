<?php

require_once(porto_admin . '/theme_options.php');

class Porto_Admin {

    public function __construct() {
        add_action( 'after_switch_theme', array( $this, 'activation_redirect' ) );
    }

    public function activation_redirect() {
        if ( current_user_can( 'edit_theme_options' ) ) {
            header( 'Location:' . admin_url() . 'admin.php?page=porto' );
        }
    }
}

new Porto_Admin();
