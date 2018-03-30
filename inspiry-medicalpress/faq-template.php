<?php
/*
 *  Template Name: FAQs Template
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

<div class="faq-page clearfix">
    <div class="container">
        <div class="row">

            <div class="<?php bc('9', '8', '12', ''); ?>">
                <div class="row">

                    <!-- Filter -->
                    <div class="<?php bc_all('12'); ?>">
                        <ul id="filters">
                            <li class="active"><a class="no-isotope" href="#" data-filter="*"><?php _e('All FAQs', 'framework') ?></a></li>
                            <?php
                            $args = array(
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hide_empty' => true,
                            );
                            $tax_terms = get_terms('faq-group', $args);
                            if (!empty($tax_terms)) {
                                foreach ($tax_terms as $term) {
                                    echo '<li><a class="no-isotope" href="' . get_term_link($term->slug, $term->taxonomy) . '" data-filter=".' . $term->slug . '">' . $term->name . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="<?php bc_all('12'); ?>">
                        <div class="blog-page-single clearfix">
                            <?php
                            if (have_posts()):
                                while (have_posts()):
                                    the_post();
                                    ?>
                                    <article id="post-<?php the_ID(); ?>" <?php post_class(' clearfix'); ?>>
                                        <div class="full-width-contents">
                                            <div class="entry-content">
                                                <?php
                                                /* output page contents */
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

                    <div class="<?php bc_all('12'); ?>">
                        <?php
                        $faq_args = array(
                            'post_type' => 'faq',
                            'posts_per_page' => -1,
                        );

                        // The Query
                        $faq_query = new WP_Query($faq_args);

                        // The Loop
                        if ($faq_query->have_posts()) {
                            echo '<div class="toggle-main faq">';
                            while ($faq_query->have_posts()) {
                                $faq_query->the_post();

                                /* faq group terms slug needed to be used as classes in html for isotope functionality */
                                $faq_group_terms = get_the_terms($post->ID, 'faq-group');
                                if (!empty($faq_group_terms)) {
                                    $faq_group_terms_slugs = '';
                                    foreach ($faq_group_terms as $term) {
                                        if (!empty($faq_group_terms_slugs))
                                            $faq_group_terms_slugs .= ' ';

                                        $faq_group_terms_slugs .= $term->slug;
                                    }
                                }

                                ?>
                                <div class="toggle <?php echo $faq_group_terms_slugs; ?>">
                                    <div class="toggle-title">
                                        <h3><i class="fa fa-question"></i><?php the_title(); ?></h3>
                                    </div>
                                    <div class="toggle-content">
                                        <div class="entry-content">
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            echo '</div>';
                        } else {
                            nothing_found( __('No FAQ found!', 'framework') );
                        }

                        /* Restore original Post Data */
                        wp_reset_query();

                        ?>
                    </div>
                </div>
            </div>

            <div class="<?php bc('3', '4', '12', ''); ?>">
                <?php get_sidebar(); ?>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>
