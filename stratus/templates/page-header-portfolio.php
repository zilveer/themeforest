<?php
//======================================================================
// Page Header Portfolio Template
//======================================================================

//-----------------------------------------------------
// Default Header Styling
//-----------------------------------------------------
$page_subheader_default = '<div class="subheader"></div>';
$page_subheader_default_show = true; // Show subheader by default

$orderby_val = get_query_var('portorder',false);
//-----------------------------------------------------
// Header and Subtext
//-----------------------------------------------------
if($show_header == 'on'){ // Show header / subetext?

	$page_subheader_default_show = false; // Don't show subheader, we'll replace with an image 

    /* Get Theme Option for Portfolio home */
    if ( function_exists( 'ot_get_option' ) ) {
        $portfolio_home_link_id = ot_get_option( 'themo_portfolio_home_link');
        $portfolio_home_link_anchor = ot_get_option( 'themo_portfolio_home_link_anchor');
        $project_nav = ot_get_option( 'themo_project_nav');
    }

    if(isset($portfolio_home_link_id) && $portfolio_home_link_id > ""){
        $portfolio_home_link = get_permalink($portfolio_home_link_id) ;
    }else {
        /*
            If not avail, check for a page that uses the portfolio template file.
            Get the first post id tha uses the portfolio template file
        */
        $the_query = new WP_Query(array(
            'post_type'  => 'page',  /* overrides default 'post' */
            'meta_key'   => '_wp_page_template',
            'meta_value' => 'templates/portfolio-standard.php',
            'post_status' => 'publish',
            'posts_per_page' => 1
        ));

        // The Loop
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $portfolio_home_link = get_permalink() ;
            }
        } else {
            // no posts found
            // If not avail, get the archive link
            $portfolio_home_link = get_home_url ('/');
        }
        /* Restore original Post Data */
        wp_reset_postdata();
    }

    if(isset($portfolio_home_link_anchor) && $portfolio_home_link_anchor > "") {
        $portfolio_home_link = $portfolio_home_link.  '#'. sanitize_title_with_dashes($portfolio_home_link_anchor);
    }
    $href_open = "<a href='".esc_url($portfolio_home_link)."'>";
    $href_close = "</a>";

    $prev_post = get_adjacent_post(true, '', true,'themo_project_type');
    $next_post = get_adjacent_post(true, '', false,'themo_project_type');

    echo '<div class="subheader"></div>';
    echo '<div class="container">';
        echo '<div class="port-header">';
            echo '<div id="themo_project_single" class="page-title centered">';
                echo '<h1>'.roots_title().'</h1>';
                echo '<div class="p-mob-nav">';
                    if(isset($project_nav) && $project_nav == 'on') {
                        if($prev_post){
                            $prev_post_url = get_permalink($prev_post->ID);
                            echo "<a href='".esc_url_raw(add_query_arg("portorder",$orderby_val,$prev_post_url))."' class='p-mob-prev' rel='prev'><i class='port-nav-icon th-icon th-i-prev'></i></a>";
                        }
                    }
                    echo '<a class="p-mob-back" href="'.$portfolio_home_link.'"><i class="port-nav-icon th-icon th-i-gallery"></i></a>';
                    if(isset($project_nav) && $project_nav == 'on') {
                        if($next_post){
                            $next_post_url = get_permalink($next_post->ID);
                            echo "<a href='".esc_url_raw(add_query_arg("portorder",$orderby_val,$next_post_url))."' class='p-mob-next' rel='next'><i class='port-nav-icon th-icon th-i-next'></i></a>";
                        }
                    }
                echo '</div>';
            echo '</div>';
            echo '<div class="port-nav">';
                echo '<a class="port-back" href="'.$portfolio_home_link.'"><i class="port-nav-icon th-icon th-i-gallery"></i></a>';
                if(isset($project_nav) && $project_nav == 'on') {

                    echo '<div class="port-arrows">';
                        if($prev_post){
                            $prev_post_url = get_permalink($prev_post->ID);
                            echo "<a href='".esc_url_raw(add_query_arg("portorder",$orderby_val,$prev_post_url))."' class='port-prev' rel='prev'><i class='port-nav-icon th-icon th-i-prev'></i></a>";
                        }
                        if($next_post){
                            $next_post_url = get_permalink($next_post->ID);
                            echo "<a href='".esc_url_raw(add_query_arg("portorder",$orderby_val,$next_post_url))."' class='port-next' rel='next'><i class='port-nav-icon th-icon th-i-next'></i></a>";
                        }
                    echo '</div>';
                }
            echo '</div>';
        echo '</div>';
    echo '</div>';
}
// Output subheader if no map or image
if ($page_subheader_default_show){echo wp_kses_post($page_subheader_default);}

