<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * The Template for displaying all single course meta information.
 *
 * Override this template by copying it to yourtheme/sensei/single-course/course-lessons.php
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */
?>

<div class="media">

    <?php

        /**
         * Actions just before the sensei single course lessons loop begins
         *
         * @hooked WooThemes_Sensei_Course::load_single_course_lessons_query
         * @since 1.9.0
         */
        do_action( 'sensei_single_course_lessons_before' );

    ?>

    <?php

    //lessons loaded into loop in the sensei_single_course_lessons_before hook
    if( have_posts() ): $i = 1;

        // start course lessons loop
        while ( have_posts() ): the_post();  ?>


                <?php

                    /**
                     * The hook is inside the course lesson on the single course. It fires
                     * for each lesson. It is just before the lesson excerpt.
                     *
                     * @since 1.9.0
                     *
                     * @param $lessons_id
                     *
                     * @hooked WooThemes_Sensei_Lesson::the_lesson_meta -  5
                     * @hooked WooThemes_Sensei_Lesson::the_lesson_thumbnail - 8
                     *
                     */
                    //do_action( 'sensei_single_course_inside_before_lesson', get_the_ID() );

                ?>

                <div class="circ-wrapper course_detail pull-left"><h3><?php echo esc_html($i); ?></h3></div>
                <div class="media-body">
                    <h4 class="media-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <p><?php the_content(); ?></p>
                    <ul class="data-lessons">
                        <?php if(get_post_meta( get_the_ID(), '_lesson_length', true )) { ?>
                        <li><i class="icon-clock"></i> <?php echo get_post_meta( get_the_ID(), '_lesson_length', true ).esc_html__(' minutes', 'learn'); ?></li>
                        <?php }
                            $lesson_video = get_post_meta( get_the_ID(), '_lesson_video_embed', true );
                            if(!$lesson_video){
                                echo '<li><i class="icon-doc"></i> '.esc_html__(' Text Reading', 'learn').'</li>';
                            }else{
                                echo '<li><i class="icon-video"></i> '.esc_html__(' Video', 'learn').'</li>';
                            } 
                        ?>
                    </ul>
                </div>
                <div class="clear-both"></div>
                <?php

                    /**
                     * The hook is inside the course lesson on the single course. It is just before the lesson closing markup.
                     * It fires for each lesson.
                     *
                     * @since 1.9.0
                     */
                    do_action( 'sensei_single_course_inside_after_lesson', get_the_ID() );

                ?>


        <?php $i++; endwhile; // end course lessons loop  ?>

    <?php endif; ?>

    <?php

        /**
         * Actions just before the sensei single course lessons loop begins
         *
         * @hooked WooThemes_Sensei_Course::reset_single_course_query
         *
         * @since 1.9.0
         */
        do_action( 'sensei_single_course_lessons_after' );

    ?>

</div>
