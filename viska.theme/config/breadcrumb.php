<?php


function breadcrumbs()
{
    $output ='';
    if(!is_front_page() && !is_archive()){
        $output .= sprintf('<li><a href="%1$s">%2$s</a></li>',home_url(),__('Home', LANGUAGE));
    }
    if ( is_category() || is_single() && !is_singular('maf_portfolio')) {
        $category = get_the_category();
        $output .= sprintf('<li>%s</li>',get_category_parents($category[0]->cat_ID, TRUE,'',FALSE));
    }
    if (is_singular('maf_portfolio'))
    {
        global $post;
        $output .= get_the_term_list($post->ID, 'portfolio_category', '<li>', ' - ', '</li>');
    }
    if(is_single() || is_page())
        $output .= sprintf('<li>%s</li>',get_the_title());
    if(is_tag())
        $output .= sprintf('<li>%s</li>',single_tag_title('',FALSE));
//    if(is_404())
//        $output .= sprintf('<li>%s</li>',__("404 - Page not Found", LANGUAGE));
//    if(is_search())
//    $output .= sprintf('<li>%s</li>',__("Search", LANGUAGE));
    if(is_month()){
        $output .= sprintf('<li><a href="%1$s">%2$s</a></li>',get_year_link(get_the_time('Y')),get_the_time('Y'));
        $output .= sprintf('<li><a href="%1$s">%2$s</a></li>',get_month_link(get_the_time('Y'),get_the_time('m')),get_the_time('m'));
    }

    if(is_year()){
        $output .= sprintf('<li><a href="%1$s">%2$s</a></li>',get_year_link(get_the_time('Y')),get_the_time('Y'));
    }
    if(is_day()){
        $output .= sprintf('<li><a href="%1$s">%2$s</a></li>',get_year_link(get_the_time('Y')),get_the_time('Y'));
        $output .= sprintf('<li><a href="%1$s">%2$s</a></li>',get_month_link(get_the_time('Y'),get_the_time('m')),get_the_time('m'));
        $output .= sprintf('<li><a href="%1$s">%2$s</a></li>',get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d')),get_the_time('d'));

    }
    if(is_author())
    {
        $user_title = get_the_author_meta( 'meta_title', (int) get_query_var( 'author' ) )?get_the_author_meta( 'meta_title', (int) get_query_var( 'author' ) ):get_the_author();
        $id = get_the_author_meta('user_login');
        $output .= sprintf('<li><a href="%1$s">%2$s</a></li>',home_url()."/author/".$id,$user_title);
    }

    if($output){
        $output = sprintf('<ol class="breadcrumb">%s</ol>',$output);
        echo $output;
    }


}


?>