<?php
/**
 * User: cb-theme
 * Date: 23.10.13
 * Time: 13:25
 * cb-theme Admin Config Page Template
 */

/**
 * $tabs
 * array (tab title,icon (/inc/cb-admin/images/),file name without .php (/inc/cb-admin/tabs/),show function from file,link if nothing to show)
 */
$tabs = array(
    array(__('General Settings', 'cb-modello'), 'fa-dashboard', 'cb-general-page', 'show_cb_general_page'),
    array(__('Styles', 'cb-modello'), 'fa-adjust', 'cb-styles-page', 'show_cb_styles_page'),
    array(__('Headers and Menu', 'cb-modello'), 'fa-outdent', 'cb-headers-page', 'show_cb_headers_page'),
    array(__('Footer', 'cb-modello'), 'fa-caret-square-o-down', 'cb-footer-page', 'show_cb_footer_page'),
    array(__('Sidebars', 'cb-modello'), 'fa-th-list', 'cb-sidebars-page', 'show_cb_sidebars_page'),
   // array(__('Slider', 'cb-modello'), 'fa-youtube-play', 'cb-slider-page', 'show_cb_slider_page'),
    //array(__('Fullscreen Slider', 'cb-modello'), '5.png', 'cb-fullslider-page'),
   // array(__('Top Icons', 'cb-modello'), 'fa-plus-circle', 'cb-topicons-page', 'show_cb_topicons_page'),
    array(__('APIs', 'cb-modello'), 'fa-rocket', 'cb-api', 'show_cb_api_page'),
   // array(__('Notification Bar', 'cb-modello'), 'fa-flash', 'cb-bar', 'show_cb_bar_page'),
    array(__('Maintenance Mode', 'cb-modello'), 'fa-caret-square-o-down', 'cb-under-page', 'show_cb_under_page'),
    array(__('Demo Content', 'cb-modello'), 'fa-magic', 'cb-demo-page', 'show_cb_demo_page'),
    array(__('WooCommerce', 'cb-modello'), 'fa-shopping-cart', 'cb-woo', 'show_cb_woo')
);

$demos = array(
    'normal' => array('title' => 'normal content', 'link' => 'http://cb-theme.com/demo/modello', 'image' => 'http://cb-theme.com/demo/modello/wp-content/themes/cb-modello/screenshot-green.png', 'xml' => 'demo_content.xml', 'install' => '/inc/cb-install.php','widgets'=>'widgets.wie'),
    'black' => array('title' => 'black version', 'link' => 'http://cb-theme.com/demo/modello/black', 'image' => 'http://cb-theme.com/demo/modello/black/wp-content/themes/cb-modello/screenshot-black.png', 'xml' => 'demo_content_black.xml', 'install' => '/inc/cb-install-black.php','widgets'=>'widget_black.wie'),
    'gold' => array('title' => 'gold version', 'link' => 'http://cb-theme.com/demo/modello/gold', 'image' => 'http://cb-theme.com/demo/modello/gold/wp-content/themes/cb-modello/screenshot-gold.png', 'xml' => 'demo_content.xml', 'install' => '/inc/cb-install-gold.php','widgets'=>'widgets.wie')
);


