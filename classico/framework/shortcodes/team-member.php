<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! team_member
// **********************************************************************// 

add_shortcode('team_member','etheme_team_member_shortcode');

function etheme_team_member_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => '',
        'type' => 1,
        'name' => '',
        'email' => '',
        'twitter' => '',
        'facebook' => '',
        'skype' => '',
        'linkedin' => '',
        'instagram' => '',
        'position' => '',
        'content' => '',
        'img' => '',
        'img_src' => '',
        'img_size' => '270x170'
    ), $atts);

    $src = '';

    $img_size = explode('x', $a['img_size']);

    $width = $img_size[0];
    $height = $img_size[1];

    if($a['img'] != '') {
        $src = etheme_get_image($a['img'], $width, $height);
    }elseif ($a['img_src'] != '') {
        $src = do_shortcode($a['img_src']);
    }

    if ($a['content'] != '') {
        $content = $a['content'];
    }

    
    $html = '';
    $span = 12;
    $html .= '<div class="team-member member-type-'.$a['type'].' '.$a['class'].'">';

        if($a['type'] == 2) {
            $html .= '<div class="row">';
        }
	    if($src != ''){

            if($a['type'] == 2) {
                $html .= '<div class="col-md-6">';
                $span = 6;
            }
            $html .= '<div class="member-image">';
                $html .= '<img src="'.$src.'" />';
	            if ($a['linkedin'] != '' || $a['twitter'] != '' || $a['facebook'] != '' || $a['skype'] != '' || $a['instagram'] != '') {
	                $html .= '<div class="member-content"><ul class="menu-social-icons">';
	                    $html .= '';
	                        if ($a['linkedin'] != '') {
	                            $html .= '<li><a href="'.$a['linkedin'].'"><i class="ico-linkedin"></i><svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle"><circle cx="19" cy="19" r="18" fill="#fff" stroke="#000000"></circle></svg></a></li>';
	                        }
	                        if ($a['twitter'] != '') {
	                            $html .= '<li><a href="'.$a['twitter'].'"><i class="ico-twitter"></i><svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle"><circle cx="19" cy="19" r="18" fill="#fff" stroke="#000000"></circle></svg></a></li>';
	                        }
	                        if ($a['facebook'] != '') {
	                            $html .= '<li><a href="'.$a['facebook'].'"><i class="ico-facebook"></i><svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle"><circle cx="19" cy="19" r="18" fill="#fff" stroke="#000000"></circle></svg></a></li>';
	                        }
	                        if ($a['skype'] != '') {
	                            $html .= '<li><a href="'.$a['skype'].'"><i class="ico-skype"></i><svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle"><circle cx="19" cy="19" r="18" fill="#fff" stroke="#000000"></circle></svg></a></li>';
	                        }
	                        if ($a['instagram'] != '') {
	                            $html .= '<li><a href="'.$a['instagram'].'"><i class="ico-instagram"></i><svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle"><circle cx="19" cy="19" r="18" fill="#fff" stroke="#000000"></circle></svg></a></li>';
	                        }
	                $html .= '</ul></div>';
	            }
            $html .= '</div>';
            $html .= '<div class="clear"></div>';
            if($a['type'] == 2) {
                $html .= '</div>';
            }		      
	    }

    
        if($a['type'] == 2) {
            $html .= '<div class="col-md-'.$span.'">';
        }
        $html .= '<div class="member-details">';
            if($a['position'] != ''){
                $html .= '<h4>'.$a['name'].'</h4>';
            }

		    if($a['name'] != ''){
			    $html .= '<h5 class="member-position">'.$a['position'].'</h5>';
		    }

            if($a['email'] != ''){
                $html .= '<p class="member-email"><span>'.__('Email:', ET_DOMAIN).'</span> <a href="'.$a['email'].'">'.$a['email'].'</a></p>';
            }
		    $html .= do_shortcode($content);
    	$html .= '</div>';

        if($a['type'] == 2) {
                $html .= '</div>';
            $html .= '</div>';
        }
    $html .= '</div>';
    
    
    return $html;
}

// **********************************************************************// 
// ! Register New Element: team_member
// **********************************************************************//
add_action( 'init', 'et_register_vc_team_member');
if(!function_exists('et_register_vc_team_member')) {
	function et_register_vc_team_member() {
		if(!function_exists('vc_map')) return;
	    $team_member_params = array(
	      'name' => '[8theme] Team member',
	      'base' => 'team_member',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          'type' => 'textfield',
	          "heading" => __("Member name", ET_DOMAIN),
	          "param_name" => "name"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Member email", ET_DOMAIN),
	          "param_name" => "email"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Position", ET_DOMAIN),
	          "param_name" => "position"
	        ),
	        array(
	          'type' => 'attach_image',
	          "heading" => __("Avatar", ET_DOMAIN),
	          "param_name" => "img"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Image size", "js_composer"),
	          "param_name" => "img_size",
	          "description" => __("Enter image size. Example in pixels: 200x100 (Width x Height).", "js_composer")
	        ),
	        array(
	          "type" => "textarea_html",
	          "holder" => "div",
	          "heading" => __("Member information", "js_composer"),
	          "param_name" => "content",
	          "value" => __("Member description", "js_composer")
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Display Type", "js_composer"),
	          "param_name" => "type",
	          "value" => array( 
	              "", 
	              __("Vertical", ET_DOMAIN) => 1,
	              __("Horizontal", ET_DOMAIN) => 2
	            )
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Twitter link", ET_DOMAIN),
	          "param_name" => "twitter"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Facebook link", ET_DOMAIN),
	          "param_name" => "facebook"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Linkedin", ET_DOMAIN),
	          "param_name" => "linkedin"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Skype name", ET_DOMAIN),
	          "param_name" => "skype"
	        ),
	        array(
	          'type' => 'textfield',
	          "heading" => __("Instagram", ET_DOMAIN),
	          "param_name" => "instagram"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ET_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ET_DOMAIN)
	        )
	      )
	
	    );  
	    vc_map($team_member_params);
	}
}
