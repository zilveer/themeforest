<?php
/*
Plugin Name: Sidebar Generator
Plugin URI: http://www.getson.info
Description: This plugin generates as many sidebars as you need. Then allows you to place them on any page you wish. Version 1.1 now supports themes with multiple sidebars. 
Version: 1.1.0
Author: Kyle Getson
Author URI: http://www.kylegetson.com
Copyright (C) 2009 Kyle Robert Getson
*/

/*
Copyright (C) 2009 Kyle Robert Getson, kylegetson.com and getson.info

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/





/* OWM DEV */

/* Define the custom box */  
  
add_action( 'add_meta_boxes', 'add_sidebar_metabox' );  
add_action( 'save_post', 'save_sidebar_postdata' );  
  
/* Adds a box to the side column on the Post and Page edit screens */  
function add_sidebar_metabox()  
{  
    add_meta_box(   
        'custom_sidebar',  
        __( 'Custom Sidebar', 'kingsize' ),  
        'custom_sidebar_callback',  
        'post',  
        'side'  
    );  
    add_meta_box(   
        'custom_sidebar',  
        __( 'Custom Sidebar', 'kingsize' ),  
        'custom_sidebar_callback',  
        'page',  
        'side'  
    );  
	add_meta_box(   
        'custom_sidebar',  
        __( 'Custom Sidebar', 'kingsize' ),  
        'custom_sidebar_callback',  
        'portfolio',  
        'side'  
    );  
} 



/* Prints the box content */
function custom_sidebar_callback( $post )
{
	global $wp_registered_sidebars;
	$template_name = get_post_meta( $post->ID, '_wp_page_template', true );

	$custom = get_post_custom($post->ID);
	
	if(isset($custom['custom_sidebar']))
		$val = $custom['custom_sidebar'][0];
	elseif($template_name == "template-contact.php")
		$val = "Contact Page Sidebar";
	else
		$val = "0";
	

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'custom_sidebar_nonce' );

	// The actual fields for data entry
	$output = '<p><label for="myplugin_new_field">'.__("Choose a sidebar to display", 'kingsize' ).'</label></p>';
	$output .= "<select name='custom_sidebar'>";

	// Add a default option
	$output .= "<option";
	if($val == "0")
		$output .= " selected='selected'";
	$output .= " value='0'>".__('Default', 'kingsize')."</option>";
	

	// Fill the select element with all registered sidebars
	foreach($wp_registered_sidebars as $sidebar_id => $sidebar)
	{
		//
		$output .= "<option";
		if($sidebar['name'] == $val)
			$output .= " selected='selected'";
		$output .= " value='".$sidebar['name']."'>".$sidebar['name']."</option>";
	}
  
	$output .= "</select>";
	
	echo $output;
}


/* When the post is saved, saves our custom data */  
function save_sidebar_postdata( $post_id )  
{  
	// verify if this is an auto save routine.   
	// If it is our form has not been submitted, so we dont want to do anything  
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )   
	  return;  
  
	// verify this came from our screen and with proper authorization,  
	// because save_post can be triggered at other times  
  
	if ( !wp_verify_nonce( $_POST['custom_sidebar_nonce'], plugin_basename( __FILE__ ) ) )  
	  return;  
  
	if ( !current_user_can( 'edit_page', $post_id ) )  
		return;  
  
	$data = $_POST['custom_sidebar'];  
  
	update_post_meta($post_id, "custom_sidebar", $data);  
}  


class sidebar_generator {
	
	function sidebar_generator(){
		add_action('init',array('sidebar_generator','init'));
		add_action('admin_menu',array('sidebar_generator','admin_menu'));
		add_action('admin_print_scripts', array('sidebar_generator','admin_print_scripts'));
		add_action('wp_ajax_add_sidebar', array('sidebar_generator','add_sidebar') );
		add_action('wp_ajax_remove_sidebar', array('sidebar_generator','remove_sidebar') );

	}
	
	public static function  init(){
		//go through each sidebar and register it
	    $sidebars = sidebar_generator::get_sidebars();
	    

	    if(is_array($sidebars)){
			foreach($sidebars as $sidebar){
				$sidebar_class = sidebar_generator::name_to_class($sidebar);
				register_sidebar(array(
					'name'=>$sidebar,
			    	'before_widget' => '<div id="%1$s" class="widget-container sbg_widget '.$sidebar_class.' %2$s">',
		   			'after_widget' => '</div>',
		   			'before_title' => '<h3 class="widget-title sbg_title">',
					'after_title' => '</h3>',
		    	));
			}
		}
	}
	
