<?php get_header();
#Emulate default settings for page without personal ID
$gt3_pagebuilder = get_default_pb_settings();
?>

<div class="content_wrapper <?php echo ((isset($gt3_pagebuilder['settings']['show_breadcrumb']) && $gt3_pagebuilder['settings']['show_breadcrumb'] == "yes" && get_theme_option("show_breadcrumb") !== "off") ? 'withbreadcrumb' : 'withoutbreadcrumb') ?>">
    <div class="container">
        <div class="content_block <?php echo esc_attr($gt3_pagebuilder['settings']['layout-sidebars']) ?> row">
            <div class="fl-container <?php echo (($gt3_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                <div class="row">
                    <div class="posts-block <?php echo (($gt3_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" || $gt3_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                        <div class="contentarea">
                            <?php
                            echo '<div class="row-fluid"><div class="span12">';

                            global $paged;
                            $foundSomething = false;

                            if ($paged < 1) {
                                $args = array(
                                    'numberposts' => -1,
                                    'post_type' => 'any',
                                    'meta_query' => array(
                                        array(
                                            'key' => 'pagebuilder',
                                            'value' => get_search_query(),
                                            'compare' => 'LIKE',
                                            'type' => 'CHAR'
                                        )
                                    )
                                );
                                $query = new WP_Query( $args );
                                while ($query->have_posts()) : $query->the_post();
                                    get_template_part("bloglisting");
                                    $foundSomething = true;
                                endwhile;
                                wp_reset_query();
                            }

                            $defaults = array('numberposts' => 10, 'post_type' => 'any', 'post_status' => 'publish', 'post_password' => '', 'suppress_filters' => false, 's' => get_search_query(), 'paged' => $paged);
                            $query = http_build_query($defaults);
                            $posts = get_posts( $query );

                            foreach( $posts as $post ) {
                                setup_postdata($post);
                                get_template_part("bloglisting");
                                $foundSomething = true;
                            }
                            get_pagination();

                            if ($foundSomething == false) {
                                ?>
                                <div class="" style="width:100%; text-align: center;">
                                    <h1 class="title404"><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("translator_oops") : __('Oops!','theme_localization')); ?> <?php echo ((get_theme_option("translator_status") == "enable") ? get_text("translator_header_404") : __('Not Found :(','theme_localization')); ?></h1>
                                    <div class="text404"><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("translator_text_404") : __('Apologies, but we were unable to find what you were looking for.','theme_localization')); ?></div>
                                    <div class="search_form_wrap">
                                        <form name="search_field" method="get" action="<?php echo home_url(); ?>" class="search_form" style="margin-top: 14px; margin-bottom: 40px;">
                                            <input type="text" name="s" value="<?php (get_theme_option("translator_status") == "enable") ? the_text("translator_search_value") : _e('Search the site...','theme_localization'); ?>" title="<?php (get_theme_option("translator_status") == "enable") ? the_text("translator_search_value") : _e('Search the site...','theme_localization'); ?>" class="field_search">
                                        </form>
                                    </div>
                                </div>
                            <?php
                            }

                            echo '</div><div class="clear"></div></div>';
                            ?>
                        </div>
                    </div>
                    <?php get_sidebar('left'); ?>
                </div>
            </div>
            <?php get_sidebar('right'); ?>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>