<?php
/**
 * select row
 */

global $post;
?>
<div class="wpv-config-row <?php echo $class?> range-row clearfix">
	
	<div class="rtitle">
		<h4><?php echo $name?></h4>
		
		<?php wpv_description('', $desc) ?>
	</div>
	
	<div class="rcontent">
		<?php foreach($ranges as $id=>$s): ?>
			<?php
				$min = isset($s['min']) ? "min='{$s['min']}' " : '';
				$max = isset($s['max']) ? "max='{$s['max']}' " : '';
				$step = isset($s['step']) ? "step='{$s['step']}' " : '';
				$unit = isset($s['unit']) ? $s['unit'] : '';
			?>
			<div class="single-option">
				<div class="single-desc"><?php echo $s['desc'] ?></div>
				
				<div class="range-input-wrap clearfix">
					<span>
						<input name="<?php echo $id?>" id="<?php echo $id?>" type="text" value="<?php echo wpv_get_option($id, $s['default'])?>" <?php echo $min.$max.$step ?> class="wpv-range-input <?php wpv_static($value)?>" />
						<span><?php echo $unit?></span>
					</span>	
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>
