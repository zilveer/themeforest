<?php

/**
 * Theme Options
 * 
 */
class Buddyapp_Admin_options {
    /**
     * Option key, and option page slug
     * @var string
     */
    public $key = 'buddyapp_options';
    /**
     * Options page metabox id
     * @var string
     */

    public $title = '';
    /**
     * Options Page hook
     * @var string
     */
    public $menu = '';
    /**
     * Options Page hook
     * @var string
     */
    public $slug = '';
    /**
     * Options Page hook
     * @var string
     */
    public $backup = '';
    /**
     * Options Page hook
     * @var string
     */
    public $backup_slug = '';
    /**
     * Constructor
     * @since 0.1.0
     */
    public function __construct() {
        // Set our title
        $this->title = esc_html__( 'BuddyApp Options', 'buddyapp' );
        $this->menu = esc_html__( 'Theme Options', 'buddyapp' );
        $this->slug = 'buddyapp-options';
        $this->backup = esc_html__( 'Theme Backup', 'buddyapp' );
        $this->backup_slug = 'buddyapp-backup';
    }
    /**
     * Initiate our hooks
     * @since 0.1.0
     */
    public function hooks() {
        add_action( 'admin_menu', array( $this, 'add_theme_options_page' ) );
        add_action('admin_print_scripts', array( $this, 'load_scripts' ));
        add_action( 'admin_notices', array( $this, 'admin_notice' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );

        add_action( 'sq_options_after_save', 'kleo_unlink_dynamic_css' );
    }

    /**
     * Load necessary JavaScript and CSS files
     */
    public function load_scripts() {

        if ( isset($_GET['page']) && $_GET['page'] == $this->slug ) {

            wp_enqueue_media();
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'admin-options',  KLEO_LIB_URI . '/theme-panel/assets/js/admin-options.js', array( 'jquery' ) );

        }

    }


    /**
     * Admin Notice.
     */
    public function admin_notice() {

        if ( isset( $_GET['page'] ) && $_GET['page'] == $this->slug ) {

            // Settings saved message
            if ( isset( $_GET['saved'] ) && $_GET['saved'] == 'true' ) {
                printf( '<div class="updated"><p><strong>%1$s</strong></p></div>',
                    esc_html__( 'Settings Saved!', 'buddyapp' )
                );
            }

            // Settings reset message
            if ( isset( $_GET['reset'] ) && $_GET['reset'] == 'true' ) {
                printf( '<div class="updated"><p><strong>%1$s</strong></p></div>',
                    esc_html__( 'All settings were reset to default values!', 'buddyapp' )
                );
            }

            // Settings backup message
            if ( isset( $_GET['backup'] ) && $_GET['backup'] == 'ok' ) {
                printf( '<div class="updated"><p><strong>%1$s</strong></p></div>',
                    esc_html__( 'You made a successful backup of your theme settings!', 'buddyapp' )
                );
            }

            // Settings restore message
            if ( isset( $_GET['restore'] ) && $_GET['restore'] == 'ok' ) {
                printf( '<div class="updated"><p><strong>%1$s</strong></p></div>',
                    esc_html__( 'All your settings were restored to default values!', 'buddyapp' )
                );
            }

        }

    }


    /**
     * Add menu options page
     * @since 0.1.0
     */
    public function add_theme_options_page() {
        add_theme_page( $this->title, $this->menu, 'manage_options', $this->slug, array( $this, 'admin_page_display' ) );
        add_theme_page( $this->backup, $this->backup, 'manage_options', $this->backup_slug, array( $this, 'backup_tab_display' ) );
    }


