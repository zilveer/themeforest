<?php
	$theme_support = 'http://support.thehappybit.com';
	$other_themes = 'http://themes.thehappybit.com';
?>

<div class="thb-admin-message">
	<span class="thb-discard" data-key="welcome">&times;</span>

	<p class="big">
		Welcome, and thanks for choosing <?php echo THB_THEME_NAME; ?>!
	</p>
	<p>
		Before you get started, you might want to know that a the dummy content file is provided in the theme package and is ready for you to import with the <a href="http://wordpress.org/extend/plugins/wordpress-importer/">WordPress importer</a> plugin. A <code>.thb-backup</code> file is also provided and can be imported via the <code>Framework settings > Import</code> panel, which will set you up with a default options and skin.
	</p>
	<p>
		Feel free to play with the <a href="<?php echo admin_url('themes.php?page=thb-theme-options'); ?>">theme options</a>, and if you want to customize the look of your website, go and play in the <a href="<?php echo admin_url('customize.php'); ?>">theme customization</a> page.
	</p>
	<p>
		<a href="<?php echo $theme_support; ?>">Theme support</a> | <a href="<?php echo $other_themes; ?>">Other themes</a>
	</p>

	<?php do_action('thb_admin_message_welcome'); ?>
</div>