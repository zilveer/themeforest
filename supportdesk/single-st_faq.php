<?php get_header(); ?>

<!-- #page-header -->
<div id="page-header" class="clearfix">
<div class="ht-container">
<h1><?php the_title(); ?></h1>
<?php if (get_post_meta( $post->ID, '_st_faq_tagline', true )) { ?>
<p><?php echo get_post_meta( $post->ID, '_st_faq_tagline', true ); ?></p>
<?php } ?>
</div>
</div>
<!-- /#page-header -->

<?php if (!get_post_meta( $post->ID, '_st_faq_breadcrumbs', true )) { ?>
<!-- #breadcrumbs -->
<div id="page-subnav" class="clearfix">
<div class="ht-container">
<?php st_breadcrumb(); ?>
</div>
</div>
<!-- /#breadcrumbs -->
<?php } ?>

<!-- #primary -->
<div id="primary" class="sidebar-off clearfix"> 
<div class="ht-container">
  <!-- #content -->
  <section id="content" role="main">
  
<?php while ( have_posts() ) : the_post(); ?>
<div class="entry-content clearfix">
<?php the_content(); ?>
</div>
<?php endwhile; // end of the loop. ?>
   
   
 <?php 
 $postid = get_the_ID();
 $args = array(
	'sort_order' => 'ASC',
	'sort_column' => 'menu_order',
	'post_type' => 'st_faq',
	'parent' 		=> $postid,
	'child_of' 		=> $postid,
	'post_status' => 'publish'
); 
$pages = get_pages($args); 

   foreach( $pages as $page ) {		
		$content = $page->post_content;
		$content = apply_filters( 'the_content', $content );
	?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		<h2 class="entry-title"><a name="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?><div class="action"><span class="plus">+</span><span class="minus">-</span></div></a></h2>
		<div class="entry-content"><?php echo $content; ?></div>
        </article>
        
<?php } ?> 
  
   
  </section>
  <!-- #content -->
  

</div>
</div>
<!-- /#primary -->
<?php get_footer(); ?>
