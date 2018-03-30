<?php
/*
* Footer
*/

?>
<div class="clear"></div>
	<?php
	if (of_get_option('footerwidget_status') ) {
	?>
	<div class="footer-container clearfix">
		<div id="footer" class="clearfix">
		
			<?php if ( function_exists('dynamic_sidebar') ) { 
				echo '<div class="footer-column">';
				dynamic_sidebar("Footer Single Column 1");  
				echo '</div>';
				}
			?>
			<?php if ( function_exists('dynamic_sidebar') ) { 
				echo '<div class="footer-column">';
				dynamic_sidebar("Footer Single Column 2");  
				echo '</div>';
				}
			?>
			<?php 
			if ( function_exists('dynamic_sidebar') ) { 
				if (is_active_sidebar("Footer Double Column")) {
					echo '<div class="footer-double-column">';
					dynamic_sidebar("Footer Double Column"); 
					echo '</div>';
				 } 
			}
			?>
			<?php if ( function_exists('dynamic_sidebar') ) { 
				echo '<div class="footer-column">';
				dynamic_sidebar("Footer Single Column 3"); 
				echo '</div>';
				}
			?>
			<?php if ( function_exists('dynamic_sidebar') ) { 
				echo '<div class="footer-column">';
				dynamic_sidebar("Footer Single Column 4");   
				echo '</div>';
				}
			?>
		</div>	
	</div>
	<?php
	}
	?>

	<div id="copyright" class="clearfix">
	<?php echo stripslashes_deep( of_get_option('footer_copyright') ); ?>
	</div>
</div>
<?php
wp_footer();
?>
<?php
echo stripslashes_deep( of_get_option ( 'footer_scripts' ) );
?>
</body>
</html>