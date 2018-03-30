<?php
function zorka_custom_css() {
    $zorka_data = of_get_options();
    $custom_css = '';

    /* body tag style*/
    $background_image = '';
    if ($zorka_data['use-bg-image'] == '1' && $zorka_data['layout-style'] == 'boxed')
    {
        $background_image_url = '';
        if (isset($zorka_data['bg-pattern-upload']) && $zorka_data['bg-pattern-upload'] != '')
        {
            $background_image_url = $zorka_data['bg-pattern-upload'];
        }
        else if (isset($zorka_data['bg-pattern']) && $zorka_data['bg-pattern'] != '')
        {
            $background_image_url = $zorka_data['bg-pattern'];
        }

        if ($background_image_url != '')
        {
            $background_image .= 'background-image: url("'. $background_image_url .'");';
            $background_image .= 'background-repeat: '. $zorka_data['bg-repeat'] .';';
            $background_image .= 'background-position: '. $zorka_data['bg-position'] .';';
            $background_image .= 'background-attachment: '. $zorka_data['bg-attachment'] .';';
            $background_image .= 'background-size: '. $zorka_data['bg-size'] .';';
        }
    }
    /*end body tag style*/

    if (!empty($background_image)) {
        $custom_css.= 'body.boxed{'.$background_image.'}';
    }



    $custom_css .='body{font-family:' . $zorka_data['body-font']['face'] . '; font-size: ' . $zorka_data['body-font']['size'] . ';font-weight:' .$zorka_data['body-font']['weight'] . ';}';



    if (!empty($zorka_data['heading-font']['face']) &&  $zorka_data['heading-font']['face'] != 'none')
    {
        $custom_css .= 'h1,h2,h3,h4,h5,h6{font-family: '. $zorka_data['heading-font']['face'] .';}';
    }

    if (!empty($zorka_data['h1-font']['face']) && $zorka_data['h1-font']['face'] != 'none')
    {
        $custom_css .= 'h1{font-family: '. $zorka_data['h1-font']['face'] .';font-size: '. $zorka_data['h1-font']['size'] .';font-style: '. $zorka_data['h1-font']['style'] .';font-weight: '. $zorka_data['h1-font']['weight'] .';text-transform: '. $zorka_data['h1-font']['text-transform'] .';}';
    }
    else
    {
        $custom_css .= 'h1{font-size: '. $zorka_data['h1-font']['size'] .';font-style: '. $zorka_data['h1-font']['style'] .';font-weight: '. $zorka_data['h1-font']['weight'] .';text-transform: '. $zorka_data['h1-font']['text-transform'] .';}';
    }

    if (!empty($zorka_data['h2-font']['face']) && $zorka_data['h2-font']['face'] != 'none')
    {
        $custom_css .= 'h2{font-family: '. $zorka_data['h2-font']['face'] .';font-size: '. $zorka_data['h2-font']['size'] .';font-style: '. $zorka_data['h2-font']['style'] .';font-weight: '. $zorka_data['h2-font']['weight'] .';text-transform: '. $zorka_data['h2-font']['text-transform'] .';}';
    }
    else
    {
        $custom_css .= 'h2{font-size: '. $zorka_data['h2-font']['size'] .';font-style: '. $zorka_data['h2-font']['style'] .';font-weight: '. $zorka_data['h2-font']['weight'] .';text-transform: '. $zorka_data['h2-font']['text-transform'] .';}';
    }

    if (!empty($zorka_data['h3-font']['face']) && $zorka_data['h3-font']['face'] != 'none')
    {
        $custom_css .= 'h3{font-family: '. $zorka_data['h3-font']['face'] .';font-size: '. $zorka_data['h3-font']['size'] .';font-style: '. $zorka_data['h3-font']['style'] .';font-weight: '. $zorka_data['h3-font']['weight'] .';text-transform: '. $zorka_data['h3-font']['text-transform'] .';}';
    }
    else
    {
        $custom_css .= 'h3{font-size: '. $zorka_data['h3-font']['size'] .';font-style: '. $zorka_data['h3-font']['style'] .';font-weight: '. $zorka_data['h3-font']['weight'] .';text-transform: '. $zorka_data['h3-font']['text-transform'] .';}';
    }

    if (!empty($zorka_data['h4-font']['face']) && $zorka_data['h4-font']['face'] != 'none')
    {
        $custom_css .= 'h4{font-family: '. $zorka_data['h4-font']['face'] .';font-size: '. $zorka_data['h4-font']['size'] .';font-style: '. $zorka_data['h4-font']['style'] .';font-weight: '. $zorka_data['h4-font']['weight'] .';text-transform: '. $zorka_data['h4-font']['text-transform'] .';}';
    }
    else
    {
        $custom_css .= 'h4{font-size: '. $zorka_data['h4-font']['size'] .';font-style: '. $zorka_data['h4-font']['style'] .';font-weight: '. $zorka_data['h4-font']['weight'] .';text-transform: '. $zorka_data['h4-font']['text-transform'] .';}';
    }

    if (!empty($zorka_data['h5-font']['face']) && $zorka_data['h5-font']['face'] != 'none')
    {
        $custom_css .= 'h5{font-family: '. $zorka_data['h5-font']['face'] .';font-size: '. $zorka_data['h5-font']['size'] .';font-style: '. $zorka_data['h5-font']['style'] .';font-weight: '. $zorka_data['h5-font']['weight'] .';text-transform: '. $zorka_data['h5-font']['text-transform'] .';}';
    }
    else
    {
        $custom_css .= 'h5{font-size: '. $zorka_data['h5-font']['size'] .';font-style: '. $zorka_data['h5-font']['style'] .';font-weight: '. $zorka_data['h5-font']['weight'] .';text-transform: '. $zorka_data['h5-font']['text-transform'] .';}';
    }

    if (!empty($zorka_data['h6-font']['face']) && $zorka_data['h6-font']['face'] != 'none')
    {
        $custom_css .= 'h6{font-family: '. $zorka_data['h6-font']['face'] .';font-size: '. $zorka_data['h6-font']['size'] .';font-style: '. $zorka_data['h6-font']['style'] .';font-weight: '. $zorka_data['h6-font']['weight'] .';text-transform: '. $zorka_data['h6-font']['text-transform'] .';}';
    }
    else
    {
        $custom_css .= 'h6{font-size: '. $zorka_data['h6-font']['size'] .';font-style: '. $zorka_data['h6-font']['style'] .';font-weight: '. $zorka_data['h6-font']['weight'] .';text-transform: '. $zorka_data['h6-font']['text-transform'] .';}';
    }




	$custom_css .=  $zorka_data['css-custom'] ;
	// Remove all newline & tab characters
    $custom_css = str_replace( "\r\n", '', $custom_css );
	$custom_css = str_replace( "\n", '', $custom_css );
	$custom_css = str_replace( "\t", '', $custom_css );
	return $custom_css;
}