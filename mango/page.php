<?php
/**
 * The main page template
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage mango
 * @since Mango 1.0
 */

global $mango_settings,$args,$mango_layout_columns, $post;
$mango_layout_columns = mango_page_columns();
$mango_class_name = mango_class_name ();
get_header();
$containerClass = mango_main_container_class();
?>
   <div class="<?php echo esc_attr($containerClass); ?> main">
                <div class="row">
                    <div class="<?php echo esc_attr($mango_class_name); ?>">
                            <?php while(have_posts()) : the_post(); ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="page">
                                        <?php the_content(); ?>
										<?php
										   wp_link_pages( array(
											'before' => '<div class="page-links">' . __( 'Pages:', 'coolthing' ),
											'after'  => '</div>',
										   ) );
										?>
                                    </div>
									<footer class="entry-footer">
										  <?php edit_post_link( __( 'Edit', 'coolthing' ), '<span class="edit-link">', '</span>' ); ?>
									</footer><!-- .entry-footer -->
                                    <?php mango_add_social_share(); ?>
                                </div>
                            <?php if ( $mango_settings['page-comment'] ) :
                                        comments_template();
                                 endif;
                            ?>
                        <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    </div><!-- End .col-md-* -->
                    <div class="md-margin2x clearfix visible-sm visible-xs"></div><!-- space -->
               <?php  get_sidebar() ?>
                </div><!-- End .row -->
    </div><!-- End .container -->
        <div class="lg-margin hidden-xs hidden-sm"></div><!-- space -->
    </section><!-- End #content -->
<?php get_footer() ?>