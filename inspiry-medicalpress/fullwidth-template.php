<?php
/*
*   Template Name: Full Width Template
*/

get_header();
get_template_part('template-parts/banner');
?>

<div class="page-top clearfix">
    <div class="container">
        <div class="row">
            <div class="<?php bc('9', '8', '7', ''); ?>">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <nav class="bread-crumb">
                    <?php theme_breadcrumb(); ?>
                </nav>
            </div>
            <div class="<?php bc('3', '4', '5', ''); ?>">
                <?php get_template_part('search-form'); ?>
            </div>
        </div>
    </div>
</div>


<div class="blog-page default-page full-width clearfix">
    <div class="container">
        <div class="row">

            <div class="<?php bc_all('12'); ?>">
                <div class="blog-page-single clearfix">
                    <?php
                    if (have_posts()):
                        while (have_posts()):
                            the_post();
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(' clearfix'); ?>>
                                <div class="full-width-contents">
                                    <header class="entry-header">
                                        <?php
                                        /* Page Featured Image */
                                        inspiry_standard_thumbnail('default-page');
                                        ?>
                                    </header>
                                    <div class="entry-content">
                                        <?php
                                        /* output page contents */
                                        the_content();

                                        // WordPress Link Pages
                                        wp_link_pages(array('before' => '<div class="page-nav-btns clearfix">', 'after' => '</div>', 'next_or_number' => 'next'));
                                        ?>
                                    </div>
                                </div>
                            </article>
                        <?php
                        endwhile;
                    endif;
                    ?>
                </div>

                <div class="row">
                    <div class="<?php bc_all('12'); ?>">
                        <?php comments_template(); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>
