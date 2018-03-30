<?php
/*
**	This file will register and load the Rock Widgets.
*/



/*
** Custom Sidebar Details
*/

$ROCK_CUSTOM_SIDEBAR = true;

//Get the custom sidebars
$quasar_custom_sidebar_data = get_option('quasar_custom_sidebar_data',array());

//Register if any sidebar exists
if(isset($quasar_custom_sidebar_data) && sizeof($quasar_custom_sidebar_data) > 0 && is_array($quasar_custom_sidebar_data) && function_exists('register_sidebar'))  {  
	foreach($quasar_custom_sidebar_data as $sidebar) {  
		register_sidebar( array(  
			'name' => __( $sidebar['name'], 'quasar' ),  
			'class' => 'awesome-class',
			'id' => rockthemes_cs_generate_sidebar_slug($sidebar['name'], 45),  
			'description' => 'Add your widgets here',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",  
			'before_title' => '<h3 class="widget-title">',  
			'after_title' => '</h3>				<div class="rockthemes-divider">
					<span class="divider-line-left">
						<span class="divider-symbol-left"></span>
					</span>
				</div>
',  
		) );  
	}  
}  

//Custom Sidebar UI function
function rockthemes_cs_custom_sidebar_function(){
	global $quasar_custom_sidebar_data;
	
	$quasar_custom_sidebar_general = get_option('quasar_custom_sidebar_general');
	
	//update_option("quasar_custom_sidebar_data","");
	$output = '<div class="wrap">';
	$output .= '<div id="fa fa-themes" class="icon32"><br></div>';
	$output .= '<h2>Quasar Custom Sidebars</h2>';
	$output .= '<p>Custom sidebars will allow you to add/remove unlimited sidebars. Make sure you are using unique names for each of your sidebar. If you don\'t use unique names for each sidebar, it may cause a conflict.</p>';

	
	if(isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated'] === 'true'){
		echo '<div id="message2" class="updated below-h2"><p>Your Custom Sidebars has been saved.</p></div>';
	}
	
	echo '<form method="post" action="options.php">';
	
	settings_fields( 'quasar_custom_sidebar_data' );
	
	$rockthemes_woosidebars_list = '';
	
	if(function_exists('rockthemes_woocommerce_active') && rockthemes_woocommerce_active()){
		$rockthemes_woosidebars_list = '
			<h4>WooCommerce Sidebar</h4>
			<p>This sidebar will be used in WooCommerce Pages such as archives and shop.</p>
			'.rockthemes_pb_get_custom_sidebars_dropdown((isset($quasar_custom_sidebar_general["rockthemes_woocommerce_sidebar"]) ? $quasar_custom_sidebar_general["rockthemes_woocommerce_sidebar"] : null),false, array('name' => 'quasar_custom_sidebar_general[rockthemes_woocommerce_sidebar][]','class'=>'quasar_custom_sidebar_woocommerce', 'id'=>'quasar_custom_sidebar_woocommerce_id'),false).'
			<br/>
		';	
	}
	
	$output .= "<div class='sidebar_management'>";  
	
	$output .= '<div id="col-container">
					<div id="col-right">
					<h3>General Settings</h3>
					<h4>General Sidebar</h4>
					<p>This sidebar will be used as default sidebar for all pages/posts. If you have specify a sidebar in page/post, this choice will be avoided.</p>
					'.rockthemes_pb_get_custom_sidebars_dropdown((isset($quasar_custom_sidebar_general["regular"]) ? $quasar_custom_sidebar_general["regular"]: null),false, array('name' => 'quasar_custom_sidebar_general[regular][]','class'=>'quasar_custom_sidebar_general', 'id'=>'quasar_custom_sidebar_general_id'),false).'
					<br/>
					<h4>Strict Sidebar</h4>
					<p>This is strict sidebar. If you make select any option below, it will effect all of the pages/posts.</p>
					'.rockthemes_pb_get_custom_sidebars_dropdown((isset($quasar_custom_sidebar_general["strict"]) ? $quasar_custom_sidebar_general["strict"] : null),false, array('name' => 'quasar_custom_sidebar_general[strict][]','class'=>'quasar_custom_sidebar_general', 'id'=>'quasar_custom_sidebar_general_id'),false,true).'
					<br/>
					'.$rockthemes_woosidebars_list.'
					<br/>
				</div>
				';
	
	$output .= '<div id="col-left">';
	
	$output .= '<h3>Add New Sidebar</h3>';
	
	$output .= rockthemes_pb_make_columns_list();
	
	$output .= rockthemes_cs_make_sidebar_alignment_list();
      
    $output .= "<h4>Enter your sidebar name</h4><p><input type='text' id='new_sidebar_name' /> <input class='button-primary' type='button' id='add_sidebar' value='".__("Add New Sidebar", "quasar")."' /></p>";  
   	
	$output .= '</div>';//close left div
		
	$output .= '</div>';//close wordpress col-container
	
	$output .= '    
	<table class="wp-list-table widefat fixed pages custom-sidebar-table" cellspacing="0">
    	<thead>
        	<tr>
    			<th scope="col" class="manage-column column-title" style="width:40%">Sidebar Name</th>
    			<th scope="col" class="manage-column column-column_num">Columns</th>
    			<th scope="col" class="manage-column column-align">Align Of Sidebar</th>
            </tr>
        </thead>
        <tbody>
			';

  
	$i = 0;  
    // Display every custom sidebar  
    if(isset($quasar_custom_sidebar_data) && is_array($quasar_custom_sidebar_data))  
    {  
        foreach($quasar_custom_sidebar_data as $sidebar)  
        {  
			$output .= '
        	<tr order="'.$i.'">
            	<td class="column-title">
                	<strong>'.$sidebar['name'].'</strong>
                    <div class="row-actions">
                    	<span class="trash"><a href="#" class="delete">Delete</a></span>
                    </div>
                </td>
                <td class="column-column_num">
                	<strong>'.$sidebar['column'].'</strong>
                </td>
                <td class="column-align">
                	<strong>'.rockthemes_cs_sidebar_alignment_to_string($sidebar['align']).'</strong>
                </td>
				<input type="hidden" name="quasar_custom_sidebar_data['.$i.'][name]" value="'.$sidebar['name'].'" />
				<input type="hidden" name="quasar_custom_sidebar_data['.$i.'][column]" value="'.$sidebar['column'].'" />
				<input type="hidden" name="quasar_custom_sidebar_data['.$i.'][align]" value="'.$sidebar['align'].'" />
			</tr>
			
			';
            $i++;  
        }  
    }  
	$array_num = $i;
    
	$output .= '
			</tbody>
		</table>
	';
	      
    $output .= "</div>";  
		
	$output .= '<br/><input class="button button-primary" type="submit" value="Save Changes" /></form></div>';
	
	echo $output;
	
	?>
    <script type="text/javascript">
                jQuery(document).ready(function(){ 
                    jQuery(".sidebar_management").on("click", ".delete", function(e){ 
						e.preventDefault();
                        jQuery(this).parent().parent().parent().parent().remove(); 
                    }); 
                     
                    jQuery(document).on("click", "#add_sidebar", function(){ 
						if(jQuery("#new_sidebar_name").val() == "") return;
						var column = jQuery(".columns_select").find(":selected");
						if(column.length <= 0 || !column.val()) return;
						column = column.val();
						var num = jQuery(".sidebar_management .custom-sidebar-table tbody tr").length;
						if(num != 0){
							
							num = parseInt(jQuery(".sidebar_management .custom-sidebar-table tbody tr:last-child").attr("order")) + 1;
						}
						var alignment = jQuery(".sidebar-alignment-list").find(":selected");

						var newElem = ''+
							'<tr order="'+num+'">'+
								'<td class="column-title">'+
									'<strong>'+jQuery("#new_sidebar_name").val()+'</strong>'+
									'<div class="row-actions">'+
										'<span class="trash"><a href="#" class="delete">Delete</a></span>'+
									'</div>'+
								'</td>'+
								'<td class="column-column_num">'+
									'<strong>'+column+'</strong>'+
								'</td>'+
								'<td class="column-align">'+
									'<strong>'+alignment.html()+'</strong>'+
								'</td>'+
								'<input type="hidden" name="quasar_custom_sidebar_data['+num+'][name]" value="'+jQuery("#new_sidebar_name").val()+'" />'+
								'<input type="hidden" name="quasar_custom_sidebar_data['+num+'][column]" value="'+column+'" />'+
								'<input type="hidden" name="quasar_custom_sidebar_data['+num+'][align]" value="'+alignment.val()+'" />'
							'</tr>';

                        jQuery('.sidebar_management .custom-sidebar-table tbody').append(newElem);  
                        jQuery("#new_sidebar_name").val("");  
                    })  
                      
                });
	</script>
    <?php
		
}

