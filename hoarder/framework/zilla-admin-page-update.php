<?php

/**
 * Update Theme Page
 */
function zilla_update_page(){    
	?>
	<div class="wrap">
		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'Theme Updates', 'zilla' ); ?></h2>
		<?php 
		if( $xml = zilla_get_theme_changelog() ) {
		    
		    $theme_data = get_option('zilla_framework_options' );
		    $theme_name = $theme_data['theme_name'];
		    $theme_version = $theme_data['theme_version'];
            		    
			if( version_compare( $theme_version, $xml->latest ) == -1 ){
				?>
				<div id="message" class="updated below-h2">
					<p><?php echo sprintf( __('<strong>There is a new version of the %s theme available.</strong> You have version %s installed. Update to version %s', 'zilla' ), $theme_name, $theme_version, $xml->latest ); ?></p>
				</div>
		 		<img style="width:200px;float:left;margin:0 20px 20px 0;border:1px solid #ddd;" src="<?php echo get_template_directory_uri() .'/screenshot.png'; ?>" alt="" />
		 		<h3>Update Download and Instructions</h3>
				<p><strong>Important:</strong> make a backup of the <?php echo $theme_name; ?> theme inside your WordPress installation folder <code><?php echo str_replace( site_url(), '', get_template_directory_uri() ); ?></code> before attempting to update.</p>
				
				<p>To update the <?php echo $theme_name; ?> theme, login to your ThemeForest account, head over to your downloads section and re-download the theme as you did when you purchased it.</p>
				
				<p>Extract the zip's contents, find the extracted theme folder, and upload the new files using FTP to the <code><?php echo str_replace( site_url(), '', get_template_directory_uri() ); ?></code> folder. This will overwrite the old files and is why it's important to backup any changes you've made to the theme files beforehand.</p>
								
				<p>If you didn't make any changes to the theme files, you are free to overwrite them with the new files without risk of losing theme settings, pages, posts, etc, and backwards compatibility is guaranteed.</p>
				
				<p>If you have made changes to the theme files, you will need to compare your changed files to the new files listed in the changelog below and merge them together.</p><br />
				<?php
			} else {
				?>
				<p>The <?php echo $theme_name; ?> theme is currently up to date at version <?php echo $theme_version; ?></p>
				<?php
			}
			?>
			<h3 class="title zilla-clear"><?php _e( 'Changelog', 'zilla' ); ?></h3>
			<?php echo $xml->changelog; ?>
			<?php
		} else {
			_e( '<p>Error: Unable to fetch the changelog.</p>', 'zilla' );
		}
		?>
	</div>
	<?php
}

?>