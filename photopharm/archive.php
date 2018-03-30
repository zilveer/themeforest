<?php get_header(); ?>

<div id="contentBox" class="boxStuff<?php if(!is_front_page()){?> activeBox<?php }?>">

	<div class="listing">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div <?php post_class(); ?>>
		<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<p class="metaStuff"><?php echo get_the_date(); ?>&nbsp; / &nbsp; <?php _e('By','themolitor');?> <?php the_author();?>&nbsp; / &nbsp; <?php comments_number(__('No Comments','themolitor'), __('1 Comment','themolitor'), __('% Comments','themolitor') ); ?><?php edit_post_link('Edit Post','&nbsp; / &nbsp;',''); ?></p>
		
		<a class="thumbLink" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail('gallery'); ?>
		</a>

		<?php the_excerpt(); ?>
		<a class="readMore" href="<?php the_permalink() ?>"><?php _e('Read More','themolitor');?> &rarr;</a>
		
        <div class="clear"></div>
		</div><!--end post-->

		<?php endwhile; ?>
		
		<div class="navigation">
			<div id="nextpage" class="pagenav alignright"><?php next_posts_link(__('Next &rarr;','themolitor')) ?></div>
			<div id="backpage" class="pagenav alignleft"><?php previous_posts_link(__('&larr; Prev','themolitor')) ?></div>
		</div><!--end navigation-->

	<?php else : ?>
		<h2><?php _e('Not Found','themolitor');?></h2>
		<p><?php _e("Sorry, but you are looking for something that isn't here.",'themolitor');?></p>
	<?php endif; ?>
		
	</div><!--end listing-->
	
</div><!--end contentBox-->

<?php 
get_sidebar();
get_footer(); 
?>