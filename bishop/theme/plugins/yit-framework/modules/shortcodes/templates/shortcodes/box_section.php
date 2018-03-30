<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for shows a box, with Title and icons on left and a text of section (you can use HTML tags)'
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

$a_before = $a_after = '';

$layout = isset( $layout ) ? $layout : '';

if ( !isset( $title_size ) || $title_size == '' ) {
    $title_size = 'h3';
}

$last_class = ( isset( $last ) && $last == 'yes' ) ? ' last' : '';

if ( isset( $border ) && $border == 'yes' ) {
    $class .= '-border';
}

if ( !empty( $link ) ) {
    $link = esc_url( $link );
    if ( !empty( $link_title ) ) {
        $link_title = ' title="' . $link_title . '"';
    }
    $a_before = '<a href="' . $link . '"' . $link_title . '>';
    $a_after  = '</a>';
}

$icon_type = ( $icon_type == '' ) ? 'theme-icon' : $icon_type;

$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';

?>

<div class="clearfix margin-bottom <?php echo esc_attr( $class . $last_class. $animate . $vc_css ); ?> <?php echo $layout?>" <?php echo $animate_data ?>>
	<?php

    echo $a_before;
    echo '<div class="box-icon">';

    if ( $icon_type == 'theme-icon' ) {
        if ( $circle_size > 0 ) {
            echo '<span class="icon-circle" style="width:'. $circle_size.'px; height:'.$circle_size.'px;border-color: '. $color_circle .'">';
        }
        $color = ( $color == '' ) ? '' : 'color:'.$color;
        $icon_size = ( $icon_size == '' ) ? '14' : $icon_size;
        echo '<span class="icon"><i class="fa fa-'.$icon_theme.'" style="'. $color.'; font-size:'.$icon_size.'px"></i></span>';
        if ( $circle_size > 0 ) {
            echo '</span>';
        }
    }
    elseif (  strcmp ( $icon_url , '' ) != 0  ) {
        echo '<span class="icon"><img src="' . esc_url( $icon_url ) . '"></span>';
    }

    echo '</div><div class="box-content">';
    if ( $title != '' ) : echo '<' . $title_size . '>' . $title . '</' . $title_size . '>'; endif;

    echo $a_after;

    ?>
    <?php echo wpautop(do_shortcode($content)); ?>
    <?php echo '</div>' ?>
</div>
