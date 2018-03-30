<?php
if(!function_exists('flow_elated_set_blog_archive_page_padding')) {
    /**
     * Generates styles for footer top
     */
    function flow_elated_set_blog_archive_page_padding() {
		$selector = array(
			'body.archive .eltd-content .eltd-content-inner > .eltd-container > .eltd-container-inner',
			'body.archive .eltd-content .eltd-content-inner > .eltd-full-width > .eltd-full-width-inner'
		);
        $styles = array();

        if(flow_elated_options()->getOptionValue('blog_archive_page_padding')) {
            $styles['padding'] = flow_elated_options()->getOptionValue('blog_archive_page_padding');
        }

        echo flow_elated_dynamic_css($selector, $styles);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_set_blog_archive_page_padding');
}
