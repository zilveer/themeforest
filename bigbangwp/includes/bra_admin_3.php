<?php
$parent_slug_3 = "brankic_admin_1";
$page_title_3 = BRANKIC_THEME." Contact Page";
$menu_title_3 = "Contact Page";
$capability_3 = "manage_options";
$menu_slug_3 = "brankic_admin_3";
$function_3 = "mytheme_admin3";


function mytheme_add_admin3() 
{
global $parent_slug_3, $page_title_3, $menu_title_3, $capability_3, $menu_slug_3, $function_3;
$hook = add_submenu_page( $parent_slug_3, $page_title_3, $menu_title_3, $capability_3, $menu_slug_3, $function_3);
add_action('admin_enqueue_scripts-' . $hook, 'my_admin_scripts');
}

add_action('admin_menu', "mytheme_add_admin3");

function mytheme_admin3() {

global $menu_slug_3, $page_title_3; 
?>
<div class='wrap'>  
<?php

if (isset($_POST["submit"]))
{
if ($_POST["submit"] == "Save Changes")
{
?>
<div class="updated">Options saved</div>
<?php

    $bra_var_length = strlen(BRANKIC_VAR_PREFIX); 
    foreach($_POST as $key=>$value)
    {
        
        if (substr($key, 0, $bra_var_length) == BRANKIC_VAR_PREFIX)
        {           
            if (is_array($value))
            {
                $serialized_value = serialize($value);
                update_option($key, $serialized_value);
            }
            else
            {
                $value = str_replace("\\", "", $value); 
                update_option($key, $value);
            }
        }
        
                
    }
}


} 
?>


 
<h3><?php echo $page_title_3; ?></h3>
 
<form action="admin.php?page=<?php echo $menu_slug_3; ?>" method="post">
    <h3>Contact page options</h3>  
    <table class="form-table">
    <tbody>
    <?php bra_form_text(BRANKIC_VAR_PREFIX."email_to", "Who will receive emails", 400, "", "Insert your email", ""); ?>
    
    <?php bra_form_text(BRANKIC_VAR_PREFIX."email_from", "Email from field", 400, "", "Insert email address in case you want to have static email FROM field", ""); ?>
    
    <?php bra_form_select(BRANKIC_VAR_PREFIX."email_from_2", "Insert the number of email field below", array("" => "I'll use static email address from above", 
                                                                                                       "1" => "1",
                                                                                                       "2" => "2",
                                                                                                       "3" => "3",
                                                                                                       "4" => "4",
                                                                                                       "5" => "5",), "", "If you select email field, you'll be able to directly reply to sender", ""); ?>
    
    <?php bra_form_text(BRANKIC_VAR_PREFIX."email_subject", "Email subject", 400, "", "Insert subject of email", ""); ?>
    
    <?php bra_form_select(BRANKIC_VAR_PREFIX."use_captcha", "Use reCaptcha", array("no" => "No", 
                                                                  "yes" => "Yes"), "", "", ""); ?>
                                                                  
    <?php bra_form_text(BRANKIC_VAR_PREFIX."recaptcha_public_api", "reCaptcha public key", 400, "", "Grab your keys from reCaptha website http://www.google.com/recaptcha/whyrecaptcha", "recaptcha"); ?>
    
    <?php bra_form_text(BRANKIC_VAR_PREFIX."recaptcha_private_api", "reCaptcha private key", 400, "", "Grab your keys from reCaptha website http://www.google.com/recaptcha/whyrecaptcha", "recaptcha"); ?> 
    
    <?php bra_form_text(BRANKIC_VAR_PREFIX."contact_form_title", "Heading above contact form", 400, "Send us a message", "Insert heading", ""); ?> 
    
    <?php bra_form_text(BRANKIC_VAR_PREFIX."contact_form_location", "Location if you're using full-width layout", 400, "Amsterdam", "Insert your location", ""); ?>
    
    <?php bra_form_text(BRANKIC_VAR_PREFIX."contact_form_zoom", "Zoom level (if you're using full-width layout", 50, "15", "15 is good, less is much wider", ""); ?>
    </tbody>
    </table>
    
        <?php
    
    
    
    for ($i = 1 ; $i <= 5 ; $i++)
    {
    ?>
    <div class="line"></div> 
    <table class="form-table">
    <tbody>
    
    <?php bra_form_select(BRANKIC_VAR_PREFIX."field_$i", "Field $i", array("Nothing" => "Nothing",
                                                                  "text" => "Text", 
                                                                  "select" => "Select",
                                                                  "textarea" => "Textarea"), "", "", ""); ?>
                                                                  
    <?php bra_form_text(BRANKIC_VAR_PREFIX."field_$i"."_caption", "Field $i caption", 400, "", "Insert caption for the field $i", "field_$i"."_caption"); ?>
    
    <?php bra_form_select(BRANKIC_VAR_PREFIX."field_$i"."_required", "Field $i required", array("no" => "No", 
                                                                  "yes" => "Yes",
                                                                  "yes_email" => "Yes - Email"), "", "", "field_$i"."_required"); ?>
                                                                  
    <?php bra_form_text(BRANKIC_VAR_PREFIX."field_$i"."_select", "Field $i select options", 400, "", "Insert options separated by comma", "field_$i"."_select"); ?> 
    </tbody>
    </table>
    
    <?php
    }
    ?>            



 <?php bra_form_submit(); ?> 
</form>
</div> 
 

<?php
}
?>