<?php

$elementsPage = new EdgeAdminPage("6", "Elements", "fa fa-flag-o");
$edgtFramework->edgtOptions->addAdminPage("elementsPage",$elementsPage);

//Accordions and Toogles

$panel29 = new EdgePanel("Accordions and Toggles","accordions_toogles_panel");
$elementsPage->addChild("panel29",$panel29);		

$accordion_regular_subtitle = new EdgeTitle("accordion_regular_subtitle", "Accordion & Toggle Title");
$panel29->addChild("accordion_regular_subtitle", $accordion_regular_subtitle);

$group4= new EdgeGroup("Title Style", "Define Accordion & Toggle Title style");    
$panel29->addChild("group4", $group4);

    $row1 = new EdgeRow(true);
    $group4->addChild("row1",$row1);
    
        $accordion_regular_title_color = new EdgeField("colorsimple","accordion_regular_title_color","","Color","This is some description");
        $row1->addChild("accordion_regular_title_color",$accordion_regular_title_color); 
        
        $accordion_regular_title_hover_color = new EdgeField("colorsimple","accordion_regular_title_hover_color","","Hover Color","This is some description");
        $row1->addChild("accordion_regular_title_hover_color",$accordion_regular_title_hover_color); 

$accordion_toogle_subtitle = new EdgeTitle("accordion_toogle_subtitle", "Accordion & Toggle Boxed Title");
$panel29->addChild("accordion_toogle_subtitle", $accordion_toogle_subtitle);
		
$group1= new EdgeGroup("Title Style", "Define Accordion & Toggle Boxed Title style"); 
$panel29->addChild("group1", $group1);

    $row1 = new EdgeRow(true);
    $group1->addChild("row1",$row1);
    
        $accordion_toogle_title_color = new EdgeField("colorsimple","accordion_toogle_title_color","","Color","This is some description");
        $row1->addChild("accordion_toogle_title_color",$accordion_toogle_title_color); 
        
        $accordion_toogle_title_hover_color = new EdgeField("colorsimple","accordion_toogle_title_hover_color","","Hover Color","This is some description");
        $row1->addChild("accordion_toogle_title_hover_color",$accordion_toogle_title_hover_color); 


$accordion_toogle_mark_subtitle = new EdgeTitle("accordion_toogle_mark_subtitle", "Accordion & Toggle Mark");
$panel29->addChild("accordion_toogle_mark_subtitle", $accordion_toogle_mark_subtitle);
	
$group2= new EdgeGroup("Mark Style", "Define mark style");
$panel29->addChild("group2", $group2);

	$row1 = new EdgeRow(true);
    $group2->addChild("row1",$row1);
	
		$accordion_mark_icon_color = new EdgeField("colorsimple","accordion_mark_icon_color","","Icon Color","This is some description");
        $row1->addChild("accordion_mark_icon_color",$accordion_mark_icon_color); 
		
		$accordion_mark_icon_hover_color = new EdgeField("colorsimple","accordion_mark_icon_hover_color","","Icon Hover/Active Color","This is some description");
        $row1->addChild("accordion_mark_icon_hover_color",$accordion_mark_icon_hover_color);
	
		$accordion_mark_background_color = new EdgeField("colorsimple","accordion_mark_background_color","","Background Color","This is some description");
        $row1->addChild("accordion_mark_background_color",$accordion_mark_background_color); 
		
		$accordion_mark_background_hover_color = new EdgeField("colorsimple","accordion_mark_background_hover_color","","Background Hover/Active Color","This is some description");
        $row1->addChild("accordion_mark_background_hover_color",$accordion_mark_background_hover_color);

	$row2 = new EdgeRow(true);
	$group2->addChild("row2",$row2);

		$accordion_mark_border_color = new EdgeField("colorsimple","accordion_mark_border_color","","Border Color","This is some description");
		$row2->addChild("accordion_mark_border_color",$accordion_mark_border_color);

		$accordion_mark_border_hover_color = new EdgeField("colorsimple","accordion_mark_border_hover_color","","Border Hover/Active Color","This is some description");
		$row2->addChild("accordion_mark_border_hover_color",$accordion_mark_border_hover_color);

		$accordion_mark_border_radius = new EdgeField("textsimple","accordion_mark_border_radius","","Border Radius","This is some description");
		$row2->addChild("accordion_mark_border_radius",$accordion_mark_border_radius);

$accordion_toggle_boxed_subtitle = new EdgeTitle("accordion_toggle_boxed_subtitle", "Accordion & Toggle Boxed Style");
$panel29->addChild("accordion_toggle_boxed_subtitle", $accordion_toggle_boxed_subtitle);

$group3= new EdgeGroup("Boxed Style", "Define boxed style");
$panel29->addChild("group3", $group3);

	$row1 = new EdgeRow(true);
	$group3->addChild("row1",$row1);

		$accordion_toggle_boxed_background_color = new EdgeField("colorsimple","accordion_toggle_boxed_background_color","","Background Color","This is some description");
		$row1->addChild("accordion_toggle_boxed_background_color",$accordion_toggle_boxed_background_color);

		$accordion_toggle_boxed_background_hover_color = new EdgeField("colorsimple","accordion_toggle_boxed_background_hover_color","","Background Hover/Active Color","This is some description");
		$row1->addChild("accordion_toggle_boxed_background_hover_color",$accordion_toggle_boxed_background_hover_color);

		$accordion_toggle_boxed_border_color = new EdgeField("colorsimple","accordion_toggle_boxed_border_color","","Border Color","This is some description");
		$row1->addChild("accordion_toggle_boxed_border_color",$accordion_toggle_boxed_border_color);

		$accordion_toggle_boxed_border_hover_color = new EdgeField("colorsimple","accordion_toggle_boxed_border_hover_color","","Border Hover/Active Color","This is some description");
		$row1->addChild("accordion_toggle_boxed_border_hover_color",$accordion_toggle_boxed_border_hover_color);

	$row2 = new EdgeRow(true);
	$group3->addChild("row2",$row2);

		$accordion_toggle_boxed_border_radius = new EdgeField("textsimple","accordion_toggle_boxed_border_radius","","Border Radius","This is some description");
		$row2->addChild("accordion_toggle_boxed_border_radius",$accordion_toggle_boxed_border_radius);

//Back to top

$panel1 = new EdgePanel("'Back to Top' Link Button","back_to_top_panel");
$elementsPage->addChild("panel1",$panel1);

	 $back_to_top_button_type = new EdgeField("select","back_to_top_button_type","square","Button Type",'Choose "Back to Top" button type ', array(
				"square" => "Square",
				"triangle" => "Triangle"
			  ),
			  array("dependence" => true,
					"hide" => array(
						"square"=>"#edgtf_back_to_top_type_triangle_container",
						"triangle"=>"#edgtf_back_to_top_type_square_container"),
					"show" => array(
						"square"=>"#edgtf_back_to_top_type_square_container",
						"triangle"=>"#edgtf_back_to_top_type_triangle_container"
					)
			  ));
	$panel1->addChild("back_to_top_button_type",$back_to_top_button_type);
	
	$back_to_top_type_square_container = new EdgeContainer("back_to_top_type_square_container","back_to_top_button_type","triangle");
    $panel1->addChild("back_to_top_type_square_container",$back_to_top_type_square_container);


        $group1 = new EdgeGroup("Background",'Choose background for "Back to Top"');
        $back_to_top_type_square_container->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $back_to_top_background_color = new EdgeField("colorsimple","back_to_top_background_color","","Background Color","This is some description");
                        $row1->addChild("back_to_top_background_color",$back_to_top_background_color);

                        $back_to_top_background_hover_color = new EdgeField("colorsimple","back_to_top_background_hover_color","","Background Hover Color","This is some description");
                        $row1->addChild("back_to_top_background_hover_color",$back_to_top_background_hover_color);

                        $back_to_top_background_transparency = new EdgeField("textsimple","back_to_top_background_transparency","","Background Transparency (0-1)","This is some description");
                        $row1->addChild("back_to_top_background_transparency",$back_to_top_background_transparency);

                        $back_to_top_background_hover_transparency = new EdgeField("textsimple","back_to_top_background_hover_transparency","","Background Hover Transparency (0-1)","This is some description");
                        $row1->addChild("back_to_top_background_hover_transparency",$back_to_top_background_hover_transparency);

        $group2 = new EdgeGroup("Border","Choose Border style for Back to Top");
        $back_to_top_type_square_container->addChild("group2",$group2);

				$row1 = new EdgeRow();
				$group2->addChild("row1",$row1);

                        $back_to_top_border_color = new EdgeField("colorsimple","back_to_top_border_color","","Border Color","This is some description");
                        $row1->addChild("back_to_top_border_color",$back_to_top_border_color);

                        $back_to_top_border_hover_color = new EdgeField("colorsimple","back_to_top_border_hover_color","","Border Hover Color","This is some description");
                        $row1->addChild("back_to_top_border_hover_color",$back_to_top_border_hover_color);

                        $back_to_top_border_width = new EdgeField("textsimple","back_to_top_border_width","","Border Width (px)","This is some description");
                        $row1->addChild("back_to_top_border_width",$back_to_top_border_width);

                        $back_to_top_border_radius = new EdgeField("textsimple","back_to_top_border_radius","","Border Radius (px)","This is some description");
                        $row1->addChild("back_to_top_border_radius",$back_to_top_border_radius);

                $row2 = new EdgeRow(true);
                $group2->addChild("row2",$row2);

                        $back_to_top_border_transparency = new EdgeField("textsimple","back_to_top_border_transparency","","Border Transparency (0-1)","This is some description");
                        $row2->addChild("back_to_top_border_transparency",$back_to_top_border_transparency);

                        $back_to_top_border_hover_transparency = new EdgeField("textsimple","back_to_top_border_hover_transparency","","Border Hover Transparency (0-1)","This is some description");
                        $row2->addChild("back_to_top_border_hover_transparency",$back_to_top_border_hover_transparency);

        $group3 = new EdgeGroup("Button Size",'Choose Size for "Back to Top" button');
        $back_to_top_type_square_container->addChild("group3",$group3);

                $row1 = new EdgeRow();
                $group3->addChild("row1",$row1);

                        $back_to_top_height = new EdgeField("textsimple","back_to_top_height","","Height (px)","This is some description");
                        $row1->addChild("back_to_top_height",$back_to_top_height);
                        $back_to_top_width = new EdgeField("textsimple","back_to_top_width","","Width (px)","This is some description");
                        $row1->addChild("back_to_top_width",$back_to_top_width);

        $group4 = new EdgeGroup("Button Position",'Define button alignment and margin bottom');
        $back_to_top_type_square_container->addChild("group4",$group4);

            $row1 = new EdgeRow();
            $group4->addChild("row1",$row1);

                        $back_to_top_position = new EdgeField("selectsimple","back_to_top_position","","Button Alignment",'Choose alignment for "Back to Top" button', array(
                            "right"  => "Right",
                            "left"   => "Left",
                            "center" => "Center",
                        ));
						$row1->addChild("back_to_top_position",$back_to_top_position);

                        $back_to_top_button_margin_bottom = new EdgeField("textsimple","back_to_top_button_margin_bottom","","Margin Bottom (px)","Enter bottom margin");
                        $row1->addChild("back_to_top_button_margin_bottom",$back_to_top_button_margin_bottom);

        $back_to_top_type = new EdgeField("select","back_to_top_type","arrow","Button Text Type",'Choose "Back to Top" button type ', array(
                    "arrow" => "Arrow",
                    "text" => "Text"
                  ),
                  array("dependence" => true,
                        "hide" => array(
                            "arrow"=>"#edgtf_back_to_top_type_text_container",
                            "text"=>"#edgtf_back_to_top_type_arrow_container"),
                        "show" => array(
                            "arrow"=>"#edgtf_back_to_top_type_arrow_container",
                            "text"=>"#edgtf_back_to_top_type_text_container"
                        )
                  ));
        $back_to_top_type_square_container->addChild("back_to_top_type",$back_to_top_type);

        $back_to_top_type_arrow_container = new EdgeContainer("back_to_top_type_arrow_container","back_to_top_type","text");
        $back_to_top_type_square_container->addChild("back_to_top_type_arrow_container",$back_to_top_type_arrow_container);

            $group1 = new EdgeGroup("Arrow Icon Style","Define style for arrow icon");
            $back_to_top_type_arrow_container->addChild("group1",$group1);

                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                    $show_back_button_icon_set = new EdgeField('selectsimple', 'show_back_button_icon_set', 'font_elegant', 'Choose Icon Pack', 'Choose Icon Pack', $edgtIconCollections->getIconCollectionsExclude('linea_icons'));
                    $row1->addChild('show_back_button_icon_set', $show_back_button_icon_set);

                    $back_to_top_arrow_size = new EdgeField("textsimple","back_to_top_arrow_size","14","Icon Size (px)","Default value is 14	");
                    $row1->addChild("back_to_top_arrow_size",$back_to_top_arrow_size);

                    $back_to_top_arrow_color = new EdgeField("colorsimple","back_to_top_arrow_color","","Icon Color","This is some description");
                    $row1->addChild("back_to_top_arrow_color",$back_to_top_arrow_color);

                    $back_to_top_arrow_hover_color = new EdgeField("colorsimple","back_to_top_arrow_hover_color","","Icon Hover Color","This is some description");
                    $row1->addChild("back_to_top_arrow_hover_color",$back_to_top_arrow_hover_color);

        $back_to_top_type_text_container = new EdgeContainer("back_to_top_type_text_container","back_to_top_type","arrow");
        $back_to_top_type_square_container->addChild("back_to_top_type_text_container",$back_to_top_type_text_container);

			$back_to_top_text = new EdgeField("text","back_to_top_text","","Back to Top Text","Enter text for 'Back to Top' button");
			$back_to_top_type_text_container->addChild("back_to_top_text",$back_to_top_text);

				$group1 = new EdgeGroup("Button Text Color","Define Color for Text Type");
				$back_to_top_type_text_container->addChild("group1",$group1);

					$row1 = new EdgeRow();
					$group1->addChild("row1",$row1);

						$back_to_top_text_color = new EdgeField("colorsimple","back_to_top_text_color","","Text Color","This is some description");
						$row1->addChild("back_to_top_text_color",$back_to_top_text_color);

						$back_to_top_text_hover_color = new EdgeField("colorsimple","back_to_top_text_hover_color","","Text Hover Color","This is some description");
						$row1->addChild("back_to_top_text_hover_color",$back_to_top_text_hover_color);

                $group2 = new EdgeGroup("Button Text Style","Define Style for Text Type");
                $back_to_top_type_text_container->addChild("group2",$group2);

                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $back_to_top_text_fontsize = new EdgeField("textsimple","back_to_top_text_fontsize","","Font Size (px)","This is some description");
                        $row1->addChild("back_to_top_text_fontsize",$back_to_top_text_fontsize);

                        $back_to_top_text_lineheight = new EdgeField("textsimple","back_to_top_text_lineheight","","Line Height (px)","This is some description");
                        $row1->addChild("back_to_top_text_lineheight",$back_to_top_text_lineheight);

                        $back_to_top_text_texttransform = new EdgeField("selectblanksimple","back_to_top_text_texttransform","","Text Transform","This is some description",$options_texttransform);
                        $row1->addChild("back_to_top_text_texttransform",$back_to_top_text_texttransform);

						$back_to_top_text_fontfamily = new EdgeField("Fontsimple","back_to_top_text_fontfamily","-1","Font Family","This is some description");
						$row1->addChild("back_to_top_text_fontfamily",$back_to_top_text_fontfamily);

                $row2 = new EdgeRow();
                $group2->addChild("row2",$row2);

                        $back_to_top_text_fontstyle = new EdgeField("selectblanksimple","back_to_top_text_fontstyle","","Font Style","This is some description",$options_fontstyle);
                        $row2->addChild("back_to_top_text_fontstyle",$back_to_top_text_fontstyle);

                        $back_to_top_text_fontweight = new EdgeField("selectblanksimple","back_to_top_text_fontweight","","Font Weight","This is some description",$options_fontweight);
                        $row2->addChild("back_to_top_text_fontweight",$back_to_top_text_fontweight);

						$back_to_top_text_letterspacing = new EdgeField("textsimple","back_to_top_text_letterspacing","","Letter Spacing (px)","This is some description");
						$row2->addChild("back_to_top_text_letterspacing",$back_to_top_text_letterspacing);


						
		$back_to_top_type_triangle_container = new EdgeContainer("back_to_top_type_triangle_container","back_to_top_button_type","square");
		$panel1->addChild("back_to_top_type_triangle_container",$back_to_top_type_triangle_container);
			
			$back_to_top_triangle_text = new EdgeField("text","back_to_top_triangle_text","","Back to Top Text","Enter text for 'Back to Top' button");
			$back_to_top_type_triangle_container->addChild("back_to_top_triangle_text",$back_to_top_triangle_text);
			
			$group1 = new EdgeGroup("Background Color",'Choose background for "Back to Top"');
			$back_to_top_type_triangle_container->addChild("group1",$group1);
				
			    $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

					$back_to_top_triangle_background_color = new EdgeField("colorsimple","back_to_top_triangle_background_color","","Background Color","This is some description");
					$row1->addChild("back_to_top_triangle_background_color",$back_to_top_triangle_background_color);


				$group2 = new EdgeGroup("Button Text Color","Define text style for button");
				$back_to_top_type_triangle_container->addChild("group2",$group2);

					$row1 = new EdgeRow();
					$group2->addChild("row1",$row1);

						$back_to_top_triangle_text_color = new EdgeField("colorsimple","back_to_top_triangle_text_color","","Text Color","This is some description");
						$row1->addChild("back_to_top_triangle_text_color",$back_to_top_triangle_text_color);

						$back_to_top_triangle_text_hover_color = new EdgeField("colorsimple","back_to_top_triangle_text_hover_color","","Text Hover Color","This is some description");
						$row1->addChild("back_to_top_triangle_text_hover_color",$back_to_top_triangle_text_hover_color);

                $group3 = new EdgeGroup("Button Text Style","Define Style for Text Type");
                $back_to_top_type_triangle_container->addChild("group3",$group3);

					$row1 = new EdgeRow();
					$group3->addChild("row1",$row1);

							$back_to_top_triangle_text_fontsize = new EdgeField("textsimple","back_to_top_triangle_text_fontsize","","Font Size (px)","This is some description");
							$row1->addChild("back_to_top_triangle_text_fontsize",$back_to_top_triangle_text_fontsize);

							$back_to_top_triangle_text_lineheight = new EdgeField("textsimple","back_to_top_triangle_text_lineheight","","Line Height (px)","This is some description");
							$row1->addChild("back_to_top_triangle_text_lineheight",$back_to_top_triangle_text_lineheight);

							$back_to_top_triangle_text_texttransform = new EdgeField("selectblanksimple","back_to_top_triangle_text_texttransform","","Text Transform","This is some description",$options_texttransform);
							$row1->addChild("back_to_top_triangle_text_texttransform",$back_to_top_triangle_text_texttransform);

							$back_to_top_triangle_text_fontfamily = new EdgeField("Fontsimple","back_to_top_triangle_text_fontfamily","-1","Font Family","This is some description");
							$row1->addChild("back_to_top_triangle_text_fontfamily",$back_to_top_triangle_text_fontfamily);

					$row2 = new EdgeRow();
					$group3->addChild("row2",$row2);

							$back_to_top_triangle_text_fontstyle = new EdgeField("selectblanksimple","back_to_top_triangle_text_fontstyle","","Font Style","This is some description",$options_fontstyle);
							$row2->addChild("back_to_top_triangle_text_fontstyle",$back_to_top_triangle_text_fontstyle);

							$back_to_top_triangle_text_fontweight = new EdgeField("selectblanksimple","back_to_top_triangle_text_fontweight","","Font Weight","This is some description",$options_fontweight);
							$row2->addChild("back_to_top_triangle_text_fontweight",$back_to_top_triangle_text_fontweight);

							$back_to_top_triangle_text_letterspacing = new EdgeField("textsimple","back_to_top_triangle_text_letterspacing","","Letter Spacing (px)","This is some description");
							$row2->addChild("back_to_top_triangle_text_letterspacing",$back_to_top_triangle_text_letterspacing);


                  
	
//Buttons

$panel2 = new EdgePanel("Buttons","buttons_panel");
$elementsPage->addChild("panel2",$panel2);

$button_default_section = new EdgeTitle("button_default_section","Default Button");
$panel2->addChild("button_default_section",$button_default_section);

        $group1 = new EdgeGroup("Text Style","Define text style");
        $panel2->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);
                        $button_title_google_fonts = new EdgeField("Fontsimple","button_title_google_fonts","-1","Font Family","This is some description");
                        $row1->addChild("button_title_google_fonts",$button_title_google_fonts);

                        $button_title_fontsize = new EdgeField("textsimple","button_title_fontsize","","Text Size (px)","This is some description");
                        $row1->addChild("button_title_fontsize",$button_title_fontsize);

                        $button_title_fontstyle = new EdgeField("selectblanksimple","button_title_fontstyle","","Font Style","This is some description",$options_fontstyle);
                        $row1->addChild("button_title_fontstyle",$button_title_fontstyle);

                        $button_title_fontweight = new EdgeField("selectblanksimple","button_title_fontweight","","Font Weight","This is some description",$options_fontweight);
                        $row1->addChild("button_title_fontweight",$button_title_fontweight);

                $row2 = new EdgeRow(true);
                $group1->addChild("row2",$row2);
                        $button_title_letter_spacing = new EdgeField("textsimple","button_title_letter_spacing","","Letter Spacing (px)","This is some description");
                        $row2->addChild("button_title_letter_spacing",$button_title_letter_spacing);

                        $button_title_lineheight = new EdgeField("textsimple","button_title_lineheight","","Line Height (px)","This is some description");
                        $row2->addChild("button_title_lineheight",$button_title_lineheight);

                        $button_title_color = new EdgeField("colorsimple","button_title_color","","Text Color","This is some description");
                        $row2->addChild("button_title_color",$button_title_color);

                        $button_title_hovercolor = new EdgeField("colorsimple","button_title_hovercolor","","Hover Text Color","This is some description");
                        $row2->addChild("button_title_hovercolor",$button_title_hovercolor);

                $row3 = new EdgeRow(true);
                $group1->addChild("row3",$row3);

                        $button_title_texttransform = new EdgeField("selectblanksimple","button_title_texttransform","","Text Transform","This is some description",$options_texttransform);
                        $row3->addChild("button_title_texttransform",$button_title_texttransform);

        $group2 = new EdgeGroup("Background","Define background");
        $panel2->addChild("group2",$group2);

                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $button_backgroundcolor = new EdgeField("colorsimple","button_backgroundcolor","","Background Color","This is some description");
                        $row1->addChild("button_backgroundcolor",$button_backgroundcolor);

                        $button_backgroundcolor_hover = new EdgeField("colorsimple","button_backgroundcolor_hover","","Background Hover Color","This is some description");
                        $row1->addChild("button_backgroundcolor_hover",$button_backgroundcolor_hover);

        $group3 = new EdgeGroup("Border Style","Define border style");
        $panel2->addChild("group3",$group3);

                $row1 = new EdgeRow();
                $group3->addChild("row1",$row1);

                        $button_border_color = new EdgeField("colorsimple","button_border_color","","Border Color","This is some description");
                        $row1->addChild("button_border_color",$button_border_color);

                        $button_border_hover_color = new EdgeField("colorsimple","button_border_hover_color","","Border Hover Color","This is some description");
                        $row1->addChild("button_border_hover_color",$button_border_hover_color);

                        $button_border_width = new EdgeField("textsimple","button_border_width","","Border Width (px)","This is some description");
                        $row1->addChild("button_border_width",$button_border_width);

                        $button_border_radius = new EdgeField("textsimple","button_border_radius","","Border Radius (px)","This is some description");
                        $row1->addChild("button_border_radius",$button_border_radius);

        $button_padding = new EdgeField("text","button_padding","","Padding Left/Right (px) ","Define padding", array(), array("col_width" => 3));
        $panel2->addChild("button_padding",$button_padding);

        $button_box_shadows = new EdgeField('yesno', 'button_box_shadows', 'no', 'Show Button Shadows', 'Enabling this option will show button shadows', array(), array(
            'dependence' => true,
            'dependence_hide_on_yes' => '',
            'dependence_show_on_yes' => '#edgtf_button_box_shadows_container'
        ));
        $panel2->addChild('button_box_shadows', $button_box_shadows);

        $button_box_shadows_container = new EdgeContainer('button_box_shadows_container', 'button_box_shadows', 'no');
        $panel2->addChild('button_box_shadows_container', $button_box_shadows_container);

            $group4 = new EdgeGroup('Button Shadows', 'Set horizontal and vertical position of shadow (negative values are allowed), and define blur and spread.');
            $button_box_shadows_container->addChild('group4', $group4);

                $row1 = new EdgeRow();
                $group4->addChild('row1', $row1);

                    $button_box_shadow_horizontal_shadow = new EdgeField('textsimple', 'button_box_shadow_horizontal_shadow', '', 'Horizontal Shadow (px)');
                    $row1->addChild('button_box_shadow_horizontal_shadow', $button_box_shadow_horizontal_shadow);

                    $button_box_shadow_vertical_shadow = new EdgeField('textsimple', 'button_box_shadow_vertical_shadow', '', 'Vertical Shadow (px)');
                    $row1->addChild('button_box_shadow_vertical_shadow', $button_box_shadow_vertical_shadow);

                    $button_box_shadow_blur_distance = new EdgeField('textsimple', 'button_box_shadow_blur_distance', '', 'Blur (px)');
                    $row1->addChild('button_box_shadow_blur_distance', $button_box_shadow_blur_distance);

                    $button_box_shadow_shadow_size = new EdgeField('textsimple', 'button_box_shadow_shadow_size', '', 'Spread (px)');
                    $row1->addChild('button_box_shadow_shadow_size', $button_box_shadow_shadow_size);

                $row2 = new EdgeRow(true);
                $group4->addChild('row2', $row2);

                $button_box_shadow_shadow_color = new EdgeField('colorsimple', 'button_box_shadow_shadow_color', '', 'Shadow color');
                $row2->addChild('button_box_shadow_shadow_color', $button_box_shadow_shadow_color);

$button_predefined_white_section = new EdgeTitle("button_predefined_white_section","Predefined White Button");
$panel2->addChild("button_predefined_white_section",$button_predefined_white_section);

        $group5 = new EdgeGroup("Text Style","Define text style.");
        $panel2->addChild("group5",$group5);
                $row1 = new EdgeRow();
                $group5->addChild("row1",$row1);

                        $button_white_text_color = new EdgeField("colorsimple","button_white_text_color","","Text Color","This is some description");
                        $row1->addChild("button_white_text_color",$button_white_text_color);

                        $button_white_text_color_hover = new EdgeField("colorsimple","button_white_text_color_hover","","Hover Text Color","This is some description");
                        $row1->addChild("button_white_text_color_hover",$button_white_text_color_hover);

        $group6 = new EdgeGroup("Background","Define background");
        $panel2->addChild("group6",$group6);
                $row1 = new EdgeRow();
                $group6->addChild("row1",$row1);

                        $button_white_background_color = new EdgeField("colorsimple","button_white_background_color","","Background Color","This is some description");
                        $row1->addChild("button_white_background_color",$button_white_background_color);

                        $button_white_background_color_hover = new EdgeField("colorsimple","button_white_background_color_hover","","Background Hover Color","This is some description");
                        $row1->addChild("button_white_background_color_hover",$button_white_background_color_hover);

        $group7 = new EdgeGroup("Border Style","Define border style.");
        $panel2->addChild("group7",$group7);

                $row1 = new EdgeRow();
                $group7->addChild("row1",$row1);

                        $button_white_border_color = new EdgeField("colorsimple","button_white_border_color","","Border Color","This is some description");
                        $row1->addChild("button_white_border_color",$button_white_border_color);

                        $button_white_border_color_hover = new EdgeField("colorsimple","button_white_border_color_hover","","Border Hover Color","This is some description");
                        $row1->addChild("button_white_border_color_hover",$button_white_border_color_hover);

$button_predefined_solid_section = new EdgeTitle("button_predefined_solid_section","Predefined Solid Button");
$panel2->addChild("button_predefined_solid_section",$button_predefined_solid_section);

        $group20 = new EdgeGroup("Text Style","Define text style.");
        $panel2->addChild("group20",$group20);
                $row1 = new EdgeRow();
                $group20->addChild("row1",$row1);

                        $button_solid_text_color = new EdgeField("colorsimple","button_solid_text_color","","Text Color","This is some description");
                        $row1->addChild("button_solid_text_color",$button_solid_text_color);

                        $button_solid_text_color_hover = new EdgeField("colorsimple","button_solid_text_color_hover","","Hover Text Color","This is some description");
                        $row1->addChild("button_solid_text_color_hover",$button_solid_text_color_hover);

        $group21 = new EdgeGroup("Background","Define background");
        $panel2->addChild("group21",$group21);
                $row1 = new EdgeRow();
                $group21->addChild("row1",$row1);

                        $button_solid_background_color = new EdgeField("colorsimple","button_solid_background_color","","Background Color","This is some description");
                        $row1->addChild("button_solid_background_color",$button_solid_background_color);

                        $button_solid_background_color_hover = new EdgeField("colorsimple","button_solid_background_color_hover","","Background Hover Color","This is some description");
                        $row1->addChild("button_solid_background_color_hover",$button_solid_background_color_hover);

        $group22 = new EdgeGroup("Border Style","Define border style.");
        $panel2->addChild("group22",$group22);

                $row1 = new EdgeRow();
                $group22->addChild("row1",$row1);

                        $button_solid_border_color = new EdgeField("colorsimple","button_solid_border_color","","Border Color","This is some description");
                        $row1->addChild("button_solid_border_color",$button_solid_border_color);

                        $button_solid_border_color_hover = new EdgeField("colorsimple","button_solid_border_color_hover","","Border Hover Color","This is some description");
                        $row1->addChild("button_solid_border_color_hover",$button_solid_border_color_hover);


$button_small_section = new EdgeTitle("button_small_section","Small Button");
$panel2->addChild("button_small_section",$button_small_section);

        $group14 = new EdgeGroup("Text Style","Define text style");
        $panel2->addChild("group14",$group14);
                $row1 = new EdgeRow();
                $group14->addChild("row1",$row1);

                        $small_button_fontsize = new EdgeField("textsimple","small_button_fontsize","","Font Size (px)","This is some description");
                        $row1->addChild("small_button_fontsize",$small_button_fontsize);

                        $small_button_fontweight = new EdgeField("selectblanksimple","small_button_fontweight","","Font Weight","This is some description",$options_fontweight);
                        $row1->addChild("small_button_fontweight",$small_button_fontweight);

                        $small_button_lineheight = new EdgeField("textsimple","small_button_lineheight","","Line Height (px)","This is some description");
                        $row1->addChild("small_button_lineheight",$small_button_lineheight);

        $small_button_padding = new EdgeField("text","small_button_padding","","Padding left/right (px) ","Define padding", array(), array("col_width" => 3));
        $panel2->addChild("small_button_padding",$small_button_padding);

        $small_button_border_radius = new EdgeField("text","small_button_border_radius","","Border radius (px)","Define border", array(), array("col_width" => 3));
        $panel2->addChild("small_button_border_radius",$small_button_border_radius);

$button_large_section = new EdgeTitle("button_large_section","Large Button");
$panel2->addChild("button_large_section",$button_large_section);

        $group17 = new EdgeGroup("Text Style","Define text style");
        $panel2->addChild("group17",$group17);

                $row1 = new EdgeRow();
                $group17->addChild("row1",$row1);

                        $large_button_fontsize = new EdgeField("textsimple","large_button_fontsize","","Font Size (px)","This is some description");
                        $row1->addChild("large_button_fontsize",$large_button_fontsize);

                        $large_button_fontweight = new EdgeField("selectblanksimple","large_button_fontweight","","Font Weight","This is some description",$options_fontweight);
                        $row1->addChild("large_button_fontweight",$large_button_fontweight);

                        $large_button_lineheight = new EdgeField("textsimple","large_button_lineheight","","Line Height (px)","This is some description");
                        $row1->addChild("large_button_lineheight",$large_button_lineheight);

        $large_button_padding = new EdgeField("text","large_button_padding","","Padding Left/Right (px) ","Define padding", array(), array("col_width" => 3));
        $panel2->addChild("large_button_padding",$large_button_padding);

        $large_button_border_radius = new EdgeField("text","large_button_border_radius","","Border Radius (px)","Define border", array(), array("col_width" => 3));
        $panel2->addChild("large_button_border_radius",$large_button_border_radius);

$button_extra_large_section = new EdgeTitle("button_extra_large_section","Extra Large Button");
$panel2->addChild("button_extra_large_section",$button_extra_large_section);

        $group20 = new EdgeGroup("Text Style","Define text style");
        $panel2->addChild("group20",$group20);
                $row1 = new EdgeRow();
                $group20->addChild("row1",$row1);

                        $big_large_button_fontsize = new EdgeField("textsimple","big_large_button_fontsize","","Font Size (px)","This is some description");
                        $row1->addChild("big_large_button_fontsize",$big_large_button_fontsize);

                        $big_large_button_fontweight = new EdgeField("selectblanksimple","big_large_button_fontweight","","Font Weight","This is some description",$options_fontweight);
                        $row1->addChild("big_large_button_fontweight",$big_large_button_fontweight);

                        $big_large_button_lineheight = new EdgeField("textsimple","big_large_button_lineheight","","Line Height (px)","This is some description");
                        $row1->addChild("big_large_button_lineheight",$big_large_button_lineheight);

        $big_large_button_padding = new EdgeField("text","big_large_button_padding","","Padding Left/Right (px) ","Define padding", array(), array("col_width" => 3));
        $panel2->addChild("big_large_button_padding",$big_large_button_padding);

        $big_large_button_border_radius = new EdgeField("text","big_large_button_border_radius","","Border Radius (px)","Define padding", array(), array("col_width" => 3));
        $panel2->addChild("big_large_button_border_radius",$big_large_button_border_radius);

//Blockquote

$panel3 = new EdgePanel("Blockquote","blockquote_panel");
$elementsPage->addChild("panel3",$panel3);

        $group1 = new EdgeGroup("Blockquote Style","Define Blockquote style");
        $panel3->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $blockquote_color = new EdgeField("colorsimple","blockquote_color","","Text Color","This is some description");
                        $row1->addChild("blockquote_font_color",$blockquote_color);

                        $blockquote_font_size = new EdgeField("textsimple","blockquote_font_size","","Font Size (px)","This is some description");
                        $row1->addChild("blockquote_font_size",$blockquote_font_size);

                        $blockquote_line_height = new EdgeField("textsimple","blockquote_line_height","","Line Height (px)","This is some description");
                        $row1->addChild("blockquote_line_height",$blockquote_line_height);

                        $blockquote_text_transform = new EdgeField("selectblanksimple","blockquote_text_transform","","Text Transform","This is some description",$options_texttransform);
                        $row1->addChild("blockquote_text_transform",$blockquote_text_transform);

                $row2 = new EdgeRow(true);
                $group1->addChild("row2",$row2);

                        $blockquote_font_family = new EdgeField("Fontsimple","blockquote_font_family","-1","Font Family","This is some description");
                        $row2->addChild("blockquote_font_family",$blockquote_font_family);

                        $blockquote_font_style = new EdgeField("selectblanksimple","blockquote_font_style","","Font Style","This is some description",$options_fontstyle);
                        $row2->addChild("blockquote_font_style",$blockquote_font_style);

                        $blockquote_font_weight = new EdgeField("selectblanksimple","blockquote_font_weight","","Font Weight","This is some description",$options_fontweight);
                        $row2->addChild("blockquote_font_weight",$blockquote_font_weight);

                        $blockquote_letter_spacing = new EdgeField("textsimple","blockquote_letter_spacing","","Letter Spacing (px)","This is some description");
                        $row2->addChild("blockquote_letter_spacing",$blockquote_letter_spacing);

                $row3 = new EdgeRow(true);
                $group1->addChild("row3",$row3);

                        $blockquote_background_color = new EdgeField("colorsimple","blockquote_background_color","","Background Color","This is some description");
                        $row3->addChild("blockquote_background_color",$blockquote_background_color);

                        $blockquote_border_color = new EdgeField("colorsimple","blockquote_border_color","","Border Color","This is some description");
                        $row3->addChild("blockquote_border_color",$blockquote_border_color);

                        $blockquote_quote_icon_color = new EdgeField("colorsimple","blockquote_quote_icon_color","","Quote Icon Color","This is some description");
                        $row3->addChild("blockquote_quote_icon_color",$blockquote_quote_icon_color);

//Call to action

$panel31 = new EdgePanel("Call to Action","call_to_action_panel");
$elementsPage->addChild("panel31",$panel31);

$call_to_action_button_section = new EdgeTitle("call_to_action_button_section","Button");
$panel31->addChild("call_to_action_button_section",$call_to_action_button_section);

        $group1 = new EdgeGroup("Text Style","Define text style");
        $panel31->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);
                        $cto_action_bttn_title_google_fonts = new EdgeField("Fontsimple","cto_action_bttn_title_google_fonts","-1","Font Family","This is some description");
                        $row1->addChild("cto_action_bttn_title_google_fonts",$cto_action_bttn_title_google_fonts);

                        $cto_action_bttn_title_fontsize = new EdgeField("textsimple","cto_action_bttn_title_fontsize","","Text Size (px)","This is some description");
                        $row1->addChild("cto_action_bttn_title_fontsize",$cto_action_bttn_title_fontsize);

                        $cto_action_bttn_title_fontstyle = new EdgeField("selectblanksimple","cto_action_bttn_title_fontstyle","","Font Style","This is some description",$options_fontstyle);
                        $row1->addChild("cto_action_bttn_title_fontstyle",$cto_action_bttn_title_fontstyle);

                        $cto_action_bttn_title_fontweight = new EdgeField("selectblanksimple","cto_action_bttn_title_fontweight","","Font Weight","This is some description",$options_fontweight);
                        $row1->addChild("cto_action_bttn_title_fontweight",$cto_action_bttn_title_fontweight);

                $row2 = new EdgeRow(true);
                $group1->addChild("row2",$row2);
                        $cto_action_bttn_title_letter_spacing = new EdgeField("textsimple","cto_action_bttn_title_letter_spacing","","Letter Spacing (px)","This is some description");
                        $row2->addChild("cto_action_bttn_title_letter_spacing",$cto_action_bttn_title_letter_spacing);

                        $cto_action_bttn_title_lineheight = new EdgeField("textsimple","cto_action_bttn_title_lineheight","","Line Height (px)","This is some description");
                        $row2->addChild("cto_action_bttn_title_lineheight",$cto_action_bttn_title_lineheight);

                        $cto_action_bttn_title_color = new EdgeField("colorsimple","cto_action_bttn_title_color","","Text Color","This is some description");
                        $row2->addChild("cto_action_bttn_title_color",$cto_action_bttn_title_color);

                        $cto_action_bttn_title_hovercolor = new EdgeField("colorsimple","cto_action_bttn_title_hovercolor","","Hover Text Color","This is some description");
                        $row2->addChild("cto_action_bttn_title_hovercolor",$cto_action_bttn_title_hovercolor);

                $row3 = new EdgeRow(true);
                $group1->addChild("row3",$row3);

                        $cto_action_bttn_title_texttransform = new EdgeField("selectblanksimple","cto_action_bttn_title_texttransform","","Text Transform","This is some description",$options_texttransform);
                        $row3->addChild("cto_action_bttn_title_texttransform",$cto_action_bttn_title_texttransform);

        $group2 = new EdgeGroup("Background","Define background");
        $panel31->addChild("group2",$group2);

                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $cto_action_bttn_backgroundcolor = new EdgeField("colorsimple","cto_action_bttn_backgroundcolor","","Background Color","This is some description");
                        $row1->addChild("cto_action_bttn_backgroundcolor",$cto_action_bttn_backgroundcolor);

                        $cto_action_bttn_backgroundcolor_hover = new EdgeField("colorsimple","cto_action_bttn_backgroundcolor_hover","","Background Hover Color","This is some description");
                        $row1->addChild("cto_action_bttn_backgroundcolor_hover",$cto_action_bttn_backgroundcolor_hover);

        $group3 = new EdgeGroup("Border Style","Define border style");
        $panel31->addChild("group3",$group3);

                $row1 = new EdgeRow();
                $group3->addChild("row1",$row1);

                        $cto_action_bttn_border_color = new EdgeField("colorsimple","cto_action_bttn_border_color","","Border Color","This is some description");
                        $row1->addChild("cto_action_bttn_border_color",$cto_action_bttn_border_color);

                        $cto_action_bttn_border_hover_color = new EdgeField("colorsimple","cto_action_bttn_border_hover_color","","Border Hover Color","This is some description");
                        $row1->addChild("cto_action_bttn_border_hover_color",$cto_action_bttn_border_hover_color);

                        $cto_action_bttn_border_width = new EdgeField("textsimple","cto_action_bttn_border_width","","Border Width (px)","This is some description");
                        $row1->addChild("cto_action_bttn_border_width",$cto_action_bttn_border_width);

                        $cto_action_bttn_border_radius = new EdgeField("textsimple","cto_action_bttn_border_radius","","Border Radius (px)","This is some description");
                        $row1->addChild("cto_action_bttn_border_radius",$cto_action_bttn_border_radius);
						
        $cto_action_bttn_padding = new EdgeField("text","cto_action_bttn_padding","","Padding Left/Right (px) ","Define padding", array(), array("col_width" => 3));
        $panel31->addChild("cto_action_bttn_padding",$cto_action_bttn_padding);
        
