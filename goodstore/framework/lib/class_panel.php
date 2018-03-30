<?php
/**
 * Description of theme admin panel
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
if (!class_exists('jwPanel')) {

    class jwPanel {

        public static $menu = null;
        public static $pages = null;
        public static $hooks = array();
        private $load = array('admin');  // admin,admin_options,frontend,

        function __construct() {
            global $pagenow;

            if (is_admin()) { // ajax must by accassable for all elements
                add_action('wp_ajax_jw_ajax_action', array('jwPanel', 'ajax_callback'));
                add_action('wp_ajax_nopriv_jw_ajax_action', array('jwPanel', 'ajax_callback'));
                add_action('admin_head', array(&$this, 'admin_message'));
                add_action('admin_menu', array(&$this, 'registerpage'));

                if ($pagenow == "themes.php" || $pagenow == "admin.php") { // todo pokud nechame menu v theme pak nech theme.php jinak zustava admin.php
                    self::menuAndHooks();

                    self::$pages = jwElements::renderPages(jwOpt::getRawOptions(), jwOpt::get_options());

                    add_filter('get_media_item_args', array(&$this, 'force_send'));
                    add_action("admin_print_styles-mlu", 'mlu_css', 0); // custom css 
                    add_action("admin_print_scripts-mlu", 'mlu_js', 0); // custom js
                }

                add_action('wp_dashboard_setup', array(&$this, 'jaw_add_dashboard_widgets'));
            }
        }

        //DASHBOARD WIDGET
        public function jaw_add_dashboard_widgets() {

            wp_add_dashboard_widget(
                    'jaw_dashboard_widget', // Widget slug.
                    '<i class="icon-support"></i> J&W Center', // Title.
                    array($this, 'jaw_dashboard_widget_function') // Display function.
            );
        }

        //Dashboard widget content
        public function jaw_dashboard_widget_function() {

            // Display whatever it is you want to show.
            echo "<img src='" . ADMIN_DIR . "assets/images/logo-jawtemplates.png'>";
            echo "<ul>";
            echo "<li><a href='" . "http://support.jawtemplates.com/goodstore/documentation/" . "' target='_blank'>Documentation</a></li>";
            echo "<li><a href='http://support.jawtemplates.com' target='_blank'>Support forum</a></li>";
            echo "<li><a href='http://support.jawtemplates.com/goodstore/web/' target='_blank'>Howto web</a></li>";
            echo "<li><a href='http://www.themeforest.net' target='_blank'>Themeforest comments</a></li>";
            echo "</ul>";
            echo "<div class='clear'></div>";
        }

        public static function menuAndHooks() {
            $menu = '';
            $hooks = array();
            $submenu = false;

            foreach (jwOpt::getPanelMenu() as $key => $value) {
                $hooks[] = $key;


                if (($value['submenu'] == 0 && $submenu == false)) {
                    $menu .= '<li rel="' . $key . '" class="' . $key . '"><a title="' . $value['name'] . '" href="#of-option-' . $key . '">' . $value['name'] . '</a></li>';
                } else if (($value['submenu'] == 1 && $submenu == true)) {
                    $menu .= '<li rel="' . $key . '" class="child ' . $key . '"><a title="' . $value['name'] . '" href="#of-option-' . $key . '">' . $value['name'] . '</a></li>';
                } elseif ($value['submenu'] == 1 && $submenu == false) { // begin
                    $menu .= '<li rel="' . $key . '" class="parent ' . $key . '">
                     <a title="' . $value['name'] . '" href="#of-option-' . $key . '">' . $value['name'] . '</a>';
                    $menu .='<ul class="submenu" style="display:none;">';
                    $submenu = true;
                } elseif ($value['submenu'] == -1 && $submenu == true) { // end
                    $menu .= '<li rel="' . $key . '" class="child ' . $key . '"><a title="' . $value['name'] . '" href="#of-option-' . $key . '">' . $value['name'] . '</a></li>';
                    $menu .='</ul>';
                    $menu .='</li>';
                    $submenu = false;
                }
            }

            if ($submenu == true)
                $menu .='</ul></li>';


            self::$menu = $menu;
            self::$hooks = $hooks;
        }

        /**
         * Forces insert into post
         */
        public function force_send($args) {
            $args['send'] = true;
            return $args;
        }

        /**
         * Adds the Thickbox CSS file and specific loading and button images to the header
         * on the pages where this function is called.
         */
        function mlu_css() {

            $_html = '';
            $_html .= '<link rel="stylesheet" href="' . get_option('siteurl') . '/' . WPINC . '/js/thickbox/thickbox.css" type="text/css" media="screen" />' . "\n";
            $_html .= '<script type="text/javascript">
		var tb_pathToImage = "' . get_option('siteurl') . '/' . WPINC . '/js/thickbox/loadingAnimation.gif";
	    var tb_closeImage = "' . get_option('siteurl') . '/' . WPINC . '/js/thickbox/tb-close.png";
	    </script>' . "\n";

            echo $_html;
        }

        function mlu_js() {

            // Registers custom scripts for the Media Library AJAX uploader.
        }


        // register admin page to wp menu
        public function registerPage() {
            //ENVATO nechce add_menu_page ale chce add_theme_page | add_options_page

            $menu = add_theme_page(THEMENAME, 'Theme Options', 'edit_theme_options', 'optionsframework', array(&$this, 'renderAdminPage'));

        }

        //todo
        public static function ajax_callback() {

            $nonce = $_POST['security'];

            $jwStyle = new jwStyle();

            if (!wp_verify_nonce($nonce, 'of_ajax_nonce'))
                die('security fail');

            //get options array from db
            $all = jwOpt::get_options();

            $save_type = $_POST['type'];

            //Uploads

            switch ($save_type) {
                case 'upload':
                    $clickedID = $_POST['data']; // Acts as the name
                    $filename = $_FILES[$clickedID];
                    $filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']);

                    $override['test_form'] = false;
                    $override['action'] = 'wp_handle_upload';
                    $uploaded_file = wp_handle_upload($filename, $override);

                    $upload_tracking[] = $clickedID;

                    //update $options array w/ image URL			  
                    $upload_image = $all; //preserve current data

                    $upload_image[$clickedID] = $uploaded_file['url'];
                    if (!isset($_POST['nosave'])) {
                        jwOpt::update_option($upload_image);
                        $jwStyle->get_static();
                        jwOpt::create_backup_files();
                    }

                    if (!empty($uploaded_file['error'])) {
                        die('Upload Error: ' . $uploaded_file['error']);
                    } else {
                        die($uploaded_file['url']);
                    } // Is the Response
                    break;

                case 'image_reset':
                    $id = $_POST['data']; // Acts as the name
                    $delete_image = $all; //preserve rest of data
                    $delete_image[$id] = ''; //update array key with empty value	 
                    jwOpt::update_option($delete_image);
                    $jwStyle->get_static();
                    jwOpt::create_backup_files();
                    break;

                case 'backup_options':
                    jwOpt::update_backups();
                    die('1');
                    break;

                case 'restore_options':
                    $data = jwOpt::get_backups(OPTIONS);
                    jwOpt::update_option($data);
                    $data = jwOpt::get_backups(CATEGORIES);
                    jwOpt::update_option($data, "category");
                    $data = jwOpt::get_backups(MENUS);
                    jwOpt::update_option($data, "menus");
                    $jwStyle->get_static();
                    jwOpt::create_backup_files();
                    die('1');
                    break;

                case 'import_options':
                    $data = $_POST['data'];
                    $target = $_POST['target'];
                    $data = unserialize(base64_decode($data)); //100% safe - ignore theme check nag
                    jwOpt::update_option($data, $target);
                    $jwStyle->get_static();
                    jwOpt::create_backup_files();
                    die('1');
                    break;

                case 'save':
                    $data = jwOpt::beforesave($_POST['data']);
                    jwOpt::update_option($data);
                    $jwStyle->get_static();
                    jwOpt::create_backup_files();
                    die('1');
                    break;

                case 'reset':
                    jwOpt::update_option(jwOpt::getDefaults());
                    $jwStyle->get_static();
                    jwOpt::create_backup_files();
                    die('1'); //options reset
                    break;

                case 'import_demo':
                    $import = new jwDemoImport($_POST['clickedFILE']);
                    break;
            }
        }

        public static function renderAdminPage() {


            $out = '';
            ob_start();
            ?>


            <div class="wrap adminoption" id="of_container" ng-controller="jaw_revo_editor">

                <h2 style="padding:0px"><?php //pro wordpress errory. Pokud se to smaze, errory rozbijeji panel, najdou si prvni h2 a zaradi pod nej error box       ?></h2>
                <div id="of-popup-save" class="of-save-popup">
                    <div class="of-save-save">Options Updated</div>
                </div>

                <div id="of-popup-reset" class="of-save-popup">
                    <div class="of-save-reset">Options Reset</div>
                </div>

                <div id="of-popup-fail" class="of-save-popup">
                    <div class="of-save-fail"><?php echo 'Error!' ?>
                        <div class="save_message"></div>
                    </div>

                </div>

                
                
                
                <span style="display: none;" id="hooks"><?php echo json_encode(self::$hooks); ?></span>
                <input type="hidden" id="reset" value="<?php if (isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>" />
                <input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />
                <form id="of_form" method="post" action="<?php echo esc_attr($_SERVER['REQUEST_URI']) ?>" enctype="multipart/form-data" >
                    <?php do_action('jaw_before_theme_options'); ?>
                    <div id="header">

                        <div class="logo">
                            <h2><?php echo THEMENAME; ?></h2>
                            <span><?php echo ('v' . THEMEVERSION); ?></span>
                        </div>

                        <div id="js-warning"><?php echo 'Warning- This options panel will not work properly without javascript!' ?></div>
                        <div class="icon-option"></div>
                        <div class="clear"></div>

                    </div>

                    <div id="info_bar">

                        <a>
                            <div id="expand_options" class="expand">Expand</div>
                        </a>

                        <img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />

                        <button id="of_save_2" type="button" class="button-primary of_save">
                            <?php echo 'Save All Changes' ?>
                        </button>

                    </div><!--.info_bar--> 	

                    <div id="main">

                        <div id="of-nav">
                            <ul>
                                <?php echo self::$menu ?>
                            </ul>
                        </div>

                        <div id="content">
                            <?php
                            echo self::$pages;
                            ?> 

                        </div>

                        <div class="clear"></div>

                    </div>

                    <div class="save_bar"> 

                        <img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
                        <button id ="of_save"  type="button" class="button-primary of_save"><?php echo 'Save All Changes'; ?></button>			

                        <button id ="of_reset" type="button" class="button submit-button reset-button" ><?php echo 'Options Reset'; ?></button>
                        <a href="javascript: launchHelp('<?php echo THEME_URI ?>/help/documentation/index.html');" type="button" class="button submit-button reset-button help-button"><?php echo 'Documentation'; ?></a>

                        <img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />

                    </div><!--.save_bar--> 
                    
                    <div class="jw-fixed-save">

                        <button class="of_save" type="button" class="button-primary">
                            <span class="ajax-loading-img jaw-spinit" style="display:none;"><i class="icon-spinner"></i></span>
                            <span class="ajax-loading-img-inverse" style="display:inline;"><i class="icon-disk"></i></span>
                            <div class="jaw-save-moretext"><span class="jaw-save-moretext-text">Save</span></div>
                        </button>
                    </div>

                </form>

                <div style="clear:both;"></div>

            </div><!--wrap-->

            <?php
            $out = ob_get_clean();


            echo $out;
        }

        public static function renderHelpPage() {
            echo '<div style="width:800px;">';
            require THEME_DIR . '/help/index.php';
            echo '</div>';
        }

        public function admin_message() {

            //Tweaked the message on theme activate
            ?>
            <script type="text/javascript">
                jQuery(function() {

                    var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=optionsframework'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
                    jQuery('.themes-php #message2').html(message);

                });
            </script>
            <?php
        }

        /**
         * Trigger code inside the Media Library popup.
         */
        public function mlu_insidepopup() {

            if (isset($_REQUEST['is_optionsframework']) && $_REQUEST['is_optionsframework'] == 'yes') {

                add_action('admin_head', array(&$this, 'mlu_js_popup'));
                add_filter('media_upload_tabs', array(&$this, 'mlu_modify_tabs'));
            }
        }

        public function mlu_js_popup() {

            $_of_title = $_REQUEST['of_title'];
            if (!$_of_title) {
                $_of_title = 'file';
            } // End IF Statement
            ?>
            <script type="text/javascript">
                jQuery(function($) {

                    jQuery.noConflict();

                    // Change the title of each tab to use the custom title text instead of "Media File".
                    $('h3.media-title').each(function() {
                        var current_title = $(this).html();
                        var new_title = current_title.replace('media file', '<?php echo $_of_title; ?>');
                        $(this).html(new_title);

                    });

                    // Change the text of the "Insert into Post" buttons to read "Use this File".
                    $('.savesend input.button[value*="Insert into Post"], .media-item #go_button').attr('value', 'Use this File');

                    // Hide the "Insert Gallery" settings box on the "Gallery" tab.
                    $('div#gallery-settings').hide();

                    // Preserve the "is_optionsframework" parameter on the "delete" confirmation button.
                    $('.savesend a.del-link').click(function() {

                        var continueButton = $(this).next('.del-attachment').children('a.button[id*="del"]');
                        var continueHref = continueButton.attr('href');
                        continueHref = continueHref + '&is_optionsframework=yes';
                        continueButton.attr('href', continueHref);

                    });

                });
            </script>
            <?php
        }

        /**
         * Triggered inside the Media Library popup to modify the title of the "Gallery" tab.
         */
        public function mlu_modify_tabs($tabs) {
            $tabs['gallery'] = str_replace('Gallery', 'Previously Uploaded', $tabs['gallery']);
            return $tabs;
        }

        // Goodstore Welcome Page
        public static function jaw_welcome_screen() {

            // get changelog
            $version = str_replace('.', '_', jaw_get_theme_version());

            $url = 'http://support.jawtemplates.com/updates/goodstore/details/content/ch_' . $version . '.php';           
            $remote = wp_remote_get($url);
            if ($remote['response']['code'] == 200) {
                $change_log = wp_remote_retrieve_body($remote);
            } else {
                $change_log = 'Not available';
            }
            ?>

            <div id="jaw-goodstore-wrapper">

                <div id="jaw-goodstore-header">

                    <div id="jaw-goodstore-thumb">

                        <img src="https://d2mdw063ttlqtq.cloudfront.net/files/86554779/Thumbnail.png" />
                    </div>
                    <div id="jaw-goodstore-welcome-text">

                        <h1>Welcome to GoodStore Overview Page</h1>
                    </div>

                    <p>So many thanks that you bought our GoodStore template!</p>
                    <p style="padding-bottom: 5px;">If you have some problems or issues please feel free to ask us! You can use some of the links below.</p>
                </div>

                <div id="jaw-goodstore-guide-buttons">

                    <div id="jaw-goodstore-links">

                        <div class="link_to_doc">

                            <a href="http://support.jawtemplates.com/goodstore/documentation/"><input type="submit" value="Documentation" class="link_btn"></a>
                        </div>
                        <div class="link_to_vid">

                            <a href="http://support.jawtemplates.com/goodstore/web/"><input type="submit" value="Video Tutorials" class="link_btn"></a>
                        </div>
                        <div class="link_to_for">

                            <a href="http://support.jawtemplates.com/"><input type="submit" value="Support Forum" class="link_btn"></a>
                        </div>
                        <div class="link_to_faq">

                            <a href="http://themeforest.net/item/goodstore-woocommerce-responsive-theme/7314327/support"><input type="submit" value="FAQ" class="link_btn"></a>
                        </div>
                    </div>
                </div>

                <div id="jaw-goodstore-changelog">

                    <h2>New Features</h2>

                    <?php echo $change_log; ?>
                </div>

                <div id="jaw-goodstore-footer">

                    <p>
                        <a href="http://themeforest.net/user/jawtemplates/portfolio/">Themeforest Portoflio</a> |
                        <a href="http://codecanyon.net/user/jawtemplates/portfolio">Codecanyon Portoflio</a> |
                        <a href="mailto:jaw@jawtemplates.com">Contact us</a>
                    </p>
                </div>

            </div>
            <?php
        }

    }

}
