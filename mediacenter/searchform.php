<?php global $s;
/**
 * The template for the search widget
 */

// The value of the field
$inputValue = ($s) ? $s : '';
?>
<div class="clearfix">
	<form id="search" class="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="form-group">
		    <label for="page-search" class="sr-only"><?php echo __( 'Type your search here', 'mediacenter' ); ?></label>
		    <input type="search" name="s" id="s" class="search-input form-control" placeholder="<?php echo __( 'Type to search', 'mediacenter' ); ?>" autocomplete="off" value="<?php echo $s;?>">
		</div>
		<button type="submit" class="page-search-button">
		    <span class="fa fa-search">
		    	<span class="sr-only"><?php echo __( 'Search', 'mediacenter' ); ?></span>
		    </span>
		</button><!-- /.page-search-button-->
	</form><!-- /.search-form -->
</div>