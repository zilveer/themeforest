<?php
/**
 * Template Name: Sitemap page
*/

get_header();
st_before_content($columns='sixteen'); ?>


<div class="columns five add17pxmargin alpha">
<h4 id="posts">Posts</h4>
<ul>
<?php
// Add categories you'd like to exclude in the exclude here
$cats = get_categories('exclude=');
foreach ($cats as $cat) {
  echo "<li>".$cat->cat_name."";
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

<div class="columns five add17pxmargin">
<h4 id="pages">Pages</h4>
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
</div>

<div class="columns five add17pxmargin omega">

<h4>Portfolio</h4>
<ul>
<?php
$terms = get_terms( 'portfolio_category', 'orderby=name' );
foreach ($terms as $term) {
echo "<li>".$term->name."";
echo "<ul>";
$args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
        'tax_query' => array(
                array(
                        'taxonomy' => 'portfolio_category',
                        'field' => 'slug',
                        'terms' => $term->slug
                )
        )
);
$new = new WP_Query($args);
while ($new->have_posts()) {
$new->the_post();
echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
}
echo "</ul>";
echo "</li>";
} ?>
</ul>

<h4>Slideshow</h4>
<ul>
<?php
$terms = get_terms( 'slideshow_category', 'orderby=name' );
foreach ($terms as $term) {
echo "<li>".$term->name."";
echo "<ul>";
$args = array(
        'post_type' => 'slideshow',
        'posts_per_page' => -1,
        'tax_query' => array(
                array(
                        'taxonomy' => 'slideshow_category',
                        'field' => 'slug',
                        'terms' => $term->slug
                )
        )
);
$new = new WP_Query($args);
while ($new->have_posts()) {
$new->the_post();
echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
}
echo "</ul>";
echo "</li>";
} ?>
</ul>

<h4>Sponsors</h4>
<ul>
<?php
echo "<ul>";
$args = array(
        'post_type' => 'sponsors',
        'posts_per_page' => -1
        );
$new = new WP_Query($args);
while ($new->have_posts()) {
$new->the_post();
echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';

} ?>
</ul>

</div>

<?php st_after_content();
get_footer();
?>
