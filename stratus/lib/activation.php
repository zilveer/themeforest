<?php
/**
 * Theme activation
 *
 * @author     @retlehs
 * @link 	   http://roots.io
 * @editor     Themovation <themovation@gmail.com>
 * @version    1.0
 */





if (is_admin() && isset($_GET['activated']) && 'themes.php' == $GLOBALS['pagenow']) {
    wp_redirect(admin_url('themes.php?page=theme_activation_options'));
    exit;
}

function roots_theme_activation_options_init() {
    register_setting(
        'roots_activation_options',
        'roots_theme_activation_options'
    );
}
add_action('admin_init', 'roots_theme_activation_options_init');

function roots_activation_options_page_capability($capability) {
    return 'edit_theme_options';
}
add_filter('option_page_capability_roots_activation_options', 'roots_activation_options_page_capability');

function roots_theme_activation_options_add_page() {
    $roots_activation_options = roots_get_theme_activation_options();

    if (!$roots_activation_options) {
        $theme_page = add_theme_page(
            esc_html__('Theme Activation', 'stratus'),
            esc_html__('Theme Activation', 'stratus'),
            'edit_theme_options',
            'theme_activation_options',
            'roots_theme_activation_options_render_page'
        );
        add_action('admin_notices', 'themo_activation_admin_notice');
    } else {
        if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'theme_activation_options') {
            flush_rewrite_rules();
            wp_redirect(admin_url('themes.php'));
            exit;
        }
    }
}
add_action('admin_menu', 'roots_theme_activation_options_add_page', 50);

function roots_get_theme_activation_options() {
    return get_option('roots_theme_activation_options');
}


