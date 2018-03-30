<?php 
/*Template Name: Portfolios Archives*/

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
         <?php endif;?>
        <?php endwhile;?>
        
        <div class="entry">
        <?php
		van_content(true,true);
	    wp_link_pages('<div class="van_pagenavi">', '</div>', 'number');
		?>
		<p><?php van_portfolios_filter($inverse=0,$echo=true);?></p>
        <?php
		$limit = get_option('posts_per_page');
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts('post_type=portfolio&posts_per_page='.$limit.'&paged='.$paged);
		get_template_part('content','portfolios');
		?> 
	 </div>
       </div>
    </section>
    
    <?php get_template_part('content','contact');?>
</div>
<?php get_footer();?>