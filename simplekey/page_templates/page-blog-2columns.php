<?php 
/*Template Name: Two columns blog archives*/

global $VAN;
get_header();
?>

<div id="container">

    <!--Page-->
    <section id="portfolio-tpl" class="page-area">
       <div class="wrapper">
       <?php while(have_posts() ) : the_post();?>
       <?php
       //Set Heading text
		  $mainHeading=get_post_meta($post->ID, "page_mainheading_value", true);
		  $subHeading=get_post_meta($post->ID, "page_subHeading_value", true);
		  $hideTitle=get_post_meta($post->ID, "hide_title_value", true);
		  if($mainHeading=='')$mainHeading=get_the_title();
	   ?>
         <?php if($hideTitle!='Yes'):?>
           <header class="title">
              <h1><strong><?php echo $mainHeading;?></strong></h1>
              <?php if($subHeading<>''):?><p><?php echo $subHeading;?></p><?php endif;?>
           </header>
           <div class="line"></div>
         <?php endif;?>
        
        <div class="entry">
			<?php
            van_content(true,true);
            wp_link_pages('<div class="van_pagenavi">', '</div>', 'number');
            ?>
        </div>
        <?php endwhile;?>
        
        <?php
		$limit = get_option('posts_per_page');
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts('posts_per_page='.$limit.'&paged='.$paged);
		?> 
        <div id="blog-2columns" class="column two_third">
          <?php if (have_posts()):?>
 <?php while (have_posts()) : the_post(); ?>
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
               <?php if(has_post_thumbnail()):?>
               <div class="thumbnail"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_post_thumbnail('blog_thumbnail',array('alt'=>esc_attr(get_the_title()),'title'=>esc_attr(get_the_title())));?></a></div>
               <?php endif;?>
               <h2><a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title());?>" rel="bookmark"><?php the_title();?></a></h2>
               <div class="postmeta"><p><?php the_time(get_option('date_format'));?> / <?php printf(__('By %s','SimpleKey'),get_the_author());?> / <?php printf( __( 'in %2$s', 'SimpleKey' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?> / <?php comments_popup_link( __( 'No comment', 'SimpleKey' ), __( '1 Comment', 'SimpleKey' ), __( '% Comments', 'SimpleKey' ) ); ?></p></div>
               <div class="entry">
               <?php 
			   if(has_post_thumbnail()){
				 if($post->post_excerpt){ 
				   the_excerpt();
				 }else{
			       echo van_truncate(strip_tags(get_the_content()),200);
				 }
				 echo '<a href="'.get_permalink().'" class="more-link">'.__('Read More &raquo;','SimpleKey').'</a>';
			   }else{
				  if($post->post_excerpt){ 
				   the_excerpt();
				  }else{
			       van_content(true,true);
				  }
			   }
			   ?>
               </div>
               <div class="clearfix"></div>
  </article>
  <?php endwhile;?>
  
  <?php echo van_pagenavi();?>
  
<?php else:?>
  <article class="post">
               <h2><?php _e( 'No Posts Found In This Category', 'SimpleKey' ); ?></h2>
               <div class="entry">
                   <?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'SimpleKey' ); ?>
                   <?php get_search_form(); ?>
               </div>
               <div class="clearfix"></div>
  </article>
<?php endif;?>
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