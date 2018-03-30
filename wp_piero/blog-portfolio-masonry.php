<?php
/*
Template Name: Portfolio Masonry
*/
global $post,$breadcrumb,$masonry_filter;
$layout = cshero_generetor_layout();
get_header(); 

?>

<?php
    $category = get_post_meta(get_the_ID(),'cs_portfolio_category',true);
    if(is_array($category)){
        $category =  implode(',', $category);
    }
    $limit = get_post_meta(get_the_ID(),'cs_page_limit',true);
    $masonry_filter = (get_post_meta(get_the_ID(),'cs_page_masonry_filter',true)=='yes')?true:false;
    $masonry_columns = get_post_meta(get_the_ID(),'cs_page_masonry_columns',true);
    $masonry_loadmore = (get_post_meta(get_the_ID(),'cs_page_masonry_loadmore',true)=='yes')?true:false;
    if(empty($limit)) $limit=5;
    if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
    elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
    else { $paged = 1; }
    global $cs_span,$cs_cat_class;
    $cs_span = "col3";
    switch ($masonry_columns) {
        case 1:
            $cs_span = "col1";
            break;
        case 2:
            $cs_span = "col2";
            break;
        case 3:
            $cs_span = "col3";
            break;
        case 4:
            $cs_span = "col4";
            break;
        default:
            $cs_span = "col3";
    }
    $class='cs-masonry-layout-item '.$cs_span.' ';
    /*script*/
    wp_enqueue_script('jquery-isotope-min-js', get_template_directory_uri() . "/js/jquery.isotope.min.js",array(),"2.0.0");
    wp_enqueue_script('jquery-imagesloaded-js', get_template_directory_uri() . "/js/jquery.imagesloaded.js",array(),"2.1.0");

?>
<?php $layout = cshero_generetor_layout();?>
    <section id="primary" class="content-area blog-masonry<?php if($breadcrumb == '0'){ echo ' no_breadcrumb_page'; }; ?><?php echo esc_attr($layout->class); ?>">
        <div class="<?php echo get_post_meta($post->ID, 'cs_layout', true) ? 'no-container' : 'container'; ?>">
            <div class="row">
                <?php if($layout->left1_col):?>
                    <div class="left-wrap <?php echo esc_attr($layout->left1_col); ?>">
                         <div id="secondary" class="widget-area" role="complementary">
                            <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                                <?php dynamic_sidebar($layout->left1_sidebar); ?>
                            </div>
                         </div>
                    </div>
                <?php endif; ?>
                <div class="content-wrap <?php echo esc_attr($layout->blog); ?>">
                    <main id="main" class="site-main" role="main">
                        <div class="cshero-page-content">
                            <?php 
                            if(have_posts()) the_post();
                            the_content();
                            wp_reset_query();
                            wp_reset_postdata();
                            ?>
                        </div>
                        <?php
                        if($masonry_filter){
                            get_template_part( 'framework/templates/blog/portfolio/masonry','filter');
                        }
                        ?>
                        <?php $post_list = new WP_Query('post_type=portfolio&post_status=publish&paged='. $paged . '&recordings=' . $category .'&posts_per_page=' . $limit );?>
                        <?php if ( $post_list->have_posts() ) : ?>
                            <?php
                                if($masonry_loadmore){
                                    /*ajax media*/
                                    wp_enqueue_style( 'wp-mediaelement' );
                                    wp_enqueue_script( 'wp-mediaelement' );
                                    global $post_list;
                                    /* js, css for load more */
                                    wp_register_script( 'cshero-load-more-js', get_template_directory_uri().'/js/cshero_loadmore.js', array('jquery') ,'1.0',true);
                                    // What page are we on? And what is the pages limit?
                                    $max = $post_list->max_num_pages;
                                    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

                                    // Add some parameters for the JS.
                                    wp_localize_script(
                                        'cshero-load-more-js',
                                        'cs_more_obj',
                                        array(
                                            'startPage' => $paged,
                                            'maxPages' => $max,
                                            'total' => $post_list->found_posts,
                                            'perpage' => $limit,
                                            'nextLink' => next_posts($max, false),
                                            'ajaxType' => 'Button',
                                            'masonry' => 'masonry'
                                        )
                                    );
                                    wp_enqueue_script( 'cshero-load-more-js' );
                                }

                                ?>
                            <?php /* Start the Loop */ ?>
                            <div class="cshero-masonry-post cs-masonry-layout cshero-shortcode">
                            <?php while ( $post_list->have_posts() ) : $post_list->the_post(); ?>
                            <?php
                            $categories = get_the_terms($post->ID,'portfolio_category');
                            $cs_cat_class='';
                            foreach($categories as $category){
                                 $cs_cat_class .= 'category-'.$category->slug.' ';
                            }
                            ?>
                                <div class="masonry-item <?php echo $class.' '.$cs_cat_class;?>">
                                <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'framework/templates/blog/portfolio/blog',get_post_format());
                                ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <?php else : ?>

                            <?php get_template_part( 'framework/templates/blog/blog', 'none' ); ?>

                        <?php endif; ?>
                        <?php
                            if($masonry_loadmore){
                                echo '<div class="cs_pagination"></div>';
                            }
                        ?>
                    </main><!-- #main -->
                </div>
                <?php if($layout->right1_col):?>
                    <div class="right-wrap <?php echo esc_attr($layout->right1_col); ?>">
                         <div id="secondary" class="widget-area" role="complementary">
                            <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                                <?php dynamic_sidebar($layout->right1_sidebar); ?>
                            </div>
                         </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section><!-- #primary -->
<?php get_footer(); ?>