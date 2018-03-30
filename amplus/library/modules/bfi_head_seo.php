<?php
/**
 * Adds the SEO meta keywords and description in the head tag
 */
 
class BFIHeadSEO {
    public static function run() {
        add_action('wp_head', array(__CLASS__, 'echoMeta'));
    }
    
    public static function echoMeta() {
        $metadescription = "";
        $metakeywords = "";
        wp_reset_query();

        // get the meta description and meta keywords
        if (is_home()) {
            if ('page' == get_option('show_on_front')) {
                $postID = get_option('page_on_front');
            } else if (bfi_get_option(BFI_FRONTPAGEOPTION)) {
                $postID = bfi_get_option(BFI_FRONTPAGEOPTION);
            }
        } else if (is_page() || is_single()) {
            global $post;
            $postID = $post->ID;
        }
        
        if (!isset($postID)) {
            $metadescription = get_bloginfo('description', '');
            $metakeywords = bfi_get_option(BFI_OPTIONMETAKEYWORDS);
        } else {
            $metadescription = bfi_get_post_meta($postID, BFI_OPTIONMETADESCRIPTION);
            $metakeywords = bfi_get_post_meta($postID, BFI_OPTIONMETAKEYWORDS);
        }

        // fall back to defaults if no meta info was found
        if (!$metadescription && bfi_get_option(BFI_OPTIONMETADESCRIPTION)) {
            $metadescription = bfi_get_option(BFI_OPTIONMETADESCRIPTION);
        } elseif (!$metadescription) {
            $metadescription = get_bloginfo('description', '');
        }
        if (!$metakeywords && bfi_get_option(BFI_OPTIONMETAKEYWORDS)) {
            $metakeywords = bfi_get_option(BFI_OPTIONMETAKEYWORDS);
        }

        // form the meta info
        $meta = "";
        $meta .= $metadescription ? "<meta name='description' content='$metadescription' />\n" : '';
        $meta .= $metakeywords ? "<meta name='keywords' content='$metakeywords' />\n" : '';
        echo $meta;
    }
}


BFIHeadSEO::run();

?>