    /**
     * Init Page.
     */
    public function page_init() {

        /* For debugging */
        /*if (!empty($_POST)) {
            var_dump($_POST);
        }*/

        $options = $this->options();

        // If the current user can manage options and the page is the options page
        // Save, Reset, Backup and Restore is possible
        if ( current_user_can( 'manage_options' ) && isset( $_GET['page'] ) && $_GET['page'] == $this->slug ) {

            // Save Options
            if (isset($_REQUEST['action']) && 'save' == $_REQUEST['action']) {

                foreach ($options as $option) {

                    if ($option['type'] == 'switch') {
                        if (isset($_POST[$option['id']])) {
                            set_theme_mod($option['id'], true);
                        } else {
                            set_theme_mod($option['id'], false);
                        }
                    } elseif ($option['type'] != 'heading' && $option['type'] != 'info' && $option['type'] != 'help') {

                        if (isset($_POST[$option['id']])) {

                            /*if ( ! is_array( $_POST[$option['id']] ) ) {
                                $the_value = stripslashes( $_POST[$option['id']] );
                            } else {
                                $the_value = serialize( $_POST[$option['id']] );
                            }*/

                            set_theme_mod($option['id'], $_POST[$option['id']]);

                        } else {
                            remove_theme_mod($option['id']);
                        }

                    }

                }

                do_action('sq_options_after_save');

                // Redirect to the theme options page
                wp_redirect(admin_url('admin.php?page=' . $this->slug . '&saved=true'));
                die;

            }

            // Reset Options
            if (isset($_REQUEST['action']) && 'reset' == $_REQUEST['action']) {

                foreach ($options as $option) {
                    if ($option['type'] != 'heading' && $option['type'] != 'info' && $option['type'] != 'help')
                        set_theme_mod($option['id'], $option['default']);
                }

                // Redirect to the theme options page
                wp_redirect(admin_url('admin.php?page=' . $this->slug . '&reset=true'));
                die;

            }

        }
        if ( current_user_can( 'manage_options' ) && isset( $_GET['page'] ) && $_GET['page'] == $this->backup_slug ) {

            // Backup Options
            if ( isset($_GET['backup']) && $_GET['backup'] == 'true' ) {

                $date           = date('l jS \of F Y h:i:s A');
                $panel_options  = array();

                /*foreach ( $options as $option ) {
                    if ( $option['type'] != 'heading' && $option['type'] != 'info' && $option['type'] != 'help' ) {

                        if ( ! is_array(get_theme_mod( $option['id'] )) ) {
                            $the_value = stripslashes( get_theme_mod( $option['id'] ) );
                        } else {
                            $the_value = maybe_serialize( get_theme_mod($option['id']) );
                        }
                        $panel_options[$option['id']] = $the_value;

                    }
                }*/
                $panel_options = get_theme_mods();

                update_option( $this->key . '_theme_backup', serialize( $panel_options ) );
                update_option( $this->key . '_theme_backup_date', $date );

                // Redirect to the theme options page
                wp_redirect( admin_url( 'admin.php?page='. $this->backup_slug .'&backup=ok' ) );
                die;

            }

            // Import Options
            if ( isset($_REQUEST['action']) && 'restore' == $_REQUEST['action'] ) {

                $saved_options = get_option( $this->key.'_theme_backup' );
                $import_options = stripslashes( $_POST['theme_update'] );

                if ( $saved_options != $import_options ) {
                    $panel_options = $import_options;
                } else {
                    $panel_options = $saved_options;
                }
                $restore_data = maybe_unserialize( $panel_options );

                foreach ( $restore_data as $key => $value ) {
                    set_theme_mod( $key, $value );
                }

                // Redirect to the theme options page
                wp_redirect( admin_url( 'admin.php?page='. $this->backup_slug .'&restore=ok' ) );
                die;

            }

        }

    }



