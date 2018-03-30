<?php
/*********************/
/* Add the update JS */
function ocmx_theme_update_script (){
	wp_enqueue_script( "ocmx-update", get_template_directory_uri("template_directory")."/ocmx/includes/upgrade.js", array( "jquery" ) );
	wp_localize_script( "ocmx-update", "ThemeAjax", array( "ajaxurl" => admin_url( "admin-ajax.php" ) ) );
	add_action( 'wp_ajax_do_theme_upgrade', 'do_theme_upgrade' );
	add_action( 'wp_ajax_do_ocmx_upgrade', 'do_ocmx_upgrade' );
}
add_action("init", "ocmx_theme_update_script");

/********************************/
/* Add it to the OCMX Interface */
function ocmx_theme_update_options(){
	$ocmx_tabs = array(
					array(
						  "option_header" => "Update Your Theme",
						  "use_function" => "ocmx_theme_update",
						  "function_args" => "",
						  "ul_class" => "content clearfix",
					  )
				);
	$ocmx_container = new OCMX_Container();
	$ocmx_container->load_container("Update Your Theme ", $ocmx_tabs, "");
};

/********************************************************************/
/* Add the Update Option to the admin menu, after the other options */
function add_update_page(){
	add_submenu_page("functions.php", "Update", "Update", "administrator", "ocmx-update", 'ocmx_theme_update_options');
}
add_filter("admin_menu", "add_update_page", 11);

/*******************************/
/* The Auto Update Starts here */
function ocmx_theme_update(){
	global $obox_productid, $ocmx_version;
	$themes = wp_get_themes();
	$current_theme = wp_get_theme();
	$theme_version = $current_theme->Version;
	$i = 2;
	$theme_updates = 0;
	$response = wp_remote_get( "http://www.obox-design.com/hotfixes-".$obox_productid.".xml" ); ?>
	 <div class="rss-widget">
			 <div class="table table_content">
			<h3> Welcome to the OCMX Theme Updater</h3>
			<?php if( is_wp_error( $response ) ){
				echo '<p>It seems that your server is not setup to allow remote queries, and therefore will not allow the update list to load. We suggest <a href="http://www.obox-design.com/hotfixes.cfm?theme=' .$obox_productid . '" target="_blank">downloading the updates manually</a></p>';
				return;
			} else {
				$xml =  new SimpleXMLElement ( $response['body'] );
			}; ?>
			<p><a href="http://kb.oboxthemes.com/articles/how-to-update-your-theme/">View detailed instructions</a> if you have an eCommerce theme or need assistance.</p>
			<p>To update your theme:</p>
			<p>
				<ol>
					<li>Click Install next to the update file with a version higher than your installed version, if available.</li>
					<li>For example, if your version is 1.2.0 and there is 1.2.1 and 1.2.2 available, click install for 1.2.1, then proceed with 1.2.2 and so on.</li>
					<li>Wait for the update to finish before proceeding to other updates.</li>
				</ol>
			</p>
			<p>If you had previously modified theme files that are overwritten by an update, you must move the changes into the new file. Do not overwrite or restore updated theme files with older versions, or the theme may break!</p>
				<?php if($xml != "") : ?>
					<p class="sub">
						This Theme's Latest Version: <strong><?php echo $xml->channel->version; ?></strong> | <a href="http://www.obox-design.com/hotfixes.cfm?theme=<?php echo $obox_productid; ?>" target="_blank">Download Updates Manually</a>
					</p>
				<?php endif; ?>
			</div>
		<table class="widefat">
				<thead>
					<tr>
						<th>Updates</th>
						<th colspan="2" width="15%" align="right">Your Installed Version: <?php echo $theme_version; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if($xml != "") :
						$updates_run_array = get_option("theme-$obox_productid-updates");
						foreach ($xml->channel->item as $xml_object => $value) :
							if(
								( $updates_run_array == '' && $theme_version < $xml->channel->version ) ||
								( $updates_run_array != '' && ! in_array( $value->version, $updates_run_array ) )
							) :

								$ver_id = str_replace(".", "-", $value->version, $i);
								$update_list = explode(",", $value->updatefiles); ?>
								<tr rel="<?php echo $value->file; ?>" id="upgrade-tr-<?php echo $ver_id; ?>">
									<td width="1%">
										<strong>Update <?php echo $value->version; ?> </strong>
									</td>
									<td><?php echo $value->description; ?></td>
									<td align="center">
										<a rel="<?php echo $value->file; ?>" id="upgrade-button-<?php echo $value->version; ?>" class="button">Install</a>
										<span style="float: right; display: none; margin-left: 10px;" id="upgrade-status-<?php echo $ver_id; ?>">
											<img src="/wp-admin/images/loading.gif" />
										</span> <br /> <br />
										<a href="#" rel="#upgrade-files-<?php echo $ver_id; ?>" id="upgrade-files-href-<?php echo $ver_id; ?>">File List</a>
									</td>
								</tr>
								<tbody id="upgrade-files-<?php echo $ver_id; ?>" class="no_display">
									<tr>
										<td></td>
										<td colspan="2">
											<strong>Changed Files:</strong>
											<pre><?php echo str_replace(", ", "<br />", $value->updatefiles); ?></pre>
										</td>
									</tr>
								</tbody>
						<?php $theme_updates++;
							elseif ( $updates_run_array != '' && in_array( $value->version, $updates_run_array ) ) : ?>
								<tr>
									<td width="1%">
										<strong>Update <?php echo $value->version; ?> </strong>
									</td>
									<td colspan="2">
										You have installed this update.
									</td>
								</tr>
						<?php elseif ( $theme_updates == 0 ) : ?>
								<tr><td colspan="3"><p>You have the latest version of this theme.</p></td></tr>
						<?php 		break;
							endif;
						endforeach;
					else : ?>
						<tr><td colspan="2"><p>There are no updates available for this theme.</p></td></tr>
					<?php endif; ?>
				</tbody>
			</table>
			<br />
		<table class="widefat">
			<thead>
				<tr>
					<th>OCMX Updates</th>
				</tr>
			</thead>
			<tbody>
				<?php $ocmx_feed = "http://www.obox-design.com/hotfixes-ocmx.xml";
				$ocmx_response = wp_remote_get($ocmx_feed);
				$ocmx_xml = new SimpleXMLElement ( $ocmx_response['body'] );
				$ocmx_updates = 0;
				if( is_array( $ocmx_xml ) && !empty( $ocmx_xml ) ) {
					foreach ($ocmx_xml->channel->item as $xml_object => $value) :
						$ver_id = str_replace(".", "-", $value->version, $i); ?>
						<?php if(str_replace(".", "", $value->version, $i) > str_replace(".", "", $ocmx_version, $i)) : ?>
							<tr rel="<?php echo $value->file; ?>" id="upgrade-tr-<?php echo $ver_id; ?>">
								<td>
									<p>
										<strong>Update <?php echo $value->version; ?>: </strong>
										<?php echo $value->description; ?>
									</p>
								</td>
							</tr>
						<?php $ocmx_updates++;
						endif;
					endforeach;
				}
				if($ocmx_updates == 0) : ?>
					<tr><td><p>You have the latest version of OCMX</p></td></tr>
				<?php endif;?>
			</tbody>
		</table>
		<?php if($ocmx_updates !== 0) : ?>
			<p align="right">
				<a rel="<?php echo $value->file; ?>" id="upgrade-ocmx-button-<?php echo $ocmx_xml->channel->version; ?>" class="button">Update to OCMX <?php echo $ocmx_xml->channel->version; ?></a>
				<span style="float: right; display: none; margin-left: 10px;" id="upgrade-status-<?php echo str_replace(".", "-", $ocmx_xml->channel->version, $i); ?>">
					<img src="images/loading.gif" />
				</span>
			</p>
		<?php  endif; ?>
</div>
<?php
}
add_action("ocmx_theme_update", "ocmx_theme_update");

