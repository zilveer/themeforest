<?php
/**
 */

/**
 * Forms the title for an archive page
 *
 * @return string The title for an archive page
 */
function bfi_get_archive_title() {
    $title = __("Archives", BFI_I18NDOMAIN);
    
    if (is_day()) {
        $title = sprintf(__("Archives: %s", BFI_I18NDOMAIN), 
                         get_the_date());
                         
    } else if (is_month()) {
        $title = sprintf(__("Archives: %s", BFI_I18NDOMAIN), 
                         get_the_date('F, Y'));
                         
    } else if (is_year()) {
        $title = sprintf(__("Archives: %s", BFI_I18NDOMAIN), 
                         get_the_date('Y'));
                         
    } else if (is_category()) {
        $title = sprintf(__("Category Archives: %s", BFI_I18NDOMAIN), 
                         single_cat_title('', false));
                         
    } else if (is_tag()) {
        $title = sprintf(__("Tag Archives: %s", BFI_I18NDOMAIN), 
                         single_cat_title('', false));

    // author page
    } else if (is_author()) {
        global $author, $author_name;
        $curauth = (isset($_GET['author_name'])) 
            ? get_user_by('slug', $author_name) 
            : get_userdata(intval($author));
        $title = sprintf(__("Author Archives: %s", BFI_I18NDOMAIN), 
                         $curauth->nickname);
    // portfolio categories
    } else if (!is_single() 
               && !is_page() 
               && get_post_type() != 'post') {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $tax_obj = get_taxonomy($cat_obj->taxonomy);
        $title = sprintf(__('Category Archives %1$s: %2$s', BFI_I18NDOMAIN),
                         $tax_obj->labels->name, 
                         $cat_obj->name);
    }
    
    return $title;
}