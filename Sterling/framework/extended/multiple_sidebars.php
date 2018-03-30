<?php
/*
* Updated on 10 April 2014 by truethemes
* Use a diff tool to compare this version with original author version to see what has been modified.
* https://wordpress.org/plugins/sidebar-generator/
*/


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

class truethemes_sidebar_generator {
	
	function truethemes_sidebar_generator(){
		add_action('init',array('truethemes_sidebar_generator','init'));
		add_action('admin_menu',array('truethemes_sidebar_generator','admin_menu'));
		//mod by denzel - use admin_head instead of admin_print_script, so that it gets loaded after jQuery.
		add_action('admin_head', array('truethemes_sidebar_generator','admin_print_scripts'));
		add_action('wp_ajax_add_sidebar', array('truethemes_sidebar_generator','add_sidebar') );
		add_action('wp_ajax_remove_sidebar', array('truethemes_sidebar_generator','remove_sidebar') );
			
		//edit posts/pages
		//add_action('edit_form_advanced', array('truethemes_sidebar_generator', 'edit_form'));
		//add_action('edit_page_form', array('truethemes_sidebar_generator', 'edit_form'));
		add_action( 'add_meta_boxes', array( &$this,'truethemes_add_meta_box') );		
		
		//save posts/pages
		add_action('edit_post', array('truethemes_sidebar_generator', 'save_form'));
		add_action('publish_post', array('truethemes_sidebar_generator', 'save_form'));
		add_action('save_post', array('truethemes_sidebar_generator', 'save_form'));
		add_action('edit_page_form', array('truethemes_sidebar_generator', 'save_form'));

	}
	
	function truethemes_add_meta_box() {

        add_meta_box(
            'truethemes_sidebar_generator',
            __( 'Custom Sidebar', 'truethemes_localize' ),
            array( &$this,'edit_form'),
            'page',
            'side',
            'low'
        );

}
	
	function init(){
		//go through each sidebar and register it
	    $sidebars = truethemes_sidebar_generator::get_sidebars();
	    

	    if(is_array($sidebars)){
			foreach($sidebars as $sidebar){
				$sidebar_class = truethemes_sidebar_generator::name_to_class($sidebar);
				register_sidebar(array(
					'name'=>$sidebar,
			    	'before_widget' => '<div class="sidebar-widget">', //mod to add in widget class of karma theme
		   			'after_widget' => '</div>', //mod to close widget class div
		   			'before_title' => '<h4>',
					'after_title' => '</h4>',
		    	));
			}
		}
	}
	
	function admin_print_scripts(){
		
		//@since 4.0 - only call script when user is on 'Sidebars' page
		global $pagenow;
		if ($pagenow == 'themes.php') {
		wp_enqueue_script( array( 'sack' )); //mod by denzel - use wp_enqueue_script instead of wp_print_scripts.
		?>
		<script type='text/javascript'>
				/* mod by denzel - jQuery to remove table row after clicking remove link
				* original - http://stackoverflow.com/questions/15604122/jquery-delete-table-row
				*/
				jQuery(document).ready(function() {
				tt_make_table_rows_deleteable();
				});
				
				function tt_make_table_rows_deleteable(){
    					jQuery('#sbg_table .deleteLink').on('click',function() {
        						var tr = jQuery(this).closest('tr');
        							tr.fadeOut(400, function(){
            							tr.remove();
        							});
        						return false;
    					});				
				}

				function add_sidebar( sidebar_name )
				{
					
					var mysack = new sack("<?php echo site_url(); ?>/wp-admin/admin-ajax.php" );    
				
				  	mysack.execute = 1;
				  	mysack.method = 'POST';
				  	mysack.setVar( "action", "add_sidebar" );
				  	mysack.setVar( "sidebar_name", sidebar_name );
				  	mysack.encVar( "cookie", document.cookie, false );
				  	mysack.onError = function() { alert('Ajax error. Cannot add sidebar' )};
				  	mysack.runAJAX();
					return true;
				}
				
				function remove_sidebar( sidebar_name)
				{
					
					var mysack = new sack("<?php echo site_url(); ?>/wp-admin/admin-ajax.php" );    
				
				  	mysack.execute = 1;
				  	mysack.method = 'POST';
				  	mysack.setVar( "action", "remove_sidebar" );
				  	mysack.setVar( "sidebar_name", sidebar_name );
				  	mysack.encVar( "cookie", document.cookie, false );
				  	mysack.onError = function() { alert('Ajax error. Cannot add sidebar' )};
				  	mysack.runAJAX();
					//alert('hi!:::'+sidebar_name);
					return true;
				}
			</script>
		<?php
	} //end function
	} //end if
	
