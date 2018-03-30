<div class="wrap about-wrap buddyapp">
    <?php sq_panel_header( 'welcome' ); ?>
    <div class="changelog">
        <div class="feature-section col three-col">
            <br>
            <div>
                <h3><span class="dashicons dashicons-admin-appearance"></span> <?php esc_html_e( "Getting started","buddyapp" );?></h3>
                <p>
                    <?php esc_html_e("Thanks for purchasing our theme. To begin please do the following:", "buddyapp"); ?><br>
                    <?php printf( wp_kses_data( __( '- Make sure to install our recommended <a href="%s" target="_blank"> Plugins</a>', 'buddyapp' ) ), admin_url('admin.php?page=install-required-plugins') );?><br>
                    <?php printf( wp_kses_data(__( '- Install <a href="%s target="_blank">Demo content</a>', 'buddyapp') ), admin_url('admin.php?page=kleo_import') ); ?>
                </p>

            </div>
            <div>
                <h3><span class="dashicons dashicons-sos"></span> <?php esc_html_e( "Reliable Support", "buddyapp"); ?></h3>
                <p>
                    <?php esc_html_e( "We are always happy to help and support our products in the best way possible. We have setup a support forum where you can report bugs if any, ask help... We’ll respond and work immediately.", "buddyapp" ); ?>
                </p>
                <a href="http://seventhqueen.com/support" target="_blank" class="button button-primary button-large"><?php esc_html_e( "Support Forums", "buddyapp");?></a>
            </div>
            <div>
                <h3><span class="dashicons dashicons-welcome-learn-more"></span> <?php esc_html_e( "Documentation", "buddyapp");?></h3>
                <p>
                    <?php esc_html_e( "You no longer need to be a professional developer or designer to create an awesome website. Our documentation and video tutorials are neat and clear and will help you to build your site easily!", "buddyapp" );?>
                </p>
                <a href="http://seventhqueen.com/support/documentation/buddyapp" target="_blank" class="button button-primary button-large"><?php esc_html_e( "Online Documentation", "buddyapp");?></a>
            </div>
            <?php if ( class_exists('Envato_WP_Toolkit') ) : ?>
            <div class="last-feature">
                <h3><span class="dashicons dashicons-rss"></span> <?php esc_html_e( "Automatic Updates", "buddyapp" );?></h3>
                <p>
                    <?php echo wp_kses_post( __( "You can receive automatic updates from Themeforest, where out theme is exclusively sold.<br>Just enter your Marketplace username and API key at the link below.", "buddyapp" ) );?>
                </p>
                <?php printf( wp_kses_data( __( '<a href="%s" target="_blank" class="button button-primary button-large">Setup updates</a>', 'buddyapp') ), admin_url('admin.php?page=envato-wordpress-toolkit'));?>
            </div>
            <?php else: ?>

                <div class="last-feature">
                    <h3><span class="dashicons dashicons-rss"></span> <?php esc_html_e("Automatic Updates are OFF", "buddyapp");?></h3>
                    <p>
                        <?php esc_html_e( "Automatic updates are disabled. Please enable Envato WordPress Toolkit plugin to receive automatic updates.", "buddyapp" );?>
                    </p>
                    <?php printf( wp_kses_data( __( '<a href="%s" target="_blank" class="button button-primary button-large">Enable auto updates</a>', 'buddyapp' ) ), admin_url('admin.php?page=install-required-plugins') );?>
                </div>

            <?php endif; ?>
        </div>
    </div>
    <div class="return-to-dashboard">
        <a href="http://seventhqueen.com" target="_blank">&copy; SeventhQueen</a>
    </div>
</div>