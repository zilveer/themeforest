<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$divider = $atts['divider'];
?>
<?php if($divider['divider_type'] == 'line'):?>
    <?php $style = !empty($divider['line']['color']) ? 'style="background-color: '.$divider['line']['color'].'"' : '';?>

    <div class="divider-1 <?php echo esc_attr($divider['line']['divider_type']);?> <?php echo esc_attr($atts['class']);?>" <?php echo ($style);?>></div>

<?php elseif($divider['divider_type'] == 'shadow'):?>

    <div class="shadow <?php echo esc_attr($atts['class']);?>">
        <?php if($divider['shadow']['divider_type'] == 'type1'):?>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/images/shadow-2.png');?>" alt="">
        <?php elseif($divider['shadow']['divider_type'] == 'type2'):?>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/images/shadow-1.png');?>" alt="">
        <?php else:?>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/images/shadow-3.png');?>" alt="">
        <?php endif;?>
    </div>

<?php elseif($divider['divider_type'] == 'pattern'):?>

    <div class="divider-1-pattern <?php echo esc_attr($divider['pattern']['divider_type']);?>  <?php echo esc_attr($atts['class']);?>"></div>

<?php endif;?>