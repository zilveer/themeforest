<?php
	$themeforest_url = 'http://themeforest.net';
	$theme_support = 'http://support.thehappybit.com';
	$other_themes = 'http://themes.thehappybit.com';
	$force_regenerate_url = 'http://wordpress.org/extend/plugins/force-regenerate-thumbnails/';
?>
<div class="thb-admin-message">
	<p class="big">
		How to update your copy of <?php echo 'thb_text_domain'; ?>
	</p>
	<p>
		<strong>Important</strong>: when updating your theme, first of all, before beginning the update procedure, make sure to <strong>make a backup</strong> of the theme folder inside your WordPress themes folder, located in /wp-content/themes/your-theme.
	</p>
	<p>Also, before downloading the updated package, make sure to read the version changelog, and the list of changed files.</p>
	<p>To update the your theme, log into your <a href="<?php echo $themeforest_url; ?>" target="_blank">ThemeForest</a> account, head over to your downloads section and re-download the theme as you did when you first purchased it.
	</p>
	<p>Extract the zip file's contents, find the extracted theme folder, and upload it using a FTP client to the /wp-content/themes/your-theme folder in your server. Beware: <strong>this will overwrite the old files</strong>! That's why it's important to backup any changes you've made to the theme files beforehand.
	</p>
	<p>If you didn&#8217;t make any changes to the theme files, you are free to overwrite them with the new files without risk of losing theme settings, pages, posts, etc. Backwards compatibility is guaranteed.
	</p>
	<p>If you have made changes to the theme files, you will need to compare your changed files to the new files listed in the changelog below and merge them together.
	</p>
	<p>We suggest to use the provided <strong>child theme</strong>, as it would not break the theme compatibility with future updates.
	</p>
	<p>When updating, or when switching from a previous WordPress installation, we warmly recommend that you <strong>regenerate the theme's Media Library items thumbnails</strong>: you can do that automatically, using a plugin like "<a href="<?php echo $force_regenerate_url; ?>" target="_blank">Force Regenerate thumbnails</a>". Unused image sizes will also be cleared from your media library.
	</p>
	<p>
		<a href="<?php echo $theme_support; ?>">Theme support</a> | <a href="<?php echo $other_themes; ?>">Other themes</a>
	</p>
</div>