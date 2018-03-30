<?php get_header();
$GLOBALS['sbg_sidebar'] = get_post_meta(get_the_ID(), 'sbg_selected_sidebar_replacement', true);
?>
<!-- begin content -->            
<section id="content_main" class="clearfix">
<div class="row main_content">
<div class="content_wraper three_columns_container">
        <div class="<?php $full= get_post_custom_values('full_widthjellywp_checkbox'); if($full[0]==1){echo esc_attr("twelve single_post_fullpage");}else{echo esc_attr("eight content_display_col1");}?> columns" id="content">
         <div class="widget_container content_page"> 
           
                               <!-- start post -->
                    <div <?php post_class(''); ?> id="post-<?php the_ID(); ?>" itemscope="" itemtype="http://schema.org/Review">
                                    
                        <?php if (have_posts()) { while (have_posts()) { the_post(); ?>
                                <?php
                                $categories = get_the_category();
                                $tags = get_the_tags();
                                $post_id = get_the_ID();
                                echo jelly_breadcrumbs_options();
                                if(of_get_option('disable_post_format_single') !=1){get_template_part('single_format');}
                        ?>
<div class="single_post_title heading_post_title">

  <?php  if(of_get_option('disable_post_category') !=1){
          if ($categories) {
            echo '<span class="meta-category-small">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
              $titleColor = jelly_categorys_title_color($tag->term_id, "category", false);
             echo '<a class="post-category-color-text" style="background:'.esc_attr($titleColor).' !important" href="'.esc_url($tag_link).'">'.$tag->name.'</a>';          
            }
            echo "</span>";
            }
       }?>

                               <h1 itemprop="name" class="entry-title single-post-title heading_post_title"><?php the_title(); ?></h1>
                                <?php echo jelly_single_post_meta($post_id);?>
                                <span class="view_love_wrapper">
                                <?php echo '<span class="view_counter_single">'.bac_PostViews(get_the_ID()).'</span>';?>
                                <?php echo jelly_post_like_meta(get_the_ID());?>
                                </span>
                               </div>
                               
                               <div class="clearfix"></div>
                                <div class="post_content"><?php the_content(); ?></div> 
                                <?php 
 	$defaults_link = array(
		'before'           => '<div class="pagination">' . esc_attr__( 'Continued On Page:', 'nanomag' ),
		'after'            => '</div>',
		'link_before'      => '<span class"box">',
		'link_after'       => '</span>',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => esc_attr__( 'Next page', 'nanomag' ),
		'previouspagelink' => esc_attr__( 'Previous page', 'nanomag' ),
		'pagelink'         => '%',
		'echo'             => 1,
		'highlight'   => 'b'
	);

wp_link_pages( $defaults_link ); ?>
      
                                   <?php  if(of_get_option('disable_post_review') !=1){?>
                               <?php if(jelly_total_score_post(get_the_ID())){?>
                                <div class="reviewbox">
                                <div class="review_header"><h3> <span itemprop="itemreviewed"><?php esc_attr_e('Reviews', 'nanomag'); ?></span></h3></div>
                                  <ul class="progress-bar">
                             
                             <?php $review_slider1= get_post_custom_values('review_option1jellywp_slider'); if($review_slider1[0]!=0){ ?>
                               <li class="title-score"><span class="review_bar-title"><?php $text1= get_post_custom_values('review_option1jellywp_text'); echo esc_attr($text1[0]); ?></span><span class="review_score"><?php echo esc_attr($review_slider1[0]); ?></span></li>
                                <li class="review_bar">
                                    <div class="review_bar-content" style="width:<?php echo esc_attr($review_slider1[0] * 10); ?>%"></div>
                                    </li>
                                    <?php }?>
                                
                                <?php $review_slider2= get_post_custom_values('review_option2jellywp_slider'); if($review_slider2[0]!=0){ ?>    
                               <li class="title-score"><span class="review_bar-title"><?php $text2= get_post_custom_values('review_option2jellywp_text'); echo esc_attr($text2[0]); ?></span><span class="review_score"><?php echo esc_attr($review_slider2[0]); ?></span></li>
                                <li class="review_bar">
                                    <div class="review_bar-content" style="width:<?php echo esc_attr($review_slider2[0] * 10); ?>%"></div>
                                    </li>
                                    <?php }?>
                                    
                                     <?php $review_slider3= get_post_custom_values('review_option3jellywp_slider'); if($review_slider3[0]!=0){ ?>  
                                  <li class="title-score"><span class="review_bar-title"><?php $text3= get_post_custom_values('review_option3jellywp_text'); echo esc_attr($text3[0]); ?></span><span class="review_score"><?php echo esc_attr($review_slider3[0]); ?></span></li>
                                <li class="review_bar">
                                    <div class="review_bar-content" style="width:<?php echo esc_attr($review_slider3[0] * 10); ?>%"></div>
                                    </li>
                                <?php }?>
                                
                                <?php $review_slider4= get_post_custom_values('review_option4jellywp_slider'); if($review_slider4[0]!=0){ ?>  
                                 <li class="title-score"><span class="review_bar-title"><?php $text4= get_post_custom_values('review_option4jellywp_text'); echo esc_attr($text4[0]); ?></span><span class="review_score"><?php echo esc_attr($review_slider4[0]); ?></span></li>
                                <li class="review_bar">
                                    <div class="review_bar-content" style="width:<?php echo esc_attr($review_slider4[0] * 10); ?>%"></div>
                                    </li>         
                                    <?php }?>
                                    
                                    <?php $review_slider5= get_post_custom_values('review_option5jellywp_slider'); if($review_slider5[0]!=0){ ?>  
                                   <li class="title-score"><span class="review_bar-title"><?php $text5= get_post_custom_values('review_option5jellywp_text'); echo esc_attr($text5[0]); ?></span><span class="review_score"><?php echo esc_attr($review_slider5[0]); ?></span></li>
                                <li class="review_bar">
                                    <div class="review_bar-content" style="width:<?php echo esc_attr($review_slider5[0] * 10); ?>%"></div>
                                    </li>
                                    <?php }?>
                                    
                                              
                           <?php $total_review = jelly_total_score_post(get_the_ID())?>
                          
                              
                              <li class="review_bar total-review-bar">
                                  <div class="total_review_bar-content"><?php echo esc_attr(round($total_review / 5 ,1));?> <p class="score-label">Score</p></div>
                                  <span class="review_bar-title"> <?php if($review_summer = get_post_custom_values('review_jellywp_wysiwyg')){?>
                                <div class="review-summery">
                                 <?php echo esc_attr($review_summer[0]); ?>
                                  </div>
                                  <?php }?></span>
                                  </li>
                              
                                </ul>

                              <?php $ratings = new user_review_user_review(); ?>
                              <div class="user_review-user-review-criteria">
                              <span class="user_review-user-review-description"><b><span class="your_rating" style="display:none;"><?php _e('Your Rating', 'nanomag'); ?></span><span class="user_rating"><?php _e('User Rating', 'nanomag'); ?></span></b>: <span class="score"><?php echo $ratings->current_rating; ?></span> ( <span class="count"><?php echo $ratings->count; ?></span> <?php _e('Votes', 'nanomag'); ?> )</span>
                              <span class="user_review-user-review-rating">
                              <span class="user_review-criteria-star-under"><span class="user_review-criteria-star-top" style="width:<?php echo $ratings->current_position; ?>%"></span></span>
                              </div>
                                
                <div itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating">
                  <meta itemprop="worstRating" content = "1">
                  <meta itemprop="ratingValue" content = "<?php echo esc_attr(round($total_review / 10 ,1));?>">
                  <meta itemprop="bestRating" content = "5">
                </div>	
								
                             <div class="clearfix"></div>   
                                
                                     
                                 </div>
                                 
                                <?php }}?>

                                
                                
                                <hr class="none" />
                                 <?php  if(of_get_option('disable_post_tag') !=1){?>
                                <div class="tag-cat">                                                               
                                   <?php if (!empty($tags)){ echo '<span class="tag_title">TAG</span>';?><?php the_tags('', ' '); ?> <?php } ?>                                                          
                                </div>
                            <?php }?>
                                
              <div class="clearfix"></div>
                                
                 <?php  if(of_get_option('disable_post_share') !=1){?>         
                          
                            <div class="share-post">
        <ul class="blog-share-socials">
        <li class="facebook">
          <a title="Facebook"  href="http://www.facebook.com/share.php?u=<?php echo get_permalink();?>" target="_blank"><i class="fa fa-facebook"></i>Facebook</a>
        </li>
        <li class="twitter">
          <a title="Twitter"  href="http://twitter.com/home?status=<?php echo the_title(); ?>%20-%20<?php echo get_permalink();?>" target="_blank"><i class="fa fa-twitter"></i>Twitter</a>
        </li> 
        <li class="googleplus">
          <a title="Google Plus"  href="https://plus.google.com/share?url=<?php echo get_permalink();?>" target="_blank"><i class="fa fa-google-plus"></i>Google+</a>
        </li>
        <li class="linkedin">
          <a title="LinkedIn"  href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink();?>&title=<?php echo the_title();?>" target="_blank"><i class="fa fa-linkedin"></i>Linkedin</a>
        </li>
        <li class="tumblr">
          <a  title="Tumblr" href="http://www.tumblr.com/share/link?url=<?php echo get_permalink();?>&name=<?php echo the_title();?>" target="_blank"><i class="fa fa-tumblr"></i>Tumblr</a>
        </li>
        <li class="pinterest">
          <a title="Pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink();?>&media=<?php if ( has_post_thumbnail()) {$thumbnail_pin_id = get_post_thumbnail_id(); if( !empty($thumbnail_pin_id) ){ $thumbnail_pin = wp_get_attachment_image_src( $thumbnail_pin_id , 'slider-normal' );} echo esc_attr($thumbnail_pin[0]);}?>" target="_blank"><i class="fa fa-pinterest"></i>Pinterest</a>
        </li>
        <li class="mail">
          <a title="Mail" href="mailto:<?php echo get_the_author_meta('email');?>?subject=<?php echo the_title();?>&body=<?php  echo get_permalink(); ?>" target="_blank"><i class="fa fa-paper-plane"></i>Mail</a>
        </li>
    </ul>

             <div class="clearfix"></div>
             
              </div>
                   <?php }?>         
                           
                            <div class="postnav">
                                       
                            <span class="left">
                                <?php
                                $next_post = get_next_post();
								
                                if (!empty($next_post)){
									
                                    ?>
                                   <i class="fa fa-angle-double-left"></i>
                                    <a href="<?php echo esc_attr(get_permalink($next_post->ID)); ?>" id="prepost"><span><?php esc_attr_e('Previous Post', 'nanomag'); ?></span><?php echo esc_attr($next_post->post_title); ?></a>

                                <?php } ?>
                                </span>
                                
                                <span class="right">

                                <?php
								
                                $prev_post = get_previous_post();
                                if (!empty($prev_post)){
								
                                    ?>
                                    <i class="fa fa-angle-double-right"></i>
                                    <a href="<?php echo esc_attr(get_permalink($prev_post->ID)); ?>" id="nextpost"><span><?php esc_attr_e('Next Post', 'nanomag'); ?></span><?php echo esc_attr($prev_post->post_title); ?></a>
                                <?php } ?>
                                </span>
                                
                                
                                
                            </div>
               
                            <hr class="none">
                        
                        
                            
                             <?php  if(of_get_option('disable_post_author_box') !=1){?>     
                            <div class="auth">
                            <div class="author-info">                                       
                                 <div class="author-avatar"><?php echo get_avatar(get_the_author_meta('user_email'), 165); ?></div> 
                                    <div class="author-description"><h5><a itemprop="author" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php esc_attr(the_author_meta( 'display_name' )); ?></a></h5>
                                <p><?php echo get_the_author_meta('description'); ?></p>
                                
                                      <ul class="author-social clearfix">
                              
                               
                                <?php if ((get_the_author_meta('url')) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('url')); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/website.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('email')) != ''){ ?>
                               <li><a href="mailto:<?php echo get_the_author_meta('email'); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/email.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('linkedin')) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('linkedin')); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/link.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('rss')) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('rss')); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/rss.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('pinterest')) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('pinterest')); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/pin.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('devianart')) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('devianart')); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/d-art.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('dribble')) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('dribble')); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/dribble.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('behance')) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('behance')); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/behance.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('youtube')) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('youtube')); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/youtube.png"></a></li>
                               <?php }?>
                                
								<?php if ((get_the_author_meta('instagram')) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('instagram')); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/instagram.png"></a></li>
                               <?php }?>
                              
                                <?php if ((get_the_author_meta('twitter')) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('twitter')); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('facebook')) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('facebook')); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/facebook.png"></a></li>
                               <?php }?>
                                <?php if ((get_the_author_meta('googleplus')) != ''){ ?>
                               <li><a href="<?php echo esc_url(get_the_author_meta('googleplus')); ?>" target="_blank"><img alt="" src="<?php echo get_template_directory_uri(); ?>/img/icons/google-plus.png"></a></li>
                               <?php }?>
                               </ul>
                                </div>
                                 </div>
                            </div>
                            <?php } ?>
                            
                            <?php } ?>
                            
                        <?php } // end of the loop.   ?>                    

                  
 <?php  if(of_get_option('disable_post_related') !=1){?>  
                    <div class="related-posts">
                      
                      <div class="widget-title"><h2><?php esc_attr_e('Related articles', 'nanomag'); ?></h2></div>
                      <div class="clearfix"></div>
                       

                        <?php
                        $jellywp_tags = null;
                        if (!empty($tags)) {
                            foreach ($tags as $tag) {
                                $jellywp_tags[] = $tag->term_id;
                            }
                        }
                        $arg_tag = array('tag__in' => $jellywp_tags, 'showposts' => 3, 'post__not_in' => array($post_id));
                        $post_query = null;
                        $post_query = new WP_Query($arg_tag);
						$post_count = 0;
                     


                        while ($post_query->have_posts()) {
                            $post_query->the_post();
							$post_id = get_the_ID();
              $categories = get_the_category(get_the_ID());
							$last = '';
							if (++$post_count  == 3) {
				$last = 'last-post-related ';
			}
                            ?>
                            

                            <div class="<?php echo esc_attr($last);?>feature-four-column medium-four-columns <?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?>">     
    <div class="image_post feature-item">
                   <a  href="<?php the_permalink(); ?>" class="feature-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('medium-feature');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/medium-feature.jpg'.'">';} ?>
<?php echo jelly_post_type(); ?>
</a>
<?php echo jelly_total_score_post_front_small_circle(get_the_ID());?>
                     </div>
 <h3 class="image-post-title columns_post"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>      
    </div>


                            <?php
                        }

                        wp_reset_query();

                       
                        ?>

                    </div>                  
              <?php } ?>
					<hr class="none" />
                    <!-- comment -->
                    <?php comments_template('', true); ?>
                    
                    </div>
                  <!-- end post --> 
        <div class="brack_space"></div>
        </div>
        </div>
<?php $full= get_post_custom_values('full_widthjellywp_checkbox'); if($full[0]==1){}else{?>
          <!-- Start sidebar -->
          <?php
          if (have_posts()) {while (have_posts()) { the_post();
          ?>
          <!-- end sidebar -->

          <!-- Start sidebar -->
          <?php echo jelly_sidebar_post_general_show();  }}?>
          <!-- end sidebar -->
  <?php }?>
        
       
        
</div>    
</div>
 </section>
<!-- end content --> 
<?php get_footer(); ?>


