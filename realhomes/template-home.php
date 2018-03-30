<?php
/*
*   Template Name: Home Template
*/
get_header();


/* Theme Home Page Module */
$theme_homepage_module = get_option('theme_homepage_module');
$main_border_class = '';

/* For demo purpose only */
if(isset($_GET['module'])){
    $theme_homepage_module = $_GET['module'];
}

switch($theme_homepage_module){
    case 'properties-slider':
        get_template_part('template-parts/slider');
        break;

    case 'slides-slider':
        get_template_part('template-parts/separate-slider');
        break;

    case 'properties-map':
        get_template_part('banners/map_based_banner');
        break;

    case 'revolution-slider':
        $rev_slider_alias = trim(get_option('theme_rev_alias'));
        if( function_exists('putRevSlider') && (!empty($rev_slider_alias)) ){
            putRevSlider( $rev_slider_alias );
        }else{
            get_template_part('banners/default_page_banner');
        }
        break;

    default:
        get_template_part('banners/default_page_banner');
        $main_border_class = 'top-border';
        break;
}

?>

    <!-- Content -->
    <div class="container contents">
        <div class="row">

            <div class="span12">

                <!-- Main Content -->
                <?php
                    $search_page_url = get_option('theme_search_url');
                    if( empty( $search_page_url ) ){
                        $main_border_class = 'top-border';
                    }
                ?>
                <div class="main <?php echo $main_border_class; ?>">
                    <?php
                    /* Display home search area widgets if there is any - otherwise display default advance search form */
                    if ( is_active_sidebar( 'home-search-area' ) ) :
                        dynamic_sidebar( 'home-search-area' );
                    else:
                        $show_home_search = get_option('theme_show_home_search');
                        if( $show_home_search == 'true' ){
                            /* Advance Search Form for Homepage */
                            get_template_part('template-parts/advance-search');
                        }
                    endif;


                    /* Homepage Contents from Page Editor */
                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            $content = get_the_content('');
                            if(!empty($content)){
                                ?>
                                <div class="inner-wrapper">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
                                        <?php the_content(); ?>
                                    </article>
                                </div>
                                <?php
                            }
                        endwhile;
                    endif;


                    /* Homepage Properties */
                    $show_home_properties = get_option('theme_show_home_properties');
                    if( $show_home_properties == 'true' ){
                        get_template_part("template-parts/home-properties") ;
                    }


                    /* Featured Properties */
                    $show_featured_properties = get_option('theme_show_featured_properties');
                    if($show_featured_properties == 'true'){
                        get_template_part("template-parts/carousel") ;
                    }


                    /* Blog Posts */
                    $show_news_posts = get_option('theme_show_news_posts');
                    /* For demo purpose only */
                    if(isset($_GET['news-on-home'])){
                        $show_news_posts = $_GET['news-on-home'];
                    }
                    if($show_news_posts == 'true'){
                        get_template_part("template-parts/home-news-posts") ;
                    }

                    ?>
                </div><!-- End Main Content -->

            </div> <!-- End span12 -->

        </div><!-- End row -->

    </div><!-- End content -->

<?php get_footer(); ?>