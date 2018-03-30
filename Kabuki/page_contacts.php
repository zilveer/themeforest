<?php /* Template name: Contacts: right sidebar, GMap header */ ?> 

<?php get_header(); ?>

<?php 
if ( function_exists( 'get_option_tree')  ) {
if ( is_string(get_option_tree( 'gmaps' ) )) {
$maps = '<div id="header-image" class="container maps"><div class="maps-wrapper"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="';
$maps .= get_option_tree( 'gmaps' );
$maps .= '&amp;output=embed&amp;iwloc=near"></iframe></div></div><!--#header-image--><div class="clear"></div>'; 
echo $maps;
}

else {
print ('<div style="margin-top:14px"></div>');
}
}
?>

<?php 
if ( function_exists( 'get_option_tree')  ) {
$cform = get_option_tree( 'cform' );
}
?>

<div id="content">
	<div id="page-wrapper">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
			<article>
				<h1><?php the_title(); ?></h1>
				<div class="clearleft"></div>
				<?php if ( has_post_thumbnail() ) { /* loads the post's featured thumbnail, requires Wordpress 3.0+ */ echo '<div class="featured-thumbnail">'; the_post_thumbnail(); echo '</div>'; } ?>
				<div class="post-edit"><?php edit_post_link(); ?></div>
				<div class="post-content page-content">
					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
				<div class="clearboth"></div></div><!--.post-content .page-content -->
			</article>
			</div><!--#post-# .post-->
	<?php endwhile; ?>
</div><!--#page-wrapper-->
</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>