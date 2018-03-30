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
<?php 
if (have_posts()) {while (have_posts()) { the_post();
?>
<div class="content_wraper three_columns_container">
   <!-- Start content -->
    <div class="eight columns content_display_col1" id="content">
 <div <?php post_class('widget_container content_page'); ?>>
 <?php echo jelly_breadcrumbs_options(); ?> 
      <h1 class="single-post-title page-title author-post-title"><?php the_title(); ?></h1>
        <?php the_content(); ?>
          <?php $users = get_users('blog_id=1&orderby=post_count&order=DESC'); 
		  $exclude = array(2);
		  foreach ($users as $user) {	
		 $exclude[] = $user->ID;
		  ?>
	       <div class="auth">
                            <div class="author-info">                                       
                                 <div class="author-avatar"> <?php echo get_avatar( get_the_author_meta( 'user_email' , $user->ID ), apply_filters( 'MFW_author_bio_avatar_size', 90 ) ); ?></div> 
                                    <div class="author-description"><h5><a itemprop="author" href="<?php echo esc_url(get_author_posts_url( $user->ID )); ?>"><?php echo esc_attr($user->display_name) ?></a></h5>
                                <p><?php echo esc_attr(the_author_meta('description' , $user->ID)); ?></p>
                                
                                      <ul class="author-social clearfix">
                              
                               
                               
                                <?php if (get_the_author_meta('url' , $user->ID)){ ?>
                               <li><a href="<?php echo esc_attr(the_author_meta('url' , $user->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/website.png"></a></li>
                               <?php }?>
                               <?php if (get_the_author_meta('email' , $user->ID)){ ?>
                               <li><a href="mailto:<?php echo the_author_meta('email' , $user->ID); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/email.png"></a></li>
                               <?php }?>
                               <?php if (get_the_author_meta('linkedin' , $user->ID)){ ?>
                               <li><a href="<?php echo esc_attr(the_author_meta('linkedin' , $user->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/link.png"></a></li>
                               <?php }?>
								<?php if (get_the_author_meta('rss' , $user->ID)){ ?>
                               <li><a href="<?php echo esc_attr(the_author_meta('rss' , $user->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/rss.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('pinterest' , $user->ID)){ ?>
                               <li><a href="<?php echo esc_attr(the_author_meta('pinterest' , $user->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/pin.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('devianart' , $user->ID)){ ?>
                               <li><a href="<?php echo esc_attr(the_author_meta('devianart' , $user->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/d-art.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('dribble' , $user->ID)){ ?>
                               <li><a href="<?php echo esc_attr(the_author_meta('dribble' , $user->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/dribble.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('behance' , $user->ID)){ ?>
                               <li><a href="<?php echo esc_attr(the_author_meta('behance' , $user->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/behance.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('youtube' , $user->ID)){ ?>
                               <li><a href="<?php echo esc_attr(the_author_meta('youtube' , $user->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/youtube.png"></a></li>
                               <?php }?>
                                
								<?php if (get_the_author_meta('instagram' , $user->ID)){ ?>
                               <li><a href="<?php echo esc_attr(the_author_meta('instagram' , $user->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/instagram.png"></a></li>
                               <?php }?>
                              
                                <?php if (get_the_author_meta('twitter' , $user->ID)){ ?>
                               <li><a href="<?php echo esc_attr(the_author_meta('twitter' , $user->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('facebook' , $user->ID)){ ?>
                               <li><a href="<?php echo esc_attr(the_author_meta('facebook' , $user->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/facebook.png"></a></li>
                               <?php }?>
                                <?php if (get_the_author_meta('googleplus' , $user->ID)){ ?>
                               <li><a href="<?php echo esc_attr(the_author_meta('googleplus' , $user->ID)); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/google-plus.png"></a></li>
                               <?php }?>
                               </ul>
                                </div>
                                 </div>
                            </div>   
          <?php } ?>
  

<div class="brack_space"></div>
        </div>

  </div>
  <!-- End content -->

    <!-- Start sidebar -->
                <?php echo jelly_sidebar_page_general_show();?>
  <!-- End sidebar -->
</div>
<?php }}  ?>
</div>
 </section>
<!-- end content --> 
<?php get_footer(); ?>