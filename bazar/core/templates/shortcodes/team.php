<?php 

// other attrs
$extra_atts = array();
foreach ( $other_atts as $att => $v ) $extra_atts[] = "$att=\"$v\"";

echo do_shortcode('[accordion name="' . $name . '" ' . implode(' ', $extra_atts) . ']'); ?>