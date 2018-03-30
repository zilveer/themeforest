<?php
/**
 * @package WordPress
 * @subpackage 3D
 * @since Idea 3D
 * Graphic Desing : Ilkay ALPGIRAY
 * Code : Mustafa TANRIVERDI
 */
?>
<?php get_header(); ?>
  
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<!-- Tab Menu Slide -->
    <div class="tabmenu-back-two"></div>
    <div class="grid_24 bigtitle">
    	<h1 class="tabmenu-bigtitle-two"><strong><?php the_title(); ?></strong></h1>
    </div>
    
    <div class="clear"></div>
	<?php if(get_post_meta(get_the_id(), 'im_theme_full_normal_page', true) == 'NORMAL') { ?>
		<?php if(get_option('im_theme_sidebar_category_lr', true) == 'LEFT')
        {
            echo '<div class="grid_6">';
                get_sidebar(); 
            echo '</div><!-- /.grid16 -->';
            
            echo '<div class="grid_16 prefix_1 bloglist-main">'; 
        } 
        else 
        {
            echo '<div class="grid_16 suffix_1 bloglist-main-two">';
        } 
        ?>
	<?php } else { ?>
    	<div class="grid_24">
    <?php } ?>
     	
        <!-- Blog List #1 -->
        <div class="blogsingle">
            <?php if(wp_get_attachment_url( get_post_thumbnail_id(get_the_id()))) { ?>
            <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); ?>" class="fancypicture" title="<?php the_title(); ?>">
            	<?php the_post_thumbnail('single-thumb', array('class' => 'bloglist-big')); ?> 
            </a>
            <?php } ?>
				<?php the_content(); ?>
                
               
		</div>
    <div class="clear"></div>




<?php endwhile; ?> 

<?php if ( comments_open() ) :?>
	<?php comments_template( '', true ); ?>
<?php endif; ?>

<div class="requ">posts_nav_link(); paginate_comments_links();</div>

</div><!-- Blog Post List .grid_18 -->
    
	
    <?php if(get_option('im_theme_sidebar_category_lr', true) == 'RIGHT')
	{
		echo '<div class="grid_6 sidebar-floatright">';
			get_sidebar(); 
		echo '</div><!-- /.grid16 prefix_1 -->';
	}
	?>
	
    <div class="clear"></div> 
    
    
<?php get_footer(); ?>
