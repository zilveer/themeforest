<?php global $r_option, $events_count; ?>

<?php 
   global $wp_query;

   $nivo_slider_width = '1920';
   $nivo_slider_height = '600';

   if (isset($post)) {
      $header_type = get_post_meta($wp_query->post->ID, '_header_type', true);
      $subtitle = get_post_meta($wp_query->post->ID, '_header_subtitle', true);
      $header_content = get_post_meta($wp_query->post->ID, '_header_content', true);
      $audio_player = get_post_meta($wp_query->post->ID, '_audio_player', true);
      $title = get_the_title($post);
   }

   // Default Wordpress Pages
   if (!is_single() && !is_page()) {
      $header_type = 'default';
      $audio_player = 'off';
   }
   
   // Shop
  if ( is_woocommerce_activated() && is_shop() ) {
         $shop_page_id = get_option( 'woocommerce_shop_page_id' );
         $title = get_the_title( $shop_page_id  );
         $subtitle = '';
   }
   else if ( is_tax('product_cat') || is_tax('product_tag') ) {

      if ( is_woocommerce_activated() ) {
         $shop_page_id = get_option( 'woocommerce_shop_page_id' );
         $subtitle = get_the_title( $shop_page_id  );
         $title = single_cat_title('', false);
      }
   }
   elseif ( 'product' == get_post_type() ) {

      if ( is_woocommerce_activated() ) {
         $shop_page_id = get_option( 'woocommerce_shop_page_id' );
         $subtitle = get_the_title( $shop_page_id  );
      }
   }
   // Categories
   elseif (is_category()) {
      $title = _x('Category.', 'Page Header Section', SHORT_NAME);
      $subtitle = single_cat_title('', false);
   }
   // Tags
   elseif (is_tag()) {
      $title = _x('Tag: ', 'Page Header Section', SHORT_NAME);
      $subtitle = single_tag_title('', false);
   }
   // Release genres
   elseif (is_tax('wp_release_genres')) {
      $title = single_cat_title('', false);
      $subtitle = _x('Releases.', 'Page Header Section', SHORT_NAME);
   }
   // Release artists
   elseif (is_tax('wp_release_artists')) {
      $title = single_cat_title('', false);
      $subtitle = _x('Releases.', 'Page Header Section', SHORT_NAME);
   }
    // Events categories
   elseif (is_tax('wp_event_categories')) {
      $title = single_cat_title('', false);
      $subtitle = _x('Events.', 'Page Header Section', SHORT_NAME);
   }
   // Archive
   elseif (is_archive()) {
      $title = _x('Archives.', 'Page Header Section', SHORT_NAME);
      if(is_year()) $subtitle = get_the_time('Y');
      if(is_month()) $subtitle = get_the_time('F, Y');
      if(is_day() || is_time()) $subtitle  = get_the_time('l - ' . $r_option['custom_date']);
   }
   // Search
   elseif (is_search()) {
      $title = _x('Search results for:', 'Page Header Section', SHORT_NAME);
      $subtitle = $_GET['s'];
   }
           
?>
<?php if ($header_type == 'nivo_slider') : ?>
   <!-- nivo slider -->
   <section class="slider">
      <div class="fullslider">
         <div class="fullslider-content">
            <?php 
               $nivo_id = get_post_meta($wp_query->post->ID, '_nivo_slider_id', true);
               echo r_nivo_slider($atts = array('id' => $nivo_id, 'image_width' => $nivo_slider_width, 'image_height' => $nivo_slider_height));
            ?>
         </div>
      </div>
   </section>
   <!-- /nivo slider -->
<?php elseif ($header_type == 'rev_slider') : ?>
   <!-- revolution slider -->
   <section>
   <?php
      $rev_id = get_post_meta($wp_query->post->ID, '_revslider', true);

      if (isset($rev_id) && function_exists('putRevSlider')) { 
         $rev_id = intval($rev_id);
         putRevSlider($rev_id);
      }
   ?>
   </section>
   <!-- /revolution slider -->
