<?php
/*
Template Name: Contact
*/
$cp_question = "2+3 = ?";
$cp_answer = "5";
?>
<?php get_header(); ?>
<div id="main_content">
  <div class="center1 padding" id="top_light4">
    <div class="center_box">
      <?php get_sidebar(); ?>
      <div class="center_right">
        <h2>Contact</h2>
        <div class="subtitle2">We can answer all your questions</div>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris eget dolor. <br />
          Phasellus <a href="#">elementum</a> accumsan risus. Mauris eget dolor. </p>
        <p> Phasellus elementum accumsan risus. </p>
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        <?php
					//validate email adress
					function is_valid_email($email)
					{
  						return (eregi ("^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}$", $email));
					}
					function is_valid_user($answer)
					{
						global $cp_answer;
						if ($answer == $cp_answer) { return true; } else { return false;}
					}
					//clean up text
					function clean($text)
					{
						return stripslashes($text);
					}
					//encode special chars (in name and subject)
					function encodeMailHeader ($string, $charset = 'UTF-8')
					{
    					return sprintf ('=?%s?B?%s?=', strtoupper ($charset),base64_encode ($string));
					}

					$cp_name    = (!empty($_POST['cp_name']))    ? $_POST['cp_name']    : "";
					$cp_email   = (!empty($_POST['cp_email']))   ? $_POST['cp_email']   : "";
					$cp_url     = (!empty($_POST['cp_url']))     ? $_POST['cp_url']     : "";
					$cp_ans     = (!empty($_POST['cp_ans']))     ? $_POST['cp_ans']     : "";
					$cp_message = (!empty($_POST['cp_message'])) ? $_POST['cp_message'] : "";
					$cp_message = clean($cp_message);
					$error_msg = "";
					$send = 0;
					if (!empty($_POST['submit'])) {
						$send = 1;
						if (empty($cp_name) || empty($cp_email) || empty($cp_message) || empty($cp_ans)) {
							$error_msg.= "<p style='color:#a00'><strong>".__("Please fill in all required fields.",'ml')."</strong></p>\n";
							$send = 0;
						}
						if (!is_valid_email($cp_email)) {
							$error_msg.= "<p style='color:#a00'><strong>".__("Your email adress failed to validate.",'ml')."</strong></p>\n";
							$send = 0;
						}
						if (!is_valid_user($cp_ans)) {
							$error_msg.= "<p style='color:#a00'><strong>".__("Incorrect Answer to the AntiSpam Question.",'ml')."</strong></p>\n";
							$send = 0;
						}
					}
					if (!$send) { ?>
        <?php the_content(__("Continue Reading &#187;",'ml'));
							?>
        <p class="post-info"><span class="required">*</span> -
          <?php _e('Required Fields','ml');?>
        </p>
        <?php echo $error_msg;?>
        <form method="post" action="<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" id="contactform">
          <fieldset id="contact">
          <strong>
          <?php _e('Name','ml');?>
          </strong><span class="required">*</span><br/>
          <input type="text" class="textbox" id="cp_name" name="cp_name" class="input-text" value="<?php echo $cp_name ;?>" />
          <br/>
          <br/>
          <strong>
          <?php _e('Email','ml');?>
          </strong><span class="required">*</span><br/>
          <input type="text" class="textbox" id="cp_email" name="cp_email" class="input-text" value="<?php echo $cp_email ;?>" />
          <br/>
          <br/>
          <strong>
          <?php _e('Website','ml');?>
          </strong><br/>
          <input type="text" class="textbox" id="cp_url" name="cp_url" class="input-text" value="<?php echo $cp_url ;?>" />
          <br/>
          <br/>
          <strong>
          <?php _e('AntiSpam Challenge:','ml');?>
          <?php echo $cp_question; ?> </strong><span class="required">*</span><br/>
          <input type="text" class="textbox" id="cp_ans" name="cp_ans" class="input-text" value="<?php echo $cp_ans ;?>" />
          <p class="post-info spam">[
            <?php _e('Just to prove you are not a spammer','ml');?>
            ]</p>
          <br/>
          <strong>
          <?php _e('Message','ml');?>
          </strong><span class="required">*</span><br/>
          <textarea id="cp_message" name="cp_message" cols="100%" rows="10"><?php echo $cp_message ;?></textarea>
          <br/>
          <input type="submit" id="submit" name="submit" class="button" value="<?php _e('Send Message','ml');?>" />
          </fieldset>
        </form>
        <?php
					} else {
						$displayName_array	= explode(" ",$cp_name);
						$displayName = htmlentities(utf8_decode($displayName_array[0]));

						$header  = "MIME-Version: 1.0\n";
						$header .= "Content-Type: text/plain; charset=\"utf-8\"\n";
						$header .= "From:" . encodeMailHeader($cp_name) . "<" . $cp_email . ">\n";
						$email_subject	= "[" . get_settings('blogname') . "] " . encodeMailHeader($cp_name);
						$email_text		= "From......: " . $cp_name . "\n" .
							  "Email.....: " . $cp_email . "\n" .
							  "Url.......: " . $cp_url . "\n\n" .
							  $cp_message;

						if (@mail(get_settings('admin_email'), $email_subject, $email_text, $header)) {
							echo "<h3>" . __('Hey','ml') . " " . $displayName . ",</h3><p>".__('Thanks for your message! I\'ll get back to you as soon as possible.','ml')."</p>";
						}
					}
					?>
        <?php endwhile; ?>
        <?php endif; ?>
        <div class="find">Find us via Google Maps</div>
        <div class="google_holder">
          <div class="google_map">
            <!-- insert your code for the google map -->
            <iframe width="442" height="288" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=split+croatia&amp;sll=37.579413,-95.712891&amp;sspn=43.810687,79.013672&amp;ie=UTF8&amp;ll=43.51451,16.446619&amp;spn=0.002474,0.004823&amp;t=h&amp;z=14&amp;output=embed"></iframe>
          </div>
          <div class="google_description">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris eget dolor. </p>
            <p>Lorem ipsum dolor sit amet, <a href="#">consectetuer</a> adipiscing elit. Mauris eget dolor. </p>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris eget dolor. </p>
          </div>
        </div>
      </div>
      <!-- end center_right-->
    </div>
    <!-- end center_box-->
  </div>
  <!--end center 1 -->
</div>
<!-- end main content-->
<?php get_footer(); ?>
