<?php
/*
Template Name: Contact
*/
?>

<?php
$nameError    = '';
$emailError   = '';
$commentError = '';
if (isset($_POST['submitted'])) {
    if (trim($_POST['contactName']) === '') {
        $nameError = true;
        $hasError  = true;
    } else {
        $name = trim($_POST['contactName']);
    }
    if (trim($_POST['email']) === '') {
        $emailError = true;
        $hasError   = true;
    } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
        $emailError = 'You entered an invalid email address.';
        $hasError   = true;
    } else {
        $email = trim($_POST['email']);
    }
    if (trim($_POST['comments']) === '') {
        $commentError = true;
        $hasError     = true;
    } else {
        if (function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['comments']));
        } else {
            $comments = trim($_POST['comments']);
        }
    }
    if (!isset($hasError)) {
        $emailTo = of_get_option('email_adress');
        if (!isset($emailTo) || ($emailTo == '')) {
            $emailTo = of_get_option('gg_email_adress');
        }
        $subject = of_get_option('email_subject');
        $body    = "Name: $name \n\nEmail: $email \n\nComments: $comments";
        $headers = 'From: ' . $name . ' <' . $emailTo . '>' . "\r\n" . 'Reply-To: ' . $email;
        mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
    }
}
?>

<?php
get_header();
?>


<div id="content">


<div class="title-head"><h1><?php
the_title();
?>
</h1></div>

                                
<?php
$page_layout = sidebar_layout();
switch ($page_layout) {
    case "layout-sidebar-left":
        echo '
<div class="sidebar-left">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-left -->';
        break;
    case "layout-sidebar-right":
        echo '
<div class="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
    case "layout-full":
        echo '
<div class="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
}
?>   

  <div class="content-right">
<?php
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
?>

<?php
if (isset($emailSent) && $emailSent == true) {
?>
    <div class="thanks">
        <p><?php
    _e('Thanks, your email was sent successfully.', 'clubber');
?></p>
  </div>
    
<?php
} else {
?>

<div id="respond">				
    <form action="<?php
    the_permalink();
?>" id="contact" method="post">
        <p class="comment-form-author"><label for="author"><?php _e('Name', 'clubber'); ?></label>
            <input type="text" name="contactName" id="contactName" value="<?php
    if (isset($_POST['contactName']))
        echo $_POST['contactName'];
?>" size="30"  class="required requiredField" />
<?php
    if ($nameError != '') {
?>
            <div class="error"><?php
        _e('&larr; Please enter your name.', 'clubber');
?></div>
<?php
    }
?>
        </p>
        <p class="comment-form-email"><label for="email"><?php _e('Email', 'clubber'); ?></label>
            <input type="text" name="email" id="email"  value="<?php
    if (isset($_POST['email']))
        echo $_POST['email'];
?>" size="30" class="required requiredField email" />                
<?php
    if ($emailError != '') {
?> 
            <div class="error"><?php
        _e('&larr; Please enter a valid email address.', 'clubber');
?></div>
<?php
    }
?>
        </p>
        <p class="comment-form-comment"><label for="comment"><?php _e('Message', 'clubber'); ?></label>
            <textarea name="comments" id="commentsText" rows="12" cols="10" class="required requiredField"><?php
    if (isset($_POST['comments'])) {
        if (function_exists('stripslashes')) {
            echo stripslashes($_POST['comments']);
        } else {
            echo $_POST['comments'];
        }
    }
?></textarea>
                    
<?php
    if ($commentError != '') {
?>
        <div class="error"><?php
        _e('&larr; Please enter a message.', 'clubber');
?></div>
<?php
    }
?>
        </p>
        <p class="form-submit">
            <input id="submitmail" class="button-send" type="submit" value="Send" />
            <input type="hidden" name="submitted" id="submitted" value="true" />
        </p>

    </form>
</div><!-- end #respond -->
<?php
}
?>
</div>
</div><!-- end #content-->

<div class="clear"></div><!-- end .clear-->

<?php
get_footer();
?>