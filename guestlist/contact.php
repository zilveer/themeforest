<?php 

$url = get_stylesheet_directory_uri().'/templates/ajax/form_contact.ajax.php';


?>

<!-- Google Maps Code -->
        <script type="text/javascript"
                src="http://maps.google.com/maps/api/js?sensor=false">
        </script>
        <script type="text/javascript">
           

        </script>
        <!-- END Google Maps Code -->

<div id="main_post" role="main">
    <div class="contact_container">
        <form action="" method="post" id="contact-form" class="validate">
        <h1><?php the_title() ?></h1>
        
        <div class="content">
            <?php the_content() ?>
       </div>
        
        <div class="contact-form">
            <?php 
            // ie fix 
            if($browser != "ie"):
            ?>
            <div class="inputframe">
                <input type="text" name="name" class="contact_name"  placeholder="<?php echo __('Name:', $bSettings->getPrefix()); ?>" required/>
            </div>
            <div class="inputframe">
                <input type="email" name="email" class="contact_email"  placeholder="<?php echo __('Email:', $bSettings->getPrefix()); ?>" required/>
            </div>
            <div class="inputframe_big">
                <textarea name="text" class="contact_message" placeholder="<?php echo __('Message:', $bSettings->getPrefix()); ?>" required></textarea>
            </div>
            <?php else: ?>
            
            
            <div class="inputframe">
                <input type="text" name="name" class="contact_name" value="<?php echo __('Name:', $bSettings->getPrefix()); ?>" onfocus="if(this.value=='<?php echo __('Name:', $bSettings->getPrefix()); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo __('Name:', $bSettings->getPrefix()); ?>';" />
            </div>
            <div class="inputframe">
                <input type="email" name="email" class="contact_email" value="<?php echo __('Email:', $bSettings->getPrefix()); ?>" onfocus="if(this.value=='<?php echo __('Email:', $bSettings->getPrefix()); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo __('Email:', $bSettings->getPrefix()); ?>';"/>
            </div>
            <div class="inputframe_big">
                <textarea name="text" class="contact_message"><?php echo __('Message:', $bSettings->getPrefix()); ?></textarea>
            </div>
            <?php endif; ?>
            <div class="add_response"></div>
        </div>
        
        <div class="google-maps">
            <h2><?php echo __('Want to meet us?', $bSettings->getPrefix()); ?></h2>
            <div id="map_canvas">
                
            </div>
            <img src="<?php bloginfo('stylesheet_directory') ?>/images/colorbox/loading.gif" id="contact_loader">
            <input id="submit" type="submit" value="<?php echo __('submit', $bSettings->getPrefix()); ?>" name="submit">
        </div>
        
        <script type="text/javascript">
			
             var geocoder;
            var map;
  
            function getMap() {
                var address = "<?php echo $bSettings->get('contact_address'); ?>";
    
                geocoder = new google.maps.Geocoder();
                if (geocoder) {
                    geocoder.geocode( { 'address': address}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            
                            var latlng = new google.maps.LatLng(results[0].geometry.location.lat().toFixed(3), results[0].geometry.location.lng().toFixed(3));
                            
                            var image = "<?php echo get_bloginfo('stylesheet_directory') ?>/images/event/where.png";
                            
                            var myOptions = {
                                zoom: 16,
                                center: latlng,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            }
                            
                            
var contentString = '<div id="content">'+
    '<div id="siteNotice">'+
    '</div>'+
    '<div id="bodyContent">'+
    '<p><?php echo $bSettings->get('contact_address'); ?></p>'+
    '</div>'+
    '</div>';

var infowindow = new google.maps.InfoWindow({
    content: contentString
});

                            
                            
                            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                            
                            var beachMarker = new google.maps.Marker({
      position: latlng,
      map: map,
      icon: image,
      title : "<?php echo $bSettings->get('contact_address'); ?>"
  });
  
  google.maps.event.addListener(beachMarker, 'click', function() {
  infowindow.open(map,beachMarker);
});

                        } else {
                            alert("Geocode was not successful for the following reason: " + status);
                        }
                    });
                }
            }
            
            jQuery(function($){
                
                getMap();
                
                
                $("#contact-form").submit(function() {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $url ?>",
                        data: "name="+$(".contact_name").val()+"&email="+$(".contact_email").val()+"&message="+$(".contact_message").val(),
                        beforeSend: function( xhr ) {
                            $('#contact_loader').show();
                        }
                    }).done(function( msg ) {
                        $(".add_response").html(msg).show();
                        $('#contact_loader').hide();
                        $('.add_response').click(function() {
                           $(this).fadeOut(); 
                        });

                    });
                    return false;
                });

            });
        </script>
    </div>				
</div>