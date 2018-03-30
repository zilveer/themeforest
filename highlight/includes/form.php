<script type="text/javascript">
jQuery(function(){
	pexetoContactForm.set("<?php echo get_template_directory_uri().'/includes/send-email.php';?>", "<?php echo pex_text('_message_sent_text');?>", "<?php echo pex_text('_name_error');?>", "<?php echo pex_text('_email_error');?>", "<?php echo pex_text('_question_error');?>");
});
</script>
<form action="" method="post" id="submit-form">
 <div class="contact_form_input">
 <h6><?php echo pex_text('_name_text');?><span class="mandatory">*</span></h6>
  <input type="text" name="name_text_box" class="input form_input" id="name_text_box" />
  </div>
  
  <div class="contact_form_input">
  <h6><?php echo pex_text('_your_email_text');?> <span class="mandatory">*</span> </h6>
  <input type="text" name="email_text_box" class="input form_input" id="email_text_box" />
 	</div>
 
 <div class="contact_form_textarea">
  <h6><?php echo pex_text('_question_text');?><span class="mandatory">*</span></h6>
  <textarea name="question_text_area" rows="" cols="" class="textArea input form_input"
    id="question_text_area"></textarea>
    <br/><br/>
  </div>
  
  <a class="button" id="send_button"><span><?php echo pex_text('_send_text');?></span></a>
  <div id="contact_status" >
   <div class="check hidden"></div>
      <!-- leave for displaying sending message status -->
  </div>
</form>


