<?php
/**
 * Template Name: Testimonials archive
 */
get_header();
?>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div id="primary" class="full-width">
                    <main id="main" class="site-main" role="main">
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <h1 class="showcase-entry-title"><?php the_title(); ?></h1>
                            </header><!-- .entry-header -->
                            <div class="entry-content clearfix">
                                <div id="filters" class="button-group clearfix">
                                    <h2><?php _e( 'Filter by', 'commercegurus' ); ?></h2> 

                                    <button class="button is-checked" data-filter-value="*">All</button>
                                    <?php
                                    $args = array(
                                        'orderby' => 'name',
                                        'order' => 'ASC',
                                        'number' => 20, // how many categories
                                    );
                                    ?>
                                </div>
                                <div class="row">
                                    <div id="showcase-wrap" class="fourcolwrap">
                                        <div id="sclist-wrap" class="isotope">
                                            <?php
                                            $args = array(
                                                'post_type' => 'testimonials',
                                                'orderby' => 'menu_order',
                                                'order' => 'ASC',
                                                'posts_per_page' => -1
                                            );
                                            $query = new WP_Query( $args );

                                            while ( $query->have_posts() ) : $query->the_post();
                                                ?>
                                                <?php
                                                global $post;
                                                $testimonial_name = get_post_meta( $post->ID, '_cg_testimonial_name', true );
                                                $testimonial_org_name = get_post_meta( $post->ID, '_cg_testimonial_org_name', true );
                                                echo '

                                             	<h2>' . $testimonial_name . '</h2>
                                             	<h5>' . $testimonial_org_name . '<h5>
                                             	
                                             	';
                                                ?>
                                            <?php endwhile; ?>
                                            <?php wp_reset_postdata(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .entry-content -->
                        </article><!-- #post-## -->
                        <?php
                        $cg_comments_status = $cg_options['cg_page_comments'];
                        if ( $cg_comments_status == 'yes' ) {
                            if ( comments_open() || '0' != get_comments_number() ) {
                                comments_template();
                            }
                        }
                        ?> 
                    </main>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
