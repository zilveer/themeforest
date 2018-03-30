<?php
/*
Template Name: Authors
*/
?>
<?php get_header();
$GLOBALS['sbg_sidebar'] = get_post_meta(get_the_ID(), 'sbg_selected_sidebar_replacement', true);
?>
<section id="content_main" class="clearfix">
<div class="row main_content">
<div class="content_wraper three_columns_container">
   <!-- Start content -->
    <div class="eight columns content_display_col1" id="content">
 <div <?php post_class('widget_container content_page'); ?>>
 <?php echo jelly_breadcrumbs_options(); ?> 
 <?php
  if(isset($_GET['author_name'])){
    $post_list_auth = get_userdatabylogin($author_name);
    }else{
    $post_list_auth = get_userdata(intval($author));
  }
  ?> 
<div class="auth author_post_list">
                            <div class="author-info">                                       
                                 <div class="author-avatar"><?php echo get_avatar( $post_list_auth->user_email, $size = '90' ); ?></div> 
                                    <div class="author-description"><h5><?php echo $post_list_auth->display_name; ?></h5>
                                <p><?php echo $post_list_auth->description; ?></p>
                                
                                      <ul class="author-social clearfix">
                              
                               
                                <?php if (get_the_author_meta('url',$post_list_auth->ID) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('url',$post_list_auth->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/website.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('email',$post_list_auth->ID) != ''){ ?>
                               <li><a href="mailto:<?php echo get_the_author_meta('email',$post_list_auth->ID); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/email.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('linkedin',$post_list_auth->ID) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('linkedin',$post_list_auth->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/link.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('rss',$post_list_auth->ID) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('rss',$post_list_auth->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/rss.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('pinterest',$post_list_auth->ID) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('pinterest',$post_list_auth->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/pin.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('devianart',$post_list_auth->ID) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('devianart',$post_list_auth->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/d-art.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('dribble',$post_list_auth->ID) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('dribble',$post_list_auth->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/dribble.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('behance',$post_list_auth->ID) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('behance',$post_list_auth->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/behance.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('youtube',$post_list_auth->ID) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('youtube',$post_list_auth->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/youtube.png"></a></li>
                               <?php }?>
                                
                <?php if (get_the_author_meta('instagram') != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('instagram',$post_list_auth->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/instagram.png"></a></li>
                               <?php }?>
                              
                                <?php if (get_the_author_meta('twitter',$post_list_auth->ID) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('twitter',$post_list_auth->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('facebook',$post_list_auth->ID) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('facebook',$post_list_auth->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/facebook.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('googleplus',$post_list_auth->ID) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('googleplus',$post_list_auth->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/google-plus.png"></a></li>
                               <?php }?>
                               </ul>
                                </div>
                                 </div>
                            </div>

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
<div class="brack_space"></div>
 <?php jelly_pagination(); ?>  
        </div>

  </div>
  <!-- End content -->

    <!-- Start sidebar -->
                <?php echo jelly_other_sidebar_general_show();?>
  <!-- End sidebar -->
</div>
</div>
 </section>
<!-- end content --> 
<?php get_footer(); ?>