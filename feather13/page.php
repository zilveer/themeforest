<?php get_header(); ?>

<?php while(have_posts()): the_post(); ?>
<div class="container fix no-sidebar">
			
	<div id="page-title">
		<h1><?php echo wpb_page_title(); ?></h1>
	</div><!--/page-title-->
	
	<div id="content-part">
		<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
			<?php get_template_part('_page-image'); ?>
			<div class="pad">
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			</div>
		</article>

		<?php comments_template(); ?>
	</div><!--/content-part-->

</div><!--/container-->
<?php endwhile; ?>

<?php get_footer(); ?>