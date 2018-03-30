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
            <li><a href="<?php echo get_option('home'); ?>/Testimonial">Testimonial</a></li>
            <li><?php the_title();?></li>
        </ul>
		</div>
	</div>
</div>
<?php } ?>
<div id="container" class="clearfix">
	<div class="container_12">
    	<div class="col1-layout clearfix">
    		<div class="grid_12">
				<div class="portfolio">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php 
						$custom = get_post_custom($post->ID);
						$full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' , false ); 
					?>
					
			            <?php if(has_post_thumbnail()){ ?>
			          	<div class="imgframe">
			          		<a href="<?php echo esc_attr($full[0]); ?>" rel="prettyPhoto">
			          			<?php the_post_thumbnail('thumb940'); ?><span class="frame"><span><span><span><span><span class="empty"><em> </em></span></span></span></span></span></span>
		          		</a>
			          	</div>
			          <?php } ?>
			          	<article class="entry">
			          		<?php the_content();?>
			          	</article>

				<?php endwhile; else: ?>
	
						<p class="gird_12">Sorry, but you are looking for something that isn't here. </p>	
	
	    			<?php endif; ?>
	    		</div>
	    	</div>
            <div class="clear"></div>
		</div>
	</div>
</div>
<?php get_footer(); ?>