<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */
 /**
Template Name: Default with Sidebar
*/
get_header(); ?>
<div id="page-title" class="clearfix">
	<div class="container_12">
        <div class="grid_12">
          <h1><?php the_title();?></h1>
        </div>
	</div>
</div>
    <?php if (get_option('themeteam_origami_enable_breadcrumbs') == 'true'){ ?>
	<div id="breadcrumbs" class="clearfix">
		<div class="container_12">
	    	<div class="grid_12">
			<?php breadcrumbs(get_option('themeteam_origami_enable_breadcrumbs')); ?>
			</div>
		</div>
	</div>
	<?php } ?>
    <div id="container" class="clearfix">
    	<div class="container_12">
        	<div class="col2-right-layout clearfix">
          		<div class="clearfix">
            		<?php get_sidebar(); ?>
				
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php
						$themeteam_header_text = get_post_meta($post->ID, "themeteam_header_text", true); 
				    	$themeteam_video_embed = get_post_meta($post->ID, "themeteam_video_embed", true); 
				    	$themeteam_video_height = get_post_meta($post->ID, "themeteam_video_height", true); 
				    	$themeteam_video_width = get_post_meta($post->ID, "themeteam_video_width", true); 
				    	$video_width = $themeteam_video_width + 2;
				    	$video_height = $themeteam_video_height + 2;
			    	?>
	            		<div class="pageTemp">
					    	<?php if($themeteam_video_embed) { ?>
			
			          			<div class="imgframe grid_8" style="width:<?php echo $video_width; ?>;height:<?php echo $video_height; ?>;">
			          				<?php echo $themeteam_video_embed; ?><span class="frame"><span><span><span><span><span class="empty"><em class="play"> </em></span></span></span></span></span></span>
			          			</div>
			              	<?php } else if (has_post_thumbnail()) { ?>
			             		<div class="imgframe grid_8">
									<?php the_post_thumbnail('thumb620x270'); ?>
			             			 <span class="frame"><span><span><span><span><span class="empty"><em class="zoom"> </em></span></span></span></span></span></span>
			             		</div>
			              	<?php } ?>
			              	<div class="grid_8">
			              		<div class="clear"> </div>
			              		<article class="entry"><?php the_content(''); ?></article>
			              	</div>
				  			
				  			
						</div>
					<?php endwhile; endif; ?>
				</div>
      		</div>
      		<div class="clear"> </div>
    	</div>
    </div>
    <!-- div#container end -->

<?php get_footer(); ?>