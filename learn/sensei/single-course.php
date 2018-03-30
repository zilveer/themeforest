<?php
/**
 * The Template for displaying all single courses.
 *
 * Override this template by copying it to yourtheme/sensei/single-course.php
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */
?>

<?php  get_sensei_header();  global $post, $woothemes_sensei; ?>

<article <?php post_class( array( 'course', 'post' ) ); ?>>

    <section class="entry fix">

        <div class="row">

            <div class="col-md-8">
                <?php

                /**
                 * Hook inside the single course post above the content
                 *
                 * @since 1.9.0
                 *
                 * @param integer $course_id
                 *
                 * @hooked Sensei()->frontend->sensei_course_start     -  10
                 * @hooked Sensei_Course::the_title                    -  10
                 * @hooked Sensei()->course->course_image              -  20
                 * @hooked Sensei_WC::course_in_cart_message           -  20
                 * @hooked Sensei_Course::the_course_enrolment_actions -  30
                 * @hooked Sensei()->message->send_message_link        -  35
                 * @hooked Sensei_Course::the_course_video             -  40
                 */

                do_action( 'sensei_single_course_content_inside_before',array( 'Sensei_Course', 'the_title'), 10 );
                
                
                ?>

                <article <?php post_class( array( 'course', 'post' ) ); ?>>

                    
                    <?php

                    /**
                     * @hooked Sensei()->course->the_progress_statement - 15
                     * @hooked Sensei()->course->the_progress_meter - 16
                     */
                    
                    do_action( 'learn_course_single_meta' ); ?>
                    <?php do_action( 'sensei_single_course_content_inside_after', get_the_ID() ); ?>

                </article><!-- .post -->

                <?php comments_template( '', true ); ?>

                <?php do_action('sensei_pagination'); ?>
            </div>
            <div class="col-md-4">

                <?php 
                $s_date = get_post_meta(get_the_ID(),'_cmb_sd_course', true); 
                if ( ! current_user_can('administrator') && $s_date < date('Y-m-d')) do_action( 'learn_course_single_btncart' ); ?>

                <?php //$checkout = new Sensei_Course(); $checkout->the_course_enrolment_actions(); ?>

                <div class="box_style_1">
                    <h4><?php esc_html_e('Lessons', 'learn'); ?> 
                        <span class="pull-right">
                            <?php if( empty( $course_id ) ){
                                global $post;
                                $course_id = $post->ID;
                            } 
                                echo count( Sensei()->course->course_lessons( $course_id ) );
                            ?>
                        </span>
                    </h4>
                    <h4><?php esc_html_e('Time', 'learn'); ?> <span class="pull-right"><?php echo learn_lesson_length(); esc_html_e(' minutes', 'learn'); ?></span></h4>
            
                    <h4><?php esc_html_e('Rates', 'learn'); ?> 
                        <span class="pull-right rating_2">
                            <?php learn_get_rating_course(); ?>
                        </span>
                    </h4>

                    <h4><?php esc_html_e('Single Purchase', 'learn'); ?> 
                        <span class="pull-right">
                            <?php 
                                $wc_post_id = get_post_meta( $post->ID, '_course_woocommerce_product', true ); 
                                $product = $woothemes_sensei->sensei_get_woocommerce_product_object( $wc_post_id );
                                if($product) echo $product->get_price_html();
                            ?>
                        </span>
                    </h4><br>
                    <?php 
                        $teachers = get_userdata( absint( get_post()->post_author ) );
                        if( $teachers ) {
                    ?>
                    <h4><?php esc_html_e('Speakers', 'learn'); ?></h4>
                    
                    <div class="media">      
                        <div class="pull-right">
                            <?php echo get_avatar($teachers,'68') ?>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading">
                                <a href="<?php echo esc_url( home_url( '/author/' . $teachers->user_login ) ); ?>">
                                    <?php echo esc_html($teachers->display_name); ?>
                                </a>
                            </h5>
                            <p>
                                <?php echo esc_html(substr($teachers->description, 0, 90)) . '...'; ?>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                                             
                </div>
                <div class="box_style_1 legend">
                    <h4><?php esc_html_e('Legend', 'learn'); ?> </h4>
                    <ul class="legend_course">
                          <li id="tostart"><?php esc_html_e( 'Still to start', 'learn' ); ?></li>
                          <li id="completed"><?php esc_html_e( 'Completed', 'learn' ); ?></li>
                     </ul>
                </div>
                <?php
                    $related = new WP_Query(
                        array(
                            'post_type'           => 'course',
                            'posts_per_page'      => 5,
                            'ignore_sticky_posts' => 1,
                            'no_found_rows'       => 1,
                            'order'               => 'rand',
                            'post__not_in'        => array( $post->ID ),
                            'tax_query'           => array(
                                'relation' => 'OR',
                                array(
                                    'taxonomy' => 'course-category',
                                    'field'    => 'term_id',
                                    'terms'    => learn_get_related_terms( 'course-category', $post->ID ),
                                    'operator' => 'IN',
                                )
                            ),
                        )
                    );
                ?>
                <?php if ( $related->have_posts() ) : ?>
                <div class="box_style_1 related-course">
                    <h4><?php esc_html_e( 'Related Content', 'learn' ); ?></h4>
                    <ul class="list_1">
                    <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                            
                      <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
                        
                    <?php endwhile; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </section>

</article><!-- .post .single-course -->

<?php get_sensei_footer(); ?>