<div id="air-wrap">

	<div id="air-header">
		<ul>
			<li id="air-theme-version"><?php air_theme_version(); ?></li>
			<li id="air-air-version"><?php air_framework_version(); ?></li>
			<li id="logo"><a id="wpbandit-logo" href="http://wpbandit.com" target="_blank">WPBandit</a></li>
		</ul>
	</div><!--/air-header-->

	<div id="air-content">

		<div id="air-sidebar">
			<ul id="air-menu">
				<?php air_theme_options_menu(); ?>
			</ul>
		</div><!--/air-sidebar-->

		<div id="air-main">

			<div id="air-subheader">
				<?php air_settings_saved_notice(); ?>

				<ul id="air-headmenu">
					<li><a href="http://wpbandit.com/themes/" target="_blank"><i class="air-icon air-icon-themes"></i>More Themes</a></li>
					<li><a href="http://wpbandit.com/forums/" target="_blank"><i class="air-icon air-icon-forums"></i>View Forums</a></li>
					<li <?php if('changelog' == $section) echo 'class="current"'; ?>><a href="<?php echo admin_url('/admin.php?page=theme-options&section=changelog'); ?>"><i class="air-icon air-icon-changelog"></i>View Changelog</a></li>
				</ul>
			</div><!--/air-subheader-->

			<form method="post" action="options.php">
				<div id="air-main-inner" class="air-text">
					<?php if( 'changelog' !== $section): ?>
						<?php settings_fields('air-settings'); ?>
						<?php do_settings_sections('air-'.$section); ?>		
						<input type="hidden" name="<?php echo Air::get('theme-options'); ?>[section]" value="<?php echo $section; ?>">
					<?php else: ?>
						<pre><?php require ( get_template_directory().'/changelog.txt' ); ?></pre>
					<?php endif; ?>
					<div class="air-clear"></div>
				</div><!--/air-main-inner-->
			
				<div id="air-footer">
					<p class="submit air-submit">
						<input type="submit" name="<?php echo Air::get('theme-options'); ?>[reset]" class="button-secondary" value="Reset Options" />
						<input type="submit" class="button-primary" value="Save Changes" />
					</p>
				</div><!--/air-footer-->
			</form>

		</div><!--/air-main-->

		<div class="air-clear"></div>
	</div><!--/air-content-->

</div><!--/air-wrap-->