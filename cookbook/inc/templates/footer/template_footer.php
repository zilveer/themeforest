<?php 

      $canon_options_frame = get_option('canon_options_frame'); 

?>

		<!-- FOOTER -->
		<footer>

            <?php
                  
                  if ($canon_options_frame['footer_pre_layout'] != "off") { get_template_part('inc/templates/footer/template_' . $canon_options_frame['footer_pre_layout']); }
                  if ($canon_options_frame['footer_main_layout'] != "off") { get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['footer_main_layout']); }
                  if ($canon_options_frame['footer_post_layout'] != "off") { get_template_part('inc/templates/footer/template_' . $canon_options_frame['footer_post_layout']); }
            
            ?>

		</footer>
            
