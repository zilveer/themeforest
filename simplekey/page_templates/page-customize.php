<?php 
/*Template Name: Fullwidth Page*/

global $VAN;
get_header();
?>

<div id="container">

    <!--Page-->
    <?php while(have_posts() ) : the_post();?>
    <section class="page-area" id="<?php echo $post->post_name;?>-page">
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
           <div class="entry">
              <?php van_content(true,true);?>
               <?php wp_link_pages('<div class="van_pagenavi">', '</div>', 'number');?> 
           </div>
    </section>
    <?php endwhile;?>
    
    
    <?php get_template_part('content','contact');?>
</div>
<?php get_footer();?>