//Content Menu

$panel25 = new EdgePanel("Content Menu","content_menu_panel");
$elementsPage->addChild("panel25",$panel25);

        $group1 = new EdgeGroup("Menu Icons Style","Define Icons style");
        $panel25->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);
                    $content_menu_icon_color = new EdgeField("colorsimple","content_menu_icon_color","","Icon Color","This is some description");
                    $row1->addChild("content_menu_icon_color",$content_menu_icon_color);
                    $content_menu_icon_hover_color = new EdgeField("colorsimple","content_menu_icon_hover_color","","Icon Hover Color","This is some description");
                    $row1->addChild("content_menu_icon_hover_color",$content_menu_icon_hover_color);
                    $content_menu_icon_size = new EdgeField("textsimple","content_menu_icon_size","","Icon Size","This is some description");
                    $row1->addChild("content_menu_icon_size",$content_menu_icon_size);

        $group2 = new EdgeGroup("Text Style","Define Text style");
        $panel25->addChild("group2",$group2);
                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);
                    $content_menu_text_color = new EdgeField("colorsimple","content_menu_text_color","","Text Color","This is some description");
                    $row1->addChild("content_menu_text_color",$content_menu_text_color);
                    $content_menu_text_hover_color = new EdgeField("colorsimple","content_menu_text_hover_color","","Text Hover Color","This is some description");
                    $row1->addChild("content_menu_text_hover_color",$content_menu_text_hover_color);
                    $content_menu_text_fontsize = new EdgeField("textsimple","content_menu_text_fontsize","","Font Size (px)","This is some description");
                    $row1->addChild("content_menu_text_fontsize",$content_menu_text_fontsize);
                    $content_menu_text_lineheight = new EdgeField("textsimple","content_menu_text_lineheight","","Line Height (px)","This is some description");
                    $row1->addChild("content_menu_text_lineheight",$content_menu_text_lineheight);
                $row2 = new EdgeRow();
                $group2->addChild("row2",$row2);
                    $content_menu_text_texttransform = new EdgeField("selectblanksimple","content_menu_text_texttransform","","Text Transform","This is some description",$options_texttransform);
                    $row2->addChild("content_menu_text_texttransform",$content_menu_text_texttransform);
                    $content_menu_text_google_fonts = new EdgeField("Fontsimple","content_menu_text_google_fonts","-1","Font Family","This is some description");
                    $row2->addChild("content_menu_text_google_fonts",$content_menu_text_google_fonts);
                    $content_menu_text_fontstyle = new EdgeField("selectblanksimple","content_menu_text_fontstyle","","Font Style","This is some description",$options_fontstyle);
                    $row2->addChild("content_menu_text_fontstyle",$h1_fontstyle);
                    $content_menu_text_fontweight = new EdgeField("selectblanksimple","content_menu_text_fontweight","","Font Weight","This is some description",$options_fontweight);
                    $row2->addChild("content_menu_text_fontweight",$content_menu_text_fontweight);
                $row3 = new EdgeRow();
                $group2->addChild("row3",$row3);
                    $content_menu_text_letterspacing = new EdgeField("textsimple","content_menu_text_letterspacing","","Letter Spacing (px)","This is some description");
                    $row2->addChild("content_menu_text_letterspacing",$content_menu_text_letterspacing);

//Counters

$panel4 = new EdgePanel("Counters","counters_panel");
$elementsPage->addChild("panel4",$panel4);

        $group1 = new EdgeGroup("Counters Style","Define styles for Counters");
        $panel4->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $counter_color = new EdgeField("colorsimple","counter_color","","Numeral Color","This is some description");
                        $row1->addChild("counter_color",$counter_color);

                        $counter_text_color = new EdgeField("colorsimple","counter_text_color","","Text Color","This is some description");
                        $row1->addChild("counter_text_color",$counter_text_color);

                        $counter_separator_color = new EdgeField("colorsimple","counter_separator_color","","Separator Color","This is some description");
                        $row1->addChild("counter_separator_color",$counter_separator_color);

                $row2 = new EdgeRow(true);
                $group1->addChild("row2",$row2);

                        $counters_font_family = new EdgeField("Fontsimple","counters_font_family","-1","Numeral Font Family","This is some description");
                        $row2->addChild("counters_font_family",$counters_font_family);

                        $counters_font_size = new EdgeField("textsimple","counters_font_size","","Numeral Font Size (px)","This is some description");
                        $row2->addChild("counters_font_size",$counters_font_size);

                        $counters_fontweight = new EdgeField("selectblanksimple","counters_fontweight","","Numeral Font Weight","This is some description",$options_fontweight);
                        $row2->addChild("counters_fontweight",$counters_fontweight);

                $row3 = new EdgeRow(true);
                $group1->addChild("row3",$row3);

                        $counters_text_font_size = new EdgeField("textsimple","counters_text_font_size","","Text Font Size (px)","This is some description");
                        $row3->addChild("counters_text_font_size",$counters_text_font_size);

                        $counters_text_fontweight = new EdgeField("selectblanksimple","counters_text_fontweight","","Text Font Weight","This is some description",$options_fontweight);
                        $row3->addChild("counters_text_fontweight",$counters_text_fontweight);

                        $counters_text_texttransform = new EdgeField("selectblanksimple","counters_text_texttransform","","Text Transform","This is some description",$options_texttransform);
                        $row3->addChild("counters_text_texttransform",$counters_text_texttransform);

                        $counters_text_letterspacing = new EdgeField("textsimple","counters_text_letterspacing","","Text Letter Spacing (px)","This is some description");
                        $row3->addChild("counters_text_letterspacing",$counters_text_letterspacing);

        $group2 = new EdgeGroup("Counters Title","Define Counter title style");
        $panel4->addChild("group2",$group2);

                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $counters_title_color = new EdgeField("colorsimple","counters_title_color","","Text Color","This is some description");
                        $row1->addChild("counters_title_color",$counters_title_color);

                        $counters_title_font_size = new EdgeField("textsimple","counters_title_font_size","","Font Size (px)","This is some description");
                        $row1->addChild("counters_title_font_size",$counters_title_font_size);

                        $counters_title_line_height = new EdgeField("textsimple","counters_title_line_height","","Line Height (px)","This is some description");
                        $row1->addChild("counters_title_line_height",$counters_title_line_height);

                        $counters_title_text_transform = new EdgeField("selectblanksimple","counters_title_text_transform","","Text Transform","This is some description",$options_texttransform);
                        $row1->addChild("counters_title_text_transform",$counters_title_text_transform);

                $row2 = new EdgeRow(true);
                $group2->addChild("row2",$row2);

                        $counters_title_font_family = new EdgeField("Fontsimple","counters_title_font_family","-1","Font Family","This is some description");
                        $row2->addChild("counters_title_font_family",$counters_title_font_family);

                        $counters_title_font_style = new EdgeField("selectblanksimple","counters_title_font_style","","Font Style","This is some description",$options_fontstyle);
                        $row2->addChild("counters_title_font_style",$counters_title_font_style);

                        $counters_title_font_weight = new EdgeField("selectblanksimple","counters_title_font_weight","","Font Weight","This is some description",$options_fontweight);
                        $row2->addChild("counters_title_font_weight",$counters_title_font_weight);

                        $counters_title_letter_spacing = new EdgeField("textsimple","counters_title_letter_spacing","","Letter Spacing (px)","This is some description");
                        $row2->addChild("counters_title_letter_spacing",$counters_title_letter_spacing);


//Expandable Section

$panel5 = new EdgePanel("Expandable Section","expandable_section_panel");
$elementsPage->addChild("panel5",$panel5);

        $group1 = new EdgeGroup("Title Style","Define Expandable Section title style");
        $panel5->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $expandable_label_color = new EdgeField("colorsimple","expandable_label_color","","Text Color","This is some description");
                        $row1->addChild("expandable_label_color",$expandable_label_color);

                        $expandable_label_font_size = new EdgeField("textsimple","expandable_label_font_size","","Font Size (px)","This is some description");
                        $row1->addChild("expandable_label_font_size",$expandable_label_font_size);

                        $expandable_label_text_transform = new EdgeField("selectblanksimple","expandable_label_text_transform","","Text Transform","This is some description",$options_texttransform);
                        $row1->addChild("expandable_label_text_transform",$expandable_label_text_transform);

                $row2 = new EdgeRow(true);
                $group1->addChild("row2",$row2);

                        $expandable_label_font_family = new EdgeField("Fontsimple","expandable_label_font_family","-1","Font Family","This is some description");
                        $row2->addChild("expandable_label_font_family",$expandable_label_font_family);

                        $expandable_label_font_weight = new EdgeField("selectblanksimple","expandable_label_font_weight","","Font Weight","This is some description",$options_fontweight);
                        $row2->addChild("expandable_label_font_weight",$expandable_label_font_weight);

                        $expandable_label_letter_spacing = new EdgeField("textsimple","expandable_label_letter_spacing","","Letter Spacing (px)","This is some description");
                        $row2->addChild("expandable_label_letter_spacing",$expandable_label_letter_spacing);

                $row3 = new EdgeRow(true);
                $group1->addChild("row3",$row3);

                        $expandable_background_color = new EdgeField("colorsimple","expandable_background_color","","Background Color","This is some description");
                        $row3->addChild("expandable_background_color",$expandable_background_color);

                        $expandable_label_hover_color = new EdgeField("colorsimple","expandable_label_hover_color","","Hover Text Color","This is some description");
                        $row3->addChild("expandable_label_hover_color",$expandable_label_hover_color);

        //Highlight

        $panel17 = new EdgePanel("Highlight","highlight_panel");
        $elementsPage->addChild("panel17",$panel17);
        $highlight_color = new EdgeField("color","highlight_color","","Highlight Color","Set color for Highlight");
        $panel17->addChild("highlight_color",$highlight_color);

//Horizontal Progress Bars

$panel6 = new EdgePanel("Horizontal Progress Bars", "horizontal_progress_bars_panel");
$elementsPage->addChild("panel6",$panel6);

    	$group1 = new EdgeGroup("Progress Bar Title Style","Define styles for Horizontal Progress Bars title");
    	$panel6->addChild("group1",$group1);

        		$row1 = new EdgeRow();
        		$group1->addChild("row1",$row1);

            			$progress_bar_horizontal_font_size = new EdgeField("textsimple","progress_bar_horizontal_font_size","","Font Size (px)","This is some description");
            			$row1->addChild("progress_bar_horizontal_font_size",$progress_bar_horizontal_font_size);

                        $progress_bar_horizontal_color = new EdgeField("colorsimple","progress_bar_horizontal_color","","Text Color","This is some description");
                        $row1->addChild("progress_bar_horizontal_color",$progress_bar_horizontal_color);

            			$progress_bar_horizontal_line_height = new EdgeField("textsimple","progress_bar_horizontal_line_height","","Line Height (px)","This is some description");
            			$row1->addChild("progress_bar_horizontal_line_height",$progress_bar_horizontal_line_height);            			

            			$progress_bar_horizontal_font_family = new EdgeField("Fontsimple","progress_bar_horizontal_font_family","-1","Font Family","This is some description");
            			$row1->addChild("progress_bar_horizontal_font_family",$progress_bar_horizontal_font_family);

        		$row2 = new EdgeRow(true);
        		$group1->addChild("row2",$row2);

            			$progress_bar_horizontal_font_style = new EdgeField("selectblanksimple","progress_bar_horizontal_font_style","","Font Style","This is some description",$options_fontstyle);
            			$row2->addChild("progress_bar_horizontal_font_style",$progress_bar_horizontal_font_style);

            			$progress_bar_horizontal_font_weight = new EdgeField("selectblanksimple","progress_bar_horizontal_font_weight","","Font Weight","This is some description",$options_fontweight);
            			$row2->addChild("progress_bar_horizontal_font_weight",$progress_bar_horizontal_font_weight);

            			$progress_bar_horizontal_letter_spacing = new EdgeField("textsimple","progress_bar_horizontal_letter_spacing","","Letter Spacing (px)","This is some description");
            			$row2->addChild("progress_bar_horizontal_letter_spacing",$progress_bar_horizontal_letter_spacing);

                        $progress_bar_horizontal_text_transform = new EdgeField("selectblanksimple","progress_bar_horizontal_text_transform","","Text Transform","This is some description",$options_texttransform);
                        $row2->addChild("progress_bar_horizontal_text_transform",$progress_bar_horizontal_text_transform);
                        

        	$group2 = new EdgeGroup("Progress Bar Percentage Style","Define styles for Horizontal Progress Bars percentage");
        	$panel6->addChild("group2",$group2);

        		$row1 = new EdgeRow();
        		$group2->addChild("row1",$row1);

        			    $progress_bar_horizontal_percentage_font_size = new EdgeField("textsimple","progress_bar_horizontal_percentage_font_size","","Font Size (px)","This is some description");
            			$row1->addChild("progress_bar_horizontal_percentage_font_size",$progress_bar_horizontal_percentage_font_size);

                        $progress_bar_horizontal_percentage_color = new EdgeField("colorsimple","progress_bar_horizontal_percentage_color","","Text Color","This is some description");
                        $row1->addChild("progress_bar_horizontal_percentage_color",$progress_bar_horizontal_percentage_color);

            			$progress_bar_horizontal_percentage_line_height = new EdgeField("textsimple","progress_bar_horizontal_percentage_line_height","","Line Height (px)","This is some description");
            			$row1->addChild("progress_bar_horizontal_percentage_line_height",$progress_bar_horizontal_percentage_line_height);            			

            			$progress_bar_horizontal_percentage_font_family = new EdgeField("Fontsimple","progress_bar_horizontal_percentage_font_family","-1","Font Family","This is some description");
            			$row1->addChild("progress_bar_horizontal_percentage_font_family",$progress_bar_horizontal_percentage_font_family);

        		$row2 = new EdgeRow(true);
        		$group2->addChild("row2",$row2);

            			$progress_bar_horizontal_percentage_font_style = new EdgeField("selectblanksimple","progress_bar_horizontal_percentage_font_style","","Font Style","This is some description",$options_fontstyle);
            			$row2->addChild("progress_bar_horizontal_percentage_font_style",$progress_bar_horizontal_percentage_font_style);

            			$progress_bar_horizontal_percentage_font_weight = new EdgeField("selectblanksimple","progress_bar_horizontal_percentage_font_weight","","Font Weight","This is some description",$options_fontweight);
            			$row2->addChild("progress_bar_horizontal_percentage_font_weight",$progress_bar_horizontal_percentage_font_weight);

            			$progress_bar_horizontal_percentage_letter_spacing = new EdgeField("textsimple","progress_bar_horizontal_percentage_letter_spacing","","Letter Spacing (px)","This is some description");
            			$row2->addChild("progress_bar_horizontal_percentage_letter_spacing",$progress_bar_horizontal_percentage_letter_spacing);

                        $progress_bar_horizontal_percentage_text_transform = new EdgeField("selectblanksimple","progress_bar_horizontal_percentage_text_transform","","Text Transform","This is some description",$options_texttransform);
                        $row2->addChild("progress_bar_horizontal_percentage_text_transform",$progress_bar_horizontal_percentage_text_transform);
//Vertical Progress Bars

$panel73 = new EdgePanel("Vertical Progress Bars", "vertical_progress_bars_panel");
$elementsPage->addChild("panel73",$panel73);

        $group1 = new EdgeGroup("Progress Bar Title Style","Define styles for Vertical Progress Bars title");
        $panel73->addChild("group1",$group1);

                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $progress_bar_vertical_font_size = new EdgeField("textsimple","progress_bar_vertical_font_size","","Font Size (px)","This is some description");
                        $row1->addChild("progress_bar_vertical_font_size",$progress_bar_vertical_font_size);

                        $progress_bar_vertical_color = new EdgeField("colorsimple","progress_bar_vertical_color","","Text Color","This is some description");
                        $row1->addChild("progress_bar_vertical_color",$progress_bar_vertical_color);

                        $progress_bar_vertical_line_height = new EdgeField("textsimple","progress_bar_vertical_line_height","","Line Height (px)","This is some description");
                        $row1->addChild("progress_bar_vertical_line_height",$progress_bar_vertical_line_height);                        

                        $progress_bar_vertical_font_family = new EdgeField("Fontsimple","progress_bar_vertical_font_family","-1","Font Family","This is some description");
                        $row1->addChild("progress_bar_vertical_font_family",$progress_bar_vertical_font_family);

                $row2 = new EdgeRow(true);
                $group1->addChild("row2",$row2);

                        $progress_bar_vertical_font_style = new EdgeField("selectblanksimple","progress_bar_vertical_font_style","","Font Style","This is some description",$options_fontstyle);
                        $row2->addChild("progress_bar_vertical_font_style",$progress_bar_vertical_font_style);

                        $progress_bar_vertical_font_weight = new EdgeField("selectblanksimple","progress_bar_vertical_font_weight","","Font Weight","This is some description",$options_fontweight);
                        $row2->addChild("progress_bar_vertical_font_weight",$progress_bar_vertical_font_weight);

                        $progress_bar_vertical_letter_spacing = new EdgeField("textsimple","progress_bar_vertical_letter_spacing","","Letter Spacing (px)","This is some description");
                        $row2->addChild("progress_bar_vertical_letter_spacing",$progress_bar_vertical_letter_spacing);

                        $progress_bar_vertical_text_transform = new EdgeField("selectblanksimple","progress_bar_vertical_text_transform","","Text Transform","This is some description",$options_texttransform);
                        $row2->addChild("progress_bar_vertical_text_transform",$progress_bar_vertical_text_transform);

            $group2 = new EdgeGroup("Progress Bar Percentage Style","Define styles for Vertical Progress Bars percentage");
            $panel73->addChild("group2",$group2);

                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $progress_bar_vertical_percentage_font_size = new EdgeField("textsimple","progress_bar_vertical_percentage_font_size","","Font Size (px)","This is some description");
                        $row1->addChild("progress_bar_vertical_percentage_font_size",$progress_bar_vertical_percentage_font_size);

                        $progress_bar_vertical_percentage_color = new EdgeField("colorsimple","progress_bar_vertical_percentage_color","","Text Color","This is some description");
                        $row1->addChild("progress_bar_vertical_percentage_color",$progress_bar_vertical_percentage_color);

                        $progress_bar_vertical_percentage_line_height = new EdgeField("textsimple","progress_bar_vertical_percentage_line_height","","Line Height (px)","This is some description");
                        $row1->addChild("progress_bar_vertical_percentage_line_height",$progress_bar_vertical_percentage_line_height);                        

                        $progress_bar_vertical_percentage_font_family = new EdgeField("Fontsimple","progress_bar_vertical_percentage_font_family","-1","Font Family","This is some description");
                        $row1->addChild("progress_bar_vertical_percentage_font_family",$progress_bar_vertical_percentage_font_family);

                $row2 = new EdgeRow(true);
                $group2->addChild("row2",$row2);

                        $progress_bar_vertical_percentage_font_style = new EdgeField("selectblanksimple","progress_bar_vertical_percentage_font_style","","Font Style","This is some description",$options_fontstyle);
                        $row2->addChild("progress_bar_vertical_percentage_font_style",$progress_bar_vertical_percentage_font_style);

                        $progress_bar_vertical_percentage_font_weight = new EdgeField("selectblanksimple","progress_bar_vertical_percentage_font_weight","","Font Weight","This is some description",$options_fontweight);
                        $row2->addChild("progress_bar_vertical_percentage_font_weight",$progress_bar_vertical_percentage_font_weight);

                        $progress_bar_vertical_percentage_letter_spacing = new EdgeField("textsimple","progress_bar_vertical_percentage_letter_spacing","","Letter Spacing (px)","This is some description");
                        $row2->addChild("progress_bar_vertical_percentage_letter_spacing",$progress_bar_vertical_percentage_letter_spacing);

                        $progress_bar_vertical_percentage_text_transform = new EdgeField("selectblanksimple","progress_bar_vertical_percentage_text_transform","","Text Transform","This is some description",$options_texttransform);
                        $row2->addChild("progress_bar_vertical_percentage_text_transform",$progress_bar_vertical_percentage_text_transform);

//Icon

$panel19 = new EdgePanel("Icons", "icons_panel");
$elementsPage->addChild("panel19",$panel19);

        $group1 = new EdgeGroup("Normal Icons","Define Normal Icons style");
        $panel19->addChild("group1",$group1);

                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $icon_color_normal = new EdgeField("colorsimple","icon_color_normal","","Icon Color","This is some description");
                        $row1->addChild("icon_color_normal",$icon_color_normal);

                        $icon_hover_color_normal = new EdgeField("colorsimple","icon_hover_color_normal","","Icon Hover Color","This is some description");
                        $row1->addChild("icon_hover_color_normal",$icon_hover_color_normal);

        $group2 = new EdgeGroup("Icons Circle/Square","Define circle/square Icons style");
        $panel19->addChild("group2",$group2);

                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $icon_color = new EdgeField("colorsimple","icon_color","","Icon Color","This is some description");
                        $row1->addChild("icon_color",$icon_color);

                        $icon_hover_color = new EdgeField("colorsimple","icon_hover_color","","Icon Hover Color","This is some description");
                        $row1->addChild("icon_hover_color",$icon_hover_color);

                        $icon_background_color = new EdgeField("colorsimple","icon_background_color","","Icon Background Color","This is some description");
                        $row1->addChild("icon_background_color",$icon_background_color);

                        $icon_hover_background_color = new EdgeField("colorsimple","icon_hover_background_color","","Icon Hover Background Color","This is some description");
                        $row1->addChild("icon_hover_background_color",$icon_hover_background_color);

                $row2 = new EdgeRow(true);
                $group2->addChild("row2",$row2);

                        $icon_border_width = new EdgeField("textsimple","icon_border_width","","Icon Border Width","This is some description");
                        $row2->addChild("icon_border_width",$icon_border_width);

                        $icon_border_color = new EdgeField("colorsimple","icon_border_color","","Icon Border Color","This is some description");
                        $row2->addChild("icon_border_color",$icon_border_color);

                        $icon_hover_border_color = new EdgeField("colorsimple","icon_hover_border_color","","Icon Hover Border Color","This is some description");
                        $row2->addChild("icon_hover_border_color",$icon_hover_border_color);

        $icon_box_shadows = new EdgeField('yesno', 'icon_box_shadows', 'no', 'Show Icon Shadows', 'Enabling this option will show icon shadow', array(), array(
            'dependence' => true,
            'dependence_hide_on_yes' => '',
            'dependence_show_on_yes' => '#edgtf_icon_box_shadows_container'
        ));
        $panel19->addChild('icon_box_shadows', $icon_box_shadows);

        $icon_box_shadows_container = new EdgeContainer('icon_box_shadows_container', 'icon_box_shadows', 'no');
        $panel19->addChild('icon_box_shadows_container', $icon_box_shadows_container);

            $group3 = new EdgeGroup('Icon Shadows', 'Set horizontal and vertical position of shadow (negative values are allowed), and define blur and spread.');
            $icon_box_shadows_container->addChild('group3', $group3);

                $row3 = new EdgeRow();
                $group3->addChild('row3', $row3);

                    $icon_box_shadow_horizontal_shadow = new EdgeField('textsimple', 'icon_box_shadow_horizontal_shadow', '', 'Horizontal Shadow (px)');
                    $row3->addChild('icon_box_shadow_horizontal_shadow', $icon_box_shadow_horizontal_shadow);

                    $icon_box_shadow_vertical_shadow = new EdgeField('textsimple', 'icon_box_shadow_vertical_shadow', '', 'Vertical Shadow (px)');
                    $row3->addChild('icon_box_shadow_vertical_shadow', $icon_box_shadow_vertical_shadow);

                    $icon_box_shadow_blur_distance = new EdgeField('textsimple', 'icon_box_shadow_blur_distance', '', 'Blur (px)');
                    $row3->addChild('icon_box_shadow_blur_distance', $icon_box_shadow_blur_distance);

                    $icon_box_shadow_shadow_size = new EdgeField('textsimple', 'icon_box_shadow_shadow_size', '', 'Spread (px)');
                    $row3->addChild('icon_box_shadow_shadow_size', $icon_box_shadow_shadow_size);

                $row4 = new EdgeRow(true);
                $group3->addChild('row4', $row4);

                    $icon_box_shadow_shadow_color = new EdgeField('colorsimple', 'icon_box_shadow_shadow_color', '', 'Shadow color');
                    $row4->addChild('icon_box_shadow_shadow_color', $icon_box_shadow_shadow_color);

$panel21 = new EdgePanel("Icon With Text", "icon_with_text_panel");
$elementsPage->addChild("panel21",$panel21);

        $group1 = new EdgeGroup("Normal Icons","Define Normal Icons style");
        $panel21->addChild("group1",$group1);

                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $icon_with_text_icon_color_normal = new EdgeField("colorsimple","icon_with_text_icon_color_normal","","Icon Color","This is some description");
                        $row1->addChild("icon_with_text_icon_color_normal",$icon_with_text_icon_color_normal);

                        $icon_with_text_icon_hover_color_normal = new EdgeField("colorsimple","icon_with_text_icon_hover_color_normal","","Icon Hover Color","This is some description");
                        $row1->addChild("icon_with_text_icon_hover_color_normal",$icon_with_text_icon_hover_color_normal);

        $group2 = new EdgeGroup("Icons Circle/Square","Define circle/square Icons style");
        $panel21->addChild("group2",$group2);

                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $icon_with_text_icon_color = new EdgeField("colorsimple","icon_with_text_icon_color","","Icon Color","This is some description");
                        $row1->addChild("icon_with_text_icon_color",$icon_with_text_icon_color);

                        $icon_with_text_icon_hover_color = new EdgeField("colorsimple","icon_with_text_icon_hover_color","","Icon Hover Color","This is some description");
                        $row1->addChild("icon_with_text_icon_hover_color",$icon_with_text_icon_hover_color);

                        $icon_with_text_icon_background_color = new EdgeField("colorsimple","icon_with_text_icon_background_color","","Icon Background Color","This is some description");
                        $row1->addChild("icon_with_text_icon_background_color",$icon_with_text_icon_background_color);

                        $icon_with_text_icon_hover_background_color = new EdgeField("colorsimple","icon_with_text_icon_hover_background_color","","Icon Hover Background Color","This is some description");
                        $row1->addChild("icon_with_text_icon_hover_background_color",$icon_with_text_icon_hover_background_color);

                $row2 = new EdgeRow(true);
                $group2->addChild("row2",$row2);

                        $icon_with_text_icon_border_width = new EdgeField("textsimple","icon_with_text_icon_border_width","","Icon Border Width","This is some description");
                        $row2->addChild("icon_with_text_icon_border_width",$icon_with_text_icon_border_width);

                        $icon_with_text_icon_border_color = new EdgeField("colorsimple","icon_with_text_icon_border_color","","Icon Border Color","This is some description");
                        $row2->addChild("icon_with_text_icon_border_color",$icon_with_text_icon_border_color);

                        $icon_with_text_icon_hover_border_color = new EdgeField("colorsimple","icon_with_text_icon_hover_border_color","","Icon Hover Border Color","This is some description");
                        $row2->addChild("icon_with_text_icon_hover_border_color",$icon_with_text_icon_hover_border_color);

        $icon_with_text_box_shadows = new EdgeField('yesno', 'icon_with_text_box_shadows', 'no', 'Show Icon Shadows', 'Enabling this option will show icon shadow', array(), array(
            'dependence' => true,
            'dependence_hide_on_yes' => '',
            'dependence_show_on_yes' => '#edgtf_icon_with_text_box_shadows_container'
        ));
        $panel21->addChild('icon_with_text_box_shadows', $icon_with_text_box_shadows);

            $icon_with_text_box_shadows_container = new EdgeContainer('icon_with_text_box_shadows_container', 'icon_with_text_box_shadows', 'no');
            $panel21->addChild('icon_with_text_box_shadows_container', $icon_with_text_box_shadows_container);

                $group3 = new EdgeGroup('Icon Shadows', 'Set horizontal and vertical position of shadow (negative values are allowed), and define blur and spread.');
                $icon_with_text_box_shadows_container->addChild('group3', $group3);

                    $row3 = new EdgeRow();
                    $group3->addChild('row3', $row3);

                        $icon_with_text_box_shadow_horizontal_shadow = new EdgeField('textsimple', 'icon_with_text_box_shadow_horizontal_shadow', '', 'Horizontal Shadow (px)');
                        $row3->addChild('icon_with_text_box_shadow_horizontal_shadow', $icon_with_text_box_shadow_horizontal_shadow);

                        $icon_with_text_box_shadow_vertical_shadow = new EdgeField('textsimple', 'icon_with_text_box_shadow_vertical_shadow', '', 'Vertical Shadow (px)');
                        $row3->addChild('icon_with_text_box_shadow_vertical_shadow', $icon_with_text_box_shadow_vertical_shadow);

                        $icon_with_text_box_shadow_blur_distance = new EdgeField('textsimple', 'icon_with_text_box_shadow_blur_distance', '', 'Blur (px)');
                        $row3->addChild('icon_with_text_box_shadow_blur_distance', $icon_with_text_box_shadow_blur_distance);

                        $icon_with_text_box_shadow_shadow_size = new EdgeField('textsimple', 'icon_with_text_box_shadow_shadow_size', '', 'Spread (px)');
                        $row3->addChild('icon_with_text_box_shadow_shadow_size', $icon_with_text_box_shadow_shadow_size);

                    $row4 = new EdgeRow(true);
                    $group3->addChild('row4', $row4);

                        $icon_with_text_box_shadow_shadow_color = new EdgeField('colorsimple', 'icon_with_text_box_shadow_shadow_color', '', 'Shadow color');
                        $row4->addChild('icon_with_text_box_shadow_shadow_color', $icon_with_text_box_shadow_shadow_color);

//Input Fields

$panel7 = new EdgePanel("Input Fields","input_fields_panel");
$elementsPage->addChild("panel7",$panel7);

        $group1 = new EdgeGroup("Input Fields Style","Define styles for Input Fields");
        $panel7->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $input_background_color = new EdgeField("colorsimple","input_background_color","","Background Color","This is some description");
                        $row1->addChild("input_background_color",$input_background_color);

                        $input_focus_background_color = new EdgeField("colorsimple","input_focus_background_color","","Focus Background Color","This is some description");
                        $row1->addChild("input_focus_background_color",$input_focus_background_color);

                        $input_border_color = new EdgeField("colorsimple","input_border_color","","Border Color","This is some description");
                        $row1->addChild("input_border_color",$input_border_color);

                        $input_focus_border_color = new EdgeField("colorsimple","input_focus_border_color","","Focus Border Color","This is some description");
                        $row1->addChild("input_focus_border_color",$input_focus_border_color);

                $row2 = new EdgeRow(true);
                $group1->addChild("row2",$row2);

                        $input_text_color = new EdgeField("colorsimple","input_text_color","","Text Color","This is some description");
                        $row2->addChild("input_text_color",$input_text_color);

                        $input_focus_text_color = new EdgeField("colorsimple","input_focus_text_color","","Focus Text Color","This is some description");
                        $row2->addChild("input_focus_text_color",$input_focus_text_color);

//Interactive Banners

$panel71 = new EdgePanel("Interactive Banners","interactive_banners_panel");
$elementsPage->addChild("panel71",$panel71);

        $group1 = new EdgeGroup("Interactive Banners Style","Define styles for Interactive Banners");
        $panel71->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $interactive_banners_background_color = new EdgeField("colorsimple","interactive_banners_background_color","","Image Overlay Color","This is some description");
                        $row1->addChild("interactive_banners_background_color",$interactive_banners_background_color);

                        $interactive_banners_background_transparency = new EdgeField("textsimple","interactive_banners_background_transparency","","Image Overlay Color Transparency (0-1)","This is some description");
                        $row1->addChild("interactive_banners_background_transparency",$interactive_banners_background_transparency);

                        $interactive_banners_hover_background_color = new EdgeField("colorsimple","interactive_banners_hover_background_color","","Image Overlay Hover Color","This is some description");
                        $row1->addChild("interactive_banners_hover_background_color",$interactive_banners_hover_background_color);

                        $interactive_banners_hover_background_transparency = new EdgeField("textsimple","interactive_banners_hover_background_transparency (0-1)","","Image Overlay Hover Color Transparency","This is some description");
                        $row1->addChild("interactive_banners_hover_background_transparency",$interactive_banners_hover_background_transparency);

//Lists

$panel72 = new EdgePanel("Lists","lists");
$elementsPage->addChild("panel72",$panel72);

        $group1 = new EdgeGroup("Unordered List Style","Define styles for Unordered Lists");
        $panel72->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $list_item_color = new EdgeField("colorsimple","list_item_color","","List Bullet Color","This is some description");
                        $row1->addChild("list_item_color",$list_item_color);
				$row2 = new EdgeRow(true);
                $group1->addChild("row2",$row2);

                        $list_color = new EdgeField("colorsimple","list_color","","Text Color","This is some description");
                        $row2->addChild("list_color",$list_color);

                        $list_fontsize = new EdgeField("textsimple","list_fontsize","","Font Size (px)","This is some description");
                        $row2->addChild("list_fontsize",$list_fontsize);

                        $list_lineheight = new EdgeField("textsimple","list_lineheight","","Line Height (px)","This is some description");
                        $row2->addChild("list_lineheight",$list_lineheight);

                        $list_texttransform = new EdgeField("selectblanksimple","list_texttransform","","Text Transform","This is some description",$options_texttransform);
                        $row2->addChild("list_texttransform",$list_texttransform);

                $row3 = new EdgeRow(true);
                $group1->addChild("row3",$row3);
                        $list_google_fonts = new EdgeField("Fontsimple","list_google_fonts","-1","Font Family","This is some description");
                        $row3->addChild("list_google_fonts",$list_google_fonts);

                        $list_fontstyle = new EdgeField("selectblanksimple","list_fontstyle","","Font Style","This is some description",$options_fontstyle);
                        $row3->addChild("list_fontstyle",$list_fontstyle);

                        $list_fontweight = new EdgeField("selectblanksimple","list_fontweight","","Font Weight","This is some description",$options_fontweight);
                        $row3->addChild("list_fontweight",$list_fontweight);

                        $list_letter_spacing = new EdgeField("textsimple","list_letter_spacing","","Letter Spacing (px)","This is some description");
                        $row3->addChild("list_letter_spacing",$list_letter_spacing);
				$row4 = new EdgeRow(true);
                $group1->addChild("row4",$row4);
					 $list_bottom_margin = new EdgeField("textsimple","list_bottom_margin","","Item bottom margin (px)","This is some description");
                     $row4->addChild("list_bottom_margin",$list_bottom_margin);
                       

		$group2 = new EdgeGroup("Ordered List Style","Define styles for Ordered lists");
        $panel72->addChild("group2",$group2);
                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $list_ordered_item_color = new EdgeField("colorsimple","list_ordered_item_color","","List Number Color","This is some description");
                        $row1->addChild("list_ordered_item_color",$list_ordered_item_color);
				$row2 = new EdgeRow(true);
                $group2->addChild("row2",$row2);

                        $list_ordered_color = new EdgeField("colorsimple","list_ordered_color","","Text Color","This is some description");
                        $row2->addChild("list_ordered_color",$list_ordered_color);

                        $list_ordered_fontsize = new EdgeField("textsimple","list_ordered_fontsize","","Font Size (px)","This is some description");
                        $row2->addChild("list_ordered_fontsize",$list_ordered_fontsize);

                        $list_ordered_lineheight = new EdgeField("textsimple","list_ordered_lineheight","","Line Height (px)","This is some description");
                        $row2->addChild("list_ordered_lineheight",$list_ordered_lineheight);

                        $list_ordered_texttransform = new EdgeField("selectblanksimple","list_ordered_texttransform","","Text Transform","This is some description",$options_texttransform);
                        $row2->addChild("list_ordered_texttransform",$list_ordered_texttransform);

                $row3 = new EdgeRow(true);
                $group2->addChild("row3",$row3);
                        $list_ordered_google_fonts = new EdgeField("Fontsimple","list_ordered_google_fonts","-1","Font Family","This is some description");
                        $row3->addChild("list_ordered_google_fonts",$list_ordered_google_fonts);

                        $list_ordered_fontstyle = new EdgeField("selectblanksimple","list_ordered_fontstyle","","Font Style","This is some description",$options_fontstyle);
                        $row3->addChild("list_ordered_fontstyle",$list_ordered_fontstyle);

                        $list_ordered_fontweight = new EdgeField("selectblanksimple","list_ordered_fontweight","","Font Weight","This is some description",$options_fontweight);
                        $row3->addChild("list_ordered_fontweight",$list_ordered_fontweight);

                        $list_ordered_letter_spacing = new EdgeField("textsimple","list_ordered_letter_spacing","","Letter Spacing (px)","This is some description");
                        $row3->addChild("list_ordered_letter_spacing",$list_ordered_letter_spacing);
				$row4 = new EdgeRow(true);
                $group2->addChild("row4",$row4);
					 $list_ordered_bottom_margin = new EdgeField("textsimple","list_ordered_bottom_margin","","Item bottom margin (px)","This is some description");
                     $row4->addChild("list_ordered_bottom_margin",$list_ordered_bottom_margin);
					 
