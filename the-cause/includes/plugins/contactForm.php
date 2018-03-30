<?php
if(isset($_POST['tbSendEmailYes'])){
	
		$tbEmail = get_option('tb_email_email');

        $sendingError = FALSE;
		
        if (empty($_POST['email']) || !preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['email'])))  {
            $sendingError = TRUE;
            echo '<div class="sendingError">Email address seems invalid.</div>';
			exit;
        } else {
            $tbSenderEmail = trim($_POST['email']);
        }
            
        if (empty($_POST['message'])) {
            $sendingError = TRUE;
            echo '<div class="sendingError">Please fill the required field - Message.</div>';
			exit;			
            
        } else {            
			$tbMessage = stripslashes(trim($_POST['message']));            
        }
		
        if (isset($_POST['subject']) && ($_POST['subject'] != 'Subject...')) $subject = stripslashes(trim($_POST['subject']));
        if (isset($_POST['fname']) && ($_POST['fname'] != 'Your First Name')) $fname = stripslashes(trim($_POST['fname']));
        if (isset($_POST['lname']) && ($_POST['lname'] != 'Your Last Name')) $lname = stripslashes(trim($_POST['lname']));
        if (isset($_POST['phone']) && ($_POST['phone'] != 'Phone Number...')) $phone = stripslashes(trim($_POST['phone']));
        
        if (!$sendingError) {

			if ($fname || $lname) {
				if (!subject) {
					$subject = "$fname $lname has sent a message to you";
				}            	
	            $message  = "Name: $fname $lname. \r\n";
	            $message .= "Email: $tbSenderEmail \r\n";
			
			} else {
				if (!subject) {
					$subject = "New message for you";
				}
	            $message = "Email: $tbSenderEmail \r\n";
			}
			
			if ($phone) {$message .= "Phone: $phone. \r\n";}
			
            $message .= "Message: \r\n $tbMessage \r\n\n";
			
			$additionalHeaders = "From: $tbSenderEmail\r\nReply-To: $tbSenderEmail\r\nReturn-Path: $tbSenderEmail\r\n";

         	$sendingConf = mail( $tbEmail, $subject, $message, $additionalHeaders);
            
			
			if ($sendingConf) {
				echo '<div class="infoBox greenBox">';
				echo "<h4>Success!!!</h4>";
				echo "<p>Your message was sent successfully. Thank you!</p>";
				echo "</div>";
			} else {
				echo '<div class="infoBox redBox">';
				echo "<h4>Failure!!!</h4>";
				echo "<p>Something went wrong. Please send your message again. Thank you!</p>";
				echo "</div>";
			}
			
			exit;
			}
        }
?>