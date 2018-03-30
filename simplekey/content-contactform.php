<?php
/*
 * Contact Form
 * Inspired by http://trevordavis.net/blog/wordpress-jquery-contact-form-without-a-plugin
*/
session_start();
global $VAN;
$nameError='';
$emailError='';
$commentError='';
$captchaError='';
	    
//If the form is submitted
if(isset($_POST['submitted'])) {
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = __('You forgot to enter your name.','SimpleKey');
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = __('You forgot to enter your email address.','SimpleKey');
			$hasError = true;
		}else if (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/i", trim($_POST['email']))) {
			$emailError = __('You entered an invalid email address.','SimpleKey');
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		//Check to make sure comments were entered
		if(trim($_POST['comments']) === '') {
			$commentError = __('You forgot to enter your comments.','SimpleKey');
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
		
		//Check Captcha
		if(isset($VAN['enable_captcha']) && $VAN['enable_captcha']==1){
		  if(trim($_POST['captcha']) === '') {
			$captchaError = __('You forgot to enter CAPTCHA.','SimpleKey');
			$hasError = true;
		  } else {
			if($_POST['captcha']!==$_SESSION['van_captcha']) {
			   $captchaError = __('You entered an invalid CAPTCHA.','SimpleKey');
			   $hasError = true;
			}
		  }
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {
			$emailTo = $VAN['email'];
			$subject = get_bloginfo('name').' New Message From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
	
            wp_mail($emailTo, $subject, $body, $headers);
			$emailSent = true;

		}
} ?>

<div class="contactform">
<?php if(isset($emailSent) && $emailSent == true) { ?>
   <span class="success"><?php _e('Your email was successfully sent. I will be in touch soon.','SimpleKey');?></span>
<?php }else{ ?>
  <?php if($nameError !== ''){?>
    <span class="error"><?php echo $nameError;?></span>
  <?php } if($emailError !== ''){?>
    <span class="error"><?php echo $emailError;?></span>
  <?php }if($commentError !== ''){?>
    <span class="error"><?php echo $commentError;?></span>
  <?php }if($captchaError !== ''){?>
    <span class="error"><?php echo $captchaError;?></span>
  <?php }?>
    
  <form id="contactForm" method="post" action="?">
   <label><input type="text"  name="contactName" id="contactName" class="requiredField" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" placeholder="<?php _e('Your Name','SimpleKey','SimpleKey');?>" /></label>
   <label><input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" placeholder="<?php _e('Your Email','SimpleKey','SimpleKey');?>" /></label>
   <label><textarea class="requiredField" name="comments" id="comments" placeholder="<?php _e('Message','SimpleKey');?>"><?php 
     if(isset($_POST['comments'])) {
		if(function_exists('stripslashes')) {
		   echo stripslashes($_POST['comments']);
		} else {
		   echo $_POST['comments'];
		}
     } 
    ?></textarea></label>
    <?php if(isset($VAN['enable_captcha']) && $VAN['enable_captcha']==1):?>
    <div class="cp">
    <input type="text" name="captcha" id="captcha" value="" class="requiredField captcha" placeholder="<?php _e('Captcha','SimpleKey');?>" /><a href="javascript:refreshCaptcha();" class="cpt-img"><img id="mycaptcha" src="<?php echo get_template_directory_uri();?>/inc/functions/captcha/van_captcha.php?rand=<?php echo rand();?>" /></a>
    </div>
   <input type="hidden" name="get_captcha" id="get_captcha" value="<?php echo $_SESSION['van_captcha'];?>" />
   <?php endif;?>
   <input type="hidden" name="submitted" id="submitted" value="true" />
   <div class="clearfix"></div>
   <button type="submit" name="submit" id="submitMsg" class="large_btn contact-btn"><?php _e('Submit','SimpleKey');?></button>
 </form>
<?php }?>
<script type="text/javascript">
//Ajax feedback message
var forgot_error="<?php _e("You forgot to enter",'SimpleKey');?>";
var email_error="<?php _e("You entered an invalid",'SimpleKey');?>";
var nameErrorText="<?php _e("your name",'SimpleKey');?>";
var commentErrorText="<?php _e("message",'SimpleKey');?>";
var captchaErrorText="<?php _e("captcha value",'SimpleKey');?>";
var emailErrorText="<?php _e("your email address",'SimpleKey');?>";
var success="<?php _e("Thanks! Your email was successfully sent. I check my email all the time, so I should be in touch soon.",'SimpleKey');?>";
var verify='<?php echo get_template_directory_uri();?>/functions/captcha/van_check.php';
function refreshCaptcha(){
  var img = document.images['mycaptcha'];
  img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
</div>