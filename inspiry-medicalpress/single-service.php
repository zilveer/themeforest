<?php

get_header();
get_template_part('template-parts/banner');
?>

    <div class="page-top clearfix">
        <div class="container">
            <div class="row">
                <div class="<?php bc_all('12'); ?>">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <nav class="bread-crumb">
                        <?php theme_breadcrumb(); ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-page default-page service-page clearfix">
        <div class="container">
            <div class="row">

                <div class="<?php bc('9', '8', '12', ''); ?>">
                    <div class="blog-page-single clearfix">
                        <?php
                        if (have_posts()):
                            while (have_posts()):
                                the_post();
                                ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                                    <div class="page-contents">
                                        <header class="entry-header">
                                            <div class="gallery gallery-slider clearfix">
                                                <?php inspiry_list_gallery_images('service-gallery-thumb') ?>
                                            </div>
                                        </header>
                                        <div class="entry-content">
                                            <?php
                                            /* output contents */
                                            the_content();
                                            ?>
                                        </div>
                                    </div>
                                </article>
                            <?php
                            endwhile;
                        endif;
                        ?>
                    </div>

                </div>

                <div class="<?php bc('3', '4', '12', ''); ?>">
                    <?php
                    get_sidebar('service');
                    ?>
                </div>

            </div>
        </div>
    </div>

<?php get_footer(); ?>