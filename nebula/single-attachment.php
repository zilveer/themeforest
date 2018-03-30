<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header(); 

?>
<br class="clear"/><br/><br/>

<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">
					
<?php

global $more; $more = false; # some wordpress wtf logic

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
	$image_id = $post->ID;
								
	$image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
?>
						
<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper full">
	
		<?php
	    	if(!empty($image_thumb))
	    	{
	    ?>
	    
	    <div class="post_img">
	    	<img src="<?php echo $image_thumb[0]; ?>" alt="" class="" style="width:<?php echo $image_thumb[1]; ?>px;height:<?php echo $image_thumb[2]; ?>px;"/>
	    </div>
	    
	    <?php
	    	}
	    ?>
	    
	    <div class="post_header full">
	    	<div class="gallery_a_title">
	    		<h5><?php the_title(); ?></h5><span class="caption"><?php the_content(); ?></span>	
	    	</div>
	    </div>
	    
	    <div class="post_excerpt_full">
		    <?php
				//Get Social Share
				get_template_part("/templates/template-share");
			?>
	    </div>
	    
	</div>

</div>
<!-- End each blog post -->

<div class="fullwidth_comment_wrapper">
	<?php comments_template( '' ); ?>
</div>

<?php wp_link_pages(); ?>

<?php endwhile; endif; ?>
    	
    	</div>
    
    </div>
    <!-- End main content -->
   
</div> 
<br class="clear"/>
<?php get_footer(); ?>