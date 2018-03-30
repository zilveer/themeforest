<?php
/**
 * Outputs the testimonial entry company
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Testimonial data
$company     = get_post_meta( get_the_ID(), 'wpex_testimonial_company', true );
$company_url = get_post_meta( get_the_ID(), 'wpex_testimonial_url', true ); ?>

<?php if ( $company ) : ?>
	<?php if ( $company_url ) : ?>
		<a href="<?php echo esc_url( $company_url ); ?>" class="testimonial-entry-company" title="<?php echo $company; ?>" target="_blank"><?php echo esc_html( $company ); ?></a>
	<?php else : ?>
		<span class="testimonial-entry-company"><?php echo esc_html( $company ); ?></span>
	<?php endif; ?>
<?php endif; ?>