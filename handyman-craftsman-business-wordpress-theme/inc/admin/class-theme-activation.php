<?php
namespace Handyman\Admin;

if (!class_exists('\Handyman\Admin\Theme_Activation')) {

    /**
     * Class Theme_Activation
     * @package Handyman\Admin
     */
    class Theme_Activation
    {

        public static $single;


        public function __construct()
        {
            self::$single =& $this;
            $this->init();
        }


        /**
         *
         */
        public function init()
        {

            if (is_admin() && isset($_GET['activated']) && 'themes.php' == $GLOBALS['pagenow']) {
                wp_redirect(admin_url('themes.php?page=theme_activation_options'));
                exit;
            }

            add_action('admin_menu', array($this, 'themeActivationOptionsAddPage'), 50);
            add_action('admin_init', array($this, 'importData'));
        }


        public function themeActivationOptionsAddPage()
        {
            add_theme_page(__('Theme Activation', TL_DOMAIN),
                __('Theme Activation', TL_DOMAIN),
                'edit_theme_options',
                'theme_activation_options',
                array($this, 'themeActivationOptionsRenderPage'));
        }


        /**
         *
         */
        public function importData()
        {
            if (isset($_POST['handy-demo-data'])) {
                if (check_admin_referer('handy-demo-data-nonce')) {

                    if ($_REQUEST['create_blog_static_page'] === 'true') {

                        $blog = get_page_by_title(__('Blog', TL_DOMAIN));

                        if ($blog) {
                            update_option('page_for_posts', $blog->ID);
                            echo '<div id="message" class="updated"><p>Blog Page Updated!</p></div>';
                        }
                    }

                    if ($_REQUEST['change_permalink_structure'] === 'true') {

                        if (get_option('permalink_structure') !== '/%postname%/') {
                            global $wp_rewrite;
                            $wp_rewrite->set_permalink_structure('/%postname%/');
                            flush_rewrite_rules();
                            echo '<div id="message" class="updated"><p>Permalink structure refreshed!</p></div>';
                        } else {
                            echo '<div id="message" class="updated"><p>Permalink structure already set. Permalinks are not updated!</p></div>';
                        }
                    }
                }
            }
        }


        /**
         *
         */
        public function themeActivationOptionsRenderPage()
        {
            ?>
            <div class="wrap">
                <h2><?php printf(__('%s Theme Activation', TL_DOMAIN), wp_get_theme()); ?></h2>

                <div class="update-nag">
                    <?php _e('These settings are optional and should usually be used only on a fresh installation.', TL_DOMAIN); ?>
                </div>
                <p><?php _e('These videos cover installation process.', TL_DOMAIN); ?></p>

                <div style="float: left; width: 30%; padding-right: 25px;">
                    <p>Installing the theme, Plugins, Landing Page, Demo content!</p>
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/feEVHxlzH28" frameborder="0" allowfullscreen></iframe>
                </div>
                <div style="float: left; width: 30%; padding-right: 25px;">
                    <p>Main Navigation Setup</p>
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/-0lTzMWiX3s" frameborder="0" allowfullscreen></iframe>
                </div>

                <div style="float: left; width: 30%;">
                    <p>Landing Page Setup</p>
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/lEBQ4bUNbAQ" frameborder="0" allowfullscreen></iframe>
                </div>

                <div style="clear:both"></div>

                <br/>
                <hr/>
                <h3><?php _e('Installation Steps', TL_DOMAIN); ?></h3>

                <ol>
                    <li>
                        <p><strong><?php _e('Install required plugins', TL_DOMAIN); ?></strong></p>

                        <p>
                            <?php _e('First, enable required plugins. If you have not already done so, there should be a link "Install Required Plugins" in the top of the page. Follow that link and after you finish plugin installation return to this page to complete the installation process.',
                                TL_DOMAIN); ?></p>
                    </li>
                    <li>
                        <p><strong><?php _e('Import demo content', TL_DOMAIN); ?></strong></p>

                        <p><?php _e('Proceed only after all plugins are installed', TL_DOMAIN); ?></p>
                        <?php if (is_plugin_active('wordpress-importer/wordpress-importer.php')): ?>
                            <a href="<?php echo admin_url('import.php?import=wordpress'); ?>"><?php _e('Go to Wordpress Importer', TL_DOMAIN); ?></a>
                        <?php else: ?>
                            <?php _e('In order to import demo content you need to install and activate Wordpress Importer plugin', TL_DOMAIN); ?>
                        <?php endif; ?>
                    </li>
                    <li>
                        <p><strong><?php _e('Save Menus', TL_DOMAIN); ?></strong></p>
                        <a href="<?php echo admin_url('nav-menus.php'); ?>"><?php _e('Go to Wordpress Menus', TL_DOMAIN); ?></a>
                    </li>
                    <li>
                        <p><strong><?php _e('Permalink Structure/Front and Blog Page Settings', TL_DOMAIN); ?></strong></p>
                    </li>

                    <li>
                        <p><strong><?php _e('Homepage setup', TL_DOMAIN); ?></strong></p>
                        <a href="<?php echo admin_url('admin.php?page=layers-add-new-page') ?>"><?php _e('Follow this link to setup homepage', TL_DOMAIN); ?></a>
                    </li>
                </ol>

                <form method="post" action="<?php echo esc_attr($_SERVER['REQUEST_URI']) ?>">
                    <input type="hidden" name="handy-demo-data" value="1">
                    <?php wp_nonce_field('handy-demo-data-nonce'); ?>
                    <table class="form-table">

                        <tr valign="top">
                            <th scope="row"><?php _e('Blog page as static posts page', TL_DOMAIN); ?></th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text">
                                        <span><?php _e('Blog page as static posts page', TL_DOMAIN); ?></span>
                                    </legend>

                                    <input type="hidden" name="create_blog_static_page" value="false"/>
                                    <input type="checkbox" name="create_blog_static_page" value="true"/>

                                    <p class="description"><?php printf(__('Set Blog page to be the static posts page (recommended)', TL_DOMAIN)); ?></p>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Permalink structure', TL_DOMAIN); ?></th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text">
                                        <span><?php _e('Permalink structure', TL_DOMAIN); ?></span>
                                    </legend>

                                    <input type="hidden" name="change_permalink_structure" value="false"/>
                                    <input type="checkbox" name="change_permalink_structure"
                                           value="true"/>

                                    <p class="description"><?php printf(__('Change permalink structure to /&#37;postname&#37;/ (optional)', TL_DOMAIN)); ?></p>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
                <br/>
                <hr/>
                <br/>

                <h3>
                    <em><?php printf(__('After you complete demo data import, visit our %s or check %s page for details on how to customize the theme.', TL_DOMAIN),
                            '<a target="_blank" href="https://www.youtube.com/channel/UCd7eparRJR7QDJSJyGc-8aw">' . __('YouTube Channel', TL_DOMAIN) . '</a>',
                            '<a target="_blank" href="' . TL_BASE_URL_CHILD . '/docs/index.html" title="' . __('Documentation', TL_DOMAIN) . '">' . __('Documentation', TL_DOMAIN) . '</a>'); ?></em>
                </h3>
                <br/>
                <hr/>
                <br/>
            </div>
        <?php
        }
    }
}