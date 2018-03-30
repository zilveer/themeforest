<?php
 $rentify_option_data = rentify_option_data();
  if(isset($rentify_option_data['sb-login-option']) && $rentify_option_data['sb-login-option'] == 1) : ?>
  <?php $current_user = wp_get_current_user(); ?> 
  <?php if(is_user_logged_in()){ ?>
    <ul class="authentication">
      <li>
        <a href="<?php echo esc_url(home_url('/')); ?>" > <i class="fa fa-user"></i> <?php echo esc_attr($current_user->user_login ); ?></a>
        <div class="login-reg-popup">
          <ul class = "list-unstyled">
            <li><a href="<?php echo esc_url(home_url('/').'/wp-admin/profile.php'); ?>" > <i class="fa fa-edit"></i> <?php esc_html_e( '&nbsp;Profile &nbsp;' , 'rentify' ); ?></a>  </li>
            <li><a href="<?php echo esc_url(wp_logout_url( home_url('/') )); ?>" > <i class="fa fa-power-off"></i> <?php esc_html_e( 'Logout' , 'rentify' ); ?></a> </li>
          </ul>
        </div>
      </li>
    </ul> 
      
  <?php } else { ?>  


    <ul class="authentication">
      <li> <a href="#">Login</a>
        <div class="login-reg-popup">

          <form name="loginform" id="loginform" class="default-form" action="<?php echo esc_url(home_url('/').'/wp-login.php'); ?>" method="post">
              <input type="text" name="log" id="user_login"  value="" size="20" placeholder="User name">
              <input type="password" name="pwd" id="user_pass"  value="" size="20" placeholder="Password">
              <input type="submit" name="wp-submit" id="wp-submit" value = "Log In"  class="btn btn-primary">
              <input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url('/')); ?>">
              <input type="hidden" name="testcookie" value="1">

               <label for="rememberme"> 
                <input name="rememberme" type="checkbox" id="rememberme" value="forever"> <?php esc_html_e( 'Remember Me' , 'rentify' ); ?> 
               </label> 
          </form>
        </div>
      </li>

      <li><a href="#">Register</a>
        <div class="login-reg-popup">
            <form method="post" name="myForm">
                <input type="text"  name="uname" placeholder = "username"/>
                <input id="email" type="text" name="uemail" placeholder = "email" />
                <input type="password"  name="upass" placeholder = "password"/>
                <input type="submit" class="btn btn-primary" value = "Register Here"/>
            </form>
        </div>
      </li>
    </ul> 


  <?php } ?>


<?php endif; ?>
<!-- End Header-Login -->