<?php
    class contact{
        static function send_mail( ){
            if( isset( $_POST['btn_send'] ) && !empty( $_POST['btn_send'] ) && isset($_POST['contact_email']) && is_email($_POST['contact_email'])  ){

                $frommail = '';
                $name = '';
                $message = '';

                $tomail = $_POST['contact_email'];
                $result = array();
                if( isset( $_POST['name'] ) && strlen( $_POST['name'] ) && trim($_POST['name']) != trim(__( 'Your name' , 'cosmotheme' ) ).' *' ) {
                    $name =  trim( $_POST['name'] );
                }else{
                    $result['contact_name'] =  __('error, name is required field.','cosmotheme');
                }

                if( isset( $_POST['email'] ) && is_email( $_POST['email'] ) && trim($_POST['email']) != trim(__( 'Your email' , 'cosmotheme' ) ).' *' ){
                    $frommail = trim( $_POST['email'] );
                }else{
                    
                    $result['contact_email'] =  __('error, email is required field.','cosmotheme');

                }

                if( isset( $_POST['message'] ) && strlen($_POST['message']) && trim($_POST['message']) != trim(__( 'Message' , 'cosmotheme' )).' *' ){
                    $message = '';
                    if( isset($_POST['name']) ){
                        $message .= __('Contact name: ','cosmotheme'). trim($_POST['name'])."\n";
                    }
                    if( isset($_POST['email']) ){
                        $message .= __('Contact email: ','cosmotheme'). trim($_POST['email'])."\n";
                    }
                    if( isset($_POST['phone']) ){
                        $message .= __('Contact phone: ','cosmotheme'). trim($_POST['phone'])."\n\n";
                    }

                    $message .= trim( $_POST['message'] );
                }else{
                    $result['contact_message'] = __('error, message content is required field.','cosmotheme');
                }

                /*if( strlen( $result ) ){
                    echo $result;
                    exit();
                }*/
//var_dump($frommail); var_dump($name); var_dump($message);
                if( is_email( $tomail ) && strlen( $tomail ) && strlen( $frommail ) &&  strlen( $name ) && strlen( $message ) ){
                    $subject = __('New email from','cosmotheme'). ' '.get_bloginfo('name'). '.'.__('Sent via contact form.','cosmotheme');
                    wp_mail($tomail, $subject , $message);
                    $result['message'] = '<span class="success" style="color:green;">' . __('Email was sent successfully ','cosmotheme') . '</span>';
                    //echo '<span class="success" style="color:green;">' . __('Email sent successfully ','cosmotheme') . '</span>';
                } /*else{
                    $result['message'] = __('Error, failed to send email','cosmotheme');
                }*/
                echo json_encode( $result );
            }
            exit;
        }

        static function get_contact_form( $email ){
?>
            <form id="comment_form" class="form comments b_contact" method="post" action="<?php echo home_url() ?>/">
			  <fieldset>
				  <p class="input">
					  <input type="text" onfocus="if (this.value == '<?php _e( 'Your name' , 'cosmotheme' ); ?> *') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Your name' , 'cosmotheme' ); ?> *';}" value="<?php _e( 'Your name' , 'cosmotheme' ); ?> *" name="name" id="name" />
				  </p>
				  <p class="input">
					  <input type="text" onfocus="if (this.value == '<?php _e( 'Your email' , 'cosmotheme' ); ?> *') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Your email' , 'cosmotheme' ); ?> *';}" value="<?php _e( 'Your email' , 'cosmotheme' ); ?> *" name="email" id="email" />
				  </p>
				  <p class="textarea">
					  <textarea onfocus="if (this.value == '<?php _e( 'Message' , 'cosmotheme' ); ?> *') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Message' , 'cosmotheme' ); ?> *';}" tabindex="4" cols="50" rows="10" id="comment_widget" name="message"><?php _e( 'Message' , 'cosmotheme' ); ?> *</textarea>
				  </p>
				  <p class="button hover">
					  <input type="button" value="<?php _e( 'Submit form' , 'cosmotheme' ); ?>" name="btn_send" onclick="javascript:act.send_mail( 'contact' , '#comment_form' , 'p#send_mail_result' );" class="inp_button" />
				  </p>
                  <div  class="container_msg"></div>
				  <p id="send_mail_result">
				  </p>
				  <input type="hidden" value="<?php echo $email; ?>" name="contact_email"  />
			  </fieldset>
		  </form>
<?php

        }
    }
?>