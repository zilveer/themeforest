<?php 
	//SMART WIDGETIZED FOOTER

	$min_num_widgets = 2;
	$max_num_widgets = 5;

	//count active widget areas
	$num_widgets = 0;
	for ($i = 1; $i < $max_num_widgets+1; $i++) {  
		if (is_active_sidebar("canon_footer_widget_area_" . $i)) $num_widgets++;
	}

	//set classes
	$widget_area_base_class = "widget";
	$widget_area_size_class = mb_get_col_size_class_from_num($num_widgets, "col-1-4");


?>


		<!-- Start Outter Wrapper -->
		<div class="outter-wrapper main-footer-container element-block-widgetized-footer">

			<div class="wrapper clearfix">


				<?php 

					if ($num_widgets < $min_num_widgets) {
					?>

						<h3 class="centered"><?php _e("Footer Widget Areas", "loc_canon"); ?></h3>  
						<p class="centered"><i><?php _e("Please login and add widgets to at least", "loc_canon"); ?> <?php echo esc_attr($min_num_widgets); ?> <?php _e("of the", "loc_canon"); ?> <?php echo esc_attr($max_num_widgets); ?> <?php _e("footer widget areas", "loc_canon"); ?>.</i></p>  
					
					<?php       
					} else {
							
						$num_widget_shown = 0;

						for ($i = 1; $i < $max_num_widgets+1; $i++) {  

							// determine which widget to add last class to
							$add_last_class_to_num = $min_num_widgets;
							if ($num_widgets > $min_num_widgets) $add_last_class_to_num = $num_widgets;

							if ( is_active_sidebar("canon_footer_widget_area_" . $i) ) {
								$num_widget_shown++;

								// set last class and final class
								$widget_area_last_class = "";
								if ($num_widget_shown === $add_last_class_to_num) $widget_area_last_class = "last";
								$widget_area_final_class = $widget_area_base_class . " " . $widget_area_size_class . " " . $widget_area_last_class;

							?>

								<!-- FOOTER: WIDGET AREA -->
								<div class="<?php echo esc_attr($widget_area_final_class); ?>">

									<?php dynamic_sidebar("canon_footer_widget_area_" . $i); ?>  

								</div>
								
							<?php
							}

						}
					}
				?>

			</div>
		</div>