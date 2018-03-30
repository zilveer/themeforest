<?php
$myFile = BRANKIC_INCLUDES . "portfolio_select.txt";

if (is_admin()) 
{
$fh = fopen($myFile, 'w');

if (!$fh) echo ("due to your server settings, you have to CHMOD 777 file " . $myFile . "<br> This file is used only for portfolio shortcode dropdown. You'll still be able to use portfolio shortcode if you don't CHMOD txt file, but you'll have to manually insert ID of parent category.");




     $select = '<select name="cat_id" id="cat_id">';
     $select .= '<option value="">&nbsp;&nbsp;Portfolio type</option>';

$terms = get_terms("portfolio_category");
if ( !(empty($terms))) {
 foreach ( $terms as $term ) {
   $all_portfolio_terms[$term->term_id] = $term->name;                   
 }
  
    foreach ($all_portfolio_terms as $term_id => $term_name) 
    { 
        $select .= '<option value="' .$term_id . '">' . $term_name . '</option>'; 
    } 
}
$select .= '<option value="">&nbsp;&nbsp;Blog type</option>';

$terms_2 = get_terms("category");
if ( !(empty($terms_2))) {
 foreach ( $terms_2 as $term_2 ) {
   $all_portfolio_terms_2[$term_2->term_id] = $term_2->name;                   
 }
  
    foreach ($all_portfolio_terms_2 as $term_id_2 => $term_name_2) 
    { 

    $select .= '<option value="' . $term_id_2 . '">' . $term_name_2 . '</option>';

    } 
}

     $select .= ' </select>';
     
fwrite($fh, $select);
fclose($fh);
}
?>