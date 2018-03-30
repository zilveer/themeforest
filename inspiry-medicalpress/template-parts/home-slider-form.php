<?php
global $theme_options;

/* check if appointment form related theme options are properly configured, as there is no point in displaying an incomplete form */
if (!empty($theme_options['appointment_form_email'])) {

    $make_appo = $appo_form = '';

    if( $theme_options['collapse_appointment_form'] ) {
        $make_appo = 'open';
        $appo_form = 'closed';
    }

    /* if user chose to display "Horizontal form over slider" then go ahead and display it */
    if ($theme_options['appointment_form_variation'] == '1') {
        ?>
        <div class="appointment clearfix">
            <div class="container">
                <div class="row">
                    <div class="<?php bc('3','4','6',''); ?> ">
                        <?php
                        if (!empty($theme_options['appointment_form_title'])) {
                            ?>
                            <span class="btn make-appoint <?php echo $make_appo; ?>"><?php echo $theme_options['appointment_form_title']; ?> <i class="fa fa-caret-down"></i></span>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="appointment-form clearfix animated <?php echo $appo_form; ?>">
                        <form class="clearfix" id="appointment_form_one" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post" >
                            <div class="<?php bc('3','3','6',''); ?> common">
                                <input type="text" name="name" id="app-name" class="required" placeholder="<?php _e('Name','framework'); ?>" />
                            </div>
                            <div class="<?php  bc('3','3','6',''); ?> common">
                                <input type="text" name="number" id="app-number" placeholder="<?php _e('Phone Number','framework'); ?>"/>
                            </div>
                            <div class="<?php bc('3','3','6',''); ?> common">
                                <input type="email" name="email" id="app-email" class="required email" placeholder="<?php _e('Email Address','framework'); ?>"/>
                            </div>
                            <div class="<?php bc('3','3','6',''); ?> common">
                                <input type="text" name="date" id="datepicker" placeholder="<?php _e('Appointment Date','framework'); ?>"/>
                            </div>
                            <div class="<?php bc_all('11'); ?> common">
                                <input type="text" name="message" id="app-message" class="required" placeholder="<?php _e('Message','framework'); ?>" />
                            </div>
                            <div class="<?php bc_all('1'); ?> common">
                                <input type="submit" name="Submit" class="btn" value="<?php _e('SEND','framework'); ?>"/>
                            </div>
                            <div class="<?php bc_all('12') ?>">
                                <input type="hidden" name="action" value="make_appointment">
                                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('request_appointment_nonce'); ?>" />
                                <img src="<?php echo get_template_directory_uri();?>/images/white-loader.gif" id="appointment-loader" alt="<?php _e('Loading...','framework'); ?>">
                                <div id="message-sent"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }else if( $theme_options['appointment_form_variation'] == '2' ) { /* if user chose to display "Vertical form over slider" then go ahead and display it */
        ?>
        <div class="appointment appointment-two clearfix">
            <div class="container">
                <div class="row">
                    <div class="<?php bc('4','4','5',''); echo  'col-lg-offset-8 col-md-offset-8 make-appoint-two'; ?> ">
                        <?php
                        if(!empty($theme_options['appointment_form_title'])){

                            ?>
                            <span class="btn make-appoint <?php echo $make_appo; ?>"><?php  echo $theme_options['appointment_form_title']; ?> <i class="fa fa-caret-down"></i></span>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="<?php  bc('4','4','12',''); echo 'col-lg-offset-8 col-md-offset-8 variation-two'; ?>">
                        <div class="appointment-form clearfix <?php echo $appo_form; ?>">
                            <form class="clearfix" id="appointment_form_two" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post" >
                                <div class="<?php bc_all('12'); ?> common">
                                    <input type="text" name="name" id="app-name" class="required" placeholder="<?php _e('Name','framework'); ?>" />
                                </div>
                                <div class="<?php  bc_all('12'); ?> common">
                                    <input type="text" name="number" id="app-number" class="" placeholder="<?php _e('Phone Number','framework'); ?>"/>
                                </div>
                                <div class="<?php bc_all('12'); ?> common">
                                    <input type="email" name="email" id="app-email" class="required email" placeholder="<?php _e('Email Address','framework'); ?>"/>
                                </div>
                                <div class="<?php   bc_all('12'); ?> common">
                                    <input type="text" name="date" id="datepicker" placeholder="<?php _e('Appointment Date','framework'); ?>"/>
                                </div>
                                <div class="<?php  bc_all('12'); ?> common">
                                    <textarea name="message" id="app-message" class="required" cols="50" rows="1" placeholder="<?php _e('Appointment Message','framework'); ?>"></textarea>
                                </div>
                                <?php
                                if( $theme_options['display_appointment_recaptcha'] ){
                                    ?>
                                    <div class="col-sm-12 common">
                                        <input type="hidden" name="recaptcha" value="true" />
                                        <?php
                                        /* Display recaptcha if enabled and configured from theme options */
                                        get_template_part('recaptcha/custom-recaptcha');
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="<?php   bc_all('12'); ?> common">
                                    <input type="submit" name="Submit" class="btn" value="<?php _e('SEND','framework'); ?>"/>
                                    <br/>
                                    <input type="hidden" name="action" value="make_appointment">
                                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('request_appointment_nonce'); ?>" />
                                    <img src="<?php echo get_template_directory_uri();?>/images/white-loader.gif" id="appointment-loader" alt="<?php _e('Loading...','framework'); ?>">
                                    <div id="message-sent"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
?>