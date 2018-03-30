<?php

/**
 * Template Name: Contact page
 */
?>

<?php 
$contact_page_email = rwmb_meta( 'gg_contact_page_email' );
$contact_page_success = rwmb_meta( 'gg_contact_page_success_msg' );
$contact_page_error = rwmb_meta( 'gg_contact_page_error_msg' );

$map_config_address = rwmb_meta( 'gg_map_config_address' );
$map_config_infobox = rwmb_meta( 'gg_map_config_infobox' );
$map_config_zoom = rwmb_meta( 'gg_map_config_zoom' );
$disable_map_directions = rwmb_meta( 'gg_disable_map_directions' );

$commentError ='';
$emailError ='';
$nameError ='';
//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['comments']) === '') {
			$commentError = 'You forgot to enter your comments.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = $contact_page_email;
			$subject = 'Contact Form Submission from '.$name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			if($sendCopy == true) {
				$subject = 'You emailed yourself';
				$headers = 'From: Your Name <noreply@somedomain.com>';
				mail($email, $subject, $body, $headers);
			}

			$emailSent = true;

		}
	}
} ?>

<?php get_header();
//Retrieve and verify sidebars 
$contact_sidebar = rwmb_meta('gg_contact-widget-area');
$sidebar_list = of_get_option('sidebar_list');
if ($sidebar_list) : $contact_sidebar_exists = in_array_r($contact_sidebar, $sidebar_list); else : $contact_sidebar_exists = false; endif;
?>

