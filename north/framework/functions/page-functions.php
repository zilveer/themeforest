<?php
//
// Blog Post Settings
//


add_action("admin_init", "vntd_page_layout");   

function vntd_page_layout(){    
    add_meta_box("vntd_page_settings", "Page Settings", "vntd_page_settings_config", "page", "side", "low");
    add_meta_box("vntd_page_settings", "Page Settings", "vntd_page_settings_config", "post", "side", "low");
    add_meta_box("vntd_page_settings", "Page Settings", "vntd_page_settings_config", "portfolio", "side", "low");

}   

function vntd_page_settings_config() {
        global $post,$smof_data;	
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);
        $page_header = $page_subtitle = $navbar_style = $navbar_color = $page_layout = $page_sidebar = $page_width = $footer_color = $footer_widgets = '';
        if(array_key_exists("page_header", $custom)) {
			$page_header = $custom["page_header"][0];
		}
		if(array_key_exists("page_subtitle", $custom)) {
			$page_subtitle = $custom["page_subtitle"][0];
		}
		if(array_key_exists("navbar_style", $custom)) {
			$navbar_style = $custom["navbar_style"][0];
		}
		if(array_key_exists("navbar_color", $custom)) {
			$navbar_color = $custom["navbar_color"][0];
		}
		if(array_key_exists("page_layout", $custom)) {
			$page_layout = $custom["page_layout"][0];	
		}
		if(array_key_exists("page_sidebar", $custom)) {
			$page_sidebar = $custom["page_sidebar"][0];
		}
		if(array_key_exists("page_width", $custom)) {
			$page_width = $custom["page_width"][0];
		}
		if(array_key_exists("footer_color", $custom)) {
			$footer_color = $custom["footer_color"][0];
		}
		if(array_key_exists("footer_widgets", $custom)) {
			$footer_widgets = $custom["footer_widgets"][0];
		}
