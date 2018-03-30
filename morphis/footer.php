<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */
?>
	
	<!-- FOOTER -->
  <div id="footer-wrapper">
	<footer class="container">
		<ul class="sixteen columns clearfix">
			<li class="four columns alpha">
				<?php if ( is_active_sidebar( 'footer-first-column' ) ) : ?>
					<?php dynamic_sidebar( 'footer-first-column' ); ?>
				<?php endif; ?>
			</li>
			<li class="four columns">
				<?php if ( is_active_sidebar( 'footer-second-column' ) ) : ?>
					<?php dynamic_sidebar( 'footer-second-column' ); ?>				
				<?php endif; ?>
			</li>
			<li class="four columns">
				<?php if ( is_active_sidebar( 'footer-third-column' ) ) : ?>
					<?php dynamic_sidebar( 'footer-third-column' ); ?>	
				<?php endif; ?>
			</li>			
			<li class="four columns omega">
				<?php if ( is_active_sidebar( 'footer-fourth-column' ) ) : ?>
					<?php dynamic_sidebar( 'footer-fourth-column' ); ?>			
				<?php endif; ?>
			</li>
		</ul>
	</footer>
	<div class="clear"></div>
  </div>
  <!-- END FOOTER -->
  <!-- SITEINFO -->
  <div id="siteInfo">
		<div class="container clearfix">
			<div class="sixteen columns clearfix">
					<?php 
					global $NHP_Options; 
					$options_morphis = $NHP_Options; 
					?>
					<?php echo $options_morphis['copyright_info']; ?>
					<a href="#" class="to-top"><?php echo __( 'Go Back to Top', 'morphis' ); ?></a>
			</div>	
		</div>
  </div>
  <!-- END SITEINFO -->
</div>
<?php wp_footer(); ?>

</body>
</html>