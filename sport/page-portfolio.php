<?php /* Template Name: Portfolio */ ?>

<?php get_header(); ?>

<?php 
 
    // SETTTINGS
    $cmb_portfolio_click = get_post_meta($post->ID, 'cmb_portfolio_click', true);
    $cmb_portfolio_cat = get_post_meta($post->ID, 'cmb_portfolio_cat', true);
    $cmb_portfolio_num_columns = get_post_meta($post->ID, 'cmb_portfolio_num_columns', true);

    // DEFAULTS
    if (empty($cmb_portfolio_num_columns)) { $cmb_portfolio_num_columns = 3; }

    // GET CLASSES
    $size_class = mb_get_size_class_from_num($cmb_portfolio_num_columns, "third");

    $post_counter = 1;

    // BUILD INCLUDE ARRAY FOR QUERY
    $include_array = array();  
    if (!empty($cmb_portfolio_cat)) {
        foreach ($cmb_portfolio_cat as $key => $value) {
            array_push($include_array, get_term_by('slug', $key, 'project_category')->term_id);
        }
    } 

    // BUILD INCLUDE STRING FOR FILTER MENU
    $include_string = " ";  //notice the extra space - to prevent include string from being empty which would display all categories.
    if (!empty($cmb_portfolio_cat)) {
        foreach ($cmb_portfolio_cat as $key => $value) {
            $include_string .=  get_term_by('slug', $key, 'project_category')->term_id . ",";
        }
        $include_string = trim($include_string,', ');
    } 

    // BASE ARGS
    $query_args = array(
        'posts_per_page'    => -1,
        'post_type'         => 'cpt_project',
        'post_status'       => 'publish',
        'orderby'           => 'post_date',
        'order'             => 'DESC',
        'suppress_filters'  => false,
        'tax_query' => array(
            array(
                'taxonomy'      => 'project_category',
                'field'         => 'term_id',
                'terms'         => $include_array,
            ),
        ),     
  );

    // FINAL QUERY
    $temp = $wp_query;
    if (!class_exists('Tribe__Events__Main')) { $wp_query = null; }
    if (!empty($include_array)) { $wp_query = new WP_Query($query_args); } else { $wp_query = new WP_Query(); }

?>

    <!-- Start Outter Wrapper -->   
    <div class="outter-wrapper feature">
        <hr/>
    </div>  
    <!-- End Outter Wrapper -->     
        
        
    <!-- start outter-wrapper -->   
    <div class="outter-wrapper">
        <!-- start main-container -->
        <div class="main-container">
            <!-- start main wrapper -->
            <div class="main wrapper clearfix">
                <!-- start main-content -->
                <div class="main-content">
        
        
                    <div class="clearfix">

                        <!-- Start Meta -->
                        <aside class="left-aside left fifth">
                            <ul class="meta option-set filters" id="filter" data-option-key="filter">
                                <li><strong><?php echo $post->post_title; ?></strong></li>

                                <?php
                                    wp_list_categories(array(
                                        'show_option_all'   => __("All categories", "loc_canon"),
                                        'include'           => $include_string,
                                        'title_li'          => "",
                                        'taxonomy'          => "project_category"

                                    )); 
                                ?>

                            </ul>

                            <?php echo do_shortcode($post->post_content); ?>

                        </aside>

                        <!-- Start Isotope -->
                        <div class="four-fifths right last thumb-portfolio super-list variable-sizes page_isotope_gallery">

                            <!-- MAIN LOOP -->
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php 
                                    $cmb_media_link = get_post_meta(get_the_ID(), 'cmb_media_link', true);
                                    $cmb_feature = get_post_meta(get_the_ID(), 'cmb_feature', true);

                                    $last_class = ($post_counter%$cmb_portfolio_num_columns) ? "" : " last";
                                    $cat_class = "";
                                    $item_categories = get_the_terms(get_the_ID(), 'project_category');
                                    if ($item_categories) foreach ($item_categories as $value) $cat_class .= " cat-item-" . $value->term_id;
                                    $final_class = $size_class . $cat_class . $last_class;
                                ?>

                                <?php 

                                        if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                            echo "<div class='gallery_item $final_class'>";
                                            echo $cmb_media_link;        
                                            echo '</div>';
                                            $post_counter++;
                                        } else {

                                            $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                            $post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'portfolio_isotope_x2');
                                            $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                            $img_post = get_post(get_post_thumbnail_id(get_the_ID()));
                                                
                                            if ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
                                                echo "<div class='gallery_item mosaic-block fade element $final_class'>";
                                                if ($cmb_portfolio_click == "post") {
                                                    printf('<a href="%s" class="mosaic-overlay link fancybox" title="%s"></a>', get_permalink(), esc_attr($img_post->post_title));
                                                } else {
                                                    printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play"></a>', esc_attr($cmb_media_link));
                                                }
                                                printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
                                                echo '</div>';
                                                $post_counter++;
                                            } elseif ( has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 
                                                echo "<div class='gallery_item mosaic-block fade element $final_class'>";
                                                if ($cmb_portfolio_click == "post") {
                                                    printf('<a href="%s" class="mosaic-overlay link fancybox" title="%s"></a>', get_permalink(), esc_attr($img_post->post_title));
                                                } else {
                                                    printf('<a href="%s" class="mosaic-overlay fancybox" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title));
                                                }
                                                printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
                                                echo '</div>';
                                                $post_counter++;
                                            }

                                        }


                                ?>

                            <?php endwhile; ?>
                            <!-- END LOOP -->

                        </div>

                    </div>                              
                        

                     
                </div>
                <!-- end main-content -->
            </div>
            <!-- end main wrapper -->
        </div>
         <!-- end main-container --> 
    </div>
     <!-- end outter-wrapper -->
 
        
        


		
<?php get_footer(); ?>