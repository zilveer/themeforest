<?php
global $uds_errors; 

if(!empty($_GET['uds_pricing_edit'])) {
	$pricing_table_name = $_GET['uds_pricing_edit'];
} else {
	$pricing_table_name = '';
}

$pricing_table_name = !empty($_POST['uds-pricing-table-name']) ? $_POST['uds-pricing-table-name'] : $pricing_table_name;

$editing = true;
if(empty($pricing_table_name)) {
	$editing = false;
}

$pricing_tables = maybe_unserialize(get_option(UDS_PRICING_OPTION, array()));

@$pricing_table = $pricing_tables[$pricing_table_name];

$edit = "";
if(!empty($pricing_table_name)) {
	$edit = "&uds_pricing_edit=$pricing_table_name";
}

?>
<div class="wrap">
	<?php if(!$editing): ?>
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
		<h2>Add New Table</h2>
	<?php else: ?>
		<div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
		<h2>Add New Table</h2>
	<?php endif; ?>
	<?php if(!empty($uds_errors)): ?>
		<div id="message" class="updated below-h2">
			<p>
				<?php foreach($uds_errors as $error): ?>
				<?php echo $error->get_error_message() ?>
				<?php endforeach; ?>
			</p>
		</div>
	<?php endif; ?>
	<div id="uds-pricing-structure" class="uds-pricing">
		<form action="<?php echo admin_url("admin.php?page=uds_pricing_admin") ?>" method="post">
			<input type="hidden" name="uds_pricing_nonce" value="<?php echo wp_create_nonce('uds-pricing-nonce') ?>" />
			<input type="hidden" name="uds_pricing_name_original" value="<?php echo $pricing_table_name ?>" />
			<!-- <h3>General Options</h3> -->
			<?php if($editing): ?>
				<!-- <a href="<?php echo admin_url("admin.php?page=uds_pricing_products$edit") ?>" class="backlink">Add/Edit Products</a> -->
			<?php endif; ?>
			<div id="uds-pricing-options">
				<?php uds_pricing_render_general_options($pricing_table) ?>
			</div>
			<!-- <h3>Properties</h3> -->
			<div id="uds-pricing-properties">
				<input type="submit" name="" class="submit button-primary" value="Save All Changes" />
				<div class="clear"></div>
			</div>
		</form>
	</div>
</div>