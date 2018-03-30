<?php
if(isset($_POST['tbSignUp'])){
	
		$tbEmail = get_option('tb_email_email');

        $sendingError = FALSE;
		
        if (empty($_POST['email']) || !preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['email'])))  {
            $sendingError = TRUE;
            echo '<div class="sendingError">Email address seems invalid.</div>';
			exit;
        } else {
            $tbFirstName = trim($_POST['fname']);
            $tbLastName = trim($_POST['lname']);
            $tbSenderEmail = trim($_POST['email']);
        }
        
        if (!$sendingError) {


			$subject = "Newsletter Sign-Up";
			$message = '';
			if ($tbFirstName) $message .= "First Name: $tbFirstName \r\n";
			if ($tbLastName) $message .= "Last Name: $tbLastName \r\n";
            $message .= "Email: $tbSenderEmail \r\n";
			
			$additionalHeaders = "From: $tbSenderEmail\r\nReply-To: $tbSenderEmail\r\nReturn-Path: $tbSenderEmail\r\n";

         	$sendingConf = mail( $tbEmail, $subject, $message, $additionalHeaders);
            
			
			if ($sendingConf) {
				echo '<div class="infoBox greenBox">';
				echo "<h4>Success!!!</h4>";
				echo "</div>";
			} else {
				echo '<div class="infoBox redBox">';
				echo "<h4>Failure!!!</h4>";
				echo "</div>";
			}
			
			exit;
			}
        }
?>