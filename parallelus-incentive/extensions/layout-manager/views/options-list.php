<?php 
	global $layouts_manager, $libraries;
	$form_builder = $libraries['FormsBuilder'];
	$settings = $layouts_manager->layouts_manager_options['settings'];
?>
<table class="wp-list-table widefat plugins" style="margin-top: 15px;">
	<thead>
	<tr>
		<!-- <th scope="col" id="cb" class="manage-column column-cb check-column" style="width: 0px;"><input type="checkbox" name="ext_chk[]" value=""></th> -->
		<th id="name_head" class="manage-column column-name"><?php _e( 'Option name', 'framework' ); ?></th>
		<th id="description_head"
			class="manage-column column-description"><?php _e( 'Description', 'framework' ); ?></th>
	</tr>
	</thead>
	<tbody id="the-list">
		<?php if(isset($settings['headers'])) : ?>		
			<tr>
				<td class="plugin-title">
					<strong><a
							href="themes.php?page=layout-manager&navigation=edit-options&option=headers">Headers</a></strong>

					<div class="row-actions">
						<span class="edit"><a
							href="themes.php?page=layout-manager&navigation=edit-options&option=headers"
							title="<?php _e( 'Edit this item', 'framework' ); ?>"><?php _e( 'Edit', 'framework' ); ?></a></span>
					</div>
				</td>
				<td class="column-description desc">
					Features that will be added to the headers
				</td>
			</tr>
		<?php endif; ?>

		<?php if(isset($settings['footers'])) : ?>		
			<tr>
				<td class="plugin-title">
					<strong><a
							href="themes.php?page=layout-manager&navigation=edit-options&option=footers">Footers</a></strong>

					<div class="row-actions">
						<span class="edit"><a
							href="themes.php?page=layout-manager&navigation=edit-options&option=footers"
							title="<?php _e( 'Edit this item', 'framework' ); ?>"><?php _e( 'Edit', 'framework' ); ?></a></span>														
					</div>
				</td>
				<td class="column-description desc">
					Features that will be added to the footers
				</td>
			</tr>
		<?php endif; ?>

		<?php if(isset($settings['other-options'])) : ?>		
			<tr>
				<td class="plugin-title">
					<strong><a
							href="themes.php?page=layout-manager&navigation=edit-options&option=other-options">Layout Options</a></strong>

					<div class="row-actions">
						<span class="edit"><a
							href="themes.php?page=layout-manager&navigation=edit-options&option=other-options"
							title="<?php _e( 'Edit this item', 'framework' ); ?>"><?php _e( 'Edit', 'framework' ); ?></a></span>														
					</div>
				</td>
				<td class="column-description desc">
					Features that will be added to the other-options
				</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>