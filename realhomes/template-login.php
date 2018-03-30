<?php
/*
*  Template Name: Login & Register Template
*/

get_header();
?>

    <!-- Page Head -->
    <?php get_template_part("banners/default_page_banner"); ?>

    <!-- Content -->
    <div class="container contents single login-register">
        <div class="row">
            <div class="span12 main-wrap">

                <?php
                global $post;
                $title_display = get_post_meta( $post->ID, 'REAL_HOMES_page_title_display', true );
                if( $title_display != 'hide' ){
                    ?>
                    <h3><span><?php the_title(); ?></span></h3>
                    <?php
                }
                ?>

                <!-- Main Content -->
                <div class="main">

                    <div class="inner-wrapper">
                        <?php
                        if(!is_user_logged_in()){
                            ?>
							<div class="forms-simple">

                            <div class="row-fluid">

                                <div class="span6">

	                                <!-- LOGIN -->
                                    <p class="info-text"><?php _e('Already a Member? Log in here.','framework'); ?></p>
                                    <form id="login-form" class="login-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-option">
                                            <label for="username"><?php _e('Username','framework'); ?><span>*</span></label>
                                            <input id="username" name="log" type="text" class="required" title="<?php _e( '* Provide username!', 'framework'); ?>" autofocus required/>
                                        </div>
                                        <div class="form-option">
	                                        <label for="password"><?php _e('Password','framework'); ?><span>*</span></label>
	                                        <input id="password" name="pwd" type="password" class="required" title="<?php _e( '* Provide password!', 'framework'); ?>" required/>
                                        </div>
                                        <?php
                                        // nonce for security
                                        wp_nonce_field( 'inspiry-ajax-login-nonce', 'inspiry-secure-login' );
                                        ?>
                                        <input type="hidden" name="action" value="inspiry_ajax_login" />
                                        <input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url() ); ?>" />
                                        <input type="hidden" name="user-cookie" value="1" />
                                        <input type="submit" id="login-button" name="submit" value="<?php _e('Log in','framework');?>" class="real-btn login-btn" />
                                        <img id="login-loader" class="modal-loader" src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="Working...">
                                        <div>
	                                        <div id="login-message" class="modal-message"></div>
	                                        <div id="login-error" class="modal-error"></div>
                                        </div>
                                    </form>


	                                <!-- FORGOT PASSWORD -->
                                    <p class="forgot-password">
                                        <a class="toggle-forgot-form" href="#"><?php _e("Forgot password!",'framework')?></a>
                                    </p>
                                    <form action="<?php echo admin_url('admin-ajax.php'); ?>" id="forgot-form"  method="post" enctype="multipart/form-data">
	                                    <div class="form-option">
		                                    <label for="reset_username_or_email"><?php _e('Username or Email','framework'); ?><span>*</span></label>
		                                    <input id="reset_username_or_email" name="reset_username_or_email" type="text" class="required" title="<?php _e( '* Provide username or email!', 'framework'); ?>" required/>
	                                    </div>
	                                    <input type="hidden" name="action" value="inspiry_ajax_forgot" />
	                                    <input type="hidden" name="user-cookie" value="1" />
	                                    <input type="submit"  id="forgot-button" name="user-submit" value="<?php _e('Reset Password','framework');?>" class="real-btn register-btn" />
	                                    <img id="forgot-loader" class="modal-loader" src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="Working...">
	                                    <?php wp_nonce_field( 'inspiry-ajax-forgot-nonce', 'inspiry-secure-reset' ); ?>
	                                    <div>
		                                    <div id="forgot-message" class="modal-message"></div>
		                                    <div id="forgot-error" class="modal-error"></div>
	                                    </div>
                                    </form>

                                </div>

                                <div class="span6">
                                    <?php
                                    if ( get_option( 'users_can_register' ) ) {
                                        ?>
                                        <p class="info-text"><?php _e('Do not have an account? Register here','framework'); ?></p>
                                        <form action="<?php echo admin_url('admin-ajax.php'); ?>" id="register-form"  method="post" enctype="multipart/form-data">

                                            <div class="form-option">
	                                            <label for="register_username" class="hide"><?php _e('Username','framework'); ?><span>*</span></label>
	                                            <input id="register_username" name="register_username" type="text" class="required"
	                                                   title="<?php _e( '* Provide username!', 'framework'); ?>"
	                                                   placeholder="<?php _e( 'Username', 'framework' ); ?>" required/>
                                            </div>

                                            <div class="form-option">
	                                            <label for="register_email" class="hide"><?php _e('Email','framework'); ?><span>*</span></label>
	                                            <input id="register_email" name="register_email" type="text" class="email required"
	                                                   title="<?php _e( '* Provide valid email address!', 'framework'); ?>"
	                                                   placeholder="<?php _e( 'Email', 'framework' ); ?>" required/>
                                            </div>

                                            <div class="form-option">
	                                            <label for="register_pwd" class="hide"><?php _e( 'Password', 'framework' ); ?><span>*</span></label>
	                                            <input id="register_pwd" name="register_pwd" type="password"
	                                                   title="<?php _e( '* Provide your password', 'framework' ); ?>"
	                                                   placeholder="<?php _e( 'Password', 'framework' ); ?>" required/>
                                            </div>

                                            <div class="form-option">
	                                            <label for="register_pwd2" class="hide"><?php _e( 'Confirm Password', 'framework' ); ?><span>*</span></label>
	                                            <input id="register_pwd2" name="register_pwd2" type="password"
	                                                   title="<?php _e( '* Password should be same as above', 'framework' ); ?>"
	                                                   placeholder="<?php _e( 'Confirm Password', 'framework' ); ?>" required/>
                                            </div>

                                            <input type="hidden" name="user-cookie" value="1" />
                                            <input type="submit" id="register-button" name="user-submit" value="<?php _e('Register','framework');?>" class="real-btn register-btn" />
                                            <img id="register-loader" class="modal-loader" src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="Working...">
                                            <input type="hidden" name="action" value="inspiry_ajax_register" />
                                            <?php
                                            // nonce for security
                                            wp_nonce_field( 'inspiry-ajax-register-nonce', 'inspiry-secure-register' );
											?>
                                            <input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" />

                                            <div>
	                                            <div id="register-message" class="modal-message"></div>
	                                            <div id="register-error" class="modal-error"></div>
                                            </div>
                                        </form>
	                                    <?php
                                    } ?>
                                </div><!-- end of .span6 -->

                            </div><!-- end of .row-fluid -->

							</div><!-- end of .forms-simple -->
                            <?php
                        } else {
	                        echo '<h5>';
	                        _e( 'You are already logged in!', 'framework' );
	                        echo '</h5>';
	                        echo '<br>';
                        }
                        ?>
                    </div>

                </div><!-- End Main Content -->

            </div> <!-- End span12 -->

        </div><!-- End contents row -->

    </div><!-- End Content -->

<?php get_footer(); ?>