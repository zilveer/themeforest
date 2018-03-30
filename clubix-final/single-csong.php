<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$prefix = Haze_Meta_Boxes::get_instance()->prefix;

global $clx_data;

get_header(); ?>

    <!-- ================================================== -->
    <!-- =============== START BREADCRUMB ================ -->
    <!-- ================================================== -->
    <div class="container">
        <div class="row">
            <div class="breadcrumb-container clearfix">

                <!-- BREADCRUMB TITLE -->
                <h1><?= $clx_data['songs-label']; ?></h1>

                <!-- BREADCRUMB -->
                <?= zen_breadcrumbs(); ?>

            </div>
        </div>
    </div>
    <!-- ================================================== -->
    <!-- =============== END BREADCRUMB ================ -->
    <!-- ================================================== -->

    <!-- ================================================== -->
    <!-- =============== START CONTENT-CONTAINER ================ -->
    <!-- ================================================== -->
    <div class="container">
    <div class="row">
    <div class="content-container">
    <div class="content-container-inner clearfix">


    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <div class="col-sm-4">
            <div class="container-row">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="widget album-widget">
                            <figure class="clearfix">

                                <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                <figcaption>
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('song_single'); ?></a>
                                </figcaption>
                                <?php endif; ?>

                                <div class="col-sm-3" style="margin-left:0;">
                                    <p>
                                        <?php
                                        $release_date = rwmb_meta("{$prefix}song_release_date");
                                        if($release_date != '') :
                                        ?>
                                        <?php _e('Release date', LANGUAGE_ZONE) ?>
                                        <span>
                                            <?php echo $release_date; ?>
                                        </span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <?php clx_genres(2); ?>
                                    </p>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-row">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="widget">
                            <div class="minimal-player">
                                <?php echo clx_simple_song_player(array(get_the_ID())); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="container-row">
                <div class="row">
                    <div class="col-sm-12">
                        <article class="post-article single-post clearfix">
                            <div class="content-article clearfix">
                                <h1>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h1>
                                <div class="entry-meta">

                                </div>
                                <hr>
                                <div class="entry-content">
                                    <?php echo do_shortcode(rwmb_meta("{$prefix}song_description")); ?>
                                </div>

                            </div>
                        </article>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- ============== COMMENTS CONTAINER ============= -->
                        <div class="comment-container">
                            <div class="col-sm-12">
                                <!-- ============== COMMENTS CONTAINER ============= -->
                                <?php comments_template('', true); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endwhile; ?>

    <?php else : ?>

        <?php
        /* Get the none-content template (error) */
        get_template_part( 'content', 'none' );
        ?>

    <?php endif; ?>

    </div>
    </div>
    </div>
    </div>
    <!-- ================================================== -->
    <!-- =============== END CONTENT-CONTAINER ================ -->
    <!-- ================================================== -->

<?php get_footer(); ?>