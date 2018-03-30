<form method="post" action="options.php">

	<div id="air-main-inner" class="air-text">
		
		<?php settings_fields('air-portfolio-settings'); ?>
		<?php do_settings_sections('air-portfolio'); ?>
		<input type="hidden" name="air-portfolio[module]" value="portfolio">
		
		<div class="air-clear"></div>
	</div><!--/air-main-inner-->

	<div id="air-footer">
		<p class="submit air-submit">
			<input type="submit" class="button-primary" value="Save Changes" />
		</p>
	</div><!--/air-footer-->

</form>

<?php if (isset($_GET['settings-updated'])) { flush_rewrite_rules(); } // Flush rewrite rules ?>