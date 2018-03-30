<?php 
get_header(); 

//VAR SETUP
$category = get_option('themolitor_slider_category');
?>

<div class="listing">
	<?php 
	query_posts('cat=-'. $category .'&paged='.$paged); 
	if (have_posts()) : while (have_posts()) : the_post(); 
	?>
	
		<div <?php post_class(); ?>>
		
		<?php if ( has_post_thumbnail() ) { ?> 
		<a class="thumbLink" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
		<?php } ?>
		
		<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		
		<?php
		get_template_part('meta');
		the_excerpt(); 
		?>
		
		<a class="button continue" href="<?php the_permalink() ?>"><?php _e('Continue Reading','themolitor');?></a>

        <div class="clear"></div>
		</div><!--end post-->

		<?php 
		endwhile;
		get_template_part('navigation');
		else : 
		?>
		
		<h2 class="center"><?php _e('Not Found','themolitor');?></h2>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.",'themolitor');?></p>
	<?php endif; ?>
	
	</div><!--end listing-->

<?php get_footer(); ?>