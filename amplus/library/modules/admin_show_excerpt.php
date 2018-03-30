<?php

add_action('admin_head', 'bfi_admin_show_excerpt');
function bfi_admin_show_excerpt() {
    global $post;
    if (!in_array(get_post_type($post), array("page", "post", BFIPortfolioModel::POST_TYPE))) {
        return;
    }
        
    echo "
        <script>
            jQuery(document).ready(function($){
                setTimeout(function() {
                    jQuery('#postexcerpt-hide:not(:checked)')
                        .prop('checked', true)
                        .attr('checked', 'checked')
                        .trigger('click');
                    });
                    jQuery('#postexcerpt')
                        .find('.hndle span')
                        .html('" . BFI_THEMENAME . " → EXCERPT')
                        .end()
                        .find('p')
                        .html('');
                    jQuery('<p style=\'font-style: italic;\'>The theme uses the text inserted here as the excerpt for this blog post. If this field is empty, the theme generates an excerpt from the main content above. Use this field if you want to specify the excerpt.</p>').insertBefore('#postexcerpt #excerpt');
                }, 100);
        </script>";
}

add_action('init', 'bfi_add_portfolio_excerpt');
function bfi_add_portfolio_excerpt() {
	add_post_type_support(BFIPortfolioModel::POST_TYPE, 'excerpt');
}

?>
