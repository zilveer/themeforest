<?php

//Setup visual editor for content builder
require_once get_template_directory() . '/modules/js-wp-editor.php' ;

function grandportfolio_content_create_meta_box() {

	$grandportfolio_page_postmetas = grandportfolio_get_page_postmetas();
	
	if ( function_exists('add_meta_box') && isset($grandportfolio_page_postmetas) && count($grandportfolio_page_postmetas) > 0 ) {  
		add_meta_box( 'content_metabox', 'Content Builder Option', 'grandportfolio_content_new_meta_box', 'page', 'normal', 'high' );
		add_meta_box( 'content_metabox', 'Content Builder Option', 'grandportfolio_content_new_meta_box', 'portfolios', 'normal', 'high' );
	}

} 

function grandportfolio_content_new_meta_box() {
	$post = grandportfolio_get_wp_post();
	$grandportfolio_page_postmetas = grandportfolio_get_page_postmetas();
	
	require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
	
	$ppb_enable = get_post_meta($post->ID, 'ppb_enable');
?>
	<br/>
	
	<strong><?php esc_html_e('Enable Content Builder', 'grandportfolio-translation' ); ?></strong>
	<hr class="pp_widget_hr">
	<div class="pp_widget_description"><?php esc_html_e('To build this page using content builder, please enable this option.', 'grandportfolio-translation' ); ?></div><br/>
	<input type="checkbox" class="iphone_checkboxes" name="ppb_enable" id="ppb_enable" value="1" <?php if(!empty($ppb_enable)) { ?>checked<?php } ?> />
	
	<?php if(!empty($ppb_enable)) { ?>
	<script>
		jQuery(document).ready(function(){
			jQuery('#postdivrich').hide();
			jQuery('#preview-action').hide();
			jQuery('#page_template').val('default');
	      	jQuery('#page_template').attr('disabled','disabled');
	      	jQuery('#ppb_page_content').removeClass('hidden');
	      	jQuery('#page_template').attr('disabled','disabled');
		});
	</script>
	<?php } ?>
	
	<br class="clear"/><br/>
	<input type="hidden" name="ppb_post_type" id="ppb_post_type" value="page"/>
	<input type="hidden" name="ppb_options" id="ppb_options" value=""/>
	<input type="hidden" name="ppb_options_title" id="ppb_options_title" value=""/>
	<input type="hidden" name="ppb_options_unsaved" id="ppb_options_unsaved" value=""/>
	
	<div id="ppb_page_content" class="hidden">
		<?php
			//Check if user edit page
			if (isset($_GET['action']) && $_GET['action'] == 'edit')
			{
		?>
		<div class="ppb_page_title"><?php the_title(); ?></div>
		<div class="ppb_page_action">
			<a id="ppb_preview_page" class="tooltipster" title="<?php esc_html_e('Preview Page', 'grandportfolio-translation' ); ?>" data-action="<?php echo esc_url(admin_url('admin-ajax.php?action=grandportfolio_ppb_preview_page_set_data')); ?>" data-preview="<?php echo esc_url(admin_url('admin-ajax.php?action=grandportfolio_ppb_preview_page&ppb_post_type=page&page_id='.$post->ID)); ?>" data-page="<?php echo esc_attr($post->ID); ?>"><i class="fa fa-search"></i></a>
			<!-- a id="ppb_save_template" class="tooltipster" title="<?php esc_html_e('Save as template', 'grandportfolio-translation' ); ?>"><i class="fa fa-copy"></i></a -->
			<a id="ppb_save" class="tooltipster" title="<?php esc_html_e('Save Changes', 'grandportfolio-translation' ); ?>"><i class="fa fa-floppy-o"></i></a>
		</div>
		<br class="clear"/>
		<?php
			}
		?>
	
	<?php
		//Find all tabs
		$ppb_tabs = array();
		
		foreach($ppb_shortcodes as $key => $ppb_shortcode)		
		{
			if(is_numeric($key) && $ppb_shortcode['title']!='Close')
			{
				$ppb_tabs[$key] = $ppb_shortcode['title'];
			}
		}

		//Add tabs
		if(!empty($ppb_tabs))
		{
	?>
		<div id="ppb_tab">
			<ul>
	<?php
			foreach($ppb_tabs as $tab_key => $ppb_tab)	
			{
	?>
			<li><a href="#tabs-<?php echo esc_attr($tab_key); ?>"><?php echo esc_html($ppb_tab); ?></a></li>
	<?php	
			}
	?>
			</ul>
	<?php
		}
	?>
	
	<?php
		foreach($ppb_shortcodes as $key => $ppb_shortcode)		
		{
			//If new tab
			if(is_numeric($key) && $ppb_shortcode['title']!='Close')
			{
	?>
		<div id="tabs-<?php echo esc_attr($key); ?>">
			<ul id="ppb_module_wrapper">
	<?php
			}
			
			//If normal content builder module
			if(!isset($ppb_shortcode['type']) && isset($ppb_shortcode['icon']) && !empty($ppb_shortcode['icon']))
			{
	?>
	<li id="ppb_module_<?php echo esc_attr($key); ?>" data-module="<?php echo esc_attr($key); ?>" data-title="<?php echo esc_attr($ppb_shortcode['title']); ?>" data-type="module"><img src="<?php echo get_template_directory_uri(); ?>/functions/images/builder/<?php echo esc_attr($ppb_shortcode['icon']); ?>" alt="" title="<?php echo esc_attr($ppb_shortcode['title']); ?>" class="builder_thumb"/>
		<span class="builder_title"><?php echo esc_html($ppb_shortcode['title']); ?></span>
	</li>
	<?php
			}
			//If demo pages module
			elseif(isset($ppb_shortcode['type']) && $ppb_shortcode['type'] == 'demo_page')
			{
	?>
	<li id="ppb_module_<?php echo esc_attr($key); ?>" data-module="<?php echo esc_attr($key); ?>" data-title="<?php echo esc_attr($ppb_shortcode['title']); ?>" data-type="demo_page" data-file="<?php echo esc_attr($ppb_shortcode['file']); ?>" data-key="<?php echo esc_attr($key); ?>">
		<div class="builder_page_icon"><span class="dashicons dashicons-format-aside"></span></div>
		<span class="builder_title"><?php echo esc_html($ppb_shortcode['title']); ?></span>
	</li>
	<?php
			}
						
			//If next is new tab
			if(is_numeric($key) && $ppb_shortcode['title']=='Close')
			{
	?>
			</ul>
		</div>
	<?php
			}
		} //End foreach
		
		//Add tabs
		if(!empty($ppb_tabs))
		{
	?>
		</div>
	<?php
		}
	?>

	<a id="ppb_sortable_preview_button" class="button" style="float:left;" href="<?php echo esc_url(admin_url('admin-ajax.php?action=grandportfolio_ppb_demo_preview')); ?>"><?php esc_html_e('Preview', 'grandportfolio-translation' ); ?></a>
	<a id="ppb_sortable_add_button" class="button button-primary" style="float:left;"><?php esc_html_e('Add', 'grandportfolio-translation' ); ?></a>
	<input type="hidden" id="ppb_inline_current" name="ppb_inline_current" value=""/>
	<input type="hidden" id="ppb_form_data_order" name="ppb_form_data_order" value=""/>

	<?php
		//Get builder item
		$ppb_form_data_order = get_post_meta($post->ID, 'ppb_form_data_order');
		$ppb_form_item_arr = array();
		
		if(isset($ppb_form_data_order[0]))
		{
			$ppb_form_item_arr = explode(',', $ppb_form_data_order[0]);
		}
	?>
	
	<ul id="content_builder_sort" class="ppb_sortable <?php if(!isset($ppb_form_item_arr[0]) OR empty($ppb_form_item_arr[0])) { ?>empty<?php } ?>" rel="content_builder_sort_data"> 
	<?php
		
		if(isset($ppb_form_item_arr[0]) && !empty($ppb_form_item_arr[0]))
		{
			foreach($ppb_form_item_arr as $key => $ppb_form_item)
			{
				$ppb_form_item_data = get_post_meta($post->ID, $ppb_form_item.'_data');
				$ppb_form_item_size = get_post_meta($post->ID, $ppb_form_item.'_size');
				$ppb_form_item_data_obj = json_decode($ppb_form_item_data[0]);
			
				if(isset($ppb_form_item[0]) && isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
				{
					$ppb_shortocde_title = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode]['title'];
					$ppb_shortocde_icon = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode]['icon'];
					
					if($ppb_form_item_data_obj->shortcode!='ppb_divider')
					{
						$obj_title_name = $ppb_form_item_data_obj->shortcode.'_title';
						
						if(property_exists($ppb_form_item_data_obj, $obj_title_name))
						{
							$obj_title_name = $ppb_form_item_data_obj->$obj_title_name;
						}
						else
						{
							$obj_title_name = '';
						}
					}
					else
					{
						$obj_title_name = '<div class="shortcode_title">Paragraph Break</div>';
						$ppb_shortocde_title = '';
					}
	?>
			<li id="<?php echo esc_attr($ppb_form_item); ?>" class="ui-state-default <?php echo esc_attr($ppb_form_item_size[0]); ?> <?php echo esc_attr($ppb_form_item_data_obj->shortcode); ?>" data-current-size="<?php echo esc_attr($ppb_form_item_size[0]); ?>">
				<div class="size">
					<a href="javascript:;" title="<?php esc_html_e('Increase Size', 'grandportfolio-translation' ); ?>" class="ppb_plus button">+</a>
					<a href="javascript:;" title="<?php esc_html_e('Decrease Size', 'grandportfolio-translation' ); ?>" class="ppb_minus button">-</a>
				</div>
				<div class="thumb"><img src="<?php echo get_template_directory_uri(); ?>/functions/images/builder/<?php echo esc_attr($ppb_shortocde_icon); ?>" alt=""/></div>
				<div class="title"><div class="shortcode_title"><?php echo esc_html($ppb_shortocde_title); ?></div>&nbsp;<?php echo rawurldecode($obj_title_name); ?></div>
				
				<div class="item_action">
					<a href="javascript:;" class="ppb_remove tooltipster" title="<?php esc_html_e('Remove', 'grandportfolio-translation' ); ?>"><i class="fa fa-trash"></i></a>
					<a data-rel="<?php echo esc_attr($ppb_form_item); ?>" href="<?php echo esc_url(admin_url('admin-ajax.php?action=grandportfolio_ppb_preview&ppb_post_type=page&title='.urlencode($ppb_shortocde_title).'&page_id='.$post->ID.'&shortcode='.$ppb_form_item_data_obj->shortcode.'&rel='.$ppb_form_item)); ?>" class="ppb_preview tooltipster" title="<?php esc_html_e('Preview', 'grandportfolio-translation' ); ?>"><i class="fa fa-search"></i></a>
					<a href="javascript:;" class="ppb_duplicate tooltipster" title="<?php esc_html_e('Duplicate', 'grandportfolio-translation' ); ?>"><i class="fa fa-copy"></i></a>
					<a data-rel="<?php echo esc_attr($ppb_form_item); ?>" href="<?php echo esc_url(admin_url('admin-ajax.php?action=grandportfolio_ppb&ppb_post_type=page&shortcode='.$ppb_form_item_data_obj->shortcode.'&rel='.$ppb_form_item.'&width=800&height=900')); ?>" class="ppb_edit tooltipster" title="<?php esc_html_e('Edit', 'grandportfolio-translation' ); ?>"><i class="fa fa-edit"></i></a>
				</div>
				<input type="hidden" class="ppb_setting_columns" value="<?php echo esc_attr($ppb_form_item_size[0]); ?>"/>
			</li>
	<?php
				}
			}
		}
	?>
	
	</ul>
	<input type="hidden" id="ppb_save_current_template" name="ppb_save_current_template"/>
	
	<br class="clear"/><br/>
	
	<div id="ppb_import_tab">
		<ul>
			<li><a href="#tabs-import"><?php esc_html_e('Import', 'grandportfolio-translation' ); ?></a></li>
			<li><a href="#tabs-export"><?php esc_html_e('Export', 'grandportfolio-translation' ); ?></a></li>
		</ul>
		
		<div id="tabs-import">
			<strong><?php esc_html_e('Import Page Content Builder', 'grandportfolio-translation' ); ?></strong>
			<div class="pp_widget_description"><?php esc_html_e('Choose the import file. *Note: Your current content builder content will be overwritten by imported data', 'grandportfolio-translation' ); ?></div><br/>
			
			<input type="file" id="ppb_import_current_file" name="ppb_import_current_file" value="0" size="25"/>
			<input type="hidden" id="ppb_import_demo_file" name="ppb_import_demo_file"/>
			<input type="hidden" id="ppb_import_current" name="ppb_import_current"/>
			<input type="submit" id="ppb_import_current_button" class="button" value="Import"/>
		</div>
		
		<div id="tabs-export">
			<strong><?php esc_html_e('Export Current Page Content Builder', 'grandportfolio-translation' ); ?></strong>
			<div class="pp_widget_description"><?php esc_html_e('Click to export current content builder data. *Note: Please make sure you save all changes and no "unsaved" module', 'grandportfolio-translation' ); ?></div><br/>
			
			<input type="hidden" id="ppb_export_current" name="ppb_export_current"/>
			<input type="submit" id="ppb_export_current_button" name="ppb_export_current_button" class="button" value="Export"/>
		</div>
	</div>
	
	<script type="text/javascript">
	jQuery(document).ready(function(){
	<?php
		foreach($ppb_form_item_arr as $key => $ppb_form_item)
		{
			if(!empty($ppb_form_item))
			{
				$ppb_form_item_data = get_post_meta($post->ID, $ppb_form_item.'_data');
	?>
				jQuery('#<?php echo esc_js($ppb_form_item); ?>').data('ppb_setting', '<?php echo addslashes($ppb_form_item_data[0]); ?>');
	<?php
			}
		}
	?>
			jQuery(window).bind('beforeunload', function(){
				if(jQuery('#ppb_options_unsaved').val()==1)
				{
			    	return '<?php esc_html_e('There are unsaved content builder settings', 'grandportfolio-translation' ); ?>';
			    }
			});
	});
	</script>
	</div>
<?php

}

//init

add_action('admin_menu', 'grandportfolio_content_create_meta_box'); 
?>