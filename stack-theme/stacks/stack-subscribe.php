<div class="stack stack-callout" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">
	<div class="span8">
	<div class="padding-right-20">
		<div class="callout-text"><?php echo $stack['stack_title']; ?></div>
	</div>
	</div>
	<div class="span4">

		<?php 
		// MailChimp
		if( $stack['service'] == 'mailchimp' ): ?>
			<form class="optin-form ajax-form validate-form" method="post" action="<?php echo home_url(); ?>/wp-admin/admin-ajax.php">
				<div class="optin-wrap">
					<input type="hidden" name="action" value="mail_subscribe" />
					<input type="hidden" name="service" value="<?php echo $stack['service']; ?>"/>
					<input type="hidden" name="mailchimp_api_key" value="<?php echo base64_encode($stack['mailchimp_api']); ?>"/>
					<input type="hidden" name="mailchimp_list_id" value="<?php echo $stack['mailchimp_list_id']; ?>"/>
					<input type="email" name="email" class="optin-email" placeholder="Email Address ..." data-rule-required="true" data-rule-email="true" data-msg-email='<?php echo __("Please enter valid email.", "theme_front"); ?>' data-msg-required='<?php echo __("Please fill your email.", "theme_front"); ?>'/>
					<input type="submit" value="" class="optin-submit button" />
					<i class="icon icon-angle-right"></i>
				</div>

				<div class="form-response"></div>
			</form>
		<?php endif; ?>

		<?php 
		// Aweber
		if( $stack['service'] == 'aweber' ): ?>
			<form class="optin-form validate-form" action="http://www.aweber.com/scripts/addlead.pl">
			<div class="optin-wrap">
				<input type="hidden" name="listname" value="<?php echo $stack['aweber_list_id']; ?>" />
				<input type="hidden" name="redirect" value="<?php echo getUrl(); ?>" />
				<input type="email" name="email" class="optin-email" placeholder="Email Address ..." data-rule-required="true" data-rule-email="true" data-msg-email='<?php echo __("Please enter valid email.", "theme_front"); ?>' data-msg-required='<?php echo __("Please fill your email.", "theme_front"); ?>'/>
				<input type="submit" value="" class="optin-submit button" />
					<i class="icon icon-angle-right"></i>
			</div>
			</form>
		<?php endif; ?>

	</div>
</div>
</div>
</div><!-- .stack-subscribe -->