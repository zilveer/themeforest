<?php get_header(); ?>
	<?php 
		
		$sidebar = "right-sidebar";
		$sidebar_class = '';
		if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar"){
			$sidebar_class = "sidebar-included " . $sidebar;
		}else if( $sidebar == "both-sidebar" ){
			$sidebar_class = "both-sidebar-included";
		}

	?>
	<div class="content-wrapper <?php echo $sidebar_class; ?>">
			
		<div class="page-wrapper">
			<?php
				$left_sidebar = '';
				$right_sidebar = 'woo right sidebar';				
				echo "<div class='gdl-page-float-left'>";
				
				echo "<div class='gdl-page-item'>";
				
				echo '<div class="sixteen columns mt30 gdl-woo-commerce-wrapper">';
				woocommerce_content();
				echo '</div>';	
	
				echo "</div>"; // end of gdl-page-item
				get_sidebar('left');		
				
				echo "</div>"; // gdl-page-float-left	
				get_sidebar('right');
				
			?>
			
			<br class="clear">
		</div>
	</div> <!-- content-wrapper -->
	
<?php get_footer(); ?>