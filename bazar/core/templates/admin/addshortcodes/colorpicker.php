<div class="fieldset">
	<label for="<?php echo $var[0].'-'.$var[2]; ?>"><?php if (isset($var[1]['title']) && $var[1]['title'] != '') : echo $var[1]['title']; else: echo $var[0]; endif; ?></label>
	
	<div id="<?php echo $var[0].'-'.$var[2]; ?>_container" class="colorpicker_container">
		<div style="background-color: <?php echo $var[1]['std'] ?>;"></div>
    	<input type="text" name="shortcode-<?php echo $var[0]; ?>" id="<?php echo $var[0].'-'.$var[2]; ?>" style="width:150px" value="<?php echo $var[1]['std'] ?>" />
    </div>
    <div class="clear"></div>
    
    <script type="text/javascript" charset="utf-8">
		jQuery(document).ready(function($){
			
			$('#<?php echo $var[0].'-'.$var[2]; ?>_container').ColorPicker({
				color: '<?php echo $var[1]['std'] ?>',
				onShow: function (colpkr) {
					$(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb) {
					$('#<?php echo $var[0].'-'.$var[2]; ?>_container div').css('backgroundColor', '#' + hex);
					$('#<?php echo $var[0].'-'.$var[2]; ?>_container').children( 'input' ).attr( 'value', '#' + hex );
				}
			});
	        
		});
    </script>
</div>