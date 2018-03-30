<?php

function the_pb_parser($modules)
{
    global $lineWidth;
    if (!is_array($modules)) {$modules=array();}

    if (count($modules)>0) {echo "<div class='row-fluid'>";}

    foreach ($modules as $module_key => $module) {

        #GET SIZE
        if ($module['size'] == "block_1_4") {
            $outputClass = "span3";
        }
        if ($module['size'] == "block_1_3") {
            $outputClass = "span4";
        }
        if ($module['size'] == "block_1_2") {
            $outputClass = "span6";
        }
        if ($module['size'] == "block_2_3") {
            $outputClass = "span8";
        }
        if ($module['size'] == "block_3_4") {
            $outputClass = "span9";
        }
        if ($module['size'] == "block_1_1") {
            $outputClass = "span12";
        }

        #open main module container
        echo "<div class='{$outputClass} module_cont {$module['padding_bottom']} module_{$module['name']}'>";

        ################################################################################################
        #######################################            #############################################
        ####################################### CASE START #############################################
        #######################################            #############################################
        ################################################################################################
        switch ($module['name']) {

            #NEW MODULE
            case "title":
                echo do_shortcode("[title heading_color='".$module["heading_color"]."' heading_size='".$module["heading_size"]."']".$module["heading_text"]."[/title]");
                break;
            #BREAK

            #NEW MODULE
            case "text_area":
                echo do_shortcode("[textarea
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                ]".$module["text"]."[/textarea]");
                break;
            #BREAK

            #NEW MODULE
            case "html":
                echo do_shortcode("[textarea
                    heading_color='".$module["heading_color"]."'
                    heading_size='".$module["heading_size"]."'
                    heading_text=\"".$module["heading_text"]."\"
                    module='html'
                    ]".$module["html"]."[/textarea]");
                break;
            #BREAK

            #NEW MODULE
            case "layer_slider":
                #heading
                if (strlen($module['heading_color'])>0) {$custom_color = "color:#{$module['heading_color']};";} else {$custom_color = "";}
                if (strlen($module['heading_text'])>0) {
                    echo "<".$module['heading_size']." style='".$custom_color."' class='headInModule'>{$module['heading_text']}</".$module['heading_size'].">";
                }
                echo "<div class='module_content'>".do_shortcode("[layerslider id='".$module["show_slider_id"]."']")."</div>";
                break;
            #BREAK

            #NEW MODULE
            case "content":
                #heading
                if (strlen($module['heading_color'])>0) {$custom_color = "color:#{$module['heading_color']};";} else {$custom_color = "";}
                if (strlen($module['heading_text'])>0) {
                    echo "<".$module['heading_size']." style='".$custom_color."' class='headInModule'>{$module['heading_text']}</".$module['heading_size'].">";
                }
                echo "<div class='module_content'>";
                echo the_content(((get_theme_option("translator_status") == "enable") ? get_text("read_more_link") : __('Read more...','theme_localization')));
                echo "</div>";
                global $contentAlreadyPrinted;
                $contentAlreadyPrinted = true;
                break;
            #BREAK

            #NEW MODULE
            case "google_map":
                echo do_shortcode("[textarea
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                ]".$module["map"]."[/textarea]");
                break;
            #BREAK

            #NEW MODULE
            case "social_share":
                echo do_shortcode("[social_share
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                ][/social_share]");
                break;
            #BREAK

            #NEW MODULE
            case "postinfo":
                echo do_shortcode("[postinfo
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                proj_option_title1='".$module["project_option_title_1"]."'
                proj_option_desc1='".$module["project_option_description_1"]."'
                proj_option_title2='".$module["project_option_title_2"]."'
                proj_option_desc2='".$module["project_option_description_2"]."'
                show_categories='".$module["show_categories"]."'
                project_date='".$module["project_date"]."'
                project_time_spent='".$module["project_time_spent"]."'
                show_share_buttons='".$module["show_share_buttons"]."'
                view_type='".$module["view_type"]."'
                ][/postinfo]");
                break;
            #BREAK

            #NEW MODULE
            case "testimonial":
                echo do_shortcode("[testimonials
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                number_of_testimonials='".$module["number_of_testimonials"]."'
                sorting_type='".$module["sorting_type"]."'
                display_type='".(isset($module["display_type"]) ? $module["display_type"] : '')."'
                ][/testimonials]");
                break;
            #BREAK

            #NEW MODULE
            case "video":
                echo do_shortcode("[video
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                w='100%'
                h='".$module["video_height"]."'
                video_url='".$module["video_url"]."'
                ][/video]");
                break;
            #BREAK

            #NEW MODULE
            case "divider":
                #divider_type='".$module["divider_type"]."'
                echo do_shortcode("[divider
                divider_color='".$module["divider_color"]."'

                ][/divider]");
                break;
            #BREAK

            #NEW MODULE
            case "gallery":
                echo do_shortcode("[show_gallery
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                galleryid='".$module["selected_gallery"]."'
                width='".$module["image_width"]."'
                height='".$module["image_height"]."'
                ][/show_gallery]");
                break;
            #BREAK

            #NEW MODULE
            case "tabs":
                if (!isset($tabcompile)) {$tabcompile='';}
                if (is_array($module["module_items"])) {
                    foreach ($module["module_items"] as $tabkey => $tab) {
                        $tabcompile .= "[tab title='".$tab['title']."' expanded_state='".$tab['expanded_state']."']".$tab['description']."[/tab]";
                    }
                }
                echo do_shortcode("[tabs
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                divider_color='".(isset($module["divider_color"]) ? $module["divider_color"] : '')."'
                divider_type='".(isset($module["divider_type"]) ? $module["divider_type"] : '')."'
                ]".$tabcompile."[/tabs]");
                unset($tabcompile);
                break;
            #BREAK

            #NEW MODULE
            case "custom_list":
                if (!isset($licompile)) {$licompile='';}
                if (is_array($module["module_items"])) {
                    foreach ($module["module_items"] as $listkey => $list_item) {
                        $licompile .= "[li]".$list_item['text']."[/li]";
                    }
                }
                echo do_shortcode("[list
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                type='".$module["list_type"]."'
                ]".$licompile."[/list]");
                unset($licompile);
                break;
            #BREAK

            #NEW MODULE
            case "feedback_form":
                echo do_shortcode("[feedback_form
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                ][/feedback_form]");
                break;
            #BREAK

            #NEW MODULE
            case "team":
                echo do_shortcode("[ourteam
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                posts_per_line='".$module["posts_per_line"]."'
                number_of_workers='".$module["number_of_workers"]."'][/ourteam]");
                break;
            #BREAK

            #NEW MODULE
            case "feature_posts":
                echo do_shortcode("[feature_posts
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                number_of_posts='".$module["number_of_posts"]."'
                posts_per_line='".$module["posts_per_line"]."'
                sorting_type='".$module["sorting_type"]."'
                post_type='".$module["post_type"]."'][/feature_posts]");
                break;
            #BREAK

            #NEW MODULE
            case "promo_text":
                echo do_shortcode("[promo_text
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                main_text='".$module["main_text"]."'
                button_text='".$module["button_text"]."'
                button_link='".$module["button_link"]."'
                additional_text='".$module["additional_text"]."'][/promo_text]");
                break;
            #BREAK

            #NEW MODULE
            case "iconboxes":
                echo do_shortcode("[iconbox
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                icon_type='".$module["icon_type"]."'
                iconbox_heading='".$module["iconbox_heading"]."'
                ]".$module["iconbox_text"]."[/iconbox]");
                break;
            #BREAK

            #NEW MODULE
            case "messageboxes":
                #messagebox_heading='".$module["messagebox_heading"]."'
                echo do_shortcode("[messagebox
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"

                box_type='".$module["box_type"]."'
                ]".$module["messagebox_text"]."[/messagebox]");
                break;
            #BREAK

            #NEW MODULE
            case "blockquote":
                echo do_shortcode("[blockquote
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                quote_type='".$module["quote_type"]."'
                author_name='".$module["author_name"]."'
                ]".$module["quote_text"]."[/blockquote]");
                break;
            #BREAK

            #NEW MODULE
            case "accordion":

                if (!isset($accompile)) {$accompile='';}

                if (is_array($module["module_items"])) {
                    foreach ($module["module_items"] as $acckey => $acc_item) {
                        $accompile .= "[accordion_item title='".$acc_item['title']."' expanded_state='".$acc_item['expanded_state']."']".$acc_item['description']."[/accordion_item]";
                    }
                }
                echo do_shortcode("[accordion_shortcode
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                ]".$accompile."[/accordion_shortcode]");
                unset($accompile);
                break;
            #BREAK

            #NEW MODULE
            case "price_table":

                if (!isset($tempcompile)) {$tempcompile='';}

                if (isset($module["module_items"]) && is_array($module["module_items"])) {
                    $price_items_number = count($module["module_items"]);
                    $thiswidth = 100/$price_items_number;
                    foreach ($module["module_items"] as $key => $thisitem) {

                        if (isset($thisitem['price_features']) && is_array($thisitem['price_features'])) {
                            $price_features = implode("||-||", $thisitem['price_features']);
                        } else {
                            $price_features = '';
                        }

                        $tempcompile .= "[pricetable_item block_name='".$thisitem['block_name']."' block_price='".$thisitem['block_price']."' block_period='".$thisitem['block_period']."' price_features='".$price_features."' block_link='".$thisitem['block_link']."' get_it_now_caption='".$thisitem['get_it_now_caption']."' most_popular='".$thisitem['most_popular']."' width='".$thiswidth."'][/pricetable_item]";
                    }
                }
                echo do_shortcode("[pricetable
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                price_items_number='".$price_items_number."'
                ]".$tempcompile."[/pricetable]");
                unset($tempcompile, $price_features);
                break;
            #BREAK

            #NEW MODULE
            case "toggle":

                if (!isset($toggompile)) {$toggompile='';}

                if (is_array($module["module_items"])) {
                    foreach ($module["module_items"] as $togglekey => $togg_item) {
                        $toggompile .= "[toggles_item title='".$togg_item['title']."' expanded_state='".$togg_item['expanded_state']."']".$togg_item['description']."[/toggles_item]";
                    }
                }
                echo do_shortcode("[toggles_shortcode
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                ]".$toggompile."[/toggles_shortcode]");
                unset($toggompile);
                break;
            #BREAK

            #NEW MODULE
            case "blog":
                echo do_shortcode("[blog
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                posts_per_page='".$module["posts_per_page"]."'
                category='".$module["category"]."'
                ][/blog]");
                break;
            #BREAK

            #NEW MODULE
            case "diagramm":

                if (!isset($diagcompile)) {$diagcompile='';}

                if (isset($module["module_items"]) && is_array($module["module_items"])) {
                    foreach ($module["module_items"] as $diagkey => $diag_item) {
                        $diagcompile .= "[diagramm_item percent='".$diag_item['percent']."']".$diag_item['title']."[/diagramm_item]";
                    }
                }
                echo do_shortcode("[diagramm
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                ]".$diagcompile."[/diagramm]");
                unset($diagcompile);
                break;
            #BREAK

            #NEW MODULE
            case "portfolio":
                echo do_shortcode("[portfolio
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                items_on_start='".$module["items_on_start"]."'
                items_per_click='".$module["items_per_click"]."'
                view_type='".$module["view_type"]."'
                ajax='".(isset($module["ajax"]) ? $module["ajax"] : "on")."'
                filter='".(isset($module["filter"]) ? $module["filter"] : "on")."'
                category='".$module["category"]."'
                ][/portfolio]");
                break;
            #BREAK

            #NEW MODULE
            case "partners":
                echo do_shortcode("[partners
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                number='".$module["number"]."'
                ][/partners]");
                break;
            #BREAK

            #NEW MODULE
            case "contact_info":
                echo do_shortcode("[contacts
                heading_color='".$module["heading_color"]."'
                heading_size='".$module["heading_size"]."'
                heading_text=\"".$module["heading_text"]."\"
                address='".$module["address"]."'
                phone='".$module["phone"]."'
                email='".$module["email"]."'
                flickr='".$module["flickr"]."'
                skype='".$module["skype"]."'
                facebook='".$module["facebook"]."'
                twitter='".$module["twitter"]."'
                youtube='".$module["youtube"]."'
                dribbble='".$module["dribbble"]."'
                ][/contacts]");
                break;
            #BREAK


        }
        ################################################################################################
        ########################################          ##############################################
        ######################################## CASE END ##############################################
        ########################################          ##############################################
        ################################################################################################

        #Close main module container
        echo "</div>";

        #add clear block
        if ($module['size'] == "block_1_4") {
            $lineWidth += 1/4;
        }
        if ($module['size'] == "block_1_3") {
            $lineWidth += 1/3;
        }
        if ($module['size'] == "block_1_2") {
            $lineWidth += 1/2;
        }
        if ($module['size'] == "block_2_3") {
            $lineWidth += 2/3;
        }
        if ($module['size'] == "block_3_4") {
            $lineWidth += 3/4;
        }
        if ($module['size'] == "block_1_1") {
            $lineWidth += 1;
        }

        #ECHO CLEAR IF ITS A NEW LINE
        if ($lineWidth >= 1) {
            echo "</div><div class='row-fluid'>";
            $lineWidth = 0;
        }

    }
    if (count($modules)>0) {echo "</div>";}
}

?>