<?php

global $var_prefix, $root;
 
$page_title = BRANKIC_THEME." Global Options";
$menu_title = "Brankic Panel";
$capability = "manage_options";
$menu_slug = "themes.php?page=options-framework";
$function = "";
$icon_url =  BRANKIC_ROOT.'/bra_favicon.ico';
$position = "61";

// http://localhost/WordPressSabloni/Bigbang/WordPress/wp-admin/admin.php?page=brankic_admin_1
// http://localhost/WordPressSabloni/Bigbang/WordPress/wp-admin/themes.php?page=options-framework   

function mytheme_add_admin() 
{
    global $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position; 
    $hook = add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    add_action('admin_enqueue_scripts-' . $hook, 'my_admin_scripts');
}
add_action('admin_menu', 'mytheme_add_admin');



function mytheme_admin() {
 
global $var_prefix, $menu_slug, $root, $page_title; 
$i=0;

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

<h2><?php echo $page_title; ?></h2>
 
<form action="admin.php?page=<?php echo $menu_slug; ?>" method="post">
<h3>Global Options</h3>
<table class="form-table">
<tbody>
<?php bra_form_select(BRANKIC_VAR_PREFIX."color", "Choose color", array("blue" => "Blue", 
                                                                        "navyblue" => "Navy blue",
                                                                        "orange" => "Orange",
                                                                        "yellow" => "Yellow",
                                                                        "green" => "Green",
                                                                        "tealgreen" => "Tealgreen",
                                                                        "red" => "Red",
                                                                        "pink" => "Pink",
                                                                        "purple" => "Purple",
                                                                        "magenta" => "Magenta",
                                                                        "cream" => "Cream"), "", "", ""); ?>
<?php bra_form_upload(BRANKIC_VAR_PREFIX."logo", "Logo", BRANKIC_ROOT."/images/logo.png", "Logo is placed in the header", "Upload file", "logo"); ?> 

<?php bra_form_upload(BRANKIC_VAR_PREFIX."logo2", "Logo 2", BRANKIC_ROOT."/images/logo-min.png", "Logo for pinned menu (activated on scroll)", "Upload file", "logo"); ?>

<?php bra_form_select(BRANKIC_VAR_PREFIX."pinned_menu", "Show Pinned menu on scroll", array("no" => "No", 
                                                                "yes" => "Yes"), "", "", ""); ?> 
                                                                          
<?php bra_form_upload(BRANKIC_VAR_PREFIX."background_image", "Background image", "", "", "Upload file", ""); ?> 

<?php bra_form_select(BRANKIC_VAR_PREFIX."tile_background", "Tile image", array("no" => "No", 
                                                                "yes" => "Yes"), "", "If no is selected, image will be stretched", ""); ?>                                                                            

<?php bra_form_select(BRANKIC_VAR_PREFIX."boxed_stretched", "Boxed or Stretched style", array("boxed" => "Boxed", 
                                                                                              "stretched" => "Stretched"), "", "Boxed is better if you're using background image", ""); ?>                                                               

<?php bra_form_upload(BRANKIC_VAR_PREFIX."favicon", "Favicon", BRANKIC_ROOT."/bra_favicon.ico", ".ico format only", "Upload favicon", ""); ?>

<?php bra_form_text(BRANKIC_VAR_PREFIX."custom_google_font", "Google Font Family", 500, "font-family: 'Oswald', sans-serif;", "Go to Google Web Fonts web page and grab the code between h1 { and }", ""); ?>
<?php bra_form_text(BRANKIC_VAR_PREFIX."custom_google_font_href", "URL for Google Font", 500, "<link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css' />", "Go to Google Web Fonts web page", ""); ?>

 <?php bra_form_textarea(BRANKIC_VAR_PREFIX."extra_javascript", "Extra JavaScript", 500, 4, "", "Define some extra javascript code", ""); ?>
<?php bra_form_textarea(BRANKIC_VAR_PREFIX."extra_css", "Extra CSS", 500, 4, "", "Define some extra CSS styles", ""); ?> 

<?php bra_form_textarea(BRANKIC_VAR_PREFIX."ga", "Google Analytics tracking code", 500, 4, "", "Insert your Google Analytics tracking code (whole code)", ""); ?>

<?php bra_form_text(BRANKIC_VAR_PREFIX."extra_images_no", "Number of Extra images (used for slides)", 60, "5", "", ""); ?> 

<?php bra_form_select(BRANKIC_VAR_PREFIX."disable_responsive", "Disable responsive layout", array("no" => "No", 
                                                                "yes" => "Yes"), "", "If you disable responsive layout website layout won't adjust to screen size of viewers device", ""); ?>

<?php bra_form_select(BRANKIC_VAR_PREFIX."show_panel", "Show Panel", array("no" => "No", 
                                                                "yes" => "Yes"), "", "Show panel with style options (like on our live preview)", ""); ?>
                                                                
<?php bra_form_select(BRANKIC_VAR_PREFIX."short_pages_fix", "Short pages fix", array("no" => "No", 
                                                                "yes" => "Yes"), "", "If there's not much content on the page footer will be fixed to the bottom of the page (beta version)", ""); ?>                                                                

</tbody>
</table>



<?php bra_form_submit(); ?> 


</form>
</div> 
<?php
}
?>