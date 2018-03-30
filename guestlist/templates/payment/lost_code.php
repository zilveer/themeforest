<?php 

$url = get_stylesheet_directory_uri().'/templates/ajax/form_lost_code.ajax.php';

$formtitle = $bSettings->get('events_default_formtitle_no_event');
$newslettertext = $bSettings->get('events_default_formtitle_no_event_no_nl_text');
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

                <?php if($formtitle != ''): ?>
                    <h2><?php _e('Get The Code Back', $bSettings->getPrefix()); ?></h2>
                <?php endif ?>
                    <p><?php _e('If you lost your code, fill out the following form and we will send it to you.', $bSettings->getPrefix()); ?></p>
                <div class="inputframe" style="margin-top: 25px;">
                    <input type="email" value="" name="email" class="event_email"  placeholder="<?php echo __('Email:', $bSettings->getPrefix()); ?>" required>
                </div>

                
                <img src="<?php bloginfo('stylesheet_directory') ?>/images/colorbox/loading.gif" id="event_subscription_loader" style="top:415px; left: 260px">
                
                <div id="add_response"></div>
                
                <input type="hidden" name="event_id" class="event_id" value="<?php the_ID(); ?>">
                <input type="submit" class="submit" style="margin-top: 25px;" value="<?php echo __('Submit', $bSettings->getPrefix()); ?>" />
                
                <script type="text/javascript">

                    jQuery(function($){

                        $("#event-subscribe-form").submit(function() {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo $url ?>",
                                data: "event_id="+$(".event_id").val()+"&email="+$(".event_email").val(),
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