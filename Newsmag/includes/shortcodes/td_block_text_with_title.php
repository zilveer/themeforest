<?php

class td_block_text_with_title extends td_block {

    function render($atts, $content = null) {
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query

        $buffy = '';
        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

            $buffy .= $this->get_block_title();
            $buffy .= '<div class="td_mod_wrap td-pb-padding-side">';
                //only run the filter if we have visual composer
                if (function_exists('wpb_js_remove_wpautop')) {
                    $buffy .= wpb_js_remove_wpautop($content);
                } else {
                    $buffy .= $content;   //no visual composer
                }
            $buffy .= '</div>';
        $buffy .= '</div>';

        return $buffy;
    }
}