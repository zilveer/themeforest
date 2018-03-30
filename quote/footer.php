<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package quote
 */
?>

	</div>

	<!-- MAIN FOOTER -->
	<div id="footerwrap">
		<div class="container">
			<div class="row">
				<?php dynamic_sidebar('footer'); ?>
			</div><!-- row -->
		</div><!-- container -->
		<div id="footer-copyright">
			<div class="container">
				<?php $footertext = get_option('footer_text' , 'Created With Love By Distinctive Themes'); echo htmlspecialchars_decode($footertext); ?>    
			</div>
		</div>
	</div>
	
	<a id="gototop" class="gototop no-display" href="#"><i class="fa fa-angle-up"></i></a>
	<!-- END MAIN FOOTER -->
	
<?php dt_bg_slider(); ?>	
<?php wp_footer(); ?>

</body>
</html>
