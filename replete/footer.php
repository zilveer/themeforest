			</div> <!-- close #main .container_wrap element -->		
		
			<?php 
			
			
			global $avia_config;
						
			//reset wordpress query in case we modified it
			wp_reset_query();
			
	
			
			
			?>

			
			<!-- ####### FOOTER CONTAINER ####### -->
			<div class='container_wrap footer_color' id='footer'>
				<div class='container'>
				
					<?php 
					
					$arrow_text = avia_get_option('footer_arrow');
		
					if($arrow_text)
					{
						echo "<div class='footer_arrow'>
								<div class='inner_content'><div class='arrow-left-small'></div><div class='arrow-right-small'></div><h3>$arrow_text</h3></div>
								<div class='footer_arrow_wrap'>
								<div class='arrow-left'></div><div class='arrow-right'></div>
								</div>
							  </div>";
					}
					
					
					//create the footer columns by iterating  
					
					
					$columns = avia_get_option('footer_columns');
					
					$firstCol = 'first';
			        switch($columns)
			        {
			        	case 1: $class = ''; break;
			        	case 2: $class = 'one_half'; break;
			        	case 3: $class = 'one_third'; break;
			        	case 4: $class = 'one_fourth'; break;
			        	case 5: $class = 'one_fifth'; break;
			        }
					
					//display the footer widget that was defined at appearenace->widgets in the wordpress backend
					//if no widget is defined display a dummy widget, located at the bottom of includes/register-widget-area.php
					for ($i = 1; $i <= $columns; $i++)
					{
						echo "<div class='flex_column $class $firstCol'>";
						if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column'.$i) ) : else : avia_dummy_widget($i); endif;
						echo "</div>";
						$firstCol = "";
					}
					
					?>

					
				</div>
				
			</div>
		<!-- ####### END FOOTER CONTAINER ####### -->
		
		
		
		<?php 
		
		// you can filter and remove the backlink with an add_filter function 
		// from your themes (or child themes) functions.php file if you dont want to edit this file
		// you can also just keep that link. I really do appreciate it ;)
		
		$kriesi_at_backlink =	apply_filters("kriesi_backlink", " - <a href='http://www.kriesi.at'>Replete e-Commerce Theme by Kriesi</a>");
		?>
		
		<!-- ####### SOCKET CONTAINER ####### -->
			<div class='container_wrap socket_color' id='socket'>
				<div class='container'>
					<span class='copyright'>&copy; <?php _e('Copyright','avia_framework'); ?> - <a href='<?php echo home_url('/'); ?>'><?php echo get_bloginfo('name');?></a><?php echo $kriesi_at_backlink; ?></span>
					
					<?php
					
						echo "<div class='sub_menu_socket'>";
						$args = array('theme_location'=>'avia3', 'fallback_cb' => '', 'depth'=>1);
						wp_nav_menu($args); 
						echo "</div>";
					
					?>
					
				</div>
			</div>
			<!-- ####### END SOCKET CONTAINER ####### -->
		
		
		</div>
	<!-- ####### END MAIN CONTAINER ####### -->
		
</div><!-- end wrap_all -->
		
		
		
<?php
		if(isset($avia_config['fullscreen_image'])) 
		{ ?>
			<!--[if lte IE 8]>
			<style type="text/css">
			.bg_container {
			-ms-filter:"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $avia_config['fullscreen_image']; ?>', sizingMethod='scale')";
			filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $avia_config['fullscreen_image']; ?>', sizingMethod='scale');
			}
			</style>
			<![endif]-->
		<?php
			echo "<div class='bg_container' style='background-image:url(".$avia_config['fullscreen_image'].");'></div>"; 
		}
	?>	
		

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	 
	
	wp_footer();
	
	
?>
<div id="fb-root"></div>
</body>
</html>