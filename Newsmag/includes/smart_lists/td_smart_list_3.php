<?php


class td_smart_list_3 extends td_smart_list {
    //holds the unique id of current smart list slide
    private $smart_list_tip_3_unique_id;

    //holds the code for the slide controls (Prev and Next)
    private $slide_controls;

    //holds the title between controls
    private $smart_list_3_title_between_controls;

    private $nr_slide_on_smart_list = 0;


    function render_table_of_contents_before($item_id_2_item_array) {
        $buffy = '';

        return $buffy;
    }

    function render_before_list_wrap() {
        $buffy = '';

        if(td_global::$cur_single_template_sidebar_pos == 'no_sidebar') {
            $td_class_nr_of_columns = ' td-3-columns ';
        } else {
            $td_class_nr_of_columns = ' td-2-columns ';
        }

        //the controls
        $this->slide_controls = '<i class = "td-icon-left doubleSliderPrevButton"><span class="td-sml3-control-text">' . __td('Prev') . '</span></i><i class = "td-icon-right doubleSliderNextButton"><span class="td-sml3-control-text">' . __td('Next') . '</span></i>';

        //generate unique gallery slider id
        $this->smart_list_tip_3_unique_id = 'smart_list_tip3_' . td_global::td_generate_unique_id();



        //wrapper with id for smart list wrapper type 3
        $buffy .= '<div class="td_smart_list_3 ' . $td_class_nr_of_columns . '">';

            //top controls
            $buffy .= '<div class="td-sml3-top-controls">' . $this->slide_controls . '</div>';

            //beginning of the slider
            $buffy .= '<div class="td-iosSlider td-smart-list-slider" id="' . $this->smart_list_tip_3_unique_id. '">';
                $buffy .= '<div class = "td-slider">';


        return $buffy;
    }


    function render_list_item($item_array, $current_item_id, $current_item_number, $total_items_number) {
        //print_r($item_array);
        $buffy = '';

        //checking the width of the tile
        $smart_list_3_title = '';
        if(!empty($item_array['title'])) {
            //if we need to cut the title to a certain length, for top and bottom titles
            if(mb_strlen($item_array['title'], 'UTF-8') > 59) {
                $this->smart_list_3_title_between_controls = mb_substr($item_array['title'], 0, 59, 'UTF-8' ) . '...';
            } else {
                $this->smart_list_3_title_between_controls = $item_array['title'];
            }

            //if there are more then 28 chars, add `td-vertical-align-top` class for the main title in the slide
            $class_verticle_align_top = '';
            if(mb_strlen($item_array['title'], 'UTF-8') > 28) {
                $class_verticle_align_top = 'td-vertical-align-top';
            }
            //converting single and double quotes
            //we do this twice because if we check the converted (with htmlentities) string the title will be longer because the tags and quotes will become `&lt;`, `&quot;`, etc
            $smart_list_3_title = $item_array['title'];
        }


        //creating each slide
        $buffy .= '<div class="td-item" id="' . $this->smart_list_tip_3_unique_id . '_item_' . $current_item_id . '">';
            $buffy .= '<div class="td-sml3-top-title"></div>';

        //get image info
        $first_img_all_info = td_util::attachment_get_full_info($item_array['first_img_id']);

        //image caption
        $first_img_caption = $item_array['first_img_caption'];

        $first_img_info = wp_get_attachment_image_src($item_array['first_img_id'], 'td_300x350');


            //image and caption
            $buffy_image = '';
            if (!empty($first_img_info[0])) {

                //retina image
                $srcset_sizes = td_util::get_srcset_sizes($item_array['first_img_id'], 'td_300x350', '300', $first_img_info[0]);

                // class used by magnific popup
                $smart_list_lightbox = " td-lightbox-enabled";

                // if a custom link is set use it
                if (!empty($item_array['first_img_link']) && $first_img_all_info['src'] != $item_array['first_img_link']) {
                    $first_img_all_info['src'] = $item_array['first_img_link'];

                    // remove the magnific popup class for custom links
                    $smart_list_lightbox = "";
                }

                $buffy_image = '
                           <figure class="td-sml3-display-image td-slide-smart-list-figure' . $smart_list_lightbox . '">
                                <a class="td-sml3-link-to-image" href="' . $first_img_all_info['src'] . '" id="td-sml3-slide_' . $this->nr_slide_on_smart_list . '" data-caption="' . esc_attr($first_img_caption, ENT_QUOTES) . '" >
                                    <img src="' . $first_img_info[0] . '"' . $srcset_sizes . '/>
                                </a>
                                <figcaption class="td-sml3-caption"><div>' . $first_img_caption . '</div></figcaption>
                           </figure>';
            }

            //adding description
            $temp_description = '';
            if(!empty($item_array['description'])) {

                //adding the title to the description; description comes between <p> and </p>, so we need to insert the title after first <p>
                $temp_description = substr($item_array['description'], 3);
                $temp_description = '<div class="td-number-and-title"><h2><span class="td-sml3-current-item-nr">' . $current_item_number. '</span><span class="td-sml3-current-item-title ' . $class_verticle_align_top . '"><span class="td-mobile-nr">' . $current_item_number. '</span> ' . $smart_list_3_title . '</span></h2></div>' . $temp_description;

                $buffy .= '<div class="td-sml3-description">' . $buffy_image . $temp_description . '</div>';

                //bottom title
                $buffy .= '<div class="td-sml3-bottom-title">' . $current_item_number . '. ' . $this->smart_list_3_title_between_controls . '</div>';
            }


        $buffy .= '</div>';

        $this->nr_slide_on_smart_list++;

        return $buffy;

    }


    function render_after_list_wrap() {
        $buffy = '';

                $buffy .= '</div>';
            $buffy .= '</div>'; // end ios slider
            $buffy .= '<div class="td-sml3-bottom-controls">' . $this->slide_controls . '</div>';//bottom controls
        $buffy .= '</div>'; //.td_smart_list_3  wrapper with id



        // @todo fix the moving from left to right from the controls, now the slide only works from right to left,
        td_js_buffer::add_to_footer('
jQuery(document).ready(function() {
    jQuery("#' . $this->smart_list_tip_3_unique_id . '").iosSlider({
        snapToChildren: true,
        desktopClickDrag: true,
        keyboardControls: false,
        infiniteSlider: true,
        navPrevSelector: jQuery(".td_smart_list_3 .doubleSliderPrevButton"),
        navNextSelector: jQuery(".td_smart_list_3 .doubleSliderNextButton"),
        startAtSlide:td_history.get_current_page("slide"),
        onSliderLoaded : td_resize_smartlist_slides,
		onSliderResize : td_resize_smartlist_sliders_and_update,
		onSlideChange : td_resize_smartlist_slides,
		onSlideComplete : td_history.slide_changed_callback
    });


    // add current page history
    td_history.replace_history_entry({current_slide:td_history.get_current_page("slide"), slide_id:"' . $this->smart_list_tip_3_unique_id . '"});

});
    ');

        return $buffy;
    }
}