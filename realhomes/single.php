<?php
get_header();
?>

        <!-- Page Head -->
        <?php get_template_part("banners/blog_page_banner"); ?>

        <!-- Content -->
        <div class="container contents single">
            <div class="row">
                <div class="span9 main-wrap">
                    <!-- Main Content -->
                    <div class="main">

                        <div class="inner-wrapper">
                            <?php
                            if ( have_posts() ) :
                                while ( have_posts() ) :
                                    the_post();

                                    $format = get_post_format();
                                    if( false === $format ) { $format = 'standard'; }

                                    ?>
                                    <article  <?php post_class(); ?>>
                                            <header>
                                                <h3 class="post-title"><?php the_title(); ?></h3>
                                                <div class="post-meta <?php echo $format; ?>-meta thumb-<?php echo has_post_thumbnail()?'exist':'not-exist'; ?>">
                                                    <span> <?php _e('Posted on', 'framework'); ?>  <span class="date"> <?php the_time('F d, Y'); ?> </span></span>
                                                    <span> <?php _e('by', 'framework'); ?> <?php the_author(); ?> <?php _e('in', 'framework'); ?>  <?php the_category(', '); ?>  </span>
                                                </div>
                                            </header>
                                            <?php
                                            get_template_part( 'post-formats/' . $format );
                                            the_content();
                                            ?>
                                    </article>
                                    <?php

                                    wp_link_pages(array('before' => '<div class="pages-nav clearfix">', 'after' => '</div>', 'next_or_number' => 'next'));

                                endwhile;
                                comments_template();
                            endif;
                            ?>
                        </div>

                    </div><!-- End Main Content -->

                </div> <!-- End span9 -->

                <?php get_sidebar(); ?>

            </div><!-- End contents row -->

        </div><!-- End Content -->

<?php get_footer(); ?>