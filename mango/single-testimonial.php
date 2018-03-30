<?php
/**
 * Testimonial Single Template
 * * @subpackage mango
 * @since Mango 1.0
 */

global $mango_settings, $args, $mango_layout_columns, $post;
$mango_layout_columns = mango_page_columns ();
$mango_class_name = mango_class_name ();
$containerClass = mango_main_container_class();
get_header (); ?>
    <div class="<?php echo esc_attr($containerClass); ?> main">
                <div class="row">
                    <div class="<?php echo esc_attr($mango_class_name); ?>">
                            <?php while ( have_posts () ) : the_post (); ?>
                            <article class="single testimonial">
                                <?php  if(has_post_thumbnail()){
                                    get_template_part("content-thumbnail");
                                } ?>
                                <h2 class="entry-title"><?php the_title(); ?></h2>
                                <div class="entry-meta">
                                    <?php  _e("Posted at",'mango') ?> <span class="entry-meta-date"><?php the_time('h:i A, j F Y') ?></span>
                                </div><!-- End .entry-meta -->
                                <div class="entry-content ">
                                    <blockquote class="blockquote-icon">
                                        <?php the_content(); ?>
                                        <?php $author = get_post_meta ( get_the_ID(), 'mango_test_author_name', true ) ? get_post_meta ( get_the_ID(), 'mango_test_author_name', true ) : '';?>
                                        <?php if($author){?> <cite>-- <?php echo esc_attr($author); ?></cite> <?php } ?>
                                    </blockquote>
                                </div><!-- End .entry-content -->
                                <?php mango_add_social_share() ?>
                            </article>
                                                <?php endwhile; ?>
                                                <?php wp_reset_postdata(); ?>
                                        </div><!-- End .col-md-* -->
                                        <div class="md-margin2x clearfix visible-sm visible-xs"></div><!-- space -->
                                    <?php  get_sidebar() ?>
                </div><!-- End .row -->
    </div><!-- End .container -->
    <div class="lg-margin hidden-xs hidden-sm"></div><!-- space -->
    </section><!-- End #content -->
<?php get_footer () ?>