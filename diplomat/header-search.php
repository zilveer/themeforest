<?php
$search_class = (TMM::get_option('menu_advanced_search')) ? 'advanced_search' : '';
?>

<?php if (TMM::get_option('menu_advanced_search')){ ?>

<div class="search-form-nav">
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<fieldset>
			<input placeholder="<?php _e('Search', 'diplomat') ?>" type="text" name="s" autocomplete="off" value="<?php echo get_search_query(); ?>" class="<?php echo $search_class ?>" />
			<button type="submit" class="submit-search"><?php _e('Search', 'diplomat') ?></button>
		</fieldset>
	</form>
</div>

<?php } ?>