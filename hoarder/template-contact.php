<?php
/*
Template Name: Contact
*/
?>

<?php 

/* Edit the error messages here --------------------------------------------------*/
$nameError = __( 'Please enter your name.', 'zilla' );
$emailError = __( 'Please enter your email address.', 'zilla' );
$emailInvalidError = __( 'You entered an invalid email address.', 'zilla' );
$commentError = __( 'Please enter a message.', 'zilla' );
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
			$emailTo = zilla_get_option('general_contact_email');
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}			
			$subject = '[Contact Form] From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>
<?php get_header(); ?>

			<script type="text/javascript">
    			jQuery(document).ready(function(){
    				jQuery("#contactForm").validate({
    					messages: {
    						contactName: '<?php echo $nameError; ?>',
    						email: {
    							required: '<?php echo $emailError; ?>',
    							email: '<?php echo $emailInvalidError; ?>'
    						},
    						comments: '<?php echo $commentError; ?>'
    					}
    				});
    			});
			</script>

			<!-- BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
                <?php zilla_page_before(); ?>
				<!-- BEGIN .hentry-->
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<?php zilla_page_start(); ?>
				
					<h1 class="entry-title"><?php the_title(); ?></h1>
                    <?php if ( current_user_can( 'edit_post', $post->ID ) ): ?>
                    
                    <!-- BEGIN .entry-meta-header-->
					<div class="entry-meta-header">
						<?php edit_post_link( __('edit', 'zilla'), '<span class="edit-post">[', ']</span>' ); ?>
					<!-- END .entry-meta-header-->
                    </div>
                    <?php endif; ?>

					<!-- BEGIN .entry-content -->
					<div class="entry-content">

				<?php if(isset($emailSent) && $emailSent == true) { ?>

					<div class="thanks">
						<p><?php _e('Thanks, your email was sent successfully.', 'zilla') ?></p>
					</div>

				<?php } else { ?>

					<?php the_content(); ?>
		
					<?php if(isset($hasError) || isset($captchaError)) { ?>
						<p class="error"><?php _e('Sorry, an error occured.', 'zilla') ?><p>
					<?php } ?>
	
					<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
						<ul class="contactform">
							<li><label for="contactName"><?php _e('Name:', 'zilla') ?></label>
								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
								<?php if(isset($errorMessages['nameError'])) { ?>
									<span class="error"><?php echo $errorMessages['nameError']; ?></span> 
								<?php } ?>
							</li>
				
							<li><label for="email"><?php _e('Email:', 'zilla') ?></label>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
								<?php if(isset($errorMessages['emailError'])) { ?>
									<span class="error"><?php echo $errorMessages['emailError']; ?></span> 
								<?php } ?>
								<?php if(isset($errorMessages['emailInvalidError'])) { ?>
									<span class="error"><?php echo $errorMessages['emailInvalidError']; ?></span> 
								<?php } ?>
							</li>
				
							<li class="textarea"><label for="commentsText"><?php _e('Message:', 'zilla') ?></label>
								<textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
								<?php if(isset($errorMessages['commentError'])) { ?>
									<span class="error"><?php echo $errorMessages['commentError']; ?></span> 
								<?php } ?>
							</li>
				
							<li class="buttons">
								<input type="hidden" name="submitted" id="submitted" value="true" />
								<button type="submit"><?php _e('Send Email', 'zilla') ?></button>
							</li>
						</ul>
					</form>
				<?php } ?>
				</div><!-- .entry-content -->	
				
				<?php zilla_page_end(); ?>
				<!-- END .hentry-->
				</div>
				<?php zilla_page_after(); ?>
				
				<?php endwhile; endif; ?>
			
			<!-- END #primary .hfeed-->
			</div>
			
<?php get_sidebar('page'); ?>

<?php get_footer(); ?>