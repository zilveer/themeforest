<?php
/**
 * The template for displaying the footer
 */
?>
				
				<?php
				/* Will be deleted in the next version */	
					
				// GET SIDEBAR
				// FETCHING SIDEBAR POSITION 
				/*$sidebar_position = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('sidebar_position') : 'right'; 
				$sidebar_show = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('sidebar_show') : ''; 
				if($sidebar_position == "right" && $sidebar_show != "hide") : 
					get_sidebar(); 
				endif;*/
				 ?>
				
<?php $is_blank_page = is_page_template('page-templates/blank-page.php');?>

				<?php // DISPLAY SCROLL
				if(!$is_blank_page) {
					$sidebar_scroll_inner = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option( 'sidebar_scroll_inner' ) : '';
					if ( $sidebar_scroll_inner == "yep" ) :
						echo '<a href="javascript:void(0)" id="can-scroll"><i class="fa fa-angle-double-down"></i></a>';
					endif;
				}?>
			
			</section>
			<!-- END CONTENT -->
<?php
if(!$is_blank_page):
?>
			<!-- START FOOTER -->
            <?php $navigation_hidden_class = woffice_get_navigation_class(); ?>
			<footer id="main-footer" class="<?php echo esc_attr($navigation_hidden_class)?>">
				
				<?php // IF YOU WANT TO DISPLAY THE EXTRA FOOTER
				$extrafooter_show = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('extrafooter_show') : '';
				if(  $extrafooter_show == "yes" ) : 
					woffice_extrafooter();
				endif; ?>

				<?php // IF YOU WANT TO DISPLAY WIDGET AREA IN THE FOOTER
				$footer_widgets = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('footer_widgets') : '';
				if(  $footer_widgets == "show" && is_active_sidebar( 'widgets' )) : ?>
					<!-- START FOOTER WIDGETS -->
					<div id="widgets">
						<?php get_sidebar( 'footer' ); ?>
					</div>
				<?php endif; ?>

				<!-- START COPYRIGHT -->
				<div id="copyright">
					<?php
		  			// GET COPYRIGHT CONTENTS
					$footer_copyright_content = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('footer_copyright_content') : '';
					?>
				  	<p><?php echo $footer_copyright_content; ?></p>
				</div>
			</footer>
			<!-- END FOOTER -->

		</div>

<?php endif; ?>

		<!-- JAVSCRIPTS BELOW AND FILES LOADED BY WORDPRESS -->
		<?php wp_footer(); ?>

	</body>
	<!-- END BODY -->
</html>