	public static function admin_print_scripts(){
		wp_print_scripts( array( 'sack' ));
		?>
			<script>
				function add_sidebar( sidebar_name )
				{
					
					var mysack = new sack("<?php echo esc_url( site_url() ); ?>/wp-admin/admin-ajax.php" );    
				
				  	mysack.execute = 1;
				  	mysack.method = 'POST';
				  	mysack.setVar( "action", "add_sidebar" );
				  	mysack.setVar( "sidebar_name", sidebar_name );
				  	mysack.encVar( "cookie", document.cookie, false );
				  	mysack.onError = function() { alert('Ajax error. Cannot add sidebar' )};
				  	mysack.runAJAX();
					return true;
				}
				
				function remove_sidebar( sidebar_name,num )
				{
					
					var mysack = new sack("<?php echo esc_url( site_url() ); ?>/wp-admin/admin-ajax.php" );    
				
				  	mysack.execute = 1;
				  	mysack.method = 'POST';
				  	mysack.setVar( "action", "remove_sidebar" );
				  	mysack.setVar( "sidebar_name", sidebar_name );
				  	mysack.setVar( "row_number", num );
				  	mysack.encVar( "cookie", document.cookie, false );
				  	mysack.onError = function() { alert('Ajax error. Cannot add sidebar' )};
				  	mysack.runAJAX();
					//alert('hi!:::'+sidebar_name);
					return true;
				}
			</script>
		<?php
	}
	
	function add_sidebar(){
		$sidebars = sidebar_generator::get_sidebars();
		$name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']);
		$id = sidebar_generator::name_to_class($name);
		if(isset($sidebars[$id])){
			die("alert('Sidebar already exists, please use a different name.')");
		}
		
		$sidebars[$id] = $name;
		sidebar_generator::update_sidebars($sidebars);
		
		$js = "
			var tbl = document.getElementById('sbg_table');
			var lastRow = tbl.rows.length;
			// if there's no header row in the table, then iteration = lastRow + 1
			var iteration = lastRow;
			var row = tbl.insertRow(lastRow);
			
			// left cell
			var cellLeft = row.insertCell(0);
			var textNode = document.createTextNode('$name');
			cellLeft.appendChild(textNode);
			
			//middle cell
			var cellLeft = row.insertCell(1);
			var textNode = document.createTextNode('$id');
			cellLeft.appendChild(textNode);
			
			//var cellLeft = row.insertCell(2);
			//var textNode = document.createTextNode('[<a href=\'javascript:void(0);\' onclick=\'return remove_sidebar_link($name);\'>Remove</a>]');
			//cellLeft.appendChild(textNode)
			
			var cellLeft = row.insertCell(2);
			removeLink = document.createElement('a');
      		linkText = document.createTextNode('remove');
			removeLink.setAttribute('onclick', 'remove_sidebar_link(\'$name\')');
			removeLink.setAttribute('href', 'javacript:void(0)');
        
      		removeLink.appendChild(linkText);
      		cellLeft.appendChild(removeLink);

			
		";
		
		
		die( "$js");
	}
	
	function remove_sidebar(){
		$sidebars = sidebar_generator::get_sidebars();
		$name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']);
		$id = sidebar_generator::name_to_class($name);
		if(!isset($sidebars[$id])){
			die("alert('Sidebar does not exist.')");
		}
		$row_number = $_POST['row_number'];
		unset($sidebars[$id]);
		sidebar_generator::update_sidebars($sidebars);
		$js = "
			var tbl = document.getElementById('sbg_table');
			tbl.deleteRow($row_number)

		";
		die($js);
	}
	
	public static function admin_menu(){
		add_submenu_page('themes.php', 'Sidebars', 'Sidebars', 'manage_options', 'my-sidebar-generator-page', array('sidebar_generator','admin_page'));
	}
	
