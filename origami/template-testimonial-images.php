<?php
/**
 * @package WordPress
 * @subpackage Grounded_Theme
 */
/**
Template Name: Testimonial Images
*/
?>
<?php get_header(); ?>
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
		<?php breadcrumbs(get_option('themeteam_origami_enable_breadcrumbs')); ?>
		</div>
	</div>
</div>
<?php } ?>

<div id="container" class="clearfix">
	<div class="container_12">
    	<div class="col1-layout">
			<?php $page = get_query_var('paged'); $args = array('post_type' => 'testimonial','paged'=> $page, 'posts_per_page'=> get_option('posts_per_page'), 'caller_get_posts' => 1 ); query_posts($args);?>
				<?php if (have_posts()): while (have_posts()): the_post() ?>
		        	<?php
		        		$custom = get_post_custom($post->ID);
		        		$testimonial_name = $custom["testimonial_name"][0];
		        		$testimonial_url = $custom["testimonial_url"][0];
						$testimonial_header = $custom["testimonial_header"][0];
						$testimonial_excerpt = $custom["testimonial_excerpt"][0];
		        	?>
		        
		        	
		        <div class="grid_4">
		        	<div class="testimonial">
		          	<?php if (has_post_thumbnail()): ?>
		                <div class="imgframe"><?php the_post_thumbnail('thumb300x165'); ?><span class="frame"><span><span><span><span><span class="empty"> </span></span></span></span></span></span></div>
		          	<?php endif ?>
		          		<article class="entry <?php echo $GLOBALS['button_css'];?>">
		          			<h3><?php echo $testimonial_header; ?></h3>
		            		<p><?php the_content();?></p>
		            		<p class="a-right"> <strong>&mdash; <?php echo $testimonial_name; ?></strong></p>
		            		<?php if($testimonial_url) : ?>
		            		<p class="a-right">&mdash;<?php echo $testimonial_url; ?></p>
		            		<?php endif ?>
		            	</article>
		          	</div>
		        </div>              
		        <?php if(++$i%3==0) echo "<div class='clear'></div>";?>
				<?php endwhile ?>
				<div class="clear"> </div>
				<div class="wp-pagenav grid_12">
					<span class="left"><?php next_posts_link('Older Posts') ?></span>
		            <span class="right"><?php previous_posts_link('Newer Posts') ?></span>
		        </div>
				<?php else: ?>
				   <p class="gird_12">Sorry, but you are looking for something that isn't here. </p>
				   <div class="clear"> </div>		
				<?php endif ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>