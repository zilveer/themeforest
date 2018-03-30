<form action="<?php echo home_url( '/' ); ?>" id="searchform" method="get">
	<div>
		<input type="submit" value="" id="searchsubmit" class="button"/>
		<input type="text" id="s" name="s" value="<?php _e('search site','avia_framework')?>"/>
		<?php do_action('avia_frontend_search_form'); ?>
	</div>
</form><!-- end searchform-->