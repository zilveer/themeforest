<?php
get_header();
global $lb_opc;
the_post(); 

$nrposts = get_post_meta($post->ID, '_blog_nrposts', true);
$fullwidth = get_post_meta($post->ID, '_blog_fullwidth', true);
$categories = get_post_meta($post->ID, '_blog_categories', true);
?>
 <div class="bg" style="text-align: left">
    <div class="container">
        <div class="sixteen columns">
            <div class="headline">
                    <h2><span class="lines"><?php _e('Blog', 'LB');?></span></h2>
            </div>
        </div>       

	<?php if ( $lb_opc ['blog_fullwidth'] == "1") { ?>

		<div class="eleven columns blog-bg">

	<?php } else { ?>	
            <div class="sixteen columns blog-bg">	
	<?php } ?>

            <?php
            $args['posts_per_page'] = $nrposts;
            if(count($categories) > 0)
                $args['category__in'] = $categories;
            $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
            $args['paged'] = $paged;
            query_posts($args);
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
                        <?php the_time("d M Y");?> 
                        in <?php the_category(', ') ?> - 
                        <?php comments_popup_link(esc_html__('0 Comments','LB'), esc_html__('1 Comment','LB'), '% '.esc_html__('Comments','LB')); ?>
                    </p>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink();?>"><div class="button1">Continue Reading...</div></a>
                </div>
            <?php endwhile; 
            get_template_part('includes/pagination');
            endif; wp_reset_query();?>
        </div>


	<?php if ( $lb_opc ['blog_fullwidth'] == "1") { ?>

		<div class="four columns sidebar blog-bg">
            <?php  
                dynamic_sidebar("Right sidebar");
            ?>
        </div>

	<?php } else { ?>		
	<?php } ?>
		
    </div>
</div>
<?php get_footer();?>