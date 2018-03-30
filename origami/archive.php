<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */

get_header(); ?>
		<?php if (have_posts()) : ?>

    <div id="page-title" class="clearfix">
      <div class="container_12">
        <div class="grid_12">
      <?php $args = array('cat'=>get_query_var('cat'),'tag'=> get_query_var('tag'),'paged'=> $paged, 'posts_per_page'=> get_option('posts_per_page') ); get_archives($args);?> 
 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h1>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h1>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h1>Archive for <?php the_time('F jS, Y'); ?></h1>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h1>Archive for <?php the_time('F, Y'); ?></h1>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h1>Archive for <?php the_time('Y'); ?></h1>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h1>Author Archive</h1>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1>Blog Archives</h1>
 	  <?php } ?>
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
		     <?php if (have_posts()): while (have_posts()): the_post() ?>
             <div class="post">
                <?php if (has_post_thumbnail()): ?>
                <div class="imgframe"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumb620x270'); ?><span class="frame"><span><span><span><span><span class="empty"><em> </em></span></span></span></span></span></span></a></div>
                <?php endif ?>
                  <article class="entry"> <span class="comment-stats right"><span><?php comments_popup_link('0', '1', '%'); ?></span></span>
                    <h2><a href="<?php the_permalink();?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></h2>
                    <?php the_excerpt();?>
                  </article>
                  <div class="left"><a href="<?php the_permalink();?>" class="button small slateblue left"><span><span>READ MORE</span></span></a></div>
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
        </div>
        <div class="clear"> </div>
      </div>
    </div>
    <!-- div#container end -->
	<?php else:?>

		<?php if ( is_category() ) { // If this is a category archive
			printf("<h2>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2>No posts found.</h2>");
		}
		get_search_form();?>


             </div>
          </div>
        </div>
        <div class="clear"> </div>
      </div>
    </div>
    <!-- div#container end -->
	<?php endif; ?>

<?php get_footer(); ?>
