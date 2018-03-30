<?php
/*-----------------------------------------------------------------------------------*/
# Build The options
/*-----------------------------------------------------------------------------------*/
function tie_options_build( $value, $option_name, $data ){

	
	# get Google Fonts
	/*---------------------------*/
	require ('google-fonts.php');
	$google_font_array = json_decode ($google_api_output,true) ;
			
	$options_fonts = array();
	$options_fonts[''] = __( 'Default Font', 'tie' );
	foreach ($google_font_array as $item) {
		$variants='';
		$variantCount=0;
		foreach ($item['variants'] as $variant) {
			$variantCount++;
			if ($variantCount>1) { $variants .= '|'; }
			$variants .= $variant;
		}
		$variantText = ' (' . $variantCount .' '. __( 'Variants', 'tie' ) . ')';
		if ($variantCount <= 1) $variantText = '';
		$options_fonts[ $item['family'] . ':' . $variants ] = $item['family']. $variantText;
	}

 ?>
	<div class="option-item" id="<?php echo $value['id'] ?>-item">
		<span class="label">
		<?php if( !empty($value['name']) ) echo $value['name']; ?></span>
	
	<?php
	switch ( $value['type'] ) {
	
		//Text Option
		case 'text': ?>
			<input name="<?php echo $option_name ?>" id="<?php  echo $value['id']; ?>" type="text" value="<?php if( !empty( $data ) ) echo $data; elseif( !empty( $value['default'] ) ) echo $value['default'];  ?>" />
			<?php
				if( $value['id']=="slider_tag" || $value['id']=="featured_posts_tag" || $value['id']=="breaking_tag"){
				$tags = get_tags('orderby=count&order=desc&number=50'); ?>
				<a style="cursor:pointer" title="<?php _e( 'Choose from the most used tags', 'tie' )  ?>" onclick="toggleVisibility('<?php echo $value['id']; ?>_tags');"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/expand.png" alt="" /></a>
				<span class="tags-list" id="<?php echo $value['id']; ?>_tags">
					<?php foreach ($tags as $tag){?>
						<a style="cursor:pointer" onclick="if(<?php echo $value['id'] ?>.value != ''){ var sep = ' , '}else{var sep = ''} <?php echo $value['id'] ?>.value=<?php echo $value['id'] ?>.value+sep+(this.rel);" rel="<?php echo $tag->name ?>"><?php echo $tag->name ?></a>
					<?php } ?>
				</span>
			<?php } ?>		
		<?php 
		break;

		
		//Array Option
		case 'arrayText':  $currentValue = $data;?>
			<input name="<?php echo $option_name ?>[<?php echo $value['key']; ?>]" id="<?php  echo $value['id']; ?>[<?php echo $value['key']; ?>]" type="text" value="<?php if( !empty( $currentValue[$value['key']] ) ) echo $currentValue[$value['key']] ?>" />	
		<?php 
		break;
		
		
		//Short-Text Option
		case 'short-text': ?>
			<input style="width:50px" name="<?php echo $option_name ?>" id="<?php  echo $value['id']; ?>" type="text" value="<?php if( !empty( $data ) ) echo $data; elseif( !empty( $value['default'] ) ) echo $value['default']; ?>" />
		<?php 
		break;
		
		
		//Checkbox Option
		case 'checkbox':
			if( $data ){$checked = "checked=\"checked\"";  } else{$checked = "";} ?>
				<input class="on-of" type="checkbox" name="<?php echo $option_name ?>" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />			
		<?php	
		break;

		
		//Radio Option
		case 'radio':
		?>
			<div class="option-contents">
				<?php
				$i = 0;
				foreach ($value['options'] as $key => $option) { $i++; ?>
				<label style="display:block; margin-bottom:8px;"><input name="<?php echo $option_name ?>" id="<?php echo $value['id']; ?>" type="radio" value="<?php echo $key ?>" <?php if ( ( !empty(  $data ) && $data == $key ) || ( empty( $data ) && $i==1 ) ) { echo ' checked="checked"' ; } ?>> <?php echo $option; ?></label>
				<?php } ?>
			</div>
		<?php
		break;
		
		
		//Select Menu Option
		case 'select':
		?>
			<select name="<?php echo $option_name ?>" id="<?php echo $value['id']; ?>">
				<?php
				$i = 0;
				foreach ($value['options'] as $key => $option) {  $i++; ?>
				<option value="<?php echo $key ?>" <?php if ( ( !empty(  $data ) && $data == $key ) || ( empty( $data ) && $i==1 ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		<?php
		break;
		
		
		//Textarea Option
		case 'textarea':
		?>
			<textarea style="direction:ltr; text-align:left; width:350px;" name="<?php echo $option_name ?>" id="<?php echo $value['id']; ?>" type="textarea" rows="3" tabindex="4"><?php echo $data;  ?></textarea>
		<?php
		break;
		
		
		//Upload Option
		case 'upload':
		?>
				<input id="<?php echo $value['id']; ?>" class="img-path" type="text" size="56" style="direction:ltr; text-align:left" name="<?php echo $option_name ?>" value="<?php echo $data; ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="button" value="<?php _e( 'Upload', 'tie' )  ?>" />

				<?php if( isset( $value['extra_text'] ) ) : ?><span class="extra-text"><?php echo $value['extra_text'] ?></span><?php endif; ?>

				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if( !$data ) echo 'style="display:none;"' ?>>
					<img src="<?php if( $data ) echo $data; else echo get_template_directory_uri().'/framework/admin/images/empty.png'; ?>" alt="" />
					<a class="del-img" title="Delete"></a>
				</div>
				<script type='text/javascript'>
					jQuery('#<?php echo $value['id']; ?>').change(function(){
						jQuery('#<?php echo $value['id']; ?>-preview').show();
						jQuery('#<?php echo $value['id']; ?>-preview img').attr("src", jQuery(this).val());
					});
					tie_set_uploader( '<?php echo $value['id']; ?>' );
				</script>
		<?php
		break;
		
		
		//Slider Option
		case 'slider':
		?>
				<div id="<?php echo $value['id']; ?>-slider"></div>
				<input type="text" id="<?php echo $value['id']; ?>" value="<?php if( !empty( $data ) ) echo $data; elseif( !empty( $value['default'] ) ) echo $value['default']; else echo 0; ?>" name="<?php echo $option_name ?>" style="width:50px;" /> <?php echo $value['unit']; ?>
				<script>
				  jQuery(document).ready(function() {
					jQuery("#<?php echo $value['id']; ?>-slider").slider({
						range: "min",
						min: <?php echo $value['min']; ?>,
						max: <?php echo $value['max']; ?>,
						value: <?php if( !empty( $data ) ) echo $data; elseif( !empty( $value['default'] ) ) echo $value['default']; else echo 0; ?>,

						slide: function(event, ui) {
						jQuery('#<?php echo $value['id']; ?>').attr('value', ui.value );
						}
					});
				  });
				</script>
		<?php
		break;
		
		
		//Background Option
		case 'background':
			$current_value = $data;
			if( is_serialized( $current_value ) )
				$current_value = unserialize ( $current_value );
		?>
				<input id="<?php echo $value['id']; ?>-img" class="img-path" type="text" size="56" style="direction:ltr; text-align:left" name="<?php echo $option_name ?>[img]" value="<?php echo $current_value['img']; ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="button" value="<?php _e( 'Upload', 'tie' )  ?>" />
					
				<div style="margin-top:15px; clear:both">
					<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php echo $current_value['color'] ; ?>"></div></div>
					<input style="width:100px;"  name="<?php echo $option_name ?>[color]" id="<?php  echo $value['id']; ?>color" type="text" value="<?php echo $current_value['color'] ; ?>" />
					
					<select name="<?php echo $option_name ?>[repeat]" id="<?php echo $value['id']; ?>[repeat]" style="width:96px;">
						<option value="" <?php if ( !$current_value['repeat'] ) { echo ' selected="selected"' ; } ?>></option>
						<option value="repeat" <?php if ( $current_value['repeat']  == 'repeat' ) { echo ' selected="selected"' ; } ?>><?php _e( 'repeat', 'tie' )  ?></option>
						<option value="no-repeat" <?php if ( $current_value['repeat']  == 'no-repeat') { echo ' selected="selected"' ; } ?>><?php _e( 'no-repeat', 'tie' )  ?></option>
						<option value="repeat-x" <?php if ( $current_value['repeat'] == 'repeat-x') { echo ' selected="selected"' ; } ?>><?php _e( 'repeat-x', 'tie' )  ?></option>
						<option value="repeat-y" <?php if ( $current_value['repeat'] == 'repeat-y') { echo ' selected="selected"' ; } ?>><?php _e( 'repeat-y', 'tie' )  ?></option>
					</select>

					<select name="<?php echo $option_name ?>[attachment]" id="<?php echo $value['id']; ?>[attachment]" style="width:96px;">
						<option value="" <?php if ( !$current_value['attachment'] ) { echo ' selected="selected"' ; } ?>></option>
						<option value="fixed" <?php if ( $current_value['attachment']  == 'fixed' ) { echo ' selected="selected"' ; } ?>><?php _e( 'Fixed', 'tie' )  ?></option>
						<option value="scroll" <?php if ( $current_value['attachment']  == 'scroll') { echo ' selected="selected"' ; } ?>><?php _e( 'Scroll', 'tie' )  ?></option>
					</select>
					
					<select name="<?php echo $option_name ?>[hor]" id="<?php echo $value['id']; ?>[hor]" style="width:96px;">
						<option value="" <?php if ( !$current_value['hor'] ) { echo ' selected="selected"' ; } ?>></option>
						<option value="left" <?php if ( $current_value['hor']  == 'left' ) { echo ' selected="selected"' ; } ?>><?php _e( 'Left', 'tie' )  ?></option>
						<option value="right" <?php if ( $current_value['hor']  == 'right') { echo ' selected="selected"' ; } ?>><?php _e( 'Right', 'tie' )  ?></option>
						<option value="center" <?php if ( $current_value['hor'] == 'center') { echo ' selected="selected"' ; } ?>><?php _e( 'Center', 'tie' )  ?></option>
					</select>
					
					<select name="<?php echo $option_name ?>[ver]" id="<?php echo $value['id']; ?>[ver]" style="width:100px;">
						<option value="" <?php if ( !$current_value['ver'] ) { echo ' selected="selected"' ; } ?>></option>
						<option value="top" <?php if ( $current_value['ver']  == 'top' ) { echo ' selected="selected"' ; } ?>><?php _e( 'Top', 'tie' )  ?></option>
						<option value="bottom" <?php if ( $current_value['ver']  == 'bottom') { echo ' selected="selected"' ; } ?>><?php _e( 'Bottom', 'tie' )  ?></option>
						<option value="center" <?php if ( $current_value['ver'] == 'center') { echo ' selected="selected"' ; } ?>><?php _e( 'Center', 'tie' )  ?></option>

					</select>
				</div>
				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if( !$current_value['img']  ) echo 'style="display:none;"' ?>>
					<img src="<?php if( $current_value['img'] ) echo $current_value['img'] ; else echo get_template_directory_uri().'/framework/admin/images/empty.png'; ?>" alt="" />
					<a class="del-img" title="Delete"></a>
				</div>
					
				<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php echo $current_value['color'] ; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#<?php echo $value['id']; ?>colorSelector div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $value['id']; ?>color').val('#'+hex);
					}
				});
				jQuery('#<?php echo $value['id']; ?>-img').change(function(){
					jQuery('#<?php echo $value['id']; ?>-preview').show();
					jQuery('#<?php echo $value['id']; ?>-preview img').attr("src", jQuery(this).val());
				});
				tie_set_uploader( '<?php echo $value['id']; ?>', true );
				</script>
		<?php
		break;
		
		
		//Color Option
		case 'color':
		?>
			<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php echo $data; ?>"></div></div>
			<input style="width:80px;"  name="<?php echo $option_name ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo $data ; ?>" />
							
			<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php echo $data; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#<?php echo $value['id']; ?>colorSelector div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $value['id']; ?>').val('#'+hex);
					}
				});
				</script>
		<?php
		break;

		
		//Typography Option
		case 'typography':
			$current_value = $data;
		?>
				<div style="clear:both;"></div>
				<div style="clear:both; padding:10px 14px; margin:0 -15px;">
					<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php echo $current_value['color'] ; ?>"></div></div>
					<input style="width:80px;"  name="<?php echo $option_name ?>[color]" id="<?php  echo $value['id']; ?>color" type="text" value="<?php echo $current_value['color'] ; ?>" />
					
					<select name="<?php echo $option_name ?>[size]" id="<?php echo $value['id']; ?>[size]" style="width:55px;">
						<option value="" <?php if (!$current_value['size'] ) { echo ' selected="selected"' ; } ?>></option>
					<?php for( $i=1 ; $i<101 ; $i++){ ?>
						<option value="<?php echo $i ?>" <?php if (( $current_value['size']  == $i ) ) { echo ' selected="selected"' ; } ?>><?php echo $i ?></option>
					<?php } ?>
					</select>

					<select name="<?php echo $option_name ?>[font]" id="<?php echo $value['id']; ?>[font]" style="width:190px;">				
					<?php foreach( $options_fonts as $font => $font_name ){
						if( empty($font_name) || $font_name == 'Arabic' ){ ?>
						<optgroup disabled="disabled" label="<?php echo $font_name ?>"></optgroup>
						<?php  }else{ ?>
						<option value="<?php echo $font ?>" <?php if ( $current_value['font']  == $font ) { echo ' selected="selected"' ; } ?>><?php echo $font_name ?></option>
					<?php  }
					} ?>
					</select>
					
					<select name="<?php echo $option_name ?>[weight]" id="<?php echo $value['id']; ?>[weight]" style="width:96px;">
						<option value="" <?php if ( !$current_value['weight'] ) { echo ' selected="selected"' ; } ?>></option>
						<option value="normal" <?php if ( $current_value['weight']  == 'normal' ) { echo ' selected="selected"' ; } ?>><?php _e( 'Normal', 'tie' )  ?></option>
						<option value="bold" <?php if ( $current_value['weight']  == 'bold') { echo ' selected="selected"' ; } ?>><?php _e( 'Bold', 'tie' )  ?></option>
						<option value="lighter" <?php if ( $current_value['weight'] == 'lighter') { echo ' selected="selected"' ; } ?>><?php _e( 'Lighter', 'tie' )  ?></option>
						<option value="bolder" <?php if ( $current_value['weight'] == 'bolder') { echo ' selected="selected"' ; } ?>><?php _e( 'Bolder', 'tie' )  ?></option>
						<option value="100" <?php if ( $current_value['weight'] == '100') { echo ' selected="selected"' ; } ?>>100</option>
						<option value="200" <?php if ( $current_value['weight'] == '200') { echo ' selected="selected"' ; } ?>>200</option>
						<option value="300" <?php if ( $current_value['weight'] == '300') { echo ' selected="selected"' ; } ?>>300</option>
						<option value="400" <?php if ( $current_value['weight'] == '400') { echo ' selected="selected"' ; } ?>>400</option>
						<option value="500" <?php if ( $current_value['weight'] == '500') { echo ' selected="selected"' ; } ?>>500</option>
						<option value="600" <?php if ( $current_value['weight'] == '600') { echo ' selected="selected"' ; } ?>>600</option>
						<option value="700" <?php if ( $current_value['weight'] == '700') { echo ' selected="selected"' ; } ?>>700</option>
						<option value="800" <?php if ( $current_value['weight'] == '800') { echo ' selected="selected"' ; } ?>>800</option>
						<option value="900" <?php if ( $current_value['weight'] == '900') { echo ' selected="selected"' ; } ?>>900</option>
					</select>
					
					<select name="<?php echo $option_name ?>[style]" id="<?php echo $value['id']; ?>[style]" style="width:100px;">
						<option value="" <?php if ( !$current_value['style'] ) { echo ' selected="selected"' ; } ?>></option>
						<option value="normal" <?php if ( $current_value['style']  == 'normal' ) { echo ' selected="selected"' ; } ?>><?php _e( 'Normal', 'tie' )  ?></option>
						<option value="italic" <?php if ( $current_value['style'] == 'italic') { echo ' selected="selected"' ; } ?>><?php _e( 'Italic', 'tie' )  ?></option>
						<option value="oblique" <?php if ( $current_value['style']  == 'oblique') { echo ' selected="selected"' ; } ?>><?php _e( 'Oblique', 'tie' )  ?></option>
					</select>
				</div>

					
				<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php echo $current_value['color'] ; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#<?php echo $value['id']; ?>colorSelector div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $value['id']; ?>color').val('#'+hex);
						<?php if( $value['id'] == 'typography_test' ): ?>
						jQuery('#font-preview').css('color', '#' + hex);
						<?php endif; ?>
					}
				});
				</script>
		<?php
		break;
	}
	?>
	<?php if( isset( $value['extra_text'] ) && $value['type'] != 'upload' ) : ?><span class="extra-text"><?php echo $value['extra_text'] ?></span><?php endif; ?>
	<?php if( isset( $value['help'] ) ) : ?>
		<a class="mo-help tooltip"  title="<?php echo $value['help'] ?>"></a>
		<?php endif; ?>
	</div>	
<?php
}
?>