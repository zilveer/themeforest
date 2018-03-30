<?php
get_header();

$theme_property_detail_variation = get_option('theme_property_detail_variation');

// Banner Image
$banner_image_path = "";
$banner_image_id = get_post_meta( $post->ID, 'REAL_HOMES_page_banner_image', true );
if( $banner_image_id ){
    $banner_image_path = wp_get_attachment_url($banner_image_id);
}else{
    $banner_image_path = get_default_banner();
}
?>

    <div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?php echo $banner_image_path; ?>'); background-size: cover;">
        <?php if(!('true' == get_option('theme_banner_titles'))): ?>
            <div class="container">
                <div class="wrap clearfix">
                    <h1 class="page-title"><span><?php the_title(); ?></span></h1>
                    <?php
                    $display_property_breadcrumbs = get_option( 'theme_display_property_breadcrumbs' );
                    if ( $display_property_breadcrumbs == 'true' ) {
                        get_template_part( 'property-details/property-breadcrumbs' );
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div><!-- End Page Head -->

    <!-- Content -->
    <div class="container contents detail">
        <div class="row">
            <div class="span9 main-wrap">

                <!-- Main Content -->
                <div class="main">

                    <div id="overview">
                        <?php
                        if ( have_posts() ) :
                            while ( have_posts() ) :
                                the_post();

                                if ( ! post_password_required() ) {

                                    /*
                                    * 1. Property Images Slider
                                    */
                                    $gallery_slider_type = get_post_meta($post->ID, 'REAL_HOMES_gallery_slider_type', true);
                                    /* For demo purpose only */
                                    if(isset($_GET['slider-type'])){
                                        $gallery_slider_type = $_GET['slider-type'];
                                    }
                                    if( $gallery_slider_type == 'thumb-on-bottom' ){
                                        get_template_part('property-details/property-slider-two');
                                    }else{
                                        get_template_part('property-details/property-slider');
                                    }


                                    /*
                                    * 2. Property Information Bar, Icons Bar, Text Contents and Features
                                    */
                                    get_template_part('property-details/property-contents');
									
                                    /*
                                    * 3. Property Floor Plans
                                    */
                                    get_template_part('property-details/property-floor-plans');

                                    /*
                                    * 4. Property Video
                                    */
                                    get_template_part('property-details/property-video');

                                    /*
                                    * 5. Property Map
                                    */
                                    get_template_part('property-details/property-map');

                                    /*
                                    * 6. Property Attachments
                                    */
                                    get_template_part('property-details/property-attachments');

                                    /*
                                    * 7. Child Properties
                                    */
                                    get_template_part('property-details/property-children');

                                    /*
                                    * 8. Property Agent
                                    */
                                    if ( isset( $_GET[ 'variation' ] ) ) {
                                        $theme_property_detail_variation = $_GET[ 'variation' ];    // For demo purpose only
                                    }

                                    if ( $theme_property_detail_variation != "agent-in-sidebar" ) {
                                        get_template_part( 'property-details/property-agent' );
                                    }

                                } else {
                                    echo get_the_password_form();
                                }

                            endwhile;
                        endif;
                        ?>
                    </div>

                </div><!-- End Main Content -->

                <?php
                /*
                 * 8. Similar Properties
                 */
                get_template_part('property-details/similar-properties');
                ?>

            </div> <!-- End span9 -->

            <?php
            if( $theme_property_detail_variation == "agent-in-sidebar" ) {
                ?>
                <div class="span3 sidebar-wrap">
                    <!-- Sidebar -->
                    <aside class="sidebar">
                        <?php get_template_part('property-details/property-agent-for-sidebar'); ?>
                        <?php
                        if ( ! dynamic_sidebar( 'property-sidebar' ) ) :
                        endif;
                        ?>
                    </aside>
                    <!-- End Sidebar -->
                </div>
            <?php
            }else{
                get_sidebar('property');
            }
            ?>

        </div><!-- End contents row -->
    </div><!-- End Content -->

<?php get_footer(); ?>