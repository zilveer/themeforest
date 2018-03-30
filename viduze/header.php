<!DOCTYPE HTML>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->

<html <?php language_attributes(); ?>>

<!--<![endif]-->

<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title>
<?php bloginfo('name'); ?>
<?php wp_title(); ?>
</title>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php 
			$cp_favicon = get_option(THEME_NAME_S.'_favicon_image');
			    if(!empty  ($cp_favicon)) {
				   $cp_favicon = wp_get_attachment_image_src($cp_favicon, 'full');
				   echo '<link rel="shortcut icon" href="' . $cp_favicon[0] . '" type="image/x-icon" />';
			     }	 
?>

       
      <!--WRAPPER START-->
<?php wp_head(); ?>
</head>

<body <?php echo body_class(); ?>>
<div class="wrapper gallery_video" id="home"> 
  
  <!--SIGN IN BOX START-->
   
<?php if( is_user_logged_in() )  {  ?>

<?php }else { 
				if(get_option('users_can_register')) 
{ ?>
<?php }?>

  <div id="login-content">
    <div id="signin" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel"><?php _e('Sign In','cp')?></h3>
    </div>
    <div class="modal-body">
      <div class="login-widget">
      
       <form id="login" action="login" method="post"> 
       <p class="status"></p>
          <input id="username" type="text" onfocus="if(this.value == 'User Name') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'User Name'; }" value="User Name" name="">
          <input id="password" type="password" onfocus="if(this.value == 'Password') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Password'; }" value="Password" name="">
          <button type="submit" class="form-btn hover-style">Login</button>
           <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <p><?php _e('Enter your Username and Password','cp')?></p>
       <a class="log-pass" href="<?php echo wp_lostpassword_url(); ?>"><?php _e('Forgot Password?','cp')?></a>
    </div>
  </div>
  
  <!--SIGNIN BOX END--> 
<?php }	?>

  <!--SIGNUP BOX START-->
  
  <div id="signup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel"><?php _e('Sign Up','cp')?></h3>
    </div>
    <div class="modal-body">
      <div class="login-widget">
        <form>
          <input type="text" onfocus="if(this.value == 'First Name') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'First Name'; }" value="First Name" name="">
          <input type="text" onfocus="if(this.value == 'Last Name') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Last Name'; }" value="Last Name" name="">
          <input type="text" onfocus="if(this.value == 'Your E-mail') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Your E-mail'; }" value="Your E-mail" name="">
          <input type="password" onfocus="if(this.value == 'New Password') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'New Password'; }" value="New Password" name="">
          <button class="form-btn hover-style">Login</button>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <p>Fill the given fields for singing up</p>
    </div>
  </div>
  
  <!--SIGNUP BOX END--> 
  
  <!--HEADER START-->
  
  <header class="border-color">
    <div class="container">
      <div class="logo"> 
        <?php
		             echo '<a href="' . home_url( '/' ) . '">';
                    $logo_id = get_option(THEME_NAME_S.'_logo');
                    $logo_attachment = wp_get_attachment_image_src($logo_id, 'full');
                    $alt_text = get_post_meta($logo_id , '_wp_attachment_image_alt', true);
                    if( !empty($logo_attachment) ){
                       $logo_attachment = $logo_attachment[0];
                    }else{
                        $logo_attachment = CP_THEME_PATH_URL . '/images/logo.png';
                        $alt_text = 'default logo';
                    } 

                    echo '<img src="' . $logo_attachment . '" alt="' . $alt_text . '"/>';
                    echo '</a>';
					?>
       </div>
       
      <div class="navbar main-navigation">
      
      
      
        <div class="sigin"> 
        <?php if( is_user_logged_in() )  {  ?>
 
  <a href="<?php echo wp_logout_url( get_permalink() ); ?>" role="button" data-toggle="modal"><?php _e('Logout','cp')?></a> 
 
   <a href="<?php echo get_edit_user_link(); ?>" role="button" data-toggle="modal"><?php _e('Profile','cp')?></a>
<?php }else { ?>
<a href="#signin" role="button" data-toggle="modal">Sign In</a> 

<?php if(get_option('users_can_register')) { 
    echo '<a  href="'.wp_registration_url().'" role="button" data-toggle="modal">'.__('Register','cp').'</a>' ; 
	
  
/*echo '<a  href="#signup" role="button" data-toggle="modal">Sign Up</a>';*/ 

} ?>

<?php } ?>

         </div>
        
        
        <nav class="navbar-inner"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
          <div class="nav-collapse">
           <?php 		
								 if ( has_nav_menu( 'main_menu' ) ) {
							    	wp_nav_menu( array('container' => 'div', 'menu_class'=> 'sf-menu nav',  'theme_location' => 'main_menu','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',) );
								 }
		    ?>
               </div> 
            </nav>
         </div>
       </div>
  </header>
   </div>
  <!--WRAPPER END-->
