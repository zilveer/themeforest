<?php
	global $wpv_fonts;

	$current_size = wpv_get_option($id.'-size');
	$current_lheight = wpv_get_option($id.'-lheight');
	$current_face = wpv_get_option($id.'-face');
	$current_weight = wpv_get_option($id.'-weight');
	$current_color = wpv_get_option($id.'-color');

	$weights = array(
		'300',
		'300 italic',
		'normal',
		'italic',
		'600',
		'600 italic',
		'bold',
		'bold italic',
		'800',
		'800 italic',
	);

	if(!isset($only)) {
		$only = array();
	} else {
		$only = explode(',', $only);
	}

	$show = new stdClass;
	$show->size = (in_array('size', $only) || sizeof($only) == 0)  ? '' : 'hidden';
	$show->size_lheight_sep = ( (in_array('size', $only) && in_array('lheight', $only)) || sizeof($only) == 0)  ? '' : 'hidden';
	$show->lheight = (in_array('lheight', $only) || sizeof($only) == 0)  ? '' : 'hidden';
	$show->face = (in_array('face', $only) || sizeof($only) == 0)  ? '' : 'hidden';
	$show->weight = (in_array('weight', $only) || sizeof($only) == 0)  ? '' : 'hidden';
	$show->color = (in_array('color', $only) || sizeof($only) == 0)  ? '' : 'hidden';
?>

<div class="wpv-config-row font clearfix <?php echo $class ?>">
	<?php if(isset($name)): ?>
		<div class="rtitle">
			<h4><?php echo $name?></h4>
			<?php wpv_description($id, $desc) ?>
		</div>
	<?php endif ?>

	<div class="rcontent">

		<div class="font-preview"><?php _e('The quick brown fox jumps over the lazy dog', 'health-center')?></div>
		<div class="font-styles"></div>

		<span class="wrapper size-wrapper <?php echo $show->size?>">
			<select name="<?php echo $id?>-size" class="size <?php wpv_static($value)?>">
				<?php for($i = $min; $i<=$max; $i++): ?>
					<option value="<?php echo $i?>" <?php selected($i, $current_size) ?>><?php echo $i?> px</option>
				<?php endfor ?>
			</select>
			<div class="sub-desc"><?php _e('font size', 'health-center')?></div>
		</span>

		<span class="size-lheight-separator <?php echo $show->size_lheight_sep?>">/</span>

		<span class="wrapper lheight-wrapper <?php echo $show->lheight?>">
			<select name="<?php echo $id?>-lheight" class="lheight <?php wpv_static($value)?>">
				<?php for($i = $lmin; $i<=$lmax; $i++): ?>
					<option value="<?php echo $i?>" <?php selected($i, $current_lheight) ?>><?php echo $i?> px</option>
				<?php endfor ?>
			</select>
			<div class="sub-desc"><?php _e('line height', 'health-center')?></div>
		</span>

		<span class="wrapper face-wrapper <?php echo $show->face?>">
			<select name="<?php echo $id?>-face" class="face <?php wpv_static($value)?>">
				<?php foreach($wpv_fonts as $face => $font): ?>
					<option value="<?php echo $face?>" <?php selected($face, $current_face) ?>><?php echo $face?></option>
				<?php endforeach ?>
			</select>
			<div class="sub-desc"><?php _e('font', 'health-center')?></div>
		</span>

		<span class="wrapper weight-wrapper <?php echo $show->weight?>">
			<select name="<?php echo $id?>-weight" class="weight <?php wpv_static($value)?>">
				<?php foreach($weights as $w): ?>
					<option value="<?php echo $w?>" <?php selected($w, $current_weight) ?>><?php echo ucwords($w)?></option>
				<?php endforeach ?>
			</select>
			<div class="sub-desc"><?php _e('style', 'health-center')?></div>
		</span>

		<span class="wrapper color-wrapper <?php echo $show->color?>">
			<input type="color" name="<?php echo $id?>-color" class="wpv-color-input <?php wpv_static($value)?>" data-hex="true" value="<?php echo $current_color?>" />
			<div class="sub-desc"><?php _e('color', 'health-center')?></div>
		</span>
	</div>
</div>