<?php
//
// ----------------
// Shared Metaboxes
// ----------------
//

	
// Layout & Sidebar

add_action("admin_init", "page_sidebar_metabox");   

function page_sidebar_metabox(){
	add_meta_box("page_sidebar_metabox", "Layout & Sidebar", "page_sidebar_config", "post", "side", "low");
	add_meta_box("page_sidebar_metabox", "Layout & Sidebar", "page_sidebar_config", "page", "side", "low");
}   

function page_sidebar_config(){
        global $post,$of_option;
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);
		$layout = $custom["page_layout"][0];
		if(!$layout){
			$page_layout = $of_option['st_main_layout'];
		}else{
			$page_layout = $custom["page_layout"][0];
		}
		$page_sidebar = $custom["page_sidebar"][0];
		$page_second_sidebar = $custom["page_second_sidebar"][0];
?>
    <table class="form-table custom-table side-table">
    	<tr>
            <td class="title-column">Layout:</td>
            <td class="">        
                <span><input type="radio" id="fullwidth" name="page_layout" class="checkbox of-radio-img-radio" value="fullwidth" <?php if($page_layout == "fullwidth") { echo 'checked="checked"'; } ?>>
                <img src="<?php echo get_template_directory_uri() ?>/admin/assets/images/1col.png" alt="" class="of-radio-img-img layout-fullwidth <?php if($page_layout == "fullwidth") { echo 'of-radio-img-selected"'; } ?>" onClick="document.getElementById('fullwidth').checked = true;" />
                </span>
                <span><input type="radio" id="sidebar-right" name="page_layout" class="checkbox of-radio-img-radio"  value="sidebar-right" <?php if($page_layout == "sidebar-right") { echo 'checked="checked"'; } ?>>
                <img src="<?php echo get_template_directory_uri() ?>/admin/assets/images/2cr.png" alt="" class="of-radio-img-img layout-other <?php if($page_layout == "sidebar-right") { echo 'of-radio-img-selected"'; } ?>" onClick="document.getElementById('sidebar-right').checked = true;" /></span>
                <span><input type="radio" id="sidebar-left" name="page_layout" class="checkbox of-radio-img-radio"  value="sidebar-left" <?php if($page_layout == "sidebar-left") { echo 'checked="checked"'; } ?>>
                <img src="<?php echo get_template_directory_uri() ?>/admin/assets/images/2cl.png" alt="" class="of-radio-img-img layout-other <?php if($page_layout == "sidebar-left") { echo 'of-radio-img-selected"'; } ?>" onClick="document.getElementById('sidebar-left').checked = true;" /></span>
                <span><input type="radio" id="sidebar-both" name="page_layout" class="checkbox of-radio-img-radio"  value="sidebar-both" <?php if($page_layout == "sidebar-both") { echo 'checked="checked"'; } ?>>
                <img src="<?php echo get_template_directory_uri() ?>/admin/assets/images/3cm.png" alt="" class="of-radio-img-img layout-both <?php if($page_layout == "sidebar-both") { echo 'of-radio-img-selected"'; } ?>" onClick="document.getElementById('sidebar-both').checked = true;" /></span>
            </td>
        </tr>
    	<tr class="primary-sidebar" <?php if($page_layout == "fullwidth") { echo 'style="display:none;"'; } ?>>
            <td class="title-column">Sidebar</td>
            <td class="select-fields">        
                <select name="page_sidebar"> 
                <option value="Default Sidebar"<?php if($page_sidebar == $sidebar) echo "selected"; ?>>Default Sidebar</option>
            	<?php
								
				// Retrieve all portfolio templates from the folder
								
				$sidebars = get_option('sidebarmanager_options');  
  
				if(isset($sidebars['custom_sidebar']) && sizeof($sidebars['custom_sidebar']) > 0)  
				{  
					foreach($sidebars['custom_sidebar'] as $sidebar)  
					{  
				?>                
				<option value="<?php echo $sidebar; ?>"<?php if($page_sidebar == $sidebar) echo "selected"; ?>><?php echo $sidebar; ?></option>';
                
				<?php
                	}  
				}				
				?>            	

                </select>
            </td>
        </tr>   
        <tr class="second-sidebar" <?php if($page_layout !== "sidebar-both") { echo 'style="display:none;"'; } ?>>
            <td class="title-column">Second Sidebar</td>
            <td class="select-fields">        
                <select name="page_second_sidebar"> 
                <option value="Default Post Sidebar"<?php if($page_sidebar == $sidebar) echo "selected"; ?>>Default Post Sidebar</option>
            	<?php
								
				// Retrieve all portfolio templates from the folder
								
				$sidebars = get_option('sidebarmanager_options');  
  
				if(isset($sidebars['custom_sidebar']) && sizeof($sidebars['custom_sidebar']) > 0)  
				{  
					foreach($sidebars['custom_sidebar'] as $sidebar)  
					{  
				?>
                
				<option value="<?php echo $sidebar; ?>"<?php if($page_second_sidebar == $sidebar) echo "selected"; ?>><?php echo $sidebar; ?></option>';
                
				<?php
                	}  
				}				
				?>            	

                </select>
            </td>
        </tr>      
    </table>

<?php
    }
	
// Page Title

add_action("admin_init", "page_title_metabox");   

function page_title_metabox(){
    add_meta_box("page_title_metabox", "Page Title", "page_title_config", "portfolio", "side", "low");
	add_meta_box("page_title_metabox", "Page Title", "page_title_config", "post", "side", "low");
	add_meta_box("page_title_metabox", "Page Title", "page_title_config", "page", "side", "low");
}   

function page_title_config(){
        global $post;
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);
		$page_title_disabled = $custom["page_title_disabled"][0];
?>
    <table class="form-table custom-table side-table">
    	<tr>
            <td class="title-column">Disable page title?</td>
            <td class="select-fields">        
                <span><input type="checkbox" name="page_title_disabled" value="enabled" <?php if($page_title_disabled) { echo 'checked="checked"'; } ?>></span>
            </td>
        </tr>           
    </table>

<?php
    }	

// Page tagline
	
add_action("admin_init", "page_tagline");   

function page_tagline(){
	add_meta_box("page_tagline", "Page Tagline", "page_tagline_config", "page", "side", "low");
	add_meta_box("page_tagline", "Page Tagline", "page_tagline_config", "portfolio", "side", "low");
}   

function page_tagline_config(){
        global $post;
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);
		$page_tagline = $custom["page_tagline"][0];
?>
    <p><textarea class="textarea-full" name="page_tagline"><?php echo $page_tagline; ?></textarea></p>

<?php
    }	
	
// Save Custom Fields
	
add_action('save_post', 'save_shared_settings'); 

function save_shared_settings(){
    global $post;  

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	}else{
		update_post_meta($post->ID, "page_layout", $_POST["page_layout"]);		
		update_post_meta($post->ID, "page_sidebar", $_POST["page_sidebar"]);
		update_post_meta($post->ID, "page_second_sidebar", $_POST["page_second_sidebar"]);
		update_post_meta($post->ID, "page_title_disabled", $_POST["page_title_disabled"]);
		update_post_meta($post->ID, "page_tagline", $_POST["page_tagline"]);
    }

}