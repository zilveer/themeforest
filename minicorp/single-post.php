<?php

/*
 * Get header.php
 */
get_header();

// Get Framework settings, do not remove!
global $ish_options;

// Get Sidebar width options, do not remove!
global $sidebar_width;


?>


<?php ishyoboy_get_lead( get_the_ID()); ?>

<!-- Content part section -->
<section class="part-content">
    <div class="row">

        <div class="<?php echo ishyoboy_get_content_class(); ?>">
            <?php
            // Breadcrumbs display
            ishyoboy_show_breadcrumbs();

            if (have_posts()) {

                while (have_posts()) {

                    the_post();

                    $format = get_post_format();
                    if( false === $format ) { $format = 'standard'; }
                    get_template_part( 'content-post', $format );

                }

                ishyoboy_pagination('', 3);

            } else {  ?>

                <div id="post-0" <?php post_class(); ?>>

                    <h2 class="entry-title"><?php _e('Error 404 - Page Not Found', 'ishyoboy') ?></h2>

                    <div class="entry-content">
                        <p><?php _e("Sorry, the content you are looking for could not be found.", 'ishyoboy') ?></p>
                    </div>

                </div>

                <?php } ?>

        </div>


        <?php
        // SIDEBAR
        get_sidebar();
        ?>

    </div>
</section>
<!-- Content part section END -->

<?php

/*
 * Get footer.php
 */
get_footer();

?>