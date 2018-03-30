<?php
/*
Template Name: Contact Template
*/
?>
<?php
get_header(); ?>
<?php if ( is_front_page() ) { ?>
	<h2 class="entry-title"><?php the_title(); ?></h2>
<?php } else { ?>
	<h1 class="entry-title"><?php the_title(); ?></h1>
<?php } ?>

<div class="page-contents-wrap float-left two-column">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<div class="entry-page-wrapper entry-content clearfix">
			
			<?php the_content() ?> <!-- Display Content -->
				
				<div>
							<h3><?php echo of_get_option('ctemplate_title'); ?></h3>
							<div id="contactform">
								<div id="successmessage">
										<?php echo of_get_option('ctemplate_thankyou'); ?>
								</div>
								<form id="contact">
									<fieldset>
										<label for="name" id="name_label"><?php echo of_get_option('ctemplate_lname'); ?></label>
										<div class="error" id="error-name">
											<?php echo of_get_option('ctemplate_errorname'); ?>
										</div>
										<input type="text" name="name" id="name" size="60" value="" class="text-input"/>
										<label for="email" id="email_label"><?php echo of_get_option('ctemplate_lemail'); ?></label>
										<div class="error" id="error-email-msg1">
											<?php echo of_get_option('ctemplate_erroremail'); ?>
										</div>
										<div class="error" id="error-email-msg2">
											<?php echo of_get_option('ctemplate_invalidemail'); ?>
										</div>
										<input type="text" name="email" id="email" size="60" value="" class="text-input"/>
										<label for="subject" id="subject_label"><?php echo of_get_option('ctemplate_lsubject'); ?></label>
										<input type="text" name="subject" id="subject" size="60" value="" class="text-input"/>
										<label for="msg" id="msg_label"><?php echo of_get_option('ctemplate_lmessage'); ?></label>
										<div class="error" id="error-message">
											<?php echo of_get_option('ctemplate_errormsg'); ?>
										</div>
										<textarea cols="60" rows="10" name="msg" id="msg" class="text-input"></textarea>
										<button type="submit" name="submit" class="button form-button" id="submit_button"><?php echo of_get_option('ctemplate_button'); ?></button>
									</fieldset>
								</form>
							</div>
							<!-- end of contactform -->
						</div>
				<div class="clear"></div>	
				<?php edit_post_link( __('edit this entry','mthemelocal') ,'<p class="edit-entry">','</p>'); ?>	
			</div>

	</div>

	
 <!-- Post Loop -->
<?php endwhile; ?>

<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>