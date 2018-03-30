<?php

/*
**	Main Import / Export UI 
**
**	This function will display the UI of the main import/export 
**
**	@since	:	1.0
**	@return	:	Returns the Import / Export UI 
**
*/
function curvy_slider_import_export_ui(){
	
	//FontAwesome 
	wp_enqueue_style('font-awesome-css',  CURVY_URI.'css/font-awesome.min.css', '','', 'all');
	
	$return = '<div class="curvyslider-main-container">';
	
	$return .= '<h2><img src="'.CURVY_URI.'images/curvy-logo.png" /></h2><br/>';

	
	//Import Field
	$import = '';
	
	$import .= '
		<div class="main-import-area">
			<h3>Load Data <div class="button predefined_import_button">Load Sample Sliders</div></h3>
			<p>Paste your exported data and then click to "Load" button</p>
			<textarea class="import-area"></textarea>
			<div class="button main_import_button">Load</div>
		</div>
		<br/>
	';
	
	//Export Field
	$export = '
		<div class="main-export-area">
			<h3>Export Data</h3>
			<p>Copy the content of this text area. Save it somewhere to import it later</p>
			<textarea class="export-area">'.curvy_slider_get_export_data().'</textarea>
		</div>
	';
	
	$return .= $import;
	
	$return .= '<hr/>';
	
	$return .= $export;
	
	$return .= '</div>';
	
	echo $return;
	
	curvy_slider_import_export_js();
	curvy_slider_import_export_css();
}


/*
**	Returns the data of the saved sliders.
**
**	@return	:	The data will be json_encoded
*/
function curvy_slider_get_export_data(){
	$references	=	json_decode(get_option('curvy_slider_references',false),true);
	if(!$references) return false;
	
	$datas				=	array();
	
	$database_name		=	'curvy_slider_';
		
	
	foreach($references as $ref){
		$datas[] = get_option($database_name.$ref['id'],array());
	}
	
	return json_encode(
				array(
					'references'	=>	($references),
					'datas'			=>	$datas,
					'site_url'		=>	home_url(),
				)
			);
}

function curvy_slider_import($data){
		
	$data = json_decode(stripslashes($data),true);
	
	$old_site_url = $data['site_url'];
	$current_site_url = home_url();
	
	//Import references
	$references_imported = update_option('curvy_slider_references', json_encode($data['references']));
		
	//Import form datas
	foreach($data['datas'] as $slider){
		$slider = (str_replace($old_site_url, $current_site_url, stripslashes($slider)));
		$slider = json_decode(($slider), true);
		$database_name = 'curvy_slider_'.$slider['id'];
		
		$slider = json_encode($slider);

		update_option($database_name, $slider);
	}
	
	echo "success";
}

function curvy_slider_import_ajax(){
	if(!current_user_can(CURVY_USER_CAPABILITY)) die();
	if(!isset($_POST['data']) || empty($_POST['data'])){
		die( 'error');
	}else{
		echo curvy_slider_import($_POST['data']);
	}
	exit;
}
add_action("wp_ajax_curvy_slider_import", "curvy_slider_import_ajax");

function curvy_slider_import_predefined_data(){
	if(!current_user_can(CURVY_USER_CAPABILITY)) die;
	global $predefined_import_data;
	
	$curvy_sample_dir = CURVY_URI.'images/samples/';
	
	include_once(CURVY_DIR.'curvy-slider-predefined-import-data.php');
	
	$data = json_decode(($predefined_import_data),true);		
		
		//Import references
		$references_imported = update_option('curvy_slider_references', json_encode($data['references']));
		
		//Import form datas
		foreach($data['datas'] as $slider){
			$string = (stripslashes($slider));
			
			preg_match_all('/https?\:\/\/[^\" ]+/i', $string, $match);
						
			$URLs = array();
			$editedURLs = array();
			
			foreach ($match as $key => $value){
				foreach ($value as $key2 => $TheUrl){
					$URLs[] = $TheUrl;
					$editedURLs[] = $curvy_sample_dir.basename(($TheUrl));
				}
			}
			
			for ($i=0;$i<count($URLs);$i++){
				$pos = strpos($string,$URLs[$i]);
				if ($pos !== false) {
					$string = substr_replace($string,$editedURLs[$i],$pos,strlen($URLs[$i]));
				}
			}
						
			$slider = json_decode(($string), true);
			$database_name = 'curvy_slider_'.$slider['id'];
			
			$slider = json_encode($slider);

			update_option($database_name, $slider);
		}
		
		die("success");
	exit;
}
add_action("wp_ajax_curvy_slider_import_predefined_data", "curvy_slider_import_predefined_data");



function curvy_slider_import_export_js(){
	
?>
<script type="text/javascript">

jQuery(document).ready(function(){
	jQuery(document).on("click",".main_import_button", function(){
		
		var that = jQuery(this);
		var button_content = that.html();
		that.html(button_content+' <i class="fa fa-refresh fa-spin"></i>');
		
		var data = jQuery(".import-area").val();

		jQuery.post(ajaxurl, {data:data, action:"curvy_slider_import"}, function(data){
			if(that.find(".fa fa-refresh").length) that.find(".fa fa-refresh").remove();
			
			
			if(data == 'success'){
				var newLink = "?page=curvy_slider";
				var siteLocation = document.location.toString().substr(0,document.location.toString().lastIndexOf("?"))
				document.location = siteLocation+newLink;
			}
		});
	});
	
	jQuery(document).on("click",".predefined_import_button", function(){
		var that = jQuery(this);
		var button_content = that.html();
		that.html(button_content+' <i class="fa fa-refresh fa-spin"></i>');

		jQuery.post(ajaxurl, {action:"curvy_slider_import_predefined_data"}, function(data){
			console.log("DATA "+data);
			if(that.find(".fa fa-refresh").length) that.find(".fa fa-refresh").remove();
			
			if(data == 'success'){
				var newLink = "?page=curvy_slider";
				var siteLocation = document.location.toString().substr(0,document.location.toString().lastIndexOf("?"))
				document.location = siteLocation+newLink;
			}
		});
	});
});

</script>

<?php
}

function curvy_slider_import_export_css(){
?>	
	<style type="text/css">
	.curvyslider-main-container{margin-right:20px;}
	.import-area, .export-area{
		width:100%;
		min-height:240px;	
	}
	</style>
<?php
}

?>