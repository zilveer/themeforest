<?php

global $qodeIconCollections;
$titlePage = new QodeAdminPage("4", "Title", "fa fa-list-alt");
$qodeFramework->qodeOptions->addAdminPage("title",$titlePage);

$panel8 = new QodePanel("Title","title_panel");
$titlePage->addChild("panel8",$panel8);

	$show_page_title = new QodeField("yesno","show_page_title","yes","Enable Page Title Area","This option will enable Title Area", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_enable_title_container"));
	$panel8->addChild("show_page_title",$show_page_title);

	$enable_title_container = new QodeContainer("enable_title_container","show_page_title","no");
	$panel8->addChild("enable_title_container",$enable_title_container);

		$title_type = new QodeField("select","title_type","standard_title","Title Type","Choose title type", array( 
				"standard_title" => "Standard",
				"breadcrumbs_title" => "Breadcrumb"
		      ),array(
		      	"dependence" => true,
		      	"hide" => array("breadcrumbs_title" => "#qodef_title_standard_container"),
		      	"show" => array("standard_title" => "#qodef_title_standard_container")
		      ));
		$enable_title_container->addChild("title_type",$title_type);

		$animate_title_area = new QodeField("select","animate_title_area","no","Animations","Choose an animation for Title Area", array( 
			"no" => "No animation",
			"text_right_left" => "Text right to left",
			"area_top_bottom" => "Title area top to bottom"
	      ));
		$enable_title_container->addChild("animate_title_area",$animate_title_area);
		
		$page_title_vertical_aligment = new QodeField("select","page_title_vertical_aligment","header_bottom","Vertical Alignment","Specify Title vertical alignment", array( 
						"header_bottom" => "From Bottom of Header",
						"window_top" => "From Window Top"
					  ));
		$enable_title_container->addChild("page_title_vertical_aligment",$page_title_vertical_aligment);
		
		$show_page_title_text = new QodeField("yesno","show_page_title_text","yes","Enable Page Title Text","This option will enable Title Text", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_enable_title_text_container, #qodef_animation_page_title_contaier"));
		$enable_title_container->addChild("show_page_title_text",$show_page_title_text);

			$enable_title_text_container = new QodeContainer("enable_title_text_container","show_page_title_text","no");
			$enable_title_container->addChild("enable_title_text_container",$enable_title_text_container);
		
		
				$page_title_position = new QodeField("select","page_title_position","left","Title Text Alignment","Specify Title text alignment", array( 
						"left" => "Left",
						"center" => "Center",
						"right" => "Right"
					  ));
				$enable_title_text_container->addChild("page_title_position",$page_title_position);
				
				$title_text_shadow = new QodeField("yesno","title_text_shadow","no","Title Text Shadow","Enabling this option will give Title text a shadow");
				$enable_title_text_container->addChild("title_text_shadow",$title_text_shadow);
		

		$title_standard_container = new QodeContainer("title_standard_container","title_type","breadcrumbs_title");
		$enable_title_container->addChild("title_standard_container",$title_standard_container);

		//Title like separator with text
		$title_like_separator = new QodeField("yesno","title_like_separator","no","Separator Around Title Text","Enable separator around title", array(), array(
			"dependence" => true,
			"dependence_hide_on_yes" => "",
			"dependence_show_on_yes" => "#qodef_title_like_separator_container"
			));
		$title_standard_container->addChild("title_like_separator",$title_like_separator);

			$title_like_separator_container = new QodeContainer("title_like_separator_container","title_like_separator","no");
			$title_standard_container->addChild("title_like_separator_container",$title_like_separator_container);

				$group1 = new QodeGroup("Line Styles", "Choose style for separator line");
				$title_like_separator_container->addChild("group1",$group1);

					$row1 = new QodeRow();
					$group1->addChild("row1",$row1);

						$title_like_separator_line_color = new QodeField("colorsimple","title_like_separator_line_color","","Color","This is some description");
						$row1->addChild("title_like_separator_line_color",$title_like_separator_line_color);

						$title_like_separator_line_width = new QodeField("textsimple","title_like_separator_line_width","","Width","This is some description");
						$row1->addChild("title_like_separator_line_width",$title_like_separator_line_width);

						$title_like_separator_line_thickness = new QodeField("textsimple","title_like_separator_line_thickness","","Thickness","This is some description");
						$row1->addChild("title_like_separator_line_thickness",$title_like_separator_line_thickness);

						$title_like_separator_line_style = new QodeField("selectsimple","title_like_separator_line_style","","Style","This is some description",array(
							"solid" => "Solid",
							"dashed" => "Dashed",
							"dotted" => "Dotted"
							));
						$row1->addChild("title_like_separator_line_style",$title_like_separator_line_style);

				$title_like_separator_margins = new QodeField("text","title_like_separator_margins","","Margins for Title","Define left/right margins for title from separator");
				$title_like_separator_container->addChild("title_like_separator_margins",$title_like_separator_margins);

				$title_like_separator_line_dots = new QodeField("yesno","title_like_separator_line_dots","no","Dots on The End of Lines","Enabling this option will give lines a dot next to title",array(),array(
						"dependence" => true,
						"dependence_hide_on_yes" => "",
						"dependence_show_on_yes" => "#qodef_title_like_separator_dots_container"
					));
				$title_like_separator_container->addChild("title_like_separator_line_dots",$title_like_separator_line_dots);

				$title_like_separator_dots_container = new QodeContainer("title_like_separator_dots_container","title_like_separator_line_dots","no");
				$title_like_separator_container->addChild("title_like_separator_dots_container",$title_like_separator_dots_container);

					$group1 = new QodeGroup("Dots Style","Choose style for dots");
					$title_like_separator_dots_container->addChild("group1",$group1);

						$row1 = new QodeRow();
						$group1->addChild("row1",$row1);

							$title_like_separator_dots_size = new QodeField("textsimple","title_like_separator_dots_size","","Size (px)","This is some description");
							$row1->addChild("title_like_separator_dots_size",$title_like_separator_dots_size);

							$title_like_separator_dots_color = new QodeField("colorsimple","title_like_separator_dots_color","","Color","This is some description");
							$row1->addChild("title_like_separator_dots_color",$title_like_separator_dots_color);

		//Subtitle like separator with text
		$subtitle_like_separator = new QodeField("yesno","subtitle_like_separator","no","Separator Around Subtitle Text","Enable separator around subtitle", array(), array(
			"dependence" => true,
			"dependence_hide_on_yes" => "",
			"dependence_show_on_yes" => "#qodef_subtitle_like_separator_container"
			));
		$title_standard_container->addChild("subtitle_like_separator",$subtitle_like_separator);

			$subtitle_like_separator_container = new QodeContainer("subtitle_like_separator_container","subtitle_like_separator","no");
			$title_standard_container->addChild("subtitle_like_separator_container",$subtitle_like_separator_container);

				$group1 = new QodeGroup("Line Styles", "Choose style for separator line");
				$subtitle_like_separator_container->addChild("group1",$group1);

					$row1 = new QodeRow();
					$group1->addChild("row1",$row1);

						$subtitle_like_separator_line_color = new QodeField("colorsimple","subtitle_like_separator_line_color","","Color","This is some description");
						$row1->addChild("subtitle_like_separator_line_color",$subtitle_like_separator_line_color);

						$subtitle_like_separator_line_width = new QodeField("textsimple","subtitle_like_separator_line_width","","Width","This is some description");
						$row1->addChild("subtitle_like_separator_line_width",$subtitle_like_separator_line_width);

						$subtitle_like_separator_line_thickness = new QodeField("textsimple","subtitle_like_separator_line_thickness","","Thickness","This is some description");
						$row1->addChild("subtitle_like_separator_line_thickness",$subtitle_like_separator_line_thickness);

						$subtitle_like_separator_line_style = new QodeField("selectsimple","subtitle_like_separator_line_style","","Style","This is some description",array(
							"solid" => "Solid",
							"dashed" => "Dashed",
							"dotted" => "Dotted"
							));
						$row1->addChild("subtitle_like_separator_line_style",$subtitle_like_separator_line_style);

				$subtitle_like_separator_margins = new QodeField("text","subtitle_like_separator_margins","","Margins for Subtitle","Define left/right margins for subtitle from separator");
				$subtitle_like_separator_container->addChild("subtitle_like_separator_margins",$subtitle_like_separator_margins);


		$title_background_color = new QodeField("color","title_background_color","","Background Color","Choose a background color for Title Area");
		$enable_title_container->addChild("title_background_color",$title_background_color);
		
		$title_image = new QodeField("image","title_image","","Background Image","Choose an Image for Title Area");
		$enable_title_container->addChild("title_image",$title_image);
		
		$responsive_title_image = new QodeField("yesno","responsive_title_image","no","Background Responsive Image","Enabling this option will make Title background image responsive", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_responsive_title_image_container", "dependence_show_on_yes" => ""));
		$enable_title_container->addChild("responsive_title_image",$responsive_title_image);

		$responsive_title_image_container = new QodeContainer("responsive_title_image_container","responsive_title_image","yes");
		$enable_title_container->addChild("responsive_title_image_container",$responsive_title_image_container);
			$fixed_title_image = new QodeField("select","fixed_title_image","no","Parallax Title Image","Enabling this option will make Title image parallax", array( "no" => "No",
			       "yes" => "Yes",
			       "yes_zoom" => "Yes, with zoom out"
			      ));
			$responsive_title_image_container->addChild("fixed_title_image",$fixed_title_image);
			$title_height = new QodeField("text","title_height","","Title Height (px)","Set a height for Title Area in pixels", array(), array("col_width" => 3));
			$responsive_title_image_container->addChild("title_height",$title_height);

		$title_overlay_image = new QodeField("image","title_overlay_image","","Pattern Overlay Image","Choose an image to be used as pattern over Title Area");
		$enable_title_container->addChild("title_overlay_image",$title_overlay_image);
		
		$title_separator = new QodeField("yesno","title_separator","no","Show Title Separator","Enabling this option will display a separator underneath Title", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_title_separator_container, #qodef_animation_page_title_separator_container"));
		$title_standard_container->addChild("title_separator",$title_separator);

		$title_separator_container = new QodeContainer("title_separator_container","title_separator","no");
		$title_standard_container->addChild("title_separator_container",$title_separator_container);

		        $title_separator_format = new QodeField("select","title_separator_format","normal","Format","Choose a format (type) of separator", array(
                        "normal" => "Normal",
                        "with_icon" => "With Icon",
                        "with_custom_icon" => "With Custom Icon"
                ), array(
                "dependence" => true,
                "hide" => array(
                	"normal" => "#qodef_separator_with_icon_container, #qodef_separator_custom_icon_container, #qodef_separator_all_icons_container",
                	"with_custom_icon" => "#qodef_separator_with_icon_container",
                	"with_icon" => "#qodef_separator_custom_icon_container"
                	),
                "show" => array(
                	"with_icon" => "#qodef_separator_with_icon_container, #qodef_separator_all_icons_container",
                	"with_custom_icon" => "#qodef_separator_custom_icon_container, #qodef_separator_all_icons_container"
                	)
                ));

                $title_separator_container->addChild("title_separator_format",$title_separator_format);

                $separator_all_icons_container = new QodeContainer("separator_all_icons_container","title_separator_format","normal");
				$title_separator_container->addChild("separator_all_icons_container",$separator_all_icons_container);	

					$group1 = new QodeGroup("Icon Position and Margins","Choose icon position and set left(right) margin");
					$separator_all_icons_container->addChild("group1",$group1);

						$row1 = new QodeRow();
						$group1->addChild("row1",$row1);

							$title_separator_icon_position = new QodeField("selectsimple","title_separator_icon_position","","Icon Position","Choose a position for an icon", array(
		                        "left" => "Left",
		                        "center" => "Center",
		                        "right" => "Right"
		                	));
		                	$row1->addChild("title_separator_icon_position",$title_separator_icon_position);

		                	$title_separator_icon_margins = new QodeField("textsimple","title_separator_icon_margins","","Margins (px)","Enter margin that will refer to left and right margin of the icon");
		                	$row1->addChild("title_separator_icon_margins",$title_separator_icon_margins);

                $separator_with_icon_container = new QodeContainer("separator_with_icon_container","title_separator_format","normal",array("normal","with_custom_icon"));
				$title_separator_container->addChild("separator_with_icon_container",$separator_with_icon_container);

	                 //init icon pack hide and show array. It will be populated dinamically from collections array
					$separator_icon_pack_hide_array = array();
					$separator_icon_pack_show_array = array();

					//do we have some collection added in collections array?
					if(is_array($qodeIconCollections->iconCollections) && count($qodeIconCollections->iconCollections)) {
						//get collections params array. It will contain values of 'param' property for each collection
						$separator_icon_collections_params = $qodeIconCollections->getIconCollectionsParams();

						//foreach collection generate hide and show array
						foreach ($qodeIconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
							$separator_icon_pack_hide_array[$dep_collection_key] = '';

							//we need to include only current collection in show string as it is the only one that needs to show
							$separator_icon_pack_show_array[$dep_collection_key] = '#qodef_separator_icon_'.$dep_collection_object->param.'_container';

							//for all collections param generate hide string
							foreach ($separator_icon_collections_params as $separator_icon_collections_param) {
								//we don't need to include current one, because it needs to be shown, not hidden
								if($separator_icon_collections_param !== $dep_collection_object->param) {
									$separator_icon_pack_hide_array[$dep_collection_key].= '#qodef_separator_icon_'.$separator_icon_collections_param.'_container,';
								}
							}

							//remove remaining ',' character
							$separator_icon_pack_hide_array[$dep_collection_key] = rtrim($separator_icon_pack_hide_array[$dep_collection_key], ',');
						}

					}

					$separator_icon_pack = new QodeField(
						"select",
						"separator_icon_pack",
						"font_awesome",
						"Separator Icon Pack",
						"Choose icon pack for separator",
						$qodeIconCollections->getIconCollections(),
						array(
							"dependence" => true,
							"hide" => $separator_icon_pack_hide_array,
							"show" => $separator_icon_pack_show_array
						));

					$separator_with_icon_container->addChild("separator_icon_pack", $separator_icon_pack);

					if(is_array($qodeIconCollections->iconCollections) && count($qodeIconCollections->iconCollections)) {
						//foreach icon collection we need to generate separate container that will have dependency set
						//it will have one field inside with icons dropdown
						foreach ($qodeIconCollections->iconCollections as $collection_key => $collection_object) {
							$icons_array = $collection_object->getIconsArray();

							//get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
							$icon_collections_keys = $qodeIconCollections->getIconCollectionsKeys();

							//unset current one, because it doesn't have to be included in dependency that hides icon container
							unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

							$separator_icon_hide_values = $icon_collections_keys;
							$separator_icon_container = new QodeContainer("separator_icon_".$collection_object->param."_container", "separator_icon_pack", "", $separator_icon_hide_values);
							$separator_icon = new QodeField("select", "separator_icon_".$collection_object->param, "", "Separator Icon","Choose Separator Icon", $icons_array, array("col_width" => 3));
							$separator_icon_container->addChild("separator_icon_".$collection_object->param, $separator_icon);

							$separator_with_icon_container->addChild("separator_icon_".$collection_object->param."_container", $separator_icon_container);
						}

					}

					$group1 = new QodeGroup("Icon Style", "Choose icon style");
					$separator_with_icon_container->addChild("group1",$group1);

						$row1 = new QodeRow();
						$group1->addChild("row1",$row1);

							$title_separator_icon_color = new QodeField("colorsimple","title_separator_icon_color","","Color","Choose a color of icon for Title separator");
							$row1->addChild("title_separator_icon_color",$title_separator_icon_color);

							$title_separator_icon_hover_color = new QodeField("colorsimple","title_separator_icon_hover_color","","Hover Color","Choose a hover color of icon for Title separator");
							$row1->addChild("title_separator_icon_hover_color",$title_separator_icon_hover_color);

							$title_separator_icon_custom_size = new QodeField("textsimple","title_separator_icon_custom_size","","Icon Size","Choose size of icon");
							$row1->addChild("title_separator_icon_custom_size",$title_separator_icon_custom_size);

                	$title_separator_icon_type = new QodeField("select","title_separator_icon_type","normal","Icon Type","Choose icon type", array(
                        "normal" => "Normal",
                        "circle" => "Circle",
                        "square" => "Square"
                	),array("dependence" => true, "hide" => array("normal" => "#qodef_title_separator_types_container"), "show" => array("circle" => "#qodef_title_separator_types_container","square" => "#qodef_title_separator_types_container")));
                	$separator_with_icon_container->addChild("title_separator_icon_type",$title_separator_icon_type);

                	$title_separator_types_container = new QodeContainer("title_separator_types_container","title_separator_icon_type","normal");
					$separator_with_icon_container->addChild("title_separator_types_container",$title_separator_types_container);

						$group1 = new QodeGroup("Border Style", "Define border style for icon");
						$title_separator_types_container->addChild("group1",$group1);

							$row1 = new QodeRow();
							$group1->addChild("row1",$row1);

								$title_separator_icon_border_radius = new QodeField("textsimple","title_separator_icon_border_radius","","Border Radius (px)","Enter border radius for icon");
		                		$row1->addChild("title_separator_icon_border_radius",$title_separator_icon_border_radius);

		                		$title_separator_icon_border_width = new QodeField("textsimple","title_separator_icon_border_width","","Border Width (px)","Enter border width for icon");
		                		$row1->addChild("title_separator_icon_border_width",$title_separator_icon_border_width);

		                		$title_separator_icon_border_color = new QodeField("colorsimple","title_separator_icon_border_color","","Border Color","Enter border color for icon");
		                		$row1->addChild("title_separator_icon_border_color",$title_separator_icon_border_color);

		                		$title_separator_icon_border_hover_color = new QodeField("colorsimple","title_separator_icon_border_hover_color","","Border Hover Color","Enter border color for icon");
		                		$row1->addChild("title_separator_icon_border_hover_color",$title_separator_icon_border_hover_color);

		                $group2 = new QodeGroup("Additional Icon Style","Choose adition icon styling");
		                $title_separator_types_container->addChild("group2",$group2);

		                	$row1 = new QodeRow();
		                	$group2->addChild("row1",$row1);

		                		$title_separator_icon_shape_size = new QodeField("textsimple","title_separator_icon_shape_size","","Shape Size (px)","This is some description");
		                		$row1->addChild("title_separator_icon_shape_size",$title_separator_icon_shape_size);

		                		$title_separator_icon_background_color = new QodeField("colorsimple","title_separator_icon_background_color","","Background Color","This is some description");
		                		$row1->addChild("title_separator_icon_background_color",$title_separator_icon_background_color);

		                		$title_separator_icon_background_hover_color = new QodeField("colorsimple","title_separator_icon_background_hover_color","","Background Hover Color","This is some description");
		                		$row1->addChild("title_separator_icon_background_hover_color",$title_separator_icon_background_hover_color);		                		
 				

 				$separator_custom_icon_container = new QodeContainer("separator_custom_icon_container","title_separator_format","normal",array("normal","with_icon"));
 				$title_separator_container->addChild("separator_custom_icon_container",$separator_custom_icon_container);

 					$separator_custom_icon = new QodeField("image","separator_custom_icon","","Custom Icon","Choose custom icon for separator");
 					$separator_custom_icon_container->addChild("separator_custom_icon",$separator_custom_icon);

                $title_separator_type = new QodeField("select","title_separator_type","","Type","Choose a Title separator line style", array( "" => "",
                        "solid" => "Solid",
                        "dashed" => "Dashed"
                ));
                $title_separator_container->addChild("title_separator_type",$title_separator_type);

                $title_separator_position = new QodeField("select","title_separator_position","","Position","Choose a Title separator position", array( "" => "",
                        "above" => "Above Title",
                        "below" => "Below Title"
                ));
                $title_separator_container->addChild("title_separator_position",$title_separator_position);

                $title_separator_color = new QodeField("color","title_separator_color","","Color","Choose a color for Title separator");
                $title_separator_container->addChild("title_separator_color",$title_separator_color);

                $group1 = new QodeGroup("Size",'Define size for Title separator');
                $title_separator_container->addChild("group1",$group1);

                $row1 = new QodeRow();
                $group1->addChild("row1",$row1);

                        $title_separator_thickness = new QodeField("textsimple","title_separator_thickness","","Thickness (px)","This is some description");
                        $row1->addChild("title_separator_thickness",$title_separator_thickness);

                        $title_separator_width = new QodeField("textsimple","title_separator_width","","Width (px)","This is some description");
                        $row1->addChild("title_separator_width",$title_separator_width);

                $group2 = new QodeGroup("Margin",'Add space at top and bottom of Title separator');
                $title_separator_container->addChild("group2",$group2);

                $row1 = new QodeRow();
                $group2->addChild("row1",$row1);

                        $title_separator_topmargin = new QodeField("textsimple","title_separator_topmargin","","Top Margin (px)","This is some description");
                        $row1->addChild("title_separator_topmargin",$title_separator_topmargin);

                        $title_separator_bottommargin = new QodeField("textsimple","title_separator_bottommargin","","Bottom Margin (px)","This is some description");
                        $row1->addChild("title_separator_bottommargin",$title_separator_bottommargin);

		$border_bottom_title_area = new QodeField("yesno","border_bottom_title_area","no","Bottom Border","Enabling this option will display bottom border on Title Area", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_border_bottom_title_area_container"));
		$enable_title_container->addChild("border_bottom_title_area",$border_bottom_title_area);
			
			$border_bottom_title_area_container = new QodeContainer("border_bottom_title_area_container","border_bottom_title_area","no");
			$enable_title_container->addChild("border_bottom_title_area_container",$border_bottom_title_area_container);
				
				$enable_title_border_grid = new QodeField("yesno","enable_title_border_grid","no","Enable Border in Grid","This option will show title bottom border in grid", array(), array('dependence' => true, 'dependence_hide_on_yes' => '', 'dependence_show_on_yes' => ''));
				$border_bottom_title_area_container->addChild("enable_title_border_grid",$enable_title_border_grid);
		
				$border_bottom_title_area_width = new QodeField("text","border_bottom_title_area_width","","Bottom Border Width (px)","Choose a width for Title Area bottom border Note: If width has not been set, border bottom will not be displayed", array(), array("col_width" => 3));
				$border_bottom_title_area_container->addChild("border_bottom_title_area_width",$border_bottom_title_area_width);
				$border_bottom_title_area_color = new QodeField("color","border_bottom_title_area_color","","Bottom Border Color","Choose a color for Title Area bottom border");
				$border_bottom_title_area_container->addChild("border_bottom_title_area_color",$border_bottom_title_area_color);
			

		$enable_breadcrumbs = new QodeField("yesno","enable_breadcrumbs","no","Enable Breadcrumbs","This option will display Breadcrumbs in Title Area", array(), array('dependence' => true, 'dependence_hide_on_yes' => '', 'dependence_show_on_yes' => '#qodef_animation_page_title_breadcrumbs_container'));
		$enable_title_container->addChild("enable_breadcrumbs",$enable_breadcrumbs);

		$title_graphics = new QodeField("image","title_graphics","","Graphics","Choose graphics");
		$title_standard_container->addChild("title_graphics",$title_graphics);

		$group1 = new QodeGroup("Title Area Content Style",'Define style for Title Area Content');
        $enable_title_container->addChild("group1",$group1);

        	$row1 = new QodeRow();
        	$group1->addChild("row1",$row1);

				$title_content_background_color = new QodeField("colorsimple","title_content_background_color","","Title Content Background Color","Background color for title content");
				$row1->addChild("title_content_background_color",$title_content_background_color);

				$title_content_background_opacity = new QodeField("textsimple","title_content_background_opacity","","Title Content Background Opacity","Choose opacity for background color (0 = fully transparent, 1 = opaque)");
				$row1->addChild("title_content_background_opacity",$title_content_background_opacity);

		$group2 = new QodeGroup("Title Style",'Define style for Title');
        $enable_title_container->addChild("group2",$group2);

        	$row1 = new QodeRow();
        	$group2->addChild("row1",$row1);

				$title_span_background_color = new QodeField("colorsimple","title_span_background_color","","Title Background Color","Background color for title");
				$row1->addChild("title_span_background_color",$title_span_background_color);

				$title_span_background_opacity = new QodeField("textsimple","title_span_background_opacity","","Title Background Opacity","Choose opacity for background color (0 = fully transparent, 1 = opaque)");
				$row1->addChild("title_span_background_opacity",$title_span_background_opacity);

		$group3 = new QodeGroup("Title Padding",'Define padding for Title');
		$enable_title_container->addChild("group3",$group3);

			$row1 = new QodeRow();
			$group3->addChild("row1",$row1);

				$title_span_top_padding = new QodeField("textsimple","title_span_top_padding","","Top Padding","This is some description.");
				$row1->addChild("title_span_top_padding",$title_span_top_padding);

				$title_span_right_padding = new QodeField("textsimple","title_span_right_padding","","Right Padding","This is some description.");
				$row1->addChild("title_span_right_padding",$title_span_right_padding);

				$title_span_bottom_padding = new QodeField("textsimple","title_span_bottom_padding","","Bottom Padding","This is some description.");
				$row1->addChild("title_span_bottom_padding",$title_span_bottom_padding);

				$title_span_left_padding = new QodeField("textsimple","title_span_left_padding","","Left Padding","This is some description.");
				$row1->addChild("title_span_left_padding",$title_span_left_padding);

		$subtitle_position = new QodeField("select","subtitle_position","below_title","Subtitle Position","Choose a Subtitle position", array( 
				"below_title" => "Below Title",
				"above_title" => "Above Title",
				"next_to_title" => "Next to Title"
		));
		$enable_title_container->addChild("subtitle_position",$subtitle_position);

		$group4 = new QodeGroup("Subtitle Style",'Define style for subtitle');
        $enable_title_container->addChild("group4",$group4);

        	$row1 = new QodeRow();
        	$group4->addChild("row1",$row1);

				$subtitle_span_background_color = new QodeField("colorsimple","subtitle_span_background_color","","Subtitle Background Color","Background color for subtitle");
				$row1->addChild("subtitle_span_background_color",$subtitle_span_background_color);

				$subtitle_span_background_opacity = new QodeField("textsimple","subtitle_span_background_opacity","","Subtitle Background Opacity","Choose opacity for background color (0 = fully transparent, 1 = opaque)");
				$row1->addChild("subtitle_span_background_opacity",$subtitle_span_background_opacity);

		$group5 = new QodeGroup("Subtitle Padding",'Define padding for subtitle');
		$enable_title_container->addChild("group5",$group5);

			$row1 = new QodeRow();
			$group5->addChild("row1",$row1);

				$subtitle_span_top_padding = new QodeField("textsimple","subtitle_span_top_padding","","Top Padding","This is some description.");
				$row1->addChild("subtitle_span_top_padding",$subtitle_span_top_padding);

				$subtitle_span_right_padding = new QodeField("textsimple","subtitle_span_right_padding","","Right Padding","This is some description.");
				$row1->addChild("subtitle_span_right_padding",$subtitle_span_right_padding);

				$subtitle_span_bottom_padding = new QodeField("textsimple","subtitle_span_bottom_padding","","Bottom Padding","This is some description.");
				$row1->addChild("subtitle_span_bottom_padding",$subtitle_span_bottom_padding);

				$subtitle_span_left_padding = new QodeField("textsimple","subtitle_span_left_padding","","Left Padding","This is some description.");
				$row1->addChild("subtitle_span_left_padding",$subtitle_span_left_padding);

$panel9 = new QodePanel('Title Animations', 'title_animations');
$titlePage->addChild('panel9', $panel9);

	//Whole title content animation
	$page_title_whole_content_animations = new QodeField('yesno', 'page_title_whole_content_animations', 'no', 'Enable Whole Title Content Animation', 'This option will enable whole title content animation', array(), array(
		'dependence' => true,
		'dependence_hide_on_yes' => '',
		'dependence_show_on_yes' => '#qodef_page_title_whole_content_animations_container'
	));
	$panel9->addChild('page_title_whole_content_animations', $page_title_whole_content_animations);

	$page_title_whole_content_animations_container = new QodeContainer('page_title_whole_content_animations_container', 'page_title_whole_content_animations', 'no');
	$panel9->addChild('page_title_whole_content_animations_container', $page_title_whole_content_animations_container);

		$page_title_whole_content_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_title_whole_content_animations_container->addChild('page_title_whole_content_animations_data_start', $page_title_whole_content_animations_data_start);

			$row1 = new QodeRow();
			$page_title_whole_content_animations_data_start->addChild('row1', $row1);

				$page_title_whole_content_data_start = new QodeField('textsimple', 'page_title_whole_content_data_start', '', 'Scrollbar Top Distance (px)');
				$row1->addChild('page_title_whole_content_data_start', $page_title_whole_content_data_start);

				$page_title_whole_content_start_custom_style = new QodeField('textareasimple', 'page_title_whole_content_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row1->addChild('page_title_whole_content_start_custom_style', $page_title_whole_content_start_custom_style);

		$page_title_whole_content_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_title_whole_content_animations_container->addChild('page_title_whole_content_animations_data_end', $page_title_whole_content_animations_data_end);

			$row2 = new QodeRow();
			$page_title_whole_content_animations_data_end->addChild('row2', $row2);

				$page_title_whole_content_data_end = new QodeField('textsimple', 'page_title_whole_content_data_end', '', 'Scrollbar Top Distance (px)');
				$row2->addChild('page_title_whole_content_data_end', $page_title_whole_content_data_end);

				$page_title_whole_content_end_custom_style = new QodeField('textareasimple', 'page_title_whole_content_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row2->addChild('page_title_whole_content_end_custom_style', $page_title_whole_content_end_custom_style);

	//Title Animations
	$animation_page_title_contaier = new QodeContainerNoStyle('animation_page_title_contaier', 'show_page_title_text', 'no');
	$panel9->addChild('animation_page_title_contaier', $animation_page_title_contaier);

	$page_title_animations = new QodeField('yesno', 'page_title_animations', 'no', 'Enable Page Title Animations', 'This option will enable Page Title Scroll Animations', array(), array(
		'dependence' => true,
		'dependence_hide_on_yes' => '',
		'dependence_show_on_yes' => '#qodef_page_title_animations_container'
	));
	$animation_page_title_contaier->addChild('page_title_animations', $page_title_animations);

	$page_title_animations_container = new QodeContainer('page_title_animations_container', 'page_title_animations', 'no');
	$animation_page_title_contaier->addChild('page_title_animations_container', $page_title_animations_container);

		$page_title_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_title_animations_container->addChild('page_title_animations_data_start', $page_title_animations_data_start);

		$row1 = new QodeRow();
		$page_title_animations_data_start->addChild('row1', $row1);

			$page_title_data_start = new QodeField('textsimple', 'page_title_data_start', '', 'Scrollbar Top Distance (px)');
			$row1->addChild('page_title_data_start', $page_title_data_start);

			$page_title_start_custom_style = new QodeField('textareasimple', 'page_title_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
			$row1->addChild('page_title_start_custom_style', $page_title_start_custom_style);


		$page_title_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_title_animations_container->addChild('page_title_animations_data_end', $page_title_animations_data_end);

		$row2 = new QodeRow();
		$page_title_animations_data_end->addChild('row2', $row2);

			$page_title_data_end = new QodeField('textsimple', 'page_title_data_end', '', 'Scrollbar Top Distance (px)');
			$row2->addChild('page_title_data_end', $page_title_data_end);

			$page_title_end_custom_style = new QodeField('textareasimple', 'page_title_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
			$row2->addChild('page_title_end_custom_style', $page_title_end_custom_style);

	//Title Separator Animations
	$animation_page_title_separator_container = new QodeContainerNoStyle('animation_page_title_separator_container', 'title_separator', 'no');
	$panel9->addChild('animation_page_title_separator_container', $animation_page_title_separator_container);

	$page_title_separator_animations = new QodeField('yesno', 'page_title_separator_animations', 'no', 'Enable Page Separator Title Animations', 'This option will enable Page Title Separator Scroll Animations', array(), array(
		'dependence' => true,
		'dependence_hide_on_yes' => '',
		'dependence_show_on_yes' => '#qodef_page_title_separator_animations_container'
	));
	$animation_page_title_separator_container->addChild('page_title_separator_animations', $page_title_separator_animations);

	$page_title_separator_animations_container = new QodeContainer('page_title_separator_animations_container', 'page_title_separator_animations', 'no');
	$animation_page_title_separator_container->addChild('page_title_separator_animations_container', $page_title_separator_animations_container);

		$page_title_separator_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_title_separator_animations_container->addChild('page_title_separator_animations_data_start', $page_title_separator_animations_data_start);

		$row1 = new QodeRow();
		$page_title_separator_animations_data_start->addChild('row1', $row1);

			$page_title_separator_data_start = new QodeField('textsimple', 'page_title_separator_data_start', '', 'Scrollbar Top Distance (px)');
			$row1->addChild('page_title_separator_data_start', $page_title_separator_data_start);

			$page_title_separator_start_custom_style = new QodeField('textareasimple', 'page_title_separator_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
			$row1->addChild('page_title_separator_start_custom_style', $page_title_separator_start_custom_style);

		$page_title_separator_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_title_separator_animations_container->addChild('page_title_separator_animations_data_end', $page_title_separator_animations_data_end);

		$row2 = new QodeRow();
		$page_title_separator_animations_data_end->addChild('row2', $row2);

			$page_title_separator_data_end = new QodeField('textsimple', 'page_title_separator_data_end', '', 'Scrollbar Top Distance (px)');
			$row2->addChild('page_title_separator_data_end', $page_title_separator_data_end);

			$page_title_separator_end_custom_style = new QodeField('textareasimple', 'page_title_separator_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
			$row2->addChild('page_title_separator_end_custom_style', $page_title_separator_end_custom_style);

	//Subtitle Animations
	$page_subtitle_animations = new QodeField('yesno', 'page_subtitle_animations', 'no', 'Enable Page Subtitle Animations', 'This option will enable Page Subtitle Scroll Animations', array(), array(
		'dependence' => true,
		'dependence_hide_on_yes' => '',
		'dependence_show_on_yes' => '#qodef_page_subtitle_animations_container'
	));
	$panel9->addChild('page_subtitle_animations', $page_subtitle_animations);

	$page_subtitle_animations_container = new QodeContainer('page_subtitle_animations_container', 'page_subtitle_animations', 'no');
	$panel9->addChild('page_subtitle_animations_container', $page_subtitle_animations_container);

		$page_subtitle_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_subtitle_animations_container->addChild('page_subtitle_animations_data_start', $page_subtitle_animations_data_start);

		$row1 = new QodeRow();
		$page_subtitle_animations_data_start->addChild('row1', $row1);

			$page_subtitle_data_start = new QodeField('textsimple', 'page_subtitle_data_start', '', 'Scrollbar Top Distance (px)');
			$row1->addChild('page_subtitle_data_start', $page_subtitle_data_start);

			$page_subtitle_start_custom_style = new QodeField('textareasimple', 'page_subtitle_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
			$row1->addChild('page_subtitle_start_custom_style', $page_subtitle_start_custom_style);

		$page_subtitle_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_subtitle_animations_container->addChild('page_subtitle_animations_data_end', $page_subtitle_animations_data_end);

		$row2 = new QodeRow();
		$page_subtitle_animations_data_end->addChild('row2', $row2);

			$page_subtitle_data_end = new QodeField('textsimple', 'page_subtitle_data_end', '', 'Scrollbar Top Distance (px)');
			$row2->addChild('page_subtitle_data_end', $page_subtitle_data_end);

			$page_subtitle_end_custom_style = new QodeField('textareasimple', 'page_subtitle_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
			$row2->addChild('page_subtitle_end_custom_style', $page_subtitle_end_custom_style);

	//Graphic Animations
	$page_title_graphic_animations = new QodeField('yesno', 'page_title_graphic_animations', 'no', 'Enable Page Title Graphic Animations', 'This option will enable Page Title Graphic Scroll Animations', array(), array(
		'dependence' => true,
		'dependence_hide_on_yes' => '',
		'dependence_show_on_yes' => '#qodef_page_title_graphic_animations_container'
	));
	$panel9->addChild('page_title_graphic_animations', $page_title_graphic_animations);

	$page_title_graphic_animations_container = new QodeContainer('page_title_graphic_animations_container', 'page_title_graphic_animations', 'no');
	$panel9->addChild('page_title_graphic_animations_container', $page_title_graphic_animations_container);

		$page_title_graphic_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_title_graphic_animations_container->addChild('page_title_graphic_animations_data_start', $page_title_graphic_animations_data_start);

		$row1 = new QodeRow();
		$page_title_graphic_animations_data_start->addChild('row1', $row1);

			$page_title_graphic_data_start = new QodeField('textsimple', 'page_title_graphic_data_start', '', 'Scrollbar Top Distance (px)');
			$row1->addChild('page_title_graphic_data_start', $page_title_graphic_data_start);

			$page_title_graphic_start_custom_style = new QodeField('textareasimple', 'page_title_graphic_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
			$row1->addChild('page_title_graphic_start_custom_style', $page_title_graphic_start_custom_style);

		$page_title_graphic_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_title_graphic_animations_container->addChild('$page_title_graphic_animations_data_end', $page_title_graphic_animations_data_end);

		$row2 = new QodeRow();
		$page_title_graphic_animations_data_end->addChild('row2', $row2);

			$page_title_graphic_data_end = new QodeField('textsimple', 'page_title_graphic_data_end', '', 'Scrollbar Top Distance (px)');
			$row2->addChild('page_title_graphic_data_end', $page_title_graphic_data_end);

			$page_title_graphic_end_custom_style = new QodeField('textareasimple', 'page_title_graphic_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
			$row2->addChild('page_title_graphic_end_custom_style', $page_title_graphic_end_custom_style);

	//Breadcrumb animations
	$animation_page_title_breadcrumbs_container = new QodeContainerNoStyle('animation_page_title_breadcrumbs_container', 'enable_breadcrumbs', 'no');
	$panel9->addChild('animation_page_title_breadcrumbs_container', $animation_page_title_breadcrumbs_container);

	$page_title_breadcrumbs_animations = new QodeField('yesno', 'page_title_breadcrumbs_animations', 'no', 'Enable Page Title Breadcrumbs Animations', 'This option will enable Page Title Breadcrumbs Scroll Animations', array(), array(
		'dependence' => true,
		'dependence_hide_on_yes' => '',
		'dependence_show_on_yes' => '#qodef_page_title_breadcrumbs_animations_container'
	));
	$animation_page_title_breadcrumbs_container->addChild('page_title_breadcrumbs_animations', $page_title_breadcrumbs_animations);

	$page_title_breadcrumbs_animations_container = new QodeContainer('page_title_breadcrumbs_animations_container', 'page_title_breadcrumbs_animations', 'no');
	$animation_page_title_breadcrumbs_container->addChild('page_title_breadcrumbs_animations_container', $page_title_breadcrumbs_animations_container);

		$page_title_breadcrumbs_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_title_breadcrumbs_animations_container->addChild('page_title_breadcrumbs_animations_data_start', $page_title_breadcrumbs_animations_data_start);

		$row1 = new QodeRow();
		$page_title_breadcrumbs_animations_data_start->addChild('row1', $row1);

			$page_title_breadcrumbs_data_start = new QodeField('textsimple', 'page_title_breadcrumbs_data_start', '', 'Scrollbar Top Distance (px)');
			$row1->addChild('page_title_breadcrumbs_data_start', $page_title_breadcrumbs_data_start);

			$page_title_breadcrumbs_start_custom_style = new QodeField('textareasimple', 'page_title_breadcrumbs_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
			$row1->addChild('page_title_breadcrumbs_start_custom_style', $page_title_breadcrumbs_start_custom_style);

	$page_title_breadcrumbs_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
	$page_title_breadcrumbs_animations_container->addChild('page_title_breadcrumbs_animations_data_end', $page_title_breadcrumbs_animations_data_end);

		$row2 = new QodeRow();
		$page_title_breadcrumbs_animations_data_end->addChild('row2', $row2);

			$page_title_breadcrumbs_data_end = new QodeField('textsimple', 'page_title_breadcrumbs_data_end', '', 'Scrollbar Top Distance (px)');
			$row2->addChild('page_title_breadcrumbs_data_end', $page_title_breadcrumbs_data_end);

			$page_title_breadcrumbs_end_custom_style = new QodeField('textareasimple', 'page_title_breadcrumbs_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
			$row2->addChild('page_title_breadcrumbs_end_custom_style', $page_title_breadcrumbs_end_custom_style);