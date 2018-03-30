<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

?>
<form action="<?php echo home_url(); ?>" method="get" class="search-form<?php echo lab_get('s') ? ' input-visible' : ''; ?>" enctype="application/x-www-form-urlencoded">

	<div class="search-input-env<?php echo trim(lab_get('s')) ? ' visible' : ''; ?>">
		<input type="text" class="form-control search-input" name="s" placeholder="<?php _e('Search...', 'aurum'); ?>" value="<?php echo esc_attr(lab_get('s')); ?>">

		<button type="submit" class="btn btn-link mobile-search-button">
			<?php echo lab_get_svg('images/search.svg'); ?>
		</button>
	</div>

</form>