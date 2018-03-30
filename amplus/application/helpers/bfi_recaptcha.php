<?php
/**
 */

if ((string)bfi_get_option(BFI_OPTIONRECAPTCHAPUBLICKEY) != '' ||
    (string)bfi_get_option(BFI_OPTIONRECAPTCHAPRIVATEKEY) != '') {
    // this is a custom action used in bfi-commentform.php used to display the recaptcha
    add_action('bfi_recaptcha_display', 'bfi_recaptcha_display');
    // checks the validity of the entered captcha
    add_action('preprocess_comment', 'bfi_recaptcha_check_comment', 0);
    // makes sure that the data gets sent to the form after a captcha failure
    add_action('comment_post_redirect', 'bfi_recaptcha_relative_redirect', 0, 2);
}


/**
 * Displays a captcha form
 *
 * @internal
 * @ignore
 */
function bfi_recaptcha_display() {
    BFILoader::requireOverridableLibraryFile('includes/recaptchalib.php');
    // require_once(BFI_INCLUDESPATH.'recaptchalib.php');
    $publickey = bfi_get_option(BFI_OPTIONRECAPTCHAPUBLICKEY);
    
    $theme = bfi_get_option(BFI_SHORTNAME.'_recaptcha_theme');
    $lang = array_key_exists('l', $_SESSION) ? $_SESSION['l'] : 'en';
    
    echo "<label><i class='icon-warning-sign icon-large'></i>".__("Human check *", BFI_I18NDOMAIN)."</label>";
    if (array_key_exists('rcommentid', $_GET))
        echo "<div class='error icon-warning-sign'>".__("The reCAPTCHA was not entered correctly.", BFI_I18NDOMAIN)."</div>";
        //echo do_shortcode("[infobox type='error']".__("The reCAPTCHA was not entered correctly.", BFI_I18NDOMAIN)."[/infobox]");
        //echo "<small class='error' style='display: inline;'>".__("The reCAPTCHA was not entered correctly.", BFI_I18NDOMAIN)."</small>";
    echo "<script>var RecaptchaOptions = { theme : '$theme', lang : '$lang' };</script>";
    echo recaptcha_get_html($publickey);
  
    // get the previous comment which errored because of recaptcha
    if (!array_key_exists('rcommentid', $_GET)) return;
    if (!array_key_exists('rhash', $_GET)) return;
  
    $commentID = $_GET['rcommentid'];
    
    // a quick check if the user came from a valid comment submission
    if (bfi_recaptcha_hasher($commentID) != $_GET['rhash']) return;
    
    $comment = get_comment($commentID);
    if ($comment == null) return;
    
    // write some javascript to put back the previous comment form data
    $auth = preg_replace('/"/', '\\"', $comment->comment_author);
    $auth = preg_replace("/'/", "\\'", $auth);
    $com = preg_replace('/"/', '\\"', $comment->comment_content);
    $com = preg_replace("/'/", "\\'", $com);
    $com = preg_replace('/\\r\\n/m', '\\\n', $com);

    echo "
        <script type='text/javascript'>
        jQuery(document).ready(function(\$){
            \$(\"input#author\").val(\"$auth\");
            \$(\"input#email\").val(\"$comment->comment_author_email\");
            \$(\"input#url\").val(\"$comment->comment_author_url\");
            \$(\"textarea#comment\").val(\"$com\");
        });
        </script>
        ";
  
    // lastly delete the comment so it can be reposted
    wp_delete_comment($commentID);
}

      
/**
 * checks whether the captcha was correct
 *
 * @internal
 * @ignore
 */
function bfi_recaptcha_check_comment($data) {
    BFILoader::requireOverridableLibraryFile('includes/recaptchalib.php');

    if (isset($_POST) && array_key_exists("recaptcha_challenge_field", $_POST)) {
        $privatekey = bfi_get_option(BFI_OPTIONRECAPTCHAPRIVATEKEY);
        
        $resp = recaptcha_check_answer(
            $privatekey,
            $_SERVER["REMOTE_ADDR"],
            $_POST["recaptcha_challenge_field"],
            $_POST["recaptcha_response_field"]);
    
        // get the captcha result
        global $bfi_recaptcha_error;
        if (!$resp->is_valid) {
            $bfi_recaptcha_error = "error";
            add_filter('pre_comment_approved', create_function('$a', 'return \'spam\';'));
        } else {
            // Your code here to handle a successful verification
            $bfi_recaptcha_error = '';
        }
    }
    return $data;
} 


 
/**
 * after a comment submission, WP redirects to another page. 
 * pass on the needed variables for when the page loads
 * so we can display the error msg & retain the form data
 *
 * @internal
 * @ignore
 */
function bfi_recaptcha_relative_redirect($location, $comment) {
    global $bfi_recaptcha_error;
    if ($bfi_recaptcha_error != '') {
        $location = substr($location, 0, strpos($location, '#')) .
            ((strpos($location, "?") === false) ? "?" : "&") .
            'rcommentid=' . $comment->comment_ID .
            '&error='.$bfi_recaptcha_error .
            '&rhash='.bfi_recaptcha_hasher($comment->comment_ID) .
            '#commentform';
    }
    return $location;
}


/**
 * Hasher for checking if the ID we get is correct
 *
 * @internal
 * @ignore
 */
function bfi_recaptcha_hasher($id) {
    return md5(BFI_SHORTNAME.$id);
}


/**
 * Displays a recaptcha form to be used in a contact form. 
 * This should be implemented in the contactform shortcode
 *
 * @package API\Utility
 * @return string the recaptcha html code
 */
function bfi_recaptcha_contactform_display() {
    if ((string)bfi_get_option(BFI_OPTIONRECAPTCHAPUBLICKEY) != '' ||
        (string)bfi_get_option(BFI_OPTIONRECAPTCHAPRIVATEKEY) != '') {
        BFILoader::requireOverridableLibraryFile('includes/recaptchalib.php');
        $publickey = bfi_get_option(BFI_OPTIONRECAPTCHAPUBLICKEY);
        
        $theme = bfi_get_option(BFI_SHORTNAME.'_recaptcha_theme');
        $lang = array_key_exists('l', $_SESSION) ? $_SESSION['l'] : 'en';
        
        $recaptcha = "<label><i class='icon-warning-sign icon-large'></i>".__("Human check *", BFI_I18NDOMAIN)."</label>";
        $recaptcha .= "<small class='error recaptcha_error' style='display: none;'>".__("The reCAPTCHA was not entered correctly.", BFI_I18NDOMAIN)."</small>";
        $recaptcha .= "<script>var RecaptchaOptions = { theme : '$theme', lang : '$lang' };</script>";
        $recaptcha .= recaptcha_get_html($publickey);
        return $recaptcha;
    }
    return '';
}


/**
 * Displays a recaptcha form to be used in a contact form. 
 * This should be implemented in the contactform shortcode
 *
 * @package API\Utility
 * @return string the recaptcha html code
 */
function bfi_recaptcha_contactform_check() {
    if ((string)bfi_get_option(BFI_OPTIONRECAPTCHAPUBLICKEY) != '' ||
        (string)bfi_get_option(BFI_OPTIONRECAPTCHAPRIVATEKEY) != '') {
        BFILoader::requireOverridableLibraryFile('includes/recaptchalib.php');

        if (isset($_POST) && array_key_exists("recaptcha_challenge_field", $_POST)) {
            $privatekey = bfi_get_option(BFI_OPTIONRECAPTCHAPRIVATEKEY);
            
            $resp = recaptcha_check_answer(
                $privatekey,
                $_SERVER["REMOTE_ADDR"],
                $_POST["recaptcha_challenge_field"],
                $_POST["recaptcha_response_field"]);
        
            // get the captcha result
            return $resp->is_valid ? '1' : '0';
        }
    }
    return '1';
}

?>
