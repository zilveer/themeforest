<?php
/**
 * Check for update
 * Display update Instruction if the theme is not up to date
 *
 * @since 1.3.5
 * @package WolfFramework
 * @author WolfThemes
 */
?>
<div class="wrap">
	<h2><?php _e( 'Theme Updates', 'wolf' ); ?></h2>

	<?php
	$parent_theme = wolf_get_theme_slug();

if ( $xml = wolf_get_theme_changelog() ) {

	if ( -1 == version_compare( WOLF_THEME_VERSION, $xml->latest ) ) {

		$content_folder = str_replace( network_site_url(), '', get_template_directory_uri() );

		?>
		<div id="message" class="updated">
			<p><strong><?php printf( __( 'There is a new version of %s available.', 'wolf' ),  ucfirst( $parent_theme ) ); ?></strong>
				<?php printf( __( 'You have version %s installed.', 'wolf' ),  WOLF_THEME_VERSION ); ?>
				<?php printf( __( 'Update to version %s', 'wolf' ),  $xml->latest ); ?>
			</p>
		</div>
 		<img style="width:200px;float:left;margin:0 20px 10px 0;border:1px solid #ddd;" src="<?php echo esc_url( WOLF_THEME_URI . '/screenshot.png' ); ?>" alt="screenshot" />
 		<h3><?php _e( 'Update Download and Instructions', 'wolf' ); ?></h3>

		<p><?php printf( __(  '<strong>Important :</strong> make a backup of the %1$s theme inside your WordPress installation folder %2$s before attempting to update.', 'wolf' ),  $parent_theme, '<code>' . $content_folder . '</code>' ); ?></p>
		<p><?php printf( __( 'To update the %s theme, login to your ThemeForest account, go to your downloads section and re-download the theme as you did when you purchased it.', 'wolf' ),  $parent_theme ); ?></p>

		<?php // Child ?>
		<p><?php _e( 'If you didn\'t make any changes to the theme files, you are free to overwrite them with the new files without risk of losing your theme settings.', 'wolf' ); ?></p>
		<p><?php printf( __( 'If you want to edit the theme files it is recommended to create a <a href="%s" target="_blank">child theme</a>.', 'wolf' ), 'http://codex.wordpress.org/Child_Themes' ); ?></p>
		<br>
		<?php
			if ( class_exists( 'Wolf_Update_Zip' ) ) {
				$wolf_do_theme_update_zip = new Wolf_Update_Zip;
				$wolf_do_theme_update_zip->update_zip_form();
			}
		?>

 		<?php // FTP instruction ?>
		<h4><?php _e( 'Update through FTP', 'wolf' ); ?></h4>
		<p><?php printf( __( 'Extract the zip\'s contents, find the <strong>%1$s</strong> theme folder, and upload the new files using your FTP client to the %2$s folder. This will overwrite the old files.', 'wolf' ), $parent_theme,  '<code>' . $content_folder . '</code>' ); ?></p>
		<p><?php _e( 'If you encounter any issue after update, remove all old files before uploading the new ones.', 'wolf' ); ?></p>

		<?php


	} else {
		?>
		<p><?php printf(
			__( 'The %1$s theme is currently up to date at version %2$s', 'wolf' ), $parent_theme, WOLF_THEME_VERSION
		); ?></p>
		<?php
	}
	?>
	<hr>
	<h3><?php _e( 'Changelog', 'wolf' ); ?></h3>
	<div id="wolf-changelog">
		<?php if ( '' !== (string)$xml->warning ) : ?>
			<div id="wolf-changelog-warning"><?php echo sanitize_text_field( $xml->warning ); ?></div>
		<?php endif ?>
		<?php if ( '' !== (string)$xml->info ) : ?>
			<div id="wolf-changelog-info"><?php echo sanitize_text_field( $xml->info ); ?></div>
		<?php endif ?>
		<div style="font-family :'andale mono', 'lucida console', monospace">
			<?php echo wp_kses( $xml->changelog, array(
				'h4' => array(),
				'ul' => array(),
				'ol' => array(),
				'li' => array(),
				'strong' => array(),
			) ); ?>
		</div>
	</div>
	<hr>
	<h3><?php _e( 'Details', 'wolf' ); ?></h3>
	<div id="wolf-theme-details">
		<p><?php _e( 'Requires', 'wolf' ); ?> : Wordpress <?php echo sanitize_text_field( $xml->requires ); ?></p>
		<p><?php _e( 'Tested', 'wolf' ); ?> : Wordpress <?php echo sanitize_text_field( $xml->tested ); ?></p>
		<p><?php _e( 'Last update', 'wolf' ); ?> : <?php echo sanitize_text_field( $xml->date ); ?></p>
	</div>
	<?php
} else {
	echo '<p>';
	_e( 'Unable to load the changelog', 'wolf' );
	echo '</p>';
}
?></div>