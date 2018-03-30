<?php 

include_once 'header.php'; 


wp_reset_query();
        
        
        
            
// check if we are in the middle of a payment process. If yes, go there, if not, continue.
$payment_process = isset($_GET['step']) && $_GET['step'] != '' ? true : false;

if($payment_process)
{
    include('templates/payment_process.php');
}else {
    
    // get the  event details
    include 'templates/event_vars.php';

        
    
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
  
}// end payment process if
 
include_once 'footer.php'; 

?>