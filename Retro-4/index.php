<?php get_header(); ?>

<?php get_template_part( 'nav' ); ?>

<main role="main">

    <section>

        <div class="section-inner section-blog <?php esc_attr_e( retro_text_color( get_queried_object() ) ); ?>" style="background-color: <?php esc_attr_e( retro_get_background_color( $post->ID ) ); ?>">

        	<hr class="top-dashed"> 

        	<div class="container">

                <div class="clear">

                    <div class="blog-list col col-9 tablet-full mobile-full">

                        <?php if ( have_posts() ) : ?>

                            <ul class="row clear">

                                <?php while ( have_posts() ) : ?>

                                    <?php the_post(); ?>

                                    <?php get_template_part( 'part', 'article' ); ?>

                                <?php endwhile; ?>

                            </ul>

                            <?php retro_paging_nav(); ?>

                        <?php else : ?>

                            <?php get_template_part( 'not-found' ); ?>

                        <?php endif; ?>             

                    </div><!-- blog-list -->  

                    <aside class="blog-sidebar col col-3 tablet-full mobile-full">

                        <?php get_sidebar(); ?>

                    </aside>          

                </div><!-- row -->               

            </div><!-- container -->

            <hr class="bottom-dashed"> 

        </div>

    </section>  

</main>

<?php get_footer(); ?>