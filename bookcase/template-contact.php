<?php
/*
Template Name: Page - Contact
*/
?>
<?php
// Contact form processing

$name_error = '';
$email_error = '';
$subject_error = '';
$message_error = '';
if (!isset($_REQUEST['c_submitted'])) 
{
//If not isset -> set with dumy value 
$_REQUEST['c_submitted'] = ""; 
$_REQUEST['c_name'] = "";
$_REQUEST['c_email'] = "";
$_REQUEST['c_message'] = "";
}

if (!isset($_REQUEST['q_submitted'])) 
{
//If not isset -> set with dumy value 
$_REQUEST['q_submitted'] = ""; 
$_REQUEST['q_name'] = "";
$_REQUEST['q_email'] = "";
$_REQUEST['q_service'] = "";
$_REQUEST['q_project'] = "";
$_REQUEST['q_budget'] = "";
$_REQUEST['q_phone'] = "";
$_REQUEST['q_website'] = "";
$_REQUEST['q_message'] = "";
}

if($_REQUEST['c_submitted']){

	//check name
	if(trim($_REQUEST['c_name'] == "")){
		//it's empty
		
		$name_error = __('You forgot to fill in your name', 'framework');
		$error = true;
	}else{
		//its ok
		$c_name = trim($_REQUEST['c_name']);
	}

	//check email
	if(trim($_REQUEST['c_email'] === "")){
		//it's empty
		$email_error = __('Your forgot to fill in your email address', 'framework');
		$error = true;
	}else if(!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_REQUEST['c_email']))){
		//it's wrong format
		$email_error = __('Wrong email format', 'framework');
		$error = true;
	}else{
		//it's ok
		$c_email = trim($_REQUEST['c_email']);
	}


	//check name
	if(trim($_REQUEST['c_message'] === "")){
		//it's empty
		$message_error = __('You forgot to fill in your message', 'framework');
		$error = true;
	}else{
		//it's ok
		$c_message = trim($_REQUEST['c_message']);
	}

	//if no errors occured
	if($error != true) {

		$email_to = get_option('of_mail_address');
		if (!isset($email_to) || ($email_to == '') ){
			$email_to = get_option('admin_email');
		}
		$c_subject = __('Contact from your site', 'framework');
		$message_body = "Name: $c_name \n\nEmail: $c_email \n\nComments: $c_message";
		$headers = 'From: '.get_bloginfo('name').' <'.$c_email.'>';

		wp_mail($email_to, $c_subject, $message_body, $headers);

		$email_sent = true;
	}

}

?>
<?php
// Quote form processing

$qname_error = '';
$qemail_error = '';
$qservice_error = '';
$qbudget_error = '';
$qphone_error = '';
$qmessage_error = '';

if($_REQUEST['q_submitted']){

	//check name
	if(trim($_REQUEST['q_name'] == "")){
		//it's empty
		$qname_error = __('You forgot to fill in your name', 'framework');
		$error = true;
	}else{
		//its ok
		$q_name = trim($_REQUEST['q_name']);
	}

	//check email
	if(trim($_REQUEST['q_email'] === "")){
		//it's empty
		$qemail_error = __('Your forgot to fill in your email address', 'framework');
		$error = true;
	}else if(!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_REQUEST['q_email']))){
		//it's wrong format
		$qemail_error = __('Wrong email format', 'framework');
		$error = true;
	}else{
		//it's ok
		$q_email = trim($_REQUEST['q_email']);
	}


	//check phone
	if(trim($_REQUEST['q_phone'] === "")){
		//it's empty
		$qphone_error = __('You forgot to fill in your phone number.', 'framework');
		$error = true;
	}else{
		//it's ok
		$q_phone = trim($_REQUEST['q_phone']);
	}
	
    //check service
	if(trim($_REQUEST['q_service'] === "")){
		//it's empty
		$qservice_error = __('You forgot to select a service.', 'framework');
		$error = true;
	}else{
		//it's ok
		$q_service = trim($_REQUEST['q_service']);
	}
	
	 //check budget
	if(trim($_REQUEST['q_budget'] === "")){
		//it's empty
		$qbudget_error = __('You forgot to select a budget.', 'framework');
		$error = true;
	}else{
		//it's ok
		$q_budget = trim($_REQUEST['q_budget']);
	}
	
	
	//non-required fields:
	
	$q_project = trim($_REQUEST['q_project']);
	$q_website = trim($_REQUEST['q_website']);
	$q_message = trim($_REQUEST['q_message']);


	//if no errors occured
	if($error != true) {
			
		$email_to = get_option('of_mail_address');
		if (!isset($email_to) || ($email_to == '') ){
			$email_to = get_option('admin_email');
		}
		$q_subject = __('Quote Request From Your Site', 'framework');
		$message_body = "Name: $q_name \n\nEmail: $q_email \n\nPhone: $q_phone \n\nWebsite: $q_website \n\nProject Name: $q_project \n\nService Required: $q_service \n\nBudget: $q_budget \n\nComments: $q_message";
		$headers = 'From: '.get_bloginfo('name').' <'.$q_email.'>';

		wp_mail($email_to, $q_subject, $message_body, $headers);

		$email_sent = true;
	}

}

