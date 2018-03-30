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
	<h2>Table Structure</h2>
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
    
    
    
    

<h3>Basic Information</h3>
	
			<form action="<?php echo admin_url("admin.php?page=uds_pricing_structure$edit") ?>" method="post">
			<input type="hidden" name="uds_pricing_nonce" value="<?php echo wp_create_nonce('uds-pricing-nonce') ?>" />
			<input type="hidden" name="uds_pricing_name_original" value="<?php echo $pricing_table_name ?>" />
			<!-- <h3>General Options</h3> -->
			<?php if($editing): ?>
				<!-- <a href="<?php echo admin_url("admin.php?page=uds_pricing_products$edit") ?>" class="backlink">Add/Edit Products</a> -->
			<?php endif; ?>
			<div id="uds-pricing-options">
				<?php uds_pricing_render_general_options($pricing_table) ?>
			</div>
			<br />
 
     
            
       <h3>Table Structure</h3>
	
    <p>This is where you define the properties/features of your products/services. (These will be listed top to bottom within the table.)</p>
			<div id="uds-pricing-properties">
            <!-- <a class="add tt-custom-add" href="#">Add another row</a><br /><br /> -->
				<table>
					<?php if(!empty($pricing_table['properties'])): ?>
						<?php foreach($pricing_table['properties'] as $name => $type): ?>
						<tr>
							<td>
								Label: <input type="text" name="labels[]" value="<?php echo $name ?>" style="" />
							</td>
							<td>
								<select name="types[]">
									<option value="text" <?php if($type == 'text') echo "selected='selected'"?>>Text</option>
									<option value="checkbox" <?php if($type == 'checkbox') echo "selected='selected'"?>>Checkbox</option>
								</select>
							</td>
							<td>
								<a class="move" href="#">Move</a>
							</td>
							<td>
								<a class="delete" href="#">Delete</a>
							</td>
						</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					<tr>
						<td>
							Label: <input type="text" name="labels[]" value="" />
						</td>
						<td>
							<select name="types[]">
								<option value="text">Text</option>
								<option value="checkbox">Checkbox</option>
							</select>
						</td>
						<td>
							<a class="move" href="#">Move</a>
						</td>
						<td>
							<a class="delete" href="#">Delete</a>
						</td>
					</tr>
				</table>
				<input type="submit" name="" class="submit button-primary" value="Save Changes" />
				<div class="clear"></div>
                <!-- <br />
                <a class="add" href="#">Add another item</a>
                <br /> -->
		</form>
	
<br /><br />
<a href="<?php echo admin_url("admin.php?page=uds_pricing_admin") ?>" class="button">Return to the Main Page</a>
 
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
	
</div>