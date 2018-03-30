<?php

/*
 * The user gets the chance to review all his details once again and stuff and done.
 */
    

switch(esc_attr($_GET['step']))
{
    case 'process':
        $include = "step";
        $template = "wide";
        break;
    case 'done':
        $include = "finished";
        $template = "wide";
        break;
    case 'cancel':
        $include = "cancel";
        $template = "wide";
        break;
    case 'lost_code':
        $include = "lost_code";
        $template = "small";
        break;
    case 'error':
    default:
        $include = "error";
        $template = "wide";
        break;
}

$prefix = $bSettings->getPrefixUnderscored();
   
if($template == "wide"):
?>
 <div id="container">
    <a href="<?php echo home_url('/') ?>">
      <?php if($logo = $bSettings->get('logo_website')): ?>  
        <img src="<?php echo $logo ?>" id="logo" alt="logo" />
      <?php else: ?>
        <img src="<?php bloginfo('stylesheet_directory') ?>/images/main/logo.png" id="logo" alt="logo" />
      <?php endif ?>
    </a>
     
    <div id="payment_process" role="main">
        <div class="payment_container">
 
                
                
            <?php 

            if(!isset($_SESSION['event_id'])) 
            {
                _e('Something went wrong! We did not get any money from you yet, so please try again. The reasons might be: You waited too long on paypal, you found a bug or paypal was down.', $bSettings->getPrefix());
            }else{


                // get template we need
                include 'payment/'.$include.'.php';


            }# event id exists
            ?>

        </div>
    </div>
  </div> <!--! end of #container -->
  
<?php 

else: 
    include 'payment/'.$include.'.php';  
endif; 

?>
