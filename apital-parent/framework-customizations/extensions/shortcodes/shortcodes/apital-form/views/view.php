<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

$contact = $atts['contact'];
?>
<?php if(!empty($contact)):?>
    <?php echo do_shortcode($contact);?>
<?php endif;?>