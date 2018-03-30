<?php 
get_header();
global $lb_opc;
the_post(); 
$options = get_post_meta($post->ID, 'vp_ptemplate_settings', true);
?>

 <div class="bg" style="text-align: left">
    <div class="container">
        <div class="sixteen columns">
            <div class="headline">

            <h2><span class="lines"> <?php single_tag_title(); ?> </span></h2>

            </div>
        </div>
		
		<div class="eleven columns blog-bg">
		
            <?php

            global $query_string;

            $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );

            query_posts($query_string . '&posts_per_page=5&paged=' . $paged);

            $i = 1;

            if(have_posts()) : while(have_posts()) : the_post(); ?>

                <div <?php post_class('article'); ?>>
					<?php
						//get feat img
						$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-post');
					?>	
					<?php if($feat_img) { ?>
						<a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="loop-entry-thumbnail"><img src="<?php echo $feat_img[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
					<?php } ?>

                    <h3 style="margin-bottom: 5px"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>

                    <p class="line2nd meta">

                        <?php _e('Posted on', 'LB');?> <?php the_time("d M Y");?> 

                        in <?php the_category(', ') ?> | 

                        <?php comments_popup_link(esc_html__('0 comments','LB'), esc_html__('1 comment','LB'), '% '.esc_html__('comments','LB')); ?>

                    </p>

                    <?php the_excerpt(); ?>

                    <a href="<?php the_permalink();?>"><div class="button1">Read More</div></a>

                </div>

            <?php endwhile; 

            get_template_part('includes/pagination');

            endif; wp_reset_query();?>

        </div> <!-- end sixteen columns -->

		
        <div class="four columns sidebar blog-bg">
            <?php  
                dynamic_sidebar("Right sidebar");
            ?>
        </div>
		
		
    </div>

</div>

<?php get_footer();?>