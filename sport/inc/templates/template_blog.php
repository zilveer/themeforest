<?php 

    //VARS
    $canon_options = get_option('canon_options');
    $canon_options_post = get_option('canon_options_post'); 
    $category_slug = "";

    // GET AND HANDLE POTENTIALLY EMPTY VARS
    $cmb_pages_blog_style = get_post_meta($post->ID, 'cmb_pages_blog_style', true);
    if (empty($cmb_pages_blog_style)) { $cmb_pages_blog_style = "default"; }
    $cmb_pages_template_attachment = get_post_meta($post->ID, 'cmb_pages_template_attachment', true);
    if (empty($cmb_pages_template_attachment)) { $cmb_pages_template_attachment = "none"; }

    // STORE ORIGINAL $POST->ID FOR USE AFTER THE_LOOP
    $original_post_id = $post->ID;

    //DETERMINE PAGE TYPE (home, page or category)
    $page_type = mb_get_page_type();

    //DETERMINE BLOG STYLE
    switch ($page_type) {
        case 'home':
            $blog_style = $canon_options_post['homepage_blog_style'];
            break;
        case 'page':
            $blog_style = $canon_options_post['blog_style'];
            if ($cmb_pages_blog_style != "default") { $blog_style = $cmb_pages_blog_style; }
            break;
        case 'category':
            $blog_style = $canon_options_post['cat_style'];
            $cat_obj = get_category_by_slug(get_query_var('category_name'));
            $category_slug = $cat_obj->slug;
            break;
        default:
            $blog_style = "full";
            break;
    }

    // SET MAIN CONTENT CLASS
    $main_content_class = "main-content";
    if ($blog_style == "sidebar") { $main_content_class .= " three-fourths"; }
    if ($canon_options['sidebars_alignment'] == 'left') { $main_content_class .= " left-main-content"; }

    
    //BUILD EXCLUDE ARRAY
    $results_exclude_posts = get_posts(array(
        'numberposts'       => -1,
        'meta_key'          => 'cmb_hide_from_archive',
        'meta_value'        => 'checked',
        'orderby'           => 'post_date',
        'order'             => 'DESC',
        'post_type'         => 'any',
        'suppress_filters'  => false,
    ));
    if (count($results_exclude_posts) > 0) {
        for ($i = 0; $i < count($results_exclude_posts); $i++) {  
            $exclude_array[$i] = $results_exclude_posts[$i]->ID;
        }   
    } else {
        $exclude_array = array();   
    }

    //to make pagination work on page if used as static homepage
    if (get_query_var('paged')) {
        $paged = get_query_var('paged'); 
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page'); 
    } else {
        $paged = 1; 
    }

    $args = array(
        'post_status'       => 'publish',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'paged'             => $paged,
        'post__not_in'      => $exclude_array,
        'category_name'     => $category_slug,
    );

    $temp = $wp_query;
    if (!class_exists('Tribe__Events__Main')) { $wp_query = null; }
    $wp_query = new WP_Query($args); 


?>


        <!-- Start Outter Wrapper -->   
        <div class="outter-wrapper feature <?php if ($cmb_pages_template_attachment == "prepend") { echo "pb_hr"; }  ?>">
            <hr/>
        </div>  
        <!-- End Outter Wrapper --> 

        <!-- PAGEBUILDER PREPEND -->
        <?php if ($cmb_pages_template_attachment == "prepend") { get_template_part('inc/templates/pagebuilder_output'); } ?>
            
        <!-- start Outter Wrapper -->  
        <div class="outter-wrapper canon_blog">    

            <!-- start main-container -->
            <div class="main-container">

                <!-- start main wrapper -->
                <div class="main wrapper clearfix">

                    <!-- start main-content -->
                    <div class="<?php echo $main_content_class; ?>">

                     
                        <?php 

                            if ( ($page_type == "category") && (($canon_options_post['show_cat_title'] == "checked") || ($canon_options_post['show_cat_description'] == "checked")) ) {
                                
                                echo '<div class="category_header">';

                                // CAT TITLE
                                if ($canon_options_post['show_cat_title'] == "checked") {

                                    echo "<h1>";
                                    echo $cat_obj->name;
                                    echo "</h1>";
                                } 

                                // CAT DESCRIPTION
                                if ($canon_options_post['show_cat_description'] == "checked") {

                                    echo "<span class='lead'>";
                                    echo category_description();
                                    echo "</span>";
                                } 
                                
                                echo '<hr/></div>';
                            }

                        ?>


                        <?php get_template_part('inc/templates/template_blog_loop'); ?>
        
                
                    </div>
                    <!-- end main-content -->


                    <?php 

                        if ($blog_style == "sidebar") {
                        ?>

                            <!-- SIDEBAR -->
                            <?php get_sidebar(); ?>

                        <?php
                        }
                    ?>




                </div> 
                <!-- end main wrapper -->
            </div>
            <!-- end main-container -->
        </div>
        <!-- end outter-wrapper -->



        <!-- PAGEBUILDER APPEND -->

        <?php 
            //first revert to original $post->ID (was changed during the_loop)
            $post->ID = $original_post_id;
            if ($cmb_pages_template_attachment == "append") { get_template_part('inc/templates/pagebuilder_output'); } 

        ?>

                                                                                                   