if (function_exists('is_admin')) {

    if (is_admin()) {
        /**
         * add admin config page
         */
        add_action('admin_menu', 'add_admin_template');

        function add_admin_template()
        {

            global $my_admin_page;
            $my_admin_page = add_menu_page('Modello Framework Settings', 'Modello', 'manage_options', 'cb-admin', 'open_admin_template', WP_THEME_URL . '/img/favicon.ico', '58.8');


        }

        /* add css and js files*/
        add_action('admin_head', 'cb_admin_head');
        function cb_admin_head()
        {
            global $my_admin_page;
            $screen = get_current_screen();
            if ($screen->id != $my_admin_page)
                return;
            echo '<link href="' . get_template_directory_uri() . '/inc/assets/js/select2/select2.css" rel="stylesheet"/>';
            echo '<link rel="stylesheet" type="text/css" href="' . WP_THEME_URL . '/inc/assets/css/cb-admin.css">';
            echo '<link rel="stylesheet" type="text/css" href="' . WP_THEME_URL . '/inc/assets/css/cb-icons.css">';
            echo '<link rel="stylesheet" type="text/css" href="' . WP_THEME_URL . '/inc/assets/css/simple-slider.css">';
            echo '<link rel="stylesheet" type="text/css" href="' . WP_THEME_URL . '/inc/assets/css/jquery.datetimepicker.css">';

            echo '<script type="text/javascript" src="' . WP_THEME_URL . '/inc/assets/js/jquery.ddslick.min.js"></script>';
            echo '<script type="text/javascript" src="' . WP_THEME_URL . '/inc/assets/js/simple-slider.min.js"></script>';
            echo '<script type="text/javascript" src="' . WP_THEME_URL . '/inc/assets/js/jquery.datetimepicker.js"></script>';


            echo '<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet" type="text/css"/>';
            echo '<script src="' . get_template_directory_uri() . '/inc/assets/js/select2/select2.js"></script>
            <script>
            jQuery(document).ready(function() { jQuery(".tab-inside select").select2(); });
            </script>';

            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
            wp_enqueue_script('media-upload');
            wp_enqueue_media();
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('wp-color-picker');
            wp_enqueue_script('jquery-ui-spinner');
        }

        /* add js file with php variables*/
        add_action('admin_enqueue_scripts', 'cb_admin_js');

        function cb_admin_js()
        {
            global $my_admin_page;
            $screen = get_current_screen();
            if ($screen->id != $my_admin_page)
                return;
            $settings = array(
                'WP_THEME_URL' => WP_THEME_URL,
                'wait' => __("please wait", "cb-modello"),
                'saved' => __("settings saved", "cb-modello"),
                'notsaved' => __("settings could not be saved", "cb-modello"),
            );

            wp_register_script('cbAdminJs', WP_THEME_URL . '/inc/assets/js/cb-admin.js');
            wp_localize_script('cbAdminJs', 'settings', $settings); //pass any php settings to javascript
            wp_enqueue_script('cbAdminJs'); //load the JavaScript file

            wp_register_script('cbIcons', WP_THEME_URL . '/inc/assets/js/cb-icons.js');
            wp_localize_script('cbIcons', 'settings', $settings); //pass any php settings to javascript
            wp_enqueue_script('cbIcons'); //load the JavaScript file


            wp_enqueue_script('svg3', WP_THEME_URL . '/inc/assets/AnimatedSVGIcons/js/snap.svg-min.js', array('jquery'), '1.0', true);
            wp_enqueue_script('svg1', WP_THEME_URL . '/inc/assets/AnimatedSVGIcons/js/svgicons.js', array('jquery'), '1.0', true);
            wp_enqueue_script('svg2', WP_THEME_URL . '/inc/assets/AnimatedSVGIcons/js/svgicons-config.js', array('jquery'), '1.0', true);


        }

        /* load tabs files*/
        foreach ($tabs as $tab) {
            if (isset($tab[4])) continue;
            $path = get_template_directory() . '/inc/cb-admin/tabs/' . $tab[2] . '.php';
            if (file_exists($path)) {
                require_once($path);
            }
        }

    }
} else echo 'no cheatin!';


