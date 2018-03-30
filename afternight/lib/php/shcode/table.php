
<div class="standard-generic-field generic-field-resource">
    <div class="generic-label"><label for="table_title"><?php _e('Table title:','cosmotheme') ?></label></div>
    <div class="generic-field generic-field-text">
    	<input type="text" id="table_title" />
    </div>
    <div class="clear"></div>
    <div class="generic-label"><label for="nr_rows">*<?php _e('Number of Rows:','cosmotheme') ?></label></div>
    <div class="generic-field generic-field-text">
    	<input type="text" id="nr_rows" class="digit" />
    </div>
    <div class="clear"></div>
    <div class="generic-label"><label for="nr_columns">*<?php _e('Number of Columns:','cosmotheme') ?></label></div>
    <div class="generic-field generic-field-text">
    	<input type="text" id="nr_columns" class="digit " />
    </div>
    
    <div class="clear"></div>
    
    <div class="generic-label"><label for="additional_class"><?php _e('Additional class:','cosmotheme') ?></label></div>
    <div class="generic-field generic-field-text">
    	<input type="text" id="additional_class" class=" " />
    </div>
    
    <div class="clear"></div>
    
    <div class="generic-label"><label for="additional_style"><?php _e('Custom CSS styles:','cosmotheme') ?></label></div>
    <div class="generic-field generic-field-text">
    	<input type="text" id="additional_style" class=" " />
    </div>
    
    <div class="clear"></div>
    
    <div class="generic-label"><label for="table_style"><?php _e('Select table style:','cosmotheme') ?></label></div>
    <div class="generic-field generic-field-select">
    	<?php $table_styles = array('default' => 'Default', 'blue' => 'Blue', 'green' => 'Green'); ?>
    	<select id="table_style">
    		<?php 
    			foreach ($table_styles as $index => $style) {
    		?>
    			<option value="<?php echo $index; ?>"><?php echo $style; ?></option>
    		<?php 		
    			}
    		?>
    	</select>
    </div>
    
    <div class="clear"></div>
    
    <div>
		<input type="button" onclick="addTableBuilder()" id="insert_tabs_btn" value="<?php _e('Add Table','cosmotheme'); ?>" class="button-primary">
	</div>
</div>
<div id="table_builder">

</div>