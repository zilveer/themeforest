<!-- Sidebar -->
<div class="main-sidebar <?php if(plsh_gs('sidebar_position') === 'left' && (is_singular(array('post', 'page')) || is_home() || is_search() || is_category() || is_tag())) { echo ' left'; } ?>">

<?php

    $page_sidebars = plsh_gs('page_sidebars');
    $template = plsh_get_sidebar_page_type();
    if(!empty($page_sidebars) && in_array($template, array_keys($page_sidebars)) && !empty($page_sidebars[$template]))
    {
        dynamic_sidebar($page_sidebars[$template]);
    }
    else
    {
        dynamic_sidebar('default');
    }
   
?>
    
</div>