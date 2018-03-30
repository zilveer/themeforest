<?php
/*-----------------------------------------------------------------------------------*/
/* The Head Hook
/*-----------------------------------------------------------------------------------*/
function icy_head() { do_action( 'icy_head' ); }

/*-----------------------------------------------------------------------------------*/
/* Adding the default options after activation */
/*-----------------------------------------------------------------------------------*/
function icy_option_setup(){

	$icy_array = array();
	add_option('icy_options',$icy_array);

	$template = get_option('icy_template');
	$saved_options = get_option('icy_options');
	
	foreach($template as $option) {
		
		if($option['type'] != 'heading'){
		
			$id = $option['id'];
			$std = $option['std'];
			$db_option = get_option($id);
		
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$icy_array[$c_id] = $c_std; 
					}
		
				} else {
						
					update_option($id,$std);
					$icy_array[$id] = $std;
				
				}
			}
		
			else { 
				$icy_array[$id] = $db_option;
			}
		}
	}
	update_option('icy_options',$icy_array);
}
if (is_admin() && $pagenow == "themes.php" && isset($_GET['activated'] ) ) {
	add_action('admin_head','icy_option_setup');
}
/*-----------------------------------------------------------------------------------*/
/* The Admin Backend 
/*-----------------------------------------------------------------------------------*/

function icyfactory_admin_head() { 
	
	// Here you can easily tweak the message on theme activation
	?>
    
    <script type="text/javascript">
    jQuery(function(){
	var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=icy'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    
	<?php
}
add_action('admin_head', 'icyfactory_admin_head'); 

add_action('admin_bar_menu', 'add_toolbar_items', 100);
function add_toolbar_items($admin_bar){
	$admin_bar->add_menu( array(
		'id'    => 'my-item',
		'title' => 'Theme Options',
		'href'  => admin_url( 'themes.php?page=icy' ),
		'meta'  => array(
			'title' => __('Theme Options'),			
		),
	));
}

?>