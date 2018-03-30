<?php
$query = '';

if( !empty( $title ) ) { $query .= '&chtt=' . $title; }
if( !empty( $labels ) ) { $query .= '&chl=' . $labels; }
if( !empty( $colors ) ) { $query .= '&chco=' . $colors; }

$query .= '&chs=' . $width . 'x' . $height;
$query .= '&chd=t:' . $data;
$query .= '&chf=bg,s,' . ltrim( $bg, '#' );

if( !empty( $advanced ) ) { $query .= '&' . $advanced; }
?>
<div style="<?php echo $align != 'center' ? 'float: ' . $align . ';' : 'text-align: center;' ?>">
    <img src="<?php echo $use_ssl == 'yes' ? 'https' : 'http' ?>://chart.apis.google.com/chart?cht=<?php echo $type . $query ?>" title="<?php echo $title ?>" alt="<?php echo $title ?>" />
</div>