<?php 
/*Template Name: Contact Page*/

global $VAN;
get_header();
?>

<div id="container">

    <!--Page-->
    <section id="content-tpl" class="page-area">
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
           <header class="title wpb_animate_when_almost_visible wpb_bottom-to-top">
              <h2><strong><?php echo $mainHeading;?></strong></h2>
              <?php if($subHeading<>''):?><p><?php echo $subHeading;?></p><?php endif;?>
           </header>
         <?php endif;?>
        <?php endwhile;?>
        
        <div class="entry">
            <div class="one_half column">
              <?php get_template_part('content','contactform');?>
            </div>
            <div class="one_half column last split">
            <?php 
			if(get_the_content()){
			  van_content(true,true);
			}else{
			  echo '<h2>KEEP IN TOUCH WITH US</h2>
                    <p>You can use the following information to contact us if you wanna join us or anything need to communicate.</p>';
			  echo van_social();
			}
			?>
            </div>
        </div>

       </div>
    </section>
</div>
<?php get_footer();?>