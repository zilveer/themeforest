<div class="row">
    <?php global $pageURL;
    $pageURL = get_page_uri(get_the_ID()); ?> 


    <?php
    $temp_query = $wp_query;
    $wp_query = new WP_Query();
    $wp_query->query(array('paged' => $paged, 'post-type' => 'posts'));
    $more = 0;
    ?>
            <?php if (qs_get_meta('qs_remove_page_title', get_the_ID()) != '1') { ?>
        <hgroup class="twelve columns entry-title">
            <h1 class="">  
    <?php
    $page_title = qs_get_meta('qs_page_title', get_the_ID()) ? qs_get_meta('qs_page_title', get_the_ID()) : get_the_title();
    echo $page_title;
    ?>
            </h1>
            <h2 class="subtitle"><?php echo qs_get_meta('qs_page_subtitle', get_the_ID()); ?></h2>
        </hgroup>
        <?php } ?>

    <section class="eight columns">
        <?php
        /* Count the number of posts so we can insert a widgetized area */ $count = 1;
        ?>

        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                if (!get_post_format()) {
                    get_template_part('format', 'standard');
                } else {
                    get_template_part('format', get_post_format());
                }
            endwhile;
            ?>   





            <?php if (function_exists('page_navi')) { // if expirimental feature is active ?>

                <?php page_navi('', '', get_the_ID()); // use the page navi function ?>

    <?php } else { // if it is disabled, display regular wp prev & next links  ?>
                <nav class="wp-prev-next">
                    <ul class="clearfix">
                        <li class="prev-link"><?php next_posts_link(_e('', "qs_framework")) ?></li>
                        <li class="next-link"><?php previous_posts_link(_e('', "qs_framework")) ?></li>
                    </ul>
                </nav>
            <?php } ?>

<?php else : ?>

            <article id="post-not-found">
                <header>
                    <h1><?php _e("No Posts Yet", "qs_framework"); ?></h1>
                </header>
                <section class="post_content">
                    <p><?php _e("Sorry, What you were looking for is not here.", "qs_framework"); ?></p>
                </section>
                <footer>
                </footer>
            </article>

        <?php
        endif;

        echo '</section>';

        echo '<aside class="four columns last">';
        get_template_part('sidebar');
        echo '</aside>';

        if (isset($wp_query)) {
            $wp_query = $temp_query;
        } // Restore to original loop
        ?>


</div>