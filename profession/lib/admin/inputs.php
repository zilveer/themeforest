<?php
	function admin_img($filename, $alt, $class="")
	{?>
		<img src="<?php echo THEME_ADMIN_URI . '/img/' . $filename; ?>" alt="<?php echo $alt; ?>" class="<?php echo $class; ?>" />
	<?php
	}
	
	function CSVInput($name, $placeholder = '')
	{
	?>
		<div class="csv-input">
			<div class="text-input clear-after">
				<input type="text" name="csv-value" class="csv-value" placeholder="<?php echo $placeholder; ?>" />
				<a href="#" class="btn-add"></a>
			</div>
			<div class="list"></div>			
			<input type="hidden" name="<?php echo $name; ?>" value="<?php echo esc_attr( opt($name) ); ?>" />
		</div>
	<?php
	}

    function SelectTag($name, $options,
                       $class = '',
                       $selectAttrs='',
                       $optionsAttrs = array())
    {
        $selected = opt($name);
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

	function MediaInput($name, $placeholder = '', $title='Upload Image', $referer = '', $class = '')
	{
	?>
		<div class="upload-field clear-after <?php echo $class; ?>" data-title="<?php echo $title; ?>" data-referer="<?php echo $referer; ?>" >
			<input type="text" name="<?php echo $name; ?>" value="<?php echo esc_attr( opt($name) ); ?>" placeholder="<?php echo $placeholder; ?>"  />
			<a href="#" class="upload-button"></a>
		</div>
	<?php
	}
	
	function ImageSelect($name, $options, $class='')
	{
		$selected = opt($name);
		?>
		<div class="imageSelect <?php echo $class; ?>">
		<?php 
		foreach($options as $key => $value)
		{
			$selectedClass = $value == $selected ? 'selected' : '';
		?>
			<a href="#" class="<?php echo $key . ' ' . $selectedClass; ?>"><?php echo $value; ?></a>
		<?php 
		}
		?>
			<input name="<?php echo $name; ?>" type="text" value="<?php echo $selected; ?>" />
		</div>
		<?php
	}
	
	function SwitchInput($name, $state0, $state1, $class='')
	{
	?>
		<div class="clear-after <?php echo $class; ?>">
			<div class="label"></div>
			<input name="<?php echo $name; ?>" type="range" class="switch" value="<?php echo esc_attr( opt($name) ); ?>" min="0" max="1" step="1"  data-state0="<?php echo $state0; ?>" data-state1="<?php echo $state1; ?>" />
		</div>
	<?php
	}
	
	function RangeInput($name, $min=1, $max=100, $step=1, $label='', $class='')
	{?>
		<div class="clear-after <?php echo $class; ?>">
			<div class="label"><?php echo $label; ?></div>
			<input name="<?php echo $name; ?>" type="range" min="<?php echo $min; ?>" max="<?php echo $max; ?>" step="<?php echo $step; ?>"  value="<?php echo esc_attr( opt($name) ); ?>" />
		</div>
	<?php
	}
	
	function TextInput($name, $placeholder='', $class = '')
	{
		$phAttr = $placeholder == "" ? "" : "placeholder=\"" . $placeholder . "\"";
	?>
	<div class="text-input <?php echo $class; ?>">
		<input type="text" name="<?php echo $name; ?>" value="<?php echo esc_attr( opt($name) ); ?>" <?php echo $phAttr; ?> />
	</div>
	<?php
	}
	
	function PasswordInput($name, $placeholder='', $class = '')
	{
		$phAttr = $placeholder == "" ? "" : "placeholder=\"" . $placeholder . "\"";
	?>
	<div class="text-input <?php echo $class; ?>">
		<input type="password" name="<?php echo $name; ?>" value="<?php echo esc_attr( opt($name) ); ?>" <?php echo $phAttr; ?> />
	</div>
	<?php
	}
	
	function Textarea($name, $placeholder='', $class = '')
	{
		$phAttr = $placeholder == "" ? "" : "placeholder=\"" . $placeholder . "\"";
	?>
	<div class="textarea-input <?php echo $class; ?>">
		<textarea name="<?php echo $name; ?>" cols="30" rows="10" <?php echo $phAttr; ?> ><?php echo stripslashes(opt($name)); ?></textarea>
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
	
	function ColorInput($name, $placeholder = '', $class='')
	{
		?>
		<div class="clear-after  <?php echo $class; ?>">
			<input name="<?php echo $name; ?>" type="text" value="<?php echo esc_attr( opt($name) ); ?>" class="colorinput" placeholder="<?php echo $placeholder; ?>" />
		</div>
		<?php
	}
