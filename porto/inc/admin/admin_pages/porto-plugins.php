<?php
$theme = wp_get_theme();
if ($theme->parent_theme) {
    $template_dir =  basename(get_template_directory());
    $theme = wp_get_theme($template_dir);
}
$tgmpa             = TGM_Plugin_Activation::$instance;
$plugins           = TGM_Plugin_Activation::$instance->plugins;
$view_totals = array(
    'all'      => array(), // Meaning: all plugins which still have open actions.
    'install'  => array(),
    'update'   => array(),
    'activate' => array(),
);

foreach ( $plugins as $slug => $plugin ) {
    if ( $tgmpa->is_plugin_active( $slug ) && false === $tgmpa->does_plugin_have_update( $slug ) ) {
        // No need to display plugins if they are installed, up-to-date and active.
        continue;
    } else {
        $view_totals['all'][ $slug ] = $plugin;

        if ( ! $tgmpa->is_plugin_installed( $slug ) ) {
            $view_totals['install'][ $slug ] = $plugin;
        } else {
            if ( false !== $tgmpa->does_plugin_have_update( $slug ) ) {
                $view_totals['update'][ $slug ] = $plugin;
            }

            if ( $tgmpa->can_plugin_activate( $slug ) ) {
                $view_totals['activate'][ $slug ] = $plugin;
            }
        }
    }
}

$all_index = $install_index = $update_index = $activate_index = 0;

foreach ( $view_totals as $type => $count ) {
    $size = sizeof($count);
    if ( $size < 1 ) {
        continue;
    }
    switch ( $type ) {
        case 'all':
            $all_index = $size;
            break;
        case 'install':
            $install_index = $size;
            break;
        case 'update':
            $update_index = $size;
            break;
        case 'activate':
            $activate_index = $size;
            break;
        default:
            break;
    }
}

$installed_plugins = get_plugins();
?>
<div class="wrap about-wrap porto-wrap">
    <h1><?php _e( 'Welcome to Porto!', 'porto' ); ?></h1>
    <div class="about-text"><?php echo esc_html__( 'Porto is now installed and ready to use! Read below for additional information. We hope you enjoy it!', 'porto' ); ?></div>
    <div class="porto-logo"><span class="porto-version"><?php _e( 'Version', 'porto' ); ?> <?php echo porto_version; ?></span></div>
    <h2 class="nav-tab-wrapper">
        <?php
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=porto' ), __( "Welcome", 'porto' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=porto-system' ), __( "System Status", 'porto' ) );
        printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', __( "Plugins", 'porto' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=porto-demos' ), __( "Install Demos", 'porto' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=porto_settings' ), __( "Theme Options", 'porto' ) );
        ?>
    </h2>
    <div class="porto-section">
        <p class="about-description"><?php _e( 'These are plugins we included inside or recommend for all design features of Porto. You can install, activate, deactivate or update the plugins from this tab.', 'porto' ); ?></p>

        <?php if ($install_index > 1 || $update_index > 1 || $activate_index > 1) : ?>
        <p class="about-description">
            <?php
            if ($install_index > 1)
                printf( '<a href="%s" class="button-primary">%s</a>', admin_url( 'themes.php?page=install-required-plugins&plugin_status=install' ), __( "Click here to install plugins all together.", 'porto' ) );
            ?>
            <?php
            if ($activate_index > 1)
                printf( '<a href="%s" class="button-primary">%s</a>', admin_url( 'themes.php?page=install-required-plugins&plugin_status=activate' ), __( "Click here to activate plugins all together.", 'porto' ) );
            ?>
            <?php
            if ($update_index > 1)
                printf( '<a href="%s" class="button-primary">%s</a>', admin_url( 'themes.php?page=install-required-plugins&plugin_status=update' ), __( "Click here to update plugins all together.", 'porto' ) );
            ?><br><br>
        </p>
        <?php endif; ?>

        <div class="porto-install-plugins">
            <div class="feature-section theme-browser rendered">
                <?php foreach ( $plugins as $plugin ) : ?>
                    <?php
                    $class = '';
                    $plugin_status = '';
                    $file_path = $plugin['file_path'];
                    $plugin_action = $this->plugin_link( $plugin );

                    if ( is_plugin_active( $file_path ) ) {
                        $plugin_status = 'active';
                        $class = 'active';
                    }
                    ?>
                    <div class="theme <?php echo $class; ?>">
                        <div class="theme-wrapper">
                            <div class="theme-screenshot">
                                <img src="<?php echo $plugin['image_url']; ?>" alt="" />
                                <div class="plugin-info">
                                    <?php if ( isset( $installed_plugins[ $plugin['file_path'] ] ) ) : ?>
                                        <?php printf( __( 'Version: %1s', 'porto' ), $installed_plugins[ $plugin['file_path'] ]['Version'] ); ?>
                                    <?php elseif ( 'bundled' == $plugin['source_type'] ) : ?>
                                        <?php printf( esc_attr__( 'Available Version: %s', 'porto' ), $plugin['version'] ); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <h3 class="theme-name">
                                <?php if ( 'active' == $plugin_status ) : ?>
                                    <span><?php printf( __( 'Active: %s', 'porto' ), $plugin['name'] ); ?></span>
                                <?php else : ?>
                                    <?php echo $plugin['name']; ?>
                                <?php endif; ?>
                            </h3>
                            <div class="theme-actions">
                                <?php foreach ( $plugin_action as $action ) { echo $action; } ?>
                            </div>
                            <?php if ( isset( $plugin_action['update'] ) && $plugin_action['update'] ) : ?>
                                <div class="theme-update">
                                    <?php printf( __( 'Update Available: Version %s', 'porto' ), $plugin['version'] ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( isset( $plugin['required'] ) && $plugin['required'] ) : ?>
                                <div class="plugin-required">
                                    <?php esc_html_e( 'Required', 'porto' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
    <div class="porto-thanks">
        <p class="description"><?php _e( 'Thank you, we hope you to enjoy using Porto!', 'porto' ); ?></p>
    </div>
</div>