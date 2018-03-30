<?php
global $heading,$emptyContent,$content_width;
?>

	<?php
	$content = get_the_content();
	$emptyContent = (empty($content)) ? "true" : "false";
 	?> 

<div class="box one box-shadow">
	<?php if($heading):?>
	
		<!-- page title -->
		<div class="head_text <?php if($emptyContent=="true") echo "nomargin"; ?>">
			<div class="arrow"></div><!-- arrow -->
			<h2><?php the_title(); ?></h2>
		</div>
		<!-- /page title -->
			
	<?php endif;?> 



	<?php  
	#
	#  featured image	   
	#
	$thumb 				= get_post_thumbnail_id();
	$image_url 			= wp_get_attachment_image_src($thumb,'false', true);
	$width 				= 300;
	$height 			= 300;
	if($thumb) $image 	= @vt_resize( $thumb, '', $width, $height, 'false' );
	?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
						
		<?php if($thumb)://featured image ?>
			<span class="frame alignleft"><a href="<?php echo $image_url[0]; ?>" title="<?php the_title(); ?>" data-gal="prettyPhoto[page_featured_image]" class="imgeffect magnifier">
				<img src="<?php echo $image["url"];?>" alt="<?php the_title(); ?>" />
			</a></span>
		<?php endif;?>
						
		<?php  echo apply_filters('the_content',$content);?> 

		<?php wp_link_pages(); ?>
	<?php endwhile;?>

			<?php if(comments_open() && get_option(THEMESLUG."_allow_page_comments")):?>
				<div class='entry commententry'>
					<div class="line"><span class="top">[<?php _e( 'top', 'rt_theme'); ?>]</span></div><!-- line -->
				    <?php comments_template(); ?>
				</div>
			<?php endif;?>
	
	<?php else: ?>
		<p><?php _e( 'Sorry, no page found.', 'rt_theme'); ?></p>
	<?php endif; ?>
</div>
