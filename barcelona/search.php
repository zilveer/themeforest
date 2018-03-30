<?php

get_header();

barcelona_breadcrumb();

$barcelona_search_query = esc_html(get_search_query());

?>
    <div class="container">

        <div class="<?php echo esc_attr(barcelona_row_class()); ?>">

            <main id="main" class="<?php echo esc_attr(barcelona_main_class()); ?>">

                <div class="box-header search-header has-title">
                    <h2 class="title">
                        <?php printf(esc_html__('Search Results for: %s', 'barcelona'), $barcelona_search_query); ?>
                    </h2>
                </div>

                <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                    <div class="input-group in-search-box">
                        <span class="input-group-btn"><button type="submit" class="btn btn-default"><span
                                    class="fa fa-search"></span></button></span>
                        <input type="text" name="s" class="form-control"
                               placeholder="<?php esc_html_e('Search&hellip;', 'barcelona'); ?>"
                               value="<?php echo esc_attr($barcelona_search_query); ?>"/>
                    </div>
                </form>

                <?php

                $barcelona_mod_post_meta = barcelona_get_option('post_meta_choices');

                include(locate_template('includes/modules/module-' . barcelona_get_option('posts_layout') . '.php'));

                barcelona_pagination(barcelona_get_option('pagination'));

                ?>
            </main>

            <?php get_sidebar(); ?>

        </div><!-- .row -->

    </div><!-- .container -->
<?php

get_footer();