<?php global $r_option; ?>

<?php get_header(); ?>

<?php 
   global $wp_query, $post;

   // Image width
   $width = '233';
   $height = '233';

   /* Lazy load */
   if ($r_option['js_lazyload'] == 'on') {
      $lazy = true;
   } else {
      $lazy = false;
   }
?>
<?php 
// Include page header
if (isset($post)) include_once(THEME . '/includes/page_header.php');
?>

<section id="main-content" class="container clearfix">
   <!-- main -->
   <section class="clearfix">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content();?>
        <div class="clear"></div>
      <?php endwhile; ?>
      <?php endif; ?>
      <!-- masonry boxes -->
      <div class="masonry-wrap clearfix">
      <?php 

         /* Images ids */
         $images_ids = get_post_meta($wp_query->post->ID, '_gallery_images', true);

         if (!$images_ids || $images_ids == '') {
           echo '<p class="message error">Gallery error: <strong>Album has no pictures.</strong></p>';
         }

         $count = 0;
         $ids = explode('|', $images_ids);
         $defaults = array(
            'title'               => '',
            'desc'                => '',
            'crop'                => 'c',
            'image_type'          => '',
            'lightbox_image'      => '',
            'lightbox_video'      => '',
            'lightbox_soundcloud' => '',
            'custom_link'         => '',
            'iframe_code'         => ''
         );

         /* Start Loop */
         foreach ($ids as $id) :
            // Vars 
            $desc_id = '';
            $title = '';

            $image_url = get_post($id);
            $image_att = wp_get_attachment_image_src($id);
            if (!$image_att[0]) continue;

            /* Count */
            $count++;

            /* Get image meta */
            $image = get_post_meta($wp_query->post->ID, '_gallery_images_' . $id, true);

            /* Add default values */
            if (isset($image) && is_array($image)) $image = array_merge($defaults, $image);
            else $image = $defaults;

            /* Add image src to array */
            $image['src'] = wp_get_attachment_url($id);

            // Link
            $link = $image['custom_link'];
            
            // Lightbox image
            if ($image['image_type'] == '') $image['image_type'] = 'lightbox_image';

            if ($image['image_type'] == 'lightbox_image') $link = $image['lightbox_image'];
              
      ?>
         <div class="masonry width-1-4 height-1-4">
            <?php 
            echo r_custom_image(array(
               'type'           => $image['image_type'],
               'iframe_code'    => $image['iframe_code'],
               'link'           => $link,
               'src'            => $image['src'],
               'crop'           => $image['crop'],
               'group'          => 'gallery',
               'title'          => $image['title'],
               'width'          => $width,
               'height'         => $height,
               'lightbox_group' => '',
               'classes'        => '',
               'lazyload'       => $lazy
            ));
            ?>
         </div>

      <?php endforeach; ?>
      </div>

   </section>
   <!-- /main -->
</section>

<?php get_footer(); ?>