<?php
/**
 * Displays a timeline custom post
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

get_header();
oxy_page_header();

global $post;
$custom_fields = get_post_custom($post->ID);
if ( isset ($custom_fields[THEME_SHORT.'_timeline']) ){
    if ($custom_fields[THEME_SHORT.'_timeline'][0] !== " ")
        $query = new WP_Query( 'category_name='.$custom_fields[THEME_SHORT.'_timeline'][0] );
    else{
        $query = new WP_Query(  array( 'post_type' => 'post' ) );
    }
}  ?>

<section class="section section-padded section-alt">
    <div class="container-fluid">
        <div class="row-fluid">
            <ol id="timeline">
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <?php get_template_part( 'partials/timeline/content' , get_post_format() ); ?>

                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>
            </ol>
        </div>
    </div>
</section>
<?php get_footer();