<?php
/**
 * The template for the search widget
 */
?>
<form method="get" id="SearchForm" action="<?php echo home_url('/') ?>">
	<div class="searchFormContainer">
		<input type="text" name="s" id="s" class="searchFormInput" value="<?php echo get_search_query() ?>" placeholder="<?php _e('Search...', 'framework');?>">
		<input type="submit" id="searchsubmit" value="Search">
	</div>
</form>