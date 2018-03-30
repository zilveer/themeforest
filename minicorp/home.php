<?php

/*
 * Get header.php
 */
get_header();
$page = get_page( get_option( 'page_for_posts' ) );

?>

<?php ishyoboy_get_home_lead(); ?>

<!-- Content part section -->
<section class="part-content">

    <?php $breadcrumb_shown = false;?>

    <?php if ( 'page' == get_option('show_on_front') && isset($page) && '' != $page && '' != $page->post_content) :?>
    <div class="row">
        <div class="grid12">
            <?php
            // Breadcrumbs display
            ishyoboy_show_breadcrumbs();
            $breadcrumb_shown = true;
            ?>

            <?php echo apply_filters( 'the_content',  $page->post_content ); ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="<?php echo ishyoboy_get_content_class(); ?>">
            <?php

            if (!$breadcrumb_shown){
                // Breadcrumbs display
                ishyoboy_show_breadcrumbs();
            }

            if (have_posts()) {

                while (have_posts()) {

                    the_post();

                    $format = get_post_format();
                    if( false === $format ) { $format = 'standard'; }
                    get_template_part( 'content-post', $format );

                }

                echo '<div class="space"></div>';

                if(empty($paged) || 0 == $paged) $paged = 1;

                $pg = ishyoboy_get_pagination('', 3, $wp_query->max_num_pages, $paged);
                if ('' != $pg){
                    echo $pg, '<div class="space"></div>';
                }
            }

            ?>

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