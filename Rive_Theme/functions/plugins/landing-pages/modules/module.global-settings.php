<?php

if ( is_admin() ) {
	global $lp_global_settings;

	//define main tabs and bind display functions

	if ( isset( $_GET['page'] )&&( $_GET['page']=='lp_global_settings'&&$_GET['page']=='lp_global_settings' ) ) {
		add_action( 'admin_init', 'lp_global_settings_enqueue' );
		function lp_global_settings_enqueue() {
			wp_enqueue_style( 'lp-css-global-settings-here', LANDINGPAGES_URLPATH . 'css/admin-global-settings.css' );
			//wp_enqueue_script('lp-js-global-settings', LANDINGPAGES_URLPATH . 'js/admin.global-settings.js');
		}
	}

	/*SETUP NAVIGATION AND DISPLAY ELEMENTS*/
	$tab_slug = 'main';
	$lp_global_settings[$tab_slug]['label'] = 'Global Settings';

	$lp_global_settings[$tab_slug]['options'][] = lp_add_option( $tab_slug, "text", "landing-page-permalink-prefix", "go", "Default landing page permalink prefix", "Enter in the 'prefix' for landing page permalinks. eg: /prefix/pemalink-name", $options=null );
	//$lp_global_settings[$tab_slug]['options'][] = lp_add_option( $tab_slug, "text", "landing-page-group-permalink-prefix", "group", "Default split testing group permalink prefix", "Enter in the 'prefix' for split testing group permalinks. eg: /prefix/pemalink-name", $options=null );
	//$lp_global_settings[$tab_slug]['options'][] = lp_add_option( $tab_slug, "radio", "landing-page-auto-format-forms", "1", "Enable Form Standardization", "With this setting enabled landing pages plugin will clean and standardize all input ids and classnames. Uncheck this setting to disable standardization.", $options= array( '1'=>'on', '0'=>'off' ) );
	/*SETUP END*/

	function lp_get_global_settings_elements() {
		global $lp_global_settings;
		return $lp_global_settings;
	}

	function lp_display_global_settings_js() {
		global $lp_global_settings;
		$lp_global_settings = lp_get_global_settings_elements();

		if ( isset( $_GET['tab'] ) ) {
			$default_id = $_GET['tab'];
		}
		else {
			$default_id ='main';
		}

?>
		<script type='text/javascript'>
			jQuery(document).ready(function()
			{
				jQuery('#<?php echo $default_id; ?>').css('display','block');
				 setTimeout(function() {
	     			var getoption = document.URL.split('&option=')[1];
					var showoption = "#" + getoption;
					jQuery(showoption).click();
    			}, 100);

				<?php
		foreach ( $lp_global_settings as $key => $array ) {
?>
					jQuery('.lp-nav-tab').live('click', function() {

						var this_id = this.id.replace('tabs-','');
						//alert(this_id);
						jQuery('.lp-tab-display').css('display','none');
						jQuery('#'+this_id).css('display','block');
						jQuery('.lp-nav-tab').removeClass('nav-tab-special-active');
						jQuery('.lp-nav-tab').addClass('nav-tab-special-inactive');
						jQuery('#tabs-'+this_id).addClass('nav-tab-special-active');
						jQuery('#id-open-tab').val(this_id);


					});
				<?php
		}
?>
			});
		</script>
		<?php
	}

	function lp_display_global_settings() {
		global $wpdb;
		global $lp_global_settings;
		$lp_global_settings = lp_get_global_settings_elements();
		$active_tab = 'main';
		if ( isset( $_REQUEST['open-tab'] ) ) {
			$active_tab = $_REQUEST['open-tab'];
		}

		lp_display_global_settings_js();
		lp_save_global_settings();

		echo '<h2 class="nav-tab-wrapper">';

		foreach ( $lp_global_settings as $key => $data ) {
?>
			<a  id='tabs-<?php echo $key; ?>' class="lp-nav-tab nav-tab nav-tab-special<?php echo $active_tab == $key ? '-active' : '-inactive'; ?>"><?php echo $data['label']; ?></a>
			<?php
		}
		echo '</h2>';
		echo "<form action='edit.php?post_type=landing-page&page=lp_global_settings' method='POST'>";
		echo "<input type='hidden' name='nature' value='lp-global-settings-save'>";
		echo "<input type='hidden' name='open-tab' id='id-open-tab' value='{$active_tab}'>";
		foreach ( $lp_global_settings as $key => $array ) {
			$these_settings = $lp_global_settings[$key]['options'];
			lp_render_global_settings( $key, $these_settings, $active_tab );
		}
		echo '<div style="float:left;padding-left:9px;padding-top:20px;">
				<input type="submit" value="Save Settings" tabindex="5" id="lp-button-create-new-group-open" class="button-primary" >
			</div>';
		echo "</form>";
?>

		<div class="clear" style="margin-top:68px; display:block; padding-top: 10px;margin-left:10px;postion:relative;color:#a9a9a9">
		 <h3>Installation Status</h3>
              <table class="form-table">

                <tr valign="top">
                   <th scope="row"><label>PHP Version</label></th>
                    <td class="installation_item_cell">
                        <strong><?php echo phpversion(); ?></strong>
                    </td>
                    <td>
                        <?php
		if ( version_compare( phpversion(), '5.0.0', '>' ) ) {
?>
                                <img src="<?php echo LANDINGPAGES_URLPATH;?>/images/tick.png"/>
                                <?php
		}
		else {
?>
                                <img src="<?php echo LANDINGPAGES_URLPATH;?>/images/cross.png"/>
                                <span class="installation_item_message"><?php _e( "Gravity Forms requires PHP 5 or above.", "gravityforms" ); ?></span>
                                <?php
		}
?>
                    </td>
                </tr>
                <tr valign="top">
                   <th scope="row"><label>MySQL Version</label></th>
                    <td class="installation_item_cell">
                        <strong><?php echo $wpdb->db_version();?></strong>
                    </td>
                    <td>
                        <?php
		if ( version_compare( $wpdb->db_version(), '5.0.0', '>' ) ) {
?>
                                <img src="<?php echo LANDINGPAGES_URLPATH;?>/images/tick.png"/>
                                <?php
		}
		else {
?>
                                <img src="<?php echo LANDINGPAGES_URLPATH;?>/images/cross.png"/>
                                <span class="installation_item_message"><?php _e( "Gravity Forms requires MySQL 5 or above.", "gravityforms" ); ?></span>
                                <?php
		}
?>
                    </td>
                </tr>
                <tr valign="top">
                   <th scope="row"><label>WordPress Version</label></th>
                    <td class="installation_item_cell">
                        <strong><?php echo get_bloginfo( "version" ); ?></strong>
                    </td>
                    <td>
                        <?php
		if ( version_compare( get_bloginfo( "version" ), '3.3', '>' ) ) {
?>
                                <img src="<?php echo LANDINGPAGES_URLPATH;?>/images/tick.png"/>
                                <?php
		}
		else {
?>
                                <img src="<?php echo LANDINGPAGES_URLPATH;?>/images/cross.png"/>
                                <span class="installation_item_message">landing pages requires version X or higher</span>
                                <?php
		}
?>
                    </td>
                </tr>
                 <tr valign="top">
                   <th scope="row"><label>Landing Page Version</label></th>
                    <td class="installation_item_cell">
                        <strong>Version <?php echo landing_page_get_version();?></strong>
                    </td>
                    <td>
                        <?php /* This might help get version numbers http://wordpress.stackexchange.com/questions/361/is-there-a-way-for-a-plug-in-to-get-its-own-version-number/371#371
                            if(version_compare(GFCommon::$version, $version_info["version"], '>=')){
                                ?>
                                <img src="<?php echo LANDINGPAGES_URLPATH;?>/images/tick.png"/>
                                <?php
                            }
                            else{
                                echo sprintf(__("New version %s available. Automatic upgrade available on the %splugins page%s", "gravityforms"), $version_info["version"], '<a href="plugins.php">', '</a>');
                            } */
?>
                    </td>
                </tr>
            </table>
        </div>
	<?php
	}

	function lp_save_global_settings() {

		$lp_global_settings = lp_get_global_settings_elements();

		if ( !isset( $_POST['nature'] ) )
			return;


		foreach ( $lp_global_settings as $key=>$array ) {
			$lp_options = $lp_global_settings[$key]['options'];
			//echo 1;

			// loop through fields and save the data
			foreach ( $lp_options as $option ) {
				//echo $option['id'].":".$_POST['main-landing-page-auto-format-forms']."<br>";
				$old = get_option( $option['id'] );
				$new = $_POST[$option['id']];

				if ( ( isset( $new ) && $new !== $old )|| !isset( $old ) ) {
					//echo $option['id'];exit;
					$bool = update_option( $option['id'], $new );
					if ( $option['id']=='main-landing-page-permalink-prefix'||$option['id']=='main-landing-page-group-permalink-prefix' ) {
						global $wp_rewrite;
						$wp_rewrite->flush_rules();
					}
				}
				elseif ( '' == $new && $old ) {
					$bool = update_option( $option['id'], $option['default'] );
				}
			} // end foreach
		}

	}
	//exit;
}

?>
