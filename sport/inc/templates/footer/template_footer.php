<?php 

      $canon_options_frame = get_option('canon_options_frame'); 

?>

		<!-- FOOTER -->
		<footer>

                  <!-- PRE FOOTER -->
                  <?php if ($canon_options_frame['show_pre_footer'] == "checked") { get_template_part('inc/templates/footer/template_footer_pre'); } ?>

                  <!-- MAIN FOOTER -->
                  <?php if ($canon_options_frame['show_main_footer'] == "checked") { get_template_part('inc/templates/footer/template_footer_main'); } ?>

                  <!-- POST FOOTER -->
                  <?php if ($canon_options_frame['show_post_footer'] == "checked") { get_template_part('inc/templates/footer/template_footer_post'); } ?>

		</footer>
            
