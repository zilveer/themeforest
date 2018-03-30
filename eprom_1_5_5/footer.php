<?php global $r_option; $wp_query; ?>
<?php if (isset($wp_query->post->ID) && !is_tax()) : ?>
   <?php
      // Footer modules
      $footer_module = get_post_meta($wp_query->post->ID, '_footer_module', true);
      if (!isset($footer_module)) $foooter_module = 'disabled';
   ?>
   <?php if ($footer_module == 'gmap') : ?>
      <?php
         $map_address = get_post_meta($wp_query->post->ID, '_map_address', true);
         if (!isset($map_address) || $map_address == '') $map_address = 'Level 13, 2 Elizabeth St, Melbourne Victoria 3000 Australia';
      ?>
      <!-- Google Maps -->
      <section id="gmap" data-address="<?php echo $map_address; ?>">
         <p class="container"><?php _e('Please enable your JavaScript in your browser, to view our location.', SHORT_NAME); ?></p>
      </section>
      <!-- /Google Maps -->
   <?php endif; ?>
   <?php if ($footer_module == 'upcoming_events') : ?>
      <?php 
         $events_limit = get_post_meta($wp_query->post->ID, '_events_limit', true);
         $events_limit = $events_limit == '0' ? $events_limit = '-1' : $events_limit = $events_limit;
       ?>
      <!-- upcoming events -->
      <section id="upcoming-events">
         <section class="container clearfix">
         <!-- left column -->
         <div class="col-1-3">
            <h3 class="medium-heading"><?php _e('<span class="color">Upcoming</span><br/>Events.', SHORT_NAME); ?></h3>
         </div>
         <!-- /left column -->
         <!-- right column -->
         <div class="col-2-3 last">
            <?php 
            $content = '<h3 class="medium-heading">' . __('Currently we have no events.', SHORT_NAME) . '</h3>';
            echo r_events(array('limit' => $events_limit, 'type'=> 'future'), $content); ?>
         </div>
         <!-- /right column -->
         </section>
      </section>
      <!-- /upcoming events -->
   <?php endif; ?>
<?php endif; ?>

</section> 
<!-- / #main-wrapper -->

<!-- footer wrapper -->
<section id="footer-wrapper">
<?php if (isset($r_option['footer_topbar']) && $r_option['footer_topbar'] == 'on') : ?>
<!-- footer-top -->
<section id="footer-top">
   <div class="container clearfix">
      <div class="<?php echo $r_option['address_class'] ?>">
         <ul class="contact">
            <?php if (isset($r_option['topbar_address']) && $r_option['topbar_address'] != '') echo '<li class="address">' . do_content($r_option['topbar_address']) . '</li>'; ?>
            <?php if (isset($r_option['topbar_tel']) && $r_option['topbar_tel'] != '') echo '<li class="phone">' . do_content($r_option['topbar_tel']) . '</li>'; ?>
            <?php if (isset($r_option['topbar_email']) && $r_option['topbar_email'] != '') echo '<li class="email"><a href="mailto:' . $r_option['topbar_email'] . '">' . $r_option['topbar_email'] . '</a></li>'; ?>
         </ul>
      </div>

      <div class="<?php echo $r_option['social_class'] ?>">
         <!-- social icons -->
         <div class="social-icons">
            <?php if (isset($r_option['social_rss']) && $r_option['social_rss'] == 'rss') : ?>
               <a href="<?php bloginfo('rss2_url'); ?>" class="social-icon rss"></a>
            <?php endif; ?>
            <?php if (isset($r_option['social_twitter']) && $r_option['social_twitter'] != '') : ?>
               <a href="<?php echo $r_option['social_twitter']; ?>" class="social-icon twitter"></a>
            <?php endif; ?>
            <?php if (isset($r_option['social_facebook']) && $r_option['social_facebook'] != '') : ?>
               <a href="<?php echo $r_option['social_facebook']; ?>" class="social-icon facebook"></a>
            <?php endif; ?>
            <?php if (isset($r_option['social_gplus']) && $r_option['social_gplus'] != '') : ?>
               <a href="<?php echo $r_option['social_gplus']; ?>" class="social-icon googleplus"></a>
            <?php endif; ?>
            <?php if (isset($r_option['social_lastfm']) && $r_option['social_lastfm'] != '') : ?>
               <a href="<?php echo $r_option['social_lastfm']; ?>" class="social-icon lastfm"></a>
            <?php endif; ?>
            <?php if (isset($r_option['social_soundcloud']) && $r_option['social_soundcloud'] != '') : ?>
               <a href="<?php echo $r_option['social_soundcloud']; ?>" class="social-icon soundcloud"></a>
            <?php endif; ?>
            <?php if (isset($r_option['social_myspace']) && $r_option['social_myspace'] != '') : ?>
               <a href="<?php echo $r_option['social_myspace']; ?>" class="social-icon myspace"></a>
            <?php endif; ?>
            <?php if (isset($r_option['social_youtube']) && $r_option['social_youtube'] != '') : ?>
               <a href="<?php echo $r_option['social_youtube']; ?>" class="social-icon youtube"></a>
            <?php endif; ?>
            <?php if (isset($r_option['social_vimeo']) && $r_option['social_vimeo'] != '') : ?>
               <a href="<?php echo $r_option['social_vimeo']; ?>" class="social-icon vimeo"></a>
            <?php endif; ?>
            <?php if (isset($r_option['social_digg']) && $r_option['social_digg'] != '') : ?>
               <a href="<?php echo $r_option['social_digg']; ?>" class="social-icon digg"></a>
            <?php endif; ?>
            <?php if (isset($r_option['social_skype']) && $r_option['social_skype'] != '') : ?>
               <a href="<?php echo $r_option['social_skype']; ?>" class="social-icon skype"></a>
            <?php endif; ?>
         </div>  
         <!-- /social icons -->
      </div>
   </div>
