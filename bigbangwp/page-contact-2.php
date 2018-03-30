<?php
/*
Template Name: Contact form full-width
*/  
get_header(); 
global $PAGE_ID;
?>

<?php while ( have_posts() ) : the_post(); 
$featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); 
$featured_image = $featured_image_array[0];
$sidebar = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."select_sidebar", true);

$bra_contact_page_field_1 = of_get_option(BRANKIC_VAR_PREFIX."field_1", of_get_default(BRANKIC_VAR_PREFIX."field_1"));
$bra_contact_page_field_1_title = of_get_option(BRANKIC_VAR_PREFIX."field_1_caption", of_get_default(BRANKIC_VAR_PREFIX."field_1_caption"));
$bra_contact_page_field_1_required = of_get_option(BRANKIC_VAR_PREFIX."field_1_required", of_get_default(BRANKIC_VAR_PREFIX."field_1_required"));
$bra_contact_page_field_1_select = of_get_option(BRANKIC_VAR_PREFIX."field_1_select", of_get_default(BRANKIC_VAR_PREFIX."field_1_select"));

$bra_contact_page_field_2 = of_get_option(BRANKIC_VAR_PREFIX."field_2", of_get_default(BRANKIC_VAR_PREFIX."field_2"));
$bra_contact_page_field_2_title = of_get_option(BRANKIC_VAR_PREFIX."field_2_caption", of_get_default(BRANKIC_VAR_PREFIX."field_2_caption"));
$bra_contact_page_field_2_required = of_get_option(BRANKIC_VAR_PREFIX."field_2_required", of_get_default(BRANKIC_VAR_PREFIX."field_2_required"));
$bra_contact_page_field_2_select = of_get_option(BRANKIC_VAR_PREFIX."field_2_select", of_get_default(BRANKIC_VAR_PREFIX."field_2_select"));

$bra_contact_page_field_3 = of_get_option(BRANKIC_VAR_PREFIX."field_3", of_get_default(BRANKIC_VAR_PREFIX."field_3"));
$bra_contact_page_field_3_title = of_get_option(BRANKIC_VAR_PREFIX."field_3_caption", of_get_default(BRANKIC_VAR_PREFIX."field_3_caption"));
$bra_contact_page_field_3_required = of_get_option(BRANKIC_VAR_PREFIX."field_3_required", of_get_default(BRANKIC_VAR_PREFIX."field_3_required"));
$bra_contact_page_field_3_select = of_get_option(BRANKIC_VAR_PREFIX."field_3_select", of_get_default(BRANKIC_VAR_PREFIX."field_3_select"));

$bra_contact_page_field_4 = of_get_option(BRANKIC_VAR_PREFIX."field_4", of_get_default(BRANKIC_VAR_PREFIX."field_4"));
$bra_contact_page_field_4_title = of_get_option(BRANKIC_VAR_PREFIX."field_4_caption", of_get_default(BRANKIC_VAR_PREFIX."field_4_caption"));
$bra_contact_page_field_4_required = of_get_option(BRANKIC_VAR_PREFIX."field_4_required", of_get_default(BRANKIC_VAR_PREFIX."field_4_required"));
$bra_contact_page_field_4_select = of_get_option(BRANKIC_VAR_PREFIX."field_4_select", of_get_default(BRANKIC_VAR_PREFIX."field_4_select"));

$bra_contact_page_field_5 = of_get_option(BRANKIC_VAR_PREFIX."field_5", of_get_default(BRANKIC_VAR_PREFIX."field_5"));
$bra_contact_page_field_5_title = of_get_option(BRANKIC_VAR_PREFIX."field_5_caption", of_get_default(BRANKIC_VAR_PREFIX."field_5_caption"));
$bra_contact_page_field_5_required = of_get_option(BRANKIC_VAR_PREFIX."field_5_required", of_get_default(BRANKIC_VAR_PREFIX."field_5_required"));
$bra_contact_page_field_5_select = of_get_option(BRANKIC_VAR_PREFIX."field_5_select", of_get_default(BRANKIC_VAR_PREFIX."field_5_select"));  

if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."hide_title", true) != "yes")
{
?>
    <div class="section-title">
    
        <h1 class="title"><?php the_title(); if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true) != "") { ?> <span><?php echo get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true); ?></span><?php } ?></h1>
                        
    </div><!--END SECTION TITLE-->
    
<?php
}
?>
    
<?php
if ($featured_image != "")
{
?>
<div class="one"> 
<p><img src="<?php echo $featured_image; ?>" alt=""></p>
</div><!--END ONE-->
<?php
}
?>
      
    <!-- START CONTACT -->
    
        <div id="bra-map-fullwidth" class="google-map fullwidth"></div>
