<?php
/*
**	Rock Theme Options - Import Export Datas
**
**	Elements are located here
**
**	Version	:	1.0
*/

global $pagenow;
if(($pagenow !== 'themes.php' || !isset($_REQUEST['page']) || strpos($_REQUEST['page'],'rock_options') === false)
	&& ( !(defined( 'WP_ADMIN' ) && WP_ADMIN ) &&  !( defined( 'DOING_AJAX' ) && DOING_AJAX ))) return;

function rockthemes_to_generate_import_export_modal(){
	//return;
	$export_data = rockthemes_to_gather_export_data();
	
	$return = '
	<div id="import_all_datas_modal" class="row-fluid">
		<div class="header">
			<h3>Theme Options Import / Export</h3>
		</div>
			<div class="row-fluid export_data">
				<div class="span12">
					<strong>Load Data</strong><br/>
					<p>Paste your saved data and then click to "Load Data" button.</p><br/>
					<textarea class="rockthemes_to_import_data"></textarea>
					<br/>
					<div class="button rockthemes_to_import_data_button">Load Data</div>
					<div class="button rockthemes_to_import_predefined_data_button" title="Load the data as seen in demo">Load Demo Data</div>
				</div>
			</div>
			<hr/>
			<div class="row-fluid export_data">
				<div class="span12">
					<strong>Export Data</strong><br/>
					<p>Store this data in a file by using your favorite text editor.</p><br/>
					<textarea class="rockthemes_to_export_textarea">'.$export_data.'</textarea>
				</div>
			</div>
			<hr/>
	</div>';
		
	echo $return;
	rockthemes_to_import_export_js();
	return;
}


function rockthemes_to_gather_export_data(){
	global $rockthemes_to_options;
	$return = '';
	
	$data_array = array();	
	
	//Get Rock Theme Options data
	$data_array[] = array('module' => 'rock_theme_options', 'data' => json_encode(array('site_url' => home_url(), 'datas' => $rockthemes_to_options)));//$rockthemes_to_options is now php array, turn it into json string
	
	//Rock Form Builder Data
	if(function_exists('rockthemes_fb_get_export_data')){
		$data_array[] = array('module' => 'rock_form_builder', 'data' => rockthemes_fb_get_export_data());
	}
	
	//Curvy Slider Data
	if(function_exists('curvy_slider_get_export_data')){
		$data_array[] = array('module' => 'curvy_slider', 'data' => curvy_slider_get_export_data());	
	}
	
	//Rock Page Builder Data
	if(function_exists('rockthemes_pb_get_export_data')){
		$data_array[] = array('module' => 'rock_page_builder', 'data' => rockthemes_pb_get_export_data());	
	}
	
	return json_encode($data_array);
}





function rockthemes_to_import_export_js(){
?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		
		//Main Import Functions
		jQuery(document).on("click", ".rockthemes_to_import_data_button", function(){
			if(jQuery(this).find("i").length) return;
			
			var button = jQuery(this);
			
			var old_button_text = jQuery(this).html();
			//Add loading spin
			jQuery(this).html('Loading data. Do not navigate away from this page! <i class="fa fa-refresh fa-spin"></i>');
			
		
			var data = jQuery(".rockthemes_to_import_data").val();
					
			jQuery.post(ajaxurl, {data:data, action:"rockthemes_to_import_all_datas"}, function(data){
				//console.log("RETURN DATA "+data);
				button.html(old_button_text);
			});
		
		});
		
		jQuery(document).on("click", ".rockthemes_to_import_predefined_data_button", function(){
			if(jQuery(this).find("i").length) return;
			
			var button = jQuery(this);
			
			var old_button_text = jQuery(this).html();
			//Add loading spin
			jQuery(this).html('Loading data. Do not navigate away from this page! <i class="fa fa-refresh fa-spin"></i>');
			
		
			var data = jQuery(".rockthemes_to_import_data").val();
					
			jQuery.post(ajaxurl, {action:"rockthemes_to_import_all_predefined_datas"}, function(data){
				//console.log("RETURN DATA "+data);
				button.html(old_button_text);
			});
		});
		
	});
</script>
<?php
}


function rockthemes_to_import_all_datas($data){
	//Remove any additional line breaks. Some PHP versions adds line breaks during json_encode / json_decode	
	$data = preg_replace( "/\r|\n/", "", $data);
		
	$array_data = json_decode($data, true);
	
	if(!is_array($array_data)){
		echo 'its not an array';
		$array_data = json_decode(stripslashes($data), true);	
	}
				
	$modules = '';
	$unprocessed_modules = array();
	foreach($array_data as $module){
		if(!is_array($module)) $module = stripslashes($module);

		switch($module['module']){
			case 'rock_form_builder':
			if(function_exists('rockthemes_fb_import')){
				rockthemes_fb_import(addslashes(str_replace('&quot;', '"', $module['data'])));
			}
			break;
			
			case 'curvy_slider':
			if(function_exists('curvy_slider_import')){
				curvy_slider_import(addslashes(str_replace('&quot;', '"', $module['data'])));
			}
			break;
			
			case 'rock_page_builder':
			rockthemes_pb_import($module['data']);
			break;
			
			case 'rock_theme_options':
			rockthemes_to_import_to_datas($module['data']);
			break;
			
		}
	}
	
	return $modules;
}

function rockthemes_to_import_all_datas_ajax(){
	if(!is_admin()) die;
	if(!isset($_REQUEST['data'])) die;
	echo rockthemes_to_import_all_datas($_REQUEST['data']);
	exit;	
}
add_action('wp_ajax_rockthemes_to_import_all_datas', 'rockthemes_to_import_all_datas_ajax');


function rockthemes_to_import_all_predefined_datas_ajax(){
	if(!is_admin()) die();

	$filename = OPTIONS_DIR.'rockthemes-to-predefined-import-data.txt';
	$handle = fopen($filename, "r");
	$rockthemes_to_predefined_data = fread($handle, filesize($filename));
	fclose($handle);

	
	$data = $rockthemes_to_predefined_data;
	
	$data = mb_convert_encoding($data, "UTF-8", "Windows-1252");	
	echo rockthemes_to_import_all_datas(($data));
	exit;
}
add_action('wp_ajax_rockthemes_to_import_all_predefined_datas', 'rockthemes_to_import_all_predefined_datas_ajax');



function rockthemes_to_import_to_datas($data){
	if(!isset($data)) return;
	

	if(!is_array($data)){
		$data_decoded = json_decode(($data), true);
		if(!is_array($data_decoded)){
			$data_decoded = json_decode(stripslashes($data), true);
		}
		$data = $data_decoded;
	}
	
	$old_url = $data['site_url'];
	$new_url = home_url();
	
	$old_site_url_slashed = str_replace('/', '\\/', $old_url);
	$current_site_url_slashed = str_replace('/', '\\/', $new_url);
	
	$data = str_replace($old_url, $new_url, json_encode($data['datas']));
	$data = str_replace($old_site_url_slashed, $current_site_url_slashed, $data);
	
	$data = json_decode($data, true);
	
	if(update_option('xr_main_settings', $data)){
		echo 'success';	
	}
	
}

?>