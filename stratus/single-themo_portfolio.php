<?php
//list($key, $show_header, $page_header_float, $masonry) = themo_return_header_sidebar_settings(get_post_type( get_the_ID()));

$key = 'themo_project_single';
$show_header = 'on';
$page_header_float = 'centered';
?>
<?php include( locate_template( 'templates/page-layout.php' ) ); ?>
<div class="inner-container">
    <?php
    //-----------------------------------------------------
    // Include Header Template File
    //-----------------------------------------------------
    include( locate_template( 'templates/page-header-portfolio.php' ) ); // Page Header Template ?>

    <?php
    //-----------------------------------------------------
    // OPEN | OUTER Container + Row
    //-----------------------------------------------------
    echo wp_kses_post($outer_container_open) . wp_kses_post($outer_row_open); // Outer Tag Open ?>

    <?php
    //-----------------------------------------------------
    // OPEN | Wrapper Class - Support for sidebar
    //-----------------------------------------------------
    echo wp_kses_post($main_class_open);  ?>

    <?php
    //-----------------------------------------------------
    // OPEN | Section + INNER Container
    //----------------------------------------------------- ?>

    <section id="<?php echo sanitize_html_class($key).'_content'; ?>" class="port-single">
        <?php echo wp_kses_post($inner_container_open);?>

        <?php
        //-----------------------------------------------------
        // LOOP
        //-----------------------------------------------------

        // Set Image Sizes
        if($has_sidebar){
            $image_size = 'themo_blog_standard';
        }else{
            $image_size = 'themo_full_width';
        }

        while (have_posts()) : the_post();
            $format = get_post_format();
            if ( false === $format ) {
                $format = '';
            }
            echo '<div class="' . implode(' ',get_post_class()) .'">';
                echo '<div class="row">';
                    get_template_part('templates/portfolio', $format);
                echo '</div>';
            echo '</div>';
            comments_template('/templates/comments.php');
        endwhile;
        //-----------------------------------------------------
        // CLOSE | Section + INNER Container
        //----------------------------------------------------- ?>
        <?php echo wp_kses_post($inner_container_close);?>
    </section>

    <?php
    //-----------------------------------------------------
    // CLOSE | Main Class
    //-----------------------------------------------------
    echo wp_kses_post($main_class_close); ?>

    <?php
    //-----------------------------------------------------
    // INCLUDE | Sidebar
    //-----------------------------------------------------
    include themo_sidebar_path(); ?>

    <?php
    //-----------------------------------------------------
    // CLOSE | OUTER Container + Row
    //-----------------------------------------------------
    echo wp_kses_post($outer_container_close) . wp_kses_post($outer_row_close); // Outer Tag Close ?>
</div><!-- /.inner-container -->    