<?php
class sidebar_generator {
	
	function sidebar_generator(){
		add_action('init',array('sidebar_generator','init'));
		//add_action('admin_menu',array('sidebar_generator','admin_menu'));
		add_action('admin_print_scripts', array('sidebar_generator','admin_print_scripts'));
		add_action('wp_ajax_add_sidebar', array('sidebar_generator','add_sidebar') );
		add_action('wp_ajax_remove_sidebar', array('sidebar_generator','remove_sidebar') );
			
		//edit posts/pages
		//add_action('edit_form_advanced', array('sidebar_generator', 'edit_form'));
		//add_action('edit_page_form', array('sidebar_generator', 'edit_form'));
		
		//save posts/pages
		add_action('edit_post', array('sidebar_generator', 'save_form'));
		add_action('publish_post', array('sidebar_generator', 'save_form'));
		add_action('save_post', array('sidebar_generator', 'save_form'));
		add_action('edit_page_form', array('sidebar_generator', 'save_form'));

	}
	
	public static function init(){
		//go through each sidebar and register it
	    $sidebars = sidebar_generator::get_sidebars();

	    if(is_array($sidebars)){
			foreach($sidebars as $sidebar){
				$sidebar_class = sidebar_generator::name_to_class($sidebar);
				register_sidebar(array(
					'name'=>$sidebar,
			    	'before_widget' => '<div id="%1$s" class="widgets sidebar-widget portfolio_sidebar '.$sidebar_class.' %2$s">',
		   			'after_widget' => '</div>',
		   			'before_title' => '<p>',
					'after_title' => '</p>',
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
					
					var mysack = new sack("<?php echo site_url() ?>/wp-admin/admin-ajax.php" );    
				
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
					
					var mysack = new sack("<?php echo site_url(); ?>/wp-admin/admin-ajax.php" );    
				
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
			//var textNode = document.createTextNode('[<a href=\'javascript:void(0);\' onclick=\'return remove_sidebar_link($name);\' class=\'al-button red-back\'>Delete</a>]');
			//cellLeft.appendChild(textNode)
			
			var cellLeft = row.insertCell(2);
			removeLink = document.createElement('a');
      		linkText = document.createTextNode('Delete');
      	
			removeLink.setAttribute('onclick', 'remove_sidebar_link(\'$name\')');
			removeLink.setAttribute('href', 'javacript:void(0)');
			removeLink.setAttribute('class', 'al-button red-back');
        
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
			tbl.deleteRow($row_number);

		";
		die($js);
	}
	
	function admin_menu(){
		//add_submenu_page('adminpanel', 'Sidebars', 'Sidebars', 'manage_options', __FILE__, array('sidebar_generator','sidebars'));
	}
	
	
	/**
	 * for saving the pages/post
	*/
	public static function save_form($post_id){
		$is_saving = isset($_POST['sbg_edit']) ? $_POST['sbg_edit'] : '';
		if(!empty($is_saving)){
			delete_post_meta($post_id, 'sbg_selected_sidebar');
			delete_post_meta($post_id, 'sbg_selected_sidebar_replacement');
			add_post_meta($post_id, 'sbg_selected_sidebar', $_POST['sidebar_generator']);
			add_post_meta($post_id, 'sbg_selected_sidebar_replacement', $_POST['sidebar_generator_replacement']);
		}		
	}
	
	public static function edit_form(){
	   
	}
	
	/**
	 * called by the action get_sidebar. this is what places this into the theme
	*/
	public static function get_sidebar($name="0"){
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
	public static function name_to_class($name){
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