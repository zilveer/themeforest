<?php
get_header();
get_template_part('template-parts/banner');

global $theme_options;
$display_gallery_categories = $theme_options['display_gallery_categories'];
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

<div class="gallery-page clearfix">

    <div class="container">
        <div class="row">

            <div class="<?php bc_all('12'); ?>">
                <div class="blog-page-single clearfix">
                    <?php
                    if (have_posts()):
                        while (have_posts()):
                            the_post();
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
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
                <ul id="filters">
                    <li class="active"><a href="#" data-filter="*"><?php _e('All', 'framework'); ?></a></li>
                    <?php
                    global $post;
                    $args = array(
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'hide_empty' => true,
                    );
                    $tax_terms = get_terms('gallery-item-type', $args);
                    if (!empty($tax_terms)) {
                        foreach ($tax_terms as $term) {
                            echo '<li><a href="#" data-filter=".' . $term->slug . '">' . $term->name . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>

        </div>
    </div>

    <div class="container isotope-wrapper text-center">
        <div class="row">
            <div id="isotope-container" class="clearfix">

                <?php
                $args = array(
                    'post_type' => 'gallery-item',
                    'posts_per_page' => -1,
                );

                // The Query
                $gallery_query = new WP_Query($args);

                // The Loop
                if ($gallery_query->have_posts()) {

                    /* decide appropriate bootstrap classes */
                    $bootstrap_classes = '';
                    if (is_page_template('gallery-four-col-template.php')) {
                        $bootstrap_classes = get_bc('3', '4', '6', '');
                    } else if (is_page_template('gallery-three-col-template.php')) {
                        $bootstrap_classes = get_bc('4', '4', '6', '');
                    } else if (is_page_template('gallery-two-col-template.php')) {
                        $bootstrap_classes = get_bc('6', '6', '6', '');
                    }

                    while ($gallery_query->have_posts()) {
                        $gallery_query->the_post();

                        /* department terms slug needed to be used as classes in html for isotope functionality */
                        $gallery_item_terms = get_the_terms($post->ID, 'gallery-item-type');
                        if (!empty($gallery_item_terms)) {
                            $gallery_terms_slugs = '';
                            foreach ($gallery_item_terms as $term) {
                                if (!empty($gallery_terms_slugs))
                                    $gallery_terms_slugs .= ' ';

                                $gallery_terms_slugs .= $term->slug;
                            }
                        }

                        ?>
                        <div class="isotope-item <?php echo $gallery_terms_slugs; ?> <?php echo $bootstrap_classes; ?>">
                            <article class="common clearfix hentry <?php if (is_page_template('gallery-four-col-template.php')) {
                                    echo 'four-col-gallery';
                                } ?>">
                                <?php
                                if (has_post_thumbnail($post->ID)) {
                                    $image_id = get_post_thumbnail_id();
                                    $full_image_url = wp_get_attachment_url($image_id);
                                    ?>
                                    <figure class="overlay-effect">
                                        <?php the_post_thumbnail('gallery-post-single'); ?>
                                        <a class="overlay" href="<?php echo $full_image_url; ?>"><i class="top"></i> <i class="bottom"></i></a>
                                    </figure>
                                <?php
                                }
                                ?>
                                <div class="content clearfix">
                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                                    <?php if($display_gallery_categories) : ?>
                                        <div class="gallery-item-types"><?php the_terms($post->ID, 'gallery-item-type', ' ', ', ', ' '); ?></div>
                                    <?php endif; ?>
                                </div>
                            </article>
                        </div>

                    <?php
                    }
                } else {
                    nothing_found(__('No gallery item found!', 'framework'));
                }

                /* Restore original Post Data */
                wp_reset_query();
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
