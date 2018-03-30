<?php
$typography_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_fonts",
    "name" => __("Typography / Fonts", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __('Body Font-Family', "mk_framework") ,
            "id" => "font_family",
            "desc" => __("Please choose the safe font family. This font family will be used as backup font (If the below none-safe fonts failed to load for any reason) and be applied to all site elements.", "mk_framework") ,
            "default" => '',
            "options" => array(
                'HelveticaNeue-Light, Helvetica Neue Light, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif' => 'HelveticaNeue-Light, Helvetica Neue Light, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif',
                'Arial Black, Gadget, sans-serif' => 'Arial Black, Gadget, sans-serif',
                'Bookman Old Style, serif' => 'Bookman Old Style, serif',
                'Comic Sans MS, cursive' => 'Comic Sans MS, cursive',
                'Courier, monospace' => 'Courier, monospace',
                'Courier New, Courier, monospace' => 'Courier New, Courier, monospace',
                'Garamond, serif' => 'Garamond, serif',
                'Georgia, serif' => 'Georgia, serif',
                'Impact, Charcoal, sans-serif' => 'Impact, Charcoal, sans-serif',
                'Lucida Console, Monaco, monospace' => 'Lucida Console, Monaco, monospace',
                'Lucida Sans, Lucida Grande, Lucida Sans Unicode, sans-serif' => 'Lucida Grande, Lucida Sans, Lucida Sans Unicode, sans-serif',
                'HelveticaNeue-Light, Helvetica Neue Light, Helvetica Neue, sans-serif' => 'HelveticaNeue-Light, Helvetica Neue Light, Helvetica Neue, sans-serif',
                'MS Sans Serif, Geneva, sans-serif' => 'MS Sans Serif, Geneva, sans-serif',
                'MS Serif, New York, sans-serif' => 'MS Serif, New York, sans-serif',
                'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype, Book Antiqua, Palatino, serif',
                'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif' => 'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif' => 'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif' => 'Verdana, Geneva, sans-serif'
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "heading" => '<img src="' . THEME_ADMIN_ASSETS_URI . '/images/typography-google-fonts.png" />',
            "title" => __("Font Family 1", "mk_framework") ,
            "type" => "groupset",
            "fields" => array(
                
                array(
                    "name" => __("Choose a font", "mk_framework") ,
                    "id" => "special_fonts_list_1",
                    "desc" => __("Choose your font family name.", "mk_framework") ,
                    "default" => 'Open+Sans',
                    "type" => "font_family"
                ) ,
                array(
                    "id" => __("special_fonts_type_1", "mk_framework") ,
                    "default" => 'google',
                    "type" => "hidden_input"
                ) ,
                array(
                    "name" => __("Google Font character sets", "mk_framework") ,
                    "desc" => __("Please choose your desired character sets hers as a comma separated list. This option is going to work if you choose Google Fonts and need to have glyphs other than English.", "mk_framework") ,
                    "id" => "google_font_subset_1",
                    "default" => '',
                    "options" => array(
                        'latin' => 'latin',
                        'latin-ext' => 'latin-ext',
                        'cyrillic-ext' => 'cyrillic-ext',
                        'greek-ext' => 'greek-ext',
                        'greek' => 'greek',
                        'vietnamese' => 'vietnamese',
                        'cyrillic' => 'cyrillic',
                    ) ,
                    "type" => "dropdown"
                ) ,
                
                array(
                    "name" => __("Site Elements to Set.", "mk_framework") ,
                    "desc" => __("Please choose elements that you would to set for the above font family. setting it to Body will affect all elements.", "mk_framework") ,
                    "id" => "special_elements_1",
                    "default" => array(
                        'body'
                    ) ,
                    "type" => "css_class_selector"
                ) ,
            )
        ) ,
        
        array(
            "heading" => '<img src="' . THEME_ADMIN_ASSETS_URI . '/images/typography-google-fonts.png" />',
            "title" => __("Font Family 2", "mk_framework") ,
            "type" => "groupset",
            "fields" => array(
                
                array(
                    "name" => __("Choose a font", "mk_framework") ,
                    "id" => "special_fonts_list_2",
                    "desc" => __("Choose your font family name.", "mk_framework") ,
                    "default" => '',
                    "type" => "font_family"
                ) ,
                array(
                    "id" => "special_fonts_type_2",
                    "default" => 'google',
                    "type" => "hidden_input"
                ) ,
                array(
                    "name" => __("Google Font character sets", "mk_framework") ,
                    "desc" => __("Please choose your desired character sets hers as a comma separated list. This option is going to work if you choose Google Fonts and need to have glyphs other than English.", "mk_framework") ,
                    "id" => "google_font_subset_2",
                    "default" => '',
                    "options" => array(
                        'latin' => 'latin',
                        'latin-ext' => 'latin-ext',
                        'cyrillic-ext' => 'cyrillic-ext',
                        'greek-ext' => 'greek-ext',
                        'greek' => 'greek',
                        'vietnamese' => 'vietnamese',
                        'cyrillic' => 'cyrillic',
                    ) ,
                    "type" => "dropdown"
                ) ,
                array(
                    "name" => __("Site Elements to Set.", "mk_framework") ,
                    "desc" => __("Please choose elements that you would to set for the above font family. setting it to Body will affect all elements.", "mk_framework") ,
                    "id" => "special_elements_2",
                    "default" => array() ,
                    "type" => "css_class_selector"
                ) ,
            )
        ) ,
        
        array(
            "heading" => '<img src="' . THEME_ADMIN_ASSETS_URI . '/images/typekit.png" />',
            "title" => __("Font Family 3", "mk_framework") ,
            "type" => "groupset",
            "fields" => array(
                
                array(
                    "name" => __("Choose a font", "mk_framework") ,
                    "desc" => __("Type the name of the font family you have picked from typekit library.", "mk_framework") ,
                    "id" => "typekit_font_family_1",
                    "default" => "",
                    "type" => "text"
                ) ,
                
                array(
                    "name" => __("Site Elements to Set.", "mk_framework") ,
                    "desc" => __("Please choose elements that you would to set for the above font family. setting it to Body will set it all elements.", "mk_framework") ,
                    "id" => "typekit_elements_1",
                    "default" => array() ,
                    "type" => "css_class_selector"
                ) ,
            )
        ) ,
        
        array(
            "title" => __("Font Family 4", "mk_framework") ,
            "heading" => '<img src="' . THEME_ADMIN_ASSETS_URI . '/images/typekit.png" /><span class="mk-groupset-desc">',
            "type" => "groupset",
            "fields" => array(
            array(
                
                "name" => __("Choose a font", "mk_framework") ,
                "desc" => __("Type the name of the font family you have picked from typekit library.", "mk_framework") ,
                "id" => "typekit_font_family_2",
                "default" => "",
                "type" => "text"
            ) ,
            array(
                "name" => __("Site Elements to Set.", "mk_framework") ,
                "desc" => __("Please choose elements that you would to set for the above font family. setting it to Body will set it all elements.", "mk_framework") ,
                "id" => "typekit_elements_2",
                "default" => array() ,
                "type" => "css_class_selector"
            ) ,
        )
    ) ,
) ,);
