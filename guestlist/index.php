<?php 

include_once 'header.php'; 


if($bSettings->get('static_mainpage_enable') == 'off')
{

    // get the last event
    
    
    
    $querystr = "
        SELECT * FROM $wpdb->posts
        LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
        WHERE $wpdb->posts.post_status = 'publish'
        AND $wpdb->posts.post_type = '".$bSettings->getPrefix()."_event'
        AND $wpdb->postmeta.meta_key = '".$bSettings->getPrefix()."_event_date'
        ORDER BY $wpdb->postmeta.meta_value ASC
    ";
    
    
    
    $events_loop = $wpdb->get_results($querystr, OBJECT);
    
    
    if(!$events_loop)
    {
        include 'event_empty.php';
    }else {
        
        $nlonly = isset($_GET['newsletter']) && $_GET['newsletter'] == "only" ? true : false;
        if($nlonly)
        {
            include 'templates/newsletter_only.php';
        }else {
    
        $i = 0; 
        global $post;
        foreach($events_loop as $post):
            setup_postdata($post);
    
        
            if($i >= 1) break;
        
    
            include 'templates/event_vars.php';
        
            if($startdate <= time() && $enddate >= time() && ($bSettings->get('events_hide_booked_events') == "off" || $has_free_slots)):
                // ok, we can use this one
                $i++;
        
    
    ?>

  <div id="container">
    <a href="<?php echo home_url('/') ?>">
          <?php if($logo = $bSettings->get('logo_website')): ?>  
            <img src="<?php echo $logo ?>" id="logo" alt="logo" />
          <?php else: ?>
            <img src="<?php bloginfo('stylesheet_directory') ?>/images/main/logo.png" id="logo" alt="logo" />
          <?php endif ?>
          </a>
    <div id="subscribe" role="contentinfo">
    	<!-- form begin -->
    	<?php include 'sidebar.php' ?>
    	<!-- form end -->    	
    		
    </div>
    
      
    
    <div id="main" role="main">
		<div class="event_container">
            <?php include_once 'templates/event.php'; ?>
		</div>				
    </div>
  </div> <!--! end of #container -->
  
  <?php
            
            else:
                include 'event_empty.php';

            endif;
        endforeach;
        }
    }
  
  
}else {
    // static mainpage is on
    
    include_once 'templates/main_static.php';
}    
    
    
    
include_once 'footer.php'; ?>  