function rockthemes_cs_sidebar_alignment_to_string($alignment_name){
	switch($alignment_name){
		case 'leftleft':
		return 'Left Left';
		break;
		
		case 'left':
		return 'Left';
		break;
		
		case 'center':
		return 'Center';
		break;
		
		case 'right':
		return 'Right';
		break;
		
		case 'rightright':
		return 'Right Right';
		break;	
	}
	
	return $alignment_name;
}

function rockthemes_cs_generate_sidebar_slug($phrase, $maxLength)  
{  
    $result = strtolower($phrase);  
  
    $result = preg_replace("/[^a-z0-9\s-]/", "", $result);  
    $result = trim(preg_replace("/[\s-]+/", " ", $result));  
    $result = trim(substr($result, 0, $maxLength));  
    $result = preg_replace("/\s/", "-", $result);  
  
    return $result;  
} 

//Get sidebars in list as dropdown
function rockthemes_pb_get_custom_sidebars_dropdown($chosen = null,$header = true, $formObj = null, $add_button=true, $strictArea=false){
	global $quasar_custom_sidebar_data;
	//Set every page/post sidebar the side from strict rule
	$general_chosen = get_option('quasar_custom_sidebar_general');
	if($general_chosen && isset($general_chosen['strict']) && is_array($general_chosen['strict'])) $chosen = $general_chosen['strict'];
	//Set default chosen value that can be changed later 
	if(!isset($chosen) && !$strictArea){
		$chosen = isset($general_chosen['regular']) ? $general_chosen['regular'] : null;
	}

	//Set chosen to null if this is admin usage from Rock Custom Sidebar for Strict Area
	//if($strictArea) $chosen = null;
	
	if($header === true){
		$header = '<h3>Custom Sidebars</h3>';
	}
	if($add_button === true):
		$addNew = '<br/><a href="themes.php?page=custom_sidebar">Add New Sidebar</a>';
	else:
		$addNew = '';
	endif;
	
	//This field will be improved for CSS
	$nosidebarMessage = $header.'<p>You do not have any sidebars</p>'.$addNew;
	
	if(!isset($quasar_custom_sidebar_data) || sizeof($quasar_custom_sidebar_data) <= 0 || !is_array($quasar_custom_sidebar_data)) return $nosidebarMessage;

	if($formObj){
		$return = $header.'<select autocomplete="off" id="'.$formObj['id'].'" name="'.$formObj['name'].'" class="'.$formObj['class'].'" multiple >';
	}else{
		$return = $header.'<select autocomplete="off" id="custom_sidebar_list" name="custom_sidebar_list[]" class="custom_sidebar_list" multiple >';
	}
	
	$no_sidebar_active = false;
	if($chosen && is_array($chosen)){
		foreach($chosen as $checkNoSidebar){
			if(rockthemes_cs_generate_sidebar_slug('no-sidebar',45) == $checkNoSidebar){
				$chosen = rockthemes_cs_generate_sidebar_slug('no-sidebar', 45);
				break;
			}
		}
	}
	
	if(rockthemes_cs_generate_sidebar_slug('no-sidebar',45) == $chosen):
		$return .= '<option value="'.rockthemes_cs_generate_sidebar_slug('no-sidebar', 45).'" selected>'.__('No Sidebar',"quasar").'</option>';
	else:
		$return .= '<option value="'.rockthemes_cs_generate_sidebar_slug('no-sidebar', 45).'">'.__('No Sidebar',"quasar").'</option>';
	endif;
	
	
	foreach($quasar_custom_sidebar_data as $sidebar) {
		if(is_array($chosen)){
			$sidebar_found = false;
			foreach($chosen as $chose){
				if(rockthemes_cs_generate_sidebar_slug($sidebar['name'], 45) == $chose):
					$return .= '<option value="'.rockthemes_cs_generate_sidebar_slug($sidebar['name'], 45).'" selected>'.__($sidebar['name'],"quasar").'</option>';
					$sidebar_found = true;
					break;
				endif;
			}
			if(!$sidebar_found)
				$return .= '<option value="'.rockthemes_cs_generate_sidebar_slug($sidebar['name'], 45).'">'.__($sidebar['name'],"quasar").'</option>';
			
		}else{
			if(rockthemes_cs_generate_sidebar_slug($sidebar['name'], 45) == $chosen):
				$return .= '<option value="'.rockthemes_cs_generate_sidebar_slug($sidebar['name'], 45).'" selected>'.__($sidebar['name'],"quasar").'</option>';
			else:
				$return .= '<option value="'.rockthemes_cs_generate_sidebar_slug($sidebar['name'], 45).'">'.__($sidebar['name'],"quasar").'</option>';
			endif;
		}
	}
	
	
	$return .= '</select>'.$addNew;
	
	return $return;

}

