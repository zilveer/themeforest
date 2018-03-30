<?php

function plsh_load_admin_menus() 
{
	add_menu_page( plsh_gs('theme_name'), plsh_gs('theme_name'), 'administrator', plsh_gs('theme_slug').'-admin', 'plsh_admin', PLSH_ADMIN_ASSET_URL . 'images/planetshine-cp-panel-icon.png', 79);
	add_submenu_page( plsh_gs('theme_slug').'-admin', 'Theme Options', 'Theme Options', 'administrator', plsh_gs('theme_slug').'-admin', 'plsh_admin');
}

function plsh_load_admin_styles($hook_suffix) 
{
     if($hook_suffix == 'toplevel_page_' . PLSH_THEME_DOMAIN . '-admin') {
        wp_enqueue_style('admin-style', get_template_directory_uri() .'/core/panel/assets/css/style.css', array(), '4.3.1');
        wp_enqueue_style('fileupload-ui-noscript', get_template_directory_uri() .'/core/panel/assets/css/jquery.fileupload-ui-noscript.css');
        wp_enqueue_style('fileupload-ui', get_template_directory_uri() .'/core/panel/assets/css/jquery.fileupload-ui.css');
        wp_enqueue_style('fileupload-ui-base', get_template_directory_uri() .'/core/panel/assets/css/jquery.fileupload.base.css');
        $protocol = is_ssl() ? 'https' : 'http';
        wp_enqueue_style('roboto', $protocol . '://fonts.googleapis.com/css?family=Roboto:100,300,400');
        wp_enqueue_style('font-awesome', get_template_directory_uri() .'/core/panel/assets/css/font-awesome.css');
     }
     wp_enqueue_style('plsh-global-style', get_template_directory_uri() .'/core/panel/assets/css/global-style.css');
}
 
function plsh_load_admin_scripts($hook_suffix) 
{	 	
 	if($hook_suffix == 'toplevel_page_' . PLSH_THEME_DOMAIN . '-admin') {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-widget');
        wp_enqueue_script('uniform', get_template_directory_uri() .'/core/panel/assets/js/jquery.uniform.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget' ));
        wp_enqueue_script('dropkick', get_template_directory_uri() .'/core/panel/assets/js/jquery.dropkick.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget' ));
        wp_enqueue_script('fileupload', get_template_directory_uri() .'/core/panel/assets/js/jquery.fileupload.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget' ));
        wp_enqueue_script('iframe-transport', get_template_directory_uri() .'/core/panel/assets/js/jquery.iframe-transport.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget' ));
        wp_enqueue_script('admin-scripts', get_template_directory_uri() .'/core/panel/assets/js/scripts.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget' ));   
    }
}


function plsh_save_settings()
{
    check_ajax_referer('plsh_save_settings');
 	parse_str($_POST['data'],$data);
 	
    Plsh_Settings :: store_settings($data);
 	
 	die(json_encode(array('status' => 'ok', 'msg' => 'Settings saved!')));
}
 

function plsh_load_style_preset()
{
    check_ajax_referer('plsh_load_style_preset');
 	
    $preset = $_POST['preset'];
    $all_presets = plsh_gs('presets', false);
    $settings = $all_presets[$preset];
 	
    foreach($settings as $setting_group)
    {
        foreach($setting_group as $key => $value)
        {
            set_theme_mod($key, $value);
        }
    }
    
 	die(json_encode(array('status' => 'ok', 'msg' => 'Settings saved!')));
}

function plsh_import_settings()
{
    check_ajax_referer('plsh_import_settings');
    parse_str($_POST['data'],$data);
       
    Plsh_Settings :: import_settings($data['settings_export']);
    
    die(json_encode(array('status' => 'ok', 'msg' => 'Settings imported!')));
}

function plsh_reset_settings()
{
    check_ajax_referer('plsh_reset_settings');
    
    Plsh_Settings :: reset_settings();
    
    die(json_encode(array('status' => 'ok', 'msg' => 'Settings reset!')));
}

function plsh_get_admin_template($name)
{
    $path = PLSH_ADMIN_PANEL_TEMPLATE_PATH . $name . '.php';    

    if(file_exists($path))
    {
        include($path);
    }
}

