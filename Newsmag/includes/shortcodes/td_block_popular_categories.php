<?php

class td_block_popular_categories extends td_block {


    function render($atts, $content = null){
        parent::render($atts);

        $buffy = '';

        extract(shortcode_atts(
            array(
                'limit' => '6',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'header_color' => ''
            ), $atts));

        $cat_args = array(
            'show_count' => true,
            'orderby' => 'count',
            'hide_empty' => false,
            'order' => 'DESC',
            'number' => $limit + 1,
            'exclude' => get_cat_ID(TD_FEATURED_CAT)
        );


        // exclude categories from the demo
        if (TD_DEPLOY_MODE == 'demo' or TD_DEPLOY_MODE == 'dev') {
            $cat_args['exclude'] = '44,45,46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 110, 152, 153, 154, 155, 156, 157, 158, 159, 160, 161, 162, 163, 164, 165, 166 ' . get_cat_ID(TD_FEATURED_CAT);
        }

        $categories = get_categories($cat_args);

        $buffy .= '<div class="' . $this->get_block_classes(array('widget', 'widget_categories')) . '" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

            $buffy .= $this->get_block_title();

            if (!empty($categories)) {
                $buffy .= '<ul class="td-pb-padding-side">';
                    foreach ($categories as $category) {
                        if (strtolower($category->cat_name) != 'uncategorized') {
                            $buffy .= '<li><a href="' . get_category_link($category->cat_ID) . '">' . $category->name . '<span class="td-cat-no">' . $category->count . '</span></a></li>';
                        }
                    }
                $buffy .= '</ul>';
            }
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

    }
}