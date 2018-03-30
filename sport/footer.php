<?php 

      $canon_options = get_option('canon_options'); 

?>

      <!-- FOOTER -->
      <?php if ( (is_page_template('page-placeholder.php') === false) ) { get_template_part('inc/templates/footer/template_footer'); } ?>

      <!-- GOOGLE ANALYTICS-->
      <?php if (!empty($canon_options['google_analytics_code'])) echo $canon_options['google_analytics_code']; ?>

      <!-- WP FOOTER -->
      <?php wp_footer(); ?>
        
			        
	</body>
	
</html>
		