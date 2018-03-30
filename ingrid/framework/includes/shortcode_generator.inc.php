<?php

// shortcode generator
	$new_meta_boxes  = array(
		"sc_gen" => array(
		"name" => "ub_sc_generator",
		"std" => "",
		"title" => __("Shortcode Genarator","ingrid")
		)
	);

	function new_meta_boxes() {
		global $post, $new_meta_boxes;
		 
		foreach($new_meta_boxes as $meta_box) {
			$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_position', true);
			 

			echo'<div class="ub_input_field"><label>'.__("Select a shortcode:","ingrid").'</label>
			<select id="ub_scg_select" name="'.$meta_box['name'].'_type" id="'.$meta_box['name'].'_type" style="width: 200px; float: left;">
				<option value="">-</option>
				
				<option value="audio"'; if($meta_box_value == 'audio'){print ' selected="selected"';} print '>'.__('Audio Player','ingrid').'</option>	
				
				<option value="buttons"'; if($meta_box_value == 'buttons'){print ' selected="selected"';} print '>'.__('Buttons','ingrid').'</option>						
				
				<option value="cta"'; if($meta_box_value == 'cta'){print ' selected="selected"';} print '>'.__('Call to Action','ingrid').'</option>						
				
				<option value="columns"'; if($meta_box_value == 'columns'){print ' selected="selected"';} print '>'.__('Columns','ingrid').'</option>						
								
				<option value="gfonts"'; if($meta_box_value == 'gfonts'){print ' selected="selected"';} print '>'.__('Google Fonts','ingrid').'</option>						
				
				<option value="gmaps"'; if($meta_box_value == 'gmaps'){print ' selected="selected"';} print '>'.__('Google Map','ingrid').'</option>						
				
				<optgroup label="Grids">
					<option value="grid-modern"'; if($meta_box_value == 'grid-modern'){print ' selected="selected"';} print '>'.__('Modern Grid','ingrid').'</option>		
					<option value="grid-classic"'; if($meta_box_value == 'grid-classic'){print ' selected="selected"';} print '>'.__('Classic Grid','ingrid').'</option>		
				</optgroup>
				
				<option value="headings"'; if($meta_box_value == 'headings'){print ' selected="selected"';} print '>'.__('Headings','ingrid').'</option>						
				
				<option value="icons"'; if($meta_box_value == 'icons'){print ' selected="selected"';} print '>'.__('Icons','ingrid').'</option>						
				
				<option value="posts"'; if($meta_box_value == 'posts'){print ' selected="selected"';} print '>'.__('Display Posts','ingrid').'</option>						
				
				<option value="resp"'; if($meta_box_value == 'resp'){print ' selected="selected"';} print '>'.__('Responsive Appearance','ingrid').'</option>						
				
				<option value="rulers"'; if($meta_box_value == 'rulers'){print ' selected="selected"';} print '>'.__('Rulers','ingrid').'</option>										
				
				<optgroup label="Tables">
					<option value="table1"'; if($meta_box_value == 'table'){print ' selected="selected"';} print '>'.__('Table Style #1','ingrid').'</option>		
					<option value="table2"'; if($meta_box_value == 'table'){print ' selected="selected"';} print '>'.__('Table Style #2','ingrid').'</option>		
					<option value="ptable"'; if($meta_box_value == 'ptable'){print ' selected="selected"';} print '>'.__('Pricing Table','ingrid').'</option>		
				</optgroup>
				
				<optgroup label="Tabs">
					<option value="tab"'; if($meta_box_value == 'tab'){print ' selected="selected"';} print '>'.__('Horizontal','ingrid').'</option>						
					<option value="vtab"'; if($meta_box_value == 'vtab'){print ' selected="selected"';} print '>'.__('Vertical','ingrid').'</option>						
				</optgroup>	
				
				<option value="testemonial"'; if($meta_box_value == 'testemonial'){print ' selected="selected"';} print '>'.__('Testemonial','ingrid').'</option>	
			
				<option value="toggles"'; if($meta_box_value == 'toggles'){print ' selected="selected"';} print '>'.__('Toggles','ingrid').'</option>						
			
				<optgroup label="Typography">					
					<option value="circled"'; if($meta_box_value == 'circled'){print ' selected="selected"';} print '>'.__('Circled Letter','ingrid').'</option>						
					<option value="dropcap"'; if($meta_box_value == 'dropcap'){print ' selected="selected"';} print '>'.__('Dropcap','ingrid').'</option>						
					<option value="list"'; if($meta_box_value == 'list'){print ' selected="selected"';} print '>'.__('List','ingrid').'</option>						
					<option value="quote"'; if($meta_box_value == 'quote'){print ' selected="selected"';} print '>'.__('Quote','ingrid').'</option>						
				</optgroup>	
			
				<option value="video"'; if($meta_box_value == 'video'){print ' selected="selected"';} print '>'.__('Video','ingrid').'</option>		
				
				<option value="vspace"'; if($meta_box_value == 'vspace'){print ' selected="selected"';} print '>'.__('Vertical Space','ingrid').'</option>						
			
			</select></div>';	
			
			
		}
				
	}

	function create_meta_box() {
		global $theme_name;
		if ( function_exists('add_meta_box') ) {
			add_meta_box( 'new-meta-boxes', 'Shortcode Generator', 'new_meta_boxes', 'post', 'normal', 'high' );
			add_meta_box( 'new-meta-boxes', 'Shortcode Generator', 'new_meta_boxes', 'page', 'normal', 'high' );
		}
	}

	function save_postdata( $post_id ) {
		// no need for autosave
	}

	add_action('admin_menu', 'create_meta_box');
	add_action('save_post', 'save_postdata');
	
?>