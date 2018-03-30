<?php
/* HTML5 jQuery Audio Player support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('morning_records_html5_jquery_audio_player_theme_setup')) {
    add_action( 'morning_records_action_before_init_theme', 'morning_records_html5_jquery_audio_player_theme_setup' );
    function morning_records_html5_jquery_audio_player_theme_setup() {
        // Add shortcode in the shortcodes list
        if (morning_records_exists_html5_jquery_audio_player()) {
			add_action('morning_records_action_add_styles',					'morning_records_html5_jquery_audio_player_frontend_scripts' );
            add_action('morning_records_action_shortcodes_list',				'morning_records_html5_jquery_audio_player_reg_shortcodes');
			if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
	            add_action('morning_records_action_shortcodes_list_vc',		'morning_records_html5_jquery_audio_player_reg_shortcodes_vc');
            if (is_admin()) {
                add_filter( 'morning_records_filter_importer_options',			'morning_records_html5_jquery_audio_player_importer_set_options', 10, 1 );
                add_action( 'morning_records_action_importer_params',			'morning_records_html5_jquery_audio_player_importer_show_params', 10, 1 );
                add_action( 'morning_records_action_importer_import',			'morning_records_html5_jquery_audio_player_importer_import', 10, 2 );
				add_action( 'morning_records_action_importer_import_fields',	'morning_records_html5_jquery_audio_player_importer_import_fields', 10, 1 );
                add_action( 'morning_records_action_importer_export',			'morning_records_html5_jquery_audio_player_importer_export', 10, 1 );
                add_action( 'morning_records_action_importer_export_fields',	'morning_records_html5_jquery_audio_player_importer_export_fields', 10, 1 );
            }
        }
        if (is_admin()) {
            add_filter( 'morning_records_filter_importer_required_plugins',	'morning_records_html5_jquery_audio_player_importer_required_plugins', 10, 2 );
            add_filter( 'morning_records_filter_required_plugins',				'morning_records_html5_jquery_audio_player_required_plugins' );
        }
    }
}

// Check if plugin installed and activated
if ( !function_exists( 'morning_records_exists_html5_jquery_audio_player' ) ) {
	function morning_records_exists_html5_jquery_audio_player() {
		return function_exists('hmp_db_create');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'morning_records_html5_jquery_audio_player_required_plugins' ) ) {
	//add_filter('morning_records_filter_required_plugins',	'morning_records_html5_jquery_audio_player_required_plugins');
	function morning_records_html5_jquery_audio_player_required_plugins($list=array()) {
        if (in_array('html5_jquery_audio_player', morning_records_storage_get('required_plugins'))) {
            $list[] = array(
                'name' => 'HTML5 jQuery Audio Player',
                'slug' => 'html5-jquery-audio-player',
                'required' => false
            );
        }
        return $list;
	}
}

// Enqueue custom styles
if ( !function_exists( 'morning_records_html5_jquery_audio_player_frontend_scripts' ) ) {
	//add_action( 'morning_records_action_add_styles', 'morning_records_html5_jquery_audio_player_frontend_scripts' );
	function morning_records_html5_jquery_audio_player_frontend_scripts() {
		if (file_exists(morning_records_get_file_dir('css/plugin.html5-jquery-audio-player.css'))) {
			morning_records_enqueue_style( 'morning_records-plugin.html5-jquery-audio-player-style',  morning_records_get_file_url('css/plugin.html5-jquery-audio-player.css'), array(), null );
		}
	}
}



// One-click import support
//------------------------------------------------------------------------

// Check HTML5 jQuery Audio Player in the required plugins
if ( !function_exists( 'morning_records_html5_jquery_audio_player_importer_required_plugins' ) ) {
	//add_filter( 'morning_records_filter_importer_required_plugins',	'morning_records_html5_jquery_audio_player_importer_required_plugins', 10, 2 );
	function morning_records_html5_jquery_audio_player_importer_required_plugins($not_installed='', $list=null) {
		//if ($importer && in_array('html5_jquery_audio_player', $importer->options['required_plugins']) && !morning_records_exists_html5_jquery_audio_player() )
		if (morning_records_strpos($list, 'html5_jquery_audio_player')!==false && !morning_records_exists_html5_jquery_audio_player() )
			$not_installed .= '<br>HTML5 jQuery Audio Player';
		return $not_installed;
	}
}


// Set options for one-click importer
if ( !function_exists( 'morning_records_html5_jquery_audio_player_importer_set_options' ) ) {
    //add_filter( 'morning_records_filter_importer_options',	'morning_records_html5_jquery_audio_player_importer_set_options', 10, 1 );
    function morning_records_html5_jquery_audio_player_importer_set_options($options=array()) {
		if ( in_array('html5_jquery_audio_player', morning_records_storage_get('required_plugins')) && morning_records_exists_html5_jquery_audio_player() ) {
			if (is_array($options['files']) && count($options['files']) > 0) {
				foreach ($options['files'] as $k => $v) {
					$options['files'][$k]['file_with_html5_jquery_audio_player'] = str_replace('posts', 'html5_jquery_audio_player', $v['file_with_posts']);
				}
			}
			// Add option's slugs to export options for this plugin
            $options['additional_options'][] = 'showbuy';
            $options['additional_options'][] = 'buy_text';
            $options['additional_options'][] = 'showlist';
            $options['additional_options'][] = 'autoplay';
            $options['additional_options'][] = 'tracks';
            $options['additional_options'][] = 'currency';
            $options['additional_options'][] = 'color';
            $options['additional_options'][] = 'tcolor';
        }
        return $options;
    }
}

// Add checkbox to the one-click importer
if ( !function_exists( 'morning_records_html5_jquery_audio_player_importer_show_params' ) ) {
    //add_action( 'morning_records_action_importer_params',	'morning_records_html5_jquery_audio_player_importer_show_params', 10, 1 );
    function morning_records_html5_jquery_audio_player_importer_show_params($importer) {
        ?>
        <input type="checkbox" <?php echo in_array('html5_jquery_audio_player', morning_records_storage_get('required_plugins')) && $importer->options['plugins_initial_state']
											? 'checked="checked"' 
											: ''; ?> value="1" name="import_html5_jquery_audio_player" id="import_html5_jquery_audio_player" /> <label for="import_html5_jquery_audio_player"><?php esc_html_e('Import HTML5 jQuery Audio Player', 'morning-records'); ?></label><br>
    <?php
    }
}


// Import posts
if ( !function_exists( 'morning_records_html5_jquery_audio_player_importer_import' ) ) {
    //add_action( 'morning_records_action_importer_import',	'morning_records_html5_jquery_audio_player_importer_import', 10, 2 );
    function morning_records_html5_jquery_audio_player_importer_import($importer, $action) {
		if ( $action == 'import_html5_jquery_audio_player' ) {
            $importer->response['result'] = $importer->import_dump('html5_jquery_audio_player', esc_html__('HTML5 jQuery Audio Player', 'morning-records'));
        }
    }
}

// Display import progress
if ( !function_exists( 'morning_records_html5_jquery_audio_player_importer_import_fields' ) ) {
	//add_action( 'morning_records_action_importer_import_fields',	'morning_records_html5_jquery_audio_player_importer_import_fields', 10, 1 );
	function morning_records_html5_jquery_audio_player_importer_import_fields($importer) {
		?>
		<tr class="import_html5_jquery_audio_player">
			<td class="import_progress_item"><?php esc_html_e('HTML5 jQuery Audio Player', 'morning-records'); ?></td>
			<td class="import_progress_status"></td>
		</tr>
		<?php
	}
}


// Export posts
if ( !function_exists( 'morning_records_html5_jquery_audio_player_importer_export' ) ) {
    //add_action( 'morning_records_action_importer_export',	'morning_records_html5_jquery_audio_player_importer_export', 10, 1 );
    function morning_records_html5_jquery_audio_player_importer_export($importer) {
		morning_records_storage_set('export_html5_jquery_audio_player', serialize( array(
			'hmp_playlist'	=> $importer->export_dump('hmp_playlist'),
			'hmp_rating'	=> $importer->export_dump('hmp_rating')
			) )
		);
    }
}


// Display exported data in the fields
if ( !function_exists( 'morning_records_html5_jquery_audio_player_importer_export_fields' ) ) {
    //add_action( 'morning_records_action_importer_export_fields',	'morning_records_html5_jquery_audio_player_importer_export_fields', 10, 1 );
    function morning_records_html5_jquery_audio_player_importer_export_fields($importer) {
        ?>
        <tr>
            <th align="left"><?php esc_html_e('HTML5 jQuery Audio Player', 'morning-records'); ?></th>
            <td><?php morning_records_fpc(morning_records_get_file_dir('core/core.importer/export/html5_jquery_audio_player.txt'), morning_records_storage_get('export_html5_jquery_audio_player')); ?>
                <a download="html5_jquery_audio_player.txt" href="<?php echo esc_url(morning_records_get_file_url('core/core.importer/export/html5_jquery_audio_player.txt')); ?>"><?php esc_html_e('Download', 'morning-records'); ?></a>
            </td>
        </tr>
    <?php
    }
}





// Shortcodes
//------------------------------------------------------------------------

// Register shortcode in the shortcodes list
if (!function_exists('morning_records_html5_jquery_audio_player_reg_shortcodes')) {
    //add_filter('morning_records_action_shortcodes_list',	'morning_records_html5_jquery_audio_player_reg_shortcodes');
    function morning_records_html5_jquery_audio_player_reg_shortcodes() {
		if (morning_records_storage_isset('shortcodes')) {
			morning_records_sc_map_after('trx_audio', 'hmp_player', array(
                "title" => esc_html__("HTML5 jQuery Audio Player", 'morning-records'),
                "desc" => esc_html__("Insert HTML5 jQuery Audio Player", 'morning-records'),
                "decorate" => true,
                "container" => false,
				"params" => array()
				)
            );
        }
    }
}


// Register shortcode in the VC shortcodes list
if (!function_exists('morning_records_hmp_player_reg_shortcodes_vc')) {
    add_filter('morning_records_action_shortcodes_list_vc',	'morning_records_hmp_player_reg_shortcodes_vc');
    function morning_records_hmp_player_reg_shortcodes_vc() {

        // Morning records HTML5 jQuery Audio Player
        vc_map( array(
            "base" => "hmp_player",
            "name" => esc_html__("HTML5 jQuery Audio Player", 'morning-records'),
            "description" => esc_html__("Insert HTML5 jQuery Audio Player", 'morning-records'),
            "category" => esc_html__('Content', 'morning-records'),
            'icon' => 'icon_trx_audio',
            "class" => "trx_sc_single trx_sc_hmp_player",
            "content_element" => true,
            "is_container" => false,
            "show_settings_on_create" => false,
            "params" => array()
        ) );

        class WPBakeryShortCode_Hmp_Player extends MORNING_RECORDS_VC_ShortCodeSingle {}

    }
}
?>