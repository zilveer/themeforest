<?php
/**
 * @package WordPress
 * @subpackage Grounded_Theme
 */
/**
Template Name: Portfolio 4 Column
*/
?>
<?php get_header(); ?>
<div id="page-title" class="clearfix">
	<div class="container_12">
    	<div class="grid_12">
      		<h1>Portfolio</h1>
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
        	<div id="filter" class="grid_12">
				<ul class="skills">
              		<?php terms(get_query_var('skills')); ?>
            	</ul>
            </div>
            <ul id="portfolio_list">  
            <!-- start the loop to get portfolio items -->
            <?php $page = get_query_var('paged'); $args = array('post_type' => 'portfolio','skills'=>get_query_var('skills'),'paged'=> $page, 'posts_per_page'=> get_option('posts_per_page'), 'caller_get_posts' => 1 ); query_posts($args);?>
			<?php if (have_posts()): while (have_posts()): the_post() ?>
				<?php 
					$custom = get_post_custom($post->ID);
					$skills = get_the_terms( $post->ID, 'skills');
					foreach( $skills as $term ) {
						$skills_as_text .= $term->slug;
						$skills_as_text .= ' ';
					}
					$year_completed = get_post_meta($post->ID, "year_completed", true); 
					$website_url = get_post_meta($post->ID, "website_url", true); 
					$themeteam_video_embed = get_post_meta($post->ID, "themeteam_video_embed", true);
					$full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' , false ); 
				?>
				<li class="grid_3 <?php echo $skills_as_text; ?>">
				<?php $skills_as_text = ''; ?>
            		<div class="portfolio">
            		<?php if($themeteam_video_embed) { ?>
						<div class="imgframe">
							<a href="<?php echo $themeteam_video_embed; ?>" rel="prettyPhoto">
          						<?php the_post_thumbnail('thumb220x130'); ?><span class="frame"><span><span><span><span><span class="empty"><em class="play"> </em></span></span></span></span></span></span></a>
          				</div>
          			<?php }else if(has_post_thumbnail()){ ?>
          				<div class="imgframe">
          					<a href="<?php echo esc_attr($full[0]); ?>" rel="prettyPhoto">
          						<?php the_post_thumbnail('thumb220x130'); ?><span class="frame"><span><span><span><span><span class="empty"><em class="zoom"> </em></span></span></span></span></span></span></a>
          				</div>
          			<?php } ?>
          				<article class="entry">
          					<h2><a href="<?php the_permalink();?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></h2>
          					<?php the_excerpt();?>
          					<p><a href="<?php the_permalink() ?>" class="button small <?php echo $GLOBALS['button_css'];?>"><span><span>READ MORE</span></span></a></p>
          				</article>
          			</div>
          		</li>
          	<?php endwhile ?>
         	</ul>
             <div class="pagenavi"> 
                <?php next_posts_link('&larr; Older Posts') ?>
                <?php previous_posts_link('Newer Posts &rarr;') ?>               
              </div>
			<?php else: ?>
				<p class="gird_12">Sorry, but you are looking for something that isn't here. </p>		
			<?php endif ?>

		</div>
        <div class="clear"> </div>
	</div>
</div>
<?php get_footer(); ?>