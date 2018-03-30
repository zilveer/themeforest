<?php if(plsh_gs('show_trending') == 'on') { ?>

    <?php
    $args = array();
    $category = plsh_gs('trending_category');
    $category_link = '#';
    
    if($category)
    {
        $args['cat'] = $category;
        $category_link = get_category_link($category);
    }
    
    $items = plsh_get_post_collection($args, 10);
    
    if(!empty($items)) 
    {
    ?>
        <!-- Trending -->
        <div class="container trending">
            <div class="title-default">
                <a href="<?php echo esc_url($category_link); ?>" class="active"><?php echo plsh_gs('trending_title'); ?></a>
                <div class="controls">
                    <a href="#" id="ticker-prev" class="prev"><i class="fa fa-caret-up"></i></a>
                    <a href="#" id="ticker-next" class="next"><i class="fa fa-caret-down"></i></a>
                    <a href="#" class="pause"><i class="fa fa-pause"></i></a>
                </div>
            </div>
            <div class="items-wrapper">
                <ul id="newsticker" class="items newsticker cycle-slideshow"
                    data-index="1"
                    data-cycle-slides="> li"
                    data-cycle-auto-height="calc"
                    data-cycle-paused="false"                                 
                    data-cycle-speed="500"
                    data-cycle-next="#ticker-next"
                    data-cycle-prev="#ticker-prev"
                    data-cycle-fx="scrollVert"
                    data-cycle-log="false"
                    data-cycle-pause-on-hover="true"
                    data-cycle-timeout="2000">
                    <?php 
                    foreach($items as $post_item)
                    {
                        $is_featured = get_post_meta( $post_item->ID, $key = 'is_featured', $single = true );
                        ?>
                            <li class="item<?php if($is_featured == 'on') { echo ' hot'; } ?>">
                                <a href="<?php echo get_permalink($post_item->ID); ?>">
                                    <?php if($is_featured == 'on') { echo '<i class="tag-default">' . __('Featured', 'goliath') . '</i>'; } ?>                                    
                                    <?php echo get_the_title($post_item->ID); ?>
                                </a>
                                <span class="legend-default"><i class="fa fa-clock-o"></i><?php echo get_the_date('', $post_item->ID); ?></span>
                                <?php if(plsh_is_post_hot($post_item->ID)) { echo '<span class="hotness">' . __('Hot', 'goliath') . '</span>'; } ?>
                            </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="social">
                <?php
                    if(plsh_gs('show_header_social') == 'on')
                    {
                        if(plsh_gs('social_facebook') != '')
                        {
                            echo '<a href="' . plsh_gs('social_facebook') . '" target="_blank"><i class="fa fa-facebook-square"></i></a> ';
                        }
                        if(plsh_gs('social_twitter') != '')
                        {
                            echo '<a href="' . plsh_gs('social_twitter') . '" target="_blank"><i class="fa fa-twitter-square"></i></a> ';
                        }
                        if(plsh_gs('social_youtube') != '')
                        {
                            echo '<a href="' . plsh_gs('social_youtube') . '" target="_blank"><i class="fa fa-youtube-square"></i></a> ';
                        }
                        if(plsh_gs('social_pinterest') != '')
                        {
                            echo '<a href="' . plsh_gs('social_pinterest') . '" target="_blank"><i class="fa fa-pinterest-square"></i></a> ';
                        }
                        if(plsh_gs('social_gplus') != '')
                        {
                            echo '<a href="' . plsh_gs('social_gplus') . '" target="_blank"><i class="fa fa-google-plus-square"></i></a> ';
                        }
                        if(plsh_gs('social_instagram') != '')
                        {
                            echo '<a href="' . plsh_gs('social_instagram') . '" target="_blank"><i class="fa fa-instagram"></i></a> ';
                        }	
						if(plsh_gs('social_linkedin') != '')
                        {
                            echo '<a href="' . plsh_gs('social_linkedin') . '" target="_blank"><i class="fa fa-linkedin-square"></i></a> ';
                        }
                        if(plsh_gs('social_rss') != '')
                        {
                            echo '<a href="' . plsh_gs('social_rss') . '" target="_blank"><i class="fa fa-rss-square"></i></a>';
                        }
                    }
                ?>
            </div>
        </div>
    <?php
    }
    wp_reset_postdata();
} ?>