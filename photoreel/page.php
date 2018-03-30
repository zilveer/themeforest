<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php setPostViews(get_the_ID()); ?>
<div class="container">

        <div id="homecontent">
        
        	<?php get_template_part('/includes/mag-ticker-random');?>
        
        	<div <?php post_class(); ?>>
        	<h2 class="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            
                    <div class="entry">
                    <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','themnific') . '</span>', 'after' => '</div>' ) ); ?>
                        <?php the_tags( '<p class="tagssingle">','',  '</p>'); ?>
                    </div>       
                        
				<div style="clear: both;"></div>  

                  
                   	<?php comments_template(); ?>

            </div>



	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria','themnific');?>.</p>

	<?php endif; ?>

                <div style="clear: both;"></div>

        </div><!-- #homecontent -->

</div>

<?php get_footer(); ?>