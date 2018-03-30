<?php
global $smof_data;
$dreamer_testimonials_page_title = $smof_data[ 'testimonials_page_title'];
?>

<!-- Testimonials Page -->
<div class="page-container pattern-1" id="testimonials">
    <div class="row">
        <div class="twelve columns page-content">
            <h1 class="page-title">
                <?php echo $dreamer_testimonials_page_title ?>
            </h1>
            <h2 class="page-subtitle">
                <?php $dreamer_testimonials_page_description=$smof_data[ 'testimonials_page_description']; echo $dreamer_testimonials_page_description ?>
            </h2>
        </div>

        <div class="twelve columns testimonials">
            <?php
               $args = array( 'post_type' => 'testimonials', 'posts_per_page' => 5 );
               $loop = new WP_Query( $args );
               $c = 0;
               while ( $loop->have_posts() ) : $loop->the_post(); ?>

            <?php $c++; // increment the counter
            if( $c % 2 !=0 ) { ?>
            <div class="twelve columns testimonial">
                <div class="four columns testimonial-date hide-for-small">
                    <div class="nine columns">
                        <div class="testimonial-day">
                            <?php the_time( 'd'); ?>
                        </div>
                    </div>
                    <div class="three columns mobile-four">
                        <div class="testimonial-month">
                            <?php the_time( 'M'); ?>
                        </div>
                        <div class="testimonial-circle">
                            <?php the_time( 'S'); ?>
                        </div>
                    </div>
                </div>
                <div class="six columns testimonial-content mobile-four">
                    <div class="testimonial-content-inner">
                        <h4 class="testimonial-title mobile-four">
                            <?php the_title(); ?>
                        </h4>
                        <p class="testimonial-content mobile-four">
                            <?php echo get_the_content(); ?>
                        </p>
                    </div>
                </div>
                <div class="two columns hide-for-small"></div>
            </div>
            <?php } else { ?>
            <div class="twelve columns testimonial-bottom">
                <div class="two columns hide-for-small"></div>
                <div class="four columns testimonial-date hide-for-small">
                    <div class="nine columns">
                        <div class="testimonial-day">
                            <?php the_time( 'd'); ?>
                        </div>
                    </div>
                    <div class="three columns mobile-four">
                        <div class="testimonial-month">
                            <?php the_time( 'M'); ?>
                        </div>
                        <div class="testimonial-circle">
                            <?php the_time( 'S'); ?>
                        </div>
                    </div>
                </div>
                <div class="six columns testimonial-content mobile-four">
                    <div class="testimonial-content-inner">
                        <h4 class="testimonial-title mobile-four">
                            <?php the_title(); ?>
                        </h4>
                        <p class="testimonial-content mobile-four">
                            <?php echo get_the_content(); ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<?php wp_reset_query(); ?>