<?php

/***************************************************
:: Register Theme Panel Pages
 ***************************************************/

add_action('admin_menu', 'kleo_register_theme_panel_pages');
function kleo_register_theme_panel_pages(){
    add_theme_page( esc_html__( 'BuddyApp Theme', 'buddyapp' ), esc_html__( 'Theme Welcome', 'buddyapp' ), 'manage_options', 'buddyapp', 'kleo_theme_panel_page_welcome' );
}


function kleo_theme_panel_page_welcome() {
    $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : false;
    if( $tab == 'changelog' ){
        kleo_theme_panel_page_changelog();
    } else {
        require( KLEO_LIB_DIR . '/theme-panel/buddyapp.php');
    }
}

function kleo_theme_panel_page_changelog() {
    require_once( KLEO_LIB_DIR . '/theme-panel/changelog.php');
}

require_once( KLEO_LIB_DIR . '/theme-panel/theme_options.php' );


add_action( 'admin_init', 'kleo_theme_panel_redirect', 0);
function kleo_theme_panel_redirect() {

    // Theme activation redirect
    global $pagenow;
    if( isset( $_GET['activated'] ) && $pagenow == 'themes.php' ){

        kleo_unlink_dynamic_css();

        wp_redirect( admin_url("themes.php?page=buddyapp") );
        exit;
    }

}

function kleo_theme_panel_function(){
    return false;
}


function sq_panel_header( $active = 'welcome' ) {
    ?>
    <span class="page-title"><span class="dashicons dashicons-text"></span><b><?php esc_html_e("BuddyApp Theme", "buddyapp");?></b></span>
    <div class="about-text">
        <?php echo wp_kses_post( __("Welcome to the <b>first mobile oriented</b> social networking theme.<br>" .
            "Here you'll find valuable information which will help you setup your site in no time.", "buddyapp") );?>
    </div>
    <div class="buddyapp-badge"><?php esc_html_e("Version", "buddyapp");?><div><?php echo KLEO_THEME_VERSION; ?></div></div>
    <h1 class="nav-tab-wrapper">
        <a class="nav-tab<?php if ( $active == 'welcome' ) { ?> nav-tab-active<?php } ?>" href="<?php echo admin_url('admin.php?page=buddyapp'); ?>"><?php esc_html_e("Welcome", "buddyapp");?></a>
        <a class="nav-tab<?php if ( $active == 'options' ) { ?> nav-tab-active<?php } ?>" href="<?php echo admin_url('admin.php?page=buddyapp-options'); ?>"><?php esc_html_e("Theme options", "buddyapp");?></a>
        <a class="nav-tab<?php if ( $active == 'backup' ) { ?> nav-tab-active<?php } ?>" href="<?php echo admin_url('admin.php?page=buddyapp-backup'); ?>"><?php esc_html_e("Backup options", "buddyapp");?></a>
        <a class="nav-tab<?php if ( $active == 'changelog' ) { ?> nav-tab-active<?php } ?>" href="<?php echo admin_url('admin.php?page=buddyapp&tab=changelog'); ?>"><?php esc_html_e("Changelog", "buddyapp");?></a>
    </h1>
<?php
}


