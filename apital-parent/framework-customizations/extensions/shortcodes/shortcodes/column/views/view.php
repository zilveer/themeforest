<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
} ?>

<?php
$id_to_class = array(
	'1_6' => 'w-col-2',
	'1_4' => 'w-col-3',
	'1_3' => 'w-col-4',
	'1_2' => 'w-col-6',
	'2_3' => 'w-col-8',
	'3_4' => 'w-col-9',
	'1_1' => 'w-col-12'
);

?>
<div class="w-col <?php echo esc_attr($id_to_class[ $atts['width'] ]); ?> w-col-stack w-clearfix">
    <?php echo do_shortcode($content); ?>
</div>

