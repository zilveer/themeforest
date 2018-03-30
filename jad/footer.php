<?php
	$sb = _sg('Sidebars')->getSidebar('footer');
	wp_reset_query();
?>
		</div>
	</div>
	<?php if (sg_get_tpl() == 'page|home' AND _sg('Slider')->getSliderType() == 'full' AND _sg('Slider')->getSlidesCount() > 0) { ?>
			<?php _sg('Theme')->eBGsf(); ?>
		</div>
	<?php } ?>
	<a class="totop" href="#"></a>
	<div class="ef-footer<?php echo (_sg('HandF')->footerState() == 'o') ? ' ef-open-footer' : ''; ?>">
		<?php if (_sg('HandF')->showTwitter()) { ?>
			<div class="ef-twitter-module">
				<div class="ef-canvas clearfix">
					<div class="ef-col ef-gu12">
						<div class="ef-tweet-module"></div>
					</div>
				</div>
				<script type="text/javascript">
					jQuery(".ef-tweet-module").tweet({
						modpath: "<?php echo get_template_directory_uri(); ?>/includes/twitter/",
						count: 1,
						avatar_size: 50,
						username: "<?php _sg('HandF')->eTwitterProfile(); ?>",
						loading_text: "<?php _e('Loading tweets...', SG_TDN); ?>",
						refresh_interval: 60
					}).bind("loaded", function() {
						jQuery(this).find("a").attr("target", "_blank");
					});
				</script>
			</div>
		<?php } ?>
		<?php if ($sb != SG_Module::USE_NONE) { ?>
			<div class="ef-expandable-wrap">
				<div class="expandable-inner">
					<div class="ef-canvas clearfix">
						<div class="ef-full-grid gu12">
							<a href="#" class="ef-open-close"></a>
						</div>
					</div>
					<div class="ef-canvas ef-expandable">
						<div class="ef-full-grid gu12">
							<div class="ef-row clearfix">
								<?php
									if ($sb == SG_Module::USE_DEFAULT) {
										sg_bottom_sidebar();
									} else {
										if (!dynamic_sidebar($sb)) {
											sg_empty_sidebar(_sg('Sidebars')->getSidebarName($sb));
										}
									}
								?>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<div class="ef-copyrignts">
			<div class="ef-canvas">
				<div class="ef-full-grid gu12">
					<?php _sg('HandF')->eCopyright(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php if (sg_get_tpl() != 'page|home' OR _sg('Slider')->getSliderType() != 'full' OR _sg('Slider')->getSlidesCount() == 0) _sg('Theme')->eBGsf(); ?>
<?php sg_footer_js(); ?>
<?php wp_footer(); ?>
<?php _sg('General')->eAnalyticsCode(); ?>
</body>
</html>