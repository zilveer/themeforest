<?php
add_action('wp_ajax_a13_font_details', 'a13_font_details');

function a13_font_details() {
    $searched_font = $_POST['font'];
    $google_fonts = json_decode(file_get_contents( A13_TPL_ADV_DIR . '/inc/google-font-json' ));

    $font = '';
    $found = false;

    foreach( $google_fonts->items as $font ) {
        if($font->family == $searched_font){
            $found = true;
            break;
        }

    }

    echo  json_encode($found? $font :  false);

    die(); // this is required to return a proper result
}



add_action('wp_ajax_a13_import_demo_data', 'a13_import_demo_data');

function a13_import_demo_data() {
	require_once(dirname(__FILE__). '/demo_data.php');

	$level          = $_POST['level'];
	$sublevel       = $_POST['sublevel'];
	$sublevel_name  = '';
	$log            = '';

	$levels = array(
		'_'                     => '', //empty to avoid bonus logic
		'start'                 => a13__be('Starting import'), 
		'clear_content'         => a13__be('Removing content'), 
		'install_plugins'       => a13__be('Installing plugins'),
		'install_layer_sliders' => a13__be('Importing Layer sliders'),
		'install_revo_sliders'  => a13__be('Importing Revolution sliders'),
		'install_content'       => a13__be('Importing content'),
		'setup_fp'              => a13__be('Setting up Front Page'), 
		'setup_wc'              => a13__be('Setting up Shop Page'), 
		'setup_menus'           => a13__be('Setting menus to proper locations'), 
		'setup_widgets'         => a13__be('Setting up widgets'), 
		'setup_permalinks'      => a13__be('Setting up permalinks'), 
		'import_predefined_set' => a13__be('Importing settings'), 
		'end'                   => a13__be('Everything done!'),
	);

	//get current level key
	if(strlen($level) === 0){
		$level = key($levels);
	}
	else{
		while (key($levels) !== $level) next($levels);
		$level = key($levels);
	}


	//do level
	$function = 'a13_demo_data_'.$level;
	if(function_exists($function)){
		//no notices or other "echos", we put it in $log
		ob_start();

		$sublevel = $function($sublevel, $sublevel_name);

		$log = ob_get_contents();
		ob_end_clean();


		if($sublevel === true){ //if functions return true, then we move to next level
			$sublevel = ''; //reset
			next($levels);
			$level = key($levels);
		}
	}
	else{ //no function - move to next level
		next($levels);
		$level = key($levels);
	}


	//check if this is last element
	$is_it_end = false;
	end($levels);
	if(key($levels) === $level){
		$is_it_end = true;
	}

	$result = array(
		'level'         => $level,
		'level_name'    => $levels[$level],
		'sublevel'      => $sublevel,
		'sublevel_name' => $sublevel_name,
		'log'           => $log,
		'is_it_end'     => $is_it_end,
	);

	//send AJAX response
	echo json_encode(sizeof($result)? $result :  false);

	die(); //this is required to return a proper result
}



add_action('wp_ajax_a13_remove_custom_sidebar', 'a13_remove_custom_sidebar');

function a13_remove_custom_sidebar() {
    global $apollo13;
    $sidebar_to_remove = $_POST['sidebar'];

    $found = false;

    //get current sidebars
    $custom_sidebars = unserialize($apollo13->get_option( 'sidebars', 'custom_sidebars' ));
    $sidebars_count = count($custom_sidebars);
    if(is_array($custom_sidebars) && $sidebars_count > 0){
        //search for sidebar to delete
        foreach($custom_sidebars as $key => $sidebar){
            if($sidebar_to_remove === $sidebar['id']){
                $found = $key;
                break;
            }
        }

        //if sidebar was found
        if($found !== false){
            //delete it
            unset($custom_sidebars[$found]);
        }

        //update theme options
        $options_name = 'sidebars';
        $apollo13->set_option( $options_name, 'custom_sidebars', serialize($custom_sidebars));
        $apollo13->update_options($options_name, true);
    }

    echo  json_encode(true);

    die(); // this is required to return a proper result
}