<script>
var $j = jQuery.noConflict();
$j(document).ready(function() {
	var WPmap = {

    // HTML Elements we'll use later!
    mapContainer   : document.getElementById('map-container'),
    dirContainer   : document.getElementById('dir-container'),
    toInput        : document.getElementById('map-config-address'),
    fromInput      : document.getElementById('from-input'),
    unitInput      : document.getElementById('unit-input'),
    geoDirections  : document.getElementById('geo-directions'),
    nativeLinkElem : document.getElementById('native-link'),
    startLatLng    : null,
    destination    : null,
    geoLocation    : null,
    geoLat         : null,
    geoLon         : null,

    // Google Maps API Objects
    dirService     : new google.maps.DirectionsService(),
    dirRenderer    : new google.maps.DirectionsRenderer(),
    map:null,

    /**
     *
     * Determine if the geolocation API is available in the browser.
     *
     */
    getGeo : function(){
        if (!! navigator.geolocation)
			<?php 
			if ( $disable_map_directions ) {
				echo "return undefined;";
			} else {
				echo "return navigator.geolocation;";
			}
			?>
        else
            return undefined;
    },

    /**
     * Get the Current Position
     */
    getGeoCoords : function (){
        
        WPmap.geoLoc.getCurrentPosition(WPmap.setGeoCoords, WPmap.geoError)
    },

    /**
     * Set the Lat/Lon Values to the object.
     * Set extra buttons for users with Geo Capabilities
     */
    setGeoCoords : function (position){

        WPmap.geoLat = position.coords.latitude;
        WPmap.geoLon = position.coords.longitude;
        WPmap.showGeoButton();
        WPmap.setNativeMapLink();
    },

    /**
     * Geo Errors - Useful for Dev - Hidden in production.
     */
    geoError : function(error) {
        var message = "";
        // Check for known errors
        switch (error.code) {
            case error.PERMISSION_DENIED:
                message = "This website does not have permission to use " +
                    "the Geolocation API";
                break;
            case error.POSITION_UNAVAILABLE:
                message = "Sorry, your current position cannot be determined, please enter your address instead.";
                break;
            case error.PERMISSION_DENIED_TIMEOUT:
                message = "Sorry, we're having trouble trying to determine your current location, please enter your address instead.";
                break;
        }
        // If it's an unknown error, build a message that includes
        // information that helps identify the situation, so that
        // the error handler can be updated.
        if (message == "")
        {
            var strErrorCode = error.code.toString();
            message = "The position could not be determined due to " +
                "an unknown error (Code: " + strErrorCode + ").";
        }
       console.log(message);
    },

    /**
     * Show the 'use current location' button
     */
    showGeoButton : function(){

        var geoContainer = document.getElementById('geo-directions');
        geoContainer.removeClass('hidden');
    },

    /*  Show the 'open in google maps' button */
    setNativeMapLink: function(){

        var locString   = WPmap.geoLat + ',' + WPmap.geoLon;
        var destination = WPmap.toInput.value;
        var newdest     = destination.replace(' ', '');
        WPmap.nativeLinkElem.innerHTML = ('or <a href="http://maps.google.com/maps?mrsp=0' 
            + '&amp;daddr='
            + newdest 
            + '&amp;saddr=' 
            + locString
            + '" class="more-link inline-block">Open in Google Maps <span class="meta-nav">&raquo;</span></a>');
    },

    /* Determine whether an Admin has entered lat/lon values or a regular address. */
    getDestination:function() {

        var toInput = WPmap.toInput.value;
        var isLatLon  = (/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/.test(toInput));

        if (isLatLon){
            var n = WPmap.toInput.value.split(",");
            WPmap.destination = new google.maps.LatLng(n[0], n[1]);
            WPmap.setupMap();
        }
        else {

            geocoder = new google.maps.Geocoder();
            geocoder.geocode( { 'address': WPmap.toInput.value}, function(results, status){

                WPmap.destination = results[0].geometry.location;
                WPmap.setupMap();
            });
        }
    },

    /* Initialize the map */
    setupMap : function() {

        //get the content
        var infoWindowContent = WPmap.mapContainer.getAttribute('data-map-infowindow');
        var initialZoom       = WPmap.mapContainer.getAttribute('data-map-zoom');

        WPmap.map = new google.maps.Map(WPmap.mapContainer, {
            zoom:parseInt(initialZoom),     //ensure it comes through as an Integer
            center:WPmap.destination,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        });

        marker = new google.maps.Marker({
            map:WPmap.map,
            position:WPmap.destination,
            draggable:false
        });

        //set the infowindow content
        infoWindow = new google.maps.InfoWindow({
            content:infoWindowContent
        });
        infoWindow.open(WPmap.map, marker);

    },

    getSelectedUnitSystem:function () {
        return WPmap.unitInput.options[WPmap.unitInput.selectedIndex].value == 'metric' ?
            google.maps.DirectionsUnitSystem.METRIC :
            google.maps.DirectionsUnitSystem.IMPERIAL;
    },

    /**
     * Get the directions
     * Check if the user has selected a Geo option & use that instead
     */
    getDirections:function (request) {

        //Get the postcode that was entered
        var fromStr = WPmap.fromInput.value;

        var dirRequest = {
            origin      : fromStr,
            destination : WPmap.destination,
            travelMode  : google.maps.DirectionsTravelMode.DRIVING,
            unitSystem  : WPmap.getSelectedUnitSystem()
        };

        //check if user clicked 'use current location'
        if (request == 'geo'){
            var geoLatLng = new google.maps.LatLng( WPmap.geoLat , WPmap.geoLon );
            dirRequest.origin = geoLatLng;
        }

        WPmap.dirService.route(dirRequest, WPmap.showDirections);
    },

    /**
     * Output the Directions into the page.
     */
    showDirections:function (dirResult, dirStatus) {
        if (dirStatus != google.maps.DirectionsStatus.OK) {
            switch (dirStatus){
                case "ZERO_RESULTS" : alert ('Sorry, we can\'t provide directions to that address (you maybe too far away, are you in the same country as us?) Please try again.')
                    break;
                case "NOT_FOUND" : alert('Sorry we didn\'t understand the address you entered - Please try again.');
                    break;
                default : alert('Sorry, there was a problem generating the directions. Please try again.')
            }
            return;
        }
        // Show directions
        WPmap.dirRenderer.setMap(WPmap.map);
        WPmap.dirRenderer.setPanel(WPmap.dirContainer);
        WPmap.dirRenderer.setDirections(dirResult);
    },

    init:function () {

        if (WPmap.geoLoc = WPmap.getGeo()){
            //things to do if the browser supports GeoLocation.
            WPmap.getGeoCoords();
        }

        WPmap.getDestination();

        //listen for when Directions are requested
        google.maps.event.addListener(WPmap.dirRenderer, 'directions_changed', function () {

            infoWindow.close();         //close the first infoWindow
            marker.setVisible(false);   //remove the first marker

            //setup strings to be used.
            var distanceString = WPmap.dirRenderer.directions.routes[0].legs[0].distance.text;

            //set the content of the infoWindow before we open it again.
            infoWindow.setContent('Thanks!<br /> It looks like you\'re about <strong> ' + distanceString + '</strong> away from us. <br />Directions are just below the map');

            //re-open the infoWindow
            infoWindow.open(WPmap.map, marker);
            setTimeout(function () {
                infoWindow.close()
            }, 8000); //close it after 8 seconds.

        });
    }//init
};

google.maps.event.addDomListener(window, 'load', WPmap.init);


/* Function to easily remove any class from an element. */
HTMLElement.prototype.removeClass = function(remove) {
    var newClassName = "";
    var i;
    var classes = this.className.split(" ");
    for(i = 0; i < classes.length; i++) {
        if(classes[i] !== remove) {
            newClassName += classes[i] + " ";
        }
    }
    this.className = newClassName;
}
});
</script>

