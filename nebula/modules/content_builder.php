<?php
function content_create_meta_box() {

	global $page_postmetas;
	if ( function_exists('add_meta_box') && isset($page_postmetas) && count($page_postmetas) > 0 ) {  
		add_meta_box( 'content_metabox', 'Content Builder Option', 'content_new_meta_box', 'page', 'normal', 'high' );
	}

} 

function content_new_meta_box() {
	global $post, $page_postmetas;
	include (get_template_directory() . "/lib/contentbuilder.shortcode.lib.php");
	
	$ppb_enable = get_post_meta($post->ID, 'ppb_enable');
?>
	<br/>
	
	<strong>Enable Content Builder</strong>
	<hr class="pp_widget_hr">
	<div class="pp_widget_description">To build this page using content builder, please enable this option.</div><br/>
	<input type="checkbox" class="iphone_checkboxes" name="ppb_enable" id="ppb_enable" value="1" <?php if(!empty($ppb_enable)) { ?>checked<?php } ?> />
	
	<?php if(!empty($ppb_enable)) { ?>
	<script>
		jQuery(document).ready(function(){
			jQuery('#postdivrich').hide();
		});
	</script>
	<?php } ?>
	
	<br class="clear"/><br/><br/>
	
	<strong>Content Builder</strong>
	<hr class="pp_widget_hr">
	<select name="ppb_options" id="ppb_options" class="pp_sortable_select" style="float:left;">
	<option value="">Please Select Content</option>
	<?php
		foreach($ppb_shortcodes as $key => $ppb_shortcode)		
		{
	?>
	<option value="<?php echo $key; ?>" title="<?php echo $ppb_shortcode['title']; ?>"><?php echo $ppb_shortcode['title']; ?></option>
	<?php 
		}
	?>
	</select>
	<a id="ppb_sortable_add_button" class="button button-primary" style="margin-left:3px;float:left;">Add</a>
	<input type="hidden" id="ppb_inline_current" name="ppb_inline_current" value=""/>
	<input type="hidden" id="ppb_form_data_order" name="ppb_form_data_order" value=""/>

	<?php
		foreach($ppb_shortcodes as $key => $ppb_shortcode)
		{
	?>
		<div id="ppb_inline_<?php echo $key; ?>" data-shortcode="<?php echo $key; ?>" class="ppb_inline">
			<div class="icon32 icon-settings"></div>
			<div class="wrap">
				<h2><?php echo $ppb_shortcode['title']; ?></h2>
			</div>
			<br/><br/>
			<?php
				if(isset($ppb_shortcode['title']) && $ppb_shortcode['title']!='Divider')
				{
			?>
			<label for="<?php echo $key; ?>_title">Title</label><span class="label_desc">Enter Title for this content</span><br/>
			<input type="text" id="<?php echo $key; ?>_title" name="<?php echo $key; ?>_title" data-attr="title" value="Text Block"/>
			<br/><br/>
			<?php
				}
				else
				{
			?>
			<input type="hidden" id="<?php echo $key; ?>_title" name="<?php echo $key; ?>_title" data-attr="title" value="<?php echo $ppb_shortcode['title']; ?>"/>
			<?php
				}
			?>
			
			<?php
				foreach($ppb_shortcode['attr'] as $attr_name => $attr_item)
				{
					if(!isset($attr_item['title']))
					{
						$attr_title = ucfirst($attr_name);
					}
					else
					{
						$attr_title = $attr_item['title'];
					}
				
					if($attr_item['type']=='jslider')
					{
			?>
			<label for="<?php echo $key; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/>
			<input name="<?php echo $key; ?>_<?php echo $attr_name; ?>" id="<?php echo $key; ?>_<?php echo $attr_name; ?>" type="text" class="ppb_jslider" />
			<br/><br/>
			<?php
					}
			
					if($attr_item['type']=='file')
					{
			?>
			<label for="<?php echo $key; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/>
			<input name="<?php echo $key; ?>_<?php echo $attr_name; ?>" id="<?php echo $key; ?>_<?php echo $attr_name; ?>" type="text" /><br/>
			<a id="<?php echo $key; ?>_<?php echo $attr_name; ?>_button" name="<?php echo $key; ?>_<?php echo $attr_name; ?>_button" type="button" class="metabox_upload_btn button" rel="<?php echo $key; ?>_<?php echo $attr_name; ?>" style="margin:7px 0 0 0">Upload</a>
			<br/><br/>
			<?php
					}
					
					if($attr_item['type']=='select')
					{
			?>
			<label for="<?php echo $key; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/>
			<select name="<?php echo $key; ?>_<?php echo $attr_name; ?>" id="<?php echo $key; ?>_<?php echo $attr_name; ?>" class="ppb_select">
				<?php
						foreach($attr_item['options'] as $attr_key => $attr_item_option)
						{
				?>
						<option value="<?php echo $attr_key; ?>"><?php echo ucfirst($attr_item_option); ?></option>
				<?php
						}
				?>
			</select>
			<br class="clear"/><br/>
			<?php
					}
					
					if($attr_item['type']=='select_multiple')
					{
			?>
			<label for="<?php echo $key; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/>
			<select name="<?php echo $key; ?>_<?php echo $attr_name; ?>" id="<?php echo $key; ?>_<?php echo $attr_name; ?>" class="ppb_select" multiple="multiple">
				<?php
						foreach($attr_item['options'] as $attr_key => $attr_item_option)
						{
							if(!empty($attr_item_option))
							{
				?>
							<option value="<?php echo $attr_key; ?>"><?php echo ucfirst($attr_item_option); ?></option>
				<?php
							}
						}
				?>
			</select>
			<br class="clear"/><br/>
			<?php
					}
					
					if($attr_item['type']=='text')
					{
			?>
			<label for="<?php echo $key; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/>
			<input name="<?php echo $key; ?>_<?php echo $attr_name; ?>" id="<?php echo $key; ?>_<?php echo $attr_name; ?>" type="text" />
			<br/><br/>
			<?php
					}
					
					if($attr_item['type']=='textarea')
					{
			?>
			<label for="<?php echo $key; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/>
			<textarea name="<?php echo $key; ?>_<?php echo $attr_name; ?>" id="<?php echo $key; ?>_<?php echo $attr_name; ?>" cols="" rows="3"></textarea>
			<br/><br/>
			<?php
					}
				}
			?>
			
			<?php
				if(isset($ppb_shortcode['content']) && $ppb_shortcode['content'])
				{
			?>
					<label for="<?php echo $key; ?>_content">Content</label><span class="label_desc">Enter text/HTML content to display in this "<?php echo $ppb_shortcode['title']; ?>"</span><br/>
					<textarea id="<?php echo $key; ?>_content" name="<?php echo $key; ?>_content" cols="" rows="7"></textarea>
			<?php
				}
			?>
			<br/><br/>
			<a data-parent="ppb_inline_<?php echo $key; ?>" class="button-primary ppb_inline_save" href="#">Save Changes</a>
			<a class="button" href="javascript:;" onClick="jQuery.fancybox.close();">Cancel</a>
		</div>
	<?php
		}
	?>

	<ul id="content_builder_sort" class="ppb_sortable" rel="content_builder_sort_data"> 
	<?php
		$ppb_form_data_order = get_post_meta($post->ID, 'ppb_form_data_order');
		$ppb_form_item_arr = array();
		
		if(isset($ppb_form_data_order[0]))
		{
			$ppb_form_item_arr = explode(',', $ppb_form_data_order[0]);
		}

		if(isset($ppb_form_item_arr[0]) && !empty($ppb_form_item_arr[0]))
		{
			foreach($ppb_form_item_arr as $key => $ppb_form_item)
			{
				if(isset($ppb_form_item[0]))
				{
					$ppb_form_item_data = get_post_meta($post->ID, $ppb_form_item.'_data');
					$ppb_form_item_size = get_post_meta($post->ID, $ppb_form_item.'_size');
					$ppb_form_item_data_obj = json_decode($ppb_form_item_data[0]);
					$ppb_shortocde_title = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode]['title'];
					
					if($ppb_form_item_data_obj->shortcode!='ppb_divider')
					{
						$obj_title_name = $ppb_form_item_data_obj->shortcode.'_title';
						$obj_title_name = $ppb_form_item_data_obj->$obj_title_name;
					}
					else
					{
						$obj_title_name = '<span class="shortcode_title" style="margin-left:-5px">Divider</span>';
						$ppb_shortocde_title = '';
					}
	?>
			<li id="<?php echo $ppb_form_item; ?>" class="ui-state-default <?php echo $ppb_form_item_size[0]; ?> <?php echo $ppb_form_item_data_obj->shortcode; ?>" data-current-size="<?php echo $ppb_form_item_size[0]; ?>">
				<div class="title"><span class="shortcode_title"><?php echo $ppb_shortocde_title; ?></span>&nbsp;<?php echo urldecode($obj_title_name); ?></div>
				<a href="javascript:;" class="ppb_remove"></a>
				<a data-rel="<?php echo $ppb_form_item; ?>" href="#ppb_inline_<?php echo $ppb_form_item_data_obj->shortcode; ?>" class="pp_fancybox ppb_edit"></a>
				<input type="hidden" class="ppb_setting_columns" value="<?php echo $ppb_form_item_size[0]; ?>"/>
				
				
			</li>
	<?php
				}
			}
		}
	?>
	</ul>
	<br class="clear"/><br/>
	
	<script type="text/javascript">
	jQuery(document).ready(function(){
	<?php
		foreach($ppb_form_item_arr as $key => $ppb_form_item)
		{
			if(!empty($ppb_form_item))
			{
				$ppb_form_item_data = get_post_meta($post->ID, $ppb_form_item.'_data');
	?>
				jQuery('#<?php echo $ppb_form_item; ?>').data('ppb_setting', '<?php echo addslashes($ppb_form_item_data[0]); ?>');
	<?php
			}
		}
	?>
	});
	</script>
	
<?php

}

//init

add_action('admin_menu', 'content_create_meta_box'); 
?>