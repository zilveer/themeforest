<?php 
/**
 * The single template to view a whole blog entry.
 */

get_header(); ?>

	<section id="main" class="content-box grid_8 alpha">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
        <article class="inner-content" id="post-<?php the_ID(); ?>">           
            
            <h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            
            <?php if ( has_post_thumbnail() ) : 
                
                $image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( get_the_ID() ), 'large');  
                $image_title = get_post( get_post_thumbnail_id() )->post_title; 
                
            ?>
            <a href="<?php echo $image_attributes[0]; ?>" title="<?php echo $image_title; ?>" rel="prettyphoto" class="post-teaser"><?php the_post_thumbnail( 'post-teaser' ); ?></a>
            <?php endif; ?>
            
            <?php post_meta_menu(); ?>
            
            <div class="entry-content"><?php the_content(); ?></div>
            
            <?php stylico_social_menu(); ?>
                
            <?php the_tags('<div class="meta-tags">', ', ', '</div>'); ?></div>
            
            <div class="clear"></div>
            
            <?php wp_link_pages(array('before' => '<div class="post-link-pages"><strong>Pages:</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
            
            <?php edit_post_link(__('Edit this entry.', 'stylico'), '<div>', '</div>'); ?>
            
            <?php comments_template(); ?>
            
        </article>
      
        <?php endwhile; else: ?>
      
            <p><?php _e('Sorry, no posts matched your criteria.', 'stylico'); ?></p>
      
        <?php endif; ?>

	</section>
    
	<?php get_sidebar(); ?>

<?php get_footer(); ?>
