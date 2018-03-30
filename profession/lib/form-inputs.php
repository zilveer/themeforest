<?php
function SelectTag($name, $options, 
				   $class = '', 
				   $selectAttrs='', 
				   $optionsAttrs = array())
{
	global $post;
	$selected = get_post_meta( $post->ID, $name, true );
?>
<div class="clear-after <?php echo $class; ?>">
	<div class="select">
		<div></div>
		<select name="<?php echo $name; ?>" <?php echo $selectAttrs; ?>>
			<?php
			foreach($options as $value => $text)
			{
				$selectedAttr = $value == $selected ? 'selected="selected"' : '';
				$attrs = array_key_exists($value, $optionsAttrs) ? $optionsAttrs[$value] : '';
			?>
				<option value="<?php echo esc_attr($value); ?>" <?php echo $selectedAttr . ' ' . $attrs; ?>><?php  echo $text; ?></option>
			<?php
			}
			?>
		</select>
	</div>
</div>
<?php
}

function MultiSelectTag($name, $options, 
				       $class = '', 
				       $selectAttrs='', 
				       $optionsAttrs = array())
{
	global $post;
	$selected = get_post_meta( $post->ID, $name, true );
?>

	<select name="<?php echo $name . '[]'; ?>" multiple="" class="<?php echo $class; ?>" <?php echo $selectAttrs; ?>>
		<?php
		foreach($options as $value => $text)
		{
			$selectedAttr = in_array($value, $selected) ? 'selected="selected"' : '';
			$attrs = array_key_exists($value, $optionsAttrs) ? $optionsAttrs[$value] : '';
		?>
			<option value="<?php echo esc_attr($value); ?>" <?php echo $selectedAttr . ' ' . $attrs; ?>><?php  echo $text; ?></option>
		<?php
		}
		?>
	</select>

<?php
}

function TextInput($name, $placeholder='', $class = '')
{
	global $post;
?>
<div class="text-input <?php echo $class; ?>">
	<input type="text" name="<?php echo $name; ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, $name, true ) ); ?>" placeholder="<?php echo $placeholder; ?>" />
</div>
<?php
}

function ImageInput($name, $placeholder, $class = '')
{
	global $post;
?>
	<div class="upload-field clear-after <?php echo $class; ?>" data-title="<?php _e('Upload Image', TEXTDOMAIN) ?>" data-referer="px-portfolio-image" >
		<input type="text" name="<?php echo $name; ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, $name, true ) ); ?>" placeholder="<?php echo $placeholder; ?>"  />
		<a href="#" class="upload-button"></a>
	</div>
<?php
}

function ColorInput($name, $placeholder = '', $class='')
{
	global $post;
	?>
	<div class="clear-after  <?php echo $class; ?>">
		<input name="<?php echo $name; ?>" type="text" value="<?php echo esc_attr( get_post_meta( $post->ID, $name, true ) ); ?>" class="colorinput" placeholder="<?php echo $placeholder; ?>" />
	</div>
	<?php
}

function SwitchInput($name, $state0, $state1, $class='')
{
    global $post;
?>
<div class="switch-input clear-after <?php echo $class; ?>">
    <div class="label"></div>
    <input name="<?php echo $name; ?>" type="range" class="switch" value="<?php echo esc_attr( get_post_meta( $post->ID, $name, true ) ); ?>" min="0" max="1" step="1"  data-state0="<?php echo $state0; ?>" data-state1="<?php echo $state1; ?>" />
</div>
<?php
}
