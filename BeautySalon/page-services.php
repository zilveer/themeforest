<?php 
/* 
Template Name: Service Page 
*/ 
?>


<?php get_header(); ?>


<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <article class="uk-article services-page">     
		
		<div class="uk-article-title-wrapper">
			<h1 class="uk-article-title"><?php the_title(); ?></h1>
		</div>

        <?php the_content(''); ?>

        <?php edit_post_link(__('Edit this post.', 'warp'), '<p><i class="uk-icon-pencil"></i> ','</p>'); ?>

    </article>

    <?php endwhile; ?>
<?php endif; ?>

 <?php get_footer(); ?>