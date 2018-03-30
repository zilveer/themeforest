<?php

$id_404 = ( isset( $ish_options['use_page_for_404'] ) && ( '1' == $ish_options['use_page_for_404'] ) && isset( $ish_options['page_for_404'] ) ) ? $ish_options['page_for_404'] : '';

get_header();

if ( '' != $id_404 && '-1' != $id_404 ){
    // 404 Page set in the backend

    ishyoboy_get_lead($id_404);
    ?>

    <!-- Content part section -->
    <section class="part-content">
        <div class="row">
            <div class="<?php echo ishyoboy_get_content_class($id_404); ?>">
                <?php
                $my_post = get_post($id_404);
                // Breadcrumbs display
                ishyoboy_show_breadcrumbs();
                ?>
                <?php echo apply_filters('the_content', $my_post->post_content); ?>

            </div>

            <?php
            // SIDEBAR
            get_sidebar('404');
            ?>

        </div>
    </section>
    <!-- Content part section END -->

<?php } else{
    // USE DEFAULT 404 TEMPLATE

    ishyoboy_custom_lead('<h1 class="color1">Oh dear!</h1><h2>No matter how hard we try, we\'re unable to find the page you\'re looking for.</h2>'); ?>

    <!-- Content part section -->
    <section class="part-content">
        <div class="row">
            <div class="grid12 no-sidebar">
                <?php
                // Breadcrumbs display
                ishyoboy_show_breadcrumbs();
                ?>
                <div class="space"></div>
                <p>We've searched more than <strong>404</strong> pages and none of them seems to be the one you we're looking for.</p>
                <p>Why don't you have a look around and try to find it?</p>
                <div class="space"></div>

            </div>

        </div>
    </section>
    <!-- Content part section END -->

<?php } ?>
<!-- #content  END -->
<?php  get_footer(); ?>