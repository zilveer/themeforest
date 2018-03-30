<?php
/*
Template Name: Events
*/
?>

<?php global $r_option, $events_count; ?>

<?php get_header(); ?>

<?php 
  global $wp_query, $post;
  $temp_post = $post;
  $query_temp = $wp_query;
  $event_type = get_post_meta($wp_query->post->ID, '_event_type', true);
  $date_format = 'd/m';
  if (isset($r_option['event_custom_date'])) $date_format = $r_option['event_custom_date'];

  /* Pagination Limit */
  $limit = (int)get_post_meta($wp_query->post->ID, '_limit', true);
  $limit = $limit && $limit == '' ? $limit = 6 : $limit = $limit;

  $next_month = '';

  /* Evnts Categories */
  $cat = get_post_meta($wp_query->post->ID, '_event_categories', true);
  
  $_type = array(
           'taxonomy' => 'wp_event_type',
           'field' => 'slug',
           'terms' => $event_type
          );
  $_cat = array(
           'taxonomy' => 'wp_event_categories',
           'field' => 'slug',
           'terms' => $cat
          );
  $tax = array($_type);
  
  if ($event_type == 'future-events') {
    if (isset($cat) && is_array($cat)) {
      
      /* All categories */
      if ($cat[0] == '_all' && count($cat) == 1) $tax = array($_type);
      else $tax = array($_type, $_cat);
      
    } 
  }
  
  /* Set order */
  if (isset($r_option['events_order']) && $r_option['events_order'] == 'start_date') 
    $events_order = '_event_date_start';
  else 
    $events_order = '_event_date_end';
  $order = $event_type == 'future-events' ? $order = 'ASC' : $order = 'DSC';
?>
<?php
  if (get_query_var('paged')) $paged = get_query_var('paged');
  elseif (get_query_var('page')) $paged = get_query_var('page');
  else $paged = 1;
  $more = 0;
  $args = array(
    'post_type'        => 'wp_events_manager',
    'tax_query'        => $tax,
    'showposts'        => $limit,
    'paged'            => $paged,
    'orderby'          => 'meta_value',
    'meta_key'         => $events_order,
    'order'            => $order,
    'suppress_filters' => 0 // WPML FIX
    );
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