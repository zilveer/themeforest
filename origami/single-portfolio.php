<?php
/**
 * @package WordPress
 * @subpackage Grounded_Theme
 */

get_header();?>
<div id="page-title" class="clearfix">
	<div class="container_12">
    	<div class="grid_12">
      		<h1><?php the_title(); ?></h1>
    	</div>
  	</div>
</div>
<?php if (get_option('themeteam_origami_enable_breadcrumbs') == 'true'){ ?>
<div id="breadcrumbs" class="clearfix">
	<div class="container_12">
    	<div class="grid_12">
		<ul>
            <li><a href="<?php echo get_option('home'); ?>/">Home</a></li>
            <li><?php the_title();?></li>
        </ul>
		</div>
	</div>
</div>
<?php } ?>
<div id="container" class="clearfix">
	<div class="container_12">
    	<div class="col1-layout">
				<div class="pageTemp">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php 
						$custom = get_post_custom($post->ID);
						$year_completed = get_post_meta($post->ID, "year_completed", true); 
						$website_url = get_post_meta($post->ID, "website_url", true); 
						$themeteam_video_embed = get_post_meta($post->ID, "themeteam_video_embed", true);
						$full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' , false ); 
					?>
					
			            <?php if($themeteam_video_embed) { ?>
			          	<div class="imgframe">
			          		<a href="<?php echo $themeteam_video_embed; ?>" rel="prettyPhoto">
			          			<?php the_post_thumbnail('thumb940'); ?><span class="frame"><span><span><span><span><span class="empty"><em class="play"> </em></span></span></span></span></span></span></a>
			          	</div>
			          	<div class="clear"> </div>
			          <?php }else if(has_post_thumbnail()){ ?>
			          	<div class="imgframe">
			          		<a href="<?php echo esc_attr($full[0]); ?>" rel="prettyPhoto">
			          			<?php the_post_thumbnail('thumb940'); ?><span class="frame"><span><span><span><span><span class="empty"><em class="zoom"> </em></span></span></span></span></span></span>
		          		</a>
			          	</div>
			          	<div class="clear"> </div>
			          <?php } ?>
			          	<div class="entry">
			          		<?php the_content();?>
			          	</div>

				<?php endwhile; else: ?>
	
						<p class="gird_12">Sorry, but you are looking for something that isn't here. </p>	
	
	    			<?php endif; ?>
	    		</div>
            <div class="clear"></div>
		</div>
	</div>
</div>
<?php get_footer(); ?>