//Masonry Gallery
$panel30 = new EdgePanel('Masonry Gallery', 'masonry_gallery_panel');
$elementsPage->addChild('panel30', $panel30);

    //Square Big
    $masonry_gallery_square_big_title = new EdgeTitle('masonry_gallery_square_big_title', 'Square Big');
    $panel30->addChild('masonry_gallery_square_big_title', $masonry_gallery_square_big_title);

    $masonry_gallery_square_big_title_group = new EdgeGroup('Title Style', 'Define Square Big Title Style');
    $panel30->addChild('masonry_gallery_square_big_title_group', $masonry_gallery_square_big_title_group);

        $row1 = new EdgeRow();
        $masonry_gallery_square_big_title_group->addChild("row1",$row1);

            $masonry_gallery_square_big_title_color = new EdgeField('colorsimple','masonry_gallery_square_big_title_color', '', 'Title Color');
            $row1->addChild('masonry_gallery_square_big_title_color', $masonry_gallery_square_big_title_color);

            $masonry_gallery_square_big_title_font_size = new EdgeField('textsimple', 'masonry_gallery_square_big_title_font_size', '', 'Font size (px)');
            $row1->addChild('masonry_gallery_square_big_title_font_size', $masonry_gallery_square_big_title_font_size);

            $masonry_gallery_square_big_title_line_height = new EdgeField('textsimple', 'masonry_gallery_square_big_title_line_height', '', 'Line Height (px)');
            $row1->addChild('masonry_gallery_square_big_title_line_height', $masonry_gallery_square_big_title_line_height);

            $masonry_gallery_square_big_title_text_transform = new EdgeField('selectblanksimple', 'masonry_gallery_square_big_title_text_transform', '', 'Text Transform', '', $options_texttransform);
            $row1->addChild('masonry_gallery_square_big_title_text_transform', $masonry_gallery_square_big_title_text_transform);

        $row2 = new EdgeRow(true);
        $masonry_gallery_square_big_title_group->addChild("row2",$row2);

            $masonry_gallery_square_big_title_font_family = new EdgeField('fontsimple', 'masonry_gallery_square_big_title_font_family', '-1', 'Font Family');
            $row2->addChild('masonry_gallery_square_big_title_font_family', $masonry_gallery_square_big_title_font_family);

            $masonry_gallery_square_big_title_font_style = new EdgeField('selectblanksimple', 'masonry_gallery_square_big_title_font_style', '', 'Font Style', '', $options_fontstyle);
            $row2->addChild('masonry_gallery_square_big_title_font_style', $masonry_gallery_square_big_title_font_style);

            $masonry_gallery_square_big_title_font_weight = new EdgeField('selectblanksimple', 'masonry_gallery_square_big_title_font_weight', '', 'Font Weight', '', $options_fontweight);
            $row2->addChild('masonry_gallery_square_big_title_font_weight', $masonry_gallery_square_big_title_font_weight);

            $masonry_gallery_square_big_title_letter_spacing = new EdgeField('textsimple', 'masonry_gallery_square_big_title_letter_spacing', '', 'Letter Spacing');
            $row2->addChild('masonry_gallery_square_big_title_letter_spacing', $masonry_gallery_square_big_title_letter_spacing);
			
		$row3 = new EdgeRow(true);
        $masonry_gallery_square_big_title_group->addChild("row3",$row3);	
		
			$masonry_gallery_square_big_title_margin_bottom = new EdgeField('textsimple', 'masonry_gallery_square_big_title_margin_bottom', '', 'Margin Bottom');
            $row3->addChild('masonry_gallery_square_big_title_margin_bottom', $masonry_gallery_square_big_title_margin_bottom);

    $masonry_gallery_square_big_text_group = new EdgeGroup('Text Style', 'Define Square Big Text Style');
    $panel30->addChild('masonry_gallery_square_big_text_group', $masonry_gallery_square_big_text_group);

        $row1 = new EdgeRow();
        $masonry_gallery_square_big_text_group->addChild("row1",$row1);

            $masonry_gallery_square_big_text_color = new EdgeField('colorsimple','masonry_gallery_square_big_text_color', '', 'Text Color');
            $row1->addChild('masonry_gallery_square_big_text_color', $masonry_gallery_square_big_text_color);

            $masonry_gallery_square_big_text_font_size = new EdgeField('textsimple', 'masonry_gallery_square_big_text_font_size', '', 'Font size (px)');
            $row1->addChild('masonry_gallery_square_big_text_font_size', $masonry_gallery_square_big_text_font_size);

            $masonry_gallery_square_big_text_line_height = new EdgeField('textsimple', 'masonry_gallery_square_big_text_line_height', '', 'Line Height (px)');
            $row1->addChild('masonry_gallery_square_big_text_line_height', $masonry_gallery_square_big_text_line_height);

            $masonry_gallery_square_big_text_text_transform = new EdgeField('selectblanksimple', 'masonry_gallery_square_big_text_text_transform', '', 'Text Transform', '', $options_texttransform);
            $row1->addChild('masonry_gallery_square_big_text_text_transform', $masonry_gallery_square_big_text_text_transform);

        $row2 = new EdgeRow(true);
        $masonry_gallery_square_big_text_group->addChild("row2",$row2);

            $masonry_gallery_square_big_text_font_family = new EdgeField('fontsimple', 'masonry_gallery_square_big_text_font_family', '-1', 'Font Family');
            $row2->addChild('masonry_gallery_square_big_text_font_family', $masonry_gallery_square_big_text_font_family);

            $masonry_gallery_square_big_text_font_style = new EdgeField('selectblanksimple', 'masonry_gallery_square_big_text_font_style', '', 'Font Style', '', $options_fontstyle);
            $row2->addChild('masonry_gallery_square_big_text_font_style', $masonry_gallery_square_big_text_font_style);

            $masonry_gallery_square_big_text_font_weight = new EdgeField('selectblanksimple', 'masonry_gallery_square_big_text_font_weight', '', 'Font Weight', '', $options_fontweight);
            $row2->addChild('masonry_gallery_square_big_text_font_weight', $masonry_gallery_square_big_text_font_weight);

            $masonry_gallery_square_big_text_letter_spacing = new EdgeField('textsimple', 'masonry_gallery_square_big_text_letter_spacing', '', 'Letter Spacing');
            $row2->addChild('masonry_gallery_square_big_text_letter_spacing', $masonry_gallery_square_big_text_letter_spacing);

    $masonry_gallery_square_big_button_group = new EdgeGroup('Button Style', 'Define Square Big Button Style');
    $panel30->addChild('masonry_gallery_square_big_button_group', $masonry_gallery_square_big_button_group);

        $row1 = new EdgeRow();
        $masonry_gallery_square_big_button_group->addChild('row1', $row1);

            $masonry_gallery_square_big_button_font_family = new EdgeField('fontsimple', 'masonry_gallery_square_big_button_font_family', '-1', 'Font Family');
            $row1->addChild('masonry_gallery_square_big_button_font_family', $masonry_gallery_square_big_button_font_family);

            $masonry_gallery_square_big_button_font_style = new EdgeField('selectblanksimple', 'masonry_gallery_square_big_button_font_style', '', 'Font Style', '', $options_fontstyle);
            $row1->addChild('masonry_gallery_square_big_button_font_style', $masonry_gallery_square_big_button_font_style);

            $masonry_gallery_square_big_button_font_weight = new EdgeField('selectblanksimple', 'masonry_gallery_square_big_button_font_weight', '', 'Font Weight', '', $options_fontweight);
            $row1->addChild('masonry_gallery_square_big_button_font_weight', $masonry_gallery_square_big_button_font_weight);

            $masonry_gallery_square_big_button_text_transform = new EdgeField('selectblanksimple', 'masonry_gallery_square_big_button_text_transform', '', 'Text Transform', '', $options_texttransform);
            $row1->addChild('masonry_gallery_square_big_button_text_transform', $masonry_gallery_square_big_button_text_transform);

        $row2 = new EdgeRow(true);
        $masonry_gallery_square_big_button_group->addChild('row2', $row2);

            $masonry_gallery_square_big_button_font_size = new EdgeField('textsimple', 'masonry_gallery_square_big_button_font_size', '', 'Text Size (px)');
            $row2->addChild('masonry_gallery_square_big_button_font_size', $masonry_gallery_square_big_button_font_size);

            $masonry_gallery_square_big_button_line_height = new EdgeField('textsimple', 'masonry_gallery_square_big_button_line_height', '', 'Line Height (px)');
            $row2->addChild('masonry_gallery_square_big_button_line_height', $masonry_gallery_square_big_button_line_height);

            $masonry_gallery_square_big_button_letter_spacing = new EdgeField('textsimple', 'masonry_gallery_square_big_button_letter_spacing', '', 'Letter Spacing (px)');
            $row2->addChild('masonry_gallery_square_big_button_letter_spacing', $masonry_gallery_square_big_button_letter_spacing);		

        $row3 = new EdgeRow(true);
        $masonry_gallery_square_big_button_group->addChild('row3', $row3);

            $masonry_gallery_square_big_button_text_color = new EdgeField('colorsimple', 'masonry_gallery_square_big_button_text_color', '', 'Text Color');
            $row3->addChild('masonry_gallery_square_big_button_text_color', $masonry_gallery_square_big_button_text_color);

            $masonry_gallery_square_big_button_hover_text_color = new EdgeField('colorsimple', 'masonry_gallery_square_big_button_hover_text_color', '', 'Hover Text Color');
            $row3->addChild('masonry_gallery_square_big_button_hover_text_color', $masonry_gallery_square_big_button_hover_text_color);

            $masonry_gallery_square_big_button_background_color = new EdgeField('colorsimple', 'masonry_gallery_square_big_button_background_color', '', 'Background Color');
            $row3->addChild('masonry_gallery_square_big_button_background_color', $masonry_gallery_square_big_button_background_color);

            $masonry_gallery_square_big_button_hover_background_color = new EdgeField('colorsimple', 'masonry_gallery_square_big_button_hover_background_color', '', 'Hover Background Color');
            $row3->addChild('masonry_gallery_square_big_button_hover_background_color', $masonry_gallery_square_big_button_hover_background_color);

        $row4 = new EdgeRow(true);
        $masonry_gallery_square_big_button_group->addChild('row4', $row4);

            $masonry_gallery_square_big_button_border_color = new EdgeField('colorsimple', 'masonry_gallery_square_big_button_border_color', '', 'Border Color');
            $row4->addChild('masonry_gallery_square_big_button_border_color', $masonry_gallery_square_big_button_border_color);

            $masonry_gallery_square_big_button_hover_border_color = new EdgeField('colorsimple', 'masonry_gallery_square_big_button_hover_border_color', '', 'Hover Border Color');
            $row4->addChild('masonry_gallery_square_big_button_hover_border_color', $masonry_gallery_square_big_button_hover_border_color);

            $masonry_gallery_square_big_button_border_width = new EdgeField('textsimple', 'masonry_gallery_square_big_button_border_width', '', 'Border Width (px)');
            $row4->addChild('masonry_gallery_square_big_button_border_width', $masonry_gallery_square_big_button_border_width);

            $masonry_gallery_square_big_button_border_radius = new EdgeField('textsimple', 'masonry_gallery_square_big_button_border_radius', '', 'Border Radius (px)');
            $row4->addChild('masonry_gallery_square_big_button_border_radius', $masonry_gallery_square_big_button_border_radius);
			
		$row5 = new EdgeRow(true);
        $masonry_gallery_square_big_button_group->addChild('row5', $row5);
		
			$masonry_gallery_square_big_button_padding_left = new EdgeField('textsimple', 'masonry_gallery_square_big_button_padding_left', '', 'Padding Left (px)');
            $row5->addChild('masonry_gallery_square_big_button_padding_left', $masonry_gallery_square_big_button_padding_left);
			
			$masonry_gallery_square_big_button_padding_right = new EdgeField('textsimple', 'masonry_gallery_square_big_button_padding_right', '', 'Padding Right (px)');
            $row5->addChild('masonry_gallery_square_big_button_padding_right', $masonry_gallery_square_big_button_padding_right);
			
			$masonry_gallery_square_big_button_margin_top = new EdgeField('textsimple', 'masonry_gallery_square_big_button_margin_top', '', 'Margin Top');
            $row5->addChild('masonry_gallery_square_big_button_margin_top', $masonry_gallery_square_big_button_margin_top);

    $masonry_gallery_square_big_icon_group = new EdgeGroup('Icon Style', 'Define Square Big Icon Style');
    $panel30->addChild('masonry_gallery_square_big_icon_group', $masonry_gallery_square_big_icon_group);

        $row1 = new EdgeRow();
        $masonry_gallery_square_big_icon_group->addChild('row1', $row1);

            $masonry_gallery_square_big_icon_color = new EdgeField('colorsimple', 'masonry_gallery_square_big_icon_color', '', 'Icon Color');
            $row1->addChild('masonry_gallery_square_big_icon_color', $masonry_gallery_square_big_icon_color);

            $masonry_gallery_square_big_icon_hover_color = new EdgeField('colorsimple', 'masonry_gallery_square_big_icon_hover_color', '', 'Icon Hover Color');
            $row1->addChild('masonry_gallery_square_big_icon_hover_color', $masonry_gallery_square_big_icon_hover_color);

            $masonry_gallery_square_big_icon_size = new EdgeField('textsimple', 'masonry_gallery_square_big_icon_size', '', 'Icon Size (px)');
            $row1->addChild('masonry_gallery_square_big_icon_size', $masonry_gallery_square_big_icon_size);
			
			$masonry_gallery_square_big_icon_margin_bottom = new EdgeField('textsimple', 'masonry_gallery_square_big_icon_margin_bottom', '', 'Margin Bottom');
            $row1->addChild('masonry_gallery_square_big_icon_margin_bottom', $masonry_gallery_square_big_icon_margin_bottom);

    $masonry_gallery_square_big_overlay_group = new EdgeGroup('Overlay Style', 'Define Square Big Overlay Style');
    $panel30->addChild('masonry_gallery_square_big_overlay_group', $masonry_gallery_square_big_overlay_group);

        $row1 = new EdgeRow();
        $masonry_gallery_square_big_overlay_group->addChild('row1', $row1);

            $masonry_gallery_square_big_overlay_color = new EdgeField('colorsimple', 'masonry_gallery_square_big_overlay_color', '', 'Color');
            $row1->addChild('masonry_gallery_square_big_overlay_color', $masonry_gallery_square_big_overlay_color);

            $masonry_gallery_square_big_overlay_transparency = new EdgeField('textsimple', 'masonry_gallery_square_big_overlay_transparency', '', 'Transparency (0=full - 1=opaque)');
            $row1->addChild('masonry_gallery_square_big_overlay_transparency', $masonry_gallery_square_big_overlay_transparency);
			
	$masonry_gallery_square_big_spacing_group = new EdgeGroup('Spacing Style', 'Define Spacing Style');
    $panel30->addChild('masonry_gallery_square_big_spacing_group', $masonry_gallery_square_big_spacing_group);	
		
		$row1 = new EdgeRow();
        $masonry_gallery_square_big_spacing_group->addChild('row1', $row1);
				
		$masonry_gallery_square_big_text_align = new EdgeField("selectsimple","masonry_gallery_square_big_text_align","center","Text Alignment","Choose text position",array(
			"center" => "Center",
			"left" => "Left",
			"right" => "Right"
		));
		
		$row1->addChild("masonry_gallery_square_big_text_align",$masonry_gallery_square_big_text_align);
	
	$masonry_gallery_square_big_padding_group = new EdgeGroup('Content Padding', 'Please insert padding in px(or %) i.e. 5px (or 5%)');
    $panel30->addChild('masonry_gallery_square_big_padding_group', $masonry_gallery_square_big_padding_group);	
		
		$row1 = new EdgeRow();
        $masonry_gallery_square_big_padding_group->addChild('row1', $row1);
		
		$masonry_gallery_square_big_padding_left = new EdgeField("textsimple","masonry_gallery_square_big_padding_left","","Padding Left","Please insert padding in px(or %) i.e. 5px(or 5%)", array(), array("col_width" => 3));
		$row1->addChild("masonry_gallery_square_big_padding_left",$masonry_gallery_square_big_padding_left);
		
		$masonry_gallery_square_big_padding_right = new EdgeField("textsimple","masonry_gallery_square_big_padding_right","","Padding Right","Please insert padding in px(or %) i.e. 5px(or 5%)", array(), array("col_width" => 3));
		$row1->addChild("masonry_gallery_square_big_padding_right",$masonry_gallery_square_big_padding_right);
			

    //Square Small
    $masonry_gallery_square_small_title = new EdgeTitle('masonry_gallery_square_small_title', 'Square Small');
    $panel30->addChild('masonry_gallery_square_small_title', $masonry_gallery_square_small_title);

    $masonry_gallery_square_small_title_group = new EdgeGroup('Title Style', 'Define Square Small Title Style');
    $panel30->addChild('masonry_gallery_square_small_title_group', $masonry_gallery_square_small_title_group);

        $row1 = new EdgeRow();
        $masonry_gallery_square_small_title_group->addChild("row1",$row1);

            $masonry_gallery_square_small_title_color = new EdgeField('colorsimple','masonry_gallery_square_small_title_color', '', 'Title Color');
            $row1->addChild('masonry_gallery_square_small_title_color', $masonry_gallery_square_small_title_color);

            $masonry_gallery_square_small_title_font_size = new EdgeField('textsimple', 'masonry_gallery_square_small_title_font_size', '', 'Font size (px)');
            $row1->addChild('masonry_gallery_square_small_title_font_size', $masonry_gallery_square_small_title_font_size);

            $masonry_gallery_square_small_title_line_height = new EdgeField('textsimple', 'masonry_gallery_square_small_title_line_height', '', 'Line Height (px)');
            $row1->addChild('masonry_gallery_square_small_title_line_height', $masonry_gallery_square_small_title_line_height);

            $masonry_gallery_square_small_title_text_transform = new EdgeField('selectblanksimple', 'masonry_gallery_square_small_title_text_transform', '', 'Text Transform', '', $options_texttransform);
            $row1->addChild('masonry_gallery_square_small_title_text_transform', $masonry_gallery_square_small_title_text_transform);

        $row2 = new EdgeRow(true);
        $masonry_gallery_square_small_title_group->addChild("row2",$row2);

            $masonry_gallery_square_small_title_font_family = new EdgeField('fontsimple', 'masonry_gallery_square_small_title_font_family', '-1', 'Font Family');
            $row2->addChild('masonry_gallery_square_small_title_font_family', $masonry_gallery_square_small_title_font_family);

            $masonry_gallery_square_small_title_font_style = new EdgeField('selectblanksimple', 'masonry_gallery_square_small_title_font_style', '', 'Font Style', '', $options_fontstyle);
            $row2->addChild('masonry_gallery_square_small_title_font_style', $masonry_gallery_square_small_title_font_style);

            $masonry_gallery_square_small_title_font_weight = new EdgeField('selectblanksimple', 'masonry_gallery_square_small_title_font_weight', '', 'Font Weight', '', $options_fontweight);
            $row2->addChild('masonry_gallery_square_small_title_font_weight', $masonry_gallery_square_small_title_font_weight);

            $masonry_gallery_square_small_title_letter_spacing = new EdgeField('textsimple', 'masonry_gallery_square_small_title_letter_spacing', '', 'Letter Spacing');
            $row2->addChild('masonry_gallery_square_small_title_letter_spacing', $masonry_gallery_square_small_title_letter_spacing);
			
		$row3 = new EdgeRow(true);
        $masonry_gallery_square_small_title_group->addChild("row3",$row3);	
		
			$masonry_gallery_square_small_title_margin_bottom = new EdgeField('textsimple', 'masonry_gallery_square_small_title_margin_bottom', '', 'Margin Bottom');
            $row3->addChild('masonry_gallery_square_small_title_margin_bottom', $masonry_gallery_square_small_title_margin_bottom);	

    $masonry_gallery_square_small_text_group = new EdgeGroup('Text Style', 'Define Square Small Text Style');
    $panel30->addChild('masonry_gallery_square_small_text_group', $masonry_gallery_square_small_text_group);

        $row1 = new EdgeRow();
        $masonry_gallery_square_small_text_group->addChild("row1",$row1);

            $masonry_gallery_square_small_text_color = new EdgeField('colorsimple','masonry_gallery_square_small_text_color', '', 'Text Color');
            $row1->addChild('masonry_gallery_square_small_text_color', $masonry_gallery_square_small_text_color);

            $masonry_gallery_square_small_text_font_size = new EdgeField('textsimple', 'masonry_gallery_square_small_text_font_size', '', 'Font size (px)');
            $row1->addChild('masonry_gallery_square_small_text_font_size', $masonry_gallery_square_small_text_font_size);

            $masonry_gallery_square_small_text_line_height = new EdgeField('textsimple', 'masonry_gallery_square_small_text_line_height', '', 'Line Height (px)');
            $row1->addChild('masonry_gallery_square_small_text_line_height', $masonry_gallery_square_small_text_line_height);

            $masonry_gallery_square_small_text_text_transform = new EdgeField('selectblanksimple', 'masonry_gallery_square_small_text_text_transform', '', 'Text Transform', '', $options_texttransform);
            $row1->addChild('masonry_gallery_square_small_text_text_transform', $masonry_gallery_square_small_text_text_transform);

        $row2 = new EdgeRow(true);
        $masonry_gallery_square_small_text_group->addChild("row2",$row2);

            $masonry_gallery_square_small_text_font_family = new EdgeField('fontsimple', 'masonry_gallery_square_small_text_font_family', '-1', 'Font Family');
            $row2->addChild('masonry_gallery_square_small_text_font_family', $masonry_gallery_square_small_text_font_family);

            $masonry_gallery_square_small_text_font_style = new EdgeField('selectblanksimple', 'masonry_gallery_square_small_text_font_style', '', 'Font Style', '', $options_fontstyle);
            $row2->addChild('masonry_gallery_square_small_text_font_style', $masonry_gallery_square_small_text_font_style);

            $masonry_gallery_square_small_text_font_weight = new EdgeField('selectblanksimple', 'masonry_gallery_square_small_text_font_weight', '', 'Font Weight', '', $options_fontweight);
            $row2->addChild('masonry_gallery_square_small_text_font_weight', $masonry_gallery_square_small_text_font_weight);

            $masonry_gallery_square_small_text_letter_spacing = new EdgeField('textsimple', 'masonry_gallery_square_small_text_letter_spacing', '', 'Letter Spacing');
            $row2->addChild('masonry_gallery_square_small_text_letter_spacing', $masonry_gallery_square_small_text_letter_spacing);

    $masonry_gallery_square_small_button_group = new EdgeGroup('Button Style', 'Define Square Small Button Style');
    $panel30->addChild('masonry_gallery_square_small_button_group', $masonry_gallery_square_small_button_group);

        $row1 = new EdgeRow();
        $masonry_gallery_square_small_button_group->addChild('row1', $row1);

            $masonry_gallery_square_small_button_font_family = new EdgeField('fontsimple', 'masonry_gallery_square_small_button_font_family', '-1', 'Font Family');
            $row1->addChild('masonry_gallery_square_small_button_font_family', $masonry_gallery_square_small_button_font_family);

            $masonry_gallery_square_small_button_font_style = new EdgeField('selectblanksimple', 'masonry_gallery_square_small_button_font_style', '', 'Font Style', '', $options_fontstyle);
            $row1->addChild('masonry_gallery_square_small_button_font_style', $masonry_gallery_square_small_button_font_style);

            $masonry_gallery_square_small_button_font_weight = new EdgeField('selectblanksimple', 'masonry_gallery_square_small_button_font_weight', '', 'Font Weight', '', $options_fontweight);
            $row1->addChild('masonry_gallery_square_small_button_font_weight', $masonry_gallery_square_small_button_font_weight);

            $masonry_gallery_square_small_button_text_transform = new EdgeField('selectblanksimple', 'masonry_gallery_square_small_button_text_transform', '', 'Text Transform', '', $options_texttransform);
            $row1->addChild('masonry_gallery_square_small_button_text_transform', $masonry_gallery_square_small_button_text_transform);
        
        $row2 = new EdgeRow(true);
        $masonry_gallery_square_small_button_group->addChild('row2', $row2);

            $masonry_gallery_square_small_button_font_size = new EdgeField('textsimple', 'masonry_gallery_square_small_button_font_size', '', 'Text Size (px)');
            $row2->addChild('masonry_gallery_square_small_button_font_size', $masonry_gallery_square_small_button_font_size);

            $masonry_gallery_square_small_button_line_height = new EdgeField('textsimple', 'masonry_gallery_square_small_button_line_height', '', 'Line Height (px)');
            $row2->addChild('masonry_gallery_square_small_button_line_height', $masonry_gallery_square_small_button_line_height);

            $masonry_gallery_square_small_button_letter_spacing = new EdgeField('textsimple', 'masonry_gallery_square_small_button_letter_spacing', '', 'Letter Spacing (px)');
            $row2->addChild('masonry_gallery_square_small_button_letter_spacing', $masonry_gallery_square_small_button_letter_spacing);

        $row3 = new EdgeRow(true);
        $masonry_gallery_square_small_button_group->addChild('row3', $row3);

            $masonry_gallery_square_small_button_text_color = new EdgeField('colorsimple', 'masonry_gallery_square_small_button_text_color', '', 'Text Color');
            $row3->addChild('masonry_gallery_square_small_button_text_color', $masonry_gallery_square_small_button_text_color);

            $masonry_gallery_square_small_button_hover_text_color = new EdgeField('colorsimple', 'masonry_gallery_square_small_button_hover_text_color', '', 'Hover Text Color');
            $row3->addChild('masonry_gallery_square_small_button_hover_text_color', $masonry_gallery_square_small_button_hover_text_color);

            $masonry_gallery_square_small_button_background_color = new EdgeField('colorsimple', 'masonry_gallery_square_small_button_background_color', '', 'Background Color');
            $row3->addChild('masonry_gallery_square_small_button_background_color', $masonry_gallery_square_small_button_background_color);

            $masonry_gallery_square_small_button_hover_background_color = new EdgeField('colorsimple', 'masonry_gallery_square_small_button_hover_background_color', '', 'Hover Background Color');
            $row3->addChild('masonry_gallery_square_small_button_hover_background_color', $masonry_gallery_square_small_button_hover_background_color);

        $row4 = new EdgeRow(true);
        $masonry_gallery_square_small_button_group->addChild('row4', $row4);

            $masonry_gallery_square_small_button_border_color = new EdgeField('colorsimple', 'masonry_gallery_square_small_button_border_color', '', 'Border Color');
            $row4->addChild('masonry_gallery_square_small_button_border_color', $masonry_gallery_square_small_button_border_color);

            $masonry_gallery_square_small_button_hover_border_color = new EdgeField('colorsimple', 'masonry_gallery_square_small_button_hover_border_color', '', 'Hover Border Color');
            $row4->addChild('masonry_gallery_square_small_button_hover_border_color', $masonry_gallery_square_small_button_hover_border_color);

            $masonry_gallery_square_small_button_border_width = new EdgeField('textsimple', 'masonry_gallery_square_small_button_border_width', '', 'Border Width (px)');
            $row4->addChild('masonry_gallery_square_small_button_border_width', $masonry_gallery_square_small_button_border_width);

            $masonry_gallery_square_small_button_border_radius = new EdgeField('textsimple', 'masonry_gallery_square_small_button_border_radius', '', 'Border Radius (px)');
            $row4->addChild('masonry_gallery_square_small_button_border_radius', $masonry_gallery_square_small_button_border_radius);
			
		$row5 = new EdgeRow(true);
        $masonry_gallery_square_small_button_group->addChild('row5', $row5);
		
			$masonry_gallery_square_small_button_padding_left = new EdgeField('textsimple', 'masonry_gallery_square_small_button_padding_left', '', 'Padding Left (px)');
            $row5->addChild('masonry_gallery_square_small_button_padding_left', $masonry_gallery_square_small_button_padding_left);
			
			$masonry_gallery_square_small_button_padding_right = new EdgeField('textsimple', 'masonry_gallery_square_small_button_padding_right', '', 'Padding Right (px)');
            $row5->addChild('masonry_gallery_square_small_button_padding_right', $masonry_gallery_square_small_button_padding_right);
			
			$masonry_gallery_square_small_button_margin_top = new EdgeField('textsimple', 'masonry_gallery_square_small_button_margin_top', '', 'Margin Top');
            $row5->addChild('masonry_gallery_square_small_button_margin_top', $masonry_gallery_square_small_button_margin_top);	

    $masonry_gallery_square_small_icon_group = new EdgeGroup('Icon Style', 'Define Square Small Icon Style');
    $panel30->addChild('masonry_gallery_square_small_icon_group', $masonry_gallery_square_small_icon_group);

        $row1 = new EdgeRow();
        $masonry_gallery_square_small_icon_group->addChild('row1', $row1);

            $masonry_gallery_square_small_icon_color = new EdgeField('colorsimple', 'masonry_gallery_square_small_icon_color', '', 'Icon Color');
            $row1->addChild('masonry_gallery_square_small_icon_color', $masonry_gallery_square_small_icon_color);

            $masonry_gallery_square_small_icon_hover_color = new EdgeField('colorsimple', 'masonry_gallery_square_small_icon_hover_color', '', 'Icon Hover Color');
            $row1->addChild('masonry_gallery_square_small_icon_hover_color', $masonry_gallery_square_small_icon_hover_color);

            $masonry_gallery_square_small_icon_size = new EdgeField('textsimple', 'masonry_gallery_square_small_icon_size', '', 'Icon Size (px)');
            $row1->addChild('masonry_gallery_square_small_icon_size', $masonry_gallery_square_small_icon_size);
			
			$masonry_gallery_square_small_icon_margin_bottom = new EdgeField('textsimple', 'masonry_gallery_square_small_icon_margin_bottom', '', 'Margin Bottom (px)');
            $row1->addChild('masonry_gallery_square_small_icon_margin_bottom', $masonry_gallery_square_small_icon_margin_bottom);

    $masonry_gallery_square_small_overlay_group = new EdgeGroup('Overlay Style', 'Define Square Small Overlay Style');
    $panel30->addChild('masonry_gallery_square_small_overlay_group', $masonry_gallery_square_small_overlay_group);

        $row1 = new EdgeRow();
        $masonry_gallery_square_small_overlay_group->addChild('row1', $row1);
        
            $masonry_gallery_square_small_overlay_color = new EdgeField('colorsimple', 'masonry_gallery_square_small_overlay_color', '', 'Color');
            $row1->addChild('masonry_gallery_square_small_overlay_color', $masonry_gallery_square_small_overlay_color);
            
            $masonry_gallery_square_small_overlay_transparency = new EdgeField('textsimple', 'masonry_gallery_square_small_overlay_transparency', '', 'Transparency (0=full - 1=opaque)');
            $row1->addChild('masonry_gallery_square_small_overlay_transparency', $masonry_gallery_square_small_overlay_transparency);
			
	$masonry_gallery_square_small_spacing_group = new EdgeGroup('Spacing Style', 'Define Spacing Style');
    $panel30->addChild('masonry_gallery_square_small_spacing_group', $masonry_gallery_square_small_spacing_group);	
		
		$row1 = new EdgeRow();
        $masonry_gallery_square_small_spacing_group->addChild('row1', $row1);
				
		$masonry_gallery_square_small_text_align = new EdgeField("selectsimple","masonry_gallery_square_small_text_align","center","Text Alignment","Choose text position",array(
			"center" => "Center",
			"left" => "Left",
			"right" => "Right"
		));
		
		$row1->addChild("masonry_gallery_square_small_text_align",$masonry_gallery_square_small_text_align);
		
		$masonry_gallery_square_small_padding_group = new EdgeGroup('Content Padding', 'Please insert padding in px(or %) i.e. 5px (or 5%)');
		$panel30->addChild('masonry_gallery_square_small_padding_group', $masonry_gallery_square_small_padding_group);	
		
		$row1 = new EdgeRow();
        $masonry_gallery_square_small_padding_group->addChild('row1', $row1);
		
		$masonry_gallery_square_small_padding_left = new EdgeField("textsimple","masonry_gallery_square_small_padding_left","","Padding Left","Please insert padding in px(or %) i.e. 5px(or 5%)", array(), array("col_width" => 3));
		$row1->addChild("masonry_gallery_square_small_padding_left",$masonry_gallery_square_small_padding_left);
		
		$masonry_gallery_square_small_padding_right = new EdgeField("textsimple","masonry_gallery_square_small_padding_right","","Padding Right","Please insert padding in px(or %) i.e. 5px(or 5%)", array(), array("col_width" => 3));
		$row1->addChild("masonry_gallery_square_small_padding_right",$masonry_gallery_square_small_padding_right);

    //Rectangle Portrait
    $masonry_gallery_rectangle_portrait_title = new EdgeTitle('masonry_gallery_rectangle_portrait_title', 'Rectangle Portrait');
    $panel30->addChild('masonry_gallery_rectangle_portrait_title', $masonry_gallery_rectangle_portrait_title);

    $masonry_gallery_rectangle_portrait_title_group = new EdgeGroup('Title Style', 'Define Rectangle Portrait Title Style');
    $panel30->addChild('masonry_gallery_rectangle_portrait_title_group', $masonry_gallery_rectangle_portrait_title_group);

        $row1 = new EdgeRow();
        $masonry_gallery_rectangle_portrait_title_group->addChild("row1",$row1);

            $masonry_gallery_rectangle_portrait_title_color = new EdgeField('colorsimple','masonry_gallery_rectangle_portrait_title_color', '', 'Title Color');
            $row1->addChild('masonry_gallery_rectangle_portrait_title_color', $masonry_gallery_rectangle_portrait_title_color);

            $masonry_gallery_rectangle_portrait_title_font_size = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_title_font_size', '', 'Font size (px)');
            $row1->addChild('masonry_gallery_rectangle_portrait_title_font_size', $masonry_gallery_rectangle_portrait_title_font_size);

            $masonry_gallery_rectangle_portrait_title_line_height = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_title_line_height', '', 'Line Height (px)');
            $row1->addChild('masonry_gallery_rectangle_portrait_title_line_height', $masonry_gallery_rectangle_portrait_title_line_height);

            $masonry_gallery_rectangle_portrait_title_text_transform = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_portrait_title_text_transform', '', 'Text Transform', '', $options_texttransform);
            $row1->addChild('masonry_gallery_rectangle_portrait_title_text_transform', $masonry_gallery_rectangle_portrait_title_text_transform);

        $row2 = new EdgeRow(true);
        $masonry_gallery_rectangle_portrait_title_group->addChild("row2",$row2);
        
            $masonry_gallery_rectangle_portrait_title_font_family = new EdgeField('fontsimple', 'masonry_gallery_rectangle_portrait_title_font_family', '-1', 'Font Family');
            $row2->addChild('masonry_gallery_rectangle_portrait_title_font_family', $masonry_gallery_rectangle_portrait_title_font_family);

            $masonry_gallery_rectangle_portrait_title_font_style = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_portrait_title_font_style', '', 'Font Style', '', $options_fontstyle);
            $row2->addChild('masonry_gallery_rectangle_portrait_title_font_style', $masonry_gallery_rectangle_portrait_title_font_style);

            $masonry_gallery_rectangle_portrait_title_font_weight = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_portrait_title_font_weight', '', 'Font Weight', '', $options_fontweight);
            $row2->addChild('masonry_gallery_rectangle_portrait_title_font_weight', $masonry_gallery_rectangle_portrait_title_font_weight);

            $masonry_gallery_rectangle_portrait_title_letter_spacing = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_title_letter_spacing', '', 'Letter Spacing');
            $row2->addChild('masonry_gallery_rectangle_portrait_title_letter_spacing', $masonry_gallery_rectangle_portrait_title_letter_spacing);
			
		$row3 = new EdgeRow(true);
        $masonry_gallery_rectangle_portrait_title_group->addChild("row3",$row3);	
		
			$masonry_gallery_rectangle_portrait_title_margin_bottom = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_title_margin_bottom', '', 'Margin Bottom');
            $row3->addChild('masonry_gallery_rectangle_portrait_title_margin_bottom', $masonry_gallery_rectangle_portrait_title_margin_bottom);		

    $masonry_gallery_rectangle_portrait_text_group = new EdgeGroup('Text Style', 'Define Rectangle Portrait Text Style');
    $panel30->addChild('masonry_gallery_rectangle_portrait_text_group', $masonry_gallery_rectangle_portrait_text_group);

        $row1 = new EdgeRow();
        $masonry_gallery_rectangle_portrait_text_group->addChild("row1",$row1);

            $masonry_gallery_rectangle_portrait_text_color = new EdgeField('colorsimple','masonry_gallery_rectangle_portrait_text_color', '', 'Text Color');
            $row1->addChild('masonry_gallery_rectangle_portrait_text_color', $masonry_gallery_rectangle_portrait_text_color);

            $masonry_gallery_rectangle_portrait_text_font_size = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_text_font_size', '', 'Font size (px)');
            $row1->addChild('masonry_gallery_rectangle_portrait_text_font_size', $masonry_gallery_rectangle_portrait_text_font_size);

            $masonry_gallery_rectangle_portrait_text_line_height = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_text_line_height', '', 'Line Height (px)');
            $row1->addChild('masonry_gallery_rectangle_portrait_text_line_height', $masonry_gallery_rectangle_portrait_text_line_height);

            $masonry_gallery_rectangle_portrait_text_text_transform = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_portrait_text_text_transform', '', 'Text Transform', '', $options_texttransform);
            $row1->addChild('masonry_gallery_rectangle_portrait_text_text_transform', $masonry_gallery_rectangle_portrait_text_text_transform);

        $row2 = new EdgeRow(true);
        $masonry_gallery_rectangle_portrait_text_group->addChild("row2",$row2);

            $masonry_gallery_rectangle_portrait_text_font_family = new EdgeField('fontsimple', 'masonry_gallery_rectangle_portrait_text_font_family', '-1', 'Font Family');
            $row2->addChild('masonry_gallery_rectangle_portrait_text_font_family', $masonry_gallery_rectangle_portrait_text_font_family);

            $masonry_gallery_rectangle_portrait_text_font_style = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_portrait_text_font_style', '', 'Font Style', '', $options_fontstyle);
            $row2->addChild('masonry_gallery_rectangle_portrait_text_font_style', $masonry_gallery_rectangle_portrait_text_font_style);

            $masonry_gallery_rectangle_portrait_text_font_weight = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_portrait_text_font_weight', '', 'Font Weight', '', $options_fontweight);
            $row2->addChild('masonry_gallery_rectangle_portrait_text_font_weight', $masonry_gallery_rectangle_portrait_text_font_weight);

            $masonry_gallery_rectangle_portrait_text_letter_spacing = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_text_letter_spacing', '', 'Letter Spacing');
            $row2->addChild('masonry_gallery_rectangle_portrait_text_letter_spacing', $masonry_gallery_rectangle_portrait_text_letter_spacing);

    $masonry_gallery_rectangle_portrait_button_group = new EdgeGroup('Button Style', 'Define Rectangle Portrait Button Style');
    $panel30->addChild('masonry_gallery_rectangle_portrait_button_group', $masonry_gallery_rectangle_portrait_button_group);

        $row1 = new EdgeRow();
        $masonry_gallery_rectangle_portrait_button_group->addChild('row1', $row1);
        
            $masonry_gallery_rectangle_portrait_button_font_family = new EdgeField('fontsimple', 'masonry_gallery_rectangle_portrait_button_font_family', '-1', 'Font Family');
            $row1->addChild('masonry_gallery_rectangle_portrait_button_font_family', $masonry_gallery_rectangle_portrait_button_font_family);
            
            $masonry_gallery_rectangle_portrait_button_font_style = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_portrait_button_font_style', '', 'Font Style', '', $options_fontstyle);
            $row1->addChild('masonry_gallery_rectangle_portrait_button_font_style', $masonry_gallery_rectangle_portrait_button_font_style);
            
            $masonry_gallery_rectangle_portrait_button_font_weight = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_portrait_button_font_weight', '', 'Font Weight', '', $options_fontweight);
            $row1->addChild('masonry_gallery_rectangle_portrait_button_font_weight', $masonry_gallery_rectangle_portrait_button_font_weight);
            
            $masonry_gallery_rectangle_portrait_button_text_transform = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_portrait_button_text_transform', '', 'Text Transform', '', $options_texttransform);
            $row1->addChild('masonry_gallery_rectangle_portrait_button_text_transform', $masonry_gallery_rectangle_portrait_button_text_transform);

        $row2 = new EdgeRow(true);
        $masonry_gallery_rectangle_portrait_button_group->addChild('row2', $row2);
        
            $masonry_gallery_rectangle_portrait_button_font_size = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_button_font_size', '', 'Text Size (px)');
            $row2->addChild('masonry_gallery_rectangle_portrait_button_font_size', $masonry_gallery_rectangle_portrait_button_font_size);
            
            $masonry_gallery_rectangle_portrait_button_line_height = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_button_line_height', '', 'Line Height (px)');
            $row2->addChild('masonry_gallery_rectangle_portrait_button_line_height', $masonry_gallery_rectangle_portrait_button_line_height);
            
            $masonry_gallery_rectangle_portrait_button_letter_spacing = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_button_letter_spacing', '', 'Letter Spacing (px)');
            $row2->addChild('masonry_gallery_rectangle_portrait_button_letter_spacing', $masonry_gallery_rectangle_portrait_button_letter_spacing);

        $row3 = new EdgeRow(true);
        $masonry_gallery_rectangle_portrait_button_group->addChild('row3', $row3);
        
            $masonry_gallery_rectangle_portrait_button_text_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_portrait_button_text_color', '', 'Text Color');
            $row3->addChild('masonry_gallery_rectangle_portrait_button_text_color', $masonry_gallery_rectangle_portrait_button_text_color);

            $masonry_gallery_rectangle_portrait_button_hover_text_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_portrait_button_hover_text_color', '', 'Hover Text Color');
            $row3->addChild('masonry_gallery_rectangle_portrait_button_hover_text_color', $masonry_gallery_rectangle_portrait_button_hover_text_color);

            $masonry_gallery_rectangle_portrait_button_background_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_portrait_button_background_color', '', 'Background Color');
            $row3->addChild('masonry_gallery_rectangle_portrait_button_background_color', $masonry_gallery_rectangle_portrait_button_background_color);

            $masonry_gallery_rectangle_portrait_button_hover_background_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_portrait_button_hover_background_color', '', 'Hover Background Color');
            $row3->addChild('masonry_gallery_rectangle_portrait_button_hover_background_color', $masonry_gallery_rectangle_portrait_button_hover_background_color);
        
        $row4 = new EdgeRow(true);
        $masonry_gallery_rectangle_portrait_button_group->addChild('row4', $row4);
        
            $masonry_gallery_rectangle_portrait_button_border_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_portrait_button_border_color', '', 'Border Color');
            $row4->addChild('masonry_gallery_rectangle_portrait_button_border_color', $masonry_gallery_rectangle_portrait_button_border_color);

            $masonry_gallery_rectangle_portrait_button_hover_border_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_portrait_button_hover_border_color', '', 'Hover Border Color');
            $row4->addChild('masonry_gallery_rectangle_portrait_button_hover_border_color', $masonry_gallery_rectangle_portrait_button_hover_border_color);

            $masonry_gallery_rectangle_portrait_button_border_width = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_button_border_width', '', 'Border Width (px)');
            $row4->addChild('masonry_gallery_rectangle_portrait_button_border_width', $masonry_gallery_rectangle_portrait_button_border_width);

            $masonry_gallery_rectangle_portrait_button_border_radius = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_button_border_radius', '', 'Border Radius (px)');
            $row4->addChild('masonry_gallery_rectangle_portrait_button_border_radius', $masonry_gallery_rectangle_portrait_button_border_radius);
			
		$row5 = new EdgeRow(true);
        $masonry_gallery_rectangle_portrait_button_group->addChild('row5', $row5);
		
			$masonry_gallery_rectangle_portrait_button_padding_left = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_button_padding_left', '', 'Padding Left (px)');
            $row5->addChild('masonry_gallery_rectangle_portrait_button_padding_left', $masonry_gallery_rectangle_portrait_button_padding_left);
			
			$masonry_gallery_rectangle_portrait_button_padding_right = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_button_padding_right', '', 'Padding Right (px)');
            $row5->addChild('masonry_gallery_rectangle_portrait_button_padding_right', $masonry_gallery_rectangle_portrait_button_padding_right);
			
			$masonry_gallery_rectangle_portrait_button_margin_top = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_button_margin_top', '', 'Margin Top');
            $row5->addChild('masonry_gallery_rectangle_portrait_button_margin_top', $masonry_gallery_rectangle_portrait_button_margin_top);		

    $masonry_gallery_rectangle_portrait_icon_group = new EdgeGroup('Icon Style', 'Define Rectangle Portrait Icon Style');
    $panel30->addChild('masonry_gallery_rectangle_portrait_icon_group', $masonry_gallery_rectangle_portrait_icon_group);

        $row1 = new EdgeRow();
        $masonry_gallery_rectangle_portrait_icon_group->addChild('row1', $row1);
        
            $masonry_gallery_rectangle_portrait_icon_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_portrait_icon_color', '', 'Icon Color');
            $row1->addChild('masonry_gallery_rectangle_portrait_icon_color', $masonry_gallery_rectangle_portrait_icon_color);
            
            $masonry_gallery_rectangle_portrait_icon_hover_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_portrait_icon_hover_color', '', 'Icon Hover Color');
            $row1->addChild('masonry_gallery_rectangle_portrait_icon_hover_color', $masonry_gallery_rectangle_portrait_icon_hover_color);
            
            $masonry_gallery_rectangle_portrait_icon_size = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_icon_size', '', 'Icon Size (px)');
            $row1->addChild('masonry_gallery_rectangle_portrait_icon_size', $masonry_gallery_rectangle_portrait_icon_size);
			
			 $masonry_gallery_rectangle_portrait_icon_margin_bottom = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_icon_margin_bottom', '', 'Margin Bottom (px)');
            $row1->addChild('masonry_gallery_rectangle_portrait_icon_margin_bottom', $masonry_gallery_rectangle_portrait_icon_margin_bottom);

    $masonry_gallery_rectangle_portrait_overlay_group = new EdgeGroup('Overlay Style', 'Define Rectangle Portrait Overlay Style');
    $panel30->addChild('masonry_gallery_rectangle_portrait_overlay_group', $masonry_gallery_rectangle_portrait_overlay_group);

        $row1 = new EdgeRow();
        $masonry_gallery_rectangle_portrait_overlay_group->addChild('row1', $row1);

            $masonry_gallery_rectangle_portrait_overlay_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_portrait_overlay_color', '', 'Color');
            $row1->addChild('masonry_gallery_rectangle_portrait_overlay_color', $masonry_gallery_rectangle_portrait_overlay_color);

            $masonry_gallery_rectangle_portrait_overlay_transparency = new EdgeField('textsimple', 'masonry_gallery_rectangle_portrait_overlay_transparency', '', 'Transparency (0=full - 1=opaque)');
            $row1->addChild('masonry_gallery_rectangle_portrait_overlay_transparency', $masonry_gallery_rectangle_portrait_overlay_transparency);
			
	$masonry_gallery_rectangle_portrait_spacing_group = new EdgeGroup('Spacing Style', 'Define Spacing Style');
    $panel30->addChild('masonry_gallery_rectangle_portrait_spacing_group', $masonry_gallery_rectangle_portrait_spacing_group);	
		
		$row1 = new EdgeRow();
        $masonry_gallery_rectangle_portrait_spacing_group->addChild('row1', $row1);
				
		$masonry_gallery_rectangle_portrait_text_align = new EdgeField("selectsimple","masonry_gallery_rectangle_portrait_text_align","center","Text Alignment","Choose text position",array(
			"center" => "Center",
			"left" => "Left",
			"right" => "Right"
		));
		
		$row1->addChild("masonry_gallery_rectangle_portrait_text_align",$masonry_gallery_rectangle_portrait_text_align);
		
		$masonry_gallery_rectangle_portrait_padding_group = new EdgeGroup('Content Padding', 'Please insert padding in px(or %) i.e. 5px (or 5%)');
		$panel30->addChild('masonry_gallery_rectangle_portrait_padding_group', $masonry_gallery_rectangle_portrait_padding_group);	
		
		$row1 = new EdgeRow();
        $masonry_gallery_rectangle_portrait_padding_group->addChild('row1', $row1);
		
		$masonry_gallery_rectangle_portrait_padding_left = new EdgeField("textsimple","masonry_gallery_rectangle_portrait_padding_left","","Padding Left","Please insert padding in px(or %) i.e. 5px(or 5%)", array(), array("col_width" => 3));
		$row1->addChild("masonry_gallery_rectangle_portrait_padding_left",$masonry_gallery_rectangle_portrait_padding_left);
		
		$masonry_gallery_rectangle_portrait_padding_right = new EdgeField("textsimple","masonry_gallery_rectangle_portrait_padding_right","","Padding Right","Please insert padding in px(or %) i.e. 5px(or 5%)", array(), array("col_width" => 3));
		$row1->addChild("masonry_gallery_rectangle_portrait_padding_right",$masonry_gallery_rectangle_portrait_padding_right);

    //Rectangle Landscape
    $masonry_gallery_rectangle_landscape_title = new EdgeTitle('masonry_gallery_rectangle_landscape_title', 'Rectangle Landscape');
    $panel30->addChild('masonry_gallery_rectangle_landscape_title', $masonry_gallery_rectangle_landscape_title);

    $masonry_gallery_rectangle_landscape_title_group = new EdgeGroup('Title Style', 'Define Rectangle Landscape Title Style');
    $panel30->addChild('masonry_gallery_rectangle_landscape_title_group', $masonry_gallery_rectangle_landscape_title_group);

        $row1 = new EdgeRow();
        $masonry_gallery_rectangle_landscape_title_group->addChild("row1",$row1);

            $masonry_gallery_rectangle_landscape_title_color = new EdgeField('colorsimple','masonry_gallery_rectangle_landscape_title_color', '', 'Title Color');
            $row1->addChild('masonry_gallery_rectangle_landscape_title_color', $masonry_gallery_rectangle_landscape_title_color);

            $masonry_gallery_rectangle_landscape_title_font_size = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_title_font_size', '', 'Font size (px)');
            $row1->addChild('masonry_gallery_rectangle_landscape_title_font_size', $masonry_gallery_rectangle_landscape_title_font_size);

            $masonry_gallery_rectangle_landscape_title_line_height = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_title_line_height', '', 'Line Height (px)');
            $row1->addChild('masonry_gallery_rectangle_landscape_title_line_height', $masonry_gallery_rectangle_landscape_title_line_height);

            $masonry_gallery_rectangle_landscape_title_text_transform = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_landscape_title_text_transform', '', 'Text Transform', '', $options_texttransform);
            $row1->addChild('masonry_gallery_rectangle_landscape_title_text_transform', $masonry_gallery_rectangle_landscape_title_text_transform);

        $row2 = new EdgeRow(true);
        $masonry_gallery_rectangle_landscape_title_group->addChild("row2",$row2);

            $masonry_gallery_rectangle_landscape_title_font_family = new EdgeField('fontsimple', 'masonry_gallery_rectangle_landscape_title_font_family', '-1', 'Font Family');
            $row2->addChild('masonry_gallery_rectangle_landscape_title_font_family', $masonry_gallery_rectangle_landscape_title_font_family);

            $masonry_gallery_rectangle_landscape_title_font_style = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_landscape_title_font_style', '', 'Font Style', '', $options_fontstyle);
            $row2->addChild('masonry_gallery_rectangle_landscape_title_font_style', $masonry_gallery_rectangle_landscape_title_font_style);

            $masonry_gallery_rectangle_landscape_title_font_weight = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_landscape_title_font_weight', '', 'Font Weight', '', $options_fontweight);
            $row2->addChild('masonry_gallery_rectangle_landscape_title_font_weight', $masonry_gallery_rectangle_landscape_title_font_weight);

            $masonry_gallery_rectangle_landscape_title_letter_spacing = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_title_letter_spacing', '', 'Letter Spacing');
            $row2->addChild('masonry_gallery_rectangle_landscape_title_letter_spacing', $masonry_gallery_rectangle_landscape_title_letter_spacing);
		
		$row3 = new EdgeRow(true);
        $masonry_gallery_rectangle_landscape_title_group->addChild("row3",$row3);	
		
			$masonry_gallery_rectangle_landscape_title_margin_bottom = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_title_margin_bottom', '', 'Margin Bottom');
            $row3->addChild('masonry_gallery_rectangle_landscape_title_margin_bottom', $masonry_gallery_rectangle_landscape_title_margin_bottom);		

    $masonry_gallery_rectangle_landscape_text_group = new EdgeGroup('Text Style', 'Define Rectangle Landscape Text Style');
    $panel30->addChild('masonry_gallery_rectangle_landscape_text_group', $masonry_gallery_rectangle_landscape_text_group);

        $row1 = new EdgeRow();
        $masonry_gallery_rectangle_landscape_text_group->addChild("row1",$row1);

            $masonry_gallery_rectangle_landscape_text_color = new EdgeField('colorsimple','masonry_gallery_rectangle_landscape_text_color', '', 'Text Color');
            $row1->addChild('masonry_gallery_rectangle_landscape_text_color', $masonry_gallery_rectangle_landscape_text_color);

            $masonry_gallery_rectangle_landscape_text_font_size = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_text_font_size', '', 'Font size (px)');
            $row1->addChild('masonry_gallery_rectangle_landscape_text_font_size', $masonry_gallery_rectangle_landscape_text_font_size);

            $masonry_gallery_rectangle_landscape_text_line_height = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_text_line_height', '', 'Line Height (px)');
            $row1->addChild('masonry_gallery_rectangle_landscape_text_line_height', $masonry_gallery_rectangle_landscape_text_line_height);

            $masonry_gallery_rectangle_landscape_text_text_transform = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_landscape_text_text_transform', '', 'Text Transform', '', $options_texttransform);
            $row1->addChild('masonry_gallery_rectangle_landscape_text_text_transform', $masonry_gallery_rectangle_landscape_text_text_transform);

        $row2 = new EdgeRow(true);
        $masonry_gallery_rectangle_landscape_text_group->addChild("row2",$row2);
        
            $masonry_gallery_rectangle_landscape_text_font_family = new EdgeField('fontsimple', 'masonry_gallery_rectangle_landscape_text_font_family', '-1', 'Font Family');
            $row2->addChild('masonry_gallery_rectangle_landscape_text_font_family', $masonry_gallery_rectangle_landscape_text_font_family);

            $masonry_gallery_rectangle_landscape_text_font_style = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_landscape_text_font_style', '', 'Font Style', '', $options_fontstyle);
            $row2->addChild('masonry_gallery_rectangle_landscape_text_font_style', $masonry_gallery_rectangle_landscape_text_font_style);

            $masonry_gallery_rectangle_landscape_text_font_weight = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_landscape_text_font_weight', '', 'Font Weight', '', $options_fontweight);
            $row2->addChild('masonry_gallery_rectangle_landscape_text_font_weight', $masonry_gallery_rectangle_landscape_text_font_weight);

            $masonry_gallery_rectangle_landscape_text_letter_spacing = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_text_letter_spacing', '', 'Letter Spacing');
            $row2->addChild('masonry_gallery_rectangle_landscape_text_letter_spacing', $masonry_gallery_rectangle_landscape_text_letter_spacing);

    $masonry_gallery_rectangle_landscape_button_group = new EdgeGroup('Button Style', 'Define Rectangle Landscape Button Style');
    $panel30->addChild('masonry_gallery_rectangle_landscape_button_group', $masonry_gallery_rectangle_landscape_button_group);

        $row1 = new EdgeRow();
        $masonry_gallery_rectangle_landscape_button_group->addChild('row1', $row1);

            $masonry_gallery_rectangle_landscape_button_font_family = new EdgeField('fontsimple', 'masonry_gallery_rectangle_landscape_button_font_family', '-1', 'Font Family');
            $row1->addChild('masonry_gallery_rectangle_landscape_button_font_family', $masonry_gallery_rectangle_landscape_button_font_family);

            $masonry_gallery_rectangle_landscape_button_font_style = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_landscape_button_font_style', '', 'Font Style', '', $options_fontstyle);
            $row1->addChild('masonry_gallery_rectangle_landscape_button_font_style', $masonry_gallery_rectangle_landscape_button_font_style);

            $masonry_gallery_rectangle_landscape_button_font_weight = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_landscape_button_font_weight', '', 'Font Weight', '', $options_fontweight);
            $row1->addChild('masonry_gallery_rectangle_landscape_button_font_weight', $masonry_gallery_rectangle_landscape_button_font_weight);

            $masonry_gallery_rectangle_landscape_button_text_transform = new EdgeField('selectblanksimple', 'masonry_gallery_rectangle_landscape_button_text_transform', '', 'Text Transform', '', $options_texttransform);
            $row1->addChild('masonry_gallery_rectangle_landscape_button_text_transform', $masonry_gallery_rectangle_landscape_button_text_transform);

        $row2 = new EdgeRow(true);
        $masonry_gallery_rectangle_landscape_button_group->addChild('row2', $row2);

            $masonry_gallery_rectangle_landscape_button_font_size = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_button_font_size', '', 'Text Size (px)');
            $row2->addChild('masonry_gallery_rectangle_landscape_button_font_size', $masonry_gallery_rectangle_landscape_button_font_size);

            $masonry_gallery_rectangle_landscape_button_line_height = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_button_line_height', '', 'Line Height (px)');
            $row2->addChild('masonry_gallery_rectangle_landscape_button_line_height', $masonry_gallery_rectangle_landscape_button_line_height);

            $masonry_gallery_rectangle_landscape_button_letter_spacing = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_button_letter_spacing', '', 'Letter Spacing (px)');
            $row2->addChild('masonry_gallery_rectangle_landscape_button_letter_spacing', $masonry_gallery_rectangle_landscape_button_letter_spacing);

        $row3 = new EdgeRow(true);
        $masonry_gallery_rectangle_landscape_button_group->addChild('row3', $row3);

            $masonry_gallery_rectangle_landscape_button_text_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_landscape_button_text_color', '', 'Text Color');
            $row3->addChild('masonry_gallery_rectangle_landscape_button_text_color', $masonry_gallery_rectangle_landscape_button_text_color);

            $masonry_gallery_rectangle_landscape_button_hover_text_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_landscape_button_hover_text_color', '', 'Hover Text Color');
            $row3->addChild('masonry_gallery_rectangle_landscape_button_hover_text_color', $masonry_gallery_rectangle_landscape_button_hover_text_color);

            $masonry_gallery_rectangle_landscape_button_background_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_landscape_button_background_color', '', 'Background Color');
            $row3->addChild('masonry_gallery_rectangle_landscape_button_background_color', $masonry_gallery_rectangle_landscape_button_background_color);

            $masonry_gallery_rectangle_landscape_button_hover_background_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_landscape_button_hover_background_color', '', 'Hover Background Color');
            $row3->addChild('masonry_gallery_rectangle_landscape_button_hover_background_color', $masonry_gallery_rectangle_landscape_button_hover_background_color);

        $row4 = new EdgeRow(true);
        $masonry_gallery_rectangle_landscape_button_group->addChild('row4', $row4);

            $masonry_gallery_rectangle_landscape_button_border_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_landscape_button_border_color', '', 'Border Color');
            $row4->addChild('masonry_gallery_rectangle_landscape_button_border_color', $masonry_gallery_rectangle_landscape_button_border_color);

            $masonry_gallery_rectangle_landscape_button_hover_border_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_landscape_button_hover_border_color', '', 'Hover Border Color');
            $row4->addChild('masonry_gallery_rectangle_landscape_button_hover_border_color', $masonry_gallery_rectangle_landscape_button_hover_border_color);

            $masonry_gallery_rectangle_landscape_button_border_width = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_button_border_width', '', 'Border Width (px)');
            $row4->addChild('masonry_gallery_rectangle_landscape_button_border_width', $masonry_gallery_rectangle_landscape_button_border_width);

            $masonry_gallery_rectangle_landscape_button_border_radius = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_button_border_radius', '', 'Border Radius (px)');
            $row4->addChild('masonry_gallery_rectangle_landscape_button_border_radius', $masonry_gallery_rectangle_landscape_button_border_radius);
			
		$row5 = new EdgeRow(true);
        $masonry_gallery_rectangle_landscape_button_group->addChild('row5', $row5);
		
			$masonry_gallery_rectangle_landscape_button_padding_left = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_button_padding_left', '', 'Padding Left (px)');
            $row5->addChild('masonry_gallery_rectangle_landscape_button_padding_left', $masonry_gallery_rectangle_landscape_button_padding_left);
			
			$masonry_gallery_rectangle_landscape_button_padding_right = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_button_padding_right', '', 'Padding Right (px)');
            $row5->addChild('masonry_gallery_rectangle_landscape_button_padding_right', $masonry_gallery_rectangle_landscape_button_padding_right);
			
			$masonry_gallery_rectangle_landscape_button_margin_top = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_button_margin_top', '', 'Margin Top');
            $row5->addChild('masonry_gallery_rectangle_landscape_button_margin_top', $masonry_gallery_rectangle_landscape_button_margin_top);	

    $masonry_gallery_rectangle_landscape_icon_group = new EdgeGroup('Icon Style', 'Define Rectangle Landscape Icon Style');
    $panel30->addChild('masonry_gallery_rectangle_landscape_icon_group', $masonry_gallery_rectangle_landscape_icon_group);

        $row1 = new EdgeRow();
        $masonry_gallery_rectangle_landscape_icon_group->addChild('row1', $row1);
        
            $masonry_gallery_rectangle_landscape_icon_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_landscape_icon_color', '', 'Icon Color');
            $row1->addChild('masonry_gallery_rectangle_landscape_icon_color', $masonry_gallery_rectangle_landscape_icon_color);
            
            $masonry_gallery_rectangle_landscape_icon_hover_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_landscape_icon_hover_color', '', 'Icon Hover Color');
            $row1->addChild('masonry_gallery_rectangle_landscape_icon_hover_color', $masonry_gallery_rectangle_landscape_icon_hover_color);
            
            $masonry_gallery_rectangle_landscape_icon_size = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_icon_size', '', 'Icon Size (px)');
            $row1->addChild('masonry_gallery_rectangle_landscape_icon_size', $masonry_gallery_rectangle_landscape_icon_size);
			
			$masonry_gallery_rectangle_landscape_icon_margin_bottom = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_icon_margin_bottom', '', 'Margin Bottom (px)');
            $row1->addChild('masonry_gallery_rectangle_landscape_icon_margin_bottom', $masonry_gallery_rectangle_landscape_icon_margin_bottom);

    $masonry_gallery_rectangle_landscape_overlay_group = new EdgeGroup('Overlay Style', 'Define Rectangle Landscape Overlay Style');
    $panel30->addChild('masonry_gallery_rectangle_landscape_overlay_group', $masonry_gallery_rectangle_landscape_overlay_group);

        $row1 = new EdgeRow();
        $masonry_gallery_rectangle_landscape_overlay_group->addChild('row1', $row1);

            $masonry_gallery_rectangle_landscape_overlay_color = new EdgeField('colorsimple', 'masonry_gallery_rectangle_landscape_overlay_color', '', 'Color');
            $row1->addChild('masonry_gallery_rectangle_landscape_overlay_color', $masonry_gallery_rectangle_landscape_overlay_color);

            $masonry_gallery_rectangle_landscape_overlay_transparency = new EdgeField('textsimple', 'masonry_gallery_rectangle_landscape_overlay_transparency', '', 'Transparency (0=full - 1=opaque)');
            $row1->addChild('masonry_gallery_rectangle_landscape_overlay_transparency', $masonry_gallery_rectangle_landscape_overlay_transparency);
	
	$masonry_gallery_rectangle_landscape_spacing_group = new EdgeGroup('Spacing Style', 'Define Spacing Style');
    $panel30->addChild('masonry_gallery_rectangle_landscape_spacing_group', $masonry_gallery_rectangle_landscape_spacing_group);	
		
		$row1 = new EdgeRow();
        $masonry_gallery_rectangle_landscape_spacing_group->addChild('row1', $row1);
				
		$masonry_gallery_rectangle_landscape_text_align = new EdgeField("selectsimple","masonry_gallery_rectangle_landscape_text_align","center","Text Alignment","Choose text position",array(
			"center" => "Center",
			"left" => "Left",
			"right" => "Right"
		));
		
		$row1->addChild("masonry_gallery_rectangle_landscape_text_align",$masonry_gallery_rectangle_landscape_text_align);
		
		$masonry_gallery_rectangle_landscape_padding_group = new EdgeGroup('Content Padding', 'Please insert padding in px(or %) i.e. 5px (or 5%)');
		$panel30->addChild('masonry_gallery_rectangle_landscape_padding_group', $masonry_gallery_rectangle_landscape_padding_group);	
		
		$row1 = new EdgeRow();
        $masonry_gallery_rectangle_landscape_padding_group->addChild('row1', $row1);
		
		$masonry_gallery_rectangle_landscape_padding_left = new EdgeField("textsimple","masonry_gallery_rectangle_landscape_padding_left","","Padding Left","Please insert padding in px(or %) i.e. 5px (or 5%)", array(), array("col_width" => 3));
		$row1->addChild("masonry_gallery_rectangle_landscape_padding_left",$masonry_gallery_rectangle_landscape_padding_left);
		
		$masonry_gallery_rectangle_landscape_padding_right = new EdgeField("textsimple","masonry_gallery_rectangle_landscape_padding_right","","Padding Right","Please insert padding in px(or %) i.e. 5px(or 5%)", array(), array("col_width" => 3));
		$row1->addChild("masonry_gallery_rectangle_landscape_padding_right",$masonry_gallery_rectangle_landscape_padding_right);

