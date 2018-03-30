
			<?php 
			global $avia_config;

						
			//reset wordpress query in case we modified it
			wp_reset_query();
			
			
			//checks which colors the footer and socket have and if they are the same to the body a border for separation is added
			$extraClass 	= "";
			$body_bg		= avia_get_option('bg_color');
			$footer 		= avia_get_option('footer_bg'); 
			$socket 		= avia_get_option('socket_bg');
			$sidebar 		= avia_get_option('sidebar_bg');
			$bg_img 		= avia_get_option('bg_image');
			
			if($sidebar == "" || $sidebar == "transparent" || ($sidebar == $body_bg && $bg_img == "")) $extraClass .= ' small_footer ';

			
			 /**
			 *  The footer default dummy widgets are defined in folder includes/register-widget-area.php
			 *  If you add a widget to the appropriate widget area in your wordpress backend the 
			 *  dummy widget will be removed and replaced by the real one previously defined
			 */
			 
			 
			?>

			
			<!-- ####### FOOTER CONTAINER ####### -->
			<div id='footer' class='container_wrap <?php echo $extraClass; ?>'>
				<div class='container'>
				
					<?php 
					
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
						echo "<div class='$class $firstCol'>";
						if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column'.$i) ) : else : avia_dummy_widget($i); endif;
						echo "</div>";
						$firstCol = "";
					}
					
					?>

					
				</div>
				
			</div>
		<!-- ####### END FOOTER CONTAINER ####### -->

		
		
		<!-- ####### SOCKET CONTAINER ####### -->
			<div id='socket' class='container_wrap <?php echo $extraClass; ?>'>
				<div class='container'>
					<span class='copyright'>&copy; <?php _e('Copyright','avia_framework'); ?> - <a href='<?php echo home_url('/'); ?>'><?php echo get_bloginfo('name');?></a> - <a href='http://www.kriesi.at'>Wordpress Theme by Kriesi.at</a></span>
								
				</div>
			</div>
			<!-- ####### END SOCKET CONTAINER ####### -->
			
			
			
			
			
			
			
		
	
	</div><!--end container_wrap-->
			

		</div><!-- end wrap_all -->
		
		
		
		<?php
			$bg_image 		= avia_get_option('bg_image') == "custom" ? avia_get_option('bg_image_custom') : avia_get_option('bg_image');
		
			if($bg_image && avia_get_option('bg_image_repeat') == 'fullscreen') 
			{ ?>
				<!--[if lte IE 8]>
				<style type="text/css">
				.bg_container {
				-ms-filter:"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $bg_image; ?>', sizingMethod='scale')";
				filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $bg_image; ?>', sizingMethod='scale');
				}
				</style>
				<![endif]-->
			<?php
				echo "<div class='bg_container' style='background-image:url(".$bg_image.");'></div>"; 
			}
		?>
		

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	 
	avia_option('analytics', false, true, true);
	wp_footer();
	
	
?>
</body>
</html>