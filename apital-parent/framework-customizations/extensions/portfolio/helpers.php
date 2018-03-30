<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if( !function_exists('fw_ext_portfolio_get_gallery_images') ) :
    function fw_ext_portfolio_get_gallery_images( $post_id = 0 ) {
        if ( 0 === $post_id && null === ( $post_id = get_the_ID() ) ) {
            return array();
        }

        $options = get_post_meta( $post_id, 'fw_options', true );

        return isset( $options['project-gallery'] ) ? $options['project-gallery'] : array();
    }
endif;

if( !function_exists('fw_theme_portfolio_post_taxonomies') ) :
    /**
     * return portfolio post taxonomies
     */
    function fw_theme_portfolio_post_taxonomies($post_id, $return = false){
        $taxonomy = 'fw-portfolio-category';
        $terms = wp_get_post_terms($post_id, $taxonomy);
        $list = '';
        $checked = false;
        foreach($terms as $term){
            if($term->parent==0){
                /* if is checked parent category */
                $list .= $term->slug.', ';
                $checked = true;
            }
            else{
                $list .= $term->slug.', ';
                $parent_id = $term->parent;
            }
        }

        if(!$checked){
            /* if is not checked parent category extract this parent */
            $term = get_term_by('id', $parent_id, $taxonomy);
            $list .= $term->slug.', ';
        }

        if($return){
            return $list;
        }
        else{
            echo esc_html($list);
        }
    }
endif;