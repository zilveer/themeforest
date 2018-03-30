

<footer>
        
        <ul class="container clearfix">
            
                 <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer")) ; ?>
            
        </ul>
    
        
    </footer>
    
      
        <div class="smallFooter">
            
            <div class="container">
                
                <div class="contentLeft eight columns"><?php echo ot_get_option('smallfooterleftcontent') ?></div>
                
                <div class="contentRight eight columns"><?php echo ot_get_option('smallfooterrightcontent') ?></div>
                
            </div>
            
        </div>

      <?php wp_footer(); ?> 

 <script type="text/javascript">
 
    jQuery(window).load(function() {
  
      jQuery('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: true,
        slideshow: false,
        itemWidth: 185,
        touch: false,
        itemMargin: 5,
        asNavFor: '#slider', 
        start: function(){
          jQuery('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: true,
            <?php if (ot_get_option('autoslide') == 'yes') {  ?>
              slideshow: true,
            <?php } else { ?>
              slideshow: false,
            <?php } ?>
            sync: "#carousel"
          });
        }
      });
   
    });
    
  </script> 
  
   <script type="text/javascript">

var messageDelay = 2000;  // How long to display status messages (in milliseconds)

// Init the form once the document is ready
jQuery( init );


// Initialize the form

function init() {

  // Hide the form initially.
  // Make submitForm() the form's submit handler.
  // Position the form so it sits in the centre of the browser window.
  jQuery('#contactForm').submit( submitForm );

  // When the "Send us an email" link is clicked:
  // 1. Fade the content out
  // 2. Display the form
  // 3. Move focus to the first field
  // 4. Prevent the link being followed

  jQuery('a[href="#contactForm"]').click( function() {
    jQuery('#content').fadeTo( 'slow', .2 );
    jQuery('#contactForm').fadeIn( 'slow', function() {
      jQuery('#senderName').focus();
    } )

    return false;
  } );
  
  // When the "Cancel" button is clicked, close the form
  jQuery('#cancel').click( function() { 
 
    jQuery('#content').fadeTo( 'slow', 1 );
  } );  

  // When the "Escape" key is pressed, close the form
  jQuery('#contactForm').keydown( function( event ) {
    if ( event.which == 27 ) {
   
      jQuery('#content').fadeTo( 'slow', 1 );
    }
  } );

}


// Submit the form via Ajax

function submitForm() {
  var contactForm = jQuery(this);

  // Are all the fields filled in?

  if ( !jQuery('#senderName').val() || !jQuery('#senderEmail').val() || !jQuery('#message').val() ) {

    // No; display a warning message and return to the form
    jQuery('#incompleteMessage').fadeIn().delay(messageDelay).fadeOut();
    delay(messageDelay).fadeIn();

  } else {

    // Yes; submit the form to the PHP script via Ajax

    jQuery('#sendingMessage').fadeIn();
    


    jQuery.ajax( {
      url: contactForm.attr( 'action' ) + "?ajax=true",
      type: contactForm.attr( 'method' ),
      data: contactForm.serialize(),
      success: submitFinished
    } );
  }

  // Prevent the default form submission occurring
  return false;
}


// Handle the Ajax response

function submitFinished( response ) {
  response = jQuery.trim( response );
  jQuery('#sendingMessage').fadeOut();

  if ( response == "success" ) {

    // Form submitted successfully:
    // 1. Display the success message
    // 2. Clear the form fields
    // 3. Fade the content back in

    jQuery('#successMessage').fadeIn().delay(messageDelay).fadeOut();
    jQuery('#senderName').val( "" );
    jQuery('#senderEmail').val( "" );
    jQuery('#message').val( "" );

    jQuery('#content').delay(messageDelay+500).fadeTo( 'slow', 1 );
        
     var t=setTimeout(function(){
               
                   jQuery('.contact').click();
           },2000)

  } else {

    // Form submission failed: Display the failure message,
    // then redisplay the form
    jQuery('#failureMessage').fadeIn().delay(messageDelay).fadeOut();
    jQuery('#contactForm').delay(messageDelay+500).fadeIn();
  }
}

</script>
      
  </body>
  
</html>

