<div class="modal fade" id="modal-login-form" tabindex="-1" role="dialog" aria-labelledby="modal-login-form" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <h4 class="modal-title"><?php _e( 'Login', 'magzilla' )?></h4>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <p class="login-link mt10"><?php _e( 'Not an account yet?', 'magzilla' )?> <a href="#" data-toggle="modal" data-target="#modal-register-form" data-dismiss="modal"><?php _e( 'Register', 'magzilla' )?></a></p>
                    </div>
                </div>

                <form class="lwa-form clearfix" action="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" method="post">
                    
                    <div class="form-group">
                        <span class="lwa-status"></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" name="log" class="form-control" placeholder="Username">
                        </div><!-- input-group -->
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                            <input type="password" name="pwd" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <?php do_action('login_form'); ?>

                    <div class="checkbox">
                        <label>
                            <input name="rememberme" type="checkbox" class="lwa-rememberme" value="forever" /> <?php _e( 'Remember me', 'magzilla' )?>
                        </label>

                        <a class="pull-right" href="#" data-toggle="modal" data-target="#modal-reset-form" data-dismiss="modal"><?php _e( 'I forgot username and password', 'magzilla' ); ?></a>
                    </div>

                    <input type="submit" name="wp-submit" class="btn btn-block btn-theme" value="<?php esc_html_e('Login', 'magzilla'); ?>" />
                    <input type="hidden" name="lwa_profile_link" value="<?php echo esc_attr($lwa_data['profile_link']); ?>" />
                    <input type="hidden" name="login-with-ajax" value="login" />

                </form>

            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modal-reset-form" tabindex="-1" role="dialog" aria-labelledby="modal-reset-form" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h4 class="modal-title"><?php _e( 'Reset Password', 'magzilla' )?></h4>
                        <p class="login-link"><?php _e( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'magzilla' )?></p>
                    </div>
                </div>

                <form class="lwa-remember" action="<?php echo esc_attr(LoginWithAjax::$url_remember) ?>" method="post">
                    <span class="lwa-status"></span>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <?php $msg = __("Enter username or email", 'magzilla'); ?>
                            <input type="text" name="user_login" class="lwa-user-remember form-control" value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />
                            <?php do_action('lostpassword_form'); ?>
                        </div><!-- input-group -->
                    </div>
                    <input type="submit" value="<?php esc_attr_e("Get New Password", 'magzilla'); ?>" class="lwa-button-remember btn btn-block btn-theme" />
                    <input type="hidden" name="login-with-ajax" value="remember" />
                </form>
            </div>
        </div>
    </div>
</div>




<div class="modal fade lwa-register lwa-register-default" id="modal-register-form" tabindex="-1" role="dialog" aria-labelledby="modal-register-form" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <h4 class="modal-title"><?php _e( 'Sign up', 'magzilla' ); ?></h4>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <p class="login-link mt10"><?php _e( 'Already have an account?', 'magzilla' ); ?> <a href="#" data-toggle="modal" data-target="#modal-login-form" data-dismiss="modal"><?php _e( 'Login', 'magzilla' ); ?></a></p>
                    </div>
                </div>

                <form class="lwa-register-form" method="post" action="<?php echo esc_attr(LoginWithAjax::$url_register); ?>">
                    <div class="form-group">
                        <span class="lwa-status"></span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" class="form-control" name="user_login" placeholder="<?php _e( 'Username', 'magzilla' ); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                            <input type="text" class="form-control" name="user_email" placeholder="<?php _e( 'Email', 'magzilla' ); ?>">
                        </div>
                    </div>
                    <?php do_action('register_form'); ?>
                        <?php do_action('lwa_register_form'); ?>
                    
                    <input type="submit" name="wp-submit" class="btn btn-block btn-theme" value="<?php esc_html_e('Sign Up', 'magzilla'); ?>" />
                    <input type="hidden" name="login-with-ajax" value="register" />
                    
                </form>
            </div>
        </div>
    </div>
</div>