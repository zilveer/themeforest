<?php 

$url = get_stylesheet_directory_uri().'/templates/ajax/form_newsletter_only.ajax.php';

?>
<div id="container_no_event">
    <a href="<?php echo home_url('/') ?>">
          <?php if($logo = $bSettings->get('logo_website')): ?>  
            <img src="<?php echo $logo ?>" id="logo" alt="logo" />
          <?php else: ?>
            <img src="<?php bloginfo('stylesheet_directory') ?>/images/main/logo.png" id="logo" alt="logo" />
          <?php endif ?>
          </a>
    <div id="subscribe" role="subscription panel">

        <div class="subscribeform">
            <form action="" method="post" id="event-subscribe-form" class="validate" >

                
                    <h2><?php echo __('Sign Up For Newsletter', $bSettings->getPrefix());; ?></h2>
                
                <div class="inputframe">
                    <input type="text" name="first_name" class="event_first_name"  placeholder="<?php echo __('First Name:', $bSettings->getPrefix()); ?>" required/>
                </div>
                <div class="inputframe">
                    <input type="text" name="last_name" class="event_last_name"  placeholder="<?php echo __('Last Name:', $bSettings->getPrefix()); ?>" required/>
                </div>
                <div class="inputframe">
                    <input type="email" value="" name="email" class="event_email"  placeholder="<?php echo __('Email:', $bSettings->getPrefix()); ?>" required>
                </div>

                <ul class="checkboxes">
                    <?php
                    if($bSettings->get('events_terms_conditions_enable') == 'on'):
                    ?>
                    <li>
                        <input type="checkbox" name="terms_read" id="event_terms_read" required>
                        <label for="event_terms_read"><a href="<?php bloginfo('stylesheet_directory') ?>/templates/custom_popup.php?get=terms" class="ajax"><?php echo __('I read the terms and conditions', $bSettings->getPrefix()); ?></a></label>	
                    </li>
                    <?php endif ?>
                </ul>

                <img src="<?php bloginfo('stylesheet_directory') ?>/images/colorbox/loading.gif" id="event_subscription_loader" style="top:415px; left: 260px">
                <div id="add_response">

                </div>
                <input type="submit" class="submit" value="<?php echo __('Submit', $bSettings->getPrefix()); ?>" />
                <script type="text/javascript">

                    jQuery(function($){

                        $("#event-subscribe-form").submit(function() {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo $url ?>",
                                data: "event_id="+$(".event_id").val()+"&first_name="+$(".event_first_name").val()+"&last_name="+$(".event_last_name").val()+"&email="+$(".event_email").val()+"&terms_read="+$("#event_terms_read").is(':checked'),
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
                            return false;
                        });

                    });
                </script>
            </form>
        </div>
    </div>
  </div> <!--! end of #container -->