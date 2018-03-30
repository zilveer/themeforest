<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// No Margin and Padding
$no_mrg_pdg = null;
if ($no_margin_padding==true) {
    if ($section_mode=="fluid") {
        $no_mrg_pdg = 'no-margin-and-padding';
    } else {
        $no_mrg_pdg = '';
    }
} else {
    $no_mrg_pdg = '';
}

// Section Mode
if ($section_mode=="normal") { $row_class = 'row'; $section_mode = 'container'; }
if ($section_mode=="fluid") { $row_class = 'row'; $section_mode = 'container-fluid'; }
if ($section_mode=="full-screen") { $row_class = 'row content-full-screen'; $section_mode = 'container-fluid full-screen'; $section_class = 'section-full-area '.$section_class.''; }

// BG Mode
$img_id = preg_replace('/[^\d]/', '', $image);
$image_string = wp_get_attachment_image_src( $img_id, 'full');
$image_string = $image_string[0];

// Pattern Mode
$pattern_id = preg_replace('/[^\d]/', '', $pattern);
$pattern_string = wp_get_attachment_image_src( $pattern_id, 'full');
$pattern_string = $pattern_string[0];

$pattern_output = null;
if ($bgmode=="customimagebg" || $bgmode=="custom") {
    if(!empty($pattern)) { $pattern_output .= '<span class="section-overlay-pattern" style="background-image: url('.$pattern_string.');"></span>'; } else { $pattern_output = ''; }
} else if($bgmode=="video") {
    if(!empty($pattern)) { $pattern_output .= '<span class="video-overlay-pattern" style="background-image: url('.$pattern_string.');"></span>'; } else { $pattern_output = ''; }
} else { 
    $pattern_output = ''; 
}

$bgposition = str_replace("_", " ", $bgposition);
$img_bg = null;

if ($bgmode=="default" && $padding=="custom-padding") { $bgmode = ' style="padding-top: '.$padding_top_value.'px; padding-bottom: '.$padding_bottom_value.'px;"'; }
else if ($bgmode=="default") { $bgmode = ''; }

if ($bgmode=="custom" && $padding=="custom-padding") { $bgmode = ' style="background-color: '.$custombgcolor.'; padding-top: '.$padding_top_value.'px; padding-bottom: '.$padding_bottom_value.'px;"'; } 
else if ($bgmode=="custom") { $bgmode = ' style="background-color: '.$custombgcolor.';"'; }

if ($bgrepeat=="stretch") { $bgrepeat = 'background-repeat: no-repeat; background-size: cover;'; } 
else { $bgrepeat = 'background-repeat: '.$bgrepeat.';'; }

if ($bgmode=="customimagebg" && $padding=="custom-padding") {
    $bgimagebackgrouncolor =  (!empty($bgimagebackgrouncolor) ? 'background-color: '.$bgimagebackgrouncolor.'; ' : '');
    $bgmode = ' style="'.$bgimagebackgrouncolor.'background-attachment: '.$bgattachment.'; background-position: '.$bgposition.'; '.$bgrepeat.' background-image: url('.$image_string.'); padding-top: '.$padding_top_value.'px; padding-bottom: '.$padding_bottom_value.'px;"'; $img_bg = 'image-cont'; 
}
else if ($bgmode=="customimagebg") { 
    $bgimagebackgrouncolor =  (!empty($bgimagebackgrouncolor) ? 'background-color: '.$bgimagebackgrouncolor.'; ' : '');
    $bgmode = ' style="'.$bgimagebackgrouncolor.'background-attachment: '.$bgattachment.'; background-position: '.$bgposition.'; '.$bgrepeat.' background-image: url('.$image_string.');"'; $img_bg = 'image-cont';
}

$videoOutput = null;
$videoLoopOutput = null;

if ($disable_video_loop==true) {
    $videoLoopOutput = '';
} else {
    $videoLoopOutput = 'loop';
}

