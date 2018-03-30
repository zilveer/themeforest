<?php get_header(); ?>

<!-- Homepage content -->
<div class="container homepage-content">

    <!-- Photo galleries -->
    <div class="latest-galleries photo-galleries">

        <div class="title-default">
            <a href="<?php echo esc_url(get_post_type_archive_link('gallery')); ?>" class="active"><?php _e('Photo galleries', 'goliath' ); ?></a>
            <a href="<?php echo esc_url(home_url()); ?>" class="go-back"><?php _e('Go back to homepage', 'goliath' ); ?></a>
        </div>
        <?php
        
        $counter = 1;
        
        if ( have_posts() ) : 
            while ( have_posts() ) : the_post();
            
                if($counter % 4 == 1)
                {
                    echo '<div class="items">';
                }
                
                get_template_part('theme/templates/loop-gallery-list-item');
                
                if($counter % 4 == 0)
                {
                    echo '</div>';
                }
                
                $counter++;
                
            endwhile;
        else :
            echo _e('no posts found!', 'goliath');
        endif;
        
        if($counter % 4 != 0)
        {
            echo '</div>';
        }
        
        ?>

        <?php get_template_part('theme/templates/pagination'); ?>
        

    </div>

    <?php echo $banner = plsh_get_banner_by_location('gallery_ad', 'container'); ?>

    <?php
        if(plsh_gs('gallery_show_featured_articles') == 'on')
        {
            get_template_part('theme/templates/featured-posts-large');
        }
    ?>

</div>

<?php get_footer(); ?>