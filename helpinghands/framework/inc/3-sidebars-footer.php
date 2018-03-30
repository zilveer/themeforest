<?php
/**
 * 3 Sidebars Footer
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
<div class="sd-footer-widgets sd-footer-widgets-3 <?php if ( $boxed_footer == 1 ) echo 'sd-boxed-padding'; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-4 sd-footer-sidebar-1">
				<?php dynamic_sidebar( 'footer-sidebar-one' ); ?>
			</div>
			<div class="col-md-4 col-sm-4 sd-footer-sidebar-2">
				<?php dynamic_sidebar( 'footer-sidebar-two' ); ?>
			</div>
			<div class="col-md-4 col-sm-4 sd-footer-sidebar-3-last">
				<?php dynamic_sidebar( 'footer-sidebar-three' ); ?>
			</div>
		</div>
		<!-- row -->
	</div>
	<!-- container -->
</div>
<!-- sd-footer-widgets -->