function plsh_save_sidebar()
{
	global $_SETTINGS;
    check_ajax_referer('plsh_save_sidebar');
 	parse_str($_POST['data'],$data);
 	    
    if(!empty($data['action']))
    {
       
        //add new sidebar
        if($data['action'] == 'new')
        {
            if(strlen($data['name']) > 0)
            {
                $sidebars = plsh_gs('sidebars');
                foreach($sidebars as $sidebar)
                {
                    if($sidebar['name'] == $data['name'])
                    {
                        die(json_encode(array('status' => 'fail', 'msg' => 'name taken')));
                    }
                }
                
                $id = strtolower($data['name']);
                $id = preg_replace('/[^A-Za-z0-9-]/', '', $id);
                
                if(strlen($id) == 0)
                {
                    die(json_encode(array('status' => 'fail', 'msg' => 'invalid string')));
                }
                
                $sidebars[] = array(
                    'name' => $data['name'],
                    'id'   => $id,
                    'description' => '',
                    'class' => '',
                    'before_widget' => '<div id="%1$s" class="sidebar-item clearfix %2$s">',
                    'after_widget'  => '</div></div>',
                    'before_title'  => '<div class="title-default"><span class="active">',
                    'after_title'   => '</span></div><div class="widget-content">'
                );
                
                plsh_ss('sidebars', $sidebars);
                
                $item = '<li style="display: none;"><span>' . $data['name'] . '</span> <a href="#" class="delete-sidebar" id="' . $id .  '"></a>';
                
                die(json_encode(array('status' => 'ok', 'msg' => 'saved', 'html' => $item)));
            }
            else 
            {
                die(json_encode(array('status' => 'fail', 'msg' => 'name empty')));
            }
        }
        else if($data['action'] == 'delete')
        {
            if(!empty($data['id']))
            {
                $sidebars = plsh_gs('sidebars');
                foreach($sidebars as $key => $sidebar)
                {
                    if($sidebar['id'] == $data['id'])
                    {
                        unset($sidebars[$key]);
                        plsh_ss('sidebars', $sidebars);
                        die(json_encode(array('status' => 'ok', 'msg' => 'deleted')));
                    }
                }

                die(json_encode(array('status' => 'fail', 'msg' => 'sidebar id not found')));
            }
        }
        else if($data['action'] == 'manage')
        {    
            unset($data['action']);
            
            $page_sidebars = plsh_gs('page_sidebars');
            
            $templates = plsh_gs('page_types');
            foreach($data as $key => $value)
            {
                if(in_array($key, array_keys($templates)))
                {
                    $page_sidebars[$key] = $value;
                }
            }
            
            plsh_ss('page_sidebars', $page_sidebars);
            
            die(json_encode(array('status' => 'ok', 'msg' => 'Sidebars saved')));
            
        }   
    }
     	
}

function plsh_save_ad_locations()
{
    global $_SETTINGS;
    check_ajax_referer('plsh_save_ad_locations');
        
    parse_str($_POST['data'],$data);
    
    
    $locations_data = $_SETTINGS->admin_body['ads_manager']['ad_locations'];
    $locations = array_keys($locations_data);
    
    foreach($locations as $location)
    {
        $enabled = (!empty($data[$location . '_ad_enabled']) ? 'on' : 'off');
        $size_ads = (!empty($data[$location]) ? $data[$location] : false );
        $size = $ad_slug = false;
        
        $location_ad_data = array();
        
        if($size_ads)
        {
            $ad_keys = array_keys($size_ads);
            foreach($ad_keys as $ad)
            {
                $parts = explode('__', $ad);
                if(!empty($parts))
                {
                    $location_ad_data[] = array('ad_size' => $parts[0], 'ad_slug' => $parts[1]);
                }
            }
        }
        
        $result = array(
            'ad_enabled' => $enabled,
            'ads_linked' => $location_ad_data
        );
                
        plsh_ss($location, $result);
    }
    
    die(json_encode(array('status' => 'ok', 'msg' => 'Ads saved')));
    
}

function plsh_save_ads()
{
	global $_SETTINGS;
    check_ajax_referer('plsh_save_ads');
        
    $data = explode(';', $_POST['data']);
    array_pop($data); //remove last
    
    if(!empty($_POST['action']) && $_POST['action'] == 'plsh_save_ads')
    {
        foreach($data as $ad_group_key)
        {
            $ad_group_string = $_POST[$ad_group_key];
            parse_str($ad_group_string,$ad_group);
            
            $key_concat = implode(';', array_keys($ad_group));
            if(strpos($key_concat, '--') === false)    //if this is one item banner list
            {
                $new_group = array();
                foreach($ad_group as $key => $value)
                {
                    $start = strlen($ad_group_key . '__');
                    $new_key = substr($key, $start);
                    $new_group[$new_key] = $value;
                }
                
                plsh_ss($ad_group_key, $new_group);
            }
            else    //if this is multiple item banner list
            {
                $new_groups = array();
                foreach($ad_group as $key => $value)    //split content in new nicely separated arrays
                {
                    $parts = explode('--', $key);
                    $val_slug = $parts[1];
                    
                    $key_parts = explode('__', $parts[0]);                    
                    $key_slug = $key_parts[1];
                    
                    if(empty($new_groups[$key_slug]))
                    {
                        $new_groups[$key_slug] = array();
                    }
                    $new_groups[$key_slug][$val_slug] = $value;
                }
                
                foreach($new_groups as $key => $ng_item)
                {
                    if(!empty($ng_item['ad_slug']) && $ng_item['ad_slug']=='NA')
                    {
                        $new_groups[$key]['ad_slug'] = uniqid();
                    }
                }
                
                plsh_ss($ad_group_key, $new_groups);
            }
        }
    }
    
    die(json_encode(array('status' => 'ok', 'msg' => 'Ads saved')));
}

