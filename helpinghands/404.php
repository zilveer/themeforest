<?php 
/**
 * 404 Page
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

get_header();

global $sd_data;

$layout_404       = $sd_data['sd_404_layout'];
$sidebar_location = $sd_data['sd_sidebar_location'];
$content_404      = $sd_data['sd_404_content'];
$button1_text     = $sd_data['sd_404_button1_text'];
$button1_url      = esc_url( $sd_data['sd_404_button1_url'] );
$button2_text     = $sd_data['sd_404_button2_text'];
$button2_url      = esc_url( $sd_data['sd_404_button2_url'] );
$sidebars_layout  = $sd_data['sd_404_sidebars'];
?>
<!--left col-->

<div class="sd-blog-page sd-404-page">
	<div class="container">
		<div class="row"> 
			<div class="col-md-<?php if ( $layout_404 == '2' ) echo '12'; else echo '8'; ?> <?php if ( $sidebar_location == '2' ) echo 'pull-right'; ?>">
				<div class="sd-left-col">
					<div class="sd-not-found">
						<?php if ( ! empty( $content_404 ) ) : ?>
							<?php echo do_shortcode( $content_404 ); ?>
						<?php else : ?>
							<div class="sd-center">
								<div class="sd-404-text">
									<span class="sd-main-404">
										<a href="<?php echo home_url('/'); ?>" title="<?php _e( 'Back to Homepage', 'sd-framework' ); ?>"><?php _e( '404', 'sd-framework' ); ?></a>
									</span>
									<span class="sd-sub-404"><?php _e( 'PAGE NOT FOUND', 'sd-framework' ); ?></span>
								
								<?php if ( ! empty( $button1_url ) ) : ?>
								<a class="sd-donate-button sd-all-trans" href="<?php echo $button1_url; ?>" title="<?php echo esc_attr( $button1_text ); ?>"><?php echo $button1_text; ?></a>
								<?php endif; ?>
								&nbsp;&nbsp;
								<?php if ( ! empty( $button2_url ) ) : ?>
								<a class="sd-more sd-all-trans" href="<?php echo $button2_url; ?>" title="<?php echo esc_attr( $button2_text ); ?>"><?php echo $button2_text; ?></a>
								<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
						<?php if ( $sidebars_layout !== '1' ) : ?> 
							<div class="sd-404-sidebars clearfix">
								<div class="row">
									<?php if ( $sidebars_layout == '2' ) : ?>
										<div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
											<?php dynamic_sidebar( 'error-sidebar-one' ); ?>
										</div>
									<?php elseif ( $sidebars_layout == '3' ) : ?>
										<div class="col-md-4 col-sm-4 col-md-offset-2 col-sm-offset-2">
											<?php dynamic_sidebar( 'error-sidebar-one' ); ?>
										</div>
										<div class="col-md-4 col-sm-4">
											<?php dynamic_sidebar( 'error-sidebar-two' ); ?>
										</div>
									<?php elseif ( $sidebars_layout == '4' ) : ?>
										<div class="col-md-4 col-sm-4">
											<?php dynamic_sidebar( 'error-sidebar-one' ); ?>
										</div>
										<div class="col-md-4 col-sm-4">
											<?php dynamic_sidebar( 'error-sidebar-two' ); ?>
										</div>
										<div class="col-md-4 col-sm-4">
											<?php dynamic_sidebar( 'error-sidebar-three' ); ?>
										</div>
									<?php endif; ?>
								</div>
								<!-- row -->
							</div>
							<!-- sd-404-sidebars -->
						<?php endif; ?>
					</div>
					<!-- sd-not-found -->
				</div>
				<!-- sd-left-col --> 
			</div>
			<!-- col-md-* --> 
			<?php if ( $layout_404 !== '2' ) : ?>
				<div class="col-md-4">
					<?php get_sidebar(); ?>
				</div>
				<!-- col-md-4 -->
			<?php endif; ?>
		</div>
		<!-- row -->
	</div>
	<!-- container -->
</div>
<!-- sd-blog-page -->
<?php get_footer(); ?>