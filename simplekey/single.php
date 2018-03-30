<?php 
global $VAN;
if(isset($VAN['blogSidebar']) && $VAN['blogSidebar']==0){
  get_template_part('single','2columns');
  die();
}
get_header();
?>

<div id="container">

    <!--Single Page-->
    <section class="page-area" id="single-content">
       <div class="wrapper">
          <div id="breadcrumbs">
            <span class="nav-previous"><?php previous_post_link( '%link', __( '&larr; Previous', 'SimpleKey' ) ); ?></span>
			<span class="nav-next"><?php next_post_link( '%link', __( 'Next &rarr;', 'SimpleKey' ) ); ?></span>
          </div>

           <?php while (have_posts()) : the_post(); ?>
            <article class="post">
               <?php van_posted_on();?>
               <h2><?php the_title();?></h2>
               <div class="entry">
                   <?php van_content(true,true);?>
                  <?php wp_link_pages('before=<div class="van-pagenavi">&after=</div>');?> 
               </div>
               <div class="clearfix"></div>
           </article>
           <?php endwhile;?>
          
           <?php comments_template(); ?>
       </div>
    </section>
    
    <?php get_template_part('content','contact');?>
</div>
<?php get_footer();?>