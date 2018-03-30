<div class="bd-sidebar theia_sticky">
    <div class="theiaStickySidebar">
    <?php
    if ( is_home() )
    {
        if (is_active_sidebar('primary-widget')) :
            dynamic_sidebar('primary-widget');
        endif;
    }
    elseif ( function_exists('is_bbpress') && is_bbpress() )
    {
        if (is_active_sidebar('bdbb-widget'))
        {
            dynamic_sidebar('bdbb-widget');
        }
        else
        {
            dynamic_sidebar('primary-widget');
        }
    }
    elseif ( is_page() )
    {
        $name = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
        if($name[0])
        {
            generated_dynamic_sidebar($name[0]);
        }
        elseif(is_active_sidebar('page-widget'))
        {
            dynamic_sidebar('page-widget');
        }
        else
        {
            dynamic_sidebar('primary-widget');
        }
    }
    elseif ( is_single() )
    {
        $name = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
        if($name[0])
        {
            generated_dynamic_sidebar($name[0]);
        }
        elseif(is_active_sidebar('post-widget'))
        {
            dynamic_sidebar('post-widget');
        }
        else
        {
            dynamic_sidebar('primary-widget');
        }
    }
    elseif ( is_category() )
    {
        if (is_active_sidebar('categories-widget')) :
            dynamic_sidebar('categories-widget');
        else :
            dynamic_sidebar('primary-widget');
        endif;
    }
    else
    {
        if (is_active_sidebar('primary-widget')) :
            dynamic_sidebar('primary-widget');
        endif;
    }
    wp_reset_query();
    ?>
</div>
</div>
    <!-- .bd-sidebar-->