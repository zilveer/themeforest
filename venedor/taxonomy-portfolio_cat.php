<?php
get_header();
global $venedor_settings, $wp_query;

$term_title = $wp_query->queried_object->name;
$term_description = $wp_query->queried_object->description;
?>
<div id="content" class="portfolio-cat-content" role="main">

    <h1 class="page-title">
        <?php printf( __( 'Archives: %s', 'venedor' ), '<span>' . $term_title . '</span>' ); ?>
    </h1>

    <?php if (!empty($term_description)) { ?>
        <div class="title-desc"><?php echo $term_description; ?></div>
    <?php } ?>

    <?php /* The loop */ ?>
    <?php if (have_posts()) : ?>

        <?php while ( have_posts() ) : the_post(); ?>
            <?php
            $slideshow_type = get_post_meta($post->ID, 'slideshow_type', true);
            global $previousday; unset($previousday);
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

                <div class="portfolio-content-wrap">
                    <div class="portfolio-content">
                        <div class="sub-content row">
                            <div class="col-md-5 col-sm-6">
                                <?php get_template_part('slideshow-portfolio'); ?>
                            </div>
                            <div class="col-md-7 col-sm-6">
                                <h2 class="portfolio-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>

                                <div class="entry-content">
                                    <p><?php echo venedor_excerpt(45); ?></p>
                                </div>
                                <div class="entry-meta">
                                    <div class="meta-item meta-date"><div class="meta-inner"><span class="fa fa-calendar"></span> <?php the_date() ?> <?php the_time(); ?></div></div>
                                    <div class="meta-item meta-cat"><div class="meta-inner"><span class="fa fa-folder-open"></span> <?php echo get_the_term_list($post->ID, 'portfolio_cat', '', ', ', ''); ?></div></div>
                                    <div class="meta-item meta-skill"><div class="meta-inner"><span class="fa fa-legal"></span> <?php echo get_the_term_list($post->ID, 'portfolio_skills', '', ', ', ''); ?></div></div>
                                    <?php if (get_post_meta($post->ID, 'portfolio_link', true)) : ?>
                                    <div class="meta-item meta-link"><div class="meta-inner"><span class="fa fa-external-link-square"></span> <a href="<?php echo get_post_meta($post->ID, 'portfolio_link', true); ?>"><?php echo get_post_meta($post->ID, 'portfolio_link', true); ?></a></div></div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <?php venedor_pagination($wp_query->max_num_pages, $range = 2);
        wp_reset_postdata(); ?>

    <?php else : ?>
        <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'venedor' ); ?></p>
        <?php get_search_form(); ?>
    <?php endif;
    wp_reset_postdata(); ?>


</div>

<?php get_footer(); ?>