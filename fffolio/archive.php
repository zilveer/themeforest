<?php 

get_header();
global $fffolio;
the_post(); 
?>
 <div class="page_bg">
    <div class="container">
        <!-- start sixteen columns -->
        <div class="eleven">
            <?php
            global $query_string;
            $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
            query_posts($query_string . '&posts_per_page=5&paged=' . $paged);
            if(have_posts()) : while(have_posts()) : the_post(); ?>
                <div <?php post_class('article'); ?>>
                    <h3 style="margin-bottom: 5px"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <p class="line2nd meta">
                        <?php _e('Posted on', 'fffolio');?> <?php the_time("d M Y");?> 
                        in <?php the_category(', ') ?> | 
                        <?php comments_popup_link(esc_html__('0 comments','fffolio'), esc_html__('1 comment','fffolio'), '% '.esc_html__('comments','fffolio')); ?>
                    </p>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink();?>"><div class="button1">Read More</div></a>
                </div>
            <?php endwhile; 
            get_template_part('includes/pagination');
            endif; wp_reset_query();?>
        </div> <!-- end sixteen columns -->

        <!-- start sidebar -->
        <div class="five columns sidebar">
            <?php 
            if($fullwidth == 0) 
                dynamic_sidebar("Right sidebar");
            ?>
        </div>
        <!-- end sidebar -->

    </div>
</div>
<?php get_footer();?>