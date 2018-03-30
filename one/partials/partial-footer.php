<?php
$thb_socials = thb_get_social_networks();
$thb_get_copyright = thb_get_copyright();
?>

<?php if ( !empty($thb_socials) || !empty($thb_get_copyright) ) : ?>
	<footer id="footer">
		<div class="<?php echo thb_footerskin(); ?>">
			<div class="thb-section-container">

				<div class="thb-footer-inner-wrapper">

					<?php if ( thb_get_copyright() != '' ) : ?>
						<div id="copyright">
							<?php thb_copyright(); ?>
						</div>
					<?php endif; ?>

					<?php if ( count( $thb_socials ) > 0 ) : ?>
						<div id="social-icons">
							<?php foreach ( $thb_socials as $social ) : ?>
								<a href="<?php echo thb_get_social_network_url( $social ); ?>" target="_blank" class="thb-social-icon thb-<?php echo str_replace('social_', '', $social); ?>">
									<?php echo $social; ?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

				</div>

			</div>
		</div>
	</footer>

<?php endif; ?>