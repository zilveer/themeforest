<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
  <section class="full_width container">

    <div class="page_content">

    	<?php if(has_post_format("video")) { ?>
    		<div class="video_player">
    		<?php 
    			if(get_post_meta(get_the_ID(), "video_url", true) != "") {
            global $wp_embed;
            echo $wp_embed->run_shortcode("[embed]". get_post_meta(get_the_ID(), "video_url", true) ."[/embed]");
    			} else {
    				echo get_post_meta(get_the_ID(), "video_embed", true);
    			}
    		?>
    		</div>
    	<?php } ?>

    	<?php if(has_post_format("audio")) { ?>
    		<div class="audio_player">
    		<?php 
    			if(get_post_meta(get_the_ID(), "audio_url", true) != "") {
    				global $wp_embed;
    				echo $wp_embed->run_shortcode("[embed]". get_post_meta(get_the_ID(), "audio_url", true) ."[/embed]");
    			} else {
    				echo get_post_meta(get_the_ID(), "audio_embed", true);
    			}
    		?>
    		</div>
    	<?php } ?>

    	<?php if(has_post_format("image")) { ?>
    		<div class="single_image">
    		  <?php the_post_thumbnail('large'); ?> 
    		</div>
    	<?php } ?>

    	<?php if(has_post_format("gallery")) { ?>
    		<div class="multi_image">

	    		<div class="flexslider" data-effect="<?php echo T2T_Toolkit::get_post_meta(get_the_ID(), "effect", true, "fade"); ?>" data-autoplay="<?php echo T2T_Toolkit::get_post_meta(get_the_ID(), "autoplay", true, "true"); ?>" data-interval="<?php echo T2T_Toolkit::get_post_meta(get_the_ID(), "interval", true, "5"); ?>">
		    		<ul class="slides">
			    		<?php
			    			// initialize options to send to t2t_get_gallery_images
			    			$options = array(
			    			  "posts_to_show"  => -1,
			    			  "posts_per_row"  => -1
			    			);
			    			
			    			// gather the images
			    			$images = T2T_Toolkit::get_gallery_images(get_the_ID(), $options);

			    			foreach($images as $index => $image_id) {
			    			  $image = wp_get_attachment_image($image_id, "full");

			    			  echo "<li>$image</li>";

			    			}
			    		?>
		    		</ul>
	    		</div>

    		</div>
    	<?php } ?>

    	<h3><?php the_title(); ?></h3>

      <?php the_content(); ?>
    </div>

  </section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>