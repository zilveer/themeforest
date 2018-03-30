<?php
	//delete_option(UDS_PRICING_OPTION);
	$pricing_tables = maybe_unserialize(get_option(UDS_PRICING_OPTION, array()));
	//d($pricing_tables);
	if(isset($_GET['uds_pricing_delete_nonce']) && wp_verify_nonce($_GET['uds_pricing_delete_nonce'], 'uds-pricing-delete-nonce')) {
		unset($pricing_tables[$_GET['uds_pricing_delete']]);
		update_option(UDS_PRICING_OPTION, serialize($pricing_tables));
	}
	
?>
<div class="wrap">
<div class="icon32" id="icon-themes"><br></div>
	<h2>Pricing Tables</h2>
	<?php if(!empty($pricing_tables)): ?>
    <br />
		<table class="widefat tt-custom-table">
        <thead>
			<tr>
				<th>Table Name</th>
				<th class="shortcode">Shortcode</th>
				<th>Products</th>
				<th>Edit Structure</th>
				<th>Edit Products</th>
				<th>Delete</th>
			</tr>
            </thead>
			<?php foreach($pricing_tables as $name => $pricing_table): ?>
				<tr>
					<td><?php echo $name ?></td>
					<td>[uds-pricing-table name="<?php echo $name ?>"]</td>
					
					<td><?php echo count(@$pricing_table['products']); ?></td>
					<td>
						<a href="<?php echo admin_url('admin.php?page=uds_pricing_structure&uds_pricing_edit='.urlencode($name)) ?>" class="pricing-edit-structure">Edit</a>
					</td>
					<td>
						<a href="<?php echo admin_url('admin.php?page=uds_pricing_products&uds_pricing_edit='.urlencode($name)) ?>" class="pricing-edit-products">Edit</a>
					</td>
					<td>
						<a href="<?php echo admin_url('admin.php?page=uds_pricing_admin&uds_pricing_delete='.urlencode($name)).'&uds_pricing_delete_nonce='.wp_create_nonce('uds-pricing-delete-nonce') ?>" class="pricing-delete">Delete</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table><br />
        <div class="create-pricing-table">
			<a href="<?php echo admin_url("admin.php?page=uds_pricing_new") ?>" class="button-primary">Create new Pricing Table</a>
		</div>
	<?php else: ?>
		<p><strong>You have not created any Pricing Tables yet.</strong></p>
        <p><a href="<?php echo admin_url('admin.php?page=uds_pricing_new') ?>" class="button">Create your first Pricing Table</a></p>
	<?php endif; ?>
</div>