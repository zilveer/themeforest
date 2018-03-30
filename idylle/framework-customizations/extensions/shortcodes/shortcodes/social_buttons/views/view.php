<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>


<?php foreach ($atts['social'] as $social):?>  
    <a href="<?php echo esc_url($social['link']); ?>" target="_blank" class="idy_social_btns">
        <i class="fa <?php echo esc_attr($social['image']); ?>"></i>
    </a>

<?php endforeach; ?>