</section>
<!-- /footer-top -->
<?php endif; ?>
<?php if (isset($r_option['footer_widgets']) && $r_option['footer_widgets'] == 'on') : ?>
<!-- footer widgets -->
<section id="footer-widgets">
   <div class="container clearfix">
      <div class="col-1-3">
         <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-footer-col-1')) : ?>
         <?php endif; ?>
      </div>
      <div class="col-1-3">
         <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-footer-col-2')) : ?>
         <?php endif; ?>
      </div>
      <div class="col-1-3 last">
         <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-footer-col-3')) : ?>
         <?php endif; ?>
      </div>
   </div>
</section>
<?php endif; ?>
<!-- footer -->
<section id="footer" class="clearfix">
   <section class="container clearfix">
      <div class="col-1-2">
         <!-- footer-nav -->
         <?php
            if (has_nav_menu('footer_menu')) wp_nav_menu(array('theme_location' => 'footer_menu', 'container' => 'nav', 'container_id' => 'footer-nav', 'menu_class' => 'clearfix', 'depth' => 1));
            else echo '<p class="warning">' . __('The footer menu has not selected location or does not exist. Go to Wordpress > Appearance > Menus and set your menu.', SHORT_NAME) . '</p>';
         ?>
         <!-- /footer-nav -->
         <div class="copyright">
            <?php if (isset($r_option['copyright'])) echo do_content($r_option['copyright']); ?>
         </div>
      </div>
      <div class="col-1-2 last">
         <?php if (isset($r_option['twitter_username'])) : ?>
         <!-- footer twitter -->
         <div id="footer-twitter">
            <?php
               $r_option['twitter_consumer_key'] = isset($r_option['twitter_consumer_key']) ? $r_option['twitter_consumer_key'] = $r_option['twitter_consumer_key'] : $r_option['twitter_consumer_key'] = '';
               $r_option['twitter_consumer_secret'] = isset($r_option['twitter_consumer_secret']) ? $r_option['twitter_consumer_secret'] = $r_option['twitter_consumer_secret'] : $r_option['twitter_consumer_secret'] = '';
               $r_option['twitter_access_token'] = isset($r_option['twitter_access_token']) ? $r_option['twitter_access_token'] = $r_option['twitter_access_token'] : $r_option['twitter_access_token'] = '';
               $r_option['twitter_access_token_secret'] = isset($r_option['twitter_access_token_secret']) ? $r_option['twitter_access_token_secret'] = $r_option['twitter_access_token_secret'] : $r_option['twitter_access_token_secret'] = '';
            ?>
            <?php 
               echo r_tweets($atts = array(
                  'replies'             => $r_option['twitter_replies'],
                  'limit'               => $r_option['twitter_limit'],
                  'username'            => $r_option['twitter_username'],
                  'consumer_key'        => $r_option['twitter_consumer_key'],
                  'consumer_secret'     => $r_option['twitter_consumer_secret'],
                  'access_token'        => $r_option['twitter_access_token'],
                  'access_token_secret' => $r_option['twitter_access_token_secret']
               )); 
            ?>
         </div>
         <!-- /footer twitter -->
         <?php endif; ?>
      </div>
      <?php if (isset($r_option['twitter_username'])) : ?>
      <!-- twitter icon -->
      <a href="http://twitter.com/<?php echo $r_option['twitter_username']; ?>" class="twitter-button"></a>
      <?php endif; ?>
   </section>
</section>
<!-- /footer -->
</section>
<!-- /footer-wrapper -->
<?php if (isset($r_option['google_analytics'])) echo $r_option['google_analytics']; ?>
<?php if (isset($r_option['use_cufon_fonts']) && $r_option['use_cufon_fonts'] == 'on') : ?>
<script type="text/javascript"> Cufon.now(); </script>
<?php endif; ?>
<?php wp_footer(); ?> 
</body>
</html>