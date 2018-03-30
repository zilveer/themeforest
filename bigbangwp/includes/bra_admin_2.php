<?php
$parent_slug_2 = "brankic_admin_1";
$page_title_2 = BRANKIC_THEME." Blog Page";
$menu_title_2 = "Blog Page";
$capability_2 = "manage_options";
$menu_slug_2 = "brankic_admin_2";
$function_2 = "mytheme_admin2";


function mytheme_add_admin2() 
{
global $parent_slug_2, $page_title_2, $menu_title_2, $capability_2, $menu_slug_2, $function_2;
$hook = add_submenu_page( $parent_slug_2, $page_title_2, $menu_title_2, $capability_2, $menu_slug_2, $function_2);
add_action('admin_enqueue_scripts-' . $hook, 'my_admin_scripts');
}

add_action('admin_menu', "mytheme_add_admin2");

function mytheme_admin2() {

global $menu_slug_2, $page_title_2; 
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


 
<h2><?php echo $page_title_2; ?></h2>
 
<form action="admin.php?page=<?php echo $menu_slug_2; ?>" method="post">
    <h3>Contact page options</h3>  
    <table class="form-table">
    <tbody>
    <?php bra_form_select(BRANKIC_VAR_PREFIX."category_page_style", "Category page style", array("1" => "Style 1", 
                                                                                                 "2" => "Style 2",
                                                                                                 "3" => "Style 3",
                                                                                                 "4" => "Style 4",
                                                                                                 "5" => "Style 5",
                                                                                                 "6" => "Style 6",), "", "This is if you bring category to the WP menu", ""); ?>
                                                                                                       
    <?php bra_form_select(BRANKIC_VAR_PREFIX."category_page_style_fullwidth", "Category page : Full width layout, or default sidebar", array("no" => "Sidebar", 
                                                                                         "yes" => "Full Width"), "", "This is if you bring category to the WP menu", ""); ?>
    <?php bra_form_select(BRANKIC_VAR_PREFIX."show_cats_blog_page", "Show categories on blog page", array("no" => "No", 
                                                                                                          "yes" => "Yes"), "", "", ""); ?>
    <?php bra_form_select(BRANKIC_VAR_PREFIX."show_cats_blog_single_page", "Show categories on blog single page", array("no" => "No", 
                                                                                                                        "yes" => "Yes"), "", "", ""); ?>
    <?php bra_form_select(BRANKIC_VAR_PREFIX."blog_single_page_style", "Blog single page style", array("1" => "Style 1", 
                                                                                                       "2" => "Style 2",
                                                                                                       "3" => "Style 3",
                                                                                                       "4" => "Style 4",
                                                                                                       "5" => "Style 5",
                                                                                                       "6" => "Style 6",), "", "", ""); ?>
    <?php bra_form_select(BRANKIC_VAR_PREFIX."blog_single_page_style_fullwidth", "Blog single : Full width layout, or sidebar", array("no" => "Sidebar", 
                                                                                         "yes" => "Full Width"), "", "", ""); ?>
    <?php bra_form_select(BRANKIC_VAR_PREFIX."show_share", "Show sharing options", array("no" => "No", 
                                                                                         "yes" => "Yes"), "", "", ""); ?>
    <?php bra_form_select(BRANKIC_VAR_PREFIX."show_tags_blog_page", "Show tags on blog page", array("no" => "No", 
                                                                                                    "yes" => "Yes"), "", "", ""); ?>
    <?php bra_form_select(BRANKIC_VAR_PREFIX."show_tags_blog_single_page", "Show tags on blog single page", array("no" => "No", 
                                                                                                                  "yes" => "Yes"), "", "", ""); ?>
    <?php bra_form_select(BRANKIC_VAR_PREFIX."hide_no_of_comments", "Hide number of comments if there are no comments", array("no" => "No", 
                                                                                                                  "yes" => "Yes"), "", "", ""); ?>
   
    </tbody>
    </table>
          



 <?php bra_form_submit(); ?> 
</form>
</div> 
 

<?php
}
?>