function rockthemes_pb_frontend_get_content_columns_after_sidebars(){
	$quasar_custom_sidebar_general = get_option('quasar_custom_sidebar_general');
	
	if($quasar_custom_sidebar_general && isset($quasar_custom_sidebar_general['strict'])){
		$meta_sidebar = $quasar_custom_sidebar_general['strict'];
	}elseif(rockthemes_woocommerce_active() && (is_woocommerce() || is_cart() || is_account_page())){
		$meta_sidebar = rockthemes_cs_get_custom_sidebar_metabox();
		
		$sidebar_exists = false;
		
		if($meta_sidebar && is_array($meta_sidebar)){
			foreach($meta_sidebar as $meta){
				if($meta == "no-sidebar") $sidebar_exists = true;	
			}
		}
		
		if(!$sidebar_exists){
			if($meta_sidebar && is_array($meta_sidebar)){
				
			}else{
				if(isset($quasar_custom_sidebar_general['rockthemes_woocommerce_sidebar'])){
					$meta_sidebar = $quasar_custom_sidebar_general['rockthemes_woocommerce_sidebar'];	
				}elseif(!$meta_sidebar || !is_array($meta_sidebar)){
					return get_sidebar();	
				}
			}
		}	
	}else{
		$meta_sidebar = rockthemes_cs_get_custom_sidebar_metabox();

		$sidebar_exists = false;
		
		if($meta_sidebar && is_array($meta_sidebar)){
			foreach($meta_sidebar as $meta){
				if($meta == "no-sidebar") $sidebar_exists = true;	
			}
		}
		
		if(!$sidebar_exists){
			if($meta_sidebar && is_array($meta_sidebar)){
				
			}else{
				if(isset($quasar_custom_sidebar_general['regular'])){
					$meta_sidebar = $quasar_custom_sidebar_general['regular'];	
				}elseif(!$meta_sidebar || !is_array($meta_sidebar)){
					return get_sidebar();	
				}
			}
		}		
	}
		
	$all_sidebars = get_option('quasar_custom_sidebar_data',false);
	
	if(!$all_sidebars || !is_array($all_sidebars)) return 12;
	
	$total_sidebar_columns = 0;
	foreach($all_sidebars as $sidebar){
		foreach($meta_sidebar as $meta){
			if(rockthemes_cs_generate_sidebar_slug($sidebar['name'],45) == $meta){
				$total_sidebar_columns += intval($sidebar['column']);
				break;
			}
		}
	}
	
	return 12 - intval($total_sidebar_columns);
}