<?php elseif ($header_type == 'masonry') : ?>
   <!-- nivo slider -->
   <section id="page-header">
      <div class="container clearfix">
         <?php if (isset($subtitle) && $subtitle != ''): ?>
            <h1 class="slogan"><?php echo do_content($subtitle) ?></h1>
         <?php endif ?>
         <div class="header-content">
            <?php echo do_content($header_content); ?>
         </div>
      </div>
   </section>
   <!-- /nivo slider -->
<?php else: ?>
   <!-- page header -->
   <section id="page-header">
      <div class="container clearfix">
         <div class="hgroup">
            <h1 class="page-title"><?php echo $title ?></h1>
            <?php if (isset($subtitle) && $subtitle != ''): ?>
            <h2 class="page-subtitle"><?php echo do_content($subtitle) ?></h2>
            <?php endif ?>
         </div>

         <?php if (isset($r_option['js_sharrre']) && $r_option['js_sharrre'] == 'on'): ?>
            <!-- share it -->
            <div id="share-wrap">
               <div id="share" data-url="<?php the_permalink(); ?>" data-text="<?php echo urlencode(get_the_title()); ?>" data-title="<?php _e('Share', SHORT_NAME); ?>"></div>
            </div>
            <!-- /share it -->
         <?php endif ?>
         <hr>
         <?php if ($header_type == 'filter'): ?>

         <!-- Filter ================================================= -->
         <?php
            /* All button */
            $all_button = get_post_meta($wp_query->post->ID, '_all_button', true);
            $all_button = isset($all_button) && $all_button == 'on' ? $all_button = 'on' : $all_button = 'off';
            /* Genres */
            $genres = get_post_meta($wp_query->post->ID, '_releases_genres', true);
            if (isset($genres) && is_array($genres)) {
         
               /* Get Genres Taxonomies */
               if ($genres[0] == '_all' && count($genres) == 1) {  
                  $genres = false;
               }
            } else { 
               $genres = false;
            }

            ?>
            <!-- cat filter -->
            <ul id="cat-filter">
               <?php if ($all_button == 'on') : ?>
                  <li><a data-categories="*"><?php _e('All', SHORT_NAME); ?></a></li>
              <?php endif; ?>
              <?php 
                  $term_args = array('hide_empty' => '1', 'orderby' => 'name', 'order' => 'ASC');
                  $terms = get_terms('wp_release_genres', $term_args);
                  if ($terms) {
                      foreach ($terms as $term) {
                           if ($genres) {
                               if (in_array($term->slug, $genres)) {
                                 echo '<li><a data-categories="' . $term->slug . '">' . $term->name . '</a></li>';
                               }
                           } else {
                              echo '<li><a data-categories="' . $term->slug . '">' . $term->name . '</a></li>';
                           }
                      }
                  }
               ?>
            </ul>
            <!-- /cat filter -->
         <?php endif ?>

         <?php if (isset($header_content) && $header_type == 'content' && $header_content != ''): ?>

            <!-- Header content ================================================= -->
            <div class="header-content">
            <?php echo do_content($header_content); ?>
            </div>
         <?php endif ?>

         <?php if (isset($events_count) && $header_type == 'events_counter' && $events_count != 0): ?>

            <!-- Events counter ================================================= -->
            <div class="header-content text-center">
               <span class="events-count" data-number="<?php echo $events_count ?>">00</span>
            </div>
         <?php endif ?>

         <?php if ($header_type == 'event_countdown'): ?>

            <!-- Events countdown ================================================= -->
            <?php if (is_object_in_term($wp_query->post->ID, 'wp_event_type', 'Future events')) : ?>
               <?php
                  $event_date = strtotime(get_post_meta($wp_query->post->ID, '_event_date_start', true));
                  $event_time = strtotime(get_post_meta($wp_query->post->ID, '_event_time_start', true));
               ?>
               <div class="header-content header-countdown-wrap">
                  <!-- countdown -->
                  <div class="header-countdown" data-event-date="<?php echo date('Y/m/d', $event_date) ?> <?php echo date('H:i', $event_time) ?>:00">
                     <div class="days" data-label="<?php _e('Days', SHORT_NAME) ?>">000</div>
                     <div class="hours" data-label="<?php _e('Hours', SHORT_NAME) ?>">000</div>
                     <div class="minutes" data-label="<?php _e('Minutes', SHORT_NAME) ?>">000</div>
                     <div class="seconds" data-label="<?php _e('Seconds', SHORT_NAME) ?>">000</div>
                  </div>
                  <!-- /countdown -->
               </div>
            <?php endif ?>
         <?php endif ?>
      </div>
   </section>
   <!-- /page header -->
