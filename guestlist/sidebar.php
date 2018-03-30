<div class="subscribeform">
<?php 


// show the sign up form if the event is still ongoing
if($startdate <= time() && $enddate >= time())
{
   

$url = get_stylesheet_directory_uri().'/templates/ajax/form_save.ajax.php';
$url_form = ''; // @TODO

$payment = false;

// check for payment options (atm we only support paypal.
if($bSettings->get('paypal_enable') == 'on')
{
    if($eventprice == "") $eventprice = 0;
    $eventprice = number_format($eventprice, 2, '.', '');
    if($eventprice != 0 && $eventprice != '' && is_numeric($eventprice))
    {
        
        $url_payment = get_stylesheet_directory_uri().'/templates/ajax/form_payment.ajax.php';
        $url_form = get_stylesheet_directory_uri().'/bebelCp2/bundles/bebelPaymentGatewaysBundle/templates/paypal.php';
        $payment = true;
    }
}

if($button_text == '')
{
    $button_text = __('Submit', $bSettings->getPrefix());
}

// check if there are slots left


?>


    <?php
        if($has_free_slots):
    ?>
    <form action="<?php echo $url_form ?>" method="post" id="event-subscribe-form" class="validate" >
        
        <?php if($formtitle != ''): ?>
            <h2><?php echo $formtitle; ?></h2>
        <?php endif ?>
            
        <?php 
        
        // ie fix 
        if($browser != "ie"):
            
        
        ?>
        <div class="inputframe">
            <input type="text" name="first_name" class="event_first_name"  placeholder="<?php echo __('First Name:', $bSettings->getPrefix()); ?>" required>
        </div>
        <div class="inputframe">
            <input type="text" name="last_name" class="event_last_name"  placeholder="<?php echo __('Last Name:', $bSettings->getPrefix()); ?>" required>
        </div>
        <div class="inputframe">
            <input type="email" name="email" class="event_email"  placeholder="<?php echo __('Email:', $bSettings->getPrefix()); ?>" required>
        </div>
            
        <?php else: ?>
        <div class="inputframe">
            <input type="text" name="first_name" class="event_first_name" value="<?php echo __('First Name:', $bSettings->getPrefix()); ?>" onfocus="if(this.value=='<?php echo __('First Name:', $bSettings->getPrefix()); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo __('First Name:', $bSettings->getPrefix()); ?>';">
        </div>
        <div class="inputframe">
            <input type="text" name="last_name" class="event_last_name" value="<?php echo __('Last Name:', $bSettings->getPrefix()); ?>" onfocus="if(this.value=='<?php echo __('Last Name:', $bSettings->getPrefix()); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo __('Last Name:', $bSettings->getPrefix()); ?>';">
        </div>
        <div class="inputframe">
            <input type="text" name="email" class="event_email" value="<?php echo __('Email:', $bSettings->getPrefix()); ?>" onfocus="if(this.value=='<?php echo __('Email:', $bSettings->getPrefix()); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo __('Email:', $bSettings->getPrefix()); ?>';">
        </div>
        <?php endif; ?>    

        <ul class="checkboxes">

            <?php
            if($bSettings->get('events_enable_newsletter') == 'on'):
            ?>
            <li>
                <input type="checkbox" name="send_newsletter" id="event_send_newsletter">
                <label for="event_send_newsletter"><?php echo __('Please send me a Newsletter', $bSettings->getPrefix()); ?>(<a href="<?php bloginfo('wpurl');?>?newsletter=only"><?php echo __('NL only', $bSettings->getPrefix()); ?></a>)</label>	
            </li>
            <?php endif ?>
            <?php
            if($bSettings->get('events_terms_conditions_enable') == 'on'):
            ?>
            <li>
                <input type="checkbox" name="terms_read" id="event_terms_read" required>
                <label for="event_terms_read"><a href="<?php bloginfo('stylesheet_directory') ?>/templates/custom_popup.php?get=terms" class="ajax"><?php echo __('I read the terms and conditions', $bSettings->getPrefix()); ?></a></label>	
            </li>
            <?php endif ?>
        </ul>
            
            
        <input type="hidden" name="event_id" class="event_id" value="<?php the_ID(); ?>">
        
        <div id="add_response">
            
        </div>
        
        <?php if($bSettings->get('paypal_enable') == 'on' && !empty($eventprice) && $eventprice != 0): ?>
            <img src="<?php bloginfo('stylesheet_directory') ?>/images/colorbox/loading.gif" id="event_subscription_loader" style="left: 303px;">
            <input type="submit" class="submit" value="<?php echo $button_text ?>" style="margin-left: 150px" />
            <img class="paypal" src="https://www.paypalobjects.com/en_US/i/logo/PayPal_mark_60x38.gif" alt="<?php _e('paypal logo', $bSettings->getPrefix()) ?>" title="<?php _e('You will be redirected to PayPal after clicking on the buy button', $bSettings->getPrefix()) ?>">
        <?php else: ?>
            <img src="<?php bloginfo('stylesheet_directory') ?>/images/colorbox/loading.gif" id="event_subscription_loader">
            <input type="submit" class="submit" value="<?php echo $button_text ?>" />    
        <?php endif; ?>
        <script type="text/javascript">
			
            jQuery(function($){
                
                $("#event-subscribe-form .submit").click(function() {
                    
                    <?php if(!$payment): ?>
                            
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $url ?>",
                        data: "event_id="+$(".event_id").val()+"&first_name="+$(".event_first_name").val()+"&last_name="+$(".event_last_name").val()+"&email="+$(".event_email").val()+"&send_newsletter="+$("#event_send_newsletter").is(':checked')+"&terms_read="+$("#event_terms_read").is(':checked'),
                        beforeSend: function( xhr ) {
                            $('#event_subscription_loader').show();
                        }
                    }).done(function( msg ) {
                        $("#add_response").html(msg);
                        $("#add_response").fadeIn(400);
                        $('#event_subscription_loader').hide();
                        
                        // if somebody can't wait, let him click it away
                        $("#add_response").click(function() {
                            $(this).fadeOut();
                        });
                        setTimeout(function(){
                              $("#add_response").fadeOut(1000);
                        },3500);
                        
                        
                    });
                    
                    <?php else: ?>
                    
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $url_payment ?>",
                        data: "event_id="+$(".event_id").val()+"&first_name="+$(".event_first_name").val()+"&last_name="+$(".event_last_name").val()+"&email="+$(".event_email").val()+"&send_newsletter="+$("#event_send_newsletter").is(':checked')+"&terms_read="+$("#event_terms_read").is(':checked'),
                        beforeSend: function( xhr ) {
                            $('#event_subscription_loader').show();
                        }
                    }).done(function( msg ) {
                        if(msg == "ok")
                        {
                            $('#event-subscribe-form').submit();
                        }else {
                            $("#add_response").html(msg);
                            $("#add_response").fadeIn(400);
                            $('#event_subscription_loader').hide();

                            // if somebody can't wait, let him click it away
                            $("#add_response").click(function() {
                                $(this).fadeOut();
                            });
                            setTimeout(function(){
                                  $("#add_response").fadeOut(1000);
                            },3500);
                            return false;
                        }
                        
                        
                        
                        
                    });
                    
                    <?php endif; ?>
                    
                    
                    return false;
                });

            });
        </script>
    </form>
    
    <?php 
    // no free slot
    else:
    ?>
    <div class="fullybooked">
        <h2><?php echo __('sold out', $bSettings->getPrefix()); ?></h2>
    </div>
        
    <?php endif; ?>
<?php

}else {
    // show notification that the event is already over
    
    ?>
    
    <div class="fullybooked">
        <h2><?php echo __('Event Over', $bSettings->getPrefix()); ?></h2>
    </div>
    
    <?php
}


?>
</div>