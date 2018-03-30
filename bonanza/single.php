<?php get_header();?>

<?php 
global $theme_shortname;  
$meta = icore_get_multimeta(array('Subheader'));
$location = icore_get_location();    
?>

<div id="entry-full">
    <div id="left">
		<div id="head-line"> 
	    <h1 class="title"><?php  the_title();  ?></h1>
		</div>
        <div class="post-full single">
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="post-content"> 
						<?php if ( has_post_thumbnail() && get_option($theme_shortname.'_'.$location.'_thumb') == 'on') { ?>         
							<div class="thumb loading"> 
                             <?php the_post_thumbnail( 'post-single', 'title=' ); ?>
                             <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="zoom-icon" rel="shadowbox"></a>            
                         	</div> <!--  end .thumbnail  -->
						<?php } ?>    
                        <?php the_content(); ?> 
                    </div>  <!--  end .post-content  -->

                    <?php the_tags(); ?>

                    <div class="meta">
                        <?php the_time('M j, Y | ');  _e('Posted by ','Bonanza');  the_author_posts_link(); ?> <?php _e('in ','Bonanza');  the_category(', ') ?> | <?php comments_popup_link(__('0 comments','Bonanza'), __('1 comment','Bonanza'), '% '.__('comments','Bonanza')); ?>
                    </div>  <!--  end .meta  -->
					<?php comments_template(); ?>

				<?php endwhile; else: ?>

					<p><?php _e('Sorry, no posts matched your criteria.','Bonanza'); ?></p>

				<?php endif; ?>
           </div>  
         </div> <!--  end .post  -->
    </div> <!--  end #right  -->
<?php get_sidebar(); ?>
</div> <!--  end #entry-full  -->
<?php get_footer(); ?>