	function admin_page(){
		?>
		<script>
			function remove_sidebar_link(name,num){
				answer = confirm("Are you sure you want to remove " + name + "?\nThis will remove any widgets you have assigned to this sidebar.");
				if(answer){
					//alert('AJAX REMOVE');
					remove_sidebar(name,num);
				}else{
					return false;
				}
			}
			function add_sidebar_link(){
				var sidebar_name = prompt("Sidebar Name:","");
				
				//alert(sidebar_name);
				if (sidebar_name!=null)
				{
				 add_sidebar(sidebar_name);
				}
			}
		</script>
		<div class="wrap">
			<h2>Sidebar Generator</h2>
			<p>
				The sidebar name is for your use only. It will not be visible to any of your visitors. 
				<br />A CSS class is assigned to each of your sidebar, use this styling to customize the sidebars.
			</p>
			<p>
				Go to "Appearance > Widgets" to manage the widgets inside each of the sidebars created.
				<br />In the write-panel of "Pages/Posts" you'll be able to assign the sidebars created accordingly.
			</p>
			<br />
			<div class="add_sidebar">
				<a href="javascript:void(0);" onclick="return add_sidebar_link()" title="Add a sidebar">+ Add Sidebar</a>
			</div>
			<br />
			<table class="widefat page" id="sbg_table" style="width:600px;">
				<tr>
					<th>Name</th>
					<th>CSS class</th>
					<th>Remove</th>
				</tr>
				<?php
				$sidebars = sidebar_generator::get_sidebars();
				//$sidebars = array('bob','john','mike','asdf');
				if(is_array($sidebars) && !empty($sidebars)){
					$cnt=0;
					foreach($sidebars as $sidebar){
						$alt = ($cnt%2 == 0 ? 'alternate' : '');
				?>
				<tr class="<?php echo $alt?>">
					<td><?php echo $sidebar; ?></td>
					<td><?php echo sidebar_generator::name_to_class($sidebar); ?></td>
					<td><a href="javascript:void(0);" onclick="return remove_sidebar_link('<?php echo $sidebar; ?>',<?php echo $cnt+1; ?>);" title="Remove this sidebar">remove</a></td>
				</tr>
				<?php
						$cnt++;
					}
				}else{
					?>
					<tr>
						<td colspan="3">No Sidebars defined</td>
					</tr>
					<?php
				}
				?>
			</table>

		<?php
	}
	
	
	/**
	 * called by the action get_sidebar. this is what places this into the theme
	*/
	function get_sidebar($name="0"){

		/* By KS @ OWM I don't know why this so commented out
		if(!is_singular('slider')){
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
			return;//dont do anything
		}
		*/

		global $wp_query,$postParentPageID;

		if($postParentPageID > 0){
			$selected_sidebar = get_post_meta($postParentPageID, 'sbg_selected_sidebar', true);
			$selected_sidebar_replacement = get_post_meta($postParentPageID, 'sbg_selected_sidebar_replacement', true);
			
			//patching is kumar work.
			$selected_custom_sidebar = get_post_meta($postParentPageID, 'custom_sidebar', true);
		}
		else{
			$post = $wp_query->get_queried_object();
			$selected_sidebar = get_post_meta($post->ID, 'sbg_selected_sidebar', true);
			$selected_sidebar_replacement = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);

			//patching is kumar work.
			$selected_custom_sidebar = get_post_meta($post->ID, 'custom_sidebar', true);
		}



		if($selected_custom_sidebar!='0'  && $selected_custom_sidebar != ""){
			$selected_sidebar[0] = $selected_custom_sidebar;
			$selected_sidebar_replacement[0] = $selected_custom_sidebar;
		

		$did_sidebar = false;
		//this page uses a generated sidebar
		if($selected_sidebar != '' && $selected_sidebar != "0"){
			echo "\n\n<!-- begin generated sidebar -->\n";
			if(is_array($selected_sidebar) && !empty($selected_sidebar)){
				
				for($i=0;$i<sizeof($selected_sidebar);$i++){
					
					if($name == "0" && $selected_sidebar[$i] == "0" &&  $selected_sidebar_replacement[$i] == "0"){
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						dynamic_sidebar();//default behavior
						$did_sidebar = true;
						break;
					}elseif($name == "0" && $selected_sidebar[$i] == "0"){
						//we are replacing the default sidebar with something
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						dynamic_sidebar($selected_sidebar_replacement[$i]);//default behavior
						$did_sidebar = true;
						break;
					}elseif($selected_sidebar[$i] == $name){
						//we are replacing this $name
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						$did_sidebar = true;
						dynamic_sidebar($selected_sidebar_replacement[$i]);//default behavior
						break;
					}
					elseif($selected_sidebar[$i] != $name){
						//we are replacing this $name
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						$did_sidebar = true;
						dynamic_sidebar($selected_sidebar_replacement[$i]);//default behavior
						break;
					}
					else{
						dynamic_sidebar();
						break;
					}
					//echo "<!-- called=$name selected={$selected_sidebar[$i]} replacement={$selected_sidebar_replacement[$i]} -->\n";
				}

			}
			if($did_sidebar == true){
				echo "\n<!-- end generated sidebar -->\n\n";
				return;
			}
			//go through without finding any replacements, lets just send them what they asked for
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
			echo "\n<!-- end generated sidebar -->\n\n";
			return;			
		}else{			
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
		}

		}
		else {
		   
		   $template_name = get_post_meta( $postParentPageID, '_wp_page_template', true ); //for contact sidebar default show

			if($template_name == "template-contact.php")
				dynamic_sidebar('Contact Page Sidebar');
			else
				get_sidebar();

		}
	}
	
	/**
	 * replaces array of sidebar names
	*/
	function update_sidebars($sidebar_array){
		$sidebars = update_option('sbg_sidebars',$sidebar_array);
	}	
	
	/**
	 * gets the generated sidebars
	*/
	public static function get_sidebars(){
		$sidebars = get_option('sbg_sidebars');
		return $sidebars;
	}
	function name_to_class($name){
		$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
		return $class;
	}
	
}
$sbg = new sidebar_generator;

function generated_dynamic_sidebar($name='0'){
	sidebar_generator::get_sidebar($name);	
	return true;
}

?>
