<form method="get" id="searchform-<?php echo rand();?>" class="searchform clearfix" action="<?php echo esc_url(home_url('/')); ?>">
	<div class="clearfix">
		<input type="text" value="" placeholder="<?php esc_html_e('Search', 'hue'); ?>" name="s" id="s-<?php echo rand();?>"/>
		<input type="submit" id="searchsubmit-<?php echo rand();?>" value="&#xe090;"/>
	</div>
</form>