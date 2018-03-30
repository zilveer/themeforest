<?php
/**
 * @package WordPress
 * @subpackage Grounded_Theme
 */
/**
Template Name: Big Image Listing
*/
get_header(); ?>
    <div id="page-title" class="clearfix">
      <div class="container_12">
        <div class="grid_12">
          <h1><?php the_title(); ?></h1>
        </div>
      </div>
    </div>
    <?php if (get_option('themeteam_origami_enable_breadcrumbs') == 'true'){ ?>
	<div id="breadcrumbs" class="clearfix">
		<div class="container_12">
	    	<div class="grid_12">
			<?php breadcrumbs(get_option('themeteam_origami_enable_breadcrumbs')); ?>
			</div>
		</div>
	</div>
	<?php } ?>
    <div id="container" class="clearfix">
      <div class="container_12">
        <div class="col2-right-layout clearfix">
          <div class="clearfix">
            <?php get_sidebar(); ?>
            <div class="grid_8">
             <?php $page = get_query_var('paged'); $args = array('paged'=> $page, 'posts_per_page'=> get_option('posts_per_page'), 'caller_get_posts' => 1 ); query_posts($args);?>
		     <?php if (have_posts()): while (have_posts()): the_post() ?>
             <div class="post">
                <?php if (has_post_thumbnail()): ?>
                <div class="imgframe"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumb620x270'); ?><span class="frame"><span><span><span><span><span class="empty"><em> </em></span></span></span></span></span></span></a></div>
                <?php endif ?>
                  <article class="entry"> <span class="comment-stats right"><span><?php comments_popup_link('0', '1', '%'); ?></span></span>
                    <h2><a href="<?php the_permalink();?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></h2>
                    <?php the_excerpt();?>
                  </article>
                  <div class="left"><a href="<?php the_permalink();?>" class="button small <?php echo $GLOBALS['button_css'];?> left"><span><span>READ MORE</span></span></a></div>
                  <div class="postmeta">
                    <time class="left"><?php the_time('F j, Y');?></time>
                    <div><?php the_category(', ') ?></div>
                  </div>
              </div>
             <?php endwhile; ?>
             <div class="pagenavi"> 
                <?php next_posts_link('&larr; Older Posts') ?>
                <?php previous_posts_link('Newer Posts &rarr;') ?>               
              </div>
	          <?php else: ?>
		       <p>Sorry, but you are looking for something that isn't here. </p>		
		      <?php endif ?>
             </div>
          </div>
        </div>
        <div class="clear"> </div>
      </div>
    </div>
    <!-- div#container end -->

<?php get_footer(); ?>
