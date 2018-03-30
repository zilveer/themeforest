<?php

class AShortcodeContact extends AShortcode {
  
  static $email_nonce = 'b39a6dda2291a87d9544e3e40726652e';
  static $email_response = '';
  static $email_was_sent = false;
  static $use_wp_mail = true;

  static function init () {
    
    self::$email_response = '<div id="email-response">'. __('<p><strong>Thank you</strong>. Your Message has been Sent.</p><p>We will respond to you shortly if your message requires a response.</p>', A_DOMAIN) .'</div>';
    
    self::tryToSend();

    add_shortcode ('contact', 'AShortcodeContact::contact');
  }

  static function contact ( $atts, $content = null ) {

    extract(shortcode_atts(array(
      'email'   => get_option ('admin_email'),  // admin mail
      'send'    => __('Send', A_DOMAIN),
      'yourname'=> __('Your Name', A_DOMAIN),   // dflt val
      'yourmail'=> __('Your Email', A_DOMAIN),  // dflt val
      'yourmsg' => __('Your Message', A_DOMAIN), // dflt val
      'sitename'=> get_bloginfo( 'name' )
    ), $atts));

    $email = str_ireplace('@', '[at]', $email);

    if ($content) $content = '<p>'. strip_tags($content) .'</p>';
    
    // dont use name="name", wpQuery crashes for some reason
    $form = '<form action="'. get_permalink() .'" method="post" id="contact">
        <fieldset>
          '.$content.'
          <p class="name">
            <input type="text" name="title" value="'. $yourname .'">
          </p>
          <p class="mail">
            <input type="text" name="mail" value="'. $yourmail .'">
          </p>
          <p class="msg">
            <label class="textarea">
              <textarea name="msg" rows="5" cols="40">'. $yourmsg .'</textarea>
            </label>
          </p>
          <p class="send">
            <input type="submit" name="send" value="'. $send .'">
          </p>
          <input name="contact" type="hidden" value="'. $email .'">
          <input name="sitename" type="hidden" value="'. $sitename .'">
          <input name="'. self::$email_nonce .'" type="hidden" value="true">
        </fieldset>
        </form>';
    
    return (self::$email_was_sent) ? self::$email_response : $form;
  }

  static function tryToSend () {

    // check if there was our submit!
    if ( !isset($_POST['msg']) || !isset($_POST['sitename']) || !isset($_POST['contact']) || !isset($_POST[self::$email_nonce]) || !isset($_POST['title']) || !isset($_POST['mail']) ) return;

    $your_site_name = $_POST['sitename'];
    $your_email = str_ireplace('[at]', '@', $_POST['contact']);
    
    $the_msg = trim($_POST['msg']);
    $the_mail = trim($_POST['mail']);
    $the_name = trim($_POST['title']);

    // check post values
    if (strlen($the_msg) < 1 || strlen($the_mail) < 1 || strlen($the_name) < 1) {
      return;
    }

    // we need email
    if (preg_match('/[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2,4}/im', $the_mail, $matches)) {
      $the_mail = $matches[0];
    } else {
      return;
    }

    // ok, no errors. you may add here special contact functional

    $header  = "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html; charset=utf-8\r\n";
    $header .= "From: {$the_name} <{$the_mail}>\r\n";

    $subject = __('Message from', A_DOMAIN) .' '. $your_site_name;
    $the_msg = nl2br($the_msg);

    if (self::$use_wp_mail)
      $res = wp_mail ($your_email, $subject, $the_msg, $header);
    else
      $res = mail ($your_email, $subject, $the_msg, $header);
    
    // self::log($your_email, $subject, $the_msg, $header); $res = true;
 
    if ($res) self::$email_was_sent = true;
  }
}

AShortcodeContact::init();
