<br/>
<?php if(!empty($sidebars)): ?>
		<table class="wp-list-table widefat plugins">
			<thead>
				<tr>
					<!-- <th scope="col" id="cb" class="manage-column column-cb check-column" style="width: 0px;"></th> -->
					<th id="field-name" class="manage-column column-name"><?php _e('Name', 'framework') ?></th>
					<th id="field-alias" class="manage-column column-alias"><?php _e('Alias', 'framework') ?></th>
					<th id="field-shortcode" class="manage-column column-shortcode"><?php _e('Shortcode', 'framework') ?></th>
					<th id="field-description" class="manage-column column-description"><?php _e('Description', 'framework') ?></th>
					<th id="field-actions" class="manage-column column-actions"><?php _e('Actions', 'framework') ?></th>
				</tr>
			</thead>
			<tbody id="the-list">
				<?php foreach ($sidebars as $key => $values): ?>
					<tr calss="active">
						<td class="column-title">
							<p><strong><?php echo $values['title']; ?></strong></p> 
						</td>
						<td class="column-alias">
							<p><?php echo $values['alias']; ?></p>
						</td>
						<td class="column-shortcode">
							<p>[sidebar alias="<?php echo $values['alias']; ?>"]</p>
						</td>
						<td class="column-description">
							<p><?php echo $values['description']; ?></p>
						</td>
						<td class="column-description">
							<p>
								<a href="<?php echo $this->self_url('edit-sidebar'); ?>&alias=<?php echo $values['alias']; ?>"><?php _e('Edit', 'framework') ?></a> | 
								<a style="color: #BC0B0B;" href="<?php echo $this->self_url(); ?>&action=delete-sidebar&alias=<?php echo $values['alias']; ?>"><?php _e('Delete', 'framework') ?></a>
							</p>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
<?php else: ?>
<h3><?php _e('No custom sidebars have been created yet.', 'framework') ?></h3>
<?php endif; ?>