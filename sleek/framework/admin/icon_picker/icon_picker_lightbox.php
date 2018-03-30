<!-- Icon Picker Lightbox -->

<div class="sleek-lightbox sleek-lightbox--icon-picker" style="display:none;">
	<div class="sleek-lightbox-mask js-close"></div>
	<div class="sleek-lightbox-modal">
		<div class="sleek-lightbox-head">
			<div class="title">Pick Icon</div>
			<div class="js-close close-icon"></div>
		</div>
		<div class="sleek-lightbox-content">
			<div class="sleek-icon-picker">

				<div class="sleek-icon-picker-header">
					<div class="status">
						<span class="title">Chosen Icon: </span>
						<i></i>
						<span class="title js-title"></span>
					</div>
					<div class="filter">
						<span class="title">Filter by </span>
						<input type="text" class="js-icon-picker-filter" placeholder="Icon Name">
					</div>
				</div>

				<div class="sleek-icon-picker-list form-item--radio-image">
					<label class="item" title="No Icon" data-icon="">
						<input type="radio" name="sleek_icon" value="">
						<span><i class=""></i></span>
					</label>
					<?php
						$icons = get_sleek_icons();
						foreach ($icons as $key => $value) {
							echo '<label class="item" title="'.$key.'" data-icon="'.$key.'">';
								echo '<input type="radio" name="sleek_icon" value="'.$key.'">';
								echo '<span><i class="'.$key.'"></i></span>';
							echo '</label>';
						}
					?>
				</div>

			</div>
		</div>
		<div class="sleek-lightbox-actions">
			<a class="button button-primary js-save">Save</a>
			<a class="button js-close">Cancel</a>
		</div>
	</div>
</div>
<!-- / Icon Picker Lightbox -->