?>
<?php get_header(); ?>
<!--Start Top Section -->
<div class="subsection">
         <div class="pagename">
          <h3 class="alignleft"><?php the_title(); ?>
                    <?php
if(get_post_meta($post->ID, "tagline_value", $single = true) != "") :
echo '<span>'.get_post_meta($post->ID, "tagline_value", $single = true).'</span>';
endif;
?>
</h3>
          <div class="clear"></div>
          </div>
<div class="subheading">

<div class="subcontainer">
<div id="main">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="post" id="post-<?php the_ID(); ?>">
                    <div class="entry">
                        <?php the_content(); ?>
                    </div>
                </div>
                <?php endwhile; endif; ?>
                <?php if(isset($email_sent) && $email_sent == true){ ?>           
                <h4>
                <?php if ($sentheading = get_option('of_sent_heading')) { echo $sentheading; } ?>
                </h4>
                <p>
                <?php if ($sentdescription = get_option('of_sent_description')) { echo $sentdescription; } ?>
                </p>
                <?php } 
                 $quotereq = get_option('of_quote_request'); 
                if ( $quotereq == 'false') { ?>
                <div class="coda-slider-wrapper">
                    <div class="coda-slider preload" id="coda-slider-1">
                        <div class="panel">
                            <div class="panel-wrapper">
                                <div id="contact-form">
                                    <form action="<?php the_permalink(); ?>" id="contactform" method="post" class="contactsubmit">
                                        <div class="formrow">
                                            <div class="one_half">
                                                <label for="c_name">
                                                <?php _e('Name', 'framework'); ?>
                                                </label>
                                                <input type="text" name="c_name" id="c_name" size="22" tabindex="1" class="required" />
                                                <?php if($name_error != '') { ?>
                                                <p><?php echo $name_error;?></p>
                                                <?php } ?>
                                            </div>
                                            <div class="one_half column-last">
                                                <label for="c_email">
                                                    <?php _e('Email', 'framework');?>
                                                </label>
                                                <input type="text" name="c_email" id="c_email" size="22" tabindex="1" class="required email" />
                                                <?php if($email_error != '') { ?>
                                                <p><?php echo $email_error;?></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="messagerow">
                                            <label for="c_message">
                                                <?php _e('Message', 'framework'); ?>
                                            </label>
                                            <textarea name="c_message" id="c_message" cols="100%" rows="8" tabindex="3" class="required"></textarea>
                                            <?php if($message_error != '') { ?>
                                            <p><?php echo $message_error;?></p>
                                            <?php } ?>
                                        </div>
                                        <p>
                                            <label for="c_submit"></label>
                                            <input type="submit" name="c_submit" id="c_submit" class="button dark" value="<?php _e('Send Message', 'framework'); ?>"/>
                                        </p>
                                        <input type="hidden" name="c_submitted" id="c_submitted" value="true" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } else { //Quote request toggle ?>
                <div class="coda-slider-wrapper">
                    <div class="divider contact">
                        <div id="coda-nav-1" class="coda-nav">
                            <ul>
                                <!--Contact Form Toggle-->
                                <li class="tab1"><a href="#Contact" class="buttonleft small active">Contact</a></li>
                                <li class="tab2"><a href="#Quote" class="buttonright small">Request a Quote</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="coda-slider preload" id="coda-slider-1">
                        <div class="panel">
                            <div class="panel-wrapper">
                                <div id="contact-form">
                                    <form action="<?php the_permalink(); ?>" id="contactform" method="post" class="contactsubmit">
                                        <div class="formrow">
                                            <div class="one_half">
                                                <label for="c_name">
                                                    <?php _e('Name', 'framework'); ?>
                                                    <span>*</span> </label>
                                                <input type="text" name="c_name" id="c_name" size="22" tabindex="1" class="required" />
                                                <?php if($name_error != '') { ?>
                                                <label class="error"><?php echo $name_error;?></label>
                                                <?php } ?>
                                            </div>
                                            <div class="one_half column-last">
                                                <label for="c_email">
                                                    <?php _e('Email', 'framework'); ?>
                                                    <span>*</span> </label>
                                                <input type="text" name="c_email" id="c_email" size="22" tabindex="1" class="required email" />
                                                <?php if($email_error != '') { ?>
                                                <label class="error"><?php echo $email_error;?></label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="messagerow">
                                            <label for="c_message">
                                                <?php _e('Message', 'framework'); ?>
                                                <span>*</span> </label>
                                            <textarea name="c_message" id="c_message" cols="100%" rows="8" tabindex="3" class="required"></textarea>
                                            <?php if($message_error != '') { ?>
                                            <label class="error"><?php echo $message_error;?></label>
                                            <?php } ?>
                                        </div>
                                        <p>
                                            <label for="c_submit"></label>
                                            <input type="submit" name="c_submit" id="c_submit" class="button dark" value="<?php _e('Send Message', 'framework'); ?>"/>
                                        </p>
                                        <input type="hidden" name="c_submitted" id="c_submitted" value="true" />
                                    </form>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--Contact Panel-->
                        <div class="panel">
                            <!--Quote Panel-->
                            <div class="panel-wrapper">
                                <form action="<?php the_permalink(); ?>" id="quoteform" method="post" class="contactsubmit">
                                    <div class="formrow">
                                        <div class="one_half">
                                            <label for="q_name">
                                                <?php _e('Name', 'framework'); ?>
                                                <span>*</span> </label>
                                            <input type="text" name="q_name" id="q_name" size="22" tabindex="5" class="required" />
                                            <?php if($qname_error != '') { ?>
                                            <label class="error"><?php echo $qname_error;?></label>
                                            <?php } ?>
                                        </div>
                                        <div class="one_half column-last">
                                            <label for="q_email">
                                                <?php _e('Email', 'framework'); ?>
                                                <span>*</span> </label>
                                            <input type="text" name="q_email" id="q_email" size="22" tabindex="6" class="required email" />
                                            <?php if($qemail_error != '') { ?>
                                            <label class="error"><?php echo $qemail_error;?></label>
                                            <?php } ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="formrow">
                                        <div class="one_half">
                                            <label for="q_phone">
                                                <?php _e('Phone', 'framework'); ?>
                                                <span>*</span> </label>
                                            <input type="text" name="q_phone" id="q_phone" size="22" tabindex="7" class="required" />
                                            <?php if($qphone_error != '') { ?>
                                            <label class="error"><?php echo $qphone_error;?></label>
                                            <?php } ?>
                                        </div>
                                        <div class="one_half column-last">
                                            <label for="q_website">
                                                <?php _e('Website', 'framework'); ?>
                                            </label>
                                            <input type="text" name="q_website" id="q_website" size="22" tabindex="8" />
                                        </div>
                                    </div>
                                    <div class="formrow">
                                        <div class="one_half">
                                            <label for="q_project">
                                                <?php _e('Project Name', 'framework'); ?>
                                            </label>
                                            <input type="text" name="q_project" id="q_project" size="22" tabindex="9" />
                                        </div>
                                        <div class="one_half column-last">
                                            <label for="q_service">
                                                <?php _e('Required Service', 'framework'); ?>
                                                <span>*</span> </label>
                                            <select tabindex="10" name="q_service" id="q_service" class="required">
                                                <option value="nothing">Select a Service</option>
                                                <?php $services = get_option('of_service_items');

									$data = preg_split("/[\r\n,]+/", $services, -1, PREG_SPLIT_NO_EMPTY);

									foreach ($data as &$value) {

										echo '<option value="'.$value.'">'.$value.'</option>';

										}

									 ?>
                                            </select>
                                            <?php if($qservice_error != '') { ?>
                                            <label class="error"><?php echo $qservice_error;?></label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="formrow">
                                            <label for="q_budget">
                                                <?php _e('Project Budget', 'framework');?>
                                                <span>*</span> </label>
                                            <?php $budget = get_option('of_budget_options');

									$data1 = preg_split("/[\r\n,]+/", $budget, -1, PREG_SPLIT_NO_EMPTY);

									foreach ($data1 as &$value) {

										echo '<label class="radiobutton"> <input type="radio" name="q_budget" value="'.$value.'"/>'.$value.'</label>';

										}

									 ?>
                                            <?php if($qbudget_error != '') { ?>
                                            <label class="error"><?php echo $qbudget_error;?></label>
                                            <?php } ?>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="messagerow">
                                        <label for="q_message">
                                            <?php _e('Message', 'framework'); ?>
                                        </label>
                                        <textarea name="q_message" id="q_message" cols="100%" rows="8" tabindex="3" ></textarea>
                                    </div>
                                    <p>
                                        <label for="q_submit"></label>
                                        <input type="submit" name="q_submit" id="q_submit" class="button dark" value="<?php _e('Request Quote', 'framework'); ?>"/>
                                    </p>
                                    <input type="hidden" name="q_submitted" id="q_submitted" value="true" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }  ?>
                <div class="clear"></div>
            </div>
            

</div>
<div class="sidebar">
   <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Contact Sidebar') ) ?>
</div>
<div class="clear"></div>
</div>
</div>
<?php get_footer(); ?>

