<?php
/**
  *
  * @KingSize 2011 - 2014
  * WordPress Developed by: O.W.M Consulting
  * http://www.ourwebmedia.com
  *
**/
  
if(function_exists('get_header') ) { get_header(); } ?>




	<!-- GOOGLE ANALYTICS -->
	<?php include (get_template_directory()  . "/lib/google-analytics-input.php"); ?>
	<!-- GOOGLE ANALYTICS -->
	
  	<!-- Responsive Framework -->
  	<script src="<?php echo get_template_directory_uri();?>/js/app.js"></script>
  	<script src="<?php echo get_template_directory_uri();?>/js/modernizr.foundation.js"></script>  
  	<!-- End Responsive Framework -->

<?php wp_footer(); ?>

</body>
</html>