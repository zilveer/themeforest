<?php
global $theme_options;

/* check if appointment form related theme options are properly configured, as there is no point in displaying an incomplete form */
if (!empty($theme_options['appointment_form_email'])) {

    if (!empty($theme_options['appointment_form_bg_img']) && (!empty($theme_options['appointment_form_bg_img']['url']))) {
        $appointment_form_bg_img = $theme_options['appointment_form_bg_img']['url'];
    } else {
        $appointment_form_bg_img = get_template_directory_uri() . '/images/appointment-bg.png'; // use the default one provided with the theme.
    }

    ?>
    <div class="appoint-var-three clearfix" style="background-image: url('<?php echo $appointment_form_bg_img; ?>'); ">
        <div class="container">
            <div class="row">
                <div class="<?php bc('8','8','12',''); ?>">
                    <?php
                    if ((!empty($theme_options['appointment_form_title'])) || (!empty($theme_options['appointment_form_desc']))) {
                        ?>
                        <div class="slogan-section animated fadeInUp clearfix">
                            <?php
                            if (!empty($theme_options['appointment_form_title'])) {
                                echo '<h3>' . $theme_options['appointment_form_title'] . '</h3>';
                            }
                            if (!empty($theme_options['appointment_form_desc'])) {
                                echo '<p>' . $theme_options['appointment_form_desc'] . '</p>';
                            }
                            ?>
                        </div>
                    <?php } ?>
                    <div class="appointment-form animated fadeInDown clearfix">
                        <form class="row" id="appointment_form_three" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post">
                                <div class="<?php bc_all('6'); ?>">
                                    <input type="text" name="name" id="app-name" class="required" placeholder="<?php _e('Name', 'framework'); ?>" title="<?php _e('* Please provide your name', 'framework'); ?>"/>
                                </div>
                                <div class=" <?php bc_all('6'); ?>">
                                    <input type="text" name="number" id="app-number" placeholder="<?php _e('Phone Number', 'framework'); ?>" title="<?php _e('* Please provide a valid phone number.', 'framework'); ?>"/>
                                </div>

                                <div class=" <?php bc_all('6'); ?>">
                                    <input type="email" name="email" id="app-email" class="required email" placeholder="<?php _e('Email Address', 'framework'); ?>" title="<?php _e('* Please provide a valid email address', 'framework'); ?>"/>
                                </div>
                                <div class=" <?php bc_all('6'); ?>">
                                    <input type="text" name="date" id="datepicker" placeholder="<?php _e('Appointment Date', 'framework'); ?>" title="<?php _e('* Please provide appointment date', 'framework'); ?>">
                                </div>

                                <div class=" <?php bc_all('12'); ?>">
                                    <textarea name="message" id="app-message" class="required" cols="50" rows="1" placeholder="<?php _e('Message', 'framework'); ?>" title="<?php _e('* Please provide your message', 'framework'); ?>"></textarea>
                                </div>

                                <?php
                                if( $theme_options['display_appointment_recaptcha'] ){
                                    ?>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="recaptcha" value="true" />
                                        <?php
                                        /* Display recaptcha if enabled and configured from theme options */
                                        get_template_part('recaptcha/custom-recaptcha');
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>

                                <div class=" <?php bc_all('12'); ?>">
                                    <input type="submit" name="Submit" class="btn" value="<?php _e('SEND', 'framework'); ?>"/>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" id="appointment-loader" alt="<?php _e('Loading...', 'framework'); ?>">
                                    <input type="hidden" name="action" value="make_appointment" />
                                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('request_appointment_nonce'); ?>" />
                                    <div id="message-sent"></div>
                                    <div id="error-container"></div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>