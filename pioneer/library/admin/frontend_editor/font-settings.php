<div id="fontselector">

	<!-- Tabs menu -->
	<ul>
		
		<li title="Header fonts"><a href="#font-tabs-1">Header fonts</a></li>
		<li title="Body fonts"><a href="#font-tabs-2">Body fonts</a></li>
		<li title="Size and color"><a href="#font-tabs-3">Colors and sizes</a></li>
	
	
	</ul>
	
	<?php
	
	$epic_fonts =  array(
			'Verdana, Geneva, Helvetica, sans serif' => "Verdana",
			'Georgia, Times New Roman, Times, serif' => "Georgia",
			'Courier New, Courier, monospace' => "Courier New",
			'Helvetica Neue, Helvetica, Arial, sans serif' => "Helvetica Neue",
			'Arial, Helvetica, sans serif' => "Arial",
			'Tahoma, Geneva, Helvetica,sans serif' => "Tahoma",
			'Trebuchet MS, Arial, Helvetica, sans serif' => "Trebuchet MS",
			'Lucida Sans Unicode, Lucida Grande, Helvetica, sans serif' => "Lucida Sans Unicode/Lucida Grande",
			);
			
	?>

	<form action="" method="post">
	
	<div id="font-tabs-1">
	
	<h5>Fonts for headers (H1 to h4)</h5>
	<p>
	<?php $epic_title_font_rendering = get_option('epic_title_font_rendering');?>
	<input type="radio" name="epic_title_font_rendering" value="websafe" <?php if($epic_title_font_rendering == 'websafe'){ echo 'checked="checked"';}?>/><label>Websafe fonts</label>
	<input type="radio" name="epic_title_font_rendering" value="google" <?php if($epic_title_font_rendering == 'google'){ echo 'checked="checked"';}?>/><label>Google fonts</label>
	</p>
	
	
	<div class="hidden">
	<h5>Google fonts</h5>
	<select name="" id="googleTitlefontselector">

	<?php
	
	$googlefonts = getGoogleFonts();
	$selectedfont = get_option('epic_google_title_fontfamily');
	$selectedTitleWeight = get_option('epic_title_google_fontfamily_weight');
	foreach ($googlefonts as $googlefont => $fontweight){
	
		echo '<option value="'.$googlefont.'" ';
		if($selectedfont == $googlefont){ echo 'selected="selected"';}
		echo ' data-weight="'.$fontweight.'">'.$googlefont.'</option>';
	
	}
	?>
	</select>
	</p>
	<h5>Font name</h5>
	<p><input type="text" name="epic_google_title_fontfamily" id="epic_google_title_fontfamily" value="<?php echo $selectedfont;?>"></p>
	<h5>Font weights</h5>
	<p><input type="text" name="epic_title_google_fontfamily_weight" id="epic_title_google_fontfamily_weight" value="<?php echo $selectedTitleWeight;?>"></p>
	
	<script>
	
	jQuery(function(){
		
			jQuery('#googleTitlefontselector').change(function(){
					var font = jQuery(this).find('option:selected').val();
					var weight = jQuery(this).find('option:selected').attr('data-weight');
					jQuery('#epic_title_google_fontfamily_weight').val(weight);
					jQuery('#epic_google_title_fontfamily').val(font);
			
			
			});
	
	
	});
	
	</script>
		
	</div>
	
	<div class="hidden">
	<h5>Websafe fonts</h5>
	<p>
	<select name="epic_websafe_title_font"/>
	<?php
	foreach ($epic_fonts as $font => $fontname){
	
		echo '<option value="'.$font.'" ';
		if(get_option('epic_websafe_title_font') == $font){ echo 'selected="selected"';}
		echo '>'.$fontname.'</option>';
	
	}
	?>
	</select>
	
	
	</p>
	</div>
		
	</div>
	
	
	
	<div id="font-tabs-2">
	
	<h5>Fonts for body and paragraph</h5>
	<p>
	<?php $epic_body_font_rendering = get_option('epic_body_font_rendering');?>
	<input type="radio" name="epic_body_font_rendering" value="websafe" <?php if($epic_body_font_rendering == 'websafe'){ echo 'checked="checked"';}?>/><label>Websafe fonts</label>
	<input type="radio" name="epic_body_font_rendering" value="google" <?php if($epic_body_font_rendering == 'google'){ echo 'checked="checked"';}?>/><label>Google fonts</label>	
	</p>
	
	
	<div class="hidden">
	<h5>Google fonts</h5>
	<p>
	
	<select name="" id="googleBodyfontselector">

	<?php
	
	$googlefonts = getGoogleFonts();
	$selectedfont = get_option('epic_body_google_fontfamily');
	$selectedWeight = get_option('epic_body_google_fontfamily_weight');
	
	foreach ($googlefonts as $googlefont => $fontweight){
	
		echo '<option value="'.$googlefont.'" ';
		if(get_option('epic_body_google_fontfamily') == $googlefont){ echo 'selected="selected"';}
		echo ' data-weight="'.$fontweight.'">'.$googlefont.'</option>';
	
	}
	?>
	</select>
	</p>
	<script>
	
	jQuery(function(){
		
			jQuery('#googleBodyfontselector').change(function(){
					var font = jQuery(this).find('option:selected').val();
					var weight = jQuery(this).find('option:selected').attr('data-weight');
					jQuery('#epic_body_google_fontfamily_weight').val(weight);
					jQuery('#epic_body_google_fontfamily').val(font);
			
			});
	
	
	});
	
	</script>
	<h5>Font name</h5>
	<p><input type="text" name="epic_body_google_fontfamily" id="epic_body_google_fontfamily" value="<?php echo $selectedfont;?>"></p>
	<h5>Font weights</h5>
	<p><input type="text" name="epic_body_google_fontfamily_weight" id="epic_body_google_fontfamily_weight" value="<?php echo $selectedWeight;?>"/></p>
	
	
	</div>
	
	<div class="hidden">
	<h5>Websafe fonts</h5>
	<p>
	<select name="epic_body_websafe_font"/>
	<?php
	foreach ($epic_fonts as $font => $fontname){
	
		echo '<option value="'.$font.'" ';
		if(get_option('epic_body_websafe_font') == $font){ echo 'selected="selected"';}
		echo '>'.$fontname.'</option>';
	
	}
	?>
	</select>
	
	</p>
	</div>	
	
	</div>
	
	
	<div id="font-tabs-3" style="clear:both;">
	<?php 
