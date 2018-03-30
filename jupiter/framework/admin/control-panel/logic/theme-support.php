<div class="control-panel-holder">

	<?php echo mk_get_control_panel_view('header', true, array('page_slug' => 'theme-support')); ?>

	<div class="support-page cp-pane">
			<h3><?php _e( 'Learn &amp; Support', 'mk_framework'); ?></h3>
			<?php
				$mk_artbees_products = new mk_artbees_products();
				if ( !$mk_artbees_products->is_verified_artbees_customer() ) {
					echo mk_get_control_panel_view('register-product-popup', true, array('message' => 'In order to access our Help desk and submit a ticket you need to register this product first.<br> <a target="_blank" href="https://artbees.net/themes/docs/how-to-register-theme/">Learn how to register</a>')); 
				}
			?>
			<div class="cp-support">
				<a class="cp-support-title" href="https://artbees.net/themes/support/<?php echo strtolower(THEME_NAME); ?>/docs" target="_blank"><?php _e('Documentation', 'mk_framework'); ?></strong></a>
				<p><?php _e( 'Read helpful resources regarding how to use Jupiter more efficiantly.', 'mk_framework'); ?></p>
			</div>

			<div class="cp-support">
				<a class="cp-support-title" href="https://artbees.net/themes/support/<?php echo strtolower(THEME_NAME); ?>/videos" target="_blank"><?php _e('Video Tutorials', 'mk_framework'); ?></a>
				<p><?php _e( 'Watch tons of narrated video tutorials.', 'mk_framework'); ?></p>
			</div>

			<div class="cp-support">
				<a class="cp-support-title" href="https://artbees.net/themes/support/<?php echo strtolower(THEME_NAME); ?>/faq" target="_blank"><?php _e('FAQ', 'mk_framework'); ?></a>
				<p><?php _e( 'The most frequent asked questions are answered here.', 'mk_framework'); ?></p>
			</div>

			<div class="cp-support">
				<a class="cp-support-title" href="https://artbees.net/themes/support/<?php echo strtolower(THEME_NAME); ?>" target="_blank"><?php _e('Ask our experts', 'mk_framework'); ?></a>
				<p><?php _e( 'Any question that is not addressed on documentations? Ask it from Artbees experts. Note that you need to register to be able to submit a new ticket.', 'mk_framework'); ?></p>
				<a href="https://artbees.net/themes/support/<?php echo strtolower(THEME_NAME); ?>" target="_blank" class="cp-button medium blue"><?php _e('Submit a Ticket', 'mk_framework'); ?></a>
			</div>
			
			<div class="cp-support">
				<a class="cp-support-title" href="http://forums.artbees.net/c/<?php echo strtolower(THEME_NAME); ?>" target="_blank"><?php _e('Join Community', 'mk_framework'); ?></a>
				<p><?php _e( 'Join the Artbees themes community. It is a cool and cozy place! Help people and get help.', 'mk_framework'); ?></p>
			</div>

			<div class="cp-support">
				<a class="cp-support-title" href="https://artbees.net/themes/artbees-care" target="_blank"><?php _e('Customise Jupiter', 'mk_framework'); ?></a>
				<p><?php _e( 'Have any more customization beyond what Jupiter offers? Artbees experts are here to help.', 'mk_framework'); ?></p>
				<a href="http://artbees.net/themes/artbees-care" target="_blank" class="cp-button medium blue"><?php _e('Hire Our Experts', 'mk_framework'); ?></a>
			</div>
		
	</div>
</div>