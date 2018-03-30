<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/*Background Color*/
$bg_color = '';
if ( ! empty( $atts['background_color'] ) ) {
	$bg_color = 'background-color:' . $atts['background_color'] . ';';
}

/*Background Image*/
$bg_image = '';
if ( ! empty( $atts['background_image'] ) && ! empty( $atts['background_image']['data']['icon'] ) ) {
	$bg_image = 'background-image:url(' . $atts['background_image']['data']['icon'] . ');';
}

/*Background Video*/
$bg_video_data_attr    = '';
$section_extra_classes = '';
if ( ! empty( $atts['video'] ) ) {
	$filetype           = wp_check_filetype( $atts['video'] );
	$filetypes          = array( 'mp4' => 'mp4', 'ogv' => 'ogg', 'webm' => 'webm', 'jpg' => 'poster' );
	$filetype           = array_key_exists( (string) $filetype['ext'], $filetypes ) ? $filetypes[ $filetype['ext'] ] : 'video';
	$bg_video_data_attr = 'data-wallpaper-options="' . fw_htmlspecialchars( json_encode( array( 'source' => array( $filetype => $atts['video'] ) ) ) ) . '"';
	$section_extra_classes .= ' background-video';
}
/*Background*/
$section_style   = ( $bg_color || $bg_image ) ? 'style="' . $bg_color . $bg_image . '"' : '';

/*FullWidth*/
$container_class = "container";
if($atts['fullwidth']==1) {
	$container_class = "container-fluid";
}else{
	$container_class = "container";
}

/*Alignment*/
$textAlign = $atts['text_align'];

?>



<section <?php if($atts['parallax']==1) {echo 'data-stellar-background-ratio="0.4"';} ?> <?php if(!empty($atts['id'])) { echo 'id="'.esc_attr($atts['id']).'"';} ?> class="idy_box <?php if($atts['fullwidth']==1) {echo 'idy_box_full';} if ( $atts['white_txt'] == 1 ) { echo " idy_white_txt"; } ?> <?php echo esc_attr($section_extra_classes); ?>" <?php echo do_shortcode($section_style); ?> <?php echo do_shortcode($bg_video_data_attr); ?>>

<?php if ($atts['over_display']=='1'): ?>
<!-- Over -->
<div class="idy_over" data-color="<?php echo esc_attr($atts['over_color']); ?>" data-opacity="<?php echo esc_attr($atts['over_opacity']); ?>"></div>
<?php endif ?>

    <div class="<?php echo esc_attr($container_class).' '.esc_attr($textAlign); ?>">
		
		

		<?php if(!empty($atts['title'])) { ?>
		<h2>
            		<?php echo esc_attr($atts['title']); ?>
        </h2>
		<?php } ?>

		<?php if(!empty($atts['subtitle'])) { ?>
        <div class="idy_subtitle"><?php echo esc_attr($atts['subtitle']); ?></div>
        <?php } ?>
		
		<!-- Content -->
		<?php echo do_shortcode( $content ); ?>

    </div>
</section>

