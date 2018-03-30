<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

?>
<?php
    $media = $atts['media_type'];
?>
<?php if($media['media'] == 'video'):?>

    <?php
        global $wp_embed;
        $iframe = $wp_embed->run_shortcode( '[embed]' . trim( $media['video']['video'] ) . '[/embed]' );
    ?>
    <div class="w-embed w-video <?php echo esc_attr($atts['class']);?>" style="padding-top: 56.20608899297424%;">
        <?php echo do_shortcode($iframe);?>
    </div>

<?php elseif($media['media'] == 'soundcloud'):?>

    <div class="w-embed w-iframe <?php echo esc_attr($atts['class']);?>">
        <iframe height="166" src="https://w.soundcloud.com/player/?url=<?php echo esc_url($media['soundcloud']['souncloud']);?>&amp;color=0066cc"></iframe>
    </div>

<?php else:?>

    <?php if(!empty($media['img']['img'])):?>
        <div class="img-e-wrap <?php echo esc_attr($atts['class']);?>" data-wow-delay="0.2s">
            <img src="<?php echo esc_url($media['img']['img']['url']); ?>" alt="">
        </div>
    <?php endif;?>

<?php endif;?>
