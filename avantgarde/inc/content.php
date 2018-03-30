<?php  global $theme_prefix; 
if(empty($theme_prefix['featured-position'])){ $theme_prefix['featured-position'] == "before";  }
?>                   

<!--**************************************************************************************************/
/* Blog Post
************************************************************************************************** -->

    <div class="blog-entry"><!-- Blog Entry Start -->
        <article <?php post_class('clearfix'); ?> id="post-<?php the_ID(); ?>">
            <?php if($theme_prefix['featured-position'] == "after" ){  ?>
            <div class="blog-entry-title margint30 marginb30 pos-center"><!-- Blog Title Start -->
                <?php if (is_sticky()) { ?> <span class="sticky-post"><i title="Stick Post" class="fa fa-bookmark"></i></span> <?php } ?><!-- Sticky Post -->
                <div class="third-font active-color pos-center post-category"><?php the_category(', '); ?></div>
                <h1><a href="<?php the_permalink(); ?>"> <?php $title = get_the_title(); if($title != "" ) { echo esc_attr($title); }  else { echo esc_attr($post_date = the_time('F j')); }  ?></a></h1>
                <div class="post-details clearfix">
                    <div class="post-comment pull-left">  
                        <i class="fa fa-user"></i><?php the_author_posts_link(); ?>
                    </div>
                    <div class="post-comment pull-left">  
                        <i class="fa fa-calendar"></i><date><?php echo esc_attr($post_date = the_time('F j')); ?></date>
                    </div>
                    <div class="post-comment pull-left">
                        <?php if(comments_open() && !post_password_required()){

                        ?><i class="fa fa-comment-o"></i><?php
                        comments_popup_link(__('No comments yet','2035Themes-fm'),__('1 Comment','2035Themes-fm'), __('% Comments','2035Themes-fm'), 'comments-link', __('Comments are off for this post','2035Themes-fm'));
                        ?> 
                        <?php }  ?>
                    </div>
                </div>
            </div><!-- Blog Title Finish -->
            <?php } ?>
            <?php if($theme_prefix['sidebar-type'] == "none" ){  $featured_image ="full-featured-image"; } else { $featured_image ="featured-image"; } ?>
            <div class="media-materials pos-center clearfix"><!-- Media Start -->
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $featured_image );
                 $image = $image[0]; ?> 
                <?php 
                $audio = get_post_meta( get_the_ID(), 'theme2035_audio', true ); 
                $video = get_post_meta( get_the_ID(), 'theme2035_video_embed', true ); 
                $gallery = get_post_meta( get_the_ID(), 'theme2035_galleryslides', true ); 
                $link = get_post_meta( get_the_ID(), 'theme2035_link', true ); 
                $quote = get_post_meta( get_the_ID(), 'theme2035_quote', true ); 
                if($audio != "" ){ echo $audio; }
                else if ($video != "" ){ echo $video; }
                else if ($gallery != "" ){ 
                    
                global $wpdb;
                $images = get_post_meta( get_the_ID(), 'theme2035_galleryslides', false );
                $images = implode( ',' , $images );
                // Re-arrange images with 'menu_order'
                $images = $wpdb->get_col("
                    SELECT ID FROM {$wpdb->posts}
                    WHERE post_type = 'attachment'
                    AND ID in ({$images})
                    ORDER BY menu_order ASC
                " );

                ?>
                <div class="flexslider">
                    <ul class="slides">
                        <?php
                        foreach ( $images as $att ){
                            // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
                            $src = wp_get_attachment_image_src( $att, $featured_image );
                            $src = $src[0];
                            // Show image
                            echo "<li><img alt='' src='{$src}' /></li>";
                            }
                        ?>
                    </ul>
                </div>
                <?php 
                }
                else if ($link != "" ){ ?><div class="link-post-format"><div class="link-post-icon pos-center"><a href="<?php echo esc_url($link); ?>"><i class="fa fa-external-link"></i></a></div><div class="margint10 pos-center"><a href="<?php echo esc_url($link); ?>"><?php echo esc_attr($link); ?></a> </div></div> <?php }
                else if ($quote != "" ){ ?><div class="quote-post-format"><div class="link-post-icon clearfix marginb20 pos-center"><i class="fa fa-quote-right"></i></div><?php echo esc_attr($quote); ?></div> <?php }
                else { ?> <a href="<?php the_permalink(); ?>"><img alt="" class="img-responsive rsp-img-center" src="<?php echo esc_attr($image); ?>"></a> <?php } ?>
            
                <?php $photo_credits = get_post_meta( get_the_ID(), 'theme2035_photo_credits', true );  ?>
                <?php if($photo_credits != ""){ ?>
                <div class="featured-image-credits"><?php  echo esc_attr($photo_credits); ?></div><hr class="credit-bottom">
                <?php } ?>
            </div><!-- Media Finish -->


            <?php if($theme_prefix['featured-position'] == "before" ){  ?>

            <div class="blog-entry-title margint40 pos-center"><!-- Blog Title Start -->
                <?php if (is_sticky()) { ?> <span class="sticky-post"><i title="Stick Post" class="fa fa-bookmark"></i></span> <?php } ?><!-- Sticky Post -->
                <div class="third-font active-color pos-center post-category"><?php the_category(', '); ?></div>
                <h1><a href="<?php the_permalink(); ?>"> <?php $title = get_the_title(); if($title != "" ) { echo esc_attr($title); }  else { echo esc_attr($post_date = the_time('F j')); }  ?></a></h1>
                <div class="post-details clearfix">
                    <div class="post-comment pull-left">  
                        <i class="fa fa-user"></i><?php the_author_posts_link(); ?>
                    </div>
                    <div class="post-comment pull-left">  
                        <i class="fa fa-calendar"></i><date><?php echo esc_attr($post_date = the_time('F j')); ?></date>
                    </div>
                    <div class="post-comment pull-left">
                        <?php if(comments_open() && !post_password_required()){

                        ?><i class="fa fa-comment-o"></i><?php
                        comments_popup_link(__('No comments yet','2035Themes-fm'),__('1 Comment','2035Themes-fm'), __('% Comments','2035Themes-fm'), 'comments-link', __('Comments are off for this post','2035Themes-fm'));
                        ?> 
                        <?php }  ?>
                    </div>
                </div>
            </div><!-- Blog Title Finish -->
            <div class="before-title-line"></div>
            <?php } ?>



            <div class="post-text clearfix"><!-- Post Text Start -->
                <?php the_content(); ?>
                <?php wp_link_pages('before=<div class="margint10 post-paginate">&after=</div>'); ?>
            </div><!-- Post Text Finish -->
            <div class="post-end clearfix"><!-- Post End Start -->
                <div class="pull-left">
                    <div class="blog-post-tag clearfix">
                    <?php
                        if( has_tag() ) {  
                        echo '<span><i class="fa fa-tags"></i></span>'; 
                        the_tags('  ',', ','  ');
                        echo '<div class="clear"></div>';
                        }else{
                          echo '<span><i class="fa fa-tags"></i></span><span class="tag-title-post">'.__("POST HASN'T TAG.","2035Themes-fm").'</span>';   
                        }
                    ?>
                    </div>
                </div>
                <?php if($theme_prefix['share-visibility'] == "1"){ ?>
                <div class="pull-right">
                    <div  class="share-tools">
                        <ul>
                            <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><i class="fa fa-facebook"></i> Facebook</a></li>
                            <li><a href="https://twitter.com/share?url=<?php the_permalink();?>&text=<?php the_title(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Twitter"><i class="fa fa-twitter"></i> Twitter</a></li>
                            <li><a href="http://pinterest.com/pin/create/button/?source_url=<?php the_permalink();?>&media=<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 300,300 ), false, '' ); echo esc_attr($src[0]); ?>&description=<?php the_title(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Pinterest"><i class="fa fa-pinterest"></i> Pinterest</a></li>
                        </ul>
                    </div>   
                </div>
                <?php } ?>
            </div><!-- Post End Finish -->
        </article>
    </div><!-- Blog Entry Finish -->
