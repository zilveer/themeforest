<?php
/*
 * Template Name: Testimonials
 */

global $mango_settings, $mango_layout_columns, $post;
$mango_layout_columns = mango_page_columns ();$mango_main_container = mango_main_container_class();
$testimonial_template = true;
$mango_class_name = mango_class_name ();
get_header ();
$args = array ( 'posts_per_page' => '-1', 'post_type' => 'testimonial' );
$wp_query = new WP_Query( $args ); ?>
<div class="<?php echo esc_attr($mango_main_container); ?> main">
                <div class="row">
                    <div class="<?php echo esc_attr($mango_class_name); ?>">
                    <?php if ( $wp_query->have_posts () ) {
                        while($wp_query->have_posts()){ $wp_query->the_post(); ?>
                        <article class="entry entry-list">
                            <div class="row">
                                <?php if(has_post_thumbnail()){ $class = "8"; ?>
                                    <div class="col-md-4">
                                    <?php get_template_part("content","thumbnail") ?>
                                    </div>
                                <?php }else{ $class = "12";   } ?>
                                <div class="col-md-<?php echo esc_attr($class); ?>">
                                    <div class="entry-wrapper">
                                        <span class="entry-date">
                                            <?php $date =  get_the_date('j-M');
                                            $date =  explode("-",$date);
                                            echo esc_attr($date[0]); ?>
                                            <span><?php  echo esc_attr($date[1]); ?></span>
                                        </span>
                                        <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                                    </div><!-- End .entry-wrapper -->
                                    <div class="entry-content testimonial">
                                        <blockquote class="blockquote-icon">
                                            <?php the_excerpt(); ?>
                                        <?php $author = get_post_meta ( get_the_ID(), 'mango_test_author_name', true ) ? get_post_meta ( get_the_ID(), 'mango_test_author_name', true ) : '';?>
                                        <?php if($author){?> <cite>-- <?php echo esc_attr($author); ?></cite> <?php } ?>
                                        </blockquote>
                                    </div><!-- End .entry-content -->
                                </div><!-- End .col-md-8 -->
                            </div><!-- End .row -->
                        </article>
                    <?php } } else {
                        get_template_part ( "content-none" );
                    } ?>
                    <?php wp_reset_postdata(); ?> 
                    </div><!-- End .col-md-* -->
                <div class="md-margin2x clearfix visible-sm visible-xs"></div><!-- space -->
                <?php  get_sidebar() ?>
                </div><!-- End .row -->
</div><!-- End .container -->

<div class="lg-margin hidden-xs hidden-sm"></div><!-- space -->

</section><!-- End #content -->
<?php get_footer () ?>