//Message Boxes

        $panel8 = new EdgePanel("Message Boxes", "message_boxes_panel");
        $elementsPage->addChild("panel8",$panel8);

                $group1 = new EdgeGroup("Message Box Style","Define Message Box Style");
                $panel8->addChild("group1",$group1);
                        $row1 = new EdgeRow();
                        $group1->addChild("row1",$row1);

                                $message_title_color = new EdgeField("colorsimple","message_title_color","","Text Color","This is some description");
                                $row1->addChild("message_title_color",$message_title_color);

                                $message_backgroundcolor = new EdgeField("colorsimple","message_backgroundcolor","","Background color","This is some description");
                                $row1->addChild("message_backgroundcolor",$message_backgroundcolor);

                        $row2 = new EdgeRow(true);
                        $group1->addChild("row2",$row2);

                                $message_title_google_fonts = new EdgeField("Fontsimple","message_title_google_fonts","-1","Font Family","This is some description");
                                $row2->addChild("message_title_google_fonts",$message_title_google_fonts);

                                $message_title_fontsize = new EdgeField("textsimple","message_title_fontsize","","Font Size (px)","This is some description");
                                $row2->addChild("message_title_fontsize",$message_title_fontsize);

                                $message_title_lineheight = new EdgeField("textsimple","message_title_lineheight","","Line Height (px)","This is some description");
                                $row2->addChild("message_title_lineheight",$message_title_lineheight);

                        $row3 = new EdgeRow(true);
                        $group1->addChild("row3",$row3);

                                $message_title_fontstyle = new EdgeField("selectblanksimple","message_title_fontstyle","","Font Style","This is some description",$options_fontstyle);
                                $row3->addChild("message_title_fontstyle",$message_title_fontstyle);

                                $message_title_fontweight = new EdgeField("selectblanksimple","message_title_fontweight","","Font Weight","This is some description",$options_fontweight);
                                $row3->addChild("message_title_fontweight",$message_title_fontweight);

                $group2 = new EdgeGroup("Message Box Icon Style","Define styles for Message Box icons");
                $panel8->addChild("group2",$group2);
                        $row1 = new EdgeRow();
                        $group2->addChild("row1",$row1);

                                $message_icon_color = new EdgeField("colorsimple","message_icon_color","","Icon Color","This is some description");
                                $row1->addChild("message_icon_color",$message_icon_color);

                                $message_icon_fontsize = new EdgeField("textsimple","message_icon_fontsize","","Font Size (px)","This is some description");
                                $row1->addChild("message_icon_fontsize",$message_icon_fontsize);

//Pagination