    /**
     * Admin page markup.
     *
     */
    public function admin_page_display() {
        ?>

        <div class="wrap buddyapp-options-page about-wrap buddyapp <?php echo esc_attr($this->key); ?>">
            <?php sq_panel_header( 'options' ); ?>
            <br>

            <div class="wrap">
                <p>
                    <?php esc_html_e( "Here you can configure options that don't have a visual impact on your site.", "buddyapp" ); ?><br>
                    <?php printf( wp_kses_data( __( "To change styling and other options that directly impact your site <a href='%s'>go to the Customizer</a>", "buddyapp" ) ), admin_url( 'customize.php' ));?>
                </p>

                    <form method="post" id="sq-form" enctype="multipart/form-data">

                        <table class="form-table">
                            <tbody>

                            <input type="hidden" name="action" value="save" />
                            <?php echo $this->render_form(); ?>

                            <tr valign="top">
                                <th scope="row"></th>
                                <td><input type="submit" class="button-primary" value="<?php esc_html_e( 'Save All Changes', 'buddyapp' ); ?>" /></td>
                            </tr>

                            </tbody>
                        </table>
                    </form>

                    <!-- Form to reset options to default values -->
                    <form method="post">
                        <table class="form-table">
                            <input type="hidden" name="action" value="reset" />

                            <tr valign="top">
                                <th scope="row"></th>
                                <td>
                                    <input type="submit" class="button-secondary"
                                           onclick="return confirm('<?php esc_html_e("This will reset all settings to default values! Consider updating your custom settings before reset. Are you sure you want to reset now?", "buddyapp"); ?>')"
                                           value="<?php esc_html_e('Reset All Options', 'buddyapp'); ?>"/>
                                </td>
                            </tr>

                        </table>
                    </form>
            </div><!-- .wrap -->
        </div>
        <?php
    }

    public function backup_tab_display() {
        ?>
        <div class="wrap buddyapp-options-page about-wrap buddyapp <?php echo $this->key; ?>">
            <?php sq_panel_header( 'backup' ); ?>
            <br>

            <div class="wrap">
                <form method="post" id="restore-form" enctype="multipart/form-data">

                    <input type="hidden" name="action" value="restore" />

                    <?php

                    $last_backup = ( get_option( $this->key . '_theme_backup_date') == '' ) ? esc_html__('never', 'buddyapp' ) : get_option( $this->key . '_theme_backup_date' );

                    printf( '<h3>%1$s</h3><p>%2$s<br>%3$s</p><p>%4$s: %5$s</p><p><a class="button-primary" href="%6$s">%7$s</a></p>',
                        esc_html__( 'Backup & Restore', 'buddyapp' ),
                        esc_html__( 'You can backup your current options and restore it back at a later time.', 'buddyapp' ),
                        esc_html__( 'It is recommended to backup your options from time to time if you change some options but would like to keep the old settings as well in case you need it back.', 'buddyapp' ),
                        esc_html__( 'Your last backup', 'buddyapp' ),
                        $last_backup,
                        admin_url( 'admin.php?page=' . $this->backup_slug . '&backup=true' ),
                        esc_html__( 'Backup Settings', 'buddyapp' ),
                        esc_html__( 'You can use the below section to make local copies of your backup file (simply copy the information in a text file) or to transfer your settings to another site.', 'buddyapp' ),
                        esc_html__( 'To import a settings file from another site just paste your backup information below and hit the "Restore Settings" button.', 'buddyapp' ),
                        esc_html__( 'If no backup file will be pasted, the last local backup will be restored.', 'buddyapp' )
                    );

                    printf( '<p>%1$s<br>%2$s</p><p>%3$s</p><p><textarea name="theme_update" class="large-text code" id="theme_update" rows="8" onClick="select(theme_update);">%4$s</textarea></p>',
                        esc_html__( 'You can use the below section to make local copies of your backup file (simply copy the information in a text file) or to transfer your settings to another site.', 'buddyapp' ),
                        esc_html__( 'To import a settings file from another site just paste your backup information below and hit the "Restore Settings" button.', 'buddyapp' ),
                        esc_html__( 'If no backup file will be pasted, the last local backup will be restored.', 'buddyapp' ),
                        get_option( $this->key.'_theme_backup' ),
                        esc_html__( 'Restore Settings', 'buddyapp' )
                    );

                    ?>

                    <br class="clear">
                    <p><input type="submit" class="button-secondary restore-but" id="restore-but" value="<?php esc_html_e( 'Restore Settings', 'buddyapp' ); ?>" /></p>

                </form>
            </div>
        </div>

        <?php
    }

