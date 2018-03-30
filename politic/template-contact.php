<?php
/*
Template Name: Contact
*/
?>

<?php 

/* Edit the error messages here --------------------------------------------------*/
$nameError = __( 'Please enter your name.', 'framework' );
$emailError = __( 'Please enter your email address.', 'framework' );
$emailInvalidError = __( 'You entered an invalid email address.', 'framework' );
$commentError = __( 'Please enter a message.', 'framework' );
/*--------------------------------------------------------------------------------*/


$errorMessages = array();
if(isset($_POST['submitted'])) {
		if(trim($_POST['contactName']) === '') {
			$errorMessages['nameError'] = $nameError;
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		if(trim($_POST['email']) === '')  {
			$errorMessages['emailError'] = $emailError;
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$errorMessages['emailInvalidError'] = $emailInvalidError;
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['comments']) === '') {
			$errorMessages['commentError'] = $commentError;
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		if(!isset($hasError)) {
			$emailTo = get_option('icy_email');
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('icy_email');
			}			
			$subject = '[Contact Form] From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>
<?php get_header(); ?>

		<div class="page-title">

			<h1><span class="the-page-title"><?php the_title(); ?></span>			
				<span class="page-subtitle">
					<?php 
					global $post;
					if(get_post_meta($post->ID, 'heading_value', true) != '') 
						echo get_post_meta($post->ID, 'heading_value', true); 
					?>
				</span>
			</h1>
	        <!-- #searchbar -->
	        <form role="search" method="get" id="searchform-top" action="<?php echo home_url( '/' ); ?>" class="clearfix" >
	            <div>
	                <input type="text" value="Search..." name="s" id="s" onfocus="if(this.value=='Search...')this.value='';" onblur="if(this.value=='')this.value='Search...';" />
	            </div>
	        </form>
	        <!-- /#searchbar-->    
		</div>

		<div class="shadow-separator"></div>
		
		<div class="container background">
            
			<!--BEGIN #main-content -->
			<section class="main-content twelve columns">
	            		
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<!--BEGIN .post -->
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
	    
	                    <!--BEGIN .entry-content -->
						<div class="entry-content">

							<?php if(isset($emailSent) && $emailSent == true) { ?>

								<div class="thanks">
									<p><?php _e('Thanks, your email was sent successfully.', 'framework') ?></p>
								</div>

							<?php } else { ?>

								<?php the_content(); ?>
					
								<?php if(isset($hasError) || isset($captchaError)) { ?>
									<p class="error"><?php _e('Sorry, an error occured.', 'framework') ?><p>
								<?php } ?>
				
								<form action="<?php the_permalink(); ?>" id="contactForm" class="contact-form" method="post">
									<ul class="contactform">
										<li><label for="contactName"><?php _e('Name:', 'framework') ?></label>
											<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
											<?php if(isset($errorMessages['nameError'])) { ?>
												<span class="error"><?php echo $errorMessages['nameError']; ?></span> 
											<?php } ?>
										</li>
							
										<li><label for="email"><?php _e('Email:', 'framework') ?></label>
											<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
											<?php if(isset($errorMessages['emailError'])) { ?>
												<span class="error"><?php echo $errorMessages['emailError']; ?></span> 
											<?php } ?>
											<?php if(isset($errorMessages['emailInvalidError'])) { ?>
												<span class="error"><?php echo $errorMessages['emailInvalidError']; ?></span> 
											<?php } ?>
										</li>
							
										<li class="textarea"><label for="commentsText"><?php _e('Message:', 'framework') ?></label>
											<textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
											<?php if(isset($errorMessages['commentError'])) { ?>
												<span class="error"><?php echo $errorMessages['commentError']; ?></span> 
											<?php } ?>
										</li>
							
										<li class="buttons">
											<input type="hidden" name="submitted" id="submitted" value="true" />
											<button type="submit"><?php _e('Send Email', 'framework') ?></button>
										</li>
									</ul>
								</form>
							<?php } ?>

	                    <!-- END .entry-content -->
	                    </div>   
                          
				<!--END posts-->  
				</div>

				<?php endwhile; ?>

			<?php else : ?>

				<!--BEGIN #post-0-->
				<div id="post-0">
				
					<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
				
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						
                        <p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
					
                    <!--END .entry-content-->
					</div>
				
				<!--END #post-404-->
				</div>

			<?php endif; ?>
			<!--END #main-content .twelve .columns-->

		</section>

<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>