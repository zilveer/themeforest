<?php

/** uncomment this function and hook to print admin notice to show all previously installed theme version.

function tt_show_versions_previously_installed(){
$ka_theme_versions_used = get_option('ka_theme_versions_used');
	
$message = '<div class="updated"><p>The following Karma Theme version numbers are versions previously installed (includes current version) on this WordPress installation. If you have altered the version number for testing purpose, Please remember to revert back in database options table.</p><ul>';
foreach($ka_theme_versions_used as $v){
$message.= "<li>$v</li>";
}
$message .= '</ul></div>';
echo $message;

}
add_action('admin_notices','tt_show_versions_previously_installed');

**/


/*---------------------------------------------------------------*/
/* Saves all previously installed Karma Theme versions
/* as an array in option table for later analysis
/* First implemented on version 4.1..
/* therefore does not contain version number less than 4.1
/* @since 4.1 dev 7
/*---------------------------------------------------------------*/
function tt_save_all_theme_version(){

	$ka_theme_versions_used = get_option('ka_theme_versions_used');

	if(empty($ka_theme_versions_used)){
	$ka_theme_versions_used = array();
	}
	
	$theme = wp_get_theme();
	if($theme->parent()){
	    /*
	    *this is child theme, we save the parent theme (Karma) version only, not child theme version.
	    *child theme could be created by customer and can be any name or version, we have no use for this data.
		*/
		$version = $theme->parent()->get('Version');
		}else{
		//this is Karma Theme only, we save this version number.
		$version = $theme->get('Version');
	}
    
    //we make sure that it is not already saved.
	if(!in_array($version,$ka_theme_versions_used)){
	//sort the version numbers from smallest to largest.
	sort($ka_theme_versions_used);
	//push in new version number
	array_push($ka_theme_versions_used,$version);
	//save the whole array back into option table
	update_option('ka_theme_versions_used',$ka_theme_versions_used);
	}

}
/*
*do the above function only when we switch to Karma Theme or Karma Theme's child theme!
*it does not run when you visit admin.
*/
add_action('after_switch_theme','tt_save_all_theme_version');



/*---------------------------------------------------------------*/
/* IE9 css fix for Browser Mode : IE9 with document mode : Internet Explorer 9 standards, 
/* does not affect Browser Mode: IE9 with document mode : Standards (Page Default)
/* @since 4.1 dev 6
/*---------------------------------------------------------------*/
function tt_custom_admin_head(){
//IE 9 fix for Document Mode: IE9 standards, does not affect Document Mode: Standards (Page Default)
echo "
<!--[if IE 9]>
<style>
#truethemes_container #main {
overflow:visible;
width:100%;
}
#truethemes_container #tt-options-sidebar {
position:absolute;
top:10%;
left:75%;
}
#tt-options-content-wrap {
    overflow:visible;
}
#truethemes_container #content {
	overflow:visible;
}
#tt-options-footer-save-bar {
	margin-top:0px !important;
}
#tt-options-content-wrap .main_save_button{
	top:45px;
	right: 15px;
	z-index:2;
}
</style>
<![endif]-->";
}
//hook into site option admin head only, does not affect other admin pages!
add_action('admin_head-appearance_page_siteoptions', 'tt_custom_admin_head');

/*---------------------------------------------------------------*/
/* Head Hook
/*---------------------------------------------------------------*/

function of_head() { do_action( 'of_head' ); }

/*---------------------------------------------------------------*/
/* Get the style path currently selected */
/*---------------------------------------------------------------*/

function of_style_path() {
    $style = $_REQUEST['style'];
    if ($style != '') {
        $style_path = $style;
    } else {
        $stylesheet = get_option('of_alt_stylesheet');
        $style_path = str_replace(".css","",$stylesheet);
    }
    if ($style_path == "default")
      echo 'images';
    else
      echo 'styles/'.$style_path;
}

/*---------------------------------------------------------------*/
/* Add default options after activation */
/*---------------------------------------------------------------*/

//@since 2.7.0 Mod by denzel, replace the previous function that does not work..
function propanel_default_settings_install(){

if(is_admin()):
 
	global $pagenow;
	
	// check if we are on theme activation page and activated is true.
	if(@$pagenow == 'themes.php' && @$_GET['activated'] == true):
	
	// reset all widgets - need karma fix... update_option( 'sidebars_widgets', $null );

	//if we are on theme activation page, do the following..
	
		$template = get_option('of_template');

			foreach($template as $t):
				$option_name   = $t['id'];
				$default_value = $t['std'];
				$value_check   = get_option("$option_name");
				if($value_check == ''){
				  update_option("$option_name","$default_value");
				}	
		
			endforeach;
	endif; //end if $pagenow
  
endif; //end if is_admin check

}
add_action('init','propanel_default_settings_install',90);
?>