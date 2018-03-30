<?php
/**
 * The template for displaying search forms.
 *
 * @package WordPress
 * @subpackage majesty
 * @since majesty 1.0
 */
?>
<form method="get" id="searchform" class="search input-group custom-search-form" action="<?php echo esc_url( home_url('/') ); ?>">
	<input type="text" value="<?php echo esc_attr(get_search_query()); ?>" name="s" id="s" class="form-control" placeholder="<?php esc_attr_e( 'SEARCH', 'theme-majesty' ); ?>">
	<input type="hidden" name="post_type" value="post" />
	<span class="input-group-btn">
		<button type="submit" id="searchsubmit" class="btn btn-default"><i class="fa fa-search"></i></button>
	</span> 
</form>