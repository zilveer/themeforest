<?php 
/* 
Template Name: Home Page
*/ 
?>

<?php get_header(); ?>


<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <article class="uk-article">
    	
        <?php the_content(''); ?>

        <?php edit_post_link(__('Edit this post.', 'warp'), '<p><i class="uk-icon-pencil"></i> ','</p>'); ?>

    </article>

    <?php endwhile; ?>
<?php endif; ?>

<?php comments_template(); ?>


 <?php get_footer(); ?>