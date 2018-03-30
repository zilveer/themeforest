<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Start Blog -->
<section id="blog" class="<?php echo get_post_meta(get_option('page_for_posts', true), 'layout', true); ?> container">

  <div class="page_content">
	  <!-- Start Post -->
  	<article>

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
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <span class="date"><?php the_time('F j, Y'); ?></span>              
        </div>

    		<div class="content">
    			<?php the_content(); ?>
    		</div>

        <?php 
          wp_link_pages(array(
            "before" => "<div class=\"post_pagination\">",
            "after"  => "</div>",
            "link_before" => "<span>",
            "link_after" => "</span>"
          )); 
        ?>
    		
    		<div class="meta">
    			<span class="author">
    				<a href="<?php the_author_link(); ?> ">
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

  	<!-- Start Comments -->
  	<div id="comments">
  		<?php comments_template(); ?>
  	</div>
  	<!-- End Comments -->
  </div>
	
  <?php if(get_post_meta(get_option('page_for_posts', true), 'layout', true) != "full_width" && get_post_meta(get_option('page_for_posts', true), 'layout', true) != "") { ?>
     <?php get_sidebar('blog'); ?>
  <?php } ?>

</section>
<!-- End Blog -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>