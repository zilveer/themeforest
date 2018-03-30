<?php


add_action('after_switch_theme', 'aitAfterSwitchTheme');

function aitAfterSwitchTheme($previousTheme)
{
	global $pagenow;

	if($pagenow == "themes.php" and isset($_GET['ait-theme-revert'])){

		switch_theme($previousTheme);
		wp_redirect(admin_url('themes.php'));
		exit;

	}elseif($pagenow == 'themes.php' and isset($_GET['ait-theme-continue'])){

		add_action('load-themes.php', array('AitAdmin', 'activateTheme'));

	}elseif(!isset($_GET['ait-theme-continue'])){

		//require_once dirname(__FILE__) . '/AitRequirementsChecker.inc';
		require_once get_template_directory() . '/ait-theme/@framework/admin/AitRequirementsChecker.inc';

		$checker = new AitRequirementsChecker($previousTheme);
		$report = $checker->check();

		if($report->errors){
			switch_theme($previousTheme);
			update_option('theme_switched', wp_get_theme()->get_stylesheet());
		}

		if($report->errors || $report->warnings){
			$checker->displayReport();
		}
	}
}
