<?php
get_header();

get_template_part('template-parts/banner');

global $theme_options;
$display_doctor_department = $theme_options['display_doctor_department'];
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

<div class="doctors-posts doctors-page clearfix">

    <div class="container">
        <div class="row">

            <!-- Filter -->
            <div class="<?php bc_all('12'); ?>">
                <ul id="filters">
                    <li class="active"><a href="#" data-filter="*"><?php _e('All Departments', 'framework') ?></a></li>
                    <?php
                    global $post;
                    $args = array(
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'hide_empty' => true,
                    );
                    $tax_terms = get_terms('department', $args);
                    if (!empty($tax_terms)) {
                        foreach ($tax_terms as $term) {
                            echo '<li><a href="' . get_term_link($term->slug, $term->taxonomy) . '" data-filter=".' . $term->slug . '">' . $term->name . '</a></li>';
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

        </div>
    </div>

    <div class="container isotope-wrapper text-center">
        <div class="row">
            <div id="isotope-container" class="clearfix">

                <?php
                $args = array(
                    'post_type' => 'doctor',
                    'posts_per_page' => -1,
                );

                $doctor_query = new WP_Query($args);

                if ($doctor_query->have_posts()) {

                    /* decide appropriate bootstrap classes and appropriate thumbnail size */
                    $bootstrap_classes = '';
                    $thumbnail_size = 'gallery-post-single';

                    if (is_page_template('doctors-four-col-template.php')) {
                        $bootstrap_classes = get_bc('3', '4', '6', '');
                    } else if (is_page_template('doctors-three-col-template.php')) {
                        $bootstrap_classes = get_bc('4', '4', '6', '');
                    } else if (is_page_template('doctors-two-col-template.php')) {
                        $bootstrap_classes = get_bc('6', '6', '6', '');
                    }

                    while ($doctor_query->have_posts()) {
                        $doctor_query->the_post();

                        /* department terms slug needed to be used as classes in html for isotope functionality */
                        $doc_terms = get_the_terms($post->ID, 'department');
                        if (!empty($doc_terms)) {
                            $doc_terms_slugs = '';
                            foreach ($doc_terms as $term) {
                                if (!empty($doc_terms_slugs))
                                    $doc_terms_slugs .= ' ';

                                $doc_terms_slugs .= $term->slug;
                            }
                        }

                        ?>
                        <div class="isotope-item <?php echo $doc_terms_slugs; ?> <?php echo $bootstrap_classes; ?>">
                            <article class="common-doctor clearfix hentry">
                                <?php inspiry_standard_thumbnail($thumbnail_size); ?>
                                <div class="text-content">
                                    <h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    <?php if( $display_doctor_department ) : ?>
                                        <div class="doctor-departments"><?php the_terms($post->ID, 'department', ' ', ', ', ' '); ?></div>
                                    <?php endif; ?>
                                    <div class="for-border"></div>
                                    <p class="entry-summary">
                                        <?php
                                        $intro_text = get_post_meta($post->ID, 'doctor_intro_text', true);
                                        if ( !empty($intro_text) ) {
                                            echo $intro_text;
                                        }
                                        ?>
                                    </p>
                                    <?php get_template_part('template-parts/doctor-social-icons'); ?>
                                </div>
                            </article>
                        </div>
                    <?php
                    }
                } else {
                    nothing_found(__('No doctor found !', 'framework'));
                }

                /* Restore original Post Data */
                wp_reset_query();
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>
