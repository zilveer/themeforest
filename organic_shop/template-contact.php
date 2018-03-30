<?php 

/* 
Template Name: Contact Us 
*/ 

?>

<?php 
	// Fetch options stored in $qns_data
	global $qns_data; 
?>

<?php

	// Email Contact Form
	$name_error = '';
	$email_error = '';
	$contact_error = '';
	
	if(isset($_POST['sent'])) {
		
		if(trim($_POST['contact_name']) === '') {
			$name_error = __('Name is a required field', 'qns');
			$got_error = true;
		} 
	
		else {
			$name = trim($_POST['contact_name']);
		}
		
		if(trim($_POST['email']) === '')  {
			$email_error = __('Email is a required field', 'qns');
			$got_error = true;
		} 
	
		else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$email_error = __('Invalid email address', 'qns');
			$got_error = true;
		} 
	
		else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['message']) === '') {
			$contact_error = __('Message is a required field', 'qns');
			$got_error = true;
		} 
	
		else {
		
			if(function_exists('stripslashes')) {
				$message = stripslashes(trim($_POST['message']));
			} 
		
			else {
				$message = trim($_POST['message']);
			}
		
		}
			
		if(!isset($got_error)) {
		
			$email_to = $qns_data['contact_email'];
		
			if (!isset($email_to) || ($email_to == '') ){
				$email_to = get_option('admin_email');
			}
		
		$subject = get_bloginfo( 'name' ) . __(' Contact Form','qns');
		$body = $message . "<br /><br /> " . __('IP Address','qns') . ": " . $_SERVER['REMOTE_ADDR'];
			
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=UTF-8\r\n";
		$headers .= 'From: '.$name.' <'.$email_to.'>' . "\r\n" . 'Reply-To: ' . $email;
			
		mail($email_to, $subject, $body, $headers);
		$emailSent = true;
		
	}
	
} ?>