function plsh_upload_image() {
    
    check_ajax_referer('plsh_upload_image');
    
    $field = plsh_get($_GET, 'field', 'files');
    
    $options = array( 
        'upload_url' => PLSH_UPLOAD_URL,
        'upload_dir' => PLSH_UPLOAD_PATH,
        'param_name' => $field,
        'image_versions' => array(),
        'accept_file_types' => '/\.(gif|jpe?g|png|ico)$/i'
    );
    ob_start();
    $upload = new UploadHandler($options);
    $response = ob_get_contents();
    ob_end_clean();
    die($response);
}

function plsh_output_theme_setting($option) {
	 
    if(!empty($option['value']))
    {
        $value = $option['value'];
    }
    else
    {
        $value = plsh_gs($option['slug']);
    }    
    
	$value = stripslashes($value);    
    
	$depend_class = $display_class = '';
	if(!empty($option['dependant'])) 	//if this option is dependant of other option
	{		
		$dep_slug = $option['dependant'];
        $dep_parts = explode(' ', $dep_slug);
        foreach($dep_parts as $dep_part)
        {
            $depend_class .= " depend_".$dep_part;
        }
		
		$display_class = 'depend_hide';
				
		if(plsh_gs($dep_slug)) 
		{
			if(plsh_gs($dep_slug) == 'on')
			{
				$display_class = '';
			}
		}
        
        
		/* WTF?! 
		elseif(isset($option_group->$dep_slug->value)) {
			if($option_group->$dep_slug->value != 'on') {
				$display_class = 'depend_hide';
			}
			
		}*/
		
	}
	
	$return = '<div class="form-item clearfix ' . $depend_class . ' ' . $display_class. '">';
    
    $description = '';
    if(!empty($option['description']))
    {
        $description = '<span class="tooltip-1"><i>' . $option['description'] . '</i></span>';
    }
	
	 if($option['type'] == "textbox") {
	 	
        $return.= '<p class="label">' . $option['title'] . ' ' . $description . '</p>';
        
        if(!empty($option['warning']))
        {
            $return.= '<div class="row-wrapper-2">';
            $return.= '      <div class="row">';
            $return.= '          <input name="' . $option['slug'] . '" value="' . htmlspecialchars($value) . '" type="text" />';
            $return.= '      </div>';
            $return.= '     <div class="row">';
            $return.= '         <div class="info-message-1">' . $option['warning'] . '</div>';
            $return.= '     </div>';
            $return.= '</div>';
        }
        else
        {
            $return.= '<input name="' . $option['slug'] . '" value="' . htmlspecialchars($value) . '" type="text" />';
        }        
        
	 }
	  elseif($option['type'] == "textarea") {
          
		$return.= '<p class="label">' . $option['title'] . ' ' . $description . '</p>';
        
        if(!empty($option['warning']))
        {
            $return.= '<div class="row-wrapper-2">';
            $return.= '      <div class="row">';
            $return.= '          <textarea name="' . $option['slug'] . '" $value>' . htmlspecialchars($value) . '</textarea>';
            $return.= '      </div>';
            $return.= '     <div class="row">';
            $return.= '         <div class="info-message-1">' . $option['warning'] . '</div>';
            $return.= '     </div>';
            $return.= '</div>';
        }
        else
        {
            $return.= '<textarea name="' . $option['slug'] . '">' . htmlspecialchars($value) . '</textarea>';
        }
	 }
	 elseif($option['type'] == "checkbox") {
	
        $return.= '<p class="label">' . $option['title'] . ' ' . $description . '</p>';
        $return.= '<input name="' . $option['slug'] . '" id="' . $option['slug'] . '" type="checkbox" class="styled"';
        if($value == 'on') { $return.= ' checked="checked"'; }
		$return.= ' />'; 
		
		//$return.= '<div class="description"><label for="'.$option['slug'].'">';
		//$return.= $option['description'];
		//$return.= '</label></div>';
	
	 }
     elseif($option['type'] == "switcher") {
	
        $return.= '<p class="label">' . $option['title'] . ' ' . $description . '</p>';
		
        if(!empty($option['warning']))
        {
            $return.= '<div class="row-wrapper-2">';
            $return.= '      <div class="row">';
            $return.= '     <label class="switch-wrapper"><input name="' . $option['slug'] . '" id="' . $option['slug'] . '" type="checkbox" class="switch"';
            if($value == 'on') { $return.= ' checked="checked"'; }
            $return.= '     /></label>';           
            $return.= '      </div>';
            $return.= '     <div class="row">';
            $return.= '         <div class="info-message-1">' . $option['warning'] . '</div>';
            $return.= '     </div>';
            $return.= '</div>';
        }
        else
        {
            $return.= '<label class="switch-wrapper"><input name="' . $option['slug'] . '" id="' . $option['slug'] . '" type="checkbox" class="switch"';
            if($value == 'on') { $return.= ' checked="checked"'; }
            $return.= ' /></label>'; 
        }       
        
	
	 }
	 elseif($option['type'] == "select") {
	
        $return.= '<p class="label">' . $option['title'] . ' ' . $description . '</p>';
        
        if(!empty($option['warning']))
        {
            $return.= '<div class="row-wrapper-2">';
            $return.= '      <div class="row">';
            
            $return.= '<select name="'.$option['slug'].'" class="default" style="width: 347px;">';
		
            foreach($option['data'] as $key => $data) {
                $return.= '<option value="'. $key .'"';
                if($key == $value) { $return.= ' selected="selected"'; }
                $return.= '>' . $data . '</option>';
            }

            $return.= '</select>';
            
            $return.= '      </div>';
            $return.= '     <div class="row">';
            $return.= '         <div class="info-message-1">' . $option['warning'] . '</div>';
            $return.= '     </div>';
            $return.= '</div>';
        }
        else
        {
            $return.= '<select name="'.$option['slug'].'" class="default" style="width: 347px;">';
		
            foreach($option['data'] as $key => $data) {
                $return.= '<option value="'. $key .'"';
                if($key == $value) { $return.= ' selected="selected"'; }
                $return.= '>' . $data . '</option>';
            }

            $return.= '</select>';
        }
		
		//$return.= $option['description'];

	
	 }
	 elseif($option['type'] == "fileupload") {
	
        $return.= '<p class="label">' . $option['title'] . ' ' . $description . '</p>';
        $return.= '<input type="file" name="' .  $option['slug'] . '_file" class="styled fileupload" />';
        $return.= '<input type="hidden" id="' .  $option['slug'] . '_file" name="' .  $option['slug'] . '" value="' . $value . '" class="styled fileupload" />';
        $return.= '<p class="filename">';
        if($value)
        {
            $filename = explode('/', $value);
            $return.= ' <a href="' . $value . '" target="_blank">' . urldecode($filename[count($filename) - 1]) . '</a>';
        }
        $return.='</p>';
	 }
	 	 
	$return.= '</div>'; 
 	//$return.= '</div>';
 	
 	echo $return;
 }