function do_ocmx_upgrade(){
	global $obox_productid;
	$theme_upgrade = new obox_theme_update();
	$destination = get_template_directory();
	$zipfile = $_GET["zipfile"];
	$version = $_GET["version"];

	$package = "http://www.obox-design.com/ocmx_hotfix.cfm?ver=$version";
	$defaults = array( 	'package' => $package, //Please always pass this.
						'destination' => $destination, //And this
						'clear_destination' => false,
						'clear_working' => true,
						'is_multi' => false,
						'hook_extra' => array() //Pass any extra $hook_extra args here, this will be passed to any hooked filters.
					);
	$show_progress = $theme_upgrade->run($defaults);

	if ( is_wp_error($show_progress) ) :
		echo $show_progress->get_error_message();
	endif;

	die("");
};
function do_theme_upgrade(){
	global $obox_productid;
	$theme_upgrade = new obox_theme_update();
	$destination = get_template_directory();
	$zipfile = $_GET["zipfile"];
	$version = $_GET["version"];

	$package = "http://www.obox-design.com/hotfixes/new/$zipfile";
	$defaults = array( 	'package' => $package, //Please always pass this.
						'destination' => $destination, //And this
						'clear_destination' => false,
						'clear_working' => true,
						'is_multi' => false,
						'hook_extra' => array() //Pass any extra $hook_extra args here, this will be passed to any hooked filters.
					);
	$show_progress = $theme_upgrade->run($defaults);

	if ( is_wp_error($show_progress) ) :
		echo $show_progress->get_error_message();
	endif;

	if(!get_option("theme-$obox_productid-updates")) :
		$theme_versions = array();
		$theme_versions[] = $version;
	else :
		$theme_versions = get_option("theme-$obox_productid-updates");
		$theme_versions[] = $version;
	endif;

	if(!get_option("theme-$obox_productid-updates") || !in_array($value->version, get_option("theme-$obox_productid-updates"))):
		update_option("theme-$obox_productid-updates", $theme_versions);
	endif;

	die("");
}; ?>