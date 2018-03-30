<?php

class lislide
{

    public function register_shortcode($shortcodeName)
    {
        if (!function_exists("shortcode_lislide")) {
            function shortcode_lislide($atts, $content = null)
            {
                extract(shortcode_atts(array(
                    'img' => $img,
                    'title' => $title,
                    'url' => $url,
                ), $atts));

                if (strlen($icon) > 0) {
                    $iconshow = '<img src="' . IMGURL . '/icons/' . $icon . '" />';
                }

                $compile = '
			
				<div data-thumb="' . $img . '" data-src="' . $img . '">';

                if (strlen($title) > 0 || strlen($content) > 0) {
                    $compile .= '       <div class="camera_caption fadeFromLeft">';
                    if (strlen($title) > 0) {
                        $compile .= "<h3>" . $title . "</h3>";
                    }

                    $compile .= $content . '
					</div>';
                }

                $compile .= '   </div>
				
			';

                return $compile;

            }
        }

        add_shortcode($shortcodeName, 'shortcode_lislide');
    }
}


#Shortcode name
$shortcodeName = "lislide";


#Register shortcode & set parameters
$shortcode_lislide = new lislide();
$shortcode_lislide->register_shortcode($shortcodeName);


?>