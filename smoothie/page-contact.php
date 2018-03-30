<?php
/*

Template Name: Contact

*/
?>
<?php

	if(isset($_POST['submitted'])) {
        if(trim($_POST['contactName']) === '') {
               $nameError = 'Please enter your name.';
               $hasError = true;
        } else {
               $name = trim($_POST['contactName']);
        }

        if(trim($_POST['email']) === '')  {
               $emailError = 'Please enter your email address.';
               $hasError = true;
        } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
               $emailError = 'You entered an invalid email address.';
               $hasError = true;
        } else {
               $email = trim($_POST['email']);
        }

        if(trim($_POST['comments']) === '') {
               $commentError = 'Please enter a message.';
               $hasError = true;
        } else {
               if(function_exists('stripslashes')) {
                       $comments = stripslashes(trim($_POST['comments']));
               } else {
                       $comments = trim($_POST['comments']);
               }
        }

        if(!isset($hasError)) {
               $emailTo = get_option('tz_email');
               if (!isset($emailTo) || ($emailTo == '') ){
                       $emailTo = get_option('admin_email');
               }
               $subject = 'Contact Form Submission from '.get_bloginfo('name').' by '.$name;
               $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
               $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
               wp_mail($emailTo, $subject, $body, $headers);
               $emailSent = true;
        }
} ?>

<?php get_header(); ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/js/contact-form/contact-form.js"></script>

<?php if(isset($emailSent) && $emailSent == true) { ?>
<div id="content">
	<div class="post page">

			<div class="box">

					<div class="thanks" style="padding: 60px 25px;">
						<h1>Thanks, <?php echo $name; ?></h1>
						<p>Your email was successfully sent. I will be in touch soon.</p>
					</div>

			</div>	

	</div>
</div>
<?php } else { ?>
		<div id="content">
			<!-- grab the posts -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div <?php post_class('post clearfix'); ?>>
				<div class="box">
					<div class="frame frame-full">
						<div class="title-wrap">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						</div>

						<div class="post-content">
							<?php the_content(); ?>
							<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
								
									<p>
										<input type="text" name="contactName" id="contactName" value="" placeholder="Name" required />
									</p>
									<p>
										<input type="email" name="email" id="email" value="" placeholder="Email" required />
									</p>
									<p>
										<textarea name="comments" id="commentsText" rows="20" cols="30" placeholder="Message" required ></textarea>
									</p>
									<p>
										<input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit" id="submittedContact">Send</button>
									</p>
								
									
							</form>
						</div>
					</div><!-- frame -->
				</div><!-- box -->
			</div><!--writing post-->			
			
			<?php endwhile; ?>
			<?php endif; ?>
			
		</div><!--content-->
<?php } ?>
		<!-- grab the sidebar -->
		<?php get_sidebar(); ?>
	
		<!-- grab footer -->
		<?php get_footer(); ?>
