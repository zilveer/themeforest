<?php 
/**
 * The template for displaying all pages.
 * 
 * Includes page with right sidebar(standard), page with left sidebar and page in fullwidth
 *
 */
 
 
get_header();

//save page class corresponding which page template is used
$page_class = 'grid_8 alpha';
$post_teaser_type = 'post-teaser';
if( is_page_template('page-leftsidebar.php') )
	$page_class = 'grid_8 omega';
else if( is_page_template('page-fullwidth.php') ) {
	$post_teaser_type = 'post-teaser-fullwidth';
	$page_class = 'container_12';
}
	

//include sidebar at the left
if( is_page_template('page-leftsidebar.php') )
	get_sidebar();

?>
	<section id="main" class="content-box <?php echo $page_class; ?>">
    
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
        <article class="inner-content">
        
            <h2 class="post-title"><?php the_title(); ?></h2>
            
            <?php if ( has_post_thumbnail() ) : 
            
                $image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( get_the_ID() ), 'large');  
                $image_title = get_post( get_post_thumbnail_id() )->post_title; 
                
            ?>
            <a href="<?php echo $image_attributes[0]; ?>" title="<?php echo $image_title; ?>" rel="prettyphoto" class="post-teaser"><?php the_post_thumbnail( $post_teaser_type ); ?></a>
            <?php endif; ?>
            
            <div class="entry-content"><?php the_content(); ?></div>
            
            <?php stylico_social_menu( false ); ?>
                            
            <?php wp_link_pages(array('before' => '<div class="post-link-pages"><strong>Pages:</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
            
            <?php edit_post_link(__('Edit this entry.', 'stylico'), '<div>', '</div>'); ?>

            <?php comments_template(); ?>
            
        </article>
            
		<?php endwhile; endif; ?>
        
	</section>
    
    <?php if( !is_page_template('page-leftsidebar.php') && !is_page_template('page-fullwidth.php') ) get_sidebar(); ?>
    
<?php get_footer(); ?>