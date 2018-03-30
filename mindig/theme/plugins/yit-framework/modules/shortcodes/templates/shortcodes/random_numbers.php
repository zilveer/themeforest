<?php

$icon_type = ( $icon_type == '' ) ? 'theme-icon' : $icon_type;
$text = (isset($text) && $text != '') ? $text : '';
$number = (isset($number) && $number != '') ? $number : '';

$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';

if ( $icon_type == 'theme-icon' ) :

    $color = ( $color == '' ) ? '#797979' : $color;
    $icon_size = ( $icon_size == '' ) ? '14' : $icon_size;

    $icon = '<span class="icon-circle" style="width:'. $circle_size . 'px; height:' .$circle_size . 'px; border-color:' . $color . '">
    <i class="fa fa-'. $icon_theme .'" style="color:' . $color . '; font-size: ' . $icon_size . 'px"></i></span>';

else :

    $icon = '<img src="' . $icon_url .'" alt="" width="52" height="52" />';

endif ?>

    <div class="random-numbers <?php echo esc_attr( $animate . $vc_css ); ?>" <?php echo $animate_data ?>>
        <?php echo  $icon ?>
        <span class="number"><?php echo $number; ?></span>
        <?php if ( function_exists('yit_addp') ){
                  echo yit_addp($text);
                }else{
                  echo $text;
                }
        ?>
    </div>