<?php get_header(); ?>
	
	<?php //Display Page Header
		global $wp_query;
		$postid = $wp_query->post->ID;
		echo page_header( get_post_meta($postid, 'qns_page_header_image', true) );
		wp_reset_query();
	?>
	
	<!-- BEGIN .section -->
	<div class="section">
		
		<ul class="columns-content page-content clearfix">
			
			<!-- BEGIN .col-main -->
			<li class="<?php echo sidebar_position('primary-content'); ?>">
			
				<h2 class="page-title"><?php the_title(); ?></h2>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php 		
						$street_address = ''; 
						$phone_number = '';
						$email_address = '';
					
						if ( $qns_data['street_address'] ) {
							$street_address = $qns_data['street_address'];
						}
					
						if ( $qns_data['phone_number'] ) {
							$phone_number = $qns_data['phone_number'];
						}
					
						if ( $qns_data['email_address'] ) {
							$email_address = $qns_data['email_address'];
						}	
					?>
				
					<?php // No Content
						if ( $post->post_content == "" ) { $no_the_content = true; } else { $no_the_content = false; }
					?>
				
					<?php // No Contact Details
						if ( !$street_address && !$phone_number && !$email_address ) { $no_details = true; } else { $no_details = false; }
					?>
				
					<?php // Some Contact Details
						if ( $street_address !== '' or $phone_number !== '' or $email_address !== '' ) { $some_details = true; } else { $some_details = false; }
					?>
				
					<?php // No Content, Some Contact Details
						if ( $some_details == true && $no_the_content == true ) { ?>
				 		
							<h4><?php _e ( 'Details','qns' )?></h4>
						
							<!--BEGIN .contact_list -->
							<ul class="contact_list">
								<?php if ( $street_address ) { ?><li class="address"><span><?php _e($qns_data['street_address'],'qns'); ?></span></li><?php } ?>
								<?php if ( $phone_number ) { ?><li class="phone"><span><?php _e($qns_data['phone_number'],'qns'); ?></span></li><?php } ?>
								<?php if ( $email_address ) { ?><li class="email"><span><?php _e($qns_data['email_address'],'qns'); ?></span></li><?php } ?>
							<!--END .contact_list -->
							</ul>
					
						<?php }	?>
				
						<?php // Content, No Contact Details
						if ( $no_details == true && $no_the_content == false ) { 
							the_content(); 
						} ?>
				
						<?php // Content and Contact Details
							if ( $some_details == true && $no_the_content == false ) { ?>
					
								<ul class="columns-2 clearfix">
									<li class="col2">
										<?php the_content(); ?>
									</li>
							
									<li class="col2">
										<h4><?php _e( 'Details','qns' )?></h4>
							
										<!--BEGIN .contact_list -->
										<ul class="contact_list">
											<?php if ( $street_address ) { ?><li class="address"><span><?php _e($qns_data['street_address'],'qns'); ?></span></li><?php } ?>
											<?php if ( $phone_number ) { ?><li class="phone"><span><?php _e($qns_data['phone_number'],'qns'); ?></span></li><?php } ?>
											<?php if ( $email_address ) { ?><li class="email"><span><?php _e($qns_data['email_address'],'qns'); ?></span></li><?php } ?>
										<!--END .contact_list -->
										</ul>
									</li>
								</ul>
					
							<?php } ?>
				
						<?php endwhile; endif; ?>
		
						<?php 
						
							if ( $qns_data['gmap-content'] ) {
								$marker_html = ' marker_html="' . $qns_data['gmap-content'] . '"';
							}
							
							if ( $qns_data['map_latitude'] ) {
								$map_latitude = $qns_data['map_latitude'];
							}
							else {
								$map_latitude = '51.508515';
							}
							
							if ( $qns_data['map_longitude'] ) {
								$map_longitude = $qns_data['map_longitude'];
							}
							else {
								$map_longitude = '-0.125487';
							}
						
							// If the Google Maps option is selected display the map
							if ( $qns_data['map_latitude'] && $qns_data['map_longitude'] ) {
								echo do_shortcode('[googlemap height="250px"' . $marker_html . ' latitude="' . $map_latitude . '" longitude="' . $map_longitude . '"]');
							}

							// If the contact form has errors display them to the user
							if ( $got_error == true ) {

								echo '<div class="msg fail">
								<ul class="list-fail">';

								if ( $name_error != '' ) { echo '<li>' . $name_error . '</li>'; }
								if ( $email_error != '' ) { echo '<li>' . $email_error . '</li>'; }
								if ( $contact_error != '' ) { echo '<li>' . $contact_error . '</li>'; }

								echo '</ul></div>';

							}
						
							// If there are no problems with the email and it has been sent display this message
							if (isset($emailSent) && $emailSent == true) : ?>
			
								<div class="msg success clearfix">
									<p class="fl"><?php _e('Email sent, thank you for contacting us', 'qns') ?></p>
								</div>

							<?php else : ?>
			
							<h4><?php _e('Send Us An Email', 'qns') ?></h4>
			
							<form action="<?php the_permalink(); ?>" id="contactform" class="clearfix" method="post">

								<div class="field-row">
									<label for="contact_name"><?php _e('Name', 'qns') ?>
										<span>(<?php _e('required', 'qns') ?>)</span>
									</label>
        							<input type="text" name="contact_name" id="contact_name" class="text_input" value="<?php if(isset($_POST['contact_name'])) echo $_POST['contact_name'];?>" />
								</div>

								<div class="field-row">
									<label for="email"><?php _e('Email', 'qns') ?>
										<span>(<?php _e('required', 'qns') ?>)</span>
									</label>
									<input type="text" name="email" id="email" class="text_input" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" />		
								</div>

								<div class="field-row">
									<label for="message_text"><?php _e('Message', 'qns') ?>
										<span>(<?php _e('required', 'qns') ?>)</span>
									</label>
									
									<textarea name="message" id="message_text" class="text_input" cols="60" rows="9"><?php if(isset($_POST['message'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message']); } else { echo $_POST['message']; } } ?></textarea>
								</div>
				
								<input class="button2" type="submit" value="<?php _e('Send Email', 'qns') ?>" name="submit">
								<input type="hidden" name="sent" value="true" />
				
							</form>
							
							<?php endif; ?>
					
				<!-- END .col-main -->
				</li>
			
			<?php get_sidebar(); ?>
		
		</ul>
		
		<!-- END .section -->		
		</div>

<?php get_footer(); ?>