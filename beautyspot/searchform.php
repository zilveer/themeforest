<?php $search_query = get_search_query(); ?>
<?php $input_placeholder = __( 'Search for ...', 'beautyspot' ); ?>
<?php $input_value = $search_query === '' ? $input_placeholder : $search_query; ?>

<!-- SEARCH FORM : begin -->
<form class="c-search-form" action="<?php echo home_url( '/' ) ?>" method="get">
	<div class="form-fields">
		<input type="text" name="s" value="<?php echo $input_value; ?>" data-placeholder="<?php echo $input_placeholder; ?>">
		<button type="submit" class="c-button"><i class="fa fa-search"></i></button>
	</div>
</form>
<!-- SEARCH FORM : end -->