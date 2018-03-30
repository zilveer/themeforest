<?php
get_header();
get_template_part('template-parts/banner');
?>

    <div class="page-top clearfix">
        <div class="container">
            <div class="row">
                <div class="<?php bc_all('12'); ?>">
                    <?php $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>
                    <h1><?php echo $current_term->name; ?></h1>
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
                <?php
                // The Loop
                if (have_posts()) {
                    /* decide appropriate bootstrap classes */
                    $bootstrap_classes = get_bc('4', '4', '6', '');
                    $loop_counter = 0;
                    while (have_posts()) {
                        the_post();
                        ?>
                        <div class="<?php echo $bootstrap_classes; ?>">
                            <article class="common clearfix hentry text-center">
                                <?php
                                if (has_post_thumbnail($post->ID)) {
                                    $image_id = get_post_thumbnail_id();
                                    $full_image_url = wp_get_attachment_url($image_id);
                                    ?>
                                    <figure class="overlay-effect">
                                        <a href="<?php echo $full_image_url; ?>" title="<?php the_title(); ?>">
                                            <?php the_post_thumbnail('gallery-post-single'); ?>
                                        </a>
                                        <a class="overlay" href="<?php echo $full_image_url; ?>"><i class="top"></i> <i class="bottom"></i></a>
                                    </figure>
                                <?php
                                }
                                ?>
                                <div class="content clearfix">
                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <div class="gallery-item-types"><?php the_terms($post->ID, 'gallery-item-type', ' ', ', ', ' '); ?></div>
                                </div>
                            </article>
                        </div>
                        <?php
                        $loop_counter++;
                        if (($loop_counter % 3) == 0) {
                            ?>
                            <div class="visible-md clearfix"></div>
                            <div class="visible-lg clearfix"></div>
                        <?php
                        } else if (($loop_counter % 2) == 0) {
                            ?>
                            <div class="visible-sm clearfix"></div>
                        <?php
                        }
                    }
                } else {
                    nothing_found(__('No gallery item found!','framework'));
                }
                ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>