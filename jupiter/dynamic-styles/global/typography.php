<?php
global $mk_options;

//TODO : Refactor this code.

$google_font_2 = $google_font_1 = $typekit_fonts_1 = $typekit_fonts_2 = $safefont_css_1 = $safefont_css_2 = '';

$special_elements_1_list = isset($mk_options['special_elements_1']) ? $mk_options['special_elements_1'] : '';
$special_elements_2_list = isset($mk_options['special_elements_2']) ? $mk_options['special_elements_2'] : '';

function mk_strstr($haystack, $needle, $before_needle = false) {
    if (!$before_needle) return strstr($haystack, $needle);
    else return substr($haystack, 0, strpos($haystack, $needle));
}

/**
 * Typekit fonts
 *
 */

$typekit_id = isset($mk_options['typekit_id']) ? $mk_options['typekit_id'] : '';
$typekit_elements_list_1 = isset($mk_options['typekit_elements_1']) ? $mk_options['typekit_elements_1'] : '';
$typekit_font_family_1 = isset($mk_options['typekit_font_family_1']) ? $mk_options['typekit_font_family_1'] : '';

if ($typekit_id != '' && $typekit_elements_list_1 != '' && $typekit_font_family_1 != '') {
    if (is_array($typekit_elements_list_1)) {
        $typekit_elements_list_1 = implode(', ', $typekit_elements_list_1);
    } 
    else {
        $typekit_elements_list_1 = $typekit_elements_list_1;
    }
    $typekit_fonts_1 = $typekit_elements_list_1 . ' {font-family: "' . $typekit_font_family_1 . '"}';
}

$typekit_elements_list_2 = isset($mk_options['typekit_elements_2']) ? $mk_options['typekit_elements_2'] : '';
$typekit_font_family_2 = isset($mk_options['typekit_font_family_2']) ? $mk_options['typekit_font_family_2'] : '';

if ($typekit_id != '' && $typekit_elements_list_2 != '' && $typekit_font_family_2 != '') {
    if (is_array($typekit_elements_list_2)) {
        $typekit_elements_list_2 = implode(', ', $typekit_elements_list_2);
    } 
    else {
        $typekit_elements_list_2 = $typekit_elements_list_2;
    }
    $typekit_fonts_2 = $typekit_elements_list_2 . ' {font-family: "' . $typekit_font_family_2 . '"}';
}

/**
 * Google Fonts
 *
 */
if (is_array($special_elements_1_list)) {
    $special_elements_1 = implode(', ', $special_elements_1_list);
} 
else {
    $special_elements_1 = $special_elements_1_list;
}

if (is_array($special_elements_2_list)) {
    $special_elements_2 = implode(', ', $special_elements_2_list);
} 
else {
    $special_elements_2 = $special_elements_2_list;
}

if ($special_elements_1 && $mk_options['special_fonts_type_1'] == 'google') {
    
    $google_font_1 = $special_elements_1 . ' {font-family: "';
    
    $format_name1 = strpos($mk_options['special_fonts_list_1'], ':');
    if ($format_name1 !== false) {
        $google_font_1.= mk_strstr(str_replace('+', ' ', $mk_options['special_fonts_list_1']) , ':', true);
    } 
    else {
        $google_font_1.= str_replace('+', ' ', $mk_options['special_fonts_list_1']);
    }
    
    $google_font_1.= '" }';
}

if ($special_elements_2 && $mk_options['special_fonts_type_2'] == 'google') {
    $google_font_2 = $special_elements_2 . ' {font-family: "';
    
    $format_name2 = strpos($mk_options['special_fonts_list_2'], ':');
    if ($format_name2 !== false) {
        $google_font_2.= mk_strstr(str_replace('+', ' ', $mk_options['special_fonts_list_2']) , ':', true);
    } 
    else {
        $google_font_2.= str_replace('+', ' ', $mk_options['special_fonts_list_2']);
    }
    
    $google_font_2.= '"}';
}


if (isset($mk_options['special_fonts_type_1']) && ($mk_options['special_fonts_type_1'] == 'safe_font')) {
    $safefont_1 = $mk_options['special_fonts_list_1'];

    if ( is_array( $mk_options['special_elements_1'] ) ) {
        $special_elements_1 = implode( ', ', $mk_options['special_elements_1'] );
    } else {
        $special_elements_1 = $mk_options['special_elements_1'];
    }

    if ( $special_elements_1 && $safefont_1 ) {
        $safefont_css_1 = $special_elements_1 . '{ font-family: ' . $safefont_1.'}';
    }

}


if (isset($mk_options['special_fonts_type_2']) && ($mk_options['special_fonts_type_2'] == 'safe_font')) {
    $safefont_2 = $mk_options['special_fonts_list_2'];
    
    if ( is_array( $special_elements_2_list ) ) {
        $special_elements_2 = implode( ', ', $special_elements_2_list );
    } else {
        $special_elements_2 = $special_elements_2_list;
    }

    if ( $special_elements_2 && $safefont_2 ) {
        $safefont_css_2 = $special_elements_2 . '{ font-family: ' . $safefont_2.'}';
    }

}


$safe_font = $mk_options['font_family'] ? 'body {font-family: ' . stripslashes($mk_options['font_family']) . ';}' : '';

Mk_Static_Files::addGlobalStyle("
{$safe_font}
{$google_font_1}
{$google_font_2}
{$safefont_css_1}
{$safefont_css_2}
{$typekit_fonts_1}
{$typekit_fonts_2}
");



