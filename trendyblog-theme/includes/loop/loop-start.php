<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
    $post_type = get_post_type();

    //sidebars
    $sidebar = get_post_meta ( DF_page_ID(), "_".THEME_NAME."_sidebar_select", true ); 
    $sidebarPosition = get_post_meta ( DF_page_ID(), "_".THEME_NAME."_sidebar_position", true ); 

    if(is_category()) {
        $catID = get_cat_id( single_cat_title("",false) );
        //sidebars
        $sidebar = df_get_custom_option ( $catID, "sidebar_select", false ); 
        $sidebarPosition = df_get_custom_option ( $catID, "sidebar_position", false ); 
    } elseif(is_tax()){
        $sidebar = df_get_custom_option ( get_queried_object()->term_id, "sidebar_select", false );
        $sidebarPosition = df_get_custom_option ( get_queried_object()->term_id, "sidebar_position", false );
    }

    if(is_search()) {
        $sidebar = "default";
        $sidebarPosition = "right";
    }

    if ( $sidebar=='') {
        $sidebar='default';
    }   

    //default main sidebar position
    $defPosition = df_get_option(THEME_NAME."_sidebar_position");
    if (($sidebarPosition == '' && $defPosition != "custom") || ($sidebarPosition != '' && $defPosition != "custom")) {
        $sidebarPosition = $defPosition;
    } else if ((!$sidebarPosition && $defPosition == "custom") || ($sidebarPosition == '' && $defPosition == "custom")) {
        $sidebarPosition = "right";
    }

?>

<?php
    if(!is_category() && get_post_meta ( DF_page_id(), "_".THEME_NAME."_sliderStyle", true ) == "2") { 
        get_template_part(THEME_SLIDERS."wide-slider");
    }
    if((!is_category() && $post_type=="post" && df_get_option(THEME_NAME."_breaking_news_post") == "on" && DF_page_id() != get_option('page_for_posts')) || 
        (!is_category() && df_get_option(THEME_NAME."_breaking_news_page") == "on" && is_page() && !is_page_template('template-homepage.php') && DF_page_id() != get_option('page_for_posts')) ||
        (!is_category() && df_get_option(THEME_NAME."_breaking_news_blog") == "on" && DF_page_id() == get_option('page_for_posts')) ||
        (!is_category() && df_get_option(THEME_NAME."_breaking_news_home") == "on" && is_page_template('template-homepage.php')) ||
        (is_category() && df_get_custom_option( get_cat_id( single_cat_title("",false) ), 'breaking_slider', false ) != "slider_off")) { 
            get_template_part(THEME_SLIDERS."breaking-news");
    }


?>
            <!-- Section -->
            <section>
                <div class="container">
                	<?php if(!is_page_template('template-homepage.php')) { ?>
                    <div class="row">
                        <?php 
                            if($sidebar!="off" && $sidebarPosition == "left") {
                                get_template_part(THEME_INCLUDES."sidebar");
                            }   


                        ?>
                        <!-- Main content -->
                        <div class="col <?php if($sidebar!="off") { ?>main-content col_9_of_12<?php } else { ?>col_12_of_12<?php } ?>">
                    <?php } ?>

                    <?php 
                        if(df_get_option(THEME_NAME."_breadcrumb")=="on" && !is_page() && is_single() && !(function_exists('is_woocommerce') && is_woocommerce()) && !(function_exists('is_bbpress') && is_bbpress())) {
                            wp_reset_query();
                            df_breadcrumbs();
                            
                        }

                    ?>

							<?php wp_reset_query();  ?>