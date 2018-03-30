<?php
/**
 * select row
 */

global $post;
?>
<div class="wpv-config-row <?php echo $class?> select-row clearfix">
	
	<div class="rtitle">
		<h4><?php echo $name?></h4>
		
		<?php wpv_description('', $desc) ?>
	</div>
	
	<div class="rcontent">
		<?php foreach($selects as $id=>$s): ?>
			<?php
				if (isset($s['target'])) {
					if (isset($s['options']))
						$s['options'] = $s['options'] + WpvConfigGenerator::get_select_target_config($s['target']);
					else
						$s['options'] = WpvConfigGenerator::get_select_target_config($s['target']);
				}

				if(isset($GLOBALS['wpv_in_metabox'])) {
					$selected = get_post_meta($post->ID, $id, true);
				} else {
					$selected = wpv_get_option($id, $s['default']);
				}
			?>
			<div class="single-option">
				<div class="single-desc"><?php echo $s['desc'] ?></div>
				
				<select name="<?php echo $id?>" id="<?php echo $id?>" class="<?php wpv_static($value)?>">
				
					<?php if(isset($s['prompt'])): ?>
						<option value=""><?php echo $s['prompt']?></option>
					<?php endif ?>
					
					<?php foreach($s['options'] as $key => $option): ?>
						<option value="<?php echo $key?>" <?php selected($selected, $key) ?>><?php echo $option?></option>
					<?php endforeach ?>
				
					<?php if (isset($s['page'])): ?>
						<?php 
						$args = array(
							'depth' => $s['page'],
							'child_of' => 0,
							'selected' => $selected,
							'echo' => 1,
							'name' => 'page_id',
							'id' => '',
							'show_option_none' => '',
							'show_option_no_change' => '',
							'option_none_value' => ''
						);
						$pages = get_pages($args);
					
						echo walk_page_dropdown_tree($pages,$depth,$args);
						?>
					<?php endif ?>
				</select>
			</div>
		<?php endforeach ?>
	</div>
</div>