<script type="text/javascript">  
jQuery(document).ready(function($) {
  $('#bra-map-fullwidth').bra_google_map({location: '<?php echo of_get_option(BRANKIC_VAR_PREFIX."contact_form_location", of_get_default(BRANKIC_VAR_PREFIX."contact_form_location")); ?>', zoom: <?php echo of_get_option(BRANKIC_VAR_PREFIX."contact_form_zoom", of_get_default(BRANKIC_VAR_PREFIX."contact_form_zoom")); ?>});
});
</script>
        
        <div id="contact-intro">
            
            <div class="two-third">        
                <h1 class="title"><?php echo get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."centered_title", true); ?></h1> 
                <p><?php echo get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true); ?></p>
            </div><!--END TWO-THIRD-->
                
            <div class="one-third text-align-right last">            
                <a href="#contact-window" class="contact-button button large orange"><?php _e('Send us a mail', BRANKIC_THEME_SHORT); ?></a>
            </div><!--END ONE-THIRD-->
        
        </div><!--END CONTACT-INTRO-->
        
        <div id="contact-window" class="contact-popup">
        
             <a href="#" class="close button small grey">Close</a>
        
            <div class="section-title">
            
                <h1 class="title"><?php the_title(); if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true) != "") { ?> <span><?php echo get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."subtitle", true); ?></span><?php } ?></h1>
                    
            </div><!--END SECTION TITLE-->        
                    
    <div class="one-half only_contact">
<?php
the_content();
?>
                    
    </div><!--END ONE-HALF-->    
                
                
    <div class="one-half last only_contact">
            
        <h3><?php echo of_get_option(BRANKIC_VAR_PREFIX."contact_form_title", of_get_default(BRANKIC_VAR_PREFIX."contact_form_title")); ?></h3>
                
        <form id="contact-form" class="form" method="post">
            <ul> 
        <?php
        bra_contact_page_create_field($bra_contact_page_field_1, $bra_contact_page_field_1_title, $bra_contact_page_field_1_required, $bra_contact_page_field_1_select);     
        bra_contact_page_create_field($bra_contact_page_field_2, $bra_contact_page_field_2_title, $bra_contact_page_field_2_required, $bra_contact_page_field_2_select);
        bra_contact_page_create_field($bra_contact_page_field_3, $bra_contact_page_field_3_title, $bra_contact_page_field_3_required, $bra_contact_page_field_3_select);
        bra_contact_page_create_field($bra_contact_page_field_4, $bra_contact_page_field_4_title, $bra_contact_page_field_4_required, $bra_contact_page_field_4_select);
        bra_contact_page_create_field($bra_contact_page_field_5, $bra_contact_page_field_5_title, $bra_contact_page_field_5_required, $bra_contact_page_field_5_select);   
if (of_get_option(BRANKIC_VAR_PREFIX."use_captcha", of_get_default(BRANKIC_VAR_PREFIX."")) == "use_captcha") 
{
require_once('includes/recaptchalib.php');
$publickey = of_get_option(BRANKIC_VAR_PREFIX."recaptcha_public_api");
$privatekey = of_get_option(BRANKIC_VAR_PREFIX."recaptcha_private_api");
if ($publickey == "") $publickey = "6Le5jNMSAAAAAO4zTrbL1-S2WY9HOD-1HynRDun3";
if ($privatekey == "") $privatekey = "6Le5jNMSAAAAALuhzPiADxAD44e9YJ7vUIlHQ3GG ";
?>
<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'clean'
 };
</script>
<li>
    <p><?php echo recaptcha_get_html($publickey);?></p>
    <p style="color: red;" id="captchaStatus">&nbsp;</p>
    </li>
<?php
}
?>                 
                    
                <li class="submit-button">
                    <input name="submit" id="submitted" value="<?php _e('Send Message', BRANKIC_THEME_SHORT); ?>" class="submit" type="submit" />
                </li>
            </ul>
        </form><!--END CONTACT FORM-->
