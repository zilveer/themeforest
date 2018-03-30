<?php
/*
Template Name: Gallery Page
*/

$content_col = 12;
get_header(); ?>

    <!--Main begin-->
<div id="main" class="round_8 clearfix row">

    <!-- Breadcrumb begin -->
    <div class="large-12 columns">
        <?php if (function_exists('pkb_breadcrumbs')) pkb_breadcrumbs(); ?>
    </div>
    <!-- Breadcrumb end -->

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <!-- Page title begin -->
    <div class="large-12 columns">
        <div class="page_title round_6">
            <h1 class="replace">
                <?php if (is_front_page()) { ?>
                    <?php the_title(); ?>
                <?php } else { ?>
                    <?php the_title(); ?>
                <?php } ?>
            </h1>
        </div>
    </div>
    <!-- Page title end -->

    <div id="content-clear" class="large-<?php echo $content_col ?> columns">

        <!-- Filter Bar begin -->
        <div id="filter-bar-container">
            <ul id="filter-bar" class="clearfix" data-option-key="filter">
                <li class="segment-1"><a class="selected all" data-option-value="*"
                                         href="#"><?php _e('All', 'peekaboo'); ?></a></li>
                <?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'media-type', 'walker' => new Walker_Category_Filter())); ?>
            </ul>
        </div>
        <!-- Filter Bar end -->

        <?php endwhile; ?>
        <?php
        $galleryPostsNumberQuery = -1; ?>

        <?php  $wp_query = new WP_Query();
        $wp_query->query('post_type=gallery&posts_per_page=' . $galleryPostsNumberQuery . ''); ?>

        <!-- Gallery Wrap begin -->
        <div id="gallery-wrapper">

            <?php
            $galleryColNumber = $smof_data['pkb_gallery_col_thumb'];
            if ($galleryColNumber) {
                $galleryPostColNumber = 'large-block-grid-' . $galleryColNumber . ' small-block-grid-2';
            } else {
                $galleryPostColNumber = 'large-block-grid-3 small-block-grid-2';
            };
            ?>
            <!-- Module Wrapper begin-->
            <ul id="module-wrapper" class="<?php echo $galleryPostColNumber ?>">

                <?php $count = 1; ?>
                <?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();
                    $terms = get_the_terms(get_the_ID(), 'media-type');  ?>

                    <li class="<?php foreach ($terms as $term) {
                        echo strtolower(preg_replace('/\s+/', '-', $term->name)) . ' ';
                    } ?> module" data-id="id-<?php echo $count; ?>">

                        <!-- Post begin -->
                        <div id="post-<?php the_ID(); ?>" <?php post_class('gallery_module'); ?> >

                            <?php
                            if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
                                ?>
                                <div class="post-thumbnail">
                                    <?php pkb_colorbox(get_the_ID(), 'pkb-gallery-thumbnail'); ?>
                                </div>
                            <?php } ?>

                            <h4 class="post-title"><a href="<?php the_permalink(); ?>"
                                                      title="<?php printf(__('Link to %s', 'peekaboo'), get_the_title()); ?>"><?php the_title(); ?></a>
                            </h4>

                        </div>
                        <!-- Post end -->
                    </li>
                    <?php $count++; ?>
                <?php endwhile; endif; ?>

            </ul>

            <?php if (function_exists("pkb_pagination")) {
                pkb_pagination();
            } ?>

            <!-- Module Wrapper end-->
            <?php wp_reset_query(); ?>
        </div>
        <!-- Gallery Wrap end -->


    </div>

<?php get_footer(); ?>