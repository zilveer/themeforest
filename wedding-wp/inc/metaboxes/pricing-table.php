<p>
	<table width="100%">
	<?php $metabox->the_field('pricing_table_skin'); ?> 
		<tr>
			<td width="20%">
				<b>Skin:</b>
			</td>
			<td>
				<input type="textbox" name="<?php $metabox->the_name();?>" value="<?php $metabox->the_value(); ?>" class="pricing-color-field"/>
			</td>
			<td>This color will be applied only to this plan.</td>
		</tr>
	<?php $metabox->the_field('pricing_table_featured'); ?> 
		<tr>
			<td width="20%">
				<b>Featured Plane?:</b>
			</td>
			<td>
				<input type="checkbox" name="<?php $metabox->the_name();?>" value="featured" <?php echo $metabox->is_value('featured')?'checked="checked"':'';?>/>
			</td>
			<td>If you would like to select this item as featured enable this option.</td>
		</tr>
		<?php $metabox->the_field('pricing_table_name'); ?> 
		<tr>
			<td width="20%">
				<b>Plan name:</b>
			</td>
			<td>
				<input type="textbox" name="<?php $metabox->the_name();?>" value="<?php $metabox->the_value(); ?>" />
			</td>
			<td>&nbsp;</td>
		</tr>
		<?php $metabox->the_field('pricing_table_price'); ?> 
		<tr>
			<td width="20%">
				<b>Plan price:</b>
			</td>
			<td>
				<input type="textbox" name="<?php $metabox->the_name();?>" value="<?php $metabox->the_value(); ?>" />
			</td>
			<td>&nbsp;</td>
		</tr>
		<?php $metabox->the_field('pricing_table_period'); ?> 
		<tr>
			<td width="20%">
				<b>Plan period:</b>
			</td>
			<td>
				<input type="textbox" name="<?php $metabox->the_name();?>" value="<?php $metabox->the_value(); ?>" />
			</td>
			<td>eg: monthly, yearly, daily</td>
		</tr>
		<?php $metabox->the_field('pricing_table_features'); ?> 
		<tr>
			<td width="20%">
				<b>Plan Features:</b>
			</td>
			<td>
				<textarea name="<?php $metabox->the_name();?>" class="pricingtablefeatures" ><?php $metabox->the_value(); ?></textarea>
			</td>
			<td>&nbsp;</td>
		</tr>
		<?php $metabox->the_field('pricing_table_button_text'); ?> 
		<tr>
			<td width="20%">
				<b>Button Text:</b>
			</td>
			<td>
				<input type="textbox" name="<?php $metabox->the_name();?>" value="<?php $metabox->the_value(); ?>" />
			</td>
			<td>&nbsp;</td>
		</tr>
		<?php $metabox->the_field('pricing_table_button_url'); ?> 
		<tr>
			<td width="20%">
				<b>Button URL:</b>
			</td>
			<td>
				<input type="textbox" name="<?php $metabox->the_name();?>" value="<?php $metabox->the_value(); ?>" />
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>


</p>
<script type="text/javascript">
jQuery(document).ready(function(){



jQuery(document).ready(function($){
$('.pricing-color-field').wpColorPicker();
});


});
</script>