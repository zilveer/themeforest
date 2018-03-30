<?php



function ql_import_page () {
	global $QLC;

	$ql_import_data = isset ( $_POST [ 'ql_import_data' ] ) ? stripslashes ( $_POST [ 'ql_import_data' ] ) : "";
	if ( isset ( $_POST [ 'ql_import_update' ] ) && wp_verify_nonce ( $_POST [ 'qlinonce' ], 'qli' ) ) {
		$qls = preg_split ( '(\n|\r)', $ql_import_data );
		if ( $qls ) {
			if ( $_POST [ "ql_import_clear" ] ) {
				$QLC -> clear ();
			}
			$addedn = 0;
			$overwrittenn = 0;
			$skippedn = 0;
			foreach ( $qls as $row ) {
				if ( $row ) {
					$data = array();
					$row = explode ( '||', str_replace ( "\t", "||", stripslashes ( $row ) ) );
					$id = $QLC -> find_id ( $row [0], $row [2] );
					if ( $id ) {
						if ( $_POST [ "ql_import_overwrite" ] ) {
							$QLC -> update ( $id, $row [0], $row [1], $row [2] );
							$overwrittenn++;
						} else {
							$skippedn++;
						}
					} else {
						$QLC -> add ( $row [0], $row [1], $row [2] );
						$addedn++;
					}
				}
			}
			echo '<div id="message" class="updated fade"><p>' . sprintf ( __ ( 'Import has finished!<br />Added: %d; Overwritten: %d; Skipped: %d.<br />Go to <a href="admin.php?page=ql-home">Edit page</a> to see the results.', "QL" ), $addedn, $overwrittenn, $skippedn ) . '</p></div>';
		}
	}
?>	
	<div class="wrapper">
	<h2><?php _e ( "Quick Localisation", "QL" ); ?> - <?php _e ( "Import", "QL" ); ?></h2>
	<form method='post'>
	<?php wp_nonce_field ( "qli", "qlinonce" ); ?>
	<p><?php _e ( "Format:", "QL" ); ?></p>
	<p><b><?php _e ( "Old", "QL" ); ?> [ || <?php _e ( "New", "QL" ); ?> [ || <?php _e ( "Domain", "QL" ); ?> ]]</b></p>
	<p><?php _e ( "e.g.", "QL" ); ?> <code><?php _e ( "Old Text", "QL" ); ?> || <?php _e ( "New Text", "QL" ); ?></code></p>
	<p><?php _e ( "e.g.", "QL" ); ?> <code><?php _e ( "Old Text", "QL" ); ?> || <?php _e ( "New Text", "QL" ); ?> || default</code></p>
	<p><textarea name="ql_import_data" rows="20" cols="100"><?php echo esc_textarea ( $ql_import_data ); ?></textarea></p>
	<p><input type="checkbox" value="1" name="ql_import_overwrite" id="ql_import_overwrite" <?php echo $_POST [ "ql_import_overwrite" ] || ! isset ( $_POST [ "ql_import_update" ] ) ? 'checked="yes"' : ''; ?>/><label for="ql_import_overwrite"> <?php _e ( "Overwrite existing values", "QL" ); ?></label></p>
	<p><input type="checkbox" value="1" name="ql_import_clear" id="ql_import_clear" <?php echo $_POST [ "ql_import_clear" ] ? 'checked="yes"' : ''; ?>/><label for="ql_import_clear"> <?php _e ( "Erase all existing items prior to import", "QL" ); ?></label></p>
	<p><input type="hidden" name="ql_import_update"/></p>
	<p><input class="button-primary" type="submit" name="save" value="<?php _e ( "Import", "QL" ); ?>" /></p>
	<hr style="width:96%;" size="1" />
	
	<h3><?php _e ( "Existing translations", "QL" ); ?></h3>
	<p style='font-size:12px;'><?php _e ( 'This plugin is already translated into some languages. Corresponding import files can be downloaded <a href="http://name.ly/plugins/quick-localization/ql-languages/">here</a>.', "QL" ); ?></p>
	<p style='font-size:12px;'><?php _e ( 'There, you can also get a sample English-to-English QL file. Simply edit the second column in your language and import above.', "QL" ); ?></p>
	<p style='font-size:12px;'><?php _e ( 'If you want to translate this plugin, please <a href="http://name.ly/about/contact/">contact</a> <a href="http://name.ly/"><i>Name.ly</i></a> team.', "QL" ); ?></p>
	<hr style="width:96%;" size="1" />
	
	</div>

<?php

} // end of function ql_import_page ()



?>