<?php get_header(); ?>
	<!-- Section -->
	<section role="main">
	<?php if(!is_page()){?>
	<div class="wmffcontainer">
    	<div class="post-padding"></div>
	<?php }?>
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<?php if(!is_page() || is_front_page()){?>
    	<div class="wmffrow">
        	<div class="col-12 wmffcol-xs-12 wmffcol-sm-12 wmffcol-md-12 wmffcol-lg-12">
	<?php }?>
		<!-- Article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<?php if(!is_page()){?>
			<?php 
                    if ( function_exists( 'get_post_format' )){
                            
                        if(!get_post_format( $post->ID )){
							?>
                            
                            <div class="post-mtitle"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
                            <div class="post-content">
                            <?php aurawp_excerpt();?>
                            </div>
                            <div class="post-minfo"><?php the_time('F j, Y'); ?> / <?php comments_popup_link( '', __( '1 Comment / ', 'aurat2d' ), __( '% Comments / ', 'aurat2d' )); ?><?php _e( 'by', 'aurat2d' ); ?> <?php the_author_posts_link(); ?> <?php echo "/  "; the_tags(); ?></div>

                            <?php
                        }else{
                            get_template_part('content',get_post_format());
                        }
                    }
                    ?>
            <?php }else{?>     
			<?php the_content(); ?>
			<?php }?>		
		</article>
		<!-- /Article -->
		 <?php if(!is_page() || is_front_page()){?>
		</div></div>
		
		<?php }?>
	<?php endwhile; ?>
    <?php if(!is_page() ){?>
	<?php get_template_part('pagination'); ?>
    <?php }?>
	<?php else: ?>
	<?php if(!is_page()){?>
    	<div class="wmffrow">
        	<div class="col-12 wmffcol-xs-12 wmffcol-sm-12 wmffcol-md-12 wmffcol-lg-12">
	<?php }?>
		<!-- Article -->
		<article>
			
			<h3><?php _e( 'Sorry, nothing to display.', 'aurat2d' ); ?></h3>
			
		</article>
		<!-- /Article -->
		
		 <?php if(!is_page()){?>
	</div></div>
	<?php }?>
	<?php endif; ?>
	
	
    <?php if(!is_page()){?>
	</div>
	<?php }?>
    </section>
	<!-- /Section -->
<?php get_footer(); ?>