<?php if ( $map_config_address ) { ?>
<div id="map-container" data-map-infowindow="<?php echo $map_config_infobox; ?>" data-map-zoom="<?php echo $map_config_zoom; ?>"></div>


<div class="contact_google_map <?php if ( $disable_map_directions ) { ?> hidden <?php } ?>">
<div id="dir-container" class="container"></div>
<div id="directions" class="container">
    <p class="inline-block">For driving directions :</p>
    <input id="from-input" type="text" value="" size="20" placeholder="Enter your address here" />
    <select onchange="" id="unit-input">
        <option value="imperial" selected="selected">Imperial</option>
        <option value="metric">Metric</option>
    </select>
    <a href="#" onclick="WPmap.getDirections('manual'); return false" class="more-link inline-block">Get Driving Directions <span class="meta-nav">&raquo;</span></a>
    <br />
    <input id="map-config-address" type="hidden" value="<?php echo $map_config_address; ?>"/>
    <div id="geo-directions" class="hidden">
    <p class="inline-block">Alternatively, you can: </p>
    <a href="#" onclick="WPmap.getDirections('geo'); return false" class="more-link inline-block">Use your Current Location <span class="meta-nav">&raquo;</span></a>
    <span id="native-link" class="inline-block"></span>
    </div>
</div>

</div>
<?php } ?>
	
<div class="clear"></div>

<div class="container">

<?php st_before_content($columns=''); get_template_part( 'loop', 'page' );?>

<script>
var $j = jQuery.noConflict();

$j(document).ready(function() {
	$j('form#contactForm').submit(function() {
		$j('.messages-holder .error').remove();
		var hasError = false;
		$j('.requiredField').each(function() {
			if(jQuery.trim($j(this).val()) == '') {
				var labelText = $j(this).prev('label').text();
				$j('.messages-holder').append('<span class="error">You forgot to enter your '+labelText+'.</span>');
				hasError = true;
			} else if($j(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim($j(this).val()))) {
					var labelText = $j(this).prev('label').text();
					$j('.messages-holder').append('<span class="error">You entered an invalid '+labelText+'.</span>');
					hasError = true;
				}
			}
		});
		if(!hasError) {
			$j('form#contactForm li.buttons button').fadeOut('normal');
			var formInput = $j(this).serialize();
			$j.post($j(this).attr('action'),formInput, function(data){
				$j('form#contactForm').slideUp("fast", function() {				   
					$j(this).before('<p class="thanks"><?php echo $contact_page_success;?></p>');
				});
			});
		}
		
		return false;
		
	});
});
</script>

<div class="messages-holder">

<?php 

if(isset($emailSent) && $emailSent == true) { ?>
	<div class="thanks">
		<h1>Thank you, <?php $name;?> !</h1>
		<p><?php echo $contact_page_success;?></p>
	</div>
<?php } else { ?>
	
<?php if(isset($hasError) || isset($captchaError)) { ?>
    <p class="error"><?php echo $contact_page_error;?><p>
<?php } ?>
		
<?php if($commentError != '') { ?>
	<span class="error"><?php $commentError;?></span> 
<?php } ?>
<?php if($emailError != '') { ?>
	<span class="error"><?php $emailError;?></span>
<?php } ?>
<?php if($nameError != '') { ?>
	<span class="error"><?php $nameError;?></span> 
<?php } ?>	
</div>
		<h3 class="widget-title">Contact form </h3>
		<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
	
			<ul class="contact-form">
				<li>
                	<label for="contactName">Name</label>
					<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" />
                </li>    
                <li>    
					<label for="email">Email</label>
					<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" />
				</li>
				
				<li class="textarea"><label for="commentsText">Comments</label>
					<textarea name="comments" id="commentsText" rows="20" cols="30" class="requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
				</li>
				
				<li class="screenReader"><label for="checking" class="screenReader">If you want to submit this form, do not enter anything in this field</label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></li>
				<li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit">Send email</button></li>
			</ul>
		</form>
	
<?php } ?>


<?php st_after_content(); get_sidebar("contact"); ?>
<?php get_footer(); ?>