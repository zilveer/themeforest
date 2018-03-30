<?php get_header(); ?>

<?php 
// Get position and location of sidebar
$st_kb_sidebar_location = of_get_option('st_kb_sidebar_location');

if (($st_kb_sidebar_location['index'] == '1') && (is_active_sidebar( 'st_sidebar_kb' ))) {
	$st_kb_sidebar_position = of_get_option('st_kb_sidebar');
} else {
	$st_kb_sidebar_position = 'off';
}
?>

<?php get_template_part( 'page-header', 'kb' ); 	?>

<!-- #primary -->
<div id="primary" class="sidebar-<?php echo $st_kb_sidebar_position; ?> clearfix"> 
<div class="ht-container">
  <!-- #content -->
  <section id="content" role="main">

<?php
//list terms in a given taxonomy
$args = array(
    'hide_empty'    => 1,
	'child_of' 		=> 0,
	'pad_counts' 	=> 1,
	'hierarchical'	=> 1
); 
$tax_terms = get_terms('st_kb_category', $args);
$tax_terms = wp_list_filter($tax_terms,array('parent'=>0));
?>

<div class="kb-category-list row stacked">

<?php foreach ($tax_terms as $tax_term) {

echo '<div class="column col-half">';

echo '<h3><span class="count">'. sprintf( __("%s Articles", "framework"), $tax_term->count) .'</span><a href="' . esc_attr(get_term_link($tax_term, 'st_kb_category')) . '" title="' . sprintf( __( 'View all posts in %s', 'framework' ), $tax_term->name ) . '" ' . '>' . $tax_term->name.' <span>&rarr;</span></a></h3>';

// Get posts per category
$args = array( 
	'numberposts' => of_get_option('st_kb_category_articles'), 
	'post_type'  => 'st_kb',
	'orderby' => 'date',
	'suppress_filters' => true,	
	'tax_query' => array(
		array(
			'taxonomy' => 'st_kb_category',
			'field' => 'term_id',
			'include_children' => true,
			'terms' => $tax_term->term_id
		)
	)
);



$st_cat_posts = get_posts( $args );
echo '<ul class="kb-article-list">';

foreach( $st_cat_posts as $post ) : ?>
	<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
    
<?php endforeach; 
echo '</ul>';
// End Get posts per Category

echo '</div>';
}
// Close list terms in a given taxonomy
?>
</div>
   
</section>
<!-- /#content -->

<?php if ($st_kb_sidebar_position != 'off') {
  get_sidebar('kb');
  } ?>
  
</div>
</div>
<!-- /#primary -->
<?php get_footer(); ?>
