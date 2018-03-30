<p>
    <?php
    
    //retrieve post category from transient cache
    $post_cats = get_transient('plsh_post_legend_cat_cache');
    if(empty($post_cats) || empty($post_cats[get_the_ID()]))
    {
        $cats = wp_get_post_categories(get_the_ID());   //get all current post cats
        if(!empty($cats))
        {
            $cat = $cats[0];
            $category = get_category($cat);
            $link = get_category_link($category);
            $current_post_cat = array('name' => $category->name, 'link' => $link);
            
            //init as empty array
            if(empty($post_cats))
            {
                $post_cats = array();
            }
            
            $post_cats[get_the_ID()] = $current_post_cat;        
            set_transient('plsh_post_legend_cat_cache', $post_cats, 60*60); //1 hour cache
        }
    }
    
    if(!empty($post_cats[get_the_ID()]))
    {
        $post_cat = $post_cats[get_the_ID()];
        echo '<a href="' . esc_url( $post_cat['link'] ) . '" title="' . esc_attr($post_cat['name']) . '" class="tag-default">' . $post_cat['name'] . '</a>';
    }

    
    ?>

    <span class="legend-default">
        <?php 
            $date = get_the_date('M j, Y');
            if($date)
            {
                echo '<i class="fa fa-clock-o"></i>' . $date;
            }
        ?>
        <?php        
        if(comments_open())
        {
            ?> <a href="<?php comments_link(); ?>" class="comment-link"><i class="fa fa-comments"></i><?php comments_number('0', '1', '%'); ?></a> <?php
        }
        ?>
    </span>
</p>