<?php

global $edgtIconCollections;
$titlePage = new EdgeAdminPage("4", "Title", "fa fa-list-alt");
$edgtFramework->edgtOptions->addAdminPage("title",$titlePage);

$panel8 = new EdgePanel("Title","title_panel");
$titlePage->addChild("panel8",$panel8);

	$show_page_title = new EdgeField("yesno","show_page_title","yes","Enable Page Title Area","This option will enable Title Area", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_enable_title_container"));
	$panel8->addChild("show_page_title",$show_page_title);

	$enable_title_container = new EdgeContainer("enable_title_container","show_page_title","no");
	$panel8->addChild("enable_title_container",$enable_title_container);

		$title_type = new EdgeField("select","title_type","standard_title","Title Type","Choose title type", array( 
				"standard_title" => "Standard",
				"breadcrumbs_title" => "Breadcrumb"
		      ),array(
		      	"dependence" => true,
		      	"hide" => array("breadcrumbs_title" => "#edgtf_title_standard_container"),
		      	"show" => array("standard_title" => "#edgtf_title_standard_container")
		      ));
		$enable_title_container->addChild("title_type",$title_type);

		$animate_title_area = new EdgeField("select","animate_title_area","no","Animations","Choose an animation for Title Area", array( 
			"no" => "No animation",
			"text_right_left" => "Text right to left",
			"area_top_bottom" => "Title area top to bottom"
	      ));
		$enable_title_container->addChild("animate_title_area",$animate_title_area);
		
		$page_title_vertical_aligment = new EdgeField("select","page_title_vertical_aligment","header_bottom","Vertical Alignment","Specify Title vertical alignment", array( 
						"header_bottom" => "From Bottom of Header",
						"window_top" => "From Window Top"
					  ));
		$enable_title_container->addChild("page_title_vertical_aligment",$page_title_vertical_aligment);
		
		$show_page_title_text = new EdgeField("yesno","show_page_title_text","yes","Enable Page Title Text","This option will enable Title Text", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_enable_title_text_container, #edgtf_animation_page_title_contaier"));
		$enable_title_container->addChild("show_page_title_text",$show_page_title_text);

			$enable_title_text_container = new EdgeContainer("enable_title_text_container","show_page_title_text","no");
			$enable_title_container->addChild("enable_title_text_container",$enable_title_text_container);
		
		
				$page_title_position = new EdgeField("select","page_title_position","left","Title Text Alignment","Specify Title text alignment", array( 
						"left" => "Left",
						"center" => "Center",
						"right" => "Right"
					  ));
				$enable_title_text_container->addChild("page_title_position",$page_title_position);
				
				$title_text_shadow = new EdgeField("yesno","title_text_shadow","no","Title Text Shadow","Enabling this option will give Title text a shadow");
				$enable_title_text_container->addChild("title_text_shadow",$title_text_shadow);
		

		$title_standard_container = new EdgeContainer("title_standard_container","title_type","breadcrumbs_title");
		$enable_title_container->addChild("title_standard_container",$title_standard_container);

		//Title like separator with text
		$title_like_separator = new EdgeField("yesno","title_like_separator","no","Separator Around Title Text","Enable separator around title", array(), array(
			"dependence" => true,
			"dependence_hide_on_yes" => "",
			"dependence_show_on_yes" => "#edgtf_title_like_separator_container"
			));
		$title_standard_container->addChild("title_like_separator",$title_like_separator);

			$title_like_separator_container = new EdgeContainer("title_like_separator_container","title_like_separator","no");
			$title_standard_container->addChild("title_like_separator_container",$title_like_separator_container);

				$group1 = new EdgeGroup("Line Styles", "Choose style for separator line");
				$title_like_separator_container->addChild("group1",$group1);

					$row1 = new EdgeRow();
					$group1->addChild("row1",$row1);

						$title_like_separator_line_color = new EdgeField("colorsimple","title_like_separator_line_color","","Color","This is some description");
						$row1->addChild("title_like_separator_line_color",$title_like_separator_line_color);

						$title_like_separator_line_width = new EdgeField("textsimple","title_like_separator_line_width","","Width","This is some description");
						$row1->addChild("title_like_separator_line_width",$title_like_separator_line_width);

						$title_like_separator_line_thickness = new EdgeField("textsimple","title_like_separator_line_thickness","","Thickness","This is some description");
						$row1->addChild("title_like_separator_line_thickness",$title_like_separator_line_thickness);

						$title_like_separator_line_style = new EdgeField("selectsimple","title_like_separator_line_style","","Style","This is some description",array(
							"solid" => "Solid",
							"dashed" => "Dashed",
							"dotted" => "Dotted"
							));
						$row1->addChild("title_like_separator_line_style",$title_like_separator_line_style);

				$title_like_separator_margins = new EdgeField("text","title_like_separator_margins","","Margins for Title","Define left/right margins for title from separator");
				$title_like_separator_container->addChild("title_like_separator_margins",$title_like_separator_margins);

				$title_like_separator_line_dots = new EdgeField("yesno","title_like_separator_line_dots","no","Dots on The End of Lines","Enabling this option will give lines a dot next to title",array(),array(
						"dependence" => true,
						"dependence_hide_on_yes" => "",
						"dependence_show_on_yes" => "#edgtf_title_like_separator_dots_container"
					));
				$title_like_separator_container->addChild("title_like_separator_line_dots",$title_like_separator_line_dots);

				$title_like_separator_dots_container = new EdgeContainer("title_like_separator_dots_container","title_like_separator_line_dots","no");
				$title_like_separator_container->addChild("title_like_separator_dots_container",$title_like_separator_dots_container);

					$group1 = new EdgeGroup("Dots Style","Choose style for dots");
					$title_like_separator_dots_container->addChild("group1",$group1);

						$row1 = new EdgeRow();
						$group1->addChild("row1",$row1);

							$title_like_separator_dots_size = new EdgeField("textsimple","title_like_separator_dots_size","","Size (px)","This is some description");
							$row1->addChild("title_like_separator_dots_size",$title_like_separator_dots_size);

							$title_like_separator_dots_color = new EdgeField("colorsimple","title_like_separator_dots_color","","Color","This is some description");
							$row1->addChild("title_like_separator_dots_color",$title_like_separator_dots_color);

		//Subtitle like separator with text
		$subtitle_like_separator = new EdgeField("yesno","subtitle_like_separator","no","Separator Around Subtitle Text","Enable separator around subtitle", array(), array(
			"dependence" => true,
			"dependence_hide_on_yes" => "",
			"dependence_show_on_yes" => "#edgtf_subtitle_like_separator_container"
			));
		$title_standard_container->addChild("subtitle_like_separator",$subtitle_like_separator);

			$subtitle_like_separator_container = new EdgeContainer("subtitle_like_separator_container","subtitle_like_separator","no");
			$title_standard_container->addChild("subtitle_like_separator_container",$subtitle_like_separator_container);

				$group1 = new EdgeGroup("Line Styles", "Choose style for separator line");
				$subtitle_like_separator_container->addChild("group1",$group1);

					$row1 = new EdgeRow();
					$group1->addChild("row1",$row1);

						$subtitle_like_separator_line_color = new EdgeField("colorsimple","subtitle_like_separator_line_color","","Color","This is some description");
						$row1->addChild("subtitle_like_separator_line_color",$subtitle_like_separator_line_color);

						$subtitle_like_separator_line_width = new EdgeField("textsimple","subtitle_like_separator_line_width","","Width","This is some description");
						$row1->addChild("subtitle_like_separator_line_width",$subtitle_like_separator_line_width);

						$subtitle_like_separator_line_thickness = new EdgeField("textsimple","subtitle_like_separator_line_thickness","","Thickness","This is some description");
						$row1->addChild("subtitle_like_separator_line_thickness",$subtitle_like_separator_line_thickness);

						$subtitle_like_separator_line_style = new EdgeField("selectsimple","subtitle_like_separator_line_style","","Style","This is some description",array(
							"solid" => "Solid",
							"dashed" => "Dashed",
							"dotted" => "Dotted"
							));
						$row1->addChild("subtitle_like_separator_line_style",$subtitle_like_separator_line_style);

				$subtitle_like_separator_margins = new EdgeField("text","subtitle_like_separator_margins","","Margins for Subtitle","Define left/right margins for subtitle from separator");
				$subtitle_like_separator_container->addChild("subtitle_like_separator_margins",$subtitle_like_separator_margins);


		$title_background_color = new EdgeField("color","title_background_color","","Background Color","Choose a background color for Title Area");
		$enable_title_container->addChild("title_background_color",$title_background_color);
		
		$title_image = new EdgeField("image","title_image","","Background Image","Choose an Image for Title Area");
		$enable_title_container->addChild("title_image",$title_image);
		
		$responsive_title_image = new EdgeField("yesno","responsive_title_image","no","Background Responsive Image","Enabling this option will make Title background image responsive", array(), array("dependence" => true, "dependence_hide_on_yes" => "#edgtf_responsive_title_image_container", "dependence_show_on_yes" => ""));
		$enable_title_container->addChild("responsive_title_image",$responsive_title_image);

		$responsive_title_image_container = new EdgeContainer("responsive_title_image_container","responsive_title_image","yes");
		$enable_title_container->addChild("responsive_title_image_container",$responsive_title_image_container);
			$fixed_title_image = new EdgeField("select","fixed_title_image","no","Parallax Title Image","Enabling this option will make Title image parallax", array( "no" => "No",
			       "yes" => "Yes",
			       "yes_zoom" => "Yes, with zoom out"
			      ));
			$responsive_title_image_container->addChild("fixed_title_image",$fixed_title_image);
			$title_height = new EdgeField("text","title_height","","Title Height (px)","Set a height for Title Area in pixels", array(), array("col_width" => 3));
			$responsive_title_image_container->addChild("title_height",$title_height);

		$title_overlay_image = new EdgeField("image","title_overlay_image","","Pattern Overlay Image","Choose an image to be used as pattern over Title Area");
		$enable_title_container->addChild("title_overlay_image",$title_overlay_image);
		
		
		$enable_title_oblique = new EdgeField("yesno","enable_title_oblique","no","Enable Angled Shape in Background","Enabling this option will show angled shape in background", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_enable_title_oblique_container"));
		$enable_title_container->addChild("enable_title_oblique",$enable_title_oblique);
		
			$enable_title_oblique_container = new EdgeContainer("enable_title_oblique_container","enable_title_oblique","no");
			$enable_title_container->addChild("enable_title_oblique_container",$enable_title_oblique_container);
				
				$title_oblique_section_position = new EdgeField("select","title_oblique_section_position","","Angled Shape Position","Choose a position for angled shape in title background", array(
                            "from_left_to_right" => "From Left To Right",
                            "from_right_to_left" => "From Right To Left"
                        ));
                $enable_title_oblique_container->addChild("title_oblique_section_position",$title_oblique_section_position);
				 
				$title_oblique_section_color = new EdgeField("color","title_oblique_section_color","","Background Color","Choose a background color for angled shape");
				$enable_title_oblique_container->addChild("title_oblique_section_color",$title_oblique_section_color);
				
		

		$enable_title_triangle = new EdgeField("yesno","enable_title_triangle","no","Enable Triangle Shape in Background","Enabling this option will display a triangular shape in background", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_enable_title_triangle_container"));
		$enable_title_container->addChild("enable_title_triangle",$enable_title_triangle);
		
			$enable_title_triangle_container = new EdgeContainer("enable_title_triangle_container","enable_title_triangle","no");
			$enable_title_container->addChild("enable_title_triangle_container",$enable_title_triangle_container);
				
				$title_triangle_section_position = new EdgeField("select","title_triangle_section_position","","Triangle Shape Position","Choose a position for a triangular shape in title background", array(
                            "top_and_bottom" => "Top and Bottom",
                            "top" => "Top",
							"bottom" => "Bottom"
                        ));
                $enable_title_triangle_container->addChild("title_triangle_section_position",$title_triangle_section_position);
				 
				$title_triangle_section_color = new EdgeField("color","title_triangle_section_color","","Background Color","Choose a background color for a triangular shape");
				$enable_title_triangle_container->addChild("title_triangle_section_color",$title_triangle_section_color);
		

		$title_separator = new EdgeField("yesno","title_separator","no","Show Title Separator","Enabling this option will display a separator underneath Title", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_title_separator_container, #edgtf_animation_page_title_separator_container"));
		$title_standard_container->addChild("title_separator",$title_separator);

		$title_separator_container = new EdgeContainer("title_separator_container","title_separator","no");
		$title_standard_container->addChild("title_separator_container",$title_separator_container);

		        $title_separator_format = new EdgeField("select","title_separator_format","normal","Format","Choose a format (type) of separator", array(
                        "normal" => "Normal",
                        "with_icon" => "With Icon",
                        "with_custom_icon" => "With Custom Icon"
                ), array(
                "dependence" => true,
                "hide" => array(
                	"normal" => "#edgtf_separator_with_icon_container, #edgtf_separator_custom_icon_container, #edgtf_separator_all_icons_container",
                	"with_custom_icon" => "#edgtf_separator_with_icon_container",
                	"with_icon" => "#edgtf_separator_custom_icon_container"
                	),
                "show" => array(
                	"with_icon" => "#edgtf_separator_with_icon_container, #edgtf_separator_all_icons_container",
                	"with_custom_icon" => "#edgtf_separator_custom_icon_container, #edgtf_separator_all_icons_container"
                	)
                ));

                $title_separator_container->addChild("title_separator_format",$title_separator_format);

                $separator_all_icons_container = new EdgeContainer("separator_all_icons_container","title_separator_format","normal");
				$title_separator_container->addChild("separator_all_icons_container",$separator_all_icons_container);	

					$group1 = new EdgeGroup("Icon Position and Margins","Choose icon position and set left(right) margin");
					$separator_all_icons_container->addChild("group1",$group1);

						$row1 = new EdgeRow();
						$group1->addChild("row1",$row1);

							$title_separator_icon_position = new EdgeField("selectsimple","title_separator_icon_position","","Icon Position","Choose a position for an icon", array(
		                        "left" => "Left",
		                        "center" => "Center",
		                        "right" => "Right"
		                	));
		                	$row1->addChild("title_separator_icon_position",$title_separator_icon_position);

		                	$title_separator_icon_margins = new EdgeField("textsimple","title_separator_icon_margins","","Margins (px)","Enter margin that will refer to left and right margin of the icon");
		                	$row1->addChild("title_separator_icon_margins",$title_separator_icon_margins);

                $separator_with_icon_container = new EdgeContainer("separator_with_icon_container","title_separator_format","normal",array("normal","with_custom_icon"));
				$title_separator_container->addChild("separator_with_icon_container",$separator_with_icon_container);

	                 //init icon pack hide and show array. It will be populated dinamically from collections array
					$separator_icon_pack_hide_array = array();
					$separator_icon_pack_show_array = array();

					//do we have some collection added in collections array?
					if(is_array($edgtIconCollections->iconCollections) && count($edgtIconCollections->iconCollections)) {
						//get collections params array. It will contain values of 'param' property for each collection
						$separator_icon_collections_params = $edgtIconCollections->getIconCollectionsParams();

						//foreach collection generate hide and show array
						foreach ($edgtIconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
							$separator_icon_pack_hide_array[$dep_collection_key] = '';

							//we need to include only current collection in show string as it is the only one that needs to show
							$separator_icon_pack_show_array[$dep_collection_key] = '#edgtf_separator_icon_'.$dep_collection_object->param.'_container';

							//for all collections param generate hide string
							foreach ($separator_icon_collections_params as $separator_icon_collections_param) {
								//we don't need to include current one, because it needs to be shown, not hidden
								if($separator_icon_collections_param !== $dep_collection_object->param) {
									$separator_icon_pack_hide_array[$dep_collection_key].= '#edgtf_separator_icon_'.$separator_icon_collections_param.'_container,';
								}
							}

							//remove remaining ',' character
							$separator_icon_pack_hide_array[$dep_collection_key] = rtrim($separator_icon_pack_hide_array[$dep_collection_key], ',');
						}

					}

					$separator_icon_pack = new EdgeField(
						"select",
						"separator_icon_pack",
						"font_awesome",
						"Separator Icon Pack",
						"Choose icon pack for separator",
						$edgtIconCollections->getIconCollections(),
						array(
							"dependence" => true,
							"hide" => $separator_icon_pack_hide_array,
							"show" => $separator_icon_pack_show_array
						));

					$separator_with_icon_container->addChild("separator_icon_pack", $separator_icon_pack);

					if(is_array($edgtIconCollections->iconCollections) && count($edgtIconCollections->iconCollections)) {
						//foreach icon collection we need to generate separate container that will have dependency set
						//it will have one field inside with icons dropdown
						foreach ($edgtIconCollections->iconCollections as $collection_key => $collection_object) {
							$icons_array = $collection_object->getIconsArray();

							//get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
							$icon_collections_keys = $edgtIconCollections->getIconCollectionsKeys();

							//unset current one, because it doesn't have to be included in dependency that hides icon container
							unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

							$separator_icon_hide_values = $icon_collections_keys;
							$separator_icon_container = new EdgeContainer("separator_icon_".$collection_object->param."_container", "separator_icon_pack", "", $separator_icon_hide_values);
							$separator_icon = new EdgeField("select", "separator_icon_".$collection_object->param, "", "Separator Icon","Choose Separator Icon", $icons_array, array("col_width" => 3));
							$separator_icon_container->addChild("separator_icon_".$collection_object->param, $separator_icon);

							$separator_with_icon_container->addChild("separator_icon_".$collection_object->param."_container", $separator_icon_container);
						}

					}

					$group1 = new EdgeGroup("Icon Style", "Choose icon style");
					$separator_with_icon_container->addChild("group1",$group1);

						$row1 = new EdgeRow();
						$group1->addChild("row1",$row1);

							$title_separator_icon_color = new EdgeField("colorsimple","title_separator_icon_color","","Color","Choose a color of icon for Title separator");
							$row1->addChild("title_separator_icon_color",$title_separator_icon_color);

							$title_separator_icon_hover_color = new EdgeField("colorsimple","title_separator_icon_hover_color","","Hover Color","Choose a hover color of icon for Title separator");
							$row1->addChild("title_separator_icon_hover_color",$title_separator_icon_hover_color);

							$title_separator_icon_custom_size = new EdgeField("textsimple","title_separator_icon_custom_size","","Icon Size","Choose size of icon");
							$row1->addChild("title_separator_icon_custom_size",$title_separator_icon_custom_size);

                	$title_separator_icon_type = new EdgeField("select","title_separator_icon_type","normal","Icon Type","Choose icon type", array(
                        "normal" => "Normal",
                        "circle" => "Circle",
                        "square" => "Square"
                	),array("dependence" => true, "hide" => array("normal" => "#edgtf_title_separator_types_container"), "show" => array("circle" => "#edgtf_title_separator_types_container","square" => "#edgtf_title_separator_types_container")));
                	$separator_with_icon_container->addChild("title_separator_icon_type",$title_separator_icon_type);

                	$title_separator_types_container = new EdgeContainer("title_separator_types_container","title_separator_icon_type","normal");
					$separator_with_icon_container->addChild("title_separator_types_container",$title_separator_types_container);

						$group1 = new EdgeGroup("Border Style", "Define border style for icon");
						$title_separator_types_container->addChild("group1",$group1);

							$row1 = new EdgeRow();
							$group1->addChild("row1",$row1);

								$title_separator_icon_border_radius = new EdgeField("textsimple","title_separator_icon_border_radius","","Border Radius (px)","Enter border radius for icon");
		                		$row1->addChild("title_separator_icon_border_radius",$title_separator_icon_border_radius);

		                		$title_separator_icon_border_width = new EdgeField("textsimple","title_separator_icon_border_width","","Border Width (px)","Enter border width for icon");
		                		$row1->addChild("title_separator_icon_border_width",$title_separator_icon_border_width);

		                		$title_separator_icon_border_color = new EdgeField("colorsimple","title_separator_icon_border_color","","Border Color","Enter border color for icon");
		                		$row1->addChild("title_separator_icon_border_color",$title_separator_icon_border_color);

		                		$title_separator_icon_border_hover_color = new EdgeField("colorsimple","title_separator_icon_border_hover_color","","Border Hover Color","Enter border color for icon");
		                		$row1->addChild("title_separator_icon_border_hover_color",$title_separator_icon_border_hover_color);

		                $group2 = new EdgeGroup("Additional Icon Style","Choose adition icon styling");
		                $title_separator_types_container->addChild("group2",$group2);

		                	$row1 = new EdgeRow();
		                	$group2->addChild("row1",$row1);

		                		$title_separator_icon_shape_size = new EdgeField("textsimple","title_separator_icon_shape_size","","Shape Size (px)","This is some description");
		                		$row1->addChild("title_separator_icon_shape_size",$title_separator_icon_shape_size);

		                		$title_separator_icon_background_color = new EdgeField("colorsimple","title_separator_icon_background_color","","Background Color","This is some description");
		                		$row1->addChild("title_separator_icon_background_color",$title_separator_icon_background_color);

		                		$title_separator_icon_background_hover_color = new EdgeField("colorsimple","title_separator_icon_background_hover_color","","Background Hover Color","This is some description");
		                		$row1->addChild("title_separator_icon_background_hover_color",$title_separator_icon_background_hover_color);		                		
 				

 				$separator_custom_icon_container = new EdgeContainer("separator_custom_icon_container","title_separator_format","normal",array("normal","with_icon"));
 				$title_separator_container->addChild("separator_custom_icon_container",$separator_custom_icon_container);

 					$separator_custom_icon = new EdgeField("image","separator_custom_icon","","Custom Icon","Choose custom icon for separator");
 					$separator_custom_icon_container->addChild("separator_custom_icon",$separator_custom_icon);

                $title_separator_type = new EdgeField("select","title_separator_type","","Type","Choose a Title separator line style", array( "" => "",
                        "solid" => "Solid",
                        "dashed" => "Dashed"
                ));
                $title_separator_container->addChild("title_separator_type",$title_separator_type);

                $title_separator_position = new EdgeField("select","title_separator_position","","Position","Choose a Title separator position", array( "" => "",
                        "above" => "Above Title",
                        "below" => "Below Title"
                ));
                $title_separator_container->addChild("title_separator_position",$title_separator_position);

                $title_separator_color = new EdgeField("color","title_separator_color","","Color","Choose a color for Title separator");
                $title_separator_container->addChild("title_separator_color",$title_separator_color);

                $group1 = new EdgeGroup("Size",'Define size for Title separator');
                $title_separator_container->addChild("group1",$group1);

                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                        $title_separator_thickness = new EdgeField("textsimple","title_separator_thickness","","Thickness (px)","This is some description");
                        $row1->addChild("title_separator_thickness",$title_separator_thickness);

                        $title_separator_width = new EdgeField("textsimple","title_separator_width","","Width (px)","This is some description");
                        $row1->addChild("title_separator_width",$title_separator_width);

                $group2 = new EdgeGroup("Margin",'Add space at top and bottom of Title separator');
                $title_separator_container->addChild("group2",$group2);

                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                        $title_separator_topmargin = new EdgeField("textsimple","title_separator_topmargin","","Top Margin (px)","This is some description");
                        $row1->addChild("title_separator_topmargin",$title_separator_topmargin);

                        $title_separator_bottommargin = new EdgeField("textsimple","title_separator_bottommargin","","Bottom Margin (px)","This is some description");
                        $row1->addChild("title_separator_bottommargin",$title_separator_bottommargin);
						
		$border_top_title_area = new EdgeField("yesno","border_top_title_area","no","Top Border","Enabling this option will display top border on Title Area", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_border_top_title_area_container"));
		$enable_title_container->addChild("border_top_title_area",$border_top_title_area);
		$border_top_title_area_container = new EdgeContainer("border_top_title_area_container","border_top_title_area","no");
		$enable_title_container->addChild("border_top_title_area_container",$border_top_title_area_container);
			$border_top_title_area_grid = new EdgeField("yesno","border_top_title_area_grid","no","Top Border in Grid","Enabling this option will display bottom border in grid");
			$border_top_title_area_container->addChild("border_top_title_area_grid",$border_top_title_area_grid);
			$border_top_title_area_width = new EdgeField("text","border_top_title_area_width","","Top Border Width (px)","Choose a width for Title Area bottom border Note: If width has not been set, border bottom will not be displayed", array(), array("col_width" => 3));
            $border_top_title_area_container->addChild("border_top_title_area_width",$border_top_title_area_width);
			$border_top_title_area_color = new EdgeField("color","border_top_title_area_color","","Top Border Color","Choose a color for Title Area bottom border");
			$border_top_title_area_container->addChild("border_top_title_area_color",$border_top_title_area_color);
			$border_top_title_area_style = new EdgeField("select","border_top_title_area_style","","Top Border Style","This is some description",array(
				""	=> "",
				"solid" => "Solid",
				"dashed" => "Dashed",
				"dotted" => "Dotted"
				));
			$border_top_title_area_container->addChild("border_top_title_area_style",$border_top_title_area_style);				

		$border_bottom_title_area = new EdgeField("yesno","border_bottom_title_area","no","Bottom Border","Enabling this option will display bottom border on Title Area", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_border_bottom_title_area_container"));
		$enable_title_container->addChild("border_bottom_title_area",$border_bottom_title_area);
		$border_bottom_title_area_container = new EdgeContainer("border_bottom_title_area_container","border_bottom_title_area","no");
		$enable_title_container->addChild("border_bottom_title_area_container",$border_bottom_title_area_container);
			$border_bottom_title_area_grid = new EdgeField("yesno","border_bottom_title_area_grid","no","Bottom Border in Grid","Enabling this option will display bottom border in grid");
			$border_bottom_title_area_container->addChild("border_bottom_title_area_grid",$border_bottom_title_area_grid);
			$border_bottom_title_area_width = new EdgeField("text","border_bottom_title_area_width","","Bottom Border Width (px)","Choose a width for Title Area bottom border Note: If width has not been set, border bottom will not be displayed", array(), array("col_width" => 3));
            $border_bottom_title_area_container->addChild("border_bottom_title_area_width",$border_bottom_title_area_width);
			$border_bottom_title_area_color = new EdgeField("color","border_bottom_title_area_color","","Bottom Border Color","Choose a color for Title Area bottom border");
			$border_bottom_title_area_container->addChild("border_bottom_title_area_color",$border_bottom_title_area_color);
			$border_bottom_title_area_style = new EdgeField("select","border_bottom_title_area_style","","Bottom Border Style","This is some description",array(
				""	=> "",
				"solid" => "Solid",
				"dashed" => "Dashed",
				"dotted" => "Dotted"
				));
			$border_bottom_title_area_container->addChild("border_bottom_title_area_style",$border_bottom_title_area_style);
			

		$enable_breadcrumbs = new EdgeField("yesno","enable_breadcrumbs","no","Enable Breadcrumbs","This option will display Breadcrumbs in Title Area", array(), array('dependence' => true, 'dependence_hide_on_yes' => '', 'dependence_show_on_yes' => '#edgtf_animation_page_title_breadcrumbs_container'));
		$enable_title_container->addChild("enable_breadcrumbs",$enable_breadcrumbs);

		$title_graphics = new EdgeField("image","title_graphics","","Graphics","Choose graphics");
		$title_standard_container->addChild("title_graphics",$title_graphics);

		$group1 = new EdgeGroup("Title Area Content Style",'Define style for Title Area Content');
        $enable_title_container->addChild("group1",$group1);

        	$row1 = new EdgeRow();
        	$group1->addChild("row1",$row1);

				$title_content_background_color = new EdgeField("colorsimple","title_content_background_color","","Title Content Background Color","Background color for title content");
				$row1->addChild("title_content_background_color",$title_content_background_color);

				$title_content_background_opacity = new EdgeField("textsimple","title_content_background_opacity","","Title Content Background Opacity","Choose opacity for background color (0 = fully transparent, 1 = opaque)");
				$row1->addChild("title_content_background_opacity",$title_content_background_opacity);

		$group2 = new EdgeGroup("Title Style",'Define style for Title');
        $enable_title_container->addChild("group2",$group2);

        	$row1 = new EdgeRow();
        	$group2->addChild("row1",$row1);

				$title_span_background_color = new EdgeField("colorsimple","title_span_background_color","","Title Background Color","Background color for title");
				$row1->addChild("title_span_background_color",$title_span_background_color);

				$title_span_background_opacity = new EdgeField("textsimple","title_span_background_opacity","","Title Background Opacity","Choose opacity for background color (0 = fully transparent, 1 = opaque)");
				$row1->addChild("title_span_background_opacity",$title_span_background_opacity);

		$group3 = new EdgeGroup("Title Padding",'Define padding for Title');
		$enable_title_container->addChild("group3",$group3);

			$row1 = new EdgeRow();
			$group3->addChild("row1",$row1);

				$title_span_top_padding = new EdgeField("textsimple","title_span_top_padding","","Top Padding","This is some description.");
				$row1->addChild("title_span_top_padding",$title_span_top_padding);

				$title_span_right_padding = new EdgeField("textsimple","title_span_right_padding","","Right Padding","This is some description.");
				$row1->addChild("title_span_right_padding",$title_span_right_padding);

				$title_span_bottom_padding = new EdgeField("textsimple","title_span_bottom_padding","","Bottom Padding","This is some description.");
				$row1->addChild("title_span_bottom_padding",$title_span_bottom_padding);

				$title_span_left_padding = new EdgeField("textsimple","title_span_left_padding","","Left Padding","This is some description.");
				$row1->addChild("title_span_left_padding",$title_span_left_padding);

		$subtitle_position = new EdgeField("select","subtitle_position","below_title","Subtitle Position","Choose a Subtitle position", array( 
				"below_title" => "Below Title",
				"above_title" => "Above Title",
				"next_to_title" => "Next to Title"
		));
		$enable_title_container->addChild("subtitle_position",$subtitle_position);

		$group4 = new EdgeGroup("Subtitle Style",'Define style for subtitle');
        $enable_title_container->addChild("group4",$group4);

        	$row1 = new EdgeRow();
        	$group4->addChild("row1",$row1);

				$subtitle_span_background_color = new EdgeField("colorsimple","subtitle_span_background_color","","Subtitle Background Color","Background color for subtitle");
				$row1->addChild("subtitle_span_background_color",$subtitle_span_background_color);

				$subtitle_span_background_opacity = new EdgeField("textsimple","subtitle_span_background_opacity","","Subtitle Background Opacity","Choose opacity for background color (0 = fully transparent, 1 = opaque)");
				$row1->addChild("subtitle_span_background_opacity",$subtitle_span_background_opacity);

		$group5 = new EdgeGroup("Subtitle Padding",'Define padding for subtitle');
		$enable_title_container->addChild("group5",$group5);

			$row1 = new EdgeRow();
			$group5->addChild("row1",$row1);

				$subtitle_span_top_padding = new EdgeField("textsimple","subtitle_span_top_padding","","Top Padding","This is some description.");
				$row1->addChild("subtitle_span_top_padding",$subtitle_span_top_padding);

				$subtitle_span_right_padding = new EdgeField("textsimple","subtitle_span_right_padding","","Right Padding","This is some description.");
				$row1->addChild("subtitle_span_right_padding",$subtitle_span_right_padding);

				$subtitle_span_bottom_padding = new EdgeField("textsimple","subtitle_span_bottom_padding","","Bottom Padding","This is some description.");
				$row1->addChild("subtitle_span_bottom_padding",$subtitle_span_bottom_padding);

				$subtitle_span_left_padding = new EdgeField("textsimple","subtitle_span_left_padding","","Left Padding","This is some description.");
				$row1->addChild("subtitle_span_left_padding",$subtitle_span_left_padding);