    /**
     * Get theme options to display
     * @param boolean $all
     * @return array
     */
    public function options( ) {

        $theme_options = array();
        $all_options = apply_filters( 'kleo_theme_settings', array() );

        foreach ( $all_options['set'] as $option ) {
            if ( ! isset( $option['customizer'] ) || $option['customizer'] == false ) {
                $theme_options[] = $option;
            }
        }

        return $theme_options;

    }

    public function render_form() {

        $options = $this->options();
        $all_options = apply_filters( 'kleo_theme_settings', array() );
        $options_sections = $all_options['sec'];
        $tabs = '';

        if ( empty( $options ) ) {
            return '';
        }

        $current_section = '';

        foreach ( $options as $option ) {

            // Define the input field values
            if ( $option['type'] != 'heading' && $option['type'] != 'info' && $option['type'] != 'help' ) {

                // Option default value
                $default_value = ( isset( $option['default'] ) ) ? $option['default'] : '';

                // User defined value
                $user_defined_value = '';
                if ( isset( $option['id'] ) ) {

                    $user_defined_value = get_theme_mod( $option['id'] );

                    if ( ! is_array( $user_defined_value ) ) {
                        $user_defined_value = stripslashes( $user_defined_value );
                    }
                }

                // Define the real value based on default or user defined value
                $real_value = ( $user_defined_value === false ) ? $default_value : $user_defined_value;

            }

            if ( $current_section == '' || $current_section != $option['section'] ) {
                $current_section = $option['section'];

                $tabs .= '<tr valign="top">'."\n";
                $tabs .= '<th style="font-size: 18px;" colspan="2" scope="row">'. esc_html($options_sections[$option['section']]['title']) .'</th>'."\n";
                $tabs .= '</tr>'."\n";
            }


            if ( isset( $option['condition'] ) ) {
                $condition = ' class="condition-me" data-cond-option="'  . $option['condition'][0] . '"' . ' data-cond-value="' . $option['condition'][1] . '"' ;
            } else {
                $condition = '';
            }

            $tabs .= '<tr valign="top"' . $condition . '>'."\n";


            // Switch between option types and populate the form fields according to the option type
            switch ( $option['type'] ) {

                // Text Field
                case 'text':

                    $tabs .= '<th scope="row">'. $option['title'] .'</th>'."\n";
                    $tabs .= '<td>'."\n";
                    $tabs .= '<input type="text" name="'. esc_attr($option['id']) .'" id="'. esc_attr($option['id']) .'" class="regular-text" value="'. esc_attr($real_value) .'" />'."\n";
                    if( isset($option['description']) )
                        $tabs .= '<p class="description">' . wp_kses_post($option['description']) . '</p>'."\n";
                    $tabs .= '</td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;


                // Text area field output
                case 'textarea':

                    $tabs .= '<th scope="row">'. esc_html($option['title']) .'</th>'."\n";
                    $tabs .= '<td>'."\n";
                    $tabs .= '<textarea class="textarea" class="large-text code" cols="50" rows="10" name="'.$option['id'].'" id="'.$option['id'].'">' .
                         wp_kses( $real_value, array( 'script' => array( 'type' => array(), 'src' => array() ) ) ) . '</textarea>'."\n";
                    if( isset($option['description']) )
                        $tabs .= '<p class="description">' . wp_kses_post($option['description']) . '</p>'."\n";
                    $tabs .= '</td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;


                // Select field output
                case 'select':
                case 'multi-select':

                    $multi = '';
                    $name = $option['id'];
                    if ($option['type'] == 'multi-select' ) {
                        $multi = 'multiple';
                        $name = $option['id'] . '[]';
                    }

                    $tabs .= '<th scope="row">'. esc_html($option['title']) .'</th>'."\n";
                    $tabs .= '<td>'."\n";

                    $tabs .= '<select class="select" name="' . $name . '" id="'.$option['id'].'" style="padding-right: 10px;" ' . $multi . '>'."\n";


                    // Which options should be selected
                    if (isset($option['choices']) && is_array($option['choices'])) {
                        foreach ($option['choices'] as $key => $value) {

                            if ($option['type'] == 'multi-select') {
                                $active_attr = (is_array( $real_value ) && in_array( $key, $real_value )) ? selected(1, 1, false) : '';
                            } else {
                                $active_attr = ($key == $real_value) ? 'selected' : '';
                            }

                            // Options
                            $tabs .= '<option value="' . $key . '" ' . $active_attr . '>' . esc_html($value) . '</option>' . "\n";

                        }
                    }

                    $tabs .= '</select>'."\n";

                    if( isset($option['description']) )
                        $tabs .= '<p class="description">' . wp_kses_post( $option['description'] ).'</p>'."\n";
                    $tabs .= '</td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;


                // Checkbox field output
                case 'checkbox':

                    $tabs .= '<th scope="row">'. esc_html($option['title']) .'</th>'."\n";
                    $tabs .= '<td>'."\n";

                    // Checked value
                    $checked = ( $user_defined_value == 'checked' ) ? 'checked="checked"' : '' ;

                    // The checkbox field
                    $tabs .= '<p class="checkbox"><input type="checkbox" name="'.$option['id'].'" id="'.$option['id'].'" value="checked" '.$checked.'>&nbsp;&nbsp;<label for="'.$option['id'].'">' . wp_kses_post($option['description']) . '</label></p>'."\n";

                    if( isset($option['description']) )
                        $tabs .= '<p class="description">' . wp_kses_post($option['description']).'</p>'."\n";
                    $tabs .= '</td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;


                // Radio field output
                case 'radio':

                    $tabs .= '<th scope="row">'. esc_html($option['title']) .'</th>'."\n";
                    $tabs .= '<td>'."\n";

                    // Which options should be selected
                    foreach ( $option['choices'] as $key => $value ) {

                        $active_attr = ( $key == $real_value ) ? 'checked' : '';

                        // The radio field
                        $tabs .= '<p class="radio"><input type="radio" name="'.$option['id'].'" value="'.$key.'" id="'.$key.'" '.$active_attr.'>&nbsp;&nbsp;<label for="'.$key.'">' . esc_html($value) . '</label></p>'."\n";

                    }

                    if( isset($option['description']) ) {
                        $tabs .= '<p class="description">' . wp_kses_post($option['description']) . '</p>' . "\n";
                    }
                    $tabs .= '</td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;

                // Radio field output
                case 'switch':

                    $tabs .= '<th scope="row">'. esc_html($option['title']) .'</th>'."\n";
                    $tabs .= '<td>'."\n";

                    // Checked value
                    $checked = ( $user_defined_value == true ) ? 'checked="checked"' : '' ;

                    $tabs .= '<div class="switch-info">';
                    $tabs .= '<input style="display:none;" type="checkbox" name="'.$option['id'].'" id="'.$option['id'].'" value="" '.$checked.'>'."\n";
                    $tabs .= '</div>';

                     $classes = $user_defined_value == true ? ' On' : ' Off';

                    $tabs .= '<div class="Switch ' . $classes . '">';
                    $tabs .= '<div class="Toggle"></div>';
                    $tabs .= '<span class="On">' . esc_html__( "ON", "buddyapp" ) . '</span>';
                    $tabs .= '<span class="Off">' . esc_html__( "OFF", "buddyapp" ) . '</span>';
                    $tabs .= '</div>';


                    if( isset($option['description']) ) {
                        $tabs .= '<p class="description clear clearfix">' . wp_kses_post( $option['description'] ) . '</p>'."\n";
                    }
                    $tabs .= '</td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;


                // WP categories select field output
                case 'categories':

                    $tabs .= '<th scope="row">'. esc_html($option['title']) .'</th>'."\n";
                    $tabs .= '<td>'."\n";

                    // The select field
                    $tabs .= '<select class="select" name="' . $option['id'] . '" id="'.$option['id'].'" style="padding-right: 10px;">'."\n";

                    // Access WP categories via an Array
                    $sq_categories = array();
                    $sq_categories = get_categories('hide_empty=0');

                    $no_cat = ( $real_value == '' ) ? 'selected' : '';
                    $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;" value="" ' . $no_cat . '>'. esc_html__( 'Select Category', 'buddyapp' ) .'</option>'."\n";

                    // Which category should be selected
                    foreach ( $sq_categories as $cat ) {

                        $active_attr = ( $cat->cat_ID == $real_value ) ? 'selected' : '';

                        // Options
                        $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;" value="'.$cat->cat_ID.'" '.$active_attr.'>'. esc_html( $cat->cat_name ) .'</option>'."\n";

                    }

                    $tabs .= '</select>'."\n";

                    if( isset($option['description']) ) {
                        $tabs .= '<p class="description">' . wp_kses_post($option['description']) . '</p>' . "\n";
                    }
                    $tabs .= '</td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;


                // WP page select field output
                case 'pages':

                    $tabs .= '<th scope="row">'. esc_html( $option['title'] ) .'</th>'."\n";
                    $tabs .= '<td>'."\n";

                    $tabs .= '<select class="select" name="'.$option['id'].'" id="'.$option['id'].'" style="padding-right: 10px;">'."\n";

                    $no_page = ( $real_value == '' ) ? 'selected' : '';
                    $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;" value="" '.$no_page.'>'. esc_html__( 'Select Page', 'buddyapp' ) .'</option>'."\n";

                    // Access WP pages via an Array
                    $sq_pages = array();
                    $sq_pages = get_pages('sort_column=post_parent,menu_order');

                    // Which page should be selected
                    foreach ( $sq_pages as $page ) {

                        $active_attr = ( $page->ID == $real_value ) ? 'selected' : '';

                        // Options
                        $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;" value="'.$page->ID.'" '.$active_attr.'>' . esc_html( $page->post_title ) . '</option>'."\n";

                    }

                    $tabs .= '</select>'."\n";

                    if( isset($option['description']) ) {
                        $tabs .= '<p class="description">' . wp_kses_post( $option['description'] ) . '</p>' . "\n";
                    }
                    $tabs .= '</td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;


                // WP post select field output
                case 'posts':

                    $tabs .= '<th scope="row">'. esc_html($option['title']) .'</th>'."\n";
                    $tabs .= '<td>'."\n";

                    $tabs .= '<select class="select" name="'.$option['id'].'" id="'.$option['id'].'" style="padding-right: 10px;">'."\n";

                    //Access WP posts via an Array
                    $sq_posts = array();
                    $sq_posts = get_posts( 'numberposts=100' );

                    $no_post = ( $real_value == '' ) ? 'selected' : '';
                    $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;" value="" '.$no_post.'>'. esc_html__( 'Select Post', 'buddyapp' ) .'</option>'."\n";


                    // Which post should be selected
                    foreach ( $sq_posts as $post ) {

                        $active_attr = ( $post->ID == $real_value ) ? 'selected' : '';

                        // Options
                        $tabs .= '<option style="margin: 2px 5px 2px 0;font-size: 12px;max-width: 330px;" value="'.$post->ID.'" '.$active_attr.'>' . esc_html( $post->post_title ) . '</option>'."\n";

                    }

                    $tabs .= '</select>'."\n";

                    if( isset($option['description']) ) {
                        $tabs .= '<p class="description">' . wp_kses_post($option['description']) . '</p>' . "\n";
                    }
                    $tabs .= '</td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;


                // Image upload output
                case 'upload':

                    $tabs .= '<th scope="row">'. esc_html($option['title']) .'</th>'."\n";
                    $tabs .= '<td>'."\n";

                    $tabs .= '<div class="upload-field">';

                    // The image upload field
                    $tabs .= '<input type="text" class="regular-text" name="'. $option['id'] .'" id="'.$option['id'].'" value="' . esc_attr( $real_value ) . '" />';
                    // The upload image button
                    $tabs .= '<input type="button" id="'. $option['id'] .'-button" class="sq-upload-button button" value="'. esc_html__( 'Upload', 'buddyapp' ) .'" />'."\n";

                    // The remove image button
                    if ( $real_value ) {

                        $tabs .= '<input type="button" id="'. $option['id'] .'-remove" class="sq-remove-button button" value="'. esc_html__( 'Remove', 'buddyapp' ) .'" />'."\n";
                        $tabs .= '<div id="'. $option['id'] .'-preview">';
                        $tabs .= '<img src="'.$real_value.'" style="max-width:300px;height:auto;margin-top:10px;border:3px solid #fff;" alt="" />'."\n";
                        $tabs .= '</div>';

                    }

                    $tabs .= '</div>';

                    if( isset($option['description']) ) {
                        $tabs .= '<p class="description">' . wp_kses_post($option['description']) . '</p>' . "\n";
                    }
                    $tabs .= '</td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;




                // Color picker output
                case 'color':

                    wp_enqueue_script( 'wp-color-picker', false, array(), false, true );
                    wp_enqueue_style( 'wp-color-picker' );

                    $tabs .= '<th scope="row">'. esc_html($option['title']) .'</th>'."\n";
                    $tabs .= '<td>'."\n";

                    $tabs .= '<input type="text" class="textfield sq-color" name="'.$option['id'].'" id="'.$option['id'].'" value="'. esc_attr( $real_value ).'" />'."\n";

                    if( isset($option['description']) ) {
                        $tabs .= '<p class="description">' . wp_kses_post($option['description']) . '</p>' . "\n";
                    }
                    $tabs .= '</td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;


                // Info section
                case 'heading':

                    $tabs .= '<td colspan="2" scope="row"><h3>' . (isset($option['title']) ? esc_html($option['title']) : '') . '</h3></td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;


                // Info section
                case 'info':

                    $tabs .= '<th scope="row"></th>'."\n";
                    $tabs .= '<td>'."\n";
                    // If style is set add color class
                    $color_class = ( isset($option['style']) ) ? $option['style'] : '' ;

                    $tabs .= '<div class="info '.$color_class.'">'."\n";

                    // Title
                    if ( isset($option['title']) && $option['title'] != '' ) {
                        $tabs .= '<h3>' . esc_html($option['title']) . '</h3>' . "\n";
                    }

                    // Description
                    if ( isset($option['description']) && $option['description'] != '' ) {
                        $tabs .= '<p>' . wp_kses_post($option['description']) . '</p>' . "\n";
                    }

                    $tabs .= '</div>'."\n";
                    $tabs .= '<td>'."\n";
                    $tabs .= '</tr>'."\n";

                    break;



            } // End switch

        }

        return $tabs;
        
    }

}

/**
 * Helper function to get/return the Buddyapp_Admin_options object
 * @since  0.1.0
 * @return Buddyapp_Admin_options object
 */
function buddyapp_theme_options_admin() {
    static $object = null;
    if ( is_null( $object ) ) {
        $object = new Buddyapp_Admin_options();
        $object->hooks();
    }
    return $object;
}

// Get it started
buddyapp_theme_options_admin();
