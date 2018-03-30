<?php

    if (is_front_page() || is_home() ):
        global $post;
        dttheme_subtitle_section( $post->ID, 'page' );
    elseif ( is_page() && !is_front_page() ):
        global $post;
        dttheme_subtitle_section( $post->ID, 'page' );
    elseif( is_post_type_archive('product') ):
        dttheme_subtitle_section( get_option('woocommerce_shop_page_id'), 'page' );
    elseif( is_post_type_archive('dt_portfolios') ):
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        $title = __("Portfolio Archives",'dt_themes');
        dttheme_custom_subtitle_section( $title, " subtitle-for-archive-term");
    elseif( is_single() ):
        if( is_attachment() ):
        else:
            $post_type = get_post_type();
            if( $post_type === 'post' )   {
                dttheme_subtitle_section( $post->ID, 'post' );
            }elseif(  $post_type === "dt_portfolios"  ) {
                dttheme_subtitle_section( $post->ID, 'dt_portfolios' );
            } elseif( $post_type === "product" ) {
                $title = get_the_title($post->ID);
                $subtitle = __("Shop",'dt_themes');
                $icon = "fa-shopping-cart";
                dttheme_custom_subtitle_section( $title, " subtitle-for-single-product");
			}
        endif; 
    elseif( is_tax() ):
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        $title = __("Term Archives",'dt_themes');
        dttheme_custom_subtitle_section( $title, " subtitle-for-archive-term");
    elseif( is_category( ) ):
        $title = __("Category Archives",'dt_themes');
        dttheme_custom_subtitle_section( $title, " subtitle-for-archive-categories");
    elseif( is_tag() ):
        $title = __("Tag Archives",'dt_themes');
        dttheme_custom_subtitle_section( $title, " subtitle-for-archive-tags");
    elseif( is_month() ):
        $title = __("Monthly Archives",'dt_themes');
        dttheme_custom_subtitle_section( $title, " subtitle-for-archive-month");
    elseif( is_year() ):
        $title = __("Yearly Archives",'dt_themes');
        dttheme_custom_subtitle_section( $title, " subtitle-for-archive-year");
    elseif(is_day() || is_time()):
    elseif( is_author() ):
        $curauth = get_user_by('slug',get_query_var('author_name')) ;
        $title  = __("Author Archives",'dt_themes');
        dttheme_custom_subtitle_section( $title, " subtitle-for-archive-author");
	elseif(in_array('events-archive', get_body_class())):
		dttheme_custom_subtitle_section( '', "events-bg");
    elseif( is_search() ):
        $title  = __("Search Result for ",'dt_themes').get_search_query();
        dttheme_custom_subtitle_section( $title, " subtitle-for-search");
    elseif( is_404() ):
        $title  = __("Lost ",'dt_themes');
        dttheme_custom_subtitle_section( $title, " subtitle-for-404");
    endif; ?>