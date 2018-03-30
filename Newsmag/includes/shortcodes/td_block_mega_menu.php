<?php


/**
 * this short code does not have the map function so it dosn't appear in the mega menu @see td_global_blocks::wpb_map_all
 * Class td_block_mega_menu
 */

class td_block_mega_menu extends td_block {


    function render($atts, $content = null){
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        extract(shortcode_atts(
            array(
                'limit' => 5,
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'show_child_cat' => '',
                'tag_slug' => '',
                'header_color' => ''
            ),$atts));

        $buffy = ''; //output buffer


        //custom categories

        //get subcategories, it returns false if there are no categories
        $get_block_sub_cats = $this->get_mega_menu_subcategories($atts);
        $buffy_categories = '';
        //$td_no_subcats_class = '';
	    $additional_classes = array();
        //we have subcategories
        if ($get_block_sub_cats !== false) {
            $buffy_categories .= '<div class="td_mega_menu_sub_cats">';
            //get the sub category filter for this block
            $buffy_categories .= $get_block_sub_cats;
            $buffy_categories .= '</div>';

        } else {
	        $additional_classes [] = 'td-no-subcats';
        }

        //end custom categories





        //get the js for this block
        $buffy .= $this->get_block_js();

        $buffy .= '<div class="' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';
            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
                //inner content of the block
                $buffy .= $this->inner($this->td_query->posts);
            $buffy .= '</div>';

            //add the categories IF we have some
            $buffy .= $buffy_categories;

            $buffy .= $this->get_block_pagination();
            //get the ajax pagination for this block

            $buffy .= '<div class="clearfix"></div>';

        $buffy .= '</div> <!-- ./block1 -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

        $buffy = '';


        if (!empty($posts)) {

            $buffy .= '<div class="td-mega-row">';

            foreach ($posts as $post) {
                $td_module_mega_menu = new td_module_mega_menu($post);
                $buffy .= '<div class="td-mega-span">';
                    $buffy .= $td_module_mega_menu->render();
                $buffy .= '</div>';
            }

            $buffy .= '</div>';
        }

        return $buffy;
    }


    /**
     * @todo mega menu subcats - folosim functia asta pentru ca e necesar sa avem alt output
     * @return bool|string
     */
    function get_mega_menu_subcategories($atts) {
        extract(shortcode_atts(
            array(
                'limit' => 5,
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'show_child_cat' => '',  //the child category number
                'sub_cat_ajax' => '' //empty we use ajax
            ), $atts ));
        $buffy = '';

        if (!empty($show_child_cat) and !empty($category_id)) {

	        $td_subcategories = get_categories(array(
		        'child_of' => $category_id,
		        'number' => $show_child_cat
	        ));


            if (!empty($td_subcategories)) {

                $buffy .= '<div class="block-mega-child-cats">';

                //show all categories only on ajax
                if (empty($sub_cat_ajax)) {
                    $buffy .= '<a class="cur-sub-cat mega-menu-sub-cat-' . $this->block_uid . '" id="' . td_global::td_generate_unique_id() . '" data-td_block_id="' . $this->block_uid . '" data-td_filter_value="" href="' . get_category_link($category_id) . '">' . __td('All') . '</a>';
                }

                foreach ($td_subcategories as $td_category) {
                    $this->td_block_template_data['td_pull_down_items'][] = array(
                        'name' => $td_category->name,
                        'id' => $td_category->cat_ID
                    );
                    $buffy .= '<a class="mega-menu-sub-cat-' . $this->block_uid . '"  id="' . td_global::td_generate_unique_id() . '" data-td_block_id="' . $this->block_uid . '" data-td_filter_value="' . $td_category->cat_ID . '" href="' . get_category_link($td_category->cat_ID) . '">' . $td_category->name . '</a>';
                }


                $buffy .= '</div>';
            } else {
                //there are no subcategories, return false - this is used by the mega menu block to alter it's structure
                return false;
            }
        }
        return $buffy;
    }
}

