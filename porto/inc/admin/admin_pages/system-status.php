<?php
$theme = wp_get_theme();
if ($theme->parent_theme) {
	$template_dir =  basename(get_template_directory());
	$theme = wp_get_theme($template_dir);
}
?>
<div class="wrap about-wrap porto-wrap">
    <h1><?php _e( 'Welcome to Porto!', 'porto' ); ?></h1>
    <div class="about-text"><?php echo esc_html__( 'Porto is now installed and ready to use! Read below for additional information. We hope you enjoy it!', 'porto' ); ?></div>
    <div class="porto-logo"><span class="porto-version"><?php _e( 'Version', 'porto' ); ?> <?php echo porto_version; ?></span></div>
    <h2 class="nav-tab-wrapper">
        <?php
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=porto' ), __( "Welcome", 'porto' ) );
        printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', __( "System Status", 'porto' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=porto-plugins' ), __( "Plugins", 'porto' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=porto-demos' ), __( "Install Demos", 'porto' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=porto_settings' ), __( "Theme Options", 'porto' ) );
        ?>
    </h2>
    <div class="porto-section">

        <table class="widefat" cellspacing="0">
            <thead>
            <tr>
                <th colspan="2"><?php _e( 'Porto Versions', 'porto' ); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php _e( 'Current Version:', 'porto' ); ?></td>
                <td><?php echo porto_version; ?></td>
            </tr>
            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
            <tr>
                <th colspan="2"><?php _e( 'WordPress Environment', 'porto' ); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php _e( 'Home URL:', 'porto' ); ?></td>
                <td><?php echo home_url(); ?></td>
            </tr>
            <tr>
                <td><?php _e( 'Site URL:', 'porto' ); ?></td>
                <td><?php echo site_url(); ?></td>
            </tr>
            <tr>
                <td><?php _e( 'WP Version:', 'porto' ); ?></td>
                <td><?php bloginfo('version'); ?></td>
            </tr>
            <tr>
                <td><?php _e( 'WP Multisite:', 'porto' ); ?></td>
                <td><?php if ( is_multisite() ) echo '&#10004;'; else echo '&ndash;'; ?></td>
            </tr>
            <tr>
                <td><?php _e( 'WP Memory Limit:', 'porto' ); ?></td>
                <td><?php
                    $memory = $this->let_to_num( WP_MEMORY_LIMIT );
                    if ( $memory < 128000000 ) {
                        echo '<mark class="error">' . sprintf( __( '%s - We recommend setting memory to at least <strong>128MB</strong>. <br /> Please define memory limit in <strong>wp-config.php</strong> file. To learn how, see: <a href="%s" target="_blank">Increasing memory allocated to PHP.</a>', 'porto' ), size_format( $memory ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
                    } else {
                        echo '<mark class="yes">' . size_format( $memory ) . '</mark>';
                        if ( $memory < 256000000 ) {
                            echo '<br /><mark class="error">' . __( 'Your current memory limit is sufficient, but if you installed many plugins or need to import demo content, the required memory limit is <strong>256MB.</strong>', 'porto' ) . '</mark>';
                        }
                    }
                    ?></td>
            </tr>
            <tr>
                <td><?php _e( 'WP Debug Mode:', 'porto' ); ?></td>
                <td><?php if ( defined('WP_DEBUG') && WP_DEBUG ) echo '<mark class="yes">' . '&#10004;' . '</mark>'; else echo '<mark class="no">' . '&ndash;' . '</mark>'; ?></td>
            </tr>
            <tr>
                <td><?php _e( 'Language:', 'porto' ); ?></td>
                <td><?php echo get_locale() ?></td>
            </tr>
            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
            <thead>
            <tr>
                <th colspan="2"><?php _e( 'Server Environment', 'porto' ); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php _e( 'Server Info:', 'porto' ); ?></td>
                <td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
            </tr>
            <tr>
                <td><?php _e( 'PHP Version:', 'porto' ); ?></td>
                <td><?php if ( function_exists( 'phpversion' ) ) echo esc_html( phpversion() ); ?></td>
            </tr>
            <?php if ( function_exists( 'ini_get' ) ) : ?>
                <tr>
                    <td><?php _e( 'PHP Post Max Size:', 'porto' ); ?></td>
                    <td><?php echo size_format( $this->let_to_num( ini_get('post_max_size') ) ); ?></td>
                </tr>
                <tr>
                    <td><?php _e( 'PHP Time Limit:', 'porto' ); ?></td>
                    <td><?php
                        $time_limit = ini_get('max_execution_time');

                        if ( $time_limit < 180 && $time_limit != 0 ) {
                            echo '<mark class="error">' . sprintf( __( '%s - We recommend setting max execution time to at least 180. <br /> To import demo content, <strong>300</strong> seconds of max execution time is required.<br />See: <a href="%s" target="_blank">Increasing max execution to PHP</a>', 'porto' ), $time_limit, 'http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded' ) . '</mark>';
                        } else {
                            echo '<mark class="yes">' . $time_limit . '</mark>';
                            if ( $time_limit < 300 && $time_limit != 0 ) {
                                echo '<br /><mark class="error">' . __( 'Current time limit is sufficient, but if you need import demo content, the required time is <strong>300</strong>.', 'porto' ) . '</mark>';
                            }
                        }
                        ?></td>
                </tr>
                <tr>
                    <td><?php _e( 'PHP Max Input Vars:', 'porto' ); ?></td>
                    <td><?php
                        echo $max_input_vars = ini_get('max_input_vars');
                        ?></td>
                </tr>
                <tr>
                    <td><?php _e( 'SUHOSIN Installed:', 'porto' ); ?></td>
                    <td><?php echo extension_loaded( 'suhosin' ) ? '&#10004;' : '&ndash;'; ?></td>
                </tr>
                <?php if ( extension_loaded( 'suhosin' ) ): ?>
                    <tr>
                        <td><?php _e( 'Suhosin Post Max Vars:', 'porto' ); ?></td>
                        <td><?php
                            echo $max_input_vars = ini_get( 'suhosin.post.max_vars' );
                            ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'Suhosin Request Max Vars:', 'porto' ); ?></td>
                        <td><?php
                            echo $max_input_vars = ini_get( 'suhosin.request.max_vars' );
                            ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'Suhosin Post Max Value Length:', 'porto' ); ?></td>
                        <td><?php
                            $suhosin_max_value_length = ini_get( "suhosin.post.max_value_length" );
                            $recommended_max_value_length = 2000000;

                            if ( $suhosin_max_value_length < $recommended_max_value_length ) {
                                echo '<mark class="error">' . sprintf( __( '%s - Recommended Value: %s.<br />Post Max Value Length limitation may prohibit the Theme Options data from being saved to your database. See: <a href="%s" target="_blank">Suhosin Configuration Info</a>.', 'porto' ), $suhosin_max_value_length, '<strong>' . $recommended_max_value_length . '</strong>', 'http://suhosin.org/stories/configuration.html' ) . '</mark>';
                            } else {
                                echo '<mark class="yes">' . $suhosin_max_value_length . '</mark>';
                            }
                            ?></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
            <tr>
                <td><?php _e( 'GZip:', 'porto' ); ?></td>
                <td><?php echo class_exists( 'ZipArchive' ) ? '&#10004;' : '&ndash;'; ?></td>
            </tr>
            <tr>
                <td><?php _e( 'MySQL Version:', 'porto' ); ?></td>
                <td>
                    <?php
                    /** @global wpdb $wpdb */
                    global $wpdb;
                    if (version_compare($wpdb->db_version(), '5.0', '>=')) {
                        echo '<mark class="yes">' . $wpdb->db_version() . '</mark>';
                    } else {
                        echo '<mark class="error">' . $wpdb->db_version() . '</mark>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td><?php _e( 'Max Upload Size:', 'porto' ); ?></td>
                <td><?php echo size_format( wp_max_upload_size() ); ?></td>
            </tr>
            <tr>
                <td><?php _e( 'DOMDocument:', 'porto' ); ?></td>
                <td><?php echo class_exists( 'DOMDocument' ) ? '&#10004;' : '&ndash;'; ?></td>
            </tr>
            <tr>
                <td><?php _e( 'WP Remote Get:', 'porto' ); ?></td>
                <?php $response = wp_safe_remote_get( 'https://www.woothemes.com/wc-api/product-key-api?request=ping&network=' . ( is_multisite() ? '1' : '0' ) ); ?>
                <td><?php echo ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) ? '<mark class="yes">&#10004;</mark>' : '<mark class="error">wp_remote_get() failed. Some theme features may not work. Please contact your hosting provider.</mark>'; ?></td>
            </tr>
            <tr>
                <td><?php _e( 'WP Remote Post:', 'porto' ); ?></td>
                <?php $response = wp_safe_remote_post( 'https://www.paypal.com/cgi-bin/webscr', array(
                    'timeout'     => 60,
                    'user-agent'  => 'WooCommerce/2.6',
                    'httpversion' => '1.1',
                    'body'        => array(
                        'cmd'    => '_notify-validate'
                    )
                ) ); ?>
                <td><?php echo ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) ? '<mark class="yes">&#10004;</mark>' : '<mark class="error">wp_remote_post() failed. Some theme features may not work. Please contact your hosting provider.</mark>'; ?></td>
            </tr>
            </tbody>
        </table>

        <table class="widefat" cellspacing="0" id="status">
            <thead>
            <tr>
                <th colspan="2"><?php _e( 'Active Plugins', 'porto' ); ?> (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $active_plugins = (array) get_option( 'active_plugins', array() );

            if ( is_multisite() ) {
                $active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
            }

            foreach ( $active_plugins as $plugin ) {

                $plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
                $dirname        = dirname( $plugin );
                $version_string = '';
                $network_string = '';

                if ( ! empty( $plugin_data['Name'] ) ) {

                    // link the plugin name to the plugin url if available
                    $plugin_name = esc_html( $plugin_data['Name'] );

                    if ( ! empty( $plugin_data['PluginURI'] ) ) {
                        $plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . __( 'Visit plugin homepage' , 'porto' ) . '">' . $plugin_name . '</a>';
                    }
                    ?>
                    <tr>
                        <td><?php echo $plugin_name; ?></td>
                        <td><?php printf( _x( 'by %s', 'by author', 'porto' ), $plugin_data['Author'] ) . ' &ndash; ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string; ?></td>
                    </tr>
                <?php
                }
            }
            ?>
            </tbody>
        </table>

    </div>
    <div class="porto-thanks">
        <p class="description"><?php _e( 'Thank you, we hope you to enjoy using Porto!', 'porto' ); ?></p>
    </div>
</div>
