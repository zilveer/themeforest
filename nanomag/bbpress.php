<?php
/**
 * bbPress Forum Template 
 */
?>
<?php get_header(); ?>
<?php $GLOBALS['sbg_sidebar'] = get_post_meta(get_the_ID(), 'sbg_selected_sidebar_replacement', true);  ?>

<section id="content_main" class="clearfix">
<div class="row main_content">

<div class="content_wraper three_columns_container">

   <!-- Start content -->
    <div class="eight columns content_display_col1 page_with_sidebar" id="content">
 <div <?php post_class('widget_container content_page'); ?>> 
 	<?php echo jelly_breadcrumbs_options(); ?>
          
          
		<?php if ( ! have_posts() ) : ?>
		<div id="post-0" class="post not-found post-listing">
			<h1 class="post-title"><?php _e( 'Not Found', 'nanomag' ); ?></h1>
			<div class="entry">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'nanomag' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class('post-listing'); ?>>
			<div class="post-inner">
				 <h1 class="single-post-title page-title"><?php the_title(); ?></h1>
				<div class="entry">
					<?php the_content(); ?>
				</div><!-- .entry /-->
			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php endwhile;?>
           
<div class="brack_space"></div>
        </div>

  </div>
  <!-- End content -->
   
    <!-- Start sidebar -->
	<div class="four columns" id="sidebar"> 

                <?php if (is_active_sidebar('bbpress-sidebar')){ dynamic_sidebar('bbpress-sidebar'); }?>
  </div>
  <!-- End sidebar -->

          

</div>
</div>
 </section>
<!-- end content --> 

<?php get_footer(); ?>


