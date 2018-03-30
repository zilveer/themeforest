<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Oswad Market
 * @since WD_Responsive
 */
?>
		<?php do_action( 'wd_before_body_end' ); ?>
		
	</div><!-- #main -->
<?php 
	global $page_datas;
	$hide_footer = false;
	if( isset($page_datas['hide_footer']) && $page_datas['hide_footer'] ){
		$hide_footer = true;
	}
?>	
	
</div><!-- #wrapper -->
<?php global $smof_data; ?>

<?php if( !$hide_footer ): ?>
	<div id="footer" role="contentinfo" class="<?php wd_page_layout_class(); ?>" >
		
			<div class="footer-container">
			
				<?php do_action( 'wd_footer_init' ); ?>
				
			</div>
			
	</div><!-- #footer -->
<?php endif; ?>

<?php do_action( 'wd_before_footer_end' ); ?>
</div><!-- #wd-content -->

</div><!-- #body-wrapper -->

<?php echo stripslashes(trim($smof_data['wd_before_body_end_code']));?>
<?php echo stripslashes(trim($smof_data['wd_google_analytic_code']));?>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>