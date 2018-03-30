<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content.
 *
 * @package Magzilla
 * @since Magzilla 1.0
 */
 global $ft_option, $fave_container, $footer_col;

 	if( empty( $ft_option['footer_layout'] ) ) { $footer_col = "col-3"; } else { $footer_col = $ft_option['footer_layout']; } 
?>

<?php if( !empty( $ft_option['ads_above_footer'] ) ): ?>
<div class="<?php echo $fave_container; ?>">
	<div class="row">
		<div class="col-md-12">
			<div class="ads-abovefooter-wrapper"><?php echo $ft_option['ads_above_footer']; ?></div>
		</div>
	</div>
</div>
<?php endif; ?>

</div><!-- Magzilla-main-wrap -->
<footer class="footer" itemscope itemtype="http://schema.org/WPFooter">

	<?php if( !empty( $ft_option['footer_ad'] )): ?>
		<div class="favethemes-footer-ads-main">
			<div class="<?php echo $fave_container; ?>">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="favethemes-ads-footer text-center">
							<?php echo $ft_option['footer_ad']; ?>
						</div><!-- .module-top -->
					</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div>
	<?php endif; ?>

	<?php get_template_part('footer/footer', $footer_col ); ?>

	<?php get_template_part('footer/footer', 'bottom'); ?>
</footer>

</div><!-- .external-wrap -->	

<?php wp_footer(); ?>

</body>
</html>