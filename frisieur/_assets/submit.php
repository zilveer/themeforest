<?php

   /**
    *
    * submit contact form or appointment form
    * to your email address
    * 
    * @author: Martanian <support@martanian.com>        
    * 
    */

    # email headers
    $headers = "MIME-Version: 1.0\n".
               "Content-type: text/html; charset=utf-8\n".
               "Content-Transfer-Encoding: 8bit\n".
               "From: Frisieur Template <no-reply@example.com>\n".
               "Reply-to: ". $_POST['data']['name'] ." <". $_POST['data']['email'] .">".
               "Date: ". date( "r" ). "\n";

   /**
    *
    * actions
    * 
    */               

    if( !isset( $_POST['submit'] ) || empty( $_POST['submit'] ) ) exit();
    else {
    
        switch( $_POST['submit'] ) {
        
           /**
            *
            * contact form
            * 
            */                                                
            
            case 'contact-form':
            
                $content = $_POST['data']['name'] .' (email: '. $_POST['data']['email'] .', phone: '. $_POST['data']['phone'] .') send you an email using contact form on your website created with Frisieur Template:<br /><br />'. $_POST['data']['message'];
                mail(
                    $_POST['email'],
                    "=?UTF-8?B?". base64_encode( $_POST['data']['subject'] ) ."?=",
                    $content,
                    $headers
                );
            
            break;
            
           /**
            *
            * appointment form
            * 
            */
            
            case 'appointment-form':
            
                $content = 'Appointment details:
                            <br />
                            <ul>
                                <li><strong>Name</strong> - '. $_POST['data']['name'] .'</li>
                                <li><strong>Phone</strong> - '. $_POST['data']['phone'] .'</li>
                                <li><strong>Email</strong> - '. $_POST['data']['email'] .'</li>
                                <li><strong>Appointment date</strong> - '. $_POST['data']['appointment-date'] .'</li>
                                <li><strong>Approximate time</strong> - '. $_POST['data']['approximate-time'] .'</li>
                                <li><strong>Additional notes</strong> - '. $_POST['data']['additional-notes'] .'</li>
                            </ul>';
                mail(
                    $_POST['email'],
                    "=?UTF-8?B?". base64_encode( 'New appointment from your website created on Frisieur Template' ) ."?=",
                    $content,
                    $headers
                );
            
            break;                                               
           
           /**
            *
            * no more options
            * 
            */
            
            default: exit();                                                
        }
    }
    
   /**
    *
    * end of file.
    * 
    */                                   

?>