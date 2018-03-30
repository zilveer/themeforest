<?php
GLOBAL $webnus_options;
?>

<section class="footer-subscribe-bar">
	<div class="container">
		<div class="row">
		<?php $type = $webnus_options->webnus_footer_subscribe_type();
		if($type=='FeedBurner'){ ?>
			<form class="footer-subscribe-form" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onSubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $webnus_options->webnus_footer_feedburner_id() ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
				<input type="hidden" value="<?php echo $webnus_options->webnus_footer_feedburner_id() ?>" name="uri"/>
				<input type="hidden" name="loc" value="en_US"/>
		<?php } elseif($type=='MailChimp'){ ?>	
			<form class="widget-subscribe-form" action="<?php echo $webnus_options->webnus_footer_mailchimp_url(); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
		<?php } ?>		
				<div class="footer-subscribe-text col-md-6 col-sm-12">
					<h6>SUBSCRIBE <span>NEWSLETTER</span></h6>
					<p><?php echo $webnus_options->webnus_footer_subscribe_text() ?></p>
				</div>
				<div class="col-md-4 col-sm-8 col-xs-12">
					<input placeholder="your email here.." class="footer-subscribe-email" type="text" name="<?php echo($type=='MailChimp')?'MERGE0':'email'; ?>"/>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-12">
					<button class="footer-subscribe-submit" type="submit">SUBSCRIBE</button>
				</div>
			</form>	
		</div>
	</div>
</section>