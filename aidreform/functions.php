<?php
require_once (get_template_directory() . '/include/global_variables.php');

function cs_comment_tut_fields() {
    $you_may_use = __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'AidReform');
    $cs_comment_opt_array = array(
        'std' => '',
        'id' => '',
        'classes' => 'commenttextarea',
        'extra_atr' => ' rows="55" cols="15"',
        'cust_id' => 'comment_mes',
        'cust_name' => 'comment',
        'return' => true,
        'required' => false
    );
    $req = isset($req) ? $req : '';
    $html = '<p class="comment-form-comment fullwidth">' .
            '<label for="comment">' . __('Comment:', 'AidReform') . '<span>' . ( $req ? __('(required)', 'AidReform') : '' ) . '</span></label>' .
            '<textarea id="comment" name="comment"  class="commenttextarea" rows="4" cols="39"></textarea>' .
            '</p>';

    echo force_balance_tags($html);
}

function cs_filter_comment_form_field_comment($field) {

    return '';
}

// add the filter
add_filter('comment_form_field_comment', 'cs_filter_comment_form_field_comment', 10, 1);

add_action('comment_form_logged_in_after', 'cs_comment_tut_fields');
add_action('comment_form_after_fields', 'cs_comment_tut_fields');

add_action('after_setup_theme', 'cs_theme_setup');

function cs_theme_setup() {
    global $wpdb, $pagenow;
    /* Add theme-supported features. */
    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();
    // Make theme available for translation
    // Translations can be filed in the /languages/ directory
    load_theme_textdomain('AidReform', get_template_directory() . '/languages');
    if (!isset($content_width))
        $content_width = 1170;
    $args = array(
        'default-color' => '',
        'flex-width' => true,
        'flex-height' => true,
        'default-image' => '',
    );
    add_theme_support('custom-background', $args);
    add_theme_support('custom-header', $args);
    // This theme uses post thumbnails
    add_theme_support('post-thumbnails');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    add_theme_support("title-tag");
    /* Add custom actions. */
    add_action('init', 'cs_register_my_menus');
    if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {

        if (!get_option('cs_theme_option')) {
            add_action('admin_head', 'cs_activate_widget');
            add_action('init', 'cs_activation_data');
            wp_redirect(admin_url('admin.php?page=cs_demo_importer'));
        }
    }
    $cs_import_data = get_option('cs_import_data');
    $front_page_settings = get_option('front_page_settings');
    $home = get_page_by_title('Home');
    if (isset($cs_import_data) && $cs_import_data == 'success' && (!isset($front_page_settings) || empty($front_page_settings))) {
        $home = get_page_by_title('Home');
        $front_page_settings = get_option('front_page_settings');
        if (!isset($front_page_settings) || empty($front_page_settings)) {
            if ($home <> '' && get_option('page_on_front') == "0") {
                update_option('page_on_front', $home->ID);
                update_option('show_on_front', 'page');
                update_option('front_page_settings', '1');
            }
        }
    }
    if (!session_id()) {
        session_start();
    }
    add_action('admin_enqueue_scripts', 'cs_admin_scripts_enqueue');
    add_action('wp_enqueue_scripts', 'cs_front_scripts_enqueue');
    add_action('pre_get_posts', 'cs_get_search_results');
    /* Add custom filters. */
    add_filter('widget_text', 'do_shortcode'); // add short code in widget area
    add_filter('user_contactmethods', 'cs_contact_options', 10, 1);
    add_filter('the_password_form', 'cs_password_form');
    add_filter('wp_page_menu', 'cs_add_menuid');
    add_filter('wp_page_menu', 'cs_remove_div');
    add_filter('nav_menu_css_class', 'cs_add_parent_css', 10, 2);
    add_filter('pre_get_posts', 'cs_change_query_vars'); // Hook our custom function onto the request filter
}

// tgm class for (internal and WordPress repository) plugin activation start

require_once dirname(__FILE__) . '/include/tgm_plugin_activation.php';

add_action('tgmpa_register', 'cs_register_required_plugins');

function cs_register_required_plugins() {

    /**

     * Array of plugin arrays. Required keys are name and slug.

     * If the source is NOT from the .org repo, then source is also required.

     */
    $plugins = array(
        // This is an example of how to include a plugin pre-packaged with a theme

        array(
            'name' => 'Revolution Slider',
            'slug' => 'revslider',
            'source' => 'http://chimpgroup.com/wp-demo/download-plugin/revslider.zip',
            'required' => false,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        ),
            // This is an example of how to include a plugin from the WordPress Plugin Repository
    );

    // Change this to your theme text domain, used for internationalising strings

    $theme_text_domain = 'AidReform';

    /**

     * Array of configuration settings. Amend each line as needed.

     * If you want the default strings to be available under your own theme domain,

     * leave the strings uncommented.

     * Some of the strings are added into a sprintf, so see the comments at the

     * end of each line for what each argument will be.

     */
    $config = array(
        'domain' => $theme_text_domain, // Text domain - likely want to be the same as your theme.
        'default_path' => '', // Default absolute path to pre-packaged plugins
        'parent_menu_slug' => 'themes.php', // Default parent menu slug
        'parent_url_slug' => 'themes.php', // Default parent URL slug
        'menu' => 'install-required-plugins', // Menu slug
        'has_notices' => true, // Show admin notices or not
        'is_automatic' => true, // Automatically activate plugins after installation or not
        'message' => '', // Message to output right before the plugins table
        'strings' => array(
            'page_title' => __('Install Required Plugins', $theme_text_domain),
            'menu_title' => __('Install Plugins', $theme_text_domain),
            'installing' => __('Installing Plugin: %s', $theme_text_domain), // %1$s = plugin name
            'oops' => __('Something went wrong with the plugin API.', $theme_text_domain),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s)
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s)
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s)
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s)
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins'),
            'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins'),
            'return' => __('Return to Required Plugins Installer', $theme_text_domain),
            'plugin_activated' => __('Plugin activated successfully.', $theme_text_domain),
            'complete' => __('All plugins installed and activated successfully. %s', $theme_text_domain), // %1$s = dashboard link
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa($plugins, $config);
}

// tgm class for (internal and WordPress repository) plugin activation end
// Paypal Button

function cs_donate_button($cause_paypal_email = '') {

    global $post, $cs_theme_option;

    if (isset($cause_paypal_email) && $cause_paypal_email <> '') {
        $cs_cause_paypal_email = $cause_paypal_email;
    } else {
        $cs_cause_paypal_email = isset($cs_theme_option['paypal_email']) ? $cs_theme_option['paypal_email'] : '';
    }

    if (isset($cs_theme_option['trans_switcher'])) {
        if ($cs_theme_option['trans_switcher'] == "on") {
            $cause_donate = __('Donate Now', 'AidReform');
        }
    } else {
        $cause_donate = isset($cs_theme_option['cause_donate']) ? $cs_theme_option['cause_donate'] : '';
    }
    $paypal_currency = isset($cs_theme_option['paypal_currency']) ? $cs_theme_option['paypal_currency'] : '';
    $paypal_ipn_url = isset($cs_theme_option['paypal_ipn_url']) ? $cs_theme_option['paypal_ipn_url'] : '';
    $paypal_content_button = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">  

		<input type="hidden" name="cmd" value="_xclick">  
		<input type="hidden" name="business" value="' . $cs_cause_paypal_email . '">
		<input type="hidden" type="text" name="amount">  
		<input type="hidden" name="item_name" value="' . get_the_title() . '"> 
		<input type="hidden" name="no_shipping" value="2">
		<input type="hidden" name="item_number" value="' . $post->ID . '">  
		<input name="cancel_return" value="' . get_permalink($post->ID) . '" type="hidden">
		<input type="hidden" name="no_note" value="1">  
		<input type="hidden" name="currency_code" value="' . $paypal_currency . '">  
		<input type="hidden" name="notify_url" value="' . $paypal_ipn_url . '">
		<input type="hidden" name="lc" value="AU">  
		<input type="hidden" name="return" value="' . get_permalink($post->ID) . '">  
		<span class="btn theme-default bgcolr btndonate"><em class="fa fa-heart-o"></em><input class="bgcolr" type="submit" value="' . $cause_donate . '"> </span>

	</form> ';

    echo $paypal_content_button;
}

function add_social_icon() {

    $template_path = get_template_directory_uri() . '/scripts/admin/media_upload.js';

    wp_enqueue_script('my-upload2', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));



    echo '<tr id="del_' . $_POST['counter_social_network'] . '"> 

		<td><img width="50" src="' . $_POST['social_net_icon_path'] . '"></td> 

		<td>' . $_POST['social_net_url'] . '</td> 

		<td class="centr"> 

			<a onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del(' . $_POST['counter_social_network'] . ')">Del</a> 

			| <a href="javascript:cs_toggle(' . $_POST['counter_social_network'] . ')">Edit</a>

		</td> 

	</tr> 

	<tr id="' . $_POST['counter_social_network'] . '" style="display:none"> 

		<td colspan="3"> 

			<ul class="form-elements">

				<li class="to-label"><label>Icon Path</label></li>

				<li class="to-field">

				  <input id="social_net_icon_path' . $_POST['counter_social_network'] . '" name="social_net_icon_path[]" value="' . $_POST['social_net_icon_path'] . '" type="text" class="small" /> 

				</li>

				<li><a onclick="cs_toggle(' . $_POST['counter_social_network'] . ')"><img src="' . get_template_directory_uri() . '/images/admin/close-red.png"></a></li>

				<li class="full">&nbsp;</li>

				<li class="to-label"><label>Awesome Font</label></li>

				<li class="to-field">

				  <input class="small" type="text" id="social_net_awesome" name="social_net_awesome[]" value="' . $_POST['social_net_awesome'] . '" style="width:420px;" />

				  <p>Put Awesome Font Code like "icon-flag".</p>

				</li>

				<li class="full">&nbsp;</li>

				<li class="to-label"><label>URL</label></li>

				<li class="to-field">

				  <input class="small" type="text" id="social_net_url" name="social_net_url[]" value="' . $_POST['social_net_url'] . '" style="width:420px;" />

				  <p>Please enter full URL.</p>

				</li>

				<li class="full">&nbsp;</li>

				<li class="to-label"><label>Title</label></li>

				<li class="to-field">

				  <input class="small" type="text" id="social_net_tooltip" name="social_net_tooltip[]" value="' . $_POST['social_net_tooltip'] . '" style="width:420px;" />

				  <p>Please enter text for icon tooltip..</p>

				</li>

			</ul>

		</td> 

	</tr>';

    die;
}

add_action('wp_ajax_add_social_icon', 'add_social_icon');

// media pagination for slider/gallery in admin side start

function media_pagination() {

    foreach ($_REQUEST as $keys => $values) {

        $$keys = $values;
    }

    $records_per_page = 10;

    if (empty($page_id))
        $page_id = 1;

    $offset = $records_per_page * ($page_id - 1);
    ?>

    <ul class="gal-list">

        <?php
        $query_images_args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => -1,);

        $query_images = new WP_Query($query_images_args);

        if (empty($total_pages))
            $total_pages = count($query_images->posts);

        $query_images_args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => $records_per_page, 'offset' => $offset,);

        $query_images = new WP_Query($query_images_args);

        $images = array();

        foreach ($query_images->posts as $image) {

            $image_path = wp_get_attachment_image_src((int) $image->ID, array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h")));
            ?>

            <li style="cursor:pointer"><img src="<?php echo $image_path[0] ?>" onclick="javascript:clone('<?php echo $image->ID ?>')" alt="" /></li>

            <?php
        }
        ?>

    </ul>

    <br />

    <div class="pagination-cus">

        <ul>

            <?php
            if ($page_id > 1)
                echo "<li><a href='javascript:show_next(" . ($page_id - 1) . ",$total_pages)'>Prev</a></li>";

            for ($i = 1; $i <= ceil($total_pages / $records_per_page); $i++) {

                if ($i <> $page_id)
                    echo "<li><a href='javascript:show_next($i,$total_pages)'>" . $i . "</a></li> ";
                else
                    echo "<li class='active'><a>" . $i . "</a></li>";
            }

            if ($page_id < $total_pages / $records_per_page)
                echo "<li><a href='javascript:show_next(" . ($page_id + 1) . ",$total_pages)'>Next</a></li>";
            ?>

        </ul>

    </div>

    <?php
    if (isset($_POST['action']))
        die();
}

add_action('wp_ajax_media_pagination', 'media_pagination');

// media pagination for slider/gallery in admin side end
// to make a copy of media image for slider start

