<?php
global $theme_search_url;
$theme_search_url = get_option('theme_search_url');

global $theme_search_fields;
$theme_search_fields= get_option('theme_search_fields');

if( !empty($theme_search_url) && !empty($theme_search_fields) && is_array($theme_search_fields) ):
    ?>
    <section class="advance-search ">
        <?php
        $home_advance_search_title= get_option('theme_home_advance_search_title');
        if(!empty($home_advance_search_title)){
            ?><h3 class="search-heading"><i class="fa fa-search"></i><?php echo $home_advance_search_title; ?></h3><?php
        }
        get_template_part('template-parts/search-form');
        ?>
    </section>
    <?php
endif;
?>