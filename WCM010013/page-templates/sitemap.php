<?php
/* Template Name: SiteMap Page */
?>
<?php get_header(); ?>

<div id="main-content" class="main-content blog-page blog-filter <?php echo tm_sidebar_position(); ?>">
  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
      <?php if($tm_content_position == 'above') : 
		// Page thumbnail
		templatemela_post_thumbnail();
		the_content(); 
	  endif; ?>
      <!-- Start archive-content -->
      <div class="archive-content">
        <div class="one_third">
          <div class="sitemap-pages">
            <h2>
              <?php _e('Pages','templatemela');?>
            </h2>
            <ul>
              <?php wp_list_pages('depth=0&sort_column=post_title&title_li=' ); ?>
            </ul>
          </div>
        </div>
        <div class="one_third">
          <div class="sitemap-category">
            <h2>
              <?php _e( 'Category Archives','templatemela'); ?>
            </h2>
            <ul>
              <?php wp_list_categories( array( 'feed' => __( 'RSS', 'templatemela' ), 'show_count' => true, 'use_desc_for_title' => false, 'title_li' => false ) ); ?>
            </ul>
          </div>
          <div class="clear"></div>
          <div class="sitemap-month-archieves">
            <h2>
              <?php _e( 'Monthly Archives','templatemela'); ?>
            </h2>
            <ul>
              <?php wp_get_archives('type=monthly'); ?>
            </ul>
          </div>
          <div class="clear"></div>
          <div class="sitemap-authors">
            <h2>
              <?php _e( 'Author Archives','templatemela'); ?>
            </h2>
            <ul>
              <?php wp_list_authors('show_fullname=1&optioncount=1&exclude_admin=0'); ?>
            </ul>
          </div>
        </div>
        <div class="one_third last">
          <div class="sitemap-posts">
            <h2>
              <?php _e( 'Blog Posts','templatemela'); ?>
            </h2>
            <ul>
              <?php 
				$archivesquery = new WP_Query('showposts=20');
				while ($archivesquery->have_posts()) : $archivesquery->the_post(); ?>
              <li> <a href="<?php the_permalink() ?>"  rel="bookmark" title="<?php printf( __("Permanent Link to %s", 'striking_front'), get_the_title() ); ?>">
                <?php the_title(); ?>
                </a> (
                <?php comments_number('0', '1', '%'); ?>
                ) </li>
              <?php endwhile; ?>
            </ul>
          </div>
        </div>
      </div>
      <!-- End archive-content -->
      <?php if($tm_content_position == 'below') : 
		// Page thumbnail
		templatemela_post_thumbnail();
		the_content(); 
	  endif; ?>
    </div>
    <!--End #content -->
  </div>
  <!-- End #primary -->
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
