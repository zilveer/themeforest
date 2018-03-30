<?php if( !defined('ABSPATH') ) exit;?>
<?php 
if( is_active_sidebar( 'mars-homepage-right-sidebar' ) ){
	?>
	<div class="col-sm-4 sidebar">
		<?php 
			dynamic_sidebar('mars-homepage-right-sidebar');
		?>
	</div>
	<?php 
}