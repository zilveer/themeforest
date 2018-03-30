<?php
if (!defined('THEME_FRAMEWORK'))
    exit('No direct script access allowed');

/**
 * Will help theme send emails using contact form shortcode and widget
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 3.5.1
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
     * @since       Version 3.5.1
     * @last_update Version 3.5.1
     * @package     artbees
     * @author      Bob Ulusoy
     */
    function send_form()
    {
        
        check_ajax_referer('mk-contact-form-security', 'security');
        
        
        $sitename = get_bloginfo('name');
        
        try {
            $siteurl = $_SERVER['HTTP_REFERER']; // Current URL
        }
        catch (Exception $e) {
            $siteurl = home_url();
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
            $error .= " - One of the fields are empty" . "\n";
        }
        
        if (!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email)) {
            $error .= " - 'Email' email address either empty or not an email." . "\n";
        }
        
        
        if (!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $send_to)) {
            $error .= " - 'Send To' email address either empty or not an email." . "\n";
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
            $headers = "From: $name $last_name <$form_email>\r\n";
            $headers .= "Reply-To: $email\r\n";
            
            if (wp_mail($send_to, $subject, $body, $headers)) {
                echo 'Email sent!';
            } else {
                echo 'Email could not be sent!';
            }
        } else {
            echo 'Error(s) occured!' . "\n\n";
            echo $error;
        }
        
        wp_die();
    }
    
    
    /**
     * Returns the email address which will look like wordpress@domain.com
     *
     * @copyright   ArtbeesLTD (c)
     * @link        http://artbees.net
     * @since       Version 3.5.1
     * @last_update Version 3.5.1
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
     * @since       Version 3.5.1
     * @last_update Version 3.5.1
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
     * @since       Version 3.5.1
     * @last_update Version 3.5.1
     * @package     artbees
     * @author      Bob Ulusoy
     */
    function get_contact_form_email($p_id, $sh_id)
    {
        
        return get_option('contact-email-' . $p_id . '-' . $sh_id);
    }
    
    
    
    /**
     * Outputs some hidden inputs for contact forms to have post id and shortcode id to be sent to admin-ajax.
     *
     * @copyright   ArtbeesLTD (c)
     * @link        http://artbees.net
     * @since       Version 3.5.1
     * @last_update Version 3.5.1
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