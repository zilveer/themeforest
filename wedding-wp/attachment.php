 <?php
/******************/
/**  Single Post
/******************/

get_header();
 ?>
 <section class="container page-content" >
    <hr class="vertical-space">
    <?php 
	if( 'left' == $webnus_options->webnus_blog_singlepost_sidebar() ): 
		get_sidebar('bleft');
	endif;
	?>
	<section class="col-md-8 omega">
      <article class="blog-single-post">
		<?php
			GLOBAL $webnus_options;
			
			
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
    <?php 
	if( 'right' == $webnus_options->webnus_blog_singlepost_sidebar() ): 
		get_sidebar('bright');
	endif;
	?>
    <!-- end-sidebar-->
    <div class="vertical-space3"></div>
  </section>
  <?php 
  get_footer();
  ?>