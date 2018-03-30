<?php
/*
Template Name: Releases
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
    $releases_layout = get_post_meta($wp_query->post->ID, '_releases_layout', true);
    $releases_layout = $releases_layout && $releases_layout != '' ? $releases_layout = $releases_layout : $releases_layout = '3';

     /* Artists */
    $artists_filter = get_post_meta($wp_query->post->ID, '_artists_filter', true);

    /* Thumbnails sizes */
    if ($releases_layout == '2') {
        $width = '460';
        $height = '460';
    } else {
        $width = '420';
        $height = '420';
    }

    /* All button */
    $all_button = get_post_meta($wp_query->post->ID, '_all_button', true);
    $all_button = isset($all_button) && $all_button == 'on' ? $all_button = 'on' : $all_button = 'off';

    /* Tax */
    $tax = array();

    /* Artists */
    $artists = get_post_meta($wp_query->post->ID, '_releases_artists', true);
    if (isset($artists) && is_array($artists)) {
        
        /* Get Artists Taxonomies */
        if ($artists[0] == '_all' && count($artists) == 1) {  
            $artists = false;
            $tax_artists = false;
        } else { 
            $tax_artists = array(
                'taxonomy' => 'wp_release_artists',
                'field' => 'slug',
                'terms' => $artists
            );
            array_push($tax, $tax_artists);
        }
    } else { 
        $artists = false;
        $tax_artists = false;
    }

    /* Genres */
    $genres = get_post_meta($wp_query->post->ID, '_releases_genres', true);
    if (isset($genres) && is_array($genres)) {
      
        /* Get Genres Taxonomies */
        if ($genres[0] == '_all' && count($genres) == 1) {  
            $genres = false;
            $tax_genres = false;
        } else { 
            $tax_genres = array(
                'taxonomy' => 'wp_release_genres',
                'field' => 'slug',
                'terms' => $genres
            );
            array_push($tax, $tax_genres);
        }
    } else { 
      $genres = false;
      $tax_genres = false;
    }

    /* Pagination Limit */
    $limit = (int)get_post_meta($wp_query->post->ID, '_limit', true);
    $limit = $limit && $limit == '' ? $limit = 6 : $limit = $limit;
    //print_r($tax);
?>
<?php 
// Include page header
if (isset($post)) include_once(THEME . '/includes/page_header.php');
?>