<script type="text/javascript">
jQuery(document).ready(function($){
    $('form#contact-form').submit(function() 
    {
        $('form#contact-form .contact-error').remove();
        var hasError = false;
        $('form#contact-form .requiredField').each(function() {
            if(jQuery.trim($(this).val()) == '') 
            {
                var labelText = $(this).prev('label').text();
                $(this).parent().append('<span class="contact-error"><?php _e('Required', BRANKIC_THEME_SHORT); ?></span>');
                $(this).addClass('inputError');
                hasError = true;
            } 
            else 
            { //else 1 
                if($(this).hasClass('email')) 
                { //if hasClass('email')
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if(!emailReg.test(jQuery.trim($(this).val()))) 
                    {
                        var labelText = $(this).prev('label').text();
                        $(this).parent().append('<span class="contact-error"><?php _e('Invalid', BRANKIC_THEME_SHORT); ?></span>');
                        $(this).addClass('inputError');
                        hasError = true;
                    } 

                } //end of if hasClass('email')

            } // end of else 1 
        }); //end of each()
        
        if(!hasError) 
        {
            
                    challengeField = "";
                    responseField = "";
                    <?php
                    if (of_get_option(BRANKIC_VAR_PREFIX."use_captcha", of_get_default(BRANKIC_VAR_PREFIX."use_captcha")) == "yes") 
                    {
                    ?>
                    challengeField = $("input#recaptcha_challenge_field").val();
                    responseField = $("input#recaptcha_response_field").val();
                    <?php
                    }
                    ?>
                    var form_post_data = "";
                    
                    $("#contact-form .bra_c_form").each(function(){
                    form_post_data += $(this).val() + "|||";
                    })
                    for (i = 1 ; i < 10 ; i ++) {
                        form_post_data = form_post_data.replace("&", "and"); 
                    } 
                    var html = $.ajax({
                    type: "POST",
                    url: "<?php echo BRANKIC_ROOT; ?>/includes/ajax.recaptcha.php",
                    data: "recaptcha_challenge_field=" + challengeField + "&recaptcha_response_field=" + responseField + "&form_post_data=" + form_post_data,
                    async: false
                    }).responseText;
                    
                    //alert(html)

                    if(html == "success")
                    {
                        
                        var formInput = $(this).serialize();
                        
                        $("li.submit-button").slideUp();
                        $("form#contact-form").after('<div class="contact-success"><strong><?php _e('THANK YOU!', BRANKIC_THEME_SHORT); ?></strong><p><?php _e('Your email was successfully sent. We will contact you as soon as possible.', BRANKIC_THEME_SHORT); ?></p></div>');
                        
                        $.post($(this).attr('action'),formInput);
                        hasError = false;
                        return false; 
                    }
                    else
                    {
                        <?php
                        if (of_get_option(BRANKIC_VAR_PREFIX."use_captcha", of_get_default(BRANKIC_VAR_PREFIX."use_captcha")) == "yes")
                        {
                        ?>
                        $("#recaptcha_response_field").parent().append('<span class="contact-error extra-padding"><?php _e('Invalid Captcha', BRANKIC_THEME_SHORT); ?></span>');
                        Recaptcha.reload();
                        
                        <?php
                        }
                        else
                        {
                        ?>
                        $("li.submit-button").slideUp();
                        $("form#contact-form").after('<div class="contact-success"><strong><?php _e("Email server problem", BRANKIC_THEME_SHORT); ?></strong></p></div>');
                        <?php    
                        }
                        ?>
                        
                        return false;
                    }

            
            
            
        }


        return false;

    });
});

/*--------------------------------------------------
         CONTACT POPUP WINDOW CODE
---------------------------------------------------*/
jQuery(document).ready(function($) {
    $('a.contact-button').click(function() { 
        var curY = $(this).offset().top;       
        var loginBox = $(this).attr('href');
        //Fade in the Popup
        $(loginBox).fadeIn(300);        
        var popMargTop = ($(loginBox).height() + 24) / 2; 
        var popMargLeft = ($(loginBox).width() + 24) / 2; 
        //alert(popMargTop + " " + curHeight);       
        $(loginBox).css({ 
            'margin-top' : -popMargTop,
            'margin-left' : -popMargLeft
        });
        var newY = $(loginBox).offset().top; 
        if (newY < 0){
            $(loginBox).css({ 
                'margin-top' : 0
            });
        }      
        $('body').append('<div id="contact-mask"></div>');
        $('#contact-mask').fadeIn(300);        
        return false;
    });    
    $('a.close, #contact-mask').live('click', function() { 
      $('#contact-mask , .contact-popup').fadeOut(300 , function() {
        $('#contact-mask').remove();  
    }); 
    return false;
    });
}); 
/*--------------------------------------------------
                   MAP HEIGHT FIXER
---------------------------------------------------*/
jQuery(document).ready(function($) {
   if ($("#contact-intro").length){
       var button_y = $("#contact-intro").offset().top
       var windowHeight = $(window).height();
       if (button_y > windowHeight){
           var current_height = $('#bra-map-fullwidth').height()
           var new_height = parseInt(current_height - (button_y - windowHeight)) + -200;
           var new_height_2 = new_height -80; 
           $('#bra-map-fullwidth').css("height", new_height_2 + "px")
           $('#wrapper.fullwidth').css("height", new_height + "px") 
       }
   }
}); 
</script>               
    </div><!--END ONE-HALF LAST-->   
            
        </div><!--END ID CONTACT-WINDOW CLASS CONTACT-POPUP-->    
    
    <!-- END CONTACT -->


    
      
    

<?php
if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."add_class_title", true) != "no")
{
?>
<script type='text/javascript'>
jQuery(document).ready(function($){
    $(".only_contact h1, .only_contact h2, .only_contact h3, .only_contact h4, .only_contact h5, .only_contact h6").addClass("title");
})    
    
</script>
<?php
} 

if ($sidebar) get_sidebar(); 

?>

<?php endwhile; // end of the loop. ?> 
		
<?php get_footer(); ?>
			