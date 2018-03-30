<div class="wpv-config-row clearfix">
	<div class="rtitle">
		<h4><?php echo $name ?></h4>
		
		<?php wpv_description('export-skin', $desc) ?>
	</div>
	
	<div class="rcontent">
		<input type="hidden" id="export-config-prefix" value="<?php echo $prefix ?>" class="static" />
		<input type="text" id="export-config-name" value="" class="static" />
		<input type="button" id="export-config" class="button static" value="<?php echo $name ?>" />
		<span class="spinner" style="float:none"></span>
	</div>
</div>