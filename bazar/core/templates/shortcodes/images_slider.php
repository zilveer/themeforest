<?php
$urls = explode("\n", $content);
$urls = array_map('trim', $urls);

if( $width == '0' )
    { $width = '100%'; }
else
    { $width = $width . 'px'; }

if( $height != 'auto' )
    { $height .= 'px'; }
    
$html = "<div class=\"images-slider-sc\" style=\"width:{$width};height:{$height}\">\n<ul class=\"slides\">";

$i = 0;
foreach($urls as $url) {
    $host = $a_before = $a_after = '';                                                   
                                            
    if( preg_match( '%^(?=[^&])(?:(?<scheme>[^:/?#]+):)?(?://(?<authority>[^/?#]*))?(?<path>[^?#]*)(?:\?(?<query>[^#]*))?(?:#(?<fragment>.*))?%', $url, $matches ) ) {
        if( empty( $matches[1] ) )
            $url = YIT_SITE_URL . '/' . $matches[3];
        else
            $url = $matches[0];
    }
    
    
    $url = str_replace( '<br />', '', $url );
    $url = str_replace( array( '<p>', '</p>' ), '', $url );
    
    if($url != '') $html .= "    <li><img style=\"max-width:100%\" src=\"{$host}{$url}\" alt=\"$i\" /></li>\n";
    $i++;
}

$html .= "</ul></div>\n";



$html .= "<script type=\"text/javascript\">
                jQuery(document).ready(function($){          
                    $('.images-slider-sc').flexslider({
                        animation: '$effect',
                        directionNav: true,
        				controlNav: false,
        				keyboardNav: false,
                        slideshowSpeed: $speed,
                        direction: '$direction'
                    });
                });
          </script>";

echo $html;
?>