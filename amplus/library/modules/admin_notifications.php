<?php

// this module is in charge of finding wrong stuff in WP or missing required configurations
// and dusplaying them in the admin
class BFIModuleAdminNotifications {
    public static function run() {
        add_action('admin_init', array(__CLASS__, 'checkStuff'));
    }    
    
    public static function checkStuff() {
        // check if there is any page published
        $loop = new WP_Query( array( 'post_type' => 'page', 'posts_per_page' => 1, 'post_status' => 'publish' ) );
        if (!$loop->have_posts()) {
            BFIAdminNotificationController::addNotification("You have not yet published any Pages. Publish one first so that you can select a page to be your frontpage in <a href='".get_admin_url()."admin.php?page=bfi_general'><strong>".BFI_THEMENAME." &gt; General</strong></a>.");
        } else {
            // check if the homepage has been set
            // if (bfi_get_option(BFI_FRONTPAGEOPTION) == "") {
            //                 $img = "<img src='".BFI_ADMINIMAGES."frontpage.jpg' style='float: right; border: 1px solid #999;' />";
            //                 BFIAdminNotificationController::addNotification($img."You have not yet assigned a frontpage to use in your site, please go to <a href='".get_admin_url()."admin.php?page=bfi_general'><strong>".BFI_THEMENAME." &gt; General</strong></a> and set a page to be your frontpage.");
            //             }
        }
        unset($loop);
        wp_reset_postdata();
        
        
        // check for theme navigation menus
        foreach (BFINavigationController::$loadedNavigationModels as $navigationModel) {
            $menu = wp_nav_menu(array('container' => '', 'theme_location' => $navigationModel->slug, 'fallback_cb' => '', 'echo' => false));
            if (!$menu) {
                BFIAdminNotificationController::addNotification("You have not yet assigned menu/s for the theme, head over to <a href='".get_admin_url()."nav-menus.php'><strong>Appearance > Menus</strong></a> to do this.");
                break;
            }
        }
        
            
        // checking for page media
        if (BFI_ENABLE_PAGEMEDIA) {
            $loop = new WP_Query( array( 'post_type' => BFIPagemediaModel::POST_TYPE, 'posts_per_page' => 1, 'post_status' => 'publish' ) );
            if (!$loop->have_posts()) {
                BFIAdminNotificationController::addNotification("You have not yet published any Page Media items. Publish one to put an image or slider in your pages! After creating a page media, don't forget to assign it in one of your pages. Go to <a href='".get_admin_url()."post-new.php?post_type=pagemedia'><strong>Page Media > Add New</strong></a> to create one now.");
            }
            unset($loop);
            wp_reset_postdata();
        }
        
        
        
        // checking for "Front page displays" = "Your latest posts" in Settings > Reading  
        // if (bfi_get_option('show_on_front') != "") {
            // if (strtolower(bfi_get_option('show_on_front')) != "posts") {
                // $img = "<img src='".BFI_ADMINIMAGES."reading.jpg' style='float: right; border: 1px solid #999;' />";
                // BFIAdminNotificationController::addNotification($img."Please go to <a href='".get_admin_url()."options-reading.php'><strong>Settings &gt; Reading</strong></a> and make sure that <strong>".__( 'Front page displays' )."</strong> is set to <strong>".__( 'Your latest posts' )."</strong>.");
            // }
        // }

        
        
        
        // checking for ~ in the URL
        if (preg_match('/\~/', home_url()) || preg_match('/\~/', site_url())) {
            $img = "<img src='".BFI_ADMINIMAGES."tilde.jpg' style='float: right; border: 1px solid #999;' />";
            BFIAdminNotificationController::addNotification($img.'Your site URL contains a <strong>tilde character "~"</strong>. Image manipulation will not work until you remove this character from your URL. Some images will not appear in your website. You can either move your site to a proper domain, or rename your URL without a tilde character.', 'warning');
        }
        
        
        
        
        // checking for bundled GD for Bfi_thumb support
        // if (!function_exists('imagecreatetruecolor') && !function_exists('imagerotate')) {
        //             BFIAdminNotificationController::addNotification("Your PHP installation does not have the <strong>Bundled GD Library</strong> installed which is required by the theme (specifically WP's Image Resizer) for performing image manipulations. Some images might not appear in your website. Please contact your web administrator regarding this issue.", 'warning');
        //         } else if (!function_exists('imagefilter') || !function_exists('imageconvolution')) {
        //             BFIAdminNotificationController::addNotification("Your PHP installation is not using the <strong><em>Bundled</em> GD Library</strong> which is required by the theme (specifically WP's Image Resizer) for performing image manipulations. Some images might not appear in your website. Please contact your web administrator regarding this issue.", 'warning');
        //         }
        
        
        
        // checking the upload path if writable
        if (!is_writable(BFI_UPLOADPATH)) {
            BFIAdminNotificationController::addNotification("The <strong>upload directory</strong> does not exist or is not writable, please fix this before continuing!", 'warning');
        }
    }
}

BFIModuleAdminNotifications::run();
