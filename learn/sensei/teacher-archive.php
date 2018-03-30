<?php
/**
 * The Template for displaying teacher author archives, this template wil show the teacher
 * and all course that belong to to them.
 *
 * Override this template by copying it to your_theme/sensei/teacher-archive.php
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */
?>

<?php  get_sensei_header();  ?>
<div class="row profiles">
    <aside class="col-md-4">
        <div class=" box_style_1 profile">
        <?php 
            $teachers = get_userdata( absint( get_post()->post_author ) );

            if( $teachers ) {
            $twi = get_the_author_meta( 'twitter_profile', $teachers->ID );
            $face = get_the_author_meta( 'facebook_profile', $teachers->ID );
            $gg = get_the_author_meta( 'google_profile', $teachers->ID );
        ?>
        <p class="text-center"><?php echo get_avatar($teachers,'150') ?></p>
        <ul class="social_teacher">
            <?php if($face) { ?><li><a href="<?php echo esc_url($face); ?>"><i class="icon-facebook"></i></a></li><?php } ?>
            <?php if($twi) { ?><li><a href="<?php echo esc_url($twi); ?>"><i class="icon-twitter"></i></a></li><?php } ?>
            <?php if($gg) { ?><li><a href="<?php echo esc_url($gg); ?>"><i class=" icon-google"></i></a></li><?php } ?>
        </ul>   
        <ul>
             <li><?php esc_html_e('Name', 'learn'); ?> <strong class="pull-right"><?php echo esc_html($teachers->display_name); ?></strong> </li>
             <li><?php esc_html_e('Email', 'learn'); ?> <strong class="pull-right"><?php echo esc_html($teachers->user_email); ?></strong></li>
             <li><?php esc_html_e('Telephone', 'learn'); ?> <strong class="pull-right"><?php echo esc_html($teachers->phone_profile); ?></strong></li>
             <li><?php esc_html_e('Website', 'learn'); ?> <strong class="pull-right"><?php echo esc_html($teachers->user_url); ?></strong></li>
        </ul>
        <?php } ?>
        </div><!-- End box-sidebar -->
    </aside><!-- End aside -->
    <div class="col-md-8">
        <ul class="nav nav-tabs" id="mytabs">
            <li class="active"><a href="#profile_teacher" data-toggle="tab"><?php esc_html_e('Profile', 'learn'); ?></a></li>
            <li><a href="#courses" data-toggle="tab"><?php esc_html_e('Courses', 'learn'); ?></a></li>
        </ul>
        <div class="tab-content">                    
            <div class="tab-pane fade in active" id="profile_teacher"><?php echo htmlspecialchars_decode($teachers->description); ?></div>
            <div class="tab-pane fade in" id="courses">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><?php esc_html_e('Category', 'learn'); ?></th>
                                <th><?php esc_html_e('Course name', 'learn'); ?></th>
                                <th><?php esc_html_e('Lessons', 'learn'); ?></th>
                                <th><?php esc_html_e('Rate', 'learn'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ( have_posts() ) : the_post(); ?>
                            <tr>
                                <td>    
                                    <?php $terms = get_the_terms( $post->ID, 'course-category' ); if($terms) { ?>   
                                    <?php foreach ( $terms as $term ) { ?>
                                        <?php echo esc_html($term->name); ?>
                                    <?php } } ?>
                                </td>
                                <td>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </td>
                                <td><?php echo count( Sensei()->course->course_lessons($post->ID) ); ?></td>
                                <td class="rating_2"><?php learn_get_rating_course(); ?></td>
                            </tr>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </tbody>
                    </table>
                </div>
            </div>       
        </div>
    </div>
</div>

<?php get_sensei_footer(); ?>