function rockthemes_pb_frontend_sidebar_before_content(){
	global $ROCK_CUSTOM_SIDEBAR;
	
	//Return if Rock Custom Sidebar is not activated
	if(!isset($ROCK_CUSTOM_SIDEBAR)) return get_sidebar();
	
	$quasar_custom_sidebar_general = get_option('quasar_custom_sidebar_general');

	if($quasar_custom_sidebar_general && isset($quasar_custom_sidebar_general['strict'])){
		$meta_sidebar = $quasar_custom_sidebar_general['strict'];
	}elseif(rockthemes_woocommerce_active() && (is_woocommerce() || is_cart() || is_account_page())){
		$meta_sidebar = rockthemes_cs_get_custom_sidebar_metabox();
		
		$sidebar_exists = false;
		
		if($meta_sidebar && is_array($meta_sidebar)){
			foreach($meta_sidebar as $meta){
				if($meta == "no-sidebar") $sidebar_exists = true;	
			}
		}
		
		if(!$sidebar_exists){
			if($meta_sidebar && is_array($meta_sidebar)){
				
			}else{
				if(isset($quasar_custom_sidebar_general['rockthemes_woocommerce_sidebar'])){
					$meta_sidebar = $quasar_custom_sidebar_general['rockthemes_woocommerce_sidebar'];	
				}elseif(!$meta_sidebar || !is_array($meta_sidebar)){
					return get_sidebar();	
				}
			}
		}	
	}else{
		$meta_sidebar = rockthemes_cs_get_custom_sidebar_metabox();
		
		$sidebar_exists = false;
		
		if($meta_sidebar && is_array($meta_sidebar)){
			foreach($meta_sidebar as $meta){
				if($meta == "no-sidebar") $sidebar_exists = true;	
			}
		}
		
		if(!$sidebar_exists){
			if($meta_sidebar && is_array($meta_sidebar)){
				
			}else{
				if(isset($quasar_custom_sidebar_general['regular'])){
					$meta_sidebar = $quasar_custom_sidebar_general['regular'];	
				}elseif(!$meta_sidebar || !is_array($meta_sidebar)){
					return get_sidebar();	
				}
			}
		}	
	}
			
	$all_sidebars = get_option('quasar_custom_sidebar_data',false);
	
	if(!$all_sidebars) return get_sidebar();
		
	$sidebar_align;
	
	$sidebar_column;
	
	$elem_found = false;
	
	$left_sidebars = array();
	foreach($all_sidebars as $sidebar){
		foreach($meta_sidebar as $meta){
			if(rockthemes_cs_generate_sidebar_slug($sidebar['name'],45) == $meta){
				if($sidebar['align'] != "leftleft" && $sidebar['align'] != "left") continue;
				$sidebar_align = $sidebar['align'];
				$sidebar_column = $sidebar['column'];
				
				$left_sidebars[] = array('align' => $sidebar['align'], 'column' => $sidebar['column'], 'slug'=> $meta);
				$elem_found = true;
				break;
			}
		}
	}

	if(!$elem_found) return;
	
	$i = 0;
	foreach($left_sidebars as $left){
		if($left['align'] == 'leftleft'){
			echo '<div class="sidebar-area large-'.$left['column'].' column">';
			echo '<div class="left-sidebar-padding">';
			dynamic_sidebar($left['slug']);
			echo '</div>';
			echo '</div>';
			
			array_splice($left_sidebars,$i,1);
		}
		$i++;
	}
	
	foreach($left_sidebars as $left){
		echo '<div class="sidebar-area large-'.$left['column'].' column">';
		echo '<div class="left-sidebar-padding">';
		dynamic_sidebar($left['slug']);
		echo '</div>';
		echo '</div>';
	}

}


