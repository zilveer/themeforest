<?php global $r_option; ?>

<?php get_header(); ?>

<?php 
    global $wp_query, $post;
    // Copy query
    $temp_post = $post;
    $query_temp = $wp_query;
?>
<?php 
// Include page header
if (isset($post)) include_once(THEME . '/includes/page_header.php');
?>

<section id="main-content" class="container clearfix">
    <!-- genres -->
    <section class="content items portfolio">
        <?php
          if (get_query_var('paged')) $paged = get_query_var('paged');
          elseif (get_query_var('page')) $paged = get_query_var('page');
          else $paged = 1;
          
          $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
          query_posts(array('post_type'=>'wp_releases', 'wp_release_genres' => $term->slug, 'posts_per_page'=> 12, 'paged'=>$paged));
        ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php

            /* Release image */
            $release_image = get_post_meta($wp_query->post->ID, '_release_image', true);
            $release_image_crop = get_post_meta($wp_query->post->ID, '_release_image_crop', true);
        ?>
        <!-- item -->
        <article class="col-1-4">
            <?php 
              $args = array(
                  'type'        => 'custom_link', //image, lightbox_image, lightbox_video, lightbox_soundcloud, custom_link, custom_link_blank
                  'effect'      => 'thumb_icon',  //thumb_icon, thumb_slide
                  'src'         => $release_image,
                  'link'        => get_permalink(),
                  'width'       => '420',
                  'height'      => '420',
                  'crop'        => $release_image_crop,
                  'align'       => 'noalign'
              );
              echo r_custom_image($args);
            ?>
            <footer>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="cat"><?php echo get_the_term_list($post->ID, 'wp_release_genres', '', '', ''); ?></div>
            </footer>
        </article>
        <!-- /item -->

        <?php endwhile; ?>
        <?php endif; ?>
    </section>
    <!-- /genres -->
    <?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>
</section>

<?php
   // Get orginal query
   $post = $temp_post;
   $wp_query = $query_temp;
?>

<?php get_footer(); ?>