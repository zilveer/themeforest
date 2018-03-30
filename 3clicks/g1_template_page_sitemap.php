<?php
/**
 * Template Name: Page: Sitemap
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php get_header(); ?>
        <div id="primary">
            <div id="content" role="main">
               <?php while ( have_posts() ) : the_post(); ?>



                   <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                       <?php
                       global $post;
                       $elems = G1_Elements()->get();

                       $title = $elems[ 'title' ] ? the_title( '', '', false ) : '';
                       $subtitle = wp_kses_data( get_post_meta( $post->ID, '_g1_subtitle', true ) );
                       ?>

                       <?php if( strlen( $title ) || strlen( $subtitle ) ): ?>
                       <header class="entry-header">
                            <div class="g1-hgroup">
                            <?php if ( strlen( $title ) ): ?>
                                <h1 class="entry-title"><?php echo $title; ?></h1>
                            <?php endif; ?>

                            <?php if ( strlen( $subtitle ) ) : ?>
                                <h3 class="entry-subtitle"><?php echo $subtitle; ?></h3>
                            <?php endif; ?>
                           </div>
                       </header><!-- .entry-header -->
                       <?php endif; ?>

                       <!-- BEGIN .entry-content -->
                       <div class="entry-content">

                           <div class="g1-grid">
                               <div class="g1-column g1-one-third">
                                   <h2><?php _e( 'Pages', 'g1_theme' ); ?></h2>
                                   <div class="g1-links">
                                       <ul>
                                           <?php wp_list_pages( 'title_li=' ); ?>
                                       </ul>
                                   </div>
                               </div>
                               <div class="g1-column g1-one-third">
                                   <h2><?php _e( 'Site Feeds', 'g1_theme' ); ?></h2>
                                   <div class="g1-links">
                                       <ul>
                                           <li><a href="feed:<?php bloginfo( 'rss2_url' ); ?>"><?php _e( 'Main RSS Feed', 'g1_theme' ); ?></a></li>
                                           <li><a href="feed:<?php bloginfo( 'comments_rss2_url' ); ?>"><?php _e( 'Comment RSS Feed', 'g1_theme' ); ?></a></li>
                                       </ul>
                                   </div>
                               </div>
                           </div><!-- .grid -->

                           <?php echo do_shortcode( '[divider_top]' ); ?>

                           <?php if ( get_option( 'page_for_posts') ): ?>
                           <h2><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></a></h2>
                           <?php else: ?>
                           <h2><?php _e( 'Blog', 'g1_theme' ); ?></h2>
                           <?php endif; ?>

                           <div class="g1-grid">
                               <div class="g1-column g1-one-third">
                                   <h3><?php _e( 'Latest entries', 'g1_theme' ); ?></h3>
                                   <div class="g1-links">
                                       <ul>
                                           <?php wp_get_archives( 'type=postbypost&limit=10' ); ?>
                                       </ul>
                                   </div>
                               </div>
                               <div class="g1-column g1-one-third">
                                   <h3><?php _e( 'Category Archives', 'g1_theme' ); ?></h3>
                                   <div class="g1-links">
                                       <ul>
                                           <?php wp_list_categories( 'title_li=' ); ?>
                                       </ul>
                                   </div>
                               </div>
                               <div class="g1-column g1-one-third">
                                   <h3><?php _e( 'Tag Archives', 'g1_theme' ); ?></h3>
                                   <?php wp_tag_cloud(); ?>
                               </div>
                           </div><!-- .grid -->

                           <?php
                           $g1_post_types = get_post_types(
                               array(
                                   'publicly_queryable'    => true,
                                   '_builtin'              => false,
                               )
                           );
                           /* Do you want to remove unwanted post types from our sitemap?
                            * Just hook into the 'g1_sitemap_post_types' custom filter.
                            */
                           $g1_post_types = apply_filters( 'g1_sitemap_post_types', $g1_post_types );
                           ?>
                            <?php foreach( $g1_post_types as $g1_post_type ): ?>
                            <?php
                                // Prepare variables
                                $g1_class = array(
                                    'g1-sitemap-post-type-' . $g1_post_type,
                                );

                                $g1_obj = get_post_type_object( $g1_post_type );
                                $g1_label = $g1_obj->labels->name;
                            ?>
                            <?php echo do_shortcode( '[divider_top]' ); ?>
                            <section class="<?php echo sanitize_html_classes( $g1_class ); ?>">
                                <header>
                                    <h2>
                                        <a href="<?php echo get_post_type_archive_link( $g1_post_type ); ?>">
                                            <?php echo $g1_label; ?>
                                        </a>
                                    </h2>
                                </header>
                                <div class="g1-grid">
                                    <div class="g1-column g1-one-third">
                                        <h3><?php _e( 'Latest entries', 'g1_theme' ); ?></h3>
                                        <?php
                                            $g1_query = new WP_Query( array(
                                                'post_type'             => $g1_post_type,
                                                'ignore_sticky_posts'	=> true,
                                                'posts_per_page'        => 10,
                                            ));
                                        ?>
                                        <?php if ( $g1_query->have_posts() ): ?>
                                        <div class="g1-links">
                                            <ul>
                                                <?php while ( $g1_query->have_posts() ): $g1_query->the_post(); ?>
                                                <li>
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </li>
                                                <?php endwhile; ?>
                                                <?php
                                                    // End of our custom loop, It's time to restore the global post object
                                                    wp_reset_postdata();
                                                ?>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                        // Get available hierarchical taxonomies (something like categories)
                                        $g1_categories = get_taxonomies(
                                            array(
                                                'query_var'             => true,
                                                'hierarchical'          => true,
                                                'object_type'           => array( $g1_post_type ),
                                            ),
                                            'objects'
                                        );
                                        /* Do you want to remove categories from our sitemap?
                                         * Just hook into the 'g1_sitemap_categories' custom filter.
                                         */
                                        $g1_categories = apply_filters( 'g1_sitemap_categories', $g1_categories, $g1_post_type );
                                    ?>
                                    <?php if ( count( $g1_categories ) ): ?>
                                    <div class="g1-column g1-one-third">
                                        <?php foreach ( $g1_categories as $g1_category => $g1_category_obj ): ?>
                                        <div>
                                            <h3><?php echo $g1_category_obj->labels->name; ?></h3>
                                            <div class="g1-links">
                                                <ul>
                                                    <?php wp_list_categories( 'title_li=&taxonomy=' . $g1_category ); ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php
                                        // Get available hierarchical taxonomies (something like categories)
                                        $g1_tags = get_taxonomies(
                                            array(
                                                'query_var'             => true,
                                                'hierarchical'          => false,
                                                'object_type'           => array( $g1_post_type ),
                                            ),
                                            'objects'
                                        );
                                        /* Do you want to remove tags from our sitemap?
                                         * Just hook into the 'g1_sitemap_tags' custom filter.
                                         */
                                        $g1_tags = apply_filters( 'g1_sitemap_tags', $g1_tags, $g1_post_type );
                                    ?>
                                    <?php if ( count( $g1_tags ) ): ?>
                                    <div class="g1-column g1-one-third">
                                        <?php foreach ( $g1_tags as $g1_tag => $g1_tag_obj ): ?>
                                        <div>
                                            <h3><?php echo $g1_tag_obj->labels->name; ?></h3>
                                            <?php wp_tag_cloud( 'taxonomy=' . $g1_tag ); ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div><!-- .g1-grid -->
                            </section>
                            <?php endforeach; ?>

                            <?php do_action( 'g1_sitemap' ); ?>

                        </div>
                        <!-- END .entry-content -->
                        <footer class="entry-meta">
                            <?php edit_post_link( __( 'Edit', 'g1_theme' ), '<span class="edit-link">', '</span>' ); ?>
                        </footer>
                    </article><!-- #post-<?php the_ID(); ?> -->

                    <?php comments_template( '', true ); ?>

                <?php endwhile; ?>

            </div><!-- #content -->
        </div><!-- #primary -->

<?php get_footer(); ?>