<?php 
/* Template Name: Contact Page */
get_header(); 

//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactName']) === '') {
		$nameError = 'You forgot to enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	
	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) === '')  {
		$emailError = 'You forgot to enter your email address.';
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
		
	//Check to make sure comments were entered	
	if(trim($_POST['comments']) === '') {
		$commentError = 'You forgot to enter your a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
		
	//If there is no error, send the email
	if(!isset($hasError)) {
		global $of_option;
		$emailTo = $of_option['st_contact_email'];
		$subject = 'Contact Form Submission from '.$name;
		$msubject = trim($_POST['subject']);
		$body = "Name: $name \n\nE-Mail: $email \n\nSubject: $msubject \n\nMessage: $comments";
		$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
		
		mail($emailTo, $subject, $body, $headers);

		$emailSent = true;

	}
}

// Translation
$prefix = "st_"; 
if($of_option[$prefix.'translate']){	
	$tr_name = $of_option[$prefix.'tr_name'];
	$tr_email = $of_option[$prefix.'tr_email'];
	$tr_subject = $of_option[$prefix.'tr_subject'];
	$tr_message = $of_option[$prefix.'tr_message'];
	$tr_send = $of_option[$prefix.'tr_send'];
	$success = $of_option[$prefix.'contact_success'];
}else{			
	$tr_name = __('Name', 'spacing');
	$tr_email = __('E-Mail', 'spacing');
	$tr_subject = __('Subject', 'spacing');
	$tr_message = __('Message', 'spacing');
	$tr_send = __('Send', 'spacing');
	$success = __('Thank you, your message has been sent.', 'spacing');
}
$layout = get_post_meta($post->ID, 'page_layout', true);
?>

	<div id="page-content" class="main-container">
    
    	<div class="container <?php echo $layout; ?>">
        	<?php if($of_option[$prefix.'contact_map']){ ?>
        	<div class="sixteen columns">
            <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.ui.map.min.js"></script>
        	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <?php
			$address = $of_option[$prefix.'map_location'];
			$prepAddr = str_replace(' ','+',$address);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$geocode = curl_exec($ch);
			curl_close($ch);
			
			$output= json_decode($geocode);
			
			$lat = $output->results[0]->geometry->location->lat;
			$long = $output->results[0]->geometry->location->lng;			
			?>
            <script type="text/javascript" charset="utf-8">
			jQuery(function()
				{
					jQuery('#contact_gmap').gmap({'zoom':<?php echo $of_option[$prefix.'map_zoom']; if($of_option[$prefix.'map_color']) echo ",styles:[{stylers:[{lightness:1},{saturation:-95}]}]"; ?>, 'center': '<?php echo $lat.",".$long ?>'}).bind('init', function(ev, map) {
					jQuery('#contact_gmap').gmap('addMarker', { 'position': map.getCenter(), 'bounds': false});
				});
			});			
			</script>
            <div id="contact_gmap">
                <p>This will be replaced with the Google Map.</p>
            </div>
            <div class="divider line"></div>
            </div>
    
			<?php } if($layout == "sidebar-both"){ ?>
            <div class="both-container twelve columns">
            <?php } ?>
                
            <div id="content" class="<?php if($layout == "fullwidth"){echo "sixteen";}elseif($layout == "sidebar-both"){ echo "eight"; }else echo "twelve"; ?> columns">   
    
            <!--Page Content Begin-->
            
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
                <?php the_content(); ?>
                      
            <?php endwhile; endif; ?>
            <!--Page Content End-->
            
            <!--Contact Form Begin -->
            
            <?php if(isset($emailSent) && $emailSent == true) { ?>
          
            <div class="form-success"> 
                <?php echo $success; ?>
            </div>
        
            <?php } else { ?>
        
            <div class="form-success"> 
                <?php echo $success; ?>
            </div>
        
            <form action="<?php the_permalink(); ?>" id="contactForm" class="contact-form" method="post">
        
                <ul class="forms">
                    <li class="textfield"><label for="contactName"><?php echo $tr_name ?>: *</label>
                        <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField <?php if($nameError != '') { ?>error-highlight<?php } ?>" />					
                        
                    </li>
                    
                    <li class="textfield"><label for="email"><?php echo $tr_email ?>: *</label>
                        <input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email <?php if($emailError != '') { ?>error-highlight<?php } ?>" />					
                        
                    </li>
                    
                    <li class="textfield last"><label for="subject"><?php echo $tr_subject ?>:</label>
                        <input type="text" name="subject" id="subject" value="<?php if(isset($_POST['subject']))  echo $_POST['subject'];?>" />					
                        
                    </li>
                    
                    <li class="textarea"><label for="commentsText"><?php  echo $tr_message ?>: *</label>
                    	<div class="contact-textarea">
                        <textarea name="comments" id="commentsText" rows="8" class="requiredField <?php if($commentError != '') { ?>error-highlight<?php } ?>"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
                        </div>
                    </li>				
                    <li class="buttons">
                        <input type="hidden" name="submitted" id="submitted" value="true" />
                        <button type="submit" class="button"><?php  echo $tr_send ?></button>
                        <div class="loading"></div>
                    </li>
                </ul>
            </form>
        
            <?php } ?>
            
            <!-- Contact Form End -->    
           
        	</div>
        
            <?php if($layout == "sidebar-both"){ ?>
            <div id="sidebar-secondary" class="sidebar four columns">
                <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar(get_post_meta($post->ID, 'page_second_sidebar', true))) ?>
            </div>
            </div>        
            <?php } if($layout !== "fullwidth"){ ?>
            <!-- Sidebar Begin --> 
            
            <div id="sidebar" class="sidebar four columns">
                <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar(get_post_meta($post->ID, 'page_sidebar', true))) ?>
            </div>
            
            <!-- Sidebar End --> 
            <?php } ?>  
    	</div>    
	</div>

<?php get_footer(); ?>