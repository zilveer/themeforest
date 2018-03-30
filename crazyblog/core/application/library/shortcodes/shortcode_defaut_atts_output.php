<?php

$output = '';
$titles = '';
if ( $show_title == 'true' && !empty( $col_title ) ):
	$titles = crazyblog_row_section_title( $col_title, $col_sub_title, $col_heading );
endif;
$output .= $titles;

echo wp_kses_post( $output );