function rockthemes_pb_frontend_sidebar_after_content(){
	global $ROCK_CUSTOM_SIDEBAR;
	
	//Return if Rock Custom Sidebar is not activated
	if(!isset($ROCK_CUSTOM_SIDEBAR)) return get_sidebar();
	
	$quasar_custom_sidebar_general = get_option('quasar_custom_sidebar_general');
	
	
	if(rockthemes_woocommerce_active() && is_woocommerce()){
		//$meta_sidebar = $quasar_custom_sidebar_general['rockthemes_woocommerce_sidebar'];
	}

	if($quasar_custom_sidebar_general && isset($quasar_custom_sidebar_general['strict'])){
		$meta_sidebar = $quasar_custom_sidebar_general['strict'];
	}elseif(rockthemes_woocommerce_active() && (is_woocommerce() || is_cart() || is_account_page())){
		$meta_sidebar = rockthemes_cs_get_custom_sidebar_metabox();
		
		$sidebar_exists = false;
		
		if($meta_sidebar && is_array($meta_sidebar)){
			foreach($meta_sidebar as $meta){
				if($meta == "no-sidebar") $sidebar_exists = true;	
			}
		}
		
		if(!$sidebar_exists){
			if($meta_sidebar && is_array($meta_sidebar)){
				
			}else{
				if(isset($quasar_custom_sidebar_general['rockthemes_woocommerce_sidebar'])){
					$meta_sidebar = $quasar_custom_sidebar_general['rockthemes_woocommerce_sidebar'];	
				}elseif(!$meta_sidebar || !is_array($meta_sidebar)){
					return get_sidebar();	
				}
			}
		}	
	}else{
		$meta_sidebar = rockthemes_cs_get_custom_sidebar_metabox();
		
		$sidebar_exists = false;
		
		if($meta_sidebar && is_array($meta_sidebar)){
			foreach($meta_sidebar as $meta){
				if($meta == "no-sidebar") $sidebar_exists = true;	
			}
		}
		
		if(!$sidebar_exists){
			if($meta_sidebar && is_array($meta_sidebar)){
				
			}else{
				if(isset($quasar_custom_sidebar_general['regular'])){
					$meta_sidebar = $quasar_custom_sidebar_general['regular'];	
				}elseif(!$meta_sidebar || !is_array($meta_sidebar)){
					return get_sidebar();	
				}
			}
		}
	}

	
	$all_sidebars = get_option('quasar_custom_sidebar_data',false);
	
	if(!$all_sidebars) return get_sidebar();
	
	$sidebar_align;
	
	$sidebar_column;
	
	$elem_found = false;
	
	$left_sidebars = array();
	foreach($all_sidebars as $sidebar){
		foreach($meta_sidebar as $meta){
			if(rockthemes_cs_generate_sidebar_slug($sidebar['name'],45) == $meta){
				if($sidebar['align'] != "rightright" && $sidebar['align'] != "right") continue;
				$sidebar_align = $sidebar['align'];
				$sidebar_column = $sidebar['column'];
				
				$left_sidebars[] = array('align' => $sidebar['align'], 'column' => $sidebar['column'], 'slug'=> $meta);
				$elem_found = true;
				break;
			}
		}
	}

	if(!$elem_found) return;
	
	$i = 0;
	foreach($left_sidebars as $left){
		if($left['align'] == 'right'){
			echo '<div class="sidebar-area large-'.$left['column'].' column">';
			echo '<div class="right-sidebar-padding">';
			dynamic_sidebar($left['slug']);
			echo '</div>';
			echo '</div>';
			
			array_splice($left_sidebars,$i,1);
		}
		$i++;
	}
	
	foreach($left_sidebars as $left){
		echo '<div class="sidebar-area large-'.$left['column'].' column">';
		echo '<div class="right-sidebar-padding">';
		dynamic_sidebar($left['slug']);
		echo '</div>';
		echo '</div>';
	}
	
}



/*
**	End of Custom Sidebar Settings
*/






//Register Widgets on menu
function rockthemes_cs_add_widgets() {
	
	//Custom Sidebar
	add_theme_page( 'Custom Sidebar',  'Custom Sidebar', 'administrator', 'custom_sidebar', 'rockthemes_cs_custom_sidebar_function' );
} 
add_action( 'admin_menu', 'rockthemes_cs_add_widgets' ); 

//Register Widget's Settings for data
function rockthemes_cs_register_widgets_datas(){
	//Custom Sidebar
    register_setting('quasar_custom_sidebar_data', 'quasar_custom_sidebar_data');
	
    register_setting('quasar_custom_sidebar_data', 'quasar_custom_sidebar_general');
}
add_action('admin_init', 'rockthemes_cs_register_widgets_datas');


//Rockthemes Twitter
include_once(get_template_directory().'/rock-widgets/rockthemes_twitter_widget.php');

?>