<script type="text/javascript">
jQuery(function(){
	pexetoContactForm.set("<?php echo get_template_directory_uri().'/includes/send-email.php';?>", "<?php echo get_opt('_message_sent_text');?>", "<?php echo get_opt('_name_error');?>", "<?php echo get_opt('_email_error');?>", "<?php echo get_opt('_question_error');?>");
});
</script>
<form action="" method="post" id="submit_form">
 <div class="contact_form_input">
 <h6><?php echo get_opt('_name_text');?><span class="mandatory">*</span></h6>
  <input type="text" name="name_text_box" class="input form_input" id="name_text_box" />
  </div>
  
  <div class="contact_form_input">
  <h6><?php echo get_opt('_your_email_text');?> <span class="mandatory">*</span> </h6>
  <input type="text" name="email_text_box" class="input form_input" id="email_text_box" />
 	</div>
 
 <div class="contact_form_textarea">
  <h6><?php echo get_opt('_question_text');?><span class="mandatory">*</span></h6>
  <textarea name="question_text_area" rows="" cols="" class="textArea input form_input"
    id="question_text_area"></textarea>
    <br/><br/>
  </div>
  
  <a class="button-small" id="send_button"><span><?php echo get_opt('_send_text');?></span></a>
  <div id="contact_status" >
   <div class="check hidden"></div>
      <!-- leave for displaying sending message status -->
  </div>
</form>


