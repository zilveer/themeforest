<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Trizzy
 */

get_header(); ?>
<section class="titlebar">
    <div class="container">
        <div class="sixteen columns">
            <h1><?php the_title(); ?></h1>

            <nav id="breadcrumbs">
                 <?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
            </nav>
        </div>
    </div>
</section>

<!-- Container -->
<div class="container single-testimonial-container">
    <div class="sixteen columns">
        <?php while ( have_posts() ) : the_post();
        $author = get_post_meta($id, 'pp_author', true);
        $link = get_post_meta($id, 'pp_link', true);
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('the-team single'); ?>>
            <div class="sixteen columns omega">
                <div class="happy-clients-photo"><?php echo get_the_post_thumbnail($wp_query->post->ID,'portfolio-thumb'); ?></div>
                <div class="happy-clients-cite">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->
                <?php  if($link) {
                    echo ' <div class="happy-clients-author"><a href="'.esc_url($link).'">'.$author.'</a></div>';
                } else {
                 echo' <div class="happy-clients-author">'.$author.'</div>';
             } ?>

         </div>
         <div class="clearfix"></div>
     </article><!-- #post-## -->

     <?php trizzy_post_nav(); ?>



 <?php endwhile; // end of the loop. ?>

</div>
</div>


<?php get_footer(); ?>