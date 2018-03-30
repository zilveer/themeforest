<?php
/**
* The template for displaying Search Results pages.
*
*/
?>

<?php if(!empty($_GET['ajax']) ? $_GET['ajax'] : null) { // Is Live Search ?>

<?php if ( have_posts() ) { ?>

<ul id="search-result">
	<?php while (have_posts()) : the_post(); ?>
    
		<li class="sr-<?php echo get_post_type( $post->ID ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        
	<?php endwhile; ?>
</ul>

<?php } else { ?>

<ul id="search-result">
  <li class="nothing-here"><?php _e( "Sorry, no posts were found.", "framework" ); ?></li>
</ul>

<?php } ?>

<?php } else { // Is Normal Search ?>

<?php get_header(); ?>


<?php if(get_post_type() == 'st_kb') { ?>

<?php get_template_part( 'page-header', 'kb' ); 	?>

<?php } else {  ?>
<!-- #page-header -->
<div id="page-header" class="clearfix">
<div class="ht-container">
<h1><?php printf( __( 'Results for: %s', 'framework' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
</div>
</div>
<!-- /#page-header -->

<!-- #breadcrumbs -->
<div id="page-subnav" class="clearfix">
<div class="ht-container">
<?php st_breadcrumb(); ?>
</div>
</div>
<!-- /#breadcrumbs -->

<?php } ?>

<!-- #primary -->
<div id="primary" class="sidebar-right clearfix"> 
<div class="ht-container">
<!-- #content -->
  <section id="content" role="main">
  

<?php if ( have_posts() ) { ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

	<?php 
 
	if( get_post_type() == 'st_kb' ) {
		
	get_template_part( 'content-kb', get_post_format() );

	} else {

	get_template_part( 'content', get_post_format() );
	
	}
	
	 ?>
         			
	<?php endwhile;  ?>

	<?php st_content_nav( 'nav-below' );?>

<?php } else { ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php } ?>
    
</section>
<!-- /#content -->


<?php if(get_post_type() == 'st_kb') {  
get_sidebar('kb');  
} else {   
get_sidebar();  
} ?>

</div>
</div>
<!-- /#primary -->

<?php get_footer(); ?>

<?php } ?>