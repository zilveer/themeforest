<div id="post-body">
	<div id="post-body-content" style="width: auto; min-width: 50%;">
	<br>
	<?php if(!empty($headers)): ?>
		<table class="wp-list-table widefat plugins">
			<thead>
				<tr>
					<th id="name" class="manage-column column-name"><?php _e('Title', 'framework') ?></th>
					<th id="name" class="manage-column column-description" style="text-align:right;">&nbsp;</th>
				</tr>
			</thead>
			<tbody id="the-list">
				<?php foreach ($headers as $key => $values): ?>
					<tr class="active">
						<td class="plugin-title">
							<a href="<?php echo $this->self_url('edit-header'); ?>&alias=<?php echo $values['alias']; ?>"><strong><?php echo $values['title']; ?></strong></a>
						</td>						
						<td class="column-description" style="text-align:right;">
							<a href="<?php echo $this->self_url('edit-header'); ?>&alias=<?php echo $values['alias']; ?>"><?php _e('Edit', 'framework') ?></a> | 
							<a style="color: #BC0B0B;" href="<?php echo $this->self_url(); ?>&navigation=headers-list&action=delete-header&alias=<?php echo $values['alias']; ?>"><?php _e('Delete', 'framework') ?></a>
						</td>
					</tr>					
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>

		<h3><?php _e('No headers created yet', 'framework') ?></h3>
	
	<?php endif; ?>

	</div> <!-- / #post-body-content -->
</div> <!-- / #post-body -->