<?php
global $xml,$theme_data,$themeupdatestatus;
?>
 
<table>
    <tr> 
	<td class="col1" colspan="2">  
	<div class="wrap">
		
	    <div id="message" class="updated below-h2"><p><strong>	   	
			 <?php if($themeupdatestatus):?>
				<?php if( (float)$xml->latest > (float)$theme_data['Version']):?> 		
					There is a new version of the <?php echo THEMENAME; ?> theme available.</strong> You have version <?php echo $theme_data['Version']; ?> installed. Update to version <?php echo $xml->latest; ?>.
				<?php else:?>
					Your theme is up to date.
				<?php endif;?>
			 <?php else:?>
				 Update notifier has been closed! You can turn on via General Options.
			 <?php endif;?>				
	    </p></div>

	   <?php if($themeupdatestatus):?>
			 <?php if( (float)$xml->latest > (float)$theme_data['Version']):?>
			 <img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" />
			 <div id="instructions">
				<h3>Update Download and Instructions</h3>
				<p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress installation folder <strong>/wp-content/themes/<?php echo NOTIFIER_THEME_FOLDER_NAME; ?>/</strong></p>
				<p>To update the Theme, login to <a href="http://www.themeforest.net/">ThemeForest</a>, head over to your <strong>downloads</strong> section and re-download the theme like you did when you bought it.</p>
				<p>Extract the zip's contents, look for the extracted theme folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/themes/<?php echo NOTIFIER_THEME_FOLDER_NAME; ?>/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the theme files).</p>
				<p>If you didn't make any changes to the theme files, you are free to overwrite them with the new ones without the risk of losing theme settings, pages, posts, etc, and backwards compatibility is guaranteed.</p>
			 </div>
			<?php endif;?>
			
			<h3 class="title">Changelog</h3><hr style="width:500px;" />
			<div class="changelog_list"><?php echo $xml->changelog; ?></div>
	    <?php endif;?>
	</div>

	</td>
</table>     