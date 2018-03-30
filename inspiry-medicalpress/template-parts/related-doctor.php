<?php
global $post;

/* Basic Arguments for related doctors query */
$related_doctors_args = array(
    'post_type' => 'doctor',
    'posts_per_page' => 4,
    'post__not_in' => array($post->ID),
    'orderby' => 'rand'
);

/* Main Post( Doctor ) Departments */
$tax_query = array();
$department_terms = get_the_terms($post->ID, "department");
if (!empty($department_terms) && is_array($department_terms)) {
    $departments_array = array();
    foreach ($department_terms as $department_term) {
        $departments_array[] = $department_term->term_id;
    }
    $tax_query[] = array(
        'taxonomy' => 'department',
        'field' => 'id',
        'terms' => $departments_array
    );
}

/* if there are departments assigned to main post then add those in related doctors query */
$tax_count = count($tax_query); // count number of taxonomies
if ($tax_count > 0) {
    $related_doctors_args['tax_query'] = $tax_query; // add taxonomies query
}

$related_doctors_query = new WP_Query($related_doctors_args);

/* Related doctors query */
if ($related_doctors_query->have_posts()) {
    $loop_counter = 0;
    while ($related_doctors_query->have_posts()) {
        $related_doctors_query->the_post();
        ?>
        <div class="<?php bc('3', '4', '6', ''); ?>">
            <article class="common-doctor clearfix hentry">
                <?php inspiry_standard_thumbnail('gallery-post-single'); ?>
                <div class="text-content text-center">
                    <h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <div class="doctor-departments"><?php the_terms($post->ID, 'department', ' ', ', ', ' '); ?></div>
                    <div class="for-border"></div>
                    <p class="entry-summary">
                        <?php
                        $intro_text = get_post_meta($post->ID, 'doctor_intro_text', true);
                        if ( !empty($intro_text) ) {
                            echo $intro_text;
                        }
                        ?>
                    </p>
                    <?php get_template_part('template-parts/doctor-social-icons'); ?>
                </div>
            </article>
        </div>
        <?php
        $loop_counter++;
        if( ($loop_counter % 3) == 0 ){
            ?>
            <div class="visible-md clearfix"></div>
            <?php
        } else if( ($loop_counter % 2) == 0 ){
            ?>
            <div class="visible-sm clearfix"></div>
            <?php
        }
    }
    wp_reset_query();
}
?>