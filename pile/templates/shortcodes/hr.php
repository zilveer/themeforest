<?php
if (empty( $type )) $type = '';

// get needed classes
$classes = 'pixcode  pixcode--separator  separator';
$classes .= ! empty( $type ) ? ' separator--' . $type : '';
$classes .= ! empty( $color ) ? ' separator_color--' . $color : '';

// create class attribute
$classes = 'class="' . trim( $classes ) . '"';

echo '<hr ' . $classes . '/>' . PHP_EOL ;
