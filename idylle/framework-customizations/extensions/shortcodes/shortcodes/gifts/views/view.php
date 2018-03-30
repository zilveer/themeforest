<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>

<!-- Wrapper -->
<div class="idy_slider">

<?php foreach ($atts['gifts'] as $gifts):
    if ( empty( $gifts['image'] ) ) {
        $image = get_template_directory_uri().'/images/no_image.jpg';
    } else {
        $image = fw_resize( $gifts['image']['attachment_id'], '', '60', true );
    }
?>  
    <a href="<?php echo esc_url($gifts['link']); ?>" target="_blank" class="idy_slider_item">
        <img src="<?php echo esc_attr($image); ?>" alt="<?php echo esc_attr($gifts['name']); ?>">
    </a>

<?php endforeach; ?>

</div>
<!-- gifts End -->
