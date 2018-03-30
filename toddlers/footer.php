<?php global $unf_options; ?>
</div>
	<div class="newlandscape clearfix">
		<div class="onleft">
		<?php if( $unf_options['unf_hidebillboard'] == "0") {?>
			<div class="billboard">
					<div class="billboard-content">

						<?php if( $unf_options['unf_billboardcontent'] == '1') { // MAILCHIMP SUBSCRIBE FORM ?>
							<?php if (!empty($unf_options['unf_mcsubscribetitle'] )) {?>
								<h3><?php echo wp_kses_post($unf_options['unf_mcsubscribetitle']); ?></h3>
							<?php } ?>
								<?php echo do_shortcode('[mc4wp_form]'); ?>
						<?php } ?>
						<?php if( $unf_options['unf_billboardcontent'] == '2') { // HTML ?>
							<?php echo wp_kses_post($unf_options['unf_billboardhtml']); ?>
						<?php } ?>

					</div>
			</div>
		<?php } ?>
		</div>
		<div class="onright">
		</div>
	</div>
	<div class="footer-wrap">
		<div class="container">

			<div class="row clearfix">
				<div class="col-sm-6 column">
					<div class="copyrightbox clearfix">
						<?php
							if (!empty($unf_options['unf_copyrighttext'] )) {
							echo wp_kses_post($unf_options['unf_copyrighttext']);
							} else { ?>
					    	 &copy; <?php echo date('Y'); ?> <?php echo bloginfo( 'name' ); ?>.
					    <?php } ?>
					</div>
				</div>
				<div class="col-sm-6 column">
					<?php if( $unf_options['unf_showfootnav'] == "1") {?>
						<?php unf_footer_menu(); ?>
					<?php } ?>
				</div>
			</div>

		</div>
	</div>

<?php wp_footer(); ?>
</body>
</html>