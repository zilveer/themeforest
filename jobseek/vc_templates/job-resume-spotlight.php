<?php

/**
* Spotlight shortcode
* Usage: [spotlight_jobs]
* Shows selected jobs in carousel
*/

add_shortcode('spotlight_jobs', 'jobseek_featured_jobs');
function jobseek_featured_jobs( $atts ) {

    ob_start();

    extract( $atts = shortcode_atts( apply_filters( 'job_manager_output_jobs_defaults', array(
        'per_page'                  => get_option( 'job_manager_per_page' ),
        'orderby'                   => 'featured',
        'order'                     => 'DESC',
        'title'                     => 'Job Spotlight',
        'columns'                   => '1',
        'autoplay'                  => '0',
        
        // Limit what jobs are shown based on category and type
        'categories'                => '',
        'job_types'                 => '',
        'featured'                  => true, // True to show only featured, false to hide featured, leave null to show both.
        'filled'                    => null, // True to show only filled, false to hide filled, leave null to show both/use the settings.    
    ) ), $atts ) );

    $randID = rand(1, 99); 

    if ( ! is_null( $filled ) ) {
        $filled = ( is_bool( $filled ) && $filled ) || in_array( $filled, array( '1', 'true', 'yes' ) ) ? true : false;
    }

    // Array handling
    $categories = is_array( $categories ) ? $categories : array_filter( array_map( 'trim', explode( ',', $categories ) ) );
    $job_types = is_array( $job_types ) ? $job_types : array_filter( array_map( 'trim', explode( ',', $job_types ) ) );
    if ( ! is_null( $featured ) ) {
        $featured = ( is_bool( $featured ) && $featured ) || in_array( $featured, array( '1', 'true', 'yes' ) ) ? true : false;
    }

    $jobs = get_job_listings(  array(
        'search_categories' => $categories,
        'job_types'         => $job_types,
        'orderby'           => $orderby,
        'order'             => $order,
        'posts_per_page'    => $per_page,
        'featured'          => $featured,
        'filled'            => $filled
    ) );
   
   if ( $jobs->have_posts() ) : ?>
 
        <div class="featured-jobs" data-columns="<?php echo $columns; ?>" data-autoplay="<?php echo $autoplay; ?>">
            <?php while ( $jobs->have_posts() ) : $jobs->the_post();
                $id = get_the_id(); ?>
                <div>
                    <div class="image">
                        <?php the_company_logo(); ?>
                    </div>
                    <h4>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <ul>
                        <li class="job-type <?php echo get_the_job_type() ? sanitize_title( get_the_job_type()->slug ) : ''; ?>"><?php the_job_type(); ?></li>
                        <li class="company"><?php the_company_name(  ); ?></li>
                        <li class="location"><?php the_job_location(); ?></li>
                    </ul>
                    
                    <p><?php
                        $excerpt = get_the_excerpt();
                        echo jobseek_string_limit_words($excerpt,20); ?>...
                    </p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e('Apply For This Job','jobseek') ?></a>
                </div>
            <?php endwhile; ?>                
        </div><?php  

    endif; 

    $job_listings_output =  ob_get_clean();

    return $job_listings_output;

}

?>