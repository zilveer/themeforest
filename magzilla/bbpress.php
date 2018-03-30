<?php 
/**
 * bbPress Forum Template 
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/ 
?>

<?php get_header(); ?>
<?php 
if ( have_posts() ) :
  while ( have_posts() ) : the_post(); 
?>

<div class="<?php echo $fave_container; ?>">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="page-header">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>		
		</div><!-- col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
	</div><!-- row -->

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<main class="site-main" role="main">
				<div class="entry-content">
					
					<?php the_content(); ?>
					
				</div><!-- entry-content -->
			</main><!-- site-main -->
		</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->


		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<aside class="sidebar">
				<?php dynamic_sidebar("bbpress-sidebar"); ?>
			</aside><!-- .sidebar -->	
		</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
		

	</div><!-- .row -->

</div>


<?php
endwhile;
endif;?>	
<?php get_footer(); ?>