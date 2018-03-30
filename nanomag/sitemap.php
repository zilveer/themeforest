<?php
/*
Template Name: Sitemap
*/
?>
<?php get_header(); ?>
<section id="content_main" class="clearfix">
<div class="row main_content">
<!-- begin content -->        
<div <?php post_class('page-sitemap twelve columns three_columns_container'); ?> id="post-<?php the_ID(); ?>"> 
<?php echo jelly_breadcrumbs_options(); ?> 
<h1 class="single-post-title page-title"><?php the_title(); ?></h1>
</div>
<div class="content_page_padding sitemap-padding"> 
<div class="three columns">
<h3 class="sitemap_title">
            <?php _e('Pages','nanomag'); ?>
          </h3>
          <ul id="sitemap_pages">
            <?php wp_list_pages('title_li='); ?>
          </ul>
</div>
<div class="three columns">
 <h3 class="sitemap_title">
            <?php _e('Categories','nanomag'); ?>
          </h3>
          <ul id="sitemap_categories">
            <?php wp_list_categories('title_li='); ?>
          </ul>
</div>
<div class="three columns">
<h3 class="sitemap_title">
            <?php _e('Tags','nanomag'); ?>
          </h3>
          <ul id="sitemap_categories">
            <?php $tags = get_tags();
			  if ($tags)
				{
					foreach ($tags as $tag)
					{
					  echo '<li><a href="' . esc_url(get_tag_link( $tag->term_id )) . '">' . esc_attr($tag->name) . '</a></li> ';
					}
				}
			?>
          </ul>
</div>
<div class="three columns">
 <h3 class="sitemap_title">
            <?php _e('Authors','nanomag'); ?>
          </h3>
          <ul id="sitemap_authors" >
            <?php wp_list_authors('optioncount=1&exclude_admin=0'); ?>
          </ul>
</div>  






<div class="clearfix"></div>
      </div>
      <div class="brack_space"></div>
      </div>
  </div> 
  </section>
<?php get_footer(); ?>