function cs_slider_clone() {

    global $cs_node, $cs_counter;

    if (isset($_POST['action'])) {

        $cs_node = new stdClass();

        $cs_node->title = '';

        $cs_node->description = '';

        $cs_node->link = '';

        $cs_node->link_target = '';

        $cs_node->use_image_as = '';

        $cs_node->video_code = '';
    }

    if (isset($_POST['counter']))
        $cs_counter = $_POST['counter'];

    if (isset($_POST['path']))
        $cs_node->path = $_POST['path'];
    ?>

    <li class="ui-state-default" id="<?php echo $cs_counter ?>">

        <div class="thumb-secs">

    <?php $image_path = wp_get_attachment_image_src((int) $cs_node->path, array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h"))); ?>

            <img src="<?php echo $image_path[0] ?>" alt="">

            <div class="gal-edit-opts">

                <!--<a href="#" class="resize"></a>-->

                <a href="javascript:slidedit(<?php echo $cs_counter ?>)" class="edit"></a>

                <a href="javascript:del_this(<?php echo $cs_counter ?>)" class="delete"></a>

            </div>

        </div>

        <div class="poped-up" id="edit_<?php echo $cs_counter ?>">

            <div class="opt-head">

                <h5><?php _e('Edit Options', 'AidReform') ?></h5>

                <a href="javascript:slideclose(<?php echo $cs_counter ?>)" class="closeit">&nbsp;</a>

                <div class="clear"></div>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Image Title', 'AidReform') ?></label></li>

                    <li class="to-field"><input type="text" name="cs_slider_title[]" value="<?php echo htmlspecialchars($cs_node->title) ?>" class="txtfield" /></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Image Description', 'AidReform') ?></label></li>

                    <li class="to-field"><textarea class="txtarea" name="cs_slider_description[]"><?php echo htmlspecialchars($cs_node->description) ?></textarea></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Link', 'AidReform') ?></label></li>

                    <li class="to-field"><input type="text" name="cs_slider_link[]" value="<?php echo htmlspecialchars($cs_node->link) ?>" class="txtfield" /></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Link Target', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_slider_link_target[]" class="select_dropdown">

                            <option <?php if ($cs_node->link_target == "_self") echo "selected"; ?> >_self</option>

                            <option <?php if ($cs_node->link_target == "_blank") echo "selected"; ?> >_blank</option>

                        </select>

                        <p><?php _e('Please select image target', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="path[]" value="<?php echo $cs_node->path ?>" />

                        <input type="button" value="Submit" onclick="javascript:slideclose(<?php echo $cs_counter ?>)" class="close-submit" />

                    </li>

                </ul>

                <div class="clear"></div>

            </div>

        </div>

    </li>

    <?php
    if (isset($_POST['action']))
        die();
}

add_action('wp_ajax_slider_clone', 'cs_slider_clone');

// to make a copy of media image for slider end
// to make a copy of media image for gallery start

function cs_gallery_clone() {

    global $cs_node, $cs_counter;

    if (isset($_POST['action'])) {

        $cs_node = new stdClass();

        $cs_node->title = "";

        $cs_node->use_image_as = "";

        $cs_node->video_code = "";

        $cs_node->link_url = "";

        $cs_node->use_image_as_db = "";

        $cs_node->link_url_db = '';
    }

    if (isset($_POST['counter']))
        $cs_counter = $_POST['counter'];

    if (isset($_POST['path']))
        $cs_node->path = $_POST['path'];
    ?>

    <li class="ui-state-default" id="<?php echo $cs_counter ?>">

        <div class="thumb-secs">

    <?php $image_path = wp_get_attachment_image_src((int) $cs_node->path, array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h"))); ?>

            <img src="<?php echo $image_path[0] ?>" alt="">

            <div class="gal-edit-opts">

                <!--<a href="#" class="resize"></a>-->

                <a href="javascript:galedit(<?php echo $cs_counter ?>)" class="edit"></a>

                <a href="javascript:del_this(<?php echo $cs_counter ?>)" class="delete"></a>

            </div>

        </div>

        <div class="poped-up" id="edit_<?php echo $cs_counter ?>">

            <div class="opt-head">

                <h5><?php _e('Edit Options', 'AidReform') ?></h5>

                <a href="javascript:galclose(<?php echo $cs_counter ?>)" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Image Title', 'AidReform') ?></label></li>

                    <li class="to-field"><input type="text" name="title[]" value="<?php echo htmlspecialchars($cs_node->title) ?>" class="txtfield" /></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Use Image As', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="use_image_as[]" class="select_dropdown" onchange="cs_toggle_gal(this.value, <?php echo $cs_counter ?>)">

                            <option <?php if ($cs_node->use_image_as == "0") echo "selected"; ?> value="0"><?php _e('LightBox to current thumbnail', 'AidReform') ?></option>

                            <option <?php if ($cs_node->use_image_as == "1") echo "selected"; ?> value="1"><?php _e('LightBox to Video', 'AidReform') ?></option>

                            <option <?php if ($cs_node->use_image_as == "2") echo "selected"; ?> value="2"><?php _e('Link', 'AidReform') ?></option>

                        </select>

                        <p><?php _e('Please select Image link where it will go', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements" id="video_code<?php echo $cs_counter ?>" <?php if ($cs_node->use_image_as == "0" or $cs_node->use_image_as == "" or $cs_node->use_image_as == "2") echo 'style="display:none"'; ?> >

                    <li class="to-label"><label><?php _e('Video Url', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="video_code[]" value="<?php echo htmlspecialchars($cs_node->video_code) ?>" class="txtfield" />

                        <p><?php _e('(Enter Specific Video Url Youtube or Vimeo)', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements" id="link_url<?php echo $cs_counter ?>" <?php if ($cs_node->use_image_as == "0" or $cs_node->use_image_as == "" or $cs_node->use_image_as == "1") echo 'style="display:none"'; ?> >

                    <li class="to-label"><label><?php _e('Url', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="link_url[]" value="<?php echo htmlspecialchars($cs_node->link_url) ?>" class="txtfield" />

                        <p><?php _e('(Enter Specific Link)', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="path[]" value="<?php echo $cs_node->path ?>" />

                        <input type="button" onclick="javascript:galclose(<?php echo $cs_counter ?>)" value="Submit" class="close-submit" />

                    </li>

                </ul>

                <div class="clear"></div>

            </div>

        </div>

    </li>

    <?php
    if (isset($_POST['action']))
        die();
}

add_action('wp_ajax_gallery_clone', 'cs_gallery_clone');

// to make a copy of media image for gallery end
// stripslashes / htmlspecialchars for theme option save start
if (!function_exists('stripslashes_htmlspecialchars')) {

    function stripslashes_htmlspecialchars($value) {

        $value = is_array($value) ? array_map('stripslashes_htmlspecialchars', $value) : stripslashes(htmlspecialchars($value));

        return $value;
    }

}

// stripslashes / htmlspecialchars for theme option save end
// saving all the theme options start

function theme_option_save() {
    global $cs_theme_option;
    if (isset($_POST['logo'])) {

        $_POST = stripslashes_htmlspecialchars($_POST);

        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['twitter_setting'])) {

            update_option("cs_theme_option", $_POST);

            echo "All Settings Saved";
        } else {

            update_option("cs_theme_option", $_POST);

            echo "All Settings Saved";
        }

        //$_POST = array_map( 'htmlspecialchars' ,$_POST);
        //$a = array_map( 'stripslashes' ,$a);
        //$cs_theme_option = get_option('cs_theme_option');
        // upating config file start

        /*

          $fname = ABSPATH."wp-config.php";

          $fhandle = fopen($fname,"r");

          $content = fread($fhandle,filesize($fname));

          $content = str_replace("define('WPLANG', '".$cs_theme_option['lang_theme']."')", "define('WPLANG', '".$_POST['lang_theme']."')", $content);

          $fhandle = fopen($fname,"w");

          fwrite($fhandle,$content);

          fclose($fhandle);

         */

        // upating config file end
    } else {

        //echo $_FILES["mofile"]["tmp_name"][0];
        //echo $_FILES["mofile"]["name"][0];

        $target_path_mo = get_template_directory() . "/languages/" . $_FILES["mofile"]["name"][0];

        if (move_uploaded_file($_FILES["mofile"]["tmp_name"][0], $target_path_mo)) {

            chmod($target_path_mo, 0777);
        }

        echo "New Language Uploaded Successfully";
    }

    die();
}

add_action('wp_ajax_theme_option_save', 'theme_option_save');

// saving all the theme options end
// saving theme options import export start

function theme_option_import_export() {

    $a = unserialize(base64_decode($_POST['theme_option_data']));

    update_option("cs_theme_option", $a);

    echo "Otions Imported";

    die();
}

add_action('wp_ajax_theme_option_import_export', 'theme_option_import_export');

// saving theme options import export end
// restoring default theme options start

function theme_option_restore_default() {

    update_option("cs_theme_option", get_option('cs_theme_option_restore'));

    echo "Default Theme Options Restored";

    die();
}

add_action('wp_ajax_theme_option_restore_default', 'theme_option_restore_default');

// restoring default theme options end
// saving theme options backup start

function theme_option_backup() {

    update_option("cs_theme_option_backup", get_option('cs_theme_option'));

    update_option("cs_theme_option_backup_time", gmdate("Y-m-d H:i:s"));

    echo "Current Backup Taken @ " . gmdate("Y-m-d H:i:s");

    die();
}

add_action('wp_ajax_theme_option_backup', 'theme_option_backup');

// saving theme options backup end
// restore backup start

function theme_option_backup_restore() {

    update_option("cs_theme_option", get_option('cs_theme_option_backup'));

    echo "Backup Restored";

    die();
}

add_action('wp_ajax_theme_option_backup_restore', 'theme_option_backup_restore');

// restore backup end
// page bulider items start
// gallery html form for page builder start

function cs_pb_gallery($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $gallery_element_size = '50';

        $cs_gal_header_title_db = '';

        $cs_gal_layout_db = '';

        $cs_gal_album_db = '';

        $cs_gal_pagination_db = '';

        $cs_gal_media_per_page_db = get_option("posts_per_page");
    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $gallery_element_size = $cs_node->gallery_element_size;

        $cs_gal_header_title_db = $cs_node->header_title;

        $cs_gal_layout_db = $cs_node->layout;

        $cs_gal_album_db = $cs_node->album;

        $cs_gal_pagination_db = $cs_node->pagination;

        $cs_gal_media_per_page_db = $cs_node->media_per_page;

        $cs_counter = $post->ID . $cs_count_node;
    }
    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $gallery_element_size ?>" item="gallery" data="<?php echo element_size_data_array_index($gallery_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="gallery_element_size[]" class="item" value="<?php echo $gallery_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'AidReform') ?></a> &nbsp; 

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'AidReform') ?></a> &nbsp;  

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'AidReform') ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'AidReform') ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Gallery Options', 'AidReform') ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Gallery Header Title', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_gal_header_title[]" class="txtfield" value="<?php echo htmlspecialchars($cs_gal_header_title_db) ?>" />

                        <p><?php _e('Please enter gallery header title', 'AidReform') ?></p>

                    </li>                    

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Choose Gallery Layout', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_gal_layout[]" class="dropdown">

                            <option value="gallery-four-col" <?php if ($cs_gal_layout_db == "gallery-four-col") echo "selected"; ?> ><?php _e('4 Column', 'AidReform') ?></option>

                            <option value="gallery-three-col" <?php if ($cs_gal_layout_db == "gallery-three-col") echo "selected"; ?> ><?php _e('3 Column', 'AidReform') ?></option>

                            <option value="gallery-two-col" <?php if ($cs_gal_layout_db == "gallery-two-col") echo "selected"; ?> ><?php _e('2 Column', 'AidReform') ?></option>

                            <option value="gallery-masonry" <?php if ($cs_gal_layout_db == "gallery-masonry") echo "selected"; ?> ><?php _e('Masonry', 'AidReform') ?></option>

                        </select>



                        <p><?php _e('Select gallery layout, single column, double column, triple column or four column', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Choose Gallery/Album', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_gal_album[]" class="dropdown">

                            <option value="0"><?php _e('-- Select Gallery --', 'AidReform') ?></option>

                            <?php
                            $query = array('posts_per_page' => '-1', 'post_type' => 'cs_gallery', 'orderby' => 'ID', 'post_status' => 'publish');

                            $wp_query = new WP_Query($query);

                            while ($wp_query->have_posts()) : $wp_query->the_post();
                                ?>

                                <option <?php if ($post->post_name == $cs_gal_album_db) echo "selected"; ?> value="<?php echo $post->post_name; ?>"><?php echo get_the_title() ?></option>

                                <?php
                            endwhile;
                            ?>

                        </select>

                        <p><?php _e('Select gallery album to show images', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Pagination', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_gal_pagination[]" class="dropdown" >

                            <option <?php if ($cs_gal_pagination_db == "Show Pagination") echo "selected"; ?> ><?php _e('Show Pagination', 'AidReform') ?></option>

                            <option <?php if ($cs_gal_pagination_db == "Single Page") echo "selected"; ?> ><?php _e('Single Page', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements" >

                    <li class="to-label"><label><?php _e('No. of Media Per Page', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_gal_media_per_page[]" class="txtfield" value="<?php echo $cs_gal_media_per_page_db; ?>" />

                        <p><?php _e('To display all the records, leave this field blank', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="gallery" />

                        <input type="button" value="<?php _e('Save', 'AidReform') ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php
    if ($die <> 1)
        die();
}

add_action('wp_ajax_cs_pb_gallery', 'cs_pb_gallery');

// gallery html form for page builder end
// services html form for page builder start

function cs_pb_services($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $services_element_size = '50';

        $service_title = '';

        $service_text = '';

        $service_link_url = '';

        $service_bg_image = '';
    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $services_element_size = $cs_node->services_element_size;

        $service_title = $cs_node->service_title;

        $service_text = $cs_node->service_text;

        $service_link_url = $cs_node->service_link_url;

        $service_text = $cs_node->service_bg_image;

        $cs_counter = $post->ID . $cs_count_node;
    }
    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column parentdelete column_<?php echo $services_element_size ?>" item="services" data="<?php echo element_size_data_array_index($services_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="services_element_size[]" class="item" value="<?php echo $services_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'AidReform') ?></a> &nbsp; 

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'AidReform') ?></a> &nbsp;  

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'AidReform') ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'AidReform') ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Services Options', 'AidReform') ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="wrapptabbox">

                <div class="clone_append">

                    <?php
                    $services_num = 0;

                    if (isset($cs_node)) {

                        $services_num = count($cs_node->service);

                        foreach ($cs_node->service as $service) {
                            ?>

                            <div class='clone_form'>

                                <a href='#' class='deleteit_node'><?php _e('Delete it', 'AidReform') ?></a>

                                <label><?php _e('Service Title', 'AidReform') ?></label> <input class="txtfield" type="text" name="service_title[]" value="<?php echo $service->service_title ?>" />

                                <label><?php _e('Service Icon', 'AidReform') ?></label> <input class="txtfield" type="text" name="service_icon[]" value="<?php echo $service->service_icon ?>" />

                                <label><?php _e('Service Background Image:', 'AidReform') ?></label> <input class="txtfield" type="text" name="service_bg_image[]" value="<?php echo $service->service_bg_image ?>" />

                                <label><?php _e('Service Link', 'AidReform') ?></label> <input class="txtfield" type="text" name="service_link_url[]" value="<?php echo $service->service_link_url ?>" />

                                <label><?php _e('Service Text', 'AidReform') ?></label> <textarea class="txtfield" name="service_text[]"><?php echo $service->service_text ?></textarea>



                            </div>



                            <?php
                        }
                    }
                    ?>

                </div>

                <div class="opt-conts">

                    <ul class="form-elements">

                        <li class="to-label"><label></label></li>

                        <li class="to-field"><a href="#" class="add_services"><?php _e('Add service', 'AidReform') ?></a></li>

                    </ul>

                    <ul class="form-elements noborder">

                        <li class="to-label"></li>

                        <li class="to-field">

                            <input type="hidden" name="services_num[]" value="<?php echo $services_num ?>" class="fieldCounter"  />

                            <input type="hidden" name="cs_orderby[]" value="services" />

                            <input type="button" value="<?php _e('Save', 'AidReform') ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                        </li>

                    </ul>

                </div>

            </div>



        </div>

    </div>

    <?php
    if ($die <> 1)
        die();
}

add_action('wp_ajax_cs_pb_services', 'cs_pb_services');

// services html form for page builder end
// slider html form for page builder start

function cs_pb_slider($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $slider_element_size = '50';

        $cs_slider_header_title_db = '';

        $cs_slider_type_db = '';

        $cs_slider_db = '';

        $cs_slider_width_db = '';

        $cs_slider_height_db = '';

        $slider_view = '';

        $slider_id = '';
    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $slider_element_size = $cs_node->slider_element_size;

        $cs_slider_header_title_db = $cs_node->slider_header_title;

        $cs_slider_type_db = $cs_node->slider_type;

        $cs_slider_db = $cs_node->slider;

        $slider_view = $cs_node->slider_view;

        $slider_id = $cs_node->slider_id;

        $cs_slider_width_db = $cs_node->width;

        $cs_slider_height_db = $cs_node->height;

        $cs_counter = $post->ID . $cs_count_node;
    }
    ?>

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $slider_element_size ?>" item="slider" data="<?php echo element_size_data_array_index($slider_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="slider_element_size[]" class="item" value="<?php echo $slider_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'AidReform') ?></a>

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'AidReform') ?></a> &nbsp;

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'AidReform') ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'AidReform') ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Slider Options', 'AidReform') ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Slider Header Title', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_slider_header_title[]" class="txtfield" value="<?php echo htmlspecialchars($cs_slider_header_title_db) ?>" />

                        <p><?php _e('Please enter slider header title', 'AidReform') ?></p>

                    </li>                    

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Choose Slider Type', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_slider_type[]" class="dropdown" onchange="cs_toggle_height(this.value, 'cs_slider_height<?php echo $name . $cs_counter ?>')">

                            <option <?php
                            if ($cs_slider_type_db == "Flex Slider") {
                                echo "selected";
                            }
                            ?> ><?php _e('Flex Slider', 'AidReform') ?></option>

                            <option <?php
                            if ($cs_slider_type_db == "Custom Slider") {
                                echo "selected";
                            }
                            ?> ><?php _e('Custom Slider', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements" id="choose_slider" style="display:<?php
                if ($cs_slider_type_db == "Custom Slider")
                    echo "none";
                else
                    echo "inline";
                ?>">

                    <li class="to-label"><label><?php _e('Choose Slider', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_slider[]" class="dropdown">

                            <?php
                            $query = array('posts_per_page' => '-1', 'post_type' => 'cs_slider', 'orderby' => 'ID', 'post_status' => 'publish');

                            $wp_query = new WP_Query($query);

                            while ($wp_query->have_posts()) : $wp_query->the_post();
                                ?>

                                <option <?php if ($post->post_name == $cs_slider_db) echo "selected"; ?> value="<?php echo $post->post_name; ?>"><?php the_title() ?></option>

                                <?php
                            endwhile;
                            ?>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements" >

                    <li class="to-label"><label><?php _e('Slider View', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="slider_view[]" class="dropdown" >

                            <option <?php if ($slider_view == "content") echo "selected"; ?> ><?php _e('content', 'AidReform') ?></option>

                            <option <?php if ($slider_view == "header") echo "selected"; ?> ><?php _e('header', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements" id="layer_slider" style="display:<?php
                if ($cs_slider_type_db == "Custom Slider")
                    echo "inline";
                else
                    echo "none";
                ?>" >

                    <li class="to-label">

                        <label><?php _e('Use Short Code', 'AidReform') ?></label>

                    </li>

                    <li class="to-field">

                        <input type="text" name="cs_slider_id[]" class="txtfield" value="<?php echo htmlspecialchars($slider_id); ?>" />

                    </li>

                    <li class="to-label"></li>

                    <li class="to-field">

                        <p><?php _e('Please enter the Revolution/Other Slider Short Code like [rev_slider AidReform]', 'AidReform') ?></p>

                    </li>                                            

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="slider" />

                        <input type="button" value="<?php _e('Save', 'AidReform') ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php
    if ($die <> 1)
        die();
}

add_action('wp_ajax_cs_pb_slider', 'cs_pb_slider');

// slider html form for page builder end

add_action('wp_ajax_add_gradiants_to_list', 'add_gradiants_to_list');

function add_gradiants_to_list() {

    global $counter_track, $address_name, $payer_email, $payment_gross, $txn_id, $payment_date;

    foreach ($_POST as $keys => $values) {

        $$keys = $values;
    }
    ?>

    <tr id="edit_track<?php echo $counter_track ?>">

        <td id="address-name<?php echo $counter_track ?>" style="width:20%;"><?php echo $address_name ?></td>

        <td id="payer_email<?php echo $counter_track ?>" style="width:20%;"><?php echo $payer_email ?></td>

        <td id="payment_gross<?php echo $counter_track ?>" style="width:20%;"><?php echo $payment_gross ?></td>

        <td id="txn_id<?php echo $counter_track ?>" style="width:20%;"><?php echo $txn_id ?></td>

        <td id="payment_date<?php echo $counter_track ?>" style="width:20%;"><?php echo $payment_date ?></td>

        <td class="centr" style="width:20%;">

            <a href="javascript:openpopedup('edit_track_form<?php echo $counter_track ?>')" class="actions edit">&nbsp;</a>

            <a onclick="javascript:return confirm('Are you sure! You want to delete this Transaction')" href="javascript:cs_div_remove('edit_track<?php echo $counter_track ?>')" class="actions delete">&nbsp;</a>

            <div class="poped-up" id="edit_track_form<?php echo $counter_track ?>" style="position:absolute;">

                <div class="opt-head">

                    <h5><?php _e('Edit Donation', 'AidReform') ?></h5>

                    <a href="javascript:closepopedup('edit_track_form<?php echo $counter_track ?>')" class="closeit">&nbsp;</a>

                    <div class="clear"></div>

                </div>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Donar Name', 'AidReform') ?></label></li>

                    <li class="to-field"><input type="text" name="address_name[]" value="<?php echo htmlspecialchars($address_name) ?>" id="address_name_title<?php echo $counter_track ?>" /><p><?php _e('Put Donar Name', 'AidReform') ?></p></li>



                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Email', 'AidReform') ?></label></li>

                    <li class="to-field"><input type="text" name="payer_email[]" value="<?php echo htmlspecialchars($payer_email) ?>" id="payer_email<?php echo $counter_track ?>" /><p><?php _e('Put Donor Emai', 'AidReform') ?>l</p></li>



                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Amount', 'AidReform') ?></label></li>

                    <li class="to-field"><input type="text" name="payment_gross[]" value="<?php echo htmlspecialchars($payment_gross) ?>" id="payment_gross<?php echo $counter_track ?>" /><p>Put Donor Raised Amount</p></li>



                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Transaction Id', 'AidReform') ?></label></li>

                    <li class="to-field"><input type="text" name="txn_id[]" value="<?php echo htmlspecialchars($txn_id) ?>" id="txn_id<?php echo $counter_track ?>" /><p><?php _e('Put Donor Transaction id', 'AidReform') ?></p></li>



                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Donation Date', 'AidReform') ?></label></li>

                    <li class="to-field"><input type="text" name="payment_date[]" value="<?php echo htmlspecialchars($payment_date) ?>" id="payment_date<?php echo $counter_track ?>" /><p><?php _e('Put Donation Date', 'AidReform') ?></p></li>



                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"><label></label></li>

                    <li class="to-field"><input type="button" value="Update Donation" onclick="update_title(<?php echo $counter_track ?>);
                                closepopedup('edit_track_form<?php echo $counter_track ?>')" /></li>

                </ul>

            </div>

        </td>

    </tr>

    <?php
}

// Menu html form for page builder start

function cs_pb_cause($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $cause_element_size = '50';

        $cause_cat = '';

        $cause_title = '';

        $cause_filterable = '';

        $cause_pagination = '';

        $cause_per_page = get_option("posts_per_page");

        $cause_view = '';

        $cs_cause_excerpt = '100';

        $cs_cause_link_title = 'Visit The Causes';

        $cs_cause_link_url = '#';

        $cause_type = '';
    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $cause_element_size = $cs_node->cause_element_size;

        $cause_title = $cs_node->cause_title;

        $cause_cat = $cs_node->cause_cat;

        $cause_filterable = $cs_node->cause_filterable;

        //$cause_post_title = $cs_node->cause_post_title;

        $cause_pagination = $cs_node->cause_pagination;

        $cause_per_page = $cs_node->cause_per_page;

        $cs_counter = $post->ID . $cs_count_node;

        $cs_cause_excerpt = $cs_node->cs_cause_excerpt;

        if ($cs_cause_excerpt == '') {
            $cs_cause_excerpt = 97;
        }

        $cs_cause_link_title = $cs_node->cs_cause_link_title;

        $cs_cause_link_url = $cs_node->cs_cause_link_url;

        $cause_type = $cs_node->cause_type;
    }
    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $cause_element_size ?>" item="blog" data="<?php echo element_size_data_array_index($cause_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="cause_element_size[]" class="item" value="<?php echo $cause_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'AidReform') ?></a>

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'AidReform') ?></a> &nbsp;

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'AidReform') ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'AidReform') ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Menu Options', 'AidReform') ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Cause Title', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cause_title[]" class="txtfield" value="<?php echo htmlspecialchars($cause_title) ?>" />

                        <p><?php _e('Menu Page Title', 'AidReform') ?></p>

                    </li>                                            

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Cause header link Title', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_cause_link_title[]" class="txtfield" value="<?php echo htmlspecialchars($cs_cause_link_title) ?>" />

                        <p><?php _e('Please enter Cause header Link title', 'AidReform') ?></p>

                    </li>                    

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Cause header link', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_cause_link_url[]" class="txtfield" value="<?php echo htmlspecialchars($cs_cause_link_url) ?>" />

                        <p><?php _e('Please enter Cause header Link', 'AidReform') ?></p>

                    </li>                    

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Choose Category', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cause_cat[]" class="dropdown">

                            <option value=""><?php _e('-- Select Category --', 'AidReform') ?></option>

    <?php show_all_cats('', '', $cause_cat, "cs_cause-category"); ?>

                        </select>

                        <p><?php _e('Choose category to show Cause list', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Cause Types', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cause_type[]" class="dropdown">

                            <option <?php if ($cause_type == "All") echo "selected"; ?> ><?php _e('All', 'AidReform') ?></option>

                            <option <?php if ($cause_type == "Upcoming Causes") echo "selected"; ?> ><?php _e('Upcoming Causes', 'AidReform') ?></option>

                            <option <?php if ($cause_type == "Past Causes") echo "selected"; ?> ><?php _e('Past Causes', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>



                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Filterable', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cause_filterable[]" class="dropdown" onchange="cs_toggle_tog('port_pagination<?php echo $name . $cs_counter ?>')">

                            <option <?php if ($cause_filterable == "Off") echo "selected"; ?> ><?php _e('Off', 'AidReform') ?></option>

                            <option <?php if ($cause_filterable == "On") echo "selected"; ?> ><?php _e('On', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <div id="port_pagination<?php echo $name . $cs_counter ?>" <?php if ($cause_filterable == "On") echo 'style=" display:none"' ?> >

                    <ul class="form-elements">

                        <li class="to-label"><label><?php _e('Pagination', 'AidReform') ?></label></li>

                        <li class="to-field">

                            <select name="cause_pagination[]" class="dropdown">

                                <option <?php if ($cause_pagination == "Show Pagination") echo "selected"; ?> ><?php _e('Show Pagination', 'AidReform') ?></option>

                                <option <?php if ($cause_pagination == "Single Page") echo "selected"; ?> ><?php _e('Single Page', 'AidReform') ?></option>

                            </select>

                        </li>

                    </ul>



                </div>
                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Length of Excerpt', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_cause_excerpt[]" class="txtfield" value="<?php echo $cs_cause_excerpt; ?>" />

                        <p><?php _e('Enter number of character for short description text', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('No. of record Per Page', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cause_per_page[]" class="txtfield" value="<?php echo $cause_per_page; ?>" />

                        <p><?php _e('To display all the records, leave this field blank', 'AidReform') ?></p>

                    </li>

                </ul>
                <ul class="form-elements noborder">

                    <li class="to-label"><label></label></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="cause" />

                        <input type="button" value="<?php _e('Save', 'AidReform') ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php
    if ($die <> 1)
        die();
}

add_action('wp_ajax_cs_pb_cause', 'cs_pb_cause');

// Menu html form for page builder end

if (isset($action))
    die();

// blog html form for page builder start

function cs_pb_blog($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $blog_element_size = '50';

        $cs_blog_title_db = '';

        $cs_blog_description_db = '';

        $cs_blog_view_db = '';

        $cs_blog_cat_db = '';

        $cs_blog_excerpt_db = '255';

        $cs_blog_num_post_db = get_option("posts_per_page");

        $cs_blog_pagination_db = '';

        $cs_post_description_db = '';

        $cs_blog_link_title_db = 'VISIT THE Blogs';

        $cs_blog_link_url_db = '';
        $cs_blog_orderby_db = 'DESC';
    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $blog_element_size = $cs_node->blog_element_size;

        $cs_blog_title_db = $cs_node->cs_blog_title;

        $cs_blog_description_db = $cs_node->cs_blog_description;

        $cs_blog_view_db = $cs_node->cs_blog_view;

        $cs_blog_cat_db = $cs_node->cs_blog_cat;

        $cs_blog_excerpt_db = $cs_node->cs_blog_excerpt;

        $cs_blog_num_post_db = $cs_node->cs_blog_num_post;

        $cs_blog_pagination_db = $cs_node->cs_blog_pagination;

        $cs_blog_description_db = $cs_node->cs_blog_description;

        $cs_counter = $post->ID . $cs_count_node;

        $cs_blog_link_title_db = $cs_node->cs_blog_link_title;

        $cs_blog_link_url_db = $cs_node->cs_blog_link_url;
        $cs_blog_orderby_db = $cs_node->cs_blog_orderby;
    }
    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $blog_element_size ?>" item="blog" data="<?php echo element_size_data_array_index($blog_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="blog_element_size[]" class="item" value="<?php echo $blog_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'AidReform') ?></a>

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'AidReform') ?></a> &nbsp;

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'AidReform') ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'AidReform') ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Blog Options', 'AidReform') ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Blog Header Title', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_blog_title[]" class="txtfield" value="<?php echo htmlspecialchars($cs_blog_title_db) ?>" />

                        <p><?php _e('Please enter Blog header title.', 'AidReform') ?></p>

                    </li>                    

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Select View', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_blog_view[]" class="dropdown">

                            <option <?php if ($cs_blog_view_db == "blog-large") echo "selected"; ?> value="blog-large"><?php _e('Blog Large Image', 'AidReform') ?></option>

                            <option <?php if ($cs_blog_view_db == "blog-medium") echo "selected"; ?> value="blog-medium"><?php _e('Blog Medium Image', 'AidReform') ?></option>

                            <option <?php if ($cs_blog_view_db == "blog-grid") echo "selected"; ?> value="blog-grid"><?php _e('Blog Grid Image', 'AidReform') ?></option>

                        </select>



                    </li>                                        

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Blog header link Title', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_blog_link_title[]" class="txtfield" value="<?php echo htmlspecialchars($cs_blog_link_title_db) ?>" />

                        <p><?php _e('Please enter Blog header Link title', 'AidReform') ?></p>

                    </li>                    

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Blog header Url', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_blog_link_url[]" class="txtfield" value="<?php echo htmlspecialchars($cs_blog_link_url_db) ?>" />

                        <p<?php _e('Please enter Blog header Link', 'AidReform') ?>></p>

                    </li>                    

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Choose Category', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_blog_cat[]" class="dropdown">

                            <option value="0"><?php _e('-- Select Category --', 'AidReform') ?></option>

    <?php show_all_cats('', '', $cs_blog_cat_db, "category"); ?>

                        </select>

                        <p><?php _e('Please select category to show posts', 'AidReform') ?></p>

                    </li>                                        

                </ul>
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Post Order', 'AidReform') ?></label></li>
                    <li class="to-field">
                        <select name="cs_blog_orderby[]" class="dropdown" >
                            <option <?php if ($cs_blog_orderby_db == "ASC") echo "selected"; ?> value="ASC"><?php _e('Ascending', 'AidReform') ?></option>
                            <option <?php if ($cs_blog_orderby_db == "DESC") echo "selected"; ?> value="DESC"><?php _e('Descending', 'AidReform') ?></option>
                        </select>
                    </li>
                </ul>
                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Post Description', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_blog_description[]" class="dropdown" >

                            <option <?php if ($cs_blog_description_db == "yes") echo "selected"; ?> value="yes"><?php _e('Yes', 'AidReform') ?></option>

                            <option <?php if ($cs_blog_description_db == "no") echo "selected"; ?> value="no"><?php _e('No', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Length of Excerpt', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_blog_excerpt[]" class="txtfield" value="<?php echo $cs_blog_excerpt_db; ?>" />

                        <p><?php _e('Enter number of character for short description text', 'AidReform') ?></p>

                    </li>                         

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Pagination', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_blog_pagination[]" class="dropdown" >

                            <option <?php if ($cs_blog_pagination_db == "Show Pagination") echo "selected"; ?> ><?php _e('Show Pagination', 'AidReform') ?></option>

                            <option <?php if ($cs_blog_pagination_db == "Single Page") echo "selected"; ?> ><?php _e('Single Page', 'AidReform') ?></option>

                                        <!--<option <?php //if($cs_blog_pagination_db=="Load More")echo "selected";   ?> >Load More</option>-->

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('No. of Post Per Page', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_blog_num_post[]" class="txtfield" value="<?php echo $cs_blog_num_post_db; ?>" />

                        <p><?php _e('To display all the records, leave this field blank', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="blog" />

                        <input type="button" value="<?php _e('Save', 'AidReform') ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php
    if ($die <> 1)
        die();
}

add_action('wp_ajax_cs_pb_blog', 'cs_pb_blog');

// blog html form for page builder end
// event html form for page builder start

function cs_pb_event($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $event_element_size = '50';

        $cs_event_title_db = '';

        $cs_event_type_db = '';

        $cs_event_category_db = '';

        $cs_event_time_db = '';

        $cs_event_organizer_db = '';

        $cs_event_filterables_db = '';

        $cs_event_pagination_db = '';

        $cs_event_per_page_db = get_option("posts_per_page");
    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $event_element_size = $cs_node->event_element_size;

        $cs_event_title_db = $cs_node->cs_event_title;

        $cs_event_type_db = $cs_node->cs_event_type;

        $cs_event_category_db = $cs_node->cs_event_category;

        $cs_event_time_db = $cs_node->cs_event_time;

        $cs_event_organizer_db = $cs_node->cs_event_organizer;

        $cs_event_filterables_db = $cs_node->cs_event_filterables;

        $cs_event_pagination_db = $cs_node->cs_event_pagination;

        $cs_event_per_page_db = $cs_node->cs_event_per_page;

        $cs_counter = $post->ID . $cs_count_node;
    }
    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $event_element_size ?>" item="event" data="<?php echo element_size_data_array_index($event_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="event_element_size[]" class="item" value="<?php echo $event_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'AidReform') ?></a>

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'AidReform') ?></a> &nbsp;

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'AidReform') ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'AidReform') ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Event Options', 'AidReform') ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Event Title', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_event_title[]" class="txtfield" value="<?php echo htmlspecialchars($cs_event_title_db) ?>" />

                        <p><?php _e('Event Page Title', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Event Types', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_type[]" class="dropdown">

                            <option <?php if ($cs_event_type_db == "All Events") echo "selected"; ?> ><?php _e('All Events', 'AidReform') ?></option>

                            <option <?php if ($cs_event_type_db == "Upcoming Events") echo "selected"; ?> ><?php _e('Upcoming Events', 'AidReform') ?></option>

                            <option <?php if ($cs_event_type_db == "Past Events") echo "selected"; ?> ><?php _e('Past Events', 'AidReform') ?></option>

                        </select>

                        <p><?php _e('Select event type', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Select Category', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_category[]" class="dropdown">

                            <option value="0"><?php _e('-- Select Category --', 'AidReform') ?></option>

    <?php show_all_cats('', '', $cs_event_category_db, "event-category"); ?>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Show Time', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_time[]" class="dropdown">

                            <option value="Yes" <?php if ($cs_event_time_db == "Yes") echo "selected"; ?> ><?php _e('Yes', 'AidReform') ?></option>

                            <option value="No" <?php if ($cs_event_time_db == "No") echo "selected"; ?> ><?php _e('No', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements" style="display:none;">

                    <li class="to-label"><label><?php _e('Show Organizer', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_organizer[]" class="dropdown">

                            <option value="Yes" <?php if ($cs_event_organizer_db == "Yes") echo "selected"; ?> ><?php _e('Yes', 'AidReform') ?></option>

                            <option value="No" <?php if ($cs_event_organizer_db == "No") echo "selected"; ?> ><?php _e('No', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Filterables', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_filterables[]" class="dropdown" >

                            <option value="No" <?php if ($cs_event_filterables_db == "No") echo "selected"; ?> ><?php _e('No', 'AidReform') ?></option>

                            <option value="Yes" <?php if ($cs_event_filterables_db == "Yes") echo "selected"; ?> ><?php _e('Yes', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Pagination', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="cs_event_pagination[]" class="dropdown" >

                            <option <?php if ($cs_event_pagination_db == "Show Pagination") echo "selected"; ?> ><?php _e('Show Pagination', 'AidReform') ?></option>

                                        <!--<option <?php //if($cs_event_pagination_db=="Load More")echo "selected";  ?> >Load More</option>-->

                            <option <?php if ($cs_event_pagination_db == "Single Page") echo "selected"; ?> ><?php _e('Single Page', 'AidReform') ?></option>

                        </select>

                        <p><?php _e('Show navigation only at List View', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('No. of Events Per Page', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_event_per_page[]" class="txtfield" value="<?php echo $cs_event_per_page_db; ?>" />

                        <p><?php _e('To display all the records, leave this field blank', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="event" />

                        <input type="button" value="<?php _e('Save', 'AidReform') ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php
    if ($die <> 1)
        die();
}

add_action('wp_ajax_cs_pb_event', 'cs_pb_event');

// event html form for page builder end
// contact us html form for page builder start

function cs_pb_contact($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $contact_element_size = '50';

        $cs_contact_email_db = '';

        $cs_contact_succ_msg_db = '';
    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $contact_element_size = $cs_node->contact_element_size;

        $cs_contact_email_db = $cs_node->cs_contact_email;

        $cs_contact_succ_msg_db = $cs_node->cs_contact_succ_msg;

        $cs_counter = $post->ID . $cs_count_node;
    }
    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $contact_element_size ?>" item="contact" data="<?php echo element_size_data_array_index($contact_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="contact_element_size[]" class="item" value="<?php echo $contact_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'AidReform') ?></a>

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'AidReform') ?></a> &nbsp;

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'AidReform') ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'AidReform') ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Contact Form', 'AidReform') ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Contact Email', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="cs_contact_email[]" class="txtfield" value="<?php
                               if ($cs_contact_email_db == "")
                                   echo get_option("admin_email");
                               else
                                   echo $cs_contact_email_db;
                               ?>" />

                        <p><?php _e('Please enter Contact email Address', 'AidReform') ?></p>

                    </li>                    

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Successful Message', 'AidReform') ?></label></li>

                    <li class="to-field"><textarea name="cs_contact_succ_msg[]"><?php
                        if ($cs_contact_succ_msg_db == "")
                            echo "Email Sent Successfully.\nThank you, your message has been submitted to us.";
                        else
                            echo $cs_contact_succ_msg_db;
                        ?></textarea></li>

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="contact" />

                        <input type="button" value="<?php _e('Save', 'AidReform') ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php
    if ($die <> 1)
        die();
}

add_action('wp_ajax_cs_pb_contact', 'cs_pb_contact');

// contact us html form for page builder end
// column html form for page builder start

function cs_pb_column($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $column_element_size = '25';

        $column_text = '';
    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $column_element_size = $cs_node->column_element_size;

        $column_text = $cs_node->column_text;

        $cs_counter = $post->ID . $cs_count_node;
    }
    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $column_element_size ?>" item="column" data="<?php echo element_size_data_array_index($column_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="column_element_size[]" class="item" value="<?php echo $column_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'AidReform') ?></a> &nbsp; 

            <a href="#" class="delete-it btndeleteit"><?php _e('Del', 'AidReform') ?></a> &nbsp;  

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'AidReform') ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'AidReform') ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Column Options', 'AidReform') ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Column Text', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <textarea name="column_text[]"><?php echo $column_text ?></textarea>

                        <p><?php _e('Shortcodes and HTML tags allowed', 'AidReform') ?></p>

                    </li>                  

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="column" />

                        <input type="button" value="<?php _e('Save', 'AidReform') ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <?php
    if ($die <> 1)
        die();
}

add_action('wp_ajax_cs_pb_column', 'cs_pb_column');

// column html form for page builder end 
// google map html form for page builder start

function cs_pb_map($die = 0) {

    global $cs_node, $cs_count_node, $post;

    if (isset($_POST['action'])) {

        $name = $_POST['action'];

        $cs_counter = $_POST['counter'];

        $map_element_size = '25';

        $map_title = '';

        $map_height = '';

        $map_lat = '';

        $map_lon = '';

        $map_zoom = '';

        $map_type = '';

        $map_info = '';

        $map_info_width = '';

        $map_info_height = '';

        $map_marker_icon = '';

        $map_show_marker = '';

        $map_controls = '';

        $map_draggable = '';

        $map_scrollwheel = '';

        $map_view = '';

        $map_conactus_content = '<a href="' . home_url() . '" class="logo"><img src="' . get_template_directory_uri() . '/images/logo.png" alt=""></a>

                            <p>25 Infinite Square,</br> Red StreetCA 123456,</br> City name Canada,</p>

                            <ul>

                                <li><span>' . __('Phone', 'AidReform') . '</span>123.456.78910</li>

                                <li><span>' . __('Mobile', 'AidReform') . '</span>(800) 123 4567 89</li>

                                <li><span>' . __('Email', 'AidReform') . '</span><a class="colrhover" href="#">resturant@resturant.com</a></li>

                                <li><span>' . __('Timing', 'AidReform') . '</span>Mon-Thu (09:00 to 17:30)</li>

                            </ul>';
    } else {

        $name = $cs_node->getName();

        $cs_count_node++;

        $map_element_size = $cs_node->map_element_size;

        $map_title = $cs_node->map_title;

        $map_height = $cs_node->map_height;

        $map_lat = $cs_node->map_lat;

        $map_lon = $cs_node->map_lon;

        $map_zoom = $cs_node->map_zoom;

        $map_type = $cs_node->map_type;

        $map_info = $cs_node->map_info;

        $map_info_width = $cs_node->map_info_width;

        $map_info_height = $cs_node->map_info_height;

        $map_marker_icon = $cs_node->map_marker_icon;

        $map_show_marker = $cs_node->map_show_marker;

        $map_controls = $cs_node->map_controls;

        $map_draggable = $cs_node->map_draggable;

        $map_scrollwheel = $cs_node->map_scrollwheel;

        $map_view = $cs_node->map_view;

        $map_conactus_content = $cs_node->map_conactus_content;

        $cs_counter = $post->ID . $cs_count_node;
    }
    ?> 

    <div id="<?php echo $name . $cs_counter ?>_del" class="column  parentdelete column_<?php echo $map_element_size ?>" item="map" data="<?php echo element_size_data_array_index($map_element_size) ?>" >

        <div class="column-in">

            <h5><?php echo ucfirst(str_replace("cs_pb_", "", $name)) ?></h5>

            <input type="hidden" name="map_element_size[]" class="item" value="<?php echo $map_element_size ?>" >

            <a href="javascript:hide_all('<?php echo $name . $cs_counter ?>')" class="options"><?php _e('Options', 'AidReform') ?></a> &nbsp; 

            <a href="#" class="delete-it btndeleteit">Del</a> &nbsp;  

            <a class="decrement" onclick="javascript:decrement(this)"><?php _e('Dec', 'AidReform') ?></a> &nbsp; 

            <a class="increment" onclick="javascript:increment(this)"><?php _e('Inc', 'AidReform') ?></a>

        </div>

        <div class="poped-up" id="<?php echo $name . $cs_counter ?>" style="border:none; background:#f8f8f8;" >

            <div class="opt-head">

                <h5><?php _e('Edit Map Options', 'AidReform') ?></h5>

                <a href="javascript:show_all('<?php echo $name . $cs_counter ?>')" class="closeit">&nbsp;</a>

            </div>

            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Title', 'AidReform') ?></label></li>

                    <li class="to-field"><input type="text" name="map_title[]" class="txtfield" value="<?php echo $map_title ?>" /></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Map Height', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_height[]" class="txtfield" value="<?php echo $map_height ?>" />

                        <p><?php _e('Info Max Height in PX (Default is 200)', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Latitude', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_lat[]" class="txtfield" value="<?php echo $map_lat ?>" />

                        <p><?php _e('Put Latitude (Default is 0)', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Longitude', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_lon[]" class="txtfield" value="<?php echo $map_lon ?>" />

                        <p><?php _e('Put Longitude (Default is 0)', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Zoom', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_zoom[]" class="txtfield" value="<?php echo $map_zoom ?>" />

                        <p><?php _e('Put Zoom Level (Default is 11)', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Map Types', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="map_type[]" class="dropdown" >

                            <option <?php if ($map_type == "ROADMAP") echo "selected"; ?> ><?php _e('ROADMAP', 'AidReform') ?></option>

                            <option <?php if ($map_type == "HYBRID") echo "selected"; ?> ><?php _e('Hybrid', 'AidReform') ?></option>

                            <option <?php if ($map_type == "SATELLITE") echo "selected"; ?> ><?php _e('SATELLITE', 'AidReform') ?></option>

                            <option <?php if ($map_type == "TERRAIN") echo "selected"; ?> ><?php _e('Terrain', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Info Text', 'AidReform') ?></label></li>

                    <li class="to-field"><input type="text" name="map_info[]" class="txtfield" value="<?php echo $map_info ?>" /></li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Info Max Width', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_info_width[]" class="txtfield" value="<?php echo $map_info_width ?>" />

                        <p><?php _e('Info Max Width in PX (Default is 200)', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Info Max Height', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_info_height[]" class="txtfield" value="<?php echo $map_info_height ?>" />

                        <p><?php _e('Info Max Height in PX (Default is 100)', 'AidReform') ?></p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Marker Icon Path', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <input type="text" name="map_marker_icon[]" class="txtfield" value="<?php echo $map_marker_icon ?>" />

                        <p>e.g. http://yourdomain.com/logo.png</p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Show Marker', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="map_show_marker[]" class="dropdown" >

                            <option value="true" <?php if ($map_show_marker == "true") echo "selected"; ?> ><?php _e('On', 'AidReform') ?></option>

                            <option value="false" <?php if ($map_show_marker == "false") echo "selected"; ?> ><?php _e('Off', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Disable Map Controls', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="map_controls[]" class="dropdown" >

                            <option value="false" <?php if ($map_controls == "false") echo "selected"; ?> ><?php _e('Off', 'AidReform') ?></option>

                            <option value="true" <?php if ($map_controls == "true") echo "selected"; ?> ><?php _e('On', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Draggable', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="map_draggable[]" class="dropdown" >

                            <option value="true" <?php if ($map_draggable == "true") echo "selected"; ?> ><?php _e('On', 'AidReform') ?></option>

                            <option value="false" <?php if ($map_draggable == "false") echo "selected"; ?> ><?php _e('Off', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Scroll Wheel', 'AidReform') ?></label></li>

                    <li class="to-field">



                        <select name="map_scrollwheel[]" class="dropdown" >

                            <option value="true" <?php if ($map_scrollwheel == "true") echo "selected"; ?> ><?php _e('On', 'AidReform') ?></option>

                            <option value="false" <?php if ($map_scrollwheel == "false") echo "selected"; ?> ><?php _e('Off', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label><?php _e('Map View', 'AidReform') ?></label></li>

                    <li class="to-field">

                        <select name="map_view[]" class="dropdown"  onchange="map_contactus_element(this.value,<?php echo $cs_counter; ?>)">

                            <option <?php if ($map_view == "content") echo "selected"; ?> ><?php _e('content', 'AidReform') ?></option>

                            <option <?php if ($map_view == "header") echo "selected"; ?> ><?php _e('header', 'AidReform') ?></option>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field">

                        <input type="hidden" name="cs_orderby[]" value="map" />

                        <input type="button" value="<?php _e('Save', 'AidReform') ?>" style="margin-right:10px;" onclick="javascript:show_all('<?php echo $name . $cs_counter ?>')" />

                    </li>

                </ul>

            </div>



        </div>

    </div>

    <?php
    if ($die <> 1)
        die();
}

add_action('wp_ajax_cs_pb_map', 'cs_pb_map');

// google map html form for page builder end
// page bulider items end
// side bar layout in pages, post and default page(theme options) start

function meta_layout() {

    global $cs_xmlObject, $cs_theme_option;

    if (empty($cs_xmlObject->sidebar_layout->cs_layout))
        $cs_layout = "";
    else
        $cs_layout = $cs_xmlObject->sidebar_layout->cs_layout;

    if (empty($cs_xmlObject->sidebar_layout->cs_sidebar_left))
        $cs_sidebar_left = "";
    else
        $cs_sidebar_left = $cs_xmlObject->sidebar_layout->cs_sidebar_left;

    if (empty($cs_xmlObject->sidebar_layout->cs_sidebar_right))
        $cs_sidebar_right = "";
    else
        $cs_sidebar_right = $cs_xmlObject->sidebar_layout->cs_sidebar_right;
    ?>

    <div class="elementhidden">

        <div class="clear"></div>

        <div class="opt-head">

            <h4><?php _e('Layout Options', 'AidReform') ?></h4>

            <div class="clear"></div>

        </div>

        <ul class="form-elements">

            <li class="to-label">

                <label><?php _e('Select Layout', 'AidReform') ?></label>

            </li>

            <li class="to-field">

                <div class="meta-input">

                    <div class='radio-image-wrapper'>

                        <input <?php if ($cs_layout == "none") echo "checked" ?> onclick="show_sidebar('none')" type="radio" name="cs_layout" class="radio" value="none" id="radio_1" />

                        <label for="radio_1">

                            <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/admin/1.gif"  alt="" /></span>

                            <span <?php if ($cs_layout == "none") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/admin/1-hover.gif" alt="" /></span>

                        </label>

                    </div>

                    <div class='radio-image-wrapper'>

                        <input <?php if ($cs_layout == "right") echo "checked" ?> onclick="show_sidebar('right')" type="radio" name="cs_layout" class="radio" value="right" id="radio_2"  />

                        <label for="radio_2">

                            <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/admin/2.gif" alt="" /></span>

                            <span <?php if ($cs_layout == "right") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/admin/2-hover.gif" alt="" /></span>

                        </label>

                    </div>

                    <div class='radio-image-wrapper'>

                        <input <?php if ($cs_layout == "left") echo "checked" ?> onclick="show_sidebar('left')" type="radio" name="cs_layout" class="radio" value="left" id="radio_3" />

                        <label for="radio_3">

                            <span class="ss"><img src="<?php echo get_template_directory_uri() ?>/images/admin/3.gif" alt="" /></span>

                            <span <?php if ($cs_layout == "left") echo "class='check-list'" ?> id="check-list"><img src="<?php echo get_template_directory_uri() ?>/images/admin/3-hover.gif" alt="" /></span>

                        </label>

                    </div>

                </div>

            </li>

        </ul>

        <ul class="form-elements meta-body" style=" <?php
    if ($cs_sidebar_left == "") {
        echo "display:none";
    } else
        echo "display:block";
    ?>" id="sidebar_left" >

            <li class="to-label">

                <label><?php _e('Select Left Sidebar', 'AidReform') ?></label>

            </li>

            <li class="to-field">

                <select name="cs_sidebar_left" class="select_dropdown" id="page-option-choose-left-sidebar">
                    <option <?php if ($cs_sidebar_left == 'sidebar-1') echo "selected"; ?> value="sidebar-1" ><?php _e('Primary Sidebar', 'AidReform') ?></option>
                    <?php
                    // $cs_theme_option = get_option('cs_theme_option');

                    if (isset($cs_theme_option['sidebar']) and count($cs_theme_option['sidebar']) > 0) {

                        foreach ($cs_theme_option['sidebar'] as $sidebar) {
                            ?>

                            <option <?php if ($cs_sidebar_left == $sidebar) echo "selected"; ?> ><?php echo $sidebar; ?></option>

            <?php
        }
    }
    ?>

                </select>

            </li>

        </ul>

        <ul class="form-elements meta-body" style=" <?php
    if ($cs_sidebar_right == "") {
        echo "display:none";
    } else
        echo "display:block";
    ?>" id="sidebar_right" >

            <li class="to-label">

                <label><?php _e('Select Right Sidebar', 'AidReform') ?></label>

            </li>

            <li class="to-field">

                <select name="cs_sidebar_right" class="select_dropdown" id="page-option-choose-right-sidebar">
                    <option <?php if ($cs_sidebar_right == 'sidebar-1') echo "selected"; ?> value="sidebar-1" ><?php _e('Primary Sidebar', 'AidReform') ?></option>

    <?php
    if (isset($cs_theme_option['sidebar']) and count($cs_theme_option['sidebar']) > 0) {

        foreach ($cs_theme_option['sidebar'] as $sidebar) {
            ?>

                            <option <?php if ($cs_sidebar_right == $sidebar) echo "selected"; ?> ><?php echo $sidebar; ?></option>

            <?php
        }
    }
    ?>

                </select>

                <input type="hidden" name="cs_orderby[]" value="meta_layout" />

            </li>

        </ul>

    </div>

    <div class="clear"></div>

    <?php
}

// side bar layout in pages, post and default page(theme options) end

function element_size_data_array_index($size) {

    if ($size == "" or $size == 100)
        return 0;

    else if ($size == 75)
        return 1;

    else if ($size == 50)
        return 2;

    else if ($size == 25)
        return 3;
}

// Show all Categories

function show_all_cats($parent, $separator, $selected = "", $taxonomy) {

    if ($parent == "") {

        global $wpdb;

        $parent = 0;
    } else
        $separator .= " &ndash; ";

    $args = array(
        'parent' => $parent,
        'hide_empty' => 0,
        'taxonomy' => $taxonomy
    );

    $categories = get_categories($args);

    foreach ($categories as $category) {
        ?>

        <option <?php if ($selected == $category->slug) echo "selected"; ?> value="<?php echo $category->slug ?>"><?php echo $separator . $category->cat_name ?></option>

        <?php
        show_all_cats($category->term_id, $separator, $selected, $taxonomy);
    }
}

// Events Meta data save

function events_meta_save($post_id) {

    global $wpdb;

    if (empty($_POST["sub_title"])) {
        $_POST["sub_title"] = "";
    }

    if (empty($_POST["inside_event_thumb_view"])) {
        $_POST["inside_event_thumb_view"] = "";
    }

    if (empty($_POST["inside_event_featured_image_as_thumbnail"])) {
        $_POST["inside_event_featured_image_as_thumbnail"] = "";
    }

    if (empty($_POST["inside_event_thumb_audio"])) {
        $_POST["inside_event_thumb_audio"] = "";
    }

    if (empty($_POST["inside_event_thumb_video"])) {
        $_POST["inside_event_thumb_video"] = "";
    }

    if (empty($_POST["inside_event_thumb_slider"])) {
        $_POST["inside_event_thumb_slider"] = "";
    }

    if (empty($_POST["inside_event_thumb_slider_type"])) {
        $_POST["inside_event_thumb_slider_type"] = "";
    }

    if (empty($_POST["inside_event_thumb_map_lat"])) {
        $_POST["inside_event_thumb_map_lat"] = "";
    }

    if (empty($_POST["inside_event_thumb_map_lon"])) {
        $_POST["inside_event_thumb_map_lon"] = "";
    }

    if (empty($_POST["inside_event_thumb_map_zoom"])) {
        $_POST["inside_event_thumb_map_zoom"] = "";
    }

    if (empty($_POST["inside_event_thumb_map_address"])) {
        $_POST["inside_event_thumb_map_address"] = "";
    }

    if (empty($_POST["inside_event_thumb_map_controls"])) {
        $_POST["inside_event_thumb_map_controls"] = "";
    }

    if (empty($_POST["inside_event_gallery"])) {
        $_POST["inside_event_gallery"] = "";
    }



    if (empty($_POST["event_social_sharing"])) {
        $_POST["event_social_sharing"] = "";
    }

    if (empty($_POST["event_buy_now"])) {
        $_POST["event_buy_now"] = "";
    }

    if (empty($_POST["event_phone_no"])) {
        $_POST["event_phone_no"] = "";
    }


    if (empty($_POST["event_start_time"])) {
        $_POST["event_start_time"] = "";
    }

    if (empty($_POST["event_end_time"])) {
        $_POST["event_end_time"] = "";
    }

    if (empty($_POST["event_all_day"])) {
        $_POST["event_all_day"] = "";
    }

    if (empty($_POST["event_address"])) {
        $_POST["event_address"] = "";
    }

    if (empty($_POST["event_map"])) {
        $_POST["event_map"] = "";
    }
    if (empty($_POST["event_featured_box"])) {
        $_POST["event_featured_box"] = "";
    }



    $sxe = new SimpleXMLElement("<event></event>");

    $sxe->addChild('sub_title', $_POST['sub_title']);

    $sxe->addChild('inside_event_thumb_view', $_POST['inside_event_thumb_view']);

    $sxe->addChild('inside_event_featured_image_as_thumbnail', $_POST['inside_event_featured_image_as_thumbnail']);

    $sxe->addChild('inside_event_thumb_audio', $_POST['inside_event_thumb_audio']);

    $sxe->addChild('inside_event_thumb_video', $_POST['inside_event_thumb_video']);

    $sxe->addChild('inside_event_thumb_slider', $_POST['inside_event_thumb_slider']);

    $sxe->addChild('inside_event_thumb_slider_type', $_POST['inside_event_thumb_slider_type']);

    $sxe->addChild('inside_event_thumb_map_lat', $_POST['inside_event_thumb_map_lat']);

    $sxe->addChild('inside_event_thumb_map_lon', $_POST['inside_event_thumb_map_lon']);

    $sxe->addChild('inside_event_thumb_map_zoom', $_POST['inside_event_thumb_map_zoom']);

    $sxe->addChild('inside_event_thumb_map_address', $_POST['inside_event_thumb_map_address']);

    $sxe->addChild('inside_event_thumb_map_controls', $_POST['inside_event_thumb_map_controls']);

    $sxe->addChild('inside_event_gallery', $_POST["inside_event_gallery"]);

    $sxe->addChild('event_social_sharing', $_POST["event_social_sharing"]);

    $sxe->addChild('event_buy_now', $_POST["event_buy_now"]);

    $sxe->addChild('event_phone_no', $_POST["event_phone_no"]);


    $sxe->addChild('event_start_time', $_POST["event_start_time"]);

    $sxe->addChild('event_end_time', $_POST["event_end_time"]);

    $sxe->addChild('event_all_day', $_POST["event_all_day"]);

    $sxe->addChild('event_address', $_POST["event_address"]);

    $sxe->addChild('event_map', $_POST["event_map"]);
    $sxe->addChild('event_featured_box', $_POST["event_featured_box"]);


    $sxe = save_layout_xml($sxe);

    update_post_meta($post_id, 'cs_event_meta', $sxe->asXML());
}

// Get Google Fonts

function get_google_fonts() {

    $fonts = array("Abel", "Aclonica", "Acme", "Actor", "Advent Pro", "Aldrich", "Allerta", "Allerta Stencil", "Amaranth", "Andika", "Anonymous Pro", "Antic", "Anton", "Arimo", "Armata", "Asap", "Asul",
        "Basic", "Belleza", "Cabin", "Cabin Condensed", "Cagliostro", "Candal", "Cantarell", "Carme", "Chau Philomene One", "Chivo", "Coda Caption", "Comfortaa", "Convergence", "Cousine", "Cuprum", "Days One",
        "Didact Gothic", "Doppio One", "Dorsa", "Dosis", "Droid Sans", "Droid Sans Mono", "Duru Sans", "Economica", "Electrolize", "Exo", "Federo", "Francois One", "Fresca", "Galdeano", "Geo", "Gudea",
        "Hammersmith One", "Homenaje", "Imprima", "Inconsolata", "Inder", "Istok Web", "Jockey One", "Josefin Sans", "Jura", "Karla", "Krona One", "Lato", "Lekton", "Magra", "Mako", "Marmelad", "Marvel",
        "Maven Pro", "Metrophobic", "Michroma", "Molengo", "Montserrat", "Muli", "News Cycle", "Nobile", "Numans", "Nunito", "Open Sans", "Open Sans Condensed", "Orbitron", "Oswald", "Oxygen", "PT Mono",
        "PT Sans", "PT Sans Caption", "PT Sans Narrow", "Paytone One", "Philosopher", "Play", "Pontano Sans", "Port Lligat Sans", "Puritan", "Quantico", "Quattrocento Sans", "Questrial", "Quicksand", "Rationale",
        "Ropa Sans", "Rosario", "Ruda", "Ruluko", "Russo One", "Shanti", "Sigmar One", "Signika", "Signika Negative", "Six Caps", "Snippet", "Spinnaker", "Syncopate", "Telex", "Tenor Sans", "Ubuntu",
        "Ubuntu Condensed", "Ubuntu Mono", "Varela", "Varela Round", "Viga", "Voltaire", "Wire One", "Yanone Kaffeesatz", "Adamina", "Alegreya", "Alegreya SC", "Alice", "Alike", "Alike Angular", "Almendra",
        "Almendra SC", "Amethysta", "Andada", "Antic Didone", "Antic Slab", "Arapey", "Artifika", "Arvo", "Average", "Balthazar", "Belgrano", "Bentham", "Bevan", "Bitter", "Brawler", "Bree Serif", "Buenard",
        "Cambo", "Cantata One", "Cardo", "Caudex", "Copse", "Coustard", "Crete Round", "Crimson Text", "Cutive", "Della Respira", "Droid Serif", "EB Garamond", "Enriqueta", "Esteban", "Fanwood Text", "Fjord One",
        "Gentium Basic", "Gentium Book Basic", "Glegoo", "Goudy Bookletter 1911", "Habibi", "Holtwood One SC", "IM Fell DW Pica", "IM Fell DW Pica SC", "IM Fell Double Pica", "IM Fell Double Pica SC",
        "IM Fell English", "IM Fell English SC", "IM Fell French Canon", "IM Fell French Canon SC", "IM Fell Great Primer", "IM Fell Great Primer SC", "Inika", "Italiana", "Josefin Slab", "Judson", "Junge",
        "Kameron", "Kotta One", "Kreon", "Ledger", "Linden Hill", "Lora", "Lusitana", "Lustria", "Marko One", "Mate", "Mate SC", "Merriweather", "Montaga", "Neuton", "Noticia Text", "Old Standard TT", "Ovo",
        "PT Serif", "PT Serif Caption", "Petrona", "Playfair Display", "Podkova", "Poly", "Port Lligat Slab", "Prata", "Prociono", "Quattrocento", "Radley", "Rokkitt", "Rosarivo", "Simonetta", "Sorts Mill Goudy",
        "Stoke", "Tienne", "Tinos", "Trocchi", "Trykker", "Ultra", "Unna", "Vidaloka", "Volkhov", "Vollkorn", "Abril Fatface", "Aguafina Script", "Aladin", "Alex Brush", "Alfa Slab One", "Allan", "Allura",
        "Amatic SC", "Annie Use Your Telescope", "Arbutus", "Architects Daughter", "Arizonia", "Asset", "Astloch", "Atomic Age", "Aubrey", "Audiowide", "Averia Gruesa Libre", "Averia Libre", "Averia Sans Libre",
        "Averia Serif Libre", "Bad Script", "Bangers", "Baumans", "Berkshire Swash", "Bigshot One", "Bilbo", "Bilbo Swash Caps", "Black Ops One", "Bonbon", "Boogaloo", "Bowlby One", "Bowlby One SC",
        "Bubblegum Sans", "Buda", "Butcherman", "Butterfly Kids", "Cabin Sketch", "Caesar Dressing", "Calligraffitti", "Carter One", "Cedarville Cursive", "Ceviche One", "Changa One", "Chango", "Chelsea Market",
        "Cherry Cream Soda", "Chewy", "Chicle", "Coda", "Codystar", "Coming Soon", "Concert One", "Condiment", "Contrail One", "Cookie", "Corben", "Covered By Your Grace", "Crafty Girls", "Creepster", "Crushed",
        "Damion", "Dancing Script", "Dawning of a New Day", "Delius", "Delius Swash Caps", "Delius Unicase", "Devonshire", "Diplomata", "Diplomata SC", "Dr Sugiyama", "Dynalight", "Eater", "Emblema One",
        "Emilys Candy", "Engagement", "Erica One", "Euphoria Script", "Ewert", "Expletus Sans", "Fascinate", "Fascinate Inline", "Federant", "Felipa", "Flamenco", "Flavors", "Fondamento", "Fontdiner Swanky",
        "Forum", "Fredericka the Great", "Fredoka One", "Frijole", "Fugaz One", "Geostar", "Geostar Fill", "Germania One", "Give You Glory", "Glass Antiqua", "Gloria Hallelujah", "Goblin One", "Gochi Hand",
        "Gorditas", "Graduate", "Gravitas One", "Great Vibes", "Gruppo", "Handlee", "Happy Monkey", "Henny Penny", "Herr Von Muellerhoff", "Homemade Apple", "Iceberg", "Iceland", "Indie Flower", "Irish Grover",
        "Italianno", "Jim Nightshade", "Jolly Lodger", "Julee", "Just Another Hand", "Just Me Again Down Here", "Kaushan Script", "Kelly Slab", "Kenia", "Knewave", "Kranky", "Kristi", "La Belle Aurore",
        "Lancelot", "League Script", "Leckerli One", "Lemon", "Lilita One", "Limelight", "Lobster", "Lobster Two", "Londrina Outline", "Londrina Shadow", "Londrina Sketch", "Londrina Solid",
        "Love Ya Like A Sister", "Loved by the King", "Lovers Quarrel", "Luckiest Guy", "Macondo", "Macondo Swash Caps", "Maiden Orange", "Marck Script", "Meddon", "MedievalSharp", "Medula One", "Megrim",
        "Merienda One", "Metamorphous", "Miltonian", "Miltonian Tattoo", "Miniver", "Miss Fajardose", "Modern Antiqua", "Monofett", "Monoton", "Monsieur La Doulaise", "Montez", "Mountains of Christmas",
        "Mr Bedfort", "Mr Dafoe", "Mr De Haviland", "Mrs Saint Delafield", "Mrs Sheppards", "Mystery Quest", "Neucha", "Niconne", "Nixie One", "Norican", "Nosifer", "Nothing You Could Do", "Nova Cut",
        "Nova Flat", "Nova Mono", "Nova Oval", "Nova Round", "Nova Script", "Nova Slim", "Nova Square", "Oldenburg", "Oleo Script", "Original Surfer", "Over the Rainbow", "Overlock", "Overlock SC", "Pacifico",
        "Parisienne", "Passero One", "Passion One", "Patrick Hand", "Patua One", "Permanent Marker", "Piedra", "Pinyon Script", "Plaster", "Playball", "Poiret One", "Poller One", "Pompiere", "Press Start 2P",
        "Princess Sofia", "Prosto One", "Qwigley", "Raleway", "Rammetto One", "Rancho", "Redressed", "Reenie Beanie", "Revalia", "Ribeye", "Ribeye Marrow", "Righteous", "Rochester", "Rock Salt", "Rouge Script",
        "Ruge Boogie", "Ruslan Display", "Ruthie", "Sail", "Salsa", "Sancreek", "Sansita One", "Sarina", "Satisfy", "Schoolbell", "Seaweed Script", "Sevillana", "Shadows Into Light", "Shadows Into Light Two",
        "Share", "Shojumaru", "Short Stack", "Sirin Stencil", "Slackey", "Smokum", "Smythe", "Sniglet", "Sofia", "Sonsie One", "Special Elite", "Spicy Rice", "Spirax", "Squada One", "Stardos Stencil",
        "Stint Ultra Condensed", "Stint Ultra Expanded", "Sue Ellen Francisco", "Sunshiney", "Supermercado One", "Swanky and Moo Moo", "Tangerine", "The Girl Next Door", "Titan One", "Trade Winds", "Trochut",
        "Tulpen One", "Uncial Antiqua", "UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Unlock", "VT323", "Vast Shadow", "Vibur", "Voces", "Waiting for the Sunrise", "Wallpoet", "Walter Turncoat",
        "Wellfleet", "Yellowtail", "Yeseva One", "Yesteryear", "Zeyada");

    return $fonts;
}

//Countries Array
if (!function_exists('cs_get_countries')) {

    function cs_get_countries() {

        $get_countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan",
            "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "British Virgin Islands",
            "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China",
            "Colombia", "Comoros", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Democratic People's Republic of Korea", "Democratic Republic of the Congo", "Denmark", "Djibouti",
            "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "England", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "French Polynesia",
            "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong",
            "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan",
            "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi", "Malaysia",
            "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique",
            "Myanmar(Burma)", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Northern Ireland",
            "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico",
            "Qatar", "Republic of the Congo", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa",
            "San Marino", "Saudi Arabia", "Scotland", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
            "South Korea", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga",
            "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "US Virgin Islands", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay",
            "Uzbekistan", "Vanuatu", "Vatican", "Venezuela", "Vietnam", "Wales", "Yemen", "Zambia", "Zimbabwe");

        return $get_countries;
    }

}

// Default xml data save

function save_layout_xml($sxe) {

    if (empty($_POST['page_title']))
        $_POST['page_title'] = "";

    if (empty($_POST['cs_layout']))
        $_POST['cs_layout'] = "";

    if (empty($_POST['cs_sidebar_left']))
        $_POST['cs_sidebar_left'] = "";

    if (empty($_POST['cs_sidebar_right']))
        $_POST['cs_sidebar_right'] = "";

    $sxe->addChild('page_title', $_POST['page_title']);

    $sidebar_layout = $sxe->addChild('sidebar_layout');

    $sidebar_layout->addChild('cs_layout', $_POST["cs_layout"]);

    if ($_POST["cs_layout"] == "left") {

        $sidebar_layout->addChild('cs_sidebar_left', $_POST['cs_sidebar_left']);
    } else if ($_POST["cs_layout"] == "right") {

        $sidebar_layout->addChild('cs_sidebar_right', $_POST['cs_sidebar_right']);
    } else if ($_POST["cs_layout"] == "both_right" or $_POST["cs_layout"] == "both_left" or $_POST["cs_layout"] == "both") {

        $sidebar_layout->addChild('cs_sidebar_left', $_POST['cs_sidebar_left']);

        $sidebar_layout->addChild('cs_sidebar_right', $_POST['cs_sidebar_right']);
    }

    return $sxe;
}

// installing tables on theme activating start

global $pagenow;

// Theme default widgets activation

function cs_activate_widget() {

    $sidebars_widgets = get_option('sidebars_widgets');  //collect widget informations
    // ---- calendar widget setting---

    $calendar = array();

    $calendar[1] = array(
        "title" => 'Calendar'
    );

    $calendar['_multiwidget'] = '1';

    update_option('widget_calendar', $calendar);

    $calendar = get_option('widget_calendar');

    krsort($calendar);

    foreach ($calendar as $key1 => $val1) {

        $calendar_key = $key1;

        if (is_int($calendar_key)) {

            break;
        }
    }

    //---Blog Categories

    $categories = array();

    $categories[1] = array(
        "title" => '[em class="fa fa-list"][/em] Categories',
        "count" => 'checked'
    );



    $calendar['_multiwidget'] = '1';

    update_option('widget_categories', $categories);

    $categories = get_option('widget_categories');

    krsort($categories);

    foreach ($categories as $key1 => $val1) {

        $categories_key = $key1;

        if (is_int($categories_key)) {

            break;
        }
    }

    // ----upcoming menus with thumbnail widget setting---

    $upcoming_menus_widget = array();

    $upcoming_menus_widget[1] = array(
        "title" => 'Our Food',
        "get_post_slug" => 'kitchen',
        "showcount" => '4',
        "thumb" => 'true'
    );

    $recent_post_widget['_multiwidget'] = '1';

    update_option('widget_upcoming_menus', $upcoming_menus_widget);

    $upcoming_menus_widget = get_option('widget_upcoming_menus');

    krsort($upcoming_menus_widget);

    foreach ($upcoming_menus_widget as $key1 => $val1) {

        $upcoming_menus_widget_key = $key1;

        if (is_int($upcoming_menus_widget_key)) {

            break;
        }
    }

    // ----   recent post with thumbnail widget setting---

    $recent_post_widget = array();

    $recent_post_widget[1] = array(
        "title" => 'Latest Blogs',
        "select_category" => 'aidreform',
        "showcount" => '3',
        "thumb" => 'true'
    );

    $recent_post_widget['_multiwidget'] = '1';

    update_option('widget_recentposts', $recent_post_widget);

    $recent_post_widget = get_option('widget_recentposts');

    krsort($recent_post_widget);

    foreach ($recent_post_widget as $key1 => $val1) {

        $recent_post_widget_key = $key1;

        if (is_int($recent_post_widget_key)) {

            break;
        }
    }

    // ----   recent post without thumbnail widget setting---

    $recent_post_widget2 = array();

    $recent_post_widget2 = get_option('widget_recentposts');

    $recent_post_widget2[2] = array(
        "title" => '[em class="fa fa-hand-o-right"][/em] Latest Posts',
        "select_category" => 'aidreform',
        "showcount" => '2',
        "thumb" => 'true'
    );

    $recent_post_widget2['_multiwidget'] = '1';

    update_option('widget_recentposts', $recent_post_widget2);

    $recent_post_widget2 = get_option('widget_recentposts');

    krsort($recent_post_widget2);

    foreach ($recent_post_widget2 as $key1 => $val1) {

        $recent_post_widget_key2 = $key1;

        if (is_int($recent_post_widget_key2)) {

            break;
        }
    }

    // ----   recent event widget setting---

    $upcoming_events_widget = array();

    $upcoming_events_widget[1] = array(
        "title" => 'Upcoming Events',
        "get_post_slug" => 'social-events',
        "showcount" => '4',
    );

    $upcoming_events_widget['_multiwidget'] = '1';

    update_option('widget_upcoming_events', $upcoming_events_widget);

    $upcoming_events_widget = get_option('widget_upcoming_events');

    krsort($upcoming_events_widget);

    foreach ($upcoming_events_widget as $key1 => $val1) {

        $upcoming_events_widget_key = $key1;

        if (is_int($upcoming_events_widget_key)) {

            break;
        }
    }

    // ----   recent event countdown widget setting---

    $upcoming_events_countdown_widget = array();

    $upcoming_events_countdown_widget[1] = array(
        "title" => 'Upcoming Events',
        "get_post_slug" => 'festival',
        "showcount" => '1',
    );

    $upcoming_events_countdown_widget['_multiwidget'] = '1';

    update_option('widget_cs_upcomingevents_count', $upcoming_events_countdown_widget);

    $upcoming_events_countdown_widget = get_option('widget_cs_upcomingevents_count');

    krsort($upcoming_events_countdown_widget);

    foreach ($upcoming_events_countdown_widget as $key1 => $val1) {

        $upcoming_events_countdown_widget = $key1;

        if (is_int($upcoming_events_countdown_widget)) {

            break;
        }
    }

    // ---- tags widget setting---

    $tag_cloud = array();

    $tag_cloud[1] = array(
        "title" => 'Tags',
        "taxonomy" => 'category',
    );

    $tag_cloud['_multiwidget'] = '1';

    update_option('widget_tag_cloud', $tag_cloud);

    $tag_cloud = get_option('widget_tag_cloud');

    krsort($tag_cloud);

    foreach ($tag_cloud as $key1 => $val1) {

        $tag_cloud_key = $key1;

        if (is_int($tag_cloud_key)) {

            break;
        }
    }

    // --- text widget setting ---

    $text = array();

    $text[1] = array(
        'title' => '',
        'text' => '<a href="' . site_url() . '/"><img src="' . get_template_directory_uri() . '/images/img-wi1.jpg" alt="" /></a>',
    );

    $text['_multiwidget'] = '1';

    update_option('widget_text', $text);

    $text = get_option('widget_text');

    krsort($text);

    foreach ($text as $key1 => $val1) {

        $text_key = $key1;

        if (is_int($text_key)) {

            break;
        }
    }

    // --- text widget About Our Team setting ---

    $text2 = array();

    $text2 = get_option('widget_text');

    $text2[2] = array(
        'title' => '',
        'text' => '<div class="widget_banner"><figure>

							<a href="' . site_url() . '/"><img src="' . get_template_directory_uri() . '/images/img-wi1.jpg" alt="" height="193" /></a>

						</figure></div>',
    );

    $text2['_multiwidget'] = '1';

    update_option('widget_text', $text2);

    $text2 = get_option('widget_text');

    krsort($text2);

    foreach ($text2 as $key1 => $val1) {

        $text_key2 = $key1;

        if (is_int($text_key2)) {

            break;
        }
    }

    // --- text widget About Our Team setting ---

    $text3 = array();

    $text3 = get_option('widget_text');

    $text3[3] = array(
        'title' => '',
        'text' => '<div class="widget_banner"><figure>

							<a href="' . site_url() . '/"><img src="' . get_template_directory_uri() . '/images/img-wi1.jpg" alt="" height="193" /></a>

						</figure></div>',
    );

    $text3['_multiwidget'] = '1';

    update_option('widget_text', $text3);

    $text3 = get_option('widget_text');

    krsort($text3);

    foreach ($text3 as $key1 => $val1) {

        $text_key3 = $key1;

        if (is_int($text_key3)) {

            break;
        }
    }

    //----text widget for contact info----------

    $text4 = array();

    $text4 = get_option('widget_text');

    $text4[4] = array(
        'text' => '<div class="widget widget_text"> <header class="heading"><h2 class="heading-color section-title">Contact Info</h2></header>			<div class="textwidget"><div class="text_widget"><p>Whales bring darkness own was and earth open god very gathering were face created. Waters made under tree evening may our, above saying great beginning she hadd man gathered. Is not you are grass two creature, morning. Wherein image male would not.</p>

                    	<ul>

                        	<li><i class="icon-home"></i><span>Practical Components, Inc. 10762 Noel Street Los Alamitos, CA 90720 United States of Amarica</span></li>

                            <li><i class="icon-phone"></i>(00) 1-714-252-0010  /  +(00) 1-714-252-0026</li>

                            <li><i class="icon-mobile-phone"></i>+ (00) 1-714-252-0026</li>

                            <li><i class="icon-envelope"></i><a href="#" class="colrhover">info@praylove.com</a></li>

                        </ul>

                        <!-- Social Network Start -->

                        <div class="social-network">

                        	<a href="#" class="icon-facebook icon-5"></a>

                            <a href="#" class="icon-twitter icon-5"></a>

                            <a href="#" class="icon-google-plus icon-5"></a>

                            <a href="#" class="icon-rss icon-5"></a>

                            <a href="#" class="icon-instagram icon-5"></a>

                            <a href="#" class="icon-tumblr icon-5"></a>

                        </div></div>

                        </div>

					</div>',
    );

    $text4['_multiwidget'] = '1';

    update_option('widget_text', $text4);

    $text4 = get_option('widget_text');

    krsort($text4);

    foreach ($text4 as $key1 => $val1) {

        $text_key4 = $key1;

        if (is_int($text_key4)) {

            break;
        }
    }

    // --- gallery widget setting ---

    $cs_gallery = array();

    $cs_gallery[1] = array(
        'title' => '[em class="fa fa-picture-o"][/em] Our Photos',
        'get_names_gallery' => 'gallery',
        'showcount' => '12'
    );

    $cs_gallery['_multiwidget'] = '1';

    update_option('widget_cs_gallery', $cs_gallery);

    $cs_gallery = get_option('widget_cs_gallery');

    krsort($cs_gallery);

    foreach ($cs_gallery as $key1 => $val1) {

        $cs_gallery_key = $key1;

        if (is_int($cs_gallery_key)) {

            break;
        }
    }

    // ---- archive widget setting---

    $archives = array();

    $archives[1] = array(
        "title" => 'Archives',
        "count" => 'checked',
        "dropdown" => ''
    );

    $archives['_multiwidget'] = '1';

    update_option('widget_chimp_archives', $archives);

    $archives = get_option('widget_chimp_archives');

    krsort($archives);

    foreach ($archives as $key1 => $val1) {

        $archives_key = $key1;

        if (is_int($archives_key)) {

            break;
        }
    }



    // ---- search widget setting---		

    $search = array();

    $search[1] = array(
        "title" => '',
    );

    $search['_multiwidget'] = '1';

    update_option('widget_search', $search);

    $search = get_option('widget_search');

    krsort($search);

    foreach ($search as $key1 => $val1) {

        $search_key = $key1;

        if (is_int($search_key)) {

            break;
        }
    }

    // ---- twitter widget setting---

    $cs_twitter_widget = array();

    $cs_twitter_widget[1] = array(
        "title" => 'Twitter',
        "username" => "envato",
        "numoftweets" => "2",
    );

    $cs_twitter_widget['_multiwidget'] = '1';

    update_option('widget_twitter_widget', $cs_twitter_widget);

    $cs_twitter_widget = get_option('widget_twitter_widget');

    krsort($cs_twitter_widget);

    foreach ($cs_twitter_widget as $key1 => $val1) {

        $cs_twitter_widget_key = $key1;

        if (is_int($cs_twitter_widget_key)) {

            break;
        }
    }

    // --- facebook widget setting-----

    $facebook_module = array();

    $facebook_module[1] = array(
        "title" => 'facebook',
        "pageurl" => "https://www.facebook.com/envato",
        "showfaces" => "on",
        "likebox_height" => "265",
        "fb_bg_color" => "#F5F2F2",
    );

    $facebook_module['_multiwidget'] = '1';

    update_option('widget_facebook_module', $facebook_module);

    $facebook_module = get_option('widget_facebook_module');

    krsort($facebook_module);

    foreach ($facebook_module as $key1 => $val1) {

        $facebook_module_key = $key1;

        if (is_int($facebook_module_key)) {

            break;
        }
    }

    //----text widget for contact info----------

    $text5 = array();

    $text5 = get_option('widget_text');

    $text5[5] = array(
        'title' => 'Accordion',
        'text' => '[accordion]

			[accordion_item active="yes" icon="" title="Qualified Full-time Professional" accordion="accordion"]Qualified Full-time Professional Master Photographer Andrew Gransden photographs weddings, portraits, wildlife and nature, commercial and businesses across Scotland from Aberdeen to Inverness..[/accordion_item]

			[accordion_item title="Commercial and businesses across" accordion="accordion"]Qualified Full-time Professional Master Photographer Andrew Gransden photographs weddings, portraits, wildlife and nature, commercial and businesses across Scotland from Aberdeen to Inverness..[/accordion_item]

			[accordion_item title="Businesses across Scotland from" accordion="accordion"]Qualified Full-time Professional Master Photographer Andrew Gransden photographs weddings, portraits, wildlife and nature, commercial and businesses across Scotland from Aberdeen to Inverness..[/accordion_item]

			[/accordion]',
    );



    $text5['_multiwidget'] = '1';

    update_option('widget_text', $text5);

    $text5 = get_option('widget_text');

    krsort($text5);

    foreach ($text5 as $key1 => $val1) {

        $text_key5 = $key1;

        if (is_int($text_key5)) {

            break;
        }
    }

    //----text widget for contact info----------

    $text6 = array();

    $text6 = get_option('widget_text');

    $text6[6] = array(
        'title' => 'Toggle',
        'text' => '[toggle active="yes" title="Toggle Title 1"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac arcu aliquet sem varius interdum vel quis odio. Nulla adipiscing ipsum sit amet neque egestas sagittis.[/toggle]',
    );

    $text6['_multiwidget'] = '1';

    update_option('widget_text', $text6);

    $text6 = get_option('widget_text');

    krsort($text6);

    foreach ($text6 as $key1 => $val1) {

        $text_key6 = $key1;

        if (is_int($text_key6)) {

            break;
        }
    }

    //----text widget for footer----------

    $text7 = array();

    $text7 = get_option('widget_text');

    $text7[7] = array(
        'title' => '[em class="fa fa-edit"][/em] About Us',
        'text' => '<div class="widget_about_us">

                <p>A much mammoth because sedulously that in more regarding coaxingly...</p>

                <p>A much mammoth because sedulously that in more regarding coaxingly wallaby more ouch fluently saw rabbit talkatively tore less like about despite..</p>

                <a class="btn button-default bgcolr" href="">more detail</a>

            </div>',
    );

    $text7['_multiwidget'] = '1';

    update_option('widget_text', $text7);

    $text7 = get_option('widget_text');

    krsort($text7);

    foreach ($text7 as $key1 => $val1) {

        $text_key7 = $key1;

        if (is_int($text_key7)) {

            break;
        }
    }

    // Add widgets in sidebars

    $sidebars_widgets['Sidebar'] = array("search-$search_key", "categories-$categories_key", "recentposts-$recent_post_widget_key", "upcoming_events-$upcoming_events_widget_key", "cs_gallery-$cs_gallery_key", "chimp_archives-$archives_key");

    $sidebars_widgets['footer-widget'] = array("text-$text_key7", "categories-$categories_key", "cs_gallery-$cs_gallery_key", "recentposts-$recent_post_widget_key2");

    $sidebars_widgets['contact-widget'] = array("facebook_module-$facebook_module_key", "text-$text_key7", "twitter_widget-$cs_twitter_widget_key");

    $sidebars_widgets['home-widget'] = array("text-$text_key3", "text-$text_key2", "cs_upcomingevents_count-$upcoming_events_countdown_widget");

    $sidebars_widgets['event-detail'] = array("search-$search_key", "categories-$categories_key", "recentposts-$recent_post_widget_key", "upcoming_events-$upcoming_events_widget_key", "cs_gallery-$cs_gallery_key");

    $sidebars_widgets['shop'] = "";

    update_option('sidebars_widgets', $sidebars_widgets);  //save widget iformations
}

// Install data on theme activation


function cs_activation_data() {

    global $wpdb;

    $args = array(
        'style_sheet' => 'custom',
        'custom_color_scheme' => '#29688a',
        'banner_color_scheme' => '#29688a',
        'banner_color' => 'on',
        'layout_option' => 'wrapper',
        // Banner Backgorung Color
        'banner_bg_color' => '#29688a',
        // footer Color Settigs
        'header_styles' => 'header1',
        'default_header' => 'header1',
        // HEADER SETTINGS header_cart 
        'header_logo' => 'on',
        'header_slogan' => 'on',
        'header_languages' => 'on',
        'header_cart' => 'on',
        'header_top_menu' => 'on',
        'header_languages' => '',
        'header_social_icons' => 'on',
        'header_next_event' => 'our-event',
        'beadcrumbs_type' => 'breadcrumbs',
        'show_beadcrumbs' => 'on',
        'breadcrumb_text' => '<div class="breadcrumbs"><ul><li><a href="" style="background: #c74949;"><em class="fa fa-flag"></em> Mission</a></li><li><a href="" style="background: #7f9940;"><em class="fa fa-globe"></em>' . __('Causes', 'AidReform') . ' </a></li><li><a href="" style="background: #2f2f2f;"><em class="fa fa-money"></em> Donate</a></li></ul></div>',
        'announcement_title' => 'Announcement',
        'announcement_blog_category' => 'announcement',
        'announcement_no_posts' => '5',
        'bg_img' => '0',
        'bg_img_custom' => '',
        'bg_position' => 'center',
        'bg_repeat' => 'no-repeat',
        'bg_attach' => 'fixed',
        'pattern_img' => '0',
        'custome_pattern' => '',
        'bg_color' => '',
        'logo' => get_template_directory_uri() . '/images/logo.png',
        'logo_width' => '187',
        'logo_height' => '51',
        'header_sticky_menu' => 'on',
        'fav_icon' => get_template_directory_uri() . '/images/favicon.ico',
        'header_code' => '',
        'header_link_title' => '',
        'header_link_url' => '',
        'footer_bg_img' => get_template_directory_uri() . '/images/footer_bg.jpg',
        'footer_logo' => get_template_directory_uri() . '/images/footer-logo.png',
        'copyright' => '&copy;' . gmdate("Y") . " " . get_option("blogname") . " Wordpress All rights reserved.",
        'powered_by' => '<a href="#">Design by ChimpStudio</a>',
        'powered_icon' => '',
        'analytics' => '',
        'responsive' => 'on',
        'style_rtl' => '',
        'paypal_email' => 'paypal@chimp.com',
        'paypal_ipn_url' => get_template_directory_uri() . '/include/ipn.php',
        'paypal_currency' => 'USD',
        'paypal_currency_sign' => '$',
        // switchers
        'color_switcher' => '',
        'trans_switcher' => '',
        'show_slider' => '',
        'slider_name' => 'slider',
        'slider_type' => 'Revolution Slider',
        'show_partners' => 'none',
        'partners_title' => 'Our Partners',
        'partners_gallery' => 'our-clients',
        'show_posts' => '',
        'post_title' => '',
        'post_cat' => '',
        'all_cat' => array(),
        'sidebar' => array('sidebar-1', 'Sidebar', 'footer-widget', 'contact-widget', 'home-widget', 'shop', 'event-detail'),
        // slider setting
        'flex_effect' => 'fade',
        'flex_auto_play' => 'on',
        'flex_animation_speed' => '7000',
        'flex_pause_time' => '600',
        'slider_id' => htmlspecialchars('[rev_slider slider]'),
        'slider_view' => '',
        'social_net_title' => '',
        'social_net_icon_path' => array('', '', '', '', '', '', '', '', ''),
        'social_net_awesome' => array('fa-facebook', 'fa-google-plus', 'fa-linkedin', 'fa-pinterest', 'fa-twitter', 'fa-youtube', 'fa-tumblr', 'fa-instagram', ' fa-flickr'),
        //'social_net_color_input' => array( '#005992', '#2a99e1', '#927f46', '#d70d38', '#ff0000', '#009bff;', '#2a99e1', '#2a99e1', ' #2a99e1' ),
        'social_net_url' => array('Facebook URL', 'Google-plus URL', 'Linked-in URL', 'Pinterest URL', 'Twitter URL', 'Youtube URL', 'Tumblr URL', 'Instagram URL', 'Flickr URL'),
        'social_net_tooltip' => array('Facebook', 'Google-plus', 'Linked-in', 'Pinterest', 'Twitter', 'Youtube', 'Tumblr', 'Instagram', 'Flickr'),
        'facebook_share' => 'on',
        'twitter_share' => 'on',
        'linkedin_share' => 'on',
        'pinterest_share' => 'on',
        'tumblr_share' => 'on',
        'google_plus_share' => 'on',
        'cs_other_share' => 'on',
        'mailchimp_key' => '90f86a57314446ddbe87c57acc930ce8-us2',
        // tranlations
        'trans_event_location' => 'Location',
        'trans_event_pics' => 'Pics',
        'trans_event_days' => 'Days',
        'trans_event_hours' => 'Hours',
        'trans_event_minutes' => 'Minutes',
        'trans_event_secondes' => 'Seconds',
        'res_first_name' => 'First Name',
        'res_last_name' => 'Last Name',
        'trans_subject' => 'Subject',
        'trans_message' => 'Message',
        'trans_submit' => 'Submit',
        'cause_raised' => 'Raised',
        'cause_end_date' => 'End Date',
        'cause_goal' => 'Goal',
        'cause_donors' => 'Donors',
        'cause_donate' => 'Donate Now',
        'cause_donation' => 'Donation',
        'cause_status' => 'Closed',
        'trans_share_this_post' => 'Share Now',
        'trans_content_404' => "It seems we can not find what you are looking for.",
        'trans_featured' => 'Featured',
        'trans_read_more' => 'read more',
        'trans_follow_us' => 'Follow Us',
        'trans_buy_now' => 'Buy Now',
        // translation end
        'pagination' => 'Show Pagination',
        'record_per_page' => '5',
        'cs_layout' => '',
        'cs_sidebar_left' => '',
        'cs_sidebar_right' => '',
        'under-construction' => '',
        'showlogo' => 'on',
        'socialnetwork' => 'on',
        'under_construction_text' => '<h1 class="colr">OUR WEBSITE IS UNDERCONSTRUCTION</h1><p>We shall be here soon with a new website, Estimated Time Remaining</p>',
        'launch_date' => '2014-10-24',
        'consumer_key' => '',
        'consumer_secret' => '',
        'access_token' => '',
        'access_token_secret' => '',
    );

    /* Merge Heaser styles

     */

    update_option("cs_theme_option", $args);
    update_option("cs_theme_option_restore", $args);
}

// Admin scripts enqueue

function cs_admin_scripts_enqueue() {

    $template_path = get_template_directory_uri() . '/scripts/admin/media_upload.js';

    wp_enqueue_script('my-upload', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));

    wp_enqueue_script('custom_wp_admin_script', get_template_directory_uri() . '/scripts/admin/cs_functions.js');

    wp_enqueue_style('custom_wp_admin_style', get_template_directory_uri() . '/css/admin/admin-style.css', array('thickbox'));

    wp_enqueue_style('wp-color-picker');
}

// Backend functionality files



require_once (TEMPLATEPATH . '/include/event.php');

require_once (TEMPLATEPATH . '/include/slider.php');

require_once (TEMPLATEPATH . '/include/gallery.php');

require_once (TEMPLATEPATH . '/include/page_builder.php');

require_once (TEMPLATEPATH . '/include/post_meta.php');

require_once (TEMPLATEPATH . '/include/short_code.php');

require_once (TEMPLATEPATH . '/include/cs_cause.php');

require_once (TEMPLATEPATH . '/functions-theme.php');

require_once (TEMPLATEPATH . '/include/ical/iCalcreator.class.php');

require_once (TEMPLATEPATH . '/include/mailchimpapi/mailchimpapi.class.php');

require_once (TEMPLATEPATH . '/include/mailchimpapi/chimp_mc_plugin.class.php');



/////// Require Woocommerce///////



require_once (TEMPLATEPATH . '/include/config_woocommerce/config.php');

require_once (TEMPLATEPATH . '/include/config_woocommerce/product_meta.php');



/////////////////////////////////





if (current_user_can('administrator')) {

    // Addmin Menu CS Theme Option

    require_once (TEMPLATEPATH . '/include/theme_option.php');

    add_action('admin_menu', 'cs_theme');
    if (!function_exists('cs_theme')) {

        function cs_theme() {

            add_theme_page('CS Theme Option', __('CS Theme Option', 'AidReform'), 'read', 'cs_theme_option', 'theme_option');
            add_theme_page("Import Demo Data", __("Import Demo Data", "AidReform"), 'read', 'cs_demo_importer', 'cs_demo_importer');
        }

    }
}

// add twitter option in user profile

function cs_contact_options($contactoptions) {

    $contactoptions['twitter'] = 'Twitter';

    return $contactoptions;
}

// Template redirect in single Gallery and Slider page

function cs_slider_gallery_template_redirect() {

    if (get_post_type() == "cs_gallery" or get_post_type() == "cs_slider") {

        global $wp_query;

        $wp_query->set_404();

        status_header(404);

        get_template_part(404);
        exit();
    }
}

// enque style and scripts

function cs_front_scripts_enqueue() {

    global $cs_theme_option;

    if (!is_admin()) {

        wp_enqueue_style('style_css', get_stylesheet_uri());
        if (isset($cs_theme_option['color_switcher'])):
            if ($cs_theme_option['color_switcher'] == "on") {

                wp_enqueue_style('color-switcher_css', get_template_directory_uri() . '/css/color-switcher.css');
            }
        endif;
        wp_enqueue_script('jquery_flexslider_min_js', get_template_directory_uri() . '/scripts/frontend/jquery.flexslider-min.js', '', '', true);

        wp_enqueue_style('flexslider_css', get_template_directory_uri() . '/css/flexslider.css');
        wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css');

        wp_enqueue_style('font-awesome_css', get_template_directory_uri() . '/css/font-awesome.css');

        wp_enqueue_style('font-awesome-ie7_css', get_template_directory_uri() . '/css/font-awesome-ie7.css');

        wp_enqueue_style('widget_css', get_template_directory_uri() . '/css/widget.css');

        wp_enqueue_style('shortcode_css', get_template_directory_uri() . '/css/shortcode.css');

        // Register stylesheet
        // Apply IE conditionals

        $GLOBALS['wp_styles']->add_data('font-awesome-ie7_css', 'conditional', 'lte IE 9');

        // Enqueue stylesheet

        wp_enqueue_style('font-awesome-ie7_css');

        wp_enqueue_style('wp-mediaelement');

        wp_enqueue_script('jquery');

        wp_enqueue_script('wp-mediaelement');

        wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/scripts/frontend/bootstrap.min.js', '', '', true);

        wp_enqueue_script('modernizr_js', get_template_directory_uri() . '/scripts/frontend/modernizr.js', '', '', true);

        wp_enqueue_script('functions_js', get_template_directory_uri() . '/scripts/frontend/functions.js', '0', '', true);
        
        wp_enqueue_script('jquery_fitvids_js', get_template_directory_uri() . '/scripts/frontend/jquery.fitvids.js', '', '', true);

            if (is_rtl()) {

                wp_enqueue_style('rtl_css', get_template_directory_uri() . '/css/rtl.css');
            }
        if (isset($cs_theme_option['responsive'])):
            if ($cs_theme_option['responsive'] == "on") {

                echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">';

                wp_enqueue_style('responsive_css', get_template_directory_uri() . '/css/risponsive.css');
            }
        endif;
    }
}

// Gallery Script Enqueue

function cs_enqueue_gallery_style_script() {

    wp_enqueue_style('prettyPhoto_css', get_template_directory_uri() . '/css/prettyphoto.css');
    wp_enqueue_script('lightbox_js', get_template_directory_uri() . '/scripts/frontend/lightbox.js', '', '', true);
    wp_enqueue_script('prettyPhoto_js', get_template_directory_uri() . '/scripts/frontend/jquery.prettyphoto.js', '', '', true);
}

// Masonry Style and Script enqueue

function cs_enqueue_masonry_style_script() {

    wp_enqueue_style('masonry_css', get_template_directory_uri() . '/css/masonry.css');

    wp_enqueue_script('jquery.masonry_js', get_template_directory_uri() . '/scripts/frontend/jquery.masonry.min.js', '', '', true);
}

// Validation Script Enqueue

function cs_enqueue_validation_script() {

    wp_enqueue_script('jquery.validate.metadata_js', get_template_directory_uri() . '/scripts/admin/jquery.validate.metadata.js', '', '', true);

    wp_enqueue_script('jquery.validate_js', get_template_directory_uri() . '/scripts/admin/jquery.validate.js', '', '', true);
}

// Flexslider Script and style enqueue

function cs_enqueue_flexslider_script() {

    wp_enqueue_script('jquery_flexslider-min_js', get_template_directory_uri() . '/scripts/frontend/jquery.flexslider-min.js', '', '', true);
    wp_enqueue_style('flexsliders_css', get_template_directory_uri() . '/css/flexslider.css');
    wp_footer();
}

// Skills Circle Porgress bar script enqueue

function cs_circular_progress_script() {

    wp_enqueue_script('circular_progress_js', get_template_directory_uri() . '/scripts/frontend/circular-progress.js', '', '', true);
}

// Skills Circle Porgress bar script enqueue

function cs_scrolltofixed_script() {

    wp_enqueue_script('sticky_scrolltofixed_js', get_template_directory_uri() . '/scripts/frontend/jquery-scrolltofixed.js', '', '', true);
}

// Flexslider Script and style enqueue

function cs_enqueue_countdown_script() {

    wp_enqueue_script('jquery.countdown_js', get_template_directory_uri() . '/scripts/frontend/jquery.countdown.js', '', '', true);
}

// Favicon and header code in head tag//

function cs_header_settings() {

    global $cs_theme_option;
    ?>
    <?php
    if (isset($cs_theme_option['fav_icon'])) {
        ?>
        <link rel="shortcut icon" href="<?php echo $cs_theme_option['fav_icon'] ?>" />
    <?php } ?>

                 <!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->



    <?php
    if (isset($cs_theme_option['header_code'])):
        echo htmlspecialchars_decode($cs_theme_option['header_code']);
    endif;
}

// Favicon and header code in head tag//

function cs_footer_settings() {

    global $cs_theme_option;
    ?>

                  <!--[if lt IE 9]><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" /><![endif]-->

    <?php
    if (isset($cs_theme_option['analytics'])) {
        echo htmlspecialchars_decode($cs_theme_option['analytics']);
    }
}

// Header Section //

function cs_get_header() {

    global $post, $cs_theme_option, $cs_position;

    $cs_position = 'relative';



    $header_styles = 'header1';

    if (isset($header_styles) && !empty($header_styles)) {

        cs_custom_header_styles($header_styles);
    }
}

// Home page Slider //

function cs_get_home_slider() {

    global $cs_theme_option;

    if (isset($cs_theme_option['show_slider']) and $cs_theme_option['show_slider'] == "on") {

        if ($cs_theme_option['slider_type'] <> "Revolution Slider") {
            ?>

            <div id="banner">

                <?php
                if ($cs_theme_option['layout_option'] == "wrapper") {

                    $width = 0;

                    $height = 0;
                } else {

                    $width = 1170;

                    $height = 490;
                }
                $slider_slug = $cs_theme_option['slider_name'];
                if ($slider_slug <> '') {
                    $args = array(
                        'name' => $slider_slug,
                        'post_type' => 'cs_slider',
                        'post_status' => 'publish',
                        'showposts' => 1,
                    );

                    $get_posts = get_posts($args);

                    if ($get_posts) {

                        $slider_id = $get_posts[0]->ID;

                        if ($cs_theme_option['slider_type'] == 'Flex Slider') {

                            cs_flex_slider($width, $height, $slider_id);
                        }
                    } else {

                        $slider_id = '';

                        echo '<div class="box-small no-results-found heading-color"> <h5>';

                        _e("No results found.", 'AidReform');

                        echo ' </h5></div>';
                    }
                }
                ?>

            </div>

            <?php
        } else {

            echo do_shortcode(htmlspecialchars_decode($cs_theme_option['slider_id']));
        }
    }
}

// Page Sub header title and subtitle //

function get_subheader_title() {

    global $post, $wp_query;
    ;

    $show_title = true;

    $show_subtitle = true;

    $subtitle = '';

    $get_title = '';

    if (is_page() || is_single()) {

        if (is_page()) {

            $cs_xmlObject = cs_meta_page('cs_page_builder');

            if (isset($cs_xmlObject)) {

                if ($cs_xmlObject->page_title == "No") {

                    $show_title = false;
                }

                $subtitle = $cs_xmlObject->page_sub_title;
            }

            if (isset($show_title) && $show_title == true) {

                $get_title = '<h1 class="cs-page-title">' . substr(get_the_title(), 0, 40) . '</h1>';
            }
        } elseif (is_single()) {

            $post_type = get_post_type($post->ID);

            if ($post_type == "events") {

                $post_type = "cs_event_meta";
            } else {

                $post_type = "post";
            }

            $post_xml = get_post_meta($post->ID, $post_type, true);

            if ($post_xml <> "") {

                $cs_xmlObject = new SimpleXMLElement($post_xml);
            }

            if (isset($cs_xmlObject) && $cs_xmlObject->sub_title <> "") {

                $subtitle = $cs_xmlObject->sub_title;
            }

            $show_title = true;

            $show_subtitle = true;

            if (isset($show_title) && $show_title == true) {

                $get_title = '<h1 class="cs-page-title">' . get_the_title() . '</h1>';
            }
        }

        if (isset($show_title) && $show_title == true) {

            echo $get_title;
        }

        if (isset($subtitle) && $subtitle <> '') {
            echo '<p>' . $subtitle . '</p>';
        }
    } else {
        ?>

        <h1 class="cs-page-title"><?php cs_post_page_title(); ?></h1>



        <?php
    }
}

// like counter funtion

function cs_like_counter($post_id = '') {

    global $cs_theme_option, $post;

    $cs_like_counter = '';

    $cs_like_counter = get_post_meta(get_the_id(), "cs_like_counter", true);

    if (!isset($cs_like_counter) or empty($cs_like_counter))
        $cs_like_counter = 0;

    if (isset($_COOKIE["cs_like_counter" . get_the_id()]) and $cs_like_counter > 0) {

        echo '<a><i class="fa fa-heart">&nbsp;</i>' . $cs_like_counter . '</a>';
    } else {
        ?>

        <a href="javascript:cs_like_counter('<?php echo get_template_directory_uri() ?>',<?php echo get_the_id() ?>)" class="btnlike" id="like_this<?php echo get_the_id() ?>"><i class="fa fa-thumbs-o-up">&nbsp;</i><?php echo $cs_like_counter; ?></a>

        <a class="btnlike" id="like_counter<?php echo get_the_id() ?>" style="display:none;"><i class="fa fa-heart">&nbsp;</i></a>

        <div id="loading_div<?php echo get_the_id() ?>" style="display:none;"><img src="<?php echo get_template_directory_uri() ?>/images/ajax-loader.gif" /></div>

        <?php
    }
}

// hide figure tag on post list page

function cs_hide_figure($post_xml, $image_url = '') {

    if ($post_xml <> "") {

        $cs_xmlObject = new SimpleXMLElement($post_xml);

        $flag = 'true';

        if ($cs_xmlObject->post_thumb_audio == '' and $cs_xmlObject->post_thumb_view == "Audio") {

            $flag = 'false';
        } elseif ($cs_xmlObject->post_thumb_video == '' and $cs_xmlObject->post_thumb_view == "Video") {

            $flag = 'false';
        } elseif ($cs_xmlObject->post_thumb_slider == '' and $cs_xmlObject->post_thumb_view == "Slider") {

            $flag = 'false';
        } elseif ($image_url == '' and $cs_xmlObject->post_thumb_view == "Single Image") {

            $flag = 'false';
        } else {

            $flag = 'true';
        }
    }

    return $flag;
}

function cs_show_partner() {

    global $cs_theme_option;
    ?>

    <div class="element_size_100">

        <!-- Logo Slide Start -->

        <div class="our-sponcers">

    <?php if ($cs_theme_option['partners_title'] <> '') { ?>

                <!--<header class="heading">

                    <h2 class="heading-color section-title cs-heading-color"><?php //echo $cs_theme_option['partners_title']; ?></h2>

                </header>-->

    <?php } ?>

            <div class="container">

                <div id="container" class="fullwidth">

                    <div class="flexslider">



                        <ul class="slides lightbox">

                            <?php
                            $gal_album_db = '';

                            $gal_album_db = $cs_theme_option['partners_gallery'];

                            if ($gal_album_db <> "0") {

                                // galery slug to id start

                                $args = array(
                                    'name' => $gal_album_db,
                                    'post_type' => 'cs_gallery',
                                    'post_status' => 'publish',
                                    'showposts' => 1,
                                );

                                $get_posts = get_posts($args);

                                if ($get_posts) {

                                    $gal_album_db = $get_posts[0]->ID;
                                }

                                // galery slug to id end	

                                $cs_meta_gallery_options = get_post_meta($gal_album_db, "cs_meta_gallery_options", true);

                                // pagination start

                                if ($cs_meta_gallery_options <> "") {

                                    $xmlObject = new SimpleXMLElement($cs_meta_gallery_options);

                                    $limit_start = 0;

                                    $limit_end = count($xmlObject);

                                    //foreach ( $xmlObject->children() as $node ) {

                                    for ($i = $limit_start; $i < $limit_end; $i++) {

                                        $path = $xmlObject->gallery[$i]->path;

                                        $title = $xmlObject->gallery[$i]->title;

                                        $use_image_as = $xmlObject->gallery[$i]->use_image_as;

                                        $video_code = $xmlObject->gallery[$i]->video_code;

                                        $link_url = $xmlObject->gallery[$i]->link_url;

                                        //$image_url = wp_get_attachment_image_src($path, array(438,288),false);

                                        $image_url = cs_attachment_image_src($path, 150, 150);

                                        //$image_url_full = wp_get_attachment_image_src($path, 'full',false);

                                        $image_url_full = cs_attachment_image_src($path, 0, 0);
                                        ?>



                                        <li>

                                            <a href="<?php
                                            if ($use_image_as == 1)
                                                echo $video_code;
                                            elseif ($use_image_as == 2)
                                                echo $link_url;
                                            else
                                                echo $image_url_full;
                                            ?>" target="<?php
                                               if ($use_image_as == 2) {
                                                   echo '_blank';
                                               } else {
                                                   echo '_self';
                                               }
                                               ?>" data-rel="<?php
                                               if ($use_image_as == 1)
                                                   echo "prettyPhoto1";
                                               elseif ($use_image_as == 2)
                                                   echo "";
                                               else
                                                   echo "prettyPhoto[gallery2]"
                                                   ?>"><?php echo "<img src='" . $image_url . "' alt='" . $title . "' />"; ?></a>

                                        </li>

                                        <?php
                                    }
                                }
                            }else {

                                echo '<h4 class="heading-color">' . __('No results found.', 'AidReform') . '</h4></li>';
                            }
                            ?>



                        </ul>

                    </div>

                </div>

            </div>

    <?php
    cs_enqueue_flexslider_script();
    ?>

            <script type="text/javascript">

                jQuery(window).load(function () {

                    var speed = <?php echo $cs_theme_option['flex_animation_speed']; ?>;

                    var slidespeed = <?php echo $cs_theme_option['flex_pause_time']; ?>;

                    jQuery('#container .flexslider').flexslider({
                        animation: "carousel",
                        animationLoop: true,
                        itemWidth: 145,
                        itemMargin: 20

                    });

                    jQuery(".flex-direction-nav a.flex-prev").append('<em class="fa fa-angle-left"></em>')

                    jQuery(".flex-direction-nav a.flex-next").append('<em class="fa fa-angle-right"></em>')

                });

            </script>

            <!-- Logo Slide End -->

        </div>

    </div>

    <?php
}

add_action('template_redirect', 'cs_addthis_script_init_method');

function cs_addthis_script_init_method() {

    if (is_single() || is_page()) {

        wp_register_script('stef_addthis', 'http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e4412d954dccc64', ",", 'true');

        wp_enqueue_script('stef_addthis');
    }
}

// Front End Functions END

function html_widget_title($title) {

    //HTML tag opening/closing brackets

    $title = str_replace('[', '<', $title);

    $title = str_replace(']', '>', $title);

    $title = str_replace('[/', '</', $title);

    $title = str_replace('&quot;', '"', $title);



    //<strong></strong>

    $title = str_replace('s]', 'strong>', $title);

    //<em></em>

    $title = str_replace('em]', 'em>', $title);



    $title = str_replace('i]', 'i>', $title);



    return stripslashes($title);
}

add_filter('widget_title', 'html_widget_title');
// Shortcode Dropdown
add_action('media_buttons', 'cs_shortcode_dropdown', 11);

function cs_shortcode_dropdown() {
    $cs_shortcode_tags = array('accordion', 'button', 'column', 'code', 'dropcap', 'divider', 'heading', 'highlight', 'image-frame', 'icon', 'list', 'message_box', 'map', 'quote', 'testimonials', 'team', 'toogle', 'tabs', 'table', 'video', 'reservation');
    $cs_shortcodes_list = '';
    echo '&nbsp;<select id="sc_select"><option>Shortcode</option>';
    foreach ($cs_shortcode_tags as $val) {

        $cs_shortcodes_list .= "<option value='" . $val . "'>" . $val . "</option>";
    }
    echo $cs_shortcodes_list;
    echo '</select>';
}

add_action('admin_head', 'cs_button_js');

function cs_button_js() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            cs_shortocde_selection();
        });
    </script>
    <?php
}

// import demo xml file
if (!function_exists('cs_demo_importer')) {

    function cs_demo_importer() {
        global $cs_theme_option;
        ?>
        <div class="cs-demo-data">
            <h2>Import Demo Data</h2>
            <div class="inn-text">
                <p>Importing demo data helps to build site like the demo site by all means. It is the quickest way to setup theme. Following things happen when dummy data is imported;</p>
                <ul class="import-data">
                    <li>&#8226; All wordpress settings will remain same and intact.</li>
                    <li>&#8226; Posts, pages and dummy images shown in demo will be imported.</li>
                    <li>&#8226; Only dummy images will be imported as all demo images have copy right restriction.</li>
                    <li>&#8226; No existing posts, pages, categories, custom post types or any other data will be deleted or modified.</li>
                    <li>&#8226; To proceed, please click "Import Demo Data" and wait for a while.</li>
                </ul>
            </div>
            <form method="post">
                <input name="reset"  type="submit" value="Import Demo Data" id="submit_btn"/>
                <input type="hidden" name="demo" value="demo-data" />
            </form>
        </div>

        <?php
        if (isset($_REQUEST['demo']) && $_REQUEST['demo'] == 'demo-data') {

            require_once ABSPATH . 'wp-admin/includes/import.php';
            if (!defined('WP_LOAD_IMPORTERS'))
                define('WP_LOAD_IMPORTERS', true);
            $cs_demoimport_error = false;

            if (!class_exists('WP_Importer')) {
                $cs_import_class = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
                if (file_exists($cs_import_class)) {
                    require_once($cs_import_class);
                } else {
                    $cs_demoimport_error = true;
                }
            }

            if (!class_exists('WP_Import')) {
                $cs_import_class = get_template_directory() . '/include/importer/wordpress-importer.php';
                if (file_exists($cs_import_class))
                    require_once($cs_import_class);
                else
                    $cs_demoimport_error = true;
            }

            if ($cs_demoimport_error) {
                echo __('Error.', 'AidReform') . '</p>';
                die();
            } else {
                if (!is_file(get_template_directory() . '/include/importer/demo.xml')) {
                    echo '<p><strong>' . __('Sorry, there has been an error.', 'AidReform') . '</strong><br />';
                    echo __('The file does not exist, please try again.', 'AidReform') . '</p>';
                } else {

                    global $wpdb;
                    $theme_mod_val = array();
                    $term_exists = term_exists('main-menu', 'nav_menu');
                    if (!$term_exists) {
                        $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "terms` VALUES ('', 'Main Menu' , 'main-menu', '0'); ");
                        $insert_id = $wpdb->insert_id;
                        $theme_mod_val['main-menu'] = $insert_id;
                        $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "term_taxonomy` VALUES ('', '" . $insert_id . "' , 'nav_menu', '', '0', '0'); ");
                    } else
                        $theme_mod_val['main-menu'] = $term_exists['term_id'];

                    $term_exists = term_exists('top-menu', 'nav_menu');
                    if (!$term_exists) {
                        $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "terms` VALUES ('', 'Top Menu' , 'top-menu', '0'); ");
                        $insert_id = $wpdb->insert_id;
                        $theme_mod_val['top-menu'] = $insert_id;
                        $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "term_taxonomy` VALUES ('', '" . $insert_id . "' , 'nav_menu', '', '0', '0'); ");
                    } else
                        $theme_mod_val['top-menu'] = $term_exists['term_id'];

                    set_theme_mod('nav_menu_locations', $theme_mod_val);



                    $cs_demo_import = new WP_Import();
                    $cs_demo_import->fetch_attachments = true;
                    $cs_demo_import->import(get_template_directory() . '/include/importer/demo.xml');

                    // Menu Location
                    //$cs_theme_option = get_option('cs_theme_option');

                    $cs_theme_option['show_slider'] = 'on';
                    $cs_theme_option['slider_type'] = 'Flex Slider';
                    $cs_theme_option['slider_name'] = '6352';
                    $cs_theme_option['announcement_title'] = 'Announcement';
                    $cs_theme_option['announcement_blog_category'] = 'aidreform';
                    $cs_theme_option['announcement_no_posts'] = '5';
                    $cs_theme_option['partners_title'] = 'Our Partners';
                    $cs_theme_option['partners_gallery'] = 'our-clients';
                    $cs_theme_option['show_partners'] = 'home';
                    $cs_theme_option['layout_option'] = 'wrapper_boxed';


                    update_option("cs_theme_option", $cs_theme_option);

                    update_option('cs_import_data', 'success');

                    $home = get_page_by_title('Home');
                    if ($home <> '' && get_option('page_on_front') == "0") {
                        update_option('page_on_front', $home->ID);
                        update_option('show_on_front', 'page');
                        update_option('front_page_settings', '1');
                    }
                }
            }
        }
    }

}

function cs_clean_shortcode_data($content = '') {

    $content = htmlspecialchars(stripslashes($content));
    $content = str_replace('&', '', $content);
    $content = str_replace(array('quot;', 'amp;#8221;', 'amp;#8243;', '#8220;', 'amp;', 'lt;', 'gt;'), array('"', '"', '"', '"', '', '<', '>'), $content);

    return $content;
}

function cs_encode_html_tags($content = '') {

    $content = str_replace(array('<', '>', '/>', '</'), array('ls_then', 'gr_then', 'cls_then', 'cgr_then'), $content);

    return $content;
}

function cs_decode_html_tags($content = '') {

    $content = str_replace(array('ls_then', 'gr_then', 'cls_then', 'cgr_then', '<br>', '<br />'), array('<', '>', '/>', '</', '', ''), $content);

    return $content;
}

function cs_content_decode($content = '') {

    $content = htmlspecialchars(stripslashes($content));
    $content = str_replace('&', '', $content);
    $content = str_replace(array('quot;', 'amp;#8221;', 'amp;#8243;', '#8220;', 'amp;', 'lt;', 'gt;'), array('"', '"', '"', '"', '', '<', '>'), $content);

    return $content;
}

function cs_allow_special_char($input = '') {
    $output = $input;
    return $output;
}
