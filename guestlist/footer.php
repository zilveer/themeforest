<?php 

// get the last valid events

$querystr = "
    SELECT * FROM $wpdb->posts
    LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
    WHERE $wpdb->posts.post_status = 'publish'
    AND $wpdb->posts.post_type = '".$bSettings->getPrefix()."_event'
    AND $wpdb->postmeta.meta_key = '".$bSettings->getPrefix()."_event_date'
    ORDER BY $wpdb->postmeta.meta_value ASC
";



$events_loop_footer = $wpdb->get_results($querystr, OBJECT);

    
$menu = array(
    'echo' => false,
    'container' => false,
    'items_wrap' => '%3$s',
    'depth' => 1
);


$menu = wp_nav_menu($menu);

$menu = str_replace('<div class="menu"><ul>', '', $menu);
$menu = str_replace('</ul></div>', '', $menu);


$menu = preg_replace("/<ul [^>]*?>(.*)<\/ul>/","$1", $menu);



?>
  
  <footer>
	<ul class="menu">
		<li>
			
			<ul class="upcoming_menu">
				<li>
                    <div id="inline_nav">
					<?php
                    $i = 0;
                    global $post;
                    foreach($events_loop_footer as $post)
                    {
                        
                        setup_postdata($post);
                        
                        if($i >= 3) break;
                        
                        $startdate  = strtotime(BebelUtils::getCustomMeta('event_registration_start', '', get_the_ID()));
                        $enddate    = strtotime(BebelUtils::getCustomMeta('event_registration_end', '', get_the_ID()));
                        $eventdate  = strtotime(BebelUtils::getCustomMeta('event_date', '', get_the_ID()));
                        $has_free_slots = bebelEventsUtils::checkForFreeSlot(get_the_id());


                        if($startdate <= time() && $enddate >= time() && ($bSettings->get('events_hide_booked_events') == "off" || $has_free_slots))
                        {
                            // ok, we can use this one
                            $i++;
                            include 'templates/footer_menu_bit.php';
                        }
                    }

                    ?>
									
				
                <?php
                // count valid entries (upcoming events) for pagination
                $j = 0;
                foreach($events_loop_footer as $post)
                {
                    $startdate  = strtotime(BebelUtils::getCustomMeta('event_registration_start', '', get_the_ID()));
                    $enddate    = strtotime(BebelUtils::getCustomMeta('event_registration_end', '', get_the_ID()));
                    if($startdate <= time() && $enddate >= time()) 
                    {
                        $j++;
                    }
                }
                
                if($j > 3)
                {
                    $limit = 1;
                    $page_event = 0;
                    include 'templates/footer_menu_navigation.php';
                }
                ?>
                </div>
                </li>
			</ul>
            <?php if($j > 3): ?>
            <input type="hidden" class="event_current_page" value="0">
            <?php endif ?>
            <a href="#" class="upcoming"><?php _e('Upcoming Events', $bSettings->getPrefix()) ?> <span class="new_count"><?php echo $j; ?></span></a>
		</li>
        <?php echo $menu ?>
	</ul>
  </footer>


  
  <?php 
  
  wp_footer();
  if($bSettings->get('google_analytics_name') != ''): ?>
  
  <script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
    try{
    var pageTracker = _gat._getTracker("<?php echo $bSettings->get('google_analytics_name') ?>");
    pageTracker._trackPageview();
    } catch(err) {}
  </script>
  <?php endif; ?>


  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>
