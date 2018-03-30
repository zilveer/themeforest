<?php
if (!defined('THEME_FRAMEWORK'))
    exit('No direct script access allowed');

/**
 * Will help theme send emails using contact form shortcode and widget
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0.10
 * @package     artbees
 */


class Mk_Send_Mail
{
    
    function __construct()
    {
        add_action('wp_ajax_nopriv_mk_contact_form', array(
            &$this,
            'send_form'
        ));
        add_action('wp_ajax_mk_contact_form', array(
            &$this,
            'send_form'
        ));
    }
    
    
    /**
     * Ajax action to send email
     *
     * @copyright   ArtbeesLTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0.10
     * @last_update Version 5.0.10
     * @package     artbees
     * @author      Bob Ulusoy
     */
    function send_form()
    {
        
        check_ajax_referer('mk-contact-form-security', 'security');

        add_filter( 'wp_mail_charset', array(&$this, 'default_mail_charset') );
        
        
        $sitename = get_bloginfo('name');
        
        try {
            $siteurl = $_SERVER['HTTP_REFERER']; // Current URL
        }
        catch (Exception $e) {
            $siteurl = esc_url( home_url('/') );
        }
        
        $form_email = $this->from_email();
        $send_to    = $this->get_contact_form_email(trim($_POST['p_id']), trim($_POST['sh_id']));
        $name       = isset($_POST['name']) ? trim($_POST['name']) : '';
        $last_name  = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
        $phone      = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $email      = isset($_POST['email']) ? trim($_POST['email']) : '';
        $website    = isset($_POST['website']) ? trim($_POST['website']) : '';
        $content    = isset($_POST['content']) ? trim($_POST['content']) : '';
        
        $error = false;
        
        if ($send_to === '' || $email === '' || $content === '' || $name === '') {
            $error .= __(" - One of the fields are empty" , 'mk_framework') . "<br>";
        }
        
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $error .= __(" - 'Email' field seems not to be an email." , 'mk_framework'). "<br>";
        }
        
        
        if (!empty($send_to) && filter_var($send_to, FILTER_VALIDATE_EMAIL) === false) {
            $error .= __(" - 'Send To' field seems not to be an email." , 'mk_framework'). "<br>";
        }
        
        if ($error == false) {
            $subject = sprintf(__('%1$s\'s message from %2$s', 'mk_framework'), $sitename, $name);
            
            $body = __('Site: ', 'mk_framework') . $sitename . ' (' . $siteurl . ')' . "\n\n";
            
            $body .= __('Name: ', 'mk_framework') . $name . " " . $last_name . "\n\n";
            
            $body .= __('Email: ', 'mk_framework') . $email . "\n\n";
            
            if (!empty($phone)) {
                $body .= __('Phone Number: ', 'mk_framework') . $phone . "\n\n";
            }
            
            if (!empty($website)) {
                $body .= __('Website: ', 'mk_framework') . $website . "\n\n";
            }
            
            $body .= __('Messages: ', 'mk_framework') . $content;
            $body = apply_filters( 'mk_contact_form_body', $body );
            $headers = "From: $name $last_name <$form_email>\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers = apply_filters( 'mk_contact_form_headers', $headers );
            
            if (wp_mail($send_to, $subject, $body, $headers)) {
                        echo json_encode( 
                                    array(
                                        'action_Status' => true,
                                        'message' => __('Email sent!', 'mk_framework')
                                    )
                                );
            } else {
                        echo json_encode( 
                                    array(
                                        'action_Status' => false,
                                        'message' => __('Email could not be sent! There is an issue with mail server!', 'mk_framework')
                                    )
                                );
            }
        } else {
                echo json_encode( 
                        array(
                            'action_Status' => false,
                            'message' => $error
                        )
                    );

        }
        
        wp_die();
    }
    
    
    /**
     * Returns the email address which will look like wordpress@domain.com
     *
     * @copyright   ArtbeesLTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0.10
     * @last_update Version 5.0.10
     * @package     artbees
     * @author      Bob Ulusoy
     */
    function from_email()
    {
        $admin_email = get_option('admin_email');
        $sitename    = strtolower($_SERVER['SERVER_NAME']);
        
        if (mk_artbees_products::isLocalHost()) {
            return $admin_email;
        }
        
        if (substr($sitename, 0, 4) == 'www.') {
            $sitename = substr($sitename, 4);
        }
        
        if (strpbrk($admin_email, '@') == '@' . $sitename) {
            return $admin_email;
        }
        
        return 'wordpress@' . $sitename;
    }
    
    
    
    /**
     * Updates email address into database if its changed.
     *
     * @copyright   ArtbeesLTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0.10
     * @last_update Version 5.0.10
     * @package     artbees
     * @author      Bob Ulusoy
     */
    public static function update_contact_form_email($p_id, $sh_id, $email)
    {
        
        $email = empty($email) ? get_bloginfo('admin_email') : $email;
        
        $stored_email = get_option('contact-email-' . $p_id . '-' . $sh_id);
        
        if ($stored_email != $email) {
            update_option('contact-email-' . $p_id . '-' . $sh_id, $email);
        }
    }
    
    /**
     * Get email address stored for specific shortcode/widget in spcific page
     *
     * @copyright   ArtbeesLTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0.10
     * @last_update Version 5.0.10
     * @package     artbees
     * @author      Bob Ulusoy
     */
    function get_contact_form_email($p_id, $sh_id)
    {
        
        return get_option('contact-email-' . $p_id . '-' . $sh_id);
    }


    /**
     * The default character encoding for wp_mail() is UTF-8. We add this function to make sure its not something else.
     *
     * @copyright   ArtbeesLTD (c)
     * @link        http://artbees.net
     * @since       Version 5.1
     * @last_update Version 5.1
     * @package     artbees
     * @author      Bob Ulusoy
     */
    function default_mail_charset( $charset ) {
        
        return 'UTF-8';
        
    }
    
    
    
    /**
     * Outputs some hidden inputs for contact forms to have post id and shortcode id to be sent to admin-ajax.
     *
     * @copyright   ArtbeesLTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0.10
     * @last_update Version 5.0.10
     * @package     artbees
     * @author      Bob Ulusoy
     */
    public static function contact_form_hidden_values($sh_id, $p_id)
    {
        $output = '<input type="hidden" id="sh_id" name="sh_id" value="' . $sh_id . '">';
        $output .= '<input type="hidden" id="p_id" name="p_id" value="' . $p_id . '">';
        
        return $output;
    }

    
}

new Mk_Send_Mail();