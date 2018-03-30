<?php 

get_header();

$page_title = get_post_meta(get_the_ID(), 'si_page_title', true);
$page_icon = get_post_meta(get_the_ID(), 'si_page_icon', true);

?>

<div id="<?php the_ID(); ?>" class="inner">

<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
	
	<?php if ($page_title != "yes") : ?>
	
		<h1 id="page_title">
		
			<?php if ($page_icon != "") : ?><i class="page_icon <?php echo $page_icon; ?>"></i><?php endif; ?>
			
			<?php the_title(); ?>
		
		</h1>
	
	<?php endif; ?>
	
	<?php the_content(); ?>

<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>