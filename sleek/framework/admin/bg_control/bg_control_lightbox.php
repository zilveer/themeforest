<!-- Bg Control Lightbox -->

<?php
	$theme_settings = sleek_theme_settings();
	$sleek_palettes = implode(',', $theme_settings->style['color'] );
?>

<div class="sleek-lightbox sleek-lightbox--bg-control" style="display:none;">
	<div class="sleek-lightbox-mask js-close"></div>
	<div class="sleek-lightbox-modal">
		<div class="sleek-lightbox-head">
			<div class="title">Set Background</div>
			<div class="js-close close-icon"></div>
		</div>
		<table class="sleek-lightbox-content"><tr>
			<td class="bg-control-form">

				<div class="form-item form-item--color">
					<label class="title">Color</label>
					<input type="text" class="bg-color" data-sleek-palettes="<?php echo $sleek_palettes; ?>">
				</div>

				<div class="form-item form-item--image">
					<label class="title">Image</label>
					<input type="text" class="bg-image">
					<a class="button js-bg-image-btn">Choose</a>
					<a class="remove js-bg-image-remove">Remove</a>
				</div>

				<div class="form-item form-item--select form-item--repeat">
					<label class="title">Repeat</label>
					<select name="bg-repeat" class="bg-repeat">
						<option value="no-repeat" selected="selected">No Repeat</option>
						<option value="repeat-x">Repeat X</option>
						<option value="repeat-y">Repeat Y</option>
						<option value="repeat">Repeat</option>
					</select>
				</div>

				<div class="form-item form-item--select form-item--size">
					<label class="title">Size</label>
					<select name="bg-size" class="bg-size">
						<option value="auto" selected="selected">Auto</option>
						<option value="cover">Cover</option>
						<option value="contain">Contain</option>
					</select>
				</div>

				<div class="form-item form-item--radio-image form-item--position">
					<label class="title">Position</label>

					<label class="item">
						<input type="radio" name="bg_position" class="bg-position" value="left top">
						<div></div>
					</label>
					<label class="item">
						<input type="radio" name="bg_position" class="bg-position" value="center top">
						<div></div>
					</label>
					<label class="item">
						<input type="radio" name="bg_position" class="bg-position" value="right top">
						<div></div>
					</label>
					<label class="item cl">
						<input type="radio" name="bg_position" class="bg-position" value="left center">
						<div></div>
					</label>
					<label class="item">
						<input type="radio" name="bg_position" class="bg-position" value="center center">
						<div></div>
					</label>
					<label class="item">
						<input type="radio" name="bg_position" class="bg-position" value="right center">
						<div></div>
					</label>
					<label class="item cl">
						<input type="radio" name="bg_position" class="bg-position" value="left bottom">
						<div></div>
					</label>
					<label class="item">
						<input type="radio" name="bg_position" class="bg-position" value="center bottom">
						<div></div>
					</label>
					<label class="item">
						<input type="radio" name="bg_position" class="bg-position" value="right bottom">
						<div></div>
					</label>
				</div>

				<div class="form-item form-item--select form-item--attachment">
					<label class="title">Attachment</label>
					<select name="bg-attachment" class="bg-attachment">
						<option value="local" selected="selected">Scroll</option>
						<option value="fixed">Fixed</option>
					</select>
				</div>

				<div class="form-item form-item--radio-image form-item--pattern">
					<label class="title">Pattern:</label>
					<label class="item">
						<input type="radio" checked="checked" class="bg-pattern" name="bg_pattern" value="" />
						<div></div>
					</label>
					<?php
					$patterns = array_diff(scandir(THEME_PATTERNS), array('..', '.'));
					foreach ($patterns as $pattern) {
						if (substr($pattern, 0, 1) === '.') {
						}else{
							echo '<label class="item">';
							echo '<input type="radio" class="bg-pattern" name="bg_pattern" value="'.THEME_PATTERNS_URI.'/'.$pattern.'" />';
							echo '<div style="background-image:url('.THEME_PATTERNS_URI.'/'.$pattern.');"></div>';
							echo '</label>';
						}
					}
					?>
				</div>
			</td>
			<td class="bg-control-preview"></td>
		</tr></table>
		<div class="sleek-lightbox-actions">
			<a class="button button-primary js-save">Save</a>
			<a class="button js-close">Cancel</a>
		</div>
	</div>
</div>
<!-- / Bg Control Lightbox -->
