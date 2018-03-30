<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */

get_header();?>
    <div id="page-title" class="clearfix">
      <div class="container_12">
        <div class="grid_12">
          <h1><?php the_title();?></h1>
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
              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>              
              <div class="post">
                <h1><?php the_title(); ?></h1>
                <div class="postmeta clearfix">
                  <time class="left"><?php the_time('F j, Y');?></time>
                  <div><?php the_category(', ') ?></div>
                </div>
                <?php if (has_post_thumbnail()): ?>
                <div class="imgframe"><?php the_post_thumbnail('thumb620x270'); ?><span class="frame"><span><span><span><span><span class="empty"></span></span></span></span></span></span></div>
                <?php endif ?>
                <article class="entry">
                  <?php the_content();?>
                </article>
                <?php the_tags( '<div class="posttags clearfix"> ', ', ', '</div>'); ?>
              </div>
              <div class="about-the-author">
                <div class="clearfix">
                  <h2>About the Author</h2>
                  <div class="avatar thumbnail left">
                  	<?php echo get_avatar(get_the_author_email(),$size='60',$default=get_template_directory_uri().'/images/sample/avatar.jpg' ); ?>
                  	<span></span>
                  </div>
                  <div>
                    <h3><?php echo get_the_author(); ?></h3>
                    <p><?php the_author_description(); ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php comments_template(); ?>
	    <?php endwhile; else: ?>
		  <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>
        <div class="clear"> </div>
      </div>
    </div>
<?php get_footer(); ?>