function open_admin_template()
{

    /* messages system*/


    $s = 'http://cb-theme.com/cb-modello.xml';
    $head = array_change_key_case(get_headers($s, TRUE));
    $message_size = $head['content-length'];

    $stored_message_size = get_option('cb5_message_size');
    if ($stored_message_size != $message_size) {
        update_option('cb5_message_size', $message_size);
        $array = json_decode(json_encode((array)simplexml_load_string(file_get_contents($s))), 1);
        update_option('cb5_message_content', $array);
    }

    $messages2 = get_option('cb5_message_content');
    $messages_read = get_option('cb5_message_read');
    if(is_array($messages_read)) $messages_read_size = sizeof($messages_read);
    else{
        $messages_read_size=0;
    }
    $messages = array();
    if (isset($messages2['message'])) {
        if (isset($messages2['message']['id']))
            $messages[] = $messages2['message'];
        else
            $messages = $messages2['message'];
    }
    $messages_size = sizeof($messages);

    $messages_unread = $messages_size - $messages_read_size;

    if ($messages_unread < 1) $messages_unread = '';
    ?>
    <style>
        .css-label {
            background-image: url(<?php echo WP_THEME_URL;?>/inc/cb-admin/images/check.png);
        }

        .cb-save {
            background-image: url(<?php echo WP_THEME_URL;?>/inc/cb-admin/images/bbg.png);
            background-position: left center;
            background-repeat: no-repeat;
        }
    </style>
    <div class="wrap">
    <a href="http://cb-theme.com" target="_blank"><img src="http://cb-theme.com/logo_large.png"
                                                       alt="cb-theme.com logo" class="our_logo"/></a>

    <div class="cl"></div>
    <div class="right-menu"><a href="http://cb-theme.com/demo/modello/documentation/"
                               target="_blank">Documentation</a>
        <a href="http://support.cb-theme.com" target="_blank">Support Platform</a> <a
            href="<?php echo WP_THEME_URL; ?>/docs/documentation.html#credits" target="_blank">Credits</a></div>
    <div class="cb_left_menu">

        <div class="logo">
            <h1>cb<span>-theme</span>

                <div class="cb-message mn">
                    <a id="cb-message-page"><i class="fa fa-envelope"></i>

                        <div
                            class="cb-message-count <?php if ($messages_unread < 1) echo 'none'; ?>"><?php echo $messages_unread; ?></div>
                </div>
                </a></h1>
        </div>

        <div class="mn">

            <?php
            global $tabs;
            $first = true;

            if (isset($_GET['tab'])) $first = false;

            foreach ($tabs as $tab) {
                if (isset($_GET['tab'])) if ($_GET['tab'] == $tab[2]) $first = true;
                echo '<a ' . (($first) ? 'class="sel"' : '') . ' id="' . $tab[2] . '" ' . (isset($tab[4]) ? 'href="' . $tab[4] . '" target="_blank"' : '') . '><i class="fa ' . $tab[1] . '" /></i>' . $tab[0] . ' <i class="chevron fa fa-chevron-right"></i></a>';
                $first = false;
            }
            ?>
        </div>


    </div>
    <div class="cb_right_content">
    <div id="poststuff" class="metabox-holder">
    <div>
    <div class="inside_right">
    <?php if (isset($_POST['action']) && $_POST['action'] == 'load_default') {

    $nonce = $_REQUEST['security'];
    if (!wp_verify_nonce($nonce, 'cb-modello')) {
        // This nonce is not valid.
        die('Security check');
    } else {
        // The nonce was valid.
        // Do stuff here.
        if (isset($demos[esc_attr(get_option('cb5_demo_version'))])) {
            require(get_template_directory() . $demos[esc_attr(get_option('cb5_demo_version'))]['install']);
        } else {
            require(get_template_directory() . '/inc/cb-install.php');
        }
    }


}
    if(isset($_GET['theme-update'])){
        if (!class_exists('Envato_WordPress_Theme_Upgrader')) include_once(get_template_directory() . '/inc/cb-lib/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');

        if(get_option('cb5_envato_user') && get_option('cb5_envato_key')){
         $upgrader = new Envato_WordPress_Theme_Upgrader( get_option('cb5_envato_user'), get_option('cb5_envato_key') );
            $result = $upgrader->check_for_theme_update('Modello');
        if($result->updated_themes_count>0){
            $upgrader->upgrade_theme();
        }

        }
    }

?>
    <div id="saved"
         style="position: fixed;top:23px;left:0;right:0;height:100%;display:none;z-index:999999;text-align:center;vertical-align:middle;"></div>
<?php
global $tabs;
$first = true;
if (isset($_GET['tab'])) $first = false;


foreach ($tabs as $tab) {

    if (isset($tab[4])) continue;
    if (isset($_GET['tab'])) if ($_GET['tab'] == $tab[2]) $first = true;
    echo '<div class="tab-inside" id="' . $tab[2] . '_content" ' . ((!$first) ? 'style="display:none;"' : '') . '>';
    $first = false;

    if (isset($tab[3])) {
        if (function_exists($tab[3])) call_user_func($tab[3]);
    }
    echo '</div>';
}
?>
    <div id="cb-message-page_content" class="tab-inside " style="display: none;">
        <h3>Messages from cb-theme</h3>

        <div class="tab_desc">Updates, new features</div>
        <div class="msg_con">

            <?php
            if(is_array($messages)){
            for ($i = $messages_size - 1; $i >= 0; $i--) {
                ?>
                <div class="pd5">
                    <div
                        class="message <?php if (in_array($messages[$i]['id'], $messages_read)) echo 'read'; ?>"
                        data-id="<?php echo $messages[$i]['id']; ?>">
                        <div class="date"><?php echo $messages[$i]['date']; ?></div>
                        <div class="title"><?php echo $messages[$i]['title']; ?></div>
                        <div class="description"><?php echo $messages[$i]['description']; ?></div>
                    </div>
                </div>
            <?php
            }
            }

            ?>
        </div>
    </div>
    <div style="clear:both"></div>
    </div>
    </div>
    </div><?php /*
    <form method="POST" action="<?php echo admin_url("admin.php?page=" . $_GET["page"]); ?>">
        <input type="hidden" name="action" value="load_default"/>
        <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>"/>
        <button type="submit" class="cb_button cb_load_default"
                onclick="return confirm('Are you sure you want to overwrite settings to default?')"><i
                class="fa fa-cogs"></i> Load default settings
        </button>
    </form> */?>
    </div>

</div>

<?php
}

/* global cb-admin  functions*/
add_action('wp_ajax_read_message', 'cb5_read_message');

function cb5_read_message()
{
    $messages_read = get_option('cb5_message_read');
    $messages_read[] = intval($_POST['id']);
    update_option('cb5_message_read', $messages_read);
    $messages = get_option('cb5_message_content');

    $messages_read = get_option('cb5_message_read');

    $messages = $messages['message'];
    $messages_size = sizeof($messages);
    $messages_unread = $messages_size - sizeof($messages_read);
    echo $messages_unread;
    die(); // this is required to return a proper result
}


