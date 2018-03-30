<?php	
	//include the scripts for validating email
	include_once ( 'validate-email.php' );

    //get the post variables
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = stripslashes($_POST['message']);
	$my_email = $_POST['myemail'];
	
	// get response messages
	$success = $_POST['success'];
	$failure = $_POST['failure'];
	$invalid = $_POST['invalid'];
	$incomplete = $_POST['incomplete'];
	
	// Get the subject of the message
	$message_subject = $_POST['subject'];
	
	// response hash
    $response = array('type'=> '', 'message'=> '');
 
    try {    
		if ( !empty( $name ) && !empty( $email ) && !empty( $message ) && !empty( $my_email ) ) { 
			if ( check_email( $email ) ) {
				//define the contents of the email
				$from = $email;
				$message ='Sender: ' . $name . "\n\n" . $message;
				$header = 'From: ' . $from;
				  
				//send an email to the site's admin
				$result = mail($my_email, $message_subject, $message, $header);
				  
				if($result) {
		  			// let's assume everything is ok, setup successful response
					$response['type'] = 'success';
					$response['message'] = $success;
				}
				else {
					throw new Exception( $failure );
				}
			}
			else {
				throw new Exception( $invalid );
			}
        }
		else {
			throw new Exception( $incomplete );
		}
    }
	catch( Exception $e ){
        $response['type'] = 'error';
        $response['message'] = $e -> getMessage();
    }
	
	
	// now we are ready to turn this hash into JSON
    echo json_encode( $response );
?>