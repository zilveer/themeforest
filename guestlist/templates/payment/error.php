<?php
    
    
    $userdata = maybe_unserialize(($_SESSION[$prefix.'userdata']));
    
    $url_form = get_stylesheet_directory_uri().'/bebelCp2/bundles/bebelPaymentGatewaysBundle/templates/paypal.php';
    $cancel_link = BebelUtils::addParameterToPermalink(get_permalink(), array('step' => 'cancel'));
    
    $checked_terms = '';
    if(isset($userdata['terms_read']) && $userdata['terms_read'] == "on")
    {
        $checked_terms = 'checked="checked"';
    }
    
    $checked_nl = '';
    if(isset($userdata['send_newsletter']) && $userdata['send_newsletter'] == "on")
    {
        $checked_nl = 'checked="checked"';
    }
    
?>

    <h1><?php the_title(); ?></h1>
    
    
    
    <div class="errorlist">
        <?php echo $_SESSION[$prefix.'errors']; ?>
        
        <a href="<?php echo $cancel_link ?>" class="cancel"><?php _e('Cancel', $bSettings->getPrefix()) ?></a>
    </div>
    <div class="form">
        <form action="<?php echo $url_form ?>" method="post" id="event-subscribe-form" class="validate" >
        <?php 
        
        // ie fix 
        if($browser != "ie"):
            
        
        ?>
        <div class="inputframe">
            <input type="text" name="first_name" value="<?php echo esc_attr($userdata['first_name']) ?>" class="event_first_name"  placeholder="<?php echo __('First Name:', $bSettings->getPrefix()); ?>" required>
        </div>
        <div class="inputframe">
            <input type="text" name="last_name" value="<?php echo esc_attr($userdata['last_name']) ?>" class="event_last_name"  placeholder="<?php echo __('Last Name:', $bSettings->getPrefix()); ?>" required>
        </div>
        <div class="inputframe">
            <input type="email" name="email" value="<?php echo esc_attr($userdata['email']) ?>" class="event_email"  placeholder="<?php echo __('Email:', $bSettings->getPrefix()); ?>" required>
        </div>
            
        <?php else: ?>
        <div class="inputframe">
            <input type="text" name="first_name" class="event_first_name" value="<?php echo !empty($userdata['first_name']) ? esc_attr($userdata['first_name']) : __('First Name:', $bSettings->getPrefix()); ?>" onfocus="if(this.value=='<?php echo __('First Name:', $bSettings->getPrefix()); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo __('First Name:', $bSettings->getPrefix()); ?>';">
        </div>
        <div class="inputframe">
            <input type="text" name="last_name" class="event_last_name" value="<?php echo !empty($userdata['last_name']) ? esc_attr($userdata['last_name']) : __('Last Name:', $bSettings->getPrefix()); ?>" onfocus="if(this.value=='<?php echo __('Last Name:', $bSettings->getPrefix()); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo __('Last Name:', $bSettings->getPrefix()); ?>';">
        </div>
        <div class="inputframe">
            <input type="text" name="email" class="event_email" value="<?php echo !empty($userdata['email']) ? esc_attr($userdata['email']) : __('Email:', $bSettings->getPrefix()); ?>" onfocus="if(this.value=='<?php echo __('Email:', $bSettings->getPrefix()); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo __('Email:', $bSettings->getPrefix()); ?>';">
        </div>
        <?php endif; ?>    

        <ul class="checkboxes">

            <?php
            if($bSettings->get('events_enable_newsletter') == 'on'):
            ?>
            <li>
                <input type="checkbox" name="send_newsletter" id="event_send_newsletter" <?php echo $checked_nl ?>>
                <label for="event_send_newsletter"><?php echo __('Please send me a Newsletter', $bSettings->getPrefix()); ?></label>	
            </li>
            <?php endif ?>
            <?php
            if($bSettings->get('events_terms_conditions_enable') == 'on'):
            ?>
            <li>
                <input type="checkbox" name="terms_read" id="event_terms_read" required <?php echo $checked_terms ?>>
                <label for="event_terms_read"><a href="<?php bloginfo('stylesheet_directory') ?>/templates/custom_popup.php?get=terms" class="ajax"><?php echo __('I read the terms and conditions', $bSettings->getPrefix()); ?></a></label>	
            </li>
            <?php endif ?>
        </ul>
        
        <input type="submit" class="submit" value="<?php echo $button_text ?>" />
        <input type="hidden" name="event_id" class="event_id" value="<?php echo $_SESSION['event_id'] ?>">
        <img src="<?php bloginfo('stylesheet_directory') ?>/images/colorbox/loading.gif" id="event_subscription_loader_error">
        </form>
        <script type="text/javascript">
			
            jQuery(function($){
                
                $("#event-subscribe-form .submit").click(function() {
                    
                    $('#event_subscription_loader_error').show();
                    $('#event-subscribe-form').submit();
                    return false;
                });

            });
        </script>
    </div>

    