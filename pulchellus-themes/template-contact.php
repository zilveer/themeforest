<?php
/*
Template Name: Contact Page
*/	
?>
<?php get_header(); ?>
<?php 
	get_template_part(THEME_INCLUDES.'top');


	wp_reset_query();
	global $post;
	$mail_to = get_option(THEME_NAME."_contact_mail");	
	$contact_subjects = get_option(THEME_NAME."_contact_subjects");	
	$contact_subjects = explode(",", $contact_subjects);
	
	$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
	$sidebarPositionCustom = get_post_meta ( df_page_id(), THEME_NAME."_sidebar_position", true ); 

?>

		<?php if($mail_to) { ?>
			<?php if (have_posts()) : ?>
			<div class="row">
				<?php 
					if( $sidebarPosition == "left" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "left") ) { 
						get_template_part(THEME_INCLUDES."sidebar");
					}
					wp_reset_query();
				?>

				<div id="primary">
					<div class="eleven columns">
		
						<?php the_content(); ?>
						
						<div id="contact">
							<div id="message" style="display: none;">
								<div class="error_message"><?php _e("Attention! Please correct the errors below and try again.",THEME_NAME);?>
									<ul class="error_messages cross">
										<li class="name" style="display: none;"><?php _e("Your name is <strong>required</strong>.",THEME_NAME);?></li>
										<li class="email" style="display: none;"><?php _e("Your e-mail address is <strong>required</strong>.",THEME_NAME);?></li>
										<li class="message" style="display: none;"><?php _e("You must <strong>enter a message</strong> to send.",THEME_NAME);?></li>
									</ul>
								</div>
								<div class="success" style="display: none;"><?php _e("Email sent successfully!",THEME_NAME);?></div>
							</div>
				
							<form method="post" name="contactform" id="contactform">
								<input name="form_type" type="hidden" id="form_type" value="contact" />
								<div id="contact-input">
									<div>
										<label for="name" accesskey="U"><?php _e("Your name",THEME_NAME);?></label>
										<input name="name" type="text" id="name" value="" />
										
									</div>                    	
									<div>
										<label for="email" accesskey="E"><?php _e("Your e-mail adress",THEME_NAME);?></label>
										<input name="email" type="text" id="email" value="" />
									</div>
								</div>
								<div id="contact-subject">
									<label for="subject"><?php _e("Subject",THEME_NAME);?></label>
									<select name="subject" id="subject">
										<option value="None">-</option>
										<?php if(is_array($contact_subjects)) { ?>
											<?php foreach($contact_subjects as $subjects) { ?>
												<?php if($subjects!="") { ?>
													<option value="<?php echo $subjects;?>"><?php echo $subjects;?></option>
												<?php } ?>
											<?php } ?>
										<?php } ?>
									</select>
								</div>   
											<div id="contact-message">
									<label for="comments" accesskey="C"><?php _e("Message",THEME_NAME);?></label>
									<textarea name="comments" id="comments"></textarea>
								</div>

								<div id="contact-submit">
									<input type="submit" class="submit button black" id="submit" value="<?php _e("Submit",THEME_NAME);?>" />
								</div>
				
							</form>
						</div>
					</div>            
				</div>            
			<?php 
				if( $sidebarPosition == "right" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "right") ) { 
					get_template_part(THEME_INCLUDES."sidebar");
				} else if ( $sidebarPosition == "custom" && !$sidebarPositionCustom ) {
					get_template_part(THEME_INCLUDES."sidebar");
				}
			?>
			</div>
		<?php else: ?>
			<p><?php printf ( __('Sorry, no posts matched your criteria.' , THEME_NAME )); ?></p>
		<?php endif; ?>
	<?php } else { echo "<span style=\"color:#000; font-size:14pt;\">You need to set up Your contact mail!</span>"; } ?>
	</div>
<?php get_footer(); ?>