$panel10 = new EdgePanel("Pagination","pagination_panel");
$elementsPage->addChild("panel10",$panel10);

		$pagination_type = new EdgeField("select","pagination_type","","Type","Choose pagination style", array(
			"standard" => "Standard",
			"arrows_on_sides" => "Arrows on Sides"
		),
        array("dependence" => true,
					  "hide" => array(
						  "standard"=>"",
						  "arrows_on_sides"=>"#edgtf_pagination_standard_position_container"),
					  "show" => array(
						  "standard"=>"#edgtf_pagination_standard_position_container",
						  "arrows_on_sides"=>""
					  )
		));
		$panel10->addChild("pagination_type",$pagination_type);

		$pagination_standard_position_container = new EdgeContainer("pagination_standard_position_container","pagination_type","arrows_on_sides");
		$panel10->addChild("pagination_standard_position_container",$pagination_standard_position_container);

			$pagination_standard_position = new EdgeField("select","pagination_standard_position","","Position","Choose position of pagination", array(
				"left" => "Left",
				"center" => "Center",
				"right" => "Right"
			));
			$pagination_standard_position_container->addChild("pagination_standard_position",$pagination_standard_position);

	$group3 = new EdgeGroup("Navigation Style","Define Navigation styles");
	$panel10->addChild("group3",$group3);

		$row1 = new EdgeRow();
		$group3->addChild("row1",$row1);

			$pagination_button_width = new EdgeField("textsimple","pagination_button_width","","Width (px)","This is some description");
			$row1->addChild("pagination_button_width",$pagination_button_width);

			$pagination_button_height = new EdgeField("textsimple","pagination_button_height","","Height (px)","This is some description");
			$row1->addChild("pagination_button_height",$pagination_button_height);

			$pagination_space_between_buttons = new EdgeField("textsimple","pagination_space_between_buttons","","Space between buttons (px)","This is some description");
			$row1->addChild("pagination_space_between_buttons",$pagination_space_between_buttons);

			$pagination_button_background_color = new EdgeField("colorsimple","pagination_button_background_color","","Background Color","This is some description");
			$row1->addChild("pagination_button_background_color",$pagination_button_background_color);

		$row2 = new EdgeRow();
		$group3->addChild("row2",$row2);

			$pagination_button_background_hover_color = new EdgeField("colorsimple","pagination_button_background_hover_color","","Background Hover Color","This is some description");
			$row2->addChild("pagination_button_background_hover_color",$pagination_button_background_hover_color);

			$pagination_button_background_active_color = new EdgeField("colorsimple","pagination_button_background_active_color","","Background Active Color","This is some description");
			$row2->addChild("pagination_button_background_active_color",$pagination_button_background_active_color);

			$pagination_button_border_color = new EdgeField("colorsimple","pagination_button_border_color","","Border Color","This is some description");
			$row2->addChild("pagination_button_border_color",$pagination_button_border_color);

			$pagination_button_border_hover_color = new EdgeField("colorsimple","pagination_button_border_hover_color","","Border Hover Color","This is some description");
			$row2->addChild("pagination_button_border_hover_color",$pagination_button_border_hover_color);

		$row3 = new EdgeRow();
		$group3->addChild("row3",$row3);

			$pagination_button_border_active_color = new EdgeField("colorsimple","pagination_button_border_active_color","","Border Active Color","This is some description");
			$row3->addChild("pagination_button_border_active_color",$pagination_button_border_active_color);

			$pagination_button_border_radius = new EdgeField("textsimple","pagination_button_border_radius","","Border Radius (px)","This is some description");
			$row3->addChild("pagination_button_border_radius",$pagination_button_border_radius);

			$pagination_button_border_width = new EdgeField("textsimple","pagination_button_border_width","","Border Width (px)","This is some description");
			$row3->addChild("pagination_button_border_width",$pagination_button_border_width);

	$group1 = new EdgeGroup("Text Style","Define text styles (this style will also be applied to Only Previous and Next type)");
	$panel10->addChild("group1",$group1);

		$row1 = new EdgeRow();
		$group1->addChild("row1",$row1);

			$pagination_color = new EdgeField("colorsimple","pagination_color","","Text Color","This is some description");
			$row1->addChild("pagination_color",$pagination_color);

			$pagination_hover_color = new EdgeField("colorsimple","pagination_hover_color","","Hover Text Color","This is some description");
			$row1->addChild("pagination_hover_color",$pagination_hover_color);

			$pagination_active_color = new EdgeField("colorsimple","pagination_active_color","","Active Text Color","This is some description");
			$row1->addChild("pagination_active_color",$pagination_active_color);

			$pagination_font_size = new EdgeField("textsimple","pagination_font_size","","Font Size (px)","This is some description");
			$row1->addChild("pagination_font_size",$pagination_font_size);

		$row2 = new EdgeRow(true);
		$group1->addChild("row2",$row2);

			$pagination_font_weight = new EdgeField("selectblanksimple","pagination_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("pagination_font_weight",$pagination_font_weight);

			$pagination_font_family = new EdgeField("Fontsimple","pagination_font_family","-1","Font Family","This is some description");
			$row2->addChild("pagination_font_family",$pagination_font_family);

			$pagination_font_style = new EdgeField("selectblanksimple","pagination_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("pagination_font_style",$pagination_font_style);

			$pagination_letter_spacing = new EdgeField("textsimple","pagination_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("pagination_letter_spacing",$pagination_letter_spacing);

	$group4 = new EdgeGroup("Icon Arrow Style","Define arrow styles (this style will also be applied to Only Previous and Next type)");
	$panel10->addChild("group4",$group4);

		$row1 = new EdgeRow();
		$group4->addChild("row1",$row1);

			$pagination_arrow_size = new EdgeField("textsimple","pagination_arrow_size","","Arrow Size (px)","This is some description");
			$row1->addChild("pagination_arrow_size",$pagination_arrow_size);

			$pagination_arrows_type = new EdgeField("selectblanksimple", "pagination_arrows_type", "", "Arrow Icon", "", $options_arrows_type);
			$row1->addChild("pagination_arrows_type", $pagination_arrows_type);

			$pagination_double_arrows_type = new EdgeField("selectblanksimple", "pagination_double_arrows_type", "", "First/Last Arrow Icon", "", $options_double_arrows_type);
			$row1->addChild("pagination_double_arrows_type", $pagination_double_arrows_type);

$portfolio_pagination_section = new EdgeTitle("portfolio_pagination_section","Portfolio Pagination");
$panel10->addChild("portfolio_pagination_section",$portfolio_pagination_section);

$group2 = new EdgeGroup("Portfolio Pagination Style","Define Pagination styles for portfolio single");
$panel10->addChild("group2",$group2);
$row1 = new EdgeRow();
$group2->addChild("row1",$row1);

$portfolio_pagination_color = new EdgeField("colorsimple","portfolio_pagination_color","","Text Color","This is some description");
$row1->addChild("portfolio_pagination_color",$portfolio_pagination_color);

$portfolio_pagination_hover_color = new EdgeField("colorsimple","portfolio_pagination_hover_color","","Hover Text Color","This is some description");
$row1->addChild("portfolio_pagination_hover_color",$portfolio_pagination_hover_color);

$portfolio_pagination_font_size = new EdgeField("textsimple","portfolio_pagination_font_size","","Font Size (px)","This is some description");
$row1->addChild("portfolio_pagination_font_size",$portfolio_pagination_font_size);

//Pie Charts

$panel11 = new EdgePanel("Pie Charts","pie_charts_panel");
$elementsPage->addChild("panel11",$panel11);

$group1 = new EdgeGroup("Pie Chart Text Style","Define text style for Pie Charts");
$panel11->addChild("group1",$group1);
$row1 = new EdgeRow();
$group1->addChild("row1",$row1);

$pie_charts_fontsize = new EdgeField("textsimple","pie_charts_fontsize","","Font Size (px)","This is some description");
$row1->addChild("pie_charts_fontsize",$pie_charts_fontsize);

$pie_charts_fontweight = new EdgeField("selectblanksimple","pie_charts_fontweight","","Text Font Weight","This is some description",$options_fontweight);
$row1->addChild("pie_charts_fontweight",$pie_charts_fontweight);

$pie_charts_margin_below_chart = new EdgeField("textsimple","pie_charts_margin_below_chart","","Margin Below Chart (px)","This is some description");
$row1->addChild("pie_charts_margin_below_chart",$pie_charts_margin_below_chart);

//Pricing table

$panel12 = new EdgePanel("Pricing Table","pricing_table_panel");
$elementsPage->addChild("panel12",$panel12);

	$group1 = new EdgeGroup("Pricing Tables Style","Define Pricing tables style");
	$panel12->addChild("group1",$group1);


		$row1 = new EdgeRow();
		$group1->addChild("row1",$row1);

			$pricing_table_title_background_color = new EdgeField("colorsimple","pricing_table_title_background_color","","Title Background Color","This is some description");
			$row1->addChild("pricing_table_title_background_color",$pricing_table_title_background_color);

			$pricing_table_title_separator_color = new EdgeField("colorsimple","pricing_table_title_separator_color","","Title Separator Color","This is some description");
			$row1->addChild("pricing_table_title_separator_color",$pricing_table_title_separator_color);

			$pricing_table_title_separator_thickness = new EdgeField("textsimple","pricing_table_title_separator_thickness","","Title Separator Thickness (px)","This is some description");
			$row1->addChild("pricing_table_title_separator_thickness",$pricing_table_title_separator_thickness);            

        $row2 = new EdgeRow(true);
        $group1->addChild("row2",$row2);  
 
            $pricing_table_title_top_padding = new EdgeField("textsimple","pricing_table_title_top_padding","","Title Padding Top (px)","This is some description");
            $row2->addChild("pricing_table_title_top_padding",$pricing_table_title_top_padding);

            $pricing_table_title_bottom_padding = new EdgeField("textsimple","pricing_table_title_bottom_padding","","Title Padding Bottom (px)","This is some description");
            $row2->addChild("pricing_table_title_bottom_padding",$pricing_table_title_bottom_padding);      

		$row3 = new EdgeRow(true);
		$group1->addChild("row3",$row3);

			$pricing_table_price_background_color = new EdgeField("colorsimple","pricing_table_price_background_color","","Price Background Color","This is some description");
			$row3->addChild("pricing_table_price_background_color",$pricing_table_price_background_color);

			$pricing_table_price_separator_color = new EdgeField("colorsimple","pricing_table_price_separator_color","","Price Separator Color","This is some description");
			$row3->addChild("pricing_table_price_separator_color",$pricing_table_price_separator_color);

			$pricing_table_price_separator_thickness = new EdgeField("textsimple","pricing_table_price_separator_thickness","","Price Separator Thickness (px)","This is some description");
			$row3->addChild("pricing_table_price_separator_thickness",$pricing_table_price_separator_thickness);            

        $row4 = new EdgeRow(true);
        $group1->addChild("row4",$row4);   

            $pricing_table_price_top_padding = new EdgeField("textsimple","pricing_table_price_top_padding","","Price Top Padding (px)","This is some description");
            $row4->addChild("pricing_table_price_top_padding",$pricing_table_price_top_padding);

            $pricing_table_price_bottom_padding = new EdgeField("textsimple","pricing_table_price_bottom_padding","","Price Bottom Padding (px)","This is some description");
            $row4->addChild("pricing_table_price_bottom_padding",$pricing_table_price_bottom_padding);


		$row5 = new EdgeRow(true);
		$group1->addChild("row5",$row5);

			$pricing_table_background_color = new EdgeField("colorsimple","pricing_table_background_color","","Content Background Color","This is some description");
			$row5->addChild("pricing_table_background_color",$pricing_table_background_color);

			$pricing_table_separator_color = new EdgeField("colorsimple","pricing_table_separator_color","","Content Separator Color","This is some description");
			$row5->addChild("pricing_table_separator_color",$pricing_table_separator_color);

			$pricing_table_separator_thickness = new EdgeField("textsimple","pricing_table_separator_thickness","","Content Separator Thickness (px)","This is some description");
			$row5->addChild("pricing_table_separator_thickness",$pricing_table_separator_thickness);

        $row6 = new EdgeRow(true);
        $group1->addChild("row6",$row6);   

            $pricing_table_content_top_padding = new EdgeField("textsimple","pricing_table_content_top_padding","","Content Top Padding (px)","This is some description");
            $row6->addChild("pricing_table_content_top_padding",$pricing_table_content_top_padding);

            $pricing_table_content_bottom_padding = new EdgeField("textsimple","pricing_table_content_bottom_padding","","Content Bottom Padding (px)","This is some description");
            $row6->addChild("pricing_table_content_bottom_padding",$pricing_table_content_bottom_padding);

        $row7 = new EdgeRow(true);
        $group1->addChild("row7",$row7);   

            $pricing_table_button_holder_background_color = new EdgeField("colorsimple","pricing_table_button_holder_background_color","","Button Holder Background Color","This is some description");
            $row7->addChild("pricing_table_button_holder_background_color",$pricing_table_button_holder_background_color);

            $pricing_table_button_top_padding = new EdgeField("textsimple","pricing_table_button_top_padding","","Button Holder Padding Top(px)","This is some description");
            $row7->addChild("pricing_table_button_top_padding",$pricing_table_button_top_padding);

            $pricing_table_button_bottom_padding = new EdgeField("textsimple","pricing_table_button_bottom_padding","","Button Holder Padding Bottom(px)","This is some description");
            $row7->addChild("pricing_table_button_bottom_padding",$pricing_table_button_bottom_padding);          

		$group2 = new EdgeGroup("Pricing Tables Active Text","DefinePricing tables active text style.");
		$panel12->addChild("group2",$group2);

			$row1 = new EdgeRow();
			$group2->addChild("row1",$row1);

				$pricing_tables_active_text_color = new EdgeField("colorsimple","pricing_tables_active_text_color","","Text Color","This is some description");
				$row1->addChild("pricing_tables_active_text_color",$pricing_tables_active_text_color);

				$pricing_tables_active_text_font_size = new EdgeField("textsimple","pricing_tables_active_text_font_size","","Font Size (px)","This is some description");
				$row1->addChild("pricing_tables_active_text_font_size",$pricing_tables_active_text_font_size);

				$pricing_tables_active_text_line_height = new EdgeField("textsimple","pricing_tables_active_text_line_height","","Line Height (px)","This is some description");
				$row1->addChild("pricing_tables_active_text_line_height",$pricing_tables_active_text_line_height);

				$pricing_tables_active_text_text_transform = new EdgeField("selectblanksimple","pricing_tables_active_text_text_transform","","Text Transform","This is some description",$options_texttransform);
				$row1->addChild("pricing_tables_active_text_text_transform",$pricing_tables_active_text_text_transform);

			$row2 = new EdgeRow(true);
			$group2->addChild("row2",$row2);

				$pricing_tables_active_text_font_family = new EdgeField("Fontsimple","pricing_tables_active_text_font_family","-1","Font Family","This is some description");
				$row2->addChild("pricing_tables_active_text_font_family",$pricing_tables_active_text_font_family);

				$pricing_tables_active_text_font_style = new EdgeField("selectblanksimple","pricing_tables_active_text_font_style","","Font Style","This is some description",$options_fontstyle);
				$row2->addChild("pricing_tables_active_text_font_style",$pricing_tables_active_text_font_style);

				$pricing_tables_active_text_font_weight = new EdgeField("selectblanksimple","pricing_tables_active_text_font_weight","","Font Weight","This is some description",$options_fontweight);
				$row2->addChild("pricing_tables_active_text_font_weight",$pricing_tables_active_text_font_weight);

				$pricing_tables_active_text_letter_spacing = new EdgeField("textsimple","pricing_tables_active_text_letter_spacing","","Letter Spacing (px)","This is some description");
				$row2->addChild("pricing_tables_active_text_letter_spacing",$pricing_tables_active_text_letter_spacing);


		$group3 = new EdgeGroup("Pricing Tables Title","Define Pricing tables title style");
		$panel12->addChild("group3",$group3);

			$row1 = new EdgeRow();
			$group3->addChild("row1",$row1);

				$pricing_tables_title_color = new EdgeField("colorsimple","pricing_tables_title_color","","Text Color","This is some description");
				$row1->addChild("pricing_tables_title_color",$pricing_tables_title_color);

				$pricing_tables_title_font_size = new EdgeField("textsimple","pricing_tables_title_font_size","","Font Size (px)","This is some description");
				$row1->addChild("pricing_tables_title_font_size",$pricing_tables_title_font_size);

				$pricing_tables_title_line_height = new EdgeField("textsimple","pricing_tables_title_line_height","","Line Height (px)","This is some description");
				$row1->addChild("pricing_tables_title_line_height",$pricing_tables_title_line_height);

				$pricing_tables_title_text_transform = new EdgeField("selectblanksimple","pricing_tables_title_text_transform","","Text Transform","This is some description",$options_texttransform);
				$row1->addChild("pricing_tables_title_text_transform",$pricing_tables_title_text_transform);

			$row2 = new EdgeRow(true);
			$group3->addChild("row2",$row2);

				$pricing_tables_title_font_family = new EdgeField("Fontsimple","pricing_tables_title_font_family","-1","Font Family","This is some description");
				$row2->addChild("pricing_tables_title_font_family",$pricing_tables_title_font_family);

				$pricing_tables_title_font_style = new EdgeField("selectblanksimple","pricing_tables_title_font_style","","Font Style","This is some description",$options_fontstyle);
				$row2->addChild("pricing_tables_title_font_style",$pricing_tables_title_font_style);

				$pricing_tables_title_font_weight = new EdgeField("selectblanksimple","pricing_tables_title_font_weight","","Font Weight","This is some description",$options_fontweight);
				$row2->addChild("pricing_tables_title_font_weight",$pricing_tables_title_font_weight);

				$pricing_tables_title_letter_spacing = new EdgeField("textsimple","pricing_tables_title_letter_spacing","","Letter Spacing (px)","This is some description");
				$row2->addChild("pricing_tables_title_letter_spacing",$pricing_tables_title_letter_spacing);

		$group4 = new EdgeGroup("Pricing Tables Period","DefinePricing tables period style");
		$panel12->addChild("group4",$group4);

			$row1 = new EdgeRow();
			$group4->addChild("row1",$row1);

				$pricing_tables_period_color = new EdgeField("colorsimple","pricing_tables_period_color","","Text Color","This is some description");
				$row1->addChild("pricing_tables_period_color",$pricing_tables_period_color);

				$pricing_tables_period_font_size = new EdgeField("textsimple","pricing_tables_period_font_size","","Font Size (px)","This is some description");
				$row1->addChild("pricing_tables_period_font_size",$pricing_tables_period_font_size);

				$pricing_tables_period_line_height = new EdgeField("textsimple","pricing_tables_period_line_height","","Line Height (px)","This is some description");
				$row1->addChild("pricing_tables_period_line_height",$pricing_tables_period_line_height);

				$pricing_tables_period_text_transform = new EdgeField("selectblanksimple","pricing_tables_period_text_transform","","Text Transform","This is some description",$options_texttransform);
				$row1->addChild("pricing_tables_period_text_transform",$pricing_tables_period_text_transform);

			$row2 = new EdgeRow(true);
			$group4->addChild("row2",$row2);

				$pricing_tables_period_font_family = new EdgeField("Fontsimple","pricing_tables_period_font_family","-1","Font Family","This is some description");
				$row2->addChild("pricing_tables_period_font_family",$pricing_tables_period_font_family);

				$pricing_tables_period_font_style = new EdgeField("selectblanksimple","pricing_tables_period_font_style","","Font Style","This is some description",$options_fontstyle);
				$row2->addChild("pricing_tables_period_font_style",$pricing_tables_period_font_style);

				$pricing_tables_period_font_weight = new EdgeField("selectblanksimple","pricing_tables_period_font_weight","","Font Weight","This is some description",$options_fontweight);
				$row2->addChild("pricing_tables_period_font_weight",$pricing_tables_period_font_weight);

				$pricing_tables_period_letter_spacing = new EdgeField("textsimple","pricing_tables_period_letter_spacing","","Letter Spacing (px)","This is some description");
				$row2->addChild("pricing_tables_period_letter_spacing",$pricing_tables_period_letter_spacing);

		$group5 = new EdgeGroup("Pricing Tables Price","Define Pricing Tables price style");
		$panel12->addChild("group5",$group5);

			$row1 = new EdgeRow();
			$group5->addChild("row1",$row1);

				$pricing_tables_price_color = new EdgeField("colorsimple","pricing_tables_price_color","","Text Color","This is some description");
				$row1->addChild("pricing_tables_price_color",$pricing_tables_price_color);

				$pricing_tables_price_font_size = new EdgeField("textsimple","pricing_tables_price_font_size","","Font Size (px)","This is some description");
				$row1->addChild("pricing_tables_price_font_size",$pricing_tables_price_font_size);

				$pricing_tables_price_line_height = new EdgeField("textsimple","pricing_tables_price_line_height","","Line Height (px)","This is some description");
				$row1->addChild("pricing_tables_price_line_height",$pricing_tables_price_line_height);

				$pricing_tables_price_text_transform = new EdgeField("selectblanksimple","pricing_tables_price_text_transform","","Text Transform","This is some description",$options_texttransform);
				$row1->addChild("pricing_tables_price_text_transform",$pricing_tables_price_text_transform);

			$row2 = new EdgeRow(true);
			$group5->addChild("row2",$row2);

				$pricing_tables_price_font_family = new EdgeField("Fontsimple","pricing_tables_price_font_family","-1","Font Family","This is some description");
				$row2->addChild("pricing_tables_price_font_family",$pricing_tables_price_font_family);

				$pricing_tables_price_font_style = new EdgeField("selectblanksimple","pricing_tables_price_font_style","","Font Style","This is some description",$options_fontstyle);
				$row2->addChild("pricing_tables_price_font_style",$pricing_tables_price_font_style);

				$pricing_tables_price_font_weight = new EdgeField("selectblanksimple","pricing_tables_price_font_weight","","Font Weight","This is some description",$options_fontweight);
				$row2->addChild("pricing_tables_price_font_weight",$pricing_tables_price_font_weight);

				$pricing_tables_price_letter_spacing = new EdgeField("textsimple","pricing_tables_price_letter_spacing","","Letter Spacing (px)","This is some description");
				$row2->addChild("pricing_tables_price_letter_spacing",$pricing_tables_price_letter_spacing);

		$group6 = new EdgeGroup("Pricing Tables Currency","Define Pricing tables currency style.");
		$panel12->addChild("group6",$group6);
			$row1 = new EdgeRow();
			$group6->addChild("row1",$row1);

				$pricing_tables_currency_color = new EdgeField("colorsimple","pricing_tables_currency_color","","Text Color","This is some description");
				$row1->addChild("pricing_tables_currency_color",$pricing_tables_currency_color);

				$pricing_tables_currency_font_size = new EdgeField("textsimple","pricing_tables_currency_font_size","","Font Size (px)","This is some description");
				$row1->addChild("pricing_tables_currency_font_size",$pricing_tables_currency_font_size);

				$pricing_tables_currency_line_height = new EdgeField("textsimple","pricing_tables_currency_line_height","","Line Height (px)","This is some description");
				$row1->addChild("pricing_tables_currency_line_height",$pricing_tables_currency_line_height);

				$pricing_tables_currency_text_transform = new EdgeField("selectblanksimple","pricing_tables_currency_text_transform","","Text Transform","This is some description",$options_texttransform);
				$row1->addChild("pricing_tables_currency_text_transform",$pricing_tables_currency_text_transform);

			$row2 = new EdgeRow(true);
			$group6->addChild("row2",$row2);

				$pricing_tables_currency_font_family = new EdgeField("Fontsimple","pricing_tables_currency_font_family","-1","Font Family","This is some description");
				$row2->addChild("pricing_tables_currency_font_family",$pricing_tables_currency_font_family);

				$pricing_tables_currency_font_style = new EdgeField("selectblanksimple","pricing_tables_currency_font_style","","Font Style","This is some description",$options_fontstyle);
				$row2->addChild("pricing_tables_currency_font_style",$pricing_tables_currency_font_style);

				$pricing_tables_currency_font_weight = new EdgeField("selectblanksimple","pricing_tables_currency_font_weight","","Font Weight","This is some description",$options_fontweight);
				$row2->addChild("pricing_tables_currency_font_weight",$pricing_tables_currency_font_weight);

				$pricing_tables_currency_letter_spacing = new EdgeField("textsimple","pricing_tables_currency_letter_spacing","","Letter Spacing (px)","This is some description");
				$row2->addChild("pricing_tables_currency_letter_spacing",$pricing_tables_currency_letter_spacing);

		$group7 = new EdgeGroup("Pricing Tables Button","Define Pricing Tables button style.");
		$panel12->addChild("group7",$group7);

			$row1 = new EdgeRow();
			$group7->addChild("row1",$row1);

				$pricing_tables_button_color = new EdgeField("colorsimple","pricing_tables_button_color","","Text Color","This is some description");
				$row1->addChild("pricing_tables_button_color",$pricing_tables_button_color);

				$pricing_tables_button_font_size = new EdgeField("textsimple","pricing_tables_button_font_size","","Font Size (px)","This is some description");
				$row1->addChild("pricing_tables_button_font_size",$pricing_tables_button_font_size);

				$pricing_tables_button_line_height = new EdgeField("textsimple","pricing_tables_button_line_height","","Line Height (px)","This is some description");
				$row1->addChild("pricing_tables_button_line_height",$pricing_tables_button_line_height);

				$pricing_tables_button_text_transform = new EdgeField("selectblanksimple","pricing_tables_button_text_transform","","Text Transform","This is some description",$options_texttransform);
				$row1->addChild("pricing_tables_button_text_transform",$pricing_tables_button_text_transform);

			$row2 = new EdgeRow(true);
			$group7->addChild("row2",$row2);

				$pricing_tables_button_font_family = new EdgeField("Fontsimple","pricing_tables_button_font_family","-1","Font Family","This is some description");
				$row2->addChild("pricing_tables_button_font_family",$pricing_tables_button_font_family);

				$pricing_tables_button_font_style = new EdgeField("selectblanksimple","pricing_tables_button_font_style","","Font Style","This is some description",$options_fontstyle);
				$row2->addChild("pricing_tables_button_font_style",$pricing_tables_button_font_style);

				$pricing_tables_button_font_weight = new EdgeField("selectblanksimple","pricing_tables_button_font_weight","","Font Weight","This is some description",$options_fontweight);
				$row2->addChild("pricing_tables_button_font_weight",$pricing_tables_button_font_weight);

				$pricing_tables_button_letter_spacing = new EdgeField("textsimple","pricing_tables_button_letter_spacing","","Letter Spacing (px)","This is some description");
				$row2->addChild("pricing_tables_button_letter_spacing",$pricing_tables_button_letter_spacing);
			$row3 = new EdgeRow(true);
			$group7->addChild("row3",$row3);
					$pricing_tables_button_hovercolor = new EdgeField("colorsimple","pricing_tables_button_hovercolor","","Text Hover Color","This is some description");
					$row3->addChild("pricing_tables_button_hovercolor",$pricing_tables_button_hovercolor);

					$pricing_tables_button_backgroundcolor = new EdgeField("colorsimple","pricing_tables_button_backgroundcolor","","Background Color","This is some description");
					$row3->addChild("pricing_tables_button_backgroundcolor",$pricing_tables_button_backgroundcolor);

					$pricing_tables_button_backgroundcolor_hover = new EdgeField("colorsimple","pricing_tables_button_backgroundcolor_hover","","Background Hover Color","This is some description");
					$row3->addChild("pricing_tables_button_backgroundcolor_hover",$pricing_tables_button_backgroundcolor_hover);					

			$row4 = new EdgeRow(true);
			$group7->addChild("row4",$row4);

                    $pricing_tables_button_border_width = new EdgeField("textsimple","pricing_tables_button_border_width","","Border Width (px)","This is some description");
                    $row4->addChild("pricing_tables_button_border_width",$pricing_tables_button_border_width);

                    $pricing_tables_button_border_radius = new EdgeField("textsimple","pricing_tables_button_border_radius","","Border Radius (px)","This is some description");
                    $row4->addChild("pricing_tables_button_border_radius",$pricing_tables_button_border_radius);

                    $pricing_tables_button_border_color = new EdgeField("colorsimple","pricing_tables_button_border_color","","Border Color","This is some description");
                    $row4->addChild("pricing_tables_button_border_color",$pricing_tables_button_border_color);

					$pricing_tables_button_border_hover_color = new EdgeField("colorsimple","pricing_tables_button_border_hover_color","","Border Hover Color","This is some description");
					$row4->addChild("pricing_tables_button_border_hover_color",$pricing_tables_button_border_hover_color);

        $group9 = new EdgeGroup("Pricing Tables Button Padding","Define Pricing Tables button padding (Takes effect only when pricing table button is set to size normal)");
        $panel12->addChild("group9",$group9);

            $row1 = new EdgeRow(true);
            $group9->addChild("row1",$row1);

                    $pricing_table_button_left_padding = new EdgeField("textsimple","pricing_table_button_left_padding","","Padding Left (px)","This is some description");
                    $row1->addChild("pricing_table_button_left_padding",$pricing_table_button_left_padding);

                    $pricing_table_button_right_padding = new EdgeField("textsimple","pricing_table_button_right_padding","","Padding Right (px)","This is some description");
                    $row1->addChild("pricing_table_button_right_padding",$pricing_table_button_right_padding);

					
		$group8 = new EdgeGroup("Pricing Tables Content","Define Pricing Tables content style");
    	$panel12->addChild("group8",$group8);

				$row1 = new EdgeRow();
				$group8->addChild("row1",$row1);

						$pricing_tables_content_color = new EdgeField("colorsimple","pricing_tables_content_color","","Text Color","This is some description");
						$row1->addChild("pricing_tables_content_color",$pricing_tables_content_color);

						$pricing_tables_content_font_size = new EdgeField("textsimple","pricing_tables_content_font_size","","Font Size (px)","This is some description");
						$row1->addChild("pricing_tables_content_font_size",$pricing_tables_content_font_size);

						$pricing_tables_content_line_height = new EdgeField("textsimple","pricing_tables_content_line_height","","Line Height (px)","This is some description");
						$row1->addChild("pricing_tables_content_line_height",$pricing_tables_content_line_height);

						$pricing_tables_content_text_transform = new EdgeField("selectblanksimple","pricing_tables_content_text_transform","","Text Transform","This is some description",$options_texttransform);
						$row1->addChild("pricing_tables_content_text_transform",$pricing_tables_content_text_transform);

				$row2 = new EdgeRow(true);
				$group8->addChild("row2",$row2);

						$pricing_tables_content_font_family = new EdgeField("Fontsimple","pricing_tables_content_font_family","-1","Font Family","This is some description");
						$row2->addChild("pricing_tables_content_font_family",$pricing_tables_content_font_family);

						$pricing_tables_content_font_style = new EdgeField("selectblanksimple","pricing_tables_content_font_style","","Font Style","This is some description",$options_fontstyle);
						$row2->addChild("pricing_tables_content_font_style",$pricing_tables_content_font_style);

						$pricing_tables_content_font_weight = new EdgeField("selectblanksimple","pricing_tables_content_font_weight","","Font Weight","This is some description",$options_fontweight);
						$row2->addChild("pricing_tables_content_font_weight",$pricing_tables_content_font_weight);

						$pricing_tables_content_letter_spacing = new EdgeField("textsimple","pricing_tables_content_letter_spacing","","Letter Spacing (px)","This is some description");
						$row2->addChild("pricing_tables_content_letter_spacing",$pricing_tables_content_letter_spacing);


//Service table

	$panel22 = new EdgePanel("Service Table","service_table_panel");
	$elementsPage->addChild("panel22",$panel22);

    		$group1 = new EdgeGroup("Service Tables Style","Define Service tables style");
    		$panel22->addChild("group1",$group1);

        			$row1 = new EdgeRow();
        			$group1->addChild("row1",$row1);

            				$service_table_title_background_color = new EdgeField("colorsimple","service_table_title_background_color","","Title Background Color","This is some description");
            				$row1->addChild("service_table_title_background_color",$service_table_title_background_color);

            				$service_table_title_separator_color = new EdgeField("colorsimple","service_table_title_separator_color","","Title Separator Color","This is some description");
            				$row1->addChild("service_table_title_separator_color",$service_table_title_separator_color);

            				$service_table_title_separator_thickness = new EdgeField("textsimple","service_table_title_separator_thickness","","Title Separator Thickness (px)","This is some description");
            				$row1->addChild("service_table_title_separator_thickness",$service_table_title_separator_thickness);

                    $row2 = new EdgeRow();
                    $group1->addChild("row2",$row2);  

                            $service_table_title_padding_top = new EdgeField("textsimple","service_table_title_padding_top","","Title Padding Top (px)","This is some description");
                            $row2->addChild("service_table_title_padding_top",$service_table_title_padding_top);

                            $service_table_title_padding_bottom = new EdgeField("textsimple","service_table_title_padding_bottom","","Title Padding Bottom (px)","This is some description");
                            $row2->addChild("service_table_title_padding_bottom",$service_table_title_padding_bottom);

        			$row3 = new EdgeRow(true);
        			$group1->addChild("row3",$row3);

            				$service_table_background_color = new EdgeField("colorsimple","service_table_background_color","","Content Background Color","This is some description");
            				$row3->addChild("service_table_background_color",$service_table_background_color);

            				$service_table_separator_color = new EdgeField("colorsimple","service_table_separator_color","","Content Separator Color","This is some description");
            				$row3->addChild("service_table_separator_color",$service_table_separator_color);

            				$service_table_separator_thickness = new EdgeField("textsimple","service_table_separator_thickness","","Content Separator Thickness (px)","This is some description");
            				$row3->addChild("service_table_separator_thickness",$service_table_separator_thickness);
				   
					$row4 = new EdgeRow();
                    $group1->addChild("row4",$row4);  

                            $service_table_content_padding_top = new EdgeField("textsimple","service_table_content_padding_top","","Content Padding Top (px)","This is some description");
                            $row4->addChild("service_table_content_padding_top",$service_table_content_padding_top);

                            $service_table_content_padding_bottom = new EdgeField("textsimple","service_table_content_padding_bottom","","Content Padding Bottom (px)","This is some description");
                            $row4->addChild("service_table_content_padding_bottom",$service_table_content_padding_bottom);

    		$group2 = new EdgeGroup("Service Tables Active Text","DefineService tables active text style.");
    		$panel22->addChild("group2",$group2);

        			$row1 = new EdgeRow();
        			$group2->addChild("row1",$row1);

            				$service_tables_active_text_color = new EdgeField("colorsimple","service_tables_active_text_color","","Text Color","This is some description");
            				$row1->addChild("service_tables_active_text_color",$service_tables_active_text_color);

            				$service_tables_active_text_font_size = new EdgeField("textsimple","service_tables_active_text_font_size","","Font Size (px)","This is some description");
            				$row1->addChild("service_tables_active_text_font_size",$service_tables_active_text_font_size);

            				$service_tables_active_text_line_height = new EdgeField("textsimple","service_tables_active_text_line_height","","Line Height (px)","This is some description");
            				$row1->addChild("service_tables_active_text_line_height",$service_tables_active_text_line_height);

            				$service_tables_active_text_text_transform = new EdgeField("selectblanksimple","service_tables_active_text_text_transform","","Text Transform","This is some description",$options_texttransform);
            				$row1->addChild("service_tables_active_text_text_transform",$service_tables_active_text_text_transform);

        			$row2 = new EdgeRow(true);
        			$group2->addChild("row2",$row2);

            				$service_tables_active_text_font_family = new EdgeField("Fontsimple","service_tables_active_text_font_family","-1","Font Family","This is some description");
            				$row2->addChild("service_tables_active_text_font_family",$service_tables_active_text_font_family);

            				$service_tables_active_text_font_style = new EdgeField("selectblanksimple","service_tables_active_text_font_style","","Font Style","This is some description",$options_fontstyle);
            				$row2->addChild("service_tables_active_text_font_style",$service_tables_active_text_font_style);

            				$service_tables_active_text_font_weight = new EdgeField("selectblanksimple","service_tables_active_text_font_weight","","Font Weight","This is some description",$options_fontweight);
            				$row2->addChild("service_tables_active_text_font_weight",$service_tables_active_text_font_weight);

            				$service_tables_active_text_letter_spacing = new EdgeField("textsimple","service_tables_active_text_letter_spacing","","Letter Spacing (px)","This is some description");
            				$row2->addChild("service_tables_active_text_letter_spacing",$service_tables_active_text_letter_spacing);


    		$group3 = new EdgeGroup("Service Tables Title","Define Service tables title style");
    		$panel22->addChild("group3",$group3);

        			$row1 = new EdgeRow();
        			$group3->addChild("row1",$row1);

            				$service_tables_title_color = new EdgeField("colorsimple","service_tables_title_color","","Text Color","This is some description");
            				$row1->addChild("service_tables_title_color",$service_tables_title_color);

            				$service_tables_title_font_size = new EdgeField("textsimple","service_tables_title_font_size","","Font Size (px)","This is some description");
            				$row1->addChild("service_tables_title_font_size",$service_tables_title_font_size);

            				$service_tables_title_line_height = new EdgeField("textsimple","service_tables_title_line_height","","Line Height (px)","This is some description");
            				$row1->addChild("service_tables_title_line_height",$service_tables_title_line_height);

            				$service_tables_title_text_transform = new EdgeField("selectblanksimple","service_tables_title_text_transform","","Text Transform","This is some description",$options_texttransform);
            				$row1->addChild("service_tables_title_text_transform",$service_tables_title_text_transform);

        			$row2 = new EdgeRow(true);
        			$group3->addChild("row2",$row2);

            				$service_tables_title_font_family = new EdgeField("Fontsimple","service_tables_title_font_family","-1","Font Family","This is some description");
            				$row2->addChild("service_tables_title_font_family",$service_tables_title_font_family);

            				$service_tables_title_font_style = new EdgeField("selectblanksimple","service_tables_title_font_style","","Font Style","This is some description",$options_fontstyle);
            				$row2->addChild("service_tables_title_font_style",$service_tables_title_font_style);

            				$service_tables_title_font_weight = new EdgeField("selectblanksimple","service_tables_title_font_weight","","Font Weight","This is some description",$options_fontweight);
            				$row2->addChild("service_tables_title_font_weight",$service_tables_title_font_weight);

            				$service_tables_title_letter_spacing = new EdgeField("textsimple","service_tables_title_letter_spacing","","Letter Spacing (px)","This is some description");
            				$row2->addChild("service_tables_title_letter_spacing",$service_tables_title_letter_spacing);

			$group4 = new EdgeGroup("Service Tables Content","Define Service tables content style");
    		$panel22->addChild("group4",$group4);

        			$row1 = new EdgeRow();
        			$group4->addChild("row1",$row1);

            				$service_tables_content_color = new EdgeField("colorsimple","service_tables_content_color","","Text Color","This is some description");
            				$row1->addChild("service_tables_content_color",$service_tables_content_color);

            				$service_tables_content_font_size = new EdgeField("textsimple","service_tables_content_font_size","","Font Size (px)","This is some description");
            				$row1->addChild("service_tables_content_font_size",$service_tables_content_font_size);

            				$service_tables_content_line_height = new EdgeField("textsimple","service_tables_content_line_height","","Line Height (px)","This is some description");
            				$row1->addChild("service_tables_content_line_height",$service_tables_content_line_height);

            				$service_tables_content_text_transform = new EdgeField("selectblanksimple","service_tables_content_text_transform","","Text Transform","This is some description",$options_texttransform);
            				$row1->addChild("service_tables_content_text_transform",$service_tables_content_text_transform);

        			$row2 = new EdgeRow(true);
        			$group4->addChild("row2",$row2);

            				$service_tables_content_font_family = new EdgeField("Fontsimple","service_tables_content_font_family","-1","Font Family","This is some description");
            				$row2->addChild("service_tables_content_font_family",$service_tables_content_font_family);

            				$service_tables_content_font_style = new EdgeField("selectblanksimple","service_tables_content_font_style","","Font Style","This is some description",$options_fontstyle);
            				$row2->addChild("service_tables_content_font_style",$service_tables_content_font_style);

            				$service_tables_content_font_weight = new EdgeField("selectblanksimple","service_tables_content_font_weight","","Font Weight","This is some description",$options_fontweight);
            				$row2->addChild("service_tables_content_font_weight",$service_tables_content_font_weight);

            				$service_tables_content_letter_spacing = new EdgeField("textsimple","service_tables_content_letter_spacing","","Letter Spacing (px)","This is some description");
            				$row2->addChild("service_tables_content_letter_spacing",$service_tables_content_letter_spacing);

//Separators

$panel13 = new EdgePanel("Separators","separators_panel");
$elementsPage->addChild("panel13",$panel13);

        $group1 = new EdgeGroup("Normal",'Define styles for separator of type "Normal"');
        $panel13->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $separator_color = new EdgeField("colorsimple","separator_color","","Color","This is some description");
                        $row1->addChild("separator_color",$separator_color);

                        $separator_thickness = new EdgeField("textsimple","separator_thickness","","Thickness (px)","This is some description");
                        $row1->addChild("separator_thickness",$separator_thickness);


                $row2 = new EdgeRow(true);
                $group1->addChild("row2",$row2);

                        $separator_topmargin = new EdgeField("textsimple","separator_topmargin","","Top Margin (px)","This is some description");
                        $row2->addChild("separator_topmargin",$separator_topmargin);

                        $separator_bottommargin = new EdgeField("textsimple","separator_bottommargin","","Bottom Margin (px)","This is some description");
                        $row2->addChild("separator_bottommargin",$separator_bottommargin);

                        $separator_type = new EdgeField("selectblanksimple","separator_type","","Separator type","", array(
                            "solid" => "Solid",
                            "dashed" => "Dashed",
                            "dotted" => "Dotted"
                        ));
                        $row2->addChild("separator_type",$separator_type);

        $group2 = new EdgeGroup("Small",'Define styles for separator of type "Small"');
        $panel13->addChild("group2",$group2);
                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $separator_small_color = new EdgeField("colorsimple","separator_small_color","","Color","This is some description");
                        $row1->addChild("separator_small_color",$separator_small_color);

                        $separator_small_thickness = new EdgeField("textsimple","separator_small_thickness","","Thickness (px)","This is some description");
                        $row1->addChild("separator_small_thickness",$separator_small_thickness);

                        $separator_small_width = new EdgeField("textsimple","separator_small_width","","Width (px)","This is some description");
                        $row1->addChild("separator_small_width",$separator_small_width);

                $row2 = new EdgeRow(true);
                $group2->addChild("row2",$row2);

                        $separator_small_topmargin = new EdgeField("textsimple","separator_small_topmargin","","Top Margin (px)","This is some description");
                        $row2->addChild("separator_small_topmargin",$separator_small_topmargin);

                        $separator_small_bottommargin = new EdgeField("textsimple","separator_small_bottommargin","","Bottom Margin (px)","This is some description");
                        $row2->addChild("separator_small_bottommargin",$separator_small_bottommargin);

                        $separator_small_type = new EdgeField("selectsimple","separator_small_type","","Separator type","", array( "" => "",
                            "solid" => "Solid",
                            "dashed" => "Dashed",
                            "dotted" => "Dotted"
                        ));
                        $row2->addChild("separator_small_type",$separator_small_type);


//Separators with text

$panel23 = new EdgePanel("Separators with Text","separators_with_text_panel");
$elementsPage->addChild("panel23",$panel23);

$group1 = new EdgeGroup("Text Style",'Define text styles for separator with text');
$panel23->addChild("group1",$group1);
$row1 = new EdgeRow();
$group1->addChild("row1",$row1);

$separators_with_text_text_color = new EdgeField("colorsimple","separators_with_text_text_color","","Text Color","This is some description");
$row1->addChild("separators_with_text_text_color",$separators_with_text_text_color);

$separators_with_text_text_hover_color = new EdgeField("colorsimple","separators_with_text_text_hover_color","","Text Hover Color","This is some description");
$row1->addChild("separators_with_text_text_hover_color",$separators_with_text_text_hover_color);

$separators_with_text_text_fontsize = new EdgeField("textsimple","separators_with_text_text_fontsize","","Font Size (px)","This is some description");
$row1->addChild("separators_with_text_text_fontsize",$separators_with_text_text_fontsize);

$separators_with_text_text_lineheight = new EdgeField("textsimple","separators_with_text_text_lineheight","","Line Height (px)","This is some description");
$row1->addChild("separators_with_text_text_lineheight",$separators_with_text_text_lineheight);

$row2 = new EdgeRow(true);
$group1->addChild("row2",$row2);

$separators_with_text_text_texttransform = new EdgeField("selectblanksimple","separators_with_text_text_texttransform","","Text Transform","This is some description",$options_texttransform);
$row2->addChild("separators_with_text_text_texttransform",$separators_with_text_text_texttransform);

$separators_with_text_text_google_fonts = new EdgeField("Fontsimple","separators_with_text_text_google_fonts","-1","Font Family","This is some description");
$row2->addChild("separators_with_text_text_google_fonts",$separators_with_text_text_google_fonts);

$separators_with_text_text_fontstyle = new EdgeField("selectblanksimple","separators_with_text_text_fontstyle","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("separators_with_text_text_fontstyle",$separators_with_text_text_fontstyle);

$separators_with_text_text_fontweight = new EdgeField("selectblanksimple","separators_with_text_text_fontweight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("separators_with_text_text_fontweight",$separators_with_text_text_fontweight);

$row3 = new EdgeRow(true);
$group1->addChild("row3",$row3);

$separators_with_text_text_letterspacing = new EdgeField("textsimple","separators_with_text_text_letterspacing","","Letter Spacing (px)","This is some description");
$row3->addChild("separators_with_text_text_letterspacing",$separators_with_text_text_letterspacing);


$panel24 = new EdgePanel("Single Image", "single_image_panel");
$elementsPage->addChild("panel24",$panel24);

    $group1 = new EdgeGroup("Hover Style","Define hover style");
    $panel24->addChild("group1",$group1);
        $row1 = new EdgeRow();
        $group1->addChild("row1",$row1);

            $single_image_hover_color = new EdgeField("colorsimple","single_image_hover_color","", "Background Color","This is some description");
            $row1->addChild("single_image_hover_color",$single_image_hover_color);

            $single_image_hover_transparency = new EdgeField("textsimple","single_image_hover_transparency","", "Transparency (0=full - 1=opaque)","This is some description");
            $row1->addChild("single_image_hover_transparency",$single_image_hover_transparency);

//Slider Navigation Interface

$panel9 = new EdgePanel("Slider Navigation Interface","navigation_panel");
$elementsPage->addChild("panel9",$panel9);

$navigation_slider_horizontal_section = new EdgeTitle("navigation_slider_horizontal_section","Edge Slider");
$panel9->addChild("navigation_slider_horizontal_section",$navigation_slider_horizontal_section);

        $group1 = new EdgeGroup("Navigation Button Size","Define navigation button size");
        $panel9->addChild("group1",$group1);

                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $navigation_button_width = new EdgeField("textsimple","navigation_button_width","","Width (px)","This is some description");
                        $row1->addChild("navigation_button_width",$navigation_button_width);

                        $navigation_button_height = new EdgeField("textsimple","navigation_button_height","","Height (px)","This is some description");
                        $row1->addChild("navigation_button_height",$navigation_button_height);

		$group9 = new EdgeGroup("Navigation Button Position","Enter the amount of pixels you would like to move the navigation buttons towards the edges of the slider");
		$panel9->addChild("group9",$group9);

				$row1 = new EdgeRow();
				$group9->addChild("row1",$row1);

					$navigation_button_position = new EdgeField("textsimple","navigation_button_position","","Position (px)","This is some description");
					$row1->addChild("navigation_button_position",$navigation_button_position);


        $group2 = new EdgeGroup("Icon Arrow Style","Define arrow navigation style");
        $panel9->addChild("group2",$group2);
                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $navigation_arrow_size = new EdgeField("textsimple","navigation_arrow_size","","Arrow Size (px)","Default value is 14    ");
                        $row1->addChild("navigation_arrow_size",$navigation_arrow_size);

                        $navigation_arrows_type = new EdgeField("selectblanksimple", "navigation_arrows_type", "", "Arrow Icon", "", $options_arrows_type);
                        $row1->addChild("navigation_arrows_type", $navigation_arrows_type);

                        $navigation_arrow_color = new EdgeField("colorsimple","navigation_arrow_color","","Arrow Color","This is some description");
                        $row1->addChild("navigation_arrow_color",$navigation_arrow_color);

                        $navigation_arrow_transparency = new EdgeField("textsimple","navigation_arrow_transparency","","Arrow Transparency (0-1)","This is some description");
                        $row1->addChild("navigation_arrow_transparency",$navigation_arrow_transparency);

                $row2 = new EdgeRow(true);
                $group2->addChild("row2",$row2);

                        $navigation_arrow_hover_color = new EdgeField("colorsimple","navigation_arrow_hover_color","","Arrow Hover Color","This is some description");
                        $row2->addChild("navigation_arrow_hover_color",$navigation_arrow_hover_color);

                        $navigation_arrow_hover_transparency = new EdgeField("textsimple","navigation_arrow_hover_transparency","","Arrow Hover Transparency (0-1)","This is some description");
                        $row2->addChild("navigation_arrow_hover_transparency",$navigation_arrow_hover_transparency);

		$navigation_number_group = new EdgeGroup('Navigation Numbers Style', 'Define navigation numbers style');
		$panel9->addChild('navigation_number_group', $navigation_number_group);

			$row1 = new EdgeRow();
			$navigation_number_group->addChild('row1', $row1);

				$navigation_number_font_size = new EdgeField('textsimple', 'navigation_number_font_size', '', 'Font Size (px)', '');
				$row1->addChild('navigation_number_font_size', $navigation_number_font_size);

				$navigation_number_letter_spacing = new EdgeField('textsimple', 'navigation_number_letter_spacing', '', 'Letter Spacing (px)', '');
				$row1->addChild('navigation_number_letter_spacing', $navigation_number_letter_spacing);

				$navigation_number_line_height = new EdgeField('textsimple', 'navigation_number_line_height', '', 'Line Height', '');
				$row1->addChild('navigation_number_line_height', $navigation_number_line_height);

				$navigation_number_font_font_family = new EdgeField('fontsimple', 'navigation_number_font_font_family','-1','Font Family', '');
				$row1->addChild('navigation_number_font_font_family', $navigation_number_font_font_family);

			$row2 = new EdgeRow(true);
			$navigation_number_group->addChild('row2', $row2);

				$navigation_number_font_style = new EdgeField('selectsimple', 'navigation_number_font_style', '', 'Font Style', '', $options_fontstyle);
				$row2->addChild('navigation_number_font_style', $navigation_number_font_style);

				$navigation_number_font_weight = new EdgeField('selectsimple', 'navigation_number_font_weight', '', 'Font Weight', '', $options_fontweight);
				$row2->addChild('navigation_number_font_weight', $navigation_number_font_weight);

			$row3 = new EdgeRow(true);
			$navigation_number_group->addChild('row3', $row3);

				$navigation_number_color = new EdgeField('colorsimple', 'navigation_number_color', '', 'Color', '');
				$row3->addChild('navigation_number_color', $navigation_number_color);

				$navigation_number_hover_color = new EdgeField('colorsimple', 'navigation_number_hover_color', '', 'Hover Color', '');
				$row3->addChild('navigation_number_hover_color', $navigation_number_hover_color);

				$navigation_number_transparency = new EdgeField('textsimple', 'navigation_number_transparency', '', 'Transparency (0=full - 1=opaque)', '');
				$row3->addChild('navigation_number_transparency', $navigation_number_transparency);

				$navigation_number_hover_transparency = new EdgeField('textsimple', 'navigation_number_hover_transparency', '', 'Hover Transparency (0=full - 1=opaque)', '');
				$row3->addChild('navigation_number_hover_transparency', $navigation_number_hover_transparency);

        $group3 = new EdgeGroup("Navigation Button Background","Define navigation button background");
        $panel9->addChild("group3",$group3);

                $row1 = new EdgeRow();
                $group3->addChild("row1",$row1);

                        $navigation_background_color = new EdgeField("colorsimple","navigation_background_color","","Background Color","This is some description");
                        $row1->addChild("navigation_background_color",$navigation_background_color);

                        $navigation_background_transparency = new EdgeField("textsimple","navigation_background_transparency","","Background Transparency (0-1)","This is some description");
                        $row1->addChild("navigation_background_transparency",$navigation_background_transparency);

                        $navigation_background_hover_color = new EdgeField("colorsimple","navigation_background_hover_color","","Background Hover Color","This is some description");
                        $row1->addChild("navigation_background_hover_color",$navigation_background_hover_color);

                        $navigation_background_hover_transparency = new EdgeField("textsimple","navigation_background_hover_transparency","","Background Hover Transparency (0-1)","This is some description");
                        $row1->addChild("navigation_background_hover_transparency",$navigation_background_hover_transparency);

        $group4 = new EdgeGroup("Navigation Button Border","Define border style");
        $panel9->addChild("group4",$group4);

                $row1 = new EdgeRow();
                $group4->addChild("row1",$row1);

                        $navigation_border_width = new EdgeField("textsimple","navigation_border_width","","Border width (px)","");
                        $row1->addChild("navigation_border_width",$navigation_border_width);

                        $navigation_border_radius = new EdgeField("textsimple","navigation_border_radius","","Border Radius (px)","This is some description");
                        $row1->addChild("navigation_border_radius",$navigation_border_radius);

                        $navigation_border_color = new EdgeField("colorsimple","navigation_border_color","","Border Color","This is some description");
                        $row1->addChild("navigation_border_color",$navigation_border_color);

                        $navigation_border_transparency = new EdgeField("textsimple","navigation_border_transparency","","Border Transparency (0-1)","This is some description");
                        $row1->addChild("navigation_border_transparency",$navigation_border_transparency);

                $row2 = new EdgeRow(true);
                $group4->addChild("row2",$row2);

                        $navigation_border_hover_color = new EdgeField("colorsimple","navigation_border_hover_color","","Border Hover Color","This is some description");
                        $row2->addChild("navigation_border_hover_color",$navigation_border_hover_color);

                        $navigation_border_hover_transparency = new EdgeField("textsimple","navigation_border_hover_transparency","","Border Hover Transparency (0-1)","This is some description");
                        $row2->addChild("navigation_border_hover_transparency",$navigation_border_hover_transparency);

$navigation_show_button_shadow = new EdgeField("yesno","navigation_show_button_shadow","no","Show Button Shadow","Enabling this options will show button shadow", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_navigation_button_shadow_container"));
$panel9->addChild("navigation_show_button_shadow",$navigation_show_button_shadow);

$navigation_button_shadow_container = new EdgeContainer("navigation_button_shadow_container","navigation_show_button_shadow","no");
$panel9->addChild("navigation_button_shadow_container",$navigation_button_shadow_container);

$group9 = new EdgeGroup("Button Shadow","Set horizontal and vertical position of shadow (negative values are allowed), and define blur and spread.");
$navigation_button_shadow_container->addChild("group9",$group9);

	$row1 = new EdgeRow();
	$group9->addChild("row1",$row1);

		$navigation_button_shadow_color = new EdgeField("colorsimple","navigation_button_shadow_color","","Color","Choose color for  box shadow");
		$row1->addChild("navigation_button_shadow_color",$navigation_button_shadow_color);

			$row2 = new EdgeRow();
			$group9->addChild("row2",$row2);

			$navigation_button_h_shadow = new EdgeField("textsimple","navigation_button_h_shadow","","Horizontal shadow (px)","");
			$row2->addChild("navigation_button_h_shadow",$navigation_button_h_shadow);

			$navigation_button_v_shadow = new EdgeField("textsimple","navigation_button_v_shadow","","Vertical shadow (px)","");
			$row2->addChild("navigation_button_v_shadow",$navigation_button_v_shadow);

			$navigation_button_blur = new EdgeField("textsimple","navigation_button_blur","","Blur (px)","");
			$row2->addChild("navigation_button_blur",$navigation_button_blur);

			$navigation_button_spread = new EdgeField("textsimple","navigation_button_spread","","Spread (px)","");
			$row2->addChild("navigation_button_spread",$navigation_button_spread);


$navigation_carousels_slider = new EdgeTitle("navigation_carousels_slider","Carousel Sliders");
$panel9->addChild("navigation_carousels_slider",$navigation_carousels_slider);

        $group16 = new EdgeGroup("Navigation Button Size","Define navigation button size");
        $panel9->addChild("group16",$group16);

                $row1 = new EdgeRow();
                $group16->addChild("row1",$row1);

                        $carousel_navigation_button_width = new EdgeField("textsimple","carousel_navigation_button_width","","Width (px)","This is some description");
                        $row1->addChild("carousel_navigation_button_width",$carousel_navigation_button_width);

                        $carousel_navigation_button_height = new EdgeField("textsimple","carousel_navigation_button_height","","Height (px)","This is some description");
                        $row1->addChild("carousel_navigation_button_height",$carousel_navigation_button_height);

        $group17 = new EdgeGroup("Navigation Button Position","Enter the amount of pixels you would like to move the navigation buttons towards the edges of the slider");
        $panel9->addChild("group17",$group17);

                $row1 = new EdgeRow();
                $group17->addChild("row1",$row1);

                    $carousel_navigation_button_position = new EdgeField("textsimple","carousel_navigation_button_position","","Position (px)","This is some description");
                    $row1->addChild("carousel_navigation_button_position",$carousel_navigation_button_position);


        $group18 = new EdgeGroup("Icon Arrow Style","Define arrow navigation style");
        $panel9->addChild("group18",$group18);
                $row1 = new EdgeRow();
                $group18->addChild("row1",$row1);

                        $carousel_navigation_arrow_size = new EdgeField("textsimple","carousel_navigation_arrow_size","","Arrow Size (px)","Default value is 14    ");
                        $row1->addChild("carousel_navigation_arrow_size",$carousel_navigation_arrow_size);

                        $carousel_navigation_arrows_type = new EdgeField("selectblanksimple", "carousel_navigation_arrows_type", "", "Arrow Icon", "", $options_arrows_type);
                        $row1->addChild("carousel_navigation_arrows_type", $carousel_navigation_arrows_type);

                        $carousel_navigation_arrow_color = new EdgeField("colorsimple","carousel_navigation_arrow_color","","Arrow Color","This is some description");
                        $row1->addChild("carousel_navigation_arrow_color",$carousel_navigation_arrow_color);

                        $carousel_navigation_arrow_transparency = new EdgeField("textsimple","carousel_navigation_arrow_transparency","","Arrow Transparency (0-1)","This is some description");
                        $row1->addChild("carousel_navigation_arrow_transparency",$carousel_navigation_arrow_transparency);

                $row2 = new EdgeRow(true);
                $group18->addChild("row2",$row2);

                        $carousel_navigation_arrow_hover_color = new EdgeField("colorsimple","carousel_navigation_arrow_hover_color","","Arrow Hover Color","This is some description");
                        $row2->addChild("carousel_navigation_arrow_hover_color",$carousel_navigation_arrow_hover_color);

                        $carousel_navigation_arrow_hover_transparency = new EdgeField("textsimple","carousel_navigation_arrow_hover_transparency","","Arrow Hover Transparency (0-1)","This is some description");
                        $row2->addChild("carousel_navigation_arrow_hover_transparency",$carousel_navigation_arrow_hover_transparency);

        $group19 = new EdgeGroup("Navigation Button Background","Define navigation button background");
        $panel9->addChild("group19",$group19);

                $row1 = new EdgeRow();
                $group19->addChild("row1",$row1);

                        $carousel_navigation_background_color = new EdgeField("colorsimple","carousel_navigation_background_color","","Background Color","This is some description");
                        $row1->addChild("carousel_navigation_background_color",$carousel_navigation_background_color);

                        $carousel_navigation_background_transparency = new EdgeField("textsimple","carousel_navigation_background_transparency","","Background Transparency (0-1)","This is some description");
                        $row1->addChild("carousel_navigation_background_transparency",$carousel_navigation_background_transparency);

                        $carousel_navigation_background_hover_color = new EdgeField("colorsimple","carousel_navigation_background_hover_color","","Background Hover Color","This is some description");
                        $row1->addChild("carousel_navigation_background_hover_color",$carousel_navigation_background_hover_color);

                        $carousel_navigation_background_hover_transparency = new EdgeField("textsimple","carousel_navigation_background_hover_transparency","","Background Hover Transparency (0-1)","This is some description");
                        $row1->addChild("carousel_navigation_background_hover_transparency",$carousel_navigation_background_hover_transparency);

        $group10 = new EdgeGroup("Navigation Button Border","Define border style");
        $panel9->addChild("group10",$group10);

                $row1 = new EdgeRow();
                $group10->addChild("row1",$row1);

                        $carousel_navigation_border_width = new EdgeField("textsimple","carousel_navigation_border_width","","Border width (px)","");
                        $row1->addChild("carousel_navigation_border_width",$carousel_navigation_border_width);

                        $carousel_navigation_border_radius = new EdgeField("textsimple","carousel_navigation_border_radius","","Border Radius (px)","This is some description");
                        $row1->addChild("carousel_navigation_border_radius",$carousel_navigation_border_radius);

                        $carousel_navigation_border_color = new EdgeField("colorsimple","carousel_navigation_border_color","","Border Color","This is some description");
                        $row1->addChild("carousel_navigation_border_color",$carousel_navigation_border_color);

                        $carousel_navigation_border_transparency = new EdgeField("textsimple","carousel_navigation_border_transparency","","Border Transparency (0-1)","This is some description");
                        $row1->addChild("carousel_navigation_border_transparency",$carousel_navigation_border_transparency);

                $row2 = new EdgeRow(true);
                $group10->addChild("row2",$row2);

                        $carousel_navigation_border_hover_color = new EdgeField("colorsimple","carousel_navigation_border_hover_color","","Border Hover Color","This is some description");
                        $row2->addChild("carousel_navigation_border_hover_color",$carousel_navigation_border_hover_color);

                        $carousel_navigation_border_hover_transparency = new EdgeField("textsimple","carousel_navigation_border_hover_transparency","","Border Hover Transparency (0-1)","This is some description");
                        $row2->addChild("carousel_navigation_border_hover_transparency",$carousel_navigation_border_hover_transparency);

$carousel_navigation_show_button_shadow = new EdgeField("yesno","carousel_navigation_show_button_shadow","no","Show Button Shadow","Enabling this options will show button shadow", array(), array(
"dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_carousel_navigation_button_shadow_container"));
$panel9->addChild("carousel_navigation_show_button_shadow",$carousel_navigation_show_button_shadow);

$carousel_navigation_button_shadow_container = new EdgeContainer("carousel_navigation_button_shadow_container","carousel_navigation_show_button_shadow","no");
$panel9->addChild("carousel_navigation_button_shadow_container",$carousel_navigation_button_shadow_container);

    $group9 = new EdgeGroup("Button Shadow","Set horizontal and vertical position of shadow (negative values are allowed), and define blur and spread.");
    $carousel_navigation_button_shadow_container->addChild("group9",$group9);

        $row1 = new EdgeRow();
        $group9->addChild("row1",$row1);

            $carousel_navigation_button_shadow_color = new EdgeField("colorsimple","carousel_navigation_button_shadow_color","","Color","Choose color for  box shadow");
            $row1->addChild("carousel_navigation_button_shadow_color",$carousel_navigation_button_shadow_color);

                $row2 = new EdgeRow();
                $group9->addChild("row2",$row2);

                $carousel_navigation_button_h_shadow = new EdgeField("textsimple","carousel_navigation_button_h_shadow","","Horizontal shadow (px)","");
                $row2->addChild("carousel_navigation_button_h_shadow",$carousel_navigation_button_h_shadow);

                $carousel_navigation_button_v_shadow = new EdgeField("textsimple","carousel_navigation_button_v_shadow","","Vertical shadow (px)","");
                $row2->addChild("carousel_navigation_button_v_shadow",$carousel_navigation_button_v_shadow);

                $carousel_navigation_button_blur = new EdgeField("textsimple","carousel_navigation_button_blur","","Blur (px)","");
                $row2->addChild("carousel_navigation_button_blur",$carousel_navigation_button_blur);

                $carousel_navigation_button_spread = new EdgeField("textsimple","carousel_navigation_button_spread","","Spread (px)","");
                $row2->addChild("carousel_navigation_button_spread",$carousel_navigation_button_spread);



$navigation_single_sliders_slider = new EdgeTitle("navigation_single_sliders_slider","Flex Sliders");
$panel9->addChild("navigation_single_sliders_slider",$navigation_single_sliders_slider);

        $group11 = new EdgeGroup("Navigation Button Size","Define navigation button size");
        $panel9->addChild("group11",$group11);
                $row1 = new EdgeRow();
                $group11->addChild("row1",$row1);

                        $single_slider_navigation_button_width = new EdgeField("textsimple","single_slider_navigation_button_width","","Width (px)","This is some description");
                        $row1->addChild("single_slider_navigation_button_width",$single_slider_navigation_button_width);

                        $single_slider_navigation_button_height = new EdgeField("textsimple","single_slider_navigation_button_height","","Height (px)","This is some description");
                        $row1->addChild("single_slider_navigation_button_height",$single_slider_navigation_button_height);

    $group12 = new EdgeGroup("Navigation Button Position","Enter the amount of pixels you would like to move the navigation buttons towards the edges of the slider");
    $panel9->addChild("group12",$group12);

            $row1 = new EdgeRow();
            $group12->addChild("row1",$row1);
                        
                $single_slider_navigation_button_position = new EdgeField("textsimple","single_slider_navigation_button_position","","Position (px)","This is some description");
                $row1->addChild("single_slider_navigation_button_position",$single_slider_navigation_button_position);


        $group13 = new EdgeGroup("Icon Arrow Style","Define arrow navigation style");
        $panel9->addChild("group13",$group13);
                $row1 = new EdgeRow();
                $group13->addChild("row1",$row1);

                        $single_slider_navigation_arrow_size = new EdgeField("textsimple","single_slider_navigation_arrow_size","","Arrow Size (px)","Default value is 14    ");
                        $row1->addChild("single_slider_navigation_arrow_size",$single_slider_navigation_arrow_size);

                        $single_slider_navigation_arrows_type = new EdgeField("selectblanksimple", "single_slider_navigation_arrows_type", "", "Arrow Icon", "", $options_arrows_type);
                        $row1->addChild("single_slider_navigation_arrows_type", $single_slider_navigation_arrows_type);

                        $single_slider_navigation_arrow_color = new EdgeField("colorsimple","single_slider_navigation_arrow_color","","Arrow Color","This is some description");
                        $row1->addChild("single_slider_navigation_arrow_color",$single_slider_navigation_arrow_color);

                        $single_slider_navigation_arrow_transparency = new EdgeField("textsimple","single_slider_navigation_arrow_transparency","","Arrow Transparency (0-1)","This is some description");
                        $row1->addChild("single_slider_navigation_arrow_transparency",$single_slider_navigation_arrow_transparency);

                $row2 = new EdgeRow(true);
                $group13->addChild("row2",$row2);

                        $single_slider_navigation_arrow_hover_color = new EdgeField("colorsimple","single_slider_navigation_arrow_hover_color","","Arrow Hover Color","This is some description");
                        $row2->addChild("single_slider_navigation_arrow_hover_color",$single_slider_navigation_arrow_hover_color);

                        $single_slider_navigation_arrow_hover_transparency = new EdgeField("textsimple","single_slider_navigation_arrow_hover_transparency","","Arrow Hover Transparency (0-1)","This is some description");
                        $row2->addChild("single_slider_navigation_arrow_hover_transparency",$single_slider_navigation_arrow_hover_transparency);

        $group14 = new EdgeGroup("Navigation Button Background","Define navigation button background");
        $panel9->addChild("group14",$group14);

                $row1 = new EdgeRow();
                $group14->addChild("row1",$row1);

                        $single_slider_navigation_background_color = new EdgeField("colorsimple","single_slider_navigation_background_color","","Background Color","This is some description");
                        $row1->addChild("single_slider_navigation_background_color",$single_slider_navigation_background_color);

                        $single_slider_navigation_background_transparency = new EdgeField("textsimple","single_slider_navigation_background_transparency","","Background Transparency (0-1)","This is some description");
                        $row1->addChild("single_slider_navigation_background_transparency",$single_slider_navigation_background_transparency);

                        $single_slider_navigation_background_hover_color = new EdgeField("colorsimple","single_slider_navigation_background_hover_color","","Background Hover Color","This is some description");
                        $row1->addChild("single_slider_navigation_background_hover_color",$single_slider_navigation_background_hover_color);

                        $single_slider_navigation_background_hover_transparency = new EdgeField("textsimple","single_slider_navigation_background_hover_transparency","","Background Hover Transparency (0-1)","This is some description");
                        $row1->addChild("single_slider_navigation_background_hover_transparency",$single_slider_navigation_background_hover_transparency);

        $group15 = new EdgeGroup("Navigation Button Border","Define border style");
        $panel9->addChild("group15",$group15);

                $row1 = new EdgeRow();
                $group15->addChild("row1",$row1);

                        $single_slider_navigation_border_width = new EdgeField("textsimple","single_slider_navigation_border_width","","Border width (px)","");
                        $row1->addChild("single_slider_navigation_border_width",$single_slider_navigation_border_width);

                        $single_slider_navigation_border_radius = new EdgeField("textsimple","single_slider_navigation_border_radius","","Border Radius (px)","This is some description");
                        $row1->addChild("single_slider_navigation_border_radius",$single_slider_navigation_border_radius);

                        $single_slider_navigation_border_color = new EdgeField("colorsimple","single_slider_navigation_border_color","","Border Color","This is some description");
                        $row1->addChild("single_slider_navigation_border_color",$single_slider_navigation_border_color);

                        $single_slider_navigation_border_transparency = new EdgeField("textsimple","single_slider_navigation_border_transparency","","Border Transparency (0-1)","This is some description");
                        $row1->addChild("single_slider_navigation_border_transparency",$single_slider_navigation_border_transparency);

                $row2 = new EdgeRow(true);
                $group15->addChild("row2",$row2);

                        $single_slider_navigation_border_hover_color = new EdgeField("colorsimple","single_slider_navigation_border_hover_color","","Border Hover Color","This is some description");
                        $row2->addChild("single_slider_navigation_border_hover_color",$single_slider_navigation_border_hover_color);

                        $single_slider_navigation_border_hover_transparency = new EdgeField("textsimple","single_slider_navigation_border_hover_transparency","","Border Hover Transparency (0-1)","This is some description");
                        $row2->addChild("single_slider_navigation_border_hover_transparency",$single_slider_navigation_border_hover_transparency);

$single_slider_navigation_show_button_shadow = new EdgeField("yesno","single_slider_navigation_show_button_shadow","no","Show Button Shadow","Enabling this options will show button shadow", array(), array(
"dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_single_slider_navigation_button_shadow_container"));
$panel9->addChild("single_slider_navigation_show_button_shadow",$single_slider_navigation_show_button_shadow);

$single_slider_navigation_button_shadow_container = new EdgeContainer("single_slider_navigation_button_shadow_container","single_slider_navigation_show_button_shadow","no");
$panel9->addChild("single_slider_navigation_button_shadow_container",$single_slider_navigation_button_shadow_container);

$group9 = new EdgeGroup("Button Shadow","Set horizontal and vertical position of shadow (negative values are allowed), and define blur and spread.");
$single_slider_navigation_button_shadow_container->addChild("group9",$group9);

    $row1 = new EdgeRow();
    $group9->addChild("row1",$row1);

        $single_slider_navigation_button_shadow_color = new EdgeField("colorsimple","single_slider_navigation_button_shadow_color","","Color","Choose color for  box shadow");
        $row1->addChild("single_slider_navigation_button_shadow_color",$single_slider_navigation_button_shadow_color);

            $row2 = new EdgeRow();
            $group9->addChild("row2",$row2);

            $single_slider_navigation_button_h_shadow = new EdgeField("textsimple","single_slider_navigation_button_h_shadow","","Horizontal shadow (px)","");
            $row2->addChild("single_slider_navigation_button_h_shadow",$single_slider_navigation_button_h_shadow);

            $single_slider_navigation_button_v_shadow = new EdgeField("textsimple","single_slider_navigation_button_v_shadow","","Vertical shadow (px)","");
            $row2->addChild("single_slider_navigation_button_v_shadow",$single_slider_navigation_button_v_shadow);

            $single_slider_navigation_button_blur = new EdgeField("textsimple","single_slider_navigation_button_blur","","Blur (px)","");
            $row2->addChild("single_slider_navigation_button_blur",$single_slider_navigation_button_blur);

            $single_slider_navigation_button_spread = new EdgeField("textsimple","single_slider_navigation_button_spread","","Spread (px)","");
            $row2->addChild("single_slider_navigation_button_spread",$single_slider_navigation_button_spread);


$slider_circle_navigation = new EdgeTitle("slider_circle_navigation","Bullet Navigation");
$panel9->addChild("slider_circle_navigation",$slider_circle_navigation);

    $group8 = new EdgeGroup("Navigation Controls","Define navigation controls style");
    $panel9->addChild("group8",$group8);

            $row1 = new EdgeRow();
            $group8->addChild("row1",$row1);

                    $navigation_control_active_color = new EdgeField("colorsimple","navigation_control_active_color","","Active Color","This is some description");
                    $row1->addChild("navigation_control_active_color",$navigation_control_active_color);

                    $navigation_control_color = new EdgeField("colorsimple","navigation_control_color","","Color","This is some description");
                    $row1->addChild("navigation_control_color",$navigation_control_color);

                    $navigation_control_size = new EdgeField("textsimple","navigation_control_size","","Size (px)","This is some description");
                    $row1->addChild("navigation_control_size",$navigation_control_size);

                    $navigation_control_border_radius = new EdgeField("textsimple","navigation_control_border_radius","","Border Radius (px)","This is some description");
                    $row1->addChild("navigation_control_border_radius",$navigation_control_border_radius);


$navigation_slider_vertical_section = new EdgeTitle("navigation_slider_vertical_section","Vertical Sliders (Full Screen Section Template)");
$panel9->addChild("navigation_slider_vertical_section",$navigation_slider_vertical_section);

        $group6 = new EdgeGroup("Navigation Button Size","Define navigation button size");
        $panel9->addChild("group6",$group6);
                $row1 = new EdgeRow();
                $group6->addChild("row1",$row1);

                        $fs_navigation_button_width = new EdgeField("textsimple","fs_navigation_button_width","","Width (px)","This is some description");
                        $row1->addChild("fs_navigation_button_width",$fs_navigation_button_width);

                        $fs_navigation_button_height = new EdgeField("textsimple","fs_navigation_button_height","","Height (px)","This is some description");
                        $row1->addChild("fs_navigation_button_height",$fs_navigation_button_height);

        $group5 = new EdgeGroup("Icon Arrow Style","Define arrow navigation style");
        $panel9->addChild("group5",$group5);

                $row1 = new EdgeRow();
                $group5->addChild("row1",$row1);

						$fs_navigation_arrow_size = new EdgeField("textsimple","fs_navigation_arrow_size","","Icon Arrow Size (px)","Define size for arrow navigation icons");
						$row1->addChild("fs_navigation_arrow_size",$fs_navigation_arrow_size);

                        $fs_navigation_arrow_color = new EdgeField("colorsimple","fs_navigation_arrow_color","","Arrow Color","This is some description");
                        $row1->addChild("fs_navigation_arrow_color",$fs_navigation_arrow_color);

                        $fs_navigation_arrow_hover_color = new EdgeField("colorsimple","fs_navigation_arrow_hover_color","","Arrow Hover Color","This is some description");
                        $row1->addChild("fs_navigation_arrow_hover_color",$fs_navigation_arrow_hover_color);

        $group7 = new EdgeGroup("Navigation Button Background","Define navigation button background");
        $panel9->addChild("group7",$group7);

                $row1 = new EdgeRow();
                $group7->addChild("row1",$row1);

                        $fs_navigation_background_color = new EdgeField("colorsimple","fs_navigation_background_color","","Background Color","This is some description");
                        $row1->addChild("fs_navigation_background_color",$fs_navigation_background_color);

                        $fs_navigation_background_transparency = new EdgeField("textsimple","fs_navigation_background_transparency","","Background Transparency (0-1)","This is some description");
                        $row1->addChild("fs_navigation_background_transparency",$fs_navigation_background_transparency);

                        $fs_navigation_background_hover_color = new EdgeField("colorsimple","fs_navigation_background_hover_color","","Background Hover Color","This is some description");
                        $row1->addChild("fs_navigation_background_hover_color",$fs_navigation_background_hover_color);

                        $fs_navigation_background_hover_transparency = new EdgeField("textsimple","fs_navigation_background_hover_transparency","","Background Hover Transparency (0-1)","This is some description");
                        $row1->addChild("fs_navigation_background_hover_transparency",$fs_navigation_background_hover_transparency);



//Social Icon

$panel14 = new EdgePanel("Social Icon", "social_icon_panel");
$elementsPage->addChild("panel14",$panel14);

        $group1 = new EdgeGroup("Normal Icons","Define Normal Social Icons style");
        $panel14->addChild("group1",$group1);
        $row1 = new EdgeRow();
        $group1->addChild("row1",$row1);

                $social_color = new EdgeField("colorsimple","social_color","","Icon Color","This is some description");
                $row1->addChild("social_color",$social_color);

                        $social_hover_color = new EdgeField("colorsimple","social_hover_color","","Icon Hover Color","This is some description");
                        $row1->addChild("social_hover_color",$social_hover_color);

        $group2 = new EdgeGroup("Social Circle/Square Icon","Define Social circle/square Icons style");
        $panel14->addChild("group2",$group2);
                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $social_icon_color = new EdgeField("colorsimple","social_icon_color","","Icon Color","This is some description");
                        $row1->addChild("social_icon_color",$social_icon_color);

                        $social_icon_hover_color = new EdgeField("colorsimple","social_icon_hover_color","","Icon Hover Color","This is some description");
                        $row1->addChild("social_icon_hover_color",$social_icon_hover_color);

                        $social_icon_background_color = new EdgeField("colorsimple","social_icon_background_color","","Icon Background Color","This is some description");
                        $row1->addChild("social_icon_background_color",$social_icon_background_color);

                        $social_icon_hover_background_color = new EdgeField("colorsimple","social_icon_hover_background_color","","Icon Hover Background Color","This is some description");
                        $row1->addChild("social_icon_hover_background_color",$social_icon_hover_background_color);

                $row2 = new EdgeRow(true);
                $group2->addChild("row2",$row2);

                        $social_icon_border_color = new EdgeField("colorsimple","social_icon_border_color","","Icon Border Color","This is some description");
                        $row2->addChild("social_icon_border_color",$social_icon_border_color);

                        $social_icon_hover_border_color = new EdgeField("colorsimple","social_icon_hover_border_color","","Icon Hover Border Color","This is some description");
                        $row2->addChild("social_icon_hover_border_color",$social_icon_hover_border_color);

        $social_icon_box_shadows = new EdgeField('yesno', 'social_icon_box_shadows', 'no', 'Show Icon Shadows', 'Enabling this option will show icon shadow', array(), array(
            'dependence' => true,
            'dependence_hide_on_yes' => '',
            'dependence_show_on_yes' => '#edgtf_social_icon_box_shadows_container'
        ));
        $panel14->addChild('social_icon_box_shadows', $social_icon_box_shadows);

        $social_icon_box_shadows_container = new EdgeContainer('social_icon_box_shadows_container', 'social_icon_box_shadows', 'no');
        $panel14->addChild('social_icon_box_shadows_container', $social_icon_box_shadows_container);

            $group3 = new EdgeGroup('Icon Shadows', 'Set horizontal and vertical position of shadow (negative values are allowed), and define blur and spread.');
            $social_icon_box_shadows_container->addChild('group3', $group3);

                $row3 = new EdgeRow();
                $group3->addChild('row3', $row3);

                    $social_icon_box_shadow_horizontal_shadow = new EdgeField('textsimple', 'social_icon_box_shadow_horizontal_shadow', '', 'Horizontal Shadow (px)');
                    $row3->addChild('social_icon_box_shadow_horizontal_shadow', $social_icon_box_shadow_horizontal_shadow);

                    $social_icon_box_shadow_vertical_shadow = new EdgeField('textsimple', 'social_icon_box_shadow_vertical_shadow', '', 'Vertical Shadow (px)');
                    $row3->addChild('social_icon_box_shadow_vertical_shadow', $social_icon_box_shadow_vertical_shadow);

                    $social_icon_box_shadow_blur_distance = new EdgeField('textsimple', 'social_icon_box_shadow_blur_distance', '', 'Blur (px)');
                    $row3->addChild('social_icon_box_shadow_blur_distance', $social_icon_box_shadow_blur_distance);

                    $social_icon_box_shadow_shadow_size = new EdgeField('textsimple', 'social_icon_box_shadow_shadow_size', '', 'Spread (px)');
                    $row3->addChild('social_icon_box_shadow_shadow_size', $social_icon_box_shadow_shadow_size);

                $row4 = new EdgeRow(true);
                $group3->addChild('row4', $row4);

                    $social_icon_box_shadow_shadow_color = new EdgeField('colorsimple', 'social_icon_box_shadow_shadow_color', '', 'Shadow color');
                    $row4->addChild('social_icon_box_shadow_shadow_color', $social_icon_box_shadow_shadow_color);

// Social Share List Icon
						
$panel26 = new EdgePanel("Social Share List", "social_share_list_icon_panel");
$elementsPage->addChild("panel26",$panel26);

	$group1 = new EdgeGroup("Icons","Define Social Icons style for Social Share List");
    $panel26->addChild("group1",$group1);
	$row1 = new EdgeRow();
    $group1->addChild("row1",$row1);
	
			$social_share_list_icon_size = new EdgeField("textsimple","social_share_list_icon_size","","Icon Size (px)","This is some description");
			$row1->addChild("social_share_list_icon_size",$social_share_list_icon_size);

			$social_share_list_icon_margin_right = new EdgeField("textsimple","social_share_list_icon_margin_right","","Margin Right (px)","This is some description");
			$row1->addChild("social_share_list_icon_margin_right",$social_share_list_icon_margin_right);
			
			$social_share_list_icon_color = new EdgeField("colorsimple","social_share_list_icon_color","","Icon Color","This is some description");
            $row1->addChild("social_share_list_icon_color",$social_share_list_icon_color);
			
            $social_share_list_icon_hover_color = new EdgeField("colorsimple","social_share_list_icon_hover_color","","Icon Hover Color","This is some description");
            $row1->addChild("social_share_list_icon_hover_color",$social_share_list_icon_hover_color);

        $social_share_list_icons_type = new EdgeField('select', 'social_share_list_icons_type', 'circle', 'Icons Type', 'Choose type of social share list icons', array(
            'circle' => 'Circle',
            'normal' => 'Normal'
        ));
        $panel26->addChild('social_share_list_icons_type', $social_share_list_icons_type);

//Tabs Panel

$panel15 = new EdgePanel("Tabs", "tabs_panel");
$elementsPage->addChild("panel15",$panel15);
		

        $tabs_navigation_subtitle = new EdgeTitle("tabs_navigation_subtitle", "Tabs Navigation (with Text)");
        $panel15->addChild("tabs_navigation_subtitle", $tabs_navigation_subtitle);

        $group1 = new EdgeGroup("Tabs Navigation Text Style","Define Tabs text style");
        $panel15->addChild("group1",$group1);
                
			$row1 = new EdgeRow();
			$group1->addChild("row1",$row1);
			
				$tab_text_color = new EdgeField("colorsimple","tab_text_color","","Text Color","This is some description");
				$row1->addChild("tab_text_color",$tab_text_color);

				$tab_active_text_color = new EdgeField("colorsimple","tab_active_text_color","","Text Active Color","This is some description");
				$row1->addChild("tab_active_text_color",$tab_active_text_color);			

				$tab_text_size = new EdgeField("textsimple","tab_text_size","","Text Size (px)","This is some description");
				$row1->addChild("tab_text_size",$tab_text_size);

				$tab_nav_font_family = new EdgeField("Fontsimple","tab_nav_font_family","-1","Font Family","This is some description");
				$row1->addChild("tab_nav_font_family",$tab_nav_font_family);				
				
			$row2 = new EdgeRow(true);
			$group1->addChild("row2",$row2);	
			
				$tab_text_transform = new EdgeField("selectblanksimple","tab_text_transform","","Text Transform","This is some description",$options_texttransform);
				$row2->addChild("tab_text_transform",$tab_text_transform);

				$tab_letter_spacing = new EdgeField("textsimple","tab_letter_spacing","","Letter Spacing (px)","This is some description");
				$row2->addChild("tab_letter_spacing",$tab_letter_spacing);

				$tab_font_weight = new EdgeField("selectblanksimple","tab_font_weight","","Font Weight","This is some description",$options_fontweight);
				$row2->addChild("tab_font_weight",$tab_font_weight);

				$tab_font_style = new EdgeField("selectblanksimple","tab_font_style","","Font Style","This is some description",$options_fontstyle);
				$row2->addChild("tab_font_style",$tab_font_style);
				
		$tabs_navigation_icon_subtitle = new EdgeTitle("tabs_navigation_icon_subtitle", "Tabs Navigation (with Icon)");
		$panel15->addChild("tabs_navigation_icon_subtitle", $tabs_navigation_icon_subtitle);

        $group2 = new EdgeGroup("Tabs Navigation Icon Style","Define icon style");
        $panel15->addChild("group2",$group2);
		
                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $tabs_icon_size = new EdgeField("textsimple","tabs_icon_size","","Icon Size (px)","This is some description");
                        $row1->addChild("tabs_icon_size",$tabs_icon_size);

                        $tab_icon_color = new EdgeField("colorsimple","tab_icon_color","","Icon Color","This is some description");
                        $row1->addChild("tab_icon_color",$tab_icon_color);

                        $tab_icon_hover_color = new EdgeField("colorsimple","tab_icon_hover_color","","Icon Hover Color","This is some description");
                        $row1->addChild("tab_icon_hover_color",$tab_icon_hover_color);
						
		$tabs_navigation_type_with_lines_subtitle = new EdgeTitle("tabs_navigation_type_with_lines_subtitle", "Tabs Navigation (With Lines)");
		$panel15->addChild("tabs_navigation_type_with_lines_subtitle", $tabs_navigation_type_with_lines_subtitle);				

        $group3 = new EdgeGroup("Tabs Navigation Style","Define tab style");
        $panel15->addChild("group3",$group3);

                $row1 = new EdgeRow(true);
                $group3->addChild("row1",$row1);
				
						$tabs_icon_width = new EdgeField("textsimple","tabs_icon_width","","Width (px)","This is some description");
                        $row1->addChild("tabs_icon_width",$tabs_icon_width);

                        $tabs_icon_height = new EdgeField("textsimple","tabs_icon_height","","Height (px)","This is some description");
                        $row1->addChild("tabs_icon_height",$tabs_icon_height);

                        $tabs_icon_shape_border_width = new EdgeField("textsimple","tabs_icon_shape_border_width","","Spike Length (px)","This is some description");
                        $row1->addChild("tabs_icon_shape_border_width",$tabs_icon_shape_border_width);
		
		$tabs_default_subtitle = new EdgeTitle("tabs_default_subtitle", "Default Tabs Style");
		$panel15->addChild("tabs_default_subtitle", $tabs_default_subtitle);	
		
		$tabs_default_show_separator = new EdgeField("yesno","tabs_default_show_separator","no","Show Right Separator","Enabling this option will show right separator", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_default_tabs_right_separator_container"));
		$panel15->addChild("tabs_default_show_separator",$tabs_default_show_separator);

		$default_tabs_right_separator_container = new EdgeContainer("default_tabs_right_separator_container","tabs_default_show_separator","no");
		$panel15->addChild("default_tabs_right_separator_container",$default_tabs_right_separator_container);

		$tabs_default_right_separator_color = new EdgeField("color","tabs_default_right_separator_color","","Separator Color","Choose right separator color");
		$default_tabs_right_separator_container->addChild("tabs_default_right_separator_color",$tabs_default_right_separator_color);
						
        $group_default_tabs = new EdgeGroup("Tabs Navigation Style","Define tab navigation style");
        $panel15->addChild("group_default_tabs",$group_default_tabs);

                $row1 = new EdgeRow(true);
                $group_default_tabs->addChild("row1",$row1);						
						
						$tabs_default_padding_left = new EdgeField("textsimple","tabs_default_padding_left","","Padding Left (px)","This is some description");
                        $row1->addChild("tabs_default_padding_left",$tabs_default_padding_left);
						
						$tabs_default_padding_right = new EdgeField("textsimple","tabs_default_padding_right","","Padding Right (px)","This is some description");
                        $row1->addChild("tabs_default_padding_right",$tabs_default_padding_right);
				
				$row2 = new EdgeRow(true);
                $group_default_tabs->addChild("row2",$row2);		
						
						$tabs_default_text_color = new EdgeField("colorsimple","tabs_default_text_color","","Text Color","This is some description");
						$row2->addChild("tabs_default_text_color",$tabs_default_text_color);

						$tabs_default_active_text_color = new EdgeField("colorsimple","tabs_default_active_text_color","","Text Active/Hover Color","This is some description");
						$row2->addChild("tabs_default_active_text_color",$tabs_default_active_text_color);
						
		$tabs_navigation_boxed_subtitle = new EdgeTitle("tabs_navigation_boxed_subtitle", "Tabs Navigation (With Borders)");
		$panel15->addChild("tabs_navigation_boxed_subtitle", $tabs_navigation_boxed_subtitle);	
						
        $group4 = new EdgeGroup("Tabs Navigation Size","Define tab size style");
        $panel15->addChild("group4",$group4);

                $row1 = new EdgeRow(true);
                $group4->addChild("row1",$row1);

                        $tabs_with_borders_height = new EdgeField("textsimple","tabs_with_borders_height","","Height (px)","This is some description");
                        $row1->addChild("tabs_with_borders_height",$tabs_with_borders_height);
						
						$tabs_with_borders_padding_left = new EdgeField("textsimple","tabs_with_borders_padding_left","","Padding Left (px)","This is some description");
                        $row1->addChild("tabs_with_borders_padding_left",$tabs_with_borders_padding_left);
						
						$tabs_with_borders_padding_right = new EdgeField("textsimple","tabs_with_borders_padding_right","","Padding Right (px)","This is some description");
                        $row1->addChild("tabs_with_borders_padding_right",$tabs_with_borders_padding_right);
						
		$horizontal_tabs_border_arround_element_no_space = new EdgeTitle("horizontal_tabs_border_arround_element_no_space", "Horizontal Tabs - Border Around Tabs (Without Space)");
        $panel15->addChild("horizontal_tabs_border_arround_element_no_space", $horizontal_tabs_border_arround_element_no_space);		
						
		$group5 = new EdgeGroup("Tab Styles","Define tab style");
        $panel15->addChild("group5",$group5);

                $row1 = new EdgeRow(true);
                $group5->addChild("row1",$row1);	
				
						$tab_bae_hor_no_marg_background_color = new EdgeField("colorsimple","tab_bae_hor_no_marg_background_color","","Background Color","This is some description");
                        $row1->addChild("tab_bae_hor_no_marg_background_color",$tab_bae_hor_no_marg_background_color);

						$tab_bae_hor_no_marg_background_color_hover = new EdgeField("colorsimple","tab_bae_hor_no_marg_background_color_hover","","Background Hover/Active Color","This is some description");
                        $row1->addChild("tab_bae_hor_no_marg_background_color_hover",$tab_bae_hor_no_marg_background_color_hover);
						
	                    $tab_bae_hor_no_marg_border_color = new EdgeField("colorsimple","tab_bae_hor_no_marg_border_color","","Border Color","This is some description");
                        $row1->addChild("tab_bae_hor_no_marg_border_color",$tab_bae_hor_no_marg_border_color);
						
						$tab_bae_hor_no_marg_border_hover_color = new EdgeField("colorsimple","tab_bae_hor_no_marg_border_hover_color","","Border Hover/Active Color","This is some description");
                        $row1->addChild("tab_bae_hor_no_marg_border_hover_color",$tab_bae_hor_no_marg_border_hover_color);
		$group6 = new EdgeGroup("Text Styles","Define text styles");
        $panel15->addChild("group6",$group6);

                $row1 = new EdgeRow(true);
                $group6->addChild("row1",$row1);	
				
					$tab_bae_hor_no_marg_text_color = new EdgeField("colorsimple","tab_bae_hor_no_marg_text_color","","Text Color","This is some description");
					$row1->addChild("tab_bae_hor_no_marg_text_color",$tab_bae_hor_no_marg_text_color);

					$tab_bae_hor_no_marg_active_text_color = new EdgeField("colorsimple","tab_bae_hor_no_marg_active_text_color","","Text Active/Hover Color","This is some description");
					$row1->addChild("tab_bae_hor_no_marg_active_text_color",$tab_bae_hor_no_marg_active_text_color);
		
		
		$hor_tabs_border_arround_element_with_space = new EdgeTitle("hor_tabs_border_arround_element_with_space", "Horizontal Tabs -  Border Around Tabs (With Space)");
        $panel15->addChild("hor_tabs_border_arround_element_with_space", $hor_tabs_border_arround_element_with_space);			
					
		$group7 = new EdgeGroup("Tab Styles","Define tab style");
        $panel15->addChild("group7",$group7);

                $row1 = new EdgeRow(true);
                $group7->addChild("row1",$row1);	
				
						$tab_bae_hor_marg_background_color = new EdgeField("colorsimple","tab_bae_hor_marg_background_color","","Background Color","This is some description");
                        $row1->addChild("tab_bae_hor_marg_background_color",$tab_bae_hor_marg_background_color);
						
						$tab_bae_hor_marg_background_hover_color = new EdgeField("colorsimple","tab_bae_hor_marg_background_hover_color","","Background Hover/Active Color","This is some description");
                        $row1->addChild("tab_bae_hor_marg_background_hover_color",$tab_bae_hor_marg_background_hover_color);

	                    $tab_bae_hor_marg_border_color = new EdgeField("colorsimple","tab_bae_hor_marg_border_color","","Border Color","This is some description");
                        $row1->addChild("tab_bae_hor_marg_border_color",$tab_bae_hor_marg_border_color);
						
						$tab_bae_hor_marg_border_hover_color = new EdgeField("colorsimple","tab_bae_hor_marg_border_hover_color","","Border Hover/Active Color","This is some description");
                        $row1->addChild("tab_bae_hor_marg_border_hover_color",$tab_bae_hor_marg_border_hover_color);
		
		$group8 = new EdgeGroup("Text Styles","Define text styles");
        $panel15->addChild("group8",$group8);

                $row1 = new EdgeRow(true);
                $group8->addChild("row1",$row1);	
				
					$tab_bae_hor_marg_text_color = new EdgeField("colorsimple","tab_bae_hor_marg_text_color","","Text Color","This is some description");
					$row1->addChild("tab_bae_hor_marg_text_color",$tab_bae_hor_marg_text_color);

					$tab_bae_hor_marg_active_text_color = new EdgeField("colorsimple","tab_bae_hor_marg_active_text_color","","Text Active/Hover Color","This is some description");
					$row1->addChild("tab_bae_hor_marg_active_text_color",$tab_bae_hor_marg_active_text_color);
					
		$horizontal_tabs_border_arround_active_tab = new EdgeTitle("horizontal_tabs_border_arround_active_tab", "Horizontal Tabs -  Border Around Active Tab");
        $panel15->addChild("horizontal_tabs_border_arround_active_tab", $horizontal_tabs_border_arround_active_tab);			
		
		$group9 = new EdgeGroup("Tab Styles","Define tab style");
        $panel15->addChild("group9",$group9);

                $row1 = new EdgeRow(true);
                $group9->addChild("row1",$row1);	
				
						$tab_bord_active_background_color = new EdgeField("colorsimple","tab_bord_active_background_color","","Background Active Color","This is some description");
                        $row1->addChild("tab_bord_active_background_color",$tab_bord_active_background_color);									

                        $tab_bord_active_background_color_hover = new EdgeField("colorsimple","tab_bord_active_background_color_hover","","Background Hover Color","This is some description");
                        $row1->addChild("tab_bord_active_background_color_hover",$tab_bord_active_background_color_hover);
						
	                    $tab_bord_active_border_hover_color = new EdgeField("colorsimple","tab_bord_active_border_hover_color","","Border Hover Color","This is some description");
                        $row1->addChild("tab_bord_active_border_hover_color",$tab_bord_active_border_hover_color);
									
						$tab_bord_active_active_tab_border_hover_color = new EdgeField("colorsimple","tab_bord_active_active_tab_border_hover_color","","Border Active Color","This is some description");
                        $row1->addChild("tab_bord_active_active_tab_border_hover_color",$tab_bord_active_active_tab_border_hover_color);
						
		
		$group10 = new EdgeGroup("Text Styles","Define text style");
        $panel15->addChild("group10",$group10);

                $row1 = new EdgeRow(true);
                $group10->addChild("row1",$row1);	
				
						$tab_bord_active_text_color = new EdgeField("colorsimple","tab_bord_active_text_color","","Text Color","This is some description");
						$row1->addChild("tab_bord_active_text_color",$tab_bord_active_text_color);

						$tab_bord_active_active_text_color = new EdgeField("colorsimple","tab_bord_active_active_text_color","","Text Active/Hover Color","This is some description");
						$row1->addChild("tab_bord_active_active_text_color",$tab_bord_active_active_text_color);
		
		$vertical_tabs_border_arround_element = new EdgeTitle("vertical_tabs_border_arround_element", "Vertical Tabs -  Border Around Tabs(Without Space)");
        $panel15->addChild("vertical_tabs_border_arround_element", $vertical_tabs_border_arround_element);		
						
		$group11 = new EdgeGroup("Tab Styles","Define tab style");
        $panel15->addChild("group11",$group11);

                $row1 = new EdgeRow(true);
                $group11->addChild("row1",$row1);	
				
						$ver_tab_bae_background_color = new EdgeField("colorsimple","ver_tab_bae_background_color","","Background Color","This is some description");
                        $row1->addChild("ver_tab_bae_background_color",$ver_tab_bae_background_color);
						
						$ver_tab_bae_background_color_hover = new EdgeField("colorsimple","ver_tab_bae_background_color_hover","","Background Active/HoverColor","This is some description");
                        $row1->addChild("ver_tab_bae_background_color_hover",$ver_tab_bae_background_color_hover);
						
	                    $ver_tab_bae_border_color = new EdgeField("colorsimple","ver_tab_bae_border_color","","Border Color","This is some description");
                        $row1->addChild("ver_tab_bae_border_color",$ver_tab_bae_border_color);
						
						$ver_tab_bae_border_color_hover = new EdgeField("colorsimple","ver_tab_bae_border_color_hover","","Border Hover Color","This is some description");
                        $row1->addChild("ver_tab_bae_border_color_hover",$ver_tab_bae_border_color_hover);
						
		$group12 = new EdgeGroup("Text Styles","Define text style");
        $panel15->addChild("group12",$group12);

                $row1 = new EdgeRow(true);
                $group12->addChild("row1",$row1);	
				
					$ver_tab_bae_text_color = new EdgeField("colorsimple","ver_tab_bae_text_color","","Text Color","This is some description");
					$row1->addChild("ver_tab_bae_text_color",$ver_tab_bae_text_color);

					$ver_tab_bae_active_text_color = new EdgeField("colorsimple","ver_tab_bae_active_text_color","","Text Active/Hover Color","This is some description");
					$row1->addChild("ver_tab_bae_active_text_color",$ver_tab_bae_active_text_color);
		
		$ver_tab_bae_with_space = new EdgeTitle("ver_tab_bae_with_space", "Vertical Tabs -  Border Around Tabs(With Space)");
        $panel15->addChild("ver_tab_bae_with_space", $ver_tab_bae_with_space);		
						
		$group_vert_tabs_with_space = new EdgeGroup("Tab Styles","Define tab style");
        $panel15->addChild("group_vert_tabs_with_space",$group_vert_tabs_with_space);

                $row1 = new EdgeRow(true);
                $group_vert_tabs_with_space->addChild("row1",$row1);	
				
						$ver_tab_bae_with_space_background_color = new EdgeField("colorsimple","ver_tab_bae_with_space_background_color","","Background Color","This is some description");
                        $row1->addChild("ver_tab_bae_with_space_background_color",$ver_tab_bae_with_space_background_color);
						
						$ver_tab_bae_with_space_background_color_hover = new EdgeField("colorsimple","ver_tab_bae_with_space_background_color_hover","","Background Active/HoverColor","This is some description");
                        $row1->addChild("ver_tab_bae_with_space_background_color_hover",$ver_tab_bae_with_space_background_color_hover);
						
	                    $ver_tab_bae_with_space_border_color = new EdgeField("colorsimple","ver_tab_bae_with_space_border_color","","Border Color","This is some description");
                        $row1->addChild("ver_tab_bae_with_space_border_color",$ver_tab_bae_with_space_border_color);
						
						$ver_tab_bae_with_space_border_color_hover = new EdgeField("colorsimple","ver_tab_bae_with_space_border_color_hover","","Border Hover Color","This is some description");
                        $row1->addChild("ver_tab_bae_with_space_border_color_hover",$ver_tab_bae_with_space_border_color_hover);
						
		$group_vert_tabs_with_space_text = new EdgeGroup("Text Styles","Define text style");
        $panel15->addChild("group_vert_tabs_with_space_text",$group_vert_tabs_with_space_text);

                $row1 = new EdgeRow(true);
                $group_vert_tabs_with_space_text->addChild("row1",$row1);	
				
					$ver_tab_bae_with_space_text_color = new EdgeField("colorsimple","ver_tab_bae_with_space_text_color","","Text Color","This is some description");
					$row1->addChild("ver_tab_bae_with_space_text_color",$ver_tab_bae_with_space_text_color);

					$ver_tab_bae_with_space_active_text_color = new EdgeField("colorsimple","ver_tab_bae_with_space_active_text_color","","Text Active/Hover Color","This is some description");
					$row1->addChild("ver_tab_bae_with_space_active_text_color",$ver_tab_bae_with_space_active_text_color);
					
					
		$vertical_tabs_border_arround_active_tab = new EdgeTitle("vertical_tabs_border_arround_active_tab", "Vertical Tabs -  Border Around Active Tab");
        $panel15->addChild("vertical_tabs_border_arround_active_tab", $vertical_tabs_border_arround_active_tab);				
						
		$group13 = new EdgeGroup("Tab Styles","Define tab style");
        $panel15->addChild("group13",$group13);

                $row1 = new EdgeRow(true);
                $group13->addChild("row1",$row1);	
				
						$ver_tab_bord_act_background_color = new EdgeField("colorsimple","ver_tab_bord_act_background_color","","Background Active Color","This is some description");
                        $row1->addChild("ver_tab_bord_act_background_color",$ver_tab_bord_act_background_color);
						
						$ver_tab_bord_act_background_color_hover = new EdgeField("colorsimple","ver_tab_bord_act_background_color_hover","","Background HoverColor","This is some description");
                        $row1->addChild("ver_tab_bord_act_background_color_hover",$ver_tab_bord_act_background_color_hover);
						
	                    $ver_tab_bord_act_border_color = new EdgeField("colorsimple","ver_tab_bord_act_border_color","","Border Active Color","This is some description");
                        $row1->addChild("ver_tab_bord_act_border_color",$ver_tab_bord_act_border_color);
												
						$ver_tab_bord_act_border_color_hover = new EdgeField("colorsimple","ver_tab_bord_act_border_color_hover","","Border Hover Color","This is some description");
                        $row1->addChild("ver_tab_bord_act_border_color_hover",$ver_tab_bord_act_border_color_hover);
						
		$group14 = new EdgeGroup("Text Styles","Define text style");
		$panel15->addChild("group14",$group14);	
		
			$row1 = new EdgeRow(true);
            $group14->addChild("row1",$row1);
		
					$ver_tab_bord_act_text_color = new EdgeField("colorsimple","ver_tab_bord_act_text_color","","Text Color","This is some description");
					$row1->addChild("ver_tab_bord_act_text_color",$ver_tab_bord_act_text_color);

					$ver_tab_bord_act_active_text_color = new EdgeField("colorsimple","ver_tab_bord_act_active_text_color","","Text Active/Hover Color","This is some description");
					$row1->addChild("ver_tab_bord_act_active_text_color",$ver_tab_bord_act_active_text_color);	
					
		$tabs_content_horizontal_subtitle = new EdgeTitle("tabs_content_horizontal_subtitle", "Horizontal Tabs Content");
        $panel15->addChild("tabs_content_horizontal_subtitle", $tabs_content_horizontal_subtitle);
		
		$group15 = new EdgeGroup("Tabs Content Styles","Define tab content style");
        $panel15->addChild("group15",$group15);
		
				$row1 = new EdgeRow(true);
                $group15->addChild("row1",$row1);

					$tabs_content_text_size = new EdgeField("textsimple","tabs_content_text_size","","Tabs Content Text Size (px)","Enter size for text in tab containers", array(), array("col_width" => 3));
					$row1->addChild("tabs_content_text_size",$tabs_content_text_size);

					$tabs_content_background_color = new EdgeField("colorsimple","tabs_content_background_color","","Tab Content Background","Choose color for tab background");
					$row1->addChild("tabs_content_background_color",$tabs_content_background_color);
					
		$group16 = new EdgeGroup("Content Padding","Define tab content padding");
        $panel15->addChild("group16",$group16);
		
			$row1 = new EdgeRow(true);
            $group16->addChild("row1",$row1);

					$tabs_content_padding_left = new EdgeField("textsimple","tabs_content_padding_left","","Padding Left (px)","This is some description");
					$row1->addChild("tabs_content_padding_left",$tabs_content_padding_left);

					$tabs_content_padding_right = new EdgeField("textsimple","tabs_content_padding_right","","Padding Right (px)","This is some description");
					$row1->addChild("tabs_content_padding_right",$tabs_content_padding_right);					
								
					$tabs_content_padding_top = new EdgeField("textsimple","tabs_content_padding_top","","Padding Top (px)","This is some description");
					$row1->addChild("tabs_content_padding_top",$tabs_content_padding_top);
					
					$tabs_content_padding_bottom = new EdgeField("textsimple","tabs_content_padding_bottom","","Padding Bottom (px)","This is some description");
					$row1->addChild("tabs_content_padding_bottom",$tabs_content_padding_bottom);
		
		$tabs_vertical_content_subtitle = new EdgeTitle("tabs_vertical_content_subtitle", "Vertical Tabs Content");
        $panel15->addChild("tabs_vertical_content_subtitle", $tabs_vertical_content_subtitle);
					
		$group17 = new EdgeGroup("Tabs Content Styles","Define tab content style");
        $panel15->addChild("group17",$group17);
		
				$row1 = new EdgeRow(true);
                $group17->addChild("row1",$row1);

					$tabs_vertical_content_text_size = new EdgeField("textsimple","tabs_vertical_content_text_size","","Tabs Content Text Size (px)","Enter size for text in tab containers", array(), array("col_width" => 3));
					$row1->addChild("tabs_vertical_content_text_size",$tabs_vertical_content_text_size);

					$tabs_vertical_content_background_color = new EdgeField("colorsimple","tabs_vertical_content_background_color","","Tab Content Background","Choose color for tab background");
					$row1->addChild("tabs_vertical_content_background_color",$tabs_vertical_content_background_color);			
					
		$group18 = new EdgeGroup("Content Padding","Define tab content padding");
        $panel15->addChild("group18",$group18);
		
			$row1 = new EdgeRow(true);
            $group18->addChild("row1",$row1);

					$tabs_vertical_content_padding_left = new EdgeField("textsimple","tabs_vertical_content_padding_left","","Padding Left (px)","This is some description");
					$row1->addChild("tabs_vertical_content_padding_left",$tabs_vertical_content_padding_left);

					$tabs_vertical_content_padding_right = new EdgeField("textsimple","tabs_vertical_content_padding_right","","Padding Right (px)","This is some description");
					$row1->addChild("tabs_vertical_content_padding_right",$tabs_vertical_content_padding_right);					
								
					$tabs_vertical_content_padding_top = new EdgeField("textsimple","tabs_vertical_content_padding_top","","Padding Top (px)","This is some description");
					$row1->addChild("tabs_vertical_content_padding_top",$tabs_vertical_content_padding_top);
					
					$tabs_vertical_content_padding_bottom = new EdgeField("textsimple","tabs_vertical_content_padding_bottom","","Padding Bottom (px)","This is some description");
					$row1->addChild("tabs_vertical_content_padding_bottom",$tabs_vertical_content_padding_bottom);

        
//Tags

$panel18 = new EdgePanel("Tags", "tags_panel");
$elementsPage->addChild("panel18",$panel18);

        $group1 = new EdgeGroup("Tags Style","Define Tags style");
        $panel18->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $tags_color = new EdgeField("colorsimple","tags_color","","Text Color","This is some description");
                        $row1->addChild("tags_color",$tags_color);

                        $tags_font_size = new EdgeField("textsimple","tags_font_size","","Font Size (px)","This is some description");
                        $row1->addChild("tags_font_size",$tags_font_size);

                        $tags_line_height = new EdgeField("textsimple","tags_line_height","","Line Height (px)","This is some description");
                        $row1->addChild("tags_line_height",$tags_line_height);

                        $tags_text_transform = new EdgeField("selectblanksimple","tags_text_transform","","Text Transform","This is some description",$options_texttransform);
                        $row1->addChild("tags_text_transform",$tags_text_transform);

                $row2 = new EdgeRow(true);
                $group1->addChild("row2",$row2);

                        $tags_font_family = new EdgeField("Fontsimple","tags_font_family","-1","Font Family","This is some description");
                        $row2->addChild("tags_font_family",$tags_font_family);

                        $tags_font_style = new EdgeField("selectblanksimple","tags_font_style","","Font Style","This is some description",$options_fontstyle);
                        $row2->addChild("tags_font_style",$tags_font_style);

                        $tags_font_weight = new EdgeField("selectblanksimple","tags_font_weight","","Font Weight","This is some description",$options_fontweight);
                        $row2->addChild("tags_font_weight",$tags_font_weight);

                        $tags_letter_spacing = new EdgeField("textsimple","tags_letter_spacing","","Letter Spacing (px)","This is some description");
                        $row2->addChild("tags_letter_spacing",$tags_letter_spacing);

                $row3 = new EdgeRow(true);
                $group1->addChild("row3",$row3);

                        $tags_hover_color = new EdgeField("colorsimple","tags_hover_color","","Hover Text Color","This is some description");
                        $row3->addChild("tags_hover_color",$tags_hover_color);

                        $tags_background_color = new EdgeField("colorsimple","tags_background_color","","Background color","This is some description");
                        $row3->addChild("tags_background_color",$tags_background_color);

                        $tags_background_hover_color = new EdgeField("colorsimple","tags_background_hover_color","","Hover background color","This is some description");
                        $row3->addChild("tags_background_hover_color",$tags_background_hover_color);

                        $tags_border_radius = new EdgeField("textsimple","tags_border_radius","","Border Radius (px)","This is some description");
                        $row3->addChild("tags_border_radius",$tags_border_radius);

                $row4 = new EdgeRow(true);
                $group1->addChild("row4",$row4);

                        $tags_border_color = new EdgeField("colorsimple","tags_border_color","","Border Color","This is some description");
                        $row4->addChild("tags_border_color",$tags_border_color);

                        $tags_border_hover_color = new EdgeField("colorsimple","tags_border_hover_color","","Border Hover Color","This is some description");
                        $row4->addChild("tags_border_hover_color",$tags_border_hover_color);

                        $tags_border_width = new EdgeField("textsimple","tags_border_width","","Border Width (px)","This is some description");
                        $row4->addChild("tags_border_width",$tags_border_width);


//Team

$panel20 = new EdgePanel("Team", "team_panel");
$elementsPage->addChild("panel20",$panel20);

        $group1 = new EdgeGroup("Team Image Hover Color Overlay","Choose team image hover color overlay");
        $panel20->addChild("group1",$group1);
                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);
                            $team_hover_color = new EdgeField("colorsimple","team_hover_color","","","This is some description");
                            $row1->addChild("team_hover_color",$team_hover_color);


        $group2 = new EdgeGroup("Team Member Name","Define styles for team member name");
        $panel20->addChild("group2",$group2);
                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $team_color = new EdgeField("colorsimple","team_color","","Text Color","This is some description");
                        $row1->addChild("team_color",$team_color);

                        $team_font_size = new EdgeField("textsimple","team_font_size","","Font Size (px)","This is some description");
                        $row1->addChild("team_font_size",$team_font_size);

                        $team_line_height = new EdgeField("textsimple","team_line_height","","Line Height (px)","This is some description");
                        $row1->addChild("team_line_height",$team_line_height);

                        $team_text_transform = new EdgeField("selectblanksimple","team_text_transform","","Text Transform","This is some description",$options_texttransform);
                        $row1->addChild("team_text_transform",$team_text_transform);

                $row2 = new EdgeRow(true);
                $group2->addChild("row2",$row2);

                        $team_font_family = new EdgeField("Fontsimple","team_font_family","-1","Font Family","This is some description");
                        $row2->addChild("team_font_family",$team_font_family);

                        $team_font_style = new EdgeField("selectblanksimple","team_font_style","","Font Style","This is some description",$options_fontstyle);
                        $row2->addChild("team_font_style",$team_font_style);

                        $team_font_weight = new EdgeField("selectblanksimple","team_font_weight","","Font Weight","This is some description",$options_fontweight);
                        $row2->addChild("team_font_weight",$team_font_weight);

                        $team_letter_spacing = new EdgeField("textsimple","team_letter_spacing","","Letter Spacing (px)","This is some description");
                        $row2->addChild("team_letter_spacing",$team_letter_spacing);

        $group3 = new EdgeGroup("Social Icons","Define Social Icons style");
        $panel20->addChild("group3",$group3);
                $row1 = new EdgeRow();
                $group3->addChild("row1",$row1);

                        $team_icon_color = new EdgeField("colorsimple","team_icon_color","","Icon Color","This is some description");
                        $row1->addChild("team_icon_color",$team_icon_color);

                        $team_icon_hover_color = new EdgeField("colorsimple","team_icon_hover_color","","Icon Hover Color","This is some description");
                        $row1->addChild("team_icon_hover_color",$team_icon_hover_color);

                        $team_icon_background_color = new EdgeField("colorsimple","team_icon_background_color","","Icon Background Color","This is some description");
                        $row1->addChild("team_icon_background_color",$team_icon_background_color);

                        $team_icon_hover_background_color = new EdgeField("colorsimple","team_icon_hover_background_color","","Icon Hover Background Color","This is some description");
                        $row1->addChild("team_icon_hover_background_color",$team_icon_hover_background_color);

                $row2 = new EdgeRow(true);
                $group3->addChild("row2",$row2);

                        $team_icon_border_color = new EdgeField("colorsimple","team_icon_border_color","","Icon Border Color","This is some description");
                        $row2->addChild("team_icon_border_color",$team_icon_border_color);

                        $team_icon_hover_border_color = new EdgeField("colorsimple","team_icon_hover_border_color","","Icon Hover Border Color","This is some description");
                        $row2->addChild("team_icon_hover_border_color",$team_icon_hover_border_color);

                        $team_icon_size = new EdgeField("textsimple","team_icon_size","","Icon Size (px)","This is some description");
                        $row2->addChild("team_icon_size",$team_icon_size);

                        $team_icon_shape_size = new EdgeField("textsimple","team_icon_shape_size","","Shape Size (px)","This is some description");
                        $row2->addChild("team_icon_shape_size",$team_icon_shape_size);

                $row3 = new EdgeRow(true);
                $group3->addChild("row3",$row3);

                        $team_icon_space = new EdgeField("textsimple","team_icon_space","","Space between Icons (px)","This is some description");
                        $row3->addChild("team_icon_space",$team_icon_space);

$main_info_below_image_subtitle = new EdgeTitle("main_info_below_image_subtitle", "Main Info Below Image - Type");
$panel20->addChild("main_info_below_image_subtitle", $main_info_below_image_subtitle);

		$group4 = new EdgeGroup("Share Icon","Define Share Icon style. This applies only if Between Image and Info is selected for Social Style");
		$panel20->addChild("group4",$group4);
				$row1 = new EdgeRow();
				$group4->addChild("row1",$row1);

						$team_share_icon_color = new EdgeField("colorsimple","team_share_icon_color","","Icon Color","This is some description");
						$row1->addChild("team_share_icon_color",$team_share_icon_color);

						$team_share_icon_hover_color = new EdgeField("colorsimple","team_share_icon_hover_color","","Icon Hover Color","This is some description");
						$row1->addChild("team_share_icon_hover_color",$team_share_icon_hover_color);

						$team_share_icon_background_color = new EdgeField("colorsimple","team_share_icon_background_color","","Icon Background Color","This is some description");
						$row1->addChild("team_share_icon_background_color",$team_share_icon_background_color);

						$team_share_icon_hover_background_color = new EdgeField("colorsimple","team_share_icon_hover_background_color","","Icon Hover Background Color","This is some description");
						$row1->addChild("team_share_icon_hover_background_color",$team_share_icon_hover_background_color);

				$row2 = new EdgeRow(true);
				$group4->addChild("row2",$row2);

						$team_share_icon_border_color = new EdgeField("colorsimple","team_share_icon_border_color","","Icon Border Color","This is some description");
						$row2->addChild("team_share_icon_border_color",$team_share_icon_border_color);

						$team_share_icon_hover_border_color = new EdgeField("colorsimple","team_share_icon_hover_border_color","","Icon Hover Border Color","This is some description");
						$row2->addChild("team_share_icon_hover_border_color",$team_share_icon_hover_border_color);

						$team_share_icon_size = new EdgeField("textsimple","team_share_icon_size","","Icon Size (px)","This is some description");
						$row2->addChild("team_share_icon_size",$team_share_icon_size);

						$team_share_icon_shape_size = new EdgeField("textsimple","team_share_icon_shape_size","","Shape Size (px)","This is some description");
						$row2->addChild("team_share_icon_shape_size",$team_share_icon_shape_size);


//Testimonials

$panel16 = new EdgePanel("Testimonials","testimonials_panel");
$elementsPage->addChild("panel16",$panel16);

$group4 = new EdgeGroup("Testimonials Title","Define Testimonials title style");
$panel16->addChild("group4",$group4);
    $row1 = new EdgeRow();
    $group4->addChild("row1",$row1);

        $testimonials_title_color = new EdgeField("colorsimple","testimonials_title_color","","Text Color","This is some description");
        $row1->addChild("testimonials_title_color",$testimonials_title_color);

        $testimonials_title_font_size = new EdgeField("textsimple","testimonials_title_font_size","","Font Size (px)","This is some description");
        $row1->addChild("testimonials_title_font_size",$testimonials_title_font_size);

        $testimonials_title_line_height = new EdgeField("textsimple","testimonials_title_line_height","","Line Height (px)","This is some description");
        $row1->addChild("testimonials_title_line_height",$testimonials_title_line_height);

        $testimonials_title_text_transform = new EdgeField("selectblanksimple","testimonials_title_text_transform","","Text Transform","This is some description",$options_texttransform);
        $row1->addChild("testimonials_title_text_transform",$testimonials_title_text_transform);

    $row2 = new EdgeRow(true);
    $group4->addChild("row2",$row2);

        $testimonials_title_font_family = new EdgeField("Fontsimple","testimonials_title_font_family","-1","Font Family","This is some description");
        $row2->addChild("testimonials_title_font_family",$testimonials_title_font_family);

        $testimonials_title_font_style = new EdgeField("selectblanksimple","testimonials_title_font_style","","Font Style","This is some description",$options_fontstyle);
        $row2->addChild("testimonials_title_font_style",$testimonials_title_font_style);

        $testimonials_title_font_weight = new EdgeField("selectblanksimple","testimonials_title_font_weight","","Font Weight","This is some description",$options_fontweight);
        $row2->addChild("testimonials_title_font_weight",$testimonials_title_font_weight);

        $testimonials_title_letter_spacing = new EdgeField("textsimple","testimonials_title_letter_spacing","","Letter Spacing (px)","This is some description");
        $row2->addChild("testimonials_title_letter_spacing",$testimonials_title_letter_spacing);

$group1 = new EdgeGroup("Testimonials Text","Define Testimonials text style");
$panel16->addChild("group1",$group1);
    $row1 = new EdgeRow();
    $group1->addChild("row1",$row1);

        $testimonials_text_color = new EdgeField("colorsimple","testimonials_text_color","","Text Color","This is some description");
        $row1->addChild("testimonials_text_color",$testimonials_text_color);

        $testimonials_text_font_size = new EdgeField("textsimple","testimonials_text_font_size","","Font Size (px)","This is some description");
        $row1->addChild("testimonials_text_font_size",$testimonials_text_font_size);

        $testimonials_text_line_height = new EdgeField("textsimple","testimonials_text_line_height","","Line Height (px)","This is some description");
        $row1->addChild("testimonials_text_line_height",$testimonials_text_line_height);

        $testimonials_text_text_transform = new EdgeField("selectblanksimple","testimonials_text_text_transform","","Text Transform","This is some description",$options_texttransform);
        $row1->addChild("testimonials_text_text_transform",$testimonials_text_text_transform);

    $row2 = new EdgeRow(true);
    $group1->addChild("row2",$row2);

        $testimonials_text_font_family = new EdgeField("Fontsimple","testimonials_text_font_family","-1","Font Family","This is some description");
        $row2->addChild("testimonials_text_font_family",$testimonials_text_font_family);

        $testimonials_text_font_style = new EdgeField("selectblanksimple","testimonials_text_font_style","","Font Style","This is some description",$options_fontstyle);
        $row2->addChild("testimonials_text_font_style",$testimonials_text_font_style);

        $testimonials_text_font_weight = new EdgeField("selectblanksimple","testimonials_text_font_weight","","Font Weight","This is some description",$options_fontweight);
        $row2->addChild("testimonials_text_font_weight",$testimonials_text_font_weight);

        $testimonials_text_letter_spacing = new EdgeField("textsimple","testimonials_text_letter_spacing","","Letter Spacing (px)","This is some description");
        $row2->addChild("testimonials_text_letter_spacing",$testimonials_text_letter_spacing);

$group2 = new EdgeGroup("Testimonials Author Style","Define Testimonials author style");
$panel16->addChild("group2",$group2);
    $row1 = new EdgeRow();
    $group2->addChild("row1",$row1);

        $testimonials_author_color = new EdgeField("colorsimple","testimonials_author_color","","Text Color","This is some description");
        $row1->addChild("testimonials_author_color",$testimonials_author_color);

        $testimonials_author_font_size = new EdgeField("textsimple","testimonials_author_font_size","","Font Size (px)","This is some description");
        $row1->addChild("testimonials_author_font_size",$testimonials_author_font_size);

        $testimonials_author_line_height = new EdgeField("textsimple","testimonials_author_line_height","","Line Height (px)","This is some description");
        $row1->addChild("testimonials_author_line_height",$testimonials_author_line_height);

        $testimonials_author_text_transform = new EdgeField("selectblanksimple","testimonials_author_text_transform","","Text Transform","This is some description",$options_texttransform);
        $row1->addChild("testimonials_author_text_transform",$testimonials_author_text_transform);

    $row2 = new EdgeRow(true);
    $group2->addChild("row2",$row2);

        $testimonials_author_font_family = new EdgeField("Fontsimple","testimonials_author_font_family","-1","Font Family","This is some description");
        $row2->addChild("testimonials_author_font_family",$testimonials_author_font_family);

        $testimonials_author_font_style = new EdgeField("selectblanksimple","testimonials_author_font_style","","Font Style","This is some description",$options_fontstyle);
        $row2->addChild("testimonials_author_font_style",$testimonials_author_font_style);

        $testimonials_author_font_weight = new EdgeField("selectblanksimple","testimonials_author_font_weight","","Font Weight","This is some description",$options_fontweight);
        $row2->addChild("testimonials_author_font_weight",$testimonials_author_font_weight);

        $testimonials_author_letter_spacing = new EdgeField("textsimple","testimonials_author_letter_spacing","","Letter Spacing (px)","This is some description");
        $row2->addChild("testimonials_author_letter_spacing",$testimonials_author_letter_spacing);

$group6 = new EdgeGroup("Testimonials Job Position Style","Define testimonials job position author style");
$panel16->addChild("group6",$group6);
    $row1 = new EdgeRow();
    $group6->addChild("row1",$row1);
        
        $testimonials_author_job_position_color = new EdgeField("colorsimple","testimonials_author_job_position_color","","Text Color","This is some description");
        $row1->addChild("testimonials_author_job_position_color",$testimonials_author_job_position_color);
        
        $testimonials_author_job_position_font_size = new EdgeField("textsimple","testimonials_author_job_position_font_size","","Font Size (px)","This is some description");
        $row1->addChild("testimonials_author_job_position_font_size",$testimonials_author_job_position_font_size);
        
        $testimonials_author_job_position_line_height = new EdgeField("textsimple","testimonials_author_job_position_line_height","","Line Height (px)","This is some description");
        $row1->addChild("testimonials_author_job_position_line_height",$testimonials_author_job_position_line_height);
        
        $testimonials_author_job_position_text_transform = new EdgeField("selectblanksimple","testimonials_author_job_position_text_transform","","Text Transform","This is some description",$options_texttransform);
        $row1->addChild("testimonials_author_job_position_text_transform",$testimonials_author_job_position_text_transform);
        
    $row2 = new EdgeRow(true);
    $group6->addChild("row2",$row2);
    
        $testimonials_author_job_position_font_family = new EdgeField("Fontsimple","testimonials_author_job_position_font_family","-1","Font Family","This is some description");
        $row2->addChild("testimonials_author_job_position_font_family",$testimonials_author_job_position_font_family);
        
        $testimonials_author_job_position_font_style = new EdgeField("selectblanksimple","testimonials_author_job_position_font_style","","Font Style","This is some description",$options_fontstyle);
        $row2->addChild("testimonials_author_job_position_font_style",$testimonials_author_job_position_font_style);
        
        $testimonials_author_job_position_font_weight = new EdgeField("selectblanksimple","testimonials_author_job_position_font_weight","","Font Weight","This is some description",$options_fontweight);
        $row2->addChild("testimonials_author_job_position_font_weight",$testimonials_author_job_position_font_weight);
        
        $testimonials_author_job_position_letter_spacing = new EdgeField("textsimple","testimonials_author_job_position_letter_spacing","","Letter Spacing (px)","This is some description");
        $row2->addChild("testimonials_author_job_position_letter_spacing",$testimonials_author_job_position_letter_spacing);

$group3 = new EdgeGroup("Testimonials Navigation","Define Testimonials navigation style");
$panel16->addChild("group3",$group3);
    $row1 = new EdgeRow();
    $group3->addChild("row1",$row1);

            $testimonials_navigation_width = new EdgeField("textsimple","testimonials_navigation_width","","Width (px)","This is some description");
            $row1->addChild("testimonials_navigation_width",$testimonials_navigation_width);

            $testimonials_navigation_height = new EdgeField("textsimple","testimonials_navigation_height","","Height (px)","This is some description");
            $row1->addChild("testimonials_navigation_height",$testimonials_navigation_height);

            $testimonials_navigation_active_width = new EdgeField("textsimple","testimonials_navigation_active_width","","Active Width (px)","This is some description");
            $row1->addChild("testimonials_navigation_active_width",$testimonials_navigation_active_width);

            $testimonials_navigation_active_height = new EdgeField("textsimple","testimonials_navigation_active_height","","Active Height (px)","This is some description");
            $row1->addChild("testimonials_navigation_active_height",$testimonials_navigation_active_height);

    $row2 = new EdgeRow(true);
    $group3->addChild("row2",$row2);

            $testimonials_navigation_color = new EdgeField("colorsimple","testimonials_navigation_color","","Color","This is some description");
            $row2->addChild("testimonials_navigation_color",$testimonials_navigation_color);

            $testimonials_navigation_color_transparency = new EdgeField("textsimple","testimonials_navigation_color_transparency","","Color Transparency","This is some description");
            $row2->addChild("testimonials_navigation_color_transparency",$testimonials_navigation_color_transparency);

            $testimonials_navigation_active_color = new EdgeField("colorsimple","testimonials_navigation_active_color","","Active Color","This is some description");
            $row2->addChild("testimonials_navigation_active_color",$testimonials_navigation_active_color);

            $testimonials_navigation_active_color_transparency = new EdgeField("textsimple","testimonials_navigation_active_color_transparency","","Active Color Transparency","This is some description");
            $row2->addChild("testimonials_navigation_active_color_transparency",$testimonials_navigation_active_color_transparency);

    $row3 = new EdgeRow(true);
    $group3->addChild("row3",$row3);

            $testimonials_navigation_border_radius = new EdgeField("textsimple","testimonials_navigation_border_radius","","Border radius (px)","This is some description");
            $row3->addChild("testimonials_navigation_border_radius",$testimonials_navigation_border_radius);

            $testimonials_navigation_border_width= new EdgeField("textsimple","testimonials_navigation_border_width","","Border width (px)","This is some description");
            $row3->addChild("testimonials_navigation_border_width",$testimonials_navigation_border_width);

            $testimonials_navigation_border_color= new EdgeField("colorsimple","testimonials_navigation_border_color","","Border color","This is some description");
            $row3->addChild("testimonials_navigation_border_color",$testimonials_navigation_border_color);

            $testimonials_navigation_border_transparency= new EdgeField("textsimple","testimonials_navigation_border_transparency","","Border Color Transparency","This is some description");
            $row3->addChild("testimonials_navigation_border_transparency",$testimonials_navigation_border_transparency);

    $row4 = new EdgeRow();
    $group3->addChild("row4",$row4);

            $testimonials_navigation_active_border_color= new EdgeField("colorsimple","testimonials_navigation_active_border_color","","Active Border color","This is some description");
            $row4->addChild("testimonials_navigation_active_border_color",$testimonials_navigation_active_border_color);

            $testimonials_navigation_active_border_transparency= new EdgeField("textsimple","testimonials_navigation_active_border_transparency","","Active Border Color Transparency","This is some description");
            $row4->addChild("testimonials_navigation_active_border_transparency",$testimonials_navigation_active_border_transparency);
			
$group_testimonials_image = new EdgeGroup("Testimonials Image Style","Define Testimonials Image Style");
$panel16->addChild("group_testimonials_image",$group_testimonials_image);	

	$row1 = new EdgeRow(true);
	$group_testimonials_image->addChild("row1",$row1);

		$testimonials_image_border_radius = new EdgeField("textsimple","testimonials_image_border_radius","","Border Radius (px)","This is some description");
		$row1->addChild("testimonials_image_border_radius",$testimonials_image_border_radius);

$group5 = new EdgeGroup("Testimonials Arrows Style","Define Testimonials Arrows Style");
$panel16->addChild("group5",$group5);
	$row1 = new EdgeRow();
	$group5->addChild("row1",$row1);

        $testimonials_arrows_button_width = new EdgeField("textsimple","testimonials_arrows_button_width","","Width (px)","This is some description");
        $row1->addChild("testimonials_arrows_button_width",$testimonials_arrows_button_width);

        $testimonials_arrows_button_height = new EdgeField("textsimple","testimonials_arrows_button_height","","Height (px)","This is some description");
        $row1->addChild("testimonials_arrows_button_height",$testimonials_arrows_button_height);

        $testimonials_arrows_type = new EdgeField("selectblanksimple", "testimonials_arrows_type", "", "Arrow Type", "", $options_arrows_type);
        $row1->addChild("testimonials_arrows_type", $testimonials_arrows_type);

        $testimonials_arrows_color = new EdgeField("colorsimple","testimonials_arrows_color","","Background Color","This is some description");
		$row1->addChild("testimonials_arrows_color",$testimonials_arrows_color);

    $row2 = new EdgeRow(true);
    $group5->addChild("row2",$row2);

        $testimonials_arrows_color_transparency = new EdgeField("textsimple","testimonials_arrows_color_transparency","","Background Transparency (0=full - 1=opaque)","This is some description");
        $row2->addChild("testimonials_arrows_color_transparency",$testimonials_arrows_color_transparency);

		$testimonials_arrows_active_color = new EdgeField("colorsimple","testimonials_arrows_active_color","","Hover Background Color","This is some description");
		$row2->addChild("testimonials_arrows_active_color",$testimonials_arrows_active_color);

        $testimonials_arrows_active_color_transparency = new EdgeField("textsimple","testimonials_arrows_active_color_transparency","","Background Hover Transparency (0=full - 1=opaque)","This is some description");
        $row2->addChild("testimonials_arrows_active_color_transparency",$testimonials_arrows_active_color_transparency);

		$testimonials_arrows_border_radius = new EdgeField("textsimple","testimonials_arrows_border_radius","","Border Radius (px)","This is some description");
		$row2->addChild("testimonials_arrows_border_radius",$testimonials_arrows_border_radius);

	$row3 = new EdgeRow(true);
	$group5->addChild("row3",$row3);

        $testimonials_arrows_border_width= new EdgeField("textsimple","testimonials_arrows_border_width","","Border Width (px)","This is some description");
        $row3->addChild("testimonials_arrows_border_width",$testimonials_arrows_border_width);

		$testimonials_arrows_border_color= new EdgeField("colorsimple","testimonials_arrows_border_color","","Border Color","This is some description");
		$row3->addChild("testimonials_arrows_border_color",$testimonials_arrows_border_color);

        $testimonials_arrows_border_transparency = new EdgeField("textsimple","testimonials_arrows_border_transparency","","Border Transparency (0=full - 1=opaque)","This is some description");
        $row3->addChild("testimonials_arrows_border_transparency",$testimonials_arrows_border_transparency);

		$testimonials_arrows_border_hover_color= new EdgeField("colorsimple","testimonials_arrows_border_hover_color","","Border Hover Color","This is some description");
		$row3->addChild("testimonials_arrows_border_hover_color",$testimonials_arrows_border_hover_color);

    $row4 = new EdgeRow(true);
    $group5->addChild("row4",$row4);

        $testimonials_arrows_border_hover_transparency = new EdgeField("textsimple","testimonials_arrows_border_hover_transparency","","Border Hover Transparency (0=full - 1=opaque)","This is some description");
        $row4->addChild("testimonials_arrows_border_hover_transparency",$testimonials_arrows_border_hover_transparency);

		$testimonials_arrows_icon_color= new EdgeField("colorsimple","testimonials_arrows_icon_color","","Icon Color","This is some description");
		$row4->addChild("testimonials_arrows_icon_color",$testimonials_arrows_icon_color);

        $testimonials_arrows_transparency = new EdgeField("textsimple","testimonials_arrows_transparency","","Icon Transparency (0=full - 1=opaque)","This is some description");
        $row4->addChild("testimonials_arrows_transparency",$testimonials_arrows_transparency);

		$testimonials_arrows_icon_hover_color= new EdgeField("colorsimple","testimonials_arrows_icon_hover_color","","Icon Hover Color","This is some description");
		$row4->addChild("testimonials_arrows_icon_hover_color",$testimonials_arrows_icon_hover_color);

	$row5 = new EdgeRow(true);
	$group5->addChild("row5",$row5);

        $testimonials_arrows_hover_transparency = new EdgeField("textsimple","testimonials_arrows_hover_transparency","","Icon Hover Transparency (0=full - 1=opaque)","This is some description");
        $row5->addChild("testimonials_arrows_hover_transparency",$testimonials_arrows_hover_transparency);

		$testimonials_arrows_size= new EdgeField("textsimple","testimonials_arrows_size","","Icon Size (px)","This is some description");
		$row5->addChild("testimonials_arrows_size",$testimonials_arrows_size);

//Vertical Split Slider
$panel_vss = new EdgePanel("Vertical Split Slider","vertical_split_slider");
$elementsPage->addChild("panel_vss",$panel_vss);

$vss_navigation_color = new EdgeField("color","vss_navigation_color","","Navigation Color","Define color for navigation dots");
$panel_vss->addChild("vss_navigation_color",$vss_navigation_color);

$vss_navigation_size = new EdgeField("text","vss_navigation_size","","Navigation Size (px)","Define size for navigation dots", array(), array("col_width" => 1));
$panel_vss->addChild("vss_navigation_size",$vss_navigation_size);

$vss_navigation_spacing_from_edge = new EdgeField("text","vss_navigation_spacing_from_edge","","Navigation Position (px)","Define position of navigation from right/left edge of slider", array(), array("col_width" => 1));
$panel_vss->addChild("vss_navigation_spacing_from_edge",$vss_navigation_spacing_from_edge);

$vss_left_panel_size = new EdgeField("text","vss_left_panel_size","","Left Slide Panel size (%)","Define size for left slide panel. Note that sum of left and right slide panel should be 100.", array(), array("col_width" => 1));
$panel_vss->addChild("vss_left_panel_size",$vss_left_panel_size);

$vss_right_panel_size = new EdgeField("text","vss_right_panel_size","","Right Slide Panel size (%)","Define size for right slide panel. Note that sum of left and right slide panel should be 100.", array(), array("col_width" => 1));
$panel_vss->addChild("vss_right_panel_size",$vss_right_panel_size);

//Parallax
$panel_parallax = new EdgePanel("Parallax Settings","parallax_settings_panel");
$elementsPage->addChild("panel_parallax",$panel_parallax);

$parallax_onoff = new EdgeField("onoff","parallax_onoff","on","Parallax on touch devices","Enabling this option will allow parallax on touch devices");
$panel_parallax->addChild("parallax_onoff",$parallax_onoff);

$parallax_minheight = new EdgeField("text","parallax_minheight","400","Parallax Min Height (px)","Set a minimum height for parallax images on small displays (phones, tablets, etc.)",array(), array("col_width" => 3));
$panel_parallax->addChild("parallax_minheight",$parallax_minheight);


//Widgets
$panel_widgets = new EdgePanel("Widgets","widget_style");
$elementsPage->addChild("panel_widgets",$panel_widgets);

$sidebar_background_color = new EdgeField("color","sidebar_background_color","","Sidebar Background Color","Choose background color for sidebar");
$panel_widgets->addChild("sidebar_background_color",$sidebar_background_color);

$group6 = new EdgeGroup("Padding","Define padding for sidebar");
$panel_widgets->addChild("group6",$group6);
$row1 = new EdgeRow(true);
$group6->addChild("row1",$row1);
$sidebar_padding_top = new EdgeField("textsimple","sidebar_padding_top","","Top Padding (px)","This is some description");
$row1->addChild("sidebar_padding_top",$sidebar_padding_top);
$sidebar_padding_right = new EdgeField("textsimple","sidebar_padding_right","","Right Padding (px)","This is some description");
$row1->addChild("sidebar_padding_right",$sidebar_padding_right);
$sidebar_padding_bottom = new EdgeField("textsimple","sidebar_padding_bottom","","Bottom Padding (px)","This is some description");
$row1->addChild("sidebar_padding_bottom",$sidebar_padding_bottom);
$sidebar_padding_left = new EdgeField("textsimple","sidebar_padding_left","","Left Padding (px)","This is some description");
$row1->addChild("sidebar_padding_left",$sidebar_padding_left);

$sidebar_shadow_enable = new EdgeField('yesno', 'sidebar_enable_box_shadow', 'no', 'Enable Shadow For Sidebar', '', array(),
	array(
		'dependence' => true,
		'dependence_hide_on_yes' => '',
		'dependence_show_on_yes' => '#edgtf_sidebar_shadow_container'
	));
$panel_widgets->addChild('sidebar_enable_box_shadow', $sidebar_shadow_enable);

$sidebar_shadow_container = new EdgeContainer('sidebar_shadow_container', 'sidebar_enable_box_shadow', 'no');
$panel_widgets->addChild('sidebar_shadow_container', $sidebar_shadow_container);

$sidebar_shadow_horizontal_offset = new EdgeField('text', 'sidebar_shadow_horizontal_offset', '', 'Horizontal Offset(px)', 'Use positive numbers for right offset and negative numbers for left offset', array(), array("col_width" => 3));
$sidebar_shadow_container->addChild('sidebar_shadow_horizontal_offset', $sidebar_shadow_horizontal_offset);

$sidebar_shadow_vertical_offset = new EdgeField('text', 'sidebar_shadow_vertical_offset', '', 'Vertical Offset(px)', 'Use positive numbers for bottom offset and negative numbers for top offset', array(), array("col_width" => 3));
$sidebar_shadow_container->addChild('sidebar_shadow_vertical_offset', $sidebar_shadow_vertical_offset);

$sidebar_shadow_blur = new EdgeField('text', 'sidebar_shadow_blur', '', 'Blur(px)', 'Define amount of shadow blur in pixels', array(), array("col_width" => 3));
$sidebar_shadow_container->addChild('sidebar_shadow_blur', $sidebar_shadow_blur);

$sidebar_shadow_spread = new EdgeField('text', 'sidebar_shadow_spread', '', 'Spread(px)', 'Define amount of shadow spread in pixels', array(), array("col_width" => 3));
$sidebar_shadow_container->addChild('sidebar_shadow_spread', $sidebar_shadow_spread);

$sidebar_shadow_color = new EdgeField('color', 'sidebar_shadow_color', '', 'Color', 'Choose color of shadow');
$sidebar_shadow_container->addChild('sidebar_shadow_color', $sidebar_shadow_color);

$sidebar_alignment = new EdgeField("select","sidebar_alignment","","Text Alignment","Choose text aligment",array(
	"left" => "Left",
	"center" => "Center",
	"right" => "Right"
));
$panel_widgets->addChild("sidebar_alignment",$sidebar_alignment);

$widget_style = new EdgeTitle("widget_style", "Widget Style");
$panel_widgets->addChild("widget_style", $widget_style);

$widget_background_color = new EdgeField("color","widget_background_color","","Background Color","Choose color for widget background");
$panel_widgets->addChild("widget_background_color",$widget_background_color);

$widget_border_color = new EdgeField("color","widget_border_color","","Border Color","Choose a border color around widget");
$panel_widgets->addChild("widget_border_color",$widget_border_color);

$group1 = new EdgeGroup("Padding","Define padding for widget");
$panel_widgets->addChild("group1",$group1);
$row1 = new EdgeRow(true);
$group1->addChild("row1",$row1);
$widget_padding_top = new EdgeField("textsimple","widget_padding_top","","Top Padding (px)","This is some description");
$row1->addChild("widget_padding_top",$widget_padding_top);
$widget_padding_right = new EdgeField("textsimple","widget_padding_right","","Right Padding (px)","This is some description");
$row1->addChild("widget_padding_right",$widget_padding_right);
$widget_padding_bottom = new EdgeField("textsimple","widget_padding_bottom","","Bottom Padding (px)","This is some description");
$row1->addChild("widget_padding_bottom",$widget_padding_bottom);
$widget_padding_left = new EdgeField("textsimple","widget_padding_left","","Left Padding (px)","This is some description");
$row1->addChild("widget_padding_left",$widget_padding_left);

$sidebar_widget_enable_box_shadow = new EdgeField('yesno', 'sidebar_widget_enable_box_shadow', 'no', 'Enable Shadow For Widgets', '', array(),
	array(
		'dependence' => true,
		'dependence_hide_on_yes' => '',
		'dependence_show_on_yes' => '#edgtf_sidebar_widget_shadow_container'
	));
$panel_widgets->addChild('sidebar_widget_enable_box_shadow', $sidebar_widget_enable_box_shadow);

$sidebar_widget_shadow_container = new EdgeContainer('sidebar_widget_shadow_container', 'sidebar_widget_enable_box_shadow', 'no');
$panel_widgets->addChild('sidebar_widget_shadow_container', $sidebar_widget_shadow_container);

$sidebar_widget_shadow_horizontal_offset = new EdgeField('text', 'sidebar_widget_shadow_horizontal_offset', '', 'Horizontal Offset(px)', 'Use positive numbers for right offset and negative numbers for left offset', array(), array("col_width" => 3));
$sidebar_widget_shadow_container->addChild('sidebar_widget_shadow_horizontal_offset', $sidebar_widget_shadow_horizontal_offset);

$sidebar_widget_shadow_vertical_offset = new EdgeField('text', 'sidebar_widget_shadow_vertical_offset', '', 'Vertical Offset(px)', 'Use positive numbers for bottom offset and negative numbers for top offset', array(), array("col_width" => 3));
$sidebar_widget_shadow_container->addChild('sidebar_widget_shadow_vertical_offset', $sidebar_widget_shadow_vertical_offset);

$sidebar_widget_shadow_blur = new EdgeField('text', 'sidebar_widget_shadow_blur', '', 'Blur(px)', 'Define amount of shadow blur in pixels', array(), array("col_width" => 3));
$sidebar_widget_shadow_container->addChild('sidebar_widget_shadow_blur', $sidebar_widget_shadow_blur);

$sidebar_widget_shadow_spread = new EdgeField('text', 'sidebar_widget_shadow_spread', '', 'Spread(px)', 'Define amount of shadow spread in pixels', array(), array("col_width" => 3));
$sidebar_widget_shadow_container->addChild('sidebar_widget_shadow_spread', $sidebar_widget_shadow_spread);

$sidebar_widget_shadow_color = new EdgeField('color', 'sidebar_widget_shadow_color', '', 'Color', 'Choose color of shadow');
$sidebar_widget_shadow_container->addChild('sidebar_widget_shadow_color', $sidebar_widget_shadow_color);

$widget_title = new EdgeTitle("widget_title", "Widget Title");
$panel_widgets->addChild("widget_title", $widget_title);

$group2 = new EdgeGroup("Text Style","Define styles for widgets title");
$panel_widgets->addChild("group2",$group2);
$row1 = new EdgeRow();
$group2->addChild("row1",$row1);
$sidebar_title_color = new EdgeField("colorsimple","sidebar_title_color","","Text Color","This is some description");
$row1->addChild("sidebar_title_color",$sidebar_title_color);

$sidebar_title_font_size = new EdgeField("textsimple","sidebar_title_font_size","","Font Size (px)","This is some description");
$row1->addChild("sidebar_title_font_size",$sidebar_title_font_size);

$sidebar_title_line_height = new EdgeField("textsimple","sidebar_title_line_height","","Line Height (px)","This is some description");
$row1->addChild("sidebar_title_line_height",$sidebar_title_line_height);

$sidebar_title_text_transform = new EdgeField("selectblanksimple","sidebar_title_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("sidebar_title_text_transform",$sidebar_title_text_transform);

$row2 = new EdgeRow(true);
$group2->addChild("row2",$row2);
$sidebar_title_font_family = new EdgeField("Fontsimple","sidebar_title_font_family","-1","Font Family","This is some description");
$row2->addChild("sidebar_title_font_family",$sidebar_title_font_family);

$sidebar_title_font_style = new EdgeField("selectblanksimple","sidebar_title_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("sidebar_title_font_style",$sidebar_title_font_style);

$sidebar_title_font_weight = new EdgeField("selectblanksimple","sidebar_title_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("sidebar_title_font_weight",$sidebar_title_font_weight);

$sidebar_title_letter_spacing = new EdgeField("textsimple","sidebar_title_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("sidebar_title_letter_spacing",$sidebar_title_letter_spacing);

$sidebar_title_background = new EdgeField("color","sidebar_title_background","","Background Color","Choose color for background");
$panel_widgets->addChild("sidebar_title_background",$sidebar_title_background);

$sidebar_title_border_color = new EdgeField("color","sidebar_title_border_color","","Border Color","Choose color for border");
$panel_widgets->addChild("sidebar_title_border_color",$sidebar_title_border_color);

$group8 = new EdgeGroup("Padding for Title","Define padding for title");
$panel_widgets->addChild("group8",$group8);

$row1 = new EdgeRow();
$group8->addChild("row1",$row1);

$sidebar_title_padding_top = new EdgeField("textsimple","sidebar_title_padding_top","","Top Padding (px)","This is some description");
$row1->addChild("sidebar_title_padding_top",$sidebar_title_padding_top);

$sidebar_title_padding_right = new EdgeField("textsimple","sidebar_title_padding_right","","Right Padding (px)","This is some description");
$row1->addChild("sidebar_title_padding_right",$sidebar_title_padding_right);

$sidebar_title_padding_bottom = new EdgeField("textsimple","sidebar_title_padding_bottom","","Bottom Padding (px)","This is some description");
$row1->addChild("sidebar_title_padding_bottom",$sidebar_title_padding_bottom);

$sidebar_title_padding_left = new EdgeField("textsimple","sidebar_title_padding_left","","Left Padding (px)","This is some description");
$row1->addChild("sidebar_title_padding_left",$sidebar_title_padding_left);

$group4 = new EdgeGroup("Separator","Define styles for title separator");
$panel_widgets->addChild("group4",$group4);
$row1 = new EdgeRow();
$group4->addChild("row1",$row1);
$sidebar_title_border_bottom_color = new EdgeField("colorsimple","sidebar_title_border_bottom_color","","Color","This is some description");
$row1->addChild("sidebar_title_border_bottom_color",$sidebar_title_border_bottom_color);

$sidebar_title_border_bottom_width = new EdgeField("textsimple","sidebar_title_border_bottom_width","","Thickness (px)","This is some description");
$row1->addChild("sidebar_title_border_bottom_width",$sidebar_title_border_bottom_width);

$sidebar_title_border_bottom_padding_bottom = new EdgeField("textsimple","sidebar_title_border_bottom_padding_bottom","","Top Margin (px)","This is some description");
$row1->addChild("sidebar_title_border_bottom_padding_bottom",$sidebar_title_border_bottom_padding_bottom);

$sidebar_title_border_bottom_margin_bottom = new EdgeField("textsimple","sidebar_title_border_bottom_margin_bottom","","Bottom Margin (px)","This is some description");
$row1->addChild("sidebar_title_border_bottom_margin_bottom",$sidebar_title_border_bottom_margin_bottom);

$widget_text = new EdgeTitle("widget_text", "Widget Text");
$panel_widgets->addChild("widget_text", $widget_text);

$group7 = new EdgeGroup("Text Style","Define styles for widgets text");
$panel_widgets->addChild("group7",$group7);
$row1 = new EdgeRow();
$group7->addChild("row1",$row1);
$sidebar_text_color = new EdgeField("colorsimple","sidebar_text_color","","Text Color","This is some description");
$row1->addChild("sidebar_text_color",$sidebar_text_color);

$sidebar_text_font_size = new EdgeField("textsimple","sidebar_text_font_size","","Font Size (px)","This is some description");
$row1->addChild("sidebar_text_font_size",$sidebar_text_font_size);

$sidebar_text_line_height = new EdgeField("textsimple","sidebar_text_line_height","","Line Height (px)","This is some description");
$row1->addChild("sidebar_text_line_height",$sidebar_text_line_height);

$sidebar_text_text_transform = new EdgeField("selectblanksimple","sidebar_text_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("sidebar_text_text_transform",$sidebar_text_text_transform);

$row2 = new EdgeRow(true);
$group7->addChild("row2",$row2);
$sidebar_text_font_family = new EdgeField("Fontsimple","sidebar_text_font_family","-1","Font Family","This is some description");
$row2->addChild("sidebar_text_font_family",$sidebar_text_font_family);

$sidebar_text_font_style = new EdgeField("selectblanksimple","sidebar_text_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("sidebar_text_font_style",$sidebar_text_font_style);

$sidebar_text_font_weight = new EdgeField("selectblanksimple","sidebar_text_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("sidebar_text_font_weight",$sidebar_text_font_weight);

$sidebar_text_letter_spacing = new EdgeField("textsimple","sidebar_text_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("sidebar_text_letter_spacing",$sidebar_text_letter_spacing);

$widget_link = new EdgeTitle("widget_link", "Widget Link");
$panel_widgets->addChild("widget_link", $widget_link);

$group3 = new EdgeGroup("Text Style","Define styles for widget links");
$panel_widgets->addChild("group3",$group3);
$row1 = new EdgeRow();
$group3->addChild("row1",$row1);
$sidebar_link_color = new EdgeField("colorsimple","sidebar_link_color","","Text Color","This is some description");
$row1->addChild("sidebar_link_color",$sidebar_link_color);

$sidebar_link_hover_color = new EdgeField("colorsimple","sidebar_link_hover_color","","Text Hover Color","This is some description");
$row1->addChild("sidebar_link_hover_color",$sidebar_link_hover_color);

$sidebar_link_font_size = new EdgeField("textsimple","sidebar_link_font_size","","Font Size (px)","This is some description");
$row1->addChild("sidebar_link_font_size",$sidebar_link_font_size);

$sidebar_link_line_height = new EdgeField("textsimple","sidebar_link_line_height","","Line Height (px)","This is some description");
$row1->addChild("sidebar_link_line_height",$sidebar_link_line_height);

$row2 = new EdgeRow(true);
$group3->addChild("row2",$row2);

$sidebar_link_text_transform = new EdgeField("selectblanksimple","sidebar_link_text_transform","","Text Transform","This is some description",$options_texttransform);
$row2->addChild("sidebar_link_text_transform",$sidebar_link_text_transform);

$sidebar_link_font_family = new EdgeField("Fontsimple","sidebar_link_font_family","-1","Font Family","This is some description");
$row2->addChild("sidebar_link_font_family",$sidebar_link_font_family);

$sidebar_link_font_style = new EdgeField("selectblanksimple","sidebar_link_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("sidebar_link_font_style",$sidebar_link_font_style);

$sidebar_link_font_weight = new EdgeField("selectblanksimple","sidebar_link_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("sidebar_link_font_weight",$sidebar_link_font_weight);

$row3 = new EdgeRow(true);
$group3->addChild("row3",$row3);
$sidebar_link_letter_spacing = new EdgeField("textsimple","sidebar_link_letter_spacing","","Letter Spacing (px)","This is some description");
$row3->addChild("sidebar_link_letter_spacing",$sidebar_link_letter_spacing);

$group9 = new EdgeGroup("Separator Style","Choose style for separator between links");
$panel_widgets->addChild("group9",$group9);

$row1 = new EdgeRow();
$group9->addChild("row1",$row1);

$sidebar_link_separator_color = new EdgeField("colorsimple","sidebar_link_separator_color","","Separator between links color","Choose color for separator between color");
$row1->addChild("sidebar_link_separator_color",$sidebar_link_separator_color);

$sidebar_link_separator_type = new EdgeField("selectblanksimple","sidebar_link_separator_type","","Separator between links style","Choose style for separator",array(
	"solid" => "Solid",
	"dotted" => "Dotted",
	"dashed" => "Dashed"
));
$row1->addChild("sidebar_link_separator_type",$sidebar_link_separator_type);

$widget_elements = new EdgeTitle("widget_elements", "Widget Elements");
$panel_widgets->addChild("widget_elements", $widget_elements);

$group5 = new EdgeGroup("Search","Define styles for search in widget");
$panel_widgets->addChild("group5",$group5);
$row1 = new EdgeRow();
$group5->addChild("row1",$row1);

$sidebar_search_height = new EdgeField("textsimple","sidebar_search_height","","Height (px)","This is some description");
$row1->addChild("sidebar_search_height",$sidebar_search_height);

$sidebar_search_border_color = new EdgeField("colorsimple","sidebar_search_border_color","","Border Color","This is some description");
$row1->addChild("sidebar_search_border_color",$sidebar_search_border_color);

$sidebar_search_loupe_color = new EdgeField("colorsimple","sidebar_search_loupe_color","","Magnifier Color","This is some description");
$row1->addChild("sidebar_search_loupe_color",$sidebar_search_loupe_color);

$sidebar_search_loupe_background_color = new EdgeField("colorsimple","sidebar_search_loupe_background_color","","Magnifier Area Background Color","This is some description");
$row1->addChild("sidebar_search_loupe_background_color",$sidebar_search_loupe_background_color);

$row2 = new EdgeRow();
$group5->addChild("row2",$row2);
$sidebar_search_text_color = new EdgeField("colorsimple","sidebar_search_text_color","","Text Color","This is some description");
$row2->addChild("sidebar_search_text_color",$sidebar_search_text_color);

$sidebar_search_focus_text_color = new EdgeField("colorsimple","sidebar_search_focus_text_color","","Focus Text Color","This is some description");
$row2->addChild("sidebar_search_focus_text_color",$sidebar_search_focus_text_color);

$sidebar_search_text_font_size = new EdgeField("textsimple","sidebar_search_text_font_size","","Font Size (px)","This is some description");
$row2->addChild("sidebar_search_text_font_size",$sidebar_search_text_font_size);

$sidebar_search_text_line_height = new EdgeField("textsimple","sidebar_search_text_line_height","","Line Height (px)","This is some description");
$row2->addChild("sidebar_search_text_line_height",$sidebar_search_text_line_height);



$row3 = new EdgeRow(true);
$group5->addChild("row3",$row3);

$sidebar_search_text_text_transform = new EdgeField("selectblanksimple","sidebar_search_text_text_transform","","Text Transform","This is some description",$options_texttransform);
$row3->addChild("sidebar_search_text_text_transform",$sidebar_search_text_text_transform);

$sidebar_search_text_font_family = new EdgeField("Fontsimple","sidebar_search_text_font_family","-1","Font Family","This is some description");
$row3->addChild("sidebar_search_text_font_family",$sidebar_search_text_font_family);

$sidebar_search_text_font_style = new EdgeField("selectblanksimple","sidebar_search_text_font_style","","Font Style","This is some description",$options_fontstyle);
$row3->addChild("sidebar_search_text_font_style",$sidebar_search_text_font_style);

$sidebar_search_text_font_weight = new EdgeField("selectblanksimple","sidebar_search_text_font_weight","","Font Weight","This is some description",$options_fontweight);
$row3->addChild("sidebar_search_text_font_weight",$sidebar_search_text_font_weight);

$row4 = new EdgeRow(true);
$group5->addChild("row4",$row4);

$sidebar_search_text_letter_spacing = new EdgeField("textsimple","sidebar_search_text_letter_spacing","","Letter Spacing (px)","This is some description");
$row4->addChild("sidebar_search_text_letter_spacing",$sidebar_search_text_letter_spacing);

$sidebar_search_border_around = new EdgeField("selectsimple","sidebar_search_border_around","","Border Around","This is some description",array(
	"around_everything" => "Around Everything",
	"around_search_text" => "Around Search Text"
));
$row4->addChild("sidebar_search_border_around",$sidebar_search_border_around);



$widget_blog_list = new EdgeTitle("widget_blog_list", "Widget - Edge Blog");
$panel_widgets->addChild("widget_blog_list", $widget_blog_list);

$group10 = new EdgeGroup("Blog List Title","Define Blog List title style");
$panel_widgets->addChild("group10",$group10);
$row1 = new EdgeRow();
$group10->addChild("row1",$row1);

$widget_blog_list_title_color = new EdgeField("colorsimple","widget_blog_list_title_color","","Text Color","This is some description");
$row1->addChild("widget_blog_list_title_color",$widget_blog_list_title_color);

$widget_blog_list_title_hover_color = new EdgeField("colorsimple","widget_blog_list_title_hover_color","","Text Hover Color","This is some description");
$row1->addChild("widget_blog_list_title_hover_color",$widget_blog_list_title_hover_color);

$widget_blog_list_title_font_size = new EdgeField("textsimple","widget_blog_list_title_font_size","","Font Size (px)","This is some description");
$row1->addChild("widget_blog_list_title_font_size",$widget_blog_list_title_font_size);

$widget_blog_list_title_line_height = new EdgeField("textsimple","widget_blog_list_title_line_height","","Line Height (px)","This is some description");
$row1->addChild("widget_blog_list_title_line_height",$widget_blog_list_title_line_height);

$row2 = new EdgeRow(true);
$group10->addChild("row2",$row2);

$widget_blog_list_title_text_transform = new EdgeField("selectblanksimple","widget_blog_list_title_text_transform","","Text Transform","This is some description",$options_texttransform);
$row2->addChild("widget_blog_list_title_text_transform",$widget_blog_list_title_text_transform);

$widget_blog_list_title_font_family = new EdgeField("Fontsimple","widget_blog_list_title_font_family","-1","Font Family","This is some description");
$row2->addChild("widget_blog_list_title_font_family",$widget_blog_list_title_font_family);

$widget_blog_list_title_font_style = new EdgeField("selectblanksimple","widget_blog_list_title_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("widget_blog_list_title_font_style",$widget_blog_list_title_font_style);

$widget_blog_list_title_font_weight = new EdgeField("selectblanksimple","widget_blog_list_title_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("widget_blog_list_title_font_weight",$widget_blog_list_title_font_weight);


$row3 = new EdgeRow(true);
$group10->addChild("row3",$row3);

$widget_blog_list_title_letter_spacing = new EdgeField("textsimple","widget_blog_list_title_letter_spacing","","Letter Spacing (px)","This is some description");
$row3->addChild("widget_blog_list_title_letter_spacing",$widget_blog_list_title_letter_spacing);


$group11 = new EdgeGroup("Blog List Post Info","Define blog list post info style");
$panel_widgets->addChild("group11",$group11);
$row1 = new EdgeRow();
$group11->addChild("row1",$row1);

$widget_blog_list_post_info_color = new EdgeField("colorsimple","widget_blog_list_post_info_color","","Text Color","This is some description");
$row1->addChild("widget_blog_list_post_info_color",$widget_blog_list_post_info_color);

$widget_blog_list_post_info_link_color = new EdgeField("colorsimple","widget_blog_list_post_info_link_color","","Link Color","This is some description");
$row1->addChild("widget_blog_list_post_info_link_color",$widget_blog_list_post_info_link_color);

$widget_blog_list_post_info_link_hover_color = new EdgeField("colorsimple","widget_blog_list_post_info_link_hover_color","","Link Hover Color","This is some description");
$row1->addChild("widget_blog_list_post_info_link_hover_color",$widget_blog_list_post_info_link_hover_color);

$widget_blog_list_post_info_font_size = new EdgeField("textsimple","widget_blog_list_post_info_font_size","","Font Size (px)","This is some description");
$row1->addChild("widget_blog_list_post_info_font_size",$widget_blog_list_post_info_font_size);


$row2 = new EdgeRow(true);
$group11->addChild("row2",$row2);

$widget_blog_list_post_info_line_height = new EdgeField("textsimple","widget_blog_list_post_info_line_height","","Line Height (px)","This is some description");
$row2->addChild("widget_blog_list_post_info_line_height",$widget_blog_list_post_info_line_height);

$widget_blog_list_post_info_text_transform = new EdgeField("selectblanksimple","widget_blog_list_post_info_text_transform","","Text Transform","This is some description",$options_texttransform);
$row2->addChild("widget_blog_list_post_info_text_transform",$widget_blog_list_post_info_text_transform);

$widget_blog_list_post_info_font_family = new EdgeField("Fontsimple","widget_blog_list_post_info_font_family","-1","Font Family","This is some description");
$row2->addChild("widget_blog_list_post_info_font_family",$widget_blog_list_post_info_font_family);

$widget_blog_list_post_info_font_style = new EdgeField("selectblanksimple","widget_blog_list_post_info_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("widget_blog_list_post_info_font_style",$widget_blog_list_post_info_font_style);

$row3 = new EdgeRow(true);
$group11->addChild("row3",$row3);

$widget_blog_list_post_info_font_weight = new EdgeField("selectblanksimple","widget_blog_list_post_info_font_weight","","Font Weight","This is some description",$options_fontweight);
$row3->addChild("widget_blog_list_post_info_font_weight",$widget_blog_list_post_info_font_weight);

$widget_blog_list_post_info_letter_spacing = new EdgeField("textsimple","widget_blog_list_post_info_letter_spacing","","Letter Spacing (px)","This is some description");
$row3->addChild("widget_blog_list_post_info_letter_spacing",$widget_blog_list_post_info_letter_spacing);

$group12 = new EdgeGroup("Blog List Date Style","Define blog list date style");
$panel_widgets->addChild("group12",$group12);
$row1 = new EdgeRow();
$group12->addChild("row1",$row1);

$widget_blog_list_date_color = new EdgeField("colorsimple","widget_blog_list_date_color","","Text Color","This is some description");
$row1->addChild("widget_blog_list_date_color",$widget_blog_list_date_color);

$widget_blog_list_date_font_size = new EdgeField("textsimple","widget_blog_list_date_font_size","","Font Size (px)","This is some description");
$row1->addChild("widget_blog_list_date_font_size",$widget_blog_list_date_font_size);

$widget_blog_list_date_line_height = new EdgeField("textsimple","widget_blog_list_date_line_height","","Line Height (px)","This is some description");
$row1->addChild("widget_blog_list_date_line_height",$widget_blog_list_date_line_height);

$widget_blog_list_date_text_transform = new EdgeField("selectblanksimple","widget_blog_list_date_text_transform","","Text Transform","This is some description",$options_texttransform);
$row1->addChild("widget_blog_list_date_text_transform",$widget_blog_list_date_text_transform);

$row2 = new EdgeRow(true);
$group12->addChild("row2",$row2);

$widget_blog_list_date_font_family = new EdgeField("Fontsimple","widget_blog_list_date_font_family","-1","Font Family","This is some description");
$row2->addChild("widget_blog_list_date_font_family",$widget_blog_list_date_font_family);

$widget_blog_list_date_font_style = new EdgeField("selectblanksimple","widget_blog_list_date_font_style","","Font Style","This is some description",$options_fontstyle);
$row2->addChild("widget_blog_list_date_font_style",$widget_blog_list_date_font_style);

$widget_blog_list_date_font_weight = new EdgeField("selectblanksimple","widget_blog_list_date_font_weight","","Font Weight","This is some description",$options_fontweight);
$row2->addChild("widget_blog_list_date_font_weight",$widget_blog_list_date_font_weight);

$widget_blog_list_date_letter_spacing = new EdgeField("textsimple","widget_blog_list_date_letter_spacing","","Letter Spacing (px)","This is some description");
$row2->addChild("widget_blog_list_date_letter_spacing",$widget_blog_list_date_letter_spacing);

$group31 = new EdgeGroup("Blog List Spacing","Define blog list spacing");
$panel_widgets->addChild("group31",$group31);

$row1 = new EdgeRow(true);
$group31->addChild("row1",$row1);

$widget_blog_list_title_margin_bttm = new EdgeField("textsimple","widget_blog_list_title_margin_bttm","","Margin Under Title (px)","This is some description");
$row1->addChild("widget_blog_list_title_margin_bttm",$widget_blog_list_title_margin_bttm);

$widget_blog_list_post_info_margin_bttm = new EdgeField("textsimple","widget_blog_list_post_info_margin_bttm","","Margin Under Post Info (px)","This is some description");
$row1->addChild("widget_blog_list_post_info_margin_bttm",$widget_blog_list_post_info_margin_bttm);

$widget_blog_list_read_more_margin_top = new EdgeField("textsimple","widget_blog_list_read_more_margin_top","","Margin Above Read More Button (px)","This is some description");
$row1->addChild("widget_blog_list_read_more_margin_top",$widget_blog_list_read_more_margin_top);