<?php get_header();
global $theme_prefix; 
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
                <?php if (is_sticky()) { ?> <span class="sticky-post"><i title="Stick Post" class="fa fa-bookmark"></i></span> <?php } ?><!-- Sticky Post -->
                <div class="blog-entry-title pos-center"><!-- Blog Title Start -->
                    <h1><a href="<?php the_permalink(); ?>"> <?php $title = get_the_title(); if($title != "" ) { echo esc_attr($title); }  else { echo esc_attr($post_date = the_time('F j')); }  ?></a></h1>
                </div><!-- Blog Title Finish -->
                <?php if($theme_prefix['sidebar-type'] == "none" ){  $featured_image ="full-featured-image"; } else { $featured_image ="featured-image"; } ?>
                <div class="media-materials clearfix"><!-- Media Start -->
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $featured_image );
                    $image = $image[0];
                    ?>
                </div><!-- Media Finish -->
                <div class="post-text clearfix">
                    <?php  if ( have_posts() ) : while ( have_posts() ) : the_post();
                    the_content();
                    endwhile; endif;
                    ?>
                </div>
                <div class="post-end"><!-- Post End Start -->
                    <div class="row">
                        <?php if($theme_prefix['share-visibility'] == "1"){ ?><!-- Post Share Start -->
                        <div class="pos-center">
                            <div class="share-tools page-share">
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