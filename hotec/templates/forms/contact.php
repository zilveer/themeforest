<form id="contact_form" name="contact_form" method="post" action="">
    <div class="row">
        <div class="six columns b0">
            <div class="form-row field_text">
                <label for="contact_name"><?php _e('Your Name','smooththemes'); ?> </label><em>(<?php _e('required','smooththemes'); ?>)</em><br>
                <input id="contact_name" class="input_text required" type="text" value="" name ="contact_name">
            </div>
            <div class="form-row field_text">
                <label for="contact_phone"><?php _e('Your Phone Number','smooththemes'); ?> </label><em>(<?php _e('optional','smooththemes'); ?>)</em><br>
                <input id="contact_phone" class="input_text" type="text" value="" name ="contact_phone">
            </div>
        </div>
        <div class="six columns b0">
            <div class="form-row field_text">
                <label for="contact_email"><?php _e('Your E-Mail Address','smooththemes'); ?> </label><em>(<?php _e('required','smooththemes'); ?>)</em><br>
                <input id="contact_email" class="input_text required" type="text" value="" name ="contact_email">
            </div>
            <div class="form-row field_text">
                <label for="contact_subject"><?php _e('Subject','smooththemes' ); ?> </label><em>(<?php _e('required','smooththemes'); ?>)</em><br>
                <input id="contact_subject" class="input_text required" type="text" value="" name ="contact_subject">
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="form-row field_textarea">
        <label for="contact_message"><?php _e('Message:','smooththemes'); ?> </label><br>
        <textarea id="contact_message" class="input_textarea required" type="text" value="" name ="contact_message"></textarea>
    </div>
    <div class="form-row field_submit">
        <input type="submit" value="<?php _e('Submit Now','smooththemes'); ?>" id="contact_submit" class="btn">
        <span class="loading hide"><img src="<?php echo st_img('loader.gif'); ?>"></span>
    </div>
    <div class="form-row notice_bar">
        <p class="notice notice_ok hide"><?php _e('Thank you for contacting us. We will get back to you as soon as possible.','smooththemes'); ?></p>
        <p class="notice notice_error hide"><?php _e('Due to an unknown error, your form was not submitted. Please resubmit it or try later.','smooththemes'); ?></p>
    </div>
    <input type="hidden" name="to_email" value="<?php echo esc_attr($data['to_email']); ?>" />
</form> <!-- END #contact_form -->