<section id="main-content" class="container clearfix">
    <?php if ($artists_filter == 'on') : ?>
    <!-- tags filter -->
    <ul id="tag-filter">
        <?php if ($all_button == 'on') : ?>
            <li><a data-tags="*"><?php _e('All Artists', SHORT_NAME); ?></a></li>
        <?php endif; ?>
        <?php 
            $term_args = array('hide_empty' => '1', 'orderby' => 'name', 'order' => 'ASC');
            $terms = get_terms('wp_release_artists', $term_args);
            if ($terms) {
                foreach ($terms as $term) {
                     if ($artists) {
                         if (in_array($term->slug, $artists)) {
                            echo '<li><a data-tags="' . $term->slug . '">' . $term->name . '</a></li>';
                         }
                     } else {
                         echo '<li><a data-tags="' . $term->slug . '">' . $term->name . '</a></li>';
                     }
                }
            }
        ?>
    </ul>
    <!-- /tags filter -->
    <?php endif; ?>
    <!-- releases -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; ?>
        <?php endif; ?>
    <section class="content items portfolio">
        
        <?php
            if (get_query_var('paged')) $paged = get_query_var('paged');
            elseif (get_query_var('page')) $paged = get_query_var('page');
            else $paged = 1;

            // Vars
            $link = '';
            $type = '';
            $classes = '';

            $args = array(
                          'post_type' => 'wp_releases',
                          'showposts'=> -1,
                          'paged' => $paged,
                          'tax_query' => $tax
                          );
            $wp_query = new WP_Query();
            $wp_query->query($args);
        ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php

            /* Release image */
            $release_image = get_post_meta($wp_query->post->ID, '_release_image', true);
            $release_image_crop = get_post_meta($wp_query->post->ID, '_release_image_crop', true);

            /* Release image 2 */
            $release_image_b = get_post_meta($wp_query->post->ID, '_release_image_b', true);
            $release_image_crop_b = get_post_meta($wp_query->post->ID, '_release_image_crop_b', true);

            /* Lightbox image */
            $lightbox_image = get_post_meta($wp_query->post->ID, '_lightbox_image', true);

            /* Release Iframe */
            $release_iframe = get_post_meta($wp_query->post->ID, '_release_iframe', true);

            /* Lightbox group */
            $lightbox_group = get_post_meta($wp_query->post->ID, '_lightbox_group', true);

            /* Release badge */
            $release_badge = get_post_meta($wp_query->post->ID, '_badge', true);

            /* Custom link */
            $custom_link = get_post_meta($wp_query->post->ID, '_link_url', true);

            /* Link target attribute */
            $target = get_post_meta($wp_query->post->ID, '_target', true);
            $target = isset($target) && $target == 'on' ? $target = 'blank' : $target = 'self';

            /* Tooltip title */
            $tooltip_title = get_post_meta($wp_query->post->ID, '_tooltip_title', true);

            /* Tooltip text */
            $tooltip_text = get_post_meta($wp_query->post->ID, '_tooltip_text', true);

            /* Release type */
            $release_type = get_post_meta($wp_query->post->ID, '_release_type', true);

            /* Thumb type */
            $thumb_type = get_post_meta($wp_query->post->ID, '_thumb_type', true);

            /* Bulid genres */
            $post_terms = get_the_terms(get_the_ID(), 'wp_release_genres');
            $genres_slugs = '';
            $term_count = 0;
            if ($post_terms) {
                $terms_count = count($post_terms);
                foreach ($post_terms as $term) {
                    $term_count++;
                    if ($term_count < $terms_count) {
                        $genres_slugs .= $term->slug . ' ';
                    } else {
                        $genres_slugs .= $term->slug;
                    }
                }
            }

            /* Bulid artists */
            $post_terms = get_the_terms(get_the_ID(), 'wp_release_artists');
            $artists_slugs = '';
            $term_count = 0;
            if ($post_terms) {
                $terms_count = count($post_terms);
                foreach ($post_terms as $term) {
                    $term_count++;
                    if ($term_count < $terms_count) {
                        $artists_slugs .= $term->slug . ' ';
                    } else {
                        $artists_slugs .= $term->slug;
                    }
                }
            }

        ?>
        <!-- item -->
        <article class="col-1-<?php echo $releases_layout; ?>" data-categories="<?php echo $genres_slugs; ?>" data-tags="<?php echo $artists_slugs; ?>">
            <?php 

                switch ($release_type) {

                     // Image
                    case 'image' :
                        $type = $release_type;
                        $classes = 'release-image';
                    break;

                    // Lightbox image
                    case 'lightbox_image' :
                        $link = $lightbox_image;
                        $type = $release_type;
                    break;

                    // Iframe
                    case 'lightbox_video':
                    case 'lightbox_soundcloud':
                        $type = $release_type;
                    break;

                    // Custom link
                    case 'custom_link' :
                        $link = $custom_link;
                        $type = $release_type;
                        if ($target == 'blank') $type = 'custom_link_blank';
                    break;

                    // Project link
                    case 'project_link' :
                        $link = get_permalink();
                        $type = 'custom_link';
                    break;
                }
                $args = array(
                    'type'        => $type, //image, lightbox_image, lightbox_video, lightbox_soundcloud, custom_link, custom_link_blank
                    'effect'      => $thumb_type,  //thumb_icon, thumb_slide
                    'src'         => $release_image,
                    'src_back'    => $release_image_b,
                    'link'        => $link,
                    'width'       => $width,
                    'height'      => $height,
                    'iframe_code' => $release_iframe,
                    'group'       => $lightbox_group,
                    'title'       => $tooltip_title,
                    'crop'        => $release_image_crop,
                    'badge'       => $release_badge,
                    'tooltip'     => $tooltip_text,
                    'align'       => 'noalign',
                    'classes'     => $classes
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
    <!-- /releases -->
    <?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>
</section>

<?php
   // Get orginal query
   $post = $temp_post;
   $wp_query = $query_temp;
?>

<?php get_footer(); ?>