<?php
global $rt_update_xml,$rt_themeupdatestatus; 
?>
 
 
	<div class="wrap">
		
	 	   	
		<?php if($rt_themeupdatestatus):?>
			<?php if( (float)$rt_update_xml->latest == 0 ) :?> 		
				<div id="message" class="error below-h2"><p>PROBLEMS TO READ THE UPDATE LOGS! PLEASE VISIT YOUR THEMEFOREST DOWNLOADS PAGE OR <a href="http://themeforest.net/user/stmcan/portfolio">THEME DASHBOARD</a> AND CHECK IF THE THEME HAS BEEN UPDATED.</p></div>
			<?php elseif( (float)$rt_update_xml->latest > (float)$this->version):?> 		
				<div id="message" class="error below-h2"><p> There is a new version of the <?php echo RT_THEMENAME; ?> theme <strong>available.</strong> You have version <?php echo $this->version; ?> installed. Update to version <?php echo $rt_update_xml->latest; ?>. </p></div>
			<?php else:?>
				<div id="message" class="updated below-h2"><p>Your theme is up to date.</p></div>
			<?php endif;?>

		<?php else:?>
			<div id="message" class="error below-h2"><p>Update notifier has been closed! You can turn on via General Options.</p></div>
		<?php endif;?>				
	    

	   <?php if($rt_themeupdatestatus):?>
			 <?php if( (float)$rt_update_xml->latest > (float)$this->version):?>
			 <div id="instructions">
				
				<hr />
				<h3>Update Download and Instructions</h3>
				<hr />
				<p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress installation folder <strong>/wp-content/themes/<?php echo RT_NOTIFIER_THEME_FOLDER_NAME; ?>/</strong></p>
				<p>To update the Theme, login to <a href="http://www.themeforest.net/">ThemeForest</a>, head over to your <strong>downloads</strong> section and re-download the theme like you did when you bought it.</p>
				<p>Extract the zip's contents, look for the extracted theme folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/themes/<?php echo RT_NOTIFIER_THEME_FOLDER_NAME; ?>/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the theme files).</p>
				<p>If you didn't make any changes to the theme files, you are free to overwrite them with the new ones without the risk of losing theme settings, pages, posts, etc, and backwards compatibility is guaranteed.</p>
			 </div>
			<?php endif;?>
			
			<hr /><h3 class="title">Changelog</h3>

			<hr />
			
			<div class="changelog_list">

				<pre style="font-size: 12px; background: none repeat scroll 0px 0px rgb(247, 247, 247); overflow: scroll; padding: 20px;">
					<?php echo $rt_update_xml->changelog; ?>
				</pre>

			</div>
	    <?php endif;?>
	</div>
 