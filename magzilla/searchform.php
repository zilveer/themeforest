<?php
/**
 * The template for displaying search forms
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
 */
?>
<div class="widget-body">
	<form class="form-horizontal" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
				<input type="text" name="s" id="s" class="form-control fave-search" placeholder="<?php _e("Search","magzilla"); ?>">
			</div>
		
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">						
				<button type="submit" class="btn btn-theme btn-block"><?php _e("Search","magzilla"); ?></button>
			</div>
		</div>
	</form>
</div>