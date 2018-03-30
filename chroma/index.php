
<?php get_header(); ?>

<!-- Start Blog -->
<?php if(class_exists("T2T_Toolkit")) { ?>
<section id="blog" class="<?php echo (is_front_page() ? "sidebar_right" : get_post_meta(get_queried_object_id(), 'layout', true)); ?> container">
<?php } else { ?>
<section id="blog" class="<?php if(is_active_sidebar('blog-sidebar')) { echo "sidebar_right"; } ?> container">
<?php } ?>
	
	<div class="page_content">
	    
      <?php while (have_posts()) : the_post(); ?>
    
    	<!-- Start Post -->
    	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
    		<?php 
        $show_featured_image = get_post_meta(get_the_ID(), 'show_featured_image', true);

        if(!isset($show_featured_image) || $show_featured_image == "") {
          $show_featured_image = true;
        }
        else {
          $show_featured_image = filter_var($show_featured_image, FILTER_VALIDATE_BOOLEAN);
        }

    		if(has_post_thumbnail() && $show_featured_image) {
    		    $image = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
    		    $alt_text = get_post_meta(get_post_thumbnail_id() , '_wp_attachment_image_alt', true);
    		?>
    		<div class="image">
    			<img src="<?php echo $image[0]; ?>" alt="<?php echo $alt_text; ?>" />
    		</div>
    		<?php } ?>

          <div class="post_wrap">
              <div class="heading">
                <h3><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <span class="date"><?php the_time('F j, Y'); ?></span>                          
            </div>
        
            <div class="content">
                <?php the_content(); ?>
            </div>
        
            <div class="meta">
              <span class="author">
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                    <span class="typicons-pencil"></span>
                    <?php the_author(); ?> 
                </a>
              </span>
              <span class="comments">
                <a href="<?php comments_link(); ?>">
                    <span class="typicons-messages"></span>
                    <?php comments_number(); ?>
                </a>
              </span>
              <?php if(has_tag()) { ?>
              <span class="tags">
                <span class="typicons-tags"></span>
                <?php the_tags(""); ?>
              </span>
              <?php } ?>
            </div>
          </div>

    	</article>
    	<!-- End Post -->
	
    	<?php endwhile; ?>
		
    	<div class="pagination">
      <?php previous_posts_link('&larr; Previous') ?>
      <?php next_posts_link('Next &rarr;') ?>
    	</div>

  </div>
	
  <?php if(class_exists("T2T_Toolkit")) { ?>
    <?php if((is_front_page() && get_post_meta(get_queried_object_id(), 'layout', true) != "full_width") || get_post_meta(get_queried_object_id(), 'layout', true) == "sidebar_right" || get_post_meta(get_queried_object_id(), 'layout', true) == "sidebar_left") { ?>
     <?php get_sidebar('blog'); ?>
    <?php } ?>
  <?php } else { ?>
    <?php get_sidebar('blog'); ?>
  <?php } ?>
	
</section>

<?php get_footer(); ?>