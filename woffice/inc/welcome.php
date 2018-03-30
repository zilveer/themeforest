<?php
function woffice_theme_activation_redirect() {
    if ( isset( $_GET['activated'] ) ) {
        wp_redirect( admin_url( 'index.php?page=woffice-welcome' ) );
    }
}
add_action( 'admin_init', 'woffice_theme_activation_redirect' );

add_action('admin_menu', 'welcome_screen_pages');
function welcome_screen_pages() {
    add_dashboard_page(
        'Welcome to Woffice !',
        'Welcome to Woffice !',
        'read',
        'woffice-welcome',
        'woffice_welcome_screen_content'
    );
}

function woffice_welcome_screen_content() {
    ?>

    <div class="wrap woffice-welcome">

        <div class="woffice-welcome-pre-header">
            <h1>Welcome on Woffice, Congratulations !</h1>
        </div>


        <div class="woffice-welcome-box woffice-welcome-showcase">
            <div class="woffice-welcome-message">
                <p><strong>One more thing and you're ready to go !</strong> Woffice comes with several plugins that you need to install in order to make it work correctly.
                    Therefore, you can reach <a href="themes.php?page=tgmpa-install-plugins">this page</a> to install them all in one single click.
                    Thank you so much for your purchase, we really hope you'll enjoy the time we've spent on Woffice's development and feel the passion and love we share with this product.
                    If you have any feedback, idea or suggestion for us, don't hesitate a minute to get in touch with us</p>
            </div>
            <div class="woffice-welcome-version">
                <h1>W</h1>
                <h4>Version</h4>
                <h3><?php echo fw()->theme->manifest->get('version'); ?></h3>
            </div>
        </div>

        <div class="woffice-welcome-grid">
            <div class="woffice-welcome-row">
                <h2>Getting starting with Woffice</h2>
                <div class="woffice-welcome-col-4">
                    <h3>One Click Setup</h3>
                    <p>
                        Using the backup / demo install extension, you can import any demo with only one single click.
                        Choosing from Business, Community or School demo. Make sure you're on a new Wordpress setup,
                        because your content will be erased. Then you'll be able to change directly the content and adapt the dsign to your own brand.
                    </p>
                    <div class="text-right">
                        <a href="https://alkaweb.ticksy.com/article/5643/" class="woffice-welcome-btn" target="_blank">Read Tutorial</a>
                    </div>
                </div>
                <div class="woffice-welcome-col-4">
                    <h3>Setup the Auto Update</h3>
                    <p>
                        By registering your copy, you can enable the Woffice auto-update feature. Your Woffice copy will be updated
                        automatically whenever we release an update. As we're working on lot on this project, we release an update
                        every 1-2 weeks, adding new features and patches. Always with one goal in mind, making Woffice better.
                    </p>
                    <div class="text-right">
                        <a href="https://alkaweb.ticksy.com/article/4136/" class="woffice-welcome-btn" target="_blank">Read Tutorial</a>
                    </div>
                </div>
                <div class="woffice-welcome-col-4">
                    <h3>Customize Woffice</h3>
                    <p>
                        You can do basic customizations (CSS, JS) through the Theme Settings tabs. But if you want to edit Woffice's files
                        or make more changes, we highly recommend you to use the Woffice Child Theme included within the main package (from Themeforest).
                        Once enabled, you'll be able to update Woffice without loosing any of your previous changes.
                    </p>
                    <div class="text-right">
                        <a href="https://codex.wordpress.org/Child_Themes" class="woffice-welcome-btn" target="_blank">Read Tutorial</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="woffice-welcome-row">
                <h2>Use Woffice's environment</h2>
                <div class="woffice-welcome-col-4">
                    <h3>Online Changelog</h3>
                    <p>
                        As we're making a lot of improvements as well as adding your great ideas, you might need to see on what we've been working on in order
                        to improve your experience. The Online Changelog is here to sum up all our changes since day 0.
                    </p>
                    <div class="text-right">
                        <a href="https://woffice.io/changelog" class="woffice-welcome-btn" target="_blank">Online Changelog</a>
                    </div>
                </div>
                <div class="woffice-welcome-col-4">
                    <h3>Online Updater</h3>
                    <p>
                        With your purchase code / username, you can access all the released versions of Woffice from everywhere around the world.
                        It can also be used as a backup safety whenever you have an issue with the theme. Keep in mind that you always come back.
                    </p>
                    <div class="text-right">
                        <a href="https://woffice.io/updater/" class="woffice-welcome-btn" target="_blank">See the Updater</a>
                    </div>
                </div>
                <div class="woffice-welcome-col-4">
                    <h3>Online Documentation</h3>
                    <p>
                        The Woffice documentation is open from everywhere and every device. We're improving it on every update in order to make
                        Woffice's setup easier and easier throughout its development. The documentation is based on 80% of captioned images and useful links.
                    </p>
                    <div class="text-right">
                        <a href="https://woffice.io/documentation/" class="woffice-welcome-btn" target="_blank">Go to the Documentation</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="woffice-welcome-box">
            <h2>Need Help ? We're here !</h2>
            <p>If you need any help with Woffice, or if you find any bug. Feel free to contact us through a new ticket on our support helpdesk.
            We're here 7/7 and always happy to help.</p>
            <div class="text-right">
                <a href="https://alkaweb.ticksy.com/" class="woffice-welcome-btn" target="_blank">Open a new ticket</a>
            </div>
        </div>

    </div>
    <?php
}
add_action( 'admin_head', 'woffice_welcome_screen_remove_menus' );
function woffice_welcome_screen_remove_menus() {
    remove_submenu_page( 'index.php', 'woffice-welcome' );
}