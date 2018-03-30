<?php get_header(); ?>
<section id="content_main" class="clearfix">
<div class="row main_content">
<div class="content_wraper three_columns_container">	

  <div class="eight columns content_display_col1" id="content">
        <div class="widget_container content_page">
        <?php echo jelly_breadcrumbs_options(); ?>   
    <?php if(is_archive() ) {?>
							<h3 class="categories-title title">					
							<?php esc_attr_e('Archives post', 'nanomag');?>
							</h3>
			<?php }?>
                    <div class="post_list_medium_widget">
                    <div>
                    
                    <?php if (have_posts()){ 
						$row_count=0; 
						while (have_posts()){ the_post(); 
                        $row_count++;
						 $post_id = get_the_ID();
						 //get all post categories
            $categories = get_the_category(get_the_ID());
				?>
				<div class="feature-two-column medium-two-columns <?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?> <?php if($row_count%2){echo esc_attr("left_post_align ");}else{echo esc_attr("right_post_align ");}?>">
                            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <div class="image_post feature-item">
                   <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium-feature');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/medium-feature.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
             <?php echo jelly_total_score_post_front_small_circle(get_the_ID());?> 		                         
                     </div>

<div class="meta_holder">
<?php  if(of_get_option('disable_post_category') !=1){
          if ($categories) {
            echo '<span class="meta-category-small">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
              $titleColor = jelly_categorys_title_color($tag->term_id, "category", false);
             echo '<a class="post-category-color-text" style="color:'.esc_attr($titleColor).'" href="'.esc_url($tag_link).'">'.$tag->name.'</a>';          
            }
            echo "</span>";
            }
       }?>
<?php echo jelly_post_like_meta(get_the_ID());?>
</div>
 <h3 class="image-post-title feature_2col"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
<?php echo jelly_post_meta(get_the_ID()); ?>
 <p><?php echo jelly_post_list_excerpt(get_the_excerpt('')); ?> </p>
 <?php echo jelly_post_meta_footer(get_the_ID()); ?>
    </div>
    </div>

    <?php if($row_count%2){}else{echo '<div class="clearfix"></div>';}?>    

                        <?php } ?>
                    <?php }else{ ?>       
                        <?php
                        if (is_search()) {
                            _e('No result found', 'nanomag');
                        }
                        ?>                   
                    <?php } ?>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
                   <?php jelly_pagination(); ?>      
  </div></div>
        
 
        <!-- Start sidebar -->	
<?php


 if (have_posts()) { while (have_posts()) { the_post();
 $GLOBALS['sbg_sidebar'] = get_post_meta(get_the_ID(), 'sbg_selected_sidebar_replacement', true);
 $GLOBALS['small_sbg_sidebar'] = get_post_meta(get_the_ID(), 'small_sbg_selected_sidebar_replacement', true); 
}}


$other_page_columns_layout= of_get_option('other_page_columns_layout'); 
if($other_page_columns_layout=='columns3_option'){echo sidebar_archive_small_show();}
else{}								
    
    //Start sidebar -->
echo jelly_sidebar_archive_general_show();
?>  

  <!-- End sidebar -->
       
    <div class="clearfix"></div>
        
</div>
</div>
 </section>
<!-- end content --> 
<?php get_footer(); ?>