function plsh_handle_admin_actions() 
{
    if(!empty($_GET['plsh_action']))
    {
        $action = $_GET['plsh_action'];
        if($action == 'install-auto-pages')
        {
            plsh_add_auto_pages();
            add_action('admin_notices', 'plsh_page_install_success_notification');
            remove_action('admin_notices', 'plsh_page_install_notification');
        }
        elseif($action == 'dismiss-auto-pages')
        {
            update_option('plsh_page_install_dismissed', true);
            remove_action('admin_notices', 'plsh_page_install_notification');
        }
        elseif($action == 'dismiss-thumb-regen')
        {
            update_option('plsh_page_thumb_regen_dismissed', true);
            remove_action('admin_notices', 'plsh_thumbnail_regenerate_notification');
        }
        elseif($action == 'plsh-db-migrate')
        {
            do_action('plsh_db_update_execute');
        }
    }
}

function plsh_remove_newsletter_notification()
{
	check_ajax_referer('plsh_remove_newsletter_notification');    
    ob_start();
	
	update_option('plsh_hide_admin_newsletter', true);
	
	echo json_encode(array('status' => 'ok'));
	
	$response = ob_get_contents();
    ob_end_clean();
    die($response);
}

function plsh_extra_google_fonts()
{
	check_ajax_referer('plsh_extra_google_fonts');
	parse_str($_POST['data'], $data);
    ob_start();
	
	if(!empty($data['fonts']))
	{
		$fonts = explode(',', $data['fonts']);
		debug($fonts ,0);
		update_option('plsh_extra_google_fonts', $fonts);
	}
	else
	{
		update_option('plsh_extra_google_fonts', array());
	}
	
	$response = ob_get_contents();
    ob_end_clean();
    die($response);
}
 
?>