	function add_sidebar(){
		$sidebars = truethemes_sidebar_generator::get_sidebars();
		$name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']);
		$id = truethemes_sidebar_generator::name_to_class($name);
		if(isset($sidebars[$id])){
			die("alert('Sidebar already exists, please use a different name.')");
		}
		
		$sidebars[$id] = $name;
		truethemes_sidebar_generator::update_sidebars($sidebars);
		
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
			var cellLeft = row.insertCell(2);
			removeLink = document.createElement('a');
      		linkText = document.createTextNode('remove');
			removeLink.setAttribute('onclick', 'remove_sidebar_link(\'$name\')');
			//removeLink.setAttribute('href', 'javacript:void(0)');
			removeLink.setAttribute('href', '#');
			removeLink.setAttribute('class', 'deleteLink');
      		removeLink.appendChild(linkText);
      		cellLeft.appendChild(removeLink);      		
      		tt_make_table_rows_deleteable(); //mod by denzel - calls javascript function at line 107
			";
		
		
		die( "$js");
	}
	
	function remove_sidebar(){
		$sidebars = truethemes_sidebar_generator::get_sidebars();
		$name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']);
		$id = truethemes_sidebar_generator::name_to_class($name);
		if(!isset($sidebars[$id])){
			die("alert('Sidebar does not exist.')");
		}
		$row_number = $_POST['row_number'];
		unset($sidebars[$id]);
		truethemes_sidebar_generator::update_sidebars($sidebars);
	}
	
	function admin_menu(){
		add_theme_page('Sidebars', 'Sidebars', 'manage_options', 'multiple_sidebars', array('truethemes_sidebar_generator','admin_page'));
		
}
	
	function admin_page(){
		?>
		<script type='text/javascript'>
			function remove_sidebar_link(name){
				answer = confirm("Are you sure you want to remove " + name + "?\nThis will also remove any widgets you have assigned to this sidebar.");
				if(answer){
					//alert('AJAX REMOVE');
					remove_sidebar(name);
				}else{
					return false;
				}
			}
			function add_sidebar_link(){
				var sidebar_name = prompt("Sidebar Name:","");
				//alert(sidebar_name);
				add_sidebar(sidebar_name);
			}
		</script>
		<div class="wrap">
			<div id="icon-options-general" class="icon32"></div><h2><?php _e('Sidebars','truethemes_localize'); ?></h2>
			<br />
            <h3><?php _e('Instructions:','truethemes_localize'); ?></h3>
            <ol>
            <li style="margin-bottom:12px;"><strong><?php _e('Step 1:','truethemes_localize'); ?></strong> <?php _e('Create a new Sidebar by clicking the "Add New Sidebar" button below. Give the sidebar a name and click "OK".','truethemes_localize'); ?></li>
            
            
            <li style="margin-bottom:12px;"><strong><?php _e('Step 2:','truethemes_localize'); ?></strong> <?php _e('Add Widgets to this Sidebar by exiting this page and clicking on','truethemes_localize'); ?> <a href="<?php echo $admin_url.'widgets.php';?>"><?php _e('Appearance > Widgets','truethemes_localize'); ?></a>. <?php _e('The Sidebar you just created will be located on the right side of the Widgets page. Simply drag-and-drop your desired Widgets into the Sidebar.','truethemes_localize'); ?></li>
            
            <li><strong><?php _e('Step 3:','truethemes_localize'); ?></strong> <?php _e('Assign the Sidebar to a page by','truethemes_localize'); ?> <a href="<?php echo $admin_url.'edit.php?post_type=page';?>"><?php _e('editing your desired page','truethemes_localize'); ?></a> <?php _e('and choosing the newly created Sidebar from within the Custom Sidebar box located on the right side of the Page Editing screen.','truethemes_localize'); ?></li>
            </ol>
            <br />
            <br />
			<table class="widefat page" id="sbg_table" style="width:600px;">
				<tr>
					<th>Sidebar Name</th>
					<th>CSS class</th>
					<th>Remove</th>
				</tr>
				<?php
				$sidebars = truethemes_sidebar_generator::get_sidebars();
				//$sidebars = array('bob','john','mike','asdf');
				if(is_array($sidebars) && !empty($sidebars)){
					$cnt=0;
					foreach($sidebars as $sidebar){
						$alt = ($cnt%2 == 0 ? 'alternate' : '');
				?>
				<tr class="<?php echo $alt?>">
					<td><?php echo $sidebar; ?></td>
					<td><?php echo truethemes_sidebar_generator::name_to_class($sidebar); ?></td>
					<td><a href="#" class="deleteLink" onclick="return remove_sidebar_link('<?php echo $sidebar; ?>');" title="Remove this sidebar">remove</a></td>
				</tr>
				<?php
						$cnt++;
					}
				}else{
					?>
					<tr>
						<td colspan="3"></td>
					</tr>
					<?php
				}
				?>
			</table><br /><br />
            <div class="add_sidebar">
				<a href="javascript:void(0);" onclick="return add_sidebar_link()" title="Add a sidebar" class="button-primary">+ <?php _e('Add New Sidebar','truethemes_localize'); ?></a>

			</div>
			
		</div>
		<?php
	}
	
