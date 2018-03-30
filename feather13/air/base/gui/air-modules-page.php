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
				<?php air_theme_modules_menu(); ?>
			</ul>
		</div><!--/air-sidebar-->

		<div id="air-main">

			<div id="air-subheader">
				<?php air_settings_saved_notice(); ?>
				
				<ul id="air-headmenu">
					<li><a href="http://wpbandit.com/themes/" target="_blank"><i class="air-icon air-icon-themes"></i>More Themes</a></li>
					<li><a href="http://wpbandit.com/forums/" target="_blank"><i class="air-icon air-icon-forums"></i>View Forums</a></li>
					<li><a href="<?php echo admin_url('/admin.php?page=theme-options&section=changelog'); ?>"><i class="air-icon air-icon-changelog"></i>View Changelog</a></li>
				</ul>
			</div><!--/air-subheader-->

			<?php require ( AIR_MODULES . '/' . $module . '/' . $module.'-options-page.php' ); ?>

		</div><!--/air-main-->

		<div class="air-clear"></div>
	</div><!--/air-content-->

</div><!--/air-wrap-->
