<?php get_header();
global $theme_prefix; 
if( have_posts() ) the_post(); 
$temp_post = get_post_meta( get_the_ID(), 'theme2035_selectpostsidebar', true );

if($temp_post == ""){
    $temp_post = $theme_prefix['blog_sidebar'];
}
$temp_default = $theme_prefix['blog_sidebar'];
if($temp_post == $temp_default){
    $blog_post_sidebar = $temp_default;
}else{
    $blog_post_sidebar = $temp_post;
}

if(empty($theme_prefix['featured-position'])){ $theme_prefix['featured-position'] == "before";  }
 
?>
<div class="container fitvids"><!-- Container Start --> 
    <div class="row clearfix">

        <?php if($theme_prefix['sidebar-type'] == "left" ){ ?> <!-- Sidebar Left Start (If selected) -->
            <aside class="col-lg-3 col-sm-4 sidebar">
                <?php if ( is_active_sidebar( $blog_post_sidebar ) ) { ?>
                    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar($blog_post_sidebar)) :  ?>
                        <a href="wp-admin/widgets.php"><?php echo __("Please Add Widget <a href='wp-admin/widgets.php'>here</a>","2035Themes-fm") ?></a>
                    <?php endif; ?>
                <?php } ?>
            </aside>
        <?php } ?><!-- Sidebar Left Finish (If selected) -->

        <?php if($theme_prefix['sidebar-type'] == "none" ){ ?> <div class="col-lg-12 col-sm-12" ><?php } else { ?> <div class="col-lg-9 col-sm-8" > <?php } ?>
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



                <?php if (is_sticky()) { ?> <span class="sticky-post"><i title="Stick Post" class="fa fa-bookmark"></i></span> <?php } ?><!-- Sticky Post -->

                <?php if($theme_prefix['sidebar-type'] == "none" ){  $featured_image ="full-featured-image"; } else { $featured_image ="featured-image"; } ?>
                <div class="media-materials clearfix"><!-- Media Start -->
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $featured_image );
                    $image = $image[0];
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
                    <?php } else if ($link != "" ){ ?>
                    <div class="link-post-format">
                        <div class="link-post-icon pos-center">
                            <a href="<?php echo esc_url($link); ?>">
                                <i class="fa fa-external-link"></i>
                            </a>
                        </div>
                        <div class="margint10 pos-center">
                            <a href="<?php echo esc_url($link); ?>"><?php echo esc_attr($link); ?></a> 
                        </div>
                    </div> 
                    <?php }  else if ($quote != "" ){ ?>
                    <div class="quote-post-format">
                        <div class="link-post-icon clearfix marginb20 pos-center">
                            <i class="fa fa-quote-right"></i>
                        </div><?php echo esc_attr($quote); ?>
                    </div> 
                    <?php } else { ?> <img alt="" class="img-responsive rsp-img-center" src="<?php echo esc_attr($image); ?>"> <?php } ?>
                    <?php $photo_credits = get_post_meta( get_the_ID(), 'theme2035_photo_credits', true );  ?>
                    <?php if($photo_credits != ""){ ?>
                    <div class="featured-image-credits">
                        <?php  echo esc_attr($photo_credits); ?>
                    </div><hr class="credit-bottom">
                    <?php } ?>
                </div><!-- Media Finish -->
                <?php if($theme_prefix['featured-position'] == "before" ){  ?>
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
                <div class="before-title-line"></div>
                <?php } ?>
                <div class="post-text clearfix">
                    <?php 
                        the_content();
                    ?>
                </div>
                <div class="post-end clearfix"><!-- Post End Start -->
                    <div class="row">
                        <div class="col-lg-6 pull-left"><!-- Post Tags Start -->
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
                        </div><!-- Post Tags Finish -->
                        <?php if($theme_prefix['share-visibility'] == "1"){ ?><!-- Post Share Start -->
                        <div class="col-lg-6">
                            <div class="share-tools pull-right">
                                <ul>
                                    <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><i class="fa fa-facebook"></i> Facebook</a></li>
                                    <li><a href="https://twitter.com/share?url=<?php the_permalink();?>&text=<?php the_title(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Twitter"><i class="fa fa-twitter"></i> Twitter</a></li>
                                    <li><a href="http://pinterest.com/pin/create/button/?source_url=<?php the_permalink();?>&media=<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 300,300 ), false, '' ); echo esc_attr($src[0]); ?>&description=<?php the_title(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Pinterest"><i class="fa fa-pinterest"></i> Pinterest</a></li>
                                </ul>
                            </div>   
                        </div>
                        <?php } ?><!-- Post Share Finish -->
                    </div>
                </div><!-- Post End Finish -->
            </article>
        </div>

        <?php if($theme_prefix['related-post-visibility'] == 1 & is_single() ){ ?><!-- Related Posts Start -->
        <div class="related-posts home-slider-3-grid clearfix">
            <div class="title pos-center margint60 marginb30"><h6> <?php echo __( 'RELATED POSTS', '2035Themes-fm' ); ?></h6></div>
            <ul>     
                <?php   if($theme_prefix['sidebar-type']  == "none"){ $number = 4; } else { $number = 3; }  
                    $orig_post = $post;  
                    global $post;  
                    $tags = wp_get_post_tags($post->ID);
                    if ($tags) {  
                    $tag_ids = array();  
                    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
                    $args=array(  
                    'tag__in' => $tag_ids,  
                    'post__not_in' => array($post->ID),  
                    'posts_per_page'=>$number, // Number of related posts to display.  
                    'ignore_sticky_posts'=>1  
                    );
                    $my_query = new wp_query( $args );
                    $totalrelated = $my_query->found_posts;
                    if($totalrelated > 0){
                    while( $my_query->have_posts() ) {
                    $my_query->the_post();  
                ?>
                <?php if (has_post_thumbnail( $post->ID ) ){?>
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home-slider-3-grid' );
                $image = $image[0]; ?>
                <?php } else $image = ""; ?>

                <li>
                    <?php if ($image != "" ){ ?>
                    <img alt="" class="img-responsive" src="<?php echo esc_attr($image); ?>" />
                    <?php } else { echo '<img alt="" src="'.IMAGES.'/slider-no-image-3.jpg">'; } ?>
                    <div class="slider-content">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <date><?php echo esc_attr($post_date = the_time('F j')); ?></date>
                    </div>
                </li>
                    
                <?php } }else{?>
                <div class="col-lg-12"><p><?php echo __("No related post","2035Themes-fm") ?></p></div>
                <?php } }else{ ?>
                <div class="col-lg-12"><p><?php echo __("No related post","2035Themes-fm") ?></p></div>
                <?php }
                $post = $orig_post;  
                ?>
            </ul>
        </div>
        <?php  } ?><!-- Related Posts Finish -->
        <?php comments_template();  ?><!-- Comments -->
    </div><!-- Blog Entry Finish -->     
    <?php if($theme_prefix['sidebar-type'] == "right" ){ ?> <!-- Sidebar Right Start (If selected) -->
        <aside class="col-lg-3 col-sm-4 sidebar">
            <?php if ( is_active_sidebar( $blog_post_sidebar ) ) { ?>
                <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar($blog_post_sidebar)) :  ?>
                    <a href="wp-admin/widgets.php"><?php echo __("Please Add Widget <a href='wp-admin/widgets.php'>here</a>","2035Themes-fm") ?></a>
                <?php endif; ?>
            <?php } ?>
        </aside>
    <?php } ?><!-- Sidebar Right Start (If selected) -->
    </div>
</div><!-- Container Finish --> 
<?php get_footer(); ?>