	/**
	 * for saving the pages/post
	*/
	function save_form($post_id){
	    if(isset($_POST['sbg_edit']))
		$is_saving = $_POST['sbg_edit'];
		if(!empty($is_saving)){
			delete_post_meta($post_id, 'sbg_selected_sidebar');
			delete_post_meta($post_id, 'sbg_selected_sidebar_replacement');
			add_post_meta($post_id, 'sbg_selected_sidebar', $_POST['sidebar_generator']);
			add_post_meta($post_id, 'sbg_selected_sidebar_replacement', $_POST['sidebar_generator_replacement']);
		}		
	}
	
	function edit_form(){
	    global $post;
	    $post_id = $post;
	    if (is_object($post_id)) {
	    	$post_id = $post_id->ID;
	    }
	    $selected_sidebar = get_post_meta($post_id, 'sbg_selected_sidebar', true);
	    if(!is_array($selected_sidebar)){
	    	$tmp = $selected_sidebar; 
	    	$selected_sidebar = array(); 
	    	$selected_sidebar[0] = $tmp;
	    }
	    $selected_sidebar_replacement = get_post_meta($post_id, 'sbg_selected_sidebar_replacement', true);
		if(!is_array($selected_sidebar_replacement)){
	    	$tmp = $selected_sidebar_replacement; 
	    	$selected_sidebar_replacement = array(); 
	    	$selected_sidebar_replacement[0] = $tmp;
	    }
		?>

			<table class="form-table cmb_metabox"><tbody><tr class="_cmb_sub_menu_title"><td colspan="2"><h5 class="cmb_metabox_title"><?php _e('Sidebar','truethemes_localize'); ?></h5><p class="cmb_metabox_description">			
			<p class="cmb_metabox_description"><?php _e('Display a custom sidebar by selecting it from the dropdown list below.','truethemes_localize'); ?><br /><br /><strong><?php _e('Please note:','truethemes_localize'); ?></strong> <?php _e('this page must be using a sidebar-ready page template in order to properly display a sidebar.','truethemes_localize'); ?><br /><?php _e('(ie. "Left Sidebar" page template)','truethemes_localize'); ?><br /><br /><strong><?php _e('Need to create a new Sidebar?','truethemes_localize'); ?></strong><br /><a href="<?php echo admin_url('admin.php?page=multiple_sidebars'); ?>"><?php _e('Appearance > Sidebars','truethemes_localize'); ?></a></p>
			</td>
			</tr>
			<tr class="truethemes_custom_sidebar"><td>	
			<input name="sbg_edit" type="hidden" value="sbg_edit" />
				
					<?php 
					global $wp_registered_sidebars;
					//var_dump($wp_registered_sidebars);		
						for($i=0;$i<1;$i++){ ?>
				
							<select name="sidebar_generator[<?php echo $i?>]" style="display: none;">
								<option value="0"<?php if($selected_sidebar[$i] == ''){ echo " selected";} ?>>WP Default Sidebar</option>
							<?php
							$sidebars = $wp_registered_sidebars;// sidebar_generator::get_sidebars();
							if(is_array($sidebars) && !empty($sidebars)){
								foreach($sidebars as $sidebar){
									if($selected_sidebar[$i] == $sidebar['name']){
										echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
									}else{
										echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
									}
								}
							}
							?>
							</select>
							<select name="sidebar_generator_replacement[<?php echo $i?>]">
								<option value="0"<?php if($selected_sidebar_replacement[$i] == ''){ echo " selected";} ?>>&mdash; Select Custom Sidebar &mdash;</option>
							<?php
							
							$sidebar_replacements = $wp_registered_sidebars;//sidebar_generator::get_sidebars();
							if(is_array($sidebar_replacements) && !empty($sidebar_replacements)){
								foreach($sidebar_replacements as $sidebar){
									if($selected_sidebar_replacement[$i] == $sidebar['name']){
										echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
									}else{
										echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
									}
								}
							}
							?>
							</select> 
							
						
						<?php } ?>
						
					</td></tr></tbody></table>


		<?php
	}
	
	/**
	 * called by the action get_sidebar. this is what places this into the theme
	*/
	function get_sidebar($name="0"){
		if(!is_singular()){
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
			return;//dont do anything
		}
		global $wp_query;
		$post = $wp_query->get_queried_object();
		$selected_sidebar = get_post_meta($post->ID, 'sbg_selected_sidebar', true);
		$selected_sidebar_replacement = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
		$did_sidebar = false;
		//this page uses a generated sidebar
		if($selected_sidebar != '' && $selected_sidebar != "0"){
			echo "";
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
					//echo "<!-- called=$name selected={$selected_sidebar[$i]} replacement={$selected_sidebar_replacement[$i]} -->\n";
				}
			}
			if($did_sidebar == true){
				echo "";
				return;
			}
			//go through without finding any replacements, lets just send them what they asked for
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
			echo "";
			return;			
		}else{
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
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
	function get_sidebars(){
		$sidebars = get_option('sbg_sidebars');
		return $sidebars;
	}
	function name_to_class($name){
		$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
		return $class;
	}
	
}
$sbg = new truethemes_sidebar_generator;

function generated_dynamic_sidebar($name='0'){
	truethemes_sidebar_generator::get_sidebar($name);	
	return true;
}
?>