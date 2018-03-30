<?php
/**
 * Newsletter Section
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

global $sd_data;

$boxed_footer         = $sd_data['sd_boxed_footer'];
$newsletter_code      = $sd_data['sd_newsletter_code'];
$newsletter_title     = $sd_data['sd_newsletter_title'];
$newsletter_sub_title = $sd_data['sd_newsletter_subtitle'];

?>
<div class="sd-newsletter <?php if ( $boxed_footer == 1 ) echo 'sd-boxed-padding'; ?>">
	<div <?php if ( $boxed_footer !== '1' ) echo 'class="container"'; ?>>
		<div class="row">
			<div class="col-md-4">
				<div class="sd-newsletter-desc">
					<?php if ( ! empty( $newsletter_title ) ) : ?>
						<h4><?php echo $newsletter_title; ?></h4>
					<?php endif; ?>
					<?php if ( ! empty( $newsletter_sub_title ) ) : ?>
						<p><?php echo $newsletter_sub_title; ?></p>
					<?php endif; ?>
				</div>
				<!-- sd-newsletter-desc -->
			</div>
			
			<div class="col-md-8">
				<?php echo $newsletter_code; ?>
			</div>
			
		
		</div>
		<!-- row -->
	</div>
	<!-- container -->
</div>
<!-- sd-newsletter -->