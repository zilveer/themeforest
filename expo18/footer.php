			<div class="container-col-full-width">
				<!-- Footer -->
				<div class="footer">
					<div class="footer-inner">
						<?php get_sidebar('footer-column-left'); ?>
						<?php get_sidebar('footer-column-center'); ?>
						<?php get_sidebar('footer-column-right'); ?>
						<div class="clear"></div>
						<div class="separator"></div>
						<div class="separator s2"></div>
					</div>
				</div>
				<!-- /Footer -->
			</div>
		</div>
	</div>

	<!-- /Container -->

	<!-- SubFooter Line -->
	<div class="subfooterline a-bg-l1">
		<div class="subfooterline-inner">
			<div class="fixw">
				<div class="subfooter-copy">
					<p>
						<?php echo get_option(OM_THEME_PREFIX."footer_text"); ?>
					</p>
				</div>
				<div class="subfooter-social">
					<p>
						<?php
							$icons=om_social_icons_list();
							foreach($icons as $i) {
								if( $icon = get_option(OM_THEME_PREFIX.'social_'.$i) )
									echo '<a href="'. esc_url($icon) .'" class="social '.$i.'" target="_blank"></a>';
							}
						?>
					</p>
				</div>
				<div class="clear">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- /SubFooter Line -->
	
	<?php wp_footer(); ?>
	
	<?php echo get_option( OM_THEME_PREFIX . 'code_before_body' ) ?>
</body>
</html>