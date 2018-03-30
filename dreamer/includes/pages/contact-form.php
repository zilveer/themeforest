<?php
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP
//If the form is submitted
if(isset($_POST['submitted'])) {
// require a name from user
if(trim($_POST['name']) === '') {
$nameError =  'Forgot your name!';
$hasError = true;
} else {
$name = trim($_POST['name']);
}
// require a mobile from user
if(trim($_POST['phonenumber']) === '') {
$phonenumberError =  'Forgot your phonenumber!';
$hasError = true;
} else {
$phonenumber = trim($_POST['phonenumber']);
}
// require a website from user
if(trim($_POST['website']) === '') {
$websiteError =  'Forgot your website!';
$hasError = true;
} else {
$website = trim($_POST['website']);
}
// require a projectbudget from user
if(trim($_POST['projectbudget']) === '') {
$projectbudgetError =  'Forgot your Budget!';
$hasError = true;
} else {
$projectbudget = trim($_POST['projectbudget']);
}
// require a youreinterestedin from user
if(trim($_POST['youreinterestedin']) === '') {
$youreinterestedinError =  'Forgot your Interest!';
$hasError = true;
} else {
$youreinterestedin = trim($_POST['youreinterestedin']);
}
// require a howdidyouhearaboutus from user
if(trim($_POST['howdidyouhearaboutus']) === '') {
$howdidyouhearaboutusError =  'Forgot How you heared about us field!';
$hasError = true;
} else {
$howdidyouhearaboutus = trim($_POST['howdidyouhearaboutus']);
}
// require a timeframe from user
if(trim($_POST['timeframe']) === '') {
$timeframeError =  'Forgot your Time Frame!';
$hasError = true;
} else {
$timeframe = trim($_POST['timeframe']);
}
// require a timeframe from user
if(trim($_POST['timeframe']) === '') {
$timeframeError =  'Forgot your Time Frame!';
$hasError = true;
} else {
$timeframe = trim($_POST['timeframe']);
}
// need valid email
if(trim($_POST['email']) === '')  {
$emailError = 'Forgot to enter in your e-mail address.';
$hasError = true;
} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
$emailError = 'You entered an invalid email address.';
$hasError = true;
} else {
$email = trim($_POST['email']);
}
// we need at least some content
if(trim($_POST['message']) === '') {
$commentError = 'You forgot to enter a message!';
$hasError = true;
} else {
if(function_exists('stripslashes')) {
$message = stripslashes(trim($_POST['message']));
} else {
$message = trim($_POST['message']);
}
}
// upon no failure errors let's email now!
if(!isset($hasError)) {
$emailTo = 'avathemes@gmail.com';
$subject = 'Submitted message from '.$name;
$sendCopy = trim($_POST['sendCopy']);
$body = "Name: $name \n\nEmail: $email \n\nMessage: $message \n\nPhone Number: $phonenumber\n\n Website Link: $website\n\n Project Budget: $projectbudget\n\n Interests: $youreinterestedin\n\n How did you heared about us: $howdidyouhearaboutus\n\n Timeframe: $timeframe\n\n ";
$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
mail($emailTo, $subject, $body, $headers);
// set our boolean completion value to TRUE
$emailSent = true;
}
}
?>
<div class="page-container pattern-1" id="contact">
    <div class="row">
        <div class="twelve columns contact">
            <div id="contact-slider">
                <div class="contact-form" data-thumb="images/contact-form.png">
                    <?php if(isset($emailSent) && $emailSent == true) { ?>
                    <p class="info">Your email was sent. Huzzah!</p>
                    <?php } else { ?>
                    <form method="post" id="contact-us" action="<?php echo get_template_directory_uri(); ?>/includes/pages/contact-form.php">
                        <div class="twelve columns contact-form-div">
                            <div class="eight columns mobile-four-760">
                                <div class="six columns first-column mobile-two-670">
                                    <div class="row collapse">
                                        <div class="two mobile-one columns">
                                            <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_one = $smof_data['form_icon_one']; echo $dreamer_contact_form_icon_one ?>" alt="Contact Name"></span>
                                        </div>
                                        <div class="ten mobile-three columns">
                                            <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_one = $smof_data['placeholder_one']; echo $dreamer_placeholder_one ?> *" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>" class="txt requiredField"/>
                                            <?php if($nameError != '') { ?>
                                            <br /><span class="error"><?php echo $nameError;?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="six columns middle-column mobile-two-670">
                                    <div class="row collapse">
                                        <div class="two mobile-one columns">
                                            <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_two = $smof_data['form_icon_two']; echo $dreamer_contact_form_icon_two ?>" alt="Contact Email"></span>
                                        </div>
                                        <div class="ten mobile-three columns">
                                            <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_two = $smof_data['placeholder_two']; echo $dreamer_placeholder_two ?> *" name="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="txt requiredField email"/>
                                            <?php if($emailError != '') { ?>
                                            <br /><span class="error"><?php echo $emailError;?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="six columns first-column mobile-two-670">
                                    <div class="row collapse">
                                        <div class="two mobile-one columns">
                                            <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_three = $smof_data['form_icon_three']; echo $dreamer_contact_form_icon_three ?>" alt="Phone Number"></span>
                                        </div>
                                        <div class="ten mobile-three columns">
                                            <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_three = $smof_data['placeholder_three']; echo $dreamer_placeholder_three ?>" name="phonenumber" value="<?php if(isset($_POST['phonenumber'])) echo $_POST['phonenumber'];?>" class="txt requiredField"/>
                                            <?php if($phonenumberError != '') { ?>
                                            <br /><span class="error"><?php echo $phonenumberError;?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="six columns middle-column mobile-two-670">
                                    <div class="row collapse">
                                        <div class="two mobile-one columns">
                                            <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_four = $smof_data['form_icon_four']; echo $dreamer_contact_form_icon_four ?>" alt="Website"></span>
                                        </div>
                                        <div class="ten mobile-three columns">
                                            <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_four = $smof_data['placeholder_four']; echo $dreamer_placeholder_four ?>" name="website" value="<?php if(isset($_POST['website'])) echo $_POST['website'];?>" class="txt requiredField"/>
                                            <?php if($websiteError != '') { ?>
                                            <br /><span class="error"><?php echo $websiteError;?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="six columns first-column mobile-two-670">
                                    <div class="row collapse">
                                        <div class="two mobile-one columns">
                                            <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_five = $smof_data['form_icon_five']; echo $dreamer_contact_form_icon_five ?>" alt="Project Budget"></span>
                                        </div>
                                        <div class="ten mobile-three columns">
                                            <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_five = $smof_data['placeholder_five']; echo $dreamer_placeholder_five ?>" name="projectbudget" value="<?php if(isset($_POST['projectbudget'])) echo $_POST['projectbudget'];?>" class="txt requiredField"/>
                                            <?php if($projectbudgetError != '') { ?>
                                            <br /><span class="error"><?php echo $projectbudgetError;?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="six columns middle-column mobile-two-670">
                                    <div class="row collapse">
                                        <div class="two mobile-one columns">
                                            <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_six = $smof_data['form_icon_six']; echo $dreamer_contact_form_icon_six ?>" alt="Timeframe"></span>
                                        </div>
                                        <div class="ten mobile-three columns">
                                            <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_six = $smof_data['placeholder_six']; echo $dreamer_placeholder_six ?>" name="timeframe" value="<?php if(isset($_POST['timeframe'])) echo $_POST['timeframe'];?>" class="txt requiredField"/>
                                            <?php if($timeframeError != '') { ?>
                                            <br /><span class="error"><?php echo $timeframeError;?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="six columns first-column mobile-two-670">
                                    <div class="row collapse">
                                        <div class="two mobile-one columns">
                                            <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_seven = $smof_data['form_icon_seven']; echo $dreamer_contact_form_icon_seven ?>" alt="You're interested in?"></span>
                                        </div>
                                        <div class="ten mobile-three columns">
                                            <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_seven = $smof_data['placeholder_seven']; echo $dreamer_placeholder_seven ?>" name="youreinterestedin" value="<?php if(isset($_POST['youreinterestedin'])) echo $_POST['youreinterestedin'];?>" class="txt requiredField"/>
                                            <?php if($youreinterestedinError != '') { ?>
                                            <br /><span class="error"><?php echo $youreinterestedinError;?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="six columns middle-column mobile-two-670">
                                    <div class="row collapse">
                                        <div class="two mobile-one columns">
                                            <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_eight = $smof_data['form_icon_eight']; echo $dreamer_contact_form_icon_eight ?>" alt="How did you hear about us?"></span>
                                        </div>
                                        <div class="ten mobile-three columns">
                                            <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_eight = $smof_data['placeholder_eight']; echo $dreamer_placeholder_eight ?>" name="howdidyouhearaboutus" id="subject" value="<?php if(isset($_POST['howdidyouhearaboutus'])) echo $_POST['howdidyouhearaboutus'];?>" class="txt requiredField"/>
                                            <?php if($howdidyouhearaboutusError != '') { ?>
                                            <br /><span class="error"><?php echo $howdidyouhearaboutusError;?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="four columns last-column mobile-four-760">
                                <textarea placeholder="<?php global $smof_data; $dreamer_placeholder_nine = $smof_data['placeholder_nine']; echo $dreamer_placeholder_nine ?> *" name="message"><?php if(isset($_POST['message'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message']); } else { echo $_POST['message']; } } ?></textarea>
                                <?php if($commentError != '') { ?>
                                <br /><span class="error"><?php echo $commentError;?></span>
                                <?php } ?>
                            </div>
                            <div class="twelve columns submit-760">
                                <input type="submit" class="button radius secondary submit-wide" value="Send Message" id="submit"/>
                                <input type="hidden" name="submitted" id="submitted" value="true" />
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_reset_query(); ?>