function roots_theme_activation_options_render_page() { ?>
    <div class="wrap">
        <h2><?php printf(esc_html__('%s Theme Activation', 'stratus'), wp_get_theme()); ?></h2>
        <div class="updated notice">
        <?php printf(wp_kses_post(__('<p>Questions?  We\'ve got <a href="%1$s" target="_blank">helpful guides</a>, <a href="%2$s" target="_blank">online documentation</a> and <a href="%3$s" target="_blank">rockstar support</a>.</p>', 'stratus')),'https://themovation.ticksy.com/articles/100000916','http://docs.themovation.com/stratus','https://themovation.ticksy.com/'); ?>
         </div>
        <!--div class="update-nag">
      <?php esc_html_e('These settings are optional and should usually be used only on a fresh installation', 'stratus'); ?>
    </div-->
        <?php //settings_errors(); ?>
        <div class="theme-activation-options theme-activation-step-one">
            <h2><?php esc_html_e('1 - Plugins', 'stratus'); ?></h2>
            <?php
            // Set tgmpa status to false until we check
            $step_1_tgmpa_not_complete = false;

            //global $submenu;

            $link_to_tgm = false;
            function find_my_menu_item( $handle, $sub = false ){

                if( !is_admin() || (defined('DOING_AJAX') && DOING_AJAX) )
                    return false;
                global $menu, $submenu;
                $check_menu = $sub ? $submenu : $menu;

                if( empty( $check_menu ) )
                    return false;

                foreach( $check_menu as $k => $item ){
                    if( $sub ){
                        foreach( $item as $sm ){

                            if($handle == $sm[2]){
                                return true;
                            }

                        }
                    } else {
                        if( $handle == $item[2] )
                            return true;
                    }
                }
                return false;
            }

            $step_1_tgmpa_not_complete = find_my_menu_item('tgmpa-install-plugins',true);


            ?>
            <?php
            // If there are pluings to install, alert and provide link, else keep going.
            if(!$step_1_tgmpa_not_complete){ ?>
                <p class="dashicons-before dashicons-yes"><?php esc_html_e('Completed', 'stratus'); ?></p>
            <?php } else { ?>
                <p class="dashicons-before dashicons-plus"><?php printf(wp_kses_post(__('<strong>%1$sInstall and Activate%2$s</strong>, required plugins before continuing.', 'stratus')), '<a href="'.esc_url(get_admin_url()).'themes.php?page=tgmpa-install-plugins'.'">','</a>'); ?></p>
            <?php }
            ?>
        </div>
        <div class="theme-activation-options theme-activation-step-two">
            <h2><?php esc_html_e('2 - Demo Content', 'stratus'); ?></h2>

            <?php
            $themo_demo_content_import_completed = get_option( 'themo_demo_content_import_completed' );
            if (isset($themo_demo_content_import_completed) && $themo_demo_content_import_completed == 1){ ?>
                <p class="dashicons-before dashicons-yes"><?php esc_html_e('Demo content import completed', 'stratus'); ?></p>
            <?php }else{ ?>
                <p class="dashicons-before dashicons-plus"><?php printf(wp_kses_post(__('<strong>%1$sImport Demo Content%2$s</strong>  - "%3$s", included in theme zip.', 'stratus')), '<a href="'.esc_url(get_admin_url()).'admin.php?import=wordpress'.'">','</a>',wp_get_theme().'-demo-content.xml'); ?></p>
                <p style="padding:10px; background-color:#e7e7e7; max-width:600px" class="dashicons-before dashicons-clock"><?php printf(wp_kses_post(__('Importing  takes time. %sLearn more.%s', 'stratus')), '<a href="http://docs.themovation.com/stratus/#democontent'.'" target="_blank">','</a></em>'); ?></p>
            <?php }
            ?>


            <?php
            $themo_demo_widget_import_completed = get_option( 'themo_demo_widget_import_completed' );
            if (isset($themo_demo_widget_import_completed) && $themo_demo_widget_import_completed == 1){ ?>
                <p class="dashicons-before dashicons-yes"><?php esc_html_e('Demo widget import completed', 'stratus'); ?></p>
            <?php }else{ ?>
                <p class="dashicons-before dashicons-plus"><?php printf(wp_kses_post(__('<strong>%1$sImport Widget Content%2$s </strong> - "%3$s", includced in theme zip.', 'stratus')), '<a href="'.esc_url(get_admin_url()).'tools.php?page=widget-importer-exporter'.'">','</a>',wp_get_theme().'-demo-widget-content.wie'); ?></p>
            <?php } ?>

            <?php
            $themo_demo_form_import_completed = get_option( 'themo_demo_form_import_completed' );
            if (isset($themo_demo_form_import_completed) && $themo_demo_form_import_completed == 1){ ?>
                <p class="dashicons-before dashicons-yes"><?php esc_html_e('Demo form import completed', 'stratus'); ?></p>
            <?php }else{ ?>
                <p class="dashicons-before dashicons-plus"><?php printf(wp_kses_post(__('<strong>%1$sImport Forms%2$s</strong> - "%3$s", includced in theme zip.', 'stratus')), '<a href="'.esc_url(get_admin_url()).'admin.php?page=formidable-import'.'">','</a>',wp_get_theme().'-formidable-custom-forms.xml'); ?></p>
            <?php } ?>


            <?php
            // Check if woocommerce has been imported.
            $woo_product = get_page_by_title( "Woo Ninja", NULL, "product" );
            if(isset($woo_product->ID) && $woo_product->ID > 0){
                update_option( '$themo_demo_content_import_woo_completed', 1 );
            }

            $themo_demo_content_import_woo_completed = get_option( '$themo_demo_content_import_woo_completed' );
            if (isset($themo_demo_content_import_woo_completed) && $themo_demo_content_import_woo_completed == 1){ ?>
                <p class="dashicons-before dashicons-yes"><?php esc_html_e('Demo WooCommerce content import completed', 'stratus'); ?></p>
            <?php }else{ ?>
                <p class="dashicons-before dashicons-products"><?php printf(wp_kses_post(__('<strong>%1$sImport Demo WooCommerce Content%2$s</strong>  - "%3$s", included in theme zip.', 'stratus')), '<a href="'.esc_url(get_admin_url()).'admin.php?import=wordpress'.'">','</a>','woo-dummy-data.xml'); ?></p>
                <p style="padding:10px; background-color:#e7e7e7; max-width:600px" class="dashicons-before dashicons-clock"><?php printf(wp_kses_post(__('Importing  takes time. %sLearn more.%s', 'stratus')), '<a href="http://docs.themovation.com/stratus/#democontent'.'" target="_blank">','</a></em>'); ?></p>
            <?php }
            ?>


        </div>


        <div class="theme-activation-options theme-activation-step-three">
            <h2><?php esc_html_e('3 - Settings', 'stratus'); ?></h2>

            <?php
            $themo_theme_activation_completed = get_option( 'themo_theme_activation_completed' );
            if (isset($themo_theme_activation_completed) && $themo_theme_activation_completed == 1){ ?>
                <p class="dashicons-before dashicons-yes"><?php esc_html_e('Settings Step Completed', 'stratus'); ?></p>


            <?php }else{ ?>

                <form method="post" action="options.php">
                    <?php settings_fields('roots_activation_options'); ?>
                    <table class="form-table">

                        <?php
                        $page_names = array('Home Product 2'); // list of all possible page names.
                        foreach ($page_names as $page_name) {
                            $page_home = get_page_by_title( $page_name );
                            if(!is_null($page_home)){ // Found something? bust out.
                                break;
                            }
                        }

                        if(isset($page_home->post_title) && $page_home->post_title > ""){ ?>
                            <tr valign="top"><th scope="row"><?php esc_html_e('Set static Front page?', 'stratus'); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php esc_html_e('Set a static Front page?', 'stratus'); ?></span></legend>
                                        <?php
                                        $args = array(
                                            'sort_order' => 'ASC',
                                            'sort_column' => 'post_title',
                                            'hierarchical' => 0,
                                            'parent' => 0,
                                            'post_type' => 'page',
                                            'post_status' => 'publish'
                                        );

                                        $pages = get_pages($args);

                                        $option_html = '<option %3$s value="%1$s">%2$s</option>';
                                        $option_output = '<option value="false">'. esc_html__('No', 'stratus') . '</option>';
                                        $option_output .= '<option value="false">---</option>';
                                        foreach ($pages as $page) {

                                            if ($page->post_title > ""){
                                                $selected = false;
                                                if (strcasecmp($page_home->post_title, $page->post_title) == 0) {
                                                    $selected = 'selected="selected"';
                                                }
                                                $option_output .= sprintf($option_html, $page->ID, $page->post_title, $selected);
                                            }
                                        }

                                        $allowed_html = array(
                                            'option' => array(
                                                'value' => array(),
                                                'selected' => array(),
                                            ),
                                        );
                                        ?>

                                        <select name="roots_theme_activation_options[set_front_page]" id="create_front_page">
                                            <?php echo wp_kses($option_output,$allowed_html); ?>
                                        </select>
                                        <p class="description"><?php printf(esc_html__('Set a page it to be the static Front page.', 'stratus')); ?></p>
                                    </fieldset>
                                </td>
                            </tr>
                        <?php }else{ ?>

                            <tr valign="top"><th scope="row"><?php esc_html_e('Create Front page?', 'stratus'); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php esc_html_e('Create Front page?', 'stratus'); ?></span></legend>
                                        <select name="roots_theme_activation_options[create_front_page]" id="create_front_page">
                                            <option selected="selected" value="true"><?php echo esc_html_e('Yes', 'stratus'); ?></option>
                                            <option value="false"><?php echo esc_html_e('No', 'stratus'); ?></option>
                                        </select>
                                        <p class="description"><?php printf(esc_html__('Create a page called Home and set it to be the Front page.', 'stratus')); ?></p>
                                    </fieldset>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if(get_page_by_title('blog')){ ?>
                            <!--tr valign="top"><th scope="row"><?php esc_html_e('Set Post page?', 'stratus'); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php esc_html_e('Set a Post page to be your default blog.', 'stratus'); ?></span></legend>
                                        <?php
                                        $args = array(
                                            'sort_order' => 'ASC',
                                            'sort_column' => 'post_title',
                                            'hierarchical' => 0,
                                            'parent' => 0,
                                            'post_type' => 'page',
                                            'post_status' => 'publish'
                                        );

                                        $pages = get_pages($args);

                                        $option_html = '<option %3$s value="%1$s">%2$s</option>';
                                        $option_output = '<option value="false">'. esc_html__('No', 'stratus') . '</option>';
                                        $option_output .= '<option value="false">---</option>';
                                        foreach ($pages as $page) {
                                            if ($page->post_title > ""){
                                                if (strcasecmp('blog', $page->post_title) == 0) {
                                                    $selected = 'selected="selected"';
                                                }else{
                                                    $selected = '';
                                                }
                                                $option_output .= sprintf($option_html, $page->ID, $page->post_title, $selected);
                                            }
                                        }?>

                                        <select name="roots_theme_activation_options[set_post_page]" id="set_post_page">
                                            <?php echo wp_kses($option_output,$allowed_html); ?>
                                        </select>
                                        <p class="description"><?php printf(esc_html__('Set a page it to be the Post page (default blog)', 'stratus')); ?></p>
                                    </fieldset>
                                </td>
                            </tr-->
                        <?php }else{ ?>

                            <!--tr valign="top"><th scope="row"><?php esc_html_e('Create Post page?', 'stratus'); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php esc_html_e('Create Post page?', 'stratus'); ?></span></legend>
                                        <select name="roots_theme_activation_options[create_post_page]" id="create_post_page">
                                            <option selected="selected" value="true"><?php echo esc_html_e('Yes', 'stratus'); ?></option>
                                            <option value="false"><?php echo esc_html_e('No', 'stratus'); ?></option>
                                        </select>
                                        <p class="description"><?php printf(esc_html__('Create a page called Blog and set it to be the Post page', 'stratus')); ?></p>
                                    </fieldset>
                                </td>
                            </tr-->
                        <?php } ?>
                        <tr valign="top"><th scope="row"><?php esc_html_e('Switch to Search Engine Friendly URLs?', 'stratus'); ?></th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text"><span><?php esc_html_e('Update permalink structure?', 'stratus'); ?></span></legend>
                                    <select name="roots_theme_activation_options[change_permalink_structure]" id="change_permalink_structure">
                                        <option selected="selected" value="true"><?php echo esc_html_e('Yes', 'stratus'); ?></option>
                                        <option value="false"><?php echo esc_html_e('No', 'stratus'); ?></option>
                                    </select>
                                    <p class="description"><?php printf(wp_kses_post(__('Change permalink structure to /&#37;postname&#37;/', 'stratus'))); ?></p>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top"><th scope="row"><?php esc_html_e('Create navigation menu?', 'stratus'); ?></th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text"><span><?php esc_html_e('Create navigation menu?', 'stratus'); ?></span></legend>
                                    <select name="roots_theme_activation_options[create_navigation_menus]" id="create_navigation_menus">
                                        <option selected="selected" value="true"><?php echo esc_html_e('Yes', 'stratus'); ?></option>
                                        <option value="false"><?php echo esc_html_e('No', 'stratus'); ?></option>
                                    </select>
                                    <p class="description"><?php printf(esc_html__('Setup Primary Navigation', 'stratus')); ?></p>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top"><th scope="row"><?php esc_html_e('Add pages to menu?', 'stratus'); ?></th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text"><span><?php esc_html_e('Add pages to menu?', 'stratus'); ?></span></legend>
                                    <select name="roots_theme_activation_options[add_pages_to_primary_navigation]" id="add_pages_to_primary_navigation">
                                        <option selected="selected" value="true"><?php echo esc_html_e('Yes', 'stratus'); ?></option>
                                        <option value="false"><?php echo esc_html_e('No', 'stratus'); ?></option>
                                    </select>
                                    <p class="description"><?php printf(esc_html__('Add all current published pages to the Primary Navigation', 'stratus')); ?></p>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            <?php } ?>
        </div>
    </div>

<?php }

function roots_theme_activation_action() {
    if (!($roots_theme_activation_options = roots_get_theme_activation_options())) {
        return;
    }

    if (strpos(wp_get_referer(), 'page=theme_activation_options') === false) {
        return;
    }

//-----------------------------------------------------
// create_front_page
// Create a page called Home and set it to be the static front page
//-----------------------------------------------------

    if (isset($roots_theme_activation_options['create_front_page']) && $roots_theme_activation_options['create_front_page'] === 'true') {
        $roots_theme_activation_options['create_front_page'] = false;

        $default_pages = array(esc_html__('Home 1', 'stratus'));
        $existing_pages = get_pages();
        $temp = array();

        foreach ($existing_pages as $page) {
            $temp[] = $page->post_title;
        }

        $pages_to_create = array_diff($default_pages, $temp);

        foreach ($pages_to_create as $new_page_title) {
            $add_default_pages = array(
                'post_title' => $new_page_title,
                'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consequat, orci ac laoreet cursus, dolor sem luctus lorem, eget consequat magna felis a magna. Aliquam scelerisque condimentum ante, eget facilisis tortor lobortis in. In interdum venenatis justo eget consequat. Morbi commodo rhoncus mi nec pharetra. Aliquam erat volutpat. Mauris non lorem eu dolor hendrerit dapibus. Mauris mollis nisl quis sapien posuere consectetur. Nullam in sapien at nisi ornare bibendum at ut lectus. Pellentesque ut magna mauris. Nam viverra suscipit ligula, sed accumsan enim placerat nec. Cras vitae metus vel dolor ultrices sagittis. Duis venenatis augue sed risus laoreet congue ac ac leo. Donec fermentum accumsan libero sit amet iaculis. Duis tristique dictum enim, ac fringilla risus bibendum in. Nunc ornare, quam sit amet ultricies gravida, tortor mi malesuada urna, quis commodo dui nibh in lacus. Nunc vel tortor mi. Pellentesque vel urna a arcu adipiscing imperdiet vitae sit amet neque. Integer eu lectus et nunc dictum sagittis. Curabitur commodo vulputate fringilla. Sed eleifend, arcu convallis adipiscing congue, dui turpis commodo magna, et vehicula sapien turpis sit amet nisi.',
                'post_status' => 'publish',
                'post_type' => 'page'
            );

            $result = wp_insert_post($add_default_pages);
        }

        $home = get_page_by_title('Home');
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home->ID);

        $home_menu_order = array(
            'ID' => $home->ID,
            'menu_order' => -1
        );
        wp_update_post($home_menu_order);
    }

//-----------------------------------------------------
// set_front_page
// Set specificed page it to be the static front page
//-----------------------------------------------------

    if (isset($roots_theme_activation_options['set_front_page']) && $roots_theme_activation_options['set_front_page'] !== 'false') {

        // get settting
        $set_frontpate_page_id = $roots_theme_activation_options['set_front_page'];
        $roots_theme_activation_options['set_front_page'] = false;

        // Update settings / reading = 'A static page'
        update_option('show_on_front', 'page');

        // Set to page specified
        update_option('page_on_front', $set_frontpate_page_id);

        // Update menu order. Set this page to top spot.
        $home_menu_order = array(
            'ID' => $set_frontpate_page_id,
            'menu_order' => -1
        );
        wp_update_post($home_menu_order);
    }

//-----------------------------------------------------
// create_post_page
// Create a page called Blog and set it to be the static Post page
//-----------------------------------------------------

    if (isset($roots_theme_activation_options['create_post_page']) && $roots_theme_activation_options['create_post_page'] === 'true') {
        $roots_theme_activation_options['create_post_page'] = false;

        $default_pages = array(esc_html__('Blog', 'stratus'));
        $existing_pages = get_pages();
        $temp = array();

        foreach ($existing_pages as $page) {
            $temp[] = $page->post_title;
        }

        $pages_to_create = array_diff($default_pages, $temp);

        foreach ($pages_to_create as $new_page_title) {
            $add_default_pages = array(
                'post_title' => $new_page_title,
                'post_content' => '',
                'post_status' => 'publish',
                'post_type' => 'page'
            );

            $result = wp_insert_post($add_default_pages);
        }

        // Name of Page
        $blog = get_page_by_title(esc_html__('Blog', 'stratus'));

        // Update settings / reading = 'A static page'
        update_option('show_on_front', 'page');

        // Set to page specified
        update_option('page_for_posts', $blog->ID);

    }

//-----------------------------------------------------
// set_post_page
// Set specificed page it to be the static Post page
//-----------------------------------------------------

    if (isset($roots_theme_activation_options['set_post_page']) && $roots_theme_activation_options['set_post_page'] !== 'false') {

        // get settting
        $set_post_page_id = $roots_theme_activation_options['set_post_page'];
        $roots_theme_activation_options['set_post_page'] = false;

        // Update settings / reading = 'A static page'
        update_option('show_on_front', 'page');

        // Set to page specified
        update_option('page_for_posts', $set_post_page_id);

    }


//-----------------------------------------------------
// change_permalink_structure
//
//-----------------------------------------------------

    if ($roots_theme_activation_options['change_permalink_structure'] === 'true') {
        $roots_theme_activation_options['change_permalink_structure'] = false;

        if (get_option('permalink_structure') !== '/%postname%/') {
            global $wp_rewrite;
            $wp_rewrite->set_permalink_structure('/%postname%/');
            flush_rewrite_rules();
        }
    }

//-----------------------------------------------------
// create_navigation_menus
//
//-----------------------------------------------------

    if ($roots_theme_activation_options['create_navigation_menus'] === 'true') {
        $roots_theme_activation_options['create_navigation_menus'] = false;

        $roots_nav_theme_mod = false;

        $primary_nav = wp_get_nav_menu_object(esc_html__('Primary Navigation', 'stratus'));

        if (!$primary_nav) {
            $primary_nav_id = wp_create_nav_menu(esc_html__('Primary Navigation', 'stratus'), array('slug' => 'primary_navigation'));
            $roots_nav_theme_mod['primary_navigation'] = $primary_nav_id;
        } else {
            $roots_nav_theme_mod['primary_navigation'] = $primary_nav->term_id;
        }

        if ($roots_nav_theme_mod) {
            set_theme_mod('nav_menu_locations', $roots_nav_theme_mod);
        }
    }

//-----------------------------------------------------
// add_pages_to_primary_navigation
//
//-----------------------------------------------------

    if ($roots_theme_activation_options['add_pages_to_primary_navigation'] === 'true') {
        $roots_theme_activation_options['add_pages_to_primary_navigation'] = false;

        $primary_nav = wp_get_nav_menu_object(esc_html__('Primary Navigation', 'stratus'));
        $primary_nav_term_id = (int) $primary_nav->term_id;
        $menu_items= wp_get_nav_menu_items($primary_nav_term_id);

        if (!$menu_items || empty($menu_items)) {
            $args = array(
                'sort_order' => 'ASC',
                'sort_column' => 'menu_order',
                'post_status' => 'publish'
            );
            $pages = get_pages($args);
            foreach($pages as $page) {
                $item = array(
                    'menu-item-object-id' => $page->ID,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type',
                    'menu-item-status' => 'publish'
                );
                wp_update_nav_menu_item($primary_nav_term_id, 0, $item);
            }
        }
    }

    update_option('roots_theme_activation_options', $roots_theme_activation_options);

    // set theme activation completed.
    update_option( 'themo_theme_activation_completed', 1 );

}
add_action('admin_init','roots_theme_activation_action');



/* Display a notice that can be dismissed */

function themo_activation_admin_notice() {
    global $current_user, $pagenow ;
    $user_id = $current_user->ID;
    /* Check that the user hasn't already clicked to ignore the message */
    if ( ! get_user_meta($user_id, 'themo_activation_ignore_notice') ) {
        echo '<div class="update-nag">';
        printf(wp_kses_post(__('<span class="dashicons-before dashicons-warning"></span> <a href="%2$s">Complete theme activation</a>', 'stratus')), '?themo_activation_nag_ignore=0',admin_url('themes.php?page=theme_activation_options'));
        echo "</div>";
    }
}
add_action('admin_init', 'themo_activation_nag_ignore');
function themo_activation_nag_ignore() {
    global $current_user;
    $user_id = $current_user->ID;
    /* If user clicks to ignore the notice, add that to their user meta */
    if ( isset($_GET['themo_activation_nag_ignore']) && '0' == $_GET['themo_activation_nag_ignore'] ) {
        add_user_meta($user_id, 'themo_activation_ignore_notice', 'true', true);
    }
}