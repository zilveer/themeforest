<?php
/*
Template Name: Sitemap
*/
?>
<?php get_header(); ?>
<?php if ( is_front_page() ) { ?>
	<h2 class="entry-title"><?php the_title(); ?></h2>
<?php } else { ?>
	<h1 class="entry-title"><?php the_title(); ?></h1>
<?php } ?>	
<div class="page-contents-wrap float-left two-column">

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

					<div class="entry-content clearfix">
					
						<?php
						// Custom Post Type List
						foreach( get_post_types( array('public' => true) ) as $post_type ) {
						  if ( in_array( $post_type, array('post','page','attachment') ) )
						    continue;
						
						  $pt = get_post_type_object( $post_type );
						
						  echo '<h2>'.$pt->labels->name.'</h2>';
						  echo '<hr/>';
						  echo '<ul>';
						
						  query_posts('post_type='.$post_type.'&posts_per_page=-1');
						  while( have_posts() ) {
						    the_post();
						    echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
						  }
						
						  echo '</ul>';
						}
						?>

						<h2 id="authors"><?php _e('Authors','mthemelocal'); ?></h2>
						<hr/>
						<ul>
						<?php
						wp_list_authors(
						  array(
						    'exclude_admin' => false,
						  )
						);
						?>
						</ul>
						
						<h2 id="pages"><?php _e('Pages','mthemelocal'); ?></h2>
						<hr/>
						<ul>
						<?php
						// Add pages you'd like to exclude in the exclude here
						wp_list_pages(
						  array(
						    'exclude' => '',
						    'title_li' => '',
						  )
						);
						?>
						</ul>

<h2 id="pages"><?php _e('Posts','mthemelocal'); ?></h2>
<hr/>
<ul>
<?php
// Add categories you'd like to exclude in the exclude here
$cats = get_categories('exclude=');
foreach ($cats as $cat) {
  echo "<li class='list-sub-heading'><h4>".$cat->cat_name."</h4>";
  echo "<ul>";
  query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
  while(have_posts()) {
    the_post();
    $category = get_the_category();
    // Only display a post link once, even if it's in multiple categories
    if ($category[0]->cat_ID == $cat->cat_ID) {
      echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
    }
  }
  echo "</ul>";
  echo "</li>";
}
?>
</ul>
					</div>
					<?php edit_post_link( __('edit this entry','mthemelocal') ,'<p class="edit-entry">','</p>'); ?>	
			

		</div><!-- #post-## -->


</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>