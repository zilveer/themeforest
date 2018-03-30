<?php
if( is_null( $content ) ) return;

$html = str_replace( array( '[', ']', '<', '>' ), array( '&#91;', '&#93;', '&lt;', '&gt;' ), $content );

echo '<pre class="shortcodes">' . $html . '</pre>';

?>