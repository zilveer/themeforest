<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * List the Course Modules and Lesson in these modules
 *
 * Template is hooked into Single Course sensei_single_main_content. It will
 * only be shown if the course contains modules.
 *
 * All lessons shown here will not be included in the list of other lessons.
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */
?>

<?php

    /**
     * Hook runs inside single-course/course-modules.php
     *
     * It runs before the modules are shown. This hook fires on the single course page. It will show
     * irrespective of irrespective the course has any modules or not.
     *
     * @since 1.8.0
     *
     */
    do_action('sensei_single_course_modules_before');

?>

<?php if( sensei_have_modules() ): ?>

    <?php while ( sensei_have_modules() ): sensei_setup_module(); ?>
        <?php if( sensei_module_has_lessons() ): ?>

            <article class="post module">

                <?php

                /**
                 * Hook runs inside single-course/course-modules.php
                 *
                 * It runs inside the if statement after the article tag opens just before the modules are shown. This hook will NOT fire if there
                 * are no modules to show.
                 *
                 * @since 1.9.0
                 *
                 * @hooked Sensei()->modules->course_modules_title - 20
                 */
                do_action('sensei_single_course_modules_inside_before');

                ?>

                <h3 class="chapter_course"><?php sensei_the_module_title(); ?></h3>

                <section class="entry">

                    <?php sensei_the_module_status(); ?>

                    <section class="module-lessons">

                        <?php while( sensei_module_has_lessons() ): the_post(); ?>
                            <div class="strip_single_course">

                                <h4 class="<?php sensei_the_lesson_status_class();?>">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>" >

                                    <?php the_title(); ?>
                                    
                                    </a>
                                </h4>
                                <ul>
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

                        <?php endwhile; ?>

                    </section><!-- .module-lessons -->

                </section>

                <?php

                /**
                 * Hook runs inside single-course/course-modules.php
                 *
                 * It runs inside the if statement before the closing article tag directly after the modules were shown.
                 * This hook will not trigger if there are no modules to show.
                 *
                 * @since 1.9.0
                 *
                 */
                do_action('sensei_single_course_modules_inside_after');

                ?>

            </article>

        <?php endif; //sensei_module_has_lessons  ?>

    <?php endwhile; // sensei_have_modules ?>

<?php endif; // sensei_have_modules ?>

<?php

/**
 * Hook runs inside single-course/course-modules.php
 *
 * It runs after the modules are shown. This hook fires on the single course page,but only if the course has modules.
 *
 * @since 1.8.0
 */
do_action('sensei_single_course_modules_after');
