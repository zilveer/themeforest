<form method="post" action="options.php">
	
	<div id="air-main-inner" class="air-text air-maintenance">
		
		<?php settings_fields('air-maintenance-settings'); ?>
		<?php do_settings_sections('air-maintenance'); ?>
		<input type="hidden" name="air-maintenance[module]" value="maintenance">
		
		<div class="air-clear"></div>
	</div><!--/air-main-inner-->

	<div id="air-footer">
		<p class="submit air-submit">
			<input type="submit" class="button-secondary" value="Insert Default Code" id="air-default-insert">
			<input type="submit" class="button-primary" value="Save Changes" />
		</p>
	</div><!--/air-footer-->

</form>