<?php endif; ?>

<?php if ($audio_player == 'on' && ! post_password_required() ) : ?>
   <!-- full player -->
   <?php
   // Vars
   $meta_name = '_audio_tracks';

   // Get metadata
   $tracks_id = get_post_meta($wp_query->post->ID, '_tracks_id', true);
   $autostart = get_post_meta($wp_query->post->ID, '_autostart', true);
   $display_playlist = get_post_meta($wp_query->post->ID, '_display_playlist', true);

   if ($autostart == 'on') $autostart = 'true';
   else $autostart = 'false';

   /* Images ids */
   $tracks_ids = get_post_meta($tracks_id, $meta_name, true);
   ?>

   <?php if (!$tracks_ids || $tracks_ids == '') : ?>
      <?php _e('<p class="message error">Audio player error: <strong>Player has no tracks or doesn\'t exists.</strong></p>', SHORT_NAME); ?>
   <?php else : ?>
      <?php
         $count = 0;
         $ids = explode('|', $tracks_ids);
         $defaults = array(
            'custom'     => false,
            'custom_url' => '',
            'title'   => '',
            'desc'    => '',
            'buttons' => '',
            'volume' => $r_option['volume']
         );
         $length = count($ids);
      ?>
      <section id="full-player-wrap" data-display-playlist="<?php echo $display_playlist ?>">
         <div class="container">
            <!-- player -->
            <div id="full-player">
               <ul id="tracklist" data-playnext="true" data-autoplay="<?php echo $autostart; ?>">
                  <?php
                     // Random tracklit
                     if ( is_array( $ids ) ) {
                        // shuffle( $ids ); 
                     }
                  ?>


                  <?php foreach ($ids as $id) : ?>
                     <?php 
                        
                        /* Count */
                        $count++;

                        /* Get image meta */
                        $track = get_post_meta($tracks_id, $meta_name . '_' . $id, true);

                        /* Add default values */
                        if (isset($track) && is_array($track)) $track = array_merge($defaults, $track);
                        else $track = $defaults;

                        /* Check if track is custom */
                        if (wp_get_attachment_url($id)) {
                           $track_att = get_post($id);
                           $track['url'] = wp_get_attachment_url($id);
                           if ($track['title'] == '') $track['title'] = $track_att->post_title;
                        } else {
                           $track['url'] = $track['custom_url'];
                           if ($track['url'] == '') continue;
                           if ($track['title'] == '') $track['title'] = __('Custom Title', SHORT_NAME);
                        }

                     ?>
                     <li><div class="track playable show-ui<?php //if ($count == 1 || $count == $length) echo ''?>" data-url="<?php echo $track['url']; ?>" data-volume="<?php echo $track['volume']; ?>"><?php echo $track['title']; ?></div></li>
                  <?php endforeach; ?>
               </ul>
            </div>
            <!-- /player -->
            <!-- player navigation -->
            <div id="fp-nav">
               <a href="#" class="prev"></a>
               <a href="#" class="play"></a>
               <a href="#" class="next"></a>
               <a href="#" class="details"></a>
            </div>
            <!-- /player navigation -->
            <div id="tracklist-nav"></div>
         </div>
      </section>
      <!-- /full player -->
   <?php endif; ?>
<?php endif; ?>