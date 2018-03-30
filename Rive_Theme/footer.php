<?php
/**
 * The template for displaying the footer.
 */

global $ch_is_footer;

if ( has_nav_menu( 'bottom-menu' ) && is_front_page()) { ?>
	<div class="row-fluid">
		<div class="span24">
		<div class="our-partners">
			<div class="partners-content">
				<div class="jcarousel-prev-horizontal"><a href="#"></a></div>
				<div class="partners-title"><h3><?php _e( 'Our Partners', 'ch' ); ?></h3></div>
				<div class="clearfix"></div>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'bottom-menu',
							'menu_class'     => 'partners-carousel',
							'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'          => 1,
							'walker'         => new partners_walker()
						)
					);
				?>
				<div class="jcarousel-next-horizontal"><a href="#"></a></div>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(window).load(function() {
				jQuery('.menu-our-partners-container').jcarousel();

				jQuery('.jcarousel-next-horizontal').jcarouselControl({
					'target': '+=1'
				});
				jQuery('.jcarousel-prev-horizontal').jcarouselControl({
					'target': '-=1'
				});
			});
		</script>
		</div>
	</div>
<?php } ?>
	<div class="clearfix"></div>
	<?php
		$ch_is_footer = true;
	?>
									<div class="clearfix"></div>
								</div><!--end of content-->
								<div class="clearfix"></div>
							</div><!--end of shadow1-->
						</div><!--end of main-container-wrapper-->
					</div><!--end of span24-->
				</div><!--end of row-->
			</div><!--end of container-->
		</div><!--end of wrapper-->
		<div class="row-fluid">
			<div class="span24">
				<div class="footer-bg">
					<div class="footer">
						<div class="footer-content">
							<?php
								// How many footer columns to show?
								$footer_columns = get_option( 'ch_footer_columns' );
								if ( $footer_columns == false ) {
									$footer_columns = 4;
								}
							?>
							<div class="footer-links-container columns_count_<?php echo $footer_columns; ?>">
								<?php get_sidebar( 'footer' ); ?>
								<div class="clearfix"></div>
							</div><!--end of footer-links-container-->
						</div>
					</div><!--end of footer-->
				</div><!--end of footer-bg-->
			</div>
		</div>
		<?php
			$tracking_code = get_option( 'ch_tracking_code' ) ? get_option( 'ch_tracking_code' ) : '';
			if ( !empty( $tracking_code ) ) { ?>
				<!-- Tracking Code -->
				<?php
				echo '
					' . $tracking_code;
			}
			wp_footer();
		?>
	</body>
</html>
