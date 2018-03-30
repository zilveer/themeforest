<?php
/**
 * 4 Sidebars Footer
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
global $sd_data;

$boxed_footer = $sd_data['sd_boxed_footer'];
?>
<!-- footer widgets -->
<div class="sd-footer-widgets sd-footer-widgets-4 <?php if ( $boxed_footer == 1 ) echo 'sd-boxed-padding'; ?>">
	<div <?php if ( $sd_data['sd_boxed_footer'] !== '1' ) echo 'class="container"'; ?>>
		<div class="row">
				<div class="col-md-3 col-sm-3 sd-footer-sidebar-1">
					<div class="sd-footer-sidebar-1-content">
						<?php dynamic_sidebar( 'footer-sidebar-one' ); ?>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-3 sd-footer-sidebar-2">
					<div class="sd-footer-sidebar-2-content">
						<?php dynamic_sidebar( 'footer-sidebar-two' ); ?>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-3 sd-footer-sidebar-3<?php if ( $sd_data['sd_footer_sidebars'] == '3' ) echo '-last'; ?> ">
					<div class="sd-footer-sidebar-3-content">
						<?php dynamic_sidebar( 'footer-sidebar-three' ); ?>
					</div>
				</div>
					
				<div class="col-md-3 col-sm-3 sd-footer-sidebar-4">
					<div class="sd-footer-sidebar-4-content">
						<?php dynamic_sidebar( 'footer-sidebar-four' ); ?>
					</div>
				</div>
		</div>
		<!-- row -->
	</div>
	<!-- container -->
</div>
<!-- sd-footer-widgets -->