<?php

	/* ************************************************************************ */
	/* /\/\/\/\/\/ Ait Item Cpt Override /\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ */
	/* ************************************************************************ */
	add_action("ait-locations_add_form_fields", 'addItemLocationFormFields', 12, 2);
	add_action("ait-locations_edit_form_fields", 'editItemLocationFormFields', 12, 2);

	function editItemLocationFormFields($tag, $taxonomy)
	{
		$termId = $tag->term_id;
		$itemLocationId = 'ait-locations';
		$extraFieldsValues = get_option("{$itemLocationId}_category_{$termId}");
		?>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $itemLocationId ?>[category_featured]"><?php _e('Featured Location', 'ait-toolkit') ?></label>
			</th>
			<td>
				<?php $checked = !empty($extraFieldsValues["category_featured"]) ? "checked" : "" ?>
				<input type="checkbox" name="<?php echo $itemLocationId ?>[category_featured]" id="<?php echo $itemLocationId ?>[category_featured]" value="true" <?php echo $checked ?> >
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $itemLocationId ?>[taxonomy_image]"><?php _e('Location Image', 'ait-toolkit') ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $itemLocationId ?>[taxonomy_image]" id="<?php echo $itemLocationId ?>[taxonomy_image]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["taxonomy_image"]) ? $extraFieldsValues["taxonomy_image"] : ''; ?>">
				<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-toolkit'))); ?> style="width:25%;" value="<?php _e('Select Image', 'ait-toolkit') ?>" id="<?php echo $itemLocationId ?>[taxonomy_image]-media-button">
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $itemLocationId ?>[header_height]"><?php _e('Header height', 'ait-toolkit') ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $itemLocationId ?>[header_height]" id="<?php echo $itemLocationId ?>[header_height]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["header_height"]) ? $extraFieldsValues["header_height"] : ''; ?>">
			</td>
		</tr>
		<?php
	}

	function addItemLocationFormFields($taxonomy)
	{
		$itemLocationId = 'ait-locations';
		?>
		<div class="form-field">
			<label for="<?php echo $itemLocationId ?>[category_featured]"><?php _e('Featured Location', 'ait-toolkit') ?></label>
			<input type="checkbox" name="<?php echo $itemLocationId ?>[category_featured]" id="<?php echo $itemLocationId ?>[category_featured]" value="true" >
		</div>

		<div class="form-field">
			<label for="<?php echo $itemLocationId ?>[taxonomy_image]"><?php _e('Location Image', 'ait-toolkit') ?></label>
			<input type="text" name="<?php echo $itemLocationId ?>[taxonomy_image]" id="<?php echo $itemLocationId ?>[taxonomy_image]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["taxonomy_image"]) ? $extraFieldsValues["taxonomy_image"] : ''; ?>">
			<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-toolkit'))); ?> style="width:25%;" value="<?php _e('Select Image', 'ait-toolkit') ?>" id="<?php echo $itemLocationId ?>[taxonomy_image]-media-button">
		</div>
		<div class="form-field">
			<label for="<?php echo $itemLocationId ?>[header_height]"><?php _e('Header height', 'ait-toolkit') ?></label>
			<input type="text" name="<?php echo $itemLocationId ?>[header_height]" id="<?php echo $itemLocationId ?>[header_height]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["header_height"]) ? $extraFieldsValues["header_height"] : ''; ?>">
		</div>
		<?php
	}

	add_filter( 'modify-ait-locations_taxonomy_default-custom-fields', 'modifyAitLocationsTaxonomyDefaultCustomFields', 10, 1 );
	function modifyAitLocationsTaxonomyDefaultCustomFields($fields){
		$fields['category_featured'] = array(
			'label' => __('Category Featured', 'ait-toolkit'),
			'notice' => __('Category Featured', 'ait-toolkit'),
		);
		$fields['taxonomy_image'] = array(
			'label' => __('Taxonomy Image', 'ait-toolkit'),
			'notice' => __('Taxonomy Image', 'ait-toolkit'),
		);
		$fields['header_height'] = array(
			'label' => __('Header height', 'ait-toolkit'),
			'notice' => __('Header height', 'ait-toolkit'),
		);

		return $fields;
	}

	add_action("ait-items_add_form_fields", 'addItemCategoryFormFields', 12, 2);
	add_action("ait-items_edit_form_fields", 'editItemCategoryFormFields', 12, 2);

	function editItemCategoryFormFields($tag, $taxonomy){
		$termId = $tag->term_id;
		$itemCategoryId = 'ait-items';
		$extraFieldsValues = get_option("{$itemCategoryId}_category_{$termId}");
		?>
		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $itemCategoryId ?>[header_height]"><?php _e('Header height', 'ait-toolkit') ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $itemCategoryId ?>[header_height]" id="<?php echo $itemCategoryId ?>[header_height]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["header_height"]) ? $extraFieldsValues["header_height"] : ''; ?>">
			</td>
		</tr>
		<?php
	}
	function addItemCategoryFormFields($taxonomy){
		$itemCategoryId = 'ait-items';
		?>
		<div class="form-field">
			<label for="<?php echo $itemCategoryId ?>[header_height]"><?php _e('Header height', 'ait-toolkit') ?></label>
			<input type="text" name="<?php echo $itemCategoryId ?>[header_height]" id="<?php echo $itemCategoryId ?>[header_height]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["header_height"]) ? $extraFieldsValues["header_height"] : ''; ?>">
		</div>
		<?php
	}

	add_filter( 'modify-ait-items_taxonomy_default-custom-fields', 'modifyAitItemsTaxonomyDefaultCustomFields', 10, 1 );
	function modifyAitItemsTaxonomyDefaultCustomFields($fields){
		$fields['header_height'] = array(
			'label' => __('Header height', 'ait-toolkit'),
			'notice' => __('Header height', 'ait-toolkit'),
		);

		return $fields;
	}

	/* ************************************************************************ */
	/* /\/\/\/\/\/ Advanced Filters Tax Override \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/ */
	/* ************************************************************************ */
	remove_action( 'ait-items_filters_add_form_fields', 'AitAdvancedFilters::filtersAddFormFields', 10 );
	remove_action( 'ait-items_filters_edit_form_fields', 'AitAdvancedFilters::filtersEditFormFields', 10 );
	add_action('ait-items_filters_add_form_fields', 'AitAdvancedFiltersFiltersAddFormFields', 10, 2);
	add_action('ait-items_filters_edit_form_fields', 'AitAdvancedFiltersFiltersEditFormFields', 10, 2);
	add_action( 'admin_enqueue_scripts', 'AitAdvancedFiltersEnqueueScripts' );

	function AitAdvancedFiltersEnqueueScripts($hook){
		if($hook == 'edit-tags.php' || $hook == 'term.php'){
			if(!empty($_REQUEST['taxonomy'])){
				if($_REQUEST['taxonomy'] === "ait-items_filters"){
					wp_enqueue_style( 'ait-font-awesome-select', aitUrl('css', '/libs/font-awesome.min.css'), array(), '4.2.0' );
				}
			}
		}
	}

	function AitAdvancedFiltersFiltersAddFormFields($tag){
		$path = "/awesome/icons.json";
		$icons = json_decode(file_get_contents(aitPath("fonts", $path)))->icons;
		?>
		<div class="form-field form-required">
			<label for="ait-items_filters[type]"><?php _e('Type', 'ait-advanced-filters'); ?></label>
			<select name="ait-items_filters[type]" id="ait-reviews[type]" aria-required="true" style="width: 95%">
				<option value="checkbox"><?php _e('Checkbox', 'ait-advanced-filters') ?></option>
			</select>
		</div>
		<div class="form-field">
			<label for="ait-items_filters[icon]"><?php _e('Icon', 'ait-advanced-filters') ?></label>
			<select name="ait-items_filters[icon]" id="ait-items_filters[icon]" aria-required="true" class="wpadmin-fontawesome-select" style="width: 95%; font-family: fontawesome, Arial;">
				<option value=""><?php _e("None", "ait-admin") ?></option>
				<?php
				foreach($icons as $icon){
					$iconName = "&#x".$icon->unicode." ".$icon->name;
					$iconClass = "fa-".$icon->id;
					?>
					<option value="<?php echo esc_attr($iconClass) ?>"><?php echo($iconName) ?></option>
					<?php
				}
				?>
			</select>
			<!--<input type="text" name="ait-items_filters[icon]" id="ait-items_filters[icon]" size="25" style="width:70%;" value="">
			<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-advanced-filters'))); ?> style="width:25%;" value="<?php _e('Select Image', 'ait-advanced-filters') ?>" id="ait-items_filters[icon]-media-button">
			<p><?php _e('Icon image displayed with filter as feature on Item detail page', 'ait-advanced-filters') ?></p>-->
		</div>
		<?php
	}

	function AitAdvancedFiltersFiltersEditFormFields($tag, $taxonomy){
		$id = $tag->term_id;
		$extraFields = get_option( "ait-items_filters_category_{$id}" );

		$path = "/awesome/icons.json";
		$icons = json_decode(file_get_contents(aitPath("fonts", $path)))->icons;
		?>
		<tr class="form-field form-required">
			<th scope="row">
				<label for="ait-items_filters[type]"><?php _e('Type', 'ait-advanced-filters'); ?></label>
			</th>
			<td>
				<select name="ait-items_filters[type]" id="ait-items_filters[type]" aria-required="true" style="width: 95%">
					<option value="checkbox" <?php echo isset($extraFields["type"]) && $extraFields["type"] == "checkbox" ? 'selected' : '' ?>><?php _e('Checkbox', 'ait-advanced-filters') ?></option>
				</select>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row">
				<label for="ait-items_filters[icon]"><?php _e('Icon', 'ait-advanced-filters'); ?></label>
			</th>
			<td>
				<select name="ait-items_filters[icon]" id="ait-items_filters[icon]" aria-required="true" class="wpadmin-fontawesome-select" style="width: 95%; font-family: fontawesome, Arial;">
					<option value=""><?php _e("None", "ait-admin") ?></option>
					<?php
					foreach($icons as $icon){
						$iconName = "&#x".$icon->unicode." ".$icon->name;
						$iconClass = "fa-".$icon->id;
						?>
						<option value="<?php echo esc_attr($iconClass) ?>" <?php selected($extraFields["icon"], $iconClass) ?>><?php echo($iconName) ?></option>
						<?php
					}
					?>
				</select>
				<!--<input type="text" name="ait-items_filters[icon]" id="ait-items_filters[icon]" size="25" style="width:70%;" value="<?php echo isset($extraFields["icon"]) ? $extraFields["icon"] : ''; ?>">
				<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-advanced-filters'))); ?> style="width:25%;" value="<?php _e('Select Image', 'ait-advanced-filters') ?>" id="ait-items_filters[icon]-media-button">
				<p class="description"><?php _e('Icon image displayed with filter as feature on Item detail page', 'ait-advanced-filters') ?></p>-->
			</td>
		</tr>
		<?php
	}

?>