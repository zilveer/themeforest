 <?php
/******************/
/**  Single Post
/******************/
get_header();
$webnus_options = webnus_options();
$webnus_options['webnus_blog_singlepost_sidebar'] = isset( $webnus_options['webnus_blog_singlepost_sidebar'] ) ? $webnus_options['webnus_blog_singlepost_sidebar'] : '';
?>
 <section class="container page-content" >
    <hr class="vertical-space">
	<?php if($webnus_options['webnus_blog_singlepost_sidebar'] == 'left' ){ ?>
		<aside class="col-md-3 sidebar leftside">
			<?php dynamic_sidebar( 'Left Sidebar' ); ?>
		</aside>
	<?php } ?>
	<section class="col-md-8 omega">
      <article class="blog-single-post">
		<?php			
			
		$post_format = get_post_format(get_the_ID());
	
		$content = get_the_content();
			
	

		  if( have_posts() ): while( have_posts() ): the_post(); ?>
        <div <?php post_class('post'); ?>>

          <h1><?php the_title() ?></h1>
		
			<?php
			
			if( wp_attachment_is_image(get_the_ID() ))
			{
				
				$att_image = wp_get_attachment_image_src( $post->id, "full");
				if(is_array($att_image))
					echo '<img src="'. $att_image[0] .'" />';
			}
			
			 ?>
		 


        </div>
		<?php 
		 endwhile;
		 endif;
		  ?>
		
      </article>
      <?php comments_template(); ?>
    </section>
    <!-- end-main-conten -->
	<?php if($webnus_options['webnus_blog_singlepost_sidebar'] == 'right' ){ ?>
		<aside class="col-md-3 sidebar">
			<?php dynamic_sidebar( 'Right Sidebar' ); ?>
		</aside>
	<?php } ?>
    <!-- end-sidebar-->
    <div class="vertical-space3"></div>
  </section>
  <?php 
  get_footer();
  ?>