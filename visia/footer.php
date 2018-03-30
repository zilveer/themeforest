<?php $t =& peTheme(); ?>
<?php $layout =& $t->layout; ?>

<!-- Begin Footer -->
<footer id="footer" class="clearfix">
	<div class="content dark container">

		<!-- Contact Links -->
		<ul class="contact animated hatch clearfix">
			<?php if ( $t->options->get("contactPhone") ) : ?>
			<li class="grid-2">
				<p>
				<i class="icon-phone"></i>
				<br>
				<?php echo $t->options->get("contactPhone"); ?>
			</li>
			<?php endif; ?>
			<?php if ( $t->options->get("contactEmail") ) : ?>
			<li class="grid-2">
				<a id="contact-open" href="#">
					<p>
						<i class="icon-mail"></i>
						<br>
					<?php echo $t->options->get("contactEmail"); ?>
					</p>
				</a>
			</li>
			<?php endif; ?>
			<?php if ( $t->options->get("contactAddress") ) : ?>
			<li class="grid-2">
				<a href="<?php echo esc_attr( $t->options->get("contactAddressLink") ); ?>" target="_blank">
					<p>
						<i class="icon-location"></i>
						<br>
					<?php echo $t->options->get("contactAddress"); ?>
					</p>
				</a>
			</li>
			<?php endif; ?>
		</ul>
	</div>

	<!-- Contact Form -->
	<div id="contact-form" class="dark clearfix">
		<div class="container">
			<div class="contact-heading grid-full">
				<h3><?php echo $t->options->get("contactHeading"); ?></h3>
				<span class="border"></span>
			</div>
		</div>

		<form action="#" method="post" class="contactForm peThemeContactForm container" id="contactform">
			<fieldset>
				<div class="form-field grid-half control-group">
					<label for="name"><?php _e("Name",'Pixelentity Theme/Plugin'); ?></label>
					<span><input type="text" class="required" name="name" id="name" /></span>
				</div>
				<div class="form-field grid-half  control-group">
					<label for="email"><?php _e("Email",'Pixelentity Theme/Plugin'); ?></label>
					<span><input type="email" class="required" name="email" id="email" /></span>
				</div>
				<div class="form-field grid-full control-group">
					<label for="message"><?php _e("Message",'Pixelentity Theme/Plugin'); ?></label>
					<span><textarea name="message" class="required" id="message"></textarea></span>
				</div>
			</fieldset>
			<div class="form-click grid-full">
				<span><button name="send" type="submit" dir="ltr" lang="en" class="submit" id="submit"><?php _e("Send",'Pixelentity Theme/Plugin'); ?></button></span>
			</div>
			<div id="contactFormSent" class="grid-full formSent alert"><?php echo $t->options->get("msgOK"); ?></div>
			<div id="contactFormError" class="grid-full formError alert"><?php echo $t->options->get("msgKO"); ?></div>
		</form>	
	</div>

	<div class="container">

		<!-- Social Links -->
		<ul class="social-links grid-full">
			<?php $t->content->socialLinks($t->options->get("footerSocialLinks"),"bottom"); ?>
		</ul>

		<!-- Copyright Info -->
		<div class="copyright grid-full"><h6><?php echo $t->options->get("footerCopyright"); ?></h6></div>

	</div>
</footer>
<!-- End Footer -->
							
<?php $t->footer->wp_footer(); ?>

</body>
</html>
