<div class="four columns widget alpha">
<h2 id="authors"><?php echo __('Authors', 'morphis'); ?></h2>
<ul>
<?php
wp_list_authors(
  array(
    'exclude_admin' => false,
  )
);
?>
</ul>
</div>

<div class="four widget columns">
<h2 id="pages"><?php echo __('Pages', 'morphis'); ?></h2>
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

<div class="four widget columns omega">
<h2 id="posts"><?php echo __('Posts by Categories', 'morphis'); ?></h2>
<ul>
<?php
// Add categories you'd like to exclude in the exclude here
$cats = get_categories('exclude=');
foreach ($cats as $cat) {
  echo "<li><h3>".$cat->cat_name."</h3>";
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