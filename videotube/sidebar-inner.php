<?php if( !defined('ABSPATH') ) exit;?>
<?php 
if( is_active_sidebar( 'mars-inner-page-right-sidebar' ) ){
	?>
	<div class="col-sm-4 sidebar">
		<?php 
			dynamic_sidebar( 'mars-inner-page-right-sidebar' );
		?>
	</div>
	<?php 
}
