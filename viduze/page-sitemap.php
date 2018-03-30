<?php 
/**
 * Template Name: Site Map
 */

get_header(); 
 
?>
            
            
                 <section class="page-body-outer">
                   <section class="page-body-wrapper container mt30"> 
                         <h1 class="cp-page-title cp-divider cp-title title-color">
							<?php the_title(); ?>
       					 </h1>
   						     <div class="content-wrapper sitemap">
	                               <div class="page-wrapper">
                                        <div class="one-third column">
                                            <?php dynamic_sidebar( 'Site Map 1' ); ?>
                                        </div>
                                        <div class="one-third column">
                                            <?php dynamic_sidebar( 'Site Map 2' ); ?>
                                        </div>
                                        <div class="one-third column">
                                            <?php dynamic_sidebar( 'Site Map 3' ); ?>
                                        </div>
                                        <br class="clear">
								   </div> <!-- page-wrapper-end -->
	                         </div> <!-- content-wrapper -->
                  </section> <!--page-body-wrapper-end-->
                </section>  
<?php get_footer(); ?>