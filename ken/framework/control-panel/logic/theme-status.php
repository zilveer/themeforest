<?php

function redux_clean( $var ) {
    return sanitize_text_field( $var );
}

$sysinfo = mk_artbees_products::compileSystemStatus( false, true );
 ?>

 <div class="control-panel-holder">

	<?php echo mk_get_control_panel_view('header', true, array('page_slug' => 'theme-status')); ?>

	<div class="status-page cp-pane">
			<h3>System Status</h3>

            <a href="#" class="cp-button medium blue debug-report">
                <?php esc_html_e( 'Get System Report', 'mk_framework' ); ?>
            </a>
        </p>

        <div id="debug-report">
            <textarea readonly="readonly" onclick="this.focus();this.select()"></textarea>
        </div>
    <br/>
    <table class="status_table" cellspacing="0" id="status">
        <thead>
        <tr>    
            <th colspan="3" data-export-label="WordPress Environment">
                <?php esc_html_e( 'WordPress Environment', 'mk_framework' ); ?>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td data-export-label="Home URL">
                <?php esc_html_e( 'Home URL', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The URL of your site\'s homepage.', 'mk_framework' ); ?>
                </span>
            </td>
            <td><?php echo esc_url($sysinfo['home_url']); ?></td>
        </tr>
        <tr>
            <td data-export-label="Site URL">
                <?php esc_html_e( 'Site URL', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The root URL of your site.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
                <?php echo esc_url($sysinfo['site_url']); ?>
            </td>
        </tr>
        <tr>
            <td data-export-label="WP Content URL">
                <?php esc_html_e( 'WP Content URL', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The location of Wordpress\'s content URL.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
                <?php echo '<code>' . esc_url($sysinfo['wp_content_url']) . '</code> '; ?>
            </td>
        </tr>        
        <tr>
            <td data-export-label="WP Version">
                <?php esc_html_e( 'WP Version', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The version of WordPress installed on your site.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
                <?php bloginfo( 'version' ); ?>
            </td>
        </tr>
        <tr>
            <td data-export-label="WP Multisite">
                <?php esc_html_e( 'WP Multisite', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'Whether or not you have WordPress Multisite enabled.', 'mk_framework' ); ?>
                </span>
            </td>
            <td><?php if ( $sysinfo['wp_multisite'] == true ) {
                    echo '<span class="status-invisible">True</span><span class="status-state status-true"></span>';
                } else {
                    echo '<span class="status-invisible">False</span><span class="status-state status-false"></span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td data-export-label="Permalink Structure">
                <?php esc_html_e( 'Permalink Structure', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The current permalink structure as defined in Wordpress Settings->Permalinks.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
                <?php echo esc_html($sysinfo['permalink_structure']); ?>
            </td>
        </tr>
        <?php $sof = $sysinfo['front_page_display']; ?>
        <tr>
            <td data-export-label="Front Page Display">
                <?php esc_html_e( 'Front Page Display', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The current Reading mode of Wordpress.', 'mk_framework' ); ?>
                </span>
            </td>
            <td><?php echo esc_html($sof); ?></td>
        </tr>

        <?php
            if ( $sof == 'page' ) {
?>
                <tr>
                    <td data-export-label="Front Page">
                        <?php esc_html_e( 'Front Page', 'mk_framework' ); ?>:
                    </td>
                    <td class="help">
                        <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                        <span class="mk-tooltip--text">
                            <?php echo esc_attr__( 'The currently selected page which acts as the site\'s Front Page.', 'mk_framework' ); ?>
                        </span>
                    </td>
                    <td>
                        <?php echo esc_html($sysinfo['front_page']); ?>
                    </td>
                </tr>
                <tr>
                    <td data-export-label="Posts Page">
                        <?php esc_html_e( 'Posts Page', 'mk_framework' ); ?>:
                    </td>
                    <td class="help">
                        <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                        <span class="mk-tooltip--text">
                            <?php echo esc_attr__( 'The currently selected page in where blog posts are displayed.', 'mk_framework' ); ?>
                        </span>
                    </td>
                    <td>
                        <?php echo esc_html($sysinfo['posts_page']); ?>
                    </td>
                </tr>
<?php
            }
?>
        <tr>
            <td data-export-label="WP Memory Limit">
                <?php esc_html_e( 'WP Memory Limit', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The maximum amount of memory (RAM) that your site can use at one time.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
<?php
                    $memory = $sysinfo['wp_mem_limit']['raw'];

                    if ( $memory < 40000000 ) {
                        echo '<mark class="error">' . sprintf( __( '%s - We recommend setting memory to at least 40MB. See: <a href="%s" target="_blank">Increasing memory allocated to PHP</a>', 'mk_framework' ), esc_html($sysinfo['wp_mem_limit']['size']), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
                    } else {
                        echo '<mark class="yes">' . esc_html($sysinfo['wp_mem_limit']['size']) . '</mark>';
                    }
?>
            </td>
        </tr>
        <tr>
            <td data-export-label="Database Table Prefix">
                <?php esc_html_e( 'Database Table Prefix', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The prefix structure of the current Wordpress database.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
                <?php echo esc_html($sysinfo['db_table_prefix']); ?>
            </td>
        </tr>
        <tr>
            <td data-export-label="WP Debug Mode">
                <?php esc_html_e( 'WP Debug Mode', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'Displays whether or not WordPress is in Debug Mode.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
                <?php if ( $sysinfo['wp_debug'] === 'true' ) {
                    echo '<span class="status-invisible">True</span><span class="status-state status-true"></span>';
                } else {
                    echo '<span class="status-invisible">False</span><span class="status-state status-false"></span>';
                } ?>
            </td>
        </tr>
        <tr>
            <td data-export-label="Language">
                <?php esc_html_e( 'Language', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The current language used by WordPress. Default = English', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
                <?php echo esc_html($sysinfo['wp_lang']); ?>
            </td>
        </tr>
        </tbody>
    </table>
    <table class="status_table" cellspacing="0" id="status">
        <thead>
        <tr>
            <th colspan="3" data-export-label="Theme"><?php esc_html_e( 'Theme', 'mk_framework' ); ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td data-export-label="Name"><?php esc_html_e( 'Name', 'mk_framework' ); ?>:</td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The name of the current active theme.', 'mk_framework' ); ?>
                </span>
            </td>
            <td><?php echo esc_html($sysinfo['theme']['name']); ?></td>
        </tr>
        <tr>
            <td data-export-label="Version"><?php esc_html_e( 'Version', 'mk_framework' ); ?>:</td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The installed version of the current active theme.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
<?php
                echo esc_html($sysinfo['theme']['version']);

                if ( ! empty( $theme_version_data['version'] ) && version_compare( $theme_version_data['version'], $active_theme->Version, '!=' ) ) {
                    echo ' &ndash; <strong style="color:red;">' . esc_html($theme_version_data['version']) . ' ' . esc_html__( 'is available', 'mk_framework' ) . '</strong>';
                }
?>
            </td>
        </tr>
        <tr>
            <td data-export-label="Author URL"><?php esc_html_e( 'Author URL', 'mk_framework' ); ?>:</td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The theme developers URL.', 'mk_framework' ); ?>
                </span>
            </td>
            <td><?php echo esc_url($sysinfo['theme']['author_uri']); ?></td>
        </tr>
        <tr>
            <td data-export-label="Child Theme"><?php esc_html_e( 'Child Theme', 'mk_framework' ); ?>:</td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'Displays whether or not the current theme is a child theme.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
<?php
                echo is_child_theme() ? '<span class="status-invisible">True</span><span class="status-state status-true"></span>' : '<span class="status-invisible">False</span><span class="status-state status-false"></span> ' . sprintf( __( '<a href="%s" target="_blank">How to create a child theme</a>', 'mk_framework' ), 'http://codex.wordpress.org/Child_Themes' );

                
?>
            </td>
        </tr>
<?php
            if ( is_child_theme() ) {
?>
                <tr>
                    <td data-export-label="Parent Theme Name"><?php esc_html_e( 'Parent Theme Name', 'mk_framework' ); ?>:
                    </td>
                    <td class="help">
                        <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                        <span class="mk-tooltip--text">
                            <?php echo esc_attr__( 'The name of the parent theme.', 'mk_framework' ); ?>
                        </span>
                    </td>
                    <td><?php echo esc_html($sysinfo['theme']['parent_name']); ?></td>
                </tr>
                <tr>
                    <td data-export-label="Parent Theme Version">
                        <?php esc_html_e( 'Parent Theme Version', 'mk_framework' ); ?>:
                    </td>
                    <td class="help">
                        <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                        <span class="mk-tooltip--text">
                            <?php echo esc_attr__( 'The installed version of the parent theme.', 'mk_framework' ); ?>
                        </span>
                    </td>
                    <td><?php echo esc_html($sysinfo['theme']['parent_version']); ?></td>
                </tr>
                <tr>
                    <td data-export-label="Parent Theme Author URL">
                        <?php esc_html_e( 'Parent Theme Author URL', 'mk_framework' ); ?>:
                    </td>
                    <td class="help">
                        <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                        <span class="mk-tooltip--text">
                            <?php echo esc_attr__( 'The parent theme developers URL.', 'mk_framework' ); ?>
                        </span>
                    </td>
                    <td><?php echo esc_url($sysinfo['theme']['parent_author_uri']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <table class="status_table" cellspacing="0" id="status">
        <thead>
        <tr>
            <th colspan="3" data-export-label="Browser">
                <?php esc_html_e( 'Browser', 'mk_framework' ); ?>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td data-export-label="Browser Info">
                <?php esc_html_e( 'Browser Info', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'Information about web browser current in use.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
<?php
                foreach ( $sysinfo['browser'] as $key => $value ) {
                    echo '<strong>' . esc_html(ucfirst( $key )) . '</strong>: ' . esc_html($value) . '<br/>';
                }
?>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="status_table" cellspacing="0" id="status">
        <thead>
        <tr>
            <th colspan="3" data-export-label="Server Environment">
                <?php esc_html_e( 'Server Environment', 'mk_framework' ); ?>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td data-export-label="Server Info">
                <?php esc_html_e( 'Server Info', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'Information about the web server that is currently hosting your site.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
                <?php echo esc_html($sysinfo['server_info']); ?>
            </td>
        </tr>
        <tr>
            <td data-export-label="Localhost Environment">
                <?php esc_html_e( 'Localhost Environment', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'Is the server running in a localhost environment.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
<?php
                if ( $sysinfo['localhost'] === 'true' ) {
                    echo '<span class="status-invisible">True</span><span class="status-state status-true"></span>';
                } else {
                    echo '<span class="status-invisible">False</span><span class="status-state status-false"></span>';
                }
?>            
            </td>
        </tr>
        <tr>
            <td data-export-label="PHP Version">
                <?php esc_html_e( 'PHP Version', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The version of PHP installed on your hosting server.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
                <?php echo esc_html($sysinfo['php_ver']); ?>
            </td>
        </tr>
        <tr>
            <td data-export-label="ABSPATH">
                <?php esc_html_e( 'ABSPATH', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The ABSPATH variable on the server.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
                <?php echo '<code>' . esc_html($sysinfo['abspath']) . '</code>'; ?>
            </td>
        </tr>
        
        <?php if ( function_exists( 'ini_get' ) ) { ?>
            <tr>
                <td data-export-label="PHP Memory Limit"><?php esc_html_e( 'PHP Memory Limit', 'mk_framework' ); ?>:</td>
                <td class="help">
                    <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                    <span class="mk-tooltip--text">
                        <?php echo esc_attr__( 'The largest filesize that can be contained in one post.', 'mk_framework' ); ?>
                    </span>
                </td>
                <td><?php echo esc_html($sysinfo['php_mem_limit']); ?></td>
            </tr>
            <tr>
                <td data-export-label="PHP Post Max Size"><?php esc_html_e( 'PHP Post Max Size', 'mk_framework' ); ?>:</td>
                <td class="help">
                    <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                    <span class="mk-tooltip--text">
                        <?php echo esc_attr__( 'The largest filesize that can be contained in one post.', 'mk_framework' ); ?>
                    </span>
                </td>
                <td><?php echo esc_html($sysinfo['php_post_max_size']); ?></td>
            </tr>
            <tr>
                <td data-export-label="PHP Time Limit"><?php esc_html_e( 'PHP Time Limit', 'mk_framework' ); ?>:</td>
                <td class="help">
                    <?php echo '<a href="#" class="mk-hint mk-tooltip--link" qtip-content="' . esc_attr__( '', 'mk_framework' ) . '"></a>'; ?>
                    <span class="mk-tooltip--text">
                        <?php echo esc_attr__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)', 'mk_framework' ); ?>
                    </span>
                </td>
                <td><?php echo esc_html($sysinfo['php_time_limit']); ?></td>
            </tr>
            <tr>
                <td data-export-label="PHP Max Input Vars"><?php esc_html_e( 'PHP Max Input Vars', 'mk_framework' ); ?>:</td>
                <td class="help">
                    <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                    <span class="mk-tooltip--text">
                        <?php echo esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'mk_framework' ); ?>
                    </span>
                </td>
                <td><?php echo esc_html($sysinfo['php_max_input_var']); ?></td>
            </tr>
            <tr>
                <td data-export-label="PHP Display Errors"><?php esc_html_e( 'PHP Display Errors', 'mk_framework' ); ?>:</td>
                <td class="help">
                    <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                    <span class="mk-tooltip--text">
                        <?php echo esc_attr__( 'Determines if PHP will display errors within the browser.', 'mk_framework' ); ?>
                    </span>
                </td>
                <td><?php
                        if ( 'true' === $sysinfo['php_display_errors'] ) {
                            echo '<span class="status-invisible">True</span><span class="status-state status-true"></span>';
                } else {
                    echo '<span class="status-invisible">False</span><span class="status-state status-false"></span>';
                        }
                    ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td data-export-label="SUHOSIN Installed"><?php esc_html_e( 'SUHOSIN Installed', 'mk_framework' ); ?>:</td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'Suhosin is an advanced protection system for PHP installations. It was designed to protect your servers on the one hand against a number of well known problems in PHP applications and on the other hand against potential unknown vulnerabilities within these applications or the PHP core itself.  If enabled on your server, Suhosin may need to be configured to increase its data submission limits.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
                <?php if ( $sysinfo['suhosin_installed'] == true ) {
                   echo '<span class="status-invisible">True</span><span class="status-state status-true"></span>';
                } else {
                    echo '<span class="status-invisible">False</span><span class="status-state status-false"></span>';
                } ?>
            </td>
        </tr>

        <tr>
            <td data-export-label="MySQL Version"><?php esc_html_e( 'MySQL Version', 'mk_framework' ); ?>:</td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The version of MySQL installed on your hosting server.', 'mk_framework' ); ?>
                </span>
            </td>
            <td><?php echo esc_html($sysinfo['mysql_ver']); ?></td>
        </tr>
        <tr>
            <td data-export-label="Max Upload Size"><?php esc_html_e( 'Max Upload Size', 'mk_framework' ); ?>:</td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The largest filesize that can be uploaded to your WordPress installation.', 'mk_framework' ); ?>
                </span>
            </td>
            <td><?php echo esc_html($sysinfo['max_upload_size']); ?></td>
        </tr>
        <tr>
            <td data-export-label="Default Timezone is UTC">
                <?php esc_html_e( 'Default Timezone is UTC', 'mk_framework' ); ?>:
            </td>
            <td class="help">
                <?php echo '<a href="#" class="mk-hint mk-tooltip--link"></a>'; ?>
                <span class="mk-tooltip--text">
                    <?php echo esc_attr__( 'The default timezone for your server.', 'mk_framework' ); ?>
                </span>
            </td>
            <td>
<?php
                if ( $sysinfo['def_tz_is_utc'] === 'false' ) {
                    echo '<span class="status-invisible">False</span><span class="status-state status-false"></span> ' . sprintf( __( 'Default timezone is %s - it should be UTC', 'mk_framework' ), esc_html(date_default_timezone_get()) );
                } else {
                    echo '<span class="status-invisible">True</span><span class="status-state status-true"></span>';
                } 

                
?>
            </td>
        </tr>
        <?php
            $posting = array();

            // fsockopen/cURL
            $posting['fsockopen_curl']['name'] = 'fsockopen/cURL';
            $posting['fsockopen_curl']['help'] = '<a href="#" class="mk-hint mk-tooltip--link"></a>
                <span class="mk-tooltip--text">
                    ' . esc_attr__( 'Used when communicating with remote services with PHP.', 'mk_framework' ) . '
                </span>
            ';

            if ( $sysinfo['fsockopen_curl'] === 'true' ) {
                $posting['fsockopen_curl']['success'] = true;
            } else {
                $posting['fsockopen_curl']['success'] = false;
                $posting['fsockopen_curl']['note']    = esc_html__( 'Your server does not have fsockopen or cURL enabled - cURL is used to communicate with other servers. Please contact your hosting provider.', 'mk_framework' );
            }

            
            // SOAP
            $posting['soap_client']['name'] = 'SoapClient';
            $posting['soap_client']['help'] = '<a href="#" class="mk-hint mk-tooltip--link""></a>
                <span class="mk-tooltip--text">
                    ' . esc_attr__( 'Some webservices like shipping use SOAP to get information from remote servers, for example, live shipping quotes from FedEx require SOAP to be installed.', 'mk_framework' ) . '
                </span>
            ';

            if ( $sysinfo['soap_client'] == true ) {
                $posting['soap_client']['success'] = true;
            } else {
                $posting['soap_client']['success'] = false;
                $posting['soap_client']['note']    = sprintf( __( 'Your server does not have the <a href="%s">SOAP Client</a> class enabled - some gateway plugins which use SOAP may not work as expected.', 'mk_framework' ), 'http://php.net/manual/en/class.soapclient.php' );
            }

            // DOMDocument
            $posting['dom_document']['name'] = 'DOMDocument';
            $posting['dom_document']['help'] = '<a href="#" class="mk-hint mk-tooltip--link"></a>
                <span class="mk-tooltip--text">
                    ' . esc_attr__( 'HTML/Multipart emails use DOMDocument to generate inline CSS in templates.', 'mk_framework' ) . '
                </span>
            ';

            if ( $sysinfo['dom_document'] == true ) {
                $posting['dom_document']['success'] = true;
            } else {
                $posting['dom_document']['success'] = false;
                $posting['dom_document']['note']    = sprintf( __( 'Your server does not have the <a href="%s">DOMDocument</a> class enabled - HTML/Multipart emails, and also some extensions, will not work without DOMDocument.', 'mk_framework' ), 'http://php.net/manual/en/class.domdocument.php' );
            }
            

            // GZIP
            $posting['gzip']['name'] = 'GZip';
            $posting['gzip']['help'] = '<a href="#" class="mk-hint mk-tooltip--link"></a>
                <span class="mk-tooltip--text">
                    ' . esc_attr__( 'GZip (gzopen) is used to open the GEOIP database from MaxMind.', 'mk_framework' ) . '
                </span>
            ';
            
            if ( $sysinfo['gzip'] == true ) {
               $posting['gzip']['success'] = true;
            } else {
               $posting['gzip']['success'] = false;
               $posting['gzip']['note']    = sprintf( __( 'Your server does not support the <a href="%s">gzopen</a> function - this is required to use the GeoIP database from MaxMind. The API fallback will be used instead for geolocation.', 'mk_framework' ), 'http://php.net/manual/en/zlib.installation.php' );
            }

            // WP Remote Post Check
            $posting['wp_remote_post']['name'] = esc_html__( 'Remote Post', 'mk_framework' );
            $posting['wp_remote_post']['help'] = '<a href="#" class="mk-hint mk-tooltip--link"></a>
                <span class="mk-tooltip--text">
                    ' . esc_attr__( 'Used to send data to remote servers.', 'mk_framework' ) . '
                </span>
            ';

            if ( $sysinfo['wp_remote_post'] === 'true' ) {
                $posting['wp_remote_post']['success'] = true;
            } else {
                $posting['wp_remote_post']['note'] = esc_html__( 'wp_remote_post() failed. Many advanced features may not function. Contact your hosting provider.', 'mk_framework' );

                if ( $sysinfo['wp_remote_post_error'] ) {
                    $posting['wp_remote_post']['note'] .= ' ' . sprintf( __( 'Error: %s', 'mk_framework' ), redux_clean( $sysinfo['wp_remote_post_error'] ) );
                }

                $posting['wp_remote_post']['success'] = false;
            }

            // WP Remote Get Check
            $posting['wp_remote_get']['name'] = esc_html__( 'Remote Get', 'mk_framework' );
            $posting['wp_remote_get']['help'] = '<a href="#" class="mk-hint mk-tooltip--link"></a>
                <span class="mk-tooltip--text">
                    ' . esc_attr__( 'Used to grab information from remote servers for updates updates.', 'mk_framework' ) . '
                </span>
            ';

            if ( $sysinfo['wp_remote_get'] === 'true' ) {
                $posting['wp_remote_get']['success'] = true;
            } else {
                $posting['wp_remote_get']['note'] = esc_html__( 'wp_remote_get() failed. This is needed to get information from remote servers. Contact your hosting provider.', 'mk_framework' );
                if ( $sysinfo['wp_remote_get_error'] ) {
                    $posting['wp_remote_get']['note'] .= ' ' . sprintf( __( 'Error: %s', 'mk_framework' ), redux_clean( $sysinfo['wp_remote_get_error'] ) );
                }

                $posting['wp_remote_get']['success'] = false;
            }

            $posting = apply_filters( 'redux_debug_posting', $posting );

            foreach ( $posting as $post ) {
                $mark = ! empty( $post['success'] ) ? 'yes' : 'error';
                ?>
                <tr>
                    <td data-export-label="<?php echo esc_html( $post['name'] ); ?>">
                        <?php echo esc_html( $post['name'] ); ?>:
                    </td>
                    <td class="help">
                        <?php echo isset( $post['help'] ) ? $post['help'] : ''; ?>
                    </td>
                    <td>
                        <mark class="<?php echo esc_attr($mark); ?>">
                            <?php echo ! empty( $post['success'] ) ? '<span class="status-invisible">True</span><span class="status-state status-true"></span>' : '<span class="status-invisible">False</span><span class="status-state status-false"></span>'; ?>
                            <?php echo ! empty( $post['note'] ) ? wp_kses_data( $post['note'] ) : ''; ?>
                        </mark>
                    </td>
                </tr>
            <?php
            }
        ?>
        </tbody>
    </table>
    
    <table class="status_table" cellspacing="0" id="status">
        <thead>
        <tr>
            <th colspan="3" data-export-label="Active Plugins (<?php echo esc_html(count( (array) get_option( 'active_plugins' ) ) ); ?>)">
                <?php esc_html_e( 'Active Plugins', 'mk_framework' ); ?> (<?php echo esc_html(count( (array) get_option( 'active_plugins' ) ) ); ?>)
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach ( $sysinfo['plugins'] as $name => $plugin_data ) {
                $version_string = '';
                $network_string = '';

                if ( ! empty( $plugin_data['Name'] ) ) {
                    // link the plugin name to the plugin url if available
                    $plugin_name = esc_html( $plugin_data['Name'] );

                    if ( ! empty( $plugin_data['PluginURI'] ) ) {
                        $plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . esc_attr__( 'Visit plugin homepage', 'mk_framework' ) . '">' . esc_html($plugin_name) . '</a>';
                    }
?>
                    <tr>
                        <td><?php echo $plugin_name; ?></td>
                        <td class="help">&nbsp;</td>
                        <td>
                            <?php echo sprintf( _x( 'by %s', 'by author', 'mk_framework' ), $plugin_data['Author'] ) . ' &ndash; ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string; ?>
                        </td>
                    </tr>
<?php
                }
            }
        ?>
        </tbody>
    </table>
		
	</div>
</div>