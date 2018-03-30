<?php global $unf_options; ?>

<?php if(isset($emailSent) && $emailSent == true) { ?>
					<div class="alert alert-success">
						<h1><?php if( isset($unf_options['unf_contact-thanks'])) {echo esc_html($unf_options['unf_contact-thanks']);} else { echo "Thanks";}?> <?php echo $name;?></h1>
						<p><?php if( isset($unf_options['unf_contact-success-message'])) {echo esc_html($unf_options['unf_contact-success-message']);} else { echo "Your email was successfully sent.";}?>
						</p>
					</div>
				<?php } ?>

				<?php if(isset($hasError) || isset($captchaError)) { ?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<h4><?php if( isset($unf_options['unf_contact-form-error-title'])) {echo esc_html($unf_options['unf_contact-form-error-title']);} else { echo "Whoops!";}?></h4>
						<?php if( isset($unf_options['unf_contact-form-error'])) {echo esc_html($unf_options['unf_contact-form-error']);} else { echo "There was an error submitting the form.";}?>
					</div>
				<?php } ?>

<div class="contact-well contact_block">
	<form id="contactForm" action="<?php the_permalink(); ?>" method="post">
		<div class="form-group">

			<div class="controls">
				<label class="control-label" for="contactName" id="Name">
			<?php if( isset($unf_options['unf_contact-name-label'])) {echo esc_html($unf_options['unf_contact-name-label']);} else { echo "Name";}?>
			</label>
				<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo esc_html($_POST['contactName']);?>" class="requiredField form-control" />
				<?php if(isset($nameError) && $nameerror != '') { ?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php echo esc_html($nameError);?>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<div class="controls">

			<label class="control-label" for="email">
			<?php if( isset($unf_options['unf_contact-email-label'])) {echo esc_html($unf_options['unf_contact-email-label']);} else { echo "Email";}?></label>
				<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo esc_attr($_POST['email']);?>" class="requiredField email form-control" placeholder="<?php if( isset($unf_options['unf_contact-email-placeholder'])) {echo esc_attr($unf_options['unf_contact-email-placeholder']);} else { echo "your@email.com";}?>" />
				<?php if(isset($emailError) && $emailError != '') { ?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php echo esc_html($emailError);?>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">

			<div class="controls">
				<label class="control-label" for="commentsText">
			<?php if( isset($unf_options['unf_contact-message-label'])) {echo esc_html($unf_options['unf_contact-message-label']);} else { echo "Message";}?>
			</label>
				<textarea name="comments" id="commentsText" rows="10" class="requiredField form-control">
				<?php
					if(isset($_POST['comments'])) {
						echo esc_textarea($_POST['comments']);
					}?>
				</textarea>
				<?php if(isset($commentError) && $commentError != '') { ?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php echo esc_html($commentError);?>
				</div>
				<?php } ?>
			</div>
		</div>


<?php if ( $unf_options['unf_switch_sendselfcopy'] == '1' ) { ?>
		<div class="form-group">
			<div class="controls">
				<label class="checkbox">
				<input type="checkbox" name="sendCopy" id="sendCopy" value="true"<?php if(isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) echo ' checked="checked"'; ?> >
				<?php if( isset($unf_options['unf_contact-send-a-copy'])) {echo $unf_options['unf_contact-send-a-copy'];} else { echo "Send a copy of this email to yourself";}?>
				</label>
			</div>
		</div>
<?php } ?>

		<div class="form-group form-checker">
			<div class="controls">
				<label for="checking" class="screenReader">
				If you want to submit this form, do not enter anything in this field
				</label>
				<input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo esc_attr($_POST['checking']);?>" />
			</div>
		</div>
		<div class="form-group">
			<div class="controls">
				<input type="hidden" name="submitted" id="submitted" value="true" />
				<button type="submit" class="btn btn-primary sendmessagebtn" ><?php if( isset($unf_options['unf_contact-send-message'])) {echo esc_html($unf_options['unf_contact-send-message']);} else { echo "Send Message";}?>
</button>
			</div>
		</div>
	</form>
</div>