<?php
/**
 * The Template for displaying all single lessons.
 *
 * Override this template by copying it to yourtheme/sensei/single-lesson.php
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

 global $woothemes_sensei, $post, $current_user, $view_lesson, $user_taking_course;
 // Content Access Permissions
 $access_permission = false;
 if ( ( isset( $woothemes_sensei->settings->settings['access_permission'] ) && ! $woothemes_sensei->settings->settings['access_permission'] ) || sensei_all_access() ) {
    if(WooThemes_Sensei_Utils::sensei_is_woocommerce_activated()) {
    $course_id = get_post_meta( $post->ID, '_lesson_course', true );
    $wc_post_id = get_post_meta( $course_id, '_course_woocommerce_product', true );
    $product = $woothemes_sensei->sensei_get_woocommerce_product_object( $wc_post_id );

    $access_permission = ! ( isset ( $product ) && is_object ( $product ) );
  }
 } // End If Statement

?>

<?php get_sensei_header();  ?>

<?php the_post(); ?>

    <div class="row">

            <div class="col-md-8">
                <article <?php post_class( array( 'lesson', 'post' ) ); ?>>

                    <?php do_action( 'sensei_single_lesson_content_inside_before', get_the_ID() ); ?>

                    <?php

                    $view_lesson = true;

                    wp_get_current_user();

                    $lesson_prerequisite = absint( get_post_meta( $post->ID, '_lesson_prerequisite', true ) );


                    if ( $lesson_prerequisite > 0 ) {
                        // Check for prerequisite lesson completions
                        $view_lesson = WooThemes_Sensei_Utils::user_completed_lesson( $lesson_prerequisite, $current_user->ID );
                    }

                    $lesson_course_id = get_post_meta( $post->ID, '_lesson_course', true );
                    $user_taking_course = WooThemes_Sensei_Utils::user_started_course( $lesson_course_id, $current_user->ID );

                    if( current_user_can( 'administrator' ) ) {
                        $view_lesson = true;
                        $user_taking_course = true;
                    }

                    $is_preview = false;
                    if( WooThemes_Sensei_Utils::is_preview_lesson( $post->ID ) ) {
                        $is_preview = true;
                        $view_lesson = true;
                    };

                    if( $view_lesson ) { ?>

                        <section class="entry fix">
                        <?php if ( $is_preview && !$user_taking_course ) { ?>
                            <div class="sensei-message alert"><?php echo $woothemes_sensei->permissions_message['message']; ?></div>
                        <?php } ?>

                            <?php
                            if ( $access_permission || ( is_user_logged_in() && $user_taking_course ) || $is_preview ) {
                                if( apply_filters( 'sensei_video_position', 'top', $post->ID ) == 'top' ) {
                                    do_action( 'sensei_lesson_video', $post->ID );
                                }
                                the_content();
                            } else {
                                echo '<p>' . $post->post_excerpt . '</p>';
                            }
                            ?>
                        </section>

                        <?php if ( $access_permission || ( is_user_logged_in() && $user_taking_course ) || $is_preview ) {
                            do_action( 'sensei_lesson_single_meta' );
                        } else {
                            do_action( 'sensei_lesson_course_signup', $lesson_course_id );
                        } ?>

                        <?php

                    } else {
                        if ( $lesson_prerequisite > 0 ) {
                            echo sprintf( __( 'You must first complete %1$s before viewing this Lesson', 'learn' ), '<a href="' . esc_url( get_permalink( $lesson_prerequisite ) ) . '" title="' . esc_attr(  sprintf( __( 'You must first complete: %1$s', 'learn' ), get_the_title( $lesson_prerequisite ) ) ) . '">' . get_the_title( $lesson_prerequisite ). '</a>' );
                        }
                    }

                    ?>

                    <?php 
                        do_action( 'sensei_single_lesson_content_inside_after', get_the_ID() );
                    ?>

                </article><!-- .post -->

            </div>
            <?php if ( is_user_logged_in() && $user_taking_course ) { ?>
            <div class="col-md-4">
                <div class="box_style_1">
                    <?php
                      if ( function_exists('rwmb_meta') ) { 
                      ?>
                      <?php $files = rwmb_meta( '_cmb_down_file', 'type=file', $post->ID ); ?>

                      <?php if($files){ 
                       foreach ( $files as $file ) { 
                       $fi = $file['url']; ?>
                      <h4><a href='<?php echo esc_url($fi); ?>'><?php esc_html_e('Download files', 'learn'); ?> <i class="icon-download pull-right"></i></a></h4><br>
                    <?php } } } ?>
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

                <?php if ( is_active_sidebar( 'lesson-widget' ) ) : ?>
                    <div class="box_style_1">
                    	<?php dynamic_sidebar( 'lesson-widget' ); ?>
                	</div>
                <?php endif; ?>
                <?php
                    $related = new WP_Query(
                        array(
                            'post_type'           => 'course',
                            'posts_per_page'      => 5,
                            'ignore_sticky_posts' => 1,
                            'no_found_rows'       => 1,
                            'order'               => 'rand',
                            'post__not_in'        => array( $course_id ),
                            'tax_query'           => array(
                                'relation' => 'OR',
                                array(
                                    'taxonomy' => 'course-category',
                                    'field'    => 'term_id',
                                    'terms'    => learn_get_related_terms( 'course-category', $course_id ),
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
            <?php } ?>
        </div>

<?php get_sensei_footer(); ?>