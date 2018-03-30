<?php

/*-----------------------------------------------------------------------------------*/
/* Head Hook
/*-----------------------------------------------------------------------------------*/

function of_head() { do_action( 'of_head' ); }

/*-----------------------------------------------------------------------------------*/
/* Add default options after activation */
/*-----------------------------------------------------------------------------------*/
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	//Call action that sets
	add_action('admin_head','of_option_setup');
}

function of_option_setup(){

	//Update EMPTY options
	$of_array = array();
	add_option('of_options',$of_array);

	$template = get_option('of_template');
	$saved_options = get_option('of_options');
	
	foreach($template as $option) {
		if($option['type'] != 'heading'){
			if (isset($option['id'])) {
			   $id = $option['id'];
			}
			if (isset($option['std'])) {
			   $std = $option['std'];
			}
			if (isset($id)) {
        $db_option = get_option($id); 
      }
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$of_array[$c_id] = $c_std; 
					}
				} else {
					if (isset($id)) {
  					update_option($id,$std);
  					$of_array[$id] = $std; 
				  }
				}
			}
			else { //So just store the old values over again.
				$of_array[$id] = $db_option;
			}
		}
	}
	update_option('of_options',$of_array);
}

/*-----------------------------------------------------------------------------------*/
/* Admin Backend */
/*-----------------------------------------------------------------------------------*/
function optionsframework_admin_head() { 
	
	//Tweaked the message on theme activate
	?>
    <script type="text/javascript">
    jQuery(function(){
	  var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=optionsframework'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    <?php
}


if(is_admin()){
  add_action('admin_head', 'optionsframework_admin_head'); 
	add_action('admin_init', 'add_admin_scripts');
}


function add_admin_scripts() {
  wp_enqueue_script( 'shortcodes', get_template_directory_uri() . '/admin/tinymce/shortcodelocalization.js');
	wp_localize_script( 'shortcodes', 'objectL10n', array(
  'elements_title' => __('Elements','vulcan'),
  'list_title' => __('List Style','vulcan'),
  'dropcap_title' => __('Dropcap','vulcan'),
  'pullquote_left_title' => __('Pullquote Left','vulcan'),
  'pullquote_right_title' => __('Pullquote Right','vulcan'),
  'tabs_title' => __('Tabs','vulcan'),
  'toggle_title' => __('Toggle','vulcan'),
  'image_title' => __('Image','vulcan'),
  'gmap_title' => __('Google Map','vulcan'),
  'youtube_title' => __('Youtube','vulcan'),
  'vimeo_title' => __('Vimeo','vulcan'),
  'button_title' => __('Button','vulcan'),
  'bulletlist_title' => __('Bullet List','vulcan'),
  'starlist_title' => __('Star List','vulcan'),
  'arrowlist_title' => __('Arrow List','vulcan'),
  'squarelist_title' => __('Square List','vulcan'),
  'checklist_title' => __('Check List','vulcan'),
  'deletelist_title' => __('Delete List','vulcan'),
  'penlist_title' => __('Pen List','vulcan'),
  'greenarrow_title' => __('Green Arrow List','vulcan'),
  'gearlist_title' => __('Gear List','vulcan'),
  'infobox_title' => __('Info Box','vulcan'),
  'successbox_title' => __('Success Box','vulcan'),
  'warningbox_title' => __('Warning Box','vulcan'),
  'errorbox_title' => __('Error Box','vulcan'),
  'onefourth_title' => __('One Fourth','vulcan'),
  'onefourth_last_title' => __('One Fourth Last','vulcan'),
  'onethird_title' => __('One Third','vulcan'),
  'onethird_last_title' => __('One Third Last','vulcan'),
  'onehalf_title' => __('One Half','vulcan'),
  'onehalf_last_title' => __('One Half Last','vulcan'),
  'twothird_title' => __('Two Third','vulcan'),
  'threefourth_title' => __('Three Fourth','vulcan'),
  'onefifth_title' => __('One Fifth','vulcan'),
  'onefifth_last_title' => __('One Fifth Last','vulcan'),
  'twothird_last_title' => __('Two Third Last','vulcan'),
  'threefourth_last_title' => __('Three Fourth Last ','vulcan'),
  'columns_title' => __('Columns','vulcan'),
  'content_title' => __('Content','vulcan'),
  'pricing_title' => __('Pricing Table','vulcan'),
  'accordion_title' => __('Accordion','vulcan'),
  'staff_title' => __('Staff List','vulcan'),
	));

}

	
	
?>