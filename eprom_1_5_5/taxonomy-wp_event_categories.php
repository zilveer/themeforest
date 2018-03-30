<?php global $r_option, $events_count; ?>

<?php get_header(); ?>

<?php 
  global $wp_query, $post;
  $temp_post = $post;
  $query_temp = $wp_query;
  $date_format = 'd/m';
  if (isset($r_option['event_custom_date'])) $date_format = $r_option['event_custom_date'];

  $next_month = '';
  if (get_query_var('paged')) $paged = get_query_var('paged');
  elseif (get_query_var('page')) $paged = get_query_var('page');
  else $paged = 1;
  
   /* Set order */
  if (isset($r_option['events_order']) && $r_option['events_order'] == 'start_date') 
    $events_order = '_event_date_start';
  else 
    $events_order = '_event_date_end';

  $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

  $args = array(
    'post_type'           => 'wp_events_manager', 
    'wp_event_categories' => $term->slug, 
    'posts_per_page'      => 12, 
    'paged'               => $paged,
    'orderby'             => 'meta_value',
    'meta_key'            => $events_order,
    'order'               => 'DSC'
    );
  query_posts($args);

  $events_count = get_posts($args);
  $events_count = count($events_count);
  $month_count = 0;
  $post_count = 0;
?>
<?php 
// Include page header
if (isset($post)) include_once(THEME . '/includes/page_header.php');
?>
<?php
  $wp_query = new WP_Query();
  $wp_query->query($args);
?>
  <?php if (have_posts()) : ?>

  <section id="main-content" class="container events">
    <?php while (have_posts()) : ?>
    
      <?php 
        the_post();

        /* Event Date */
        $event_date_start = strtotime(get_post_meta($wp_query->post->ID, '_event_date_start', true));
        $event_date_end = strtotime(get_post_meta($wp_query->post->ID, '_event_date_end', true));

        // Get event month
        $this_month = date_i18n('F', $event_date_start);
        
          if ($this_month != $next_month && $month_count != 0) echo "</ul>\n<!-- /events list -->\n";
          if ($this_month != $next_month || $month_count == 0) {
          echo '<h4 class="events-heading">' . $this_month . ' <span class="color">' . date('Y', $event_date_start) . '</span></h4>'."\n";
          echo "<!-- events list -->\n";
          echo '<ul class="none events-list">'."\n";
          $month_count++; 
        } 

        /* Post Image */
        $event_image = get_post_meta($wp_query->post->ID, '_event_image', true); 
        $crop = get_post_meta($wp_query->post->ID, '_event_image_crop', true);
        $crop = isset($crop) && $crop != '' ? $crop = $crop : $crop = 'c';

        /* Location */
        $event_location = get_post_meta($wp_query->post->ID, '_event_location', true);

      ?>
      <!-- event -->
      <li>
        <a href="<?php the_permalink(); ?>">
          <span class="date"><?php echo date($date_format, $event_date_start); ?></span>
          <?php if (isset($event_image) && !empty($event_image)) : ?>
            <span class="cover">
            <?php
              echo r_image(array(
                'type'    => 'image',
                'src'     => $event_image,
                'crop'    => $crop,
                'title'   => get_the_title(),
                'width'   => '60',
                'height'  => '60'
              ));
            ?>
            </span>
          <?php endif; ?>
          <span class="title"><?php the_title(); ?> <span class="details"><?php echo $event_location; ?></span></span>
          <span class="plus-button"></span>
        </a>
      </li>
      <!-- /event -->
    <?php
      $next_month = $this_month;
      // Latest event
      $post_count++;
      if ($post_count == $events_count) echo "</ul>\n<!-- /events list -->\n";
    ?>
    <?php endwhile; ?>
    <?php if ($wp_query->max_num_pages > 1) : ?>
      <div class="events-pagination">
        <?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>
      </div>
    <?php endif; ?>
  </section>
  <?php else : ?>
  <section id="main-content" class="container">
    <?php echo do_content($r_option['no_events_msg']); ?>
  </section>
  <?php endif; ?>
<?php 
  $post = $temp_post;
  $wp_query = $query_temp;
?>

<?php get_footer(); ?>