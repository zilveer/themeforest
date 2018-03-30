<?php

foreach ( glob( '*.css' ) as $filename ) {
    $css = file_get_contents($filename);
    $css = preg_replace( '/[\s]color: #([a-fA-F0-9]+);/', ' color: #$1 !important;', $css );
    //echo nl2br($css).'<br /><br />';
    file_put_contents($filename, $css);
}

// $started = $ended = false;
// $handle = @fopen('buttons.css', "r");
// if ($handle) {
//     $filename = '';
//     while (($buffer = fgets($handle, 4096)) !== false) {
//         if ( ! $started ) $started = preg_match( '/\/\* class\: .btn-([a-z0-9-]+)/', $buffer, $matches_start ); 
//         $ended = preg_match( '/\/\* end .btn-([a-z0-9-]+)/', $buffer, $matches );
//                                                                   
//         if ( ! $started && ! $ended ) continue;
//         
//         $filename = $matches_start[1];
//         file_put_contents( 'buttons/' . $filename . '.css', $buffer, FILE_APPEND );
//         
//         if ( $ended )
//             $started = false;
//     }
//     if (!feof($handle)) {
//         echo "Error: unexpected fgets() fail\n";
//     }
//     fclose($handle);
// }