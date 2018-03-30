<?php
/*
Template Name: Contact Us
*/
?>



<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.defaultvalue.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/contact_us.js"></script>

<div id="page-title" class="clearfix">
	<div class="container_12">
    	<div class="grid_12">
        	<h1><?php the_title();?></h1>
        </div>
	</div>
</div>
<?php if (get_option('themeteam_origami_enable_breadcrumbs') == 'true'){ ?>
<div id="breadcrumbs" class="clearfix">
	<div class="container_12">
    	<div class="grid_12">
		<?php breadcrumbs(get_option('themeteam_origami_enable_breadcrumbs')); ?>
		</div>
	</div>
</div>
<?php } ?>
<div id="container" class="clearfix">
	<div class="container_12">
    	<div class="col2-right-layout clearfix">
        	<div class="clearfix">
           		<?php get_sidebar('contactus'); ?>
            	<div class="grid_8">
					<div id="mainContactUs" class="contactform large">

					<?php if (have_posts()) : ?>
	
						<?php while (have_posts()) : the_post(); ?>
	        
					        <?php if(isset($emailSent) && $emailSent == true) { ?>
								<div class="half left success-msg">
			          				<p>Your message has been sent</p>
			          				<h4>thank you!</h4>
								</div>
								
					
							<?php } else { ?> 
								<div class="entry">
									<?php the_content();?>
								</div>
								 
								<form action="<?php bloginfo('template_directory'); ?>/submit-contactus.php" id="contactForm" method="post">
									<?php if(isset($hasError) || isset($captchaError)) { ?>
									<p class="error">There was an error submitting the form.<p>
									<?php } ?>
									
									<?php if(!get_option('themeteam_origami_email_contact')) { ?>
									<p class="error">You have not set your email address in the Origami options admin panel<p>
									<?php } ?>
									
									<p>
										<input type="text" name="contactName" id="contactName1" class="requiredField" value="<?php if(isset($_POST['contactName1'])) echo $_POST['contactName1']; ?>"/>
										<?php if($nameError != '') { ?>
											<span class="error"><?=$nameError;?></span> 
										<?php } ?>
									</p>
									<p>	
										<input type="text" name="email" id="email1" class="requiredField email" value="<?php if(isset($_POST['email1']))  echo $_POST['email1'];?>"/>
										<?php if($emailError != '') { ?>
											<span class="error"><?=$emailError;?></span>
										<?php } ?>
									</p>
									<p>
										<textarea name="commentsText" id="commentsText1" rows="12" cols="30" class="requiredField"><?php if(isset($_POST['commentsText1'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['commentsText1']); } 
										else { echo $_POST['comments']; } } ?></textarea>
										<?php if($commentError != '') { ?>
											<span class="error"><?=$commentError;?></span> 
										<?php } ?>
									</p>
									<p>
									<input type="hidden" name="submitted" id="submitted" value="true" />
									<input type="hidden" name="emailTo" id="emailTo" value="<?php echo nospam(get_option('themeteam_origami_email_contact'));?>" /> 
                                    <button class="button small <?php echo $GLOBALS['button_css'];?>" ><span><span>SUBMIT</span></span></button>
                                    </p>
								</form>
							<?php } ?>
						<?php endwhile; ?>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--div.col2-right-layout end -->
<?php get_footer(); ?>
	