if ($bgmode=="video" && $padding=="custom-padding") {
    $v_image = wp_get_attachment_url($customimagevideo);
    $bgmode = ' style="padding-top: '.$padding_top_value.'px; padding-bottom: '.$padding_bottom_value.'px;"';
    $customvideoembed =  rawurldecode(base64_decode(strip_tags($customvideoembed)));

     if(!empty($customvideoembed)) {  
        $videoOutput .= '<div class="video-section-container">';
        if($video_overlay == "show_video_overlay"){
            $videoOutput .= '<div class="video-overlay" style="background-color:'.$video_color_overlay.';"></div>';
        }
        $videoOutput .= '<div class="video-embed-wrap">'.$customvideoembed.'</div></div>';

     } else {
        $videoOutput .= '<div class="video-section-container">';
                    if($video_overlay == "show_video_overlay"){
                        $videoOutput .= '<div class="video-overlay" style="background-color:'.$video_color_overlay.';"></div>';
                    }
        $videoOutput .= '<div class="mobile-video-image" style="background-image: url('.$v_image.'); background-size: cover; background-position: center center;"></div>
                            <div class="video-wrap">
                                <video class="video" preload="auto" '.$videoLoopOutput.' autoplay width="1920" height="800" poster="'.$v_image.'">';
                                    if(!empty($customvideowebm)) { $videoOutput .= '<source type="video/webm" src="'.$customvideowebm.'">'; }
                                    if(!empty($customvideom4v)) { $videoOutput .= '<source type="video/mp4" src="'.$customvideom4v.'">'; }
                                    if(!empty($customvideoogv)) { $videoOutput .= '<source type="video/ogg" src="'.$customvideoogv.'">'; }
        $videoOutput .= '       </video>
                            </div>
                        </div>';
     }

} 
else if ($bgmode=="video") { 
    $bgmode = ''; 
    $v_image = wp_get_attachment_url($customimagevideo);
    $customvideoembed =  rawurldecode(base64_decode(strip_tags($customvideoembed)));
    
    if(!empty($customvideoembed)) {  
        $videoOutput .= '<div class="video-section-container">';
        if($video_overlay == "show_video_overlay"){
            $videoOutput .= '<div class="video-overlay" style="background-color:'.$video_color_overlay.';"></div>';
        }
        $videoOutput .= '<div class="video-embed-wrap">'.$customvideoembed.'</div></div>';

    } else {
        $videoOutput .= '<div class="video-section-container">';
                    if($video_overlay == "show_video_overlay"){
                        $videoOutput .= '<div class="video-overlay" style="background-color:'.$video_color_overlay.';"></div>';
                    }
        $videoOutput .= '<div class="mobile-video-image" style="background-image: url('.$v_image.'); background-size: cover; background-position: center center;"></div>
                            <div class="video-wrap">
                                <video class="video" preload="auto" '.$videoLoopOutput.' autoplay width="1920" height="800" poster="'.$v_image.'">';
                                    if(!empty($customvideowebm)) { $videoOutput .= '<source type="video/webm" src="'.$customvideowebm.'">'; }
                                    if(!empty($customvideom4v)) { $videoOutput .= '<source type="video/mp4" src="'.$customvideom4v.'">'; }
                                    if(!empty($customvideoogv)) { $videoOutput .= '<source type="video/ogg" src="'.$customvideoogv.'">'; }
        $videoOutput .= '       </video>
                            </div>
                        </div>';
    }
}

$sectionMaskOverlay = null;
if ($section_overlay == "yes_overlay") {
    $sectionMaskOverlay = '<span class="section-overlay-mask" style="background-color: '.$sectionoveralycolor.';"></span>';
}

$scrBtn = null;
if ($scroll_button==true) {
    $srcBtn = '<a href="#'.$scroll_id.'" class="scroll-btn-full-area"><i class="scroll-btn-down-icon animated-opacity"></i></a>';
} else {
    $srcBtn = '';
}

// Set ID and Classes
$el_class = $this->getExtraClass($el_class);
$section_id_Value = (!empty($section_id) ? ' id="'.$section_id.'"' : '');
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $row_class.(!empty($el_class) ? ' '.$el_class : ''), $this->settings['base']);
$class = setClass(array('main-content', $img_bg, $no_mrg_pdg, $section_class, $padding, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

// Output
$output .= '
<section'.$section_id_Value.$class.$bgmode.'>'.$pattern_output.$srcBtn.$videoOutput.$sectionMaskOverlay.'';
$output .= '
<div class="'.$section_mode.'">';
$output .= '
<div class="'.$css_class.'">';
$output .= 
wpb_js_remove_wpautop($content);
$output .= '
</div>';
$output .= '
</div>';
$output .= '
</section>'.$this->endBlockComment('row');

echo $output;