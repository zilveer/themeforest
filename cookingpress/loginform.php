<div id="login-register-password">

    <?php global $user_ID, $user_identity; get_currentuserinfo(); if (!$user_ID) { ?>
    <ul class="tabs-nav">
        <li class="active"><a href="#tab1_login"><?php _e('Login','cookingpress'); ?></a></li>
        <li><a href="#tab2_login"><?php _e('Register','cookingpress'); ?></a></li>
        <li><a href="#tab3_login"><?php _e('Lost your password?','cookingpress'); ?></a></li>
    </ul>
    <div class="tabs-container loginbox">
        <div id="tab1_login" class="tab-content">

            <?php
            if(isset($_GET['register']) ){ $register = $_GET['register']; }
            if(isset($_GET['reset'] )){ $reset = $_GET['reset']; }

            if (isset($register) && $register == true) { ?>

            <h3><?php _e('Success!','cookingpress'); ?></h3>
            <p><?php _e('Check your email for the password and then return to log in.','cookingpress'); ?></p>

            <?php } elseif ( isset($reset) && $reset == true ) { ?>

            <h3><?php _e('Success!','cookingpress'); ?></h3>
            <p><?php _e('Check your email to reset your password.','cookingpress'); ?></p>

            <?php } else { ?>

            <h3><?php _e('Have an account?','cookingpress'); ?></h3>
            <p><?php _e('You need to log in to add recipe.','cookingpress'); ?></p>

            <?php } ?>

            <?php wp_login_form(); ?>
        </div>
        <div id="tab2_login" class="tab-content">
            <h3><?php _e('Register for this site!','cookingpress'); ?></h3>
            <p><?php _e('Sign up now for the good stuff.','cookingpress'); ?></p>
            <form method="post" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="wp-user-form">
                <p class="login-username">
                    <label for="user_login"><?php _e('Username','cookingpress'); ?>: </label>
                    <input type="text" name="user_login" value="" size="20" id="user_login" tabindex="101" />
                </p>
                <p class="login-password">
                    <label for="user_email"><?php _e('Your Email','cookingpress'); ?>: </label>
                    <input type="text" name="user_email" value="" size="25" id="user_email" tabindex="102" />
                </p>
                <p class="login_fields">
                    <?php do_action('register_form'); ?>
                    <input type="submit" name="user-submit" value="<?php _e('Sign up!','cookingpress'); ?>" class="user-submit" tabindex="103" />
                    <?php if(isset($register) && $register == true) { echo '<p>Check your email for the password!</p>'; } ?>
                    <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?register=true" />
                    <input type="hidden" name="user-cookie" value="1" />
                </p>
            </form>
        </div>
        <div id="tab3_login" class="tab-content" >
            <h3><?php _e('Lost your password?','cookingpress'); ?></h3>
            <p><?php _e('Enter your username or email to reset your password.','cookingpress'); ?></p>
            <form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
                <p class="login-username">
                    <label for="user_login" class="hide"><?php _e('Username or Email','cookingpress'); ?>: </label>
                    <input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
                </p>
                <p class="login_fields">
                    <?php do_action('login_form', 'resetpass'); ?>
                    <input type="submit" name="user-submit" value="<?php _e('Reset my password','cookingpress'); ?>" class="user-submit" tabindex="1002" />
                    <?php if(isset($reset) && $reset == true) { _e('<p>A message will be sent to your email address.</p>','cookingpress');  } ?>
                    <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
                    <input type="hidden" name="user-cookie" value="1" />
                </p>
            </form>
        </div>
    </div>

    <?php } else { // is logged in ?>

    <div class="sidebox">
        <h3><?php _e('Welcome','cookingpress') ?>, <?php echo $user_identity; ?></h3>
        <div class="usericon">
            <?php global $userdata; get_currentuserinfo(); echo get_avatar($userdata->ID, 60); ?>
        </div>
        <div class="userinfo">
            <p><?php _e('You&rsquo;re logged in as','cookingpress'); ?> <strong><?php echo $user_identity; ?></strong></p>
            <p>
                <a href="<?php echo wp_logout_url('index.php'); ?>"><?php _e('Log out','cookingpress') ?></a> |
                <?php if (current_user_can('manage_options')) {
                    echo '<a href="' . admin_url() . '">' . __('Admin','cookingpress') . '</a>'; } else {
                        echo '<a href="' . admin_url() . 'profile.php">' . __('Profile','cookingpress') . '</a>'; } ?>
            </p>
        </div>
    </div>

    <?php } ?>

</div>
