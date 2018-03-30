			<?php 
			global $avia_config;
						
			//reset wordpress query in case we modified it
			wp_reset_query();
			
			 /**
			 *  The footer default dummy widgets are defined in folder includes/register-widget-area.php
			 *  If you add a widget to the appropriate widget area in your wordpress backend the 
			 *  dummy widget will be removed and replaced by the real one previously defined
			 */
			
			
			if(is_front_page() || avia_get_option('footer_logo_where') == 'everywhere')			 
			$attachment_holder = avia_get_post_by_title( "avia_smart-logo-gallery"); 
			
			if(!empty($attachment_holder['ID']))
			{
				$attachments = get_children(array('post_parent' => $attachment_holder['ID'],
                        'post_status' => 'inherit',
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'order' => 'ASC',
                        'orderby' => 'menu_order ID'));
                if(is_array($attachments))
                {
                	echo "<div class='footer-logos'><div class='container'>";
	                foreach($attachments as $key => $attachment) 
					{
						echo avia_image_by_id($attachment->ID);
					}
					echo "</div></div>";
				}
			}
		
		


		
			?>
			
			
			
			
			
			<!-- ####### FOOTER CONTAINER ####### -->
			<div class='container_wrap' id='footer'>
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
			<div class='container_wrap' id='socket'>
				<div class='container'>
					<span class='copyright'>&copy; <?php _e('Copyright','avia_framework'); ?> - <a href='<?php echo home_url('/'); ?>'><?php echo get_bloginfo('name');?></a> - <a href='http://www.kriesi.at'>Wordpress Theme by Kriesi.at</a></span>
				
					<ul class="social_bookmarks">
							<?php do_action('avia_add_social_icon','footer');

							echo "<li class='phone'><a href='#top'>".__('scroll to top','avia_framework')."</a></li>"; 
							
							//contact icon
							$contact_page_id = avia_get_option('email_page');
			                if (function_exists('icl_object_id')) $contact_page_id = icl_object_id($contact_page_id, 'page', true);  //wpml prepared
							if($contact_page_id) echo "<li class='mail'><a href='".get_permalink($contact_page_id)."'>".__('Send us Mail', 'avia_framework')."</a></li>";
							
							 
							if($twitter = avia_get_option('twitter')) echo "<li class='twitter'><a href='http://twitter.com/".$twitter."'>".__('Follow us on Twitter', 'avia_framework')."</a></li>";
							if($facebook = avia_get_option('facebook')) echo "<li class='facebook'><a href='".$facebook."'>".__('Join our Facebook Group', 'avia_framework')."</a></li>";
							
							
							 ?>
							
							<li class='rss'><a href="<?php avia_option('feedburner',get_bloginfo('rss2_url')); ?>"><?php _e('Subscribe to our RSS Feed', 'avia_framework')?></a></li>

									
						</ul>
						<!-- end social_bookmarks-->
				
				</div>
			</div>
			<!-- ####### END SOCKET CONTAINER ####### -->
		
		</div><!-- end wrap_all -->
		
		
		
		<?php 
			if(avia_get_option('bg_image') && avia_get_option('bg_image_repeat') == 'fullscreen') 
			{ 
				$image = avia_get_option('bg_image');
			?>
				<!--[if lte IE 8]>
				<style type="text/css" class='bg_fullscreen_ie_rule'>
				body {
				-ms-filter:"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $image; ?>', sizingMethod='scale')";
				filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $image; ?>', sizingMethod='scale');
				}
				</style>
				<![endif]-->
			<?php
				echo "<div class='bg_container' style='background-image:url(".avia_get_option('bg_image').");'></div>"; 
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
</div>

</body>
</html>