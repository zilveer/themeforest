<?php

if ( is_user_logged_in() ) :
  do_action( 'bp_before_sidebar_me' ); ?>
  <div id="sidebar-me">
    <div id="bpavatar">
      <?php bp_loggedin_user_avatar( 'type=full' ); ?>
    </div>
    <ul>
      <li id="username"><a href="<?php bp_loggedin_user_link(); ?>"><?php bp_loggedin_user_fullname(); ?></a></li>
      <?php do_action('wplms_header_top_login'); ?>
      <li><a href="<?php echo bp_loggedin_user_domain() . BP_XPROFILE_SLUG ?>/" title="<?php _e('View profile','vibe'); ?>"><?php _e('View profile','vibe'); ?></a></li>
      <li id="vbplogout"><a href="<?php echo wp_logout_url( get_permalink() ); ?>" id="destroy-sessions" rel="nofollow" class="logout" title="<?php _e( 'Log Out','vibe' ); ?>"><i class="icon-close-off-2"></i> <?php _e('LOGOUT','vibe'); ?></a></li>
      <li id="admin_panel_icon"><?php if (current_user_can("edit_posts"))
           echo '<a href="'.vibe_site_url() .'wp-admin/" title="'.__('Access admin panel','vibe').'"><i class="icon-settings-1"></i></a>'; ?>
      </li>
    </ul> 
    <ul>
<?php
$loggedin_menu = array(
  'courses'=>array(
              'icon' => 'icon-book-open-1',
              'label' => __('Courses','vibe'),
              'link' => bp_loggedin_user_domain().BP_COURSE_SLUG
              ),
  'stats'=>array(
              'icon' => 'icon-analytics-chart-graph',
              'label' => __('Stats','vibe'),
              'link' => bp_loggedin_user_domain().BP_COURSE_SLUG.'/'.BP_COURSE_STATS_SLUG
              )
  );
if ( bp_is_active( 'messages' ) ){
  $loggedin_menu['messages']=array(
              'icon' => 'icon-letter-mail-1',
              'label' => __('Inbox','vibe').(messages_get_unread_count()?' <span>' . messages_get_unread_count() . '</span>':''),
              'link' => bp_loggedin_user_domain().BP_MESSAGES_SLUG
              );
  $n=vbp_current_user_notification_count();
  $loggedin_menu['notifications']=array(
              'icon' => 'icon-exclamation',
              'label' => __('Notifications','vibe').(($n)?' <span>'.$n.'</span>':''),
              'link' => bp_loggedin_user_domain().BP_NOTIFICATIONS_SLUG
              );
}
if ( bp_is_active( 'groups' ) ){
  $loggedin_menu['groups']=array(
              'icon' => 'icon-myspace-alt',
              'label' => __('Groups','vibe'),
              'link' => bp_loggedin_user_domain().BP_GROUPS_SLUG 
              );
}

$loggedin_menu['settings']=array(
              'icon' => 'icon-settings',
              'label' => __('Settings','vibe'),
              'link' => bp_loggedin_user_domain().BP_SETTINGS_SLUG
              );
$loggedin_menu = apply_filters('wplms_logged_in_top_menu',$loggedin_menu);
foreach($loggedin_menu as $item){
  echo '<li><a href="'.$item['link'].'"><i class="'.$item['icon'].'"></i>'.$item['label'].'</a></li>';
}
?>
    </ul>
  
  <?php
  do_action( 'bp_sidebar_me' ); ?>
  </div>
  <?php do_action( 'bp_after_sidebar_me' );

/***** If the user is not logged in, show the log form and account creation link *****/

else :

?>
<div id="wplogin-modal">
    <div class="md-content">
        <div id="login_register_form">
            <div class="col-md-6">
                <form name="form" name="login-form" class="form-validation" action="<?php echo apply_filters('wplms_login_widget_action',home_url( 'wp-login.php', 'login-post' )); ?>" method="post">
                    <h3><?php _e('Login','vibe'); ?></h3>
                      <div class="list-group list-group-sm">
                        <div class="list-group-item">
                          <label><?php _e('USERNAME','vibe'); ?></label>  
                          <input type="text" name="log" placeholder="<?php _e('Enter Username','vibe'); ?>" class="form-control no-border" required="" tabindex="0" aria-required="true" aria-invalid="true">
                        </div>
                        <div class="list-group-item">
                           <label><?php _e('PASSWORD','vibe'); ?></label>  
                           <input type="password" name="pwd" placeholder="<?php _e('Enter Password','vibe'); ?>" class="form-control no-border" required="" tabindex="0" aria-required="true" aria-invalid="true">
                        </div>
                      </div>
                      <div class="pull-right"><a href="<?php echo wp_lostpassword_url(); ?>"><?php _e('Forgot Password?','vibe'); ?></a></div>
                      <div class="checkbox">
                        <input type="checkbox" id="rememberme" name="rememberme" value="forever">
                        <label for="rememberme"><?php _e('Remember me','vibe'); ?></label>
                      </div>
                      <input type="submit" name="user-submit" class="btn btn-lg btn-primary btn-block" id="wp-submit" value="<?php _e('SIGN IN','vibe'); ?>" tabindex="100" />
                      <input type="hidden" name="user-cookie" value="1" />
                      <div class="line line-dashed"></div>
                      <?php do_action( 'login_form' ); //BruteProtect FIX ?>
                </form>
            </div>
            <div class="col-md-6">
                <h3><?php _e('Register','vibe'); ?></h3>
                <?php do_action('bp_social_connect'); 
                  $registration_link = apply_filters('wplms_buddypress_registration_link',site_url( BP_REGISTER_SLUG . '/' ));
                ?>
                <a href="<?php echo $registration_link; ?>" class="btn btn-lg btn-default btn-block" href="#" ><?php _e('Create an Account','vibe'); ?></a>
            </div>
        </div>
        <div id="forgot_password">
            <div class="col-md-6 col-md-offset-3">
                <div class="list-group list-group-sm">
                  <form role="form">
                    <div class="list-group-item form-group">
                      <label><?php _e('ENTER REGISTERED EMAIL ID','vibe'); ?></label>
                      <input type="email" name="user_email" id="user_email" class="form-field no-border" />
                      <?php wp_nonce_field('security','security'); ?>
                    </div>
                    <a id="forgot_password_submit" class="btn btn-lg btn-info btn-block" href="#" tabindex="0" aria-disabled="true"><?php _e('Retrieve Password','vibe'); ?></a>
                  </form>  
                    <a class="link"><?php _e('Back to login/register','vibe'); ?></a>
              </div>
            </div>  
        </div>    
    </div>
</div>
<div id="wplogin-modal-overlay">
    <a id="close-modal"></a>
</div>
<?php
endif;