<?php

class show_gallery {

	public function register_shortcode($shortcodeName) {
        if (!function_exists("shortcode_show_gallery")) {
            function shortcode_show_gallery($atts, $content = null)
            {

                global $gt3_pbconfig;

                $compile = "";

                extract(shortcode_atts(array(
                    'heading_size' => $gt3_pbconfig['default_heading_in_module'],
                    'heading_color' => '',
                    'heading_text' => '',
                    'width' => $gt3_pbconfig['gallery_module_default_width'],
                    'height' => $gt3_pbconfig['gallery_module_default_height'],
                    'galleryid' => '',
                ), $atts));

                #heading
                if (strlen($heading_color) > 0) {
                    $custom_color = "color:#{$heading_color};";
                }
                if (strlen($heading_text) > 0) {
                    $compile .= "<" . $heading_size . " style='" . (isset($custom_color) ? $custom_color : '') . "' class='headInModule'>{$heading_text}</" . $heading_size . ">";
                }

                $compile .= "<div class='nolist list-of-images'>";

                /*$args = array(
                    'post_type' => 'attachment',
                    'numberposts' => -1,
                    'post_status' => null,
                    'post_parent' => $galleryid
                    );
                $images = get_posts($args);*/

                $galleryPageBuilder = get_theme_pagebuilder($galleryid);

                if (isset($galleryPageBuilder['sliders']['fullscreen']['slides']) && is_array($galleryPageBuilder['sliders']['fullscreen']['slides'])) {
                    foreach ($galleryPageBuilder['sliders']['fullscreen']['slides'] as $image) {

                        $photoTitle = $image['title']['value'];
                        if (strlen($photoTitle) > 0) {
                            $photoTitleOutput = "<span class='gallery_title'>" . $photoTitle . "</span>";
                        } else {
                            $photoTitleOutput = "";
                        }
                        $photoCaption = $image['caption']['value'];

                        if ($image['slide_type'] == "image") {
                            $compile .= '
                        <div class="gallery_item">
                            <a rel="prettyPhoto[gallery2]" style="width:' . $width . ';height:' . $height . ';" href="' . $image['src'] . '" class="gallery-stand-link prettyPhoto">
                                <img class="gallery-stand-img" src="' . aq_resize($image['src'], $width, $height, true, true, true) . '" alt="">
                                <div class="gallery-wrapper"></div>
                                <span class="post_type post_type_image"></span>
                                ' . ((strlen($photoTitleOutput) > 0 || $photoCaption > 0) ? '<div class="gallery_descr">
                                    <span class="setme">' . $photoTitleOutput . $photoCaption . '</span>
                                </div>' : '') . '
                                <hr>
                            </a>
                        </div>';
                        }

                        if ($image['slide_type'] == "video") {
                            $compile .= '
                        <div class="gallery_item">
                            <a rel="prettyPhoto[gallery2]" style="width:' . $width . ';height:' . $height . ';" href="' . $image['src'] . '" class="gallery-stand-link prettyPhoto">
                                <img class="gallery-stand-img" src="' . aq_resize($image['thumbnail']['value'], $width, $height, true, true, true) . '" alt="">
                                <span class="post_type post_type_video"></span>
                                ' . ((strlen($photoTitleOutput) > 0 || $photoCaption > 0) ? '<div class="gallery_descr">
                                    <span class="setme">' . $photoTitleOutput . $photoCaption . '</span>
                                </div>' : '') . '
                                <hr>
                            </a>
                        </div>
                        ';
                        }
                        unset($photoTitleOutput, $photoCaption);
                    }
                }

                $compile .= "


            <div class='clear'></div>
            </div>
            ";

                return $compile;

            }
        }
		add_shortcode($shortcodeName, 'shortcode_show_gallery');
	}
}



$compilegal="";
/* GET ALL GALLERYS FOR SELECT */
/*$wp_query_temp = new WP_Query();
$args = array(
'post_type' => 'gallery',
);

$wp_query_temp->query($args);
while ( $wp_query_temp->have_posts() ) : $wp_query_temp->the_post();

$compilegal .= '<option value="'.get_the_ID().'">'.get_the_title().'</option>';

endwhile;

wp_reset_query();*/




#Shortcode name
$shortcodeName="show_gallery";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "
<div style='float:left;clear:both;line-height:27px;'>Photo width:</div> <input style='width:60px;text-align:center;' value='124' type='text' class='".$shortcodeName."_width' name='".$shortcodeName."_width'> (px)
<div style='clear:both;'></div>
<div style='float:left;clear:both;line-height:27px;'>Photo height:</div> <input style='width:60px;text-align:center;' value='124' type='text' class='".$shortcodeName."_height' name='".$shortcodeName."_height'> (px)
<div style='clear:both;'></div>
<div style='float:left;clear:both;line-height:27px;'>Gallery:</div> 
	<select name='".$shortcodeName."_galleryid' class='".$shortcodeName."_galleryid'>
		".$compilegal."
	</select>
<div style='clear:both;'></div>

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		var width = jQuery('.".$shortcodeName."_width').val();
		var height = jQuery('.".$shortcodeName."_height').val();
		var galleryid = jQuery('.".$shortcodeName."_galleryid').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName." width=\"'+width+'\" height=\"'+height+'\" galleryid=\"'+galleryid+'\"][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";






#Register shortcode & set parameters
$shortcode_show_gallery = new show_gallery();
$shortcode_show_gallery->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['show_gallery'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>