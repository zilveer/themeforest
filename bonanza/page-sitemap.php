<?php 
/* 
Template Name: Sitemap
*/ ?>
<?php get_header();?>
<?php 
global $theme_shortname;
$location = icore_get_location();   
$meta = icore_get_multimeta(array('Subheader'));
?>
<div id="entry-full" class="page-sitemap">
    <div id="left">
		<div id="head-line"> 
	    <h1 class="title"><?php  the_title();  ?></h1>
		</div>
        <div class="post-full single">
            
                <h2 id="authors">Authors</h2>
				<ul>
				<?php
				wp_list_authors(
				  array(
				    'exclude_admin' => false,
				  )
				);
				?>
				</ul>

				<h2 id="pages">Pages</h2>
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

				<h2 id="posts">Posts</h2>
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
            
         </div> <!--  end .post  -->
    </div> <!--  end #left  -->
<?php get_sidebar(); ?>
</div> <!--  end #entry-full  -->
<?php get_footer(); ?>
