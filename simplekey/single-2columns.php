<?php 
global $VAN;
get_header();
?>

<div id="container">

    <!--Single Page-->
    <section class="page-area" id="blog-single">
       <div class="wrapper">
          <div id="breadcrumbs">
            <span class="nav-previous"><?php previous_post_link( '%link', __( '&larr; Previous', 'SimpleKey' ) ); ?></span>
			<span class="nav-next"><?php next_post_link( '%link', __( 'Next &rarr;', 'SimpleKey' ) ); ?></span>
          </div>
          
           <div class="clearfix"></div>
           <div id="blog-2columns-single" class="column two_third">
               <?php while (have_posts()) : the_post(); ?>
                   <article class="post">
                       <h2><?php the_title();?></h2>
                       <div class="postmeta"><?php the_time(get_option('date_format'));?> / <?php printf(__('By %s','SimpleKey'),get_the_author());?> / <?php printf( __( 'in %2$s', 'SimpleKey' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>/ <?php comments_popup_link( __( 'No comment', 'SimpleKey' ), __( '1 Comment', 'SimpleKey' ), __( '% Comments', 'SimpleKey' ) ); ?></div>
                       <div class="entry">
                          <?php van_content(true,true);?>
                          <?php wp_link_pages('before=<div class="van-pagenavi">&after=</div>');?> 
                       </div>
                       <div class="clearfix"></div>
                   </article>
               <?php endwhile;?>
               <?php comments_template(); ?>
           </div>
           <div id="sidebar-right" class="column one_third last">
                <?php get_sidebar();?>
           </div>
           <div class="clearfix"></div>
       </div>
    </section>
    
    <?php get_template_part('content','contact');?>
</div>
<?php get_footer();?>