<?php 
function flow_general_menu() {

    //must check that the user has the required capability 
    if( ! current_user_can('manage_options') ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'flowthemes' ) );
    }

    // variables for the field and option names 
	$hidden_field_name = 'mt_submit_hidden';
	
    $opt_name = 'flow_logo';
    $data_field_name = 'flow_logo';
	$opt_name3 = 'footer_col_countcustom';
    $data_field_name3 = 'footer_col_countcustom';
	$opt_name10 = 'info_box';
    $data_field_name10 = 'info_box';
	$opt_name13 = 'flow_portfolio_page';
    $data_field_name13 = 'flow_portfolio_page';
	
    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	$opt_val3 = get_option( $opt_name3 );
	$opt_val10 = get_option( $opt_name10 );
	$opt_val13 = get_option( $opt_name13 );
	
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset( $_POST[ $hidden_field_name ] ) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
		$opt_val = $_POST[ $data_field_name ];
        $opt_val3 = $_POST[ $data_field_name3 ];
        $opt_val10 = $_POST[ $data_field_name10 ];
        $opt_val13 = $_POST[ $data_field_name13 ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt_name3, $opt_val3 );
        update_option( $opt_name10, $opt_val10 );
        update_option( $opt_name13, $opt_val13 );
		?>
		<div class="updated"><p><strong><?php _e( 'Settings Saved', 'flowthemes' ); ?></strong></p></div>
	<?php } ?>
<div class="wrap">
	<h2><?php _e('General Settings', 'flowthemes'); ?></h2>
	<form name="form-main-page" method="post" action="">
	<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
	
    <table class="form-table flow-admin-table">
        <tr valign="top">
			<th scope="row"><?php _e('Logo', 'flowthemes'); ?></th>
			<td>
				<div class="flowuploader">
					<input class="flowuploader_media_url" type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" />
					<span class="flowuploader_upload_button button"><?php _e('Select image', 'flowthemes'); ?></span>
					<div class="flowuploader_media_preview_image"></div>
				</div>
				<p><?php _e('WordPress will display text logo and tagline unless you put a link to an image logo here. Allowed formats: PNG, JPG, GIF, SVG. Recommended size (demo size): around 150&times;40px. The text logo and tagline can be modified in [Settings > General].', 'flowthemes'); ?></p>
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row"><?php _e('Top Drop-down Panel', 'flowthemes'); ?></th>
			<td>
				<select name="<?php echo $data_field_name10; ?>">
					<option value="0"><?php _e('None', 'flowthemes'); ?></option>
					<?php 
						$pages = get_pages();
						foreach ($pages as $pagg) {
							print("<option value=\"".$pagg->ID."\"".(($opt_val10==$pagg->ID)?" selected=\"selected\"":"").">".$pagg->post_title."</option>");
						}
					?>
				</select>
				<p><?php _e('A page that will be displayed as the top drop-down panel.', 'flowthemes'); ?></p>
			</td>
        </tr>		
		
		<tr valign="top">
			<th scope="row"><?php _e('Main Portfolio Page', 'flowthemes'); ?></th>
			<td><select name="<?php echo $data_field_name13; ?>">
					<option value="0"><?php _e('None', 'flowthemes'); ?></option>
					<?php
					$pages = get_pages();
					foreach ($pages as $pagg) {
						print("<option value=\"".$pagg->ID."\"".(($opt_val13==$pagg->ID)?" selected=\"selected\"":"").">".$pagg->post_title."</option>");
					} ?>
				</select><br/>
				<p><?php _e('Your main portfolio page.<br>1. "Back" button of each project will link to this portfolio page if nothing else is specified under [Portfolio > (a project) > Back Button].<br>2. "View Portfolio" button in "Classic Homepage" will link to this page.<br>3. This must be a page with "Portfolio Template" selected.', 'flowthemes'); ?></p>
			</td>
        </tr>
		
		<tr valign="top">
			<th scope="row"><?php _e('Footer Layout', 'flowthemes'); ?></th>
			<td>
				<div class="footer-new-row">
					<select>
						<option value="grid_12 last">1 Column (100)</option>
						<option value="grid_6, grid_6 last">2 Columns (50|50)</option>
						<option value="grid_4, grid_8 last">2 Columns (33|66)</option>
						<option value="grid_8, grid_4 last">2 Columns (66|33)</option>
						<option value="grid_4, grid_4, grid_4 last">3 Columns (33|33|33)</option>
						<option value="grid_3, grid_3, grid_6 last">3 Columns (25|25|50)</option>
						<option value="grid_3, grid_6, grid_3 last">3 Columns (25|50|25)</option>
						<option value="grid_6, grid_3, grid_3 last">3 Columns (50|25|25)</option>
						<option value="grid_3, grid_3, grid_3, grid_3 last">4 Columns (25|25|25|25)</option>
					</select>
					<button type="button" class="footer-add-new-row">Add New Row</button>
					<button type="button" class="footer-clear-rows">Clear Rows</button>
				</div>
				<div class="clearfix">
					<textarea class="footer-creator-textarea" rows="6" cols="70" name="<?php echo $data_field_name3; ?>"><?php echo $opt_val3; ?></textarea>
					<div class="footer-creator clearfix">
						<div class="footer-columns clearfix"></div>
					</div>
				</div>
				<p><?php printf(__('A comma-separated list of grid system CSS classes.<br><b>Example:</b> 4 equal columns - <code>grid_3, grid_3, grid_3, grid_3 last</code>.<br><b>Default:</b> <code>grid_12 last widget_no_margin, grid_6, grid_6 last</code><br>When you create a column, new widget area is created in [Appearance > Widgets]. Once you\'re done please <a href="%s" target="_blank">add widgets</a> to footer columns.', 'flowthemes'), admin_url( 'widgets.php' )); ?></p>
			</td>
		</tr>
	</table>
	<p class="submit"><input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes', 'flowthemes') ?>" /></p>
</form>
<table class="form-table flow-admin-table">
	<tr valign="top">
		<th scope="row"><?php _e('Uninstall the Theme', 'flowthemes'); ?></th>
		<td>
			<script>
				jQuery(document).ready(function(){
					jQuery('#flow-clean-database').on('click', function(){
						return confirm("<?php _e('Do you really want to remove all the theme settings from the database? This can not be undone.', 'flowthemes'); ?>");
					});
				});
			</script>
			<form id="form-delete-database" name="form-delete-database" method="post" action="">
				<?php wp_nonce_field("flow_clean_nonce_security"); ?>
				<input type="hidden" name="clean_submit_hidden" value="Y">
				<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Clean the Database', 'flowthemes') ?>" id="flow-clean-database" />
			</form>
			<p><?php _e('<strong>Deletes all the theme settings from the database</strong><br>When you deactivate the theme, the settings aren\'t removed &mdash; just in case you wanted to re-activate it. To permanently remove them please click this button. This can not be undone. The demo settings will be imported again once you re-activate the theme. This does not remove posts, pages, projects, media library items etc. It only removes the theme settings.', 'flowthemes'); ?></p>
		</td>
	</tr>
</table>
<?php } ?>
