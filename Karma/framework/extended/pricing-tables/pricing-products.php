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
<div class="icon32" id="icon-options-general"><br></div>
	<h2>Products</h2>
	<?php if(!empty($pricing_tables)): ?>
		
	<?php endif; ?>
	<?php if(!empty($uds_errors)): ?>
		<div class="updated uds-warn">
			<ul>
				<?php foreach($uds_errors as $error): ?>
					<li><?php echo $error->get_error_message() ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
	<?php if(!empty($pricing_table)): ?>
		<div id="uds-pricing-products">
			<form action="<?php echo admin_url("admin.php?page=uds_pricing_products&uds_pricing_edit=".$pricing_table_name) ?>" method="post">
				<input type="hidden" name="uds_pricing_products_nonce" value="<?php echo wp_create_nonce('uds-pricing-products-nonce')?>" />
				<h3>Edit Products</h3>
				<a href="" class="collapse-all">Expand All</a>
				<!-- <a href="<?php echo admin_url("admin.php?page=uds_pricing_structure$edit") ?>" class="backlink">Edit Structure</a> -->
				<label class="uds-no-featured-label">Don't render any product as Featured</label>
				<input type="checkbox" name="uds-no-featured" class="radio uds-no-featured" <?php echo $pricing_table['no-featured'] ? "checked='checked'" : ''?> />
				<div class='clear'></div>
				<?php if(!empty($pricing_table['products'])): ?>
					<?php foreach($pricing_table['products'] as $product): ?>
						<div class="product">
							<h3 class="collapsible"><?php echo $product['uds-name'] ?></h3>
							<div class="actions">
								<span class="move">Move</span>
								<span class="delete">Delete</span>
							</div>
							<div class="options">
								<?php uds_pricing_render_product_options($product, $pricing_table['properties']) ?>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
                <br />
				<h3>Add New Product:</h3>
				<div class="product new">
					<?php uds_pricing_render_product_options(null, $pricing_table['properties']) ?>
				</div>
				<input type="submit" name="" value="Save All Changes" class="submit button-primary" />
				<div class="clear">
			</form>
		</div>
       <br /> <a href="<?php echo admin_url("admin.php?page=uds_pricing_admin") ?>" class="button">Return to the Main Page</a>
<br /><br />
	<?php else: ?>
		<div class="warn"><p><strong>Please select the table that you would like to edit.</strong></p></div>
        <div class="uds-pricing-edit">
			<p><select class="uds-load-pricing-table" style="width:200px;">
				<?php foreach($pricing_tables as $name => $table): ?>
					<option <?php echo $pricing_table_name == $name ? 'selected="selected"' : '' ?>><?php echo $name ?></option>
				<?php endforeach; ?>
			</select></p>
			<p><input type="submit" name="" value="Select Table" class="submit button-primary uds-change-table" /></p>
		<?php endif; ?>
        </div>
        <br />
	
</div>