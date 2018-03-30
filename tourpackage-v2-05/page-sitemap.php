<?php 
/**
 * Template Name: Site Map
 */

get_header(); ?>
<div class="content-outer-wrapper">
	<div class="content-wrapper container main ">
	<?php 
		// Check and get Sidebar Class
		$sidebar_array = gdl_get_sidebar_size( 'no-sidebar' );
	?>		
	<div class="page-wrapper sitemap-page <?php echo $sidebar_array['sidebar_class']; ?>">
		<?php
			
			echo '<div class="row gdl-page-row-wrapper">';
			echo '<div class="gdl-page-left mb0 ' . $sidebar_array['page_left_class'] . '">';
			
			echo '<div class="row">';
			echo '<div class="gdl-page-item mb20 ' . $sidebar_array['page_item_class'] . '">';
			?>
			
			<div class="row">
				<div class="four columns">
					<?php dynamic_sidebar( 'Site Map 1' ); ?>
				</div>
				<div class="four columns">
					<?php dynamic_sidebar( 'Site Map 2' ); ?>
				</div>
				<div class="four columns">
					<?php dynamic_sidebar( 'Site Map 3' ); ?>
				</div>
			</div>
			
			<?php 
			echo '<div class="clear"></div>';
			echo "</div>"; // end of gdl-page-item
			
			echo '<div class="clear"></div>';			
			echo "</div>"; // row
			echo "</div>"; // gdl-page-left

			echo '<div class="clear"></div>';
			echo "</div>"; // row
		?>
		<div class="clear"></div>
	</div> <!-- page wrapper -->
	</div> <!-- content wrapper -->
</div> <!-- content outer wrapper -->
<?php get_footer(); ?>