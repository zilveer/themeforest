<?php 
/**
 * 404 ( Not fount page )
 */

get_header(); ?>
<div class="content-outer-wrapper">
	<div class="content-wrapper container main ">
	<?php 
		// Check and get Sidebar Class
		$sidebar_array = gdl_get_sidebar_size( 'no-sidebar' );
		
		global $gdl_admin_translator;
		if( $gdl_admin_translator == 'enable' ){
			$translator_404_title = get_option(THEME_SHORT_NAME.'_404_title', 'Page Not Found');
			$translator_404_content = get_option(THEME_SHORT_NAME.'_404_content', 'The page you are looking for doesn\'t seem to exist.');
		}else{
			$translator_404_title = __('Page Not Found','gdl_front_end');		
			$translator_404_content = __('The page you are looking for doesn\'t seem to exist.','gdl_front_end');
		}			
	?>		
	<div class="page-wrapper sitemap-page <?php echo $sidebar_array['sidebar_class']; ?>">
		<?php

			echo '<div class="row gdl-page-row-wrapper">';
			echo '<div class="gdl-page-left mb0 ' . $sidebar_array['page_left_class'] . '">';
			
			echo '<div class="row">';
			echo '<div class="gdl-page-item mb20 ' . $sidebar_array['page_item_class'] . '">';
			?>
			
			<div class="message-box-wrapper red">
				<div class="message-box-title">
					<?php echo $translator_404_title; ?>
				</div>
				<div class="message-box-content">
					<?php echo $translator_404_content; ?>
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