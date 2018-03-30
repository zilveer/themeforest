<?php
$subtitle = ( $subtitle == '' ) ? '' : '<h5>' . $subtitle . '</h5>';
$title = ( $title == '' ) ? '' : '<h2>' . $title . '</h2>';
$class =  ( $last == 'yes' ) ? 'last' : '';
$class .=  ( $first == 'yes' ) ? ' first' : '';
$bg =  ( $background_image == '' ) ? '' : 'style="background-image: url(' . $background_image . ')"';

$animate_data   = ( $animate != '' ) ? ' data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';
?>

<div class="featured-column <?php echo esc_attr( $class . $animate . $vc_css ) ?>" <?php echo $bg . $animate_data ?>>
    <?php echo $subtitle ?>
    <?php echo $title ?>
    <p><?php echo do_shortcode( $content ) ?></p>
    <?php if ( $show_button == 'yes' ): ?>
        <a class="btn btn-flat" href="<?php echo $url_button ?>"><?php echo $label_button ?></a>
    <?php endif ?>
</div>