?>
    <div class="metabox-options form-table side-options">
  		
		<div id="page-header" class="label-radios">  		
			<h5><?php _e('Page Title','veented_backend'); ?>:</h5>
    	    <?php
    	    $headers = array(
    	    	'Enabled' => "default",
    	    	'No Page Title' => 'no-header'
    	    );
    	    
    	    vntd_create_dropdown('page_header',$headers,$page_header);
    	    
    	    ?>
    	    
    	</div>
    	
    	<div id="vntd_page_header_default" <?php if($page_header != "default" && $page_header) { echo 'class="hidden"'; } ?>>
    		<h5><?php _e('Page Tagline','veented_backend'); ?>:</h5>
    		<input type="text" name="page_subtitle" value="<?php echo $page_subtitle; ?>">
    	</div>
    	
    	<div id="navbar-style">  		
    		<h5><?php _e('Header Style','veented_backend'); ?>:</h5>
    	    <?php
    	    $navbar_styles = array(
    	    	'Default set in Theme Options' => "default",
    	    	'Style1' => 'style1',
    	    	'Style2' => 'style2',
    	    	'Style3' => 'style3',
    	    	'Disable' => 'disable'
    	    );
    	    
    	    vntd_create_dropdown('navbar_style',$navbar_styles,$navbar_style);
    	    
    	    ?>
    	    
    	</div>
    	
    	<div id="navbar-color">  		
    		<h5><?php _e('Header Color','veented_backend'); ?>:</h5>
    	    <?php
    	    $navbar_colors = array(
    	    	'Default set in Theme Options' => "default",
    	    	'White' => 'white',
    	    	'Dark' => 'dark'
    	    );
    	    
    	    vntd_create_dropdown('navbar_color',$navbar_colors,$navbar_color);
    	    
    	    ?>
    	    
    	</div>
    	
    	<?php if(get_post_type(get_the_id()) == 'portfolio') { } else { ?>
    	
    	<div class="metabox-option">
			<h5><?php _e('Layout','veented_backend'); ?>:</h5>
			
			<?php 
			if(!$page_layout) $page_layout = $smof_data['vntd_default_layout'];
			$page_layout_arr = array('Right Sidebar' => 'sidebar_right', 'Left Sidebar' => 'sidebar_left', "Fullwidth" => 'fullwidth');  
			
			vntd_create_dropdown('page_layout',$page_layout_arr,$page_layout,true);
			
			?>
		</div>
		<div class="metabox-option fold fold-page_layout fold-sidebar_right fold-sidebar_left" <?php if($page_layout == "fullwidth" || !$page_layout) echo 'style="display:none;"'; ?>>
			<h5><?php _e('Page Sidebar','veented_backend'); ?>:</h5>
			<select name="page_sidebar" class="select"> 
                <option value="Default Sidebar"<?php if($page_sidebar == "Default Sidebar" || !$page_sidebar) echo "selected"; ?>>Default Sidebar</option>
            	<?php
            								
				// Retrieve custom sidebars
											
				$sidebars = $smof_data['sidebar_generator'];  
  
				if(isset($sidebars) && sizeof($sidebars) > 0)  
				{  
					foreach($sidebars as $sidebar)  
					{  
				?>                
				<option value="<?php echo $sidebar['title']; ?>"<?php if($page_sidebar == $sidebar['title']) echo "selected"; ?>><?php echo $sidebar['title']; ?></option>
                
				<?php
                	}  
				}	
				
				if(class_exists('Woocommerce')) {
				
					if($page_sidebar == "WooCommerce Shop Page") $selected_shop = "selected";
					if($page_sidebar == "WooCommerce Product Page") $selected_product = "selected";
					
					echo '<option value="WooCommerce Shop Page" '.$selected_shop.'>WooCommerce Shop Page</option>';
					echo '<option value="WooCommerce Product Page" '.$selected_product.'>WooCommerce Product Page</option>';
				}			
				?>            	

            </select>
		</div>
		
		<?php } ?>

		<?php if(get_post_type(get_the_id()) == 'post') { ?>
		<div class="metabox-option fold fold-page_layout fold-fullwidth" <?php if($page_layout != "fullwidth" && get_post_type(get_the_id()) != 'portfolio') echo 'style="display:none;"'; ?>>
			<h5><?php _e('Page Content Width','veented_backend'); ?>:</h5>
			
			<?php 
			if(!$page_layout) $page_layout = $smof_data['vntd_default_layout'];
			$page_width_arr = array('Container' => 'content', 'Fullwidth' => 'fullwidth');  
			
			vntd_create_dropdown('page_width',$page_width_arr,$page_width,true);
			
			?>
		</div>
		<?php } else { ?>
		<div class="metabox-option fold fold-page_layout fold-fullwidth" <?php if($page_layout != "fullwidth" && get_post_type(get_the_id()) != 'portfolio') echo 'style="display:none;"'; ?>>
			<h5><?php _e('Page Content Width','veented_backend'); ?>:</h5>
			
			<?php 
			if(!$page_layout) $page_layout = $smof_data['vntd_default_layout'];
			$page_width_arr = array('Fullwidth' => 'fullwidth', 'Container' => 'content');  
			
			vntd_create_dropdown('page_width',$page_width_arr,$page_width,true);
			
			?>
		</div>
		
		<?php } ?>
		
		<div id="footer-color">  		
			<h5><?php _e('Footer Color','veented_backend'); ?>:</h5>
		    <?php
		    $footer_colors = array(
		    	'Default set in Theme Options' => "default",
		    	'White' => 'white',
		    	'Dark' => 'dark'
		    );
		    
		    vntd_create_dropdown('footer_color',$footer_colors,$footer_color);
		    
		    ?>
		    
		</div>
		
		<div id="footer-color">  		
			<h5><?php _e('Footer Widgets Area','veented_backend'); ?>:</h5>
		    <?php
		    $footer_widgets_arr = array(
		    	'Default set in Theme Options' => "default",
		    	'Enabled' => 'enabled',
		    	'Disabled' => 'disabled'
		    );
		    
		    vntd_create_dropdown('footer_widgets',$footer_widgets_arr,$footer_widgets);
		    
		    ?>
		    
		</div>
        
    </div>
<?php

}	
	
// Save Custom Fields
	
add_action('save_post', 'vntd_save_page_settings'); 

function vntd_save_page_settings(){
    global $post;  

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	}else{		
	
		$post_metas = array('page_layout','page_sidebar','page_width','navbar_style','navbar_color','footer_color','page_header','page_title','page_subtitle','footer_widgets');
		
		foreach($post_metas as $post_meta) {
			if(isset($_POST[$post_meta])) update_post_meta($post->ID, $post_meta, $_POST[$post_meta]);
		}

    }

}