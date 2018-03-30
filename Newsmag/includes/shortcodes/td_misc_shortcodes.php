<?php

// quote
function td_quote_center($atts, $content = null) {
    return '<blockquote><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('quote_center', 'td_quote_center');


function td_quote_right($atts, $content = null) {
    return '<blockquote class="td_quote td_quote_right"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('quote_right', 'td_quote_right');


function td_quote_left($atts, $content = null) {
    return '<blockquote class="td_quote td_quote_left"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('quote_left', 'td_quote_left');


function td_quote_box_center($atts, $content = null) {
    return '<blockquote class="td_quote_box td_box_center"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('quote_box_center', 'td_quote_box_center');


function td_quote_box_left($atts, $content = null) {
    return '<blockquote class="td_quote_box td_box_left"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('quote_box_left', 'td_quote_box_left');


function td_quote_box_right($atts, $content = null) {
    return '<blockquote class="td_quote_box td_box_right"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('quote_box_right', 'td_quote_box_right');


function td_pull_quote_center($atts, $content = null) {
    return '<blockquote class="td_pull_quote td_pull_center"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('pull_quote_center', 'td_pull_quote_center');


function td_pull_quote_left($atts, $content = null) {
    return '<blockquote class="td_pull_quote td_pull_left"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('pull_quote_left', 'td_pull_quote_left');


function td_pull_quote_right($atts, $content = null) {
    return '<blockquote class="td_pull_quote td_pull_right"><p>' . $content . '</p></blockquote>' ;
}
add_shortcode('pull_quote_right', 'td_pull_quote_right');


//dropcaps
function td_dropcap($atts, $content = null) {
    extract(shortcode_atts(
            array(
                'label' => '', /* the text */
                'bg_color' => '', /* empty for default color OR color profile OR custom #color */
                'text_color' => '', /* empty for default color OR color profile OR custom #color */
                'type' => '' /* empty = default type, 1 and 2 and 3 */
            ),
            $atts
        )
    );

    $style_output = '';

    //bg-color
    if ($bg_color != '') {
        $style_output .= 'background-color:' . $bg_color . '; ';
    }

    //text-color
    if ($text_color != '') {
        $style_output .= 'color:' . $text_color . '; ';
    }

    //parse the style
    if (!empty($style_output)) {
        $style_output = ' style="' . $style_output . '"';
    }

    //parse the label
    if (!empty($content)) {
        $label = $content;
    }


    $class_output = '';
    switch ($type) {
        case '1':
            $class_output .= 'dropcap1 ';
            break;

        case '2':
            $class_output .= 'dropcap2 ';
            break;
        case '3':
            $class_output .= 'dropcap3 ';
            break;

        case '4':
            $class_output .= 'dropcap4 ';
            break;
    }


    return '<span class="dropcap ' . $class_output . '"' . $style_output . '>' . $label . '</span>';
}
add_shortcode('dropcap', 'td_dropcap');



//button
function td_button($atts, $content = null) {
	extract(shortcode_atts(
			array(
				'label' => '', /* text button */
				'color' => '', /* button color */
				'size' => '', /* empty for default size or */
				'type' => '', /* empty for default type or */
				'target' => '', /* empty for _self or */
				'link' => '' /* empty for # or */
			),
			$atts
		)
	);

	$style_output = '';

	// color
	if ($color != '') {
		$style_output .= 'vc_btn-' . $color . ' ';
	} else {
		$style_output .= 'vc_btn-black ';
	}

	// size
	switch ($size) {
		case 'mini':
			$size = 'vc_btn-xs ';
			break;

		case 'small':
			$size = 'vc_btn-sm ';
			break;

		case 'large':
			$size = 'vc_btn-lg ';
			break;

		case 'normal':
			$size = 'vc_btn-md ';
			break;

		default:
			$size = 'vc_btn-sm ';
	}
	$style_output .= $size;

	// type
	if ($type != '') {
		$style_output .= 'vc_btn_' . $type . ' ';
	} else {
		$style_output .= 'vc_btn_rounded ';
	}

	// target
	if ($target != '') {
		$target = 'target="' . $target . '" ';
	} else {
		$target = '';
	}

	// link
	if ($link != '') {
		$link = 'href="' . $link . '" ';
	} else {
		$link = 'href="#"';
	}

	//parse the style
	if (!empty($style_output)) {
		$style_output = ' class="vc_btn ' . $style_output . '" ' . $target . $link;
	}

	//parse the label
	if (!empty($content)) {
		$label = $content;
	}


	return '<a ' . $style_output . '>' . $label . '</a>';
}
add_shortcode('button', 'td_button');