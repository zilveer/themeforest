<?php
/*
Template Name: Gallery
*/
?>
<?php global $r_option; ?>

<?php get_header(); ?>

<?php 
    global $wp_query, $post;
    // Copy query
    $temp_post = $post;
    $query_temp = $wp_query;

    /* Releases Layout */
    $gallery_layout = get_post_meta($wp_query->post->ID, '_gallery_layout', true);
    $gallery_layout = $gallery_layout && $gallery_layout != '' ? $gallery_layout = $gallery_layout : $gallery_layout = '3';

    /* Thumbnails sizes */
    if ($gallery_layout == '2') {
        $width = '460';
        $height = '460';
    } else {
        $width = '420';
        $height = '420';
    }

    /* Pagination Limit */
    $limit = (int)get_post_meta($wp_query->post->ID, '_limit', true);
    $limit = $limit && $limit == '' ? $limit = 6 : $limit = $limit;
    $date_format = 'd/m/y';
    if (isset($r_option['custom_date'])) $date_format = $r_option['custom_date'];
?>
<?php 
// Include page header
if (isset($post)) include_once(THEME . '/includes/page_header.php');
?>

<section id="main-content" class="container clearfix">
    <!-- gallery -->
   <section class="content items portfolio">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; ?>
        <?php endif; ?>
        <?php
            if (get_query_var('paged')) $paged = get_query_var('paged');
            elseif (get_query_var('page')) $paged = get_query_var('page');
            else $paged = 1;

            $args = array(
                            'post_type' => 'wp_gallery',
                            'showposts'=> $limit,
                            'paged' => $paged
                          );
            $wp_query = new WP_Query();
            $wp_query->query($args);
        ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php

            /* Album cover */
            $album_cover = get_post_meta($wp_query->post->ID, '_album_cover', true);
            $album_cover_crop = get_post_meta($wp_query->post->ID, '_album_cover_crop', true);

            /* Tooltip title */
            $tooltip_title = get_post_meta($wp_query->post->ID, '_tooltip_title', true);

            /* Tooltip text */
            $tooltip_text = get_post_meta($wp_query->post->ID, '_tooltip_text', true);

        ?>
        <!-- item -->
        <article class="col-1-<?php echo $gallery_layout; ?>">
            <?php 
                $args = array(
                    'type'        => 'custom_link', //image, lightbox_image, lightbox_video, lightbox_soundcloud, custom_link, custom_link_blank
                    'effect'      => 'thumb_icon',  //thumb_icon, thumb_slide
                    'src'         => $album_cover,
                    'link'        => get_permalink(),
                    'width'       => $width,
                    'height'      => $height,
                    'title'       => $tooltip_title,
                    'crop'        => $album_cover_crop,
                    'tooltip'     => $tooltip_text,
                    'align'       => 'noalign',
                );

                echo r_custom_image($args);
            ?>
            <footer>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br><small><?php the_time($date_format); ?></small></h2>
            </footer>
        </article>
        <!-- /item -->
        <?php endwhile; ?>
        <?php endif; ?>    
    </section>
    <!-- /gallery -->
    <?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>
</section>

<?php
   // Get orginal query
   $post = $temp_post;
   $wp_query = $query_temp;
?>

<?php get_footer(); ?>