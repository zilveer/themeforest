<?php
class Mobile_Menu_Walker_Nav_Menu extends Walker_Nav_Menu 
{
    public function start_lvl(&$output, $depth = 0, $args = array()) 
	{
        $indent = str_repeat("\t", $depth);
        if($args->theme_location == "main-menu" && $depth==0)
            $output .='<a href="#" class="template-arrow-menu"></a>';
        
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
}
?>