$fontlist = array(
	"h1" => "Header 1",
	"h2" => "Header 2",
	"h3" => "Header 3",
	"h4" => "Header 4",
	"h5" => "Header 5",
	"h6" => "Header 6",
	"p"  => "Paragraph",
	);
?>
<table class="fontoptions">
	<tr>
<?php

$int = 1;
foreach ($fontlist as $font => $fontname):

	$fontcolor =  get_option('epic_'.$font.'_color');
	$fontsize  =  get_option('epic_'.$font.'_size');
	if(!$fontsize){$fontsize = '13';}
	$fontweight = get_option('epic_'.$font.'_weight');
	echo $fontweight;
	?>
	<td>
		<?php echo $font;?> 
		<div id="slider-<?php echo $font;?>-size" class="slider-vertical"></div>
		<input type="text" id="fee-<?php echo $font;?>-size" name="fee-<?php echo $font;?>-size" value="<?php echo $fontsize ?>"/>
		<div id="colorSelector_<?php echo $font;?>" class="picker"><div></div></div>
		<input type="text" name="fee-<?php echo $font;?>-color" id="fee-<?php echo $font;?>-color" value="<?php echo $fontcolor; ?>"/>
		<input type="checkbox" name="epic_<?php echo $font;?>_weight"  <?php if($fontweight == 'on'){echo 'checked="checked"';} ?>/><label>Bold</label>
	</td>
		
<script>
	
	jQuery(function($) {
	
		
	
		jQuery( "#slider-<?php echo $font;?>-size" ).slider({
			orientation: "vertical",
			range: "min",
			value:  <?php echo $fontsize;?>,
			min: 10,
			max: 40,
			slide: function( event, ui ) {
				jQuery("#fee-<?php echo $font;?>-size" ).val( ui.value);
				jQuery('#wrapper <?php echo $font;?>').css({'fontSize': ui.value  });
				}
		});
		
		jQuery('#colorSelector_<?php echo $font;?> div').css('backgroundColor', '<?php echo $fontcolor?>');
		jQuery('#colorSelector_<?php echo $font;?>').ColorPicker({
			//color: '<?php echo $fontcolor?>',
			onShow: function (colpkr) {
				jQuery(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				jQuery(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				jQuery('#colorSelector_<?php echo $font;?> div').css('backgroundColor', '#' + hex);
				jQuery('<?php echo $font;?>').css('color', '#' + hex);
				jQuery('#fee-<?php echo $font;?>-color').val('#' + hex);
				}
		});

	});
	
</script>

<?php 

//if($int % 4 == 0){ echo '</tr><tr>';}

$int++;

endforeach; ?>



			</tr>
		</table>
	
	</div>

	<script>
	// increase the default animation speed to exaggerate the effect

	jQuery(function() {
	
		jQuery( "#fontselector" ).tabs({ 
				fx: { opacity: 'toggle' },
				cookie: {expires: 1	}
				});
	
		jQuery( "#fontselector" ).dialog({
			autoOpen: false,
			title:"Font settings",
			show: "fade",
			hide: "fade",
			modal: true,
			width: 580
		});

		jQuery( "#openFontSelector" ).click(function() {
			jQuery( "#fontselector" ).dialog( "open" );
			return false;
		});
		
	});
	</script>


	
	<input type="submit" value="Save & close window"/>
	<input type="hidden" name="action" value="saved" />
	<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_fontsettings'); ?>
	</form>
</div>		